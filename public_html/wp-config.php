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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',          '0tOcyuX-Tpx?RR*x//Pal!U-n>DaR?)9)Aw,>s]aR8ouXtT4$[[R!j,6)=W,LP+@' );
define( 'SECURE_AUTH_KEY',   '`%zrV,;U4$,k]uQ)Gk$`E1]G{-hzBdl2^z388zg~JRiO{}T5T6@x*@:yPM7l1~-1' );
define( 'LOGGED_IN_KEY',     'g@$H/PP@Xv^|-(1p>|..L(]wt?S>IiQ@I(.N;~j{<~b ^rya2l: ]Qwv%).<{$ph' );
define( 'NONCE_KEY',         '{lWi>iZx;:tXO.0iPC{:vmaRQ#JjjY.uI[I.|z~9S`._92}n1W!/K,g!{@W+,mRM' );
define( 'AUTH_SALT',         'u85%.Y?Lsjn5e!q?e4D7(z:Y8mF,<OT6Q):Dekp*&K,{/0 R]XZBHAq=sf}j81CC' );
define( 'SECURE_AUTH_SALT',  'g<qVF*do2Z` [frdm4;?G6KGQuTWz>0}go4UE;2ZQGOW5A]HC /W{~%w-{uSgkO9' );
define( 'LOGGED_IN_SALT',    'Jblx5TivPvi[W?jSGeCLFk[FC&<d7T}lm;{vr8b3^*ZMc~xZT7w,nttZC#0-YyNz' );
define( 'NONCE_SALT',        'E_m|D7EfS7D_FiEAKEvGuPj)}||1F4e[<o40e1-wdJ+Sd*(`{N]VOyyb-QjQS8a7' );
define( 'WP_CACHE_KEY_SALT', 'xD>E5_Q2p|TI{9L;>w8qUmY8!;^DcK,O |2IE.F9APs -85Oc0Lt}O}.K2rhbL%s' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */

define('WP_DEBUG', false);

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
