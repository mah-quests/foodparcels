<?php

  include("config/connect.php");

  error_reporting(0);
  session_start();

  if(isset($_POST['submit'])) 
  {

    $passed_code = $_GET['code'];

    if($_GET["action"] == "transit"){

        $activities_data = array(
          'parcel_unique_code' => $passed_code,
          'security_name' => $_SESSION['security_name'],
          'security_uid' => $_SESSION['security_uid'],
          'activity' => "The security has signed out food parcels, ",
          'status' => "in-transit",
          'region' => $_SESSION['region'],
          'driver_1_names'  => $_POST['driver_1_names'],
          'driver_2_names' => $_POST['driver_2_names'],
          'truck_detail' => $_POST['truck_detail']
        );

      } else {
        $activities_data = array(
          'parcel_unique_code' => $passed_code,
          'security_name' => $_SESSION['security_name'],
          'security_uid' => $_SESSION['security_uid'],
          'activity' => "The security has signed food parcels back to the food bank, ",
          'status' => "transit-to-foodbank",
          'region' => $_SESSION['region'],
          'driver_1_names'  => $_POST['driver_1_names'],
          'driver_2_names' => $_POST['driver_2_names'],
          'truck_detail' => $_POST['truck_detail']
        );

      }
      
        $api_url = $APIBASE."activity_notification_exec.php?action=add_security_activity";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $activities_data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        $result = json_decode($response, true); 


        if(count($result) > 0){
          foreach($result as $row) {

            $success = "<br>Successfully completed a foodpack process! <p>The page will be closed in <span id='counter'>1</span> second(s).</p>
            <script type='text/javascript'>
                function countdown() {
                  var i = document.getElementById('counter');
                  if (parseInt(i.innerHTML)==0) {
                    window.close();
                  }
                  i.innerHTML = parseInt(i.innerHTML)-1;
                }
                setInterval(function(){ countdown(); },3000);
                </script>'";     
            
          }
        } else {

            $error_message = "<br>This transaction was not fully successful! Please try again<p>You will be redirected in <span id='counter'>1</span> second(s).</p>
            <script type='text/javascript'>
                function countdown() {
                var i = document.getElementById('counter');
                if (parseInt(i.innerHTML)<=0) {
                  location.href = 'foodpack.php?code=$passed_code';
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
              <br>
              <h4 align="center">DSD Security Portal</h4>
              <p align="center"><i>Driver & Vehicle Details - <?php echo $_SESSION['region'] ?></i></p>
              <br><br>

            <div align="center">
                <?php if (!empty($error_message)) {
                    echo '<div class="alert alert-danger">'.$error_message.'</div>';
                    }
                    if (!empty($success)) {
                      echo '<div class="alert alert-success">'.$success.'</div>';
                    }
				        ?>
            </div>                 
              
              <form action="" method="post" >

                <?php
                    $api_url = $APIBASE."systems_users_exec.php?action=view_region_drivers&region=".$_SESSION["region"]."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);

                    $fullnames = array();
                    if(count($result) > 0){
                        foreach($result as $row) {
                            $fullnames[] = $row->first_name.' '.$row->surname;
                        }
                    }

                    $names_length = count($fullnames);
                    
                ?>              

                <div class="form-group">
                    <label for="driver_1_names">Driver #1 Full Name</label>
                    <select class="form-control form-control-lg" id="driver_1_names" name="driver_1_names" required>
                        <?php for ($i=0;$i<$names_length;$i++){ ?>
                            <option style="color:black" value="<?php echo $fullnames[$i];?>"><?php echo $fullnames[$i];?></option>
                         <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="driver_2_names">Driver #2 Full Name</label>
                    <select class="form-control form-control-lg" id="driver_2_names" name="driver_2_names" required>
                        <?php for ($i=0;$i<$names_length;$i++){ ?>
                            <option style="color:black" value="<?php echo $fullnames[$i];?>"><?php echo $fullnames[$i];?></option>
                         <?php } ?>
                    </select>
                </div>

                <?php
                    $api_url = $APIBASE."systems_users_exec.php?action=view_region_vehicles&region=".$_SESSION["region"]."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);

                    $vehicle = array();
                    if(count($result) > 0){
                        foreach($result as $row) {
                            $vehicle[] = $row->make.' - '.$row->model.' - '.$row->reg_number;
                        }
                    }

                    $vehicle_length = count($vehicle);
                    
                ?>              

                <div class="form-group">
                <label for="truck_detail">Vehicle Details</label>
                    <select class="form-control form-control-lg" id="truck_detail" name="truck_detail" required>
                        <?php for ($i=0;$i<$vehicle_length;$i++){ ?>
                            <option style="color:black" value="<?php echo $vehicle[$i];?>"><?php echo $vehicle[$i];?></option>
                         <?php } ?>
                    </select>
                </div>

                <div align="center">
                  <input  class="btn btn-outline-primary btn-icon-text btn" type="submit" name="submit" value="Submit">
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
