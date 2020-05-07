
<?php
	
	
	$db = new mysqli('localhost:8889','root','root','votersaccount');

	
	if (isset($_POST['reset'])) {
	  
	   $username       = mysqli_real_escape_string($db, $_POST['username']);
	   $password 	   = mysqli_real_escape_string($db, $_POST['password']);
	   $password 	   = md5($password);
	   $new_password   = mysqli_real_escape_string($db, $_POST['new_password']);
	   $new_password_c = mysqli_real_escape_string($db, $_POST['new_password']);

	   if ($new_password == $new_password_c) {
	   		
	   		$sql = "SELECT * FROM voters WHERE username='$username' AND password='$password'";
	   		$results = mysqli_query($db, $sql);

	   		if (!$row = mysqli_fetch_assoc($results)) {
	   			echo "You need to re-submit your request.";
	   			
	   		}else {
	   			$hash_password = md5($new_password);
	   			$stmt = $db->prepare("UPDATE voters SET password=? WHERE username =?");
	   			$stmt->bind_param("ss", $hash_password, $username);
	   			$stmt->execute();

	   			$_SESSION['success'] = "Your Password was Successfully Changed!";
	   			$stmt->close();
	   			$db->close();

	   			header('location: login.php');
	   		 	

	   		 	
	   			
	   		}


	   }

	}	
	
?>

         
  <!DOCTYPE html>
<html>
<head>
	<title>Reset</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/style.css">
	<link href="https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body>
<div class="row">
	<div class="col-sm-4"></div>
	<div class="col-sm-4" style="margin-top: 200px">
	
	<h2 class="form-title">Reset password</h2>
	<hr class="mb-4">
	<form action="reset_p.php" method="post">
	  		<div class="form-group">
	   			 <label for="username">Username:</label>
	    		 <input type="text" class="form-control" name="username" required>
	  		</div>
	  		<div class="form-group">
	   			 <label for="password">Current Password:</label>
	    		 <input type="password" class="form-control" name="password" id="password"  required>
	 	    </div>
	 	    <div class="form-group">
	   			 <label for="new_password"> New Password:</label>
	    		 <input type="password" class="form-control" name="new_password" id="new_password" required>
	 	    </div>
	 	    <div class="form-group">
	   			 <label for="new_password_c">Confirm New Password:</label>
	    		 <input type="password" class="form-control" name="new_password_c" id="new_password_c" required>
	 	    </div>
	  	    
	           
	           <button type="submit" class="btn btn-primary" name="reset">Submit</button>   
		</form>
		
		
		<hr class="mb-4">
	</div>
</div>
</body>
</html>