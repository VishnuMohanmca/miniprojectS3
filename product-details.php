<?php

    include 'dbconn.php';
    if(isset($_GET['pid'])){
        $prod_id= $_GET['pid'];
        $product_details_query= mysqli_query($conn,"SELECT * from tbl_products WHERE product_id='$prod_id' AND prod_status!=0");
        if($product_details_query && mysqli_num_rows($product_details_query)==1){
            $presult= mysqli_fetch_row($product_details_query);
            $pdes= $presult[14];
            $pimg= $presult[5];
            $pname= $presult[2];
        }
        else{
            $pdes= "Sample Description";
            $pimg= "seller/photos/Samsung Galaxy M10.jpg";
            $pname= "Sample Name";

        }
    }
    else{
        header('Location: products.php');
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>mobistore.com </title>

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
                        <li><a href="#"><i class="fa fa-envelope"></i>mobistore@gmail.com.com</a></li>
                        <li><a href="#"><i class="fa fa-phone"></i>7025614019</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="right-icons">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="cart.php"><i class=""></i></a></li>
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
                    <h1><small><del><sup></sup> </del></small> &nbsp; <sup></sup></h1>
                    <span>
            </span>
                </div>
            </div>
        </div>
    </div>

    <div class="services">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div>
                        <!-- <img src="../mobiletemplate/images/vivo-y21-000.jpg" alt="" class="img-fluid wc-image"> -->
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-sm-4 col-6">
                            <div>
                                <img src="<?php echo $pimg; ?>" alt="" class="img-fluid">
                            </div>
                            <br>
                        </div>
                        <div class="col-sm-4 col-6">
                            <div>
                                <!-- <img src="../mobiletemplate/images/vivo1.jfif" alt="" class="img-fluid"> -->
                            </div>
                            <br>
                        </div>
                        <div class="col-sm-4 col-6">
                            <div>
                                <!-- <img src="../mobiletemplate/images/vivo2.jfif" alt="" class="img-fluid"> -->
                            </div>
                            <br>
                        </div>
                    </div>

                    <br>
                </div>

                <div class="col-md-5">
                    <div class="sidebar-item recent-posts">
                        <div class="sidebar-heading">
                            <h4>Info</h4>
                            <h2><?php echo $pname; ?></h2>
                        </div>

                        <div class="content">
                            <p></p>
                        </div>
                    </div>

                    <br>
                    <br>

                    <h4>Add to Cart</h4>

                    <br>

                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="">Extra 1</label>
                                    <select class="form-control">
                                        <option value="0">Extra A</option>
                                        <option value="0">Extra B</option>
                                        <option value="0">Extra C</option>
                                        <option value="0">Extra D</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="">Quantity</label>
                                    <input type="text" value="1" required="" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <a href="#" class="filled-button">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <br>
                </div>
            </div>

            <br>

            <h4>Description</h4>

            <p><?php echo $pdes; ?></p>



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
                    <h4>MobiStore</h4>
                    <p></p>
                    <ul class="social-icons">
                        <li><a rel="nofollow" href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-3 footer-item">
                    <h4>Useful Links</h4>
                    <ul class="menu-list">
                        <li>
                            <a href="#"></a>
                        </li>
                        <li>
                            <a href="#"></a>
                        </li>
                        <li>
                            <a href="#"></a>
                        </li>
                        <li>
                            <a href="#"></a>
                        </li>
                        <li>
                            <a href="#"></a>
                        </li>
                    </ul>
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
                        Copyright © 2022  <a href="https://mobistore.com/">mobistore.com</a>
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