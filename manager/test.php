
<?php 

include_once "include/header.php";

    $APIBASE="http://localhost/foodparcels/api/";
    $_SESSION['region'] = "Johannesburg";

    
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

      $api_url = $APIBASE."stock_levels_exec.php?action=check_allocated_stock&location=".$_SESSION['region']."&stock_name=".$_POST['stock_name']."&stock_brand=".$_POST['stock_brand']."&project_name=".$_POST['project_name']."&floor_square=".$_POST['floor_square']."";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      $result = json_decode($response);

      if(count($result) > 0){
        foreach($result as $row) {
          
          $current_stock_level = $row->items_qty;
          $entered_stock_level = $_POST['items_qty'];
          $items_qty = $current_stock_level + $entered_stock_level;

          echo "yyyyyyyyy";


              //Update Supplier Status Stock Detail table
              $stock_data = array(
                'items_qty' => $items_qty,
                'location' => $_SESSION['region'],
                'stock_name' =>  $_POST['stock_name'],
                'stock_brand' => $_POST['stock_brand'],
                'project_name' => $_POST['project_name'],
                'floor_square' => $_POST['floor_square']
              );

   
              $api_url = $APIBASE."stock_levels_exec.php?action=update_allocated_stock";
              $client = curl_init($api_url);
              curl_setopt($client, CURLOPT_POST, true);
              curl_setopt($client, CURLOPT_POSTFIELDS, $stock_data);
              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
              $response = curl_exec($client);
              curl_close($client);          
          


        }
      } else {

        echo "xxxxxxxxx";


        $allocation_data = array(
          'stock_type' => $_POST['stock_type'],
          'stock_name' => $_POST['stock_name'],
          'stock_brand'  => $_POST['stock_brand'],
          'items_qty' => $_POST['items_qty'],
          'stock_man_date' => $_POST['stock_man_date'],
          'stock_exp_date' => $_POST['stock_exp_date'],
          'allocated_floor_space'  => $_POST['floor_square'],
          'unique_code' => $unique_code,
          'region' => $_POST['region'], 
          'project_name' => $_POST['project_name'], 
          'delivery_month' => $_POST['delivery_month']
        );
      
        $api_url = $APIBASE."stock_levels_exec.php?action=add_stock_floor_location";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $allocation_data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);

      }
    }


?>

</head>
<body>

            <?php

              $id = $_GET['id'];

              $api_url = $APIBASE."delivery_notice_exec.php?action=show_foodbank_stock_by_id&id=".$id."";
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


            <div class="col-md-6 col-xl-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="modal-body">
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
                                <option>FL_SQ_01</option>
                                <option>FL_SQ_02</option>
                                <option>FL_SQ_03</option>                            
                                <option>FL_SQ_04</option>
                                <option>STG_RM_SQ_01</option>
                                <option>STG_RM_SQ_02</option>                            
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
                          <input type="hidden" id="region" name="region" value="<?php echo $row->region; ?>">
                          <input type="hidden" id="project_name" name="project_name" value="<?php echo $row->project_name; ?>">
                          <input type="hidden" id="delivery_month" name="delivery_month" value="<?php echo $row->delivery_month; ?>">

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
            </div>

            <?php
                }
              }
            ?>

            
</body>
</html>
