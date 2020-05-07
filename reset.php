<?php
session_start();
$errors = [];
$db = new mysqli('localhost:8889','root','root','votersaccount');
/*
  Accept email of user whose password is to be reset
  Send email to user to reset their password
*/
if (isset($_POST['reset'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $password = md5($password);
  $new_pass = mysqli_real_escape_string($db, $_POST['new_password']);
  $new_pass_c = mysqli_real_escape_string($db, $_POST['new_password_c']);
  // ensure that the user exists on our system
  $query = "SELECT username, password FROM voters WHERE username='$username'";
  $results = mysqli_query($db, $query);

  if ($new_password !== $new_password_c) {
  		array_push($errors, "Password does not match!");


  if (mysqli_num_rows($results) == 1 && count($errors) == 0) {
  		$password = md5($new_pass);

  		$$stmt = $db->prepare("UPDATE voters set password = ? WHERE username = ?");
    		$stmt->bind_param("ss", $password, $username);
    		$stmt->execute();
    		$_SESSION['success'] = "Your Password Changed!";

    		stmt->close();
    		$db->close();
    		header('location: login.php');
      	}else {
      		echo "wrong username/password";
      	}
  }

}

?> 