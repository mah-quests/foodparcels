<?php
    include_once "include/header.php";
    include("../config/connect.php");

    if (isset($_POST['submit'])) {



      function refGenerator()
      {

          $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $generated_ref = substr(str_shuffle($permitted_chars), 0, 10);
          return $generated_ref;
      }      

      $unique_code = refGenerator();

      $supplier_stock_level_data = array(
        'region' => $_SESSION['region'],
        'project_name' => $_POST['project_name'],
        'stock_type'  => $_POST['stock_type'],
        'est_date_of_delivery' => $_POST['est_date_of_delivery'],
        'stock_status'  => $_POST['stock_status'],
        'driver_full_name' => $_POST['driver_fullnames'],
        'driver_cellphone'  => $_POST['driver_cellphone'],
        'truck_details' => $_POST['truck_model'],
        'truck_registration_num'  => $_POST['truck_registration'],
        'unique_code' => $unique_code,
        'user_id' => $_SESSION['user_id'],
        'status' => 'progress',
        'previous_reference'  => $_POST['previous_reference'],
        'delivery_month' => $_POST['delivery_month']
      );
    
      $api_url = $APIBASE."delivery_notice_exec.php?action=add_supplier_delivery_note";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $supplier_stock_level_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);
  
      foreach($result as $keys => $values)
      {
        if($result[$keys]['success'] == '1')
        {
          $success = 'Successfully Added Delivery Notice';
        }
        else
        {
          $error_message = 'Failed to Add Delivery Notice';
        }
      }


      //Maize Meal 
      if ($_POST['maize_meal_quantity'] > 0 ){
      
      $maize_meal_data = array(
        'unique_code' => $unique_code,
        'stock_type' =>  $_POST['stock_type'],
        'stock_name' => 'Maize Meal',
        'stock_brand'  => $_POST['maize_meal_brand'],
        'stock_level_amount' => $_POST['maize_meal_quantity'],
        'stock_batch_number'  => $_POST['maize_meal_batch_number'],
        'stock_man_date' => $_POST['maize_meal_man_date'],
        'stock_exp_date'  => $_POST['maize_meal_exp_date'],
        'user_id' => $_SESSION['user_id'],
        'status' => 'pending',
        'project_name' => $_POST['project_name'],
        'region' => $_SESSION['region'],
        'delivery_month' => $_POST['delivery_month']
      );
    
      $api_url = $APIBASE."delivery_notice_exec.php?action=add_supplier_stock";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $maize_meal_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);  
      }

      //Rice
      if ($_POST['rice_quantity'] > 0 ){
      
        $rice_data = array(
          'unique_code' => $unique_code,
          'stock_type' =>  $_POST['stock_type'],
          'stock_name' => 'Rice',
          'stock_brand'  => $_POST['rice_brand'],
          'stock_level_amount' => $_POST['rice_quantity'],
          'stock_batch_number'  => $_POST['rice_batch_number'],
          'stock_man_date' => $_POST['rice_man_date'],
          'stock_exp_date'  => $_POST['rice_exp_date'],
          'user_id' => $_SESSION['user_id'],
          'status' => 'pending',
          'project_name' => $_POST['project_name'],
          'region' => $_SESSION['region'],
          'delivery_month' => $_POST['delivery_month']          
        );
      
        $api_url = $APIBASE."delivery_notice_exec.php?action=add_supplier_stock";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $rice_data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        $result = json_decode($response, true);  
        }      

      //Sugar
      if ($_POST['sugar_quantity'] > 0 ){
      
        $sugar_data = array(
          'unique_code' => $unique_code,
          'stock_type' =>  $_POST['stock_type'],
          'stock_name' => 'Sugar',
          'stock_brand'  => $_POST['sugar_brand'],
          'stock_level_amount' => $_POST['sugar_quantity'],
          'stock_batch_number'  => $_POST['sugar_batch_number'],
          'stock_man_date' => $_POST['sugar_man_date'],
          'stock_exp_date'  => $_POST['sugar_exp_date'],
          'user_id' => $_SESSION['user_id'],
          'status' => 'pending',
          'project_name' => $_POST['project_name'],
          'region' => $_SESSION['region'],
          'delivery_month' => $_POST['delivery_month']          
        );
      
        $api_url = $APIBASE."delivery_notice_exec.php?action=add_supplier_stock";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $sugar_data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        $result = json_decode($response, true);  
        }          

       //Cooking Oil
       if ($_POST['cooking_oil_quantity'] > 0 ){
      
        $cooking_oil_data = array(
          'unique_code' => $unique_code,
          'stock_type' =>  $_POST['stock_type'],
          'stock_name' => 'Cooking Oil',
          'stock_brand'  => $_POST['cooking_oil_brand'],
          'stock_level_amount' => $_POST['cooking_oil_quantity'],
          'stock_batch_number'  => $_POST['cooking_oil_batch_number'],
          'stock_man_date' => $_POST['cooking_oil_man_date'],
          'stock_exp_date'  => $_POST['cooking_oil_exp_date'],
          'user_id' => $_SESSION['user_id'],
          'status' => 'pending',
          'project_name' => $_POST['project_name'],
          'region' => $_SESSION['region'],
          'delivery_month' => $_POST['delivery_month']          
        );
      
        $api_url = $APIBASE."delivery_notice_exec.php?action=add_supplier_stock";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $cooking_oil_data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        $result = json_decode($response, true);  
        }       

       //Tea
       if ($_POST['tea_quantity'] > 0 ){
      
        $tea_data = array(
          'unique_code' => $unique_code,
          'stock_type' =>  $_POST['stock_type'],
          'stock_name' => 'Tea',
          'stock_brand'  => $_POST['tea_brand'],
          'stock_level_amount' => $_POST['tea_quantity'],
          'stock_batch_number'  => $_POST['tea_batch_number'],
          'stock_man_date' => $_POST['tea_man_date'],
          'stock_exp_date'  => $_POST['tea_exp_date'],
          'user_id' => $_SESSION['user_id'],
          'status' => 'pending',
          'project_name' => $_POST['project_name'],
          'region' => $_SESSION['region'],
          'delivery_month' => $_POST['delivery_month']          
        );
      
        $api_url = $APIBASE."delivery_notice_exec.php?action=add_supplier_stock";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $tea_data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        $result = json_decode($response, true);  
        }          

        //Baked Beans
        if ($_POST['baked_beans_quantity'] > 0 ){
      
          $baked_beans_data = array(
            'unique_code' => $unique_code,
            'stock_type' =>  $_POST['stock_type'],
            'stock_name' => 'Baked Beans',
            'stock_brand'  => $_POST['baked_beans_brand'],
            'stock_level_amount' => $_POST['baked_beans_quantity'],
            'stock_batch_number'  => $_POST['baked_beans_batch_number'],
            'stock_man_date' => $_POST['baked_beans_man_date'],
            'stock_exp_date'  => $_POST['baked_beans_exp_date'],
            'user_id' => $_SESSION['user_id'],
            'status' => 'pending',
            'project_name' => $_POST['project_name'],
            'region' => $_SESSION['region'],
            'delivery_month' => $_POST['delivery_month']            
          );
        
          $api_url = $APIBASE."delivery_notice_exec.php?action=add_supplier_stock";
          $client = curl_init($api_url);
          curl_setopt($client, CURLOPT_POST, true);
          curl_setopt($client, CURLOPT_POSTFIELDS, $baked_beans_data);
          curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($client);
          curl_close($client);
          $result = json_decode($response, true);  
          }   

        //All Purpose Soap
        if ($_POST['soap_quantity'] > 0 ){
      
          $soap_data = array(
            'unique_code' => $unique_code,
            'stock_type' =>  $_POST['stock_type'],
            'stock_name' => 'All Purpose Soap',
            'stock_brand'  => $_POST['soap_brand'],
            'stock_level_amount' => $_POST['soap_quantity'],
            'stock_batch_number'  => $_POST['soap_batch_number'],
            'stock_man_date' => $_POST['soap_man_date'],
            'stock_exp_date'  => $_POST['soap_exp_date'],
            'user_id' => $_SESSION['user_id'],
            'status' => 'pending',
            'project_name' => $_POST['project_name'],
            'region' => $_SESSION['region'],
            'delivery_month' => $_POST['delivery_month']            
          );
        
          $api_url = $APIBASE."delivery_notice_exec.php?action=add_supplier_stock";
          $client = curl_init($api_url);
          curl_setopt($client, CURLOPT_POST, true);
          curl_setopt($client, CURLOPT_POSTFIELDS, $soap_data);
          curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($client);
          curl_close($client);
          $result = json_decode($response, true);  
          }  

        //Soya Mince
        if ($_POST['soya_quantity'] > 0 ){
      
          $soya_data = array(
            'unique_code' => $unique_code,
            'stock_type' =>  $_POST['stock_type'],
            'stock_name' => 'Soya Mince',
            'stock_brand'  => $_POST['soya_brand'],
            'stock_level_amount' => $_POST['soya_quantity'],
            'stock_batch_number'  => $_POST['soya_batch_number'],
            'stock_man_date' => $_POST['soya_man_date'],
            'stock_exp_date'  => $_POST['soya_exp_date'],
            'user_id' => $_SESSION['user_id'],
            'status' => 'pending',
            'project_name' => $_POST['project_name'],
            'region' => $_SESSION['region'],
            'delivery_month' => $_POST['delivery_month']            
          );
        
          $api_url = $APIBASE."delivery_notice_exec.php?action=add_supplier_stock";
          $client = curl_init($api_url);
          curl_setopt($client, CURLOPT_POST, true);
          curl_setopt($client, CURLOPT_POSTFIELDS, $soya_data);
          curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($client);
          curl_close($client);
          $result = json_decode($response, true);  
          }  

        //Cabbage
        if ($_POST['cabbage_quantity'] > 0 ){

          $expiry_date = date('Y-m-d', strtotime($_POST['cabbage_date_unearthed']. ' + 91 days'));
      
          $cabbage_data = array(
            'unique_code' => $unique_code,
            'stock_type' =>  $_POST['stock_type'],
            'stock_name' => 'Cabbage',
            'stock_brand'  => $_POST['cabbage_farm'],
            'stock_level_amount' => $_POST['cabbage_quantity'],
            'stock_batch_number'  => $_POST['cabbage_batch_number'],
            'stock_man_date' => $_POST['cabbage_date_unearthed'],
            'stock_exp_date'  => $expiry_date,
            'user_id' => $_SESSION['user_id'],
            'status' => 'pending',
            'project_name' => $_POST['project_name'],
            'region' => $_SESSION['region'],
            'delivery_month' => $_POST['delivery_month']            
          );
        
          $api_url = $APIBASE."delivery_notice_exec.php?action=add_supplier_stock";
          $client = curl_init($api_url);
          curl_setopt($client, CURLOPT_POST, true);
          curl_setopt($client, CURLOPT_POSTFIELDS, $cabbage_data);
          curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($client);
          curl_close($client);
          $result = json_decode($response, true);  
          }            


        //Potatoes
        if ($_POST['potatoes_quantity'] > 0 ){

          $expiry_date = date('Y-m-d', strtotime($_POST['potatoes_date_unearthed']. ' + 61 days'));
      
          $potatoes_data = array(
            'unique_code' => $unique_code,
            'stock_type' =>  $_POST['stock_type'],
            'stock_name' => 'Potatoes',
            'stock_brand'  => $_POST['potatoes_farm'],
            'stock_level_amount' => $_POST['potatoes_quantity'],
            'stock_batch_number'  => $_POST['potatoes_batch_number'],
            'stock_man_date' => $_POST['potatoes_date_unearthed'],
            'stock_exp_date'  => $expiry_date,
            'user_id' => $_SESSION['user_id'],
            'status' => 'pending',
            'project_name' => $_POST['project_name'],
            'region' => $_SESSION['region'],
            'delivery_month' => $_POST['delivery_month']            
          );
        
          $api_url = $APIBASE."delivery_notice_exec.php?action=add_supplier_stock";
          $client = curl_init($api_url);
          curl_setopt($client, CURLOPT_POST, true);
          curl_setopt($client, CURLOPT_POSTFIELDS, $potatoes_data);
          curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($client);
          curl_close($client);
          $result = json_decode($response, true);  
          }            


        //Pumpkin
        if ($_POST['pumpkin_quantity'] > 0 ){

          $expiry_date = date('Y-m-d', strtotime($_POST['pumpkin_date_unearthed']. ' + 56 days'));
      
          $pumpkin_data = array(
            'unique_code' => $unique_code,
            'stock_type' =>  $_POST['stock_type'],
            'stock_name' => 'Pumpkin',
            'stock_brand'  => $_POST['pumpkin_farm'],
            'stock_level_amount' => $_POST['pumpkin_quantity'],
            'stock_batch_number'  => $_POST['pumpkin_batch_number'],
            'stock_man_date' => $_POST['pumpkin_date_unearthed'],
            'stock_exp_date'  => $expiry_date,
            'user_id' => $_SESSION['user_id'],
            'status' => 'pending',
            'project_name' => $_POST['project_name'],
            'region' => $_SESSION['region'],
            'delivery_month' => $_POST['delivery_month']            
          );
        
          $api_url = $APIBASE."delivery_notice_exec.php?action=add_supplier_stock";
          $client = curl_init($api_url);
          curl_setopt($client, CURLOPT_POST, true);
          curl_setopt($client, CURLOPT_POSTFIELDS, $pumpkin_data);
          curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($client);
          curl_close($client);
          $result = json_decode($response, true);  
          }  


          $activities_data = array(
            'unique_code' => $unique_code,
            'action_performed' => 'The supplier has created a Goods Delivery Note, ',
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



          $success = "<br>Finished adding a Supplier Delivery Note! <p>You will be redirected in <span id='counter'>1</span> second(s).</p>
          <script type='text/javascript'>
              function countdown() {
                var i = document.getElementById('counter');
                if (parseInt(i.innerHTML)<=0) {
                  location.href = 'delivery_history.php';
                }
                i.innerHTML = parseInt(i.innerHTML)-1;
              }
              setInterval(function(){ countdown(); },1000);
              </script>'";             

    }
