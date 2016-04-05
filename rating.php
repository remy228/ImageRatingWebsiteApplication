<?php
//require_once("model.php");
session_start();
if($_SESSION['logged'] === true) {

   $user = $_SESSION["username"];
   $img=$_SESSION["image"];
   echo $user;
}
error_reporting(E_ALL & ~E_NOTICE);
require_once("Config.php");
include "Connection.php";
	if(isset($_POST['submit']))
	{
		if(isset($_POST['rating'])){
		    $rating = $_POST['rating'];
		    }
		
	}
	else{
	    echo "Please select value to be inserted";
	    }
	//$imageconn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD);
	
	$dbUsed= "USE $DB_NAME";
	if(mysqli_query($db, $dbUsed) === TRUE)
	{
		echo "Database selectd";
	}
	else
	{
		echo "No db";
	}
	$insert= "INSERT INTO rating values('$user','$img',$rating)";
	if(mysqli_query($db, $insert) === TRUE)
	{
		echo "Inserted";
	}
	else
	{
		echo "Error:";
	}
?>
<!DOCTYPE html>
<html>
<body>

<form method = 'POST' action="rating.php">
<select name="rating">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
</select>
<input type="submit" name="submit"  value="Submit">
</form>
<p>Choose a rating.</p>
</body>
</html>
