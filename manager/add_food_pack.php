<?php
  include_once "include/header.php";
  include("../config/connect.php");
  include("include/QR_BarCode.php");

  error_reporting(0);
  session_start();

  $location = $_SESSION['region'];
  $qr = new QR_BarCode();

  if (isset($_POST['submit'])) {

    function refGenerator()
    {

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $generated_ref = substr(str_shuffle($permitted_chars), 0, 10);
        return $generated_ref;
    }      

    $unique_code = refGenerator();    

    $foodpack = array();
    $allocated_stock = array();


    if(!empty($_POST['maize_meal'])){
      foreach($_POST['maize_meal'] as $row_id){
        
        
        $api_url = $APIBASE."stock_levels_exec.php?action=allocated_stock_id&id=".$row_id."";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        $result = json_decode($response);


        if(count($result) > 0){
          foreach($result as $row) {

            $foodpack[] = "maize_meal";
            $allocated_stock[] = $row->allocation_id;

          }
        }

      }
    }  

    if(!empty($_POST['rice'])){
      foreach($_POST['rice'] as $row_id){
        
        $api_url = $APIBASE."stock_levels_exec.php?action=allocated_stock_id&id=".$row_id."";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        $result = json_decode($response);


        if(count($result) > 0){
          foreach($result as $row) {

            $foodpack[] = "rice";
            $allocated_stock[] = $row->allocation_id;

          }
        }

      }
    }  
    
    
    if(!empty($_POST['sugar'])){
      foreach($_POST['sugar'] as $row_id){
        
        $api_url = $APIBASE."stock_levels_exec.php?action=allocated_stock_id&id=".$row_id."";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        $result = json_decode($response);


        if(count($result) > 0){
          foreach($result as $row) {

            $foodpack[] = "sugar";
            $allocated_stock[] = $row->allocation_id;

          }
        }

      }
    }  
    
    if(!empty($_POST['cooking_oil'])){
      foreach($_POST['cooking_oil'] as $row_id){
        
        $api_url = $APIBASE."stock_levels_exec.php?action=allocated_stock_id&id=".$row_id."";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        $result = json_decode($response);


        if(count($result) > 0){
          foreach($result as $row) {

            $foodpack[] = "cooking_oil";
            $allocated_stock[] = $row->allocation_id;

          }
        }

      }
    }      

    if(!empty($_POST['tea'])){
      foreach($_POST['tea'] as $row_id){
        
        $api_url = $APIBASE."stock_levels_exec.php?action=allocated_stock_id&id=".$row_id."";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        $result = json_decode($response);


        if(count($result) > 0){
          foreach($result as $row) {

            $foodpack[] = "tea";
            $allocated_stock[] = $row->allocation_id;

          }
        }

      }
    }  

    if(!empty($_POST['baked_beans'])){
      foreach($_POST['baked_beans'] as $row_id){
        
        $api_url = $APIBASE."stock_levels_exec.php?action=allocated_stock_id&id=".$row_id."";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        $result = json_decode($response);


        if(count($result) > 0){
          foreach($result as $row) {

            $foodpack[] = "baked_beans";
            $allocated_stock[] = $row->allocation_id;

          }
        }

      }
    }  

    if(!empty($_POST['soap'])){
      foreach($_POST['soap'] as $row_id){
        
        $api_url = $APIBASE."stock_levels_exec.php?action=allocated_stock_id&id=".$row_id."";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        $result = json_decode($response);


        if(count($result) > 0){
          foreach($result as $row) {

            $foodpack[] = "soap";
            $allocated_stock[] = $row->allocation_id;
            

          }
        }

      }
    }  
    
    if(!empty($_POST['soya_mince'])){
      foreach($_POST['soya_mince'] as $row_id){
        
        $api_url = $APIBASE."stock_levels_exec.php?action=allocated_stock_id&id=".$row_id."";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        $result = json_decode($response);


        if(count($result) > 0){
          foreach($result as $row) {

            $foodpack[] = "soya_mince";
            $allocated_stock[] = $row->allocation_id;

          }
        }

      }
    }  
    
    if(!empty($_POST['cabbage'])){
      foreach($_POST['cabbage'] as $row_id){
        
        $api_url = $APIBASE."stock_levels_exec.php?action=allocated_stock_id&id=".$row_id."";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        $result = json_decode($response);


        if(count($result) > 0){
          foreach($result as $row) {

            $foodpack[] = "cabbage";
            $allocated_stock[] = $row->allocation_id;

          }
        }

      }
    }  
    
    if(!empty($_POST['potatoes'])){
      foreach($_POST['potatoes'] as $row_id){
        
        $api_url = $APIBASE."stock_levels_exec.php?action=allocated_stock_id&id=".$row_id."";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        $result = json_decode($response);


        if(count($result) > 0){
          foreach($result as $row) {

            $foodpack[] = "potatoes";
            $allocated_stock[] = $row->allocation_id;

          }
        }

      }
    }      


    if(!empty($_POST['pumpkin'])){
      foreach($_POST['pumpkin'] as $row_id){
        
        $api_url = $APIBASE."stock_levels_exec.php?action=allocated_stock_id&id=".$row_id."";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        $result = json_decode($response);


        if(count($result) > 0){
          foreach($result as $row) {

            $foodpack[] = "pumpkin";
            $allocated_stock[] = $row->allocation_id;

          }
        }

      }
    }  

    if (count($foodpack) == 11){

      if(in_array("maize_meal", $foodpack) && in_array("rice", $foodpack) && in_array("sugar", $foodpack) && in_array("cooking_oil", $foodpack) && 
      in_array("tea", $foodpack) && in_array("baked_beans", $foodpack) && in_array("soap", $foodpack) && in_array("cabbage", $foodpack) && 
      in_array("potatoes", $foodpack) && in_array("pumpkin", $foodpack) && in_array("soya_mince", $foodpack) ){
  

        foreach ($allocated_stock as $id) {

          $remove_stock_data = array(

            'allocation_id' => $id 

          );
        
          $api_url = $APIBASE."stock_levels_exec.php?action=create_foodpack";
          $client = curl_init($api_url);
          curl_setopt($client, CURLOPT_POST, true);
          curl_setopt($client, CURLOPT_POSTFIELDS, $remove_stock_data);
          curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($client);
          curl_close($client);



          $foodpack_details_data = array(

            'allocation_id' => $id,
            'unique_code' => $unique_code
  
          );
        
          $api_url = $APIBASE."stock_levels_exec.php?action=add_foodpack_details";
          $client = curl_init($api_url);
          curl_setopt($client, CURLOPT_POST, true);
          curl_setopt($client, CURLOPT_POSTFIELDS, $foodpack_details_data);
          curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($client);
          curl_close($client);            


        }

        $current_stock_data = array(

          'region' => $_SESSION['region']

        );
      
        $api_url = $APIBASE."delivery_notice_exec.php?action=after_foodpack_create";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $current_stock_data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);        


        $foodbank_stock_data = array(

          'region' => $_SESSION['region'],
          'project_name' => $_POST['project_name']

        );
      
        $api_url = $APIBASE."stock_levels_exec.php?action=update_current_stock_after_foodpack";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $foodbank_stock_data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);        


        $foodpack_summary_data = array(

          'unique_code' => $unique_code,
          'region' => $_SESSION['region'],
          'project_name' => $_POST['project_name'],
          'pakaged_by' => $_SESSION['name'],
          'foodpack_state' => "Food Bank"

        );

        $url = $URLBASE."foodpack.php?code=".$unique_code;
        //create text QR code
        $qr->URL($url);

        //Save QR in image
        $qr->qrCode(200,'../qr-code/'.$unique_code.'.png');        
      
        $api_url = $APIBASE."stock_levels_exec.php?action=add_foodpack_summary";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $foodpack_summary_data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);            


        $activities_data = array(
          'unique_code' => $unique_code,
          'action_performed' => "The foodbank manager has created a food pack, ",
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

        $success = "<br>Successfully Finished processing the Food Pack! <p>You will be redirected in <span id='counter'>1</span> second(s).</p>
        <script type='text/javascript'>
            function countdown() {
              var i = document.getElementById('counter');
              if (parseInt(i.innerHTML)<=0) {
                location.href = 'food_parcels.php';
              }
              i.innerHTML = parseInt(i.innerHTML)-1;
            }
            setInterval(function(){ countdown(); },1000);
            </script>'";   
  

  
      } else {
  
        $error_message = "The food pack not complete. Please ensire that all food pack items are packaged properly.";
  
      }

    } else {
      
      $error_message = "The food pack is missing items. Please ensire that all food pack items are packaged properly.";

    }
  }

