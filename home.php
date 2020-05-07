<?php
include 'config.php'; //connect the connection page

if(empty($_SESSION)) // if the session not yet started
   session_start();

if(!isset($_SESSION['username'])) { //if not yet logged in
   header("Location: login.php");// send to login page
   exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Voter Profile</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/style.css">
	<link href="https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body>
<div class="row">
	<div class="col-sm-4">
		<h2>Welcome, <?php echo $_SESSION['username'];?> </h2>
	</div>
	<div class="col-sm-4" style="margin-top: 200px">
	
	<h1 align="center"><b>Voter Profile</b></h1>
	<hr class="mb-4">
		<form action="" method="post">
	  		<div class="form-group">
	   			  <button type="button" class="btn btn-primary btn-lg btn-block">Click to Vote YES</button>
				  <button type="button" class="btn btn-secondary btn-lg btn-block">Click to Vote NO</button>
	 	    </div>
	  	    
	        
	             
		</form>
			
		
		<hr class="mb-4">
	</div>
	<div class="col-sm-4"  id="took">
				
				<hr class="mb-4" >
				<button type="button" class="btn btn-outline-success "><a href="reset_p.php">Reset Password</b></a></button><br>
				<hr class="mb-4">
				<button type="button" class="btn btn-outline-success "><a href="sec_qestion.php">Set Security<br>Answer</b></a></button>
				<hr class="mb-4">
				<h1><b><a href="logout.php">logout</a></b></h1>
				<hr class="mb-4">
				
				</div>
</div>
</body>
</html>