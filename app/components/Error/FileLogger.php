<?php

namespace Olympus\Error;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Log all errors in log file
 *
 * @category   PHP
 * @package    Olympus
 * @subpackage Error\FileLogger
 * @author     Achraf Chouk <achrafchouk@gmail.com>
 * @license    https://github.com/crewstyle/Olympus/blob/master/LICENSE MIT
 * @link       https://github.com/crewstyle/Olympus
 * @since      0.0.6
 */

class FileLogger
{
    /**
     * Constructor.
     *
     * @param string $file
     *
     * @since 0.0.6
     */
    public function __construct($file)
    {
        // Setup Monolog logger
        $log = new Logger('Olympus');
        $log->pushHandler(new StreamHandler($file, Logger::DEBUG));
    }
}
