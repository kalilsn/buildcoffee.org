<?php
/**
 * A single section of the homepage
 *
 * @package _bctheme
 */
?>
<?php $section_name = get_post_field( 'post_name' ); ?>
<div class="section <?php echo $section_name ?>" id="<?php echo $section_name; ?>">
	<?php
		the_content();
	if ( locate_template( 'section-' . $section_name . '.php' ) !== '' ) {
		get_template_part( 'section', $section_name );
	}
	?>
</div>
