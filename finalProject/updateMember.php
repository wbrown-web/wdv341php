<?php
session_start();

if ($_SESSION["admin"]) {
    } 
else {
  header("location:index.php");
  exit();
}

if(isset($_GET["ID"]) && ($_SESSION["admin"])){
    $updated_id = $_GET["ID"];
    $displayForm = "";
} 
else {
    $updated_id = 0;
    $displayForm = "hidden";
}

$signIn = $_SESSION["username"]; //Display Login Username

include 'connectPDO.php'; // Database connect file

// START: CARD LOAD FOR PAGE

try{
    $stmt = $conn->query("SELECT ID, memberName, memberImage, memberTitle, memberContact, begin_date, DATE_FORMAT(begin_date, '%m/%d/%Y') AS beginDate FROM teammembers");
}

catch(PDOException $e) {
    echo "Failed To Load Members " . $e->getMessage();
}
// END: CARD LOAD FOR PAGE

// START: MEMBER UPDATE

//Form Variables
$member_name = "";
$member_title = "";
$member_start = "";
$member_contact = "";
$member_image = ""; 

// Success Message
$member_success = "";
//Error Messages
$imgEror = "";
$errorMSG = "";

if( isset($_POST['uploadButton']) && isset($_SESSION["admin"])) {

    //Reset Variables for multiple uploads. 
    // Success Message
    $member_success = "";
    //Error Messages
    $imgEror = "";
    $errorMSG = "";
    
    if(!empty($_FILES['memberImage'])){
        

    // START: File Upload Piece
        $target_dir = "images/members/";
        $target_file = $target_dir . basename($_FILES["memberImage"]["name"]);
        $validUpload = 1; //boolean flag

        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["memberImage"]["tmp_name"]);
        if($check !== false) {
            $validUpload = 1;
        } 
        
        else {
            echo "File is not an image.";
            $validUpload = 0;
        }

        // START: Check File Type
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $imgEror = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $validUpload = 0;
        }
        // END: Check File Type
        
    //START: Actual File Move    
        // Check if $validUpload is set to 0 by an error
        if ($validUpload == 0) {
            $imgEror = "Sorry, your file was not uploaded.";

        // if everything is ok, try to upload file
        } 
        else {
            
            if (move_uploaded_file($_FILES["memberImage"]["tmp_name"], $target_file)) {      
            } 
            
            else {
            $imgEror = "Sorry, there was an error uploading your file.";
            }
        }
}
//END: Actual File Move
// END: File Upload Piece

// START: Form Content To Database
    $member_name = $_POST['memberName'];
    $member_title = $_POST['memberTitle'];
    $member_start = $_POST['begin_date'];
    $member_contact = $_POST['memberContact'];
    $member_image = "images/members/" . basename( $_FILES["memberImage"]["name"]);


    $sql = "UPDATE teammembers SET memberName=:memberName, memberTitle=:memberTitle, memberContact=:memberContact, begin_date=:begin_date, memberImage=:memberImage WHERE ID='$updated_id' ";

    try {
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':memberName', $member_name);
        $stmt->bindParam(':memberTitle', $member_title);
        $stmt->bindParam(':memberContact', $member_contact);
        $stmt->bindParam(':begin_date', $member_start);
        $stmt->bindParam(':memberImage', $member_image);
        $stmt->execute();

        $member_success = "Member was successfully updated!";
    }

    catch(PDOExeption $e){
        $errorMSG = "Failed To Add Member " . $e->getMessage();
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css" type="text/css">
    <title>Admin Panel</title>
</head>
<body>
<header>
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
        <div class="col-lg-6"></div>
        <div class="col-lg-4 text-right">Welcome back <?= $signIn ?>!</div>
        <div class="col-lg-2 text-left">
        <a href="logout.php">Logout</a>
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
                    <li class="nav-item">
                    <a class="nav-link" href="updateMember.php">Update Member</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="addMember.php">Add Member</a>
                    </li>
                </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
</header>
<main>

<!-- START: Members Display -->
<div class="container">
    <div class="row justify-content-center">
    <?php
    try {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
            //Form Variables
            $member_name = $row['memberName'];
            $member_title = $row['memberTitle'];
            $member_start = $row['begin_date'];
            $member_contact = $row['memberContact'];
            $member_image = $row['memberImage'];
    ?>
        <div class="col-lg-4 text-left">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="<?= $row['memberImage'] ?>" alt="<?= $row['memberName'] ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['memberName'] ?></h5>
                    <h6>Title: <?= $row['memberTitle'] ?></h6>
                    <p class="contact-info"><em><?= $row['memberContact'] ?> </em></p>
                    <p class="start-date text-right"><strong>Start Date: <?= $row['beginDate'] ?> </strong></p>
                </div>
                <?php
                    if(isset($_SESSION["admin"]) )
                    {
                      if($_SESSION["admin"]){
                    ?>
                <div class="card-footer">    
                    <a href="deleteMember.php?ID=<?= $row['ID'] ?>" class="card-link delete float-left">Delete</a>          
                    <a href="updateMember.php?ID=<?= $row['ID'] . ',#memberName'?>" class="card-link float-right">Update</a>
                </div>
                <?php
                      }
                    }
                ?> 
            </div>    
        </div>
    <?php
        }
    }
    catch(PDOExeption $e){
        $errorMSG = "Failed To Add Member " . $e->getMessage();
    }
    ?>
    </div>
