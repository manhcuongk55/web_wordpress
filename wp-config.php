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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'ok');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
define('FS_METHOD', 'direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'o>)H1mN;{m P0?|<qjXM@*}fsU|V_$;=P_Q$!Si_tl4GofHoD;t+>X<y|N ojEcO');
define('SECURE_AUTH_KEY',  'it-!*_w)H5NSN.]qHEe>bTQ=WP^2(3(_=f1cYfxVb8x>P@F%}|~x#9|SLnLu))0t');
define('LOGGED_IN_KEY',    'DH=f!bactNoC!O%Vry^8?+*.w}SK7V^C1[}53U+};P?M0_,*7CH]im`L5jKWi7S|');
define('NONCE_KEY',        'EE8L_m7(U`L;24eX|#.:fw KH,|{A99yG;1f[n%pnv$>$9++&$`isd]65Nc=)ljW');
define('AUTH_SALT',        '4E1WY|ay^?-|xdQj4&_dQ92c2ww9$/]w|::zR|8wX&6dJA?XYze7-BXdh5gc%WhV');
define('SECURE_AUTH_SALT', 'aLht]gA5?Cd@>D{+ ]T/m1|qBT+T&HslVC>pb[V-RqH-rWNg-;$XXHM2tKH-m!$8');
define('LOGGED_IN_SALT',   'iM}Q&>z=&d&c%V1LX^smwu![7:|M%3a1T=N<-Y~}`QP6{Pa+*)( l_6nctE--4@f');
define('NONCE_SALT',       'F$dR)gmCvWPp8 pE0k3D_MDv#78l]-{fBc):%.g1(#x8R*YM)@J2xY`*7f~]mmA5');


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
