<!DOCTYPE html>
<head>
	<title>Image Rating</title>
	<link rel="icon" href="logofavicon.ico">
	<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
	<div class='float'>
		<img src='logo.png' alt="Logo" height="80" width="60">
	</div>
	<div class='float head'>
		<h1>Image Rating </h1>
	</div>
	<div class='float sign'>
		<a href="signin.php"><u>Sign In!</u></a>
		<a href="register.php"><u>Register</u></a>
	</div>
	<h2>Recent</h2>
	<?php
		include "recent.php"
	?>
	<h2>Popularity</h2>
	<?php
		include "popularity_unsigned.php";
		popularity_unsigned::popular();
		
	?>
	
</body>
</html>