?>

<script type="text/javascript">

  function showHideReleventForm() {
    var noOption = document.getElementById("stock_type").value;
    if (noOption == "Dry Goods") {
      jQuery('#dry-goods-info').show();
      document.getElementById("dry-goods-info").style.visibility = 'visible';

      jQuery('#veggies-info').hide();
      document.getElementById("veggies-info").style.visibility = 'hidden';

    } else {
      jQuery('#veggies-info').show();
      document.getElementById("veggies-info").style.visibility = 'visible';

      jQuery('#dry-goods-info').hide();
      document.getElementById("dry-goods-info").style.visibility = 'hidden';
    }
    
  }


  function showHideReferenceInput() {
    var noOption = document.getElementById("new_existing").value;
    if (noOption == "Existing") {
      jQuery('#old-reference-info').show();
      document.getElementById("old-reference-info").style.visibility = 'visible';

    } else {

      jQuery('#old-reference-info').hide();
      document.getElementById("old-reference-info").style.visibility = 'hidden';
    }
    
  }  

</script>

      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"> 
                      <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Delivery Register Overview</a>
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
                <div class="col-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Delivery Register Form</h4>

                      <form action="" method="POST">

                        <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="delivery_month">Delivery Month</label>
                                <input type="month" class="form-control" name="delivery_month" id="delivery_month" required>
                              </div>
                            </div>                          
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="new_existing">Is this a new or existing delivery?</label>
                                <select class="form-control" id="new_existing" name="new_existing" onchange="showHideReferenceInput(this.value)"  required>
                                  <option selected></option>
                                  <option>New</option>
                                  <option>Existing</option>
                                </select>
                              </div>  
                            </div>
                            <div class="col-md-4" id="old-reference-info" style="display:none">
                              <div class="form-group">
                                <label for="previous_reference">Existing Reference Number</label>
                                <input type="text" class="form-control" name="previous_reference" id="previous_reference" placeholder="Enter Exisiting Reference">
                              </div>
                            </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
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
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="stock_type">Stock Type</label>
                              <select class="form-control" id="stock_type" name="stock_type" onchange="showHideReleventForm(this.value)" required>
                                <option selected></option>
                                <option>Dry Goods</option>
                                <option>Vegetables</option>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div id="dry-goods-info" style="display:none">

                          <h6>
                            <u>Maize-Meal</u>
                          </h6>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="maize_meal_brand">Brand</label>
                                <input type="text" class="form-control" name="maize_meal_brand" id="maize_meal_brand" placeholder="Enter Brand">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="maize_meal_batch_number">Batch Number</label>
                                <input type="text" class="form-control" name="maize_meal_batch_number" id="maize_meal_batch_number" placeholder="Enter Batch Number">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="maize_meal_quantity">Quantity</label>
                                <input type="text" class="form-control" name="maize_meal_quantity" id="maize_meal_quantity" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Enter Quantity">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="maize_meal_man_date">Manufactured Date</label>
                                <input type="date" class="form-control" name="maize_meal_man_date" id="maize_meal_man_date" placeholder="Manufactured Date">
                              </div>
                            </div>
                            <div class="col-md-2">                      
                              <div class="form-group">
                                <label for="maize_meal_exp_date">Expiry Date</label>
                                <input type="date" class="form-control" name="maize_meal_exp_date"  id="maize_meal_exp_date" placeholder="Expiry Date">
                              </div>
                            </div>
                          </div>

                          <h6>
                            <u>Rice</u>
                          </h6>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="rice_brand">Brand</label>
                                <input type="text" class="form-control" name="rice_brand" id="rice_brand" placeholder="Enter Brand">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="rice_batch_number">Batch Number</label>
                                <input type="text" class="form-control" name="rice_batch_number" id="rice_batch_number" placeholder="Enter Batch Number">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="rice_quantity">Quantity</label>
                                <input type="text" class="form-control" name="rice_quantity" id="rice_quantity" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  placeholder="Enter Quantity">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="rice_man_date">Manufactured Date</label>
                                <input type="date" class="form-control" name="rice_man_date" id="rice_man_date" placeholder="Manufactured Date">
                              </div>
                            </div>
                            <div class="col-md-2">                      
                              <div class="form-group">
                                <label for="rice_exp_date">Expiry Date</label>
                                <input type="date" class="form-control" name="rice_exp_date" id="rice_exp_date" placeholder="Expiry Date">
                              </div>
                            </div>
                          </div>

                          <h6>
                            <u>Sugar</u>
                          </h6>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="sugar_brand">Brand</label>
                                <input type="text" class="form-control" name="sugar_brand" id="sugar_brand" placeholder="Enter Brand">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="sugar_batch_number">Batch Number</label>
                                <input type="text" class="form-control" name="sugar_batch_number" id="sugar_batch_number" placeholder="Enter Batch Number">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="exampleInputName1">Quantity</label>
                                <input type="text" class="form-control" name="sugar_quantity" id="sugar_quantity" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  placeholder="Enter Quantity">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="sugar_man_date">Manufactured Date</label>
                                <input type="date" class="form-control" name="sugar_man_date" id="sugar_man_date" placeholder="Manufactured Date">
                              </div>
                            </div>
                            <div class="col-md-2">                      
                              <div class="form-group">
                                <label for="sugar_exp_date">Expiry Date</label>
                                <input type="date" class="form-control" name="sugar_exp_date" id="sugar_exp_date" placeholder="Expiry Date">
                              </div>
                            </div>
                          </div>

                          <h6>
                            <u>Cooking Oil</u>
                          </h6>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="cooking_oil_brand">Brand</label>
                                <input type="text" class="form-control" name="cooking_oil_brand" id="cooking_oil_brand" placeholder="Enter Brand">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="cooking_oil_batch_number">Batch Number</label>
                                <input type="text" class="form-control" name="cooking_oil_batch_number" id="cooking_oil_batch_number" placeholder="Enter Batch Number">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="cooking_oil_quantity">Quantity</label>
                                <input type="text" class="form-control" name="cooking_oil_quantity" id="cooking_oil_quantity" placeholder="Enter Quantity">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="cooking_oil_man_date">Manufactured Date</label>
                                <input type="date" class="form-control" name="cooking_oil_man_date" id="cooking_oil_man_date" placeholder="Manufactured Date">
                              </div>
                            </div>
                            <div class="col-md-2">                      
                              <div class="form-group">
                                <label for="cooking_oil_exp_date">Expiry Date</label>
                                <input type="date" class="form-control" name="cooking_oil_exp_date"  id="cooking_oil_exp_date" placeholder="Expiry Date">
                              </div>
                            </div>
                          </div>

                          <h6>
                            <u>Tea</u>
                          </h6>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="tea_brand">Brand</label>
                                <input type="text" class="form-control" name="tea_brand" id="tea_brand" placeholder="Enter Brand">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="tea_batch_number">Batch Number</label>
                                <input type="text" class="form-control" name="tea_batch_number"  id="tea_batch_number" placeholder="Enter Batch Number">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="tea_quantity">Quantity</label>
                                <input type="text" class="form-control" name="tea_quantity" id="tea_quantity" placeholder="Enter Quantity">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="tea_man_date">Manufactured Date</label>
                                <input type="date" class="form-control" name="tea_man_date" id="tea_man_date" placeholder="Manufactured Date">
                              </div>
                            </div>
                            <div class="col-md-2">                      
                              <div class="form-group">
                                <label for="tea_exp_date">Expiry Date</label>
                                <input type="date" class="form-control" name="tea_exp_date" id="tea_exp_date" placeholder="Expiry Date">
                              </div>
                            </div>
                          </div>

                          <h6>
                            <u>Baked Beans</u>
                          </h6>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="baked_beans_brand">Brand</label>
                                <input type="text" class="form-control" name="baked_beans_brand" id="baked_beans_brand" placeholder="Enter Brand">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="baked_beans_batch_number">Batch Number</label>
                                <input type="text" class="form-control" name="baked_beans_batch_number" id="baked_beans_batch_number" placeholder="Enter Batch Number">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="baked_beans_quantity">Quantity</label>
                                <input type="text" class="form-control" name="baked_beans_quantity" id="baked_beans_quantity" placeholder="Enter Quantity">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="baked_beans_man_date">Manufactured Date</label>
                                <input type="date" class="form-control" name="baked_beans_man_date" id="baked_beans_man_date" placeholder="Manufactured Date">
                              </div>
                            </div>
                            <div class="col-md-2">                      
                              <div class="form-group">
                                <label for="baked_beans_exp_date">Expiry Date</label>
                                <input type="date" class="form-control"  name="baked_beans_exp_date" id="baked_beans_exp_date" placeholder="Expiry Date">
                              </div>
                            </div>
                          </div>

                          <h6>
                            <u>All Purpose Soap</u>
                          </h6>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="soap_brand">Brand</label>
                                <input type="text" class="form-control" name="soap_brand" id="soap_brand" placeholder="Enter Brand">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="soap_batch_number">Batch Number</label>
                                <input type="text" class="form-control" name="soap_batch_number" id="soap_batch_number" placeholder="Enter Batch Number">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="soap_quantity">Quantity</label>
                                <input type="text" class="form-control" name="soap_quantity" id="soap_quantity" placeholder="Enter Quantity">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="soap_man_date">Manufactured Date</label>
                                <input type="date" class="form-control" name="soap_man_date" id="soap_man_date" placeholder="Manufactured Date">
                              </div>
                            </div>
                            <div class="col-md-2">                      
                              <div class="form-group">
                                <label for="soap_exp_date">Expiry Date</label>
                                <input type="date" class="form-control" name="soap_exp_date" id="soap_exp_date" placeholder="Expiry Date">
                              </div>
                            </div>
                          </div>

                          <h6>
                            <u>Soya Mince</u>
                          </h6>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="soya_brand">Brand</label>
                                <input type="text" class="form-control" name="soya_brand" id="soya_brand" placeholder="Enter Brand">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="soya_batch_number">Batch Number</label>
                                <input type="text" class="form-control" name="soya_batch_number" id="soya_batch_number" placeholder="Enter Batch Number">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="soya_quantity">Quantity</label>
                                <input type="text" class="form-control" name="soya_quantity" id="soya_quantity" placeholder="Enter Quantity">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="soya_man_date">Manufactured Date</label>
                                <input type="date" class="form-control" name="soya_man_date" id="soya_man_date" placeholder="Manufactured Date">
                              </div>
                            </div>
                            <div class="col-md-2">                      
                              <div class="form-group">
                                <label for="soya_exp_date">Expiry Date</label>
                                <input type="date" class="form-control" name="soya_exp_date" id="soya_exp_date" placeholder="Expiry Date">
                              </div>
                            </div>
                          </div>

                        </div>


                        <div id="veggies-info" style="display:none">

                          <h6>
                            <u>Cabbage</u>
                          </h6>
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="cabbage_farm">Farm</label>
                                <input type="text" class="form-control" name="cabbage_farm" id="cabbage_farm" placeholder="Enter Farm Name">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="cabbage_province">Province</label>
                                <select class="form-control" id="cabbage_province" name="cabbage_province">
                                  <option selected></option>
                                  <option>Gauteng</option>
                                  <option>Free State</option>
                                  <option>Limpopo</option>
                                  <option>North West</option>
                                  <option>Northern Cape</option>
                                  <option>Western Cape</option>
                                  <option>Eastern Cape</option>
                                  <option>Mpumalanga</option>
                                  <option>Kwazulu Natal</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="cabbage_batch_number">Batch Number</label>
                                <input type="text" class="form-control" name="cabbage_batch_number" id="cabbage_batch_number" placeholder="Enter Batch Number">
                              </div>
                            </div>                            
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="cabbage_quantity">Quantity</label>
                                <input type="text" class="form-control" name="cabbage_quantity" id="cabbage_quantity" placeholder="Enter Quantity">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="cabbage_date_unearthed">Date Uneathed</label>
                                <input type="date" class="form-control" name="cabbage_date_unearthed" id="cabbage_date_unearthed" placeholder="Manufactured Date">
                              </div>
                            </div>
                          </div>

                          <h6>
                            <u>Potatoes</u>
                          </h6>
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="potatoes_farm">Farm</label>
                                <input type="text" class="form-control" name="potatoes_farm" id="potatoes_farm" placeholder="Enter Farm Name">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="potatoes_province">Province</label>
                                <select class="form-control" id="potatoes_province" name="potatoes_province">
                                  <option selected></option>
                                  <option>Gauteng</option>
                                  <option>Free State</option>
                                  <option>Limpopo</option>
                                  <option>North West</option>
                                  <option>Northern Cape</option>
                                  <option>Western Cape</option>
                                  <option>Eastern Cape</option>
                                  <option>Mpumalanga</option>
                                  <option>Kwazulu Natal</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="potatoes_batch_number">Batch Number</label>
                                <input type="text" class="form-control" name="potatoes_batch_number" id="potatoes_batch_number" placeholder="Enter Batch Number">
                              </div>
                            </div>                            
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="potatoes_quantity">Quantity</label>
                                <input type="text" class="form-control" name="potatoes_quantity" id="potatoes_quantity" placeholder="Enter Quantity">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="potatoes_date_unearthed">Date Uneathed</label>
                                <input type="date" class="form-control" name="potatoes_date_unearthed" id="potatoes_date_unearthed" placeholder="Manufactured Date">
                              </div>
                            </div>
                          </div>                          

                          <h6>
                            <u>Pumpkin</u>
                          </h6>
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="pumpkin_farm">Farm</label>
                                <input type="text" class="form-control" name="pumpkin_farm" id="pumpkin_farm" placeholder="Enter Farm Name">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="pumpkin_province">Province</label>
                                <select class="form-control" id="pumpkin_province" name="pumpkin_province">
                                  <option selected></option>
                                  <option>Gauteng</option>
                                  <option>Free State</option>
                                  <option>Limpopo</option>
                                  <option>North West</option>
                                  <option>Northern Cape</option>
                                  <option>Western Cape</option>
                                  <option>Eastern Cape</option>
                                  <option>Mpumalanga</option>
                                  <option>Kwazulu Natal</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="pumpkin_batch_number">Batch Number</label>
                                <input type="text" class="form-control" name="pumpkin_batch_number" id="pumpkin_batch_number" placeholder="Enter Batch Number">
                              </div>
                            </div>                            
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="pumpkin_quantity">Quantity</label>
                                <input type="text" class="form-control" name="pumpkin_quantity" id="pumpkin_quantity" placeholder="Enter Quantity">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="pumpkin_date_unearthed">Date Uneathed</label>
                                <input type="date" class="form-control" name="pumpkin_date_unearthed" id="pumpkin_date_unearthed" placeholder="Manufactured Date">
                              </div>
                            </div>
                          </div>

                        </div>

                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="est_date_of_delivery">Estimated Date of delivery</label>
                                <input type="date" class="form-control" name="est_date_of_delivery" id="est_date_of_delivery" placeholder="Choose Date" required>
                              </div>
                            </div> 
                            <div class="col-md">
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Stock Status</label>
                                <div class="col-sm-3">
                                  <div class="form-check form-check-success">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="stock_status" id="stock_status" value="Full Stock">
                                      Full Stock
                                    </label>
                                  </div>
                                </div>                                
                                <div class="col-sm-3">
                                  <div class="form-check form-check-danger">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="stock_status" id="stock_status" value="Under Stock">
                                        Under Stock
                                    </label>
                                  </div>
                                </div>
                                <div class="col-sm-3">
                                  <div class="form-check form-check-warning">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input"  name="stock_status" id="stock_status" value="Over Stock">
                                        Over Stock
                                    </label>
                                  </div>
                                </div>                          
                              </div>
                            </div>
                          </div>
        

                          <h6>
                            Driver Details
                          </h6>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="driver_fullnames">Full Names</label>
                                <input type="text" class="form-control" name="driver_fullnames" id="driver_fullnames" placeholder="Enter Driver Full Names" required>
                              </div>
                            </div>                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="driver_cellphone">Cellphone Number</label>
                                <input type="text" class="form-control" name="driver_cellphone" id="driver_cellphone" placeholder="Enter Driver Cellphone Number" required>
                              </div>
                            </div>
                          </div>

                          <h6>
                            Truck Details
                          </h6>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="truck_model">Brand and Model</label>
                                <input type="text" class="form-control" name="truck_model" id="truck_model" placeholder="Enter Truck Brand & Model" required>
                              </div>
                            </div>                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="truck_registration">Registration / Plate Numbers</label>
                                <input type="text" class="form-control" name="truck_registration" id="truck_registration" placeholder="Enter  Truck Number Plate" required>
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


