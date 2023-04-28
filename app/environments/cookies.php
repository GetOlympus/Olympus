<?php

/**
 * Cookies constants.
 *
 * @category PHP
 * @package  Olympus
 * @author   Achraf Chouk <achrafchouk@gmail.com>
 * @license  https://github.com/GetOlympus/Olympus/blob/master/LICENSE MIT
 * @link     https://github.com/GetOlympus/Olympus
 * @since    0.0.20
 */

$hasholympus = md5('olympus');
$hashsiteurl = md5($config['wordpress']['siteurl']);
$search = '|https?://[^/]+|i';

$opts = array_merge([
    // Default
    'cookiehash' => $hashsiteurl,
    // Auth
    'user_cookie' => $hasholympus.'_u_'.$hashsiteurl,
    'pass_cookie' => $hasholympus.'_p_'.$hashsiteurl,
    'auth_cookie' => $hasholympus.'_a_'.$hashsiteurl,
    'secure_auth_cookie'   => $hasholympus.'_s_'.$hashsiteurl,
    'logged_in_cookie'     => $hasholympus.'_l_'.$hashsiteurl,
    'recovery_mode_cookie' => $hasholympus.'_r_'.$hashsiteurl,
    // Paths
    'cookiepath'           => preg_replace($search, '', $config['wordpress']['home'].S),
    'sitecookiepath'       => preg_replace($search, '', $config['wordpress']['siteurl'].S),
    'admin_cookie_path'    => preg_replace($search, '', $config['wordpress']['siteurl'].S).WPADMINDIR,
    'plugins_cookie_path'  => preg_replace($search, '', $config['wordpress']['home'].S.STATICSDIR.S.PLUGINSDIR),
    // Domain
    'cookie_domain' => false,
    // Testing or trying...
    'test_cookie' => $hasholympus.'_is_trying',
], isset($config['options']['cookies']) ? $config['options']['cookies'] : []);

/**
 * Define constants
 */

// Default
define('COOKIEHASH', (string) $opts['cookiehash']);

// Auth
define('USER_COOKIE', (string) $opts['user_cookie']);
define('PASS_COOKIE', (string) $opts['pass_cookie']);
define('AUTH_COOKIE', (string) $opts['auth_cookie']);
define('SECURE_AUTH_COOKIE', (string) $opts['secure_auth_cookie']);
define('LOGGED_IN_COOKIE', (string) $opts['logged_in_cookie']);
define('RECOVERY_MODE_COOKIE', (string) $opts['recovery_mode_cookie']);

// Paths
define('COOKIEPATH', (string) $opts['cookiepath']);
define('SITECOOKIEPATH', (string) $opts['sitecookiepath']);
define('ADMIN_COOKIE_PATH', (string) $opts['admin_cookie_path']);
define('PLUGINS_COOKIE_PATH', (string) $opts['plugins_cookie_path']);

// Domain
define('COOKIE_DOMAIN', (bool) $opts['cookie_domain']);

// Testing or trying...
define('TEST_COOKIE', (string) $opts['test_cookie']);

// Free memory
unset($opts);
