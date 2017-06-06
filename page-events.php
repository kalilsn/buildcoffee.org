<?php
/**
 * Template Name: Events Section
 *
 * @package _bctheme
 */
	the_content();
	$args = [
		'post_type' => 'event',
		'orderby' => 'meta_value_num',
		'meta_key' => 'event_start_time',
		'order' => 'ASC',
		'posts_per_page' => -1,
		'meta_query' => [
			'key' => 'event_end_time',
			'value' => strtotime( 'yesterday' ),
			'type' => 'numeric',
			'compare' => '>=',
		],
	];
	$events_query = new WP_Query( $args );
	if ( $events_query->have_posts() ) {
		while ( $events_query->have_posts() ) {
			$events_query->the_post();
			get_template_part( 'templates/content', 'event' );
		}
	} else {
		//If no events, display page
		$page = get_page_by_title( 'No Events' );
		$content = apply_filters( 'the_content', $page->post_content );
		echo $content;
	}
