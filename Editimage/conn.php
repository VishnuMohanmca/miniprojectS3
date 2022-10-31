<?php
	$conn = mysqli_connect("localhost", "root", "", "mobilestore");
	
	if(!$conn){
		die("Error: Failed to connect to database!");
	}
?>