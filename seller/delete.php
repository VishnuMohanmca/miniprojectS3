<?php
    include "../dbconn.php";
    if(isset($_GET['pid'])){
        $pid = $_GET['pid'];
        // $sql = "DELETE from `tbl_products` where product_id=$pid";
        $sql= "UPDATE tbl_products SET prod_status=0 WHERE product_id=$pid";
        $conn->query($sql);
    }
    header('location:sellerindex.php');
    exit;
?>