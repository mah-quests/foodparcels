<?php

  include_once "header.php";
  include("config/connect.php");

  error_reporting(0);
  session_start();

  if (isset($_POST['submit'])) {

        //Populate the stock activities table (foodbank_stock_details_tbl)
        $user_data = array(
        'first_name' => $_POST["first_name"],
        'surname' => $_POST["surname"],
        'username' => $_POST["username"],
        'password' => $_POST["password"],
        'role' => $_POST["role"],
        'region' => $_POST["region"],
        'foodbank' => $_POST["foodbank"],
        'code' => $_POST["code"]
        );


        $api_url = $APIBASE."systems_users_exec.php?action=add_systems_user";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $user_data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        $result = json_decode($response, true);  
        
        
        if(count($result) > 0){

            $success = "<br>Finished adding a User! <p>You will be redirected in <span id='counter'>1</span> second(s).</p>
            <script type='text/javascript'>
                function countdown() {
                var i = document.getElementById('counter');
                if (parseInt(i.innerHTML)<=0) {
                    location.href = 'index.php';
                }
                i.innerHTML = parseInt(i.innerHTML)-1;
                }
                setInterval(function(){ countdown(); },1000);
                </script>'"; 
        } else {
            $error_message = "<br>There was an error adding the User! <p>You will be redirected in <span id='counter'>1</span> second(s).</p>
            <script type='text/javascript'>
                function countdown() {
                var i = document.getElementById('counter');
                if (parseInt(i.innerHTML)<=0) {
                    location.href = 'register.php';
                }
                i.innerHTML = parseInt(i.innerHTML)-1;
                }
                setInterval(function(){ countdown(); },1000);
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
              <h4 align="center">Food Distribution Centre Automation System</h4>
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
                  <input type="text" class="form-control form-control-lg" name="reg_key" id="reg_key"  placeholder="Registration API Key" onchange="showHideRegistrationAfterKey(this.value)" required>
                </div>

                <div id="registration_full_form" style="display:none">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg" id="first_name" name="first_name" placeholder="Enter First Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg" id="surname" name="surname"  placeholder="Enter Surname" required>
                    </div>
                    <div class="form-group">
                        <select class="form-control form-control-lg" id="region" name="region" required>
                            <option>Select Region</option>
                            <option>Johannesburg</option>
                            <option>Tshwane</option>
                            <option>Sedibeng</option>
                            <option>Ekurhuleni</option>
                            <option>West Rand</option>
                        </select>
                    </div>  
                    <div class="form-group">
                        <select class="form-control form-control-lg" id="role" name="role" required>
                            <option>Select Role</option>
                            <option value="manager">Manager</option>
                            <option value="supplier">Supplier</option>
                            <option value="agent">Agent</option>
                            <option value="security">Security</option>
                        </select>
                    </div>                     
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg" id="foodbank" name="foodbank"  placeholder="Enter Food Bank Name" required>
                    </div>                                      
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg" id="username" name="username"  placeholder="Enter Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg" id="password" name="password"  placeholder="Enter Password" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg" id="code" name="code"  placeholder="Enter Unique User Code" required>
                    </div>

                    <div align="center">
                        <input  class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Register">
                    </div>
                    <br><br>

                </div>
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
