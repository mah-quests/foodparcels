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

                  <h3>War On Poverty (WOP) Stock Levels</h3><br>

                <?php 

                  $project_name = "War+On+Poverty";
                  $api_url = $APIBASE."stock_levels_exec.php?action=show_region_total_project&location=".$location."&project_name=".$project_name."";
                  $client = curl_init($api_url);
                  curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                  $response = curl_exec($client);
                  $result = json_decode($response);

                  foreach($result as $row)
                  {
                    
                    $ceiling = 16400;
                    $region_totals = $row->total;
                    $stock_percentage = ($region_totals / $ceiling) * 100;

                  }
                  ?>   

                  <div class="row" align="center">
                    <div class="col-md-2 grid-margin">
                      <div class="card bg-facebook d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-white">WOP Stock % </h6>
                              <h2 class="mt-2 card-text text-white"><?php echo number_format((float)$stock_percentage, 2, '.', ''); ?>%</h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <?php 

                      $project_name = "War+On+Poverty";
                      $stock_name = "Maize+Meal";
                      $api_url = $APIBASE."stock_levels_exec.php?action=stock_name_total_region&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                      $client = curl_init($api_url);
                      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                      $response = curl_exec($client);
                      $result = json_decode($response);

                      foreach($result as $row)
                      {   

                        if($row->total == ""){
                          $total = 0;
                        } else {
                          $total = $row->total;
                        }
                        
                      ?>                    

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-google">Maize-Meal</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $total ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <?php 

                      }

                      $project_name = "War+On+Poverty";
                      $stock_name = "Rice";
                      $api_url = $APIBASE."stock_levels_exec.php?action=stock_name_total_region&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                      $client = curl_init($api_url);
                      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                      $response = curl_exec($client);
                      $result = json_decode($response);

                      foreach($result as $row)
                      {   

                        if($row->total == ""){
                          $total = 0;
                        } else {
                          $total = $row->total;
                        }   
                        
                      ?>

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-linkedin">Rice</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $total ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <?php 

                      }

                      $project_name = "War+On+Poverty";
                      $stock_name = "Sugar";
                      $api_url = $APIBASE."stock_levels_exec.php?action=stock_name_total_region&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
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
                              <h2 class="mt-2 text-muted card-text"><?php echo $total ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  <?php 

                    }

                    $project_name = "War+On+Poverty";
                    $stock_name = "Cooking+Oil";
                    $api_url = $APIBASE."stock_levels_exec.php?action=stock_name_total_region&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);

                    foreach($result as $row)
                    {   

                      if($row->total == ""){
                        $total = 0;
                      } else {
                        $total = $row->total;
                      }                                               
                    
                    ?>

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-reddit">Cooking Oil</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $total ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <?php 

                      }

                      $project_name = "War+On+Poverty";
                      $stock_name = "Tea";
                      $api_url = $APIBASE."stock_levels_exec.php?action=stock_name_total_region&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                      $client = curl_init($api_url);
                      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                      $response = curl_exec($client);
                      $result = json_decode($response);

                      foreach($result as $row)
                      {   

                        if($row->total == ""){
                          $total = 0;
                        } else {
                          $total = $row->total;
                        }                                               
                      
                      ?>    
                  
                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-behance">Tea</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $total ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>    


                    <div class="col-md-2 grid-margin">
                    </div>  

              <?php 

                }

                $project_name = "War+On+Poverty";
                $stock_name = "Baked+Beans";
                $api_url = $APIBASE."stock_levels_exec.php?action=stock_name_total_region&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                $client = curl_init($api_url);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                $result = json_decode($response);

                foreach($result as $row)
                {   

                  if($row->total == ""){
                    $total = 0;
                  } else {
                    $total = $row->total;
                  }                                               
                
                ?>                       

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-linkedin">Baked Beans</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $total ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>  

                    <?php 

                      }

                      $project_name = "War+On+Poverty";
                      $stock_name = "All+Purpose+Soap";
                      $api_url = $APIBASE."stock_levels_exec.php?action=stock_name_total_region&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                      $client = curl_init($api_url);
                      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                      $response = curl_exec($client);
                      $result = json_decode($response);

                      foreach($result as $row)
                      {   

                        if($row->total == ""){
                          $total = 0;
                        } else {
                          $total = $row->total;
                        }                                               
                      
                      ?>                      

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-linkedin">Soap</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $total ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> 

                    <?php 

                      }

                      $project_name = "War+On+Poverty";
                      $stock_name = "Soya+Mince";
                      $api_url = $APIBASE."stock_levels_exec.php?action=stock_name_total_region&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                      $client = curl_init($api_url);
                      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                      $response = curl_exec($client);
                      $result = json_decode($response);

                      foreach($result as $row)
                      {   

                        if($row->total == ""){
                          $total = 0;
                        } else {
                          $total = $row->total;
                        }                                               
                      
                      ?>                      

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-dribbble">Soya Mince</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $total ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> 

                <?php 

                  }

                  $project_name = "War+On+Poverty";
                  $stock_name = "Cabbage";
                  $api_url = $APIBASE."stock_levels_exec.php?action=stock_name_total_region&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                  $client = curl_init($api_url);
                  curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                  $response = curl_exec($client);
                  $result = json_decode($response);

                  foreach($result as $row)
                  {   

                    if($row->total == ""){
                      $total = 0;
                    } else {
                      $total = $row->total;
                    }                                               
                  
                  ?>  

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-reddit">Cabbage</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $total ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                                         

                  <?php 

                    }

                    $project_name = "War+On+Poverty";
                    $stock_name = "Potatoes";
                    $api_url = $APIBASE."stock_levels_exec.php?action=stock_name_total_region&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);

                    foreach($result as $row)
                    {   

                      if($row->total == ""){
                        $total = 0;
                      } else {
                        $total = $row->total;
                      }                                               
                    
                    ?>  

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-behance">Potatoes</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $total ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>  

                    <div class="col-md-2 grid-margin">
                    </div>                    

                  <?php 

                    }

                    $project_name = "War+On+Poverty";
                    $stock_name = "Pumpkin";
                    $api_url = $APIBASE."stock_levels_exec.php?action=stock_name_total_region&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);

                    foreach($result as $row)
                    {   

                      if($row->total == ""){
                        $total = 0;
                      } else {
                        $total = $row->total;
                      }                                               
                    
                    ?>  

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-behance">Pumpkin</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $total ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>  
                    
                 <?php 
                    } 
                  ?>                                       


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
                                    $wop_output = '';

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
                                          <a href="#"><button class="btn btn-outline-primary" >View</button></a>
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




                <?php 

                  $project_name = "ART";
                  $api_url = $APIBASE."stock_levels_exec.php?action=show_region_total_project&location=".$location."&project_name=".$project_name."";
                  $client = curl_init($api_url);
                  curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                  $response = curl_exec($client);
                  $result = json_decode($response);

                  foreach($result as $row)
                  {
                    
                    $ceiling = 16400;
                    $region_totals = $row->total;
                    $stock_percentage = ($region_totals / $ceiling) * 100;

                  }
                  ?>   

                  <div class="row" align="center">
                    <div class="col-md-2 grid-margin">
                      <div class="card bg-facebook d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-white">WOP Stock % </h6>
                              <h2 class="mt-2 card-text text-white"><?php echo number_format((float)$stock_percentage, 2, '.', ''); ?>%</h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <?php 

                      $project_name = "ART";
                      $stock_name = "Maize+Meal";
                      $api_url = $APIBASE."stock_levels_exec.php?action=stock_name_total_region&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                      $client = curl_init($api_url);
                      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                      $response = curl_exec($client);
                      $result = json_decode($response);

                      foreach($result as $row)
                      {   

                        if($row->total == ""){
                          $total = 0;
                        } else {
                          $total = $row->total;
                        }
                        
                      ?>                    

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-google">Maize-Meal</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $total ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <?php 

                      }

                      $project_name = "ART";
                      $stock_name = "Rice";
                      $api_url = $APIBASE."stock_levels_exec.php?action=stock_name_total_region&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                      $client = curl_init($api_url);
                      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                      $response = curl_exec($client);
                      $result = json_decode($response);

                      foreach($result as $row)
                      {   

                        if($row->total == ""){
                          $total = 0;
                        } else {
                          $total = $row->total;
                        }   
                        
                      ?>

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-linkedin">Rice</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $total ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <?php 

                      }

                      $project_name = "ART";
                      $stock_name = "Sugar";
                      $api_url = $APIBASE."stock_levels_exec.php?action=stock_name_total_region&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
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
                              <h2 class="mt-2 text-muted card-text"><?php echo $total ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  <?php 

                    }

                    $project_name = "ART";
                    $stock_name = "Cooking+Oil";
                    $api_url = $APIBASE."stock_levels_exec.php?action=stock_name_total_region&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);

                    foreach($result as $row)
                    {   

                      if($row->total == ""){
                        $total = 0;
                      } else {
                        $total = $row->total;
                      }                                               
                    
                    ?>

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-reddit">Cooking Oil</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $total ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <?php 

                      }

                      $project_name = "ART";
                      $stock_name = "Tea";
                      $api_url = $APIBASE."stock_levels_exec.php?action=stock_name_total_region&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                      $client = curl_init($api_url);
                      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                      $response = curl_exec($client);
                      $result = json_decode($response);

                      foreach($result as $row)
                      {   

                        if($row->total == ""){
                          $total = 0;
                        } else {
                          $total = $row->total;
                        }                                               
                      
                      ?>    
                  
                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-behance">Tea</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $total ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>    


                    <div class="col-md-2 grid-margin">
                    </div>  

              <?php 

                }

                $project_name = "ART";
                $stock_name = "Baked+Beans";
                $api_url = $APIBASE."stock_levels_exec.php?action=stock_name_total_region&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                $client = curl_init($api_url);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                $result = json_decode($response);

                foreach($result as $row)
                {   

                  if($row->total == ""){
                    $total = 0;
                  } else {
                    $total = $row->total;
                  }                                               
                
                ?>                       

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-linkedin">Baked Beans</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $total ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>  

                    <?php 

                      }

                      $project_name = "ART";
                      $stock_name = "All+Purpose+Soap";
                      $api_url = $APIBASE."stock_levels_exec.php?action=stock_name_total_region&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                      $client = curl_init($api_url);
                      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                      $response = curl_exec($client);
                      $result = json_decode($response);

                      foreach($result as $row)
                      {   

                        if($row->total == ""){
                          $total = 0;
                        } else {
                          $total = $row->total;
                        }                                               
                      
                      ?>                      

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-linkedin">Soap</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $total ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> 

                    <?php 

                      }

                      $project_name = "ART";
                      $stock_name = "Soya+Mince";
                      $api_url = $APIBASE."stock_levels_exec.php?action=stock_name_total_region&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                      $client = curl_init($api_url);
                      curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                      $response = curl_exec($client);
                      $result = json_decode($response);

                      foreach($result as $row)
                      {   

                        if($row->total == ""){
                          $total = 0;
                        } else {
                          $total = $row->total;
                        }                                               
                      
                      ?>                      

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-dribbble">Soya Mince</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $total ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> 

                <?php 

                  }

                  $project_name = "ART";
                  $stock_name = "Cabbage";
                  $api_url = $APIBASE."stock_levels_exec.php?action=stock_name_total_region&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                  $client = curl_init($api_url);
                  curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                  $response = curl_exec($client);
                  $result = json_decode($response);

                  foreach($result as $row)
                  {   

                    if($row->total == ""){
                      $total = 0;
                    } else {
                      $total = $row->total;
                    }                                               
                  
                  ?>  

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-reddit">Cabbage</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $total ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                                         

                  <?php 

                    }

                    $project_name = "ART";
                    $stock_name = "Potatoes";
                    $api_url = $APIBASE."stock_levels_exec.php?action=stock_name_total_region&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);

                    foreach($result as $row)
                    {   

                      if($row->total == ""){
                        $total = 0;
                      } else {
                        $total = $row->total;
                      }                                               
                    
                    ?>  

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-behance">Potatoes</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $total ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>  

                    <div class="col-md-2 grid-margin">
                    </div>                    

                  <?php 

                    }

                    $project_name = "ART";
                    $stock_name = "Pumpkin";
                    $api_url = $APIBASE."stock_levels_exec.php?action=stock_name_total_region&location=".$location."&stock_name=".$stock_name."&project_name=".$project_name."";
                    $client = curl_init($api_url);
                    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($client);
                    $result = json_decode($response);

                    foreach($result as $row)
                    {   

                      if($row->total == ""){
                        $total = 0;
                      } else {
                        $total = $row->total;
                      }                                               
                    
                    ?>  

                    <div class="col-md-2 grid-margin">
                      <div class="card d-flex align-items-center">
                        <div class="card-body">
                          <div class="d-flex flex-row align-items-center">
                            <i class=""></i>
                            <div class="ms-3">
                              <h6 class="text-behance">Pumpkin</h6>
                              <h2 class="mt-2 text-muted card-text"><?php echo $total ?></h2>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>  
                    
                 <?php 
                    } 
                  ?>                                       


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

                                        $art_output .= '
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
                                    $art_output .= '
                                      <tr align="center">
                                        <td align="center"> No Data To Display </td>
                                      </tr>
                                      ';
                                  }

                                    echo $art_output;
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
                              <h2 class="mt-2 card-text text-white">0%</h2>
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