</div>
<!-- END: Members Display -->

<!-- START: Update Form -->
<?php
  if($updated_id == $updated_id) {
    $stmt = $conn->query("SELECT * FROM `teammembers` WHERE `ID` = '$updated_id' ");
    while ($row = $stmt->fetch())
      {
        $languageArray[$row[0]] = $row[1];
        
        $member_name = $row['memberName'];
        $member_title = $row['memberTitle'];
        $member_start = $row['begin_date'];
        $member_contact = $row['memberContact'];
        $member_image = $row['memberImage'];
      }
  }
?>


<div class="container text-center <?= $displayForm ?>">
    <?php 
        if (strlen($member_success) > 0 ) {
    ?>
    <div class="row">
        <div class="col-lg-12 success-msg">
            <h2><?= $member_success ?></h2>
        </div>
    </div>
    <?php
        }
        if (strlen($imgEror) > 0) {
    ?>
    <div class="row">
        <div class="col-lg-12 error-msg">
            <h2><?= $imgEror ?></h2>
        </div>
    </div>
    <?php
        }
    ?>    
    
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <h1>Update Member Info</h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
        <!-- Has to Be Method = POST  
        ENCTYPE is important. Must HAVE!!! -->
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . "?recId=$updated_id"; ?>" method="POST" enctype="multipart/form-data" name="fileUploadForm">
        
        
            <label class="form-left" for="memberName">Name</label>
            <input type="text" class="form-control" name="memberName" id="memberName" value="<?= $member_name ?>">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <label class="form-left" for="memberTitle">Title</label>
            <input type="text" class="form-control" name="memberTitle" id="memberTitle" value="<?= $member_title ?>">
        </div>    
    </div>
    <div class="row justify-content-center">   
        <div class="col-lg-10">
            <label class="form-left" for="begin_date">Start Date</label>
            <input type="date" class="form-control" name="begin_date" id="begin_date" value="<?= $member_start ?>">
        </div>
    </div>
    <div class="row justify-content-center">    
        <div class="col-lg-10">   
            <label class="form-left" for="memberContact">Contact Email</label>
            <input type="text" class="form-control" name="memberContact" id="memberContact" value="<?= $member_contact ?>">
        </div>   
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <label class="form-left" for="memberImage">Add Photo</label>
            <input type="file" class="form-control" name="memberImage" id="memberImage" value="<?= $member_image ?>">
            <button type="submit" name="uploadButton" class="btn btn-primary form">Update Member</button>
        </div>
        </form>
    </div>
</div>
<!-- END: Update Form -->
</main>
<footer>
</footer>
</body>
</html>