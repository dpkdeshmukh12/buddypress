<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'buddypress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         ':Z|_,h8s$-H*&Fw[lxATDZ9Zz`UWovLKXSAR{|q!{n$!Ao7g%5tgm:H:M/UY+mu(');
define('SECURE_AUTH_KEY',  '{P5<yp((7}y.,1|M{H=pcOrOT=VRp%Za_hM#G+X3,M+PUAp;-JP$YfSXzJoP3!kJ');
define('LOGGED_IN_KEY',    'T7Zu(NNwphF8-E|mLadsS%cT/6-_/]>V2-S0)j-W4$!-pf0OS8j}8T|W]&cX ]pQ');
define('NONCE_KEY',        '1AC)#(^+-:F8NLZ@|ONbAp2i~6!}56c_m9=q]>Yqh~O:cYVi/hI0&*hIO6CSCU D');
define('AUTH_SALT',        'Y+%CEKTmSAus@Xu)]r-<If,-8LxdPw7KV}0mPh5z^@I?s:8TC]XuD,PRip}/%2(2');
define('SECURE_AUTH_SALT', '|]|UtqHU%962W;t2EJ+-7MoED~:l|,HSWG^9-Hpmxjb[2A_.eesBQ~0^wG~sV1>`');
define('LOGGED_IN_SALT',   'iD=F_sL+^DIPS5T#QS*PeKX9 87,F+#E8<?[+/qS6~MV!Q+nKup!(5[^?h@fj&4[');
define('NONCE_SALT',       'E0? X-p:QEX)W:W&A2xWR>W]0pj,0W!1y9}A<vqyK[$0XvOAfD)W%+Ac%o7dURwc');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
