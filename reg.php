<?php

            $username    = $_POST['username'];
            $password    = $_POST['password'];
            $firstname   = $_POST['fname'];
            $lastname    = $_POST['lname'];
            $phone       = $_POST['phone'];
            $email       = $_POST['email'];
            $city        = $_POST['city'];
            // $password    = md5($password);
            $state       = $_POST['state'];
            $rating      = $_POST['rating'];
            $background  = $_POST['background_pass'];
            
            


    
    $conn = new mysqli('us-cdbr-iron-east-01.cleardb.net:3306','b0fc7571f78ffb','b562c8a3','heroku_cb680c63ed9989a');

    if ($conn->connect_error) {
        die('Connection Failed : '.$conn->connect_error);
    } else{
        
        $stmt = $conn->prepare("insert into users (username, password, fname, lname, phone, email, city, state, rating, background_pass) 
            values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $username,  $password, $firstname, $lastname, $phone, $email, $city, $state, $rating, $background);

        
        $stmt->execute();
        header("Location: login.php");
        echo "Registration Successful!";
        $stmt->close();
        $conn->close();
    }
?>
