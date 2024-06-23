<?php

/**
 * Multisite constants.
 *
 * @category PHP
 * @package  Olympus
 * @author   Achraf Chouk <achrafchouk@gmail.com>
 * @license  https://github.com/GetOlympus/Olympus/blob/master/LICENSE MIT
 * @link     https://github.com/GetOlympus/Olympus
 * @since    0.0.20
 */

// Multisite dis/enabled
if (isset($config['multisite']) && is_bool($config['multisite'])) {
    define('WP_ALLOW_MULTISITE', $config['multisite']);
} else {
    define('WP_ALLOW_MULTISITE', false);
}
