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
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Goods Delivery Stock Line Items - <span color:blue> Reference <?php echo $_GET['code'] ?></span></h4>
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
                          <th>Expiry Date</th>
                        </tr>
                      </thead>
                      <tbody>

											<?php
                          $api_url = $APIBASE."delivery_notice_exec.php?action=show_supplier_stock_detail&code=".$_GET['code']."";
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
                              <td>'.$row->stockdetail_id.'</td>
                              <td>'.$row->create_date.'</td>
                              <td>'.$row->stock_type.'</td>
                              <td>'.$row->stock_name.', '.$row->stock_brand.'</td>
                              <td>'.$row->stock_level_amount.'</td>
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


