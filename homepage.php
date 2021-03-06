<?php
include 'config.php'; //connect the connection page
error_reporting(0);
if(empty($_SESSION)) // if the session not yet started
   session_start();

if(!isset($_SESSION['username'])) { //if not yet logged in
   header("Location: login.php");// send to login page
   exit;
}

if (isset($_POST['task'])) {
  $_SESSION['task'] = $_POST['task'];
}
else{
  $_SESSION['task'] = 'casual';
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

<body style="background-color: grey;">

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
            <a class="nav-link" href="#"></a>
          </li>
          <li class="nav-item">
          <a class="btn btn-primary btn-xl" href="logout.php">Logout</a>
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
        <div class="list-group">

        <form action="homepage.php" method="post">
                <textarea style = "display:none" cols="86" rows ="20" name="task">casual</textarea>
                    <button class="btn btn-primary btn-xl js-scroll-trigger" id = "submit" type="submit" name="view" style="margin-bottom: 10px;">
							      Casual
                    </button>
        </form> 
        <form action="homepage.php" method="post">
                <textarea style = "display:none" cols="86" rows ="20" name="task">student</textarea>
                    <button class="btn btn-primary btn-xl js-scroll-trigger" id = "submit" type="submit" name="view" style="margin-bottom: 10px;">
							      Student
                    </button>   
        </form>   
        </div>
        <form action="homepage.php" method="post">
                <textarea style = "display:none" cols="86" rows ="20" name="task">professional</textarea>
                    <button class="btn btn-primary btn-xl js-scroll-trigger" id = "submit" type="submit" name="view" style="margin-bottom: 10px;">
							      Professional
                    </button>
                    
        </form> 

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="images/pain.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="images/grass.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="images/carpentry.jpg" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <div class="row">

          

<?php

if(!isset($_SESSION["street"])){
  $street = $_POST["street"];
  $number = $_POST["number"];
  $state = $_POST["state"];
  $city = $_POST["city"];
  
  $_SESSION["street"] = $street;
  $_SESSION["number"] = $number;
  $_SESSION["state"] = $state;
  $_SESSION["city"] = $city;
}

$urldata = array(
  'street' => $_SESSION["street"],
  'number' => $_SESSION["number"],
  'state' => $_SESSION["state"],
  'city' => $_SESSION["city"],
  'userid' => $_SESSION["username"],
  'task'  => $_SESSION['task']
);

$urlquery = http_build_query($urldata);

ini_set("allow_url_fopen", 1);

// Insert api call here
$url = 'http://localhost:8080/allavailablerequests?' . $urlquery;
$obj = json_decode(file_get_contents($url), true);

?>
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
                <form action="details.php" method="post">
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
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; OddJob.com 2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
