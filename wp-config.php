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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'gbdecks');

/** MySQL database username */
define('DB_USER', 'greensburg-decks');

/** MySQL database password */
define('DB_PASSWORD', ',Vbb-STpTXOQ');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '^h~|L(J%!#^9N8#CC)M&4Qg+EgPIG}+ifvk-?p{(ZnGTvD1H[eC7`a8ely5RWzBY');
define('SECURE_AUTH_KEY',  'A/ynsm|Md+oht*hY!SPjMb~V11EJHh`m#RAtf`z_arS8_z5*$EEPc,rqI6V+:hBK');
define('LOGGED_IN_KEY',    'kZC$jdK&c&On6|+$94!Y:)dK6VNH8 Dc(ZYnp8l(tB<>a(i>QDw<C@9O?+O5??-I');
define('NONCE_KEY',        '.,Z2ASC=bEZ%GGusAhdc/pnD_k(/>qx<juac`HobOlV#|-wj_Z7A8wsEB4SnNa-Z');
define('AUTH_SALT',        'l*-WQ~;^Y%oVr`e%uTM4>p&aH6g:}PJ):gf.rVwYl9ATU`WT3.>4@^A{nKQ[mx,V');
define('SECURE_AUTH_SALT', 'AHYx[jfM`)H)PPdF|TC@(7roYQ^Y1aw?fS|65(~F0FnB]`PU9<T#fX86G/2XY`g]');
define('LOGGED_IN_SALT',   'NwH.:h/Op}nw/qR0~ IMPrXtfPX3j#$TYq6Va=P]wxh>}vVZw]l>tf~vF9b<#JF.');
define('NONCE_SALT',       'Vv|o[da>&05Rs/6W~:^Y]3dv(2s>?Id8LAaB_Q5&@<al_G#aGb>mhlCJ~Q5E,c2e');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
