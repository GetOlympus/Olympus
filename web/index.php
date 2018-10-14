<?php

/**
 * Bootstrap all WordPress contexts.
 *
 * @category PHP
 * @package  Olympus
 * @author   Achraf Chouk <achrafchouk@gmail.com>
 * @license  https://github.com/GetOlympus/Olympus/blob/master/LICENSE MIT
 * @link     https://github.com/GetOlympus/Olympus
 * @since    0.0.1
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
// Folders names.
defined('WORDPRESS_DIR') or define('WORDPRESS_DIR', 'cms');
defined('STATICS_DIR')   or define('STATICS_DIR', 'statics');

/**
 * WordPress constants.
 */

// Loads the WordPress theme and output it.
define('WP_USE_THEMES', true);

/**
 * Loads the WordPress Environment and Template.
 */
if (!file_exists($wpblogheader = WEBPATH.WORDPRESS_DIR.S.'wp-blog-header.php')) {
    // Require error class file.
    require_once APPPATH.'components'.S.'Error'.S.'ErrorDebugger.php';

    // Use ErrorDebugger class to display error.
    Olympus\Components\Error\ErrorDebugger::error500('WordPress is not installed.', 'The default WordPress CMS folder seems empty and does not contain the required files. Please, run <code>php composer.phar install</code> command line from your project folder and refresh this page.', 'File not found');
}

require $wpblogheader;
