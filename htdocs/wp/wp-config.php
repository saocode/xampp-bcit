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

define('DB_NAME', "wp");


/** MySQL database username */

define('DB_USER', "root");


/** MySQL database password */

define('DB_PASSWORD', "");


/** MySQL hostname */

define('DB_HOST', "localhost");


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

define('AUTH_KEY',         '{o!e3*_9g)GN,:X</i7}Qz]g?Lo|#@B%?GE)M AZnMX4/(B$(F%0ur#X/6a;G*@`');

define('SECURE_AUTH_KEY',  '9jcgEZD:]/qu163kdi_t%;QbgJsHo<Ct_R]&!espx685|J7rdMgfSq2l^[Di[~]i');

define('LOGGED_IN_KEY',    'wwU>Zn:nDm0c,,~lI(;kT$[C`7:Ok[Frc%kb:a<`[HgS|u*%<x9U*tNK![6=GS*k');

define('NONCE_KEY',        '@UNicA>8%&mn2HIK1m.4MN+%o~w#PMoKD$4`{jfpbgvr@8__Cr8dgI9|oH:mSf~d');

define('AUTH_SALT',        '+;Ha>kfJY**VT%mp`-oCY*Z_d>d1| u^C ]0TBUQs{}gi)O%ovYYM2.NINmw>)?c');

define('SECURE_AUTH_SALT', 'DRF7tm::fac1>|xpq?v`m<A,=l}:WpD.|o+{`BFd_,P<9_qF-[_38f4([kM GEY}');

define('LOGGED_IN_SALT',   'tRQ 2!iv.iBp.w14G;]kWPhf*`t]o{;#1pzD(TSTA ZzJG[W%@%{%`T9cgS)(PeF');

define('NONCE_SALT',       '>&fA8_6:N^R+(bqT4AB;Lx2<s;XqtH1T,9kgZ/9q*%hBLs~[N:Z!!rA=o~.10gp&');


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

