<?php
    include_once "include/header.php";
    include("../config/connect.php");

    $user_id = $_SESSION['user_id'];
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
                      <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Goods Delivery History Overview</a>
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
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Goods Delivery History</h4>
                  <p class="card-description">
                    over the past 24 months
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Transaction</th>
                          <th>Reference</th>
                          <th>Project Name</th>
                          <th>Date of delivery</th>
                          <th>Stock Type</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

											<?php
                          $api_url = $APIBASE."delivery_notice_exec.php?action=show_supplier_user_stock&user_id=".$user_id."";
                          $client = curl_init($api_url);
                          curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                          $response = curl_exec($client);
                          $result = json_decode($response);
                          $output = '';

                          if(count($result) > 0)
                          {
                            foreach($result as $row)
                            {
                              $status = $row->status;

                              if ($status == 'progress') {
                                $status_button = '<label class="badge badge-warning">In progress</label>';
                              } else if ($status == 'completed') {
                                $status_button = '<label class="badge badge-success">Completed</label>';
                              } else if ($status == 'processed') {
                              $status_button = '<label class="badge badge-success">Processed</label>';                              
                              } else if ($status == 'rejected') {
                                $status_button = '<label class="badge badge-danger">Rejected</label>';

                              } else {

                                $status_button = '<label class="badge badge-primary">Unknown</label>';

                              }

                              $output .= '
                              <tr>
                              <td>'.$row->stocklevel_id.'</td>
                              <td>'.$row->unique_code.'</td>
                              <td>'.$row->project_name.'</td>
                              <td>'.$row->est_date_of_delivery.'</td>
                              <td>'.$row->stock_type.'</td>
                              <td>'.$status_button.'</td>
                              <td>
                                <a target="_blank" href="view_stock_manifest.php?code='.$row->unique_code.'"><button class="btn btn-outline-primary" >View</button></a>
                              </td>
                              </tr>
                              ';
                            }
                          }

                          echo $output;
											?>                      


                        <tr>
                          <td>1010</td>
                          <td>9Yy3gm5VIK</td>
                          <td>War On Poverty</td>
                          <td>14-Mar-2022</td>                          
                          <td>Dry Goods</td>
                          <td><label class="badge badge-danger">Pending</label></td>
                          <td>
                            <a href="view_delivery_register_01.html"><button class="btn btn-outline-primary" >View</button></a>
                          </td>                          
                        </tr>
                        <tr>
                          <td>1012</td>
                          <td>L21k5j7B4o</td>
                          <td>ART</td>
                          <td>13-Feb-2022</td>                          
                          <td>Dry Goods</td>
                          <td><label class="badge badge-warning">In progress</label></td>
                          <td>
                            <button class="btn btn-outline-primary">View</button>
                          </td>                           
                        </tr>
                        <tr>
                          <td>1018</td>
                          <td>uMoHfKgVW4</td>
                          <td>War On Poverty</td>
                          <td>12-Jan-2022</td>                          
                          <td>Vegetables</td>
                          <td><label class="badge badge-success">Completed</label></td>
                          <td>
                            <a href="view_delivery_register_03.html"><button class="btn btn-outline-primary" >View</button></a>
                          </td>                           
                        </tr>
                        <tr>
                          <td>1019</td>
                          <td>uMoHfKgVW4</td>
                          <td>War On Poverty</td>
                          <td>11-Jan-2022</td>                          
                          <td>Dry Goods</td>
                          <td><label class="badge badge-success">Completed</label></td>
                          <td>
                            <button class="btn btn-outline-primary">View</button>
                          </td>                           
                        </tr>
                        <tr>
                          <td>1020</td>
                          <td>gIfyWjZobS</td>
                          <td>ART</td>
                          <td>8-Dec-2021</td>                          
                          <td>Vegetables</td>
                          <td><label class="badge badge-success">Completed</label></td>
                          <td>
                            <button class="btn btn-outline-primary">View</button>
                          </td>                           
                        </tr>
                        <tr>
                          <td>1022</td>
                          <td>ruV2xOMfLc</td>
                          <td>ART</td>
                          <td>12-Nov-2021</td>                          
                          <td>Dry Goods</td>
                          <td><label class="badge badge-success">Completed</label></td>
                          <td>
                            <button class="btn btn-outline-primary">View</button>
                          </td>                           
                        </tr>
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


