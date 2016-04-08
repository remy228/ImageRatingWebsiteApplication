<?php
class upload
{
    
function uploading()
{
        require("Config.php");
        session_start();
        if($_SESSION['logged'] === true) 
        {

            $user = $_SESSION["username"];   
            echo $user;
        }

    //flag ==1 implies that the file upload progress is OK if $flag ==0 it implies that the file upload failed
    $target_dir = "resources/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $flag = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"]))
    {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false)
        {
            echo "File is an image - " . $check["mime"] . ".";
            $flag = 1;
        } 
        else 
        {
        echo "File is not an image.";
        $flag = 0;
        }
    }

    // Checking if file already exists
    if (file_exists($target_file)) 
    {	//Add Jay
        echo header("Location:index2.php?message=File already exists. Make sure you upload another image or rename the image. ");
        $flag = 0;
    }


    // Allow only JPG AND JPEG files
    if($imageFileType != "jpg" && $imageFileType != "jpeg") 
    {
        echo "Only JPG, JPEG files are allowed";
        $flag = 0;
    }


    //final upload if all the restrictions have been passed.
    if ($flag == 0) 
    {	//Add Jay
        echo "\n Image was not uploaded. Please try again";
    } 
    else 
    {
    $exif = exif_read_data($_FILES["fileToUpload"]["tmp_name"], 0, true);
    $Original_Height=$exif['COMPUTED']['Height'];
    $Original_Width=$exif['COMPUTED']['Width'];
    echo $Original_Height;
    echo $Original_Width;
    $new_Height= (500 * $Original_Height)/($Original_Width);

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
        {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            echo $_POST["caption"];
            list($t,$image) = split('/',$target_file);
            $_SESSION["image"]=$image;
            $rsr_org = imagecreatefromjpeg("./$target_file");
            $rsr_scl = imagescale($rsr_org, 500, $new_Height);
            $newimg = imagejpeg($rsr_scl, "./$target_file");
            imagedestroy($rsr_org);
            imagedestroy($rsr_scl);
            
            //SQL CONNECTION
            $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD);
            $dbused= "USE $DB_NAME";
    
            // Check connection
                if ($conn->connect_error ) 
                {
                    die("Connection failed: " . $conn->connect_error);
                } 
    
            // TIMESTAMP (NEW)
    
            $currTime=$_SERVER['REQUEST_TIME'];
            $caption=$_POST["caption"];
            
			date_default_timezone_set('America/Los_Angeles');
			$date = date('m/d/Y h:i:s a', time());
			$insertion= "INSERT INTO images VALUES ('$user' , '$image', '$caption', '$currTime', '$date')";
                if ( $conn->query($dbused) === TRUE && $conn->query($insertion) === TRUE )
                {	
					$insert = "INSERT into average values('$image', 0)";
					$initial = $conn->query($insert);


					//$_SESSION["image"] = $image;
                    header('Location: index2.php?message=You have successfully uploaded image');
                } 
                else 
                {
                    echo "Error: " . $conn->error;
                }           
        }     
        else 
        {
            echo "error while uploading the file";
			header('Location: index2.php');
        }
        
    }//end of if-else block

}//end of uploading method

}//end of  upload class

$up = new upload();
$up->uploading();
//include(rating.php);
//$conn->close();

?>