<?php
$to      = 'wbrown84@gmail.com';
$subject = 'PHP Test Email';
$message = 'It Is Working';
$headers = 'From: contact@willbdesigned.com' . "\r\n";

mail($to, $subject, $message, $headers);
?>
