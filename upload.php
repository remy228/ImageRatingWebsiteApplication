<?php

require("Config.php");
session_start();
if($_SESSION['logged'] === true) {

   $user = $_SESSION["username"];
    
   echo $user;
}

//flag ==1 implies that the file upload progress is OK if $flag ==0 it implies that the file upload failed
$target_dir = "resources/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$flag = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $flag = 1;
    } else {
        echo "File is not an image.";
        $flag = 0;
    }
}

// Checking if file already exists
if (file_exists($target_file)) {
    echo "File already exists ";
    
    $flag = 0;
}


// Allow only JPG AND JPEG files
if($imageFileType != "jpg" && $imageFileType != "jpeg") {
    echo "Only JPG, JPEG files are allowed";
    $flag = 0;
}


//final upload if all the restrictions have been passed.
if ($flag == 0) {
    echo "Image was not uploaded.";
} else {



$exif = exif_read_data($_FILES["fileToUpload"]["tmp_name"], 0, true);
$Original_Height=$exif['COMPUTED']['Height'];
$Original_Width=$exif['COMPUTED']['Width'];


echo $Original_Height;
echo $Original_Width;

$new_Height= (500 * $Original_Height)/($Original_Width);

 if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        echo $_POST["caption"];
        list($t,$image) = split('/',$target_file);
           $_SESSION["image"]=$image;
		   

$rsr_org = imagecreatefromjpeg("./$target_file");
$rsr_scl = imagescale($rsr_org, 500, $new_Height);
$newimg = imagejpeg($rsr_scl, "./$target_file");
imagedestroy($rsr_org);
imagedestroy($rsr_scl);

//edit start SQL insert
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD);
$dbused= "USE $DB_NAME";

// Check connection
if ($conn->connect_error ) {
    die("Connection failed: " . $conn->connect_error);
} 

// TIMESTAMP (NEW)

$currTime=$_SERVER['REQUEST_TIME'];
$caption=$_POST["caption"];
$insertion= "INSERT INTO images VALUES ('$user' , '$image', '$caption', '$currTime')";
if ( $conn->query($dbused) === TRUE && $conn->query($insertion) === TRUE ) {
    echo "Successfully inserted";
    header('Location: index2.php');
} 
else {
    echo "Error: " . $conn->error;
	 }

//edit stop


        
    } else {
        echo "error while uploading the file";
    }
}





//include(rating.php);
//$conn->close();

?>