<?php
$serverName = "localhost";
$username = "root";  //Root is default user name in XAMPP
$password = "";  // Password is left blank by defualt in XAMPP
$database = "wdv341";  //Name Of database

try {
    $conn = new PDO("mysql:host=$serverName;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>
