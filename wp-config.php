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
define( 'DB_NAME', 'plugin' );

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
define( 'AUTH_KEY',         '8`!u<zv5$M`b1Np2xs=X}*0SyrQFz#b0[-eQZcu&~G[1qSn;jrl0*}37rdTx/af5' );
define( 'SECURE_AUTH_KEY',  '+Jojs%[Nar~W/dz-wZ8JBV V^AgX`%UoqFA{R+yo-&RO&M{O#MBQl5SWy~Kl3e4U' );
define( 'LOGGED_IN_KEY',    '$uW<AP@#tVu}=[%(NynG.:;hx+l}XDt|wO*H`|33E;r(eZD4.otGE<V<N>t_g9PD' );
define( 'NONCE_KEY',        '+q6l6ZxNJzkK0tQUh.6]QzG#r>Q_HY7:AeNNe>CKB$fx<yw@h4~8We@Y(&bB/T?/' );
define( 'AUTH_SALT',        '?Fyug+TrC+H_|&34T2!kw({S*F^va5,?OB4YjTeKy{X<)wtm5o <N,a<0SC)c&FW' );
define( 'SECURE_AUTH_SALT', 'p&a:=Tg-^;X.a2dp!ibMs$W<WhUV87!jbp*/wL#@aWWMnB1aU/({p+#KpXClolHB' );
define( 'LOGGED_IN_SALT',   '>{di|[vpEKGg VrG[whe5twN}rca!(NLjCVW#:^|1*l$0rgsgZO{r4|LD<NgEOHW' );
define( 'NONCE_SALT',       '0G@Ca%/Z|mzePnc9%JPc;gQ+%A$JhWkuaim}^.Ir9^i8*SpJHtTxD`m>Us31K~4n' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'pl_';

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
