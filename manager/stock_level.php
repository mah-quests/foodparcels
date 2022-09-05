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

              <?php 

                $api_url = $APIBASE."stock_levels_exec.php?action=view_all_stock_levels&location=".$location."";
                $client = curl_init($api_url);
                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($client);
                $result = json_decode($response);

                foreach($result as $row)
                {

              ?>  

              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Allocated Stock Levels Breakdown</h4>
                    <div class="mt-4">
                      <div class="accordion accordion-bordered" id="accordion-2" role="tablist">
                        <div class="card">
                            <?php include '../graphs/stock_levels.php'; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <?php 
                  } 
              ?>


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
                              <h6 class="text-white"><? echo $_SESSION['region'] ?> Stock % </h6>
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


                <?php 

                  $project_name = "War+On+Poverty";
                  $api_url = $APIBASE."stock_levels_exec.php?action=view_stock_levels&location=".$location."&project_name=".$project_name."";
                  $client = curl_init($api_url);
                  curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                  $response = curl_exec($client);
                  $result = json_decode($response);

                  foreach($result as $row)
                  {
                    
                    $ceiling = 16600;

                    $stock_percentage = ($row->total_project_stock / $ceiling) * 100;


                  ?>                    

                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Allocated Stock Levels Breakdown</h4>
                        <div class="mt-4">
                          <div class="accordion accordion-bordered" id="accordion-2" role="tablist">
                            <div class="card">
                              <div class="card-header" role="tab" id="heading-4">
                                <h6 class="mb-0">
                                  <a data-bs-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                    War On Poverty - Stock Levels - [<?php echo number_format((float)$stock_percentage, 2, '.', ''); ?> % ] 
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
                                          <h3 class="popover-header" align="center">Maize Meal</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_maize_meal ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-warning">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Rice</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_rice ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-danger">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Sugar</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_sugar ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-info">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Cooking Oil</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_cooking_oil ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-primary">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Tea</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_tea ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-success">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Baked Beans</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_baked_beans ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-warning">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Soap</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_all_purpose_soap ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-danger">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Soya Mince</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_soya_mince ?></h1>
                                          </div>
                                        </div>


                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-info">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Cabbage</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_cabbage ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-primary">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Potatoes</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_potatoes ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-success">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Pumpkin</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_pumpkin ?></h1>
                                          </div>
                                        </div>

                                        <?php 
                                          }
                                        ?>                                        

                                        <div class="clearfix"></div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>


                            <?php 

                              $project_name = "ART";
                              $api_url = $APIBASE."stock_levels_exec.php?action=view_stock_levels&location=".$location."&project_name=".$project_name."";
                              $client = curl_init($api_url);
                              curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
                              $response = curl_exec($client);
                              $result = json_decode($response);

                              foreach($result as $row)
                              {
                                $ceiling = 15000;
                                $stock_percentage = ($row->total_project_stock / $ceiling) * 100;

                              ?>             


                            <div class="card">
                              <div class="card-header" role="tab" id="heading-5">
                                <h6 class="mb-0">
                                  <a class="collapsed" data-bs-toggle="collapse" href="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                                   AntiRetroviral Treatment (ART) - [<?php echo number_format((float)$stock_percentage, 2, '.', ''); ?> % ] 
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
                                          <h3 class="popover-header" align="center">Maize Meal</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_maize_meal ?></h1>
                                          </div>
                                        </div>


                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-warning">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Rice</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_rice ?></h1>
                                          </div>
                                        </div>
                                        
                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-danger">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Sugar</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_sugar ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-info">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Cooking Oil</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_cooking_oil ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-primary">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Tea</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_tea ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-success">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Baked Beans</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_baked_beans ?></h1>
                                          </div>
                                        </div>


                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-warning">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Soap</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_all_purpose_soap ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-danger">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Soya Mince</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_soya_mince ?></h1>
                                          </div>
                                        </div>


                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-info">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Cabbage</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_cabbage ?></h1>
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

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-primary">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Potatoes</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $total ?></h1>
                                          </div>
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

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-success">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Pumpkin</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $total ?></h1>
                                          </div>
                                        </div>

                                        <?php 
                                          }
                                        ?>                                        

                                        <div class="clearfix"></div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>


                            </div>

                            <?php $stock_percentage = 0 ?>

                            <div class="card">
                              <div class="card-header" role="tab" id="heading-8">
                                <h6 class="mb-0">
                                  <a data-bs-toggle="collapse" href="#collapse-8" aria-expanded="false" aria-controls="collapse-8">
                                    Special Projects - Stock Levels - [<?php echo number_format((float)$stock_percentage, 2, '.', ''); ?> % ] 
                                  </a>
                                </h6>
                              </div>
                              <div id="collapse-8" class="collapse" role="tabpanel" aria-labelledby="heading-8" data-bs-parent="#accordion-8">
                                <div class="card-body">
                                  <div class="card" align="center">
                                    <div class="card-body">
                                      <div class="popover-static-demo">
                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-success">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Maize Meal</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_maize_meal ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-warning">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Rice</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_rice ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-danger">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Sugar</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_sugar ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-info">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Cooking Oil</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_cooking_oil ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-primary">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Tea</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_tea ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-success">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Baked Beans</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_baked_beans ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-warning">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Soap</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_all_purpose_soap ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-danger">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Soya Mince</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_soya_mince ?></h1>
                                          </div>
                                        </div>


                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-info">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Cabbage</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_cabbage ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-primary">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Potatoes</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_potatoes ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-success">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Pumpkin</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_pumpkin ?></h1>
                                          </div>
                                        </div>                                     

                                        <div class="clearfix"></div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>


                            <?php $stock_percentage = 0 ?>
                            <div class="card">
                              <div class="card-header" role="tab" id="heading-8">
                                <h6 class="mb-0">
                                  <a data-bs-toggle="collapse" href="#collapse-8" aria-expanded="false" aria-controls="collapse-8">
                                    Donations - Stock Levels - [<?php echo number_format((float)$stock_percentage, 2, '.', ''); ?> % ] 
                                  </a>
                                </h6>
                              </div>
                              <div id="collapse-8" class="collapse" role="tabpanel" aria-labelledby="heading-8" data-bs-parent="#accordion-8">
                                <div class="card-body">
                                  <div class="card" align="center">
                                    <div class="card-body">
                                      <div class="popover-static-demo">
                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-success">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Maize Meal</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_maize_meal ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-warning">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Rice</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_rice ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-danger">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Sugar</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_sugar ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-info">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Cooking Oil</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_cooking_oil ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-primary">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Tea</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_tea ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-success">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Baked Beans</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_baked_beans ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-warning">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Soap</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_all_purpose_soap ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-danger">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Soya Mince</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_soya_mince ?></h1>
                                          </div>
                                        </div>


                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-info">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Cabbage</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_cabbage ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-primary">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Potatoes</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_potatoes ?></h1>
                                          </div>
                                        </div>

                                        <div class="popover bs-popover-bottom bs-popover-bottom-demo popover-success">
                                          <div class="arrow"></div>
                                          <h3 class="popover-header" align="center">Pumpkin</h3>
                                          <div class="popover-body">
                                            <h1 align="center"><?php echo $row->total_pumpkin ?></h1>
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
                                  Other Projects - [0%]
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
                                          <h1 align="center">0%</h1>
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
