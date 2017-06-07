<?php
//Get event date/time and url
$meta = get_post_custom( get_the_ID() );
$external_url = $meta['event_url'][0];
$permalink = get_permalink();
$format = get_option( 'time_format' );

//Format date/time
$start_date = date( 'l, F j', $meta['event_start_time'][0] );
$start_time = date( $format, $meta['event_start_time'][0] );
$end_date = date( 'l, F j', $meta['event_end_time'][0] );
$end_time = date( $format, $meta['event_end_time'][0] );


//Output event

if ( !function_exists( 'permalink' ) ) {
	function permalink($contents, $permalink, $mobile=false) {
		$mobile = $mobile ? 'mobile' : '';
		if ( !is_single() ) {
			?>
			<a class="permalink alternate-link <?php echo $mobile; ?>" href="<?php echo esc_url( $permalink ); ?>"><?php echo $contents ?></a>
			<?php
		} elseif ( $contents !== 'Permalink' ) {
			echo $contents;
		}
	}
}

$date = $start_date === $end_date ? $start_date : "$start_date &mdash; $end_date";

?>
<div class="event">
	<h3 class="event-date"><?php echo esc_html( $date ); ?></h3>
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="event-thumbnail-container">
			<?php the_post_thumbnail( 'thumbnail', [
				'class' => 'event-thumbnail',
			] ); ?>
			<?php permalink( 'Permalink', $permalink ); ?>
		</div>
	<?php } ?>
	<div class="event-info">
		<?php
		if ( has_post_thumbnail() ) { ?>
			<div class="event-thumbnail-container">
				<?php
				the_post_thumbnail( 'thumbnail', [
					'class' => 'event-thumbnail',
				] );
				?>
			</div>
		<?php
		}
		permalink( '<h4 class="event-title">' . get_the_title() . '</h4>', $permalink );
		if ( $start_date === $end_date ) {
			?>
			<h5 class="event-time"><?php echo esc_html( "$start_time &mdash; $end_time" ); ?></h5>
			<?php
		}
		the_content();
		if ( !empty( $external_url ) ) {
			?>
			<a href="<?php echo esc_url( $external_url ); ?>" class="events-more" target="_blank">Learn more &rarr;</a>
		<?php } ?>
		<br>
		<?php permalink( 'Permalink', $permalink, true ); ?>
	</div>
</div>
