<?php

/**
 *
 * @package Olympus
 * @author Achraf Chouk <achrafchouk@gmail.com>
 * @since 0.0.1
 *
 */

/**
 * Load environment files.
 */
$loader = new mKomorowski\Config\Loader(APPPATH.'config'.S.'env'.S);

// Return array of environment data
if (!file_exists($env = APPPATH.'config'.S.'env.php')) {
    die('
        <h1>Unable to load environment data.</h1>
        Please define your environments properly in <code>'.$env.'</code> file.
    ');
}

// Load all environments
$getenvs = require_once($env);
$environments = new mKomorowski\Config\Environments($getenvs);

// Retrieve all configs
$config = new mKomorowski\Config\Config($loader, $environments, 'dev');

/**
 * Define environment constants.
 */
// Database
define('DB_HOST',           $config->has('database.host') ? $config->get('database.host') : '127.0.0.1');
define('DB_NAME',           $config->has('database.name') ? $config->get('database.name') : 'wordpress');
define('DB_USER',           $config->has('database.user') ? $config->get('database.user') : 'root');
define('DB_PASSWORD',       $config->has('database.password') ? $config->get('database.password') : 'password');

// WordPress URLs
$home = $config->has('wordpress.home') ? $config->get('wordpress.home') : 'http://localhost';
$siteurl = $config->has('wordpress.siteurl') ? $config->get('wordpress.siteurl') : 'http://localhost/cms';

// CHeck home and siteurl
if ($home === $siteurl) {
    die('
        <h1>Your home and site url values cannot be identical.</h1>
        Please define your environments properly.
    ');
}

define('WP_HOME',           $home);
define('WP_SITEURL',        $siteurl);

// Debug
if (!$config->has('debug') || false === $config->get('debug')) {
    // Development
    define('SAVEQUERIES',       false);
    define('SCRIPT_DEBUG',      false);
    define('WP_DEBUG_DISPLAY',  false);
    define('WP_DEBUG_LOG',      false);
    define('WP_DEBUG',          false);
}
else {
    // Development
    define('SAVEQUERIES',       $config->has('debug.savequeries') ? $config->get('debug.savequeries') : false);
    define('SCRIPT_DEBUG',      $config->has('debug.script_debug') ? $config->get('debug.script_debug') : false);
    define('WP_DEBUG_DISPLAY',  $config->has('debug.wp_debug_display') ? $config->get('debug.wp_debug_display') : false);
    define('WP_DEBUG_LOG',      $config->has('debug.wp_debug_log') ? $config->get('debug.wp_debug_log') : false);
    define('WP_DEBUG',          $config->has('debug.wp_debug') ? $config->get('debug.wp_debug') : false);
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

require_once($common);
