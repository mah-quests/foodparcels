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
                          Beneficiaries Polls & Service Ratings
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

                  <div class="col-md-12 grid-margin grid-margin-md-0 stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Beneficiaries Experiences and Ratings</h4>
                        <div class="template-demo">
                          <div class="d-flex justify-content-between mt-2">
                            <small>Quality Of Food</small>
                            <small>90%</small>
                          </div>
                          <div class="progress progress-xl">
                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="d-flex justify-content-between mt-3">
                            <small>Time Management</small>
                            <small>68%</small>
                          </div>
                          <div class="progress progress-xl">
                            <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="width: 68%" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="d-flex justify-content-between mt-3">
                            <small>Communication</small>
                            <small>55%</small>
                          </div>
                          <div class="progress progress-xl">
                            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="d-flex justify-content-between mt-3">
                            <small>Experience</small>
                            <small>35%</small>
                          </div>
                          <div class="progress progress-xl">
                            <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="d-flex justify-content-between mt-3">
                            <small>Friendliness</small>
                            <small>85%</small>
                          </div>
                          <div class="progress progress-xl">
                            <div class="progress-bar bg-dark progress-bar-striped progress-bar-animated" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <div class="d-flex justify-content-between mt-3">
                            <small>Issue Resolution</small>
                            <small>75%</small>
                          </div>
                          <div class="progress progress-xl">
                            <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <br><br>
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Individual Poll Feedback</h4>
                    <div class="row">
                      <div class="col-12">
                        <div class="table-responsive">
                          <table id="order-listing" class="table">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Full Names</th>
                                <th>Quality</th>
                                <th>Time<br> management</th>
                                <th>Communication</th>
                                <th>Experience</th>
                                <th>Friendliness</th>
                                <th>Issue<br> Resolution</th>                                
                                <th>Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>1</td>
                                <td>Aneziwe<br> Khetha</td>
                                <td>8</td>
                                <td>5</td>
                                <td>3</td>
                                <td>8</td>
                                <td>7</td>
                                <td>2</td>  
                                <td>
                                  <button class="btn btn-outline-primary">View</button>
                                </td>
                              </tr>
                              <tr>
                                <td>2</td>
                                <td>Sifiso <br> Ximba</td>
                                <td>8</td>
                                <td>7</td>
                                <td>9</td>
                                <td>1</td>
                                <td>7</td>
                                <td>2</td>  
                                <td>
                                  <button class="btn btn-outline-primary">View</button>
                                </td>
                              </tr>
                              <tr>
                                <td>3</td>
                                <td>Zwalipani <br> Ndlovu</td>
                                <td>2</td>
                                <td>2</td>
                                <td>2</td>
                                <td>0</td>
                                <td>1</td>
                                <td>2</td>  
                                <td>
                                  <button class="btn btn-outline-primary">View</button>
                                </td>
                              </tr>
                              <tr>
                                <td>4</td>
                                <td>Thulani <br> Sthole</td>
                                <td>8</td>
                                <td>9</td>
                                <td>10</td>
                                <td>8</td>
                                <td>7</td>
                                <td>2</td>  
                                <td>
                                  <button class="btn btn-outline-primary">View</button>
                                </td>
                              </tr>
                              <tr>
                                <td>5</td>
                                <td>Sande <br> Nyeza</td>
                                <td>4</td>
                                <td>5</td>
                                <td>8</td>
                                <td>1</td>
                                <td>9</td>
                                <td>5</td>  
                                <td>
                                  <button class="btn btn-outline-primary">View</button>
                                </td>
                              </tr>
                              <tr>
                                <td>6</td>
                                <td>Anna <br> Motshabi</td>
                                <td>6</td>
                                <td>6</td>
                                <td>3</td>
                                <td>9</td>
                                <td>2</td>
                                <td>1</td>  
                                <td>
                                  <button class="btn btn-outline-primary">View</button>
                                </td>
                              </tr>
                              <tr>
                                <td>7</td>
                                <td>Moshe <br> Sebela</td>
                                <td>9</td>
                                <td>9</td>
                                <td>3</td>
                                <td>7</td>
                                <td>3</td>
                                <td>9</td>  
                                <td>
                                  <button class="btn btn-outline-primary">View</button>
                                </td>
                              </tr>
                              <tr>
                                <td>8</td>
                                <td>Alice <br> Tsotetsi</td>
                                <td>8</td>
                                <td>9</td>
                                <td>4</td>
                                <td>3</td>
                                <td>7</td>
                                <td>9</td>  
                                <td>
                                  <button class="btn btn-outline-primary">View</button>
                                </td>
                              </tr>
                              <tr>
                                <td>9</td>
                                <td>Kedibone <br> Mogapi</td>
                                <td>4</td>
                                <td>7</td>
                                <td>4</td>
                                <td>9</td>
                                <td>1</td>
                                <td>4</td>  
                                <td>
                                  <button class="btn btn-outline-primary">View</button>
                                </td>
                              </tr>
                              <tr>
                                <td>10</td>
                                <td>Nombulelo <br> Thiso</td>
                                <td>9</td>
                                <td>9</td>
                                <td>3</td>
                                <td>0</td>
                                <td>4</td>
                                <td>3</td>  
                                <td>
                                  <button class="btn btn-outline-primary">View</button>
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
