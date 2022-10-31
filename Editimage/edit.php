<?php
	include 'conn.php';
	if(ISSET($_POST['edit'])){
		$pid = $_POST['pid'];
		$image_name = $_FILES['photo']['name'];
		$image_temp = $_FILES['photo']['tmp_name'];
		$pname = $_POST['pname'];
		$pprice = $_POST['pprice'];
		$poffer = $_POST['poffer'];
		$pfeature = $_POST['pfeature'];
		

		$pfeature = $_POST['previous'];
		$exp = explode(".", $image_name);
		$end = end($exp);
		$name = time().".".$end;
		$path = "seller/photos/".$name;
		$allowed_ext = array("gif", "jpg", "jpeg", "png");
		if(in_array($end, $allowed_ext)){
			if(unlink($previous)){
				if(move_uploaded_file($image_temp, $path)){
					mysqli_query($conn, "UPDATE `tbl_products` set `prod_name` = '$pname', `prod_price` = '$pprice',`prod_offer`='$pofer',`prod_feature`='$pfeature', `pimage` = '$path' WHERE `product_id`='$pid'") or die(mysqli_error($conn));
					echo "<script>alert('User account updated!')</script>";
					header("location: index.php");
				}
			}		
		}else{
			echo "<script>alert('Image only')</script>";
		}
	}
?>