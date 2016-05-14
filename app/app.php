<?php

/**
 * Autoload vendors and set all defined WordPress constants.
 *
 * @category PHP
 * @package  Olympus
 * @author   Achraf Chouk <achrafchouk@gmail.com>
 * @license  https://github.com/crewstyle/Olympus/blob/master/LICENSE MIT
 * @link     https://github.com/crewstyle/Olympus
 * @since    0.0.1
 */

/**
 * Olympus configs.
 */
$olympus_data = [
    'debug' => true,
    'log' => true,
];

/**
 * Path to WordPress.
 */
defined('ABSPATH') or define('ABSPATH', WEBPATH.'cms'.S);

/**
 * Include composer autoloading.
 */
$loader = include_once APPPATH.'autoload.php';

/**
 * Load error catcher.
 */
require_once APPPATH.'error.php';

/**
 * Load environment configuration.
 */
require_once APPPATH.'environment.php';

/**
 * Update olympus globals.
 */
$olympus_data['debug'] = WP_DEBUG;
$olympus_data['log'] = WP_DEBUG_LOG;
