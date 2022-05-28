<?php
  include_once "include/header.php";
  include("../config/connect.php");
  error_reporting(0);
  session_start();

  $region = $_SESSION['region'];

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
                          Floor Plans & Stock Allocations
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

                  <div class="row">
                    <div class="col-md-6 grid-margin">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">FL-SQ-01</h4>
                          <p class="card-description">
                            Floor Square Number 01
                          </p>

                          <?php
                              $api_url = $APIBASE."stock_levels_exec.php?action=show_allocated_foodbank_stock&location=".$_SESSION['region']."";
                              $client = curl_init($api_url);
                              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                              $response = curl_exec($client);
                              $result = json_decode($response);
                              $output_fsq1 = '';

                              if(count($result) > 0)
                              {
                                foreach($result as $row)
                                {
                                  if($row->allocated_floor_space == "FL-SQ-01"){

                                  $output_fsq1 .= '

                                  <div class="alert alert-fill-primary" role="alert">
                                    <i class="ti-info-alt"></i>
                                      ['.$row->items_qty.'] - ['.$row->stock_name.'] - ['.$row->stock_brand.'] - ['.$row->stock_exp_date.']
                                  </div>

                                  ';
                                  }
                                }
                              }

                              echo $output_fsq1;
                          ?> 
                        </div>
                      </div>
                    </div>


                    <div class="col-md-6 grid-margin">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">FL-SQ-02</h4>
                          <p class="card-description">
                            Floor Square Number 02
                          </p>

                          <?php
                              $api_url = $APIBASE."stock_levels_exec.php?action=show_allocated_foodbank_stock&location=".$_SESSION['region']."";
                              $client = curl_init($api_url);
                              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                              $response = curl_exec($client);
                              $result = json_decode($response);
                              $output_fsq2 = '';

                              if(count($result) > 0)
                              {
                                foreach($result as $row)
                                {
                                  if($row->allocated_floor_space == "FL-SQ-02"){

                                  $output_fsq2 .= '

                                  <div class="alert alert-fill-success" role="alert">
                                    <i class="ti-info-alt"></i>
                                      ['.$row->items_qty.'] - ['.$row->stock_name.'] - ['.$row->stock_brand.'] - ['.$row->stock_exp_date.']
                                  </div>

                                  ';
                                  }
                                }
                              }

                              echo $output_fsq2;
                          ?> 

                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-6 grid-margin">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">FL-SQ-03</h4>
                          <p class="card-description">
                            Floor Square Number 03
                          </p>

                          <?php
                              $api_url = $APIBASE."stock_levels_exec.php?action=show_allocated_foodbank_stock&location=".$_SESSION['region']."";
                              $client = curl_init($api_url);
                              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                              $response = curl_exec($client);
                              $result = json_decode($response);
                              $output_fsq3 = '';

                              if(count($result) > 0)
                              {
                                foreach($result as $row)
                                {
                                  if($row->allocated_floor_space == "FL-SQ-03"){

                                  $output_fsq3 .= '

                                  <div class="alert alert-fill-info" role="alert">
                                    <i class="ti-info-alt"></i>
                                      ['.$row->items_qty.'] - ['.$row->stock_name.'] - ['.$row->stock_brand.'] - ['.$row->stock_exp_date.']
                                  </div>

                                  ';
                                  }
                                }
                              }

                              echo $output_fsq3;
                          ?> 

                        </div>
                      </div>
                    </div>


                    <div class="col-md-6 grid-margin">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">FL-SQ-04</h4>
                          <p class="card-description">
                            Floor Square Number 04
                          </p>

                          <?php
                              $api_url = $APIBASE."stock_levels_exec.php?action=show_allocated_foodbank_stock&location=".$_SESSION['region']."";
                              $client = curl_init($api_url);
                              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                              $response = curl_exec($client);
                              $result = json_decode($response);
                              $output_fsq4 = '';

                              if(count($result) > 0)
                              {
                                foreach($result as $row)
                                {
                                  if($row->allocated_floor_space == "FL-SQ-04"){

                                  $output_fsq4 .= '

                                  <div class="alert alert-fill-warning" role="alert">
                                    <i class="ti-info-alt"></i>
                                      ['.$row->items_qty.'] - ['.$row->stock_name.'] - ['.$row->stock_brand.'] - ['.$row->stock_exp_date.']
                                  </div>

                                  ';
                                  }
                                }
                              }

                              echo $output_fsq4;
                          ?> 

                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-6 grid-margin">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">STG-RM-SQ-01</h4>
                          <p class="card-description">
                            Storage Room Square Number 01
                          </p>

                          <?php
                              $api_url = $APIBASE."stock_levels_exec.php?action=show_allocated_foodbank_stock&location=".$_SESSION['region']."";
                              $client = curl_init($api_url);
                              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                              $response = curl_exec($client);
                              $result = json_decode($response);
                              $output_fsq4 = '';

                              if(count($result) > 0)
                              {
                                foreach($result as $row)
                                {
                                  if($row->allocated_floor_space == "STG-RM-SQ-01"){

                                  $output_fsq4 .= '

                                  <div class="alert alert-fill-primary" role="alert">
                                    <i class="ti-info-alt"></i>
                                      ['.$row->items_qty.'] - ['.$row->stock_name.'] - ['.$row->stock_brand.'] - ['.$row->stock_exp_date.']
                                  </div>

                                  ';
                                  }
                                }
                              }

                              echo $output_fsq4;
                          ?> 
                                   

                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 grid-margin">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">STG-RM-SQ-02</h4>
                          <p class="card-description">
                            Storage Room Square Number 02
                          </p>

                          <?php
                              $api_url = $APIBASE."stock_levels_exec.php?action=show_allocated_foodbank_stock&location=".$_SESSION['region']."";
                              $client = curl_init($api_url);
                              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                              $response = curl_exec($client);
                              $result = json_decode($response);
                              $output_fsq4 = '';

                              if(count($result) > 0)
                              {
                                foreach($result as $row)
                                {
                                  if($row->allocated_floor_space == "STG-RM-SQ-01"){

                                  $output_fsq4 .= '

                                  <div class="alert alert-fill-success" role="alert">
                                    <i class="ti-info-alt"></i>
                                      ['.$row->items_qty.'] - ['.$row->stock_name.'] - ['.$row->stock_brand.'] - ['.$row->stock_exp_date.']
                                  </div>

                                  ';
                                  }
                                }
                              }

                              echo $output_fsq4;
                          ?> 


                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <br>
            <div class="col-lg-12 grid-margin stretch-card" id="food-bank-stock">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Floor Square Unallocated Stock</h4>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Transaction</th>
                          <th>Created Date</th>
                          <th>Stock Type</th>
                          <th>Item Details</th>
                          <th>Quantity</th>
                          <th>Expiry Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                      <?php
                          $api_url = $APIBASE."delivery_notice_exec.php?action=show_foodbank_stock";
                          $client = curl_init($api_url);
                          curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                          $response = curl_exec($client);
                          $result = json_decode($response);
                          $bank_history_output = '';

                          if(count($result) > 0)
                          {
                            foreach($result as $row)
                            {

                              $row_id = $row->stockdetail_id;
                              
                              if($row->allocated != "allocated" && $row->allocated != "partial"){

                              $bank_history_output .= '
                              <tr>
                              <td>'.$row->stockdetail_id.'</td>
                              <td>'.$row->create_date_time.'</td>
                              <td>'.$row->stock_type.'</td>
                              <td>'.$row->stock_name.', '.$row->stock_brand.'</td>
                              <td>'.$row->stock_level_amount.'</td>
                              <td>'.$row->stock_exp_date.'</td>
                              <td>
                                <a target="_blank" href="allocate_stock.php?id='.$row->stockdetail_id.'"><button class="btn btn-outline-primary">Allocate</button></a>
                              </td>
                              </tr>
                              ';
                            }
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

            <br>
            <div class="col-lg-12 grid-margin stretch-card" id="partial-food-bank-stock">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title"> Allocated Stock to Floor Square</h4>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Transaction</th>
                          <th>Created Date</th>
                          <th>Stock Type</th>
                          <th>Item Details</th>
                          <th>Quantity</th>
                          <th>Manufactured Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                      <?php
                          $api_url = $APIBASE."stock_levels_exec.php?action=show_allocated_foodbank_stock";
                          $client = curl_init($api_url);
                          curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                          $response = curl_exec($client);
                          $result = json_decode($response);
                          $bank_history_output = '';

                          if(count($result) > 0)
                          {
                            foreach($result as $row)
                            {

                              $row_id = $row->allocation_id;

                              $partial_output .= '
                              <tr>
                              <td>'.$row->allocation_id.'</td>
                              <td>'.$row->date_time.'</td>
                              <td>'.$row->stock_type.'</td>
                              <td>'.$row->stock_name.', '.$row->stock_brand.'</td>
                              <td>'.$row->items_qty.'</td>
                              <td>'.$row->stock_exp_date.'</td>
                              <td>
                                <a target="_blank" href="allocate_stock.php?id='.$row->stockdetail_id.'"><button class="btn btn-outline-primary">Allocate</button></a>
                              </td>
                              </tr>
                              ';
                            }
                          } else {
                          $partial_output .= '
                            <tr align="center">
                              <td align="center"> No Data To Display </td>
                            </tr>
                            ';
                        }

                          echo $partial_output;
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
