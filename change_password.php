<?php

  include("config/connect.php");

  error_reporting(0);
  session_start();

  if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $code = $_POST['code'];

    if ($_POST['initpassword'] == $_POST['confirmpassword']){

      $user_details_data = array(
        'user_id' => $_GET['user_id'],
        'password' => $_POST['initpassword']  
      );
    
      $api_url = $APIBASE."systems_users_exec.php?action=reset_user_password";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $user_details_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true); 
    

      $success = "User found... You will now reset your password! <p>Redirection in <span id='counter'>1</span> second(s).</p>
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

      
    } else {

      $error_message = "<br>Error reseting passowrd. The password and confirmed passwords are not the same! <p>You will be redirected in <span id='counter'>1</span> second(s).</p>
      <script type='text/javascript'>
          function countdown() {
          var i = document.getElementById('counter');
          if (parseInt(i.innerHTML)<=0) {
              location.href = 'change_password.php';
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
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div align="center">
                <img src="images/dsd-logo.png" alt="logo" width="100%">
              </div>
              <h4 align="center">DSD User Password Reset Portal</h4>
              <br> 

              <h6>Enter New User Password</h6>

                <div align="center">
                  <?php if (!empty($error_message)) {
                    echo '<div class="alert alert-danger">' . $error_message . '</div>';
                    }
                    if (!empty($success)) {
                      echo '<div class="alert alert-success">' . $success . '</div>';
                    }
					        ?>
                </div>                

              <form action="" method="post" >

                                   
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg" id="initpassword" name="initpassword"  placeholder="Enter New Password" required>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg" id="confirmpassword" name="confirmpassword"  placeholder="Comfirm New Password" required>
                    </div>

                    <div align="center">
                        <input  class="btn btn-primary btn-block" type="submit" name="submit" value="Submit">
                        <a href="index.php"  class="btn btn-danger btn-block">Cancel</a>                      
                    </div>
                    <br><br>

              </form>
                <div align="center">
                    <p> Copyright &copy; 2022  All rights reserved.</p>
                </div>              
            </div>
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
