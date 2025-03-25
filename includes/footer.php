<?php


//Autoload PHPMailer
require 'vendor/autoload.php';

// echo dirname(__DIR__, 1);

use Dotenv\Dotenv;

// Load environment variables
$dotenv = Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->load();
$reCAPTCHA_site_key = $_ENV['RECAPTCHA_SITE_KEY'];
?>
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $reCAPTCHA_site_key; ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const submitForm = document.querySelector('.validateFormData');
    if (submitForm) {

        const firstForm = document.querySelector('form');
        const formId = firstForm.getAttribute('id');

        const formSubmitURL = firstForm.getAttribute('action');
        console.log("formSubmitURL: " + formSubmitURL);



        grecaptcha.ready(function(formSubmitURL) {
            grecaptcha.execute('<?php echo $reCAPTCHA_site_key; ?>', {
                    action: formSubmitURL
                })
                .then(function(token) {
                    // console.log(token)
                    document.getElementById('gRecaptchaResponse').value = token;
                });
        });
        submitForm.addEventListener('click', function(e) {

            var formType = document.getElementById('form_type').value;
            if (formType == "contact") {
                console.log(formType);
            } else if (formType == "quote") {
                console.log(formType);
            }
            // console.log("came here to submit form" + formId);
            if (validateForm(formId)) {
                e.preventDefault();
                // getRecaptchaToken(firstForm, formSubmitURL)

                console.log("form is valid");

                const form = document.getElementById(formId);
                if (!form) return;



                // Show loading state
                const submitButton = form.querySelector('[type="submit"]');
                const originalButtonText = submitButton.innerHTML;
                submitButton.innerHTML = 'Sending...';
                submitButton.disabled = true;

                // Prepare form data
                const formData = new FormData(form);
                var frm = $('#' + formId);
                // console.log(frm.serialize());

                $.ajax({
                    type: frm.attr('method'),
                    url: frm.attr('action'),
                    data: frm.serialize(),
                    dataType: "json",
                    // contentType: "application/json",
                    success: function(data) {


                        // data = JSON.parse(data);
                        var dataObject = jQuery.parseJSON(JSON.stringify(data));

                        console.log(dataObject);
                        if (dataObject.status == "error") {
                            $('.error-message-text').html(dataObject.message);
                            console.log(dataObject.message);
                            submitButton.innerHTML = originalButtonText;
                            submitButton.disabled = false;
                            return false;
                        } else {
                            window.location.href = dataObject.redirect;
                        }
                        return false;
                    },
                    error: function(xhr, textStatus, data) {

                        console.log(xhr.statusText);
                        console.log(textStatus);
                        console.log(data.responseText);
                        // data = JSON.parse(data);
                        if (formType == "contact") {
                            console.log(formType);
                            submitButton.innerHTML = 'Send Message';

                        } else if (formType == "quote") {
                            console.log(formType);
                            submitButton.innerHTML = 'Submit Quote Request';

                        }
                        submitButton.disabled = false;

                    },
                });
            } else {
                e.preventDefault();
                console.log("form is invalid");
            }
        })
    } else {
        console.log('No form found');
    }
</script>

<!-- Footer Template -->
<footer>
    <div class="container">
        <div class="footer-container">
            <div class="footer-col">
                <h3>About Swat Info System</h3>
                <p style="color: var(--gray-dark); margin-bottom: 20px;">We are a leading IT services provider dedicated to helping businesses leverage technology for growth and success.</p>
                <div class="social-icons">
                    <a href="#" class="social-icon">f</a>
                    <a href="#" class="social-icon">in</a>
                    <a href="#" class="social-icon">t</a>
                    <a href="#" class="social-icon">ig</a>
                </div>
            </div>
            <div class="footer-col">
                <h3>Services</h3>
                <ul>
                    <li><a href="website_development">Website Development</a></li>
                    <li><a href="webapp_development">Web App Development</a></li>
                    <li><a href="mobile_app_development">Mobile App Development</a></li>
                    <li><a href="digital_marketing">Digital Marketing</a></li>
                    <li><a href="ux_ui">UX/UI Design</a></li>
                    <li><a href="desktop_application">Desktop Applications</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Solutions</h3>
                <ul>
                    <li><a href="automobile">Automobile</a></li>
                    <li><a href="business">Business</a></li>
                    <li><a href="education">Education</a></li>
                    <li><a href="tours_travel">Tours & Travel</a></li>
                    <li><a href="real_estate">Real Estate</a></li>
                    <li><a href="online_shopping">Online Shopping</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Contact Us</h3>
                <ul class="footer-contact">
                    <li>
                        <span>📍</span>
                        <span>302, Ornate One Silver Stone Main Road, 150 Feet Ring Road, behind Reliance Mall, Rajkot, Gujarat 360005</span>
                    </li>
                    <li>
                        <span>📞</span>
                        <span>+91 951-071-799</span>
                    </li>
                    <li>
                        <span>✉️</span>
                        <span>info@swatinfosystem.com</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; <?php echo date('Y'); ?> Swat Info System. All Rights Reserved.</p>
        </div>
    </div>
</footer>