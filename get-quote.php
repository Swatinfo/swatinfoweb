<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Request a free quote for your project. Our team will analyze your requirements and provide a detailed proposal for web development, mobile apps, digital marketing and more.">
    <meta name="keywords" content="quote, estimate, project quote, IT services quote, software development quote">
    <title>Get a Quote | Swat Info System</title>
    <link rel="stylesheet" href="css/styles.css">

    <link rel="stylesheet" href="css/custom.css">

</head>

<body>
    <!-- Header Include -->
    <?php include('includes/header_menu.php'); ?>

    <section class="page-banner">
        <div class="container">
            <h1>Get a Custom Quote</h1>
            <p>Tell us about your project, and we'll provide a detailed proposal tailored to your needs</p>
        </div>
    </section>

    <div class="breadcrumbs">
        <div class="container breadcrumbs-container">
            <a href="">Home</a>
            <span class="separator">/</span>
            <span class="current">Get a Quote</span>
        </div>
    </div>

    <section class="quote-section">
        <div class="container quote-grid">
            <div class="quote-info">
                <h3>Our Quote Process</h3>
                <p>At Swat Info System, we believe in providing transparent and accurate quotes that reflect the true scope and requirements of your project. Here's how our quote process works:</p>

                <div class="process-list">
                    <div class="process-item">
                        <div class="process-icon">1</div>
                        <div class="process-content">
                            <h4>Submit Your Requirements</h4>
                            <p>Fill out the quote request form with details about your project, including goals, features, timeline, and budget considerations.</p>
                        </div>
                    </div>

                    <div class="process-item">
                        <div class="process-icon">2</div>
                        <div class="process-content">
                            <h4>Initial Consultation</h4>
                            <p>Our team will review your requirements and schedule a call to discuss your project in more detail and clarify any questions.</p>
                        </div>
                    </div>

                    <div class="process-item">
                        <div class="process-icon">3</div>
                        <div class="process-content">
                            <h4>Analysis & Estimation</h4>
                            <p>We'll analyze your requirements, breaking down the project into tasks and estimating the effort, resources, and timeline required.</p>
                        </div>
                    </div>

                    <div class="process-item">
                        <div class="process-icon">4</div>
                        <div class="process-content">
                            <h4>Detailed Proposal</h4>
                            <p>You'll receive a comprehensive proposal with project scope, timeline, deliverables, and pricing options tailored to your specific needs.</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-mini">
                    <p>"The quote process with Swat Info System was refreshingly thorough and transparent. They took the time to really understand our needs before providing a detailed proposal that addressed all our requirements. There were no surprises along the way."</p>
                    <div class="testimonial-mini-author">
                        <div class="author-avatar">
                            <img src="api/placeholder/50/50" alt="Client Avatar" width="100%">
                        </div>
                        <div class="author-details">
                            <h5>Michael Thompson</h5>
                            <span>Chief Digital Officer, Enterprise Solutions</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="quote-form">
                <h3>Request a Free Quote</h3>
                <form id="quoteForm" name="quoteForm"  method="post" action="mail.php">
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
                        <label for="company">Company Name</label>
                        <input type="text" id="company" name="company" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Services Required</label>
                        <div class="checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="services[]" value="website" class="checkbox-control" required>
                                Website Development
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="services[]" value="webapp" class="checkbox-control">
                                Web Application Development
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="services[]" value="mobileapp" class="checkbox-control">
                                Mobile App Development
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="services[]" value="digitalmarketing" class="checkbox-control">
                                Digital Marketing
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="services[]" value="uxui" class="checkbox-control">
                                UX/UI Design
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="services[]" value="desktopapp" class="checkbox-control">
                                Desktop Application
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="services[]" value="other" class="checkbox-control">
                                Other (please specify in requirements)
                            </label>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <label for="budget">Budget Range</label>
                        <select id="budget" name="budget" class="form-control">
                            <option value="">Select Budget Range</option>
                            <option value="< $5,000">Less than $5,000</option>
                            <option value="$5,000 - $10,000">$5,000 - $10,000</option>
                            <option value="$10,000 - $25,000">$10,000 - $25,000</option>
                            <option value="$25,000 - $50,000">$25,000 - $50,000</option>
                            <option value="$50,000+">$50,000+</option>
                            <option value="Not Sure">Not Sure</option>
                        </select>
                    </div> -->

                    <div class="form-group">
                        <label for="timeline">Expected Timeline</label>
                        <select id="timeline" name="timeline" class="form-control">
                            <option value="">Select Expected Timeline</option>
                            <option value="< 1 month">Less than 1 month</option>
                            <option value="1-3 months">1-3 months</option>
                            <option value="3-6 months">3-6 months</option>
                            <option value="6+ months">6+ months</option>
                            <option value="Not Sure">Not Sure</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="requirements">Project Requirements</label>
                        <textarea id="requirements" name="requirements" class="form-control" placeholder="Please describe your project goals, features, and any specific requirements..." required></textarea>
                    </div>

                    <button type="submit" class="submit-button validateFormData">Submit Quote Request</button>

                    <p class="form-note">We'll get back to you with a detailed proposal within 2 business days.</p>
                </form>
            </div>
        </div>
    </section>

    <section class="faq-section">
        <div class="container">
            <div class="section-header">
                <h2>Frequently Asked Questions</h2>
                <p>Common questions about our quote and project process</p>
            </div>
            <div class="faqs-container">
                <div class="faq-item">
                    <div class="faq-question">
                        <span>How long does it take to receive a quote?</span>
                        <span>+</span>
                    </div>
                    <div class="faq-answer">
                        <p>After submitting your quote request, you can expect to receive an initial response within 24-48 hours. For simple projects, we can often provide a detailed quote within 2-3 business days. For more complex projects requiring in-depth analysis, it may take up to 5 business days to deliver a comprehensive proposal.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Is the quote binding or just an estimate?</span>
                        <span>+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Our quotes provide a detailed breakdown of costs based on the requirements you share with us. For fixed-scope projects, we offer firm fixed-price quotes. For projects with evolving requirements, we provide an estimated range with clearly defined assumptions. Any changes to the project scope may affect the final cost, but we always discuss and get approval for any changes before proceeding.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>What information should I include in my quote request?</span>
                        <span>+</span>
                    </div>
                    <div class="faq-answer">
                        <p>The more detail you can provide, the more accurate our quote will be. Key information to include: your business goals for the project, target audience, desired features and functionality, design preferences, any technical requirements or constraints, expected timeline, and budget considerations. If you have existing materials like wireframes, designs, or specifications, those are extremely helpful as well.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>What if I'm not sure about my exact requirements?</span>
                        <span>+</span>
                    </div>
                    <div class="faq-answer">
                        <p>That's completely normal, and we're here to help! If you're uncertain about specific requirements, we can start with a discovery phase to help define your project needs. Our team can work with you to clarify goals, identify key features, and develop a detailed requirements specification. This collaborative approach ensures that our solution aligns perfectly with your business objectives.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        <span>Do you offer payment plans?</span>
                        <span>+</span>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, we offer flexible payment options to accommodate your business needs. Most projects follow a milestone-based payment schedule, with an initial deposit to begin work and subsequent payments tied to specific project milestones. For larger projects, we can discuss custom payment arrangements. Our goal is to find a payment structure that works for both parties while ensuring smooth project progression.</p>
                    </div>
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