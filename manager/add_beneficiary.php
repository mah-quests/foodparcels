<?php
  include_once "include/header.php";
  include("../config/connect.php");
  error_reporting(0);
  session_start();

  $user_id = $_SESSION['user_id'];
  $location = $_SESSION['region'];

  
  if ($_POST['submit']) {

    function refGenerator()
    {

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $generated_ref = substr(str_shuffle($permitted_chars), 0, 10);
        return $generated_ref;
    }      

    $unique_code = refGenerator();

    if( !(empty($_POST['official_name'])) && !(empty($_POST['referral_contact']))){
    //Add Non Food Bank Staff Details
    $non_foodbank_staff_data = array(
      'unique_code' => $unique_code,
      'region' => $_SESSION['region'],
      'official_name' => $_POST['official_name'],
      'referral_contact' => $_POST['referral_contact'],
      'date_reffered' => $_POST['date_reffered'],
      'referral_department' => $_POST['referral_department']
    );


    $api_url = $APIBASE."beneficiary_details_exec.php?action=add_non_foodbank_staff";
    $client = curl_init($api_url);
    curl_setopt($client, CURLOPT_POST, true);
    curl_setopt($client, CURLOPT_POSTFIELDS, $non_foodbank_staff_data);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    curl_close($client);
    $result = json_decode($response, true);     
 
    }

    //Add Head Of Household Details
    $household_head_data = array(
      'unique_code' => $unique_code,
      'first_name' => $_POST['first_name'],
      'surname' => $_POST['surname'],
      'id_number' => $_POST['id_number'],
      'region' => $_SESSION['region'],
      'cellphone' => $_POST['cellphone'],
      'head_grant_type' => $_POST['head_grant_type'],
      'home_address' => $_POST['home_address'],
      'ward_number' => $_POST['ward_number'],
      'ward_code' => $_POST['ward_code'],
      'suburb' => $_POST['List3'],
      'district' => $_POST['List2'],
      'municipality' => $_POST['List1'],
      'other_help' => $_POST['other_help'],
      'made_payment' => $_POST['made_payment'],
      'paid_who' => $_POST['paid_who'],
      'by_official' => $_POST['by_official'],
      'specify_other' => $_POST['specify_other']
    );


    $api_url = $APIBASE."beneficiary_details_exec.php?action=add_head_of_household";
    $client = curl_init($api_url);
    curl_setopt($client, CURLOPT_POST, true);
    curl_setopt($client, CURLOPT_POSTFIELDS, $household_head_data);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    curl_close($client);
    $result = json_decode($response, true);     


    //Add Non Food Bank Staff Details
    $household_details_data = array(
      'unique_code' => $unique_code,
      'region' => $_SESSION['region'],
      'household_status' => $_POST['household_status'],
      'ailments_mobilities' => $_POST['ailments_mobilities'],
      'household_affected' => $_POST['household_affected'],
      'no_sa_id' => $_POST['no_sa_id'],
      'no_sa_passport' => $_POST['no_sa_passport'],
      'no_birth_certificate' => $_POST['no_birth_certificate'],
      'country_of_origin' => $_POST['country_of_origin'],
      'no_other_country_id' => $_POST['no_other_country_id'],
      'no_other_country_passport' => $_POST['no_other_country_passport'],
      'household_employed' => $_POST['household_employed'],
      'school_upto_grade12' => $_POST['school_upto_grade12'],
      'people_need_skills' => $_POST['people_need_skills'],
      'earnings_income' => $_POST['earnings_income'],
      'earnings_grant' => $_POST['earnings_grant'],
      'earnings_other' => $_POST['earnings_other']
    );


    $api_url = $APIBASE."beneficiary_details_exec.php?action=add_household_details";
    $client = curl_init($api_url);
    curl_setopt($client, CURLOPT_POST, true);
    curl_setopt($client, CURLOPT_POSTFIELDS, $household_details_data);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    curl_close($client);
    $result = json_decode($response, true);         


    //Add Household Beneficiaries Details - Beneficiary 1
    if( !(empty($_POST['beneficiary_1_name'])) && !(empty($_POST['beneficiary_1_surname']))){

        $household_beneficiary_data = array(
          'unique_code' => $unique_code,
          'region' => $_SESSION['region'],
          'name' => $_POST['beneficiary_1_name'],
          'surname' => $_POST['beneficiary_1_surname'],
          'id_number' => $_POST['beneficiary_1_id'],
          'relation' => $_POST['beneficiary_1_relation'],
          'grant_type' => $_POST['beneficiary_1_grant'],
          'gender' => $_POST['beneficiary_1_gender'],      
          'disabled' => $_POST['beneficiary_1_disability']
        );
    
    
        $api_url = $APIBASE."beneficiary_details_exec.php?action=add_beneficiary_details";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        $result = json_decode($response, true);

    }


    //Add Household Beneficiaries Details - Beneficiary 2
    if( !(empty($_POST['beneficiary_2_name'])) && !(empty($_POST['beneficiary_2_surname']))){

      $household_beneficiary_data = array(
        'unique_code' => $unique_code,
        'region' => $_SESSION['region'],
        'name' => $_POST['beneficiary_2_name'],
        'surname' => $_POST['beneficiary_2_surname'],
        'id_number' => $_POST['beneficiary_2_id'],
        'relation' => $_POST['beneficiary_2_relation'],
        'grant_type' => $_POST['beneficiary_2_grant'],
        'gender' => $_POST['beneficiary_2_gender'],      
        'disabled' => $_POST['beneficiary_2_disability']
      );
  
  
      $api_url = $APIBASE."beneficiary_details_exec.php?action=add_beneficiary_details";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);

  }    


    //Add Household Beneficiaries Details - Beneficiary 3
    if( !(empty($_POST['beneficiary_3_name'])) && !(empty($_POST['beneficiary_3_surname']))){

      $household_beneficiary_data = array(
        'unique_code' => $unique_code,
        'region' => $_SESSION['region'],
        'name' => $_POST['beneficiary_3_name'],
        'surname' => $_POST['beneficiary_3_surname'],
        'id_number' => $_POST['beneficiary_3_id'],
        'relation' => $_POST['beneficiary_3_relation'],
        'grant_type' => $_POST['beneficiary_3_grant'],
        'gender' => $_POST['beneficiary_3_gender'],      
        'disabled' => $_POST['beneficiary_3_disability']
      );
  
  
      $api_url = $APIBASE."beneficiary_details_exec.php?action=add_beneficiary_details";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);

  }     


    //Add Household Beneficiaries Details - Beneficiary 4
    if( !(empty($_POST['beneficiary_4_name'])) && !(empty($_POST['beneficiary_4_surname']))){

      $household_beneficiary_data = array(
        'unique_code' => $unique_code,
        'region' => $_SESSION['region'],
        'name' => $_POST['beneficiary_4_name'],
        'surname' => $_POST['beneficiary_4_surname'],
        'id_number' => $_POST['beneficiary_4_id'],
        'relation' => $_POST['beneficiary_4_relation'],
        'grant_type' => $_POST['beneficiary_4_grant'],
        'gender' => $_POST['beneficiary_4_gender'],      
        'disabled' => $_POST['beneficiary_4_disability']
      );
  
  
      $api_url = $APIBASE."beneficiary_details_exec.php?action=add_beneficiary_details";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);

  } 


    //Add Household Beneficiaries Details - Beneficiary 5
    if( !(empty($_POST['beneficiary_5_name'])) && !(empty($_POST['beneficiary_5_surname']))){

      $household_beneficiary_data = array(
        'unique_code' => $unique_code,
        'region' => $_SESSION['region'],
        'name' => $_POST['beneficiary_5_name'],
        'surname' => $_POST['beneficiary_5_surname'],
        'id_number' => $_POST['beneficiary_5_id'],
        'relation' => $_POST['beneficiary_5_relation'],
        'grant_type' => $_POST['beneficiary_5_grant'],
        'gender' => $_POST['beneficiary_5_gender'],      
        'disabled' => $_POST['beneficiary_5_disability']
      );
  
  
      $api_url = $APIBASE."beneficiary_details_exec.php?action=add_beneficiary_details";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);

  }   


    //Add Household Beneficiaries Details - Beneficiary 6
    if( !(empty($_POST['beneficiary_6_name'])) && !(empty($_POST['beneficiary_6_surname']))){

      $household_beneficiary_data = array(
        'unique_code' => $unique_code,
        'region' => $_SESSION['region'],
        'name' => $_POST['beneficiary_6_name'],
        'surname' => $_POST['beneficiary_6_surname'],
        'id_number' => $_POST['beneficiary_6_id'],
        'relation' => $_POST['beneficiary_6_relation'],
        'grant_type' => $_POST['beneficiary_6_grant'],
        'gender' => $_POST['beneficiary_6_gender'],      
        'disabled' => $_POST['beneficiary_6_disability']
      );
  
  
      $api_url = $APIBASE."beneficiary_details_exec.php?action=add_beneficiary_details";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);

  } 


    //Add Household Beneficiaries Details - Beneficiary 7
    if( !(empty($_POST['beneficiary_7_name'])) && !(empty($_POST['beneficiary_7_surname']))){

      $household_beneficiary_data = array(
        'unique_code' => $unique_code,
        'region' => $_SESSION['region'],
        'name' => $_POST['beneficiary_7_name'],
        'surname' => $_POST['beneficiary_7_surname'],
        'id_number' => $_POST['beneficiary_7_id'],
        'relation' => $_POST['beneficiary_7_relation'],
        'grant_type' => $_POST['beneficiary_7_grant'],
        'gender' => $_POST['beneficiary_7_gender'],      
        'disabled' => $_POST['beneficiary_7_disability']
      );
  
  
      $api_url = $APIBASE."beneficiary_details_exec.php?action=add_beneficiary_details";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);

  }   


    //Add Household Beneficiaries Details - Beneficiary 8
    if( !(empty($_POST['beneficiary_8_name'])) && !(empty($_POST['beneficiary_8_surname']))){

      $household_beneficiary_data = array(
        'unique_code' => $unique_code,
        'region' => $_SESSION['region'],
        'name' => $_POST['beneficiary_8_name'],
        'surname' => $_POST['beneficiary_8_surname'],
        'id_number' => $_POST['beneficiary_8_id'],
        'relation' => $_POST['beneficiary_8_relation'],
        'grant_type' => $_POST['beneficiary_8_grant'],
        'gender' => $_POST['beneficiary_8_gender'],      
        'disabled' => $_POST['beneficiary_8_disability']
      );
  
  
      $api_url = $APIBASE."beneficiary_details_exec.php?action=add_beneficiary_details";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);

  }     


    //Add Household Beneficiaries Details - Beneficiary 9
    if( !(empty($_POST['beneficiary_9_name'])) && !(empty($_POST['beneficiary_9_surname']))){

      $household_beneficiary_data = array(
        'unique_code' => $unique_code,
        'region' => $_SESSION['region'],
        'name' => $_POST['beneficiary_9_name'],
        'surname' => $_POST['beneficiary_9_surname'],
        'id_number' => $_POST['beneficiary_9_id'],
        'relation' => $_POST['beneficiary_9_relation'],
        'grant_type' => $_POST['beneficiary_9_grant'],
        'gender' => $_POST['beneficiary_9_gender'],      
        'disabled' => $_POST['beneficiary_9_disability']
      );
  
  
      $api_url = $APIBASE."beneficiary_details_exec.php?action=add_beneficiary_details";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);

  }       


    //Add Household Beneficiaries Details - Beneficiary 10
    if( !(empty($_POST['beneficiary_10_name'])) && !(empty($_POST['beneficiary_10_surname']))){

      $household_beneficiary_data = array(
        'unique_code' => $unique_code,
        'region' => $_SESSION['region'],
        'name' => $_POST['beneficiary_10_name'],
        'surname' => $_POST['beneficiary_10_surname'],
        'id_number' => $_POST['beneficiary_10_id'],
        'relation' => $_POST['beneficiary_10_relation'],
        'grant_type' => $_POST['beneficiary_10_grant'],
        'gender' => $_POST['beneficiary_10_gender'],      
        'disabled' => $_POST['beneficiary_10_disability']
      );
  
  
      $api_url = $APIBASE."beneficiary_details_exec.php?action=add_beneficiary_details";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);

  }


    //Add Household Beneficiaries Details - Beneficiary 11
    if( !(empty($_POST['beneficiary_11_name'])) && !(empty($_POST['beneficiary_11_surname']))){

      $household_beneficiary_data = array(
        'unique_code' => $unique_code,
        'region' => $_SESSION['region'],
        'name' => $_POST['beneficiary_11_name'],
        'surname' => $_POST['beneficiary_11_surname'],
        'id_number' => $_POST['beneficiary_11_id'],
        'relation' => $_POST['beneficiary_11_relation'],
        'grant_type' => $_POST['beneficiary_11_grant'],
        'gender' => $_POST['beneficiary_11_gender'],      
        'disabled' => $_POST['beneficiary_11_disability']
      );
  
  
      $api_url = $APIBASE."beneficiary_details_exec.php?action=add_beneficiary_details";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);

  }      


    //Add Household Beneficiaries Details - Beneficiary 12
    if( !(empty($_POST['beneficiary_12_name'])) && !(empty($_POST['beneficiary_12_surname']))){

      $household_beneficiary_data = array(
        'unique_code' => $unique_code,
        'region' => $_SESSION['region'],
        'name' => $_POST['beneficiary_12_name'],
        'surname' => $_POST['beneficiary_12_surname'],
        'id_number' => $_POST['beneficiary_12_id'],
        'relation' => $_POST['beneficiary_12_relation'],
        'grant_type' => $_POST['beneficiary_12_grant'],
        'gender' => $_POST['beneficiary_12_gender'],      
        'disabled' => $_POST['beneficiary_12_disability']
      );
  
  
      $api_url = $APIBASE."beneficiary_details_exec.php?action=add_beneficiary_details";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);

  }    


    //Add Household Beneficiaries Details - Beneficiary 13
    if( !(empty($_POST['beneficiary_13_name'])) && !(empty($_POST['beneficiary_13_surname']))){

      $household_beneficiary_data = array(
        'unique_code' => $unique_code,
        'region' => $_SESSION['region'],
        'name' => $_POST['beneficiary_13_name'],
        'surname' => $_POST['beneficiary_13_surname'],
        'id_number' => $_POST['beneficiary_13_id'],
        'relation' => $_POST['beneficiary_13_relation'],
        'grant_type' => $_POST['beneficiary_13_grant'],
        'gender' => $_POST['beneficiary_13_gender'],      
        'disabled' => $_POST['beneficiary_13_disability']
      );
  
  
      $api_url = $APIBASE."beneficiary_details_exec.php?action=add_beneficiary_details";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);

  }  


    //Add Household Beneficiaries Details - Beneficiary 14
    if( !(empty($_POST['beneficiary_14_name'])) && !(empty($_POST['beneficiary_14_surname']))){

      $household_beneficiary_data = array(
        'unique_code' => $unique_code,
        'region' => $_SESSION['region'],
        'name' => $_POST['beneficiary_14_name'],
        'surname' => $_POST['beneficiary_14_surname'],
        'id_number' => $_POST['beneficiary_14_id'],
        'relation' => $_POST['beneficiary_14_relation'],
        'grant_type' => $_POST['beneficiary_14_grant'],
        'gender' => $_POST['beneficiary_14_gender'],      
        'disabled' => $_POST['beneficiary_14_disability']
      );
  
  
      $api_url = $APIBASE."beneficiary_details_exec.php?action=add_beneficiary_details";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);

  }    


    //Add Household Beneficiaries Details - Beneficiary 15
    if( !(empty($_POST['beneficiary_15_name'])) && !(empty($_POST['beneficiary_15_surname']))){

      $household_beneficiary_data = array(
        'unique_code' => $unique_code,
        'region' => $_SESSION['region'],
        'name' => $_POST['beneficiary_15_name'],
        'surname' => $_POST['beneficiary_15_surname'],
        'id_number' => $_POST['beneficiary_15_id'],
        'relation' => $_POST['beneficiary_15_relation'],
        'grant_type' => $_POST['beneficiary_15_grant'],
        'gender' => $_POST['beneficiary_15_gender'],      
        'disabled' => $_POST['beneficiary_15_disability']
      );
  
  
      $api_url = $APIBASE."beneficiary_details_exec.php?action=add_beneficiary_details";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);

  }      


    //Add Household Beneficiaries Details - Beneficiary 16
    if( !(empty($_POST['beneficiary_16_name'])) && !(empty($_POST['beneficiary_16_surname']))){

      $household_beneficiary_data = array(
        'unique_code' => $unique_code,
        'region' => $_SESSION['region'],
        'name' => $_POST['beneficiary_16_name'],
        'surname' => $_POST['beneficiary_16_surname'],
        'id_number' => $_POST['beneficiary_16_id'],
        'relation' => $_POST['beneficiary_16_relation'],
        'grant_type' => $_POST['beneficiary_16_grant'],
        'gender' => $_POST['beneficiary_16_gender'],      
        'disabled' => $_POST['beneficiary_16_disability']
      );
  
  
      $api_url = $APIBASE."beneficiary_details_exec.php?action=add_beneficiary_details";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);

  }    


    //Add Household Beneficiaries Details - Beneficiary 17
    if( !(empty($_POST['beneficiary_17_name'])) && !(empty($_POST['beneficiary_17_surname']))){

      $household_beneficiary_data = array(
        'unique_code' => $unique_code,
        'region' => $_SESSION['region'],
        'name' => $_POST['beneficiary_17_name'],
        'surname' => $_POST['beneficiary_17_surname'],
        'id_number' => $_POST['beneficiary_17_id'],
        'relation' => $_POST['beneficiary_17_relation'],
        'grant_type' => $_POST['beneficiary_17_grant'],
        'gender' => $_POST['beneficiary_17_gender'],      
        'disabled' => $_POST['beneficiary_17_disability']
      );
  
  
      $api_url = $APIBASE."beneficiary_details_exec.php?action=add_beneficiary_details";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);

  }      


    //Add Household Beneficiaries Details - Beneficiary 18
    if( !(empty($_POST['beneficiary_18_name'])) && !(empty($_POST['beneficiary_18_surname']))){

      $household_beneficiary_data = array(
        'unique_code' => $unique_code,
        'region' => $_SESSION['region'],
        'name' => $_POST['beneficiary_18_name'],
        'surname' => $_POST['beneficiary_18_surname'],
        'id_number' => $_POST['beneficiary_18_id'],
        'relation' => $_POST['beneficiary_18_relation'],
        'grant_type' => $_POST['beneficiary_18_grant'],
        'gender' => $_POST['beneficiary_18_gender'],      
        'disabled' => $_POST['beneficiary_18_disability']
      );
  
  
      $api_url = $APIBASE."beneficiary_details_exec.php?action=add_beneficiary_details";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);

  }        


    //Add Household Beneficiaries Details - Beneficiary 19
    if( !(empty($_POST['beneficiary_19_name'])) && !(empty($_POST['beneficiary_19_surname']))){

      $household_beneficiary_data = array(
        'unique_code' => $unique_code,
        'region' => $_SESSION['region'],
        'name' => $_POST['beneficiary_19_name'],
        'surname' => $_POST['beneficiary_19_surname'],
        'id_number' => $_POST['beneficiary_19_id'],
        'relation' => $_POST['beneficiary_19_relation'],
        'grant_type' => $_POST['beneficiary_19_grant'],
        'gender' => $_POST['beneficiary_19_gender'],      
        'disabled' => $_POST['beneficiary_19_disability']
      );
  
  
      $api_url = $APIBASE."beneficiary_details_exec.php?action=add_beneficiary_details";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);

  }        


    //Add Household Beneficiaries Details - Beneficiary 20
    if( !(empty($_POST['beneficiary_20_name'])) && !(empty($_POST['beneficiary_20_surname']))){

      $household_beneficiary_data = array(
        'unique_code' => $unique_code,
        'region' => $_SESSION['region'],
        'name' => $_POST['beneficiary_20_name'],
        'surname' => $_POST['beneficiary_20_surname'],
        'id_number' => $_POST['beneficiary_20_id'],
        'relation' => $_POST['beneficiary_20_relation'],
        'grant_type' => $_POST['beneficiary_20_grant'],
        'gender' => $_POST['beneficiary_20_gender'],      
        'disabled' => $_POST['beneficiary_20_disability']
      );
  
  
      $api_url = $APIBASE."beneficiary_details_exec.php?action=add_beneficiary_details";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);

  }        


    //Add Change Agent Details 1
    if( !(empty($_POST['changeagent_1_name'])) && !(empty($_POST['changeagent_1_needs']))){

      $household_beneficiary_data = array(
        'unique_code' => $unique_code,
        'region' => $_SESSION['region'],
        'name' => $_POST['changeagent_1_name'],
        'needs' => $_POST['changeagent_1_needs'],
        'highest_skills' => $_POST['changeagent_1_highest_skills'],
        'contactnumber' => $_POST['changeagent_1_contactno'],
        'area' => $_POST['changeagent_1_area'],
        'workexperience' => $_POST['changeagent_1_workexperience'],      
        'careerpath' => $_POST['changeagent_1_careerpath']
      );
  
  
      $api_url = $APIBASE."beneficiary_details_exec.php?action=add_change_agent_details";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);

  }    

  

    //Add Change Agent Details 2
    if( !(empty($_POST['changeagent_2_name'])) && !(empty($_POST['changeagent_2_needs']))){

      $household_beneficiary_data = array(
        'unique_code' => $unique_code,
        'region' => $_SESSION['region'],
        'name' => $_POST['changeagent_2_name'],
        'needs' => $_POST['changeagent_2_needs'],
        'highest_skills' => $_POST['changeagent_2_highest_skills'],
        'contactnumber' => $_POST['changeagent_2_contactno'],
        'area' => $_POST['changeagent_2_area'],
        'workexperience' => $_POST['changeagent_2_workexperience'],      
        'careerpath' => $_POST['changeagent_2_careerpath']
      );
  
  
      $api_url = $APIBASE."beneficiary_details_exec.php?action=add_change_agent_details";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);

  }      


    //Add Change Agent Details 3
    if( !(empty($_POST['changeagent_3_name'])) && !(empty($_POST['changeagent_3_needs']))){

      $household_beneficiary_data = array(
        'unique_code' => $unique_code,
        'region' => $_SESSION['region'],
        'name' => $_POST['changeagent_3_name'],
        'needs' => $_POST['changeagent_3_needs'],
        'highest_skills' => $_POST['changeagent_3_highest_skills'],
        'contactnumber' => $_POST['changeagent_3_contactno'],
        'area' => $_POST['changeagent_3_area'],
        'workexperience' => $_POST['changeagent_3_workexperience'],      
        'careerpath' => $_POST['changeagent_3_careerpath']
      );
  
  
      $api_url = $APIBASE."beneficiary_details_exec.php?action=add_change_agent_details";
      $client = curl_init($api_url);
      curl_setopt($client, CURLOPT_POST, true);
      curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($client);
      curl_close($client);
      $result = json_decode($response, true);

  }        


  //Add Development Officer Details
  $household_beneficiary_data = array(
    'unique_code' => $unique_code,
    'region' => $_SESSION['region'],
    'dev_officer_name' => $_POST['dev_officer_name'],
    'dev_officer_cellphone' => $_POST['dev_officer_cellphone'],
    'nearest_stakeholder' => $_POST['nearest_stakeholder'],
    'social_intervention' => $_POST['social_intervention']
  );


  $api_url = $APIBASE."beneficiary_details_exec.php?action=add_development_officer";
  $client = curl_init($api_url);
  curl_setopt($client, CURLOPT_POST, true);
  curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
  curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($client);
  curl_close($client);
  $result = json_decode($response, true);



  $activities_data = array(
    'unique_code' => $unique_code,
    'action_performed' => "The foodbank manager has added a beneficiary, ",
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


  $success = "<br>Completed a beneficiary form successfully! <p>You will be redirected in <span id='counter'>1</span> second(s).</p>
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

<script type="text/javascript">

  function showHideFoodBankStaff() {
    var noOption = document.getElementById("profiled_by").value;
    
    if (noOption == "Non Food Bank Staff Member") {

      jQuery('#non-fb-staff-member').show();
      document.getElementById("non-fb-staff-member").style.visibility = 'visible';
      
    } else {

      jQuery('#non-fb-staff-member').hide();
      document.getElementById("non-fb-staff-member").style.visibility = 'hidden';


    }
    
  }

  function showHideChangeAgentDetails() {
    var noOption = document.getElementById("change_agent_numbers").value;
    
    if (noOption == "1") {

      jQuery('#change-agent-1-info').show();
      document.getElementById("change-agent-1-info").style.visibility = 'visible';

      
      jQuery('#change-agent-2-info').hide();
      document.getElementById("change-agent-2-info").style.visibility = 'hidden';

      jQuery('#change-agent-3-info').hide();
      document.getElementById("change-agent-3-info").style.visibility = 'hidden';


    } else if (noOption == "2") {

      jQuery('#change-agent-1-info').show();
      document.getElementById("change-agent-1-info").style.visibility = 'visible';

      jQuery('#change-agent-2-info').show();
      document.getElementById("change-agent-2-info").style.visibility = 'visible';

      jQuery('#change-agent-3-info').hide();
      document.getElementById("change-agent-3-info").style.visibility = 'hidden';


    } else if (noOption == "3") {

      jQuery('#change-agent-1-info').show();
      document.getElementById("change-agent-1-info").style.visibility = 'visible';

      jQuery('#change-agent-2-info').show();
      document.getElementById("change-agent-2-info").style.visibility = 'visible';

      jQuery('#change-agent-3-info').show();
      document.getElementById("change-agent-3-info").style.visibility = 'visible';      

    }
    
  }  
  


  function showHideBeneficiaryNumbers() {
    var noOption = document.getElementById("beneficiary_numbers").value;
    
    if (noOption == "1-5 Beneficiaries") {

      jQuery('#1to5household-member-info').show();
      document.getElementById("1to5household-member-info").style.visibility = 'visible';
      
    } else if (noOption == "6-10 Beneficiaries") {

      jQuery('#1to5household-member-info').show();
      document.getElementById("1to5household-member-info").style.visibility = 'visible';

      jQuery('#6to10household-member-info').show();
      document.getElementById("6to10household-member-info").style.visibility = 'visible';

    } else if (noOption == "11-15 Beneficiaries") {

      jQuery('#1to5household-member-info').show();
      document.getElementById("1to5household-member-info").style.visibility = 'visible';

      jQuery('#6to10household-member-info').show();
      document.getElementById("6to10household-member-info").style.visibility = 'visible';

      jQuery('#11to15household-member-info').show();
      document.getElementById("11to15household-member-info").style.visibility = 'visible';      

    } else if (noOption == "16+ Beneficiaries") {

      jQuery('#1to5household-member-info').show();
      document.getElementById("1to5household-member-info").style.visibility = 'visible';

      jQuery('#6to10household-member-info').show();
      document.getElementById("6to10household-member-info").style.visibility = 'visible';

      jQuery('#11to15household-member-info').show();
      document.getElementById("11to15household-member-info").style.visibility = 'visible';     
      
      jQuery('#11to15household-member-info').show();
      document.getElementById("11to15household-member-info").style.visibility = 'visible';    
      
      jQuery('#16to20household-member-info').show();
      document.getElementById("16to20household-member-info").style.visibility = 'visible';          

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


  function showHidePaidMoneyTo() {
    var noOption = document.getElementById("made_payment").value;
    if (noOption == "Yes") {
      jQuery('#who-you-paid-info').show();
      document.getElementById("who-you-paid-info").style.visibility = 'visible';

    } else {

      jQuery('#who-you-paid-info').hide();
      document.getElementById("who-you-paid-info").style.visibility = 'hidden';
    }
    
  } 
  
  function showHideParcelByOfficial() {
    var noOption = document.getElementById("by_official").value;
    if (noOption == "Other") {
      jQuery('#official-other-info').show();
      document.getElementById("official-other-info").style.visibility = 'visible';

    } else {

      jQuery('#official-other-info').hide();
      document.getElementById("official-other-info").style.visibility = 'hidden';
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
                        <a class="nav-link active border-0"  id="more-tab" data-bs-toggle="tab" href="#" role="tab" aria-selected="false">
                          Beneficiary Management
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
                        <h4 class="card-title"><u>Add Beneficiary Form</u></h4>
                        <form action="" method="POST">

                          <h6>
                            <u>Profiler Details</u>
                          </h6>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="profiled_by">Profiled By</label>
                                <select class="form-control" id="profiled_by" name="profiled_by" onchange="showHideFoodBankStaff(this.value)"  required>
                                  <option selected></option>
                                  <option>Food Bank Staff Member</option>
                                  <option>Non Food Bank Staff Member</option>
                                </select>
                              </div>
                            </div>
                          </div>

                          <fieldset id="non-fb-staff-member" style="display:none">

                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="official_name">Name DSD official / CDW / Community leader</label>
                                  <input type="text" class="form-control" id="official_name" name="official_name" placeholder="Enter Name DSD official">
                                </div>
                              </div>                            
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="date_reffered">Date Referred</label>
                                  <input type="date" class="form-control" id="date_reffered" name="date_reffered" placeholder="Enter Surname">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="referral_contact">Contact details of referral</label>
                                  <input type="text" class="form-control" id="referral_contact" name="referral_contact"  pattern="[0-9]{10}" placeholder="Enter Referral Contact details">
                                </div>
                              </div>                            
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="referral_department">Referral Dept</label>
                                  <input type="text" class="form-control" id="referral_department" name="referral_department" placeholder="Enter Referral Department">
                                </div>
                              </div>
                            </div>                                                    

                          </fieldset>

                          <h6>
                            <u>Head of household</u>
                          </h6>                          
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="first_name">First Names</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Names" required>
                              </div>
                            </div>                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="surname">Surname</label>
                                <input type="text" class="form-control" id="surname" name="surname" placeholder="Enter Surname" required>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="id_number">South African ID Number / Date Of Birth</label>
                                <input type="text" class="form-control" id="id_number" name="id_number" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" pattern="[0-9]{12}" placeholder="Enter ID Number">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="cellphone">Cellphone Number</label>
                                <input type="text" class="form-control" id="cellphone" name="cellphone" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  pattern="[0-9+]{10}" placeholder="Enter Cellphone" required>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="head_grant_type">Type of grant receiving</label>
                                <select class="form-control" id="head_grant_type" name="head_grant_type"  required>
                                  <option selected></option>
                                  <option>CSG</option>
                                  <option>OLD AGE</option>
                                  <option>DISABILITY</option>
                                  <option>FOSTER CARE</option>
                                  <option>OTHER</option>
                                  <option>NONE</option>
                                </select>
                              </div>
                            </div>                            
                          </div>                          
                          <div class="row">
                            <div class="col-md-8">
                              <div class="form-group">
                                <label for="home_address">Home Address</label>
                                <textarea class="form-control" id="home_address" name="home_address" placeholder="Enter Home Address" required></textarea>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="ward_number">Ward Number</label>
                                <input type="text" class="form-control" id="ward_number" name="ward_number" placeholder="Enter Ward Number">
                              </div>
                            </div>   
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="ward_code">Ward Code</label>
                                <select class="form-control" id="ward_code" name="ward_code"  required>
                                  <option selected></option>
                                  <option>Red</option>
                                  <option>Yellow</option>
                                  <option>Green</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                              <label for="municipality"><br>Location</label>
                                <select  class="form-control" name='List1' id="List1" onchange="fillSelect(this.value,this.form['List2'])" required>
                                  <option selected value="">Select Province</option>
                                    </select> &nbsp;
                                <select class="form-control"  name='List2' id="List2" onchange="fillSelect(this.value,this.form['List3'])" required>
                                  <option selected value="">Select District and metropolitan municipalities</option>
                                    </select> &nbsp;
                                <select  class="form-control" name='List3' id="List3" onchange="fillSelect(this.value,this.form['List4'])" required>
                                  <option selected value="">Choose Municipality</option>
                                    </select> &nbsp;
                              </div> 
                            </div>
                          </div>  


                          <h6>
                            <u>Beneficiaries in Household</u>
                          </h6>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="beneficiary_numbers">Number of Beneficiaries In Household</label>
                                <select class="form-control" id="beneficiary_numbers" name="beneficiary_numbers" onchange="showHideBeneficiaryNumbers(this.value)"  required>
                                  <option selected></option>
                                  <option>0 Beneficiaries</option>
                                  <option>1-5 Beneficiaries</option>
                                  <option>6-10 Beneficiaries</option>
                                  <option>11-15 Beneficiaries</option>
                                  <option>16+ Beneficiaries</option>
                                </select>
                              </div>
                            </div>
                          </div>

                          <fieldset id="1to5household-member-info"  style="display:none">
                          <p>
                            <u>Beneficiary #1</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_1_name">Name</label>
                                <input type="text" class="form-control" id="beneficiary_1_name" name="beneficiary_1_name" placeholder="Enter Beneficiary 1 First Name">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_1_surname">Surname</label>
                                <input type="text" class="form-control" id="beneficiary_1_surname" name="beneficiary_1_surname" placeholder="Enter Beneficiary 1 Surname">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_1_id">I.D Number /Date Of Birth</label>
                                <input type="text" class="form-control" id="beneficiary_1_id" name="beneficiary_1_id" placeholder="Enter Beneficiary 1 ID Number">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_1_relation">Relation to Head of Household</label>
                                <input type="text" class="form-control" id="beneficiary_1_relation" name="beneficiary_1_relation" placeholder="Beneficiary 1 Relation to Head of Household">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_1_grant">Type of Grant</label>
                                <select class="form-control" id="beneficiary_1_grant" name="beneficiary_1_grant">
                                  <option selected></option>
                                  <option>NONE</option>
                                  <option>CHILD CSG GRANT - Reg to HOH</option>
                                  <option>CHILD CSG GRANT - Not Reg to HOH</option>
                                  <option>CSG</option>
                                  <option>OLD AGE</option>
                                  <option>DISABILITY</option>
                                  <option>FOSTER CARE</option>                         
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_1_gender">Gender</label>
                                <select class="form-control" id="beneficiary_1_gender" name="beneficiary_1_gender">
                                  <option selected></option>
                                  <option>MALE</option>
                                  <option>FEMALE</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_1_disability">Disability</label>
                                <select class="form-control" id="beneficiary_1_disability" name="beneficiary_1_disability" >
                                  <option selected></option>
                                  <option>YES</option>
                                  <option>NO</option>
                                </select>
                              </div>
                            </div>                          
                          </div>
                          <p>
                            <u>Beneficiary #2</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_2_name">Name</label>
                                <input type="text" class="form-control" id="beneficiary_2_name" name="beneficiary_2_name" placeholder="Enter Beneficiary 2 First Name">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_2_surname">Surname</label>
                                <input type="text" class="form-control" id="beneficiary_2_surname" name="beneficiary_2_surname" placeholder="Enter Beneficiary 2 Surname">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_2_id">I.D Number /Date Of Birth</label>
                                <input type="text" class="form-control" id="beneficiary_2_id" name="beneficiary_2_id" placeholder="Enter Beneficiary 2 ID Number">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_2_relation">Relation to Head of Household</label>
                                <input type="text" class="form-control" id="beneficiary_2_relation" name="beneficiary_2_relation" placeholder="Beneficiary 2 Relation to Head of Household">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_2_grant">Type of Grant</label>
                                <select class="form-control" id="beneficiary_2_grant" name="beneficiary_2_grant">
                                  <option selected></option>
                                  <option>NONE</option>
                                  <option>CHILD CSG GRANT - Reg to HOH</option>
                                  <option>CHILD CSG GRANT - Not Reg to HOH</option>
                                  <option>CSG</option>
                                  <option>OLD AGE</option>
                                  <option>DISABILITY</option>
                                  <option>FOSTER CARE</option>                         
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_2_gender">Gender</label>
                                <select class="form-control" id="beneficiary_2_gender" name="beneficiary_2_gender">
                                  <option selected></option>
                                  <option>MALE</option>
                                  <option>FEMALE</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_2_disability">Disability</label>
                                <select class="form-control" id="beneficiary_2_disability" name="beneficiary_2_disability" >
                                  <option selected></option>
                                  <option>YES</option>
                                  <option>NO</option>
                                </select>
                              </div>
                            </div>                          
                          </div>
                          
                          <p>
                            <u>Beneficiary #3</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_3_name">Name</label>
                                <input type="text" class="form-control" id="beneficiary_3_name" name="beneficiary_3_name" placeholder="Enter Beneficiary 3 First Name">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_3_surname">Surname</label>
                                <input type="text" class="form-control" id="beneficiary_3_surname" name="beneficiary_3_surname" placeholder="Enter Beneficiary 3 Surname">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_3_id">I.D Number /Date Of Birth</label>
                                <input type="text" class="form-control" id="beneficiary_3_id" name="beneficiary_3_id" placeholder="Enter Beneficiary 3 ID Number">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_3_relation">Relation to Head of Household</label>
                                <input type="text" class="form-control" id="beneficiary_3_relation" name="beneficiary_3_relation" placeholder="Beneficiary 3 Relation to Head of Household">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_3_grant">Type of Grant</label>
                                <select class="form-control" id="beneficiary_3_grant" name="beneficiary_3_grant">
                                  <option selected></option>
                                  <option>NONE</option>
                                  <option>CHILD CSG GRANT - Reg to HOH</option>
                                  <option>CHILD CSG GRANT - Not Reg to HOH</option>
                                  <option>CSG</option>
                                  <option>OLD AGE</option>
                                  <option>DISABILITY</option>
                                  <option>FOSTER CARE</option>                         
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_3_gender">Gender</label>
                                <select class="form-control" id="beneficiary_3_gender" name="beneficiary_3_gender">
                                  <option selected></option>
                                  <option>MALE</option>
                                  <option>FEMALE</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_3_disability">Disability</label>
                                <select class="form-control" id="beneficiary_3_disability" name="beneficiary_3_disability" >
                                  <option selected></option>
                                  <option>YES</option>
                                  <option>NO</option>
                                </select>
                              </div>
                            </div>                          
                          </div> 
                            
                            <p>
                            <u>Beneficiary #4</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_4_name">Name</label>
                                <input type="text" class="form-control" id="beneficiary_4_name" name="beneficiary_4_name" placeholder="Enter Beneficiary 4 First Name">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_4_surname">Surname</label>
                                <input type="text" class="form-control" id="beneficiary_4_surname" name="beneficiary_4_surname" placeholder="Enter Beneficiary 4 Surname">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_4_id">I.D Number /Date Of Birth</label>
                                <input type="text" class="form-control" id="beneficiary_4_id" name="beneficiary_4_id" placeholder="Enter Beneficiary 4 ID Number">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_4_relation">Relation to Head of Household</label>
                                <input type="text" class="form-control" id="beneficiary_4_relation" name="beneficiary_4_relation" placeholder="Beneficiary 4 Relation to Head of Household">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_4_grant">Type of Grant</label>
                                <select class="form-control" id="beneficiary_4_grant" name="beneficiary_4_grant">
                                  <option selected></option>
                                  <option>NONE</option>
                                  <option>CHILD CSG GRANT - Reg to HOH</option>
                                  <option>CHILD CSG GRANT - Not Reg to HOH</option>
                                  <option>CSG</option>
                                  <option>OLD AGE</option>
                                  <option>DISABILITY</option>
                                  <option>FOSTER CARE</option>                         
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_4_gender">Gender</label>
                                <select class="form-control" id="beneficiary_4_gender" name="beneficiary_4_gender">
                                  <option selected></option>
                                  <option>MALE</option>
                                  <option>FEMALE</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_4_disability">Disability</label>
                                <select class="form-control" id="beneficiary_4_disability" name="beneficiary_4_disability" >
                                  <option selected></option>
                                  <option>YES</option>
                                  <option>NO</option>
                                </select>
                              </div>
                            </div>                          
                          </div>           
                            
                            <p>
                            <u>Beneficiary #5</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_5_name">Name</label>
                                <input type="text" class="form-control" id="beneficiary_5_name" name="beneficiary_5_name" placeholder="Enter Beneficiary 4 First Name">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_5_surname">Surname</label>
                                <input type="text" class="form-control" id="beneficiary_5_surname" name="beneficiary_5_surname" placeholder="Enter Beneficiary 4 Surname">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_5_id">I.D Number /Date Of Birth</label>
                                <input type="text" class="form-control" id="beneficiary_5_id" name="beneficiary_5_id" placeholder="Enter Beneficiary 4 ID Number">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_5_relation">Relation to Head of Household</label>
                                <input type="text" class="form-control" id="beneficiary_5_relation" name="beneficiary_5_relation" placeholder="Beneficiary 4 Relation to Head of Household">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_5_grant">Type of Grant</label>
                                <select class="form-control" id="beneficiary_5_grant" name="beneficiary_5_grant">
                                  <option selected></option>
                                  <option>NONE</option>
                                  <option>CHILD CSG GRANT - Reg to HOH</option>
                                  <option>CHILD CSG GRANT - Not Reg to HOH</option>
                                  <option>CSG</option>
                                  <option>OLD AGE</option>
                                  <option>DISABILITY</option>
                                  <option>FOSTER CARE</option>                         
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_5_gender">Gender</label>
                                <select class="form-control" id="beneficiary_5_gender" name="beneficiary_5_gender">
                                  <option selected></option>
                                  <option>MALE</option>
                                  <option>FEMALE</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_5_disability">Disability</label>
                                <select class="form-control" id="beneficiary_5_disability" name="beneficiary_5_disability" >
                                  <option selected></option>
                                  <option>YES</option>
                                  <option>NO</option>
                                </select>
                              </div>
                            </div>
                          </div>

                          </fieldset>
                          <fieldset id="6to10household-member-info" style="display:none">

                          <p>
                            <u>Beneficiary #6</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_6_name">Name</label>
                                <input type="text" class="form-control" id="beneficiary_6_name" name="beneficiary_6_name" placeholder="Enter Beneficiary 6 First Name">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_6_surname">Surname</label>
                                <input type="text" class="form-control" id="beneficiary_6_surname" name="beneficiary_6_surname" placeholder="Enter Beneficiary 6 Surname">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_6_id">I.D Number /Date Of Birth</label>
                                <input type="text" class="form-control" id="beneficiary_6_id" name="beneficiary_6_id" placeholder="Enter Beneficiary 6 ID Number">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_6_relation">Relation to Head of Household</label>
                                <input type="text" class="form-control" id="beneficiary_6_relation" name="beneficiary_6_relation" placeholder="Beneficiary 6 Relation to Head of Household">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_6_grant">Type of Grant</label>
                                <select class="form-control" id="beneficiary_6_grant" name="beneficiary_6_grant">
                                  <option selected></option>
                                  <option>NONE</option>
                                  <option>CHILD CSG GRANT - Reg to HOH</option>
                                  <option>CHILD CSG GRANT - Not Reg to HOH</option>
                                  <option>CSG</option>
                                  <option>OLD AGE</option>
                                  <option>DISABILITY</option>
                                  <option>FOSTER CARE</option>                         
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_6_gender">Gender</label>
                                <select class="form-control" id="beneficiary_6_gender" name="beneficiary_6_gender">
                                  <option selected></option>
                                  <option>MALE</option>
                                  <option>FEMALE</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_6_disability">Disability</label>
                                <select class="form-control" id="beneficiary_6_disability" name="beneficiary_6_disability" >
                                  <option selected></option>
                                  <option>YES</option>
                                  <option>NO</option>
                                </select>
                              </div>
                            </div>                          
                          </div>
                          
                          <p>
                            <u>Beneficiary #7</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_7_name">Name</label>
                                <input type="text" class="form-control" id="beneficiary_7_name" name="beneficiary_7_name" placeholder="Enter Beneficiary 7 First Name">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_7_surname">Surname</label>
                                <input type="text" class="form-control" id="beneficiary_7_surname" name="beneficiary_7_surname" placeholder="Enter Beneficiary 7 Surname">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_7_id">I.D Number /Date Of Birth</label>
                                <input type="text" class="form-control" id="beneficiary_7_id" name="beneficiary_7_id" placeholder="Enter Beneficiary 7 ID Number">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_7_relation">Relation to Head of Household</label>
                                <input type="text" class="form-control" id="beneficiary_7_relation" name="beneficiary_7_relation" placeholder="Beneficiary 7 Relation to Head of Household">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_7_grant">Type of Grant</label>
                                <select class="form-control" id="beneficiary_7_grant" name="beneficiary_7_grant">
                                  <option selected></option>
                                  <option>NONE</option>
                                  <option>CHILD CSG GRANT - Reg to HOH</option>
                                  <option>CHILD CSG GRANT - Not Reg to HOH</option>
                                  <option>CSG</option>
                                  <option>OLD AGE</option>
                                  <option>DISABILITY</option>
                                  <option>FOSTER CARE</option>                         
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_7_gender">Gender</label>
                                <select class="form-control" id="beneficiary_7_gender" name="beneficiary_7_gender">
                                  <option selected></option>
                                  <option>MALE</option>
                                  <option>FEMALE</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_7_disability">Disability</label>
                                <select class="form-control" id="beneficiary_7_disability" name="beneficiary_7_disability" >
                                  <option selected></option>
                                  <option>YES</option>
                                  <option>NO</option>
                                </select>
                              </div>
                            </div>                          
                          </div>
                          
                          <p>
                            <u>Beneficiary #8</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_8_name">Name</label>
                                <input type="text" class="form-control" id="beneficiary_8_name" name="beneficiary_8_name" placeholder="Enter Beneficiary 8 First Name">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_8_surname">Surname</label>
                                <input type="text" class="form-control" id="beneficiary_8_surname" name="beneficiary_8_surname" placeholder="Enter Beneficiary 8 Surname">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_8_id">I.D Number /Date Of Birth</label>
                                <input type="text" class="form-control" id="beneficiary_8_id" name="beneficiary_8_id" placeholder="Enter Beneficiary 8 ID Number">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_8_relation">Relation to Head of Household</label>
                                <input type="text" class="form-control" id="beneficiary_8_relation" name="beneficiary_8_relation" placeholder="Beneficiary 8 Relation to Head of Household">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_8_grant">Type of Grant</label>
                                <select class="form-control" id="beneficiary_8_grant" name="beneficiary_8_grant">
                                  <option selected></option>
                                  <option>NONE</option>
                                  <option>CHILD CSG GRANT - Reg to HOH</option>
                                  <option>CHILD CSG GRANT - Not Reg to HOH</option>
                                  <option>CSG</option>
                                  <option>OLD AGE</option>
                                  <option>DISABILITY</option>
                                  <option>FOSTER CARE</option>                         
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_8_gender">Gender</label>
                                <select class="form-control" id="beneficiary_8_gender" name="beneficiary_8_gender">
                                  <option selected></option>
                                  <option>MALE</option>
                                  <option>FEMALE</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_8_disability">Disability</label>
                                <select class="form-control" id="beneficiary_8_disability" name="beneficiary_8_disability" >
                                  <option selected></option>
                                  <option>YES</option>
                                  <option>NO</option>
                                </select>
                              </div>
                            </div>                          
                          </div>
                          
                          <p>
                            <u>Beneficiary #9</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_9_name">Name</label>
                                <input type="text" class="form-control" id="beneficiary_9_name" name="beneficiary_9_name" placeholder="Enter Beneficiary 9 First Name">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_9_surname">Surname</label>
                                <input type="text" class="form-control" id="beneficiary_9_surname" name="beneficiary_9_surname" placeholder="Enter Beneficiary 9 Surname">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_9_id">I.D Number /Date Of Birth</label>
                                <input type="text" class="form-control" id="beneficiary_9_id" name="beneficiary_9_id" placeholder="Enter Beneficiary 9 ID Number">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_9_relation">Relation to Head of Household</label>
                                <input type="text" class="form-control" id="beneficiary_9_relation" name="beneficiary_9_relation" placeholder="Beneficiary 9 Relation to Head of Household">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_9_grant">Type of Grant</label>
                                <select class="form-control" id="beneficiary_9_grant" name="beneficiary_9_grant">
                                  <option selected></option>
                                  <option>NONE</option>
                                  <option>CHILD CSG GRANT - Reg to HOH</option>
                                  <option>CHILD CSG GRANT - Not Reg to HOH</option>
                                  <option>CSG</option>
                                  <option>OLD AGE</option>
                                  <option>DISABILITY</option>
                                  <option>FOSTER CARE</option>                         
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_9_gender">Gender</label>
                                <select class="form-control" id="beneficiary_9_gender" name="beneficiary_9_gender">
                                  <option selected></option>
                                  <option>MALE</option>
                                  <option>FEMALE</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_9_disability">Disability</label>
                                <select class="form-control" id="beneficiary_9_disability" name="beneficiary_9_disability" >
                                  <option selected></option>
                                  <option>YES</option>
                                  <option>NO</option>
                                </select>
                              </div>
                            </div>                          
                          </div>                          
                          <p>
                            <u>Beneficiary #10</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_10_name">Name</label>
                                <input type="text" class="form-control" id="beneficiary_10_name" name="beneficiary_10_name" placeholder="Enter Beneficiary 10 First Name">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_10_surname">Surname</label>
                                <input type="text" class="form-control" id="beneficiary_10_surname" name="beneficiary_10_surname" placeholder="Enter Beneficiary 10 Surname">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_10_id">I.D Number /Date Of Birth</label>
                                <input type="text" class="form-control" id="beneficiary_10_id" name="beneficiary_10_id" placeholder="Enter Beneficiary 10 ID Number">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_10_relation">Relation to Head of Household</label>
                                <input type="text" class="form-control" id="beneficiary_10_relation" name="beneficiary_10_relation" placeholder="Beneficiary 10 Relation to Head of Household">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_10_grant">Type of Grant</label>
                                <select class="form-control" id="beneficiary_10_grant" name="beneficiary_10_grant">
                                  <option selected></option>
                                  <option>NONE</option>
                                  <option>CHILD CSG GRANT - Reg to HOH</option>
                                  <option>CHILD CSG GRANT - Not Reg to HOH</option>
                                  <option>CSG</option>
                                  <option>OLD AGE</option>
                                  <option>DISABILITY</option>
                                  <option>FOSTER CARE</option>                         
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_10_gender">Gender</label>
                                <select class="form-control" id="beneficiary_10_gender" name="beneficiary_10_gender">
                                  <option selected></option>
                                  <option>MALE</option>
                                  <option>FEMALE</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_10_disability">Disability</label>
                                <select class="form-control" id="beneficiary_10_disability" name="beneficiary_10_disability" >
                                  <option selected></option>
                                  <option>YES</option>
                                  <option>NO</option>
                                </select>
                              </div>
                            </div>                          
                          </div>

                          </fieldset>
                          <fieldset id="11to15household-member-info" style="display:none">


                          <p>
                            <u>Beneficiary #11</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_11_name">Name</label>
                                <input type="text" class="form-control" id="beneficiary_11_name" name="beneficiary_11_name" placeholder="Enter Beneficiary 11 First Name">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_11_surname">Surname</label>
                                <input type="text" class="form-control" id="beneficiary_11_surname" name="beneficiary_11_surname" placeholder="Enter Beneficiary 11 Surname">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_11_id">I.D Number /Date Of Birth</label>
                                <input type="text" class="form-control" id="beneficiary_11_id" name="beneficiary_11_id" placeholder="Enter Beneficiary 11 ID Number">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_11_relation">Relation to Head of Household</label>
                                <input type="text" class="form-control" id="beneficiary_11_relation" name="beneficiary_11_relation" placeholder="Beneficiary 11 Relation to Head of Household">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_11_grant">Type of Grant</label>
                                <select class="form-control" id="beneficiary_11_grant" name="beneficiary_11_grant">
                                  <option selected></option>
                                  <option>NONE</option>
                                  <option>CHILD CSG GRANT - Reg to HOH</option>
                                  <option>CHILD CSG GRANT - Not Reg to HOH</option>
                                  <option>CSG</option>
                                  <option>OLD AGE</option>
                                  <option>DISABILITY</option>
                                  <option>FOSTER CARE</option>                         
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_11_gender">Gender</label>
                                <select class="form-control" id="beneficiary_11_gender" name="beneficiary_11_gender">
                                  <option selected></option>
                                  <option>MALE</option>
                                  <option>FEMALE</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_11_disability">Disability</label>
                                <select class="form-control" id="beneficiary_11_disability" name="beneficiary_11_disability" >
                                  <option selected></option>
                                  <option>YES</option>
                                  <option>NO</option>
                                </select>
                              </div>
                            </div>                          
                          </div>
                          
                          <p>
                            <u>Beneficiary #12</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_12_name">Name</label>
                                <input type="text" class="form-control" id="beneficiary_12_name" name="beneficiary_12_name" placeholder="Enter Beneficiary 12 First Name">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_12_surname">Surname</label>
                                <input type="text" class="form-control" id="beneficiary_12_surname" name="beneficiary_12_surname" placeholder="Enter Beneficiary 12 Surname">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_12_id">I.D Number /Date Of Birth</label>
                                <input type="text" class="form-control" id="beneficiary_12_id" name="beneficiary_12_id" placeholder="Enter Beneficiary 12 ID Number">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_12_relation">Relation to Head of Household</label>
                                <input type="text" class="form-control" id="beneficiary_12_relation" name="beneficiary_12_relation" placeholder="Beneficiary 12 Relation to Head of Household">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_12_grant">Type of Grant</label>
                                <select class="form-control" id="beneficiary_12_grant" name="beneficiary_12_grant">
                                  <option selected></option>
                                  <option>NONE</option>
                                  <option>CHILD CSG GRANT - Reg to HOH</option>
                                  <option>CHILD CSG GRANT - Not Reg to HOH</option>
                                  <option>CSG</option>
                                  <option>OLD AGE</option>
                                  <option>DISABILITY</option>
                                  <option>FOSTER CARE</option>                         
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_12_gender">Gender</label>
                                <select class="form-control" id="beneficiary_12_gender" name="beneficiary_12_gender">
                                  <option selected></option>
                                  <option>MALE</option>
                                  <option>FEMALE</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_12_disability">Disability</label>
                                <select class="form-control" id="beneficiary_12_disability" name="beneficiary_12_disability" >
                                  <option selected></option>
                                  <option>YES</option>
                                  <option>NO</option>
                                </select>
                              </div>
                            </div>                          
                          </div>
                          
                          <p>
                            <u>Beneficiary #13</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_13_name">Name</label>
                                <input type="text" class="form-control" id="beneficiary_13_name" name="beneficiary_13_name" placeholder="Enter Beneficiary 13 First Name">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_13_surname">Surname</label>
                                <input type="text" class="form-control" id="beneficiary_13_surname" name="beneficiary_13_surname" placeholder="Enter Beneficiary 13 Surname">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_13_id">I.D Number /Date Of Birth</label>
                                <input type="text" class="form-control" id="beneficiary_13_id" name="beneficiary_13_id" placeholder="Enter Beneficiary 13 ID Number">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_13_relation">Relation to Head of Household</label>
                                <input type="text" class="form-control" id="beneficiary_13_relation" name="beneficiary_13_relation" placeholder="Beneficiary 13 Relation to Head of Household">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_13_grant">Type of Grant</label>
                                <select class="form-control" id="beneficiary_13_grant" name="beneficiary_13_grant">
                                  <option selected></option>
                                  <option>NONE</option>
                                  <option>CHILD CSG GRANT - Reg to HOH</option>
                                  <option>CHILD CSG GRANT - Not Reg to HOH</option>
                                  <option>CSG</option>
                                  <option>OLD AGE</option>
                                  <option>DISABILITY</option>
                                  <option>FOSTER CARE</option>                         
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_13_gender">Gender</label>
                                <select class="form-control" id="beneficiary_13_gender" name="beneficiary_13_gender">
                                  <option selected></option>
                                  <option>MALE</option>
                                  <option>FEMALE</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_13_disability">Disability</label>
                                <select class="form-control" id="beneficiary_13_disability" name="beneficiary_13_disability" >
                                  <option selected></option>
                                  <option>YES</option>
                                  <option>NO</option>
                                </select>
                              </div>
                            </div>                          
                          </div>
                          
                          <p>
                            <u>Beneficiary #14</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_14_name">Name</label>
                                <input type="text" class="form-control" id="beneficiary_14_name" name="beneficiary_14_name" placeholder="Enter Beneficiary 14 First Name">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_14_surname">Surname</label>
                                <input type="text" class="form-control" id="beneficiary_14_surname" name="beneficiary_14_surname" placeholder="Enter Beneficiary 14 Surname">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_14_id">I.D Number /Date Of Birth</label>
                                <input type="text" class="form-control" id="beneficiary_14_id" name="beneficiary_14_id" placeholder="Enter Beneficiary 14 ID Number">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_14_relation">Relation to Head of Household</label>
                                <input type="text" class="form-control" id="beneficiary_14_relation" name="beneficiary_14_relation" placeholder="Beneficiary 14 Relation to Head of Household">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_14_grant">Type of Grant</label>
                                <select class="form-control" id="beneficiary_14_grant" name="beneficiary_14_grant">
                                  <option selected></option>
                                  <option>NONE</option>
                                  <option>CHILD CSG GRANT - Reg to HOH</option>
                                  <option>CHILD CSG GRANT - Not Reg to HOH</option>
                                  <option>CSG</option>
                                  <option>OLD AGE</option>
                                  <option>DISABILITY</option>
                                  <option>FOSTER CARE</option>                         
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_14_gender">Gender</label>
                                <select class="form-control" id="beneficiary_14_gender" name="beneficiary_14_gender">
                                  <option selected></option>
                                  <option>MALE</option>
                                  <option>FEMALE</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_14_disability">Disability</label>
                                <select class="form-control" id="beneficiary_14_disability" name="beneficiary_14_disability" >
                                  <option selected></option>
                                  <option>YES</option>
                                  <option>NO</option>
                                </select>
                              </div>
                            </div>                          
                          </div>                          
                          <p>
                            <u>Beneficiary #15</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_15_name">Name</label>
                                <input type="text" class="form-control" id="beneficiary_15_name" name="beneficiary_15_name" placeholder="Enter Beneficiary 15 First Name">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_15_surname">Surname</label>
                                <input type="text" class="form-control" id="beneficiary_15_surname" name="beneficiary_15_surname" placeholder="Enter Beneficiary 15 Surname">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_15_id">I.D Number /Date Of Birth</label>
                                <input type="text" class="form-control" id="beneficiary_15_id" name="beneficiary_15_id" placeholder="Enter Beneficiary 15 ID Number">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_15_relation">Relation to Head of Household</label>
                                <input type="text" class="form-control" id="beneficiary_15_relation" name="beneficiary_15_relation" placeholder="Beneficiary 15 Relation to Head of Household">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_15_grant">Type of Grant</label>
                                <select class="form-control" id="beneficiary_15_grant" name="beneficiary_15_grant">
                                  <option selected></option>
                                  <option>NONE</option>
                                  <option>CHILD CSG GRANT - Reg to HOH</option>
                                  <option>CHILD CSG GRANT - Not Reg to HOH</option>
                                  <option>CSG</option>
                                  <option>OLD AGE</option>
                                  <option>DISABILITY</option>
                                  <option>FOSTER CARE</option>                         
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_15_gender">Gender</label>
                                <select class="form-control" id="beneficiary_15_gender" name="beneficiary_15_gender">
                                  <option selected></option>
                                  <option>MALE</option>
                                  <option>FEMALE</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_15_disability">Disability</label>
                                <select class="form-control" id="beneficiary_15_disability" name="beneficiary_15_disability" >
                                  <option selected></option>
                                  <option>YES</option>
                                  <option>NO</option>
                                </select>
                              </div>
                            </div>                          
                          </div>                          

                          </fieldset>   
                          <fieldset id="16to20household-member-info" style="display:none">


                          <p>
                            <u>Beneficiary #16</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_16_name">Name</label>
                                <input type="text" class="form-control" id="beneficiary_16_name" name="beneficiary_16_name" placeholder="Enter Beneficiary 16 First Name">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_16_surname">Surname</label>
                                <input type="text" class="form-control" id="beneficiary_16_surname" name="beneficiary_16_surname" placeholder="Enter Beneficiary 16 Surname">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_16_id">I.D Number /Date Of Birth</label>
                                <input type="text" class="form-control" id="beneficiary_16_id" name="beneficiary_16_id" placeholder="Enter Beneficiary 16 ID Number">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_16_relation">Relation to Head of Household</label>
                                <input type="text" class="form-control" id="beneficiary_16_relation" name="beneficiary_16_relation" placeholder="Beneficiary 16 Relation to Head of Household">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_16_grant">Type of Grant</label>
                                <select class="form-control" id="beneficiary_16_grant" name="beneficiary_16_grant">
                                  <option selected></option>
                                  <option>NONE</option>
                                  <option>CHILD CSG GRANT - Reg to HOH</option>
                                  <option>CHILD CSG GRANT - Not Reg to HOH</option>
                                  <option>CSG</option>
                                  <option>OLD AGE</option>
                                  <option>DISABILITY</option>
                                  <option>FOSTER CARE</option>                         
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_16_gender">Gender</label>
                                <select class="form-control" id="beneficiary_16_gender" name="beneficiary_16_gender" >
                                  <option selected></option>
                                  <option>MALE</option>
                                  <option>FEMALE</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_16_disability">Disability</label>
                                <select class="form-control" id="beneficiary_16_disability" name="beneficiary_16_disability" >
                                  <option selected></option>
                                  <option>YES</option>
                                  <option>NO</option>
                                </select>
                              </div>
                            </div>                          
                          </div>
                          
                          <p>
                            <u>Beneficiary #17</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_17_name">Name</label>
                                <input type="text" class="form-control" id="beneficiary_17_name" name="beneficiary_17_name" placeholder="Enter Beneficiary 17 First Name">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_17_surname">Surname</label>
                                <input type="text" class="form-control" id="beneficiary_17_surname" name="beneficiary_17_surname" placeholder="Enter Beneficiary 17 Surname">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_17_id">I.D Number /Date Of Birth</label>
                                <input type="text" class="form-control" id="beneficiary_17_id" name="beneficiary_17_id" placeholder="Enter Beneficiary 17 ID Number">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_17_relation">Relation to Head of Household</label>
                                <input type="text" class="form-control" id="beneficiary_17_relation" name="beneficiary_17_relation" placeholder="Beneficiary 17 Relation to Head of Household">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_17_grant">Type of Grant</label>
                                <select class="form-control" id="beneficiary_17_grant" name="beneficiary_17_grant">
                                  <option selected></option>
                                  <option>NONE</option>
                                  <option>CHILD CSG GRANT - Reg to HOH</option>
                                  <option>CHILD CSG GRANT - Not Reg to HOH</option>
                                  <option>CSG</option>
                                  <option>OLD AGE</option>
                                  <option>DISABILITY</option>
                                  <option>FOSTER CARE</option>                         
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_17_gender">Gender</label>
                                <select class="form-control" id="beneficiary_17_gender" name="beneficiary_17_gender" >
                                  <option selected></option>
                                  <option>MALE</option>
                                  <option>FEMALE</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_17_disability">Disability</label>
                                <select class="form-control" id="beneficiary_17_disability" name="beneficiary_17_disability" >
                                  <option selected></option>
                                  <option>YES</option>
                                  <option>NO</option>
                                </select>
                              </div>
                            </div>                          
                          </div>
                          
                          <p>
                            <u>Beneficiary #18</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_18_name">Name</label>
                                <input type="text" class="form-control" id="beneficiary_18_name" name="beneficiary_18_name" placeholder="Enter Beneficiary 18 First Name">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_18_surname">Surname</label>
                                <input type="text" class="form-control" id="beneficiary_18_surname" name="beneficiary_18_surname" placeholder="Enter Beneficiary 18 Surname">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_18_id">I.D Number /Date Of Birth</label>
                                <input type="text" class="form-control" id="beneficiary_18_id" name="beneficiary_18_id" placeholder="Enter Beneficiary 18 ID Number">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_18_relation">Relation to Head of Household</label>
                                <input type="text" class="form-control" id="beneficiary_18_relation" name="beneficiary_18_relation" placeholder="Beneficiary 18 Relation to Head of Household">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_18_grant">Type of Grant</label>
                                <select class="form-control" id="beneficiary_18_grant" name="beneficiary_18_grant">
                                  <option selected></option>
                                  <option>NONE</option>
                                  <option>CHILD CSG GRANT - Reg to HOH</option>
                                  <option>CHILD CSG GRANT - Not Reg to HOH</option>
                                  <option>CSG</option>
                                  <option>OLD AGE</option>
                                  <option>DISABILITY</option>
                                  <option>FOSTER CARE</option>                         
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_18_gender">Gender</label>
                                <select class="form-control" id="beneficiary_18_gender" name="beneficiary_18_gender" >
                                  <option selected></option>
                                  <option>MALE</option>
                                  <option>FEMALE</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_18_disability">Disability</label>
                                <select class="form-control" id="beneficiary_18_disability" name="beneficiary_18_disability" >
                                  <option selected></option>
                                  <option>YES</option>
                                  <option>NO</option>
                                </select>
                              </div>
                            </div>                          
                          </div>
                          
                          <p>
                            <u>Beneficiary #19</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_19_name">Name</label>
                                <input type="text" class="form-control" id="beneficiary_19_name" name="beneficiary_19_name" placeholder="Enter Beneficiary 19 First Name">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_19_surname">Surname</label>
                                <input type="text" class="form-control" id="beneficiary_19_surname" name="beneficiary_19_surname" placeholder="Enter Beneficiary 19 Surname">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_19_id">I.D Number /Date Of Birth</label>
                                <input type="text" class="form-control" id="beneficiary_19_id" name="beneficiary_19_id" placeholder="Enter Beneficiary 19 ID Number">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_19_relation">Relation to Head of Household</label>
                                <input type="text" class="form-control" id="beneficiary_19_relation" name="beneficiary_19_relation" placeholder="Beneficiary 19 Relation to Head of Household">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_19_grant">Type of Grant</label>
                                <select class="form-control" id="beneficiary_19_grant" name="beneficiary_19_grant">
                                  <option selected></option>
                                  <option>NONE</option>
                                  <option>CHILD CSG GRANT - Reg to HOH</option>
                                  <option>CHILD CSG GRANT - Not Reg to HOH</option>
                                  <option>CSG</option>
                                  <option>OLD AGE</option>
                                  <option>DISABILITY</option>
                                  <option>FOSTER CARE</option>                         
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_19_gender">Gender</label>
                                <select class="form-control" id="beneficiary_19_gender" name="beneficiary_19_gender" >
                                  <option selected></option>
                                  <option>MALE</option>
                                  <option>FEMALE</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_19_disability">Disability</label>
                                <select class="form-control" id="beneficiary_19_disability" name="beneficiary_19_disability" >
                                  <option selected></option>
                                  <option>YES</option>
                                  <option>NO</option>
                                </select>
                              </div>
                            </div>                          
                          </div>                          
                          <p>
                            <u>Beneficiary #20</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_20_name">Name</label>
                                <input type="text" class="form-control" id="beneficiary_20_name" name="beneficiary_20_name" placeholder="Enter Beneficiary 20 First Name">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_20_surname">Surname</label>
                                <input type="text" class="form-control" id="beneficiary_20_surname" name="beneficiary_20_surname" placeholder="Enter Beneficiary 20 Surname">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="beneficiary_20_id">I.D Number /Date Of Birth</label>
                                <input type="text" class="form-control" id="beneficiary_20_id" name="beneficiary_20_id" placeholder="Enter Beneficiary 20 ID Number">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_20_relation">Relation to Head of Household</label>
                                <input type="text" class="form-control" id="beneficiary_20_relation" name="beneficiary_20_relation" placeholder="Beneficiary 20 Relation to Head of Household">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_20_grant">Type of Grant</label>
                                <select class="form-control" id="beneficiary_20_grant" name="beneficiary_20_grant">
                                  <option selected></option>
                                  <option>NONE</option>
                                  <option>CHILD CSG GRANT - Reg to HOH</option>
                                  <option>CHILD CSG GRANT - Not Reg to HOH</option>
                                  <option>CSG</option>
                                  <option>OLD AGE</option>
                                  <option>DISABILITY</option>
                                  <option>FOSTER CARE</option>                         
                                </select>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_20_gender">Gender</label>
                                <select class="form-control" id="beneficiary_20_gender" name="beneficiary_20_gender" >
                                  <option selected></option>
                                  <option>Male</option>
                                  <option>Female</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="beneficiary_20_disability">Disability</label>
                                <select class="form-control" id="beneficiary_20_disability" name="beneficiary_20_disability" >
                                  <option selected></option>
                                  <option>Yes</option>
                                  <option>No</option>
                                </select>
                              </div>
                            </div>                          
                          </div>

                          </fieldset>                       

                          <h6>
                            <u>Questions To Beneficiaries</u>
                          </h6>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="other_help">Have you ever received help through SASSA, HBC or a clinic or Disaster mangement for food parcels or other relief in the last 3 mnths specify?</label>
                                <select class="form-control" id="other_help" name="other_help" required>
                                  <option selected></option>
                                  <option>Yes</option>
                                  <option>No</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="made_payment">Did you pay anyone for this food parcel?</label>
                                <select class="form-control" id="made_payment" name="made_payment" onchange="showHidePaidMoneyTo(this.value)"  required>
                                  <option selected></option>
                                  <option>Yes</option>
                                  <option>No</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="by_official">Were you promised a food parcel by an official or /other </label>
                                <select class="form-control" id="by_official" name="by_official" onchange="showHideParcelByOfficial(this.value)"  required>
                                  <option selected></option>
                                  <option>Official</option>
                                  <option>Other</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6" id="who-you-paid-info" style="display:none">
                              <div class="form-group">
                                <label for="paid_who">Who did you pay money to</label>
                                <input type="text" class="form-control" id="paid_who" name="paid_who" placeholder="Enter who you pid money to">
                              </div>
                            </div>                              
                            <div class="col-md-6" id="official-other-info" style="display:none">
                              <div class="form-group">
                                <label for="specify_other">Specify Other</label>
                                <input type="text" class="form-control" id="specify_other" name="specify_other" placeholder="Specify Non Official Details">
                              </div>
                            </div>                                                        
                          </div>

                          <h6>
                            <u>Further Household Details</u>
                          </h6>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="household_status">Status of Household</label>
                                <select class="form-control" id="household_status" name="household_status" required>
                                  <option selected></option>
                                  <option>Senior Headed</option>
                                  <option>Youth Headed</option>
                                  <option>Child Headed</option>
                                  <option>Child under 6</option>
                                  <option>Other</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="ailments_mobilities">Ailments Addictions & Mobility </label>
                                <select class="form-control" id="ailments_mobilities" name="ailments_mobilities" required>
                                  <option selected></option>
                                  <option>Old Age</option>
                                  <option>Not Mobile </option>
                                  <option>Disabled</option>
                                  <option>Substance Abuse</option>
                                  <option>None</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="household_affected">Emergency: households affected</label>
                                <select class="form-control" id="household_affected" name="household_affected" required>
                                  <option selected></option>
                                  <option>None</option>
                                  <option>Burnt Shack</option>
                                  <option>Flood</option>
                                  <option>Tornado/ Wind</option>
                                  <option>Funeral</option>
                                  <option>Other</option>
                                </select>
                              </div>
                            </div>     
                          </div>

                          <h6>
                            <u>Identification (number of member who have)</u>
                          </h6>                          
                          <div class="row">
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="no_sa_id">No. SA ID </label>
                                <input type="text" class="form-control" id="no_sa_id" name="no_sa_id" placeholder="Enter Number of ID holders">
                              </div>
                            </div>   
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="no_sa_passport">No. SA Passport </label>
                                <input type="text" class="form-control" id="no_sa_passport" name="no_sa_passport" placeholder="Enter Number of SA Passport">
                              </div>
                            </div>  
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="no_birth_certificate">No. Birth Certs</label>
                                <input type="text" class="form-control" id="no_birth_certificate" name="no_birth_certificate" placeholder="Enter Number of Child Birth Certicates">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="country_of_origin">Country of origin</label>
                                <input type="text" class="form-control" id="country_of_origin" name="country_of_origin" placeholder="Enter Country of origin">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="no_other_country_id">No. Other Country ID</label>
                                <input type="text" class="form-control" id="no_other_country_id" name="no_other_country_id" placeholder="Enter Number of  Other Country ID">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="no_other_country_passport">No. Other Passport</label>
                                <input type="text" class="form-control" id="no_other_country_passport" name="no_other_country_passport" placeholder="Enter Number of  Other Country Passport">
                              </div>
                            </div>
                          </div>
                          <h6>
                            <u>Employment  History and Schooling</u>
                          </h6>  
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="household_employed">No. of employed in household</label>
                                <input type="text" class="form-control" name="household_employed"  id="household_employed" placeholder="Enter Number of  employed in household">
                              </div>
                            </div>                            
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="school_upto_grade12">No. of formal schooled up to Grd 12</label>
                                <input type="text" class="form-control" id="school_upto_grade12" name="school_upto_grade12" placeholder="Enter Number of Number of formal schooled up to Grd 12">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="people_need_skills">No. of people needing skills </label>
                                <input type="text" class="form-control" id="people_need_skills" name="people_need_skills" placeholder="Enter Number of Number of people needing skills">
                              </div>
                            </div>                            
                          </div>  
                          <h6>
                            <u>Source of Income</u>
                          </h6>  
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="earnings_income">Amount from Income Earnings</label>
                                <input type="text" class="form-control" name="earnings_income"  id="earnings_income" placeholder="Enter Amount Earning an income">
                              </div>
                            </div>                            
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="earnings_grant">Amount from Grants Earnings</label>
                                <input type="text" class="form-control" id="earnings_grant" name="earnings_grant" placeholder="Enter Amount from Grants Earnings">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="earnings_other">Amount from Other Earnings</label>
                                <input type="text" class="form-control" id="earnings_other" name="earnings_other" placeholder="Enter Amount from Other Earnings">
                              </div>
                            </div>                            
                          </div>  
                          <h6>
                            <u>Details of Change Agent</u>
                          </h6>                          
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="change_agent_numbers">Number of Change Agents</label>
                                <select class="form-control" id="change_agent_numbers" name="change_agent_numbers" onchange="showHideChangeAgentDetails(this.value)"  required>
                                  <option selected></option>
                                  <option>0</option>
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                </select>
                              </div>
                            </div>
                          </div>

                          <fieldset id="change-agent-1-info"  style="display:none">
                          <p>
                            <u>Change Agent #1</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="changeagent_1_name">Name Of Change Agent Identified</label>
                                <input type="text" class="form-control" id="changeagent_1_name" name="changeagent_1_name" placeholder="Enter Name Of Change Agent Identified">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="changeagent_1_needs">Type of Skills/ Homeaffairs/ Sassa Needed</label>
                                <input type="text" class="form-control" id="changeagent_1_needs" name="changeagent_1_needs" placeholder="Enter Type of Skills/ Homeaffairs/ Sassa Needed">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="changeagent_1_highest_skills">Highest Skills obtained</label>
                                <input type="text" class="form-control" id="changeagent_1_highest_skills" name="changeagent_1_highest_skills" placeholder="Enter Highest Skills obtained">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="changeagent_1_contactno">Contact no</label>
                                <input type="text" class="form-control" id="changeagent_1_contactno" name="changeagent_1_contactno" placeholder="Enter Change Agent 1 Contact Number">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="changeagent_1_area">Area</label>
                                <input type="text" class="form-control" id="changeagent_1_area" name="changeagent_1_area" placeholder="Enter Change Agent 1 Area">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="changeagent_1_workexperience">Work experience</label>
                                <input type="text" class="form-control" id="changeagent_1_workexperience" name="changeagent_1_workexperience" placeholder="Enter Change Agent 1 Work experience">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="changeagent_1_careerpath">Desired career path</label>
                                <input type="text" class="form-control" id="changeagent_1_careerpath" name="changeagent_1_careerpath" placeholder="Enter Change Agent 1 Desired career path">
                              </div>
                            </div>                         
                          </div>
                          </fieldset>
                        <fieldset id="change-agent-2-info"  style="display:none">
                          <p>
                            <u>Change Agent #2</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="changeagent_2_name">Name Of Change Agent Identified</label>
                                <input type="text" class="form-control" id="changeagent_2_name" name="changeagent_2_name" placeholder="Enter Name Of Change Agent Identified">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="changeagent_2_needs">Type of Skills/ Homeaffairs/ Sassa Needed</label>
                                <input type="text" class="form-control" id="changeagent_2_needs" name="changeagent_2_needs" placeholder="Enter Type of Skills/ Homeaffairs/ Sassa Needed">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="changeagent_2_highest_skills">Highest Skills obtained</label>
                                <input type="text" class="form-control" id="changeagent_2_highest_skills" name="changeagent_2_highest_skills" placeholder="Enter Highest Skills obtained">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="changeagent_2_contactno">Contact no</label>
                                <input type="text" class="form-control" id="changeagent_2_contactno" name="changeagent_2_contactno" placeholder="Enter Change Agent 2 Contact Number">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="changeagent_2_area">Area</label>
                                <input type="text" class="form-control" id="changeagent_2_area" name="changeagent_2_area" placeholder="Enter Change Agent 2 Area">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="changeagent_2_workexperience">Work experience</label>
                                <input type="text" class="form-control" id="changeagent_2_workexperience" name="changeagent_2_workexperience" placeholder="Enter Change Agent 2 Work experience">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="changeagent_2_careerpath">Desired career path</label>
                                <input type="text" class="form-control" id="changeagent_2_careerpath" name="changeagent_2_careerpath" placeholder="Enter Change Agent 2 Desired career path">
                              </div>
                            </div>                         
                          </div>
                          </fieldset>
                          <fieldset id="change-agent-3-info"  style="display:none">
                          <p>
                            <u>Change Agent #3</u>
                          </p>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="changeagent_3_name">Name Of Change Agent Identified</label>
                                <input type="text" class="form-control" id="changeagent_3_name" name="changeagent_3_name" placeholder="Enter Name Of Change Agent Identified">
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="changeagent_3_needs">Type of Skills/ Homeaffairs/ Sassa Needed</label>
                                <input type="text" class="form-control" id="changeagent_3_needs" name="changeagent_3_needs" placeholder="Enter Type of Skills/ Homeaffairs/ Sassa Needed">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="changeagent_3_highest_skills">Highest Skills obtained</label>
                                <input type="text" class="form-control" id="changeagent_3_highest_skills" name="changeagent_3_highest_skills" placeholder="Enter Highest Skills obtained">
                              </div>
                            </div>                             
                          </div> 
                          <div class="row">
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="changeagent_3_contactno">Contact no</label>
                                <input type="text" class="form-control" id="changeagent_3_contactno" name="changeagent_3_contactno" placeholder="Enter Change Agent 3 Contact Number">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="changeagent_3_area">Area</label>
                                <input type="text" class="form-control" id="changeagent_3_area" name="changeagent_3_area" placeholder="Enter Change Agent 3 Area">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="changeagent_3_workexperience">Work experience</label>
                                <input type="text" class="form-control" id="changeagent_3_workexperience" name="changeagent_3_workexperience" placeholder="Enter Change Agent 3 Work experience">
                              </div>
                            </div> 
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="changeagent_3_careerpath">Desired career path</label>
                                <input type="text" class="form-control" id="changeagent_3_careerpath" name="changeagent_3_careerpath" placeholder="Enter Change Agent 3 Desired career path">
                              </div>
                            </div>                         
                          </div>
                          </fieldset> 

                          <h6>
                            <u>Development Officer</u>
                          </h6>  
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="dev_officer_name">Name of Development Officer</label>
                                <input type="text" class="form-control" name="dev_officer_name"  id="dev_officer_name" placeholder="Enter Name of development officer">
                              </div>
                            </div>                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="dev_officer_cellphone">Cell No of Development Officer</label>
                                <input type="text" class="form-control" id="dev_officer_cellphone" name="dev_officer_cellphone" placeholder="Enter Cell No of development officer">
                              </div>
                            </div>                           
                          </div>  
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="nearest_stakeholder">Nearest Stakeholder from Chng Agnt</label>
                                <input type="text" class="form-control" name="nearest_stakeholder"  id="nearest_stakeholder" placeholder="Enter Nearest Stakeholder from Chng Agnt">
                              </div>
                            </div>                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="social_intervention">Is there a need for social intervention if so eloborate</label>
                                <textarea class="form-control" id="social_intervention" name="social_intervention" placeholder="Enter social intervention needed"></textarea>
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
                        <h4 class="card-title">List of Identified Beneficiaries</h4>
                        <p class="card-description">
                          over the past 24 months
                        </p>
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Full Names</th>
                                <th>Phone</th>
                                <th>ID Number </th>                                
                                <th>Address</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>

                            <?php
                                $api_url = $APIBASE."beneficiary_details_exec.php?action=show_20_headofhouse&location=".$location."";
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
                                    <td>'.$row->hoh_id.'</td>
                                    <td>'.substr($row->hoh_date_time, 0, 11).'</td>
                                    <td>'.$row->first_name.' '.$row->surname.'</td>
                                    <td>'.$row->cellphone.'</td>
                                    <td>'.$row->id_number.'</td>
                                    <td>'.$row->home_address.'</td>
                                    <td>
                                      <a target="_blank" href="view_beneficiary_details.php?code='.$row->unique_code.'"><button class="btn btn-outline-primary">Details</button></a>
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