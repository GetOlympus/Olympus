<?php

namespace Olympus\Components\Autoloader;

/**
 * Update AdminAjax name modifier.
 *
 * @category   PHP
 * @package    Olympus
 * @subpackage Components\Autoloader\AdminAjax
 * @author     Achraf Chouk <achrafchouk@gmail.com>
 * @license    https://github.com/GetOlympus/Olympus/blob/master/LICENSE MIT
 * @link       https://github.com/GetOlympus/Olympus
 * @since      0.0.38
 */

class AdminAjax
{
    /**
     * @var boolean
     */
    protected static $isRunning = false;

    /**
     * Constructor.
     *
     * @param  bool    $is_admin
     *
     * @since 0.0.38
     */
    public function __construct()
    {
        if (self::$isRunning) {
            return;
        }

        self::$isRunning = true;

        add_action('after_setup_theme', [$this, 'init']);
    }

    /**
     * Run some checks then change `admin-ajax.php` name.
     *
     * @since 0.0.38
     */
    public function init()
    {
        add_action('init', [$this, 'manageCalls']);

        if (!OL_ISADMIN) {
            add_filter('admin_url', [$this, 'rewriteAdminAjaxUrl'], 11, 3);
            add_action('template_redirect', [$this, 'runAjaxQuery'], 1);
        }
    }

    /**
     * Rewrite all `admin-ajax.php` default calls.
     *
     * @since 0.0.38
     */
    public function manageCalls()
    {
        add_rewrite_tag('%ol-admin-ajax%', '([^&]+)');
        add_rewrite_tag('%action%', '([^&]+)');

        add_rewrite_rule('^'.ADMINAJAXPATH.'/?$', 'index.php?ol-admin-ajax=1', 'top');
        add_rewrite_rule('^'.ADMINAJAXPATH.'/([^/]+)/?$', 'index.php?ol-admin-ajax=1&action=$matches[1]', 'top');
    }

    /**
     * Checks url called name and update it if needed.
     *
     * @param  string  $url
     * @param  string  $path
     * @param  integer $blog_id
     * @return string
     *
     * @since 0.0.38
     */
    public function rewriteAdminAjaxUrl($url, $path, $blog_id)
    {
        return $path === 'admin-ajax.php' ? home_url('/'.ADMINAJAXPATH.'/') : $url;
    }

    /**
     * Run all ajax calls.
     *
     * @since 0.0.38
     */
    public function runAjaxQuery()
    {
        global $wp_query;

        if (!isset($wp_query->query_vars['ol-admin-ajax'])) {
            return;
        }

        define('DOING_AJAX', true);

        // Get requested action
        if (isset($wp_query->query_vars['action'])) {
            $action = $wp_query->query_vars['action'];
        } else {
            $action = isset($_REQUEST['action']) ? esc_attr($_REQUEST['action']) : false;
        }

        // Check action
        if (!$action) {
            die(0);
        }

        do_action('ol.olympus.admin-ajax.before');
        do_action('ol.olympus.admin-ajax.before.'.$action);

        // Build headers
        $headers = apply_filters('ol.olympus.admin-ajax.headers', [
            'Content-Type: text/html; charset='.OL_BLOG_CHARSET,
            'X-Robots-Tag: noindex',
        ]);

        if (is_array($headers) && count($headers)) {
            foreach ($headers as $header) {
                @header($header);
            }
        }

        send_nosniff_header();
        nocache_headers();

        $action = 'wp_ajax_'.(!is_user_logged_in() ? 'nopriv_' : '').$action;
        do_action($action);

        die(0);
    }
}
