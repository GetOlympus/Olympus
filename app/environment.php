<?php

/**
 * Autoload vendors and set all defined WordPress constants.
 *
 * @category PHP
 * @package  Olympus
 * @author   Achraf Chouk <achrafchouk@gmail.com>
 * @license  https://github.com/crewstyle/Olympus/blob/master/LICENSE MIT
 * @link     https://github.com/crewstyle/Olympus
 * @since    0.0.2
 */

// Return array of environment data
if (!file_exists($env = APPPATH.'config'.S.'env.php')) {
    _error('Unable to load your environment data.', 'Please define your environments properly in <code>'.$env.'</code> file.', 'File not found');
}

// Load all environments
$environments = include_once $env;
$defaults = include_once APPPATH.'config'.S.'env.php.dist';

// Retrieve all configs and merge them with defaults
$config = array_merge($defaults, $environments);

/**
 * WordPress Database Table prefix.
 */
$table_prefix = $config['database']['prefix'];

/**
 * Define environment constants.
 */
// Database
define('DB_HOST', $config['database']['host']);
define('DB_NAME', $config['database']['name']);
define('DB_USER', $config['database']['user']);
define('DB_PASSWORD', $config['database']['pass']);
define('DB_CHARSET', $config['database']['charset']);
define('DB_COLLATE', $config['database']['collate']);

// CHeck home and siteurl
if ($config['wordpress']['home'] === $config['wordpress']['siteurl']) {
    _error('Security issue!', '<strong>For your own security, your <code>home</code> and <code>siteurl</code> values cannot be identical.</strong> Please define your environments properly.', 'Security');
}

// Define home as domain.tld and siteurl as domain.tld/cms_or_whatever_you_want
define('WP_HOME', $config['wordpress']['home']);
define('WP_SITEURL', $config['wordpress']['siteurl']);

// Fix revisions up to 10 - 0 to disable revisions, remove the line to make it infinite
if (-1 < $config['wordpress']['revisions']) {
    define('WP_POST_REVISIONS', $config['wordpress']['revisions']);
}

// Automatic updater
define('AUTOMATIC_UPDATER_DISABLED', !$config['wordpress']['updater']);

// If Secure protocol is defined, in a several servers environment with a loadbalancer,
// the $_SERVER array is not properly defined. So we have to explicitly define HTTPS to 'on'
// to make WordPress works within it.
if (true === $config['https']) {
    $_SERVER['HTTPS'] = 'on';
    define('FORCE_SSL_ADMIN', true);
}

// We recommand that you DO NOT use the default WordPress cron which is made to work
// for those who do not have an ssh access to their server.
if (false === $config['cron']) {
    define('ALTERNATE_WP_CRON', false);
    define('DISABLE_WP_CRON', true);
}

// Security:
// Disable file editor in the "Theme editor"
if (false === $config['file_edit']) {
    define('DISALLOW_FILE_EDIT', true);
}

// Cache
define('WP_CACHE', $config['cache']);

// Debug
if (!is_array($config['debug']) && false === $config['debug']) {
    // Production environment
    define('SAVEQUERIES', false);
    define('SCRIPT_DEBUG', false);
    define('WP_DEBUG_DISPLAY', false);
    define('WP_DEBUG_LOG', false);
    define('WP_DEBUG', false);
} else {
    // Development environment
    define('SAVEQUERIES', isset($config['debug']['savequeries']) ? $config['debug']['savequeries'] : true);
    define('SCRIPT_DEBUG', isset($config['debug']['script_debug']) ? $config['debug']['script_debug'] : true);
    define('WP_DEBUG_DISPLAY', isset($config['debug']['wp_debug_display']) ? $config['debug']['wp_debug_display'] : true);
    define('WP_DEBUG_LOG', isset($config['debug']['wp_debug_log']) ? $config['debug']['wp_debug_log'] : true);
    define('WP_DEBUG', isset($config['debug']['wp_debug']) ? $config['debug']['wp_debug'] : true);
}

/**
 * Content directory
 */
define('CONTENT_DIR', STATICS_DIR);
define('WP_CONTENT_DIR', WEBPATH.CONTENT_DIR);
define('WP_CONTENT_URL', WP_HOME.S.CONTENT_DIR);
define('WPMU_PLUGIN_DIR', WEBPATH.CONTENT_DIR.S.'mu-plugins');

/**
 * Define salt constants.
 */
if (!file_exists($salt = APPPATH.'config'.S.'salt.php')) {
    _error('Unable to load your salt constants.', 'Please define your constants properly in <code>'.$salt.'</code> file.', 'File not found');
}

require_once $salt;
