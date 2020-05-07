<?php
	
	
	$db = new mysqli('localhost:8889','root','root','votersaccount');

	
	if (isset($_POST['restore'])) {
	  
	   $username       = mysqli_real_escape_string($db, $_POST['username']);
	   $solve 	   	   = mysqli_real_escape_string($db, $_POST['solve']);
	   
	   
	   		
	   		$sql = "SELECT * FROM password_resets WHERE username='$username' AND answer='$solve'";
	   		$results = mysqli_query($db, $sql);

	   		if (!$row = mysqli_fetch_assoc($results)) {
	   			echo "You have provided a wrong answer.";
	   			
	   		}else {
	   			// $hash_password = md5($new_password);
	   			// $stmt = $db->prepare("UPDATE voters SET password=? WHERE username =?");
	   			// $stmt->bind_param("ss", $hash_password, $username);
	   			// $stmt->execute();

	   			// $_SESSION['success'] = "Your Password was Successfully Changed!";
	   			// $stmt->close();
	   			// $db->close();

	   			header('location: new_password.php');
	   		 	

	   		 	
	   			
	   		}


	   }

		
?>

<!DOCTYPE html>
<html>
<head>
	<title>Restore Password</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/style.css">
	<link href="https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body>
<div class="row">
	<div class="col-sm-4"></div>
	<div class="col-sm-4" style="margin-top: 200px">
	<h2 class="form-title">Restore Password</h2>
	<h2 class="form-title">Security Question</h2>
	<hr class="mb-4">
	<form action="" method="post">
	  		<div class="form-group">
	   			 <label for="username">What is you username?</label>
	    		 <input type="text" class="form-control" name="username" required>
	  		</div>
	  		<div class="form-group">
	   			 <label for="solve">What is you favorite color?</label>
	    		 <input type="text" class="form-control" name="solve"  required>
	 	    </div>
	 	    
	  	    
	           
	           <button type="submit" class="btn btn-primary" name="restore">Submit</button>   
		</form>
		
		
		<hr class="mb-4">
	</div>
</div>
</body>
</html>