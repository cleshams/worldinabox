<?php
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


#¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬
#
#	ENVIROMENTS
#
#¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬

define('ENV_LOCAL', 		'local-worldinabox.co.uk');
define('ENV_STAGING',		'staging-worldinabox-co.stackstaging.com');
define('ENV_PRODUCTION', 	'worldinabox.co');


if($_SERVER['HTTP_HOST'] == ENV_LOCAL)
{	
	define('DB_NAME', 'worldinabox_local');
	define('DB_USER', 'root');
	define('DB_PASSWORD', 'root');
	define('DB_HOST', '127.0.0.1');
	define('DEBUG', true);
	define('DEBUG_LOG', true);
	
}
elseif($_SERVER['HTTP_HOST'] == ENV_STAGING)
{
	define('DB_NAME', 'worldinabox-31303751eb');
	define('DB_USER', 'worldinabox-31303751eb');
	define('DB_PASSWORD', 'l7e28mt64w');
    define('DB_HOST', 'shareddb-n.hosting.stackcp.net');
    define('DEBUG', true);
    define('DEBUG_LOG', true);
    define('DEBUG_DISPLAY', false);

}
elseif($_SERVER['HTTP_HOST'] == ENV_PRODUCTION)
{
	define('DB_NAME', 'worldina_wiab_db');
	define('DB_USER', 'worldina_wiab_db');
	define('DB_PASSWORD', 'Kw2MT!6MF');
    define('DB_HOST', 'localhost');
    define('DEBUG', false);
    define('DEBUG_LOG', false);
    define('DEBUG_DISPLAY', false);
}
else
{
	$msg = '<h1>' . $_SERVER['HTTP_HOST'] . ' doesnt match a defined environment' . '</h1>';
	die($msg);
}

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
define('AUTH_KEY',         'SvJ}Wx/q-y~x5PF:=OxRYv.J[W`[;*+8/f`B9kO+@<qFY8v3EG<AJTvb+0hBrR,/');
define('SECURE_AUTH_KEY',  'p+fL=KGNpEq-P-WSe%ii*G7{W,j6a.$A!Y>EA*~:|CCdV[T~iD`T/`XW2yR48@Z|');
define('LOGGED_IN_KEY',    'T^NZP{u(W5^YUea6N.B++#@%+?s2hf96.jloZ],1O<DL84SLY3lp9q9DM]d}Q>MH');
define('NONCE_KEY',        'kJ2!+ux&`UR8wN{f+t`AR?Av5A2g0EntG:H+KKP>t-TPol f|Yt;H*YUG2c{%s#d');
define('AUTH_SALT',        'l=,R[bd$(*>*ki3+ih6gxo3e[^_RG2;+Cl!edy,;uhdK<6tsL-[1K%SyE=X]+j)8');
define('SECURE_AUTH_SALT', '}z^xZtrN||JW/L9.!])-^4({*51G_eT+/P$NIe`@@1H6n:E<$3AF K:gz(B%x=Fi');
define('LOGGED_IN_SALT',   'F4X79u-DDO0;9z&1&C4w|.~[lXH`VMf_1Xrl)ZIu==!|/)U</LXYe1iOUroJK+Aa');
define('NONCE_SALT',       'w0+Ij~t#=..G&hIN3C<WE(v,-){TYUVQ$1^)7kO|>Azx6T8_Bt0zonSacj);7H?G');

$table_prefix  = 'wp_';


/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
