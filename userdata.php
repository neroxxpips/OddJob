<?php
include 'config.php'; //connect the connection page

if(empty($_SESSION)) // if the session not yet started
   session_start();

if(!isset($_SESSION['username'])) { //if not yet logged in
  $username=$_SESSION['username'];
  $sql = "SELECT fname, lname, phone, city, FROM users WHERE username='$username'";
  $results = mysqli_query($conn, $sql);
   header("Location: login.php");// send to login page
   exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>OddJob - Homepage</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor1/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Luckiest+Guy&display=swap" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link href="css/homepage.css" rel="stylesheet">
  <link href="css/creative.min.css" rel="stylesheet">


</head>

<body >

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
    <a class="navbar-brand js-scroll-trigger" href="#page-top"  style="font-family: 'Luckiest Guy';font-size:20px;"
>OddJob</a>

<ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Welcome, <?php echo $_SESSION['username'];?>
              <span class="sr-only">(current)</span>
            </a>
          </li>
  </ul>
      <!--<a class="navbar-brand" href="#" >OddJob</a> -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <!-- <li class="nav-item active">
            <a class="nav-link" href="#">Welcome, <?php echo $_SESSION['username'];?>
              <span class="sr-only">(current)</span>
            </a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="#">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="homepage.php">Available Task</a>
          </li>
          <li class="nav-item">
          <a class="btn btn-primary btn-xl" href="logout.php" style="height: 5px;">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <a class="navbar-brand js-scroll-trigger" href="#page-top"  style="font-family: 'Luckiest Guy';font-size:50px;"
>OddJob</a>
        <div class="list-group" style="width:200px;height:200px;border-radius:50%;">
        <img src="img/avatar-1.png" id="profimg" class="rounded" alt="..." style="width:200px;height:200px;border-radius:50%;">
        </div>

        <div style="height: 450px;width:300px;border:2px black solid;color:blue;padding-left:4px;background-color:black;margin-top:10px;">
              <br>
              <h4>Username: <span style=color:green;><?php echo $_SESSION['username'];?></span></h4>
              <h4><b>First name: <span style=color:green;>
              <?php 
              
              $url = 'http://localhost:8080/userprofile?username=' . $_SESSION['username'];
              $obj = json_decode(file_get_contents($url), true);
              echo $obj['fname'];
              
              ?></span></b></h4>

              <?php
                $img_b64 = $obj['image'];

                echo "<script>var image = document.getElementById(\"profimg\");
                image.src = '" .  $img_b64 . "';</script>";
              ?>
              <h4><b>Last name: <span style=color:green;>
              <?php
              echo $obj['lname'];
              ?></span>
              </b></h4>
              
              <br>
              
              
              
              
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">
	
				<form class="login100-form validate-form" action="homepage.php" method="post">
				
					<span class="login100-form-title p-b-43">
						Welcome, <h4><b> <span style=color:green;>
              <?php 
              
              $url = 'http://localhost:8080/userprofile?username=' . $_SESSION['username'];
              $obj = json_decode(file_get_contents($url), true);
              echo $obj['fname'];
              
              ?></span></b></h4> Please Enter Your Location
					</span>
					<br>
					
					<div class="wrap-input100 validate-input" data-validate = "street number is required">
						<input class="input100" type="number" name="number">
						<span class="focus-input100"></span>
						<span class="label-input100">Street Number</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="street name is required">
						<input class="input100" type="text" name="street">
						<span class="focus-input100"></span>
						<span class="label-input100">Street Name</span>
					</div>

          <div class="wrap-input100 validate-input" data-validate="state is required">
						<input class="input100" type="text" name="state">
						<span class="focus-input100"></span>
						<span class="label-input100">State</span>
          </div>
          
          <div class="wrap-input100 validate-input" data-validate="state is required">
						<input class="input100" type="text" name="city">
						<span class="focus-input100"></span>
						<span class="label-input100">City</span>
					</div>

          

          

          
          

					
					
			
					<div class="container-login100-form-btn">
          
						<button class="login100-form-btn" id = "submit" type="submit" name="submit">
							Submit Location
						</button>
					</div>
					
					

					
				</form>

       

          
  </div>
  <!-- /.container -->

  <script> 
          
          
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
