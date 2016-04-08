

<?php
include_once "details.php";
//require_once("model.php");
if (!isset($_SESSION)) { session_start(); }
if($_SESSION['logged'] === true) {

   $user = $_SESSION["username"];
  // $img=$_SESSION["image"];
}
error_reporting(E_ALL & ~E_NOTICE);
require_once("Config.php");
include "Connection.php";
//checking that only one user can rate 

 $dbused= "USE $DB_NAME";

            
           // $num_fields = mysqli_num_fields($result);
            //$num_fields2 = mysqli_num_fields($result2);
            
            
	//connecting to db
	//$dbUsed= "USE $DB_NAME";
	
	
	//if you press submit
	if(isset($_POST['submit']))
	{
		//Add Jay
		//include_once "details.php";
		$details = new Details();
		$details->details();
		
		
	    $im=$_POST['result'];

            // Check connection
            $query ="SELECT count(uname) as rat from rating where uname = '$user' and image = '$im'";
           // $query2="SELECT image from images order by timstamp desc";
              //echo "user",$user;
              //echo "image",$im;

            $result = mysqli_query($db, $query);
            
            //$result2 = mysqli_query($db, $query2);            

            $num_ros = mysqli_fetch_array($result);
            //$y =$num_ros;
            $t=0;
            $y=$num_ros["rat"];
            
            
	 //check if 1 user rated this image before
	 if($y==0)
	 {   
	    
			
		if(isset($_POST['rating'])){
			$rating = $_POST['rating'];
			}
			  if (isset($im))
			  {
				$insert= "INSERT INTO rating values('$user','$im','$rating')";
				}
		if(mysqli_query($db, $insert) === TRUE)
		{
			echo "Inserted";
			header("Location: index2.php");
		}
		else
		{
			echo "You already rated";
			header("Location: index2.php");
		}
		
	}
	else
	{	
	    header('Location: index2.php?message=Oops you cannot rate this image twice');
		
	    }
	}
	else{
	    echo "Please select value to be inserted";
	    }
	//$imageconn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD);
	
	$db->close();
	
?>
