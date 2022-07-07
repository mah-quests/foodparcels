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
                        <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Goods Delivery History Overview</a>
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
                        <h4 class="card-title">Supplier - Goods Delivery History</h4>
                        <p class="card-description">
                          over the past 24 months
                        </p>
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead align="center">
                              <tr>
                                <th>#</th>
                                <th>Reference</th>
                                <th>Project Name</th>
                                <th>Date of delivery</th>
                                <th>Stock Type</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody align="center">

                            <?php
                                $api_url = $APIBASE."delivery_notice_exec.php?action=show_region_stock_limit&region=".$_SESSION['region']."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);
                                $output_region = '';

                                if(count($result) > 0)
                                {
                                  foreach($result as $row)
                                  {
                                    $status = $row->status;

                                    if ($status == 'progress') {
                                      $status_button = '<label class="badge badge-warning">In progress</label>';
                                    } else if ($status == 'completed') {
                                      $status_button = '<label class="badge badge-success">Completed</label>';
                                    } else if ($status == 'processed') {
                                      $status_button = '<label class="badge badge-success">Processed</label>';
                                    } else if ($status == 'rejected') {
                                      $status_button = '<label class="badge badge-danger">Rejected</label>';

                                    } else {

                                      $status_button = '<label class="badge badge-primary">Unknown</label>';

                                    }

                                    $output_region .= '
                                    <tr>
                                    <td>'.$row->stocklevel_id.'</td>
                                    <td>'.$row->unique_code.'</td>
                                    <td>'.$row->project_name.'</td>
                                    <td>'.$row->est_date_of_delivery.'</td>
                                    <td>'.$row->stock_type.'</td>
                                    <td>'.$status_button.'</td>
                                    <td>
                                      <a target="_blank" href="action_stock_manifest.php?code='.$row->unique_code.'"><button class="btn btn-outline-primary" >Receivals</button></a>
                                    </td>
                                    </tr>
                                    ';
                                  }
                                } else {
                                  $output_region .= '
                                  <center>
                                    <tr>
                                      <td> No Data To Display </td>
                                    </tr>
                                  </center>
                                  ';
                                }

                                echo $output_region;
											      ?>                      

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <br><br>
                  <div class="col-lg-12 grid-margin stretch-card" id="food-bank-stock">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Food Bank Stock History</h4>
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Created Date</th>
                                <th>Stock Type</th>
                                <th>Item Details</th>
                                <th>Quantity</th>
                                <th>Manufactured Date</th>
                                <th>Expiry Date</th>
                              </tr>
                            </thead>
                            <tbody>

                            <?php
                                $api_url = $APIBASE."delivery_notice_exec.php?action=supplier_stock_region&region=".$_SESSION['region']."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);
                                $bank_history_output = '';

                                if(count($result) > 0)
                                {
                                  foreach($result as $row)
                                  {


                                    $bank_history_output .= '
                                    <tr>
                                    <td>'.$row->stockdetail_id.'</td>
                                    <td>'.$row->create_date.'</td>
                                    <td>'.$row->stock_type.'</td>
                                    <td>'.$row->stock_name.', '.$row->stock_brand.'</td>
                                    <td>'.$row->stock_level_amount.'</td>
                                    <td>'.$row->stock_man_date.'</td>
                                    <td>'.$row->stock_exp_date.'</td>
                                    </tr>
                                    ';
                                  }
                                } else {
                                  $bank_history_output .= '
                                    <tr align="center">
                                      <td align="center"> No Data To Display </td>
                                    </tr>
                                    ';
                                }

                                echo $bank_history_output;
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
