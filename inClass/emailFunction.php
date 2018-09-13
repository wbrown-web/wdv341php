<?php

function sendMail() {
$to      = 'wbrown84@gmail.com';
$subject = 'PHP Test Email';
$message = 'It Is Working';
$headers = 'From: contact@willbdesigned.com';
mail($to, $subject, $message, $headers);
}

sendMail();
?>
