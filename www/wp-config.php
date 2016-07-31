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
define('DB_NAME', 'feature-lights-db');

/** MySQL database username */
define('DB_USER', 'bertie');

/** MySQL database password */
define('DB_PASSWORD', 'Pa55word');

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
define('AUTH_KEY',         '?MI}mW.Oc54ab:]zT^yEiz^$JKghtWJ/?AI s>bJpuF8lt#%|?Tj_e(+#RFR}auF');
define('SECURE_AUTH_KEY',  '=FwB<G,yX.85KeGU95B4}ZTIeX.~-c???AI6{{@feV.Tm8cP4*-e_A$P^8WnG4)i');
define('LOGGED_IN_KEY',    'XEx#(n!cM=})}b=C9e{j=vV4>]M|u[d,uMOKc}B?qS]B[_iUVz;&^&S/s;)X;k+G');
define('NONCE_KEY',        '_F9vA@3rhw7~K=^M8G9(WzDVE^!4~Eg*a|u+Fy_)$T#RjaZ:+swAbx$,um  !fe?');
define('AUTH_SALT',        ' )y`#m?Re?,C_4h08u|esNm0DyriH,29!BK?t-b_FG4IJ)7iQsks@im9-n2uj`JI');
define('SECURE_AUTH_SALT', ' Dxq*cZz`JQEFFdu#Fh]*=+uKy=hhI?*59?ie>D3m/h3I?Fl$faO?XXZ/$l1<> k');
define('LOGGED_IN_SALT',   'w*WbRtDop?f0|[UON)4-AL13P@W$yz%P61l44NNwOU[E2EeP2#u$9KQ&Tyjfq2<<');
define('NONCE_SALT',       '@Jq;gz&b.R#;v1#9^6J:$/3uzC=uiwmSHM 5Nr{slhmDvaTd^W0$iX,QmQkN{W.[');

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
