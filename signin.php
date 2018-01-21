<?php
session_start();
require('db.php');
if (isset($_POST['signin'])) {
 
 $username = strip_tags($_POST['username']);
 $password = strip_tags($_POST['password']);
 
 $username = $con->real_escape_string($username);
 $password = $con->real_escape_string($password);

 if(empty($username)){
 	    echo "<script type='text/javascript'>alert('No Username Entered!')</script>";
         echo "<script language='javascript' type='text/javascript'> location.href='index.php' </script>";   
         exit();
 } 

  if(empty($password)){
 	    echo "<script type='text/javascript'>alert('No Password Entered!')</script>";
         echo "<script language='javascript' type='text/javascript'> location.href='index.php' </script>";   
         exit();
 } 
 $query = $con->query("SELECT * FROM users WHERE username='$username'");
 $row=$query->fetch_array();

 $count = $query->num_rows;
 $password_hashed = hash('sha256', $password);
  if( $count == 1 && $row['userpass']==$password_hashed ) {
    $_SESSION['user'] = $row['username'];
    header("Location: dashboard.php");
   }

 else {
    echo "<script type='text/javascript'>alert('User Name Or Password Invalid!')</script>";
         echo "<script language='javascript' type='text/javascript'> location.href='index.php' </script>";   
 }
 $con->close();
}
else{
	header('Location:index.php');
}



?>