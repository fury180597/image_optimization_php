<?php

session_start();

include('db.php');
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == '')) {
     header("Location:index.php");
}
$username=$_SESSION['user'];
 $query = $con->query("SELECT * FROM users WHERE username='$username'");
 $row=$query->fetch_array();

 $userid=$row['id'];


?>



<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/thumbnail-gallery.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>

                        <li class="nav-item ">
              <a class="nav-link" href="logout.php">Log-out
              
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <h1 class="my-4 text-center text-lg-center">Welcome <?php echo $_SESSION['user'] ?> To Your Gallery!</h1>
      <h6 class="my-4 text-center text-lg-center"><span style="color: red;">Click on the image to see full size image </span></h6>

      <div class="row text-center text-lg-left">
<?php 

 $query1 = $con->query("SELECT * FROM images WHERE user_id='$userid'");
 
 while($row1=$query1->fetch_array()){
        echo '<div class="col-lg-3 col-md-4 col-xs-6">
        <a href="'.$row1['path'].'" target="_blank">
            <img class="img-fluid img-thumbnail" src="'.$row1['path'].'" alt=""></a>
            <h5>New Size:<span style="color: green;"> '.$row1['size'].' kb</span> <br/> Old size: '.$row1['old_size'].' kb</h5>
        
        </div>';}?>

      </div>

    </div>

    <div class="container">
      <div class="row">
        <div class="col-sm-2">
        </div>
          <div class="col-sm-8">
  <h2 style="text-align: center;">Upload Image</h2>
  <form class="form-horizontal" action="image_optimize.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="image">Upload Image: <span style="color: red;">(Drag And Drop Or Choose File)</span></label>
    <input type="file" name="image" class="form-control" id="image" required style="height: 180px; background-color: #eee;padding-top: 150px;">
  </div>
  <input type="hidden" name="user_id" <?php echo 'value="'.$userid.'"';?>>

    <div class="form-group">
    <label  for="form-username">Quality:<span style="color: red;">(Enter a qulaity value between 1-100 this will affect the size of image)</span> </label>
      <input type="number" name="quality" placeholder="Enter quality (1-100)" class="form-username form-control" id="form-username" required="" >
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="post" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
</div>
        <div class="col-sm-2">
        </div>
</div>
</div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Made by <a href="http://manishmishra.esy.es">Manish-Mishra</a></p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
