<?php

  include_once "include/header.php";
  include("../config/connect.php");
  error_reporting(0);
  session_start();

  $location = $_SESSION['region'];

  if (isset($_POST['submit'])) {

    function refGenerator()
    {

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $generated_ref = substr(str_shuffle($permitted_chars), 0, 10);
        return $generated_ref;
    }      

    $unique_code = refGenerator();

    $discvrd_bnfr = array();

    // 1. Seach for the 'head_of_household_tbl' table for the selected location 

    $api_url = $APIBASE."beneficiary_details_exec.php?action=generate_distribution_plan&suburb=".$_POST['List3']."&no_of_distribution=".$_POST['no_planned_distrb']."";
    $client = curl_init($api_url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    $result = json_decode($response);

    $count = 0;

    if(count($result) > 0){
      foreach($result as $row) {

        // 2. Add the selected lineitems into an array 
        $discvrd_bnfr[] = $row->unique_code;


        // 3. Update the line items for allocated column
        //    Create a distribution detailed table to store data from the head_of_household_tbl        
        $hoh_user = array(
          'allocated' => "distribution",
          'allocated_ref' => $unique_code,
          'hoh_id'  => $row->hoh_id
        );

        $api_url = $APIBASE."beneficiary_details_exec.php?action=update_headofhouse_id";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $hoh_user);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        $result = json_decode($response, true);  


        if ($count == 0){

          // 4. Create distribution_route_tbl to store the summary details of the distribution route
          $distr_route_data = array(
            'unique_code' => $unique_code,
            'day' => $_POST['day_of_week'],
            'route_gen_date' => $_POST['planned_distrb_date'],
            'region' => $_SESSION['region'],
            'suburb' => $_POST['List3'],
            'user_id'  => $_SESSION['user_id'],
            'performed_by'  => $_SESSION['name']
              
          );
        
          $api_url = $APIBASE."beneficiary_details_exec.php?action=add_planned_route";
          $client = curl_init($api_url);
          curl_setopt($client, CURLOPT_POST, true);
          curl_setopt($client, CURLOPT_POSTFIELDS, $distr_route_data);
          curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
          $response = curl_exec($client);
          curl_close($client);
          $result = json_decode($response, true); 


          // Add a contents to the activity table
          $activities_data = array(
            'unique_code' => $unique_code,
            'action_performed' => "The foodbank manager has created a distribution plan for ".$_POST['List3'],
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

          $count= $count + 1;

        }

        $success = "<br>Successfully completed a route distribution plan! <p>You will be redirected in <span id='counter'>1</span> second(s).</p>
        <script type='text/javascript'>
            function countdown() {
              var i = document.getElementById('counter');
              if (parseInt(i.innerHTML)<=0) {
                location.href = 'distribution_plan.php';
              }
              i.innerHTML = parseInt(i.innerHTML)-1;
            }
            setInterval(function(){ countdown(); },1000);
            </script>'";  
      

      }
    } else {

      $error_message = "Unfortunately the distribution plan was not generated successfully.";

    }

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
                        <a class="nav-link active border-0"  id="more-tab" data-bs-toggle="tab" href="#" role="tab" aria-selected="false">
                          Food Distribution Plan Overview
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

                  <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Generate Food Distribution Plan</h4>
                          <form action="" method="POST">
                            <div class="row">
                              <div class="col-md-3">
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
                              
                              <div class="col-md-3">
                                <div class="form-group">
                                <br>
                                  <label for="no_planned_distrb">Number of Planned Distributions</label>
                                  <div class="input-group input-daterange d-flex align-items-center">
                                    <input type="text" class="form-control" id="no_planned_distrb" name="no_planned_distrb" required>
                                  </div>
                                </div>
                              </div>

                              <div class="col-md-2">
                                <div class="form-group">
                                <br>
                                  <label for="day_of_week">Day Of Week</label>
                                  <select class="form-control" id="day_of_week" name="day_of_week" required>
                                    <option selected></option>
                                    <option>Sunday</option>
                                    <option>Monday</option>
                                    <option>Tuesday</option>
                                    <option>Wednesday</option>
                                    <option>Thursday</option>
                                    <option>Friday</option>
                                    <option>Saturday</option>
                                  </select>
                                </div>
                              </div>      

                              <div class="col-md-2"> 
                                <div class="form-group">
                                <br>
                                  <label for="planned_distrb_date">Planned Distribution Date</label>
                                  <div class="input-group input-daterange d-flex align-items-center">
                                    <input type="date" class="form-control"  id="planned_distrb_date" name="planned_distrb_date" required>
                                  </div>
                                </div>
                              </div>                          
                              
                              <div class="col-md-2">
                                <div class="form-group">
                                <br>
                                  <label for="distrb_type">Distribution Type</label>
                                  <select class="form-control" id="distrb_type" name="distrb_type" required>
                                    <option selected></option>
                                    <option value="dry-goods">Door To Door</option>
                                    <option value="veggies">Central</option>
                                  </select>
                                </div>
                              </div>   

                              <div align="center">
                                <input  class="btn btn-outline-primary btn-icon-text btn-lg" type="submit" name="submit" value="Submit">
                                <button class="btn btn-outline-warning btn-icon-text btn-lg" >
                                  <i class="ti-reload btn-icon-prepend"></i>                                                    
                                  Reset
                                </button>
                              </div>

                            </div>
                          </form>
                    </div>
                  </div>
                </div>

                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Distribution Plan</h4>
                        <p class="card-description">
                          for the past 7 days
                        </p>
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Reference</th>                                
                                <th>Date</th>
                                <th>Day</th>
                                <th>Municipality</th>
                                <th>Town</th>                                
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                                $api_url = $APIBASE."beneficiary_details_exec.php?action=show_distr_route_limit&location=".$location."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);
                                $output_limit = '';

                                if(count($result) > 0)
                                {
                                  foreach($result as $row)
                                  {


                                    $output_limit .= '
                                    <tr>
                                    <td>'.$row->distr_route_id.'</td>
                                    <td>'.$row->unique_code.'</td>
                                    <td>'.$row->route_gen_date.'</td>
                                    <td>'.$row->day.'</td>
                                    <td>'.$row->region.'</td>
                                    <td>'.$row->suburb.'</td>
                                    <td>
                                      <a target="_blank" href="list_scheduled_beneficiary.php?code='.$row->unique_code.'"><button class="btn btn-outline-primary">Details</button></a>
                                  </td>
                                    </tr>
                                    ';
                                  }
                                }

                                echo $output_limit;
                                
                              ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Distribution Plan</h4>
                        <p class="card-description">
                          over the past 24 months
                        </p>
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Reference</th>                                
                                <th>Date</th>
                                <th>Day</th>
                                <th>Municipality</th>
                                <th>Town</th>                                
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                                $api_url = $APIBASE."beneficiary_details_exec.php?action=show_distribution_routes&location=".$location."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);
                                $output_limit = '';

                                if(count($result) > 0)
                                {
                                  foreach($result as $row)
                                  {


                                    $output_limit .= '
                                    <tr>
                                    <td>'.$row->distr_route_id.'</td>
                                    <td>'.$row->unique_code.'</td>
                                    <td>'.$row->route_gen_date.'</td>
                                    <td>'.$row->day.'</td>
                                    <td>'.$row->region.'</td>
                                    <td>'.$row->suburb.'</td>
                                    <td>
                                      <a target="_blank" href="list_scheduled_beneficiary.php?code='.$row->unique_code.'"><button class="btn btn-outline-primary">Details</button></a>
                                  </td>
                                    </tr>
                                    ';
                                  }
                                }

                                echo $output_limit;
                                
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