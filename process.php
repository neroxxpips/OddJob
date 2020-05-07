<?php
		if(isset($_POST['create'])){
			$image 		 = $_POST['image'];
			$firstname	 = $_POST['firstname'];
			$lastname 	 = $_POST['lastname'];
			$sex 		 = $_POST['sex'];
			$username 	 = $_POST['username'];
			$password 	 = $_POST['password'];
			$course 	 = $_POST['course'];
			$sponsor   	 = $_POST['sponsor'];

			$sql = "INSERT INTO voters (image, firstname, lastname, sex, username, password, course, sponsor) VALUES(?,?,?,?,?,?,?,?)";
			$stmtinsert = $db->prepare($sql);
			$result = $stmtinsert->execute([$image, $firstname, $lastname, $sex, $username, $password, $course, $sponsor]);
			if($result){
				echo 'Successfully saved!';
			}else{
				echo 'There were errors while saving data.';
			}
			 
		} 

		?>