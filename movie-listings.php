<?php
/**
* Plugin Name:You Tube Movie Listings
* Description: Lists movies and info
* Version: 1.0
* Author: Tuan Anh Le
* Author URI: https://themestar.co.uk  https://themetheuk.com
**/

// Exit If Accessed Directly
if(!defined('ABSPATH')){
    exit;
}

require_once(plugin_dir_path(__FILE__) . '/includes/movie-listings-scripts.php');

// Check if admin

	require_once(plugin_dir_path(__FILE__) . '/includes/movie-listings-cpt.php');
	require_once(plugin_dir_path(__FILE__) . '/includes/movie-listings-settings.php');
	require_once(plugin_dir_path(__FILE__) . '/includes/movie-listings-fields.php');
	require_once(plugin_dir_path(__FILE__) . '/includes/movie-listings-reorder.php');
    require_once(plugin_dir_path(__FILE__) . '/includes/movie-listings-shortcodes.php');



