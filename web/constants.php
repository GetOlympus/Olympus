<?php

/**
 * Define all usefull constants.
 *
 * @category PHP
 * @package  Olympus
 * @author   Achraf Chouk <achrafchouk@gmail.com>
 * @license  https://github.com/GetOlympus/Olympus/blob/master/LICENSE MIT
 * @link     https://github.com/GetOlympus/Olympus
 * @since    0.0.20
 */

$path = dirname(dirname(__FILE__));

/**
 * Global constants.
 */

// Directory separator.
defined('S')             or define('S', DIRECTORY_SEPARATOR);
// Paths.
defined('APPPATH')       or define('APPPATH', $path.S.'app'.S);
defined('CACHEPATH')     or define('CACHEPATH', APPPATH.'cache'.S);
defined('VENDORPATH')    or define('VENDORPATH', $path.S.'vendor'.S);
defined('WEBPATH')       or define('WEBPATH', $path.S.'web'.S);
// Web contents paths.
defined('DISTPATH')      or define('DISTPATH', WEBPATH.'resources'.S.'dist'.S);

/**
 * Folder names constants.
 */

defined('WORDPRESS_DIR') or define('WORDPRESS_DIR', 'cms');
defined('STATICS_DIR')   or define('STATICS_DIR', 'statics');
