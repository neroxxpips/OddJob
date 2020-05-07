 <?php

 	$conn = new mysqli('localhost:8889','root','root','votersaccount');

    if (isset($_POST['save'])) {

            $username    = $_POST['username'];
            $answer  = $_POST['answer'];
            


    
    

	    if ($conn->connect_error) {
	        die('Connection Failed : '.$conn->connect_error);
	    } else{
	        
	        $stmt = $conn->prepare("insert into password_resets(username, answer) 
	            values (?, ?)");
	        $stmt->bind_param("ss", $username, $answer);

	        $stmt->execute();
	        header("Location: home.php");
	       
	        $stmt->close();
	        $conn->close();
	    }

	}
?>
 


 <!DOCTYPE html>
<html>
<head>
	<title>Security Question</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/style.css">
	<link href="https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>
<body>
<div class="row">
	<div class="col-sm-4"></div>
	<div class="col-sm-4" style="margin-top: 200px">
	
	<h2 class="form-title">Security Question</h2>
	<hr class="mb-4">
	<form action="" method="post">
	  		<div class="form-group">
	   			 <label for="username">What is you username?</label>
	    		 <input type="text" class="form-control" name="username" required>
	  		</div>
	  		
	 	    <div class="form-group">
	   			 <label for="answer"> What is you favorite color?</label>
	    		 <input type="text" class="form-control" name="answer" required>
	 	    </div>
	 	    
	  	    
	           
	           <button type="submit" class="btn btn-primary" name="save">Save</button>   
		</form>
		
		
		<hr class="mb-4">
	</div>
</div>
</body>
</html>