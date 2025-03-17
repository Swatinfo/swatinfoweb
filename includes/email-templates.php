<?php

/**
 * Email Templates for Swat Info System
 * 
 * This file contains email templates for contact and quote forms,
 * including both client confirmations and admin notifications.
 */

/**
 * Contact Form - Client Confirmation Email Template
 * 
 * @param array $data Form submission data
 * @return string HTML email content
 */
function getContactClientEmailTemplate($data)
{
    $name = htmlspecialchars($data['name']);
    $email = htmlspecialchars($data['email']);
    $company = isset($data['company']) ? htmlspecialchars($data['company']) : 'N/A';

    $template = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thank You for Contacting Us</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333333;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
            }
            .header {
                background-color: #2563eb;
                padding: 20px;
                text-align: center;
            }
            .header h1 {
                color: white;
                margin: 0;
                padding: 0;
                font-size: 24px;
            }
            .content {
                background-color: #f8fafc;
                padding: 20px;
                border-left: 1px solid #e2e8f0;
                border-right: 1px solid #e2e8f0;
            }
            .footer {
                background-color: #1e293b;
                color: white;
                text-align: center;
                padding: 15px;
                font-size: 14px;
            }
            .footer a {
                color: #60a5fa;
                text-decoration: none;
            }
            .contact-info {
                margin-top: 20px;
                background-color: #e2e8f0;
                padding: 15px;
                border-radius: 5px;
            }
            .button {
                display: inline-block;
                background-color: #2563eb;
                color: white;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 5px;
                margin-top: 15px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>Thank You for Contacting Us</h1>
            </div>
            <div class="content">
                <p>Dear ' . $name . ',</p>
                <p>Thank you for reaching out to Swat Info System. We have received your message and will get back to you as soon as possible, typically within 24 hours during business days.</p>
                <p>Here\'s a summary of the information you provided:</p>
                <ul>
                    <li><strong>Name:</strong> ' . $name . '</li>
                    <li><strong>Email:</strong> ' . $email . '</li>
                    ' . ($company !== 'N/A' ? '<li><strong>Company:</strong> ' . $company . '</li>' : '') . '
                </ul>
                <p>If you have any additional information to provide or questions in the meantime, please feel free to reply to this email or call us directly.</p>
                <div class="contact-info">
                    <p><strong>Contact Information:</strong></p>
                    <p>Phone: +1 (555) 123-4567<br>
                    Email: info@swatinfosystem.com</p>
                </div>
                <p>We look forward to speaking with you soon!</p>
                <p>Best regards,<br>
                Swat Info System Team</p>
                <a href="https://www.swatinfosystem.com" class="button">Visit Our Website</a>
            </div>
            <div class="footer">
                &copy; ' . date('Y') . ' Swat Info System. All Rights Reserved.<br>
                <a href="https://www.swatinfosystem.com/privacy-policy">Privacy Policy</a> | 
                <a href="https://www.swatinfosystem.com/terms-of-service">Terms of Service</a>
            </div>
        </div>
    </body>
    </html>
    ';

    return $template;
}

/**
 * Contact Form - Admin Notification Email Template
 * 
 * @param array $data Form submission data
 * @return string HTML email content
 */
