<?php
    include 'conn.php';
	if(ISSET($_POST['save'])){
		$image_name = $_FILES['pimage']['name'];
		$image_temp = $_FILES['pimage']['tmp_name'];
		$firstname = $_POST['pname'];
		$pprice = $_POST['pprice'];
		$poffer = $_POST['poffer'];
		$feature = $_POST['pfeature'];
		$exp = explode(".", $image_name);
		$end = end($exp);
		$name = time().".".$end;
		$path = "seller/photos/".$name;
		$allowed_ext = array("gif", "jpg", "jpeg", "png");
		if(in_array($end, $allowed_ext)){
			if(move_uploaded_file($image_temp, $path)){
				mysqli_query($conn, "INSERT INTO `tbl_products` VALUES('$pname', '$pprice', '$poffer','$pfeature' '$path')") or die(mysqli_error($conn));
				echo "<script>alert('User account saved!')</script>";
				header("location: index.php");
			}	
		}else{
			echo "<script>alert('Image only')</script>";
		}
	}
?>