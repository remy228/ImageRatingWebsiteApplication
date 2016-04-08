<?php
class Details
{
function details(){
require("Config.php");
include "Connection.php";
$details = "SELECT image, avg(rating) from rating group by image";
$results = mysqli_query($db, $details);


while($row = mysqli_fetch_array($results))
{
	
	$imgname =  $row['image'];
	$ratingValue = $row['avg(rating)'];
	$insert = "UPDATE average set average = '$ratingValue' WHERE image = '$imgname'";
	$final = mysqli_query($db, $insert);
	
}

}
}
$db = new Details();
$db->details();
?>
