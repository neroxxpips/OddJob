<?php

            $image       = time() . '_' . $_FILES['image']['name'];
            // $target = 'images/' . $image;
            // move_uploaded_file($_FILES['image']['tmp_name'], $target);

            $firstname   = $_POST['firstname'];
            $lastname    = $_POST['lastname'];
            $sex         = $_POST['sex'];
            $username    = $_POST['username'];
            $password    = $_POST['password'];
            // $salt        = "votersaccount";
            // $password = sha1($password.$salt);
            $password    = md5($password);
            $course      = $_POST['course'];
            $sponsor     = $_POST['sponsor'];


    
    $conn = new mysqli('localhost:8889','root','root','votersaccount');

    if ($conn->connect_error) {
        die('Connection Failed : '.$conn->connect_error);
    } else{
        
        $stmt = $conn->prepare("insert into voters (image, firstname, lastname, sex, username, password, course, sponsor) 
            values (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $image, $firstname, $lastname, $sex, $username, $password, $course, $sponsor);

        
        $stmt->execute();
        header("Location: /login.php");
        echo "Registration Successful!";
        $stmt->close();
        $conn->close();
    }
?>
