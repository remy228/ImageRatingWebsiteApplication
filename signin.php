<?php

error_reporting(E_ALL & ~E_NOTICE);
session_start();
$nameErr ="";
if(!empty($_GET['message'])) {
    $message = $_GET['message'];
	echo $message;
}
if(isset($_POST['submit'])){
	
	include_once("connection.php");
	$uname = strip_tags($_POST['username']);
	$pwd = strip_tags($_POST['password']);
	
	$sql = "SELECT name, uname, password FROM user WHERE uname='$uname' AND password='$pwd'";
	$query = mysqli_query($db, $sql);
	
	if($query){
		$result = mysqli_fetch_row($query);
		$user = $result[1];
		$password = $result[2];
	}
	if($user == $uname && $pwd == $password){
		$_SESSION['logged'] = true;
		$_SESSION['username']= $uname;
		
		header('Location: index2.php');
	}
	else{
		echo "Incorrect name and password";
	}
}

?>

<!DOCTYPE html>
<head>
	<link rel="icon" href="logofavicon.ico">
	<link rel="stylesheet" type="text/css" href="mystyle.css">
	
	<title>Login</title>
	<style>
		form{
			margin: auto;
			width: 60%;
			border: 3px solid teal;
			padding: 10px;
		}
		#text{
			font-weight: bold;
			text-align: center;
		}
		body{
			background-color:tan;
		}
	</style>
</head>
<body>
	<form method='POST' action='signin.php'>
	<br />
		<div id='text'>
		<label name='login'><u>Login</u><br>
		<label for='username' name='uname'> Username: 
		<input type='text' id='username' name='username' placeholder='Enter your username'><br /><br /><br />
		<label for='password' name='password'> Password:  
		<input type='password' id='password' name='password' placeholder='Enter your password'><br />
		<input type='submit' value='Log In' name='submit'>     
		<a href='register.php'><u>Register</u></a>
		</div>
	</form>
</body>
</html>