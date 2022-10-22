 //<?php
//include("products.php")
//?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pagination</title>
</head>

<body>
    <?php
// connect to database
      
    $host = "localhost";  
    $user = "root";  
    $password = '';  
    $db_name = "mobilestore";  
      
    $conn = mysqli_connect($host, $user, $password, $db_name);  
    if(mysqli_connect_errno()) {  
        die("Failed to connect with MySQL: ". mysqli_connect_error()); 
       
        
    }  
    


// define how many results you want per page
$results_per_page = 9;

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
$sql='SELECT * FROM tbl_products LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result)) {
  echo '
      <div class="col-md-4">
          <div class="service-item">
              <div id="product_img_div">
                  <img id="product_img" src="'.$row['5'].'" alt="'.$row['2'].'">
              </div>
              <div class="down-content">
                  <h4 id="product_name">'.$row['2'].'</h4>
                  <div style="margin-bottom:10px;">
                      <span>
                          <del><sup>₹</sup>'.$row['7'].'</del> &nbsp; <sup>₹</sup>'.$row['8'].'</span>
                  </div>

                  <p id="product_feat">'.$row['13'].'</p>
                  <a href="product-details.php" class="filled-button">View More</a>
              </div>
          </div>

          <br>
      </div>
  ';
}

// display the links to the pages
for ($page=1;$page<=$number_of_pages;$page++) {
  echo '<a href="pagination.php?page=' . $page . '">' . $page . '</a> ';
}

?>
</body>

</html>