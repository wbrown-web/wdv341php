<?php

    require 'connectPDO.php';

    $event_name = $_POST['event_name']; //Event Name Value Pulled From event_name name att on form
    $event_description = $_POST['event_description'];
    $event_presenter = $_POST['event_presenter'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];


    $sql = "INSERT INTO wdv341_event (event_name, event_description, event_presenter, event_date, event_time) VALUES (:eventName, :eventDescription, :eventPresenter, :eventDate, :eventTime)"; //insert multiple columns by using a comma||Values Must follow how you've laid out the columns in the SQL

    // Use a "Try Catch Block" so that we know if something went wrong and where it went wrong

    try {
    $stmt = $conn->prepare($sql); //prepare the sql PDOStatement
    $stmt->bindParam(':eventName', $event_name); //bind placeholder to a value
    $stmt->bindParam(':eventDescription', $event_description);
    $stmt->bindParam(':eventPresenter', $event_presenter);
    $stmt->bindParam(':eventDate', $event_date);
    $stmt->bindParam(':eventTime', $event_time);
    $stmt->execute();
    }
    catch(PDOException $e) {
        die();
    }

 ?>

 <!DOCTYPE html>
 <html>

<head>
<meta charset="utf-8">
<title>Untitled Doc</title>
</head>
<body>

</body>
</html>
