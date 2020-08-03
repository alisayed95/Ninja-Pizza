<?php 
	
	//connect to database
	$conn = mysqli_connect("localhost","Ali","12345678", "ninja_pizza");
	
	//check connection
	if(!$conn){
		echo "Connection Error" . mysqli_connect_error();
	}

?>