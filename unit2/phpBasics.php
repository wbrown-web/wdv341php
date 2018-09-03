<?php
// START: Question 1
$yourName = "Will Brown";
// END: Question 1

// START: Question 4
$number1 = 2;
$number2 = 3;
$total = $number1 + $number2;
// END: Question 4

 ?>


 <!DOCTYPE html>
 <head>
<meta charset="utf-8">
 </head>

 <body>
<!-- START: Question 1    -->
<p>1) $yourName variable holds: <?= $yourName ?></p>
<!-- END: Question 1 -->

<!-- START: Question 2 -->
<p>2) Assignment displayed as an H1</p>
<?= "<h1>PHP Basics</h1>" ?>
<!-- END: Question 2 -->

<!-- START: Question 3 -->
<p>3) HTML H2 used to display the variable from question 1</p>
<h2> <?= $yourName ?> </h2>
<!-- END: Question 3 -->

<!-- START: Question 5 -->
<p>4&5) The value of $number1 is <?= $number1 ?>, the value of $number2 is <?= $number2 ?>, they total <?= $total ?> </p>
<!-- END: Question 5 -->

<!-- START: Question 6 -->
<p>The array named 'code' holds the following values:
<br>
  <?= "<script>
var code = ['PHP', 'HTML', 'Javascript'];
for (i=0; i < code.length; i++){
document.write(code[i] + '<br>');
};
</script>"  ?>
<p>
<!-- END: Question 6 -->
 </body>
