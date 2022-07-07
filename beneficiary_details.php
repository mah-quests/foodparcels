<?php

  include("config/connect.php");

  error_reporting(0);
  session_start();

  if(isset($_POST['submit'])) 
  {

      // Get the total number of beneficiaries from a head of household reference
      $api_url = $APIBASE."beneficiary_details_exec.php?action=get_total_beneficiaries_code&code=".$_GET['hoh_code']."";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      $result = json_decode($response);
  
      if(count($result) > 0){
        foreach($result as $row) {
  
          $total_beneficiaries = $row->total_beneficiaries;
  
        } 
      } 

      // Determine the number of food packs based on the number of beneficiaries in a household 
      
      if ($total_beneficiaries >= 0 && $total_beneficiaries < 6){
        
        $no_foodpacks_given = 1; 

      } else if ($total_beneficiaries > 5 && $total_beneficiaries < 11){
        
        $no_foodpacks_given = 2; 

      } else if ($total_beneficiaries > 10 && $total_beneficiaries < 16){
        
        $no_foodpacks_given = 3; 

      } else if ($total_beneficiaries > 15 && $total_beneficiaries < 21){
        
        $no_foodpacks_given = 4; 

      }

      // Get the head of household ID Number, to update the food pack details 
      $api_url = $APIBASE."beneficiary_details_exec.php?action=show_headofhousehold_detail&code=".$_GET['hoh_code']."";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      $result = json_decode($response);
  
      if(count($result) > 0){
        foreach($result as $row) {
  
          $id_number = $row->id_number;
          $current_delivery_times = $row->no_delivery_times;
  
        } 
      } 

      // Add the beneficiary and food pack details to a 'food_parcel_delivery_tbl'
      $allocate_pack_beneficiary_data = array(
        'foodpack_code' => $_GET['foodparcel'],
        'headofhousehold_code' => $_GET['hoh_code'],
        'number_of_parcels' => $no_foodpacks_given,
        'region' => $_POST['district'],
        'user_id'  => "0"
      );
    
      $api_url = $APIBASE."foodpack_exec.php?action=allocate_foodpack_household";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $allocate_pack_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true); 

      if($current_delivery_times < 3){
        $delivery_state = "delivered";
        $state = "Delivered";
      } else if($current_delivery_times > 2){
        $delivery_state = "post-delivery";
        $state = "Post Delivery";
      }

      // Update the 'head_of_household_tbl' table, changing the status to delivered and food pack code 
      $add_pack_to_beneficiary = array(
        'unique_code' => $_GET['hoh_code'],
        'allocated' => $delivery_state,
        'allocated_ref' => $_GET['foodparcel']
      );
    
      $api_url = $APIBASE."foodpack_exec.php?action=update_headofhousehold_delivery_number";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $add_pack_to_beneficiary);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);       



      $foodpack_data = array(
        'unique_code' => $_GET['foodparcel'],
        'foodpack_state' => $state,
        'state' =>  $delivery_state,
    );

      $api_url = $APIBASE."foodpack_exec.php?action=update_foodpack_state";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $foodpack_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client); 


      // Update the 'packaged_foodpack_tbl' to upda the ID Nunber and Delivery code
      $foodpack_data = array(
        'unique_code' => $_GET['foodparcel'],
        'deliveredto_idnumber' => $id_number,
        'deliveredto_code' =>   $_GET['hoh_code']
    );

      $api_url = $APIBASE."foodpack_exec.php?action=update_foodpack_beneficiary";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $foodpack_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client); 


      $activities_data = array(
        'unique_code' => $_GET['foodparcel'],
        'action_performed' => "The head of household has successfully accepted the food parcel, ",
        'performed_by' => $id_number,
        'user_id'  => $id_number,
        'region' => $_POST['district'],
      );
    
      $api_url = $APIBASE."activity_notification_exec.php?action=add_user_activity";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $activities_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);       

      $success = "<br>Allocation successfully done! <p>You will be redirected in <span id='counter'>1</span> second(s).</p>
      <script type='text/javascript'>
          function countdown() {
            var i = document.getElementById('counter');
            if (parseInt(i.innerHTML)<=0) {
              location.href = 'foodpack.php';
            }
            i.innerHTML = parseInt(i.innerHTML)-1;
          }
          setInterval(function(){ countdown(); },1000);
          </script>'";   

  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>DSD - Department of Social Development </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />


</head>

