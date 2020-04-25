<?php
// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line

if(php_sapi_name() == 'cli') {
    $_SERVER['HTTP_HOST'] = '';
    $_SERVER['REQUEST_METHOD'] = '';
    $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
    $_SERVER['HTTPS'] = 'on';
}

define('HTTP_PROTOCOL', isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http');
define('WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/content');
define('WP_CONTENT_URL', HTTP_PROTOCOL . '://' . $_SERVER['HTTP_HOST'] . '/content');
define('PLUGINDIR', 'content/plugins');
define('MUPLUGINDIR', 'content/mu-plugins');
define("DEVELOPMENT_MODE", getenv("ENV_TYPE") == "dev");
//define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor


if(DEVELOPMENT_MODE){
	$db_name = 'denikates';
	$db_user = 'root';
	$dn_password = 'Meir2788@&**';
	$db_host = '127.0.0.1';
}
else{
    $db_name = 'denikate_jdprod';
    $db_user = 'denikate_jduser';
    $dn_password = 'Danit2788@&**';
    $db_host = '127.0.0.1';
}




/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', $db_name);

/** MySQL database username */
define('DB_USER', $db_user);

/** MySQL database password */
define('DB_PASSWORD', $dn_password);

/** MySQL hostname */
define('DB_HOST', $db_host);

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
define('AUTH_KEY',         'lJ4(P)dN|s(9MfHp}t.?b$9V:R`)Ha.lt$E|LdCHn_w97d;|a{tB=fN?QOO[o{r7');
define('SECURE_AUTH_KEY',  ':f5tK<GdfP1c);yc=5[PJ]!~%jyEKRM0zR`G@4.WjU0 n9NwdbwH*_EQsN=hAqq9');
define('LOGGED_IN_KEY',    'I$6q^R>im?*Tv7 w2|mjwPVvp0!q@R`(Yuf<I$s-#iZ,3AMrPx<9l+8c:|(ALkQ>');
define('NONCE_KEY',        '4pI>=xWD#^8O9T`w!H/;Mdr^*Oc1J;|0++hu~}_Exhg+cPW4tJbD7$Z0l?oDAiI[');
define('AUTH_SALT',        'FchOKtyz%&{Hi-7s;t@.6OK6we`xe-((=BnzI!@7S?0ImJ^7_ZQBq>UK?wEo|;s>');
define('SECURE_AUTH_SALT', 'xYD0w*?^CZ@U8P~.Y+.9!ai[0E|N5$wINzN_{EmPpu8Uj!e#kJTBEy,Ww@3w_ s.');
define('LOGGED_IN_SALT',   'I$5J~~JYVs4*,z;{<)0d1>:]^Q&>Ly~I9i0#|7Qu1&|pXmG]JKsRQ+6VnW;K9g#`');
define('NONCE_SALT',       'H%4g}k-ZLnx!=^@r23BJB0) ]@O=}ZBiURL&!k2my$GdlNu )HgRIZT2o12)j<,4');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'jd_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', DEVELOPMENT_MODE && false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
