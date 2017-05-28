<?php
/**
 * Events custom post type setup
 **/

add_action('admin_init', 'bc_functions_css');

function bc_functions_css() {
    wp_enqueue_style('bc-events-functions-css', get_bloginfo('template_directory') . '/bc-events-functions.css');
}

add_image_size('admin', 60, 60);

//Register event post type
add_action('init', 'create_event_post_type');

function create_event_post_type() {
    $labels = array(
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
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'rewrite' => array( "slug" => "events" ),
        'supports'=> array('title', 'thumbnail', 'excerpt', 'editor'),
    );

    register_post_type('bc_events', $args);
}

//Create columns for events in dashboard
add_filter("manage_edit-bc_events_columns", "bc_events_edit_columns");
add_action("manage_posts_custom_column", "bc_events_custom_columns");

function bc_events_edit_columns($columns) {
    $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "bc_col_ev_date" => "Date",
    "bc_col_ev_time" => "Time",
    "bc_col_ev_thumb" => "Thumbnail",
    "title" => "Event",
    "bc_col_ev_desc" => "Description",
    );

    return $columns;
}

function bc_events_custom_columns($column) {
    global $post;
    $custom = get_post_custom();
    
    switch($column) {
        //Show event date
        case "bc_col_ev_date":
            $startd = $custom["bc_events_startdate"][0];
            $endd = $custom["bc_events_enddate"][0];
            $startdate = date("F j, Y", $startd);
            $enddate = date("F j, Y", $endd);
            echo $startdate . '<br /><em>' . $enddate . '</em>';
        break;

        //Show event time
        case "bc_col_ev_time":
            $startt = $custom["bc_events_startdate"][0];
            $endt = $custom["bc_events_enddate"][0];
            $time_format = get_option('time_format');
            $starttime = date($time_format, $startt);
            $endtime = date($time_format, $endt);
            echo $starttime . ' - ' .$endtime;
        break;

        //Show event thumbnail image
        case "bc_col_ev_thumb":
            the_post_thumbnail('admin');
        break;

        //Show event description
        case "bc_col_ev_desc":
            the_excerpt();
        break;
    }
}


//Meta box

add_action('admin_init', 'bc_events_create');

function bc_events_create() {
    add_meta_box('bc_events_meta', 'Events', 'bc_events_meta', 'bc_events');
}

function bc_events_meta() {
    global $post;
    $custom = get_post_custom($post->ID);
    $meta_sd = $custom["bc_events_startdate"][0];
    $meta_ed = $custom["bc_events_enddate"][0];
    $meta_st = $meta_sd;
    $meta_et = $meta_ed;
    $meta_url = $custom["bc_events_url"][0];

    //Get user's time format
    $time_format = get_option('time_format');

    //Default start/end times and dates
    if ($meta_sd == null) {
        $meta_sd = time(); 
        $meta_ed = $meta_sd; 
        $meta_st = 0; 
        $meta_et = 0;
    }

    //Format dates/times
    $clean_sd = date("D, M d, Y", $meta_sd);
    $clean_ed = date("D, M d, Y", $meta_ed);
    $clean_st = date($time_format, $meta_st);
    $clean_et = date($time_format, $meta_et);

    echo '<input type="hidden" name="bc-events-nonce" id="bc-events-nonce" value="' .
    wp_create_nonce( 'bc-events-nonce' ) . '" />';

    ?>
    <div class="bc-meta">
        <ul>
            <li><label>External URL</label><input class="bcurl" name="bc_events_url" value="<?php echo $meta_url; ?>" /></li>
            <li><label>Start Date</label><input name="bc_events_startdate" class="bcdate" value="<?php echo $clean_sd; ?>" /></li>
            <li><label>Start Time</label><input name="bc_events_starttime" value="<?php echo $clean_st; ?>" /></li>
            <li><label>End Date</label><input name="bc_events_enddate" class="bcdate" value="<?php echo $clean_ed; ?>" /></li>
            <li><label>End Time</label><input name="bc_events_endtime" value="<?php echo $clean_et; ?>" /></li>
        </ul>
    </div>
    <?php 
}


//Save post after editing
add_action ('save_post', 'save_bc_events');
 
function save_bc_events() {
 
    global $post;
     
    if (isset($_POST['bc-events-nonce']) && !wp_verify_nonce($_POST['bc-events-nonce'], 'bc-events-nonce')) {
        return $post->ID;
    }
     
    //Verify user privileges
    if (!current_user_can('edit_post', $post->ID)){
        return $post->ID;
    }
     
    //Update post
    if (!isset($_POST['bc_events_startdate'])) {
        return $post;
    }

    $updatestartd = strtotime($_POST["bc_events_startdate"] . $_POST["bc_events_starttime"]);
    update_post_meta($post->ID, "bc_events_startdate", $updatestartd );
     
    if (!isset($_POST["bc_events_enddate"])) {
        return $post;
    }
    $updateendd = strtotime ( $_POST["bc_events_enddate"] . $_POST["bc_events_endtime"]);
    update_post_meta($post->ID, "bc_events_enddate", $updateendd);

    update_post_meta($post->ID, "bc_events_url", $_POST["bc_events_url"]); 
}

//Customize update messages
add_filter('post_updated_messages', 'events_updated_messages');
 
function events_updated_messages($messages) {
 
    global $post, $post_ID;

    $messages['bc_events'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => sprintf( 'Event updated. <a href="%s">View item</a>', esc_url( get_permalink($post_ID) ) ),
        2 => 'Custom field updated.',
        3 => 'Custom field deleted.',
        4 => 'Event updated.',
        5 => isset($_GET['revision']) ? sprintf( 'Event restored to revision from %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( 'Event published. <a href="%s">View event</a>', esc_url( get_permalink($post_ID) ) ),
        7 => 'Event saved.',
        8 => sprintf( 'Event submitted. <a target="_blank" href="%s">Preview event</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( 'Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview event</a>',
          date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( 'Event draft updated. <a target="_blank" href="%s">Preview event</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    );
     
    return $messages;
}


function events_styles() {
    global $post_type;
    if ('bc_events' != $post_type) {
        return;
    }
    wp_enqueue_style('ui-datepicker', 'https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css');
}

function events_scripts() {
    global $post_type;
    if( 'bc_events' != $post_type )
        return;
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_script('custom_script', get_bloginfo('template_url').'/bc-events-admin.js', array('jquery'));
}
 
add_action( 'admin_print_styles-post.php', 'events_styles', 1000 );
add_action( 'admin_print_styles-post-new.php', 'events_styles', 1000 );
 
add_action( 'admin_print_scripts-post.php', 'events_scripts', 1000 );
add_action( 'admin_print_scripts-post-new.php', 'events_scripts', 1000 );
?>
