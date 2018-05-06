<?php
get_header();

$args = [
	'post_type' => 'event',
	'orderby' => 'meta_value_num',
	'meta_key' => 'event_start_time',
	'order' => 'DESC',
	'posts_per_page' => -1,
];
$events_query = new WP_Query( $args );
if ( $events_query->have_posts() ) {
	while ( $events_query->have_posts() ) {
		$events_query->the_post();
		get_template_part( 'templates/content', 'event' );
	}
}

get_footer();
