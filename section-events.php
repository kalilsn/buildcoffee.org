<?php
/**
 * Template Name: Events Section
 *
 * @package _bctheme
 */
?>

<?php 
    $args = array(
        "post_type" => "bc_events", 
        "orderby" => "meta_value_num", 
        "meta_key" => "bc_events_startdate", 
        "order" => "ASC", 
        "posts_per_page" => -1,
        "meta_query" => array("key" => "bc_events_enddate", "value" => strtotime("yesterday"), "type" => "numeric", "compare" => ">=")
    );
    $query = new WP_Query($args);
    while ($query->have_posts()) {
        $query->the_post();
        the_title();
        the_post_thumbnail();
        echo '<div class="event-description">';
        the_content();
        echo "</div><hr>";
    }
?>