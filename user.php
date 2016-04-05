<?php 

include "signin.php";
session_start();
if($_SESSION['logged'] === true) {

   print $_SESSION["username"];
}

?>
<!DOCTYPE html>
<head>
	<title>Hi</title>
</head>
<body>
	<h1>Yay</h1>
</body>
<html>
