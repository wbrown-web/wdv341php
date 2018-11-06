<?php
	try{

        include 'connectPDO.php';			//connects to the database
//display error page (I currently don't want to make this)
        $stmt = $conn->prepare("SELECT event_id,event_name,event_description FROM wdv341_event WHERE event_id=:eventID");
        $selectID = 1;
        $stmt->bindParam(':eventID', $selectID);  // Hard coded event id of 2. Which will pull the event with ID of 2
        $stmt->execute();
    }
    catch(PDOException $e) {
        die();
    }
?>
<table border='1'>
	<tr>
		<td>ID</td>
		<td>Name</td>
		<td>Description</td>
		<td>UPDATE</td>
		<td>DELETE</td>
<?php 
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		echo "<tr>";
			echo "<td>" . $row['event_id'] . "</td>";
			echo "<td>" . $row['event_name'] . "</td>";	
			echo "<td>" . $row['event_description'] . "</td>";
			echo "<td><a href='updateEvent.php?eventID=" . $row['event_id'] . "'>Update</a></td>"; 
			echo "<td><a href='deleteEvent.php?eventID=" . $row['event_id'] . "'>Delete</a></td>"; 		
		echo "</tr>";
	}
?>
</table>