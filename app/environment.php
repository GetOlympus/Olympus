<?php

/**
 *
 * @package Olympus
 * @author Achraf Chouk <achrafchouk@gmail.com>
 * @since 0.0.2
 *
 */

// Return array of environment data
if (!file_exists($env = APPPATH.'config'.S.'env.php')) {
    die('
        <h1>Unable to load environment data.</h1>
        Please define your environments properly in <code>'.$env.'</code> file.
    ');
}

// Load all environments
$environments = require_once $env;

// Retrieve all configs and merge them with defaults
$config = array_merge([
    'database' => [
        'host' => '127.0.0.1',
        'name' => 'wordpress',
        'user' => 'root',
        'pass' => 'password',
    ],
    'wordpress' => [
        'home' => 'http://www.domain.tld',
        'siteurl' => 'http://www.domain.tld/cms',
    ],
    'https' => false,
    'debug' => false,
], $environments);

/**
 * Define environment constants.
 */
// Database
define('DB_HOST',           $config['database']['host'];
define('DB_NAME',           $config['database']['name'];
define('DB_USER',           $config['database']['user'];
define('DB_PASSWORD',       $config['database']['pass'];

// WordPress URLs
$home = $config['wordpress']['home'];
$siteurl = $config['wordpress']['siteurl'];

// CHeck home and siteurl
if ($home === $siteurl) {
    die('
        <h1>For your security, your home and site url values cannot be identical.</h1>
        Please define your environments properly.
    ');
}

define('WP_HOME',           $home);
define('WP_SITEURL',        $siteurl);

// Debug
if (false === $config->get('debug')) {
    // Development
    define('SAVEQUERIES',       false);
    define('SCRIPT_DEBUG',      false);
    define('WP_DEBUG_DISPLAY',  false);
    define('WP_DEBUG_LOG',      false);
    define('WP_DEBUG',          false);
}
else {
    // Development
    define('SAVEQUERIES',       isset($config['debug']['savequeries']) ? $config['debug']['savequeries'] : false);
    define('SCRIPT_DEBUG',      isset($config['debug']['script_debug']) ? $config['debug']['script_debug'] : false);
    define('WP_DEBUG_DISPLAY',  isset($config['debug']['wp_debug_display']) ? $config['debug']['wp_debug_display'] : false);
    define('WP_DEBUG_LOG',      isset($config['debug']['wp_debug_log']) ? $config['debug']['wp_debug_log'] : false);
    define('WP_DEBUG',          isset($config['debug']['wp_debug']) ? $config['debug']['wp_debug'] : false);
}

/**
 * Content directory.
 */
define('CONTENT_DIR',       STATICS_DIR);
define('WP_CONTENT_DIR',    WEBPATH.CONTENT_DIR);
define('WP_CONTENT_URL',    WP_HOME.S.CONTENT_DIR);

/**
 * Define common constants.
 */
if (!file_exists($common = APPPATH.'config'.S.'common.php')) {
    die('
        <h1>Unable to load common constants.</h1>
        Please define your constants properly in <code>'.$common.'</code> file.
    ');
}

require_once $common;
