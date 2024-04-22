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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'leadgen' );

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
define( 'AUTH_KEY',         '(n,kOiPSe>&Y6Z.dnx U8!;nPMhdUwcp<B=!c8![ngr,s=.(Ka@7/r8yw^#IPN|e' );
define( 'SECURE_AUTH_KEY',  '@%Bj:?z$K[j-yC,_;5zC_(zI7O[H{s!=Ovil6{HzX!.nx}O:G`@`U*brKPjw8oA!' );
define( 'LOGGED_IN_KEY',    'Vd,xLc2fq?T_s[Nxg:y7hR|[,>gRRp.0}>9v>&a(iBt+aa[1]E71q|n*LXoH=v-5' );
define( 'NONCE_KEY',        '6i.ANQW4K<:EbELP=1,poEeXN|*g{(,I=Vu#ld#}INfbiW8MJ;M}SMs5dCj 8$D$' );
define( 'AUTH_SALT',        'f;~jCN:piae#y dT+`$o%ZOv|[t(x>fzFrA?QU|MKcxOgj,h6Sn|,aJ%bK KB: 9' );
define( 'SECURE_AUTH_SALT', 'GZKa2lbp3Ye[Mzvg7tpmm/PHmy4)p^)3k^D~qPOH O&{?8%H?(a,!XUX/g[[&[EM' );
define( 'LOGGED_IN_SALT',   '2O{3Y5;*zO4=rZDw[_9GU`{^XfKk3/ESntubm]a-UxQSp)TTGSz>O4js|1LLjOuM' );
define( 'NONCE_SALT',       'c=zn4bF6aJ2F,xyuK(bAtMd^c0&_AW?zdQ!F!Bv){T5Nl)+{7Gt%Alf$[]ywH}<^' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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

define('FS_METHOD', 'direct');
define('FS_CHMOD_DIR',0755);
define('FS_CHMOD_FILE',0644);
define('WP_MEMORY_LIMIT', '256M');
define('WP_DEBUG', true);
