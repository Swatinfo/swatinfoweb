<?php

/**
 * Swat Info System - Form Submission Handler
 * 
 * This script processes form submissions from contact and quote forms,
 * sending confirmation emails to clients and notifications to administrators
 * using SMTP email sending.
 */

// Autoload PHPMailer
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;
use EmailChecker\EmailChecker;

$gump = new GUMP();
if (!GUMP::has_validator('alpha_numeric_dash_space')) {
    GUMP::add_validator("alpha_numeric_dash_space", function ($field, array $input, array $params, $value) {

        // echo "<br />Field" . $field;
        // echo "<br />Input <pre>" . print_r($input, true) . "</pre>";
        // echo "<br />Params <pre>" . print_r($params, true) . "</pre>";
        // echo "<br />Value" . $value;

        if (! is_string($value) && ! is_numeric($value)) {
            return false;
        }
        return preg_match('/^[0-9A-Za-z.+<\-_ ]+$/u', $value) > 0;
    }, '{field} Only letters, numbers, space, underscore and dash are allowed.');
}
if (!GUMP::has_validator('phone_mobile_validator')) {
    GUMP::add_validator("phone_mobile_validator", function ($field, array $input, array $params, $value) {

        // echo "<br />Field" . $field;
        // echo "<br />Input <pre>" . print_r($input, true) . "</pre>";
        // echo "<br />Params <pre>" . print_r($params, true) . "</pre>";
        // echo "<br />Value" . $value;

        return preg_match("/^\\+?\\d{1,4}?[-.\\s]?\\(?\\d{1,3}?\\)?[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,4}[-.\\s]?\\d{1,9}$/", $value) > 0;
    }, 'Please enter valid <b>phone / mobile</b> number.');
}


// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Include the email templates
require_once 'includes/email-templates.php';

// SMTP Configuration
$smtpConfig = [

    'host'     => $_ENV['SMTP_HOST'],
    'username' => $_ENV['SMTP_USERNAME'],
    'password' => $_ENV['SMTP_PASSWORD'],
    'port'     => $_ENV['SMTP_PORT'],
    'from_email' => $_ENV['DEFAULT_FROM_EMAIL'],
    'from_name'  => $_ENV['DEFAULT_FROM_NAME'],
];

// Set admin email address
$adminEmail = $smtpConfig['from_email'];



// Collect form data
$formData = $_POST;
$formType = isset($_POST['form_type']) ? $_POST['form_type'] : '';

// Check if we have data
if (empty($formData)) {
    return redirectWithError('No form data received');
}

// Validate required fields
$requiredFields = array('name', 'email');
foreach ($requiredFields as $field) {
    if (empty($formData[$field])) {
        return redirectWithError("Required field '$field' is missing");
    }
}

// Validate email format
if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
    return redirectWithError('Invalid email address');
}

$checker = new EmailChecker();

if ($checker->isValid($formData['email']) == false) {
    return redirectWithError("Email Verification Failed:<br /><br /> The email address you've provided has been identified in our spam detection system.<br /><br /> To ensure the security of our platform, we cannot accept this email address.<br /><br /> Please use an alternative email address or contact our support team with verification details if you believe this is in error.");
}

if ($formType == 'contact') {
    $gump->validation_rules([
        'name'    => 'required|alpha_numeric_dash_space|valid_name',
        'email'       => 'required|valid_email',
        'phone'      => 'required|phone_mobile_validator',
        'subject' => 'required|alpha_numeric_dash_space',
        'message' => 'required|alpha_numeric_dash_space',
    ]);



    // set filter rules
    $gump->filter_rules([
        'name' => 'trim|sanitize_string|basic_tags|trim',
        'email'    => 'trim|sanitize_email|basic_tags|trim',
        'phone' => 'trim|sanitize_string|basic_tags|trim',
        'subject' => 'trim|sanitize_string|basic_tags|noise_words|trim',
        'message' => 'trim|sanitize_string|basic_tags|noise_words|trim',
    ]);

    // on success: returns array with same input structure, but after filters have run
    // on error: returns false
    $valid_data = $gump->run($_POST);

    if ($gump->errors()) {
       // echo "errors found";
        // echo "<pre>" . print_r($gump->get_readable_errors(), true) . "</pre>";
        // // ['Field <span class="gump-field">Somefield</span> is required.'] 
        // // or
        // echo "<pre>" . print_r($gump->get_errors_array(), true) . "</pre>";
        // ['field' => 'Field Somefield is required']
        if(!empty($gump->get_readable_errors())) {
            $error_message = implode("<br />", $gump->get_readable_errors());
            return redirectWithError($error_message);
            // return redirectWithError($recaptcha_error_message);
        }
    } else {
        // echo "all good";
        // // var_dump($valid_data);
        // echo "<pre>" . print_r($valid_data, true) . "</pre>";
    }
    // exit;
} else if ($formType == 'quote') {
    $gump->validation_rules([
        'name'    => 'required|alpha_numeric_dash_space|valid_name',
        'email'       => 'required|valid_email',
        'phone'      => 'required|phone_mobile_validator',
        'company'      => 'required|alpha_numeric_dash_space',
        'services'    => 'required|valid_array_size_greater,1',
        'timeline' => 'required|alpha_numeric_dash_space',
        'requirements' => 'required|alpha_numeric_dash_space',
    ]);



    // set filter rules
    $gump->filter_rules([
        'name' => 'trim|sanitize_string|basic_tags|trim',
        'email'    => 'trim|sanitize_email|basic_tags|trim',
        'phone' => 'trim|sanitize_string|basic_tags|trim',
        'company' => 'trim|sanitize_string|basic_tags|noise_words|trim',
        'timeline' => 'trim|sanitize_string|basic_tags|noise_words|trim',
        'requirements' => 'trim|sanitize_string|basic_tags|noise_words|trim',
    ]);

    // on success: returns array with same input structure, but after filters have run
    // on error: returns false
    $valid_data = $gump->run($_POST);

    if ($gump->errors()) {
        // echo "errors found";
        // echo "<pre>" . print_r($gump->get_readable_errors(), true) . "</pre>";
        // // ['Field <span class="gump-field">Somefield</span> is required.'] 
        // // or
        // echo "<pre>" . print_r($gump->get_errors_array(), true) . "</pre>";
        // ['field' => 'Field Somefield is required']
        if(!empty($gump->get_readable_errors())) {
            $error_message = implode("<br />", $gump->get_readable_errors());
            return redirectWithError($error_message);
            // return redirectWithError($recaptcha_error_message);
        }
    } else {
        // echo "all good";
        // // var_dump($valid_data);
        // echo "<pre>" . print_r($valid_data, true) . "</pre>";
    }
    // exit;
}
// exit;


