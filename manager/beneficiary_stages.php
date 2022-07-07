<?php

  include_once "include/header.php";
  include("../config/connect.php");
  error_reporting(0);
  session_start();

  $location = $_SESSION['region'];
 
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
                          Beneficiary Management Stages 
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

                  <?php
                    $api_url = $APIBASE."beneficiary_details_exec.php?action=show_beneficiary_stages&location=".$location."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);
                    $output_limit = '';

                    if(count($result) > 0)
                    {
                      foreach($result as $row)
                      {        
                  ?>
                  
                  <br><br>
                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                      <h4 class="mb-3 mt-5" align="center">View Beneficiaries At Different Lifecycle Stages</h4>
                      <p class="w-75 mx-auto mb-5" align="center">To view the beneficiaries at different stages, from creating new beneficiaries, to eligable beneficiaries, and then post support beneficiaries.</p>
                        <div class="row pricing-table">
                          <div class="col-md-4 col-xl-4 grid-margin stretch-card pricing-card">
                            <div class="card border-primary border pricing-card-body">
                              <div class="text-center pricing-card-head">
                                <h3 class="text-primary">New <br>Beneficiaries</h3>
                                <p># no-deliveries</p>
                                <h1 class="fw-normal mb-4"><?php echo $row->tot_new_users ?></h1>
                              </div>
                              <ul class="list-unstyled plan-features">
                              </ul>
                              <div class="wrapper" align="center">
                                <a href="#new" >
                                  <input type='button' class="btn btn-outline-primary btn-block btn-lg"  value='View'>
                                </a>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 col-xl-4 grid-margin stretch-card pricing-card">
                            <div class="card border border-success pricing-card-body">
                              <div class="text-center pricing-card-head">
                                <h3 class="text-success">Eligable Beneficiaries</h3>
                                <p>1 - 3 deliveries</p>
                                <h1 class="fw-normal mb-4"><?php echo $row->tot_delivered_users ?></h1>
                              </div>
                              <ul class="list-unstyled plan-features">
                              </ul>
                              <div class="wrapper" align="center">
                              <a href="#delivered" >
                                <input type='button' class="btn btn-success btn-block btn-lg"  value='View'>
                              </a>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 col-xl-4 grid-margin stretch-card pricing-card">
                            <div class="card border border-danger pricing-card-body">
                              <div class="text-center pricing-card-head">
                                <h3 class="text-danger">Post-Support Beneficiaries</h3>
                                <p># post intevension</p>
                                <h1 class="fw-normal mb-4"><?php echo $row->tot_completed_users ?></h1>
                              </div>
                              <ul class="list-unstyled plan-features">
                              </ul>
                              <div class="wrapper" align="center">
                                <a href="#post-delivery" >
                                  <input type='button' class="btn btn-outline-primary btn-block btn-lg"  value='View '>
                                </a>
                              </div>                                  
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <?php
                      }
                    }
                  ?>
                  
                  <div class="col-lg-12 grid-margin stretch-card" id="new" >
                    <div class="card">
                      <div class="card-body">
                      <h4 class="card-title"> Beneficiaries who have not received food parcels yet</h4>
                        <p class="card-description">
                          food packs packaged in the past 30 days
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
                                <th>Address</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>

                            <?php
                                $api_url = $APIBASE."beneficiary_details_exec.php?action=show_20_new_headofhouse&location=".$location."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);
                                $new_beneficiary_output = '';

                                if(count($result) > 0)
                                {
                                  foreach($result as $row)
                                  {


                                    $new_beneficiary_output .= '
                                    <tr>
                                    <td>'.$row->hoh_id.'</td>
                                    <td>'.substr($row->hoh_date_time, 0, 11).'</td>
                                    <td>'.$row->first_name.' '.$row->surname.'</td>
                                    <td>'.$row->cellphone.'</td>
                                    <td>'.$row->id_number.'</td>
                                    <td>'.$row->home_address.'</td>
                                    <td>
                                      <a target="_blank" href="view_beneficiary_details.php?code='.$row->unique_code.'"><button class="btn btn-outline-primary">Details</button></a>
                                    </td>
                                    </tr>
                                    ';
                                  }
                                }

                                echo $new_beneficiary_output;
                            ?> 


                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>                  



                  <div class="col-lg-12 grid-margin stretch-card" id="delivered" >
                    <div class="card">
                      <div class="card-body">
                      <h4 class="card-title"> Beneficiaries who are eligable for receiving food parcels</h4>
                        <p class="card-description">
                          Received between 1 to 3 food parcels
                        </p>
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Distribution <br> Date Time</th>
                                <th>Full Names</th>
                                <th>Phone</th>
                                <th>ID Number </th>                                
                                <th>Address</th>
                                <th>No of <br>Deliveries</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>

                            <?php
                                // Update the API end-point
                                $api_url = $APIBASE."beneficiary_details_exec.php?action=show_20_delivered_headofhouse&location=".$location."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);
                                $delivered_output = '';

                                if(count($result) > 0)
                                {
                                  foreach($result as $row)
                                  {


                                    $delivered_output .= '
                                    <tr>
                                    <td>'.$row->hoh_id.'</td>
                                    <td>'.$row->hoh_date_time.'</td>
                                    <td>'.$row->first_name.' '.$row->surname.'</td>
                                    <td>'.$row->cellphone.'</td>
                                    <td>'.$row->id_number.'</td>
                                    <td>'.$row->home_address.'</td>
                                    <td>'.$row->no_delivery_times.'</td>
                                    <td>
                                      <a target="_blank" href="view_beneficiary_details.php?code='.$row->unique_code.'"><button class="btn btn-outline-primary">Details</button></a>
                                    </td>                                    
                                    </tr>
                                    ';
                                  }
                                }

                                echo $delivered_output;
                            ?> 


                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>   
                  

                  <div class="col-lg-12 grid-margin stretch-card" id="post-delivery" >
                    <div class="card">
                      <div class="card-body">
                      <h4 class="card-title"> Beneficiaries who are eligable for post delivery services</h4>
                        <p class="card-description">
                          Received all 3 food parcels, eligable for post delivery services
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
                                <th>Address</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>

                            <?php
                                // Update the API end-point
                                $api_url = $APIBASE."beneficiary_details_exec.php?action=show_20_postdelivered_headofhouse&location=".$location."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);
                                $delivered_output = '';

                                if(count($result) > 0)
                                {
                                  foreach($result as $row)
                                  {


                                    $delivered_output .= '
                                    <tr>
                                    <td>'.$row->hoh_id.'</td>
                                    <td>'.substr($row->hoh_date_time, 0, 11).'</td>
                                    <td>'.$row->first_name.' '.$row->surname.'</td>
                                    <td>'.$row->cellphone.'</td>
                                    <td>'.$row->id_number.'</td>
                                    <td>'.$row->home_address.'</td>
                                    <td>
                                      <a target="_blank" href="view_beneficiary_details.php?code='.$row->unique_code.'"><button class="btn btn-outline-primary">Details</button></a>
                                    </td>
                                    </tr>
                                    ';
                                  }
                                }

                                echo $delivered_output;
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
