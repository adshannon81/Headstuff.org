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
 //Added by WP-Cache Manager
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/admin/web/headstuff.org/public_html/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'admin_headstuff');

/** MySQL database username */
define('DB_USER', 'admin_headstuff');

/** MySQL database password */
define('DB_PASSWORD', 'crazyf00l');

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
define('AUTH_KEY',         '~dISAfo> RgxNEvtN=!Ii4<x$Qv|Vsb1Z[c~S/B)L(3w*(v|^Osa5U60h1>Em1|`');
define('SECURE_AUTH_KEY',  ';$sOb*C!C3n)ex-=XM(&6|dA+#<4w-|Q/|rgP]Ct|/+Hnkph.ZoZ^q#cj2Deu-+s');
define('LOGGED_IN_KEY',    '/HZX8g#>7IuI&sM/NR^`O+{<j }^S(?SpO>4A+l}#>~;H_2+,U:jM.V!wnV-#J[k');
define('NONCE_KEY',        'R+ksb0Ei+*Ooei|QjwK>UIUbDiq#m{Msj;sAp<dt8M&-[TPb^=PM(~[Q$+IqBfek');
define('AUTH_SALT',        '1J$,++Vf~H_q-Fn|gqCulKn=jkIa_SWIa5md4Tx-@ZUy,TQ2Q~^;v|7^f*Q%9zi-');
define('SECURE_AUTH_SALT', 'V*IlBv0+u_>xBb91C}|kdETc8s_m>]f-+|>mGp3.X7hyr6H<:bTwaN21}&TKN&g;');
define('LOGGED_IN_SALT',   'RNrw$<QtpI43JU_|X[E3 #u|>{`{#Ddmjz,?jU[6+skg.V_sowvCjCoVF@sld/Mw');
define('NONCE_SALT',       '>ae);&U::b|Pt}U[/2CRo0<#Xw2nf+ Yb=9~7Sm^MD^c]!ZjGjC|](^_ A-ggAN3');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

//define('WP_MEMORY_LIMIT', '64M');
define('FTP_HOST', '178.62.60.172');
define('FTP_USER', 'admin_ftpheadstuff');
define('FTP_PASS', 'xgTVWfgaFp');
define('FTP_TIMEOUT', '900');

ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . 'error_log.txt');
error_reporting(E_ALL);

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
