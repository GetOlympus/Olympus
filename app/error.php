<?php

use GetOlympus\Components\Error\FileLogger;
use GetOlympus\Components\Error\ErrorDebugger;

/**
 * Catches all errors.
 *
 * @category PHP
 * @package  Olympus
 * @author   Achraf Chouk <achrafchouk@gmail.com>
 * @license  https://github.com/crewstyle/Olympus/blob/master/LICENSE MIT
 * @link     https://github.com/crewstyle/Olympus
 * @since    0.0.6
 */

function _error($title, $message, $type = 'Error 500')
{
    global $olympus_data;

    // If debug is enabled, just display error message
    if (isset($olympus_data['debug']) && true === $olympus_data['debug']) {
        ErrorDebugger::error500($title, $message, $type);
    }
}

// Check if debug is enabled or not and Push all in handler
if (isset($olympus_data['debug']) && true === $olympus_data['debug']) {
    // Use the ErrorDebugger to display errors
    // with the gorgeous Whoops vendor in
    // development environment only
    new ErrorDebugger($olympus_data);
}

// Check if logger is enabled or not and Log all in file
if (isset($olympus_data['log']) && true === $olympus_data['log']) {
    // Use the FileLogger to store errors
    // in a specific log file
    new FileLogger(APPPATH.'logs'.S.'errors.log');
}
