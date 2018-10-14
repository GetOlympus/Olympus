<?php

namespace Olympus\Components\Error;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\JsonResponseHandler;
use Whoops\Run;
use Whoops\Util\Misc;

/**
 * Log all errors in log file
 *
 * @category   PHP
 * @package    Olympus
 * @subpackage Components\Error\ErrorDebugger
 * @author     Achraf Chouk <achrafchouk@gmail.com>
 * @license    https://github.com/GetOlympus/Olympus/blob/master/LICENSE MIT
 * @link       https://github.com/GetOlympus/Olympus
 * @since      0.0.6
 */

class ErrorDebugger
{
    /**
     * Constructor.
     *
     * @param array $configs
     *
     * @since 0.0.6
     */
    public function __construct($configs = [])
    {
        // Use Whoops vendor to display errors
        $run = new Run();

        // New Pretty handler
        $handler = new PrettyPageHandler();

        // Custom tables
        if (!empty($configs)) {
            $handler->addDataTable('Olympus configurations', $configs);
        }

        // Page title
        $handler->setPageTitle('Oops! There was a problem.');

        // Page custom CSS
        $handler->setResourcesPath(dirname(__FILE__).S.'resources'.S);
        $handler->addCustomCss('olympus.whoops.css');

        // Push all in handler
        $run->pushHandler($handler);

        // AJAX requests
        if (Misc::isAjaxRequest()) {
            $run->pushHandler(new JsonResponseHandler);
        }

        // Log in file
        if (isset($configs['log']) && true === $configs['log']) {
            // Push all in handler
            $run->pushHandler(function ($exception, $inspector, $run) {
                // Setup error level
                $error_level = 500 === ERROR_LEVEL ? Logger::CRITICAL : Logger::WARNING;

                // Setup Monolog
                $logger = new Logger('Olympus');
                $logger->pushHandler(new StreamHandler(APPPATH.'logs'.S.'errors.log', $error_level));

                // Add error to logger
                $logger->addError($exception->getMessage());
            });
        }

        // Handler registration
        $run->register();
    }

    /**
     * Display error page.
     *
     * @param string $title
     * @param string $message
     * @param string $type
     *
     * @since 0.0.6
     */
    public static function error500($title, $message, $type)
    {
        $error = '<!DOCTYPE html>';
        $error .= '<html>';
        $error .= '<head>';
        $error .= '  <title>'.$title.'</title>';
        $error .= '  <meta charset="utf-8">';
        $error .= '  <meta name="robots" content="noindex">';
        $error .= '  <meta name="generator" content="Olympus">';
        $error .= '  <style>#olympus-error{background:#fff;margin:100px auto 0;max-width:98%;width:800px}#olympus-error h1{color:#333;font:700 42px/40px sans-serif;margin:30px 0 0}#olympus-error p{color:#333;font:20px/28px Georgia,serif;margin:30px 0 0}#olympus-error code{background:rgba(117,205,69,.3);color:#333;display:inline-block;font:16px/28px monospace;padding:0 10px}#olympus-error small{color:#333;display:block;font:14px/16px Georgia,serif;margin:30px 0 0}a{color:#75cd45}a:hover{color:#5da535}</style>';
        $error .= '</head>';
        $error .= '<body>';
        $error .= '  <div id="olympus-error">';
        $error .= '    <h1>'.$title.'</h1>';
        $error .= '    <p>'.$message.'</p>';
        $error .= '    <small>'.$type.'<br/>--<br/>Please, find more details on the <a href="https://github.com/GetOlympus" target="_blank">Olympus framework</a> repository.</small>';
        $error .= '  </div>';
        $error .= '</body>';
        $error .= '</html>';

        die($error);
    }
}
