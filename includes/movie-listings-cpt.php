<?php

// Create Movie Listing Post Type
function ml_register_movie_listing() {
    $singular_name = apply_filters('ml_label_single', 'Movie Listing');
    $plural_name = apply_filters('ml_label_plural', 'Movie Listings');
 
    $labels = array(
        'name'                  => $plural_name,
        'singular_name'         => $singular_name,
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New '.$singular_name,
        'edit'                  => 'Edit',
        'edit_item'             => 'Edit '.$singular_name,
        'new_item'              => 'New '.$singular_name,
        'view'                  => 'View',
        'view_item'             => 'View '.$singular_name,
        'search_items'          => 'Search '.$plural_name,
        'not_found'             => 'No '.$plural_name.' Found',
        'not_found_in_trash'    => 'No '.$plural_name.' Found',
        'parent_item_colon'     => 'Parent '.$singular_name,
        'menu_name'             => $plural_name,
    );
 
    $args = apply_filters('ml_movie_listing_args', array(
        'labels'                => $labels,
        'hierarchical'          => true,
        'description'           => 'Movie listings by genre',
        'taxonomies'            => array( 'genres' ),
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-video-alt2',
        'show_in_nav_menus'     => true,
        'publicly_queryable'    => true,
        'exclude_from_search'   => false,
        'has_archive'           => true,
        'query_var'             => true,
        'can_export'            => true,
        'rewrite'               => array('slug' => 'movie_listing', 'with_front' => FALSE),
        'capability_type'       => 'post',
        'supports'              => array( 
            'title',
            'thumbnail'
        )
    ));
 
    // Register The Movie Listing Post Type
    register_post_type( 'movie_listing', $args );
    flush_rewrite_rules();
}
 
add_action( 'init', 'ml_register_movie_listing' );

// Create Genres Taxonomy
function ml_genres_taxonomy(){
    register_taxonomy(
        'genres',
        'movie_listing',
        array(
            'label' => 'Genres',
            'hierarchical'          => true,
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'genre',
                'with_front' => false
            )
        )
    );
}

add_action('init', 'ml_genres_taxonomy');

// Load Template
function ml_load_templates($template){
    if(get_query_var('post_type') == 'movie_listing'){
        $new_template = plugin_dir_path(__FILE__). 'templates/single-movie-listing.php';
        if('' != $new_template){
            return $new_template;
        }
    }

    return $template;
}

add_filter('template_include', 'ml_load_templates');