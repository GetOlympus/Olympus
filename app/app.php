<?php

/**
 * Autoload vendors and set all defined WordPress constants.
 *
 * @category PHP
 * @package  Olympus
 * @author   Achraf Chouk <achrafchouk@gmail.com>
 * @license  https://github.com/GetOlympus/Olympus/blob/master/LICENSE MIT
 * @link     https://github.com/GetOlympus/Olympus
 * @since    0.0.1
 */

/**
 * Include composer autoloading.
 */
$loader = include_once APPPATH.'autoload.php'; //NOSONAR

/**
 * Load environment configuration.
 */
require_once APPPATH.'environment.php'; //NOSONAR

/**
 * Load error catcher.
 */
require_once APPPATH.'error.php';
