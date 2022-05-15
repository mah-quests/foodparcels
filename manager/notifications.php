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
                          Systems Notifications
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

                  <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Notifications from the System</h4>

                        <?php
                          $api_url = $APIBASE."activity_notification_exec.php?action=region_activities&region=".$_SESSION['region']."";
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

                              <div class="alert alert-success" role="alert">
                                <a href="#">
                                  ['.$row->date_time.'] - '.$row->action_performed.' using reference <b>'.$row->unique_code.'</b>. Done by '.$row->performed_by.'
                                </a>
                              </div>

                              ';
                            }
                          }

                          echo $output;
											?>                      

                        <div class="alert alert-success" role="alert">
                          <a href="view_receivables_register_01.html" target="_blank">
                            [12-Mar-2022] - The Supplier has created a new goods delivery transaction. Delivery marked for 15-Mar-2022
                          </a>
                        </div>
                        <div class="alert alert-success" role="alert">
                          <a href="#">
                            [8-Mar-2022] - Weekly parcel delivery report generated and sent to M&E.
                          </a>
                        </div>
                        <div class="alert alert-warning" role="alert">
                          <a href="#">
                            [6-Mar-2022] - Overall stock levels are under 40%
                          </a>
                        </div>
                        <div class="alert alert-success" role="alert">
                          <a href="#">
                            [8-Mar-2022] - Weekly parcel delivery report generated and sent to M&E.
                          </a>
                        </div>
                        <div class="alert alert-danger" role="alert">
                          <a href="#">
                            [25-Feb-2022] - Victor Molotsane reported damages on the stock to the supplier.
                          </a>
                        </div>
                        <div class="alert alert-success" role="alert">
                          <a href="#">
                            [21-Mar-2022] - Food Distribution Web Application Update. Reference: SYS209 upgrade
                          </a>
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
