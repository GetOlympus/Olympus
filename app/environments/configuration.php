<?php

/**
 * Configuration constants.
 *
 * @category PHP
 * @package  Olympus
 * @author   Achraf Chouk <achrafchouk@gmail.com>
 * @license  https://github.com/GetOlympus/Olympus/blob/master/LICENSE MIT
 * @link     https://github.com/GetOlympus/Olympus
 * @since    0.0.20
 */

// Default options
$opts = array_merge([
    // Set memory limit
    'wp_memory_limit' => '128M',
    // Autosave interval in seconds
    'autosave_interval' => 60,
    // Cron lock timeout in seconds
    'wp_cron_lock_timeout' => 60,
    // Trash feature for media
    'media_trash' => true,
], isset($config['options']['configuration']) ? $config['options']['configuration'] : []);

/**
 * Define constants
 */

// Disable file editor in the "Theme / Plugin editor"
if (false === (bool) $config['file_edit']) {
    define('DISALLOW_FILE_EDIT', true);
}

// Fix revisions up to 10 - 0 to disable revisions, remove the line to make it infinite
if (-1 < (int) $config['wordpress']['revisions']) {
    define('WP_POST_REVISIONS', (int) $config['wordpress']['revisions']);
}

// Days for posts in trash
if (-1 < (int) $config['wordpress']['posts_in_trash']) {
    define('EMPTY_TRASH_DAYS', (int) $config['wordpress']['posts_in_trash']);
}

// Automatic updater and core upgrader
if (true === (bool) $config['wordpress']['disable_updater']) {
    define('AUTOMATIC_UPDATER_DISABLED', true);
    define('CORE_UPGRADE_SKIP_NEW_BUNDLED', true);
}

// We recommand that you DO NOT use the default WordPress cron which is made to work
// for those who do not have an ssh access to their server.
if (false === (bool) $config['cron']) {
    define('ALTERNATE_WP_CRON', false);
    define('DISABLE_WP_CRON', true);
}

// Set memory limit
define('WP_MEMORY_LIMIT', (string) $opts['wp_memory_limit']);

// Autosave interval in seconds
define('AUTOSAVE_INTERVAL', (int) $opts['autosave_interval']);

// Cron lock timeout in seconds
define('WP_CRON_LOCK_TIMEOUT', (int) $opts['wp_cron_lock_timeout']);

// Trash feature for media
define('MEDIA_TRASH', (bool) $opts['media_trash']);

// Free memory
unset($opts);
