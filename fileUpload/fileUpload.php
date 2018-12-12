<?php

    if( isset($_POST['uploadButton'])) {

        $target_dir = "uploadimages/";
        $target_file = $target_dir . basename($_FILES["fileUploader"]["name"]);
        $validUpload = 1;  //boolean flag
 
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileUploader"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $validUpload = 1;
        } else {
            echo "File is not an image.";
            $validUpload = 0;
        }

        // START: Check File Type
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $validUpload = 0;
        }
        // END: Check File Type
        
    //START: Actual File Move    
        // Check if $validUpload is set to 0 by an error
        if ($validUpload == 0) {
            echo "Sorry, your file was not uploaded.";

        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileUploader"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileUploader"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    //END: Actual File Move


    }

    else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>File Upload Form</title>
</head>
<body>
<header>
<h1>File Upload Form</h1>
</header>
<main>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
        <!-- Has to Be Method = POST  
        ENCTYPE is important. Must HAVE!!! -->
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data" name="fileUploadForm">
        <div class="form-group">
            <label for="pictureName">Picture Name</label>
            <input type="text" name="pictureName" id="pictureName">
            <br>
            <input type="file" name="fileUploader" id="fileUploader">
        </div>
        <button type="submit" name="uploadButton" class="btn btn-primary">Upload File</button>

        </form>
        </div>
    </div>
</div>
</main>
<footer>
</footer>    
</body>
</html>
<?php 
    }
?>