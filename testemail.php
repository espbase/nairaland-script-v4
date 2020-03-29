<?php     

  // Sending email
   /* Send a registration link to entered email address */
$to = 'unduworldofliving@gmail.com';
$subject = 'New Nairaland Installed';
$from = $email;
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    $time=date('d,m,y');

// Compose a simple HTML email message
$message = '
<h1 style="color:#f40;">Howdy Marshall Unduemi!</h1> <p style="color:#080;font-size:12px;">, Nairaland has been installed on '.$weburl.'</p> <p>
From '.$email.' date '.$time.' </p>';
// Sending email

mail($to,$subject,$message,$headers);
?>