<?php
  include_once "include/header.php";
  include("../config/connect.php");
  error_reporting(0);
  session_start();

  $location = $_SESSION['region'];
  $project_name = "%";

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
                          Food Bank Stock Levels
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

                  <h3><?php echo $_SESSION['region'].' ' ?>  - Stock Levels</h3><br>

                <?php 

                  
                  $api_url = $APIBASE."stock_levels_exec.php?action=view_all_stock_levels&location=".$location."";
                  $client = curl_init($api_url);
                  curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                  $response = curl_exec($client);
                  $result = json_decode($response);

                  foreach($result as $row)
                  {
                    
                    $ceiling = 16600;

                    $stock_percentage = ($row->total_project_stock / $ceiling) * 100;


                  ?>   

                  <div class="row" align="center">
                    <div class="col-md-2 grid-margin">
                      <div class="card bg-facebook d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-white"> Stock % </h6>
                              <h2 class="mt-2 card-text text-white"><?php echo number_format((float)$stock_percentage, 2, '.', ''); ?>%</h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-google">Maize-Meal</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $row->total_maize_meal ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-linkedin">Rice</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $row->total_rice ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-dribbble">Sugar</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $row->total_sugar ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-reddit">Cooking Oil</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $row->total_cooking_oil ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  
                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-behance">Tea</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $row->total_tea ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>    


                    <div class="col-md-2 grid-margin">
                    </div>                  

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-linkedin">Baked Beans</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $row->total_baked_beans ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>  

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-linkedin">Soap</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $row->total_all_purpose_soap ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> 

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-dribbble">Soya Mince</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $row->total_soya_mince ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> 

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-reddit">Cabbage</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $row->total_cabbage ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                                         

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-behance">Potatoes</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $row->total_potatoes ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>  

                    <div class="col-md-2 grid-margin">
                    </div>                    


                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-behance">Pumpkin</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $row->total_pumpkin ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>  
                    
                 <?php 
                    } 
                  ?>                                       


              </div>

                <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Stock Details</h4>
                      <div class="row">
                        <div class="col-12">
                          <div class="table-responsive">
                            <table id="order-listing" class="table">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Stock Type</th>
                                    <th>Stock Name</th>
                                    <th>Qty</th>
                                    <th>Man. Date</th>
                                    <th>Exp Date</th>
                                    <th>Life Span</th>
                                    <th>Allocated Space</th>
                                </tr>
                              </thead>
                              <tbody>

                              <?php
                                    
                                    $api_url = $APIBASE."stock_levels_exec.php?action=show_region_stock_details&location=".$location."";
                                    $client = curl_init($api_url);
                                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                    $response = curl_exec($client);
                                    $result = json_decode($response);
                                    $art_output = '';

                                    if(count($result) > 0)
                                    {
                                        foreach($result as $row)
                                        {

                                        $man_date= $row->stock_man_date;
                                        $exp_date= $row->stock_exp_date;
                                        $number_of_days = (strtotime($exp_date) - strtotime($man_date)) / (60 * 60 * 24);

                                        if ($row->stock_name == "Potatoes"){
                                            $number_of_days = 61;
                                        }

                                        if ($row->stock_name == "Cabbage"){
                                            $number_of_days = 91;
                                        }    
                                        
                                        if ($row->stock_name == "Pumpkin"){
                                            $number_of_days = 56;
                                        }                                            

                                ?>  


                              <tr>
                                    <td><?php echo $row->allocation_id ?></td>
                                    <td><?php echo $row->stock_type ?></td>
                                    <td><?php echo $row->stock_name ?></td>
                                    <td><?php echo $row->items_qty ?></td>
                                    <td><?php echo $row->stock_man_date ?></td>
                                    <td><?php echo $row->stock_exp_date ?></td>
                                    <td><?php echo $number_of_days ?></td>
                                    <td><?php echo $row->allocated_floor_space ?></td>
                                </tr>

                                <?php 
                                        } 
                                    }
                                ?>

                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> 


                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Unallocated Stock</h4>
                        <div class="row">
                            <div class="table-sorter-wrapper col-lg-12 table-responsive">
                            <table id="sortable-table-2" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="sortStyle">Date Delivered<i class="ti-angle-down"></i></th>
                                    <th class="sortStyle">Stock Type<i class="ti-angle-down"></i></th>
                                    <th class="sortStyle">Stock Details<i class="ti-angle-down"></i></th>
                                    <th class="sortStyle">Quantity<i class="ti-angle-down"></i></th>
                                    <th class="sortStyle">Manufactured<br> Date<i class="ti-angle-down"></i></th>
                                    <th class="sortStyle">Expiry Date<i class="ti-angle-down"></i></th>
                                    <th class="sortStyle">Allocated<br> Space<i class="ti-angle-down"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                        
                                    $api_url = $APIBASE."delivery_notice_exec.php?action=show_foodbank_stock&location=".$_SESSION['region']."";
                                    $client = curl_init($api_url);
                                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                    $response = curl_exec($client);
                                    $result = json_decode($response);
                                    $art_output = '';

                                    if(count($result) > 0)
                                    {
                                        foreach($result as $row)
                                        {

                                            $row_id = $row->stockdetail_id;
                                                if($row->allocated != "allocated" && $row->allocated != "partial"){

                                ?>  


                                <tr>
                                        <td><?php echo $row->stockdetail_id ?></td>
                                        <td><?php echo $row->create_date_time ?></td>
                                        <td><?php echo $row->stock_type ?></td>
                                        <td><?php echo $row->stock_name.', '.$row->stock_brand ?></td>
                                        <td><?php echo $row->stock_level_amount ?></td>
                                        <td><?php echo $row->stock_man_date ?></td>
                                        <td><?php echo $row->stock_exp_date ?></td>
                                        <td>-</td>
                                    </tr>

                                    <?php 
                                            } 
                                        }
                                    } 
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

<script src="../vendors/js/vendor.bundle.base.js"></script>
<script src="../vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="../vendors/datatables.net/jquery.dataTables.js"></script>
<script src="../vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="../js/off-canvas.js"></script>
<script src="../js/hoverable-collapse.js"></script>
<script src="../js/template.js"></script>
<script src="../js/settings.js"></script>
<script src="../js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="../js/data-table.js"></script>


<?php

  include_once "include/footer.php";

?>


