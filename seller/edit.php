<?php
  include "../dbconn.php";
 
  $pid="";
  $pname="";
  $pprice="";
  $poffer="";
  $pfeature="";
  $pimg="";

  $error="";
  $success="";

  if($_SERVER["REQUEST_METHOD"]=='GET'){
    if(!isset($_GET['pid'])){
      header("location:/ProjectMobilestore/seller/sellerindex.php");
      exit;
    }
    $pid = $_GET['pid'];
    $sql = "select * from tbl_products where product_id=$pid";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    while(!$row){
      header("location: /ProjectMobilestore/seller/sellerindex.php");
      exit;
    }
    $pname=$row["prod_name"];
    $pprice=$row["prod_price"];
    $poffer=$row["prod_offers"];
    $pfeature=$row["prod_feature"];
    $pimg=$row["prod_img"];
   


  }
  // $name = $_FILES['pimage']['name'];
  // $temp_name = $_FILES['pimage']['temp_name'];

  // if (isset($name)) {

  //     if (!empty($name)) {
  //         $location = '../seller/photos/';
  //     }

  //     if (move_uploaded_file($temp_name, $location.$name)) {
  //         echo 'uploaded';
  //     }

  // } else {
  //     echo 'please uploaded';
  // }
 $targetDir = "../seller/photos/";
 $finaltargetDir = "seller/photos/";
  if(isset($_POST['submit'])){
    $pid = $_POST["pid"];
    $pname=$_POST["pname"];
    $pprice=$_POST["pprice"];
    $poffer=$_POST["poffer"];
    $pfeature=$_POST["pfeature"];
    $pimg=$_FILES["pimage"]["name"];
    $targetFilePath = $targetDir . $pimg;
    $finaltargetFile = $finaltargetDir . $pimg;
    
    move_uploaded_file($_FILES["pimage"]["tmp_name"],$targetFilePath);
    $sql = "update tbl_products set prod_name='$pname', prod_price='$pprice', prod_offers='$poffer', prod_feature='$pfeature',prod_img='$finaltargetFile' where product_id='$pid'";
    //$result = $conn->query($sql);
    $result= mysqli_query($conn,$sql);
    if($result){
      echo "<script>alert('New Item updated Successfully...');</script>";
      header('sellerindex.php');
  }
  else{
    echo "<script>alert('Not updated !!');</script>";
  }
}
  ?>
    

<!DOCTYPE html>
<html>
<head>
 <title>Seller</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" class="fw-bold">
      <div class="container-fluid">
        <a class="navbar-brand" href="sellerindex.php">Seller form</a>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="sellerindex.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Add.php">Add New</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
 <div class="col-lg-6 m-auto">
 
 <form method="post" action="edit.php" enctype="multipart/form-data" name="editForm">
 
 <br><br><div class="card">
 
 <div class="card-header bg-warning">
 <h1 class="text-white text-center">  Update Products </h1>
 </div><br>

 <input type="hidden" id="pid" name="pid" value="<?php echo $pid; ?>" class="form-control"> <br>

 <label> Product Name: </label>
 <input type="text" id="pname" name="pname" value="<?php echo $pname; ?>" class="form-control"> <br>

 <label> Product Price: </label>
 <input type="text" id="pprice" name="pprice" value="<?php echo $pprice; ?>" class="form-control"> <br>

 <label> Offer: </label>
 <input type="text" id="poffer" name="poffer" value="<?php echo $poffer; ?>" class="form-control"> <br>

 <label> Feature: </label>
 <input type="text" id="pfeauture" name="pfeature" value="<?php echo $pfeature; ?>" class="form-control"> <br>

 <label> Upload Image: </label>
 <input type="file" id="pimge" name="pimage" class="form-control"> <br>

 <input type="submit" class="btn btn-success" value="edit" name="submit"><br>
 <a class="btn btn-info" type="submit" name="cancel" href="sellerindex.php"> Cancel </a><br>

 </div>
 </form>
 </div>
</body>
</html>