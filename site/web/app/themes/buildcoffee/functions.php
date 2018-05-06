<?php
/**
 * _bctheme functions and definitions
 *
 * @package _bctheme
 */

/****************************************
Theme Setup
*****************************************/

/**
 * Theme initialization
 */
require_once get_template_directory() . '/lib/init.php';

/**
 * Custom theme functions definited in /lib/init.php
 */
require_once get_template_directory() . '/lib/theme-functions.php';

/**
 * Helper functions for use in other areas of the theme
 */
require_once get_template_directory() . '/lib/theme-helpers.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require_once get_template_directory() . '/lib/inc/extras.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/lib/inc/customizer.php';

/****************************************
Misc Theme Functions
*****************************************/

/**
 * Filter Yoast SEO Metabox Priority
 */
add_filter( 'wpseo_metabox_prio', 'bc_filter_yoast_seo_metabox' );
function bc_filter_yoast_seo_metabox() {
	return 'low';
}


//Convert all links in menu from eg. /about/ to /#about
add_filter( 'nav_menu_link_attributes', 'scrolling_nav_links', 10, 3 );
function scrolling_nav_links( $atts, $item, $args ) {
	$anchor = '#' . strtolower( $item->title );
	$atts['href'] = $anchor;
	return $atts;
}


//Remove unnecessary classes and ids from nav menu
// https://wordpress.stackexchange.com/questions/12784/wp-nav-menu-remove-class-and-id-from-li
add_filter( 'nav_menu_item_id', 'clear_nav_menu_item_id', 10, 3 );
function clear_nav_menu_item_id( $id, $item, $args ) {
	return '';
}

add_filter( 'nav_menu_css_class', 'clear_nav_menu_item_class', 10, 3 );
function clear_nav_menu_item_class( $classes, $item, $args ) {
	return [];
}

//Hide admin bar
add_filter( 'show_admin_bar', '__return_false' );

require_once get_template_directory() . '/events.php';

//Hide/rename menu items
function customize_menus() {
	remove_menu_page( 'edit.php' ); //Posts
	remove_menu_page( 'edit-comments.php' ); //Comments

	global $menu;
	global $submenu;

}

add_action( 'admin_menu', 'customize_menus' );

//Image setup
add_image_size( 'admin', '60', '60', false );
add_image_size( 'small', '300', '300', false );
add_image_size( 'medium-small', '500', '500', false );
add_image_size( 'medium-ish', '1024', '1024', false );
add_image_size( 'medium-large', '1280', '1280', false );
add_image_size( 'huge', '2560', '2560', false );

function increase_max_srcset_image_width( $max_width ) {
	return 2560;
}

add_filter( 'max_srcset_image_width', 'increase_max_srcset_image_width' );

//Lower excerpt length
function custom_excerpt_length( $length ) {
	return 15;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


//Contact form handler

add_action( 'wp_ajax_send_contact_email', 'send_contact_email' );
add_action( 'wp_ajax_nopriv_send_contact_email', 'send_contact_email' );

function send_contact_email() {

	if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
		$name = filter_var( preg_replace( '/\s+/', ' ', trim( $_POST['name'] ) ), FILTER_SANITIZE_STRING );
		$email = !empty( $_POST['email'] ) ? filter_var( trim( $_POST['email'] ), FILTER_SANITIZE_EMAIL ) : null;
		$message = filter_var( trim( $_POST['message'] ), FILTER_SANITIZE_STRING );

		# Recaptcha verification
		$content = [
			'secret' => '6Lf1xQgUAAAAABRD04M61uerCod3xW9jp-RfKlgV',
			'response' => $_POST['g-recaptcha-response'],
			'remoteip' => $_SERVER['REMOTE_ADDR'],
		];

		$url = 'https://www.google.com/recaptcha/api/siteverify';

		$opts = [
			'http' => [
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query( $content ),
			],
		];

		$context = stream_context_create( $opts );
		$response = file_get_contents( $url, false, $context );
		$captcha = json_decode( $response )->success;

		if ( empty( $name )
			|| empty( $message )
			|| ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) && isset( $email ) )
			|| !$captcha
		) {
			http_response_code( 400 );
			echo "Looks like something wasn't quite right. Make sure you use a valid email address and fill in all the required fields!";
		}

		$to = 'beamalsky@gmail.com, hannahnyhart@gmail.com';
		$subject = "buildcoffee.org | Contact form message from $name";
		$message = "$message\n --$name <$email>";

		$email_headers = !empty( $email ) ? "Reply-to: $name <$email>" : '';

		if ( wp_mail( $to, $subject, $message, $email_headers ) ) {
			http_response_code( 200 );
			echo "Thanks for getting in touch! We'll get back to you as soon as possible.";
		} else {
			http_response_code( 500 );
			echo 'Something went wrong. Please try again or send us an email.';
		}
	} else {
		http_response_code( 403 );
		echo "That's not what this is for.";
	}
	wp_die();
}

function add_tags_to_attachments() {
	register_taxonomy_for_object_type( 'post_tag', 'attachment' );
}
add_action( 'init' , 'add_tags_to_attachments' );

function deregister_scripts() {
	wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'deregister_scripts' );

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
