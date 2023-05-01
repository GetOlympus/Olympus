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
    if (class_exists('\\Olympus\\Components\\Error\\ErrorDebugger')) {
        $ctn = \Olympus\Components\Error\ErrorDebugger::error500($title, $message, $type);
        die($ctn);
    }

    // Add 500 header
    header($_SERVER['SERVER_PROTOCOL'].' 500 Internal Server Error', true, $code);

    /**
     * Template copied directly from the Hades-Error-Handler bundle
     * @see https://github.com/GetOlympus/Hades-Error-Handler/tree/master/src/Hades/Resources/views
     */
    // CSS vars definition
    $css  = ':root{--color-main:31,107,255;--color-hover:191,38,255;--color-hover-28:152,55,255;';
    $css .= '--color-hover-38:131,64,255;--color-hover-61:91,81,255;--color-hover-71:71,90,255}';

    // CSS definition
    $css .= '#olympus-error{background:#fff;margin:100px auto 0;max-width:98%;width:800px}';
    $css .= '#olympus-error h1{color:#333;font:700 42px/40px sans-serif;margin:30px 0 0}';
    $css .= '#olympus-error p{color:#333;font:20px/28px Georgia,serif;margin:30px 0 0}';
    $css .= '#olympus-error code{display:inline-block;font:16px/28px monospace;padding:0 10px}';
    $css .= '#olympus-error code{background:rgba(var(--color-main),.3);background:-webkit-linear-gradient(';
    $css .= 'to right,rgba(var(--color-hover),.3) 0,rgba(var(--color-hover-28),.3) 28%,';
    $css .= 'rgba(var(--color-hover-38),.3) 38%,rgba(var(--color-hover-61),.3) 61%,rgba(var(--color-hover-71),.3) 71%,';
    $css .= 'rgba(var(--color-main),.3) 100%);background:linear-gradient(to right,rgba(var(--color-hover),.3) 0,';
    $css .= 'rgba(var(--color-hover-28),.3) 28%,rgba(var(--color-hover-38),.3) 38%,rgba(var(--color-hover-61),.3) 61%,';
    $css .= 'rgba(var(--color-hover-71),.3) 71%,rgba(var(--color-main),.3) 100%)}';
    $css .= '#olympus-error small{color:#333;display:block;font:14px/16px Georgia,serif;margin:30px 0 0}';
    $css .= 'a{color:rgb(var(--color-main))}a:hover{color:rgb(var(--color-hover))}';

    // Add contents
    $ctn  = '<!DOCTYPE html>';
    $ctn .= '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-EN" lang="en-EN">';
    $ctn .= '<head>';
    $ctn .= '<title>'.$title.'</title>';
    $ctn .= '<meta charset="utf-8"/><meta name="robots" content="noindex"/><meta name="generator" content="Olympus"/>';
    $ctn .= '<style>'.$css.'</style>';
    $ctn .= '</head>';
    $ctn .= '<body>';
    $ctn .= '<div id="olympus-error">';
    $ctn .= '<h1>'.$title.'</h1><p>'.$message.'</p><small>'.$type.'<br/>--<br/>Please, find more details on the ';
    $ctn .= '<a href="https://github.com/GetOlympus" target="_blank">Olympus framework</a> repository.</small>';
    $ctn .= '</div>';
    $ctn .= '</body>';
    $ctn .= '</html>';

    // Display all and stop
    die($ctn);
}
