<?php
  include_once "include/header.php";
  include("../config/connect.php");
  error_reporting(0);
  session_start();

  $user_id = $_SESSION['user_id'];
  $region = $_SESSION['region'];

  if (isset($_POST['submit'])) {

    function refGenerator()
    {

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $generated_ref = substr(str_shuffle($permitted_chars), 0, 10);
        return $generated_ref;
    }      

    $unique_code = refGenerator();

      //Update Status
      $rejected_data = array(
        'supplier_unique_code' => $_POST['reference'],
        'manager_unique_code' => $unique_code,
        'supplier_delivery_date' => $_POST['delivery_date'],
        'stock_type' => $_POST['stock_type'],
        'stock_name' => $_POST['stock_name'],
        'rejected_amounts' => $_POST['stock_quantity'],
        'status' => "food bank operator rejected",
        'reason_of_rejection' => $_POST['rejection_notes'],
        'logged_by' => $_POST['operator'],
        'logged_by_user_id' => $_SESSION['user_id'],
        'project_name' => $_POST['project_name'],
        'region' => $_SESSION['region'],
        'delivery_month' => $_POST['delivery_date']
      );


      $api_url = $APIBASE."delivery_notice_exec.php?action=add_rejected_stock";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $rejected_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);                

      $activities_data = array(
        'unique_code' => $unique_code,
        'action_performed' => "The foodbank manager has processing returned goods, ",
        'performed_by' => $_SESSION['name'],
        'user_id'  => $_SESSION['user_id'],
        'region' => $_SESSION['region']  
      );
    
      $api_url = $APIBASE."activity_notification_exec.php?action=add_user_activity";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $activities_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true); 
      

 

      $success = "<br>Finished allocating stock to designated floor locations! <p>You will be redirected in <span id='counter'>1</span> second(s).</p>
      <script type='text/javascript'>
          function countdown() {
            var i = document.getElementById('counter');
            if (parseInt(i.innerHTML)<=0) {
              location.href = 'damages_returns.php';
            }
            i.innerHTML = parseInt(i.innerHTML)-1;
          }
          setInterval(function(){ countdown(); },1000);
          </script>'";    

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
                        <form action="" method="POST">

                          <h6>
                            Contact Person Details
                          </h6>
                          <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="project_name">Project Name</label>
                              <select class="form-control" id="project_name" name="project_name" required>
                                <option selected></option>
                                <option>War On Poverty</option>
                                <option>ART</option>
                                <option>Christmas Hamper</option>                            
                                <option>Disaster Project</option>
                                <option>Special Project</option>
                                <option>Other</option>                            
                              </select>
                            </div>  
                          </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="reference">Initial Reference Code</label>
                                <input type="text" class="form-control" id="reference" name="reference" placeholder="Enter Delivert Reference Code" required>
                              </div>
                            </div>                            
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="delivery_date">Date of delivery</label>
                                <input type="date" class="form-control" name="delivery_date" id="delivery_date" placeholder="Choose Date">
                              </div>
                            </div> 
                          </div>

                          <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="stock_type">Stock Type</label>
                              <select class="form-control" id="stock_type" name="stock_type" required>
                                <option selected></option>
                                <option>Dry Goods</option>
                                <option>Vegetables</option>
                              </select>
                            </div>
                          </div>                            
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="stock_name">Item</label>
                                <select class="form-control" id="stock_name" name="stock_name" required>
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
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="stock_quantity">Quantity</label>
                                <input type="text" class="form-control" id="stock_quantity" name="stock_quantity" placeholder="Enter Quantity Items">
                              </div>
                            </div>   
                          </div>

                          <div class="row">
                            <div class="col-md-8">
                              <div class="form-group">
                                <label for="rejection_notes">Description</label>
                                <textarea class="form-control" id="rejection_notes" name="rejection_notes" placeholder="Enter stock Description"></textarea>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="operator">Operator Responsible</label>
                                <input type="text" class="form-control" id="operator" name="operator" placeholder="Enter Operator Name">
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
                                <th>Project Name</th>
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
                                    <td>'.$row->project_name.'</td>
                                    <td>'.$row->stock_type.'</td>
                                    <td>'.$row->stock_name.'</td>
                                    <td>'.$row->rejected_amounts.'</td>
                                    <td>
                                      <a href="#"><button class="btn btn-outline-primary" >View</button></a>
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
