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
define( 'AUTH_KEY',         ':wk-2Z;S3 6CUIog:x|KE8A]Xc54~o=.hK $bu3tO__B$5l9 e(E5rFll0nVn6CL' );
define( 'SECURE_AUTH_KEY',  'M)i!Z2/+y,en#O,z2GtO{VE(+4ncN+:J1lbIW7Wa4N-/W%C&R(<0%gpf+T0[Y}Rn' );
define( 'LOGGED_IN_KEY',    '{tBkrf.s5Z$6H-ve 7sw.L<eD.u+6:uy)Ims.ge!Rvr/>/?qUreLKdc3hG[*@qC5' );
define( 'NONCE_KEY',        'r~rb8q%38QOsB:f)s+C];Y^=b@#JP;TT)VbT~%>,x3ruHxG=|@(COqo~9pFl:pIw' );
define( 'AUTH_SALT',        'W.rKbu}5/n3nGJHkE@ImM?8SW@|7<8Tlv+Pg?L+Idf3j4)/mbzd/ukhr]EPo^9M9' );
define( 'SECURE_AUTH_SALT', 'E,Q3@r>fL>Y>{ht67SSq`U,73A@bD9NS*ptP:A,JFI7)& }PVVsfRdo<_%KGrB[:' );
define( 'LOGGED_IN_SALT',   '2ZX`}WrZ.0Fa7Y;1|Vp%6/$SECV p&hHkJ*z#$7_R9Xc1j5Cg@!iq6gVgdG+nNJ+' );
define( 'NONCE_SALT',       'd`OiH@F KIS!a~Ni839Rck8<)U=9-zSXq79D]c/p #k;MoO]d[`I#zM;V$`oG+oW' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