function getContactAdminEmailTemplate($data)
{
    $name = htmlspecialchars($data['name']);
    $email = htmlspecialchars($data['email']);
    $phone = isset($data['phone']) ? htmlspecialchars($data['phone']) : 'Not provided';
    $subject = isset($data['subject']) ? htmlspecialchars($data['subject']) : 'General Inquiry';
    $message = isset($data['message']) ? nl2br(htmlspecialchars($data['message'])) : 'No message content';
    $company = isset($data['company']) ? htmlspecialchars($data['company']) : 'Not provided';
    $date = date('F j, Y, g:i a');

    $template = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>New Contact Form Submission</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333333;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
            }
            .header {
                background-color: #2563eb;
                padding: 20px;
                text-align: center;
            }
            .header h1 {
                color: white;
                margin: 0;
                padding: 0;
                font-size: 24px;
            }
            .content {
                background-color: #f8fafc;
                padding: 20px;
                border-left: 1px solid #e2e8f0;
                border-right: 1px solid #e2e8f0;
            }
            .footer {
                background-color: #1e293b;
                color: white;
                text-align: center;
                padding: 15px;
                font-size: 14px;
            }
            .submission-info {
                margin-top: 20px;
                background-color: #e2e8f0;
                padding: 15px;
                border-radius: 5px;
            }
            .message-content {
                border-left: 3px solid #2563eb;
                padding-left: 15px;
                margin: 15px 0;
            }
            .button {
                display: inline-block;
                background-color: #2563eb;
                color: white;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 5px;
                margin-top: 15px;
            }
            .priority {
                font-weight: bold;
                color: #dc2626;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>New Contact Form Submission</h1>
            </div>
            <div class="content">
                <p>A new contact form submission has been received from the website.</p>
                <div class="submission-info">
                    <p><strong>Submission Details:</strong></p>
                    <ul>
                        <li><strong>Name:</strong> ' . $name . '</li>
                        <li><strong>Email:</strong> ' . $email . '</li>
                        <li><strong>Phone:</strong> ' . $phone . '</li>
                        <li><strong>Company:</strong> ' . $company . '</li>
                        <li><strong>Subject:</strong> ' . $subject . '</li>
                        <li><strong>Date:</strong> ' . $date . '</li>
                    </ul>
                </div>
                <p><strong>Message:</strong></p>
                <div class="message-content">
                    ' . $message . '
                </div>
                <p class="priority">Please respond to this inquiry within 24 hours.</p>
                <p>You can reply directly to this email to respond to the client.</p>
                <a href="mailto:' . $email . '" class="button">Reply to ' . $name . '</a>
            </div>
            <div class="footer">
                &copy; ' . date('Y') . ' Swat Info System | Internal Notification
            </div>
        </div>
    </body>
    </html>
    ';

    return $template;
}

/**
 * Quote Form - Client Confirmation Email Template
 * 
 * @param array $data Form submission data
 * @return string HTML email content
 */
function getQuoteClientEmailTemplate($data)
{
    $name = htmlspecialchars($data['name']);
    $email = htmlspecialchars($data['email']);
    $company = isset($data['company']) ? htmlspecialchars($data['company']) : 'N/A';
    $services = isset($data['services']) && is_array($data['services']) ? implode(', ', array_map('htmlspecialchars', $data['services'])) : 'Not specified';

    $template = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thank You for Your Quote Request</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333333;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
            }
            .header {
                background-color: #2563eb;
                padding: 20px;
                text-align: center;
            }
            .header h1 {
                color: white;
                margin: 0;
                padding: 0;
                font-size: 24px;
            }
            .content {
                background-color: #f8fafc;
                padding: 20px;
                border-left: 1px solid #e2e8f0;
                border-right: 1px solid #e2e8f0;
            }
            .footer {
                background-color: #1e293b;
                color: white;
                text-align: center;
                padding: 15px;
                font-size: 14px;
            }
            .footer a {
                color: #60a5fa;
                text-decoration: none;
            }
            .contact-info {
                margin-top: 20px;
                background-color: #e2e8f0;
                padding: 15px;
                border-radius: 5px;
            }
            .button {
                display: inline-block;
                background-color: #2563eb;
                color: white;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 5px;
                margin-top: 15px;
            }
            .next-steps {
                background-color: #10b981;
                color: white;
                padding: 15px;
                border-radius: 5px;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>Thank You for Your Quote Request</h1>
            </div>
            <div class="content">
                <p>Dear ' . $name . ',</p>
                <p>Thank you for requesting a quote from Swat Info System. We have received your submission and are excited about the possibility of working with you on your project.</p>
                <p>Here\'s a summary of the information you provided:</p>
                <ul>
                    <li><strong>Name:</strong> ' . $name . '</li>
                    <li><strong>Email:</strong> ' . $email . '</li>
                    <li><strong>Company:</strong> ' . $company . '</li>
                    <li><strong>Services Requested:</strong> ' . $services . '</li>
                </ul>
                <div class="next-steps">
                    <h3>Next Steps</h3>
                    <p>Our team will review your requirements and prepare a detailed, customized quote for your project. You can expect to hear from us within 2 business days.</p>
                </div>
                <p>If you have any additional information to provide or questions in the meantime, please feel free to reply to this email or call us directly.</p>
                <div class="contact-info">
                    <p><strong>Contact Information:</strong></p>
                    <p>Phone: +1 (555) 123-4567<br>
                    Email: info@swatinfosystem.com</p>
                </div>
                <p>We look forward to discussing your project in detail!</p>
                <p>Best regards,<br>
                Swat Info System Team</p>
                <a href="https://www.swatinfosystem.com/services" class="button">Explore Our Services</a>
            </div>
            <div class="footer">
                &copy; ' . date('Y') . ' Swat Info System. All Rights Reserved.<br>
                <a href="https://www.swatinfosystem.com/privacy-policy">Privacy Policy</a> | 
                <a href="https://www.swatinfosystem.com/terms-of-service">Terms of Service</a>
            </div>
        </div>
    </body>
    </html>
    ';

    return $template;
}

