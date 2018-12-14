<?php
session_start();

if(isset($_POST["submit"])){
    
  }

else {
      if (isset($_SESSION["admin"]) || isset($_SESSION["resumeAdmin"])) {
        session_unset();
        session_destroy();
      }
    // Fall through
    }

    include 'connectPDO.php'; // Database Connect File.

    $username = "";
    $password = "";
    $errMsg = "";
    $successMsg = "";
    $adminDisplayForm = "";
   
    $_SESSION["admin"] = false;
    $_SESSION["username"] = "";
    $_SESSION["resumeAdmin"] = false;
    
    if(isset($_POST["login"])){
      
        $username = $_POST['username'];
        $password = $_POST['password'];
       
        try {
            $stmt = $conn->query("SELECT * FROM `fpusers` WHERE `username` = '$username' AND `password` = '$password'");
            $signIn = $stmt->fetch();
           
            if (empty($signIn)){
              $errMsg = 'Please Try Again';
            } 

            else {
             
                if ($signIn["username"] == "resumeAdmin"){
                    $_SESSION["resumeAdmin"] = true;
                    $_SESSION["username"] = $signIn["username"];
                } 
                else {
                    $_SESSION["admin"] = true;
                    $_SESSION["username"] = $signIn["username"];
              }
              header("location:admin.php");
            }
          }

        catch(PDOException $e){
          echo "Connection failed: " . $e->getMessage();
          }
    }

    try{
        $stmt = $conn->prepare("SELECT memberName, memberImage, memberTitle, memberContact, DATE_FORMAT(begin_date, '%m/%d/%Y') AS beginDate FROM teammembers");
        $stmt->execute();
    }

    catch(PDOException $e) {
        echo "Failed To Load Members " . $e->getMessage();
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
    <title>Will B Designed Team</title>
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
    <div class="row justify-content-right">
        <div class="col-lg-12">
        <form id="loginForm" name="loginForm" method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label class="login" for="username">Username</label>
            <input type="text" placeholder="Username" id="username" name="username">
            <label class="login" for="password">Password</label>
            <input type="password" placeholder="Password" id="password" name="password">
            <input type="submit" class="btn btn-primary login" name="login" id="submit" value="login" />
        </form>
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
</header>  
<!-- END: Header -->
<main>
<div class="container">
    <div class="row justify-content-center">
    <?php 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
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
            </div>    
        </div>
    <?php
        }
    ?>
    </div>
</div>
</main>
<footer>
</footer>
</div>
</body>
</html>