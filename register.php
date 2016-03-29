<?php

if(isset($_POST['register'])){
	$uname = strip_tags($_POST['username']);
	$name = strip_tags($_POST['name']);
	$pwd =strip_tags($_POST['password']);
	$pwd1 =strip_tags($_POST['password1']);
	if($uname AND $name AND $pwd AND $pwd1){
		//All fieds were entered 
		if($pwd === $pwd1 ){
			//Passwords match
			include_once('connection.php');
			$checkUserSql = "SELECT username FROM members WHERE username = '$uname'";
			$checkResult = mysqli_query($db, $checkUserSql);
			$checkUserResult = mysqli_num_rows($checkResult);
	
			if ($checkUserResult == 0){
				$sql = "INSERT INTO members VALUES ('$uname', '$name', '$pwd')";
				$query = mysqli_query($db, $sql);
				$sql_check = "SELECT username, name, password FROM members WHERE username='$uname' AND name='$name'";
				$query_check = mysqli_query($db, $sql_check);
				$check_num_rows = mysqli_num_rows($query_check);
				if ($check_num_rows === 1){
					//If successfully registered, do a GET redirect to signin.php
					header("Location: signin.php?message=You were successfully registered. Login with your details now.");
				}
				else{
					//If something happened
					echo("Something went wrong. Please try again");
				}
			}
			else{
				//If username already exists
				echo ("The username already exists. Try something else.");
				
			}
		}
		else
		{
			//If password and password1 dp not match
			echo("The passwords do not match. Please try again");
			
		}
	}
	else{
		//User did not enter all the details
		echo("Make sure you enter all details!");
		
	}
}

?>


<!DOCTYPE html>
<head>
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
		#rule{
			font-size:15px;
			font-weight: normal;
		}
	</style>
</head>
<body>
	<form method='POST' action='register.php'>
	<br />
		<div id='text'>
			<label name='register'><u>Register for an account! Enter your details below</u><br>
			<label for='username' name='uname'> Username: 
			<input type='text' id='username' name='username' placeholder='Enter your username'><br /><br /><br />
			<label for='name' name='name'> Name: 
			<input type='text' id='name' name='name' placeholder='FirstName Surname'><br /><br /><br />
			<label for='password' name='pwd'> Password:  
			<input type='password' id='password' name='password' placeholder='Enter your password'>
				<div id='rule'>Should not be more than 8 alphanumeric characters</div><br />
			<label for='password1' name='pwd1'> Re-type Password:  
			<input type='password' id='password1' name='password1' placeholder='Re-type password'><br />
			<input type='submit' value='Register' name='register'> 
			<a href='signin.php'><u>Sign In</u></a>
		</div>
	</form>
</body>
</html>