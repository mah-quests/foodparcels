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

                <br><br>
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                      <h4 class="card-title">Food Parcel Details</h4>
                        <form class="forms-sample">

                          <br><br>

                          <?php
                              $api_url = $APIBASE."foodpack_exec.php?action=show_foodpack_by_code&code=".$_GET["code"]."";
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
                            <u>Food Pack Details</u>
                          </h6>

                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="unique_code">Unique Code</label>
                                  <input type="text" class="form-control" id="unique_code" name="unique_code" value="<?php echo $row->unique_code ?>" readonly>
                                </div>
                              </div>                            
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="project_name">Project Name</label>
                                  <input type="text" class="form-control" id="project_name" name="project_name" value="<?php echo $row->project_name ?>" readonly>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="region">Region</label>
                                  <input type="text" class="form-control" id="region" name="region"  value="<?php echo $row->region ?>" readonly>
                                </div>
                              </div>   
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="foodpack_state">Location</label>
                                  <input type="text" class="form-control" id="foodpack_state" name="foodpack_state"  value="<?php echo $row->foodpack_state ?>" readonly>
                                </div>
                              </div>                                                                                    
                            </div>                            
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="pakaged_by">Packaged By</label>
                                  <input type="text" class="form-control" id="pakaged_by" name="pakaged_by" value="<?php echo $row->pakaged_by ?>" readonly>
                                </div>
                              </div>                            
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="package_date">Packaged Date</label>
                                  <input type="text" class="form-control" id="package_date" name="package_date" value="<?php echo $row->package_date ?>" readonly>
                                </div>
                              </div>                             
                            </div>                            


                          <?php 
                                }
                              }

                          ?>

                        <br><br>
                        <h6>
                          <u>List Of Food Pack Items</u>
                        </h6>
                        <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Reference</th>
                                <th>Stock Type</th>
                                <th>Stock Name</th>
                                <th>Stock Brand</th>
                                <th>Manufactured Date</th>
                                <th>Expiry Date</th>
                              </tr>
                            </thead>
                            <tbody>

                            <?php
                                $api_url = $APIBASE."foodpack_exec.php?action=list_foodpack_by_code&code=".$_GET["code"]."";
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
                                    <td>'.$row->fp_detail_id.'</td>
                                    <td>'.$row->unique_code.'</td>
                                    <td>'.$row->stock_type.'</td>
                                    <td>'.$row->stock_name.'</td>
                                    <td>'.$row->stock_brand.'</td>
                                    <td>'.$row->stock_man_date.'</td>
                                    <td>'.$row->stock_exp_date.'</td>
                                    </tr>
                                    ';

                                  }
                                }

                                echo $output;
                            ?> 

                            </tbody>
                          </table>
                        <br>

                        <div align="center">
                          <img src="../qr-code/<?php echo $row->unique_code ?>.png"  alt="QR Code" width="200">
                        </div>

                        <div class="container-fluid w-100" align="center" >
                          <a href="food_parcels.php" class="btn btn-success float-right mt-4"><i class="ti ti-arrow-left"></i> &nbsp;&nbsp; Back</a>
                          <a href="print_foodparcel_slip.php?code=<?php echo $row->unique_code ?>" class="btn btn-primary float-right mt-4 ms-2" style="color:white"><i class="ti-printer me-1" ></i>Print</a>
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


