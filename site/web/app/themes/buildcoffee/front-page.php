<?php
/**
 * The template for displaying the front page.
 *
 * This is the template that displays on the front page only.
 *
 * @package _bctheme
 */

get_header( 'home' ); ?>

<?php
	$args = [
		'post_type' => 'page',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'post_parent' => 0,
	];
	$home_query = new WP_Query( $args );
	while ( $home_query->have_posts() ) {
		$home_query->the_post();
		the_post_thumbnail( 'huge', [
			'class' => 'divider',
		] );
		get_template_part( 'page' );
		$home_query->reset_postdata();
	}
?>

	<?php get_footer();
