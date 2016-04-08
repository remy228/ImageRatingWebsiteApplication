<!DOCTYPE html>
<head></head>
<body>
<?php
global $img1;
class popularity
{
    
    function popular()
        {
            //public $imagename="";
            require("Config.php");
            include "Connection.php";


            //$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD);
            $dbused= "USE $DB_NAME";

            // Check connection
            $query ="SELECT avg(rating) as rat,image from rating group by image order by rat desc";
            $query2="SELECT image from images order by timstamp desc";
            $result = mysqli_query($db, $query);
            $result2 = mysqli_query($db, $query2);            

            $num_rows = mysqli_num_rows($result);
            $num_fields = mysqli_num_fields($result);
            //$num_fields2 = mysqli_num_fields($result2);

            
            $num_rows2 = mysqli_num_rows($result2);


            if($num_rows<10)
            {
                $remaining = 10-$num_rows;
                $duplicate=array();
                for($j = 1; $j <= $num_rows; $j++)
                {
                        
                   	$row = mysqli_fetch_array($result);
                   	//print $row[0].$row["image"]. "<br />";
                   	echo '<img src="./resources/'.$row["image"].'" alt="Cover">';
                   	$img1=$row["image"];
                   	
                   	include "rating_form.html";
                   	
                   	include "rating.php";
                   	array_push($duplicate,$row["image"]);

                }
                
                if($num_rows2<$remaining)
                {
                for($j = 1; $j <= $num_rows2; $j++)
                {
                        $row2 = mysqli_fetch_array($result2);

                        if(in_array($row2["image"],$duplicate))
                        {}
                        else
                        {
                   	//print $row[0].$row["image"]. "<br />";
                   	echo '<img src="./resources/'.$row2["image"].'" alt="Cover">';
                   	 $img1=$row2["image"];

                   	include "rating_form.html";
                   	include "rating.php";

                   	}

                }
                }
                else
                {
                    $count =0;
                    for($y = 1; $y <= $remaining; $y++)
                    {
                        
                        
                        if(in_array($row2["image"],$duplicate))
                        {
                            $y=$y-1;
                        }
                        else
                        {
                   	$row2 = mysqli_fetch_array($result2);
                   	//print $row[0].$row["image"]. "<br />";
                   	echo '<img src="./resources/'.$row2["image"].'" alt="Cover">';
                   	 $img1=$row2["image"];

                   	include "rating_form.html";
                   	include "rating.php";

                   	}

                    }
                    
                }
                
            }
            else
            {
                for($j = 1; $j <= 10; $j++)
                {
                   	$row = mysqli_fetch_array($result);
                   	//print $row[0].$row["image"]. "<br />";
                   	echo '<img src="./resources/'.$row["image"].'" alt="Cover">';
                   	 $img1=$row["image"];

                   	include "rating_form.html";
                   	include "rating.php";

   	
                }
    
            }//end of if-else block
        } // end of method popular
}//end of class popularity


?>

</body>

</html>
