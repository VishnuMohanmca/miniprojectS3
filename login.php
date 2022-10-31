<?php
session_start();

if(isset($_SESSION['islogged'])){
    $islogged=$_SESSION['islogged'];
    if($islogged==true){
        header('Location: index.php');
        
    }
}
?>
<!DOCTYPE html>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="logstyle.css">

    <title>Login & Registration Form</title>
</head>

<body>
<?php
    include('dbconn.php');

    if(isset($_POST['signup-submit']))
    {
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $email = $_POST['email'];
        $lastname= $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $name= $firstname." ".$lastname;
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $password = $_POST['password'];
        $pass=md5($password);
        $role=$_POST['role'];
        $status=1;
        $sql1 = "INSERT INTO tbl_registration VALUES (null,'$email', '$name', '$phone', '$gender', '$status')";
    
        $sql3="select * from tbl_registration where (email='$email');";

        $res=mysqli_query($conn,$sql3);
  
        if (mysqli_num_rows($res) > 0) {
          
          $row = mysqli_fetch_assoc($res);
          if($email==isset($row['email']))
          {
                  echo "<script> alert('email already exists');</script>";
          }
          }
        if(mysqli_query($conn, $sql1)){
            $reg_id_res= mysqli_query($conn,"SELECT * from tbl_registration WHERE email='$email'");
            if($reg_id_res && mysqli_num_rows($reg_id_res)==1){

                $reg_data= mysqli_fetch_array($reg_id_res);
                $reg_id= $reg_data['reg_id'];

                $sql2 = "INSERT INTO tbl_login VALUES (null,$reg_id,'$email','$pass','$role','$status',0)";
                if(mysqli_query($conn, $sql2)){
                echo"<script> alert('registration successful');</script>";
                    $_SESSION['islogged']=true;
                    $_SESSION['login_user']= $name;
                    if($role=='customer'){
                        echo"<script>window.location.href='index.php';</script>";
                    }
                    else{
                        echo"<script>window.location.href='../seller/sellerindex.php';</script>";
                    }
                    // header('Location: index.php');
                    
                } else{
                    echo "ERROR: Could not able to execute $sql2. " . mysqli_error($conn);
                }
            }
            
        }
        else{
            echo "ERROR: Could not able to execute $sql1. " . mysqli_error($conn);
        }
    }

    if(isset($_POST['login-submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $pass=md5($password);

        $login_sql= "SELECT * FROM tbl_login WHERE email='$email' AND user_passwrd='$pass'";
        $logress=mysqli_query($conn,$login_sql);
        //echo($logress);
        if (mysqli_num_rows($logress) == 1) {
            $details_sql= "SELECT * FROM tbl_registration WHERE email='$email'";
            $detailsres=mysqli_query($conn,$details_sql);
            if($detailsres){
                $row=mysqli_fetch_array( $detailsres);
                $_SESSION['islogged']=true;
                $_SESSION['login_user']= $row['name'];  // Initializing Session with value of PHP Variable
                echo "<script>window.alert('Login Successful !!')</script>";
                //header('Location: index.php');

                $log_details= mysqli_fetch_array($logress);
                $role= $log_details['user_role'];
                if($role=='customer'){
                    header('Location: index.php');
                }
                else{
                    header('Location: seller/sellerpage.php');
                }

            }
            //   else if($role=='seller'){
            //       header('Location: seller/sellerpage.php');
            //  }
            session_start();
            $_SESSION["id"] = $row['seller_id'];
            $_SESSION["name"] = $row['name'];
             // Store Session Data

         
        }
        else{
            echo "<script>alert('Unable to Login !! Invalid email or password')</script>";
        }
    }
?>

    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title" style="color: #eaeaea">Login</span>

                <form action="login.php" method="POST">

                    <!-- <div class="custom_select" id="role-div" style="margin-left: 0px;"> -->
                        <!-- <i class="fa fa-tasks icon"></i> -->
                        <!-- <select name="role" id="role" required> -->
                            <!-- <option value="" disabled selected>Select your role</option> -->
                            <!-- <option value="admin">Admin</option> -->
                            <!-- <option value="customer">Customer</option> -->
                            <!-- <option value="seller">Seller</option> -->
                            <!-- <option value="delivary_agent">Delivary Agent</option> -->
                        <!-- </select> -->
                    <!-- </div> -->

                    <div class="input-field">
                        <input type="email" id="email" name="email" placeholder="Enter your email" autocomplete="off" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" id="pwd" class="password" name="password" placeholder="Enter your password"
                         required pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$" 
                         oninvalid="setCustomValidity('Invalid password !!')" 
                        oninput="setCustomValidity('')"
                        maxlength="20">

                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="logCheck" name="remember">
                            <label for="logCheck" class="text">Remember me</label>
                        </div>

                        <a href="../ProjectMobilestore/resetpassFolder/forgot-password.php" class="text">Forgot password?</a>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="login-submit" value="Login">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Not a member?
                    <a href="#" class="text signup-link">Signup Now</a>
                </span>
                </div>
            </div>

            <!-- Registration Form -->
            <div class="form signup">
                <span class="title" style="color: #eaeaea">Registration</span>

                <form action="login.php" method="POST" onsubmit="return validate();">

                <div class="signup-input-div">
                    <div class="input-field" id="firstname-div">
                        <input type="text" id="reg_firstname" name="firstname" autocomplete="off" placeholder="Enter your first name" required pattern="[a-zA-Z]{3,30}"  
                        oninvalid="setCustomValidity('Invalid Username !!')" 
                        oninput="setCustomValidity('')"
                        maxlength="30">
                        <i class="uil uil-user"></i>
                    </div>

                    <div class="input-field" id="lastname-div">
                        <input type="text" id="reg_lastname" name="lastname" placeholder="Enter your last name" autocomplete="off"  required pattern="[a-zA-Z]{1,30}"  
                        oninvalid="setCustomValidity('Invalid Username !!')" 
                        oninput="setCustomValidity('')"
                        maxlength="30">
                        <i class="uil uil-user"></i>
                    </div>

                </div>

                    <div class="signup-input-div">
                        <div class="input-field" id="email-div">
                            <input type="email" id="reg_email" name="email"  placeholder="Enter your email" autocomplete="off"  required  oninvalid="setCustomValidity('Invalid Email id !!')" 
                        oninput="setCustomValidity('')"
                        maxlength="30">
                            <i class="uil uil-envelope icon"></i>
                        </div>
                        <div class="input-field" id="phone-div">
                            <input type="number" id="reg_phone" name="phone" min="10" maxlength="10" autocomplete="off"  placeholder="Enter your number" required>
                            <i class="uil uil-phone icon"></i>
                        </div>
                    </div>
                    
                    <div class="signup-input-div">
                        <div class="custom_select" id="gender-div">
                        <i class="fa fa-mars-double icon"></i>
                            <select name="gender" id="reg_gender" required>
                                <option value="" disabled selected>Select your gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                        <div class="custom_select" id="role-div">
                        <i class="fa fa-tasks icon"></i>
                            <select name="role" id="reg_role" required>
                                <option value="" disabled selected>Select your role</option>
                                <option value="customer">Customer</option>
                                <option value="seller">Seller</option> 
                                <option value="delivary_agent">Delivary Agent</option> 
                            </select>
                        </div>
                    </div>

                    <div class="signup-input-div">
                        <div class="input-field" id="password-div">
                            <input type="password" id="reg_password" class="password" name="password" minlength="8" maxlength="20" placeholder="Create a password" required pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$" 
                         oninvalid="setCustomValidity('Invalid password !!')" 
                        oninput="setCustomValidity('')"
                        maxlength="20">
                            <i class="uil uil-lock icon"></i>
                        </div>
                        <div class="input-field" id="conf-password-div">
                            <input type="password" id="reg_confpassword" class="password" name="cpassword" minlength="8" maxlength="20" placeholder="Confirm a password" required pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$" 
                         oninvalid="setCustomValidity('Invalid password !!')" 
                        oninput="setCustomValidity('')"
                        maxlength="20">
                            <i class="uil uil-lock icon"></i>
                            <i class="uil uil-eye-slash showHidePw"></i>
                        </div>
                    </div>

                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="regterm" name="regterm">
                            <label for="termCon" class="text">I accepted all terms and conditions</label>
                        </div>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="signup-submit" value="Signup">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Already a member?
                    <a href="#" class="text login-link">Login Now</a>
                </span>
                </div>
            </div>
        </div>
    </div>

    <script src="logscript.js"></script>
       
</body>

</html>