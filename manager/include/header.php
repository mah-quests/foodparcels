<?php 
error_reporting(0);
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>DSD Web App - Manager Portal </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/feather/feather.css">
  <link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="../js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>
<body>
  <div class="container-scroller">

    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="dashboard.php">
            <img src="../images/dsd-logo.png" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini" href="dashboard.php">
            <img src="../images/dsd-logo.png" alt="logo" />
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
          <h1 class="welcome-text">Welcome back, <span class="text-black fw-bold"><?php echo $_SESSION['name'] ?></span></h1>
            <h3 class="welcome-sub-text">Performance Summary For <?php echo $_SESSION['region'] ?> Distribution Center </h3>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown d-none d-lg-block">
            <a class="nav-link dropdown-bordered dropdown-toggle dropdown-toggle-split" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false"> Select Category </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
              <a class="dropdown-item py-3" >
                <p class="mb-0 font-weight-medium float-left">Select category</p>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">Stock Management</p>
                  <p class="fw-light small-text mb-0">To see stock management throughout all regions</p>
                </div>
              </a>
              <a  class="dropdown-item preview-item">
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">Idetified Households</p>
                  <p class="fw-light small-text mb-0">To see all identified households throughout all regions</p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">Food Deliveries</p>
                  <p class="fw-light small-text mb-0">To see all food delivered throughout all regions</p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">Reports</p>
                  <p class="fw-light small-text mb-0">To see a list of different reports for all regions</p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item d-none d-lg-block">
            <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
              <span class="input-group-addon input-group-prepend border-right">
                <span class="icon-calendar input-group-text calendar-icon"></span>
              </span>
              <input type="text" class="form-control">
            </div>
          </li>
          <li class="nav-item">
            <form class="search-form" action="#">
              <i class="icon-search"></i>
              <input type="search" class="form-control" placeholder="Search Here" title="Search here">
            </form>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
              <i class="icon-mail icon-lg"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
              <a class="dropdown-item py-3 border-bottom">
                <p class="mb-0 font-weight-medium float-left">You have 4 new notifications </p>
                <span class="badge badge-pill badge-primary float-right">View all</span>
              </a>
              <a class="dropdown-item preview-item py-3">
                <div class="preview-thumbnail">
                  <i class="mdi mdi-alert m-auto text-primary"></i>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject fw-normal text-dark mb-1">Report Generated</h6>
                  <p class="fw-light small-text mb-0"> Just now </p>
                </div>
              </a>
              <a class="dropdown-item preview-item py-3">
                <div class="preview-thumbnail">
                  <i class="mdi mdi-settings m-auto text-primary"></i>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject fw-normal text-dark mb-1">Settings</h6>
                  <p class="fw-light small-text mb-0"> Private message </p>
                </div>
              </a>
              <a class="dropdown-item preview-item py-3">
                <div class="preview-thumbnail">
                  <i class="mdi mdi-airballoon m-auto text-primary"></i>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject fw-normal text-dark mb-1">New user registration</h6>
                  <p class="fw-light small-text mb-0"> 2 days ago </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown"> 
            <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="icon-bell"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="countDropdown">
              <a class="dropdown-item py-3">
                <p class="mb-0 font-weight-medium float-left">You have 3 unread mails </p>
                <span class="badge badge-pill badge-primary float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                </div>
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark"> Ithemba Lethu Foods </p>
                  <p class="fw-light small-text mb-0"> Goods Delivery scheduled for the 15th March created </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                </div>
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark"> Ithemba Lethu Foods </p>
                  <p class="fw-light small-text mb-0"> Response to damaged goods returned on the 14th February </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                </div>
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">Thato Mohono </p>
                  <p class="fw-light small-text mb-0"> Distribution Center System feature updates </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="../images/faces/DavidM.png" alt="Profile image"> </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <p class="mb-1 mt-3 font-weight-semibold">Thato Mohono</p>
                  <p class="fw-light text-muted mb-0">thato.mohono@gmail.com</p>
                </div>
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile <span class="badge badge-pill badge-danger">1</span></a>
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i> Messages</a>
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i> Activity</a>
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> FAQ</a>
                <a class="dropdown-item" href="../index.php"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        <div class="theme-setting-wrapper">
          <div id="settings-trigger"><i class="ti-settings"></i></div>
          <div id="theme-settings" class="settings-panel">
            <i class="settings-close ti-close"></i>
            <p class="settings-heading">SIDEBAR SKINS</p>
            <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border me-3"></div>Light</div>
            <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border me-3"></div>Dark</div>
            <p class="settings-heading mt-2">HEADER SKINS</p>
            <div class="color-tiles mx-0 px-4">
              <div class="tiles success"></div>
              <div class="tiles warning"></div>
              <div class="tiles danger"></div>
              <div class="tiles info"></div>
              <div class="tiles dark"></div>
              <div class="tiles default"></div>
            </div>
          </div>
        </div>
        <div id="right-sidebar" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="todo-tab" data-bs-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="chats-tab" data-bs-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
            </li>
          </ul>
        </div>
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->

        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">DASHBOARD</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#regions" aria-expanded="false" aria-controls="ui-advanced">
                <i class="menu-icon ti ti-angle-double-right"></i>
                <span class="menu-title">REGIONS</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="regions">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="#">Jo'burg</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">Sedibeng</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">Tshwane</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">West Rand</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">Ekurhuleni</a></li>
                </ul>
              </div>
            </li>          
            <li class="nav-item nav-category">SUPPLIER MGNT</li>
            <li class="nav-item">
              <a class="nav-link" href="notifications.php">
                <i class="menu-icon ti ti-announcement"></i>
                <span class="menu-title">Notifications</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="goods_receivables.php">
                <i class="menu-icon ti ti-check-box"></i>
                <span class="menu-title">Goods Receivables</span>
              </a>
            </li>          
            <li class="nav-item">
              <a class="nav-link" href="donations.php">
                <i class="menu-icon ti ti-gift"></i>
                <span class="menu-title">Donations </span>
              </a>
            </li>  
            <li class="nav-item">
              <a class="nav-link" href="damages_returns.php">
                <i class="menu-icon ti ti-back-left"></i>
                <span class="menu-title">Damages & Returns </span>
              </a>
            </li>             
            <li class="nav-item nav-category">PACKAGING MGNT</li>
            <li class="nav-item">
              <a class="nav-link" href="stock_level.php">
                <i class="menu-icon ti ti-align-justify"></i>
                <span class="menu-title">Stock Level</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="items_list.php">
                <i class="menu-icon ti ti-menu"></i>
                <span class="menu-title">Items List</span>
              </a>
            </li>          
            <li class="nav-item">
              <a class="nav-link" href="floor_plan.php">
                <i class="menu-icon mdi mdi-border-inside"></i>
                <span class="menu-title">Floor Plan </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="add_food_pack.html">
                <i class="menu-icon ti ti-plus"></i>
                <span class="menu-title">Add Food Packs </span>
              </a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="food_parcels.html">
                <i class="menu-icon icon icon-bag"></i>
                <span class="menu-title">Food Parcels </span>
              </a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="damages_returns.html">
                <i class="menu-icon ti ti-back-left"></i>
                <span class="menu-title">Damages & Returns </span>
              </a>
            </li>
            <li class="nav-item nav-category">BENEFICIARY MGNT</li>
            <li class="nav-item">
              <a class="nav-link" href="add_beneficiary.html">
                <i class="menu-icon icon icon-user-follow"></i>
                <span class="menu-title">Add Beneficiary</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="list_beneficiary.html">
                <i class="menu-icon icon icon-list"></i>
                <span class="menu-title">All Beneficiaries</span>
              </a>
            </li>   
            <li class="nav-item">
              <a class="nav-link" href="beneficiary_analysis.php">
                <i class="menu-icon icon icon-graph"></i>
                <span class="menu-title">Beneficiaries Analysis</span>
              </a>
            </li>                      
            <li class="nav-item">
              <a class="nav-link" href="distribution_plan.html">
                <i class="menu-icon ti ti-direction-alt"></i>
                <span class="menu-title">Food Distribution Plan </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="beneficiary_stages.html">
                <i class="menu-icon ti ti-split-h"></i>
                <span class="menu-title">Beneficiaries Stages </span>
              </a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="beneficiary_polls.html">
                <i class="menu-icon ti ti-comments"></i>
                <span class="menu-title">Beneficiary Polls </span>
              </a>
            </li>  
            <li class="nav-item nav-category">SECURITY CHECK</li>
            <li class="nav-item">
              <a class="nav-link" href="pack_intransit.html">
                <i class="menu-icon ti ti-car"></i>
                <span class="menu-title">Food Packs Transit</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="food_pack_stages.html">
                <i class="menu-icon ti ti-layers-alt"></i>
                <span class="menu-title">Food Packs Stages</span>
              </a>
            </li>          
            <li class="nav-item">
              <a class="nav-link" href="food_pack_return.html">
                <i class="menu-icon ti ti-shift-left"></i>
                <span class="menu-title">Food Packs Return </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="security_all_activities.html">
                <i class="menu-icon ti ti-align-left"></i>
                <span class="menu-title">All Activities </span>
              </a>
            </li> 
            <li class="nav-item nav-category">FOOD DELIVERIES</li>
            <li class="nav-item">
              <a class="nav-link" href="door2door_deliveries.html">
                <i class="menu-icon mdi mdi-home"></i>
                <span class="menu-title">Door to door</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="central_deliveries.html">
                <i class="menu-icon mdi mdi-google-circles-extended"></i>
                <span class="menu-title">Central</span>
              </a>
            </li>          
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="menu-icon mdi mdi-account-multiple-outline"></i>
                <span class="menu-title">All Deliveries </span>
              </a>
            </li>
            <li class="nav-item nav-category">REPORTS</li>
            <li class="nav-item">
              <a class="nav-link" href="delivery_reports.html">
                <i class="menu-icon mdi mdi-file-hidden"></i>
                <span class="menu-title">Delivery Reports</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="menu-icon mdi mdi-file-outline"></i>
                <span class="menu-title">Stock Management Report</span>
              </a>
            </li>          
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="menu-icon mdi mdi-cash-usd"></i>
                <span class="menu-title">Finance Report </span>
              </a>
            </li>                                      
          </ul>
        </nav>  


