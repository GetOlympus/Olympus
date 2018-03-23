<?php

namespace Olympus\Components\Handler;

use Composer\Script\Event;

/**
 * Gets its own config via composer, inspired from Incenteev ParameterHandler script.
 *
 * @category   PHP
 * @package    Olympus
 * @subpackage Components\Handler\Configurator
 * @author     Achraf Chouk <achrafchouk@gmail.com>
 * @license    https://github.com/GetOlympus/Olympus/blob/master/LICENSE MIT
 * @link       https://github.com/GetOlympus/Olympus
 * @see        https://github.com/Incenteev/ParameterHandler
 * @since      0.0.3
 */

class Configurator
{
    /**
     * Build files on Composer install / update.
     *
     * @param  Event $event
     *
     * @since 0.0.3
     */
    public static function build(Event $event)
    {
        // Get vendor path
        $vendor = $event->getComposer()->getConfig()->get('vendor-dir');

        // Instanciate Processor
        $processor = new Processor($event->getIO());

        // Build `env.php` file
        $processor->processEnv(dirname($vendor).'/app/config/env.php');

        // Build `salt.php` file
        $processor->processSalt(dirname($vendor).'/app/config/salt.php');

        // Build `own.php` file
        $processor->processConfig(dirname($vendor).'/app/config/own.php', false);

        // Build `config.rb` file
        $processor->processConfig(dirname($vendor).'/app/deploy/config.rb');

        // Build `robots.txt` file
        $processor->processRobots(dirname($vendor).'/web/robots.txt', dirname($vendor).'/app/config/env.php');
    }
}
