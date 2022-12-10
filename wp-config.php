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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'laptopfusionwpdb' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'T{5-(n%QF[3Bs(L@{lOm:PYezAYg^/N/l0h0u&<cMdO ZKw/Q5%ZnxV:pct#0WN{' );
define( 'SECURE_AUTH_KEY',  'T@nB+l~svFF:&)GvD(MRFo_^dIl(L`0Nz~V+$?I+1FSiBxfn/CsmWU,rjxip =C?' );
define( 'LOGGED_IN_KEY',    'BD1tDSL E.93FgS?v]T//R$R :!@G_VXhAL4.PaxP/E qz6N&Fj,YTnqna:^fm)7' );
define( 'NONCE_KEY',        '];2d$=QcPRc:S%IY;1b;Jnp@#jGjtTVolajblUgn:rWh;3EEv}@|SL,)P}5EVX3i' );
define( 'AUTH_SALT',        's4zty6#6WA_}zI1<kc(8TzQXkaT&$2c$.F$VeXykb@?/0Fz1o/Cf-?[`#rrc358>' );
define( 'SECURE_AUTH_SALT', '_aiB%RKC;j)7a+Hs:eTSNCcvWX4F!-@2M,<[afvd0~,:BwhO?tR2Ix)oz%*Ij<gx' );
define( 'LOGGED_IN_SALT',   'Zp:XQ;~+p|ivABUp?v$*erQ;6@RJw9;Q,d~(Jt|O`Yx)cmL> Ba1]v;n*s$I-wuN' );
define( 'NONCE_SALT',       'en1)zpA]knw&vK6^mn[>b,humoH$d#(H_v/|j}?g6ADKLC>Y/|ElkM-|8s)EPUlj' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'laptopfusionwp_143';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
