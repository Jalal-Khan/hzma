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
define( 'AUTH_KEY',          'Y1/c=6:Q%[RI:DM?:lFGPN.=eEA+x$RsE .3J6Zusodn,GqNQ|%kRbP&S0vmikxQ' );
define( 'SECURE_AUTH_KEY',   'o*uw?wF3Z25d.N^hGS1Na~dFp&NsN8|,ZyL%c HF+wlo|Z;6?-3k>#$iI]f1V?ZE' );
define( 'LOGGED_IN_KEY',     'N/{b]5&fE6a)`8C2s) IQs3`|r}C4spOj?WJSO-KFbg__$%d0pd[Q<?2p)a>P^nN' );
define( 'NONCE_KEY',         'zwj>39{QROp_Egr>k4Dk+O1ok<|5l_r~:,7& 7CgqS3#,#%~dV9_x3,vmnXlP>d.' );
define( 'AUTH_SALT',         '_Bo|TS3v#Z0gTEb!Du?^a> mKQ7XZgpzc9Zge@m*QM8GI0S3%AeyZ+5$BqUx~OjQ' );
define( 'SECURE_AUTH_SALT',  'nI?da0J#.#KlB]=7.%+?P-2b:hGXU/:j$J=|55>atf8t`){}t< qSc[8@K!y%LGD' );
define( 'LOGGED_IN_SALT',    '![OrUIX+&}rXOs+{(By+NSX7jT&3/._Xk&/i3Miz1S|~4v@KjdN<%R?O/?;I+/Bi' );
define( 'NONCE_SALT',        'iG{HNG60bkE)7lqg.x~zJxMo^qCy1)<E~.g[P`_m,IUoJD?`Pu%*K5|KpMOUX3w=' );
define( 'WP_CACHE_KEY_SALT', 'n<=: fv*Fe<5G#S-zA&_(Ocl68Nsd/Na`q,#*0[2 t:=.^I-<SW4L?Ha}}x^e6(b' );


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
