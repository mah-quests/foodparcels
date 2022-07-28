<?php

  include("config/connect.php");

  error_reporting(0);
  session_start();
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
              <h4 align="center">DSD Food Parcel Portal</h4>
              <h6 class="fw-light" align="center">Details of the food parcel after the QR Code Scan</h6>
              <form class="pt-3">
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

            ?>   

              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-sm-flex flex-row flex-wrap text-sm-left align-items-center">
                      <img src="qr-code/<?php echo $row->unique_code ?>.png" class="img-lg rounded" alt="QR Code">
                      <div class="ms-sm-3 ms-md-0 ms-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                        <h4 class="mb-0"><?php echo $row->unique_code ?></h4>
                        <p class="text-muted mb-1"><?php echo $row->region ?></p>
                        <p class="mb-0 text-success fw-bold"><?php echo $row->foodpack_state ?></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

          <?php 
              } 
            }
          ?>              

              </div>

              <!-- Modal -->
              <div class="modal fade" id="foodbank_delivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="foodbank_delivery_label">Illegal Move: Food Bank To Delivery Not Allowed</h5>
                    </div>
                    <div class="modal-body">
                      You can not move a food parcel from the food bank directly to the delivery point. The food parcel first has to be checked out by security. Please follow correct procedure for that. 
                    </div>
                  </div>
                </div>
              </div>


              <div class="mt-3" align="center">

              <?php if ($row->state == "foodbank"){ ?>
              
                <a class="btn btn-block btn-success btn-sm  auth-form-btn" href="security_in_out.php?action=transit&code=<?php echo $_GET["code"] ?>">SECURITY</a>
                <button type="button" class="btn btn-block btn-info btn-sm  auth-form-btn" data-bs-toggle="modal" data-bs-target="#foodbank_delivery" data-whatever="@fat">DELIVERY</button>

                <?php } else if ($row->state == "intransit"){ ?>

                <a class="btn btn-block btn-success btn-sm  auth-form-btn" href="beneficiary.php?code=<?php echo $_GET["code"] ?>">DELIVERY</a>
                <a class="btn btn-block btn-secondary btn-sm  auth-form-btn" href="security_in_out.php?action=foodbank&code=<?php echo $_GET["code"] ?>">SECURITY</a>

                <?php } ?>

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
