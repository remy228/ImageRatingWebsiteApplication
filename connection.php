<?php
require "Config.php";
$db = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME) or die("Couldn't connect");


if (mysqli_connect_error()){
	echo "Failed to connect".mysql_connect_error();
}
?>
