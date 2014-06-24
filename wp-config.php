<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true);
define('DB_NAME', 'jimbirch_wdps2');

/** MySQL database username */
define('DB_USER', 'jimbirch_wdps2');

/** MySQL database password */
define('DB_PASSWORD', 'DL9XtD6EDT84xBzT');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '+|a{XC&|g3=}9i@cxN6!(gpOw;r@L$%S(@xSZ=%XIz/$u[|A_7#A%swUhCF8ztN|');
define('SECURE_AUTH_KEY',  'fz$|lr;UYvK2ZS~BwDNTWVbdaKz. k>~,:<wF!<iIE[+?-;TC&qg9;l*Usdlpp|{');
define('LOGGED_IN_KEY',    '6J)n+@*l])?k?&$az3+U)F{ZX;F5x1aj,Z+@hwy@ZwE.S#_GL%p[n #X1+PL%Y5^');
define('NONCE_KEY',        '9&[mcW)msBsWg|-J&YU72`:&0CY-)!rX09NATy`&+FC+C66>;@2#1fP]Hrr%M|`6');
define('AUTH_SALT',        'U6XomLR73smj;83+}>EAX||)jWG6<ez=?4.-Xj>sHD+pKSR>/#K9L>)eaMh{&;7W');
define('SECURE_AUTH_SALT', '_!,fULl+sv;%uH$^J?YqK8-YlVj2ezg@Q|qm%0Oh ntM0e!,-}zw#%(+f6A8:{9I');
define('LOGGED_IN_SALT',   'RnG(#u#3O*&.q0FkYXVFB?xiky|  1Mwn<QPnNyb>7T@m/%-Hvb`DIai`}xF57mw');
define('NONCE_SALT',       'C|36mejx8ZC,~^;uSMHc`O!k?yHDr/&o(|S9Gej/=)(*p%h0]Jm_^mXLkSws[?YQ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
