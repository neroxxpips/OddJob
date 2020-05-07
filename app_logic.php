<?php
$recipientEmail = "nero1deluxe@gmail.com";
$emailSubject = "PHP Mailing Function";
$emailContext = "Sending content using PHP mail function";

$emailHeaders = "Cc: nero1deluxe@gmail.com" . "\r\n";
$emailHeaders .= "Bcc: nero1deluxe@gmail.com" . "\r\n";

$fromAddress = "-fpostmaster@localhost";
$emailStatus = mail($recipientEmail, $emailSubject, $emailContext, $emailHeaders, $fromAddress);
if($emailStatus) {
echo "EMail Sent Successfully!";
} else {
echo "No Email is sent";
}
?>