<?php

include_once "include/header.php";
include("../config/connect.php");
error_reporting(0);
session_start();

  if (isset($_POST['submit'])) {

        //Populate the stock activities table (foodbank_stock_details_tbl)
        $user_data = array(
        'first_name' => $_POST["first_name"],
        'surname' => $_POST["surname"],
        'id_number' => $_POST["id_number"],
        'cellphone' => $_POST["cellphone"],
        'address' => $_POST["address"],
        'license_number' => $_POST["license_number"],
        'license_code' => $_POST["license_code"],
        'region' => $_SESSION['region'],
        'foodbank' => $_SESSION['foodbank']
        );


        $api_url = $APIBASE."systems_users_exec.php?action=add_driver_operator";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $user_data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        $result = json_decode($response, true);  
        
        
        if(count($result) > 0){

            $success = "<br>Finished adding a Food bank driver! <p>You will be redirected in <span id='counter'>1</span> second(s).</p>
            <script type='text/javascript'>
                function countdown() {
                var i = document.getElementById('counter');
                if (parseInt(i.innerHTML)<=0) {
                    location.href = 'add_driver.php';
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
                    location.href = 'add_driver.php';
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
                          Driver Management
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
                        <h4 class="card-title" align="center"><u>Add Driver Form</u></h4>
                        <br>
                        <form action="" method="POST">

                          <h6>
                            <u>Personal Information</u>
                          </h6>

                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="first_name">First Names</label>
                                  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Names">
                                </div>
                              </div>                            
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="surname">Surname</label>
                                  <input type="text" class="form-control" id="surname" name="surname" placeholder="Enter Surname">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="id_number">ID Number</label>
                                  <input type="text" class="form-control" id="id_number" name="id_number" placeholder="Enter First Names">
                                </div>
                              </div>                            
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="cellphone">Cellphone</label>
                                  <input type="text" class="form-control" id="cellphone" name="cellphone"  placeholder="Enter Cellphone">
                                </div>
                              </div>   
                            </div>                            
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="license_number">License Number</label>
                                  <input type="text" class="form-control" id="license_number" name="license_number"  placeholder="Enter License Number">
                                </div>
                              </div>                            
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="license_code">License Code</label>
                                  <input type="text" class="form-control" id="license_code" name="license_code"  placeholder="Enter License Code">
                                </div>
                              </div>  
                            </div>  
                            <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">Home Address</label>
                                    <textarea class="form-control" id="address" name="address" placeholder="Enter Home Address" required></textarea>
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
                        <h4 class="card-title">List of Drivers In the <?php echo $_SESSION['region'].' ' ?> Region</h4>
                        <p class="card-description">
                          over the past 24 months
                        </p>
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Full Names</th>
                                <th>Phone</th>
                                <th>ID Number </th>                                
                                <th>License Code</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>

                            <?php
                                $api_url = $APIBASE."systems_users_exec.php?action=view_region_drivers&region=".$_SESSION["region"]."";
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
                                    <td>'.$row->driver_id.'</td>
                                    <td>'.substr($row->date_time, 0, 11).'</td>
                                    <td>'.$row->first_name.' '.$row->surname.'</td>
                                    <td>'.$row->cellphone.'</td>
                                    <td>'.$row->id_number.'</td>
                                    <td>'.$row->license_code.'</td>
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