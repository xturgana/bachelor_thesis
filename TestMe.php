<?php

/*
Plugin Name: Test Me
Plugin URI:
Description: This plugin is designed to create quiezes.
Version: 1.0
Author: Alisher Turganaliyev
Author URI: https://profiles.wordpress.org/xturgana
License: A "Slug" license name e.g. GPL2
*/
session_start();

include("includes/tm_sql.php");
include("includes/tm_admin.php");
include("includes/tm_user.php");


register_activation_hook(__FILE__, 'tm_create_database');

register_deactivation_hook(__FILE__, 'tm_deactivation');

register_uninstall_hook(__FILE__, 'tm_delete_database');

function tm_add_admin_menu()
{
    add_menu_page('TestMe', 'TestMe', 'manage_options', __FILE__, 'tm_show_all', '', 75);
    add_submenu_page(__FILE__, 'Students', 'Students', 'manage_options', 'studenty', 'tm_show_students');
    add_submenu_page(__FILE__, 'Teachers', 'Teachers', 'manage_options', 'teachers', 'tm_show_teachers');
    add_submenu_page(__FILE__, 'Firms', 'Firms', 'manage_options', 'firms', 'tm_show_firms');
    add_submenu_page(__FILE__, 'Others', 'Others', 'manage_options', 'others', 'tm_show_others');
}

add_action('admin_menu', 'tm_add_admin_menu');

function tm_load_scripts()
{
    // jquery регистрируется в WP по умолчанию.
    // Поэтому для его подключения достаточно одной строки:
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-tabs');
    wp_enqueue_script('jquery-ui-dialog');
    wp_enqueue_style('jquery-ui', plugin_dir_url(__FILE__) . 'styles/jquery-ui.min.css');
    wp_enqueue_script('ql-js', plugin_dir_url(__FILE__) . 'js/ql.js');
    wp_enqueue_style('ql-css', plugin_dir_url(__FILE__) . 'styles/style.css');
    wp_enqueue_script('ql-color', plugin_dir_url(__FILE__) . 'js/jscolor.js');
    ///bootstrap
    wp_enqueue_script('bootstrap', plugin_dir_url(__FILE__) . 'js/bootstrap.js');
    wp_enqueue_script('bootstrap-bundle', plugin_dir_url(__FILE__) . 'js/bootstrap.bundle.js');
    wp_enqueue_style('bootstrap', plugin_dir_url(__FILE__) . 'styles/bootstrap.css');
    wp_enqueue_style('bootstrap-grid', plugin_dir_url(__FILE__) . 'styles/bootstrap-grid.css');
    wp_enqueue_style('bootstrap-reboot', plugin_dir_url(__FILE__) . 'styles/bootstrap-reboot.css');
    //canvas
    wp_enqueue_script('canvas-charts', plugin_dir_url(__FILE__) . 'js/jquery.canvasjs.min.js');
    wp_enqueue_style('circle', plugin_dir_url(__FILE__) . 'styles/circle.css');


}

function tm_load_client_scripts()
{
    wp_enqueue_script('tm_ajax', plugins_url('js/ql-ajax.js', __FILE__), array('jquery'));
    wp_enqueue_style('ql-css', plugin_dir_url(__FILE__) . 'styles/style.css');
    if (is_singular()) {
        wp_localize_script('tm_ajax', 'MyAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'singul' => is_single));
    } else {
        wp_localize_script('tm_ajax', 'MyAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'singul' => not_single));
    }
    wp_enqueue_script('bootstrap', plugin_dir_url(__FILE__) . 'js/bootstrap.js');
    wp_enqueue_script('bootstrap-bundle', plugin_dir_url(__FILE__) . 'js/bootstrap.bundle.js');
    wp_enqueue_style('bootstrap', plugin_dir_url(__FILE__) . 'styles/bootstrap.css');
    wp_enqueue_style('bootstrap-grid', plugin_dir_url(__FILE__) . 'styles/bootstrap-grid.css');
    wp_enqueue_style('bootstrap-reboot', plugin_dir_url(__FILE__) . 'styles/bootstrap-reboot.css');
}

add_action('admin_enqueue_scripts', 'tm_load_scripts');
add_action('wp_enqueue_scripts', 'tm_load_client_scripts');

?>