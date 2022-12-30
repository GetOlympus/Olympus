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

/**
 * Loads the WordPress theme and output it.
 */
define('WP_USE_THEMES', true);

/**
 * Global constants.
 */
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'constants.php';

/**
 * Loads the WordPress Environment and Template.
 */
if (!file_exists($wpblogheader = WEBPATH.WORDPRESSDIR.S.'wp-blog-header.php')) {
    // Require error class file.
    require_once APPPATH.'components'.S.'Error'.S.'ErrorDebugger.php';

    $ctn = 'The default WordPress CMS folder seems empty and does not contain the required files.';
    $ctn .= ' Please, run <code>php composer.phar install</code> command line from';
    $ctn .= ' your project folder and refresh this page.';

    // Use ErrorDebugger class to display error.
    Olympus\Components\Error\ErrorDebugger::error500('WordPress is not installed.', $ctn, 'File not found');
}

require_once $wpblogheader;
