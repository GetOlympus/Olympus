<?php

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
    'log'   => WP_DEBUG_LOG,
]);
