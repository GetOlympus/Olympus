<?php

/**
 * Bootstrap all WordPress context.
 *
 * @category PHP
 * @package  Olympus
 * @author   Achraf Chouk <achrafchouk@gmail.com>
 * @license  https://github.com/GetOlympus/Olympus/blob/master/LICENSE MIT
 * @link     https://github.com/GetOlympus/Olympus
 * @since    0.0.1
 */

$s = DIRECTORY_SEPARATOR;
$d = dirname(__FILE__);

/**
 * Loads the WordPress theme and output it.
 */
define('WP_USE_THEMES', true);

/**
 * Loads the WordPress Environment and Template.
 */
if (!file_exists($wpblogheader = $d.$s.'cms'.$s.'wp-blog-header.php')) {
    // Require error class file.
    require_once dirname($d).$s.'app'.$s.'components'.$s.'Error'.$s.'ErrorDebugger.php';

    // Use ErrorDebugger class to display error.
    Olympus\Components\Error\ErrorDebugger::error500('WordPress is not installed.', 'The default WordPress CMS folder seems empty and does not contain the required files. Please, run <code>php composer.phar install</code> command lines from your project folder and refresh this page.', 'File not found');
}

require $wpblogheader;
