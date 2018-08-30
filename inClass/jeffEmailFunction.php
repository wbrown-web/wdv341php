<?php

$emailResult= "";

function phpMailer() {
  global $emailResult;


  $sendTo = "jhgullion@dmacc.edu";
  $subject = "This is a test email from WDV341";
  $message = "It Works!";
  $from = "From: contact@jhgullion.org" . "\r\n";

  $emailResult = mail($sendTo, $subject, $message, $from);

}

phpMailer();

?>

<h1>Email Test</h1>

<h2> Result: <?= $emailResult ?></h2>
