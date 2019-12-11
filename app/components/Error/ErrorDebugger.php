<?php

namespace Olympus\Components\Error;

use Monolog\Logger;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\RotatingFileHandler;
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
        // Vars
        $log = Logger::getLevelName($configs['level']);


        // Use Whoops vendor to display errors
        $run = new Run;


        // AJAX requests
        if (Misc::isAjaxRequest()) {
            $run->pushHandler(new JsonResponseHandler);
        }


        // New Pretty handler
        $handler = new PrettyPageHandler;

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


        // Setup Monolog
        $logger = new Logger('Olympus');
        $logger->pushHandler(new RotatingFileHandler(ERRORPATH, 0, $log));
        $logger->pushHandler(new StreamHandler(ERRORPATH, $log));
        $logger->pushHandler(new FirePHPHandler);

        // Push all in a handler to log in file
        $run->pushHandler(function ($exception, $inspector, $run) use ($logger) {
            // Add error to logger
            $logger->error($exception->getMessage(), [
                'file'  => $exception->getFile(),
                'line'  => $exception->getLine(),
                'code'  => $exception->getCode(),
                'error' => $exception->getTrace()
            ]);
        });


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
        $error = '<!DOCTYPE html>'."\n";
        $error .= '<html>'."\n";
        $error .= '<head>'."\n";
        $error .= '  <title>'.$title.'</title>'."\n";
        $error .= '  <meta charset="utf-8">'."\n";
        $error .= '  <meta name="robots" content="noindex">'."\n";
        $error .= '  <meta name="generator" content="Olympus">'."\n";
        $error .= '  <style>#olympus-error{background:#fff;margin:100px auto 0;max-width:98%;width:800px}';
        $error .= '#olympus-error h1{color:#333;font:700 42px/40px sans-serif;margin:30px 0 0}';
        $error .= '#olympus-error p{color:#333;font:20px/28px Georgia,serif;margin:30px 0 0}';
        $error .= '#olympus-error code{background:rgba(117,205,69,.3);color:#333;display:inline-block;';
        $error .= 'font:16px/28px monospace;padding:0 10px}#olympus-error small{color:#333;display:block;';
        $error .= 'font:14px/16px Georgia,serif;margin:30px 0 0}a{color:#75cd45}a:hover{color:#5da535}</style>'."\n";
        $error .= '</head>'."\n";
        $error .= '<body>'."\n";
        $error .= '  <div id="olympus-error">'."\n";
        $error .= '    <h1>'.$title.'</h1>'."\n";
        $error .= '    <p>'.$message.'</p>'."\n";
        $error .= '    <small>'.$type.'<br/>--<br/>Please, find more details on the';
        $error .= ' <a href="https://github.com/GetOlympus" target="_blank">Olympus framework</a>';
        $error .= ' repository.</small>'."\n";
        $error .= '  </div>'."\n";
        $error .= '</body>'."\n";
        $error .= '</html>';

        die($error);
    }
}
