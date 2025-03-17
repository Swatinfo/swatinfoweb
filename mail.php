<?php

/**
 * Swat Info System - Form Submission Handler
 * 
 * This script processes form submissions from contact and quote forms,
 * sending confirmation emails to clients and notifications to administrators
 * using SMTP email sending.
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Autoload PHPMailer
require 'vendor/autoload.php';

// Include the email templates
require_once 'includes/email-templates.php';

// SMTP Configuration
$smtpConfig = [
    'host' => 'smtp.gmail.com',     // Your SMTP host
    'username' => 'your-email@gmail.com', // Your email address
    'password' => 'your-app-password',    // App password or SMTP password
    'port' => 587,                  // Typically 587 for TLS
    'from_email' => 'your-email@gmail.com',
    'from_name' => 'Swat Info System'
];

// Set admin email address
$adminEmail = $smtpConfig['from_email'];

// Collect form data
$formData = $_POST;
$formType = isset($_POST['form_type']) ? $_POST['form_type'] : '';

// Check if we have data
if (empty($formData)) {
    redirectWithError('No form data received');
}

// Validate required fields
$requiredFields = array('name', 'email');
foreach ($requiredFields as $field) {
    if (empty($formData[$field])) {
        redirectWithError("Required field '$field' is missing");
    }
}

// Validate email format
if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
    redirectWithError('Invalid email address');
}

// Process based on form type
switch ($formType) {
    case 'contact':
        processContactForm($formData, $adminEmail, $smtpConfig);
        break;

    case 'quote':
        processQuoteForm($formData, $adminEmail, $smtpConfig);
        break;

    default:
        // Default to contact form if not specified
        processContactForm($formData, $adminEmail, $smtpConfig);
}

/**
 * Process contact form submission
 *
 * @param array $data Form data
 * @param string $adminEmail Admin email address
 * @param array $smtpConfig SMTP Configuration
 * @return void
 */
function processContactForm($data, $adminEmail, $smtpConfig)
{
    // Get email templates
    $clientEmailContent = getContactClientEmailTemplate($data);
    $adminEmailContent = getContactAdminEmailTemplate($data);

    // Send confirmation email to client
    $clientSubject = "Thank you for contacting Swat Info System";
    $clientResult = sendSMTPEmail($data['email'], $clientSubject, $clientEmailContent, $smtpConfig);

    // Send notification email to admin
    $adminSubject = "New Contact Form Submission: " . (isset($data['subject']) ? $data['subject'] : "General Inquiry");
    $adminResult = sendSMTPEmail($adminEmail, $adminSubject, $adminEmailContent, $smtpConfig);

    // Check if both emails were sent successfully
    if ($clientResult && $adminResult) {
        redirectWithSuccess('contact');
    } else {
        redirectWithError('Failed to send emails');
    }
}

/**
 * Process quote form submission
 *
 * @param array $data Form data
 * @param string $adminEmail Admin email address
 * @param array $smtpConfig SMTP Configuration
 * @return void
 */
function processQuoteForm($data, $adminEmail, $smtpConfig)
{
    // Get email templates
    $clientEmailContent = getQuoteClientEmailTemplate($data);
    $adminEmailContent = getQuoteAdminEmailTemplate($data);

    // Send confirmation email to client
    $clientSubject = "Thank you for your quote request - Swat Info System";
    $clientResult = sendSMTPEmail($data['email'], $clientSubject, $clientEmailContent, $smtpConfig);

    // Send notification email to admin
    $adminSubject = "New Quote Request from " . $data['name'];
    $adminResult = sendSMTPEmail($adminEmail, $adminSubject, $adminEmailContent, $smtpConfig);

    // Check if both emails were sent successfully
    if ($clientResult && $adminResult) {
        redirectWithSuccess('quote');
    } else {
        redirectWithError('Failed to send emails');
    }
}

/**
 * Send email using SMTP
 *
 * @param string $to Recipient email address
 * @param string $subject Email subject
 * @param string $body HTML email body
 * @param array $smtpConfig SMTP configuration
 * @return bool Whether email was sent successfully
 */
function sendSMTPEmail($to, $subject, $body, $smtpConfig)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = $smtpConfig['host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtpConfig['username'];
        $mail->Password   = $smtpConfig['password'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $smtpConfig['port'];

        // Set email headers
        $mail->setFrom($smtpConfig['from_email'], $smtpConfig['from_name']);
        $mail->addAddress($to);
        $mail->isHTML(true);

        // Content
        $mail->Subject = $subject;
        $mail->Body    = $body;

        // Send email
        $mail->send();
        return true;
    } catch (Exception $e) {
        // Log the error or handle it as needed
        error_log('Email sending failed: ' . $mail->ErrorInfo);
        return false;
    }
}

/**
 * Redirect with error message
 *
 * @param string $message Error message
 * @return void
 */
function redirectWithError($message)
{
    // Encode message for URL
    $encodedMessage = urlencode($message);

    // Redirect back to the referring page with error message
    header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=$encodedMessage");
    exit;
}

/**
 * Redirect to thank you page with success message
 *
 * @param string $formType Type of form (contact or quote)
 * @return void
 */
function redirectWithSuccess($formType)
{
    // Determine redirect location
    $redirect = 'thank-you.php?type=' . $formType;

    // Redirect to thank you page
    header("Location: $redirect");
    exit;
}
