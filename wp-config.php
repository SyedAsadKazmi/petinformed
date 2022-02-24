<?php

//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL
define('WP_CACHE', false); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '' ); //Added by WP-Cache Manager
define('DB_NAME', 'petinformedcom');
define('DB_USER', 'petinformedcom');
define('DB_PASSWORD', 'Nm96QB82FI4t');

define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

define('AUTH_KEY',         'INAUdcRSmFSNQ9DWha7fCjOBTCcX90xG2AZd6Gfd');
define('SECURE_AUTH_KEY',  'Zubc7xOexjSwAU7lgsgs3OpL7CM95l1QYABgvKzQ');
define('LOGGED_IN_KEY',    's4rkzhlYmVHsu4eISiPCywFWjWNljaddrvRZrj3y');
define('NONCE_KEY',        'aWDCllL4YPFW3YUd1Ggc3sShSz0QBPO83qDRgdtU');
define('AUTH_SALT',        'VHVminHM2AaYp7hq5rzENnod0w1fpvXUzhisXRJX');
define('SECURE_AUTH_SALT', 'BOtcOJ6i6ZucZGuHylmvUJzOri20dwFkXjw6gkkV');
define('LOGGED_IN_SALT',   'O2Vgk8LFcfQRfMuoJiHo1GG4JgDtVyS0O7vD3E2H');
define('NONCE_SALT',       'xtOghIedbJxupF6o3xIl5USlNU6oUuhWbgfhEu3z');

$table_prefix  = 'wp_171c886108_';

define('SP_REQUEST_URL', ($_SERVER['HTTPS'] ? 'https://' : 'http://') . $_SERVER['HTTP_HOST']);

define('WP_SITEURL','https://petinformed.com');
define('WP_HOME','https://petinformed.com');

/* Change WP_MEMORY_LIMIT to increase the memory limit for public pages. */
define('WP_MEMORY_LIMIT', '256M');

/* Uncomment and change WP_MAX_MEMORY_LIMIT to increase the memory limit for admin pages. */
//define('WP_MAX_MEMORY_LIMIT', '256M');

/* That's all, stop editing! Happy blogging. */

if ( !defined('ABSPATH') )
        define('ABSPATH', dirname(__FILE__) . '/');

require_once(ABSPATH . 'wp-settings.php');
