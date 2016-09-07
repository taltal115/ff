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
// !qwRf$%tY^7uJ
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//define('DB_NAME', 'findingfootage');
//
///** MySQL database username */
//define('DB_USER', 'root');
//
///** MySQL database password */
//define('DB_PASSWORD', 'root');
//
///** MySQL hostname */
//define('DB_HOST', 'localhost');



// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'findingf_live');
//define('DB_NAME', 'findingfootage');
/** MySQL database username */
define('DB_USER', 'findingf_live');
//define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'D@coders0333');
//define('DB_PASSWORD', 'root');
/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
//define('WP_ALLOW_REPAIR', true);
define( 'BP_DISABLE_ADMIN_BAR', true );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '9R?+&?[JfqmXicAof0.?Jflx^OW>+]8.en?mm*cm^QGt<qHH<Thl|U-tO^}Vkql1');
define('SECURE_AUTH_KEY',  'FobDU<|?)7^L&Q2-sPBQPa-qV2Jh(6e+j!s}F&Y.VZ`|p{^+H^tn}q(]B}Xi#bZ5');
define('LOGGED_IN_KEY',    'jRtAw0WKlxlID-%9s!Q1X7|k}_S9]l4z&T%G-|-NEh8V-|76qoAZo!*2>lvZ/n*/');
define('NONCE_KEY',        '+dj)YYi>8r/OpLe3(wf-LtTe~-nidcC|v-YK/#3c^.-c$;zU.jS}#+*_.dvEzrgz');
define('AUTH_SALT',        '[8Pj>Yt@fS=dPJzAg`k@Y^:o&>Vgz}*^Ji|-| q^i>^E;A}qIqbv@^h@-LFF}#;q');
define('SECURE_AUTH_SALT', 'q%K3Q ,pVn$)fU-+|tg11nL/eO*UY._Wibfh4L5q]N9vX2rp6nuCh:*Vn;(lc+$@');
define('LOGGED_IN_SALT',   'XC_.PSV@;h-F@kg2B1)Ifp93k6%imr`N1K;z4nZiA$JAig+45cRD_Hd:N}_S`>:^');
define('NONCE_SALT',       'K}Mwuy7YB+)-BV+_jS| /uN!L1$f/  eW[wR0F@EbScK{,dk}.y<b*CRfVR1&.,e');

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
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
