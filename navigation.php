<?php
    session_start();
    if(isset($_SESSION['islogged'])){
        $islogged=$_SESSION['islogged'];
    }
    else{
        $islogged=false;
    }

    $home_page=false;
    $product_page=false;
    $about_page=false;
    $contact_page= false;

    if(isset($_GET['loadpage'])){
        $page= $_GET['loadpage'];
        if($page=='home'){
            $home_page= true;
        }
        else if($page=='product'){
            $product_page= true;
        }
        else if($page=='about'){
            $about_page= true;
        }
        else if($page=='contact'){
            $contact_page= true;
        }
        else{
            $home_page= true;
        }
    }
    else{
        $home_page=true;
    }
?>

<header class=" ">
    <nav class="navbar navbar-expand-lg ">
        <div class="container ">
            <a class="navbar-brand " href="index.php ">
                <h2>MobiStore <em></em></h2>
            </a>
            <button class="navbar-toggler " type="button " data-toggle="collapse " data-target="#navbarResponsive " aria-controls="navbarResponsive " aria-expanded="false " aria-label="Toggle navigation ">
                <span class="navbar-toggler-icon "></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarResponsive ">

                <ul class="navbar-nav ml-auto ">
                    <li class="nav-item <?php if($home_page==true){ echo "active"; } ?>">

                        <a class="nav-link " href="index.php?loadpage=home">Home
                            <span class="sr-only ">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item <?php if($product_page==true){ echo "active"; } ?>">
                        <a class="nav-link " href="products.php?loadpage=product">Products</a>
                    </li>
                    <!-- <li class="nav-item ">
                                <a class="nav-link " href="brands.php ">Brands</a>
                            </li> -->
                    <!-- <li class="nav-item ">
                                <a class="nav-link " href="checkout.php ">Checkout</a>
                            </li> -->

                    <li class="nav-item ">
                        <a class="nav-link <?php if($about_page==true){ echo "active"; } ?>" href="about.php?loadpage=about">About Us</a>
                    </li>

                    <!-- <li class="nav-item dropdown">
                                <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">About</a>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="about.php">About Us</a>
                                    <a class="dropdown-item" href="blog.php">Blog</a>
                                    <a class="dropdown-item" href="testimonials.php">Testimonials</a>
                                    <a class="dropdown-item" href="terms.php">Terms</a>
                                </div>
                            </li> -->
                    <li class="nav-item ">
                        <a class="nav-link <?php if($contact_page==true){ echo "active"; } ?>" href="contact.php?loadpage=contact">Contact Us</a>
                    </li>

                    <?php
                    if ($islogged == false) {
                        echo '
                                        <li class="nav-item ">
                                            <a class="nav-link " href="login.php">Login</a>
                                        </li>
                                    ';
                    }
                    ?>

                    <?php
                    if ($islogged == true) {
                        echo '
                                        <li class="nav-item dropdown">
                                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">' . $_SESSION["login_user"] . '</a>
            
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="about.php">Prfoile</a>
                                            <a class="dropdown-item" href="blog.php">Account Settings</a>
                                            <a class="dropdown-item" href="testimonials.php">Checkout</a>
                                            <a class="dropdown-item" href="logout.php">Logout</a>
                                        </div>
                                    </li>
                                    ';
                    }
                    ?>

                </ul>
            </div>
        </div>
    </nav>
</header>