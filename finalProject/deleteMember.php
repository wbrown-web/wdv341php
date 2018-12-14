<?php
session_start();

if ($_SESSION["admin"] || $_SESSION["resumeAdmin"]) {
    } 
else {
  header("location:index.php");
  exit();
}

include 'connectPDO.php'; // Database connect file

$deleteId = $_GET['ID'];
if($deleteId == $deleteId)
{
    $stmt = $conn->prepare("DELETE FROM teammembers WHERE ID = '$deleteId'");
    $stmt->execute();
  header("location:updateMember.php");
}
else
{
  header("location:index.php");
}

?>