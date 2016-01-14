<?php

/**
 *
 * @package Olympus
 * @author Achraf Chouk <achrafchouk@gmail.com>
 * @since 0.0.1
 *
 */

/**
 * Path to WordPress.
 */
if (!defined('ABSPATH')) {
    define('ABSPATH', WEBPATH.'cms'.S);
}

/**
 * Include composer autoloading.
 */
$loader = require_once APPPATH.'autoload.php';

/**
 * Load environment configuration.
 */
require_once APPPATH.'environment.php';