?>  

<script type="text/javascript">

  function showHideReleventForm() {
    var noOption = document.getElementById("project_name").value;
    if (noOption == "ART") {

      jQuery('#art-info').show();
      document.getElementById("art-info").style.visibility = 'visible';

      jQuery('#war-on-poverty-info').hide();
      document.getElementById("dwar-on-poverty-info").style.visibility = 'hidden';


    } else {

      jQuery('#war-on-poverty-info').show();
      document.getElementById("war-on-poverty-info").style.visibility = 'visible';

      jQuery('#art-info').hide();
      document.getElementById("art-info").style.visibility = 'hidden';


    }
  }


  function showEditMaizeMealField() {

    var noOption = document.getElementById("maize_meal_status").value;

    if (noOption == "Partial"){


      jQuery('#maize_meal-readonly').hide();
      document.getElementById("maize_meal-readonly").style.visibility = 'hidden';

      jQuery('#maize_meal-edit').show();
      document.getElementById("maize_meal-edit").style.visibility = 'visible';

      jQuery('#maize_meal-rejected-notes').show();
      document.getElementById("rejected-notes").style.visibility = 'visible';
            
    } else if (noOption == "Rejected"){

      jQuery('#maize_meal-rejected-notes').show();
      document.getElementById("rejected-notes").style.visibility = 'visible';

      jQuery('#maize_meal-readonly').show();
      document.getElementById("maize_meal-readonly").style.visibility = 'visible';

      jQuery('#maize_meal-edit').hide();
      document.getElementById("maize_meal-edit").style.visibility = 'hidden';   

    
    } else {

      jQuery('#maize_meal-readonly').show();
      document.getElementById("maize_meal-readonly").style.visibility = 'visible';

      jQuery('#maize_meal-edit').hide();
      document.getElementById("maize_meal-edit").style.visibility = 'hidden';      

      jQuery('#maize_meal-rejected-notes').hide();
      document.getElementById("rejected-notes").style.visibility = 'hidden';

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
                        <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Add Food Pack Overview</a>
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
                  <br>

                  <div align="center">
                  <?php if (!empty($error_message)) {
                    echo '<div class="alert alert-danger">' . $error_message . '</div>';
                    }
                    if (!empty($success)) {
                      echo '<div class="alert alert-success">' . $success . '</div>';
                    }
					        ?>
                </div> 

                  <div class="col-12 grid-margin">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Compose Food Pack</h4>
                        <p class="card-description">Food Composition Portal. Based on the ptoject, select relevant stock items. </p>

                          <form action="" method="POST">

                            <div class="row">   
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="project_name">Project Name</label>
                                  <select class="form-control" id="project_name" name="project_name" onchange="showHideReleventForm(this.value)"  required>
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
                            </div>

                            <div id="war-on-poverty-info" style="display:none">

                              <?php 

                                $stock_name = "Maize+Meal";
                                $project_name = "War+On+Poverty";
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_foodparcel_available_stock&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);

                                foreach($result as $row)
                                {
                                  if ($row->items_qty > 0){

                                ?>  

                                <div class="row">                  
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="item">Item</label>
                                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="floor_allocation">Allocated Floor Plan </label>
                                      <input type="text" class="form-control" name="floor_allocation" id="floor_allocation" value="<?php echo $row->allocated_floor_space ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="total">Total Items</label>
                                      <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->items_qty ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-1">
                                    <div class="form-check">
                                      <label class="form-check-label"></label>
                                      <input type="checkbox" class="form-check-input" name="maize_meal[]" id="maize_meal[]"  value="<?php echo $row->allocation_id ?>" >
                                    </div>    
                                  </div>
                                </div>

                                <?php 
                                  }
                                }
                                ?>


                              <?php 

                                $stock_name = "Rice";
                                $project_name = "War+On+Poverty";
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_foodparcel_available_stock&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);

                                foreach($result as $row)
                                {
                                  if ($row->items_qty > 0){


                                ?>  

                                <div class="row">                  
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="item">Item</label>
                                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="floor_allocation">Allocated Floor Plan </label>
                                      <input type="text" class="form-control" name="floor_allocation" id="floor_allocation" value="<?php echo $row->allocated_floor_space ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="total">Total Items</label>
                                      <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->items_qty ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-1">
                                    <div class="form-check">
                                      <label class="form-check-label"></label>
                                      <input type="checkbox" class="form-check-input" name="rice[]" id="rice[]"  value="<?php echo $row->allocation_id ?>" >
                                    </div>    
                                  </div>                               
                                </div>

                                <?php 
                                  }
                                }
                                ?>
                                
                              <?php 

                                $stock_name = "Sugar";
                                $project_name = "War+On+Poverty";
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_foodparcel_available_stock&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);

                                foreach($result as $row)
                                {
                                  if ($row->items_qty > 0){

                                ?>  

                                <div class="row">                  
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="item">Item</label>
                                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="allocation">Allocated Floor Plan </label>
                                      <input type="text" class="form-control" name="allocation" id="allocation" value="<?php echo $row->allocated_floor_space ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="total">Total Items</label>
                                      <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->items_qty ?>" readonly>
                                    </div>
                                  </div>                                
                                  <div class="col-md-1">
                                    <div class="form-check">
                                      <label class="form-check-label"></label>
                                      <input type="checkbox" class="form-check-input" name="sugar[]" id="sugar[]"  value="<?php echo $row->allocation_id ?>" >
                                    </div>    
                                  </div>                               
                                </div>

                                <?php 
                                  }
                                }
                                ?>


                              <?php 

                                $stock_name = "Cooking+Oil";
                                $project_name = "War+On+Poverty";
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_foodparcel_available_stock&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);

                                foreach($result as $row)
                                {
                                  if ($row->items_qty > 0){

                                ?>  

                                <div class="row">                  
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="item">Item</label>
                                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="floor_allocation">Allocated Floor Plan </label>
                                      <input type="text" class="form-control" name="floor_allocation" id="floor_allocation" value="<?php echo $row->allocated_floor_space ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="total">Total Items</label>
                                      <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->items_qty ?>" readonly>
                                    </div>
                                  </div>                                 
                                  <div class="col-md-1">
                                    <div class="form-check">
                                      <label class="form-check-label"></label>
                                      <input type="checkbox" class="form-check-input" name="cooking_oil[]" id="cooking_oil[]" value="<?php echo $row->allocation_id ?>" >
                                    </div>    
                                  </div>                               
                                </div>

                                <?php 
                                  }
                                }
                                ?>



                              <?php 

                                $stock_name = "Tea";
                                $project_name = "War+On+Poverty";
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_foodparcel_available_stock&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);

                                foreach($result as $row)
                                {
                                  if ($row->items_qty > 0){

                                ?>  

                                <div class="row">                  
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="item">Item</label>
                                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="floor_allocation">Allocated Floor Plan </label>
                                      <input type="text" class="form-control" name="floor_allocation" id="floor_allocation" value="<?php echo $row->allocated_floor_space ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="total">Total Items</label>
                                      <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->items_qty ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-1">
                                    <div class="form-check">
                                      <label class="form-check-label"></label>
                                      <input type="checkbox" class="form-check-input" name="tea[]" id="tea[]"  value="<?php echo $row->allocation_id ?>" >
                                    </div>    
                                  </div>                               
                                </div>

                                <?php 
                                  }
                                }
                                ?>



                              <?php 

                                $stock_name = "Baked+Beans";
                                $project_name = "War+On+Poverty";
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_foodparcel_available_stock&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);

                                foreach($result as $row)
                                {
                                  if ($row->items_qty > 0){

                                ?>  

                                <div class="row">                  
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="item">Item</label>
                                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="floor_allocation">Allocated Floor Plan </label>
                                      <input type="text" class="form-control" name="floor_allocation" id="floor_allocation" value="<?php echo $row->allocated_floor_space ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="total">Total Items</label>
                                      <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->items_qty ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-1">
                                    <div class="form-check">
                                      <label class="form-check-label"></label>
                                      <input type="checkbox" class="form-check-input" name="baked_beans[]" id="baked_beans[]"  value="<?php echo $row->allocation_id ?>" >
                                    </div>    
                                  </div>                               
                                </div>

                                <?php 
                                  }
                                }
                                ?>


                              <?php 

                                $stock_name = "All+Purpose+Soap";
                                $project_name = "War+On+Poverty";
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_foodparcel_available_stock&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);

                                foreach($result as $row)
                                {
                                  if ($row->items_qty > 0){

                                ?>  

                                <div class="row">                  
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="item">Item</label>
                                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="floor_allocation">Allocated Floor Plan </label>
                                      <input type="text" class="form-control" name="floor_allocation" id="floor_allocation" value="<?php echo $row->allocated_floor_space ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="total">Total Items</label>
                                      <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->items_qty ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-1">
                                    <div class="form-check">
                                      <label class="form-check-label"></label>
                                      <input type="checkbox" class="form-check-input" name="soap[]" id="soap[]"  value="<?php echo $row->allocation_id ?>" >
                                    </div>    
                                  </div>                               
                                </div>

                                <?php 
                                  }
                                }
                                ?>


                              <?php 

                                $stock_name = "Soya+Mince";
                                $project_name = "War+On+Poverty";
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_foodparcel_available_stock&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);

                                foreach($result as $row)
                                {
                                  if ($row->items_qty > 0){

                                ?>  

                                <div class="row">                  
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="item">Item</label>
                                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="floor_allocation">Allocated Floor Plan </label>
                                      <input type="text" class="form-control" name="floor_allocation" id="floor_allocation" value="<?php echo $row->allocated_floor_space ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="total">Total Items</label>
                                      <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->items_qty ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-1">
                                    <div class="form-check">
                                      <label class="form-check-label"></label>
                                      <input type="checkbox" class="form-check-input" name="soya_mince[]" id="soya_mince[]"  value="<?php echo $row->allocation_id ?>" >
                                    </div>    
                                  </div>                               
                                </div>

                                <?php 
                                  }
                                }
                                ?>

                              <?php 

                                $stock_name = "Cabbage";
                                $project_name = "War+On+Poverty";
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_foodparcel_available_stock&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);

                                foreach($result as $row)
                                {
                                  if ($row->items_qty > 0){

                                ?>  

                                <div class="row">                  
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="item">Item</label>
                                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="floor_allocation">Allocated Floor Plan </label>
                                      <input type="text" class="form-control" name="floor_allocation" id="floor_allocation" value="<?php echo $row->allocated_floor_space ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="total">Total Items</label>
                                      <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->items_qty ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-1">
                                    <div class="form-check">
                                      <label class="form-check-label"></label>
                                      <input type="checkbox" class="form-check-input" name="cabbage[]" id="cabbage[]"  value="<?php echo $row->allocation_id ?>" >
                                    </div>    
                                  </div>                               
                                </div>

                                <?php 
                                  }
                                }
                                ?>

                              <?php 

                                $stock_name = "Potatoes";
                                $project_name = "War+On+Poverty";
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_foodparcel_available_stock&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);

                                foreach($result as $row)
                                {
                                  if ($row->items_qty > 0){

                                ?>  

                                <div class="row">                  
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="item">Item</label>
                                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="floor_allocation">Allocated Floor Plan </label>
                                      <input type="text" class="form-control" name="floor_allocation" id="floor_allocation" value="<?php echo $row->allocated_floor_space ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="total">Total Items</label>
                                      <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->items_qty ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-1">
                                    <div class="form-check">
                                      <label class="form-check-label"></label>
                                      <input type="checkbox" class="form-check-input" name="potatoes[]" id="potatoes[]"  value="<?php echo $row->allocation_id ?>" >
                                    </div>    
                                  </div>                               
                                </div>

                                <?php 
                                  }
                                }
                                ?>

                              <?php 

                                $stock_name = "Pumpkin";
                                $project_name = "War+On+Poverty";
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_foodparcel_available_stock&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);

                                foreach($result as $row)
                                {
                                  if ($row->items_qty > 0){

                                ?>  

                                <div class="row">                  
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="item">Item</label>
                                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="floor_allocation">Allocated Floor Plan </label>
                                      <input type="text" class="form-control" name="floor_allocation" id="floor_allocation" value="<?php echo $row->allocated_floor_space ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="total">Total Items</label>
                                      <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->items_qty ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-1">
                                    <div class="form-check">
                                      <label class="form-check-label"></label>
                                      <input type="checkbox" class="form-check-input" name="pumpkin[]" id="pumpkin[]"  value="<?php echo $row->allocation_id ?>" >
                                    </div>    
                                  </div>                               
                                </div>

                                <?php 
                                  }
                                }
                                ?>

                            </div>


                            <div id="art-info" style="display:none">

                              <?php 

                                $stock_name = "Maize+Meal";
                                $project_name = "ART";
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_foodparcel_available_stock&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);

                                foreach($result as $row)
                                {
                                  if ($row->items_qty > 0){

                                ?>  

                                <div class="row">                  
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="item">Item</label>
                                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>"  readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="floor_allocation">Allocated Floor Plan </label>
                                      <input type="text" class="form-control" name="floor_allocation" id="floor_allocation" value="<?php echo $row->allocated_floor_space ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="total">Total Items</label>
                                      <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->items_qty ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-1">
                                    <div class="form-check">
                                      <label class="form-check-label"></label>
                                      <input type="checkbox" class="form-check-input" name="maize_meal[]" id="maize_meal[]"  value="<?php echo $row->allocation_id ?>">
                                    </div>    
                                  </div>                               
                                </div>

                                <?php 
                                  }
                                }
                                ?>


                              <?php 

                                $stock_name = "Rice";
                                $project_name = "ART";
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_foodparcel_available_stock&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);

                                foreach($result as $row)
                                {
                                  if ($row->items_qty > 0){

                                ?>  

                                <div class="row">                  
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="item">Item</label>
                                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>"  readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="floor_allocation">Allocated Floor Plan </label>
                                      <input type="text" class="form-control" name="floor_allocation" id="floor_allocation" value="<?php echo $row->allocated_floor_space ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="total">Total Items</label>
                                      <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->items_qty ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-1">
                                    <div class="form-check">
                                      <label class="form-check-label"></label>
                                      <input type="checkbox" class="form-check-input" name="rice[]" id="rice[]"  value="<?php echo $row->allocation_id ?>">
                                    </div>    
                                  </div>                               
                                </div>

                                <?php 
                                  }
                                }
                                ?>
                                
                              <?php 

                                $stock_name = "Sugar";
                                $project_name = "ART";
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_foodparcel_available_stock&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);

                                foreach($result as $row)
                                {
                                  if ($row->items_qty > 0){

                                ?>  

                                <div class="row">                  
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="item">Item</label>
                                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>"  readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="allocation">Allocated Floor Plan </label>
                                      <input type="text" class="form-control" name="allocation" id="allocation" value="<?php echo $row->allocated_floor_space ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="total">Total Items</label>
                                      <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->items_qty ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-1">
                                    <div class="form-check">
                                      <label class="form-check-label"></label>
                                      <input type="checkbox" class="form-check-input" name="sugar[]" id="sugar[]" value="<?php echo $row->allocation_id ?>">
                                    </div>    
                                  </div>                               
                                </div>

                                <?php 
                                  }
                                }
                                ?>


                              <?php 

                                $stock_name = "Cooking+Oil";
                                $project_name = "ART";
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_foodparcel_available_stock&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);

                                foreach($result as $row)
                                {
                                  if ($row->items_qty > 0){

                                ?>  

                                <div class="row">                  
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="item">Item</label>
                                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="floor_allocation">Allocated Floor Plan </label>
                                      <input type="text" class="form-control" name="floor_allocation" id="floor_allocation" value="<?php echo $row->allocated_floor_space ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="total">Total Items</label>
                                      <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->items_qty ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-1">
                                    <div class="form-check">
                                      <label class="form-check-label"></label>
                                      <input type="checkbox" class="form-check-input" name="cooking_oil[]" id="cooking_oil[]" value="<?php echo $row->allocation_id ?>" >
                                    </div>    
                                  </div>                               
                                </div>

                                <?php 
                                  }
                                }
                                ?>



                              <?php 

                                $stock_name = "Tea";
                                $project_name = "ART";
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_foodparcel_available_stock&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);

                                foreach($result as $row)
                                {
                                  if ($row->items_qty > 0){

                                ?>  

                                <div class="row">                  
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="item">Item</label>
                                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>"  readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="floor_allocation">Allocated Floor Plan </label>
                                      <input type="text" class="form-control" name="floor_allocation" id="floor_allocation" value="<?php echo $row->allocated_floor_space ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="total">Total Items</label>
                                      <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->items_qty ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-1">
                                    <div class="form-check">
                                      <label class="form-check-label"></label>
                                      <input type="checkbox" class="form-check-input" name="tea[]" id="tea[]" value="<?php echo $row->allocation_id ?>" >
                                    </div>    
                                  </div>                               
                                </div>

                                <?php 
                                  }
                                }
                                ?>



                              <?php 

                                $stock_name = "Baked+Beans";
                                $project_name = "ART";
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_foodparcel_available_stock&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);

                                foreach($result as $row)
                                {
                                  if ($row->items_qty > 0){

                                ?>  

                                <div class="row">                  
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="item">Item</label>
                                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>"  readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="floor_allocation">Allocated Floor Plan </label>
                                      <input type="text" class="form-control" name="floor_allocation" id="floor_allocation" value="<?php echo $row->allocated_floor_space ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="total">Total Items</label>
                                      <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->items_qty ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-1">
                                    <div class="form-check">
                                      <label class="form-check-label"></label>
                                      <input type="checkbox" class="form-check-input" name="baked_beans[]" id="baked_beans[]" value="<?php echo $row->allocation_id ?>" >
                                    </div>    
                                  </div>                               
                                </div>

                                <?php 
                                  }
                                }
                                ?>


                              <?php 

                                $stock_name = "All+Purpose+Soap";
                                $project_name = "ART";
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_foodparcel_available_stock&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);

                                foreach($result as $row)
                                {
                                  if ($row->items_qty > 0){

                                ?>  

                                <div class="row">                  
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="item">Item</label>
                                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="floor_allocation">Allocated Floor Plan </label>
                                      <input type="text" class="form-control" name="floor_allocation" id="floor_allocation" value="<?php echo $row->allocated_floor_space ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="total">Total Items</label>
                                      <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->items_qty ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-1">
                                    <div class="form-check">
                                      <label class="form-check-label"></label>
                                      <input type="checkbox" class="form-check-input" name="soap[]" id="soap[]" value="<?php echo $row->allocation_id ?>" >
                                    </div>    
                                  </div>                               
                                </div>

                                <?php 
                                  }
                                }
                                ?>


                              <?php 

                                $stock_name = "Soya+Mince";
                                $project_name = "ART";
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_foodparcel_available_stock&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);

                                foreach($result as $row)
                                {
                                  if ($row->items_qty > 0){

                                ?>  

                                <div class="row">                  
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="item">Item</label>
                                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="floor_allocation">Allocated Floor Plan </label>
                                      <input type="text" class="form-control" name="floor_allocation" id="floor_allocation" value="<?php echo $row->allocated_floor_space ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="total">Total Items</label>
                                      <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->items_qty ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-1">
                                    <div class="form-check">
                                      <label class="form-check-label"></label>
                                      <input type="checkbox" class="form-check-input" name="soya_mince[]" id="soya_mince[]" value="<?php echo $row->allocation_id ?>" >
                                    </div>    
                                  </div>                               
                                </div>

                                <?php 
                                  }
                                }
                                ?>

                              <?php 

                                $stock_name = "Cabbage";
                                $project_name = "ART";
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_foodparcel_available_stock&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);

                                foreach($result as $row)
                                {
                                  if ($row->items_qty > 0){

                                ?>  

                                <div class="row">                  
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="item">Item</label>
                                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>"  readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="floor_allocation">Allocated Floor Plan </label>
                                      <input type="text" class="form-control" name="floor_allocation" id="floor_allocation" value="<?php echo $row->allocated_floor_space ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="total">Total Items</label>
                                      <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->items_qty ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-1">
                                    <div class="form-check">
                                      <label class="form-check-label"></label>
                                      <input type="checkbox" class="form-check-input" name="cabbage[]" id="cabbage[]" value="<?php echo $row->allocation_id ?>" >
                                    </div>    
                                  </div>                               
                                </div>

                                <?php 
                                  }
                                }
                                ?>

                              <?php 

                                $stock_name = "Potatoes";
                                $project_name = "ART";
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_foodparcel_available_stock&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);

                                foreach($result as $row)
                                {
                                  if ($row->items_qty > 0){

                                ?>  

                                <div class="row">                  
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="item">Item</label>
                                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="floor_allocation">Allocated Floor Plan </label>
                                      <input type="text" class="form-control" name="floor_allocation" id="floor_allocation" value="<?php echo $row->allocated_floor_space ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="total">Total Items</label>
                                      <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->items_qty ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-1">
                                    <div class="form-check">
                                      <label class="form-check-label"></label>
                                      <input type="checkbox" class="form-check-input" name="potatoes[]" id="potatoes[]" value="<?php echo $row->allocation_id ?>" >
                                    </div>    
                                  </div>                               
                                </div>

                                <?php 
                                  }
                                }
                                ?>

                              <?php 

                                $stock_name = "Pumpkin";
                                $project_name = "ART";
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_foodparcel_available_stock&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);

                                foreach($result as $row)
                                {
                                  if ($row->items_qty > 0){

                                ?>  

                                <div class="row">                  
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="item">Item</label>
                                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="floor_allocation">Allocated Floor Plan </label>
                                      <input type="text" class="form-control" name="floor_allocation" id="floor_allocation" value="<?php echo $row->allocated_floor_space ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="total">Total Items</label>
                                      <input type="text" class="form-control" name="total" id="total" value="<?php echo $row->items_qty ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-md-1">
                                    <div class="form-check">
                                      <label class="form-check-label"></label>
                                      <input type="checkbox" class="form-check-input" name="pumpkin[]" id="pumpkin[]" value="<?php echo $row->allocation_id ?>" >
                                    </div>    
                                  </div>
                                </div>

                                <?php 
                                  }
                                }
                                ?>

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

                  <br>
                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                      <h4 class="card-title">List Of Food Packs</h4>
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>Transaction</th>
                                <th>Unique Code</th>
                                <th>Project Name</th>
                                <th>Package Date</th>
                                <th>Packed By</th>
                                <th>FoodPack Stage</th>
                              </tr>
                            </thead>
                            <tbody>

                            <?php
                                $api_url = $APIBASE."foodpack_exec.php?action=show_foodpack_list_20&location=".$location."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);
                                $allocated_output = '';

                                if(count($result) > 0)
                                {
                                  foreach($result as $row)
                                  {


                                    $foodpack_output .= '
                                    <tr>
                                    <td>'.$row->foodpack_id.'</td>
                                    <td>'.$row->unique_code.'</td>
                                    <td>'.$row->project_name.'</td>
                                    <td>'.$row->package_date.'</td>
                                    <td>'.$row->pakaged_by.'</td>
                                    <td>'.$row->foodpack_state.'</td>
                                    </tr>
                                    ';
                                  }
                                } else {
                                $foodpack_output .= '
                                  <tr align="center">
                                    <td align="center"> No Data To Display </td>
                                  </tr>
                                  ';
                              }

                                echo $foodpack_output;
                            ?>                      

                            </tbody>
                          </table>

                        </div>
                      </div>
                    </div>
                  </div>  

                  <br>
                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                      <h4 class="card-title">Allocated Stock To Floor Square</h4>
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
                                <th>Floor Allocation</th>
                              </tr>
                            </thead>
                            <tbody>

                            <?php
                                $api_url = $APIBASE."stock_levels_exec.php?action=show_allocated_foodbank_stock&location=".$location."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);
                                $allocated_output = '';

                                if(count($result) > 0)
                                {
                                  foreach($result as $row)
                                  {

                                    $row_id = $row->allocation_id;

                                    $allocated_output .= '
                                    <tr>
                                    <td>'.$row->allocation_id.'</td>
                                    <td>'.$row->date_time.'</td>
                                    <td>'.$row->stock_type.'</td>
                                    <td>'.$row->stock_name.', '.$row->stock_brand.'</td>
                                    <td>'.$row->items_qty.'</td>
                                    <td>'.$row->stock_exp_date.'</td>
                                    <td>'.$row->allocated_floor_space.'</td>
                                    </tr>
                                    ';
                                  }
                                } else {
                                $allocated_output .= '
                                  <tr align="center">
                                    <td align="center"> No Data To Display </td>
                                  </tr>
                                  ';
                              }

                                echo $allocated_output;
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
