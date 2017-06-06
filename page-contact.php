<?php
/**
 * Template Name: Events Section
 *
 * @package _bctheme
 */
the_content();
?>
<div class="contact-form-wrapper">
	<div class="response"></div>
	<form id="contact-form" data-url="<?php echo admin_url( 'admin-ajax.php' ) ?>">
		<input type="hidden" name="action" value="send_contact_email">
		<label for="name">Name:</label><input type="text" id="name" name="name" required>
		<label for="email">Email address:</label><input type="email" id="email" name="email">
		<label for="message">Message:</label><textarea name="message" id="msg" required></textarea>
		<div class="g-recaptcha" data-sitekey="6Lf1xQgUAAAAAJTRQoSAA6oMTcoH-ZVW4hEnMG2S" data-callback="recaptchaCallback"></div>
		<button type="submit">Send</button>
	</form>
</div>
