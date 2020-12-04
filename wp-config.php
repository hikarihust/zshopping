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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'zshopping' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */

define('AUTH_KEY',         '2GlJx4sYw2*o(X4tKe:QUbY-$mRjtu4G*I8j38?Fg`gNe}_{te3qJd7,Bu;g#w+0');
define('SECURE_AUTH_KEY',  'n1>CKshj?*B!%p$YZp6w49a/4Rw<IYzFM6m|IL<&^Ek6v+S8;97iTj42Kg7[lq.-');
define('LOGGED_IN_KEY',    '0H`.}?EOm@kl1ZkoFTA--x|7M+KlZ&^;-T0$r27ahNb-{5x0MAK|v>?/5IQ|f;K&');
define('NONCE_KEY',        '6jk)F{T:sz#7RV*V]t,2ES7C<(k|iKP;,(6*JD-(b;rZeT{cAmT|QDmj v |O;7P');
define('AUTH_SALT',        'POnj0^3,nrg&yT2i^r=GJH@=%Hf~T%5+ |[W1Mord+)9Jh *f?j=&gV~c+3X||e3');
define('SECURE_AUTH_SALT', 'i%#t[:nk<%}w/|dv1CSFPRS/TXq<uc+b/*d/tU~7yA62jOwEUm+pKdl/|HTM0hJ9');
define('LOGGED_IN_SALT',   'P2GlGR~7d_hM(I|};?CU+un7?y8x83-hWO_FSY)BzY,YN0&hoh2RZqRePEOyoDb;');
define('NONCE_SALT',       'V%v`p@:N9CXV~%H4+OAW9.:onVZSMn+,S?l?oBYbanW(-al_$-e*d[(]ZyU~>u)}');

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
