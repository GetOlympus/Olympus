<?php

/**
 * Multisite constants.
 *
 * @category PHP
 * @package  Olympus
 * @author   Achraf Chouk <achrafchouk@gmail.com>
 * @license  https://github.com/GetOlympus/Olympus/blob/master/LICENSE MIT
 * @link     https://github.com/GetOlympus/Olympus
 * @since    0.0.20
 */

$opts = array_merge([
    'subdomain_install'    => (bool) $config['multisite'],
    'domain_current_site'  => preg_replace('|https?://[^/]+|i', '', $config['wordpress']['home']),
    'path_current_site'    => S.WORDPRESSDIR.S,
    'site_id_current_site' => 1,
    'blog_id_current_site' => 1,
], isset($config['options']['multisite']) ? $config['options']['multisite'] : []);

/**
 * Define constants
 */

// Multisite configuration
if (true === (bool) $config['multisite']) {
    define('WP_ALLOW_MULTISITE', true);

    // Network setup
    define('MULTISITE', true);
    define('SUBDOMAIN_INSTALL', (bool) $opts['subdomain_install']);
    define('DOMAIN_CURRENT_SITE', (string) $opts['domain_current_site']);
    define('PATH_CURRENT_SITE', (string) $opts['path_current_site']);
    define('SITE_ID_CURRENT_SITE', (int) $opts['site_id_current_site']);
    define('BLOG_ID_CURRENT_SITE', (int) $opts['blog_id_current_site']);
}

// Free memory
unset($opts);
