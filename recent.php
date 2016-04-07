<!DOCTYPE html>
<head>
	<link rel="icon" href="logofavicon.ico">
	<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<?php
	
	require("Config.php");
	include "Connection.php";


	//$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD);
	$dbused= "USE $DB_NAME";

	//Getting count
	$bottom = 3;
	//$count = "SELECT COUNT(*) FROM IMAGES";
	$query = "SELECT * FROM images ORDER BY timstamp DESC LIMIT 3";
	$result = mysqli_query($db, $query);
	$num_rows = mysqli_num_rows($result);
	$num_fields = mysqli_num_fields($result);
	if($num_rows<3)
	{
	for($j = 1; $j <= $num_rows; $j++)
	{
		$row = mysqli_fetch_array($result);
		//print $row[0].$row["image"]. "<br />";
		echo '<img src="./resources/'.$row["image"].'" alt="recent">';
		
	}
	}
	else
	{
		for($j = 1; $j <= 3; $j++)
	{
		$row = mysqli_fetch_array($result);
		//print $row[0].$row["image"]. "<br />";
		echo '<img src="./resources/'.$row["image"].'" alt="recent">';
		
	}
	}	
	
	

?>

</body>

</html>
