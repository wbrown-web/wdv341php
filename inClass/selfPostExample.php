<?php
  // Form Field Variables
  $valid_form = false;
  $prod_name = "";
  $prod_price = "";
  // $prod_radio = "";

  // Error Messages
  $nameErrMsg = "";




	if(isset($_POST["prod_submit"])){
    // process form data
    // echo "<h1>Form has been submitted and should be processed</h1>";
    $prod_name = $_POST['prod_name'];
    $prod_price = $_POST['prod_price'];
    $prod_radio = $_POST['prod_radio'];
    
    // *** Validation Section ***
   

    $valid_form = true; //set validation flag assume all fields are valid
    
    include 'formValidationFunctions.php'; 

    // if( validateProdName($prod_name) ) {   //one way of doing it with more code

    // }
    // else {
    //   $valid_form = false;                                             
    //   $name_errMsg = "Please enter a product name";
    // }

    if( !validateProdName($prod_name) ) { //another way of doing the validation. Less code. 
      $valid_form = false;
      $nameErrMsg = "Please enter a product name";
      
    }

    if($valid_form) {
      // form is good send to db
      // include pdo
      // create sql insert command 
      // try catch block 
      //   prepare the statement pdo prepared statements
      //   bind my variables to the prepared statements
      //   execute your prepared stream_get_transports
      // confirmation message DO NOT DISPLAY FORM!!!
            // only do this if the database worked
            // display confirmation INSTEAD of the form
            // Message: "Thank you it worked!"

    }

  }

  // else { //show the form to the customer

  

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Self Post Example</title>
</head>

<body>

<h1>WDV341 Intro PHP </h1>
<h2>Unit-8 Self Posting Form</h2>
<h3>Example Form</h3>
<p>Converting a form to a self posting form.</p>

<?php 
  if($valid_form) {
    ?>
    <h1>Form Was Successful</h1>
<?php
  }
  else{
  ?>
<form name="form1" method="post" action="selfPostExample.php">
  <p>
    <label for="prod_name">Product Name: </label>
    <input type="text" name="prod_name" id="prod_name" value="<?= $prod_name; ?>"><span id="nameErrMsg"><?= $nameErrMsg; ?></span>
  </p>
  <p>
    <label for="prod_price">Product Price: </label>
    <input type="text" name="prod_price" id="prod_price">
  </p>
  <p>Product Color:</p>
  <p>
    <input type="radio" name="prod_radio" id="prod_red" value="prod_red">
    <label for="prod_red">Red Wagon<br>
    </label>
    <input type="radio" name="prod_radio" id="prod_green" value="prod_green">
    <label for="prod_green">Green Wagon</label>
  </p>
  <p>
    <input type="submit" name="prod_submit" id="prod_submit" value="Submit">
    <input type="reset" name="Reset" id="button" value="Reset">
  </p>
</form>
<?php 
  } //End Of If statement for Form being good or not
?>

<p>&nbsp;</p>
<?php 
//} //End Of Else Statement
?> 
</body>
</html>