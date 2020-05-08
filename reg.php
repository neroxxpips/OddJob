<?php

            $username    = $_POST['username'];
            $password    = $_POST['pass'];
            $firstname   = $_POST['fname'];
            $lastname    = $_POST['lname'];
            $phone       = $_POST['phone'];
            $email       = $_POST['email'];
            $city        = $_POST['city'];
            $password    = md5($password);
            $state       = $_POST['state'];
            $image       = $_POST['userImageText'];


    $conn = new mysqli('us-cdbr-iron-east-01.cleardb.net:3306','b0fc7571f78ffb','b562c8a3','heroku_cb680c63ed9989a');
    if ($conn->connect_error) {
        die('Connection Failed : '.$conn->connect_error);
    } else{
        
        $stmt = $conn->prepare("insert into users (username, password, fname, lname, phone, email, city, state, rating, background_pass) 
            values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssdi", $username,  $password, $firstname, $lastname, $phone, $email, $city, $state, $dummy = 0, $dummy2 = 0);

        
        $stmt->execute();



        ini_set("allow_url_fopen", 1);

        $url = 'http://localhost:8080/userprofile';

        $data = array (
            'username' => $username,
            'fname' => $firstname,
            'lname' => $lastname,
            'email' => $email,
            'state' => $state,
            'city' => $city,
            'phonenum' => $phone,
            'image' => $image,
        );

        $options = array (
            'http' => array (
                'header' => "Content-Type: application/json\r\n" .
                    "Accept: application/json\r\n",
                'method' => 'POST',
                'content' => json_encode($data)
            )
            );
            
            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            if ($result == FALSE) {
                var_dump($result);
            }
        header("Location: login.php");
    }
?>