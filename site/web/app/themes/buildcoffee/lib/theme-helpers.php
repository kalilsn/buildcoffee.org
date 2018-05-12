<?php
	/**
 * Helper functions for use in other areas of the theme
 *
 * @package _bctheme
 */

	/**
 * Add capabilities for a custom post type
 *
 * @return void
 */
function bc_add_capabilities( $posttype ) {
		// gets the author role
		$role = get_role( 'administrator' );

		// adds all capabilities for a given post type to the administrator role
		$role->add_cap( 'edit_' . $posttype . 's' );
		$role->add_cap( 'edit_others_' . $posttype . 's' );
		$role->add_cap( 'publish_' . $posttype . 's' );
		$role->add_cap( 'read_private_' . $posttype . 's' );
		$role->add_cap( 'delete_' . $posttype . 's' );
		$role->add_cap( 'delete_private_' . $posttype . 's' );
		$role->add_cap( 'delete_published_' . $posttype . 's' );
		$role->add_cap( 'delete_others_' . $posttype . 's' );
		$role->add_cap( 'edit_private_' . $posttype . 's' );
		$role->add_cap( 'edit_published_' . $posttype . 's' );
}

function bc_nav_menu() {
	$pages = get_pages(['parent' => 0, 'sort_column' => 'menu_order']);
	?>
	<ul id="nav" class="nav">
		<?php
		foreach ($pages as $page) {
			?>
			<li><a href="#<?php echo $page->post_name ?>"><?php echo $page->post_title ?></a></li>
			<?php
		}
		?>
	</ul>
	<?php
}
