<?php
  include_once "include/header.php";
  include("../config/connect.php");
  error_reporting(0);
  session_start();

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
                          Security Notifications
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
                  <br><br>

                  <!--
                  <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Security Notifications from food pack activities</h4>

                        <?php
                          $api_url = $APIBASE."activity_notification_exec.php?action=security_activities&region=".$_SESSION['region']."";
                          $client = curl_init($api_url);
                          curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                          $response = curl_exec($client);
                          $result = json_decode($response);
                          $output = '';

                          if(count($result) > 0)
                          {
                            foreach($result as $row)
                            {
                              if($row->status == "in-transit"){
                                $output .= '

                                <div class="alert alert-success" role="alert">
                                  <span style="color:black">
                                    ['.$row->date_time.'] - '.$row->security_name.'. '.$row->activity.'Drivers are '.$row->driver_1_names.' and '.$row->driver_2_names.' using '.$row->truck_detail.'
                                  </span>
                                </div>
  
                                ';  
                              }
                            }
                          }

                          echo $output;
											?>                      

                      </div>
                    </div>
                  </div>

                  -->

                  <div class="col-lg-12 grid-margin stretch-card" id="transit">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title"> <i>Stock From Transit To Food Bank</i></h4>
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Date</th>                                
                                <th>Reference</th>
                                <th>Security Name</th>
                                <th>Driver #1</th>
                                <th>Driver #2</th>
                                <th>Truck Details</th>
                              </tr>
                            </thead>
                            <tbody>

                            <?php
                                $api_url = $APIBASE."activity_notification_exec.php?action=security_activities&region=".$_SESSION['region']."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);
                                $transit_to_foodbank = '';

                                if(count($result) > 0)
                                {
                                  foreach($result as $row)
                                  {
                                    if($row->status == "transit-to-foodbank"){

                                      $transit_to_foodbank .= '
                                      <tr>
                                      <td>'.$row->activity_id.'</td>
                                      <td>'.$row->date_time.'</td>
                                      <td>'.$row->parcel_unique_code.'</td>
                                      <td>'.$row->security_name.'</td>
                                      <td>'.$row->driver_1_names.'</td>
                                      <td>'.$row->driver_2_names.'</td>
                                      <td>'.$row->truck_detail.'</td>                               
                                      </tr>
                                      ';
                                  }
                                } 
                              } else {
                                $transit_to_foodbank .= '
                                  <tr align="center">
                                    <td align="center"> No Data To Display </td>
                                  </tr>
                                  ';
                              }

                                echo $transit_to_foodbank;
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
