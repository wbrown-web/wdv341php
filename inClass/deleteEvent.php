<?php

    if(isset( $_GET['eventID'] )) {
        $inEventID = $_GET['eventID']; // Pull ID from our GET parameter into a variable. 
    }

    else {
        header('Location: displayEvents.php');
    }

try {

    include 'connectPDO.php';			//connects to the database

    $stmt = $conn->prepare("DELETE FROM wdv341_event WHERE event_id=:eventID");

    $stmt->bindParam(':eventID', $inEventID);
    $stmt->execute();

}

catch(PDOException $e) {
    //display error page (I currently don't want to make this)
    die();
}

catch(Exception $e){
    //Something else broke. 
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
    
</body>
</html>