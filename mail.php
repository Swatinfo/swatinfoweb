<?php

/**
 * Swat Info System - Form Submission Handler
 * 
 * This script processes form submissions from contact and quote forms,
 * sending confirmation emails to clients and notifications to administrators.
 */

// Include the email templates
require_once 'includes/email-templates.php';

// Set admin email address
$adminEmail = 'info@swatinfosystem.com';

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
        processContactForm($formData, $adminEmail);
        break;

    case 'quote':
        processQuoteForm($formData, $adminEmail);
        break;

    default:
        // Default to contact form if not specified
        processContactForm($formData, $adminEmail);
}

/**
 * Process contact form submission
 *
 * @param array $data Form data
 * @param string $adminEmail Admin email address
 * @return void
 */
function processContactForm($data, $adminEmail)
{
    // Get email templates
    $clientEmailContent = getContactClientEmailTemplate($data);
    $adminEmailContent = getContactAdminEmailTemplate($data);

    // Set up headers for HTML email
    $headers = getEmailHeaders($adminEmail);

    // Send confirmation email to client
    $clientSubject = "Thank you for contacting Swat Info System";
    mail($data['email'], $clientSubject, $clientEmailContent, $headers);

    // Send notification email to admin
    $adminSubject = "New Contact Form Submission: " . (isset($data['subject']) ? $data['subject'] : "General Inquiry");
    mail($adminEmail, $adminSubject, $adminEmailContent, $headers);

    // Redirect to thank you page
    redirectWithSuccess('contact');
}

/**
 * Process quote form submission
 *
 * @param array $data Form data
 * @param string $adminEmail Admin email address
 * @return void
 */
function processQuoteForm($data, $adminEmail)
{
    // Get email templates
    $clientEmailContent = getQuoteClientEmailTemplate($data);
    $adminEmailContent = getQuoteAdminEmailTemplate($data);

    // Set up headers for HTML email
    $headers = getEmailHeaders($adminEmail);

    // Send confirmation email to client
    $clientSubject = "Thank you for your quote request - Swat Info System";
    mail($data['email'], $clientSubject, $clientEmailContent, $headers);

    // Send notification email to admin
    $adminSubject = "New Quote Request from " . $data['name'];
    mail($adminEmail, $adminSubject, $adminEmailContent, $headers);

    // Redirect to thank you page
    redirectWithSuccess('quote');
}

/**
 * Generate email headers for HTML email
 *
 * @param string $fromEmail From email address
 * @return string Email headers
 */
function getEmailHeaders($fromEmail)
{
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Swat Info System <$fromEmail>" . "\r\n";
    $headers .= "Reply-To: $fromEmail" . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    return $headers;
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
