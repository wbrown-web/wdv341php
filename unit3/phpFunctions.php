<?php

$programName = " DMACC Web Development ";
$numbers = 1234567890;
$currency = 123456;


// Question 1
function dateMDY() {
  echo date('m/d/Y');
}

// Question 2
function dateDMY() {
  echo date('d/m/Y');
}

// Question 3
function questionThree($inString) {
  echo "<p>".strtolower(trim($inString))." has ".strlen($inString)." characters.</p>";
  
  $dmacc = strpos($inString, "DMACC");

  if($dmacc === false) {
    echo "$inString does not contain DMACC.";
  }
  
  else {
    echo "$inString does contain DMACC.";
  }
}

// Question 4
function numberFormatter($inNumber) {
  return number_format($inNumber);
}

// Question 5
function usCurrency($inCurrency) {
  // Doesn't work because I forgot Jeff is a jerk and this only works on macs. :(
 
    // setlocale(LC_MONETARY, "en_US.UTF-8");
  // return money_format("%.2n", $inCurrency);   

  echo "$".number_format($inCurrency, 2); //quick and easy fix w/o a bunch of code 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
<h1>PHP Functions</h1>

<p>1.) Create a function that will accept a date input and format it into mm/dd/yyyy format.</p>
<p><?= dateMDY(); ?></p>
<p>2.) Create a function that will accept a date input and format it into dd/mm/yyyy format to use when working with international dates.</p>
<?= dateDMY(); ?>
<p>3.) Create a function that will accept a string input.  It will do the following things to the string:</p>
  <ol>
    <li>Display the number of characters in the string</li>
    <li>Trim any leading or trailing whitespace</li>
    <li>Display the string as all lowercase characters</li>
    <li>Will display whether or not the string contains "DMACC" either upper or lowercase</li>
  </ol>
<p><?= questionThree($programName); ?></p>
<p>4.) Create a function that will accept a number and display it as a formatted number.   Use 1234567890 for your testing.</p>
<?= numberFormatter($numbers); ?>
<p>5.) Create a function that will accept a number and display it as US currency.  Use 123456 for your testing.</p>
<p><?= usCurrency($currency); ?></p>
</body>
</html>
