<?php
    include 'dbconn.php';
    $sql="select * from tbl_products";
  
    $num_per_page= 03;
   
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title> Mobile Store Website </title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/owl.css">
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <div class="sub-header">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-xs-12">
                    <ul class="left-info">
                        <li><a href="#"><i class="fa fa-envelope"></i>mobistore2020@gmail.com</a></li>
                        <li><a href="#"><i class="fa fa-phone"></i>7025614019</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="right-icons">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="cart.php"><i class="fa fa-shopping-cart "></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php include 'navigation.php'; ?>

    <!-- Page Content -->
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Products</h1>
                    <span></span>
                </div>
            </div>
        </div>
    </div>

    <div class="services">

        <div id="filters_div">
            <form action="products.php" method="POST">
                <center>
                    <h4>Filters</h4>
                    <p>Select you desired brand to filters and view.</p>
                    <select name="filters" id="filters">
                        <option value="" selected disabled>Select a brand</option>

                        <?php
                            $filter_opt_sql= mysqli_query($conn,"SELECT distinct(prod_brand) FROM tbl_products");
                            if($filter_opt_sql){
                                while ($row = mysqli_fetch_array($filter_opt_sql)) {
                                    echo '<option value="'.$row[0].'">'.$row[0].'</option>';
                                }
                            }
                        ?>
                    </select>

                    <input type="submit" name="filters_submitbtn" id="filters_submitbtn" class="btn btn-primary">
                </center>
            </form>
            <hr>
        </div>

        <div id="products_container" class="container">
            <div class="row">

                <?php
                    // $product_sql= "SELECT * from tbl_products where prod_brand='Vivo'";
                    if(isset($_POST['filters_submitbtn']) && isset($_POST['filters'])){
                        $filter= $_POST['filters'];
                        $product_sql= "SELECT * from tbl_products where prod_brand='$filter'";
                    }
                    else{
                        $product_sql= "SELECT * from tbl_products WHERE prod_status!=0";

                        $results_per_page = 15;

                        // find out the number of results stored in database
                        $sql='SELECT * FROM tbl_products';
                        $result = mysqli_query($conn, $sql);
                        $number_of_results = mysqli_num_rows($result);

                        // determine number of total pages available
                        $number_of_pages = ceil($number_of_results/$results_per_page);

                        // determine which page number visitor is currently on
                        if (!isset($_GET['page'])) {
                        $page = 1;
                        } else {
                        $page = $_GET['page'];
                        }

                        // determine the sql LIMIT starting number for the results on the displaying page
                        $this_page_first_result = ($page-1)*$results_per_page;

                        // retrieve selected results from database and display them on page
                        $product_sql='SELECT * FROM tbl_products WHERE prod_status!=0 LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
                    }
                    
                    $prod_query= mysqli_query($conn, $product_sql);

                    while ($row = mysqli_fetch_array($prod_query)) {

                        $prod_id= $row[0];
                        $prod_name= $row[2];
                        $prod_img= $row[5];
                        $prod_offer= $row[8];
                        $prod_price= $row[7];
                        $prod_feature= $row[13];
                        
                            echo '
                                <div class="col-md-4">
                                    <div class="service-item">
                                        <div id="product_img_div">
                                            <img src= "'.$prod_img.'" id="product_img" alt="'.$prod_name.'">
                                        </div>
                                        <div class="down-content">
                                            <h4 id="product_name">'.$prod_name.'</h4>
                                            <div style="margin-bottom:10px;">
                                                <span>
                                                    <del><sup>₹</sup>'.$prod_price.'</del> &nbsp; <sup>₹</sup>'.$prod_offer.'</span>
                                            </div>

                                            <p id="product_feat">'.$prod_feature.'</p>
                                            <a href="product-details.php?pid='.$prod_id.'" class="filled-button">View More</a>
                                        </div>
                                    </div>

                                    <br>
                                </div>
                            ';

                    }
                    
                ?>

            </div>
            <nav>
                <ul class="pagination pagination-lg justify-content-center">
                
                    <?php

                        if(isset($_GET['page']))
                            $curr_page= $_GET['page'];
                        else
                            $curr_page= 1;

                        if($curr_page > 1){
                            echo '
                                <li class="page-item">
                                    <a class="page-link" href="products.php?page='.($curr_page-1).'" aria-label="Previous">
                                        <span aria-hidden="true">«</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>

                                <li id="pageitem'.($curr_page-1).'" class="page-item"><a id="pagelink'.($curr_page-1).'" class="page-link" href="products.php?page='.($curr_page-1).'">'.($curr_page-1).'</a></li>
                            ';
                        }

                        echo '<li id="pageitem'.$curr_page.'" class="page-item"><a id="pagelink'.$curr_page.'" class="page-link">'.$curr_page.'</a></li>';
                        $docid= "pagelink".$curr_page;
                        echo "<script>
                            document.getElementById('$docid').style.backgroundColor= '#94d924';
                            document.getElementById('$docid').style.color= 'white';
                        </script>";

                        $number_of_results= isset($number_of_results) ? $number_of_results : 1;
                        if($curr_page < $number_of_results){
                            echo '
                                <li id="pageitem'.($curr_page+1).'" class="page-item"><a id="pagelink'.($curr_page+1).'" class="page-link" href="products.php?page='.($curr_page+1).'">'.($curr_page+1).'</a></li>
                                
                                <li class="page-item">
                                    <a class="page-link" href="products.php?page='.($curr_page+1).'" aria-label="Next">
                                        <span aria-hidden="true">»</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            ';
                        }
                        
                    ?>
                </ul>
            </nav>
            <br>
            <br>
            <br>
            <br>
        </div>
    </div>
    <!-- Footer Starts Here -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-3 footer-item">
                    <h4>Mobile Store</h4>
                    <!-- <p>Vivamus tellus mi. Nulla ne cursus elit,vulputate. Sed ne cursus augue hasellus lacinia sapien vitae.</p> -->
                    <ul class="social-icons">
                        <li><a rel="nofollow" href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-3 footer-item">
                    <h4>Useful Links</h4>
                    <!-- <ul class="menu-list">
                        <li><a href="#">Vivamus ut tellus mi</a></li>
                        <li><a href="#">Nulla nec cursus elit</a></li>
                        <li><a href="#">Vulputate sed nec</a></li>
                        <li><a href="#">Cursus augue hasellus</a></li>
                        <li><a href="#">Lacinia ac sapien</a></li>
                    </ul> -->
                </div>
                <div class="col-md-3 footer-item">
                    <h4>Additional Pages</h4>
                    <ul class="menu-list">
                        <li><a href="#">Products</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Terms</a></li>
                    </ul>
                </div>
                <div class="col-md-3 footer-item last-item">
                    <h4>Contact Us</h4>
                    <div class="contact-form">
                        <form id="contact footer-contact" action="" method="post">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <fieldset>
                                        <input name="name" type="text" class="form-control" id="name" placeholder="Full Name" required="">
                                    </fieldset>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <fieldset>
                                        <input name="email" type="text" class="form-control" id="email" pattern="[^ @]*@[^ @]*" placeholder="E-Mail Address" required="">
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <textarea name="message" rows="6" class="form-control" id="message" placeholder="Your Message" required=""></textarea>
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <button type="submit" id="form-submit" class="filled-button">Send Message</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        Copyright © 2020  <a href="https://www.mobistore.com/">mobistore.com</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/accordions.js"></script>

    <script language="text/Javascript">
        cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
        function clearField(t) { //declaring the array outside of the
            if (!cleared[t.id]) { // function makes it static and global
                cleared[t.id] = 1; // you could use true and false, but that's more typing
                t.value = ''; // with more chance of typos
                t.style.color = '#fff';
            }
        }
    </script>




    
</body>
</html>