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
    const ADMINAJAXGETTER = 'ol-admin-ajax';

    /**
     * @var boolean
     */
    protected $is_admin;

    /**
     * @var boolean
     */
    protected static $is_running = false;

    /**
     * Constructor.
     *
     * @param  bool    $is_admin
     *
     * @since 0.0.38
     */
    public function __construct($is_admin = false)
    {
        if (true === self::$is_running) {
            return false;
        }

        self::$is_running = true;
        $this->is_admin   = $is_admin;

        add_action('after_setup_theme', [&$this, 'init']);
    }

    /**
     * Run some checks then change `admin-ajax.php` name.
     *
     * @since 0.0.38
     */
    public function init()
    {
        if (!$this->is_admin) {
            add_filter('admin_url', [&$this, 'redirectAdminAjaxUrl'], 11, 3);
            add_action('template_redirect', [&$this, 'runAjaxQuery']);
        }

        register_activation_hook(__FILE__, [&$this, 'activate']);
        add_action('init', [&$this, 'rewriteCalls']);
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
    public function redirectAdminAjaxUrl($url, $path, $blog_id)
    {
        return strpos($url, 'admin-ajax') ? home_url('/'.preg_replace('#(/$)#', '', ADMINAJAXPATH)) : $url;
    }

    /**
     * Rewrite all `admin-ajax.php` default calls.
     *
     * @since 0.0.38
     */
    public function rewriteCalls()
    {
        global $wp_rewrite;

        add_rewrite_tag("%".ADMINAJAXGETTER."%", "([0-9]+)");

        $rule = apply_filters('ol.olympus.admin-ajax.rule', '^'.ADMINAJAXPATH.'?$');
        add_rewrite_rule($rule, 'index.php?'.ADMINAJAXGETTER.'=true', 'top');
    }

    /**
     * Run all ajax calls.
     *
     * @since 0.0.38
     */
    public function runAjaxQuery()
    {
        global $wp_query;

        if (!$wp_query->get(ADMINAJAXGETTER)) {
            return;
        }

        define('DOING_AJAX', true);

        // Get requested action
        $action = isset($_REQUEST['action']) ? esc_attr($_REQUEST['action']) : false;

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

        $action = (is_user_logged_in() ? 'wp_ajax_' : 'wp_ajax_nopriv_').$action;
        do_action($action);

        die(0);
    }
}
