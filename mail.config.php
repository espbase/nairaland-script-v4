<?php
require_once ('config.php');

require 'vendor/autoload.php';
//Import PHPMailer classes into the global namespace
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
$mail = new PHPMailer;

// Enable verbose debug output
$mail->isSMTP();
$mail->SMTPDebug = $smtpdebug;  //2 to show bug                                  // Set mailer to use SMTP
$mail->Host = $smtpserver;              // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = $noreplyemail;                 // SMTP username
$mail->Password = $mailerpass;                           // SMTP password
$mail->SMTPSecure = $smtpsecure;                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = $mailerport; //587
