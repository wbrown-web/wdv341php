<?php
session_start();

?>
<!doctype html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css" type="text/css">
    <title>Contact</title>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <img src="images/logo.gif" alt="Will B Designed Logo">
        </div>
        <div class="col-lg-9">
            <h1 class="pagetitle">Will B Designed Team</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home<span class="sr-only"></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
<div class="container col-lg-9">
      <div class="container">
        <h1 style="text-align: center;" class="">Contact</h1>

        <form id="contact-form" method="post" action="contact.php" role="form">

          <div class="messages"></div>

          <div class="controls">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="form_name">First name *</label>
                  <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your firstname *" required="required" data-error="Firstname is required.">
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="form_lastname">Last name *</label>
                  <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Please enter your lastname *" required="required" data-error="Lastname is required.">
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="form_email">Email *</label>
                  <input id="form_email" type="email" name="form_email" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required.">
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="form_phone">Phone</label>
                  <input id="form_phone" type="tel" name="phone" class="form-control" placeholder="Please enter your phone">
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="form_message">Message*</label>
                  <textarea id="form_message" name="message" class="form-control" placeholder="Message for me *" rows="4" required="required" data-error="Please,leave us a message."></textarea>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="col-md-12">
                <input type="submit" class="btn btn-primary" value="Send message">
              </div>
            </div>
          </div>
        </form>
      </div>
  </div>



  <?php
  if(isset($_POST["submit"]))
    {
  /*
   *  CONFIGURE EVERYTHING HERE
   */
  // an email address that will be in the From field of the email.
  $from = 'contact@willbdesigned.com';
  // an email address that will receive the email with the output of the form
  $sendTo = $_POST["form_email"];
  // subject of the email
  $subject = 'New message from contact form';
  // form field names and their translations.
  // array variable name => Text to appear in the email
  $fields = array('name' => 'Name', 'surname' => 'Surname', 'phone' => 'Phone', 'email' => 'Email', 'message' => 'Message');
  // message that will be displayed when everything is OK :)
  $okMessage = 'Message Sent';
  // If something goes wrong, we will display this message.
  $errorMessage = 'There was an error while submitting the form. Please try again later';
  /*
   *  LET'S DO THE SENDING
   */
  // if you are not debugging and don't need error reporting, turn this off by error_reporting(0);
  error_reporting(0);
  try
  {
      if(count($_POST) == 0) throw new \Exception('Form is empty');
      $emailText = "You have a new message from your contact form\n=============================\n";
      foreach ($_POST as $key => $value) {
          // If the field exists in the $fields array, include it in the email
          if (isset($fields[$key])) {
              $emailText .= "$fields[$key]: $value\n";
          }
      }
      // All the neccessary headers for the email.
      $headers = array('Content-Type: text/plain; charset="UTF-8";',
          'From: ' . $from,
          'Reply-To: ' . $from,
          'Return-Path: ' . $from,
      );
      // Send email
      mail($sendTo, $subject, $emailText, implode("\n", $headers));
      $responseArray = array('type' => 'success', 'message' => $okMessage);
  }
  catch (\Exception $e)
  {
      $responseArray = array('type' => 'danger', 'message' => $errorMessage);
  }
  // if requested by AJAX request return JSON response
  if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
      $encoded = json_encode($responseArray);
      header('Content-Type: application/json');
      echo $encoded;
  }
  // else just display the message
  else {
      echo $responseArray['message'];
  }
}
?>

</body>
</html>