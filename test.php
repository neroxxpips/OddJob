<?php  
 $connect = mysqli_connect("localhost:8889", "root", "root", "votersaccount");  
 session_start();  
 if(isset($_SESSION["username"]))  
 {  
      header("location:entry.php");  
 }  
 if(isset($_POST["register"]))  
 {  
      if(empty($_POST["username"]) && empty($_POST["password"]))  
      {  
           echo '<script>alert("Both Fields are required")</script>';  
      }  
      else  
      {    $image     = mysqli_real_escape_string($connect, $_POST["image"]);
           $firstname = mysqli_real_escape_string($connect, $_POST["firstname"]);
           $lastname  = mysqli_real_escape_string($connect, $_POST["lastname"]);
           $sex       = mysqli_real_escape_string($connect, $_POST["sex"]);  
           $password  = mysqli_real_escape_string($connect, $_POST["password"]); 
           $password  = md5($password); 
           $course = mysqli_real_escape_string($connect, $_POST["course"]);
           $sponsor = mysqli_real_escape_string($connect, $_POST["sponsor"]); 
            
           $query = "INSERT INTO votersbooth (image, firstname, lastname, sex, username, password, course, sponsor) VALUES($image, $firstname, $lastname, $sex, $username, $password, $course, $sponsor)";  
           if(mysqli_query($connect, $query))  
           {  
                echo '<script>alert("Registration Done")</script>';  
           }  
      }  
 }  
 if(isset($_POST["login"]))  
 {  
      if(empty($_POST["username"]) && empty($_POST["password"]))  
      {  
           echo '<script>alert("Both Fields are required")</script>';  
      }  
      else  
      {  
           $username = mysqli_real_escape_string($connect, $_POST["username"]);  
           $password = mysqli_real_escape_string($connect, $_POST["password"]);  
           $password = md5($password);  
           $query = "SELECT * FROM votersbooth WHERE username = '$username' AND password = '$password'";  
           $result = mysqli_query($connect, $query);  
           if(mysqli_num_rows($result) > 0)  
           {  
                $_SESSION['username'] = $username;  
                header("location:entry.php");  
           }  
           else  
           {  
                echo '<script>alert("Wrong User Details")</script>';  
           }  
      }  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Webslesson Tutorial | PHP Login Registration Form with md5() Password Encryption</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:500px;">  
                <h3 align="center">PHP Login Registration Form with md5() Password Encryption</h3>  
                <br />  
                <?php  
                if(isset($_GET["action"]) == "login")  
                {  
                ?>  
                <h3 align="center">Login</h3>  
                <br />  
                <form method="post">  
                     <label>Enter Username</label>  
                     <input type="text" name="username" class="form-control" />  
                     <br />  
                     <label>Enter Password</label>  
                     <input type="password" name="password" class="form-control" />  
                     <br />  
                     <input type="submit" name="login" value="Login" class="btn btn-info" />  
                     <br />  
                     <p align="center"><a href="test.php">Register</a></p>  
                </form>  
                <?php       
                }  
                else  
                {  
                ?>  
                <h3 align="center">Register</h3>  
                <br />  
                <form method="post">  
                     <label for="image"><b>Image</b></label>
          <input class="form-control" type="file" name="image" required>
          

          <label for="firstname"><b>First Name</b></label>
          <input class="form-control" type="text" name="firstname" required>

          <label for="lastname"><b>Last Name</b></label>
          <input class="form-control" type="text" name="lastname" required>

        
          <label for="sex"><b>Sex</b></label>
          <select type="text" for="sex" name="sex" class="form-control">
            <option selected>Choose One</option>
            <option>male</option>
            <option>female</option>
          </select>

          <label for="username"><b>Username</b></label>
          <input class="form-control" type="text" name="username" required>

          <label for="password"><b>Password</b></label>
          <input class="form-control" type="password" name="password" id="pwd" required>

          <label for="course"><b>Course</b></label>
          <input class="form-control type="text" name="course" required>

          <label for="sponsor"><b>Sponsor</b></label>
          <input class="form-control" type="text" name="sponsor" required>
          <hr class="mb-3">
          
          <input class="btn btn-primary" type="submit" name="register" value="Register">  
                     <br />  
                     <p align="center"><a href="test.php?action=login">Login</a></p>  
                </form>  
                <?php  
                }  
                ?>  
           </div>  
      </body>  
 </html>  