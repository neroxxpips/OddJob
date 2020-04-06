<?php

            $label       = $_POST['task'];
            $descript    = $_POST['descript'];
            $price       = $_POST['price'];
            $image       = $_POST['image'];


    
    $conn = new mysqli('localhost:8889','root','root','votersaccount');

    if ($conn->connect_error) {
        die('Connection Failed : '.$conn->connect_error);
    } else{
        
        $stmt = $conn->prepare("insert into voters (task, descript, price, image) 
            values (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $task, $descript, $price);

        
        $stmt->execute();
        header("Location: /homepage.php");
        echo "Post Successful!";
        $stmt->close();
        $conn->close();
    }
?>
