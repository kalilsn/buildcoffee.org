<?php
/**
 * A single section of the homepage
 *
 * @package _bctheme
 */
?>
<?php $sectionName = get_post_field('post_name'); ?>
<div class="section <?php echo $sectionName ?>" id="<?php echo $sectionName; ?>">
	<?php 
		if (locate_template('section-' . $sectionName . '.php') != '') {
		    get_template_part('section', $sectionName);
		} else {
		    the_content();
		}
	?>
</div>