<body>

  <div align="center">
    <img src="images/dsd-logo.png" alt="logo" width="20%">
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

  <br>
  <div class="col-12 grid-margin stretch-card" >
      <div class="card">
        <div class="card-body">
        <h4 class="card-title" align="center">Beneficiary Form Details</h4>
          <form action="" method="post" >

            <br><br>

            <?php
                $api_url = $APIBASE."beneficiary_details_exec.php?action=show_no_fb_staff_detail&code=".$_GET["hoh_code"]."";
                $client = curl_init($api_url);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                $result = json_decode($response);
                $output_fsq4 = '';

                if(count($result) > 0)
                {
                  foreach($result as $row)
                  {

              ?>
            
            <h6>
              <u>Profiler Details</u>
            </h6>

            <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="official_name">Name DSD official / CDW / Community leader</label>
                    <input type="text" class="form-control" id="official_name" name="official_name" value="<?php echo $row->official_name ?>" >
                  </div>
                </div>                            
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="date_reffered">Date Referred</label>
                    <input type="text" class="form-control" id="date_reffered" name="date_reffered" value="<?php echo $row->date_reffered ?>" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="referral_contact">Contact details of referral</label>
                    <input type="text" class="form-control" id="referral_contact" name="referral_contact"  value="<?php echo $row->referral_contact ?>" >
                  </div>
                </div>                            
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="referral_department">Referral Dept</label>
                    <input type="text" class="form-control" id="referral_department" name="referral_department" value="<?php echo $row->referral_department ?>" >
                  </div>
                </div>
              </div>                            
            
            <?php 
                  }
                }

                $api_url = $APIBASE."beneficiary_details_exec.php?action=show_headofhousehold_detail&code=".$_GET["hoh_code"]."";
                $client = curl_init($api_url);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                $result = json_decode($response);
                $output_fsq4 = '';

                if(count($result) > 0)
                {
                  foreach($result as $row)
                  {

            ?>

            <h6>
              <u>Head of household</u>
            </h6>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="first_name">First Names</label>
                  <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $row->first_name ?>" >
                </div>
              </div>                            
              <div class="col-md-6">
                <div class="form-group">
                  <label for="surname">Surname</label>
                  <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $row->surname ?>" >
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="id_number">South African ID Number / Date Of Birth</label>
                  <input type="text" class="form-control" id="id_number" name="id_number" value="<?php echo $row->id_number ?>" >
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="cellphone">Cellphone Number</label>
                  <input type="text" class="form-control" id="cellphone" name="cellphone" value="<?php echo $row->cellphone ?>" >
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                <label for="head_grant_type">Type of grant receiving</label>
                  <input type="text" class="form-control" id="head_grant_type" name="head_grant_type" value="<?php echo $row->head_grant_type ?>" >
                </div>
              </div>                            
            </div>                          
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                <label for="home_address">Home Address</label>
                  <input type="text" class="form-control" id="home_address" name="home_address" value="<?php echo $row->home_address ?>" >
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="ward_number">Ward Number</label>
                  <input type="text" class="form-control" id="ward_number" name="ward_number" value="<?php echo $row->ward_number ?>" >
                </div>
              </div>   
              <div class="col-md-2">
                <div class="form-group">
                  <label for="ward_code">Ward Code</label>
                  <input type="text" class="form-control" id="ward_code" name="ward_code" value="<?php echo $row->ward_code ?>" >
                </div>
              </div>  

              <div class="col-md-4">
                <div class="form-group">
                <label for="municipality">Province</label>
                  <input type="text" class="form-control" id="municipality" name="municipality" value="<?php echo $row->municipality ?>" >
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="district">District</label>
                  <input type="text" class="form-control" id="district" name="district" value="<?php echo $row->district ?>" >
                </div>
              </div>   
              <div class="col-md-4">
                <div class="form-group">
                  <label for="suburb">Suburb</label>
                  <input type="text" class="form-control" id="suburb" name="suburb" value="<?php echo $row->suburb ?>" >
                </div>
              </div>                               


            </div>  

            <h6>
              <u>Questions To Beneficiaries</u>
            </h6>
            <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                    <label for="other_help">Have you ever received help through SASSA, HBC or a clinic or Disaster mangement for food parcels or other relief in the last 3 mnths specify?</label>
                    <input type="text" class="form-control" id="other_help" name="other_help" value="<?php echo $row->other_help ?>" >
                  </div>
              </div>    
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="made_payment">Did you pay anyone for this food parcel?</label>
                    <input type="text" class="form-control" id="made_payment" name="made_payment" value="<?php echo $row->made_payment ?>" >
                  </div>
              </div>   
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="by_official">Were you promised a food parcel by an official or /other </label>
                    <input type="text" class="form-control" id="by_official" name="by_official" value="<?php echo $row->by_official ?>" >
                  </div>
              </div> 
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="paid_who">Who did you pay money to</label>
                    <input type="text" class="form-control" id="paid_who" name="paid_who" value="<?php echo $row->paid_who ?>" >
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="specify_other">Specify Other</label>
                    <input type="text" class="form-control" id="specify_other" name="specify_other" value="<?php echo $row->specify_other ?>" >
                  </div>
              </div>                                                            
                                      
            </div>


            <?php 
                  }
                }

            ?>


          <h6>
            <u>List Of Beneficiaries</u>
          </h6>
          <table class="table table-hover">
              <thead>
                <tr>
                  <th>Transaction</th>
                  <th>ID Number</th>
                  <th>Full Names</th>
                  <th>Relation</th>
                  <th>Gender </th>                                
                  <th>Grant Type</th>
                  <th>Disability</th>
                </tr>
              </thead>
              <tbody>

              <?php
                  $api_url = $APIBASE."beneficiary_details_exec.php?action=show_beneficiary_by_code&code=".$_GET["hoh_code"]."";
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
                      <td>'.$row->bnf_id.'</td>
                      <td>'.$row->id_number.'</td>
                      <td>'.$row->name.' '.$row->surname.'</td>
                      <td>'.$row->relation.'</td>
                      <td>'.$row->gender.'</td>
                      <td>'.$row->grant_type.'</td>
                      <td>'.$row->disabled.'</td>
                      </tr>
                      ';
                    }
                  }

                  echo $output;
              ?> 

              </tbody>
            </table>

            <br><br>

            <?php 

                $api_url = $APIBASE."beneficiary_details_exec.php?action=show_household_details_by_code&code=".$_GET["hoh_code"]."";
                $client = curl_init($api_url);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                $result = json_decode($response);
                $output_fsq4 = '';

                if(count($result) > 0)
                {
                  foreach($result as $row)
                  {

            ?>                          

            <h6>
              <u>Further Household Details</u>
            </h6>
            <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                  <label for="household_status">Status of Household</label>
                    <input type="text" class="form-control" id="household_status" name="household_status" value="<?php echo $row->household_status ?>" >
                  </div>
              </div>  
              <div class="col-md-4">
                  <div class="form-group">
                  <label for="ailments_mobilities">Ailments Addictions & Mobility </label>
                    <input type="text" class="form-control" id="ailments_mobilities" name="ailments_mobilities" value="<?php echo $row->ailments_mobilities ?>" >
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                  <label for="household_affected">Emergency: households affected</label>
                    <input type="text" class="form-control" id="household_affected" name="household_affected" value="<?php echo $row->household_affected ?>" >
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label for="no_sa_id">No. SA ID </label>
                  <input type="text" class="form-control" id="no_sa_id" name="no_sa_id"  value="<?php echo $row->no_sa_id ?>" >
                </div>
              </div>   
              <div class="col-md-2">
                <div class="form-group">
                  <label for="no_sa_passport">No. SA Passport </label>
                  <input type="text" class="form-control" id="no_sa_passport" name="no_sa_passport"  value="<?php echo $row->no_sa_passport ?>" >
                </div>
              </div>  
              <div class="col-md-2">
                <div class="form-group">
                  <label for="no_birth_certificate">No. Birth Certs</label>
                  <input type="text" class="form-control" id="no_birth_certificate" name="no_birth_certificate" value="<?php echo $row->no_birth_certificate ?>" >
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="country_of_origin">Country of origin</label>
                  <input type="text" class="form-control" id="country_of_origin" name="country_of_origin" value="<?php echo $row->country_of_origin ?>"  >
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="no_other_country_id">No. Other Country ID</label>
                  <input type="text" class="form-control" id="no_other_country_id" name="no_other_country_id"  value="<?php echo $row->no_other_country_id ?>" >
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="no_other_country_passport">No. Other Passport</label>
                  <input type="text" class="form-control" id="no_other_country_passport" name="no_other_country_passport"  value="<?php echo $row->no_other_country_passport ?>" >
                </div>
              </div>
            </div>   
            
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="household_employed">No. of employed in household</label>
                  <input type="text" class="form-control" name="household_employed"  id="household_employed"  value="<?php echo $row->household_employed ?>" >
                </div>
              </div>                            
              <div class="col-md-4">
                <div class="form-group">
                  <label for="school_upto_grade12">No. of formal schooled up to Grd 12</label>
                  <input type="text" class="form-control" id="school_upto_grade12" name="school_upto_grade12"  value="<?php echo $row->school_upto_grade12 ?>" >
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="people_need_skills">No. of people needing skills </label>
                  <input type="text" class="form-control" id="people_need_skills" name="people_need_skills"  value="<?php echo $row->people_need_skills ?>" >
                </div>
              </div>                            
            </div> 
            
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="earnings_income">Amount from Income Earnings</label>
                  <input type="text" class="form-control" name="earnings_income"  id="earnings_income"  value="<?php echo $row->earnings_income ?>" >
                </div>
              </div>                            
              <div class="col-md-4">
                <div class="form-group">
                  <label for="earnings_grant">Amount from Grants Earnings</label>
                  <input type="text" class="form-control" id="earnings_grant" name="earnings_grant"  value="<?php echo $row->earnings_grant ?>" >
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="earnings_other">Amount from Other Earnings</label>
                  <input type="text" class="form-control" id="earnings_other" name="earnings_other"   value="<?php echo $row->earnings_other ?>" >
                </div>
              </div>                            
            </div>                            


            <?php 
                  }
                }

            ?>                          
          
          <br>
          <h6>
            <u>List Of Change Agents</u>
          </h6>
          <table class="table table-hover">
              <thead>
                <tr>
                  <th>Transaction</th>
                  <th>ID Number</th>
                  <th>Full Names</th>
                  <th>Relation</th>
                  <th>Gender </th>                                
                  <th>Grant Type</th>
                  <th>Disability</th>
                </tr>
              </thead>
              <tbody>

              <?php
                  $api_url = $APIBASE."beneficiary_details_exec.php?action=show_change_agent_by_code&code=".$_GET["hoh_code"]."";
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
                      <td>'.$row->ca_id.'</td>
                      <td>'.$row->name.'</td>
                      <td>'.$row->contactnumber.'</td>
                      <td>'.$row->needs.'</td>
                      <td>'.$row->highest_skills.'</td>
                      <td>'.$row->workexperience.'</td>
                      <td>'.$row->careerpath.'</td>
                      </tr>
                      ';
                    }
                  }

                  echo $output;
              ?> 

              </tbody>
            </table>

            <br><br>

            <?php
                $api_url = $APIBASE."beneficiary_details_exec.php?action=show_development_officer_by_code&code=".$_GET["hoh_code"]."";
                $client = curl_init($api_url);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                $result = json_decode($response);
                $output_fsq4 = '';

                if(count($result) > 0)
                {
                  foreach($result as $row)
                  {

              ?>
            
            <h6>
              <u>Development Officer</u>
            </h6>  
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="dev_officer_name">Name of Development Officer</label>
                  <input type="text" class="form-control" name="dev_officer_name"  id="dev_officer_name"   value="<?php echo $row->dev_officer_name ?>" >
                </div>
              </div>                            
              <div class="col-md-4">
                <div class="form-group">
                  <label for="dev_officer_cellphone">Cell No of Development Officer</label>
                  <input type="text" class="form-control" id="dev_officer_cellphone" name="dev_officer_cellphone"   value="<?php echo $row->dev_officer_cellphone ?>" >
                </div>
              </div>                           
              <div class="col-md-4">
                <div class="form-group">
                  <label for="nearest_stakeholder">Nearest Stakeholder from Chng Agnt</label>
                  <input type="text" class="form-control" name="nearest_stakeholder"  id="nearest_stakeholder"   value="<?php echo $row->nearest_stakeholder ?>" >
                </div>
              </div> 
            </div>

            <input type="hidden" class="form-control" name="foodpack_code"  id="foodpack_code"   value="<?php echo $_GET["foodparcel"] ?>" >
            <input type="hidden" class="form-control" name="hoh_code"  id="hoh_code"   value="<?php echo $_GET["hoh_code"] ?>" >

              <?php 
                  }
                }

            ?>   

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="signature">Beneficiary Signature</label><br>
                  <iframe src="signature/beneficiary_pad.php?code=<?php echo $row->unique_code ?>" name="signature" seamless width="600" height="300"></iframe>  
                </div>
              </div>
            </div>   

      
            <div class="my-3" align="center">
              <input class="btn btn-primary btn-rounded btn-fw" type="submit" name="submit" value="Accept">
            </div>            

          </form>
        </div>
      </div>
    </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
