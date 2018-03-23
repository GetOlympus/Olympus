<?php

use Olympus\Components\Error\FileLogger;
use Olympus\Components\Error\ErrorDebugger;

/**
 * Catches all errors.
 *
 * @category PHP
 * @package  Olympus
 * @author   Achraf Chouk <achrafchouk@gmail.com>
 * @license  https://github.com/GetOlympus/Olympus/blob/master/LICENSE MIT
 * @link     https://github.com/GetOlympus/Olympus
 * @since    0.0.6
 */

/**
 * Use the ErrorDebugger to display errors with the gorgeous Whoops vendor in
 * development environment only
 */
new ErrorDebugger([
    'debug' => WP_DEBUG,
]);

/**
 * Check if logger is enabled or not and Log all in file
 */
if (defined(WP_DEBUG_LOG) && true === WP_DEBUG_LOG) {
    // Use the FileLogger to store errors
    // in a specific log file
    new FileLogger(APPPATH.'logs'.S.'errors.log');
}
