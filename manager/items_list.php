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

                  <h3>War On Poverty (W-O-P) Stock Levels</h3><br>
                  <div class="row" align="center">
                    <div class="col-md-2 grid-margin">
                      <div class="card bg-facebook d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-white">W-O-P Stock</h6>
                              <h2 class="mt-2 card-text text-white">16%</h2>
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
                              <h2 class="mt-2 text-muted card-text">805</h2>
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
                              <h2 class="mt-2 text-muted card-text">811</h2>
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
                              <h6 class="text-dribbble">Cooking Oil</h6>
                              <h2 class="mt-2 text-muted card-text">821</h2>
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
                              <h6 class="text-reddit">Canned food</h6>
                              <h2 class="mt-2 text-muted card-text">1338</h2>
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
                              <h6 class="text-behance">Vegetables</h6>
                              <h2 class="mt-2 text-muted card-text">22%</h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>    

                  </div>


                  <div class="content-wrapper">
                    <div class="row">
                      <div class="col-12 grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Stock Details</h4>
                            <div class="row">
                              <div class="table-sorter-wrapper col-lg-12 table-responsive">
                                <table id="sortable-table-2" class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th class="sortStyle">Type<i class="ti-angle-down"></i></th>
                                      <th class="sortStyle">Item<i class="ti-angle-down"></i></th>
                                      <th class="sortStyle">Quantity<i class="ti-angle-down"></i></th>
                                      <th class="sortStyle">Expiry Date<i class="ti-angle-down"></i></th>
                                      <th class="sortStyle">Life Span (days)<i class="ti-angle-down"></i></th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                <?php
                                    $project_name="War+On+Poverty";
                                    $api_url = $APIBASE."stock_levels_exec.php?action=show_project_stock_details&location=".$location."&project_name=".$project_name."";
                                    $client = curl_init($api_url);
                                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                    $response = curl_exec($client);
                                    $result = json_decode($response);
                                    $bank_history_output = '';

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

                                        $wop_output .= '
                                        <tr>
                                        <td>'.$row->stockdetail_id.'</td>
                                        <td>'.$row->stock_type.'</td>
                                        <td>'.$row->stock_name.'</td>
                                        <td>'.$row->stock_level_amount.'</td>
                                        <td>'.$row->stock_exp_date.'</td>
                                        <td>'.$number_of_days.'</td>
                                        <td>
                                          <a href="wop_maizemeal_details.html"><button class="btn btn-outline-primary" >View</button></a>
                                        </td>
                                        </tr>
                                        ';
                                      }
                                    } else {
                                    $wop_output .= '
                                      <tr align="center">
                                        <td align="center"> No Data To Display </td>
                                      </tr>
                                      ';
                                  }

                                    echo $wop_output;
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



                  <h3>AntiRetroviral Treatment (ART) Stock Levels</h3><br>
                  <div class="row" align="center">
                    <div class="col-md-2 grid-margin">
                      <div class="card bg-facebook d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-white">A-R-T Stock</h6>
                              <h2 class="mt-2 card-text text-white">13%</h2>
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
                              <h2 class="mt-2 text-muted card-text">503</h2>
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
                              <h2 class="mt-2 text-muted card-text">770</h2>
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
                              <h2 class="mt-2 text-muted card-text">1440</h2>
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
                              <h2 class="mt-2 text-muted card-text">560</h2>
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
                              <h2 class="mt-2 text-muted card-text">380</h2>
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
                              <h6 class="text-google">Vegetables</h6>
                              <h2 class="mt-2 text-muted card-text">20%</h2>
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
                              <h6 class="text-linkedin">Canned food</h6>
                              <h2 class="mt-2 text-muted card-text">1000</h2>
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
                              <h6 class="text-dribbble">Soap</h6>
                              <h2 class="mt-2 text-muted card-text">1388</h2>
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
                              <h6 class="text-reddit">Soya Mince</h6>
                              <h2 class="mt-2 text-muted card-text">1690</h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                                         
                    
                  </div>


                  <div class="content-wrapper">
                    <div class="row">
                      <div class="col-12 grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Stock Details</h4>
                            <div class="row">
                              <div class="table-sorter-wrapper col-lg-12 table-responsive">
                                <table id="sortable-table-1" class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th class="sortStyle">Type<i class="ti-angle-down"></i></th>
                                      <th class="sortStyle">Item<i class="ti-angle-down"></i></th>
                                      <th class="sortStyle">Quantity<i class="ti-angle-down"></i></th>
                                      <th class="sortStyle">Expiry Date<i class="ti-angle-down"></i></th>
                                      <th class="sortStyle">Life Span (days)<i class="ti-angle-down"></i></th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                  <?php
                                    $project_name="ART";
                                    $api_url = $APIBASE."stock_levels_exec.php?action=show_project_stock_details&location=".$location."&project_name=".$project_name."";
                                    $client = curl_init($api_url);
                                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                    $response = curl_exec($client);
                                    $result = json_decode($response);
                                    $bank_history_output = '';

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

                                        $wop_output .= '
                                        <tr>
                                        <td>'.$row->stockdetail_id.'</td>
                                        <td>'.$row->stock_type.'</td>
                                        <td>'.$row->stock_name.'</td>
                                        <td>'.$row->stock_level_amount.'</td>
                                        <td>'.$row->stock_exp_date.'</td>
                                        <td>'.$number_of_days.'</td>
                                        <td>
                                          <a href="wop_maizemeal_details.html"><button class="btn btn-outline-primary" >View</button></a>
                                        </td>
                                        </tr>
                                        ';
                                      }
                                    } else {
                                    $wop_output .= '
                                      <tr align="center">
                                        <td align="center"> No Data To Display </td>
                                      </tr>
                                      ';
                                  }

                                    echo $wop_output;
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


                  <h3>Other Projects Stock Levels</h3><br>
                  <div class="row" align="center">
                    <div class="col-md-2 grid-margin">
                      <div class="card bg-facebook d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-white">Other Stock</h6>
                              <h2 class="mt-2 card-text text-white">28%</h2>
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
                              <h6 class="text-google">1L Fresh Milk</h6>
                              <h2 class="mt-2 text-muted card-text">112</h2>
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
                              <h6 class="text-linkedin">Gas Stove</h6>
                              <h2 class="mt-2 text-muted card-text">55</h2>
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
                              <h6 class="text-dribbble">Coffee Tins</h6>
                              <h2 class="mt-2 text-muted card-text">531</h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>


                  <div class="content-wrapper">
                    <div class="row">
                      <div class="col-12 grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Stock Details</h4>
                            <div class="row">
                              <div class="table-sorter-wrapper col-lg-12 table-responsive">
                                <table id="sortable-table-3" class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th class="sortStyle">Type<i class="ti-angle-down"></i></th>
                                      <th class="sortStyle">Item<i class="ti-angle-down"></i></th>
                                      <th class="sortStyle">Quantity<i class="ti-angle-down"></i></th>
                                      <th class="sortStyle">Expiry Date<i class="ti-angle-down"></i></th>
                                      <th class="sortStyle">Life Span (days)<i class="ti-angle-down"></i></th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>1</td>
                                      <td>Dry Goods</td>
                                      <td>1L Fresh Milk</td>
                                      <td>112</td>
                                      <td>2022-04-15</td>
                                      <td>45</td>
                                      <td>
                                        <a href="#"><button class="btn btn-outline-primary" >View</button></a>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>2</td>
                                      <td>Other</td>
                                      <td>Gas Stove</td>
                                      <td>55</td>
                                      <td>2024-12-31</td>
                                      <td>635</td>
                                      <td>
                                        <a href="#"><button class="btn btn-outline-primary" >View</button></a>
                                      </td>                                      
                                    </tr>
                                    <tr>
                                      <td>3</td>
                                      <td>Other</td>
                                      <td>Coffee Tins</td>
                                      <td>531</td>
                                      <td>2023-04-31</td>
                                      <td>435</td>
                                      <td>
                                        <a href="#"><button class="btn btn-outline-primary" >View</button></a>
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


