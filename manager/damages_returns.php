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
                          Damages and Returns 
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
                  <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Damages and Returns Register Form</h4>
                        <form class="forms-sample">

                          <h6>
                            Contact Person Details
                          </h6>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputName1">Reference Code</label>
                                <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter Reference Code">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputName1">Date of delivery</label>
                                <input type="date" class="form-control" id="exampleInputName1" placeholder="Choose Date">
                              </div>
                            </div> 
                          </div>

                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleFormControlSelect2">Item</label>
                                <select class="form-control" id="stock_type" name="stock_type">
                                  <option selected></option>
                                  <option>Maize-Meal</option>
                                  <option>Rice</option>
                                  <option>Sugar</option>
                                  <option>Cooking Oil</option>
                                  <option>Tea</option>
                                  <option>Baked Beans</option>
                                  <option>All Purpose Soap</option>
                                  <option>Soya Mince</option>
                                  <option>Cabbage</option>
                                  <option>Potatoes</option>
                                  <option>Pumpkin</option>
                                  <option>Other</option>
                                </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputName1">Operator Responsible</label>
                                <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter Operator Name">
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-8">
                              <div class="form-group">
                                <label for="exampleInputName1">Description</label>
                                <textarea class="form-control" id="stock_type" name="stock_type" placeholder="Enter stock Description"></textarea>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="exampleInputName1">Quantity</label>
                                <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter Quantity Items">
                              </div>
                            </div>                            
                          </div>         

                          <div align="center">
                            <button type="button" class="btn btn-outline-primary btn-icon-text btn-lg">
                              <i class="ti-file btn-icon-prepend"></i>
                              Submit
                            </button>
                            <button type="button" class="btn btn-outline-warning btn-icon-text btn-lg">
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
                        <h4 class="card-title">Damages & Returns History</h4>
                        <p class="card-description">
                          over the past 24 months
                        </p>
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>Transaction</th>
                                <th>Reported Date</th>
                                <th>Delivery Reference</th>
                                <th>Stock Type</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>

                            <?php
                                $api_url = $APIBASE."delivery_notice_exec.php?action=show_rejected_stock";
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
                                    <td>'.$row->rejected_id.'</td>
                                    <td>'.$row->reject_reported_date.'</td>
                                    <td>'.$row->manager_unique_code.'</td>
                                    <td>'.$row->stock_type.'</td>
                                    <td>'.$row->stock_name.'</td>
                                    <td>'.$row->rejected_amounts.'</td>
                                    <td>'.$row->stock_exp_date.'</td>
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
