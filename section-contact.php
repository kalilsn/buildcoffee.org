<?php
/**
 * Template Name: Events Section
 *
 * @package _bctheme
 */
?>
<div class="contact-form-wrapper">
    <form id="contact-form" action="contact.php" method="post">
        <label for="name">Name:</label><input type="text" id="name" name="name" pattern="[a-zA-Z0-9 ]+" required>
        <label for="email">Email address:</label><input type="email" id="email" name="email">
        <label for="message">Message:</label><textarea name="message" id="msg" required></textarea>
        <div class="g-recaptcha" data-sitekey="6Lf1xQgUAAAAAJTRQoSAA6oMTcoH-ZVW4hEnMG2S" data-callback="recaptchaCallback"></div>
        <button type="submit">Send</button>
    </form>
</div>