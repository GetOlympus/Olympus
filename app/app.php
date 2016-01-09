<?php

/**
 *
 * @package Olympus
 * @author Achraf Chouk <achrafchouk@gmail.com>
 * @since 0.0.1
 *
 */

/**
 * Include composer autoloading.
 */
require_once(APPPATH.'autoload.php');

/**
 * Load environment configuration.
 */
require_once(APPPATH.'environment.php');

/**
 * Path to WordPress.
 */
if (!defined('ABSPATH')) {
	define('ABSPATH', WEBPATH.'cms'.S);
}
