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

      function completeDelivery($id, $unique_code, $stock_qty){

        include("../config/connect.php");

        $api_url = $APIBASE."delivery_notice_exec.php?action=supplier_stock_id&id=".$id."";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        $result = json_decode($response);

        if(count($result) > 0){
          foreach($result as $row) {

            $new_stock_qty = $stock_qty;
            $current_stock_name = $row->stock_name;

            //Populate the stock activities table (foodbank_stock_details_tbl)
            $stock_data = array(
              'unique_code' => $unique_code,
              'stock_type' => $row->stock_type,
              'stock_name' => $row->stock_name,
              'stock_brand'  => $row->stock_brand,
              'stock_level_amount' => $stock_qty,
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
              'stockdetail_id' => $id
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

              //Update Supplier Rejected Stock status
              $update_rejected_stock_data = array(
                'supplier_unique_code' => $row->unique_code,
                'stock_name' => $row->stock_name,
                'status' => "resolved",
                   
              );

              $api_url = $APIBASE."delivery_notice_exec.php?action=update_rejected_stock_status";
              $client = curl_init($api_url);
              curl_setopt($client, CURLOPT_POST, true);
              curl_setopt($client, CURLOPT_POSTFIELDS, $update_rejected_stock_data);
              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
              $response = curl_exec($client);
              curl_close($client);    



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
    
            }
        }
    
        
        $received_stock = $new_stock_qty;
        $new_stock_level = $current_stock_level + $received_stock;
    
        $actual_stock_data = array(
            'unique_code' => $unique_code,
            'current_stock_level' => $new_stock_level,
            'old_stock_level' => $current_stock_level,
            'updated_stock_level' => $received_stock,
            'update_activity' => "Added Stock From The Supplier",
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

      function rejectDelivery($id, $unique_code, $reason, $stock_qty){

        include("../config/connect.php");

        $api_url = $APIBASE."delivery_notice_exec.php?action=supplier_stock_id&id=".$id."";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        $result = json_decode($response);

        if(count($result) > 0){
          foreach($result as $row) {

            //Update Supplier Status Stock Detail table
            $stock_data = array(
              'status' => "rejected",
              'stockdetail_id' => $id,     
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
              'rejected_amounts' => $stock_qty,
              'status' => "food bank rejected",
              'reason_of_rejection' => $reason,
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

      $unique_code = refGenerator();

      if ($_POST['maize_meal_status'] == "Complete"){
        completeDelivery($_POST['maize_meal_id'], $unique_code, $_POST['full_maize_meal_qty']);
      } else if ($_POST['maize_meal_status'] == "Rejected"){
        rejectDelivery($_POST['maize_meal_id'], $unique_code, $_POST['rejected_maize_meal'], $_POST['full_maize_meal_qty']);
      } else if ($_POST['maize_meal_status'] == "Partial"){
        $maize_meal_full_stock = $_POST['full_maize_meal_qty'];
        $maize_meal_partial_acceptable = $_POST['edited_maize_meal_qty'];
        $maize_meal_rejected_stock = $maize_meal_full_stock - $maize_meal_partial_acceptable;
        completeDelivery($_POST['maize_meal_id'], $unique_code, $maize_meal_partial_acceptable);
        rejectDelivery($_POST['maize_meal_id'], $unique_code, $_POST['rejected_maize_meal'], $maize_meal_rejected_stock);
      } 
    
      if ($_POST['rice_status'] == "Complete"){
        completeDelivery($_POST['rice_id'], $unique_code, $_POST['full_rice_qty']);
      } else if ($_POST['rice_status'] == "Rejected"){
        rejectDelivery($_POST['rice_id'], $unique_code, $_POST['rejected_rice'], $_POST['full_rice_qty']);
      } else if ($_POST['rice_status'] == "Partial"){
        $rice_full_stock = $_POST['full_rice_qty'];
        $rice_partial_acceptable = $_POST['edited_rice_qty'];
        $rice_rejected_stock = $rice_full_stock - $rice_partial_acceptable;
        completeDelivery($_POST['rice_id'], $unique_code, $rice_partial_acceptable);
        rejectDelivery($_POST['rice_id'], $unique_code, $_POST['rejected_rice'], $rice_rejected_stock);
      }       
    
      if ($_POST['sugar_status'] == "Complete"){
        completeDelivery($_POST['sugar_id'], $unique_code, $_POST['full_sugar_qty']);
      } else if ($_POST['sugar_status'] == "Rejected"){
        rejectDelivery($_POST['sugar_id'], $unique_code, $_POST['rejected_sugar'], $_POST['full_sugar_qty']);
      } else if ($_POST['sugar_status'] == "Partial"){
        $sugar_full_stock = $_POST['full_sugar_qty'];
        $sugar_partial_acceptable = $_POST['edited_sugar_qty'];
        $sugar_rejected_stock = $sugar_full_stock - $sugar_partial_acceptable;
        completeDelivery($_POST['sugar_id'], $unique_code, $sugar_partial_acceptable);
        rejectDelivery($_POST['sugar_id'], $unique_code, $_POST['rejected_sugar'], $sugar_rejected_stock);
      }       
    
      if ($_POST['cooking_oil_status'] == "Complete"){
        completeDelivery($_POST['cooking_oil_id'], $unique_code, $_POST['full_cooking_oil_qty']);
      } else if ($_POST['cooking_oil_status'] == "Rejected"){
        rejectDelivery($_POST['cooking_oil_id'], $unique_code, $_POST['rejected_cooking_oil'], $_POST['full_cooking_oil_qty']);
      } else if ($_POST['cooking_oil_status'] == "Partial"){
        $cooking_oil_full_stock = $_POST['full_cooking_oil_qty'];
        $cooking_oil_partial_acceptable = $_POST['edited_cooking_oil_qty'];
        $cooking_oil_rejected_stock = $cooking_oil_full_stock - $cooking_oil_partial_acceptable;
        completeDelivery($_POST['cooking_oil_id'], $unique_code, $cooking_oil_partial_acceptable);
        rejectDelivery($_POST['cooking_oil_id'], $unique_code, $_POST['rejected_cooking_oil'], $cooking_oil_rejected_stock);
      }       
          
      if ($_POST['tea_status'] == "Complete"){
        completeDelivery($_POST['tea_id'], $unique_code, $_POST['full_tea_qty']);
      } else if ($_POST['tea_status'] == "Rejected"){
        rejectDelivery($_POST['tea_id'], $unique_code, $_POST['rejected_tea'], $_POST['full_tea_qty']);
      } else if ($_POST['tea_status'] == "Partial"){
        $tea_full_stock = $_POST['full_tea_qty'];
        $tea_partial_acceptable = $_POST['edited_tea_qty'];
        $tea_rejected_stock = $tea_full_stock - $tea_partial_acceptable;
        completeDelivery($_POST['tea_id'], $unique_code, $tea_partial_acceptable);
        rejectDelivery($_POST['tea_id'], $unique_code, $_POST['rejected_tea'], $tea_rejected_stock);
      } 
          
      if ($_POST['baked_beans_status'] == "Complete"){
        completeDelivery($_POST['baked_beans_id'], $unique_code, $_POST['full_baked_beans_qty']);
      } else if ($_POST['baked_beans_status'] == "Rejected"){
        rejectDelivery($_POST['baked_beans_id'], $unique_code, $_POST['rejected_baked_beans'], $_POST['full_baked_beans_qty']);
      } else if ($_POST['baked_beans_status'] == "Partial"){
        $baked_beans_full_stock = $_POST['full_baked_beans_qty'];
        $baked_beans_partial_acceptable = $_POST['edited_baked_beans_qty'];
        $baked_beans_rejected_stock = $baked_beans_full_stock - $baked_beans_partial_acceptable;
        completeDelivery($_POST['baked_beans_id'], $unique_code, $baked_beans_partial_acceptable);
        rejectDelivery($_POST['baked_beans_id'], $unique_code, $_POST['rejected_baked_beans'], $baked_beans_rejected_stock);
      } 
          
      if ($_POST['soap_status'] == "Complete"){
        completeDelivery($_POST['soap_id'], $unique_code, $_POST['full_soap_qty']);
      } else if ($_POST['soap_status'] == "Rejected"){
        rejectDelivery($_POST['soap_id'], $unique_code, $_POST['rejected_soap'], $_POST['full_soap_qty']);
      } else if ($_POST['soap_status'] == "Partial"){
        $soap_full_stock = $_POST['full_soap_qty'];
        $soap_partial_acceptable = $_POST['edited_soap_qty'];
        $soap_rejected_stock = $soap_full_stock - $soap_partial_acceptable;
        completeDelivery($_POST['soap_id'], $unique_code, $soap_partial_acceptable);
        rejectDelivery($_POST['soap_id'], $unique_code, $_POST['rejected_soap'], $soap_rejected_stock);
      } 
    
      if ($_POST['soya_mince_status'] == "Complete"){
        completeDelivery($_POST['soya_mince_id'], $unique_code, $_POST['full_soya_mince_qty']);
      } else if ($_POST['soya_mince_status'] == "Rejected"){
        rejectDelivery($_POST['soya_mince_id'], $unique_code, $_POST['rejected_soya_mince'], $_POST['full_soya_mince_qty']);
      } else if ($_POST['soya_mince_status'] == "Partial"){
        $soya_mince_full_stock = $_POST['full_soya_mince_qty'];
        $soya_mince_partial_acceptable = $_POST['edited_soya_mince_qty'];
        $soya_mince_rejected_stock = $soya_mince_full_stock - $soya_mince_partial_acceptable;
        completeDelivery($_POST['soya_mince_id'], $unique_code, $soya_mince_partial_acceptable);
        rejectDelivery($_POST['soya_mince_id'], $unique_code, $_POST['rejected_soya_mince'], $soya_mince_rejected_stock);
      } 


      if ($_POST['pumkin_status'] == "Complete"){
        completeDelivery($_POST['pumpkin_id'], $unique_code, $_POST['full_pumkin_qty']);
      } else if ($_POST['pumkin_status'] == "Rejected"){
        rejectDelivery($_POST['pumpkin_id'], $unique_code, $_POST['rejected_pumkin'], $_POST['full_pumkin_qty']);
      } else if ($_POST['pumkin_status'] == "Partial"){
        $pumkin_full_stock = $_POST['full_pumkin_qty'];
        $pumkin_partial_acceptable = $_POST['edited_pumkin_qty'];
        $pumkin_rejected_stock = $pumkin_full_stock - $pumkin_partial_acceptable;
        completeDelivery($_POST['pumpkin_id'], $unique_code, $pumkin_partial_acceptable);
        rejectDelivery($_POST['pumpkin_id'], $unique_code, $_POST['rejected_pumkin'], $pumkin_rejected_stock);
      } 
    
    
      if ($_POST['potatoes_status'] == "Complete"){
        completeDelivery($_POST['potatoes_id'], $unique_code, $_POST['full_potatoes_qty']);
      } else if ($_POST['potatoes_status'] == "Rejected"){
        rejectDelivery($_POST['potatoes_id'], $unique_code, $_POST['rejected_potatoes'], $_POST['full_potatoes_qty']);
      } else if ($_POST['potatoes_status'] == "Partial"){
        $potatoes_full_stock = $_POST['full_potatoes_qty'];
        $potatoes_partial_acceptable = $_POST['edited_potatoes_qty'];
        $potatoes_rejected_stock = $potatoes_full_stock - $potatoes_partial_acceptable;
        completeDelivery($_POST['potatoes_id'], $unique_code, $potatoes_partial_acceptable);
        rejectDelivery($_POST['potatoes_id'], $unique_code, $_POST['rejected_potatoes'], $potatoes_rejected_stock);
      } 

    
      if ($_POST['cabbage_status'] == "Complete"){
        completeDelivery($_POST['cabbage_id'], $unique_code, $_POST['full_cabbage_qty']);
      } else if ($_POST['cabbage_status'] == "Rejected"){
        rejectDelivery($_POST['cabbage_id'], $unique_code, $_POST['rejected_cabbage'], $_POST['full_cabbage_qty']);
      } else if ($_POST['cabbage_status'] == "Partial"){
        $cabbage_full_stock = $_POST['full_cabbage_qty'];
        $cabbage_partial_acceptable = $_POST['edited_cabbage_qty'];
        $cabbage_rejected_stock = $cabbage_full_stock - $cabbage_partial_acceptable;
        completeDelivery($_POST['cabbage_id'], $unique_code, $cabbage_partial_acceptable);
        rejectDelivery($_POST['cabbage_id'], $unique_code, $_POST['rejected_cabbage'], $cabbage_rejected_stock);
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
          setInterval(function(){ countdown(); },2000);
          </script>'";   
   

    }

?>

<script type="text/javascript">

  function showEditPumkinField() {

    var noOption = document.getElementById("pumkin_status").value;

    if (noOption == "Partial"){


      jQuery('#pumkin-readonly').hide();
      document.getElementById("pumkin-readonly").style.visibility = 'hidden';

      jQuery('#pumkin-edit').show();
      document.getElementById("pumkin-edit").style.visibility = 'visible';

      jQuery('#pumkin-rejected-notes').show();
      document.getElementById("rejected-notes").style.visibility = 'visible';
            
    } else if (noOption == "Rejected"){

      jQuery('#pumkin-rejected-notes').show();
      document.getElementById("rejected-notes").style.visibility = 'visible';

      jQuery('#pumkin-readonly').show();
      document.getElementById("pumkin-readonly").style.visibility = 'visible';

      jQuery('#pumkin-edit').hide();
      document.getElementById("pumkin-edit").style.visibility = 'hidden';   

    
    } else {

      jQuery('#pumkin-readonly').show();
      document.getElementById("pumkin-readonly").style.visibility = 'visible';

      jQuery('#pumkin-edit').hide();
      document.getElementById("pumkin-edit").style.visibility = 'hidden';      

      jQuery('#pumkin-rejected-notes').hide();
      document.getElementById("rejected-notes").style.visibility = 'hidden';

    }
    
  }

  function showEditPotatoesField() {

    var noOption = document.getElementById("potatoes_status").value;

    if (noOption == "Partial"){


      jQuery('#potatoes-readonly').hide();
      document.getElementById("potatoes-readonly").style.visibility = 'hidden';

      jQuery('#potatoes-edit').show();
      document.getElementById("potatoes-edit").style.visibility = 'visible';

      jQuery('#potatoes-rejected-notes').show();
      document.getElementById("rejected-notes").style.visibility = 'visible';
            
    } else if (noOption == "Rejected"){

      jQuery('#potatoes-rejected-notes').show();
      document.getElementById("rejected-notes").style.visibility = 'visible';

      jQuery('#potatoes-readonly').show();
      document.getElementById("potatoes-readonly").style.visibility = 'visible';

      jQuery('#potatoes-edit').hide();
      document.getElementById("potatoes-edit").style.visibility = 'hidden';   

    
    } else {

      jQuery('#potatoes-readonly').show();
      document.getElementById("potatoes-readonly").style.visibility = 'visible';

      jQuery('#potatoes-edit').hide();
      document.getElementById("potatoes-edit").style.visibility = 'hidden';      

      jQuery('#potatoes-rejected-notes').hide();
      document.getElementById("rejected-notes").style.visibility = 'hidden';

    }
    
  } 

      function showEditCabbageField() {

      var noOption = document.getElementById("cabbage_status").value;

      if (noOption == "Partial"){


        jQuery('#cabbage-readonly').hide();
        document.getElementById("cabbage-readonly").style.visibility = 'hidden';

        jQuery('#cabbage-edit').show();
        document.getElementById("cabbage-edit").style.visibility = 'visible';

        jQuery('#cabbage-rejected-notes').show();
        document.getElementById("rejected-notes").style.visibility = 'visible';
              
      } else if (noOption == "Rejected"){

        jQuery('#cabbage-rejected-notes').show();
        document.getElementById("rejected-notes").style.visibility = 'visible';

        jQuery('#cabbage-readonly').show();
        document.getElementById("cabbage-readonly").style.visibility = 'visible';

        jQuery('#cabbage-edit').hide();
        document.getElementById("cabbage-edit").style.visibility = 'hidden';   

      
      } else {

        jQuery('#cabbage-readonly').show();
        document.getElementById("cabbage-readonly").style.visibility = 'visible';

        jQuery('#cabbage-edit').hide();
        document.getElementById("cabbage-edit").style.visibility = 'hidden';      

        jQuery('#cabbage-rejected-notes').hide();
        document.getElementById("rejected-notes").style.visibility = 'hidden';

      }
      
    }

  function showEditSoyaMinceField() {

    var noOption = document.getElementById("soya_mince_status").value;

    if (noOption == "Partial"){


      jQuery('#soya_mince-readonly').hide();
      document.getElementById("soya_mince-readonly").style.visibility = 'hidden';

      jQuery('#soya_mince-edit').show();
      document.getElementById("soya_mince-edit").style.visibility = 'visible';

      jQuery('#soya_mince-rejected-notes').show();
      document.getElementById("rejected-notes").style.visibility = 'visible';
            
    } else if (noOption == "Rejected"){

      jQuery('#soya_mince-rejected-notes').show();
      document.getElementById("rejected-notes").style.visibility = 'visible';

      jQuery('#soya_mince-readonly').show();
      document.getElementById("soya_mince-readonly").style.visibility = 'visible';

      jQuery('#soya_mince-edit').hide();
      document.getElementById("soya_mince-edit").style.visibility = 'hidden';   

    
    } else {

      jQuery('#soya_mince-readonly').show();
      document.getElementById("soya_mince-readonly").style.visibility = 'visible';

      jQuery('#soya_mince-edit').hide();
      document.getElementById("soya_mince-edit").style.visibility = 'hidden';      

      jQuery('#soya_mince-rejected-notes').hide();
      document.getElementById("rejected-notes").style.visibility = 'hidden';

    }
    
  } 
  
  
  function showEditSoapField() {

    var noOption = document.getElementById("soap_status").value;

    if (noOption == "Partial"){


      jQuery('#soap-readonly').hide();
      document.getElementById("soap-readonly").style.visibility = 'hidden';

      jQuery('#soap-edit').show();
      document.getElementById("soap-edit").style.visibility = 'visible';

      jQuery('#soap-rejected-notes').show();
      document.getElementById("rejected-notes").style.visibility = 'visible';
            
    } else if (noOption == "Rejected"){

      jQuery('#soap-rejected-notes').show();
      document.getElementById("rejected-notes").style.visibility = 'visible';

      jQuery('#soap-readonly').show();
      document.getElementById("soap-readonly").style.visibility = 'visible';

      jQuery('#soap-edit').hide();
      document.getElementById("soap-edit").style.visibility = 'hidden';   

    
    } else {

      jQuery('#soap-readonly').show();
      document.getElementById("soap-readonly").style.visibility = 'visible';

      jQuery('#soap-edit').hide();
      document.getElementById("soap-edit").style.visibility = 'hidden';      

      jQuery('#soap-rejected-notes').hide();
      document.getElementById("rejected-notes").style.visibility = 'hidden';

    }
    
  }

  function showEditBakedBeansField() {

    var noOption = document.getElementById("baked_beans_status").value;

    if (noOption == "Partial"){


      jQuery('#baked_beans-readonly').hide();
      document.getElementById("baked_beans-readonly").style.visibility = 'hidden';

      jQuery('#baked_beans-edit').show();
      document.getElementById("baked_beans-edit").style.visibility = 'visible';

      jQuery('#baked_beans-rejected-notes').show();
      document.getElementById("rejected-notes").style.visibility = 'visible';
            
    } else if (noOption == "Rejected"){

      jQuery('#baked_beans-rejected-notes').show();
      document.getElementById("rejected-notes").style.visibility = 'visible';

      jQuery('#baked_beans-readonly').show();
      document.getElementById("baked_beans-readonly").style.visibility = 'visible';

      jQuery('#baked_beans-edit').hide();
      document.getElementById("baked_beans-edit").style.visibility = 'hidden';   

    
    } else {

      jQuery('#baked_beans-readonly').show();
      document.getElementById("baked_beans-readonly").style.visibility = 'visible';

      jQuery('#baked_beans-edit').hide();
      document.getElementById("baked_beans-edit").style.visibility = 'hidden';      

      jQuery('#baked_beans-rejected-notes').hide();
      document.getElementById("rejected-notes").style.visibility = 'hidden';

    }
    
  } 
  
    function showEditTeaField() {

    var noOption = document.getElementById("tea_status").value;

    if (noOption == "Partial"){


      jQuery('#tea-readonly').hide();
      document.getElementById("tea-readonly").style.visibility = 'hidden';

      jQuery('#tea-edit').show();
      document.getElementById("tea-edit").style.visibility = 'visible';

      jQuery('#tea-rejected-notes').show();
      document.getElementById("rejected-notes").style.visibility = 'visible';
            
    } else if (noOption == "Rejected"){

      jQuery('#tea-rejected-notes').show();
      document.getElementById("rejected-notes").style.visibility = 'visible';

      jQuery('#tea-readonly').show();
      document.getElementById("tea-readonly").style.visibility = 'visible';

      jQuery('#tea-edit').hide();
      document.getElementById("tea-edit").style.visibility = 'hidden';   

    
    } else {

      jQuery('#tea-readonly').show();
      document.getElementById("tea-readonly").style.visibility = 'visible';

      jQuery('#tea-edit').hide();
      document.getElementById("tea-edit").style.visibility = 'hidden';      

      jQuery('#tea-rejected-notes').hide();
      document.getElementById("rejected-notes").style.visibility = 'hidden';

    }
    
  }


  function showEditCookingOilField() {

var noOption = document.getElementById("cooking_oil_status").value;

if (noOption == "Partial"){


  jQuery('#cooking_oil-readonly').hide();
  document.getElementById("cooking_oil-readonly").style.visibility = 'hidden';

  jQuery('#cooking_oil-edit').show();
  document.getElementById("cooking_oil-edit").style.visibility = 'visible';

  jQuery('#cooking_oil-rejected-notes').show();
  document.getElementById("rejected-notes").style.visibility = 'visible';
        
} else if (noOption == "Rejected"){

  jQuery('#cooking_oil-rejected-notes').show();
  document.getElementById("rejected-notes").style.visibility = 'visible';

  jQuery('#cooking_oil-readonly').show();
  document.getElementById("cooking_oil-readonly").style.visibility = 'visible';

  jQuery('#cooking_oil-edit').hide();
  document.getElementById("cooking_oil-edit").style.visibility = 'hidden';   


} else {

  jQuery('#cooking_oil-readonly').show();
  document.getElementById("cooking_oil-readonly").style.visibility = 'visible';

  jQuery('#cooking_oil-edit').hide();
  document.getElementById("cooking_oil-edit").style.visibility = 'hidden';      

  jQuery('#cooking_oil-rejected-notes').hide();
  document.getElementById("rejected-notes").style.visibility = 'hidden';

}

} 


function showEditSugarField() {

var noOption = document.getElementById("sugar_status").value;

if (noOption == "Partial"){


  jQuery('#sugar-readonly').hide();
  document.getElementById("sugar-readonly").style.visibility = 'hidden';

  jQuery('#sugar-edit').show();
  document.getElementById("sugar-edit").style.visibility = 'visible';

  jQuery('#sugar-rejected-notes').show();
  document.getElementById("rejected-notes").style.visibility = 'visible';
        
} else if (noOption == "Rejected"){

  jQuery('#sugar-rejected-notes').show();
  document.getElementById("rejected-notes").style.visibility = 'visible';

  jQuery('#sugar-readonly').show();
  document.getElementById("sugar-readonly").style.visibility = 'visible';

  jQuery('#sugar-edit').hide();
  document.getElementById("sugar-edit").style.visibility = 'hidden';   


} else {

  jQuery('#sugar-readonly').show();
  document.getElementById("sugar-readonly").style.visibility = 'visible';

  jQuery('#sugar-edit').hide();
  document.getElementById("sugar-edit").style.visibility = 'hidden';      

  jQuery('#sugar-rejected-notes').hide();
  document.getElementById("rejected-notes").style.visibility = 'hidden';

}

}


  function showEditRiceField() {

    var noOption = document.getElementById("rice_status").value;

    if (noOption == "Partial"){


      jQuery('#rice-readonly').hide();
      document.getElementById("rice-readonly").style.visibility = 'hidden';

      jQuery('#rice-edit').show();
      document.getElementById("rice-edit").style.visibility = 'visible';

      jQuery('#rice-rejected-notes').show();
      document.getElementById("rejected-notes").style.visibility = 'visible';
            
    } else if (noOption == "Rejected"){

      jQuery('#rice-rejected-notes').show();
      document.getElementById("rejected-notes").style.visibility = 'visible';

      jQuery('#rice-readonly').show();
      document.getElementById("rice-readonly").style.visibility = 'visible';

      jQuery('#rice-edit').hide();
      document.getElementById("rice-edit").style.visibility = 'hidden';   

    
    } else {

      jQuery('#rice-readonly').show();
      document.getElementById("rice-readonly").style.visibility = 'visible';

      jQuery('#rice-edit').hide();
      document.getElementById("rice-edit").style.visibility = 'hidden';      

      jQuery('#rice-rejected-notes').hide();
      document.getElementById("rejected-notes").style.visibility = 'hidden';

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
                    if (!empty($testing)) {
                      echo '<div class="alert alert-info">' . $testing . '</div>';
                    }                    
					        ?>
                </div>                


                <br><br>
          <div class="col-lg-12">
            <form action="" method="POST">
 
              <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body">
                      
                          <div class="row">
                              <div class="col-md-2">Response</div>
                              <div class="col-md-2">Stock Type</div>
                              <div class="col-md-4">Item Details</div>
                              <div class="col-md-2">Qty</div>
                              <div class="col-md-2">Expiry Date</div>
                          </div>


                          <?php
                              $api_url = $APIBASE."delivery_notice_exec.php?action=show_supplier_stock_detail&code=".$_GET['code']."";
                              $client = curl_init($api_url);
                              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                              $response = curl_exec($client);
                              $result = json_decode($response);

                              if(count($result) > 0)
                              {
                                foreach($result as $row)
                                {

                            ?>
                          <br>

                            <?php 
                            
                            if ($row->stock_name == "Maize Meal") { ?>
                            <div class="row">
                              <div class="col-md-2">
                                <div class="form-group">
                                  <select class="form-control" id="maize_meal_status" name="maize_meal_status"  onchange="showEditMaizeMealField(this.value)"  required>
                                    <option>Choose One</option>
                                    <option>Complete</option>
                                    <option>Rejected</option>
                                    <option>Partial</option>
                                  </select>
                                </div>
                              </div>  
                              <input type="hidden" class="form-control" id="maize_meal_id" name="maize_meal_id" value="<?php echo $row->stockdetail_id ?>" readonly>                        
                              <div class="col-md-2">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_type ?>" readonly>
                                </div>
                              </div>     
                              <div class="col-md-4">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                </div>
                              </div>
                              <div class="col-md-2" id="maize_meal-edit" style="display:none">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="edited_maize_meal_qty" name="edited_maize_meal_qty" value="0">
                                </div>
                              </div>  
                              <div class="col-md-2" id="maize_meal-readonly">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="full_maize_meal_qty" name="full_maize_meal_qty" value="<?php echo $row->stock_level_amount ?>" readonly>
                                </div>
                              </div>                                
                              <div class="col-md-2">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_exp_date ?>" readonly>
                                </div>
                              </div>   
                              <div class="col-md-12" id="maize_meal-rejected-notes" style="display:none">
                                <div class="form-group">
                                  <textarea class="form-control" id="rejected_maize_meal" name="rejected_maize_meal" placeholder="Enter Reason for rejecting the maize_meal stock"></textarea>
                                </div>
                              </div>                                                                                           
                            </div>
                          

                            <?php 
                              } 
                            ?>

                          <?php 
                            
                            if ($row->stock_name == "Rice") { ?>
                            <div class="row">
                              <div class="col-md-2">
                                <div class="form-group">
                                  <select class="form-control" id="rice_status" name="rice_status"  onchange="showEditRiceField(this.value)"  required>
                                    <option>Choose One</option>
                                    <option>Complete</option>
                                    <option>Rejected</option>
                                    <option>Partial</option>
                                  </select>
                                </div>
                              </div>
                              <input type="hidden" class="form-control" id="rice_id" name="rice_id" value="<?php echo $row->stockdetail_id ?>" readonly>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_type ?>" readonly>
                                </div>
                              </div>     
                              <div class="col-md-4">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                </div>
                              </div>
                              <div class="col-md-2" id="rice-edit" style="display:none">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="edited_rice_qty" name="edited_rice_qty" value="0">
                                </div>
                              </div>  
                              <div class="col-md-2" id="rice-readonly">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="full_rice_qty" name="full_rice_qty" value="<?php echo $row->stock_level_amount ?>" readonly>
                                </div>
                              </div>                                
                              <div class="col-md-2">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_exp_date ?>" readonly>
                                </div>
                              </div>   
                              <div class="col-md-12" id="rice-rejected-notes" style="display:none">
                                <div class="form-group">
                                  <textarea class="form-control" id="rejected_rice" name="rejected_rice" placeholder="Enter Reason for rejecting the rice stock"></textarea>
                                </div>
                              </div>                                                                                           
                            </div>
                          
                            <?php 
                              } 
                            ?>

                          <?php 
                            
                            if ($row->stock_name == "Sugar") { ?>
                            <div class="row">
                              <div class="col-md-2">
                                <div class="form-group">
                                  <select class="form-control" id="sugar_status" name="sugar_status"  onchange="showEditSugarField(this.value)"  required>
                                    <option>Choose One</option>
                                    <option>Complete</option>
                                    <option>Rejected</option>
                                    <option>Partial</option>
                                  </select>
                                </div>
                              </div>
                              <input type="hidden" class="form-control" id="sugar_id" name="sugar_id" value="<?php echo $row->stockdetail_id ?>" readonly>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_type ?>" readonly>
                                </div>
                              </div>     
                              <div class="col-md-4">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                </div>
                              </div>
                              <div class="col-md-2" id="sugar-edit" style="display:none">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="edited_sugar_qty" name="edited_sugar_qty" value="0">
                                </div>
                              </div>  
                              <div class="col-md-2" id="sugar-readonly">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="full_sugar_qty" name="full_sugar_qty" value="<?php echo $row->stock_level_amount ?>" readonly>
                                </div>
                              </div>                                
                              <div class="col-md-2">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_exp_date ?>" readonly>
                                </div>
                              </div>   
                              <div class="col-md-12" id="sugar-rejected-notes" style="display:none">
                                <div class="form-group">
                                  <textarea class="form-control" id="rejected_sugar" name="rejected_sugar" placeholder="Enter Reason for rejecting the sugar stock"></textarea>
                                </div>
                              </div>                                                                                           
                            </div>
                          

                            <?php 
                              } 
                            ?>                          

                          <?php 
                            
                            if ($row->stock_name == "Cooking Oil") { ?>
                            <div class="row">
                              <div class="col-md-2">
                                <div class="form-group">
                                  <select class="form-control" id="cooking_oil_status" name="cooking_oil_status"  onchange="showEditCookingOilField(this.value)"  required>
                                    <option>Choose One</option>
                                    <option>Complete</option>
                                    <option>Rejected</option>
                                    <option>Partial</option>
                                  </select>
                                </div>
                              </div>  
                              <input type="hidden" class="form-control" id="cooking_oil_id" name="cooking_oil_id" value="<?php echo $row->stockdetail_id ?>" readonly>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_type ?>" readonly>
                                </div>
                              </div>     
                              <div class="col-md-4">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                </div>
                              </div>
                              <div class="col-md-2" id="cooking_oil-edit" style="display:none">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="edited_cooking_oil_qty" name="edited_cooking_oil_qty" value="0">
                                </div>
                              </div>  
                              <div class="col-md-2" id="cooking_oil-readonly">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="full_cooking_oil_qty" name="full_cooking_oil_qty" value="<?php echo $row->stock_level_amount ?>" readonly>
                                </div>
                              </div>                                
                              <div class="col-md-2">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_exp_date ?>" readonly>
                                </div>
                              </div>   
                              <div class="col-md-12" id="cooking_oil-rejected-notes" style="display:none">
                                <div class="form-group">
                                  <textarea class="form-control" id="rejected_cooking_oil" name="rejected_cooking_oil" placeholder="Enter Reason for rejecting the cooking_oil stock"></textarea>
                                </div>
                              </div>                                                                                           
                            </div>
                          

                            <?php 
                              } 
                            ?>                          

                          <?php 
                            
                            if ($row->stock_name == "Tea") { ?>
                            <div class="row">
                              <div class="col-md-2">
                                <div class="form-group">
                                  <select class="form-control" id="tea_status" name="tea_status"  onchange="showEditTeaField(this.value)"  required>
                                    <option>Choose One</option>
                                    <option>Complete</option>
                                    <option>Rejected</option>
                                    <option>Partial</option>
                                  </select>
                                </div>
                              </div>
                              <input type="hidden" class="form-control" id="tea_id" name="tea_id" value="<?php echo $row->stockdetail_id ?>" readonly>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_type ?>" readonly>
                                </div>
                              </div>     
                              <div class="col-md-4">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                </div>
                              </div>
                              <div class="col-md-2" id="tea-edit" style="display:none">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="edited_tea_qty" name="edited_tea_qty" value="0">
                                </div>
                              </div>  
                              <div class="col-md-2" id="tea-readonly">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="full_tea_qty" name="full_tea_qty" value="<?php echo $row->stock_level_amount ?>" readonly>
                                </div>
                              </div>                                
                              <div class="col-md-2">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_exp_date ?>" readonly>
                                </div>
                              </div>   
                              <div class="col-md-12" id="tea-rejected-notes" style="display:none">
                                <div class="form-group">
                                  <textarea class="form-control" id="rejected_tea" name="rejected_tea" placeholder="Enter Reason for rejecting the tea stock"></textarea>
                                </div>
                              </div>                                                                                           
                            </div>
                          

                            <?php 
                              } 
                            ?>

                          <?php 
                            
                            if ($row->stock_name == "Baked Beans") { ?>
                            <div class="row">
                              <div class="col-md-2">
                                <div class="form-group">
                                  <select class="form-control" id="baked_beans_status" name="baked_beans_status"  onchange="showEditBakedBeansField(this.value)"  required>
                                    <option>Choose One</option>
                                    <option>Complete</option>
                                    <option>Rejected</option>
                                    <option>Partial</option>
                                  </select>
                                </div>
                              </div>
                              <input type="hidden" class="form-control" id="baked_beans_id" name="baked_beans_id" value="<?php echo $row->stockdetail_id ?>" readonly>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_type ?>" readonly>
                                </div>
                              </div>     
                              <div class="col-md-4">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                </div>
                              </div>
                              <div class="col-md-2" id="baked_beans-edit" style="display:none">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="edited_baked_beans_qty" name="edited_baked_beans_qty" value="0">
                                </div>
                              </div>  
                              <div class="col-md-2" id="baked_beans-readonly">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="full_baked_beans_qty" name="full_baked_beans_qty" value="<?php echo $row->stock_level_amount ?>" readonly>
                                </div>
                              </div>                                
                              <div class="col-md-2">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_exp_date ?>" readonly>
                                </div>
                              </div>   
                              <div class="col-md-12" id="baked_beans-rejected-notes" style="display:none">
                                <div class="form-group">
                                  <textarea class="form-control" id="rejected_baked_beans" name="rejected_baked_beans" placeholder="Enter Reason for rejecting the baked_beans stock"></textarea>
                                </div>
                              </div>                                                                                           
                            </div>
                          

                            <?php 
                              } 
                            ?>

                          <?php 
                            
                            if ($row->stock_name == "All Purpose Soap") { ?>
                            <div class="row">
                              <div class="col-md-2">
                                <div class="form-group">
                                  <select class="form-control" id="soap_status" name="soap_status"  onchange="showEditSoapField(this.value)"  required>
                                    <option>Choose One</option>
                                    <option>Complete</option>
                                    <option>Rejected</option>
                                    <option>Partial</option>
                                  </select>
                                </div>
                              </div>
                              <input type="hidden" class="form-control" id="soap_id" name="soap_id" value="<?php echo $row->stockdetail_id ?>" readonly>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_type ?>" readonly>
                                </div>
                              </div>     
                              <div class="col-md-4">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                </div>
                              </div>
                              <div class="col-md-2" id="soap-edit" style="display:none">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="edited_soap_qty" name="edited_soap_qty" value="0">
                                </div>
                              </div>  
                              <div class="col-md-2" id="soap-readonly">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="full_soap_qty" name="full_soap_qty" value="<?php echo $row->stock_level_amount ?>" readonly>
                                </div>
                              </div>                                
                              <div class="col-md-2">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_exp_date ?>" readonly>
                                </div>
                              </div>   
                              <div class="col-md-12" id="soap-rejected-notes" style="display:none">
                                <div class="form-group">
                                  <textarea class="form-control" id="rejected_soap" name="rejected_soap" placeholder="Enter Reason for rejecting the soap stock"></textarea>
                                </div>
                              </div>                                                                                           
                            </div>
                          

                            <?php 
                              } 
                            ?>


                            <?php 
                            
                            if ($row->stock_name == "Soya Mince") { ?>
                            <div class="row">
                              <div class="col-md-2">
                                <div class="form-group">
                                  <select class="form-control" id="soya_mince_status" name="soya_mince_status"  onchange="showEditSoyaMinceField(this.value)"  required>
                                    <option>Choose One</option>
                                    <option>Complete</option>
                                    <option>Rejected</option>
                                    <option>Partial</option>
                                  </select>
                                </div>
                              </div>
                              <input type="hidden" class="form-control" id="soya_mince_id" name="soya_mince_id" value="<?php echo $row->stockdetail_id ?>" readonly>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_type ?>" readonly>
                                </div>
                              </div>     
                              <div class="col-md-4">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                </div>
                              </div>
                              <div class="col-md-2" id="soya_mince-edit" style="display:none">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="edited_soya_mince_qty" name="edited_soya_mince_qty" value="0">
                                </div>
                              </div>  
                              <div class="col-md-2" id="soya_mince-readonly">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="full_soya_mince_qty" name="full_soya_mince_qty" value="<?php echo $row->stock_level_amount ?>" readonly>
                                </div>
                              </div>                                
                              <div class="col-md-2">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_exp_date ?>" readonly>
                                </div>
                              </div>   
                              <div class="col-md-12" id="soya_mince-rejected-notes" style="display:none">
                                <div class="form-group">
                                  <textarea class="form-control" id="rejected_soya_mince" name="rejected_soya_mince" placeholder="Enter Reason for rejecting the soya_mince stock"></textarea>
                                </div>
                              </div>                                                                                           
                            </div>
                          

                            <?php 
                              } 
                            ?>

                            <?php 
                            
                            if ($row->stock_name == "Cabbage") { ?>
                            <div class="row">
                              <div class="col-md-2">
                                <div class="form-group">
                                  <select class="form-control" id="cabbage_status" name="cabbage_status"  onchange="showEditCabbageField(this.value)"  required>
                                    <option>Choose One</option>
                                    <option>Complete</option>
                                    <option>Rejected</option>
                                    <option>Partial</option>
                                  </select>
                                </div>
                              </div>
                              <input type="hidden" class="form-control" id="cabbage_id" name="cabbage_id" value="<?php echo $row->stockdetail_id ?>" readonly>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_type ?>" readonly>
                                </div>
                              </div>     
                              <div class="col-md-4">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                </div>
                              </div>
                              <div class="col-md-2" id="cabbage-edit" style="display:none">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="edited_cabbage_qty" name="edited_cabbage_qty" value="0">
                                </div>
                              </div>  
                              <div class="col-md-2" id="cabbage-readonly">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="full_cabbage_qty" name="full_cabbage_qty" value="<?php echo $row->stock_level_amount ?>" readonly>
                                </div>
                              </div>                                
                              <div class="col-md-2">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_exp_date ?>" readonly>
                                </div>
                              </div>   
                              <div class="col-md-12" id="cabbage-rejected-notes" style="display:none">
                                <div class="form-group">
                                  <textarea class="form-control" id="rejected_cabbage" name="rejected_cabbage" placeholder="Enter Reason for rejecting the cabbage stock"></textarea>
                                </div>
                              </div>                                                                                           
                            </div>
                          

                            <?php 
                              } 
                            ?>

                          <?php 
                            
                            if ($row->stock_name == "Potatoes") { ?>
                            <div class="row">
                              <div class="col-md-2">
                                <div class="form-group">
                                  <select class="form-control" id="potatoes_status" name="potatoes_status"  onchange="showEditPotatoesField(this.value)"  required>
                                    <option>Choose One</option>
                                    <option>Complete</option>
                                    <option>Rejected</option>
                                    <option>Partial</option>
                                  </select>
                                </div>
                              </div>
                              <input type="hidden" class="form-control" id="potatoes_id" name="potatoes_id" value="<?php echo $row->stockdetail_id ?>" readonly>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_type ?>" readonly>
                                </div>
                              </div>     
                              <div class="col-md-4">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                </div>
                              </div>
                              <div class="col-md-2" id="potatoes-edit" style="display:none">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="edited_potatoes_qty" name="edited_potatoes_qty" value="0">
                                </div>
                              </div>  
                              <div class="col-md-2" id="potatoes-readonly">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="full_potatoes_qty" name="full_potatoes_qty" value="<?php echo $row->stock_level_amount ?>" readonly>
                                </div>
                              </div>                                
                              <div class="col-md-2">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_exp_date ?>" readonly>
                                </div>
                              </div>   
                              <div class="col-md-12" id="potatoes-rejected-notes" style="display:none">
                                <div class="form-group">
                                  <textarea class="form-control" id="rejected_potatoes" name="rejected_potatoes" placeholder="Enter Reason for rejecting the potatoes stock"></textarea>
                                </div>
                              </div>                                                                                           
                            </div>
                          

                            <?php 
                              } 
                            ?>                          



                            <?php 
                            
                            if ($row->stock_name == "Pumpkin") { ?>
                            <div class="row">
                              <div class="col-md-2">
                                <div class="form-group">
                                  <select class="form-control" id="pumkin_status" name="pumkin_status"  onchange="showEditPumkinField(this.value)"  required>
                                    <option>Choose One</option>
                                    <option>Complete</option>
                                    <option>Rejected</option>
                                    <option>Partial</option>
                                  </select>
                                </div>
                              </div>
                              <input type="hidden" class="form-control" id="pumpkin_id" name="pumpkin_id" value="<?php echo $row->stockdetail_id ?>" readonly>
                              <div class="col-md-2">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_type ?>" readonly>
                                </div>
                              </div>     
                              <div class="col-md-4">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_name.', '.$row->stock_brand ?>" readonly>
                                </div>
                              </div>
                              <div class="col-md-2" id="pumkin-edit" style="display:none">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="edited_pumkin_qty" name="edited_pumkin_qty" value="0">
                                </div>
                              </div>  
                              <div class="col-md-2" id="pumkin-readonly">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="full_pumkin_qty" name="full_pumkin_qty" value="<?php echo $row->stock_level_amount ?>" readonly>
                                </div>
                              </div>                                
                              <div class="col-md-2">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="stock_type" name="stock_type" value="<?php echo $row->stock_exp_date ?>" readonly>
                                </div>
                              </div>   
                              <div class="col-md-12" id="pumkin-rejected-notes" style="display:none">
                                <div class="form-group">
                                  <textarea class="form-control" id="rejected_pumkin" name="rejected_pumkin" placeholder="Enter Reason for rejecting the pumkin stock"></textarea>
                                </div>
                              </div>                                                                                           
                            </div>
                          

                            <?php 
                              } 
                            ?>


                          <?php 
                                }
                              } 

                          ?>

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
                  </div>
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


