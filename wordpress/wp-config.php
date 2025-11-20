<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
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
define( 'DB_HOST', 'localhost:3307' );

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
define( 'AUTH_KEY',         '{VX]))6e6Ol<wB(qH3)B3PXn)$k?IeoN0JXGo&b%:O|E8w$M_4kLh>fu.X*lPjVo' );
define( 'SECURE_AUTH_KEY',  'aQ*0aV=N]lCgPe: <ADZ@!aoldBpm<7/`7y7zH/;_+St<%1)`XvWkDPZ;^.p7of4' );
define( 'LOGGED_IN_KEY',    'V22y&|d?Q2,mzdq&tR~Lua]:>OhB_g3k]}lN]<ThSzNt%H/hok 8d*aPc;l$v2ka' );
define( 'NONCE_KEY',        '^K!Ff,jQIO(2gL*J}vkeWgch_[WZd&_Ip, 2Kd)VO`%u!T^UL|arhX$=TqDAfsO[' );
define( 'AUTH_SALT',        'PBLthMtwu E@f53!^d{w}*h&r{dhk!k0I6zh/A(@R?HOrC3 2Z[CcYb}np^P {Ph' );
define( 'SECURE_AUTH_SALT', 'TSb#yBNk+D;Aafx.&dL*).Vd>;j,%yXlO5xe5@4,JF1;*FuD5^;}Zv>Ip(W>0au}' );
define( 'LOGGED_IN_SALT',   '0lH[o8[&.q6.&T%$;m@BQ(g6mfP9:_KW}z/4oYS.I%|FSSDqn*RFeuSin2eK|G>0' );
define( 'NONCE_SALT',       'Qp,Rs.dGYUx,,(&{`FMHE{PD<)_P,[:84gdAu`F`9}>zsCZ9YQmrF)(*;PoN$p2#' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
