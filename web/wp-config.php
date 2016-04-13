<?php

/**
 * File used by WordPress to list all constant options.
 *
 * @category PHP
 * @package  Olympus
 * @author   Achraf Chouk <achrafchouk@gmail.com>
 * @license  https://github.com/crewstyle/Olympus/blob/master/LICENSE MIT
 * @link     https://github.com/crewstyle/Olympus
 * @since    0.0.1
 */

$path = dirname(dirname(__FILE__));

/**
 * Global constants.
 */
// Directory separator.
defined('S')           or define('S', DIRECTORY_SEPARATOR);
// Paths.
defined('APPPATH')     or define('APPPATH', $path.S.'app'.S);
defined('VENDORPATH')  or define('VENDORPATH', $path.S.'vendor'.S);
defined('WEBPATH')     or define('WEBPATH', $path.S.'web'.S);
// Contents folder
defined('STATICS_DIR') or define('STATICS_DIR', 'statics');

/**
 * Bootstrap WordPress.
 */
require_once APPPATH.'app.php';

/**
 * Sets up WordPress vars and included files.
 */
require_once ABSPATH.'wp-settings.php';
