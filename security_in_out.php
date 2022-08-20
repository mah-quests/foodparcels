<?php

  include_once "header.php";
  
  if(isset($_POST['submit'])) 
  {

    $passed_code = $_GET['code'];

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
   
          if($row->role == "security"){

            $_SESSION['loggedin'] = TRUE;
            $_SESSION['foodbank'] = $row->foodbank;
            $_SESSION['security_name'] = $row->first_name.' '.$row->surname;
            $_SESSION['security_uid'] = $row->user_id;
            $_SESSION['region'] = $row->region;
            $_SESSION['security_role'] = $row->role;

            if($_GET["action"] == "transit"){
              $foodpack_data = array(
      
                  'unique_code' => $passed_code,
                  'foodpack_state' => "In Transit",
                  'state' => "intransit",
      
              );
            } else {
              $foodpack_data = array(
      
                'unique_code' => $passed_code,
                'foodpack_state' => "Food Bank",
                'state' => "foodbank",
      
            );        
            }
              
              $api_url = $APIBASE."foodpack_exec.php?action=update_foodpack_state";
              $client = curl_init($api_url);
              curl_setopt($client, CURLOPT_POST, true);
              curl_setopt($client, CURLOPT_POSTFIELDS, $foodpack_data);
              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
              $response = curl_exec($client);
              curl_close($client); 
              
      
      
              $activities_data = array(
                'unique_code' => $passed_code,
                'action_performed' => "The security has processed a food pack and changed its status, ",
                'performed_by' => $_SESSION['security_name'],
                'user_id'  => $_SESSION['security_uid'],
                'region' => $_SESSION['region']
              );
            
              $api_url = $APIBASE."activity_notification_exec.php?action=add_user_activity";
              $client = curl_init($api_url);
              curl_setopt($client, CURLOPT_POST, true);
              curl_setopt($client, CURLOPT_POSTFIELDS, $activities_data);
              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
              $response = curl_exec($client);
              curl_close($client);
              $result = json_decode($response, true); 
      
      
              if($_GET["action"] == "transit"){

                $success = "<br>Successfully Authenticated, final step before submiting information! <p>You will be redirected in <span id='counter'>1</span> second(s).</p>
                <script type='text/javascript'>
                    function countdown() {
                      var i = document.getElementById('counter');
                      if (parseInt(i.innerHTML)<=0) {
                        location.href = 'intransit_details.php?action=transit&code=$passed_code';
                      }
                      i.innerHTML = parseInt(i.innerHTML)-1;
                    }
                    setInterval(function(){ countdown(); },1000);
                    </script>'";  

              } else {

                $success = "<br>Successfully Authenticated, final step before submiting information! <p>You will be redirected in <span id='counter'>1</span> second(s).</p>
                <script type='text/javascript'>
                    function countdown() {
                      var i = document.getElementById('counter');
                      if (parseInt(i.innerHTML)<=0) {
                        location.href = 'intransit_details.php?action=foodbank&code=$passed_code';
                      }
                      i.innerHTML = parseInt(i.innerHTML)-1;
                    }
                    setInterval(function(){ countdown(); },1000);
                    </script>'";  

              }



          } else {
            $error_message = "<br>NOT SECURITY ROLE! You do not have permission to authorise food pack to be in-transit! Please try again<p>You will be redirected in <span id='counter'>1</span> second(s).</p>
            <script type='text/javascript'>
                function countdown() {
                var i = document.getElementById('counter');
                if (parseInt(i.innerHTML)<=0) {
                  location.href = 'security_in_out.php?action=transit&code=$passed_code';
                }
                i.innerHTML = parseInt(i.innerHTML)-1;
                }
                setInterval(function(){ countdown(); },3000);
                </script>'";   

          }

        } else {

          $error_message = "<br>The password entered is incorrect! Please try again<p>You will be redirected in <span id='counter'>1</span> second(s).</p>
          <script type='text/javascript'>
              function countdown() {
              var i = document.getElementById('counter');
              if (parseInt(i.innerHTML)<=0) {
                location.href = 'security_in_out.php?action=transit&code=$passed_code';
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
              location.href = 'security_in_out.php?action=transit&code=$passed_code';
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
                  DSD Security Portal
              </h4>

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

                <?php
                    $api_url = $APIBASE."foodpack_exec.php?action=show_foodpack_by_code&code=".$_GET["code"]."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);

                    if(count($result) > 0)
                    {
                        foreach($result as $row)
                        {

                            if( $row->state == "foodbank" ){

                                $fromto = '<h5 align="center" style="color:red">Authorization From Food Bank To <b>Transit</b></h5>';

                            } else if ($row->state == "intransit") {

                                $fromto = '<h5 align="center" style="color:green">Authorization From In Transit Back <b>To Food Bank</b></h5>';

                            }

                ?>   

                        <h4 class="mb-0" align="center"><b>Reference Number:</b><?php echo $row->unique_code ?></h4>
                        <h4 class="mb-0" align="center" style="color:green"><b>Current Location: </b><?php echo $row->foodpack_state ?></h4>
                        <br><br>
                        <b><?php echo $fromto ?></b>

                <?php 
                    } 
                    }
                ?> 
          
                <div class="form-group">
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
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-lock text-primary"></i>
                      </span>
                    </div>
                    <input type="password" class="form-control form-control-lg border-left-0" id="password" name="password" placeholder="Enter Password">                        
                  </div>
                </div>
                <div class="my-3" align="center">
                    <input class="btn btn-primary btn-rounded btn-fw" type="submit" name="submit" value="Approve">
                </div>
              </div>
              </form>
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
