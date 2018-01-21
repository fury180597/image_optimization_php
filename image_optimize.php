<?php

require('db.php');

if(isset($_POST['user_id'])){
    $user_id=$_POST['user_id'];

if(isset($_POST['post'])){

    $quality=$_POST['quality'];
    if($quality==0){
            echo "<script type='text/javascript'>alert('Quality can not be 0')</script>";
         echo "<script language='javascript' type='text/javascript'> location.href='dashboard.php' </script>";
         exit();
    }

 //image upload
            $pro_image = $_FILES['image']['name'];
            $pro_image_tmp = $_FILES['image']['tmp_name'];

            $fileType = $_FILES["image"]["type"];  
            $fileSize = $_FILES["image"]["size"];  
            $fileErrorMsg = $_FILES["image"]["error"];  

             $fileName = preg_replace('#[^a-z.0-9]#i', '', $pro_image); 
             $nwtourimg = explode(".", $fileName);
             if (!$pro_image_tmp) { // if file not chosen
                echo "ERROR: An error occured (File size may be more than 5mb)";
                exit();
            } else if($fileSize > 5242880) { // if file size is larger than 5 Megabytes
                echo "ERROR: Your file was larger than 5 Megabytes in size.";
                unlink($pro_image_tmp); // Remove the uploaded file from the PHP temp folder
                exit();
            } else if (!preg_match("/.(gif|jpg|png|jpeg)$/i", $fileName) ) {
                 // This condition is only if you wish to allow uploading of specific file types    
                 echo "ERROR: Your image was not .gif, .jpg, or .png.";
                 unlink($pro_image_tmp); // Remove the uploaded file from the PHP temp folder
                 exit();
            } else if ($fileErrorMsg == 1) { // if file upload error key is equal to 1
                echo "ERROR: An error occured while processing the file. Try again.";
                exit();
            }

             $fileExt = end($nwtourimg);
             $fileName = time().rand().".".$fileExt;
             $path="images/".$fileName."";
$old_size=round( filesize($pro_image_tmp)/1024);

             $img = imagecreatefromjpeg($pro_image_tmp); //image quality manipulation
imagejpeg($img,$path,$quality);

$size =round( filesize($path)/1024);


 $query1 = $con->query("INSERT INTO images (user_id,size,old_size,path) VALUES ('$user_id','$size','$old_size','$path')");

 if($query1){
    header('Location:dashboard.php');
 }
 else{
        echo "<script type='text/javascript'>alert('Error')</script>";
         echo "<script language='javascript' type='text/javascript'> location.href='dashboard.php' </script>";  
 }
}
}
else{
    echo "<script type='text/javascript'>alert('Error')</script>";
         echo "<script language='javascript' type='text/javascript'> location.href='index.php' </script>";  
}
?>




