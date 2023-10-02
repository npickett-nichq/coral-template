<?php

namespace Wpo\Services;

use \Wpo\Services\Id_Token_Service;
use \Wpo\Services\Log_Service;
use \Wpo\Services\Nonce_Service;
use \Wpo\Services\Options_Service;
use \Wpo\Services\Request_Service;

// Prevent public access to this script
defined('ABSPATH') or die();

if (!class_exists('\Wpo\Services\Id_Token_Service_Ciam')) {

    class Id_Token_Service_Ciam
    {

        /**
         * Constructs the Azure AD CIAM oauth authorize URL that is the end point where the user will be sent for authorization.
         * 
         * @since 24.0 Added Azure AD Customer IAM (CIAM) support.
         * 
         * @param $login_hint string Login hint that will be added to Open Connect ID link
         * @param $redirect_to string Link where the user will be redirected to
         * 
         * @return string if everthing is configured OK a valid authorization URL
         */
        public static function get_openidconnect_url($login_hint = null, $redirect_to = null, $b2c_policy = null)
        {
            Log_Service::write_log('DEBUG', '##### -> ' . __METHOD__);

            $application_id = Options_Service::get_aad_option('application_id');
            $directory_id = Options_Service::get_aad_option('tenant_id');
            $domain_name = Options_Service::get_global_string_var('b2c_domain_name');
            $oidc_flow = Options_Service::get_global_string_var('oidc_flow');

            /**
             * @since 24.0 Filters the AAD Redirect URI e.g. to set it dynamically to the current host.
             */

            $redirect_uri = Options_Service::get_aad_option('redirect_url');
            $redirect_uri = apply_filters('wpo365/aad/redirect_uri', $redirect_uri);
            $ciam_domain = sprintf('https://%s.ciamlogin.com/', $domain_name);

            $redirect_to = !empty($redirect_to)
                ? $redirect_to
                : (
                    (isset($_SERVER['HTTP_REFERER'])
                        ? $_SERVER['HTTP_REFERER']
                        : $GLOBALS['WPO_CONFIG']['url_info']['wp_site_url'])
                );

            $redirect_to = urlencode($redirect_to);

            if (class_exists('\Wpo\Services\User_Create_Update_Service')) {
                $scope = 'https://graph.microsoft.com/user.read openid email profile';
            } else {
                $scope = 'openid email profile';
            }

            $params = array(
                'client_id'     => $application_id,
                'nonce'         => Nonce_Service::create_nonce(),
                'redirect_uri'  => $redirect_uri,
                'response_mode' => 'form_post',
                'scope'         => $scope,
                'state'         => $redirect_to,
            );

            $params['response_type'] = $oidc_flow == 'code' ? 'code' : 'id_token token';

            // Add Proof Key for Code Exchange challenge if required
            if (Options_Service::get_global_boolean_var('use_pkce') && class_exists('\Wpo\Services\Pkce_Service')) {
                \Wpo\Services\Pkce_Service::add_and_memoize_verifier($params);
            }

            $auth_url = $ciam_domain
                . $directory_id
                . '/oauth2'
                . '/v2.0'
                . '/authorize?'
                . http_build_query($params, '', '&');

            Log_Service::write_log('DEBUG', __METHOD__ . " -> CIAM Open ID Connect URL: $auth_url");

            return $auth_url;
        }

        /**
         * Gets an OpenID Connect authorization URL for the configured sign-up end point.
         * 
         * @since 24.0
         * 
         * @param string $register 
         * @return string 
         */
        public static function get_registration_url($register)
        {
            if (!Options_Service::get_global_boolean_var('b2c_enable_signup')) {
                return $register;
            }

            $policy = Options_Service::get_global_string_var('b2c_signup_policy');

            if (empty($policy)) {
                return $register;
            }

            return self::get_openidconnect_url(null, null, $policy);
        }

        /**
         * Helper to process the authorization code which is then used to request an ID and access token.
         * 
         * @since   18.0
         * 
         * @return void 
         */
        public static function process_openidconnect_code()
        {
            Log_Service::write_log('DEBUG', '##### -> ' . __METHOD__);

            $request_service = Request_Service::get_instance();
            $request = $request_service->get_request($GLOBALS['WPO_CONFIG']['request_id']);
            $code = $request->get_item('code');

            if (empty($code)) {
                Log_Service::write_log('ERROR', sprintf('%s -> Authorization code not found', __METHOD__));
                return;
            }

            $application_id = Options_Service::get_aad_option('application_id');
            $application_secret = Options_Service::get_aad_option('application_secret');
            $domain_name = Options_Service::get_global_string_var('b2c_domain_name');


            /**
             * @since 24.0 Filters the AAD Redirect URI e.g. to set it dynamically to the current host.
             */

            $redirect_uri = Options_Service::get_aad_option('redirect_url');
            $redirect_uri = apply_filters('wpo365/aad/redirect_uri', $redirect_uri);
            $ciam_domain = sprintf('https://%s.ciamlogin.com/', $domain_name);

            $params = array(
                'client_id'     => $application_id,
                'response_type' => 'token',
                'redirect_uri'  => $redirect_uri,
                'response_mode' => 'form_post',
                'scope'         => "openid email profile offline_access",
                'grant_type'    => 'authorization_code',
                'code'          => $code,
                'client_secret' => $application_secret,
            );

            if (Options_Service::get_global_boolean_var('use_pkce') && class_exists('\Wpo\Services\Pkce_Service')) {
                $pkce_code_verifier = \Wpo\Services\Pkce_Service::get_personal_pkce_code_verifier();

                if (!empty($pkce_code_verifier)) {
                    $params['code_verifier'] = $pkce_code_verifier;
                } else {
                    $warning = 'Cannot retrieve an (ID) token because the Administrator 
                        has configured the use of a Proof Key for Code Exchange but a code verifier for the current
                        user cannot be found. See the <a href="https://docs.wpo365.com/article/149-require-proof-key-for-code-exchange-pkce" target="_blank">online documentation</a> 
                        for detailed step-by-step instructions on how to configure the WPO365 | LOGIN plugin to use a Proof Key for Code Exchange.';
                    Log_Service::write_log('ERROR', __METHOD__ . " -> $warning");

                    $access_token_errors = $request->get_item('access_token_errors') ?: array();
                    $access_token_errors[] = $warning;
                    $request->set_item('access_token_errors', $access_token_errors);

                    return;
                }
            }

            $skip_ssl_verify = !Options_Service::get_global_boolean_var('skip_host_verification');

            $token_url = $ciam_domain
                . "$domain_name.onmicrosoft.com"
                . '/oauth2'
                . '/v2.0'
                . '/token';

            $response = wp_remote_post($token_url, array(
                'blocking' => true,
                'sslverify' => $skip_ssl_verify,
                'timeout' => 30, // timeout in seconds
                'body' => $params,
                'headers' => array('Expect' => ''),
            ));

            if (is_wp_error($response)) {
                Log_Service::write_log('ERROR', sprintf('%s -> Error occured whilst fetching from %s: %s', __METHOD__, $token_url, $response->get_error_message()));
                return;
            }

            $body = json_decode(wp_remote_retrieve_body($response));

            if (empty($body)) {
                Log_Service::write_log('ERROR', sprintf('%s -> Error occured whilst fetching from %s: See next line for details.', __METHOD__, $token_url));
                Log_Service::write_log('ERROR', $response);
                return;
            }

            if (property_exists($body, 'error')) {
                Log_Service::write_log('ERROR', sprintf('%s -> Error occured whilst fetching from %s: %s', __METHOD__, $token_url, $body->error));
                return;
            }

            if (property_exists($body, 'access_token')) {
                $access_token = new \stdClass();
                $access_token->access_token = $body->access_token;

                if (property_exists($body, 'expires_in')) {
                    $access_token->expiry = time() + intval($body->expires_in);
                }

                if (property_exists($body, 'scope')) {
                    $access_token->scope = $body->scope;
                }

                $access_tokens = $request->get_item('access_tokens');

                if (empty($access_tokens)) {
                    $access_tokens = array();
                }

                // Save access token as request variable -> will be saved on shutdown
                $access_tokens[] = $access_token;
                $request->set_item('access_tokens', $access_tokens);
            }

            if (property_exists($body, 'refresh_token')) {
                $refresh_token = new \stdClass();
                $refresh_token->refresh_token = $body->refresh_token;

                if (property_exists($body, 'scope')) {
                    $refresh_token->scope = $body->scope;
                }

                $request->set_item('refresh_token', $refresh_token);
            }

            if (property_exists($body, 'id_token')) {
                $request->set_item('encoded_id_token', $body->id_token);
                Id_Token_Service::process_openidconnect_token();
                return;
            }

            Log_Service::write_log('ERROR', sprintf('%s -> ID token not found in data retrieved from token endpoint [see next line for response body]', __METHOD__));
            Log_Service::write_log('DEBUG', $body);
        }
    }
}
