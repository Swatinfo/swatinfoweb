<?php


// Autoload PHPMailer
require 'vendor/autoload.php';

// echo dirname(__DIR__, 1);

use Dotenv\Dotenv;

// Load environment variables
$dotenv = Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->load();
$reCAPTCHA_site_key = $_ENV['RECAPTCHA_SITE_KEY'];
?>
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $reCAPTCHA_site_key; ?>"></script>
<script>
    grecaptcha.ready(function() {
        grecaptcha.execute(<?php echo $reCAPTCHA_site_key; ?>, {
            action: 'mail.php'
        }).then(function(token) {
            document.getElementById('g-recaptcha-response').value = token;
        });
    });
</script>

<!-- Footer Template -->
<footer>
    <div class="container">
        <div class="footer-container">
            <div class="footer-col">
                <h3>About Swat Info System</h3>
                <p style="color: var(--gray); margin-bottom: 20px;">We are a leading IT services provider dedicated to helping businesses leverage technology for growth and success.</p>
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