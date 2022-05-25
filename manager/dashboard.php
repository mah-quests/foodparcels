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
                        <a class="nav-link active border-0"  id="more-tab" data-bs-toggle="tab" href="#" role="tab" aria-selected="false">Dashboard</a>
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
                              <p class="statistics-title">Parcels Delivered</p>
                              <h3 class="rate-percentage">62.13%</h3>
                              <p class="text d-flex"></i><span>monthly target</span></p>
                            </div>
                            <div>
                              <p class="statistics-title">Households</p>
                              <h3 class="rate-percentage">1,268</h3>
                            </div>
                            <div>
                              <p class="statistics-title">Beneficiaries</p>
                              <h3 class="rate-percentage">26,258</h3>
                            </div>
                            <div class="d-none d-md-block">
                              <p class="statistics-title">Avg. Time on Site</p>
                              <h3 class="rate-percentage">15m:55s</h3>
                            </div>
                            <div class="d-none d-md-block">
                              <p class="statistics-title">New Households</p>
                              <h3 class="rate-percentage">488</h3>
                            </div>
                            <div class="d-none d-md-block">
                              <p class="statistics-title">Verifications Completed</p>
                              <h3 class="rate-percentage">275</h3>
                            </div>
                          </div>
                        </div>
                      </div> 



                      <h3>Stock Level Percentage</h3><br>
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




                      <div class="row">
                        <div class="col-lg-12 d-flex flex-column">
                          <div class="row flex-grow">
                            <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                              <div class="card card-rounded">
                                <div class="card-body">
                                  <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                     <h4 class="card-title card-title-dash">Households Food Parcels Delivery</h4>
                                     <h5 class="card-subtitle card-subtitle-dash">Deliveries made throughout the provice in the past 2 weeks</h5>
                                   </div>
                                   <div id="performance-line-legend"></div>
                                 </div>
                                 <div class="chartjs-wrapper mt-5">
                                  <canvas id="performaneLine"></canvas>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Identified Households</h4>
                                    <p class="card-subtitle card-subtitle-dash">Households Identitified By The DSD Regional & Provincial Offices</p>
                                  </div>
                                  <div>
                                    <div class="dropdown">
                                      <button class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> This month </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        <h6 class="dropdown-header">Settings</h6>
                                        <a class="dropdown-item" href="#">Last Month</a>
                                        <a class="dropdown-item" href="#">Two Months Ago</a>
                                        <a class="dropdown-item" href="#">Three Months Ago</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Custom Dates</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                                  <div class="me-3"><div id="marketing-overview-legend"></div></div>
                                </div>
                                <div class="chartjs-bar-wrapper mt-3">
                                  <canvas id="marketingOverview"></canvas>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="col-lg-12 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">Distributed Food Parcels</h4>
                          <p class="card-description">
                            Food Parcels That Have Been Distributed In The Past Week
                          </p>
                          <div class="table-responsive">
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th>Transaction ID</th>
                                  <th>Full Names</th>
                                  <th>Phone</th>
                                  <th>Alt Number </th>
                                  <th>ID Number </th>
                                  <th>Address</th>
                                  <th>Actions</th>                       
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>51423</td>
                                  <td>Mzameni Mzameni</td>
                                  <td>0639925196</td>
                                  <td>-</td>
                                  <td>8611246082081</td>
                                  <td>
                                    Block 24/2 Jabulani Hostel
                                  </td>
                                  <td class="text-right">
                                    <button class="btn btn-light">
                                      <i class="ti-eye text-primary"></i>View
                                    </button>
                                  </td>
                                </tr>
                                <tr>
                                  <td>51422</td>
                                  <td>Sande Sande</td>
                                  <td>0661851197</td>
                                  <td>0619941100</td>
                                  <td>9703186039087</td>
                                  <td>
                                    Block 24/1 Jabulani Hostels
                                  </td>
                                  <td class="text-right">
                                    <button class="btn btn-light">
                                      <i class="ti-eye text-primary"></i>View
                                    </button>
                                  </td>
                                </tr>
                                <tr>
                                  <td>51421</td>
                                  <td>Thulani Thulani</td>
                                  <td>0661025577</td>
                                  <td>0833159838</td>
                                  <td>8409236284084</td>
                                  <td>
                                    Block 24/1 Jabulani Hostel
                                  </td>
                                  <td class="text-right">
                                    <button class="btn btn-light">
                                      <i class="ti-eye text-primary"></i>View
                                    </button>
                                  </td>
                                </tr>
                                <tr>
                                  <td>47882</td>
                                  <td>Siphiwe Hlongwane</td>
                                  <td>0627650519</td>
                                  <td></td>
                                  <td>9309145133084</td>
                                  <td>
                                    25033 Bopanang street
                                  </td>
                                  <td class="text-right">
                                    <button class="btn btn-light">
                                      <i class="ti-eye text-primary"></i>View
                                    </button>
                                  </td>
                                </tr>
                                <tr>
                                  <td>48407</td>
                                  <td>Sifiso Dloboyi</td>
                                  <td>0728482875</td>
                                  <td>0843189838</td>
                                  <td>9503015363082</td>
                                  <td>
                                   13566 Motha street 
                                 </td>
                                 <td class="text-right">
                                  <button class="btn btn-light">
                                    <i class="ti-eye text-primary"></i>View
                                  </button>
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
