<?php
include 'config.php'; //connect the connection page
error_reporting(0);
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
            <a class="nav-link" href="profile.php">Make Requests</a>
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
        <div style="height: 600px;width:300px;border:2px black solid;color:blue;padding-left:4px;background-color:black;margin-top:10px;">
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
              <h4><b>City: <span style=color:green;>
              <?php
              echo $obj['city']; 
              ?></span></b></h4>
              <h4><b>State: <span style=color:green;>
              <?php
              echo $obj['state'];
              ?></span>
              </b></h4>
              <br>
              <div>
              <a class="btn btn-primary btn-xl js-scroll-trigger" href="accepted.php">Your Requests</a>
              </div>
              <br>
              <div>
              <a class="btn btn-primary btn-xl js-scroll-trigger" href="yourjobs.php">Your Jobs</a>
              </div>
              <br>
              <div>
              <a class="btn btn-primary btn-xl js-scroll-trigger" href="archivedjobsreq.php">Past Jobs Requested</a>
              </div>
              <br>
              <div>
              <a class="btn btn-primary btn-xl js-scroll-trigger" href="archivedjobscomp.php">Past Jobs Completed</a>
              </div>
        </div>
      </div>
      <!-- /.col-lg-3 -->
      <div class="col-lg-9" >
                    <span class="login100-form-title p-b-43">
                        Your Past Jobs Completed
                    </span>
                    <br>
<?php
ini_set("allow_url_fopen", 1);
$username = $_SESSION["username"];
// Insert api call here
$url = 'http://localhost:8080/allarchiveddone?user=' . $username;
$obj = json_decode(file_get_contents($url), true);
?>
<div class="row" style="margin-left: 20px;">
<?php
for ($i = 0; $i < count($obj['requestArray']); $i++) {
?>  
<div class="col-lg-4 col-md-6 mb-4">
   <div class="card h-100">
              <a>
              <?php
              $rid = $obj['requestArray'][$i]['rid'];
              $req_img = $obj['requestArray'][$i]['image'];
              echo "<img class=\"card-img-top\" src=' ". $req_img . "' alt=\"\">";
              ?>
                </a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#"><?php echo $obj['requestArray'][$i]['title']; ?></a>
                </h4>
                <h5>$<?php echo $obj['requestArray'][$i]['price']; ?></h5>
                <p style="color:green;" class="card-text" ><?php echo $obj['requestArray'][$i]['title']; ?></p>
              </div>
              <div class="card-footer">
                <small class="text-muted">
                <form action="details4.php" method="post">
                <textarea style = "display:none" cols="86" rows ="20" name="req"><?php echo   $rid ?></textarea>
                    <button class="btn btn-primary btn-xl js-scroll-trigger" id = "submit" type="submit" name="view">
                                  View
                    </button>
                </form> 
                </small>
              </div>
            </div>
            </div>
<?php  
};  
?>
</div>
  </div>
  <!-- /.container -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>