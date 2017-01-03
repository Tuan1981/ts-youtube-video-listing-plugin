<?php

// Add Admin Scripts
function ml_add_admin_scripts(){
		wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css');
    	wp_enqueue_style('ml-style', plugins_url() . '/movie-listings/css/style-admin.css');
    	wp_enqueue_script('ml-script',plugins_url().'/movie-listings/js/main.js', array('jquery','jquery-ui-sortable'));
}

add_action('admin_init','ml_add_admin_scripts');


// Add Scripts
function ml_add_scripts(){
    wp_enqueue_style('ml-style', plugins_url() . '/movie-listings/css/style.css');
    wp_enqueue_script('ml-script',plugins_url().'/movie-listings/js/main.js', array('jquery'));
}

add_action('wp_enqueue_scripts','ml_add_scripts');