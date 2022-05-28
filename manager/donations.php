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
                          Donations Summary
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
                  <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Donation Register Form</h4>
                        <form class="forms-sample">

                          <br><br>
                          <h6>
                            Organizations Details
                          </h6>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputName1">Organization Name</label>
                                <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter Organization Name">
                              </div>
                            </div>                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputName1">Registration  Numbers</label>
                                <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter Registration  Numbers">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputName1">Organization Address</label>
                                <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter Organization Address">
                              </div>
                            </div>                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputName1">Organization  Office Numbers</label>
                                <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter Registration  Office Numbers">
                              </div>
                            </div>                            
                          </div>                          

                          <h6>
                            Contact Person Details
                          </h6>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputName1">Full Names</label>
                                <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter Driver Full Names">
                              </div>
                            </div>                            
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputName1">Cellphone Number</label>
                                <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter Driver Cellphone Number">
                              </div>
                            </div>
                          </div>


                          <div class="form-group">
                            <label for="exampleFormControlSelect2">Stock Type</label>
                            <select class="form-control" id="stock_type" name="stock_type">
                              <option selected></option>
                              <option value="dry-goods">Dry Goods</option>
                              <option value="veggies">Vegetables</option>
                              <option value="other">Other</option>
                            </select>
                          </div>

                          <div class="row">
                            <div class="col-md-8">
                              <div class="form-group">
                                <label for="exampleInputName1">Description</label>
                                <textarea class="form-control" id="stock_type" name="stock_type" placeholder="Enter stock Description"></textarea>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="exampleInputName1">Quantity</label>
                                <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter Quantity Items">
                              </div>
                            </div>                            
                          </div>         

                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="exampleInputName1">Date of delivery</label>
                                <input type="date" class="form-control" id="exampleInputName1" placeholder="Choose Date">
                              </div>
                            </div>
                          </div>    

                          <div align="center">
                            <button type="button" class="btn btn-outline-primary btn-icon-text btn-lg">
                              <i class="ti-file btn-icon-prepend"></i>
                              Submit
                            </button>
                            <button type="button" class="btn btn-outline-warning btn-icon-text btn-lg">
                              <i class="ti-reload btn-icon-prepend"></i>                                                    
                              Reset
                            </button>
                          </div>

                        </form>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Donation History</h4>
                        <p class="card-description">
                          over the past 24 months
                        </p>
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>Transaction</th>
                                <th>Date</th>
                                <th>Donar Organization</th>
                                <th>Donar Names</th>
                                <th>Contact Number</th>                                
                                <th>Items Donated</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>101</td>
                                <td>15-Jan-2022</td>
                                <td>Samlam Foundation</td>
                                <td>Mathukana Mokoka</td>
                                <td>0842638331</td>                                
                                <td>School Shoes</td>
                                <td>
                                  <a href="#"><button class="btn btn-outline-primary" >View</button></a>
                                </td>                          
                              </tr>
                              <tr>
                                <td>102</td>
                                <td>5-Dec-2021</td>
                                <td>Tshikululu Foundations</td>
                                <td>Sindiswa Mjola</td>                          
                                <td>0768330076</td>
                                <td>Perishables</td>
                                <td>
                                  <button class="btn btn-outline-primary">View</button>
                                </td>                           
                              </tr>
                              <tr>
                                <td>103</td>
                                <td>15-Nov-2021</td>
                                <td>Gift of the givers</td>
                                <td>Andre Human</td>                          
                                <td>0795398141</td>
                                <td>Perishables</td>
                                <td>
                                  <a href="#"><button class="btn btn-outline-primary" >View</button></a>
                                </td>                           
                              </tr>
                              <tr>
                                <td>109</td>
                                <td>12-Jul-2021</td>
                                <td>Kazier Chiefs FC</td>
                                <td>Junior Motaung</td>                          
                                <td>0716241081</td>
                                <td>Perishables</td>
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

                  <br>
                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Bin List: Donations Activities</h4>
                        <p class="card-description">
                          over the past 12 months
                        </p>
                        <div class="table-responsive">
                          <table class="table table-hover">
                            <thead align="center">
                              <tr>
                                <th>Transaction</th>
                                <th>Reference</th>
                                <th>Action</th>
                                <th>Item</th>
                                <th>Floor Space</th>
                                <th>Unit(s)</th>
                                <th>Total</th>
                                <th>Actioned By</th>
                              </tr>
                            </thead>
                            <tbody align="center">
                              <tr>
                                <td>11</td>
                                <td>9Yy3gm5VIK</td>
                                <td>Food Parcel Pack</td>
                                <td>School Shoes</td>
                                <td>FL-SQ-04</td>
                                <td>1</td>                          
                                <td><b>49</b></td>
                                <td>Dlamini</td>
                              </tr>                              
                              <tr>
                                <td>12</td>
                                <td>L21k5j7B4o</td>
                                <td>Food Parcel Pack</td>
                                <td>School Shoes</td>
                                <td>FL-SQ-04</td>
                                <td>1</td>                          
                                <td><b>48</b></td>
                                <td>Dlamini</td>
                              </tr>   
                              <tr>
                                <td>13</td>
                                <td>uMoHfKgVW4</td>
                                <td>Food Parcel Pack</td>
                                <td>School Shoes</td>
                                <td>FL-SQ-04</td>
                                <td>1</td>                          
                                <td><b>47</b></td>
                                <td>Dlamini</td>
                              </tr>  
                              <tr>
                                <td>14</td>
                                <td>5iqgADz4xR</td>
                                <td>Donation Receivals</td>
                                <td>Perishables, Canned Fruits</td>
                                <td>FL-SQ-06</td>
                                <td>250</td>                          
                                <td><b>250</b></td>
                                <td>Victor Molotsane</td>
                              </tr> 
                              <tr>
                                <td>15</td>
                                <td>79GKMrbw0H</td>
                                <td>Donation Receivals</td>
                                <td>School Shoes</td>
                                <td>FL-SQ-06</td>
                                <td>1250</td>                          
                                <td><b>1297</b></td>
                                <td>Victor Molotsane</td>
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



<?php

  include_once "include/footer.php";

?>