$gRecaptchaResponse = $formData['gRecaptchaResponse'];
$reCAPTCHA_secret_key = $_ENV['RECAPTCHA_SECRET_KEY'];
$g_recaptcha_allowable_score = $_ENV['RECAPTCHA_ALLOWABLE_SCORE'];
// echo $g_recaptcha_allowable_score;

$ip = $_SERVER['REMOTE_ADDR'];
$url =  'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($reCAPTCHA_secret_key) . '&response=' . urlencode($gRecaptchaResponse) . '&remoteip=' . urlencode($ip);
$response = file_get_contents($url);

$responseKeys = json_decode($response, true);
// echo "<pre>" . print_r($responseKeys, true) . "</pre>";
// exit;

$recaptcha_error_message = "We were unable to verify your request due to an incomplete or unsuccessful reCAPTCHA verification<br /><br />
To proceed with your request:<br /><br />

- Please complete the reCAPTCHA verification by checking the I'm not a robot box<br />
- Ensure all verification challenges are completed correctly<br />
- If using a VPN or proxy service, temporary disconnection may resolve this issue<br />";

if ($responseKeys["success"]) {
    // echo "came here 0...0...";
    if ($responseKeys["score"] >= $g_recaptcha_allowable_score) {
        //send email with contact form submission data to site owner/ submit to database/ etc
        //redirect to confirmation page or whatever you need to do
    } elseif ($responseKeys["score"] < $g_recaptcha_allowable_score) {
        // echo "came here 0...1...";
        return redirectWithError($recaptcha_error_message);
    }
} elseif ($responseKeys["error-codes"]) { //optional
    // echo "came here 0...2...";
    //handle errors. See notes below for possible error codes
    //(I handle errors by sending myself an email with the error code for debugging and offering the visitor the option to try again or use an alternative method of contact)
    return redirectWithError($recaptcha_error_message);
} else {
    // echo "came here 0...3...";
    //unkown screw up. Again, offer the visitor the option to try again or use an alternative method of contact.
    return redirectWithError($recaptcha_error_message);
}

// echo "came here 1.....form....." . $formType;
// exit;
// Process based on form type
switch ($formType) {
    case 'contact':
        return processContactForm($formData, $adminEmail, $smtpConfig);
        break;

    case 'quote':
        return processQuoteForm($formData, $adminEmail, $smtpConfig);
        break;

    default:
        // Default to contact form if not specified
        return processContactForm($formData, $adminEmail, $smtpConfig);
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
        // echo "came here contact success 1";
        // exit;
        return redirectWithSuccess('contact');
    } else {
        // echo "came here contact error 1";
        return redirectWithError('Failed to send emails');
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
        // echo "came here quote success 1";
        // exit;
        return redirectWithSuccess('quote');
    } else {
        // echo "came here quote error 1";
        // exit;
        return redirectWithError('Failed to send emails');
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
        // echo "came here 2";
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
        // echo "came here 3";
        // Log the error or handle it as needed
        return redirectWithError('Email sending failed: ' . $mail->ErrorInfo);
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
    // echo $message;
    // // Encode message for URL
    // $encodedMessage = urlencode($message);

    // // Redirect back to the referring page with error message
    // header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=$encodedMessage");
    // exit;
    // header('Content-Type: application/json; charset=utf-8');

    // echo json_encode(array("message" => $message));


    header('Content-Type: application/json; charset=utf-8');
    http_response_code(200);
    echo json_encode(array("message" => $message, "status" => "error"));
}

/**
 * Redirect to thank you page with success message
 *
 * @param string $formType Type of form (contact or quote)
 * @return void
 */
function redirectWithSuccess($formType)
{
    // echo $formType;
    // Determine redirect location
    $redirect = 'thank-you.php?type=' . $formType;

    // Redirect to thank you page
    // header("Location: $redirect");
    // exit;
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(200);
    echo json_encode(array("message" => "Email sent successfully", "redirect" => $redirect, "status" => "success"));
}
