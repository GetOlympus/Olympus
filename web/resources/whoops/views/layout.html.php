<?php

/**
 * Layout template file for Whoops's pretty error output.
 *
 * @category PHP
 * @package  Olympus
 * @author   Achraf Chouk <achrafchouk@gmail.com>
 * @license  https://github.com/GetOlympus/Olympus/blob/master/LICENSE MIT
 * @link     https://github.com/GetOlympus/Olympus
 * @since    0.0.1
 */

// Check debugger
$olp_debug = isset($tables['debug']) ? $tables['debug'] : false;
$olp_layout = $olp_debug ? 'on' : 'off';

// Call template
include 'debug-'.$olp_layout.'.html.php';
