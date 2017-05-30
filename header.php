<?php
/**
 * The Header for the homepage.
 *
 * @package _bctheme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php $base_url = get_template_directory_uri(); ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $base_url ?>/assets/images/icons/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="<?php echo $base_url ?>/assets/images/icons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php echo $base_url ?>/assets/images/icons/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="<?php echo $base_url ?>/assets/images/icons/manifest.json">
	<link rel="mask-icon" href="<?php echo $base_url ?>/assets/images/icons/safari-pinned-tab.svg" color="#000000">
	<link rel="shortcut icon" href="<?php echo $base_url ?>/assets/images/icons/favicon.ico">
	<meta name="msapplication-config" content="<?php echo $base_url ?>/assets/images/icons/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
	<?php wp_head(); ?>
	<script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>

<body>
<!--[if lt IE 9]>
	<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
