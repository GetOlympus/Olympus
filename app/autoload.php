<?php

/**
 *
 * @package Olympus
 * @author Achraf Chouk <achrafchouk@gmail.com>
 * @since 0.0.1
 *
 */

/**
 * Register rhe composer autoloader.
 */
if (!file_exists($autoload = VENDORPATH.'autoload.php')) {
    die('
        <h1>Unable to find composer autoloader.</h1>
        Please use: <code>curl -s http://getcomposer.org/installer | php</code> and <code>php composer.phar install</code>
    ');
}

require $autoload;

/**
 * Include the compiled class file.
 *
 * To dramatically increase your application's performance, you may use a
 * compiled class file which contains all of the classes commonly used
 * by a request. The Artisan "optimize" is used to create this file.
 */
if (file_exists($compiled = APPPATH.'cache'.S.'compiled.php')) {
    require $compiled;
}
