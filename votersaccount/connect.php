<?php
            $image       = $_POST['image'];
            $firstname   = $_POST['firstname'];
            $lastname    = $_POST['lastname'];
            $sex         = $_POST['sex'];
            $username    = $_POST['username'];
            $password    = $_POST['password'];
            $course      = $_POST['course'];
            $sponsor     = $_POST['sponsor'];

   


    //Database Connection
    $conn = new mysqli('localhost:3306','root','','votersaccount');
    if ($conn->connect_error) {
        die('Connection Failed : '.$conn->connect_error);
    } else{
        //prepare query and add data to db
        $stmt = $conn->prepare("insert into voter (image, firstname, lastname, sex, username, password, course, sponsor) 
            values (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $image, $firstname, $lastname, $sex, $username, $password, $course, $sponsor);
        //$conn->query("insert into voter (firstname, lastname, image, sex, username, password, course, sponsor) values ('$firstName','ghj','93ej','bijnl','bijn','hbkjn','jnk','jn')");
        $stmt->execute();
        echo "Registration Successful!";
        $stmt->close();
        $conn->close();
    }
?>
