<?php

// List Movies
function ml_list_movies($atts, $content = null){
	$atts = shortcode_atts(array(
		'title' => 'Latest Movies',
		'count' => 12,
		'genre' => 'all',
		'pagination' => 'on'
	), $atts);

	$pagination = $atts['pagination'] == 'on' ? false : true;
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;

	// Check genre
	if($atts['genre'] == 'all'){
		$terms = '';
	} else {
		$terms = array(array(
			'taxonomy' => 'genres',
			'field'    => 'slug',
			'terms'	   => $atts['genre']
		));
	}

	// Query Args
	$args = array(
		'post_type' => 'movie_listing',
		'post_status'	=> 'publish',
		'orderby' => 'menu_order',
		'order'		=> 'ASC',
		'no_found_rows'	=> $pagination,
		'posts_per_page'=> $atts['count'],
		'paged'			=> $paged,
		'tax_query'		=> $terms
	);

	// Get Movies From DB
	$movies = new WP_Query($args);

	// Check For Movies
	if($movies->have_posts()){
		// Get genre Slug
		$genre = str_replace('-', ' ', $atts['genre']);
			$output = '<div class="movie-list">';
			while($movies->have_posts()){
				$movies->the_post();
				$image = wp_get_attachment_image_src(get_post_thumbnail_id(),'single-post-thumbnail');
				
				$output .= '<div class="movie-col">';
				$output .= '<img class="feat-image" src="'.$image[0].'"';
				$output .= '<h5 class="movie-title">'.get_the_title().'</h5><br>';
				$output .= '<a href="'.get_permalink().'">View Details</a>';
				$output .= '</div>';
			}
			$output .= '</div>';

			// Clear Float
			$output .= '<div style="clear:both"></div>';

			// Reset Post Data
			wp_reset_postdata();

			// Pagination
		if($movies->max_num_pages > 1 && is_page()){
			$output .= '<nav class="prev-next-posts">';
			$output .= '<div class="nav-previous">';
			$output .= get_next_posts_link(__('<span class="meta-nav">&larr;</span> Previous'), $movies->max_num_pages);
			$output .= '</div>';

			$output .= '<div class="next-posts-link">';
			$output .= get_previous_posts_link(__('<span class="meta-nav">&rarr;</span> Next'));
			$output .= '</div>';
			$output .= '</nav';
		}

			return $output;
	} else {
		return '<p>No Movies Found</p>';
	}
}

add_shortcode('movies', 'ml_list_movies');