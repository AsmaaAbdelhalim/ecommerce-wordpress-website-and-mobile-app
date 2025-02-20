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

 * * ABSPATH

 *

 * @link https://wordpress.org/support/article/editing-wp-config-php/

 *

 * @package WordPress

 */


// ** Database settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define( 'DB_NAME', 'bitnami_wordpress' );


/** Database username */

define( 'DB_USER', 'bn_wordpress' );


/** Database password */

define( 'DB_PASSWORD', '7ee474abcc63f07343214c4d657751fbc9d8bde1781f9ea48f491e65ecd7c2f6' );


/** Database hostname */

define( 'DB_HOST', '127.0.0.1:3306' );


/** Database charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8' );


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

define( 'AUTH_KEY',         'kj,+tuf2U;_<H9[~Ommf;7n-SJpZ/n`F)OzAe/ayw-uXnx 37.{9fqS]&ow19)E9' );

define( 'SECURE_AUTH_KEY',  '|<y5Vr$N8cop.ZAE:fB3(VzH.{o,9)[x-)@((9ONUSJW3b}Lh8csCy6U-|Ss[RI*' );

define( 'LOGGED_IN_KEY',    '$awa?Y |yO+$3d_(]VC!g70R`YakM|?J@}tKt4I<3Dy1?sV):teNB^h?Pxlx&g91' );

define( 'NONCE_KEY',        '$zKE8ppe|=QM^TNk*|xmKLEB9pfn4d$ykw>|E#^on3|y.u[r1Gb{UqsA+bSCwn;3' );

define( 'AUTH_SALT',        '#,q~;GG>|jXo.}Ht fRiu>|qPyxEWKbSg@28$]ebvya1kKgi3U.@7KX!#6[(#4o8' );

define( 'SECURE_AUTH_SALT', 'a74>RfjuQ+paeqW&QE%j[ AF.N .27%ifK090a>*^Dmm|&X?,rvBJD3.+BYKoPTn' );

define( 'LOGGED_IN_SALT',   '<]RA=_4/M j<Q2)`a3uTPmBkzfkq<vs1rz5G+}dF#8yR$O*JroXVut(9~3-h@5Vn' );

define( 'NONCE_SALT',       '_{C,?9#c:=:&y6z@bow:q*,gwJhq3pVoi5MRQQ|zeY5Q|@$nkO_gYSW{;|N%c{1K' );


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

 * @link https://wordpress.org/support/article/debugging-in-wordpress/

 */

define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */




define( 'FS_METHOD', 'direct' );
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
 */
if ( defined( 'WP_CLI' ) ) {
	$_SERVER['HTTP_HOST'] = '127.0.0.1';
}

define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */


/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}


/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';

/**
 * Disable pingback.ping xmlrpc method to prevent WordPress from participating in DDoS attacks
 * More info at: https://docs.bitnami.com/general/apps/wordpress/troubleshooting/xmlrpc-and-pingback/
 */
if ( !defined( 'WP_CLI' ) ) {
	// remove x-pingback HTTP header
	add_filter("wp_headers", function($headers) {
		unset($headers["X-Pingback"]);
		return $headers;
	});
	// disable pingbacks
	add_filter( "xmlrpc_methods", function( $methods ) {
		unset( $methods["pingback.ping"] );
		return $methods;
	});
}
