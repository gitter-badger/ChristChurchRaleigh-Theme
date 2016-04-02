/* Contact Form */
(function($) {

    /* Ajax Contact Form */
    $contactForm = $('form[name="contact-form"]')
    $contactForm.submit(function(event) {

        // prevent the page from reloading
        event.preventDefault();

        // get the form data
        var formData = $(this).serialize();

        // submit the contact request
        var $sending = $('<div class="alert">Sending message...</div>');
        $contactForm.before($sending);
        $contactForm.slideUp();

        $.post(site_url, formData)
            .done(function(data) {
                // get the response message
                var $alert = $('.form .alert', data);
                $sending.html($alert.text());
            })
            .fail(function(data) {
                var response = data.responseText;
                var error = JSON.parse(response);
                $sending.html('An error has occurred. We are sorry about this inconvienence. Please call us instead.');
            });
    });

})(jQuery);
