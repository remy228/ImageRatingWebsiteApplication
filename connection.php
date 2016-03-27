<?php

$db = mysqli_connect("localhost", "root", "", "users") or die("Couldn't connect");


if (mysqli_connect_error()){
	echo "Failed to connect".mysql_connect_error();
}
?>
