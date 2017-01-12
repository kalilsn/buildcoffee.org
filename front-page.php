<?php
/**
 * The template for displaying the front page.
 *
 * This is the template that displays on the front page only.
 *
 * @package _bctheme
 */

get_header(); ?>

<?php
	$args = array("post_type" => "page", "orderby" => "menu_order", "order" => "ASC");
	$query = new WP_Query($args);
	while ($query->have_posts()) {
		$query->the_post();
		get_template_part("section");
        the_post_thumbnail("large", array("class" => "divider"));
	}
?>
    
<?php get_footer(); ?>