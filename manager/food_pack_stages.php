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
                        <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">View Food Pack Overview</a>
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


                  
                  <br><br>
                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                      <h4 class="mb-3 mt-5" align="center">View Food Parcels At Different Lifecycle Stages</h4>
                      <p class="w-75 mx-auto mb-5" align="center">To view the food parcels at different stages, from creating new food pack, to food packages in transit, and food packages delivered to beneficiaries.</p>
                        <div class="row pricing-table">

                          <?php
                            $api_url = $APIBASE."foodpack_exec.php?action=show_foodpack_stage_today&location=".$location."";
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

                          <div class="col-md-6 col-xl-6 grid-margin stretch-card pricing-card">
                            <div class="card border border-success pricing-card-body">
                              <div class="text-center pricing-card-head">
                                <h3 class="text-success">Food Packs In Transit - Today </h3>
                                <p>#</p>
                                <h1 class="fw-normal mb-4"><?php echo $row->pack_in_transit_today ?></h1>
                              </div>
                              <ul class="list-unstyled plan-features">
                              </ul>
                              <div class="wrapper" align="center">
                              <a href="#transit" >
                                <input type='button' class="btn btn-success btn-block btn-lg"  value='View'>
                              </a>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-xl-6 grid-margin stretch-card pricing-card">
                            <div class="card border border-danger pricing-card-body">
                              <div class="text-center pricing-card-head">
                                <h3 class="text-danger">Delivered Food Packs - Today</h3>
                                <p>#</p>
                                <h1 class="fw-normal mb-4"><?php echo $row->pack_delivered_today ?></h1>
                              </div>
                              <ul class="list-unstyled plan-features">
                              </ul>
                              <div class="wrapper" align="center">
                                <a href="#delivered" >
                                  <input type='button' class="btn btn-outline-danger btn-block btn-lg"  value='View '>
                                </a>
                              </div>                                  
                            </div>
                          </div>

                          <?php
                              }
                            }
                          ?>    


                        </div>
                      </div>
                    </div>
                  </div>


                  <br>
                  <div class="col-lg-12 grid-margin stretch-card" id="transit">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title"> <i>Stock On Transit </i></h4>
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>Transaction</th>
                                <th>Reference</th>
                                <th>Project Name</th>
                                <th>Package Date</th>
                                <th>Packed By</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>

                            <?php
                                $api_url = $APIBASE."foodpack_exec.php?action=show_foodpack_list_today&location=".$location."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);
                                $in_transit_output = '';

                                if(count($result) > 0)
                                {
                                  foreach($result as $row)
                                  {

                                    $status = $row->foodpack_state;

                                    if ($status == 'In Transit') {

                                    $in_transit_output .= '
                                    <tr>
                                    <td>'.$row->foodpack_id.'</td>
                                    <td>'.$row->unique_code.'</td>
                                    <td>'.$row->project_name.'</td>
                                    <td>'.$row->package_date.'</td>
                                    <td>'.$row->pakaged_by.'</td>
                                    <td><label class="badge badge-success">In Transit</label></td>
                                    <td>
                                      <a target="_blank" href="view_foodparcel_details.php?code='.$row->unique_code.'"><button class="btn btn-outline-primary">View</button></a>
                                    </td>                                      
                                    </tr>
                                    ';
                                  }
                                } 
                              } else {
                                $in_transit_output .= '
                                  <tr align="center">
                                    <td align="center"> No Data To Display </td>
                                  </tr>
                                  ';
                              }

                                echo $in_transit_output;
                            ?>                      



                            </tbody>
                          </table>
                        </div>

                        <div align="center">
                          <br><br>
                          <button type="button" class="btn btn-outline-primary btn-icon-text btn-lg">
                            View All
                          </button>

                        </div>

                      </div>
                    </div>
                  </div>



                  <br>
                  <div class="col-lg-12 grid-margin stretch-card"  id="delivered">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title"> <i>Delivered Food Parcels </i></h4>
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>Transaction</th>
                                <th>Reference</th>
                                <th>Project Name</th>
                                <th>Package Date</th>
                                <th>Packed By</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>

                            <?php
                                $api_url = $APIBASE."foodpack_exec.php?action=show_foodpack_list_today&location=".$location."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);
                                $delivered_output = '';

                                if(count($result) > 0)
                                {
                                  foreach($result as $row)
                                  {

                                    $status = $row->foodpack_state;

                                    if ($status == 'Delivered') {

                                    $delivered_output .= '
                                    <tr>
                                    <td>'.$row->foodpack_id.'</td>
                                    <td>'.$row->unique_code.'</td>
                                    <td>'.$row->project_name.'</td>
                                    <td>'.$row->package_date.'</td>
                                    <td>'.$row->pakaged_by.'</td>
                                    <td><label class="badge badge-danger">Delivered</label></td>
                                    <td>
                                      <a target="_blank" href="view_foodparcel_details.php?code='.$row->unique_code.'"><button class="btn btn-outline-primary">View</button></a>
                                    </td>                                      
                                    </tr>
                                    ';
                                  }
                                } 
                              } else {
                                $delivered_output .= '
                                  <tr align="center">
                                    <td align="center"> No Data To Display </td>
                                  </tr>
                                  ';
                              }

                                echo $delivered_output;
                            ?>                      



                            </tbody>
                          </table>
                        </div>

                        <div align="center">
                          <br><br>
                          <button type="button" class="btn btn-outline-primary btn-icon-text btn-lg">
                            View All
                          </button>

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
      </div>
      <!-- content-wrapper ends -->
      <!-- partial:partials/_footer.html -->
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
