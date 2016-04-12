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
 * Path to WordPress.
 */
defined('ABSPATH') or define('ABSPATH', WEBPATH.'cms'.S);

/**
 * Include composer autoloading.
 */
$loader = include_once APPPATH.'autoload.php';

/**
 * Load environment configuration.
 */
require_once APPPATH.'environment.php';
