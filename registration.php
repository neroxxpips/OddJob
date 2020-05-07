<? php
require_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Voter Registration</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<div>
		 <?php
		if(isset($_POST['create'])){
			$image 		 = $_POST['image'];
			$firstname	 = $_POST['firstname'];
			$lastname 	 = $_POST['lastname'];
			$sex 		 = $_POST['sex'];
			$username 	 = $_POST['username'];
			$password 	 = $_POST['password'];
			$course 	 = $_POST['course'];
			$sponsor   	 = $_POST['sponsor'];

			echo "$firstname";

			$sql = "INSERT INTO voters (image, firstname, lastname, sex, username, password, course, sponsor) VALUES(?,?,?,?,?,?,?,?)";
			$stmtinsert = $db->prepare($sql);
			$result = $stmtinsert->execute([$image, $firstname, $lastname, $sex, $username, $password, $course, $sponsor]);
			if($result){
				echo 'Successfully saved!';
			}else{
				echo 'There were errors while saving data.';
			}
			 
		} 

		?> 
			
			
	</div>
<div>
	<form action="registration.php" method="post">
		<div class="container">

			<div class="row">
				<div class="col-sm-3">
					<h1 align="center">Voter Registration</h1>
					<p>Fill up the form with correct values.</p>
					<hr class="mb-3">
					<label for="image"><b>Image</b></label>
					<input class="form-control type="text" name="image" required> 

					<label for="firstname"><b>First Name</b></label>
					<input class="form-control" type="text" name="firstname" required>

					<label for="lastname"><b>Last Name</b></label>
					<input class="form-control type="text" name="lastname" required>

					<label for="sex"><b>Sex</b></label>
					<input class="form-control type="text" name="sex" required>

					<label for="username"><b>Username</b></label>
					<input class="form-control type="text" name="username" required>

					<label for="password"><b>Password</b></label>
					<input class="form-control type="text" name="password" required>

					<label for="course"><b>Course</b></label>
					<input class="form-control type="text" name="course" required>

					<label for="sponsor"><b>Sponsor</b></label>
					<input class="form-control type="text" name="sponsor" required>
					<hr class="mb-3">
					
					<input class="btn btn-primary" type="submit" name="create" value="Sign Up">
				</div>	
			</div>	
		</div>
		
	</form>
</div>
</body>
</html>