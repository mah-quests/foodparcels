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

                <?php 

                  
                  $api_url = $APIBASE."stock_levels_exec.php?action=show_region_total&location=".$location."";
                  $client = curl_init($api_url);
                  curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                  $response = curl_exec($client);
                  $result = json_decode($response);

                  foreach($result as $row)
                  {
                    $ceiling = 16600;
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

                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                      <h4 class="mb-3 mt-5" align="center">View Food Parcels At Different Lifecycle Stages</h4>
                      <p class="w-75 mx-auto mb-5" align="center">To view the food parcels at different stages, from creating new food pack, to food packages in transit, and food packages delivered to beneficiaries.</p>
                        <div class="row pricing-table">

                          <?php
                            $api_url = $APIBASE."foodpack_exec.php?action=show_foodpack_stage&location=".$location."";
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


                          <div class="col-md-4 col-xl-4 grid-margin stretch-card pricing-card">
                            <div class="card border-primary border pricing-card-body">
                              <div class="text-center pricing-card-head">
                                <h3 class="text-primary">New <br>Food Packs</h3>
                                <p>#</p>
                                <h1 class="fw-normal mb-4"><?php echo $row->pack_in_foodbank ?></h1>
                              </div>
                              <ul class="list-unstyled plan-features">
                              </ul>
                              <div class="wrapper" align="center">
                                <a href="food_parcels.php#stock" >
                                  <input type='button' class="btn btn-outline-primary btn-block btn-lg"  value='View'>
                                </a>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 col-xl-4 grid-margin stretch-card pricing-card">
                            <div class="card border border-success pricing-card-body">
                              <div class="text-center pricing-card-head">
                                <h3 class="text-success">Food Packs In Transit</h3>
                                <p>#</p>
                                <h1 class="fw-normal mb-4"><?php echo $row->pack_in_transit ?></h1>
                              </div>
                              <ul class="list-unstyled plan-features">
                              </ul>
                              <div class="wrapper" align="center">
                              <a href="food_parcels.php#transit" >
                                <input type='button' class="btn btn-success btn-block btn-lg"  value='View'>
                              </a>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 col-xl-4 grid-margin stretch-card pricing-card">
                            <div class="card border border-danger pricing-card-body">
                              <div class="text-center pricing-card-head">
                                <h3 class="text-danger">Delivered Food Packs</h3>
                                <p>#</p>
                                <h1 class="fw-normal mb-4"><?php echo $row->pack_delivered ?></h1>
                              </div>
                              <ul class="list-unstyled plan-features">
                              </ul>
                              <div class="wrapper" align="center">
                                <a href="food_parcels.php#delivered" >
                                  <input type='button' class="btn btn-outline-danger btn-block btn-lg"  value='View '>
                                </a>
                              </div>                                  
                            </div>
                          </div>

                          <?php
                              }
                            }
                          ?>    


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


                    <?php
                    $api_url = $APIBASE."beneficiary_details_exec.php?action=show_beneficiary_stages&location=".$location."";
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
                  
                  <br><br>
                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                      <h4 class="mb-3 mt-5" align="center">View Beneficiaries At Different Lifecycle Stages</h4>
                      <p class="w-75 mx-auto mb-5" align="center">To view the beneficiaries at different stages, from creating new beneficiaries, to eligable beneficiaries, and then post support beneficiaries.</p>
                        <div class="row pricing-table">
                          <div class="col-md-4 col-xl-4 grid-margin stretch-card pricing-card">
                            <div class="card border-primary border pricing-card-body">
                              <div class="text-center pricing-card-head">
                                <h3 class="text-primary">New <br>Beneficiaries</h3>
                                <p># no-deliveries</p>
                                <h1 class="fw-normal mb-4"><?php echo $row->tot_new_users ?></h1>
                              </div>
                              <ul class="list-unstyled plan-features">
                              </ul>
                              <div class="wrapper" align="center">
                                <a href="beneficiary_stages.php#new" >
                                  <input type='button' class="btn btn-outline-primary btn-block btn-lg"  value='View'>
                                </a>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 col-xl-4 grid-margin stretch-card pricing-card">
                            <div class="card border border-success pricing-card-body">
                              <div class="text-center pricing-card-head">
                                <h3 class="text-success">Eligable Beneficiaries</h3>
                                <p>1 - 3 deliveries</p>
                                <h1 class="fw-normal mb-4"><?php echo $row->tot_delivered_users ?></h1>
                              </div>
                              <ul class="list-unstyled plan-features">
                              </ul>
                              <div class="wrapper" align="center">
                              <a href="beneficiary_stages.php#delivered" >
                                <input type='button' class="btn btn-success btn-block btn-lg"  value='View'>
                              </a>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 col-xl-4 grid-margin stretch-card pricing-card">
                            <div class="card border border-danger pricing-card-body">
                              <div class="text-center pricing-card-head">
                                <h3 class="text-danger">Post-Support Beneficiaries</h3>
                                <p># post intevension</p>
                                <h1 class="fw-normal mb-4"><?php echo $row->tot_completed_users ?></h1>
                              </div>
                              <ul class="list-unstyled plan-features">
                              </ul>
                              <div class="wrapper" align="center">
                                <a href="beneficiary_stages.php#post-delivery" >
                                  <input type='button' class="btn btn-outline-primary btn-block btn-lg"  value='View '>
                                </a>
                              </div>                                  
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <?php
                      }
                    }
                  ?>
                  
                  <div class="col-lg-12 grid-margin stretch-card" id="delivered" >
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
                                <th>#</th>
                                <th>Distribution <br> Date Time</th>
                                <th>Full Names</th>
                                <th>Phone</th>
                                <th>ID Number </th>                                
                                <th>Address</th>
                                <th>No of <br>Deliveries</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>

                            <?php
                                // Update the API end-point
                                $api_url = $APIBASE."beneficiary_details_exec.php?action=show_20_delivered_headofhouse&location=".$location."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);
                                $delivered_output = '';

                                if(count($result) > 0)
                                {
                                  foreach($result as $row)
                                  {


                                    $delivered_output .= '
                                    <tr>
                                    <td>'.$row->hoh_id.'</td>
                                    <td>'.$row->hoh_date_time.'</td>
                                    <td>'.$row->first_name.' '.$row->surname.'</td>
                                    <td>'.$row->cellphone.'</td>
                                    <td>'.$row->id_number.'</td>
                                    <td>'.$row->home_address.'</td>
                                    <td>'.$row->no_delivery_times.'</td>
                                    <td>
                                      <a target="_blank" href="view_beneficiary_details.php?code='.$row->unique_code.'"><button class="btn btn-outline-primary">View</button></a>
                                    </td>                                    
                                    </tr>
                                    ';
                                  }
                                }

                                echo $delivered_output;
                                
                            ?> 

                            <?php
                                // Update the API end-point
                                $api_url = $APIBASE."beneficiary_details_exec.php?action=show_20_postdelivered_headofhouse&location=".$location."";
                                $client = curl_init($api_url);
                                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                                $response = curl_exec($client);
                                $result = json_decode($response);
                                $delivered_output = '';

                                if(count($result) > 0)
                                {
                                  foreach($result as $row)
                                  {


                                    $delivered_output .= '
                                    <tr>
                                    <td>'.$row->hoh_id.'</td>
                                    <td>'.substr($row->hoh_date_time, 0, 11).'</td>
                                    <td>'.$row->first_name.' '.$row->surname.'</td>
                                    <td>'.$row->cellphone.'</td>
                                    <td>'.$row->id_number.'</td>
                                    <td>'.$row->home_address.'</td>
                                    <td>'.$row->no_delivery_times.'</td>
                                    <td>
                                      <a target="_blank" href="view_beneficiary_details.php?code='.$row->unique_code.'"><button class="btn btn-outline-primary">View</button></a>
                                    </td>
                                    </tr>
                                    ';
                                  }
                                }

                                echo $delivered_output;
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
