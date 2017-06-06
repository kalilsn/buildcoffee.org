<?php
/**
 * Events custom post type setup
 **/

add_action( 'admin_init', 'events_admin_css' );

function events_admin_css() {
	wp_enqueue_style( 'events-admin-css', get_bloginfo( 'template_directory' ) . '/events-admin.css' );
}

add_image_size( 'admin', 60, 60 );

//Register event post type
add_action( 'init', 'create_event_post_type' );

function create_event_post_type() {
	$labels = [
		'name' => 'Events',
		'singular_name' => 'Event',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Event',
		'edit_item' => 'Edit Event',
		'new_item' => 'New Event',
		'view_item' => 'View Event',
		'search_items' => 'Search Events',
		'not_found' => 'No events found',
		'not_found_in_trash' => 'No events found in Trash',
	];

	$args = [
		'labels' => $labels,
		'public' => true,
		'menu_icon' => 'dashicons-calendar-alt',
		'rewrite' => [
			'slug' => 'events',
		],
		'supports' => [ 'title', 'thumbnail', 'excerpt', 'editor' ],
		'taxonomies' => [ 'post_tag' ],
		'has_archive' => true,
	];

	register_post_type( 'event', $args );
}

//Create columns for events in dashboard
add_filter( 'manage_edit-event_columns', 'events_edit_columns' );
add_action( 'manage_posts_custom_column', 'events_custom_columns' );

function events_edit_columns( $columns ) {
	$columns = [
		'cb' => '<input type="checkbox" />',
		'event_date' => 'Date',
		'time' => 'Time',
		'thumbnail' => 'Thumbnail',
		'title' => 'Event',
		'description' => 'Description',
		'tags' => 'Tags',
	];

	return $columns;
}

function events_custom_columns( $column ) {
	global $post;
	$meta = get_post_custom();

	switch ( $column ) {
		//Show event date
		case 'event_date':
			$start_date = date( 'F j, Y', $meta['event_start_time'][0] );
			$end_date = date( 'F j, Y', $meta['event_end_time'][0] );
			echo $start_date . ( $end_date  === $start_date ? '' : " &mdash; $end_date" );
		break;

		//Show event time
		case 'time':
			$time_format = get_option( 'time_format' );
			$start_time = date( $time_format, $meta['event_start_time'][0] );
			$end_time = date( $time_format, $meta['event_end_time'][0] );
			echo $start_time . ' - ' . $end_time;
		break;

		//Show event thumbnail image
		case 'thumbnail':
			the_post_thumbnail( 'admin' );
		break;

		//Show event description
		case 'description':
			the_excerpt();
		break;
	}
}


//Meta box

add_action( 'admin_init', 'event_create' );

function event_create() {
	add_meta_box( 'event_meta', 'Events', 'event_meta', 'event' );
}

function event_meta() {
	global $post;
	$meta = get_post_custom( $post->ID );
	$start_time = $meta['event_start_time'][0];
	$end_time = $meta['event_end_time'][0];
	$start_date = $start_time;
	$end_date = $end_time;
	$url = $meta['event_url'][0];

	// Get user's time format
	$time_format = get_option( 'time_format' );

	// Default start/end times and dates
	if ( empty( $start_time ) ) {
		$start_date = $end_date = time();
		$start_time = $end_time = 0;
	}

	// Format dates/times
	// Dates and times are both stored as unix timestamps, so they're not actually different
	$start_date = date( 'D, M d, Y', $start_date );
	$end_date = date( 'D, M d, Y', $end_date );
	$start_time = date( $time_format, $start_time );
	$end_time = date( $time_format, $end_time );

	?>
	<div class="event-meta">
		<ul>
			<li><label>External URL</label><input name="event_url" class="event-url" value="<?php echo esc_url( $url ); ?>" /></li>
			<li><label>Start Date</label><input name="event_start_date" class="event-date" value="<?php echo $start_date; ?>" /></li>
			<li><label>Start Time</label><input name="event_start_time" value="<?php echo $start_time; ?>" /></li>
			<li><label>End Date</label><input name="event_end_date" class="event-date" value="<?php echo $end_date; ?>" /></li>
			<li><label>End Time</label><input name="event_end_time" value="<?php echo $end_time; ?>" /></li>
		</ul>
		<input type="hidden" name="event-nonce" id="event-nonce" value="<?php echo wp_create_nonce( 'event-nonce-' . $post->ID ); ?>" />
	</div>
	<?php
}


//Save post after editing
add_action( 'save_post', 'save_event' );

function save_event() {

	global $post;
	$nonce_id = 'event-nonce-' . $post->ID;
	if ( !isset( $_POST[ 'event-nonce' ] ) || !wp_verify_nonce( $_POST[ 'event-nonce' ], $nonce_id ) ) {
		return $post->ID;
	}

	//Verify user privileges
	if ( !current_user_can( 'edit_post', $post->ID ) ) {
		return $post->ID;
	}

	//Update post
	if ( !isset( $_POST['event_start_date'] ) ) {
		return $post;
	}

	$update_start_date = strtotime( $_POST['event_start_date'] . $_POST['event_start_time'] );
	update_post_meta( $post->ID, 'event_start_time', $update_start_date );

	if ( !isset( $_POST['event_end_date'] ) ) {
		return $post;
	}
	$update_end_time = strtotime( $_POST['event_end_date'] . $_POST['event_end_time'] );
	update_post_meta( $post->ID, 'event_end_time', $update_end_time );

	update_post_meta( $post->ID, 'event_url', esc_url_raw( $_POST['event_url'] ) );
}

//Customize update messages
add_filter( 'post_updated_messages', 'event_updated_messages' );

function event_updated_messages( $messages ) {

	global $post, $post_id;

	$messages['event'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( 'Event updated. <a href="%s">View item</a>', esc_url( get_permalink( $post_id ) ) ),
		2 => 'Custom field updated.',
		3 => 'Custom field deleted.',
		4 => 'Event updated.',
		5 => isset( $_GET['revision'] ) ? sprintf( 'Event restored to revision from %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( 'Event published. <a href="%s">View event</a>', esc_url( get_permalink( $post_id ) ) ),
		7 => 'Event saved.',
		8 => sprintf( 'Event submitted. <a target="_blank" href="%s">Preview event</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_id ) ) ) ),
		9 => sprintf( 'Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview event</a>',
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_id ) ) ),
		10 => sprintf( 'Event draft updated. <a target="_blank" href="%s">Preview event</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_id ) ) ) ),
	];

	return $messages;
}


function event_styles() {
	global $post_type;
	if ( $post_type !== 'event' ) {
		return;
	}
	wp_enqueue_style( 'ui-datepicker', 'https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css' );
}

function event_scripts() {
	global $post_type;
	if ( $post_type !== 'event' ) {
		return;
	}
	wp_enqueue_script( 'jquery-ui-datepicker' );
	wp_enqueue_script( 'custom_script', get_bloginfo( 'template_url' ) . '/events-admin.js', [ 'jquery' ] );
}

add_action( 'admin_print_styles-post.php', 'event_styles', 1000 );
add_action( 'admin_print_styles-post-new.php', 'event_styles', 1000 );

add_action( 'admin_print_scripts-post.php', 'event_scripts', 1000 );
add_action( 'admin_print_scripts-post-new.php', 'event_scripts', 1000 );
?>
