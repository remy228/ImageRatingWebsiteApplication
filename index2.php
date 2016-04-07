<?php
session_start();
if($_SESSION['logged'] === true) {

   print $_SESSION["username"];
}

?>
<!DOCTYPE html>
<html>
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
	
	<div id='logout'>
	<a href="index.php">Logout</a>
	</div>
	
	<h2>Recent</h2>
	<?php
		include "recent.php";
	?>
	<h2>Popularity</h2>
	<?php
		include "popularity.php";
		popularity::popular();
		
	?>
	
	 <a href="image_upload_htmlform.html"><button type="button">Upload!</button></a>
<?php
	
$currTime=$_SERVER['REQUEST_TIME'];


?>
</body>
</html>