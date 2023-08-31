<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'coral' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ',q4NRfO;!(ve#;o,9*@1OEDhsfWECnR,E3s){&-L}U@+Br-[@.AOEKpnNBz.ORt&' );
define( 'SECURE_AUTH_KEY',  '8?!t/f`ia/W=4c)}Y(@&%5/&HHX@B,&@7c2uyqp43)kPj?(;($,s[sV }t!vq0IF' );
define( 'LOGGED_IN_KEY',    'H9bqq/$MCjTD^K =L|Rh?S9A+o7&wWt=c#-H2_tNl_fXF$DiJQO*`.iV:WgN%o{f' );
define( 'NONCE_KEY',        '&]b}8GauqpC!T^u,^Q|v)!|)ks_YZo2ObmgOh^!]}^bHC?!qAtv<Qt/Ir;=r.]s&' );
define( 'AUTH_SALT',        '/`?s<$:CG~mq%-E#-D4rRTn$WyioDl[6KM -b0A$,^wNln8VU1^$COV$T:tG!nlw' );
define( 'SECURE_AUTH_SALT', '>-d|1 |/hf6S]$S|/c[i&r;/!C`/y5*%@|Nl?BZKwrOVUq||>nK.S,n@M{nLE~<2' );
define( 'LOGGED_IN_SALT',   '(1>4G(ceOXd}4yP0/:#Q}%PAM~lu|$Y_kC5),RnpXWlg)oxW2sYllYgP/!L1rbX,' );
define( 'NONCE_SALT',       'GZb-V[BuB9(=EoUfbfc3Z]VgqFa@#?C`_}T5`xkX+:R9?,PDDviU`$.~*3>QCLCp' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'cd_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */

// Enable Debug logging to the /wp-content/debug.log file
define( 'WP_DEBUG_LOG', true );

// Disable display of errors and warnings
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 0 );

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define( 'SCRIPT_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
