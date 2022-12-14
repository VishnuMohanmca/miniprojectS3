<?php
    include 'dbconn.php';
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

    <header class="">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <h2>MobiStore<em></em></h2>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home
                  <span class="sr-only">(current)</span>
                </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="products.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="checkout.php">Checkout</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">About</a>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="about.php">About Us</a>
                                <a class="dropdown-item" href="blog.php">Blog</a>
                                <a class="dropdown-item" href="testimonials.php">Testimonials</a>
                                <a class="dropdown-item" href="terms.php">Terms</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

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
                        $product_sql= "SELECT * from tbl_products";
                    }
                    
                    $prod_query= mysqli_query($conn, $product_sql);

                    while ($row = mysqli_fetch_array($prod_query)) {

                        $prod_name= $row[2];
                        $prod_img= $row[5];
                        $prod_offer= $row[8];
                        $prod_price= $row[7];
                        $prod_feature= $row[13];
                        
                            echo '
                                <div class="col-md-4">
                                    <div class="service-item">
                                        <div id="product_img_div">
                                            <img id="product_img" src="'.$prod_img.'" alt="'.$prod_name.'">
                                        </div>
                                        <div class="down-content">
                                            <h4 id="product_name">'.$prod_name.'</h4>
                                            <div style="margin-bottom:10px;">
                                                <span>
                                                    <del><sup>???</sup>'.$prod_price.'</del> &nbsp; <sup>???</sup>'.$prod_offer.'</span>
                                            </div>

                                            <p id="product_feat">'.$prod_feature.'</p>
                                            <a href="product-details.php" class="filled-button">View More</a>
                                        </div>
                                    </div>

                                    <br>
                                </div>
                            ';

                    }
                    
                ?>

            </div>

            <br>
            <br>

            <div id="showTable"></div>
            <div class="a">
                <a href="javascript:getPereviousPage()" id="previousPage">Previous Page</a>
                <a href="javascript:getNextPage()" id="nextPage">Next Page</a> Page Number: <span id="paginationPage"></span>
            </div>

            <nav>
                <ul class="pagination pagination-lg justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">??</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
              
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">??</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
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
                    <p>Vivamus tellus mi. Nulla ne cursus elit,vulputate. Sed ne cursus augue hasellus lacinia sapien vitae.</p>
                    <ul class="social-icons">
                        <li><a rel="nofollow" href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-3 footer-item">
                    <h4>Useful Links</h4>
                    <ul class="menu-list">
                        <li><a href="#">Vivamus ut tellus mi</a></li>
                        <li><a href="#">Nulla nec cursus elit</a></li>
                        <li><a href="#">Vulputate sed nec</a></li>
                        <li><a href="#">Cursus augue hasellus</a></li>
                        <li><a href="#">Lacinia ac sapien</a></li>
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
                        Copyright ?? 2020 Company Name - Template by: <a href="https://www.phpjabbers.com/">PHPJabbers.com</a>
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



<script type="text/javascript">
        var currentPage = 1;
        var CountPerEachPage = 2;
        //json object mapping for content
        var paginationObject = [{
            content: "Hi,"
        }, {
            content: "Hello...."
        }, {
            content: "I"
        }, {
            content: "Amardeep."
        }, {
            content: "My"
        }, {
            content: "Best"
        }, {
            content: "Friend"
        }, {
            content: "is"
        }, {
            content: "Paramesh"
        }, {
            content: "Nathi"
        }, {
            content: ".........."
        }, ];
        //function for go to previous page
        function getPereviousPage() {
            if (currentPage > 1) {
                currentPage--;
                validateEachPage(currentPage);
            }
        }
        //function for go to next page
        function getNextPage() {
            if (currentPage < numberOfPages()) {
                currentPage++;
                validateEachPage(currentPage);
            }
        }
        //function for validating real time condition like if move to last page, last page disabled etc
        function validateEachPage(paginationPage) {
            var nextPage = document.getElementById("nextPage");
            var previousPage = document.getElementById("previousPage");
            var showMyTable = document.getElementById("showTable");
            var paginationPage_span = document.getElementById("paginationPage");
            //validating pages based on page count
            if (paginationPage < 1)
                paginationPage = 1;
            if (paginationPage > numberOfPages())
                paginationPage = numberOfPages();
            showMyTable.innerHTML = "";
            for (var i = (paginationPage - 1) * CountPerEachPage; i < (paginationPage * CountPerEachPage); i++) {
                showMyTable.innerHTML += paginationObject[i].content + "<br>";
            }
            paginationPage_span.innerHTML = paginationPage;
            if (paginationPage == 1) {
                previousPage.style.visibility = "hidden";
            } else {
                previousPage.style.visibility = "visible";
            }
            if (paginationPage == numberOfPages()) {
                nextPage.style.visibility = "hidden";
            } else {
                nextPage.style.visibility = "visible";
            }
        }
        //function per number of Pages
        function numberOfPages() {
            return Math.ceil(paginationObject.length / CountPerEachPage);
        }
        //loading al JavaScript functions functionality
        window.onload = function() {
            validateEachPage(1);
        };
    </script>

</body>

</html>