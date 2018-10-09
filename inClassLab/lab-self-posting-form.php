<?php
  // R. William Brown

  // Form Field Vairables
  $valid_form = false;
  $lab_name = "";
  $lab_email = "";
  $lab_fax = "";

  // Error Messages

  $name_errMsg = "";
  $email_errMsg = "";

  if( isset($_POST["button"]) ){
    // process form data

    $lab_name = $_POST['lab_name'];
    $lab_email = $_POST['lab_email'];
    $lab_fax = $_POST['lab_fax'];
    	//BEGIN: FORM VALIDATION
	
  	$valid_form = true;		
	
	  //validate name - Cannot be empty
    if( empty($lab_name)) {
      $name_errMsg = "Please enter a name";
      $valid_form = false;
    }

    //validate email using PHP filter
    if( !filter_var($lab_email, FILTER_VALIDATE_EMAIL)) {
      $email_errMsg = "Invalid email";
      $valid_form = false;	
    }

    // honeypot validation
    if( !empty($lab_fax)) {
      $valid_form = false;
      die();
    }
      // END: FORM vALIDATION
    
    if($valid_form) {
      // Form is good send to DB
      // include pdo 
      // create sql insert command 
      // try catch block
      //   prepare the stmt pdo prepared statements
      //   bind my variables to the prepared stmts 
      //   execute your prepared stmts 
      // confirmation message DO NOT DISPLAY FORM 
      //     only do this if the db worked
      //     display confirmation INSTEAD of the form 
      //     Message: Thank you it worked!
    }  

  }

  // else show the form to the customer

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>WDV341 Intro PHP</title>
<style>
.green {
  border: 2px solid green;
  background: lightgrey;
  color: green;
  width: 300px;
}

label[for="lab_fax"],
#lab_fax,
#fax_errMsg{
  display: none;
}
</style>
<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>


<h1>WDV341 Intro PHP</h1>
<h2>Unit-7 and Unit-8 Form Validations and Self Posting Forms.</h2>
<h3>In Class Lab - Self Posting Form</h3>
<?php
    if($valid_form) {
?>
<div class="green">
<h1>Form Was Successful</h1>
</div>
<?php 
    }
    else {  //START: Else Statement (Shows form if no submit)
?>
<p><strong>Instructions:</strong></p>
<ol>
  <li>Modify this page as needed to convert it into a PHP self posting form.</li>
  <li>Use the validations provided on the page for the server side validation. You do NOT need to code any validations.</li>
  <li>Modify the page as needed to display any input errors.</li>
  <li>Include some form of form protection.</li>
  <li>You do NOT need to do any database work with this form. </li>
</ol>
<p>When complete:</p>
<ol>
  <li>Post a copy on your host account.</li>
  <li>Push a copy to your repo.</li>
  <li>Submit the assignment on Blackboard. Include a link to your page and to your repo.</li>
</ol>
<form name="form1" method="post" action="lab-self-posting-form.php">
  <p>
    <label for="lab_name">Name:</label>
    <input type="text" name="lab_name" id="lab_name" value="<?= $lab_name; ?>"><span id="name_errMsg"><?= $name_errMsg; ?></span>
  </p>
  <p>
    <label for="lab_email">Email:</label>
    <input type="text" name="lab_email" id="lab_email" value="<?= $lab_email; ?>"> <span id="email_errMsg"><?= $email_errMsg; ?></span>
  </p>
  <p>
    <label for="lab_fax">Fax:</label>
    <input type="text" name="lab_fax" id="lab_fax" value=""><span id="fax_errMsg"></span>
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Submit">
    <input type="reset" name="button2" id="button2" value="Reset">
  </p>
</form>
<h2>Worried about those itchy red bots?</h2>
<h4>No worries, we have you covered!</h4>
<img src="protection.jpg" alt="The Best Brand For Protection">
<?php
    }  //END: Else Statement (Shows form if no submit)
?>
<p>&nbsp;</p>
</body>
</html>
