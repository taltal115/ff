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
define('DB_NAME', 'findingfootage');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '4E+-0lt&| 3s80Dt?{2i>^EdQlYnvR(&0L|[Z8+`9`N&zSC>x0:Le4&/WR&P^L,U');
define('SECURE_AUTH_KEY',  'G$B#:+|h*J_a6l^|E7}8I?!W@+^{|AX#MQq48}9lC7cbf9O}(`AfN|GHY:om&(-K');
define('LOGGED_IN_KEY',    '2rZS2U[{O=@)`+Bo(j<.=Uu,;*y=ZOoHSD-]5|Pw>|[yAP[(tf%GsA&4M[6=M_LN');
define('NONCE_KEY',        '5)4g-#ggQ}[o~y:?&AMA4E<qCDN479r5a,Xi+!Lao<b!wTIcdP]fqJR|*Y&4K5-K');
define('AUTH_SALT',        '9|fhOCv{AfopG^!#mG#CDkE-1boF41apO#ujq+WulesI-CW!R||CZ#9~fo/:`^Fh');
define('SECURE_AUTH_SALT', 'OR0-;`rRqM}Ve!8wlMS-o-0C4YdqqcP-?|_*m?@WE>wmmd^Ihb eG][22E|Ev(mw');
define('LOGGED_IN_SALT',   '+iS<k:95xs@+<T([s/3:u$S8;gp#ZDu,Vy@RuHTRqOC0)E-QWes}$pBhC.WzW/-:');
define('NONCE_SALT',       'E&=F[r]O2C!Qr0`su|,|Y>DMt`2,F(,Zb-On`.p$-2IZ;*|kqw</-U}Z@<T7IF:*');
define( 'BP_DISABLE_ADMIN_BAR', true );
define( 'BP_DTHEME_DISABLE_CUSTOM_HEADER', true );


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