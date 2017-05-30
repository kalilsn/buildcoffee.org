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
	<div class="credit">This site was created by Kalil Smith-Nuevelle and Bea Malsky<a href="<?php echo wp_login_url(); ?>" tabindex="-1">.</a></div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
