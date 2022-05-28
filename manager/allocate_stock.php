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

      $allocation_data = array(
        'stock_type' => $_POST['stock_type'],
        'stock_name' => $_POST['stock_name'],
        'stock_brand'  => $_POST['stock_brand'],
        'items_qty' => $_POST['items_qty'],
        'stock_man_date' => $_POST['stock_man_date'],
        'stock_exp_date' => $_POST['stock_exp_date'],
        'allocated_floor_space'  => $_POST['floor_square'],
        'unique_code' => $unique_code,
        'region' => $_SESSION['region']
      );
    
      $api_url = $APIBASE."stock_levels_exec.php?action=add_stock_floor_location";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $allocation_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      
      
      if ($_POST['stock_level_amount'] == $_POST['items_qty']){
        $allocation_status = "allocated";
      } else {
        $allocation_status = "partial";
      }

      //Update Supplier Status Stock Level table
      $update_foodbank_data = array(
        'allocated' => $allocation_status,
        'stockdetail_id' => $_POST['stockdetail_id'] 
      );

      $api_url = $APIBASE."delivery_notice_exec.php?action=update_foodbank_stock";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $update_foodbank_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);           


      $activities_data = array(
        'unique_code' => $unique_code,
        'action_performed' => "The foodbank manager has processed allocated stock to floor square, ",
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
              location.href = 'floor_plan.php';
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
                      <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Allocate Delivery Stock To Floor Square</a>
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
                <div class="row">
                  <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Unallocated Item Details</h4>
                        
                        <div class="template-demo">
                          <table class="table mb-0">
                            <thead>
                              <tr>
                                <th class="ps-0">Item Details</th>
                                <th class="text-right">Value</th>
                              </tr>
                            </thead>
                            <tbody>

                            <?php
                              $api_url = $APIBASE."delivery_notice_exec.php?action=show_foodbank_stock_by_id&id=".$_GET['id']."";
                              $client = curl_init($api_url);
                              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                              $response = curl_exec($client);
                              $result = json_decode($response);
                              $bank_history_output = '';

                              if(count($result) > 0)
                              {
                                foreach($result as $row)
                                {
                            ?>


                              <tr>
                                <td class="ps-0"><b>Stock Type</b></td>
                                <td class="pr-0 text-right"><?php echo $row->stock_type ?></div></td>
                              </tr>
                              <tr>
                              <td class="ps-0"><b>Stock Item</b></td>
                                <td class="pr-0 text-right"><?php echo $row->stock_name ?></div></td>
                              </tr>
                              <tr>
                              <td class="ps-0"><b>Item Brand</b></td>
                              <td class="pr-0 text-right"><?php echo $row->stock_brand ?></div></td>
                              </tr>
                              <tr>
                              <td class="ps-0"><b>Batch Number</b></td>
                              <td class="pr-0 text-right"><?php echo $row->stock_batch_number ?></div></td>
                              </tr>
                              <tr>
                              <td class="ps-0"><b>Manufactured Date</b></td>
                              <td class="pr-0 text-right"><?php echo $row->stock_man_date ?></div></td>
                              </tr>
                              <td class="ps-0"><b>Expiry Date</b></td>
                              <td class="pr-0 text-right"><?php echo $row->stock_exp_date ?></div></td>
                              </tr>
                              <td class="ps-0"><b>Stock Amount</b></td>
                              <td class="pr-0 text-right"><?php echo $row->stock_level_amount ?></div></td>
                              </tr>  
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Allocate Stock Item To Floor Square</h4>
                        <div class="template-demo">
                          <table class="table mb-0">

                            <form action="" method="POST">

                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="stock_details">Stock Type, Item </label>
                                    <input type="text" class="form-control" name="stock_details" id="stock_details" value="<?php echo $row->stock_type.', '.$row->stock_name ; ?>" readonly>
                                  </div>
                                </div>                                
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="floor_square">Floor Square Space</label>
                                    <select class="form-control" id="floor_square" name="floor_square" required>
                                      <option selected></option>
                                      <option>FL-SQ-01</option>
                                      <option>FL-SQ-02</option>
                                      <option>FL-SQ-03</option>                            
                                      <option>FL-SQ-04</option>
                                      <option>STG-RM-SQ-01</option>
                                      <option>STG-RM-SQ-02</option>                            
                                    </select>
                                  </div>  
                                </div>                            
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="items_qty">Number of Items</label>
                                    <input type="text" class="form-control" name="items_qty" id="items_qty" value="<?php echo $row->stock_level_amount; ?>" placeholder="Enter Number of Items to be allocated">
                                  </div>
                                </div>

                                <input type="hidden" id="stockdetail_id" name="stockdetail_id" value="<?php echo $row->stockdetail_id; ?>">
                                <input type="hidden" id="stock_type" name="stock_type" value="<?php echo $row->stock_type; ?>">
                                <input type="hidden" id="stock_level_amount" name="stock_level_amount" value="<?php echo $row->stock_level_amount; ?>">
                                <input type="hidden" id="stock_name" name="stock_name" value="<?php echo $row->stock_name; ?>">
                                <input type="hidden" id="stock_brand" name="stock_brand" value="<?php echo $row->stock_brand; ?>">
                                <input type="hidden" id="stock_man_date" name="stock_man_date" value="<?php echo $row->stock_man_date; ?>">
                                <input type="hidden" id="stock_exp_date" name="stock_exp_date" value="<?php echo $row->stock_exp_date; ?>">

                              </div>

                                <div align="center">
                                  <input  class="btn btn-outline-primary btn-icon-text btn-lg" type="submit" name="submit" value="Submit">
                                  <button class="btn btn-outline-warning btn-icon-text btn-lg" >
                                    <i class="ti-reload btn-icon-prepend"></i>                                                    
                                    Reset
                                  </button>
                                </div>

                            </form>

                          <?php                                   
                                }
                              }
                          ?>    


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


