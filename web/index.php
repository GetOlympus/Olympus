<?php

/**
 * Bootstrap all WordPress context.
 *
 * @category PHP
 * @package  Olympus
 * @author   Achraf Chouk <achrafchouk@gmail.com>
 * @license  https://github.com/crewstyle/Olympus/blob/master/LICENSE MIT
 * @link     https://github.com/crewstyle/Olympus
 * @since    0.0.1
 */

$s = DIRECTORY_SEPARATOR;

/**
 * Loads the WordPress theme and output it.
 */
define('WP_USE_THEMES', true);

/**
 * Loads the WordPress Environment and Template.
 */
require(dirname(__FILE__).$s.'cms'.$s.'wp-blog-header.php');
