<?php
/**
 * Template Name: Events Section
 *
 * @package _bctheme
 */

	$args = [
		'post_type' => 'bc_events',
		'orderby' => 'meta_value_num',
		'meta_key' => 'bc_events_startdate',
		'order' => 'ASC',
		'posts_per_page' => -1,
		'meta_query' => [
			'key' => 'bc_events_enddate',
			'value' => strtotime( 'yesterday' ),
			'type' => 'numeric',
			'compare' => '>=',
		],
	];
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();

			//Get event date/time and url
			$custom = get_post_custom( get_the_ID() );
			$st = $custom['bc_events_startdate'][0];
			$et = $custom['bc_events_enddate'][0];
			$url = $custom['bc_events_url'][0];

			//Format date/time
			$date = date( 'l, F j', $st );
			$format = get_option( 'time_format' );
			$starttime = date( $format, $st );
			$endtime = date( $format, $et );

			//Output event
			?>
			<div class="event">
				<h3 class="event-date"><?php echo esc_html( $date ); ?></h3>
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="event-thumbnail-container">
						<?php the_post_thumbnail( 'thumbnail', [
							'class' => 'event-thumbnail',
						] ); ?>
					</div>
				<?php } ?>
				<div class="event-info">
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="event-thumbnail-container">
							<?php the_post_thumbnail( 'thumbnail', [
								'class' => 'event-thumbnail',
							] ); ?>
						</div>
					<?php }
if ( empty( $url ) ) {
	the_title( '<h4 class="event-title">', '</h4>' );
} else {
	?>
	<a href="<?php echo esc_attr( $url ); ?>" target="_blank">
<?php the_title( '<h4 class="event-title">', '</h4>' );?>
	</a>
<?php } ?>
					<h5 class="event-time"><?php echo esc_html( "$starttime &mdash; $endtime" ); ?></h5>
					<?php
					the_content();
					if ( !empty( $url ) ) {
						?>
						<a href="<?php echo esc_attr( $url ); ?>" class="events-more" target="_blank">Learn more &rarr;</a>
					<?php } ?>
				</div>
			</div>
		<?php
		}
	} else {
		//If no events, display page
		$page = get_page_by_title( 'No Events' );
		$content = apply_filters( 'the_content', $page->post_content );
		echo $content;
	}
