<?php

include 'Database.php';

$params = array(':eventName' => "InClass", ":eventDescription" => "HALP!",":eventPresenter" => "Yassir", ":eventDate" => "", ":eventTime" => ""); //associative array most match how many binds we have in SQL. IE below is just eventID

$db= new Database("localhost", "wdv341", "root", "");

$sql = "INSERT INTO wdv341_event (event_name, event_description, event_presenter, event_date, event_time) VALUES (:eventName, :eventDescription, :eventPresenter, :eventDate, :eventTime)";

$db->preparePDO($sql);

$dbResult = $db->executePDO($params);

// $rowCount = $dbResult->rowCount();

// echo "<h3>$rowCount</h3>";

// TESTING FOR SENDING NO PARAM INTO executePDO()

$sql = "SELECT event_id,event_name,event_description FROM wdv341_event WHERE event_id=4";

$db->preparePDO($sql);

$dbResult = $db->executePDO();

$rowCount = $dbResult->rowCount();

echo "<h3>$rowCount</h3>";
?>