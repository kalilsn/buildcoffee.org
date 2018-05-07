<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package _bctheme
 */
?>

<footer <?php echo is_home() ? '' : 'class="footer-alternate"'; ?>>
	<div class="credit">This site was created by Kalil Smith-Nuevelle and <a href="https://beamalsky.fyi/">Bea Malsky</a><a href="<?php echo wp_login_url(); ?>" tabindex="-1">.</a> Photos by <a href="http://www.alexjungtcs.com/">Alex Jung.</a></div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php wp_footer(); ?>
<script src='<?php echo get_template_directory_uri(); ?>/assets/js/vendor/webfontloader/webfontloader.min.js' async defer></script>
<script src='https://www.google.com/recaptcha/api.js' async defer></script>
</body>
</html>
