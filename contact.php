<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Get in touch with Swat Info System for all your IT service needs. Contact us for inquiries about web development, mobile apps, digital marketing, and custom software solutions.">
    <meta name="keywords" content="contact, IT services, get in touch, tech support, software development contact">
    <title>Contact Us | Swat Info System</title>
    <link rel="stylesheet" href="css/styles.css">

    <link rel="stylesheet" href="css/custom.css">

</head>

<body>
    <!-- Header Include -->
    <?php include('includes/header_menu.php'); ?>

    <section class="page-banner">
        <div class="container">
            <h1>Contact Us</h1>
            <p>Get in touch with our team for any inquiries or support needs</p>
        </div>
    </section>

    <div class="breadcrumbs">
        <div class="container breadcrumbs-container">
            <a href="">Home</a>
            <span class="separator">/</span>
            <span class="current">Contact</span>
        </div>
    </div>

    <section class="contact-section">
        <div class="container contact-grid">
            <div class="contact-info">
                <h3>We'd Love to Hear From You</h3>
                <p>Whether you have a question about our services, need a custom quote, or want to discuss your project, our team is ready to assist you. Reach out to us through any of the following channels:</p>

                <div class="contact-details">
                    <div class="contact-item">
                        <div class="contact-icon">📍</div>
                        <div class="contact-text">
                            <h4>Our Location</h4>
                            <p>123 Tech Street, Silicon Valley<br>CA 94000, United States</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">📞</div>
                        <div class="contact-text">
                            <h4>Phone Number</h4>
                            <p>+1 (555) 123-4567</p>
                            <p>Monday - Friday: 9:00 AM - 6:00 PM</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">✉️</div>
                        <div class="contact-text">
                            <h4>Email Address</h4>
                            <p>info@swatinfosystem.com</p>
                            <p>sales@swatinfosystem.com</p>
                        </div>
                    </div>
                </div>

                <div class="social-links">
                    <h4>Connect With Us</h4>
                    <div class="social-icons-large">
                        <a href="#" class="social-icon-large">f</a>
                        <a href="#" class="social-icon-large">in</a>
                        <a href="#" class="social-icon-large">tw</a>
                        <a href="#" class="social-icon-large">ig</a>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <h3>Send Us a Message</h3>
                <form id="contactForm" name="contactForm"  method="post" action="mail.php">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea id="message" name="message" class="form-control" required></textarea>
                    </div>

                    <button type="submit" class="submit-button validateFormData">Send Message</button>

                    <p class="form-note">We'll get back to you within 24 hours.</p>
                </form>
            </div>
        </div>
    </section>

    <section class="map-section">
        <div class="container">
            <div class="section-header">
                <h2>Our Location</h2>
                <p>Find us at our headquarters in Silicon Valley</p>
            </div>
            <div class="map-container">
                <!-- Replace with actual map embed code -->
                <div style="width:100%; height:100%; background-color:#ddd; display:flex; align-items:center; justify-content:center;">
                    <p style="font-weight:bold;">Google Maps Embed</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Include -->
    <!-- <div w3-include-html="/includes/footer.html"></div> -->
    <?php include('includes/footer.php'); ?>

    <!-- Scripts -->
    <script src="js/include-helper.js"></script>
    <!-- <script src="js/scripts.js"></script> -->
    <script src="js/main.js"></script>
</body>

</html>