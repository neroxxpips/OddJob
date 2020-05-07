<?php
	session_start();
$_SESSION["username"] = "$username";
$conn = mysqli_connect("localhost:8889", "root", "root", "votersaccount") or die("Connection Error: " . mysqli_error($conn));

if (count($_POST) > 0) {
    $result = mysqli_query($conn, "SELECT *from users WHERE userId='" . $_SESSION["userId"] . "'");
    $row = mysqli_fetch_array($result);
    if ($_POST["password"] == $row["password"]) {
        mysqli_query($conn, "UPDATE voters set password='" . $_POST["new_password"] . "' WHERE username='" . $_SESSION["username"] . "'");
        $message = "Password Changed";
    } else
        $message = "Current Password is not correct";
}

?> 
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
	<form action="enter_email.php" method="post" onSubmit="return validatePassword()">
	  		<div class="form-group">
	   			 <label for="username">Username:</label>
	    		 <input type="text" class="form-control" name="username" required>
	  		</div>
	  		<div class="form-group">
	   			 <label for="password">Password:</label>
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
<script>
function validatePassword() {
var password,new_password,new_password_c,output = true;

password = document.frmChange.cpassword;
new_password = document.frmChange.newPassword;
new_password_c = document.frmChange.new_password_c;

if(!password.value) {
password.focus();
document.getElementById("password").innerHTML = "required";
output = false;
}
else if(!new_password.value) {
new_password.focus();
document.getElementById("new_password").innerHTML = "required";
output = false;
}
else if(!new_password_c.value) {
new_password_c.focus();
document.getElementById("new_password_c").innerHTML = "required";
output = false;
}
if(new_password.value != new_password_c.value) {
new_password.value="";
new_password_c.value="";
new_assword.focus();
document.getElementById("new_password_c").innerHTML = "not same";
output = false;
} 	
return output;
}
</script>
</html>