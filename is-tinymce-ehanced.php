<?php
/**
 * Plugin Name: TinyMCE Enhanced
 * Description: This plugin adds advanced features to the TinyMCE text editor.
 * Version: 1.0
 * Author: Interlude Santé
 * Author URI: https://interludesante.com
 * Author Email: hello@interludesante.com
 * Text Domain: is-tinymce-enhanced
 * License: GPLv3
 *
 * @package   is-tinymce-enhanced
 * @link      https://github.com/thomasnavarro/is-tinymce-enhanced
 * @author    Interlude Santé <hello@interludesante.com>
 * @copyright Interlude Santé
 * @license   GPLv3
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class IS_Tinymce_Enhanced
{

    /**
     * The single instance of the class.
     *
     * @since  1.0
     * @access protected
     */
    protected static $instance = null;

    /**
     * A dummy magic method to prevent class from being cloned.
     *
     * @since  1.0
     * @access public
     */
    public function __clone()
    {
        _doing_it_wrong(__FUNCTION__, 'Cheatin&#8217; huh?', '1.0.0');
    }

    /**
     * A dummy magic method to prevent class from being unserialized.
     *
     * @since  1.0
     * @access public
     */
    public function __wakeup()
    {
        _doing_it_wrong(__FUNCTION__, 'Cheatin&#8217; huh?', '1.0.0');
    }

    /**
     * Main instance.
     *
     * Ensures only one instance is loaded or can be loaded.
     *
     * @since  1.0
     * @access public
     *
     * @return Main instance.
     */
    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor.
     *
     * @since  1.0
     * @access public
     */
    public function __construct()
    {

        $this->file     =  __FILE__;
        $this->basename = plugin_basename($this->file);

        $this->init_hooks();
    }

    /**
     * Get the plugin url.
     *
     * @since  1.0
     * @access public
     *
     * @return string
     */
    public function get_plugin_url()
    {
        return plugin_dir_url($this->file);
    }

    /**
     * Get the plugin path.
     *
     * @since  1.0
     * @access public
     *
     * @return string
     */
    public function get_plugin_path()
    {
        return plugin_dir_path($this->file);
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since  1.0
     * @access public
     *
     * @return string
     */
    public function get_version()
    {
        $plugin_data = get_file_data($this->file, [ 'Version' => 'Version' ], 'plugin');
        return $plugin_data['Version'];
    }

    /*
     * Hook into actions and filters.
     *
     * @since  1.0
     * @access private
     */
    private function init_hooks()
    {
        add_filter('mce_buttons', [$this, 'add_table_button']);
        add_filter('mce_external_plugins', [$this, 'add_table_plugin']);
    }

    /**
     * Add Button to TinyMCE.
     *
     * @since  1.0
     * @access public
     */
    function add_table_button($buttons)
    {
        array_push($buttons, '|', 'table');

        return $buttons;
    }

    /**
     * Add Table plugin.
     *
     * @since  1.0
     * @access public
     */
    public function add_table_plugin($plugins)
    {
        $plugins['table'] = $this->get_plugin_url() . 'assets/js/table.min.js';

        return $plugins ;
    }
}

IS_Tinymce_Enhanced::instance();
