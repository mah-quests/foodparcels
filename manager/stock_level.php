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
                          Distribution Center Stock Levels
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


                  <div class="row" align="center">
                    <div class="content-wrapper">
                      <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">Overall Stock Levels </h4>
                              <canvas id="barChart"></canvas>
                            </div>
                          </div>
                        </div>            
                      </div>
                    </div>
                  </div>

                  <h3>Overall Stock Levels</h3><br>
                  <div class="row" align="center">
                    <div class="col-md-2 grid-margin">
                      <div class="card bg-facebook d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-white">Joburg Stock</h6>
                              <h2 class="mt-2 card-text text-white">30%</h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                <?php 

                  $stock_name = "Maize+Meal";
                  $api_url = $APIBASE."stock_levels_exec.php?action=show_region_stock_details&location=".$location."&stock_name=".$stock_name."";
                  $client = curl_init($api_url);
                  curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                  $response = curl_exec($client);
                  $result = json_decode($response);

                  foreach($result as $row)
                  {

                  ?>                       

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-google">Maize-Meal</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $row->current_stock_level ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  <?php 
                    }

                    $stock_name = "Rice";
                    $api_url = $APIBASE."stock_levels_exec.php?action=show_region_stock_details&location=".$location."&stock_name=".$stock_name."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);
  
                    foreach($result as $row)
                    {
                    
                  ?>

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-linkedin">Rice</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $row->current_stock_level ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  <?php 

                    }

                    $stock_name = "Sugar";
                    $api_url = $APIBASE."stock_levels_exec.php?action=show_region_stock_details&location=".$location."&stock_name=".$stock_name."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);
  
                    foreach($result as $row)
                    {
                    
                  ?>                    

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-dribbble">Sugar</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $row->current_stock_level ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  <?php 
                  
                    }

                    $stock_name = "Cooking+Oil";
                    $api_url = $APIBASE."stock_levels_exec.php?action=show_region_stock_details&location=".$location."&stock_name=".$stock_name."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);
  
                    foreach($result as $row)
                    {
                    
                  ?>   

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-reddit">Cooking Oil</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $row->current_stock_level ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  <?php 
                  
                    }

                    $stock_name = "Tea";
                    $api_url = $APIBASE."stock_levels_exec.php?action=show_region_stock_details&location=".$location."&stock_name=".$stock_name."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);
  
                    foreach($result as $row)
                    {
                    
                  ?>   
                  

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-behance">Tea</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $row->current_stock_level ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>    

                <?php 

                    } 

                ?>

                    <div class="col-md-2 grid-margin">
                    </div>

                  <?php 
                  
                    $stock_name = "Baked+Beans";
                    $api_url = $APIBASE."stock_levels_exec.php?action=show_region_stock_details&location=".$location."&stock_name=".$stock_name."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);
  
                    foreach($result as $row)
                    {
                    
                  ?>                       

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-linkedin">Baked Beans</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $row->current_stock_level ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>  

                  <?php 
                  
                    }

                    $stock_name = "All+Purpose+Soap";
                    $api_url = $APIBASE."stock_levels_exec.php?action=show_region_stock_details&location=".$location."&stock_name=".$stock_name."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);
  
                    foreach($result as $row)
                    {
                    
                  ?>                       

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-linkedin">Soap</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $row->current_stock_level ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> 

                  <?php 
                  
                    }

                    $stock_name = "Soya+Mince";
                    $api_url = $APIBASE."stock_levels_exec.php?action=show_region_stock_details&location=".$location."&stock_name=".$stock_name."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);
  
                    foreach($result as $row)
                    {
                    
                  ?>                    

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-dribbble">Soya Mince</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $row->current_stock_level ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> 

                  <?php 
                  
                    }

                    $stock_name = "Cabbage";
                    $api_url = $APIBASE."stock_levels_exec.php?action=show_region_stock_details&location=".$location."&stock_name=".$stock_name."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);
  
                    foreach($result as $row)
                    {
                    
                  ?>  

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-reddit">Cabbage</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $row->current_stock_level ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                                         

                  <?php 
                  
                    }

                    $stock_name = "Potatoes";
                    $api_url = $APIBASE."stock_levels_exec.php?action=show_region_stock_details&location=".$location."&stock_name=".$stock_name."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);
  
                    foreach($result as $row)
                    {
                    
                  ?>  

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-behance">Potatoes</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $row->current_stock_level ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>  

                    <div class="col-md-2 grid-margin">
                    </div>                    

                  <?php 
                  
                    }

                    $stock_name = "Pumpkin";
                    $api_url = $APIBASE."stock_levels_exec.php?action=show_region_stock_details&location=".$location."&stock_name=".$stock_name."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);
  
                    foreach($result as $row)
                    {
                    
                  ?>  

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-behance">Pumpkin</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $row->current_stock_level ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>  
                    
                 <?php 
                    } 
                  ?>                                       


                  </div>


                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Stock Levels Breakdown</h4>
                        <div class="mt-4">
                          <div class="accordion accordion-bordered" id="accordion-2" role="tablist">
                            <div class="card">
                              <div class="card-header" role="tab" id="heading-4">
                                <h6 class="mb-0">
                                  <a data-bs-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                    War On Poverty - Stock Levels - [16%]
                                  </a>
                                </h6>
                              </div>
                              <div id="collapse-4" class="collapse" role="tabpanel" aria-labelledby="heading-4" data-bs-parent="#accordion-2">
                                <div class="card-body">


                                  <div class="card" align="center">
                                    <div class="card-body">
                                      <div class="popover-static-demo">
                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-success">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Maize-Meal</h3>
                                          <div class="popover-body">
                                            <h1 align="center">805</h1>
                                          </div>
                                        </div>
                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-warning">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Rice</h3>
                                          <div class="popover-body">
                                            <h1 align="center">811</h1>
                                          </div>
                                        </div>
                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-danger">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Cooking Oil</h3>
                                          <div class="popover-body">
                                            <h1 align="center">821</h1>
                                          </div>
                                        </div>
                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-info">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Canned food</h3>
                                          <div class="popover-body">
                                            <h1 align="center">1338</h1>
                                          </div>
                                        </div>
                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-primary">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Vegetables</h3>
                                          <div class="popover-body">
                                            <h1 align="center">22%</h1>
                                          </div>
                                        </div>
                                        <div class="clearfix"></div>
                                      </div>
                                    </div>
                                  </div>
                                  


                                </div>
                              </div>
                            </div>
                            <div class="card">
                              <div class="card-header" role="tab" id="heading-5">
                                <h6 class="mb-0">
                                  <a class="collapsed" data-bs-toggle="collapse" href="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                                   AntiRetroviral Treatment (ART) - [13%]
                                 </a>
                               </h6>
                             </div>
                             <div id="collapse-5" class="collapse" role="tabpanel" aria-labelledby="heading-5" data-bs-parent="#accordion-2">
                              <div class="card-body">

                                <div class="card" align="center">
                                  <div class="card-body">
                                    <div class="popover-static-demo">
                                      <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-success">
                                        <div class="arrow"></div>
                                        <h3 class="popover-header" align="center">Maize-Meal</h3>
                                        <div class="popover-body">
                                          <h1 align="center">503</h1>
                                        </div>
                                      </div>
                                      <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-warning">
                                        <div class="arrow"></div>
                                        <h3 class="popover-header" align="center">Rice</h3>
                                        <div class="popover-body">
                                          <h1 align="center">770</h1>
                                        </div>
                                      </div>
                                      <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-danger">
                                        <div class="arrow"></div>
                                        <h3 class="popover-header" align="center">Sugar</h3>
                                        <div class="popover-body">
                                          <h1 align="center">1440</h1>
                                        </div>
                                      </div>
                                      <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-info">
                                        <div class="arrow"></div>
                                        <h3 class="popover-header" align="center">Cooking Oil</h3>
                                        <div class="popover-body">
                                          <h1 align="center">560</h1>
                                        </div>
                                      </div>
                                      <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-primary">
                                        <div class="arrow"></div>
                                        <h3 class="popover-header" align="center">Tea</h3>
                                        <div class="popover-body">
                                          <h1 align="center">380</h1>
                                        </div>
                                      </div>
                                      <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-success">
                                        <div class="arrow"></div>
                                        <h3 class="popover-header" align="center">Vegetables</h3>
                                        <div class="popover-body">
                                          <h1 align="center">20%</h1>
                                        </div>
                                      </div>
                                      <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-warning">
                                        <div class="arrow"></div>
                                        <h3 class="popover-header" align="center">Canned food</h3>
                                        <div class="popover-body">
                                          <h1 align="center">1000</h1>
                                        </div>
                                      </div>
                                      <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-danger">
                                        <div class="arrow"></div>
                                        <h3 class="popover-header" align="center">Soap</h3>
                                        <div class="popover-body">
                                          <h1 align="center">1388</h1>
                                        </div>
                                      </div>
                                      <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-info">
                                        <div class="arrow"></div>
                                        <h3 class="popover-header" align="center">Soya Mince</h3>
                                        <div class="popover-body">
                                          <h1 align="center">1690</h1>
                                        </div>
                                      </div>                   
                                      <div class="clearfix"></div>
                                    </div>
                                  </div>
                                </div>



                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" role="tab" id="heading-6">
                              <h6 class="mb-0">
                                <a class="collapsed" data-bs-toggle="collapse" href="#collapse-5" aria-expanded="true" aria-controls="collapse-5">
                                  Other Projects - [1%]
                                </a>
                              </h6>
                            </div>
                            <div id="collapse-6" class="collapse show" role="tabpanel" aria-labelledby="heading-6" data-bs-parent="#accordion-2">
                              <div class="card-body">


                                <div class="card" align="center">
                                  <div class="card-body">
                                    <div class="popover-static-demo">
                                      <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-success">
                                        <div class="arrow"></div>
                                        <h3 class="popover-header" align="center">Other</h3>
                                        <div class="popover-body">
                                          <h1 align="center">28%</h1>
                                        </div>
                                      </div>
                                      <div class="clearfix"></div>
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
