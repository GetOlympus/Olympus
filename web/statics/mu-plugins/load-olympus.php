<?php

use crewstyle\OlympusCore\Olympus;
use crewstyle\TeaThemeOptions\TeaThemeOptions;

/**
 *
 * @package Olympus
 * @author Achraf Chouk <achrafchouk@gmail.com>
 * @since 0.0.1
 *
 * @see https://codex.wordpress.org/Must_Use_Plugins
 *
 */

// Instanciate the Olympus Core package
if (class_exists('OlympusCore')) {
    $olympus = new OlympusCore();
}

// Instanciate the Tea Theme Options package
if (class_exists('TeaThemeOptions')) {
    $tea = new TeaThemeOptions();
}
