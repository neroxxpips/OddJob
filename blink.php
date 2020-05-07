<? php

		   
		   $username = $_POST['username'];  
           $password = $_POST['password'];  
           $salt     = "votersaccount";
           $password = sha1($password.$salt);  

           $username = stripslashes($username);
           $password = stripcslashes($password);
           $username = mysql_real_escape_string($username);
           $password = mysql_real_escape_string($password);



           $conn = new mysqli('localhost:8889','root','root','votersaccount');

           $query = "SELECT * FROM voters WHERE username = '$username' AND password = '$password'";  
           $result = mysqli_query($query) or die("Failed to query database".mysql_error()); 

           $row = mysql_fetch_array($result); 
           if($row['username'] == $username && $row['password'] == $password)  
           {  
                // $_SESSION['username'] = $username;  
           		header("Location: /reg.php");
                echo "Login Success!!!". $row['username'];  
           }  
           else  
           {  
                echo "Failed to login";  
           }  

?>