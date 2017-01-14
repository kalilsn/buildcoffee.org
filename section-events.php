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
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            //Get event date/time and url
            $custom = get_post_custom(get_the_ID());
            $st = $custom["bc_events_startdate"][0];
            $et = $custom["bc_events_enddate"][0];
            $url = $custom["bc_events_url"][0];
            
            //Format date/time
            $date = date("l, F j", $st);
            $format = get_option('time_format');
            $starttime = date($format, $st);
            $endtime = date($format, $et);

            //Output event
            echo "<div class=\"event\"><h3 class=\"event-date\">$date</h3>";
            if (has_post_thumbnail()) {
                echo '<div class="event-thumbnail-container">';
                the_post_thumbnail("thumbnail", array("class" => "event-thumbnail"));
                echo '</div>';
            }
            echo '<div class="event-info">';
            if (empty($url)) {
                the_title("<h4 class=\"event-title\">", "</h4>");
            }
            else {
                the_title("<a href=\"$url\" target=\"_blank\"><h4 class=\"event-title\">", "</h4></a>");    
            }
            echo "<h5 class=\"event-time\">$starttime &mdash; $endtime</h5>";
            the_content();
            if (!empty($url)) {
                echo "<a href=\"$url\" class=\"events-more\" target=\"_blank\">Learn more &rarr;</a>";
            }
            echo "</div></div>";
        }
    }
?>