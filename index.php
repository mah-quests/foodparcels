<?php 

include("config/connect.php");
error_reporting(0); // hide undefine index errors
session_start(); // temp sessions

if(isset($_POST['submit'])) 
{

 $username = $_POST["username"];

 $api_url = $APIBASE."systems_users_exec.php?action=check_user_login&username=".$username."";
 $client = curl_init($api_url);
 curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
 $response = curl_exec($client);
 $result = json_decode($response);


 if(count($result) > 0){
   foreach($result as $row) {

      $db_password = $row->password;

      if (password_verify($_POST['password'], $db_password)) {

        $_SESSION['loggedin'] = TRUE;
        $_SESSION['foodbank'] = $row->foodbank;
        $_SESSION['name'] = $row->first_name.' '.$row->surname;
        $_SESSION['user_id'] = $row->user_id;
        $_SESSION['region'] = $row->region;
        $_SESSION['role'] = $row->role;

        if($row->role == "manager"){

          $success = "<br>Username and Password match. Login successfully! <p>You will be redirected in <span id='counter'>1</span> second(s).</p>
          <script type='text/javascript'>
              function countdown() {
              var i = document.getElementById('counter');
              if (parseInt(i.innerHTML)<=0) {
                  location.href = 'manager/dashboard.php';
              }
              i.innerHTML = parseInt(i.innerHTML)-1;
              }
              setInterval(function(){ countdown(); },3000);
              </script>'";  

          header("refresh:1;url=manager/dashboard.php");

        } else if ($row->role == "supplier"){


          $success = "<br>Username and Password match. Login successfully! <p>You will be redirected in <span id='counter'>1</span> second(s).</p>
          <script type='text/javascript'>
              function countdown() {
              var i = document.getElementById('counter');
              if (parseInt(i.innerHTML)<=0) {
                  location.href = 'supplier/dashboard.php';
              }
              i.innerHTML = parseInt(i.innerHTML)-1;
              }
              setInterval(function(){ countdown(); },3000);
              </script>'";  

          header("refresh:1;url=supplier/dashboard.php");
        }                 

      } else {

        $error_message = "<br>The password entered is incorrect! Please try again<p>You will be redirected in <span id='counter'>1</span> second(s).</p>
        <script type='text/javascript'>
            function countdown() {
            var i = document.getElementById('counter');
            if (parseInt(i.innerHTML)<=0) {
                location.href = 'index.php';
            }
            i.innerHTML = parseInt(i.innerHTML)-1;
            }
            setInterval(function(){ countdown(); },3000);
            </script>'";   

      }

   } 

  } else {

    $error_message = "<br>The username entered is incorrect! Please try again<p>You will be redirected in <span id='counter'>1</span> second(s).</p>
    <script type='text/javascript'>
        function countdown() {
        var i = document.getElementById('counter');
        if (parseInt(i.innerHTML)<=0) {
            location.href = 'index.php';
        }
        i.innerHTML = parseInt(i.innerHTML)-1;
        }
        setInterval(function(){ countdown(); },3000);
        </script>'";      

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

            <div align="center">
                  <?php if (!empty($error_message)) {
                    echo '<div class="alert alert-danger">' . $error_message . '</div>';
                    }
                    if (!empty($success)) {
                      echo '<div class="alert alert-success">' . $success . '</div>';
                    }
					        ?>
                </div>   

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
                  <a href="reset_password.php" class="auth-link text-black">Forgot password?</a>
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
