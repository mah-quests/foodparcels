<?php

  include_once "header.php";

  error_reporting(0);
  session_start();

  if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $code = $_POST['code'];

    $api_url = $APIBASE."systems_users_exec.php?action=check_user_registration&username=".$username."&code=".$code."";
    $client = curl_init($api_url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    $result = json_decode($response);


    if(count($result) > 0){
      foreach($result as $row) {

        $success = "User found... You will now reset your password! <p>Redirection in <span id='counter'>1</span> second(s).</p>
            <script type='text/javascript'>
            function countdown() {
              var i = document.getElementById('counter');
              if (parseInt(i.innerHTML)<=0) {
                location.href = 'change_password.php?user_id=$row->user_id';
              }
              i.innerHTML = parseInt(i.innerHTML)-1;
            }
            setInterval(function(){ countdown(); },3000);
            </script>'";
    
      header("refresh:1;url=change_password.php?user_id=$row->user_id");

      }
    } else {
        $error_message = "<br>There is username and code combination error! <p>You will be redirected in <span id='counter'>1</span> second(s).</p>
        <script type='text/javascript'>
            function countdown() {
            var i = document.getElementById('counter');
            if (parseInt(i.innerHTML)<=0) {
                location.href = 'reset_password.php';
            }
            i.innerHTML = parseInt(i.innerHTML)-1;
            }
            setInterval(function(){ countdown(); },3000);
            </script>'";             
    }

  }

?>

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
              <br>
              <h4 align="center">
                  User Password Reset Portal
              </h4>
              <br> 

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
                        <input type="text" class="form-control form-control-lg" id="username" name="username"  placeholder="Enter Username" required>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg" id="code" name="code"  placeholder="Enter Unique User Code" required>
                    </div>

                    <div align="center">
                        <input  class="btn btn-primary btn-block" type="submit" name="submit" value="Validate">
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
