<?php 

//Set Initial Flag
$validForm = false;
//Post Variables

$inName = "";
$inSoc = "";
$inResp = "";

//Error Messages

$name_errMsg = "";
$soc_errMsg = "";
$response_errMsg = "";

if (isset($_POST['submit'])) {
  if( !empty($_POST['badhoneypotname']) ) {
    die();
  }
    $inName = $_POST['inName'];
    $inSoc = $_POST['inSoc'];

    if(isset($_POST['RadioGroup1']))
    {
      $inResp = $_POST['RadioGroup1'];
    }
    else {
      $inResp = "";
    }

    $validForm = true;

    include 'validations.php';

    if( !validateName($inName)) {
      $validForm = false;
      $name_errMsg = "Please Enter Customer Name";
    }

    if( !validateSoc($inSoc)) {
      $validForm = false;
      $soc_errMsg = "Please Enter Your Soc";
    }

    if( !validateResp($inResp)) {
      $validForm = false;
      $response_errMsg = "Please Choose a Response";
    }

    if($validForm) {
      
      try {
        include 'connectPDO.php'; // Conenct to my DB
        
        $sql = "INSERT INTO table_name (cust_name, cust_soc, cust_resp) VALUES (:custName, :custSoc, :custResp)"; //insert multiple columns by using a comma||Values Must follow how you've laid out the columns in the SQL
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':custName', $inName); 
        $stmt->bindParam(':custSoc', $inSoc);
        $stmt->bindParam(':custResp', $inResp);
        $stmt->execute();
    }
    
      catch(PDOException $e) {
      echo "<p>something went wrong</p>";
      die();
      }
    }
}
?>

<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - Form Validation Example</title>
<style>

#orderArea	{
	width:600px;
	background-color:#CF9;
}

.error	{
	color:red;
	font-style:italic;	
}

.terribleHoneyPot {
  display: none;
}

</style>
</head>

<body>
<h1>WDV341 Intro PHP</h1>
<h2>Form Validation Assignment</h2>
<?php 
if($validForm){
  ?>
  <h1>Form Was Successful</h1>
  <?php
}
else{
?>
<div id="orderArea">
  <form id="form1" name="form1" method="post" action=<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>>
  <h3>Customer Registration Form</h3>
  <table width="587" border="0">
    <tr>
      <td width="117">Name:</td>
      <td width="246"><input type="text" name="inName" id="inName" size="40" value="<?= $inName ?>"/></td>
      <td width="210" class="error"> <span><?= $name_errMsg ?></span> </td>
    </tr>
    <tr>
      <td>Social Security</td>
      <td><input type="text" name="inSoc" id="inSoc" size="40" value="<?= $inSoc ?>" /></td>
      <td class="error"> <span><?= $soc_errMsg ?> </span> </td>
    </tr>
    <tr>
      <td>Choose a Response</td>
      <td><p>
        <label>
          <input type="radio" name="RadioGroup1" id="RadioGroup1_0" value="RadioGroup1_0" <?php if ($inResp == "RadioGroup1_0") {echo "checked";}?>>
          Phone</label>
        <br>
        <label>
          <input type="radio" name="RadioGroup1" id="RadioGroup1_1" value="RadioGroup1_1" <?php if ($inResp == "RadioGroup1_1") {echo "checked";}?>>
          Email</label>
        <br>
        <label>
          <input type="radio" name="RadioGroup1" id="RadioGroup1_2" value="RadioGroup1_2" <?php if ($inResp == "RadioGroup1_2") {echo "checked";}?>> 
          US Mail</label>
        <br>
      </p></td>
      <td class="error"><span><?= $response_errMsg ?></span></td>
    </tr>
    <tr>
    </tr>
    <td class="terribleHoneyPot">
    <input type="text" id="badhoneypotname" name="badhoneypotname">
    </td>
  </table>
  <p>
    <input type="submit" name="submit" id="button" value="Register" />
    <input type="reset" name="button2" id="button2" value="Clear Form" />
  </p>
</form>
</div>
<?php
}//end Valid form confirmation
?>
</body>
</html>