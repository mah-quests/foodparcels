<?php
    include_once "include/header.php";
    include("../config/connect.php");

    $user_id = $_SESSION['user_id'];

    if (isset($_POST['submit'])) {

      function refGenerator()
      {

          $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $generated_ref = substr(str_shuffle($permitted_chars), 0, 10);
          return $generated_ref;
      }      

      $unique_code = refGenerator();

      if(!empty($_POST['item_complete'])){
        foreach($_POST['item_complete'] as $row_id){


          $api_url = $APIBASE."delivery_notice_exec.php?action=supplier_stock_id&id=".$row_id."";
          $client = curl_init($api_url);
          curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($client);
          $result = json_decode($response);


          if(count($result) > 0){
            foreach($result as $row) {

              //Populate the stock activities table (foodbank_stock_details_tbl )
              $stock_data = array(
                'unique_code' => $unique_code,
                'stock_type' => $row->stock_type,
                'stock_name' => $row->stock_name,
                'stock_brand'  => $row->stock_brand,
                'stock_level_amount' => $row->stock_level_amount,
                'stock_batch_number'  => $row->stock_batch_number,
                'stock_man_date' => $row->stock_man_date,
                'stock_exp_date'  => $row->stock_exp_date,
                'user_id' => $_SESSION['user_id'],
                'status' => "Completed",
                'supplier_ref' => $row->unique_code,     
              );

   
              $api_url = $APIBASE."delivery_notice_exec.php?action=add_foodbank_stock";
              $client = curl_init($api_url);
              curl_setopt($client, CURLOPT_POST, true);
              curl_setopt($client, CURLOPT_POSTFIELDS, $stock_data);
              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
              $response = curl_exec($client);
              curl_close($client);
              $result = json_decode($response, true);  


              //Update Supplier Status Stock Detail table
              $stock_data = array(
                'status' => "complete",
                'stockdetail_id' => $row_id,     
              );

   
              $api_url = $APIBASE."delivery_notice_exec.php?action=update_delivered_stock_status";
              $client = curl_init($api_url);
              curl_setopt($client, CURLOPT_POST, true);
              curl_setopt($client, CURLOPT_POSTFIELDS, $stock_data);
              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
              $response = curl_exec($client);
              curl_close($client);
              $result = json_decode($response, true);  


              //Update Supplier Status Stock Level table
              $stock_data = array(
                'status' => "processed",
                'unique_code' => $row->unique_code,     
              );

   
              $api_url = $APIBASE."delivery_notice_exec.php?action=update_delivery_status";
              $client = curl_init($api_url);
              curl_setopt($client, CURLOPT_POST, true);
              curl_setopt($client, CURLOPT_POSTFIELDS, $stock_data);
              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
              $response = curl_exec($client);
              curl_close($client);
              $result = json_decode($response, true);  

              }
          }
 

        }
      }

      if(!empty($_POST['item_partial'])){
        foreach($_POST['item_partial'] as $row_id){


          $api_url = $APIBASE."delivery_notice_exec.php?action=supplier_stock_id&id=".$row_id."";
          $client = curl_init($api_url);
          curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($client);
          $result = json_decode($response);


          if(count($result) > 0){
            foreach($result as $row) {

              //Populate the stock activities table (foodbank_stock_details_tbl )
              $stock_data = array(
                'unique_code' => $unique_code,
                'stock_type' => $row->stock_type,
                'stock_name' => $row->stock_name,
                'stock_brand'  => $row->stock_brand,
                'stock_level_amount' => $_POST['stock_level_amount'],
                'stock_batch_number'  => $row->stock_batch_number,
                'stock_man_date' => $row->stock_man_date,
                'stock_exp_date'  => $row->stock_exp_date,
                'user_id' => $_SESSION['user_id'],
                'status' => "Completed",
                'supplier_ref' => $row->unique_code,     
              );

   
              $api_url = $APIBASE."delivery_notice_exec.php?action=add_foodbank_stock";
              $client = curl_init($api_url);
              curl_setopt($client, CURLOPT_POST, true);
              curl_setopt($client, CURLOPT_POSTFIELDS, $stock_data);
              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
              $response = curl_exec($client);
              curl_close($client);
              $result = json_decode($response, true);  


              //Update Supplier Status Stock Detail table
              $stock_data = array(
                'status' => "partial",
                'stockdetail_id' => $row_id,     
              );

   
              $api_url = $APIBASE."delivery_notice_exec.php?action=update_delivered_stock_status";
              $client = curl_init($api_url);
              curl_setopt($client, CURLOPT_POST, true);
              curl_setopt($client, CURLOPT_POSTFIELDS, $stock_data);
              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
              $response = curl_exec($client);
              curl_close($client);
              $result = json_decode($response, true);  



              //Update Status
              $stock_data = array(
                'status' => "processed",
                'unique_code' => $row->unique_code,     
              );

   
              $api_url = $APIBASE."delivery_notice_exec.php?action=update_delivery_status";
              $client = curl_init($api_url);
              curl_setopt($client, CURLOPT_POST, true);
              curl_setopt($client, CURLOPT_POSTFIELDS, $stock_data);
              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
              $response = curl_exec($client);
              curl_close($client);
              $result = json_decode($response, true);  


              }
          }
 

        }
      }

      if(!empty($_POST['item_rejected'])){
        foreach($_POST['item_rejected'] as $row_id){


          $api_url = $APIBASE."delivery_notice_exec.php?action=supplier_stock_id&id=".$row_id."";
          $client = curl_init($api_url);
          curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($client);
          $result = json_decode($response);


          if(count($result) > 0){
            foreach($result as $row) {

              //Update Supplier Status Stock Detail table
              $stock_data = array(
                'status' => "rejected",
                'stockdetail_id' => $row_id,     
              );

   
              $api_url = $APIBASE."delivery_notice_exec.php?action=update_delivered_stock_status";
              $client = curl_init($api_url);
              curl_setopt($client, CURLOPT_POST, true);
              curl_setopt($client, CURLOPT_POSTFIELDS, $stock_data);
              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
              $response = curl_exec($client);
              curl_close($client);
              $result = json_decode($response, true);  



              //Update Status
              $stock_data = array(
                'status' => "processed",
                'unique_code' => $row->unique_code,     
              );

   
              $api_url = $APIBASE."delivery_notice_exec.php?action=update_delivery_status";
              $client = curl_init($api_url);
              curl_setopt($client, CURLOPT_POST, true);
              curl_setopt($client, CURLOPT_POSTFIELDS, $stock_data);
              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
              $response = curl_exec($client);
              curl_close($client);
              $result = json_decode($response, true);  


              }
          }
 

        }
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
                      <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Goods Delivery Stock Line Items</a>
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
          <div class="col-lg-12 grid-margin stretch-card">
            <form action="" method="POST">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Goods Delivery Stock Line Items - <span color:blue> Reference <?php echo $_GET['code'] ?></span></h4>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Complete</th>
                          <th>Partial</th>
                          <th>Rejected</th>
                          <th>Created Date</th>
                          <th>Stock Type</th>
                          <th>Item Details</th>
                          <th>Quantity</th>
                          <th>Expiry Date</th>
                        </tr>
                      </thead>
                      <tbody>

						          <?php

                          $api_url = $APIBASE."delivery_notice_exec.php?action=show_supplier_stock_detail&code=".$_GET['code']."";
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
                              <td>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="item_complete[]" id="item_complete[]" value="'.$row->stockdetail_id.'">
                                      Complete
                                  </label>
                                </div>
                              </td>
                              <td>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="item_partial[]" id="item_partial[]" value="'.$row->stockdetail_id.'">
                                      Partial
                                  </label>
                                </div>
                              </td>  
                              <td>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="item_rejected[]" id="item_partial[]" value="'.$row->stockdetail_id.'">
                                      Rejected
                                  </label>
                                </div>
                              </td>                                                            
                              <td>'.$row->create_date.'</td>
                              <td>'.$row->stock_type.'</td>
                              <td>'.$row->stock_name.', '.$row->stock_brand.'</td>
                              <td><input type="text" class="form-control" name="stock_level_amount" id="stock_level_amount" value="'.$row->stock_level_amount.'" ></td>
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

                <?php

                    $api_url = $APIBASE."delivery_notice_exec.php?action=show_supplier_stock_level&code=".$_GET['code']."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);
                    $output = '';

                    if(count($result) > 0)
                    {
                      foreach($result as $row)
                      {
                        if($row->status != "processed"){

                        
                  ?>

                    <div align="center">
                      <input  class="btn btn-outline-primary btn-icon-text btn-lg" type="submit" name="submit" value="Submit">
                      <button class="btn btn-outline-warning btn-icon-text btn-lg" >
                        <i class="ti-reload btn-icon-prepend"></i>                                                    
                        Reset
                      </button>
                    </div>

                  <?php
                      }
                    }
                  }
              ?>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Dashboard Web App Is Developed by <a href="https://www.mahquests.co.za/" target="_blank">MaH Quests Enterprises</a></span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2022. All rights reserved.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

<?php
  include_once "include/footer.php";
?>


