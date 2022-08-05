<?php

  include("config/connect.php");

  error_reporting(0);
  session_start();

  if (isset($_POST['submit'])) {

    if( (empty($_POST['full_names'])) && (empty($_POST['cellphone']))){
        $set_fullnames = "Anonymous";
        $set_phone = "NONE";
    } else {
        $set_fullnames = $_POST['full_names'];
        $set_phone = $_POST['cellphone'];
    }

        //Populate the stock activities table (foodbank_stock_details_tbl)
        $experience_data = array(
        'full_names' => $set_fullnames,
        'cellphone' => $set_phone,
        'region' => $_POST["region"],
        'quality' => $_POST["quality"],
        'time' => $_POST["time"],
        'communication' => $_POST["communication"],
        'experience' => $_POST["experience"],
        'friendliness' => $_POST["friendliness"],
        'resolving_issues' => $_POST["resolving_issues"],
        'notes' => $_POST["notes"]
        );


        $api_url = $APIBASE."systems_users_exec.php?action=add_customer_experience";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $experience_data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        $result = json_decode($response, true);  
        
        
            $success = "<br>Completed Survey Successfully! <p>You will be redirected in <span id='counter'>1</span> second(s).</p>
            <script type='text/javascript'>
                function countdown() {
                var i = document.getElementById('counter');
                if (parseInt(i.innerHTML)<=0) {
                    location.href = 'service_experience.php';
                }
                i.innerHTML = parseInt(i.innerHTML)-1;
                }
                setInterval(function(){ countdown(); },1000);
                </script>'"; 

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


<script type="text/javascript">

    function showNonAnnonymousUser() {
    var noOption = document.getElementById("anonymous").value;
    
    if (noOption != "Anonymous") {

        jQuery('#user_details').show();
        document.getElementById("user_details").style.visibility = 'visible';
        
    } else {

        jQuery('#user_details').hide();
        document.getElementById("user_details").style.visibility = 'hidden';

    }    
}
</script>

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
              <br><br>
              <h4 align="center">Beneficiary Service Experience</h4>
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
                        <select class="form-control" id="anonymous" name="anonymous" onchange="showNonAnnonymousUser(this.value)"  required>
                            <option selected></option>
                            <option>Anonymous</option>
                            <option>Specify Details</option>
                        </select>
                    </div> 

                    <div id="user_details" style="display:none">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="full_names" name="full_names" placeholder="Enter Full Names">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="cellphone" name="cellphone"  placeholder="Enter Cellphone">
                        </div>
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
                        <select class="form-control form-control-lg" id="quality" name="quality" required>
                            <option>Select Quality Of Food</option>
                            <option value="0">0 - Poor</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5 - Great</option>
                        </select>
                    </div>   
                    <div class="form-group">
                        <select class="form-control form-control-lg" id="time" name="time" required>
                            <option>Time Management</option>
                            <option value="0">0 - Poor</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5 - Great</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control form-control-lg" id="communication" name="communication" required>
                            <option>Communication</option>
                            <option value="0">0 - Poor</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5 - Great</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control form-control-lg" id="experience" name="experience" required>
                            <option>Experience</option>
                            <option value="0">0 - Poor</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5 - Great</option>
                        </select>
                    </div>    
                    <div class="form-group">
                        <select class="form-control form-control-lg" id="friendliness" name="friendliness" required>
                            <option>Friendliness</option>
                            <option value="0">0 - Poor</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5 - Great</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control form-control-lg" id="resolving_issues" name="resolving_issues" required>
                            <option>Issue Resolution</option>
                            <option value="0">0 - Poor</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5 - Great</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control form-control-lg" id="notes" name="notes"  rows="3" placeholder="Enter Your Remarks"></textarea>
                    </div>                      
                    <div align="center">
                        <input  class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Submit">
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
