<?php

$errors = '';
$myemail = 'info@swatinfosystem.com'; //<-----Put Your email address here.

$name = isset($_POST['name']) ? $_POST['name'] : '';
$email_address = isset($_POST['email']) ? $_POST['email'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$company = isset($_POST['company']) ? $_POST['company'] : '';
$services = isset($_POST['services']) ? $_POST['services'] : '';
$timeline = isset($_POST['timeline']) ? $_POST['timeline'] : '';
$subject = isset($_POST['subject']) ? $_POST['subject'] : '';
$requirements = isset($_POST['requirements']) ? $_POST['requirements'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';

// $email_address = $_POST['email'];
// $subject = $_POST['phone'];
// $subject = $_POST['company'];
// $subject = $_POST['services'];
// $subject = $_POST['timeline'];
// $subject = $_POST['subject'];
// $message = $_POST['requirements'];
// $message = $_POST['message'];

echo "<pre>" . print_r($_POST, true) . "</pre>";
exit;

if (empty($errors)) {
    $to = $myemail;
    if ($subject != "") {
        $email_subject = "Contact form : $subject";
    } else {
        $email_subject = "Contact form submission: $name";
    }
    
    $email_body = "You have received a new message. " .
        " Here are the details:\n Name: $name \n " .
        "Email: $email_address\n " .
        "Subject: $subject\n " .
        "Message: $message\n ";
    $headers = "From: $myemail\n";
    $headers .= "Reply-To: $email_address";
    mail($to, $email_subject, $email_body, $headers);
    //redirect to the 'thank you' page
    header('Location: index.html');
}
