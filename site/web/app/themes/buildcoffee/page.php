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
	if ( locate_template( 'page-' . $section_name . '.php' ) !== '' ) {
		get_template_part( 'page', $section_name );
	} else {
		the_content();
	}
	?>
</div>
