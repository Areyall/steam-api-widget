<?php

/*
  Plugin Name: Steam-Api-Widget
  Plugin URI: http://8bit-life.com
  Description: A simple WordPress widget for your steam profile.
  Version: 1.0
  Author: armin nowacki
  Author URI: http://8bit-life.com
  License: GPL2
 */

require('steam/api.php');
require('steam/games.php');
require('steam/profile.php');

class Steam_Api_Widget extends WP_Widget {

    private $default_settings = array(
        "title" => "Steam",
        "apikey" => "221D4C81A2190C6AB2837576CC12DE6C",
        "steamid64" => '76561198017266021',
        "count" => '7'
    );

    private function init_plugin_constants() {

        if (!defined('PLUGIN_LOCALE')) {
            define('PLUGIN_LOCALE', 'steam-api-widget-locale');
        }

        if (!defined('PLUGIN_NAME')) {
            define('PLUGIN_NAME', 'Steam');
        }

        if (!defined('PLUGIN_SLUG')) {
            define('PLUGIN_SLUG', 'steam-api-widget');
        }
    }

    private function load_file($name, $file_path, $is_script = false) {

        $url = WP_PLUGIN_URL . $file_path;
        $file = WP_PLUGIN_DIR . $file_path;

        if (file_exists($file)) {
            if ($is_script) {
                wp_register_script($name, $url);
                wp_enqueue_script($name);
            } else {
                wp_register_style($name, $url);
                wp_enqueue_style($name);
            }
        }
    }

    private function register_scripts_and_styles() {
        if (!is_admin())
            $this->load_file(PLUGIN_NAME, '/' . PLUGIN_SLUG . '/css/bootstrap.css');
    }

    function Steam_Api_Widget() {

        $this->init_plugin_constants();

        $widget_opts = array(
            'classname' => PLUGIN_SLUG,
            'description' => __('A simple WordPress widget for your Steam profile.', PLUGIN_LOCALE)
        );

        $this->WP_Widget(PLUGIN_SLUG, __(PLUGIN_NAME, PLUGIN_LOCALE), $widget_opts);
        $this->register_scripts_and_styles();
    }

    function form($instance) {

        $instance = wp_parse_args((array) $instance, $this->default_settings);
        $title = esc_attr($instance['title']);
        $api_key = esc_attr($instance['apikey']);
        $steam_id = esc_attr($instance['steamid64']);
        $count = esc_attr($instance['count']);
        include(WP_PLUGIN_DIR . '/' . PLUGIN_SLUG . '/views/admin.php');
    }

    function update($new_instance, $old_instance) {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['apikey'] = strip_tags($new_instance['apikey']);
        $instance['steamid64'] = strip_tags($new_instance['steamid64']);
        $instance['count'] = strip_tags($new_instance['count']);
        return $instance;
    }

    function widget($args, $instance) {

        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $api_key = $instance['apikey'];
        $steam_id = $instance['steamid64'];
        $count = $instance['count'];

        echo $before_widget;

        if ($title) {
            echo $before_title . $title . $after_title;
        }

        echo '<div id="steam-widget">';
        $api = new Api($api_key, $steam_id);
        $data = $api->GetData();

        if ($data) {

            $profile = new Profile($data['profile']);
            $games = new Games($data['games']);

            include(WP_PLUGIN_DIR . '/' . PLUGIN_SLUG . '/views/widget.php');
        }
        echo '</div>';


        echo $after_widget;
    }

}

add_action('widgets_init', create_function('', 'return register_widget("Steam_Api_Widget");'));
?>
