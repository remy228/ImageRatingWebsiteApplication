<!DOCTYPE html>
<head></head>
<body>
<?php
require("Config.php");
include "Connection.php";


//$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD);
$dbused= "USE $DB_NAME";

// Check connection



$query ="SELECT avg(rating) as rat,image from rating group by image order by rat desc";
$result = mysqli_query($db, $query);
$num_rows = mysqli_num_rows($result);
$num_fields = mysqli_num_fields($result);
if($num_rows<10)
{
for($j = 1; $j <= $num_rows; $j++)
{
	$row = mysqli_fetch_array($result);
	//print $row[0].$row["image"]. "<br />";
	echo '<img src="./resources/'.$row["image"].'" alt="Cover">';
	
}
}
else
{
    for($j = 1; $j <= 10; $j++)
{
	$row = mysqli_fetch_array($result);
	//print $row[0].$row["image"]. "<br />";
	echo '<img src="./resources/'.$row["image"].'" alt="Cover">';
	
}
    
}
?>

</body>

</html>
