<?php
  include_once "include/header.php";
  include("../config/connect.php");

  $location = $_SESSION['region'];
  
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
                          List Food Pack Activities
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

                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">List Food Pack Activities</h4>
                        <p class="card-description">
                          over the past 24 months
                        </p>
                        <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Food Pack Code</th>
                                <th>Beneficiary Code</th>
                                <th># Food Parcels </th>                                
                                <th>Region</th>
                              </tr>
                            </thead>
                            <tbody>

                            <?php
                                $api_url = $APIBASE."foodpack_exec.php?action=show_foodpack_delivery_list&location=".$location."";
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
                                    <td>'.$row->fp_dlv_id.'</td>
                                    <td>'.$row->delivery_date_time.'</td>
                                    <td>
                                      <a target="_blank" href="view_foodparcel_details.php?code='.$row->foodpack_code.'">'.$row->foodpack_code.'</a>
                                    </td>
                                    <td>
                                      <a target="_blank" href="view_beneficiary_details.php?code='.$row->headofhousehold_code.'">'.$row->headofhousehold_code.'</a>
                                    </td>                                    
                                    <td>'.$row->number_of_parcels.'</td>
                                    <td>'.$row->region.'</td>
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