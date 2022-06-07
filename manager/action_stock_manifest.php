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

              $new_stock_qty = $row->stock_level_amount;
              $current_stock_name = $row->stock_name;

              //Populate the stock activities table (foodbank_stock_details_tbl)
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
                'region' => $_SESSION['region'],
                'status' => "Completed",
                'project_name'  => $row->project_name,                
                'supplier_ref' => $row->unique_code,
                'delivery_month' => $row->delivery_month
              );

   
              $api_url = $APIBASE."delivery_notice_exec.php?action=add_foodbank_stock";
              $client = curl_init($api_url);
              curl_setopt($client, CURLOPT_POST, true);
              curl_setopt($client, CURLOPT_POSTFIELDS, $stock_data);
              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
              $response = curl_exec($client);
              curl_close($client);
              $result = json_decode($response, true);  

              $current_stock = $row->stock_name;
              $stock_amount = $row->stock_level_amount;

              //Update Supplier Status Stock Detail table
              $stock_data = array(
                'status' => "complete",
                'stockdetail_id' => $row_id
              );

   
              $api_url = $APIBASE."delivery_notice_exec.php?action=update_delivered_stock_status";
              $client = curl_init($api_url);
              curl_setopt($client, CURLOPT_POST, true);
              curl_setopt($client, CURLOPT_POSTFIELDS, $stock_data);
              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
              $response = curl_exec($client);
              curl_close($client);


              if (strlen($unique_code) > 1 ){

                //Update Supplier Status Stock Level table
                $stock_data = array(
                  'status' => "processed",
                  'unique_code' => $row->unique_code   
                );

                $api_url = $APIBASE."delivery_notice_exec.php?action=update_delivery_status";
                $client = curl_init($api_url);
                curl_setopt($client, CURLOPT_POST, true);
                curl_setopt($client, CURLOPT_POSTFIELDS, $stock_data);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                curl_close($client);                

              }
            } 
          }



          if ($current_stock_name == "Maize Meal"){
              $current_stock_name = "Maize+Meal";
          } 
      
          if ($current_stock_name == "Maize-Meal"){
              $current_stock_name = "Maize+Meal";
          }     
      
          if ($current_stock_name == "Cooking Oil"){
              $current_stock_name = "Cooking+Oil";
          } 
      
          if ($current_stock_name == "Baked Beans"){
              $current_stock_name = "Baked+Beans";
          } 
      
          if ($current_stock_name == "All Purpose Soap"){
              $current_stock_name = "All+Purpose+Soap";
          } 
      
          if ($current_stock_name == "Soya Mince"){
              $current_stock_name = "Soya+Mince";
          }     
      
          //Get the current stock level before updating
      
          $stock_detail_api_url = $APIBASE."delivery_notice_exec.php?action=get_stock_amount&location=".$_SESSION['region']."&stock_name=".$current_stock_name."";
      
          $client = curl_init($stock_detail_api_url);
          curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($client);
          $result = json_decode($response);
      
          if(count($result) > 0){
              foreach($result as $row) {
      
                  $stock_id = $row->stock_id;
                  $current_stock_level = $row->current_stock_level;
                  $old_stock_level = $row->old_stock_level;
                  $updated_stock_level = $row->updated_stock_level;
      
              }
          }
      
          
          $unique_code = $unique_code;
          $received_stock = $new_stock_qty;
          $new_stock_level = $current_stock_level + $received_stock;
      
          $actual_stock_data = array(
              'unique_code' => $unique_code,
              'current_stock_level' => $new_stock_level,
              'old_stock_level' => $current_stock_level,
              'updated_stock_level' => $received_stock,
              'update_activity' => "Added Fully Stock From The Supplier",
              'stock_id' => $stock_id
          );
      
          $api_url = $APIBASE."delivery_notice_exec.php?action=update_stock_level";
          $client = curl_init($api_url);
          curl_setopt($client, CURLOPT_POST, true);
          curl_setopt($client, CURLOPT_POSTFIELDS, $actual_stock_data);
          curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($client);
          curl_close($client);
          $result = json_decode($response, true); 
    
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

              //Populate the stock activities table (foodbank_stock_details_tbl)
              $stock_data = array(
                'unique_code' => $unique_code,
                'stock_type' => $row->stock_type,
                'stock_name' => $row->stock_name,
                'stock_brand'  => $row->stock_brand,
                'stock_level_amount' => $_POST['stock_level_amount'],
                'stock_batch_number'  => $row->stock_batch_number,
                'stock_man_date' => $row->stock_man_date,
                'stock_exp_date'  => $row->stock_exp_date,
                'project_name'  => $row->project_name,
                'region' => $_SESSION['region'],
                'user_id' => $_SESSION['user_id'],
                'status' => "Completed",
                'supplier_ref' => $row->unique_code,
                'delivery_month' => $row->delivery_month
              );

   
              $api_url = $APIBASE."delivery_notice_exec.php?action=add_foodbank_stock";
              $client = curl_init($api_url);
              curl_setopt($client, CURLOPT_POST, true);
              curl_setopt($client, CURLOPT_POSTFIELDS, $stock_data);
              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
              $response = curl_exec($client);
              curl_close($client);
              $result = json_decode($response, true);  

              $current_stock_name = $row->stock_name;

              //Update Supplier Status Stock Detail table
              $stock_data = array(
                'status' => "partial",
                'stockdetail_id' => $row_id
              );

   
              $api_url = $APIBASE."delivery_notice_exec.php?action=update_delivered_stock_status";
              $client = curl_init($api_url);
              curl_setopt($client, CURLOPT_POST, true);
              curl_setopt($client, CURLOPT_POSTFIELDS, $stock_data);
              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
              $response = curl_exec($client);
              curl_close($client);


              if (strlen($unique_code) > 1 ){

                //Update Supplier Status Stock Level table
                $stock_data = array(
                  'status' => "processed",
                  'unique_code' => $row->unique_code   
                );

                $api_url = $APIBASE."delivery_notice_exec.php?action=update_delivery_status";
                $client = curl_init($api_url);
                curl_setopt($client, CURLOPT_POST, true);
                curl_setopt($client, CURLOPT_POSTFIELDS, $stock_data);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                curl_close($client);                

              }
            } 
          }

          

          if ($current_stock_name == "Maize Meal"){
              $current_stock_name = "Maize+Meal";
          } 
      
          if ($current_stock_name == "Maize-Meal"){
              $current_stock_name = "Maize+Meal";
          }     
      
          if ($current_stock_name == "Cooking Oil"){
              $current_stock_name = "Cooking+Oil";
          } 
      
          if ($current_stock_name == "Baked Beans"){
              $current_stock_name = "Baked+Beans";
          } 
      
          if ($current_stock_name == "All Purpose Soap"){
              $current_stock_name = "All+Purpose+Soap";
          } 
      
          if ($current_stock_name == "Soya Mince"){
              $current_stock_name = "Soya+Mince";
          }     
      
          //Get the current stock level before updating
      
          $stock_detail_api_url = $APIBASE."delivery_notice_exec.php?action=get_stock_amount&location=".$_SESSION['region']."&stock_name=".$current_stock_name."";
      
          $client = curl_init($stock_detail_api_url);
          curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($client);
          $result = json_decode($response);
      
          if(count($result) > 0){
              foreach($result as $row) {
      
                  $stock_id = $row->stock_id;
                  $current_stock_level = $row->current_stock_level;
                  $old_stock_level = $row->old_stock_level;
                  $updated_stock_level = $row->updated_stock_level;
      
              }
          }
      
          
          $unique_code = $unique_code;
          $received_stock = $_POST['stock_level_amount'];
          $new_stock_level = $current_stock_level + $received_stock;
      
          $actual_stock_data = array(
              'unique_code' => $unique_code,
              'current_stock_level' => $new_stock_level,
              'old_stock_level' => $current_stock_level,
              'updated_stock_level' => $received_stock,
              'update_activity' => "Added Partial Stock From The Supplier",
              'stock_id' => $stock_id
          );
      
          $api_url = $APIBASE."delivery_notice_exec.php?action=update_stock_level";
          $client = curl_init($api_url);
          curl_setopt($client, CURLOPT_POST, true);
          curl_setopt($client, CURLOPT_POSTFIELDS, $actual_stock_data);
          curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($client);
          curl_close($client);
          $result = json_decode($response, true); 
    
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


              if (strlen($unique_code) > 1 ){

                //Update Supplier Status Stock Level table
                $stock_data = array(
                  'status' => "processed",
                  'unique_code' => $row->unique_code   
                );

                $api_url = $APIBASE."delivery_notice_exec.php?action=update_delivery_status";
                $client = curl_init($api_url);
                curl_setopt($client, CURLOPT_POST, true);
                curl_setopt($client, CURLOPT_POSTFIELDS, $stock_data);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                curl_close($client);                

              }


              //Update Status
              $rejected_data = array(
                'supplier_unique_code' => $row->unique_code,
                'manager_unique_code' => $unique_code,
                'supplier_delivery_date' => $row->create_date,
                'stock_type' => $row->stock_type,
                'stock_name' => $row->stock_name,
                'rejected_amounts' => $row->stock_level_amount,
                'status' => "food bank rejected",
                'reason_of_rejection' => $_POST['rejection_notes'],
                'logged_by' => $_SESSION['name'],
                'logged_by_user_id' => $_SESSION['user_id'],
                'project_name' => $row->project_name,
                'region' => $_SESSION['region'],
                'delivery_month' => $row->delivery_month
              );

   
              $api_url = $APIBASE."delivery_notice_exec.php?action=add_rejected_stock";
              $client = curl_init($api_url);
              curl_setopt($client, CURLOPT_POST, true);
              curl_setopt($client, CURLOPT_POSTFIELDS, $rejected_data);
              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
              $response = curl_exec($client);
              curl_close($client);
              $result = json_decode($response, true);                

              }
          }
 

        }
      }      

      $activities_data = array(
        'unique_code' => $unique_code,
        'action_performed' => "The foodbank manager has processed a Goods Delivery Note, ",
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
      

      $success = "<br>Finished processing the Supplier Delivery Stock! <p>You will be redirected in <span id='counter'>1</span> second(s).</p>
      <script type='text/javascript'>
          function countdown() {
            var i = document.getElementById('counter');
            if (parseInt(i.innerHTML)<=0) {
              location.href = 'goods_receivables.php#food-bank-stock';
            }
            i.innerHTML = parseInt(i.innerHTML)-1;
          }
          setInterval(function(){ countdown(); },1000);
          </script>'";   


    }

