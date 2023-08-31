<?php
/**
 * @package BuddyBoss Child
 * The parent theme functions are located at /buddyboss-theme/inc/theme/functions.php
 * Add your own functions at the bottom of this file.
 */


/****************************** THEME SETUP ******************************/

/**
 * Sets up theme for translation
 *
 * @since BuddyBoss Child 1.0.0
 */
function buddyboss_theme_child_languages()
{
  /**
   * Makes child theme available for translation.
   * Translations can be added into the /languages/ directory.
   */

  // Translate text from the PARENT theme.
  load_theme_textdomain( 'buddyboss-theme', get_stylesheet_directory() . '/languages' );

  // Translate text from the CHILD theme only.
  // Change 'buddyboss-theme' instances in all child theme files to 'buddyboss-theme-child'.
  // load_theme_textdomain( 'buddyboss-theme-child', get_stylesheet_directory() . '/languages' );

}
add_action( 'after_setup_theme', 'buddyboss_theme_child_languages' );

/**
 * Enqueues scripts and styles for child theme front-end.
 *
 * @since Boss Child Theme  1.0.0
 */
function buddyboss_theme_child_scripts_styles()
{
  /**
   * Scripts and Styles loaded by the parent theme can be unloaded if needed
   * using wp_deregister_script or wp_deregister_style.
   *
   * See the WordPress Codex for more information about those functions:
   * http://codex.wordpress.org/Function_Reference/wp_deregister_script
   * http://codex.wordpress.org/Function_Reference/wp_deregister_style
   **/

  // Styles
  wp_enqueue_style( 'buddyboss-child-css', get_stylesheet_directory_uri().'/assets/css/custom.css' );

  // Javascript
  wp_enqueue_script( 'buddyboss-child-js', get_stylesheet_directory_uri().'/assets/js/custom.js' );
}
add_action( 'wp_enqueue_scripts', 'buddyboss_theme_child_scripts_styles', 9999 );


/****************************** CUSTOM FUNCTIONS ******************************/

// Add your own custom functions here

/* code to hide admin help posts from non-admins */
function admin_content( $atts, $content="") {
	if( $content && user_is_admin() ) {
		return $content;
	}
	return '';
}

add_shortcode( 'hide_content', 'admin_content' );

/* helper function to check if user is admin */
function user_is_admin() {
	$ret = false;
	$user = wp_get_current_user();
	if( in_array( 'administrator', (array) $user->roles ) ) {
		$ret = true;
	}
	return apply_filters( 'user_is_admin', $ret );
}

/* add new users to forum */
function auto_enroll_new_user( $user_id ) {
	$auto_forum_id = 479; //id of the NON-GROUP forum to add
	bbp_add_user_forum_subscription( $user_id, $auto_forum_id );
}
add_action( 'user_register', 'auto_enroll_new_user');

/* make notify of new replies auto-checked */
function notify_of_new_replies_by_default( $checked, $topic_subscribed ) {
  if( $topic_subscribed == 0 )
    $topic_subscribed = true;

  return checked( $topic_subscribed, true, false );
}
add_filter( 'bbp_get_form_topic_subscribed', 'notify_of_new_replies_by_default', 10, 2 );

?>