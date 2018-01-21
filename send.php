<?php

//TIMEZONE
date_default_timezone_set('America/New_York');

if ((!isset($_POST['mailTo'])) || $_POST['mailTo'] == "") {
  var_dump($_POST);
  exit;
}

$mailFrom = "daniel7byte@gmail.com";
$mailTo = $_POST['mailTo'];
$body = $_POST['body'];

/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//SMTPOptions
$mail->SMTPOptions = array(
  'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
  )
);

$mail->CharSet = "UTF-8";

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

$mail->Host = 'smtp.gmail.com';                       //Set the hostname of the mail server
$mail->Port = 587;                                    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->SMTPSecure = 'tls';                            //Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPAuth = true;                               //Whether to use SMTP authentication
$mail->Username = $mailFrom;                          //Username to use for SMTP authentication - use full email address for gmail
$mail->Password = "";                        //Password to use for SMTP authentication


//Recipients
$mail->setFrom($mailFrom, 'Jose Daniel Posso Garcia');
$mail->addAddress($mailFrom, 'Jose Daniel Posso Garcia');          // Add a recipient & Name is optional
$mail->addAddress($mailTo);
$mail->addReplyTo($mailFrom, 'Jose Daniel Posso Garcia');

//Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Email sent on ' . date('r');        // ISO 8601
$mail->Body    = 'This email was sent by: ' . $mailFrom . '<br>' . $body;
$mail->AltBody = 'New message of ControllerSendEmailAPI';

//send the message, check for errors
if (!$mail->send()) {
  var_dump($_POST);
  echo 'Versión actual de PHP: ' . phpversion();
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Done!";
}
