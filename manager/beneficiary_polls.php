<?php

  include_once "include/header.php";
  include("../config/connect.php");
  error_reporting(0);
  session_start();

  $location = $_SESSION['region'];
 
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
                          Beneficiaries Polls & Service Ratings
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

                  <br><br>


              <?php
                  $api_url = $APIBASE."systems_users_exec.php?action=view_customer_experience&region=".$location."";
                  $client = curl_init($api_url);
                  curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                  $response = curl_exec($client);
                  $result = json_decode($response);
                  $output_limit = '';

                  if(count($result) > 0)
                  {
                    foreach($result as $row)
                    {
  
                ?>

                  <div class="col-md-12 grid-margin grid-margin-md-0 stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Beneficiaries Experiences and Ratings</h4>
                        <div class="template-demo">
                          <div class="d-flex justify-content-between mt-2">
                            <small>Quality Of Food</small>
                            <small><?php echo $row->average_quality ?>%</small>
                          </div>
                          <div class="progress progress-xl">
                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $row->average_quality ?>%" aria-valuenow="<?php echo $row->average_quality ?>" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="d-flex justify-content-between mt-3">
                            <small>Time Management</small>
                            <small><?php echo $row->average_time ?>%</small>
                          </div>
                          <div class="progress progress-xl">
                            <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $row->average_time ?>%" aria-valuenow="<?php echo $row->average_time ?>" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="d-flex justify-content-between mt-3">
                            <small>Communication</small>
                            <small><?php echo $row->average_communication ?>%</small>
                          </div>
                          <div class="progress progress-xl">
                            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $row->average_communication ?>%" aria-valuenow="<?php echo $row->average_communication ?>" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="d-flex justify-content-between mt-3">
                            <small>Experience</small>
                            <small><?php echo $row->average_experience ?>%</small>
                          </div>
                          <div class="progress progress-xl">
                            <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $row->average_experience ?>%" aria-valuenow="<?php echo $row->average_experience ?>" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="d-flex justify-content-between mt-3">
                            <small>Friendliness</small>
                            <small><?php echo $row->average_friendliness ?>%</small>
                          </div>
                          <div class="progress progress-xl">
                            <div class="progress-bar bg-dark progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $row->average_friendliness ?>%" aria-valuenow="<?php echo $row->average_friendliness ?>" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="d-flex justify-content-between mt-3">
                            <small>Issue Resolution</small>
                            <small><?php echo $row->average_resolving_issues ?>%</small>
                          </div>
                          <div class="progress progress-xl">
                            <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $row->average_resolving_issues ?>%" aria-valuenow="<?php echo $row->average_resolving_issues ?>" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              <?php 
                  } 
                } 
              ?>

                </div>
                <br><br>
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Individual Poll Feedback</h4>
                    <div class="row">
                      <div class="col-12">
                        <div class="table-responsive">
                          <table id="order-listing" class="table">
                            <thead>
                              <tr align="center">
                                <th>#</th>
                                <th>Full Names</th>
                                <th>Date & Time</th>
                                <th>Quality</th>
                                <th>Time<br> management</th>
                                <th>Communication</th>
                                <th>Experience</th>
                                <th>Friendliness</th>
                                <th>Issue<br> Resolution</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                                $api_url = $APIBASE."systems_users_exec.php?action=show_all_surveys";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);
                                $output_region = '';

                                if(count($result) > 0)
                                {
                                  foreach($result as $row)
                                  {

                                    if($row->region == $_SESSION['region']){

                                      $output_region .= '
                                      <tr align="center">
                                      <td>'.$row->experience_id.'</td>
                                      <td>'.$row->full_names.'</td>
                                      <td>'.substr($row->date_time, 0, 11).'</td>
                                      <td>'.$row->quality.'</td>
                                      <td>'.$row->time.'</td>
                                      <td>'.$row->communication.'</td>
                                      <td>'.$row->experience.'</td>
                                      <td>'.$row->friendliness.'</td>
                                      <td>'.$row->resolving_issues.'</td>
                                      </tr>
                                      ';                                      

                                    }

                                  }
                                } else {
                                  $output_region .= '
                                  <center>
                                    <tr>
                                      <td> No Data To Display </td>
                                    </tr>
                                  </center>
                                  ';
                                }

                                echo $output_region;
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
