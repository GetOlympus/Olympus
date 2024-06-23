<?php

/**
 * Advanced cache mechanism for WordPress.
 * This script is executed by WordPress early in the loading process.
 *
 * @category PHP
 * @package  Olympus
 * @author   Achraf Chouk <achrafchouk@gmail.com>
 * @license  https://github.com/GetOlympus/Olympus/blob/master/LICENSE MIT
 * @link     https://github.com/GetOlympus/Olympus
 * @since    0.0.39
 */

if (!defined('WP_CACHE') || !WP_CACHE || !isset($GLOBALS['wp_object_cache'])) {
    return;
}

/**
 * Silence is golden
 */
