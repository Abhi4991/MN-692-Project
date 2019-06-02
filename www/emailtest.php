<?php
$to      = 'ddowell327@gmail.com';
$subject = 'This is a test email';
$message = 'Hello me.';
$headers = 'From: david@rollcall.net.au' . "\r\n" .
   'Reply-To: david@rollcall.net.au' . "\r\n" .
   'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

echo " Mail sent \r\n";

echo $message;

?>