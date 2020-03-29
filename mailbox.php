<?php
$code = rand(10000,1000000);
$to = "unduworldofliving@gmail.com";
$subject = 'Registration';
$from = 'Christianity24.org';
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
// Create email headers
$headers .= 'From: '.$from."\r\n".
'Reply-To: '.$from."\r\n" .
'X-Mailer: PHP/' . phpversion();
$body = "Hello $to.  This is an automatic mail please don't reply to this message.
Click the link below to reset your password  or copy to your browser
http://thewallclone.com/forgot-password?code=$code&email=$to ". "\r\n" ."
Rgards: Marshall Unduemi J";
mail($to,$subject,$body,$headers);