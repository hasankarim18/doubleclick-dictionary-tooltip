<?php

/*
Plugin Name: DoubleClick Dictionary Tooltip
Plugin URI: https://example.com/doubleclick-dictionary-tooltip
Description: Adds a tooltip with dictionary definitions when users double-click words.
Version: 1.0.0
Author: Your Name
Author URI: https://example.com
License: GPL2
Text Domain: doubleclick-dictionary-tooltip
*/

class LOADING_SCRIPTS
{
    private $path = '';
    private const VERSION = '1.0.0';

    public function __construct()
    {
        $this->path = plugin_dir_url(__FILE__);
        add_action('wp_enqueue_scripts', array($this, 'load_styles'));
        add_action('wp_enqueue_scripts', array($this, 'load_js_scripts'));
    }

    public function load_styles()
    {
        wp_enqueue_style('dcdt-style', "{$this->path}frontend/css/main.css", [], self::VERSION);
    }

    public function load_js_scripts()
    {

        $plugin_path = plugin_dir_url(__FILE__) . "frontend/js/main.js";
        wp_enqueue_script('dcdt-script', $plugin_path, [], self::VERSION, ['in_footer' => true]);
    }
}

new LOADING_SCRIPTS();


class DOUBLECLICK_DICTIONARY_TOOLTIP
{
}