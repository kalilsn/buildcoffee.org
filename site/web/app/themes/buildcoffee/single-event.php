<?php
get_header();

$args = [
	'post_type' => 'attachment',
	'numberposts' => -1,
	'tag' => 'background',
];

$attachments = get_posts( $args );
$id = $attachments[ array_rand( $attachments ) ]->ID;
echo wp_get_attachment_image( $id, 'huge', false, [ 'class' => 'background' ] );
?>
<div class="single-event">
	<div class="overlay">
		<?php
		while ( have_posts() ) {
			the_post();
			get_template_part( 'templates/content', 'event' );
		}
		?>
	</div>
</div>
<?php
get_footer();
