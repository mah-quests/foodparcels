<?php
  include_once "include/header.php";
  include("../config/connect.php");
  error_reporting(0);
  session_start();
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
                          Beneficiaries Data Analysis
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
                  <div class="row" >
                    <div class="col-12" >
                      <div class="card bg-gradient-x-info">
                        <div class="card-content">
                          <div class="row">   
                            <?php include 'graphs/respondents_age_race.php'; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <br><br>

                  <div class="row" >
                    <div class="col-12" >
                      <div class="card bg-gradient-x-info">
                        <div class="card-content">
                          <div class="row">   
                            <?php include 'graphs/sector_religions.php'; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <br><br>

                  <div class="row" >
                    <div class="col-12" >
                      <div class="card bg-gradient-x-info">
                        <div class="card-content">
                          <div class="row">   
                            <?php include 'graphs/sector_genders.php'; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <br><br>

                  <div class="row" >
                    <div class="col-12" >
                      <div class="card bg-gradient-x-info">
                        <div class="card-content">
                          <div class="row">   
                            <?php include 'graphs/sector_sex_pronouns.php'; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <br><br>

                  <div class="row" >
                    <div class="col-12" >
                      <div class="card bg-gradient-x-info">
                        <div class="card-content">
                          <div class="row">   
                            <?php include 'graphs/sector_disabilities.php'; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <br><br>

                  <div class="row" >
                    <div class="col-12" >
                      <div class="card bg-gradient-x-info">
                        <div class="card-content">
                          <div class="row">   
                            <?php include 'graphs/sector_employment.php'; ?>
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
