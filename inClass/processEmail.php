<?php
  require 'Emailer.php'; //access the class file we created for use on the page

  $businessEmail = new Emailer(); //instantiate a new instace of a class

  $businessEmail->setMessageLine("Hello Class"); //loaded a value into the object

  $businessEmail->setSenderAddress("contact@willbdesigned.com");

  $businessEmail->setSendToAddress("wbrown84@gmail.com");

  $businessEmail->setSubjectLine("test");

  $validEmail= $businessEmail->sendPHPEmail();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>WDV341 Email Processor</title>
</head>
<body>
  <h1>WDV 341 Class Email Example</h1>
<!-- We want to display the message we just set in setMessageLine. The best spot for this is in the View of the MVC -->
<p>Your sending this to: <?= $businessEmail->getSendToAddress(); ?></p>
<p>Your sending this from: <?= $businessEmail->getSenderAddress(); ?></p>
<p>The subject of this email is: <?= $businessEmail->getSubjectLine(); ?></p>
<p>Your email message is: <?= $businessEmail->getMessageLine(); ?></p>

<?php if ($validEmail) {
  ?>
<p>Thank you for your email. We will respond as soon as possible.</p>
<?php
}
else {
  ?>
<p>Sorry, something went wrong. Contact Web Admin.</p>
<?php
}
?>

</body>
</html>
