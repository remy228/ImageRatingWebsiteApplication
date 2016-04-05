<?php
require("Config.php");
//include $createConstants.".php";
//class CreateDatabase extends createConstants
//{
//function createdb(){
//$obj1=new createConstants();
//$obj1->createConst();	
// Create connection
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Create database
$sql = "CREATE DATABASE $DB_NAME";
$dbused= "USE $DB_NAME";
$user = "CREATE TABLE user(name varchar(20), uname varchar(10) primary key, password varchar(10))";
$image = "CREATE TABLE rating(uname varchar(10) unique , image varchar(10), rating int(1))";
$userimage= "CREATE TABLE images(uname varchar(10), image varchar(10))";

if ($conn->query($sql) === TRUE AND $conn->query($dbused) === TRUE AND $conn->query($user) === TRUE AND $conn->query($image) === TRUE AND $conn->query($userimage) === TRUE) {
    echo "Successfully created";
} 
else {
    echo "Error: " . $conn->error;
	 }

//}
//}
//$db = new CreateDatabase();
//$db->createdb();
$conn->close();
?>