<?php
$serverName = "localhost";
$username = "rwbrown84_php";  //Root is default user name in XAMPP
$password = "50rQH1dQzo";  // Password is left blank by defualt in XAMPP
$database = "rwbrown84_php";  //Name Of database

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
