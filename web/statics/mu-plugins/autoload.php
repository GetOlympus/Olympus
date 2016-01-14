<?php

/**
 *
 * @package Olympus
 * @author Achraf Chouk <achrafchouk@gmail.com>
 * @since 0.0.1
 *
 * @see https://codex.wordpress.org/Must_Use_Plugins
 *
 */


/**
 * Usefull hoook to start working.
 */
add_action('setup_theme', function (){
    /**
     * Template configurations.
     */

    //the current theme repertory.
    define('OL_TPL_DIR', get_template_directory());
    //the current theme URI.
    define('OL_TPL_DIR_URI', get_template_directory_uri());
    //the current language dictionnary
    define('OL_TPL_DICTIONARY', basename(OL_TPL_DIR));


    /**
     * Global definitions.
     */

    //define if we are in the admin panel or not
    define('OL_ISADMIN', is_admin());
    //define an AJAX NONCE value
    define('OL_NONCE', wp_create_nonce(OL_TPL_DICTIONARY.'_ajax_nonce'));


    /**
     * Blog definitions.
     */

    $name = get_bloginfo('name');
    $description = get_bloginfo('description');

    //the Home URL
    define('OL_TPL_HOME', WP_HOME);
    //the WP URL
    define('OL_TPL_WPURL', get_bloginfo('wpurl'));
    //the language
    define('OL_TPL_LANGUAGE', get_bloginfo('language'));
    //the homepage escaped url
    define('OL_TPL_HOME_URL_ESCAPED', esc_url(home_url('/')));
    //the author
    define('OL_TPL_AUTHOR', get_bloginfo('author'));
    //the name
    define('OL_TPL_NAME', $name);
    //the description
    define('OL_TPL_DESCRIPTION', $description);
    //the escaped name
    define('OL_TPL_NAME_ESCAPED', esc_attr($name));
    //the escaped description
    define('OL_TPL_DESCRIPTION_ESCAPED', esc_attr($description));
    //the title
    define('OL_TPL_TITLE', get_bloginfo('title'));
    //the charset
    define('OL_TPL_CHARSET', get_bloginfo('charset'));
    //the pingback URL
    define('OL_TPL_PINGBACK_URL', get_bloginfo('pingback_url'));
    //the pingback URL
    define('OL_TPL_RSS', get_bloginfo('rss_url'));


    /**
     * Customizable Olympus Zeus definitions.
     */

    //The value defining if we are in admin panel or not
    define('OLZ_ISADMIN', OL_ISADMIN);
    //The nonce ajax value
    define('OLZ_NONCE', OL_NONCE);

    //The blog home url
    define('OLZ_HOME', OL_TPL_HOME);
    //The language blog
    define('OLZ_LOCAL', OL_TPL_LANGUAGE);
    //The path
    //define('OLZ_PATH', dirname(APPPATH));
    //The URI
    define('OLZ_URI', OL_TPL_HOME.'/medias/zeus');
    //The Twig cache folder
    define('OLZ_CACHE', APPPATH.'/cache');


    /**
     * Instanciate Tea Theme Options core.
     */

    $GLOBALS['Olympus'] = new crewstyle\OlympusZeus\OlympusZeus();


    /**
     * Return a value from options
     *
     * @since 1.4.0
     */
    function _get_option($option, $default = '', $transient = false)
    {
        return $GLOBALS['Olympus']::getOption($option, $default, $transient);
    }

    /**
     * Set a value into options
     *
     * @since 1.4.0
     */
    function _set_option($option, $value, $transient = false)
    {
        $GLOBALS['Olympus']::setOption($option, $value, $transient);
    }
});
