<?php

/**
 * Cache constants.
 *
 * @category PHP
 * @package  Olympus
 * @author   Achraf Chouk <achrafchouk@gmail.com>
 * @license  https://github.com/GetOlympus/Olympus/blob/master/LICENSE MIT
 * @link     https://github.com/GetOlympus/Olympus
 * @since    0.0.20
 */

// Cache dis/enabled
if (isset($config['cache']) && is_bool($config['cache'])) {
    define('WP_CACHE', $config['cache']);
} else {
    define('WP_CACHE', false);
}