?>

<script type="text/javascript">

  function showHideReleventForm() {
    var noOption = document.getElementById("item_rejected");

    if (noOption.checked != true){


      jQuery('#item-rejected-info').hide();
      document.getElementById("item-rejected-info").style.visibility = 'hidden';

      
    } else {

      jQuery('#item-rejected-info').show();
      document.getElementById("item-rejected-info").style.visibility = 'visible';

      
    }
    
  }

</script>

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
                  <p class="card-description">
                    As completed by the supplier. 
                  </p>
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
                                    <input type="checkbox" class="form-check-input" name="item_rejected[]" id="item_rejected[]" onclick="showHideReleventForm(this.value)" value="'.$row->stockdetail_id.'">
                                      Rejected
                                  </label>
                                </div>
                              </td>                                                            
                              <td>'.$row->create_date.'</td>
                              <td>'.$row->stock_type.'</td>
                              <td>'.$row->stock_name.', <br>'.$row->stock_brand.'</td>
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


                    <div id="item-rejected-info">
                      <div class="row" align="center">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-10">
                          <tr>
                            <td>
                              <textarea class="form-control" name="rejection_notes" id="rejection_notes" rows="4" placeholder="If there's rejections. Enter the reason for stock rejection"></textarea>
                            </td>
                          </tr>
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


