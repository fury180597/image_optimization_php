<?php
session_start();
require('db.php');
if (isset($_POST['create'])) {
 $username = strip_tags($_POST['username_create']);
 $email = strip_tags($_POST['email']);
 $password = strip_tags($_POST['password_create']);
 
 $username = $con->real_escape_string($username);
  $email = $con->real_escape_string($email);
 $password = $con->real_escape_string($password);

 


 $query = $con->query("SELECT * FROM users WHERE username='$username'");
 $row=$query->fetch_array();

 $count = $query->num_rows;


 if($count==1){
      echo "<script type='text/javascript'>alert('Username already in use!')</script>";
         echo "<script language='javascript' type='text/javascript'> location.href='index.php' </script>"; 

         exit();
 }

 $password_hashed = hash('sha256', $password);

 $query1 = $con->query("INSERT INTO users (username,userpass,email) VALUES ('$username','$password_hashed','$email')");

 if($query1){
 		$_SESSION['user'] = $username;
 		header('Location:dashboard.php');
 }
 else{
 	      echo "<script type='text/javascript'>alert('ERROR!')</script>";
         echo "<script language='javascript' type='text/javascript'> location.href='index.php' </script>";
 }

  $con->close();
}
else{
  header('Location:index.php');
}
?>