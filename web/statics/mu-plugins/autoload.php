<?php

use Olympus\Components\Autoloader\MuPlugins;

/**
 * This autoloader initialize all details for Olympus Hera and Zeus.
 * It brings all necessary statics for plugins and themes.
 *
 * @category PHP
 * @package  Olympus
 * @author   Achraf Chouk <achrafchouk@gmail.com>
 * @license  https://github.com/GetOlympus/Olympus/blob/master/LICENSE MIT
 * @link     https://github.com/GetOlympus/Olympus
 * @since    0.0.1
 */

/**
 * Plugin Name: Olympus Autoload
 * Plugin URI: https://github.com/GetOlympus/Olympus
 * Description: This autoloader initialize all details for Olympus bundles and brings statics for plugins and themes.
 * Version: 0.0.1
 * Author: crewstyle
 * Author URI: https://github.com/crewstyle
 * License: MIT License
 */

/**
 * Update theme root folder.
 */
add_filter('theme_root', function () {
    return WP_THEME_DIR;
});
add_filter('theme_root_uri', function () {
    return WP_THEME_URL;
});

/**
 * Autoload all mu-plugins.
 * As the first autoloaded file, all useful constants are defined here.
 */
add_action('setup_theme', function () {
    /**
     * Template configurations.
     */

    // Current theme repertory.
    define('OL_TPL_DIR', get_template_directory());
    // Current theme URI.
    define('OL_TPL_DIR_URI', get_template_directory_uri());


    /**
     * Blog definitions.
     */

    $name = get_bloginfo('name');
    $description = get_bloginfo('description');

    // Home URL
    define('OL_BLOG_HOME', WP_HOME);
    // WP URL
    define('OL_BLOG_WPURL', get_bloginfo('wpurl'));
    // Language
    define('OL_BLOG_LANGUAGE', get_bloginfo('language'));
    // Homepage escaped url
    define('OL_BLOG_HOME_URL_ESCAPED', esc_url(home_url('/')));
    // Author
    define('OL_BLOG_AUTHOR', get_bloginfo('author'));
    // Name
    define('OL_BLOG_NAME', $name);
    // Description
    define('OL_BLOG_DESCRIPTION', $description);
    // Escaped name
    define('OL_BLOG_NAME_ESCAPED', esc_attr($name));
    // Escaped description
    define('OL_BLOG_DESCRIPTION_ESCAPED', esc_attr($description));
    // Title
    define('OL_BLOG_TITLE', get_bloginfo('title'));
    // Charset
    define('OL_BLOG_CHARSET', get_bloginfo('charset'));
    // Pingback URL
    define('OL_BLOG_PINGBACK_URL', get_bloginfo('pingback_url'));
    // Pingback URL
    define('OL_BLOG_RSS', get_bloginfo('rss_url'));

    // Memory free
    unset($name, $description);


    /**
     * Global definitions.
     */

    // Define if we are in the admin panel or not
    defined('OL_ISADMIN')       || define('OL_ISADMIN', is_admin());
    // Define if the user is connected or not
    defined('OL_ISCONNECTED')   || define('OL_ISCONNECTED', is_user_logged_in());
    // The dist folder URI
    defined('OL_DISTURI')       || define('OL_DISTURI', OL_BLOG_HOME.'/resources/dist/');
    // AJAX NONCE value
    defined('OL_NONCE')         || define('OL_NONCE', wp_create_nonce(basename(OL_TPL_DIR).'_ajax_nonce'));


    /**
     * Class initialization.
     */

    (new MuPlugins(OL_ISADMIN))->init();
});
