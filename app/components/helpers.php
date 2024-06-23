<?php

/**
 * All helpers functions.
 *
 * @category   PHP
 * @author     Achraf Chouk <achrafchouk@gmail.com>
 * @license    https://github.com/GetOlympus/Olympus/blob/master/LICENSE MIT
 * @link       https://github.com/GetOlympus/Olympus
 * @since      0.0.23
 */

function displayError($title, $message, $type, $code = 500)
{
    // Check ErrorDebugger `error500` function
    if (
        class_exists('\\Olympus\\Components\\Error\\ErrorDebugger') &&
        method_exists('\\Olympus\\Components\\Error\\ErrorDebugger', 'error500')
    ) {
        $ctn = \Olympus\Components\Error\ErrorDebugger::error500($title, $message, $type, 'olympus');
        die($ctn);
    }

    // Add 500 header
    header($_SERVER['SERVER_PROTOCOL'].' 500 Internal Server Error', true, $code);

    // Build inline CSS
    $css = include_once APPPATH.'components'.S.'Resources'.S.'css'.S.'style.php';

    // Build template HTML
    $ctn = include_once APPPATH.'components'.S.'Resources'.S.'tpl'.S.'html.php';

    // Display all and stop
    die($ctn);
}
