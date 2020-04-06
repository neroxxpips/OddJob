<?php

            $firstname   = $_POST['fname'];
            $lastname    = $_POST['lname'];
            $email         = $_POST['email'];
            $password    = $_POST['password'];
            $password    = md5($password);
            $state    = $_POST['state'];
            $zipcode     = $_POST['z_code'];
            $phone     = $_POST['p_number'];


    
    $conn = new mysqli('localhost:8889','root','root','votersaccount');

    if ($conn->connect_error) {
        die('Connection Failed : '.$conn->connect_error);
    } else{
        
        $stmt = $conn->prepare("insert into voters (fname, lname, email, password, state, z_code, p_number) 
            values (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $firstname, $lastname, $email, $password, $state, $zipcode, $phone);

        
        $stmt->execute();
        header("Location: /login.php");
        echo "Registration Successful!";
        $stmt->close();
        $conn->close();
    }
?>
