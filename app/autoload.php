<?php

/**
 * Register the composer autoloader.
 * 
 * @category PHP
 * @package  Olympus
 * @author   Achraf Chouk <achrafchouk@gmail.com>
 * @license  https://github.com/crewstyle/Olympus/blob/master/LICENSE MIT
 * @link     https://github.com/crewstyle/Olympus
 * @since    0.0.1
 */

/**
 * Register the composer autoloader.
 */
if (!file_exists($autoload = VENDORPATH.'autoload.php')) {
    die('<h1>Unable to find composer autoloader.</h1> Please use: <code>curl -s http://getcomposer.org/installer | php</code> and <code>php composer.phar install</code>');
}

$loader = include $autoload;

/**
 * Include the compiled class file.
 *
 * To dramatically increase your application's performance, you may use a
 * compiled class file which contains all of the classes commonly used
 * by a request.
 */
if (file_exists($compiled = APPPATH.'cache'.S.'compiled.php')) {
    include $compiled;
}

/**
 * Return autoload.
 */
return $loader;
