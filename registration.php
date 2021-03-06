<!DOCTYPE html>
<html lang="en">
<head>
	<title>OddJob - Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link href="https://fonts.googleapis.com/css?family=Luckiest+Guy&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

</head>
<body style="background-color: #666666;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="reg.php" method="post">
				<span class="odd-logo"><h1 style="font-size:50px;">OddJob</h1></span>
					<span class="login100-form-title p-b-43">
						Registration Form
					</span>
					
					<div class="wrap-input100 validate-input" data-validate="Username is required">
						<input class="input100" type="text" name="username">
						<span class="focus-input100"></span>
						<span class="label-input100">Username</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "First Name is required">
						<input class="input100" type="text" name="fname">
						<span class="focus-input100"></span>
						<span class="label-input100">First Name</span>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate="Last Name is required">
						<input class="input100" type="text" name="lname">
						<span class="focus-input100"></span>
						<span class="label-input100">Last Name</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="Email" name="email">
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="city is required">
						<input class="input100" type="text" name="city">
						<span class="focus-input100"></span>
						<span class="label-input100">City</span>
					</div>


					<div class="wrap-input100 validate-input" data-validate="State is required">
						<input class="input100" type="text" name="state">
						<span class="focus-input100"></span>
						<span class="label-input100">State</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Phone Number is required">
						<input class="input100" type="number" name="phone">
						<span class="focus-input100"></span>
						<span class="label-input100">Phone Number</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="file is required">
						<input class="input100" onchange="encodeImageFileAsURL(this)" type="file" name="image">
						<span class="focus-input100"></span>
						<span class="label-input100">Image</span>
					</div>

          
					<textarea style = "display:none" id="userImgText" cols="86" rows ="20" name="userImageText"></textarea>


					<div class="container-login100-form-btn">
						<button class="login100-form-btn" id = "submit" type="submit">
							Submit
						</button>
					</div>
					
					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							<a href="login.php">Click Here to Signin</a>
						</span>
					</div>
					<script> 
          
          			function encodeImageFileAsURL(element) {
           				var file = element.files[0];
						var reader = new FileReader();
						var userImg = "";
						reader.onloadend = function() {
						userImg = reader.result;
						}
						reader.readAsDataURL(file);

						document.getElementById('submit').onclick = function() {
						document.getElementById('userImgText').innerHTML = userImg;
						};
            
        			  }
        
    </script>
					
				</form>

				<div class="login100-more" style="background-image: url('images/painting.jpeg');">
				</div>
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>