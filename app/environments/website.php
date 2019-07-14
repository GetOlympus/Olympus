<?php

/**
 * Website constants.
 *
 * @category PHP
 * @package  Olympus
 * @author   Achraf Chouk <achrafchouk@gmail.com>
 * @license  https://github.com/GetOlympus/Olympus/blob/master/LICENSE MIT
 * @link     https://github.com/GetOlympus/Olympus
 * @since    0.0.20
 */

// Set homeurl & siteurl vars
$config['wordpress']['home']    = rtrim($config['wordpress']['home'], S);
$config['wordpress']['siteurl'] = rtrim($config['wordpress']['home'].S.WORDPRESSDIR, S);

// Define options
$opts = array_merge([
    // Global
    'wp_content_dir'  => WEBPATH.STATICSDIR,
    'wp_content_url'  => $config['wordpress']['home'].S.STATICSDIR,
    // Mu plugins
    'wpmu_plugin_dir' => WEBPATH.STATICSDIR.S.MUPLUGINSDIR,
    'wpmu_plugin_url' => $config['wordpress']['home'].S.STATICSDIR.S.MUPLUGINSDIR,
    // Plugins
    'wp_plugin_dir'   => WEBPATH.STATICSDIR.S.PLUGINSDIR,
    'wp_plugin_url'   => $config['wordpress']['home'].S.STATICSDIR.S.PLUGINSDIR,
    // Themes - Define 2 new constants to prevent themes folder path and name
    'wp_theme_dir'    => WEBPATH.STATICSDIR.S.THEMESDIR,
    'wp_theme_url'    => $config['wordpress']['home'].S.STATICSDIR.S.THEMESDIR,
], isset($config['options']['website']) ? $config['options']['website'] : []);

/**
 * Define constants
 */

// Define home as domain.tld and siteurl as domain.tld/cms_or_whatever_you_want
define('WP_HOME', $config['wordpress']['home']);
define('WP_SITEURL', $config['wordpress']['siteurl']);

// Fix unknown bug from WP where SERVER_NAME and HTTP_HOST can be empty
if (empty($_SERVER['SERVER_NAME']) || empty($_SERVER['HTTP_HOST'])) {
    $hostname = parse_url(WP_HOME, PHP_URL_HOST);

    // Set $_SERVER vars
    $_SERVER['SERVER_NAME'] = empty($_SERVER['SERVER_NAME']) ? (string) $hostname : $_SERVER['SERVER_NAME'];
    $_SERVER['HTTP_HOST']   = empty($_SERVER['HTTP_HOST']) ? (string) $hostname : $_SERVER['HTTP_HOST'];

    // Free memory
    unset($hostname);
}

// If Secure protocol is defined, in a several servers environment with a loadbalancer,
// the $_SERVER array is not properly defined. So we have to explicitly define HTTPS to 'on'
// to make WordPress works within it.
if (true === (bool) $config['https'] && 'https' === parse_url($config['wordpress']['siteurl'], PHP_URL_SCHEME)) {
    $_SERVER['HTTPS'] = 'on';
    define('FORCE_SSL_ADMIN', true);
}

// Contents
define('WP_CONTENT_DIR', (string) $opts['wp_content_dir']);
define('WP_CONTENT_URL', (string) $opts['wp_content_url']);

// Mu plugins
define('WPMU_PLUGIN_DIR', (string) $opts['wpmu_plugin_dir']);
define('WPMU_PLUGIN_URL', (string) $opts['wpmu_plugin_url']);

// Plugins
define('WP_PLUGIN_DIR', (string) $opts['wp_plugin_dir']);
define('WP_PLUGIN_URL', (string) $opts['wp_plugin_url']);

// Themes - Define 2 new constants to prevent themes folder path and name
define('WP_THEME_DIR', (string) $opts['wp_theme_dir']);
define('WP_THEME_URL', (string) $opts['wp_theme_url']);

// Free memory
unset($opts);
