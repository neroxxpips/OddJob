<?php
	$db = new mysqli('localhost:8889','root','root','votersaccount');

if (isset($_POST['new_password'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $new_pass = mysqli_real_escape_string($db, $_POST['new_password']);
  $new_pass_c = mysqli_real_escape_string($db, $_POST['new_password_c']);

	if ($new_password !== $new_password_c) {
  		array_push($errors, "Password does not match!");

    }

    if (count($errors) == 0) {
    	$query = "SELECT * FROM voters WHERE username = '$username' LIMIT 1";
    	$result = mysqli_query($db, $query);
    	$user = mysqli_fetch_assoc($result);
    	if (password_verify($password, $user['password'])) {
    		$password = md5($new_pass);

    		$stmt = $db->prepare("UPDATE voters set password = ? WHERE username = ?");
    		$stmt->bind_param("ss", $password, $username);
    		$stmt->execute();

    		$_SESSION['success'] = "Your Password Changed!";
    		$_stmt->close();
    		header('location: login.php');
    	}else {
    		array_push($errors, "Wrong Username/Password");
    		}

    }

 }


?>