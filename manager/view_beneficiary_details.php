<?php
    include_once "include/header.php";
    include("../config/connect.php");

    $user_id = $_SESSION['user_id'];



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
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                      <h4 class="card-title">Beneficiary Form Details</h4>
                        <form class="forms-sample">

                          <br><br>

                          <?php
                              $api_url = $APIBASE."beneficiary_details_exec.php?action=show_no_fb_staff_detail&code=".$_GET["code"]."";
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
                                  <input type="text" class="form-control" id="official_name" name="official_name" value="<?php echo $row->official_name ?>" readonly>
                                </div>
                              </div>                            
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="date_reffered">Date Referred</label>
                                  <input type="text" class="form-control" id="date_reffered" name="date_reffered" value="<?php echo $row->date_reffered ?>" readonly>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="referral_contact">Contact details of referral</label>
                                  <input type="text" class="form-control" id="referral_contact" name="referral_contact"  value="<?php echo $row->referral_contact ?>" readonly>
                                </div>
                              </div>                            
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="referral_department">Referral Dept</label>
                                  <input type="text" class="form-control" id="referral_department" name="referral_department" value="<?php echo $row->referral_department ?>" readonly>
                                </div>
                              </div>
                            </div>                            
                          
                          <?php 
                                }
                              }

                              $api_url = $APIBASE."beneficiary_details_exec.php?action=show_headofhousehold_detail&code=".$_GET["code"]."";
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
                                <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $row->first_name ?>" readonly>
                              </div>
                            </div>                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="surname">Surname</label>
                                <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $row->surname ?>" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="id_number">South African ID Number / Date Of Birth</label>
                                <input type="text" class="form-control" id="id_number" name="id_number" value="<?php echo $row->id_number ?>" readonly>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="cellphone">Cellphone Number</label>
                                <input type="text" class="form-control" id="cellphone" name="cellphone" value="<?php echo $row->id_number ?>" readonly>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                              <label for="head_grant_type">Type of grant receiving</label>
                                <input type="text" class="form-control" id="head_grant_type" name="head_grant_type" value="<?php echo $row->head_grant_type ?>" readonly>
                              </div>
                            </div>                            
                          </div>                          
                          <div class="row">
                            <div class="col-md-8">
                              <div class="form-group">
                              <label for="home_address">Home Address</label>
                                <input type="text" class="form-control" id="home_address" name="home_address" value="<?php echo $row->home_address ?>" readonly>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="ward_number">Ward Number</label>
                                <input type="text" class="form-control" id="ward_number" name="ward_number" value="<?php echo $row->ward_number ?>" readonly>
                              </div>
                            </div>   
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="ward_code">Ward Code</label>
                                <input type="text" class="form-control" id="ward_code" name="ward_code" value="<?php echo $row->ward_code ?>" readonly>
                              </div>
                            </div>  

                            <div class="col-md-4">
                              <div class="form-group">
                              <label for="municipality">Province</label>
                                <input type="text" class="form-control" id="municipality" name="municipality" value="<?php echo $row->municipality ?>" readonly>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="district">District</label>
                                <input type="text" class="form-control" id="district" name="district" value="<?php echo $row->district ?>" readonly>
                              </div>
                            </div>   
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="suburb">Suburb</label>
                                <input type="text" class="form-control" id="suburb" name="suburb" value="<?php echo $row->suburb ?>" readonly>
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
                                  <input type="text" class="form-control" id="other_help" name="other_help" value="<?php echo $row->other_help ?>" readonly>
                                </div>
                            </div>    
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="made_payment">Did you pay anyone for this food parcel?</label>
                                  <input type="text" class="form-control" id="made_payment" name="made_payment" value="<?php echo $row->made_payment ?>" readonly>
                                </div>
                            </div>   
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="by_official">Were you promised a food parcel by an official or /other </label>
                                  <input type="text" class="form-control" id="by_official" name="by_official" value="<?php echo $row->by_official ?>" readonly>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="paid_who">Who did you pay money to</label>
                                  <input type="text" class="form-control" id="paid_who" name="paid_who" value="<?php echo $row->paid_who ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="specify_other">Specify Other</label>
                                  <input type="text" class="form-control" id="specify_other" name="specify_other" value="<?php echo $row->specify_other ?>" readonly>
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
                                $api_url = $APIBASE."beneficiary_details_exec.php?action=show_beneficiary_by_code&code=".$_GET["code"]."";
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

                              $api_url = $APIBASE."beneficiary_details_exec.php?action=show_household_details_by_code&code=".$_GET["code"]."";
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
                                  <input type="text" class="form-control" id="household_status" name="household_status" value="<?php echo $row->household_status ?>" readonly>
                                </div>
                            </div>  
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="ailments_mobilities">Ailments Addictions & Mobility </label>
                                  <input type="text" class="form-control" id="ailments_mobilities" name="ailments_mobilities" value="<?php echo $row->ailments_mobilities ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="household_affected">Emergency: households affected</label>
                                  <input type="text" class="form-control" id="household_affected" name="household_affected" value="<?php echo $row->household_affected ?>" readonly>
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="no_sa_id">No. SA ID </label>
                                <input type="text" class="form-control" id="no_sa_id" name="no_sa_id"  value="<?php echo $row->no_sa_id ?>" readonly>
                              </div>
                            </div>   
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="no_sa_passport">No. SA Passport </label>
                                <input type="text" class="form-control" id="no_sa_passport" name="no_sa_passport"  value="<?php echo $row->no_sa_passport ?>" readonly>
                              </div>
                            </div>  
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="no_birth_certificate">No. Birth Certs</label>
                                <input type="text" class="form-control" id="no_birth_certificate" name="no_birth_certificate" value="<?php echo $row->no_birth_certificate ?>" readonly>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="country_of_origin">Country of origin</label>
                                <input type="text" class="form-control" id="country_of_origin" name="country_of_origin" value="<?php echo $row->country_of_origin ?>" readonly >
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="no_other_country_id">No. Other Country ID</label>
                                <input type="text" class="form-control" id="no_other_country_id" name="no_other_country_id"  value="<?php echo $row->no_other_country_id ?>" readonly>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="no_other_country_passport">No. Other Passport</label>
                                <input type="text" class="form-control" id="no_other_country_passport" name="no_other_country_passport"  value="<?php echo $row->no_other_country_passport ?>" readonly>
                              </div>
                            </div>
                          </div>   
                          
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="household_employed">No. of employed in household</label>
                                <input type="text" class="form-control" name="household_employed"  id="household_employed"  value="<?php echo $row->household_employed ?>" readonly>
                              </div>
                            </div>                            
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="school_upto_grade12">No. of formal schooled up to Grd 12</label>
                                <input type="text" class="form-control" id="school_upto_grade12" name="school_upto_grade12"  value="<?php echo $row->school_upto_grade12 ?>" readonly>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="people_need_skills">No. of people needing skills </label>
                                <input type="text" class="form-control" id="people_need_skills" name="people_need_skills"  value="<?php echo $row->people_need_skills ?>" readonly>
                              </div>
                            </div>                            
                          </div> 
                          
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="earnings_income">Amount from Income Earnings</label>
                                <input type="text" class="form-control" name="earnings_income"  id="earnings_income"  value="<?php echo $row->earnings_income ?>" readonly>
                              </div>
                            </div>                            
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="earnings_grant">Amount from Grants Earnings</label>
                                <input type="text" class="form-control" id="earnings_grant" name="earnings_grant"  value="<?php echo $row->earnings_grant ?>" readonly>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="earnings_other">Amount from Other Earnings</label>
                                <input type="text" class="form-control" id="earnings_other" name="earnings_other"   value="<?php echo $row->earnings_other ?>" readonly>
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
                                $api_url = $APIBASE."beneficiary_details_exec.php?action=show_change_agent_by_code&code=".$_GET["code"]."";
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
                              $api_url = $APIBASE."beneficiary_details_exec.php?action=show_development_officer_by_code&code=".$_GET["code"]."";
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
                                <input type="text" class="form-control" name="dev_officer_name"  id="dev_officer_name"   value="<?php echo $row->dev_officer_name ?>" readonly>
                              </div>
                            </div>                            
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="dev_officer_cellphone">Cell No of Development Officer</label>
                                <input type="text" class="form-control" id="dev_officer_cellphone" name="dev_officer_cellphone"   value="<?php echo $row->dev_officer_name ?>" readonly>
                              </div>
                            </div>                           
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="nearest_stakeholder">Nearest Stakeholder from Chng Agnt</label>
                                <input type="text" class="form-control" name="nearest_stakeholder"  id="nearest_stakeholder"   value="<?php echo $row->nearest_stakeholder ?>" readonly>
                              </div>
                            </div> 
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="social_intervention">Is there a need for social intervention if so eloborate</label>
                                <input type="text" class="form-control" name="social_intervention"  id="social_intervention"   value="<?php echo $row->social_intervention ?>" readonly>
                              </div>
                            </div>     


                          </div>  

                            <?php 
                                }
                              }

                          ?>   

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


