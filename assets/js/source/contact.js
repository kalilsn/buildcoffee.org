/*
 * AJAX contact form
 */

(function($) {
    var responseDiv = $('.contact .response');
    var contactForm = $('.contact form');
    contactForm.submit(function(e) {
        e.preventDefault();

        var data = contactForm.serialize();

        $.ajax({
            type: 'POST',
            url: contactForm.data('url'),
            data: data,
            error: onFormError,
            success: onFormSuccess
        });
    });

    function onFormSuccess(data) {
            responseDiv.removeClass('error');
            contactForm.hide();
            responseDiv.text(data);
        }

    function onFormError(data) {
            responseDiv.addClass('error');
            var response = data.responseText;
            if (response.responseText !== '') {
                responseDiv.text(response);
            } else {
                responseDiv.text("An error occurred. Please try again or send us an email.");
            }
    }

})(jQuery);

//Google recaptcha setup
function recaptchaCallback() {
    jQuery('.g-recaptcha').hide();
    jQuery('.contact button[type="submit"]').show();
}
