<?php

            $username    = $_POST['username'];
            $answer_one  = $_POST['answer_one'];
            $answer_two  = $_POST['answer_two'];


    $conn = new mysqli('localhost:8889','root','root','votersaccount');

    

	    if ($conn->connect_error) {
	        die('Connection Failed : '.$conn->connect_error);
	    } else{
	        
	        $stmt = $conn->prepare("insert into sec_answer(username, answer_one, answer_two) 
	            values (?, ?, ?)");
	        $stmt->bind_param("sss", $username, $answer_one, $answer_two);

	        $stmt->execute();

	        header("Location: home.php");
	       
	        $stmt->close();
	        $conn->close();
	    

	}

	?>