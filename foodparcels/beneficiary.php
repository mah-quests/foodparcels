<?php

  include_once "header.php";

  if(isset($_POST['submit'])) 
  {
   $idnumber = $_POST["idnumber"];
   $surname = $_POST["surname"];
   $cellphone = $_POST["cellphone"];

   if( !(empty($_POST['idnumber']))){
    
    $api_url = $APIBASE."foodpack_exec.php?action=show_headofhouse_by_id&id_number=".$idnumber."";
    $client = curl_init($api_url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    $result = json_decode($response);

    if(count($result) > 0){
      foreach($result as $row) {

        $household_code = $row->unique_code;
        $newURL= "beneficiary_details.php?foodparcel=".$_POST['code']."&hoh_code=".$household_code."";
        header('Location: '.$newURL);

      } 
    } else {

      $newURL= "beneficiary.php?code=".$_POST['code']."&message=invalid";
      header('Location: '.$newURL);     

    }
   } else if( !(empty($_POST['surname'])) && !(empty($_POST['cellphone']))){
    
    $api_url = $APIBASE."foodpack_exec.php?action=show_headofhouse_by_id&id_number=".$idnumber."&surname=".$surname."";
    $client = curl_init($api_url);
    curl_setopt($client, CURLOPT_POST, true);
    curl_setopt($client, CURLOPT_POSTFIELDS, $household_beneficiary_data);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    curl_close($client);
    $result = json_decode($response, true);
        
    if(count($result) > 0){
      foreach($result as $row) {

        $code = $row->unique_code;
        $newURL= "beneficiary_details.php?foodparcel=".$_POST['code']."&hoh_code=".$household_code."";
        header('Location: '.$newURL);

      } 
    } else {

      $newURL= "beneficiary.php?code=".$_POST['code']."&message=invalid";
      header('Location: '.$newURL); 
            
    }

   }
      
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

  <script type="text/javascript">

  </script>

</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div align="center">
                <img src="images/dsd-logo.png" alt="logo" width="100%">
              </div>
              <br>
              <div align="center">
                <?php if ($_GET['message'] == "invalid") {
                    echo '<div class="alert alert-danger">Invalid Verification Details Entered! Please re-enter your verification details!</div>';
                    }
				        ?>
              </div>  

            <h4 align="center">DSD Beneficiary Portal</h4>
            <div class="form-group">
              <form action="" method="POST">

                <?php
                    $api_url = $APIBASE."foodpack_exec.php?action=show_foodpack_by_code&code=".$_GET["code"]."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);

                    if(count($result) > 0)
                    {
                        foreach($result as $row)
                        {

                ?>   

                        <h4 class="mb-0" align="center"><b>Food Pack Ref: </b><?php echo $row->unique_code ?></h4>
                        <br><br>

                <?php 
                        } 
                    }
                ?> 

                <div class="form-group">
                  <label for="validation_procedure">Verification Type</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-check text-primary"></i>
                      </span>
                    </div>
                      <select class="form-control" id="validation_procedure" name="validation_procedure" onchange="showHideValidationType(this.value)" >
                        <option selected></option>
                        <option value="idnumber">ID Number</option>
                        <option value="surnamecellphone">Cellphone and Surname</option>
                      </select>
                  </div>
                </div>
          
                <div class="form-group" id="id_number-label" style="display:none">
                  <label for="idnumber">ID / Passport Number</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-id-badge text-primary"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control form-control-lg border-left-0" id="idnumber" name="idnumber" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  placeholder="Enter ID Number" >
                  </div>
                </div>
                <fieldset id="cellphone-surname-label" style="display:none">
                <div class="form-group">
                    <label for="cellphone">Cellphone Number</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="ti-mobile text-primary"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control form-control-lg border-left-0" id="cellphone" name="cellphone" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  placeholder="Enter Cellphone Number" >                        
                    </div>
                  </div>                
                  <div class="form-group">
                    <label for="surname">Surname</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="ti-user text-primary"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control form-control-lg border-left-0" id="surname" name="surname" placeholder="Enter Surname"> 
                      <input type="hidden"  id="code" name="code" value="<?php echo $_GET['code'] ?>"> 
                    </div>
                  </div>
                </fieldset>
                

                <div class="my-3" align="center">
                    <input class="btn btn-primary btn-rounded btn-fw" type="submit" name="submit" value="Submit">
                </div>
              </form>
            </div>
            

            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
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