/**
 * Quote Form - Admin Notification Email Template
 * 
 * @param array $data Form submission data
 * @return string HTML email content
 */
function getQuoteAdminEmailTemplate($data)
{
    $name = htmlspecialchars($data['name']);
    $email = htmlspecialchars($data['email']);
    $phone = isset($data['phone']) ? htmlspecialchars($data['phone']) : 'Not provided';
    $company = isset($data['company']) ? htmlspecialchars($data['company']) : 'Not provided';
    $services = isset($data['services']) && is_array($data['services']) ? implode(', ', array_map('htmlspecialchars', $data['services'])) : 'Not specified';
    $timeline = isset($data['timeline']) ? htmlspecialchars($data['timeline']) : 'Not specified';
    $requirements = isset($data['requirements']) ? nl2br(htmlspecialchars($data['requirements'])) : 'No requirements provided';
    $date = date('F j, Y, g:i a');

    $template = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>New Quote Request</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333333;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
            }
            .header {
                background-color: #2563eb;
                padding: 20px;
                text-align: center;
            }
            .header h1 {
                color: white;
                margin: 0;
                padding: 0;
                font-size: 24px;
            }
            .content {
                background-color: #f8fafc;
                padding: 20px;
                border-left: 1px solid #e2e8f0;
                border-right: 1px solid #e2e8f0;
            }
            .footer {
                background-color: #1e293b;
                color: white;
                text-align: center;
                padding: 15px;
                font-size: 14px;
            }
            .submission-info {
                margin-top: 20px;
                background-color: #e2e8f0;
                padding: 15px;
                border-radius: 5px;
            }
            .requirements-content {
                border-left: 3px solid #2563eb;
                padding-left: 15px;
                margin: 15px 0;
            }
            .button {
                display: inline-block;
                background-color: #2563eb;
                color: white;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 5px;
                margin-top: 15px;
            }
            .priority-high {
                font-weight: bold;
                color: #dc2626;
            }
            .services-list {
                margin-top: 5px;
                list-style-type: disc;
                padding-left: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>New Quote Request</h1>
            </div>
            <div class="content">
                <p>A new quote request has been submitted from the website.</p>
                <div class="submission-info">
                    <p><strong>Client Information:</strong></p>
                    <ul>
                        <li><strong>Name:</strong> ' . $name . '</li>
                        <li><strong>Email:</strong> ' . $email . '</li>
                        <li><strong>Phone:</strong> ' . $phone . '</li>
                        <li><strong>Company:</strong> ' . $company . '</li>
                        <li><strong>Services Requested:</strong> ' . $services . '</li>
                        <li><strong>Timeline:</strong> ' . $timeline . '</li>
                        <li><strong>Submission Date:</strong> ' . $date . '</li>
                    </ul>
                </div>
                <p><strong>Project Requirements:</strong></p>
                <div class="requirements-content">
                    ' . $requirements . '
                </div>
                <p class="priority-high">This is a new business opportunity. Please prepare a quote within 2 business days.</p>
                <p>You can reply directly to this email to communicate with the client.</p>
                <a href="mailto:' . $email . '" class="button">Contact ' . $name . '</a>
            </div>
            <div class="footer">
                &copy; ' . date('Y') . ' Swat Info System | Internal Notification
            </div>
        </div>
    </body>
    </html>
    ';

    return $template;
}
