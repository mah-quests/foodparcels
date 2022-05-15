<?php 
error_reporting(0); // hide undefine index errors
session_start(); // temp sessions

if(isset($_POST['submit'])) 
{
 $username = $_POST["username"];
 $password = $_POST["password"];

 if($username == "manager" && $password == "manager"){
  $_SESSION['loggedin'] = TRUE;
  $_SESSION['foodbank'] = 'Johannesburg Food Bank';
  $_SESSION['name'] = 'Victor Molotsane';
  $_SESSION['user_id'] = '7';
  $_SESSION['region'] = 'Johannesburg';
    header("refresh:0;url=manager/dashboard.php");

 } else if($username == "practitioner" && $password == "practitioner"){

    header("refresh:0;url=practitioner/dashboard.html");

 } else if($username == "supplier" && $password == "supplier"){
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['supplier'] = 'Ithemba Lethu Foods';
    $_SESSION['name'] = 'Frans Modikwe';
    $_SESSION['user_id'] = '6';
    $_SESSION['region'] = 'Johannesburg';
    header("refresh:0;url=supplier/dashboard.php");

 } else if($username == "agent" && $password == "agent"){

    header("refresh:0;url=delivery_agents/dashboard.html");    

 } else if($username == "security" && $password == "security"){

    header("refresh:0;url=security/dashboard.html");    

 } else if($username == "beneficiary" && $password == "beneficiary"){

    header("refresh:0;url=beneficiary/receive_parcel.html");        

 } else{

      header("refresh:0;url=index.php?id=invalid");
 }

} 

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>DSD - Department of Social Development </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">

              <?php

              $login_failed = $_GET["id"];

              if ($login_failed == "invalid"){
              echo '
                  <div class="alert alert-fill-danger" role="alert" align="center">
                    <i class="ti-info-alt"></i>
                    Oh snap! Please enter correct Username and Password!
                  </div>
              ';                
              }

              ?>

              <div>  
                <img src="images/dsd-logo.png" alt="logo" width="300">
              </div>
              <br>
              <h4>Gauteng Food Distribution Center App</h4>
              <h6 class="fw-light"></h6>
              <form action="" method="post" >
                <div class="form-group">
                  <label for="username">Username</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-user text-primary"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control form-control-lg border-left-0" id="username" name="username" placeholder="Enter Username">
                  </div>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-lock text-primary"></i>
                      </span>
                    </div>
                    <input type="password" class="form-control form-control-lg border-left-0" id="password" name="password" placeholder="Enter Password">                        
                  </div>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="my-3">
                    <input  class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Login">
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2022  All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
