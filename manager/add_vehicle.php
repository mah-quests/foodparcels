<?php

include_once "include/header.php";
include("../config/connect.php");
error_reporting(0);
session_start();

  if (isset($_POST['submit'])) {

        //Populate the stock activities table (foodbank_stock_details_tbl)
        $user_data = array(
        'make' => $_POST["make"],
        'model' => $_POST["model"],
        'vehicle_type' => $_POST["vehicle_type"],
        'reg_number' => $_POST["reg_number"],
        'region' => $_SESSION['region'],
        'foodbank' => $_SESSION['foodbank']
        );


        $api_url = $APIBASE."systems_users_exec.php?action=add_vehicle_details";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $user_data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        $result = json_decode($response, true);  
        
        
        if(count($result) > 0){

            $success = "<br>Finished adding a vehicles details! <p>You will be redirected in <span id='counter'>1</span> second(s).</p>
            <script type='text/javascript'>
                function countdown() {
                var i = document.getElementById('counter');
                if (parseInt(i.innerHTML)<=0) {
                    location.href = 'add_vehicle.php';
                }
                i.innerHTML = parseInt(i.innerHTML)-1;
                }
                setInterval(function(){ countdown(); },1000);
                </script>'"; 
        } else {
            $error_message = "<br>There was an error adding a vehicles! <p>You will be redirected in <span id='counter'>1</span> second(s).</p>
            <script type='text/javascript'>
                function countdown() {
                var i = document.getElementById('counter');
                if (parseInt(i.innerHTML)<=0) {
                    location.href = 'add_vehicle.php';
                }
                i.innerHTML = parseInt(i.innerHTML)-1;
                }
                setInterval(function(){ countdown(); },1000);
                </script>'";             
        }

  }

?>

        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-sm-12">
                <div class="home-tab">
                  <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active border-0"  id="more-tab" data-bs-toggle="tab" href="#" role="tab" aria-selected="false">
                          Vehicle Management
                        </a>
                      </li>
                    </ul>
                    <div>
                      <div class="btn-wrapper">
                        <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
                        <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
                        <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
                      </div>
                    </div>
                  </div>

                  <div align="center">
                  <?php if (!empty($error_message)) {
                    echo '<div class="alert alert-danger">' . $error_message . '</div>';
                    }
                    if (!empty($success)) {
                      echo '<div class="alert alert-success">' . $success . '</div>';
                    }
					        ?>
                </div>  

                  <br><br>
                  <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title" align="center"><u>Add Vehicle Form</u></h4>
                        <br>
                        <form action="" method="POST">

                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="make">Vehicle Make</label>
                                  <input type="text" class="form-control" id="make" name="make" placeholder="Enter Vehicle Make">
                                </div>
                              </div>                            
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="model">Vehicle Model</label>
                                  <input type="text" class="form-control" id="model" name="model" placeholder="Enter Model">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="vehicle_type">Vehicle Type</label>
                                  <input type="text" class="form-control" id="vehicle_type" name="vehicle_type" placeholder="Enter Vehicle Type">
                                </div>
                              </div>                            
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="reg_number">Vehicle Rergistration Number</label>
                                  <input type="text" class="form-control" id="reg_number" name="reg_number"  placeholder="Enter Vehicle Rergistration Number">
                                </div>
                              </div>   
                            </div> 

                          <div align="center">
                            <input  class="btn btn-outline-primary btn-icon-text btn-lg" type="submit" name="submit" value="Submit">
                            <button class="btn btn-outline-warning btn-icon-text btn-lg" >
                              <i class="ti-reload btn-icon-prepend"></i>                                                    
                              Reset
                            </button>
                          </div>

                        </form>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">List of Vehicles At <?php echo $_SESSION['foodbank'].' ' ?> Food Bank</h4>
                        <p class="card-description">
                          over the past 24 months
                        </p>
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Type</th>                                
                                <th>Registration</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>

                            <?php
                                $api_url = $APIBASE."systems_users_exec.php?action=view_region_vehicles&region=".$_SESSION["region"]."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);
                                $output = '';

                                if(count($result) > 0)
                                {
                                  foreach($result as $row)
                                  {


                                    $output .= '
                                    <tr>
                                    <td>'.$row->vehicle_id.'</td>
                                    <td>'.$row->date_time.'</td>
                                    <td>'.$row->make.'</td>
                                    <td>'.$row->model.'</td>
                                    <td>'.$row->vehicle_type.'</td>
                                    <td>'.$row->reg_number.'</td>
                                    <td>
                                      <a target="_blank" href="#"><button class="btn btn-outline-primary">Details</button></a>
                                    </td>
                                    </tr>
                                    ';
                                  }
                                }

                                echo $output;
                            ?> 


                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->

    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  <!-- partial:partials/_footer.html -->
  <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Dashboard Web App Is Developed by <a href="https://www.mahquests.co.za/" target="_blank">MaH Quests Enterprises</a></span>
      <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2022. All rights reserved.</span>
    </div>
  </footer>
  <!-- partial -->  
</div>
<!-- container-scroller -->
<?php

  include_once "include/footer.php";

?>