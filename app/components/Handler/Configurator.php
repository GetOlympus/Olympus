<?php

namespace Olympus\Handler;

use Composer\Script\Event;

/**
 * Gets its own config via composer, inspired from Incenteev ParameterHandler script.
 * 
 * @category   PHP
 * @package    Olympus
 * @subpackage Handler\Configurator
 * @author     Achraf Chouk <achrafchouk@gmail.com>
 * @license    https://github.com/crewstyle/Olympus/blob/master/LICENSE MIT
 * @link       https://github.com/crewstyle/Olympus
 * @see        https://github.com/Incenteev/ParameterHandler
 * @since      0.0.3
 */

class Configurator
{
    /**
     * Build files on Composer install / update.
     *
     * @param  Event $event
     * @return 
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

        // Build `config.rb` file
        $processor->processConfig(dirname($vendor).'/app/deploy/config.rb');
    }
}
