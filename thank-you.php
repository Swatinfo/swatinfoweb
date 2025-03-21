<?php

/**
 * Thank You Page Template
 * 
 * This is a thank you page displayed after successful form submissions.
 * It shows different content based on the form type.
 */

// Get the form type from the query string
$formType = isset($_GET['type']) ? $_GET['type'] : 'default';

// Set page title and content based on form type
switch ($formType) {
    case 'contact':
        $title = "Thank You for Contacting Us";
        $message = "We have received your message and will get back to you as soon as possible, typically within 24 hours during business days.";
        $nextSteps = "In the meantime, feel free to explore our website to learn more about our services and solutions.";
        $buttonText = "Explore Our Services";
        $buttonLink = "service";
        break;

    case 'quote':
        $title = "Thank You for Your Quote Request";
        $message = "We have received your request and are excited about the possibility of working with you on your project.";
        $nextSteps = "Our team will review your requirements and prepare a detailed, customized quote for your project. You can expect to hear from us within 2 business days.";
        $buttonText = "View Our Portfolio";
        $buttonLink = "website_development"; // Assuming this links to a sample of your work
        break;

    default:
        $title = "Thank You for Your Submission";
        $message = "We have received your submission and will process it shortly.";
        $nextSteps = "We'll be in touch with you soon.";
        $buttonText = "Return to Home";
        $buttonLink = "index";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Thank you for contacting Swat Info System. We've received your message and will respond shortly.">
    <meta name="robots" content="noindex, nofollow">
    <title><?php echo $title; ?> | Swat Info System</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>
    <!-- Header Include -->
    <?php include('includes/header_menu.php'); ?>

    <section class="page-banner">
        <div class="container">
            <h1><?php echo $title; ?></h1>
            <p>We appreciate your interest in Swat Info System</p>
        </div>
    </section>

    <div class="breadcrumbs">
        <div class="container breadcrumbs-container">
            <a href="">Home</a>
            <span class="separator">/</span>
            <span class="current">Thank You</span>
        </div>
    </div>

    <section class="thank-you-section">
        <div class="container">
            <div class="thank-you-content">
                <div class="success-icon">✓</div>
                <h2>Submission Successful</h2>
                <p><?php echo $message; ?></p>

                <div class="next-steps-card">
                    <h3>Next Steps</h3>
                    <p><?php echo $nextSteps; ?></p>
                </div>

                <div class="contact-info-card">
                    <h3>Have Questions?</h3>
                    <p>If you need immediate assistance, please contact us directly:</p>
                    <ul class="contact-list">
                        <li><strong>Phone:</strong> +91 951-071-799</li>
                        <li><strong>Email:</strong> info@swatinfosystem.com</li>
                        <li>
                            <strong>Hours:</strong>
                            Monday - Friday, 9:00 AM - 6:00 PM
                            <br />Saturday: 9:00 AM - 2:00 PM
                        </li>
                    </ul>
                </div>

                <div class="button-container">
                    <a href="<?php echo $buttonLink; ?>" class="primary-button"><?php echo $buttonText; ?></a>
                    <a href="index" class="secondary-button">Return to Home</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Include -->
    <?php include('includes/footer.php'); ?>

    <!-- Scripts -->
    <script src="js/include-helper.js"></script>
    <script src="js/main.js"></script>

    <style>
        .thank-you-section {
            padding: 4rem 0;
        }

        .thank-you-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            padding: 2rem;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .success-icon {
            font-size: 3rem;
            color: var(--secondary);
            background-color: var(--secondary-light);
            width: 5rem;
            height: 5rem;
            line-height: 5rem;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
        }

        .next-steps-card,
        .contact-info-card {
            margin: 2rem 0;
            padding: 1.5rem;
            border-radius: var(--border-radius);
            background-color: var(--gray-light);
            text-align: left;
        }

        .next-steps-card {
            border-left: 4px solid var(--secondary);
        }

        .contact-info-card {
            border-left: 4px solid var(--primary);
        }

        .contact-list {
            list-style: none;
            padding: 0;
            margin: 1rem 0 0;
        }

        .contact-list li {
            margin-bottom: 0.5rem;
        }

        .button-container {
            margin-top: 2.5rem;
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .primary-button {
            background-color: var(--primary);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-weight: 500;
            transition: background-color var(--transition-speed);
        }

        .primary-button:hover {
            background-color: var(--primary-dark);
        }
    </style>
</body>

</html>