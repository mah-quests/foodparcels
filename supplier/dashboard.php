<?php
  include_once "include/header.php";
  include("../config/connect.php");
  error_reporting(0);
  session_start();

  $location = $_SESSION['region'];

?>


      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link ps-0" href="../index.php" >Back</a>
                    </li>
                    <li> 
                      
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active border-0"  id="more-tab" data-bs-toggle="tab" href="#joburg" role="tab" aria-selected="false">Jo’burg</a>
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
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="statistics-details d-flex align-items-center justify-content-between">
                          <div>
                            <p class="statistics-title">Contract Number</p>
                            <h3 class="rate-percentage">2021/098/89</h3>
                          </div>
                          <div>
                            <p class="statistics-title">Contract Duration</p>
                            <h3 class="rate-percentage">(7)/24</h3>
                          </div>
                          <div>
                            <p class="statistics-title">Next Delivery</p>
                            <h3 class="rate-percentage">15-Mar-2022</h3>
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">Avg. Time on Site</p>
                            <h3 class="rate-percentage">6 hrs</h3>
                          </div>
                            <div class="d-none d-md-block">
                              <p class="statistics-title">New Requests</p>
                              <h3 class="rate-percentage">3</h3>
                            </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">Avg Resolution Time</p>
                            <h3 class="rate-percentage">1.5 days</h3>
                          </div>
                        </div>
                      </div>
                    </div> 

                  <h3>Stock Level Percentage</h3><br>

                <?php 

                  
                  $api_url = $APIBASE."stock_levels_exec.php?action=show_region_total&location=".$location."";
                  $client = curl_init($api_url);
                  curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                  $response = curl_exec($client);
                  $result = json_decode($response);

                  foreach($result as $row)
                  {
                    $ceiling = 31400;
                    $region_totals = $row->total;
                    $stock_percentage = ($region_totals / $ceiling) * 100;

                  ?>  

                  <div class="row" align="center">
                    <div class="col-md-2 grid-margin">
                      <div class="card bg-facebook d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-white">Joburg Stock</h6>
                              <h2 class="mt-2 card-text text-white"><?php echo number_format((float)$stock_percentage, 2, '.', ''); ?>%</h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                <?php 
                
                  }

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

                  <div class="row" align="center">
                    <div class="content-wrapper">
                      <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">Stock Levels At The Distribution Center</h4>
                              <canvas id="barChart"></canvas>
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
