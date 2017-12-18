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
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/home1/marksme3/public_html/wp-content/plugins/wp-super-cache/' );
define('DB_NAME', 'marksme3_ss_dbname1ff');

/** MySQL database username */
define('DB_USER', 'marksme3_ss_d1ff');

/** MySQL database password */
define('DB_PASSWORD', 'hljs0tMEBstK');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY', 'T<_ovBnWRuoRJqXI!vhcc!KoE=Wxo%fHISA?]UbPieJLo}{)f|szJ&t_ES>y%em<!=+HGCQea(>IJ;TUyBX[@wyaCZ!gUuIbAEFf>BiI|/SPv+@{WWM+FEHc!IQK|D+?');
define('SECURE_AUTH_KEY', 'Ton&oJQJpQHT&Qx&_w(!UV&dYO[)Xl&(cJVNvDJPOBAjE<Ajvy;>;v+nJFdAfr=b_)n!*wgBo}gdZZ+{OgU&_[qOlE*^R_A<>QXC&D>TrZfGBaQ|B=SvRqSobCXUyKyx');
define('LOGGED_IN_KEY', '_@(>jQlMAN(A?_[wCetbJzW&v!vKyQem@!x/p%|-(VMd]jM>xFlfoe@OAKFn}Cd^Xc@$i<iuhI|SFE}(QFhO&n]^aicb(!@Z-*CAmkcEzN?YCgNqDt>CupoPhN!P$(Uu');
define('NONCE_KEY', 'oIu>[xO+|X{RPvG%&JRo$ktksyAs%qLdTuQy]AeNf%]-sf{c]BWGtYjUUQg_Dm(Kqtt<&/Gcw+=k>?+G(>S;|lV(OBfvI$HXejupEY_XjBN$eXtZgQK^r%bTahp_S}/p');
define('AUTH_SALT', '{ExXdBKMtp*sP_N^n=}ILEYJB&{w&[hb;}>$ROz$MlS/vP-gsnZ_[AMrqSyiUb@Zm;b;za/g{=PClQ&suoxs&AS-ES[qtSh?Jgm)q(HD*s![MoZIJU{(sulmZ+d&%E=s');
define('SECURE_AUTH_SALT', 'UR+m*&C=qoVX[!{[sD-[=$)F!(N!cwec!OjA+@EJt&$_U(y/$jQdnZKTfA;NVhi@fvyQoB%&}>(ewtP;S^*QZc&J=+rvrUU;j=(JZ+M/Cm+FY|^Zd_x]jb+xNJzrO?/J');
define('LOGGED_IN_SALT', '*wx>/UoKoEWQIDS[NONTxZ;?%bs!+wW{p!ut@Z$R-m={@WFGc]AioAsDHL?]E;jlGZS%!de?Y?F)E)B}s)zi/%=!R%>bteN{i/!mzdEY%FjWdb[*JF]iyFj;Gp|Ru)c}');
define('NONCE_SALT', 'g_ce^f>wb&AKUEP[IQ_x=+Jq*bFKG$^gvZXo*;(;{o!PNsAyR?V%HS>(-Hj]$DrUIrq%SR]vXDsCZeQswKjvg;J^MzD|V}x{/wvx>hWWSoAlvZsyDZHUruFj=q&-wm[+');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_nnju_';

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
