<?php 
error_reporting(0);
session_start();

if($_SESSION['role'] != "manager"){
  session_destroy ();
  header("refresh:1;url=../index.php");

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Gauteng Food Distribution Centre Automation System</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/feather/feather.css">
  <link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
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



<style type="text/css">
  .DDlist { display:none; }
</style>

<script type="text/javascript">
      var categories = [];
      categories["startList"] = ["Western Cape", "Eastern Cape", 'Northern Cape', 'North West', 'Free State', 'Kwazulu Natal', 'Gauteng', 'Limpopo', 'Mpumalanga']; // Level 1  (True|False is 1 level only)

      categories["Western Cape"] = ["Cape Winelands District Municipality", "Central Karoo District Municipality", "Garden Route District Municipality", "Overberg District Municipality", "West Coast District Municipality", "City of Cape Town Metropolitan"];
      // Level 2
      categories["Cape Winelands District Municipality"] = ["Witzenberg", "Drakenstein", "Stellenbosch", "Breede Valley", "Langeberg"];
      categories["Central Karoo District Municipality"] = ["Laingsburg", "Prince Albert", "Beaufort West"];
      categories["Garden Route District Municipality"] = ["Kannaland", "Hessequa", "Mossel Bay", "George", "Oudtshoorn", "Bitou", "Knysna"];
      categories["Overberg District Municipality"] = ["Theewaterskloof", "Overstrand Cape", "Agulhas", "Swellendam"];
      categories["West Coast District Municipality"] = ["Matzikama", "Cederberg", "Bergrivier", "Saldanha Bay", "Swartland"];
      categories["City of Cape Town Metropolitan"] = ["City of Cape Town"];

      categories["Eastern Cape"] = ["Alfred Nzo District Municipality", "Amathole District Municipality", "Chris Hani District Municipality", "Joe Gqabi District Municipality", "OR Tambo District Municipality", "Sarah Baartman District Municipality", "Nelson Mandela Bay Metropolitan", "Buffalo City Metropolitan"]; // Level 2
      categories["Alfred Nzo District Municipality"] = ["Matatiele", "Mbizana", "Ntabankulu", "Umzimvubu"]; // Level 3 only
      categories["Amathole District Municipality"] = ["Mnquma", "Mbhashe", "Amahlathi", "Ngqushwa", "Great Kei", "Raymond Mhlaba"]; // Level 3 only
      categories["Chris Hani District Municipality"] = ["Intsika Yethu", "Enoch Mgijima", "Engcobo", "Emalahleni", "Inxuba Yethemba", "Sakhisizwe"];
      categories["Joe Gqabi District Municipality"] = ["Elundini", "Senqu", "Walter Sisulu"]; // Level 3 only
      categories["OR Tambo District Municipality"] = ["King Sabata Dalindyebo Local Municipality", "Nyandeni", "Ngquza Hill", "Mhlontlo", "Port St Johns"]; // Level 3 only
      categories["Sarah Baartman District Municipality"] = ["Blue Crane Route", "Dr Beyers Naudé", "Kou-Kamma", "Kouga", "Makana", "Ndlambe", "Sunday's River Valley"];
      categories["Buffalo City Metropolitan"] = ["Buffalo City"];
      categories["Nelson Mandela Bay Metropolitan"] = ["Nelson Mandela Bay Municipality"];

      categories["Northern Cape"] = ["Frances Baard District Municipality", "John Taolo Gaetsewe District Municipality", "Namakwa District Municipality", "Pixley ka Seme District Municipality", "ZF Mgcawu District Municipality"];
      categories["Frances Baard District Municipality"] = ["Sol Plaatje", "Dikgatlong", "Magareng", "Phokwane"];
      categories["John Taolo Gaetsewe District Municipality"] = ["Joe Morolong", "Ga-Segonyana", "Gamagara"];
      categories["Namakwa District Municipality"] = ["Richtersveld", "Nama Khoi", "Kamiesberg", "Hantam", "Karoo Hoogland", "Khâi-Ma"];
      categories["Pixley ka Seme District Municipality"] = ["Ubuntu", "Umsobomvu", "Emthanjeni", "Kareeberg", "Renosterberg", "Thembelihle", "Siyathemba", "Siyancuma"];
      categories["ZF Mgcawu District Municipality"] = ["Dawid Kruiper", "Kai ǃGarib", "ǃKheis", "Tsantsabane", "Kgatelopele"];

      categories["North West"] = ["Bojanala Platinum", "Ngaka Modiri Molema", "Dr Ruth Segomotsi Mompati", "Dr Kenneth Kaunda"];
      categories["Bojanala Platinum"] = ["Moretele", "Madibeng", "Rustenburg", "Kgetlengrivier", "Moses Kotane"];
      categories["Ngaka Modiri Molema"] = ["Ratlou", "Tswaing", "Mahikeng", "Ditsobotla", "Ramotshere"];
      categories["Dr Ruth Segomotsi Mompati"] = ["Naledi", "Mamusa", "Greater Taung", "Lekwa-Teemane", "Kagisano-Molopo"];
      categories["Dr Kenneth Kaunda"] = ["JB Marks", "Matlosana", "Maquassi Hills"];

      categories["Free State"] = ["Mangaung Metropolitan", "Fezile Dabi District", "Lejweleputswa District", "Thabo Mofutsanyana District", "Xhariep District"];
      categories["Mangaung Metropolitan"] = ["Mangaung Metropolitan Municipality"];
      categories["Fezile Dabi District"] = ["Moqhaka", "Ngwathe", "Metsimaholo", "Mafube"];
      categories["Lejweleputswa District"] = ["Masilonyana", "Tokologo", "Tswelopele", "Matjhabeng", "Nala"];
      categories["Thabo Mofutsanyana District"] = ["Setsoto", "Dihlabeng", "Nketoana", "Maluti-a-Phofung", "Phumelela", "Mantsopa"];
      categories["Xhariep District"] = ["Letsemeng", "Kopanong", "Mohokare", "Naledi"];

      categories["Kwazulu Natal"] = ["Amajuba District Municipality", "Harry Gwala District Municipality", "iLembe District Municipality", "King Cetshwayo District Municipality", "Ugu District Municipality", "uMgungundlovu District Municipality", "uMkhanyakude District Municipality", "uMzinyathi District Municipality", "uThukela District Municipality", "Zululand District Municipality", "eThekwini Metropolitan"];
      categories["Amajuba District Municipality"] = ["Dannhauser", "eMadlangeni", "Newcastle"];
      categories["Harry Gwala District Municipality"] = ["Dr Nkosazana Dlamini-Zuma", "Greater Kokstad", "Ubuhlebezwe", "Umzimkhulu"];
      categories["iLembe District Municipality"] = ["KwaDukuza", "Mandeni", "Maphumulo", "Ndwedwe"];
      categories["King Cetshwayo District Municipality"] = ["City of uMhlathuze", "Mthonjaneni", "Nkandla", "uMfolozi", "uMlalazi"];
      categories["Ugu District Municipality"] = ["Ray Nkonyeni", "uMdoni", "uMuziwabantu", "Umzumbe", "Vulamehlo"];
      categories["uMgungundlovu District Municipality"] = ["Impendle", "Mkhambathini", "Mpofana", "Msunduzi", "Richmond", "uMngeni", "uMshwathi"];
      categories["uMkhanyakude District Municipality"] = ["Big Five Hlabisa", "Jozini", "Mtubatuba", "uMhlabuyalingana"];
      categories["uMzinyathi District Municipality"] = ["Endumeni", "Msinga", "Nquthu", "Umvoti"];
      categories["uThukela District Municipality"] = ["Alfred Duma", "Inkosi Langalibalele", "Okhahlamba"];
      categories["Zululand District Municipality"] = ["Abaqulusi", "eDumbe", "Nongoma", "Ulundi", "uPhongolo"];
      categories["eThekwini Metropolitan"] = ["eThekwini Metropolitan Municipality"];

      /** 
      categories["Gauteng"] = ["Johannesburg", "Tshwane", "Ekurhuleni", "Sedibeng", "West Rand"];
      categories["Johannesburg"] = ["Johannesburg"];
      categories["Tshwane"] = ["Tshwane"];
      categories["Ekurhuleni"] = ["Ekurhuleni"];
      categories["Sedibeng"] = ["Emfuleni", "Lesedi", "Midvaal"];
      categories["West Rand"] = ["Merafong City", "Mogale City", "Rand West City"];
      */

      categories["Gauteng"] = ["Johannesburg", "Tshwane", "Ekurhuleni", "Sedibeng", "West Rand", "Other"];

      categories["Johannesburg"] = ["Dobsonville", "Chaiwelo","White City", "Mofolo","Zola","Protea Glen","Jabulani","Phiri Senoane","Midway industrial area","Meadowlands","Diepkloof Zone 4","Diepkloof Zone 6","Pimville","Alex","Benmore","Braamfontein","Jeppestown","Joubert Park","Hilbrow","Dooronfontein","Fordsburg","Orange Farm"];
      categories["Tshwane"] = ["Mamelodi"];
      categories["Ekurhuleni"] = ["Vosloorus","Katlehong","Daveyton","Thokoza","Palmridge","Tsakane","Kwa Thema", "Tembisa"];
      categories["Sedibeng"] = ["Evaton","Sebokeng"];
      categories["West Rand"] = ["Kagiso"];
      categories["Other"] = ["Other"];
      

      categories["Limpopo"] = ["Capricorn District Municipality", "Mopani District Municipality", "Sekhukhune District Municipality", "Vhembe District Municipality", "Waterberg District Municipality"];
      categories["Capricorn District Municipality"] = ["Blouberg", "Lepelle-Nkumpi", "Molemole", "Polokwane"];
      categories["Mopani District Municipality"] = ["Ba-Phalaborwa", "Greater Giyani", "Greater Letaba", "Greater Tzaneen", "Maruleng"];
      categories["Sekhukhune District Municipality"] = ["Elias Motsoaledi", "Ephraim Mogale", "Fetakgomo/Tubatse", "Makhuduthamaga"];
      categories["Vhembe District Municipality"] = ["Collins Chabane", "Makhado", "Musina", "Thulamela"];
      categories["Waterberg District Municipality"] = ["Bela-Bela", "Lephalale", "Mogalakwena", "Mookgophong/Modimolle", "Thabazimbi"];

      categories["Mpumalanga"] = ["Gert Sibande", "Nkangala", "Ehlanzeni"];
      categories["Gert Sibande"] = ["Albert Luthuli", "Msukaligwa", "Mkhondo", "Pixley ka Seme", "Lekwa", "Dipaleseng", "Govan Mbeki"];
      categories["Nkangala"] = ["Victor Khanye", "Emalahleni", "Steve Tshwete", "Emakhazeni", "Thembisile Hani", "Dr JS Moroka"];
      categories["Ehlanzeni"] = ["Thaba Chweu", "Mbombela", "Umjindi", "Nkomazi", "Bushbuckridge"];


      var nLists = 3; // number of lists in the set

      function fillSelect(currCat, currList) {
        var step = Number(currList.name.replace(/\D/g, ""));
        for (i = step; i < nLists + 1; i++) {
          document.forms[0]['List' + i].length = 1;
          document.forms[0]['List' + i].selectedIndex = 0;
          document.getElementById('List' + i).style.display = 'none';
          var firstP = document.getElementById('List' + i);
        }
        var nCat = categories[currCat];
        if (nCat != undefined) {
          document.getElementById('List' + step).style.display = 'inline';
          for (each in nCat) {
            var nOption = document.createElement('option');
            var nData = document.createTextNode(nCat[each]);
            nOption.setAttribute('value', nCat[each]);
            nOption.appendChild(nData);
            currList.appendChild(nOption);
          }
        }
      }

      function getValues() {
        var str = '';
        str += document.getElementById('List1').value + '\n';
        for (var i = 2; i <= nLists; i++) {
          if (document.getElementById('List' + i).selectedIndex != 0) {
            str += document.getElementById('List' + i).value + '\n';
          }
        }
        alert(str);
      }

      function init() {
        fillSelect('startList', document.forms[0]['List1']);
      }

      navigator.appName == "Microsoft Internet Explorer" ?
        attachEvent('onload', init, false) :
        addEventListener('load', init, false);
    </script>




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
          <!--
          <li class="nav-item">
            <form class="search-form" action="#">
              <i class="icon-search"></i>
              <input type="search" class="form-control" placeholder="Search Here" title="Search here">
            </form>
          </li>
          -->
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
                <a class="dropdown-item" href="../logout.php"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
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
            <li class="nav-item nav-category">SUPPLIER MODULE</li>
            <li class="nav-item">
              <a class="nav-link" href="notifications.php">
                <i class="menu-icon ti ti-announcement"></i>
                <span class="menu-title">Notifications</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="menu-icon ti ti-calendar"></i>
                <span class="menu-title">Provisional Schedule</span>
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
                <span class="menu-title">Donations</span>
              </a>
            </li>  
            <li class="nav-item">
              <a class="nav-link" href="damages_returns.php">
                <i class="menu-icon ti ti-back-left"></i>
                <span class="menu-title">Damages & Returns </span>
              </a>
            </li>             
            <li class="nav-item nav-category">WAREHOUSE MODULE</li>
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
              <a class="nav-link" href="food_parcels.php">
                <i class="menu-icon icon icon-bag"></i>
                <span class="menu-title">Food Parcels </span>
              </a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="damages_rejects.php">
                <i class="menu-icon ti ti-back-left"></i>
                <span class="menu-title">Damages & Returns </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
              <i class="menu-icon ti ti-announcement"></i>
                <span class="menu-title">Notification</span>
              </a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="#">
              <i class="menu-icon ti ti-search"></i>
                <span class="menu-title">Custom Search</span>
              </a>
            </li>
            <li class="nav-item nav-category">HAMPER PACKAGING MODULE</li>
            <li class="nav-item">
              <a class="nav-link" href="add_food_pack.php">
                <i class="menu-icon ti ti-package"></i>
                <span class="menu-title">Add Hamper</span>
              </a>
            </li>            
            <li class="nav-item">
              <a class="nav-link" href="pack_intransit.php">
                <i class="menu-icon ti ti-car"></i>
                <span class="menu-title">Food Packs Transit</span>
              </a>
            </li>  
            <li class="nav-item">
              <a class="nav-link" href="food_parcels.php">
                <i class="menu-icon ti ti-split-h"></i>
                <span class="menu-title">Hamper Stages</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
              <i class="menu-icon ti ti-search"></i>
                <span class="menu-title">Custom Search</span>
              </a>
            </li>           
            <li class="nav-item nav-category">BENEFICIARY MODULE</li>
            <li class="nav-item">
              <a class="nav-link" href="list_beneficiary.php">
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
              <a class="nav-link" href="distribution_plan.php">
                <i class="menu-icon ti ti-direction-alt"></i>
                <span class="menu-title">Food Distribution Plan </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="beneficiary_stages.php">
                <i class="menu-icon ti ti-split-h"></i>
                <span class="menu-title">Beneficiaries Stages </span>
              </a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="list_foodpack_activities.php">
                <i class="menu-icon ti ti-mouse"></i>
                <span class="menu-title">Food Pack Activities </span>
              </a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="menu-icon ti ti-crown"></i>
                <span class="menu-title">Change Agents </span>
              </a>
            </li>                         
            <li class="nav-item">
              <a class="nav-link" href="beneficiary_polls.php">
                <i class="menu-icon ti ti-comments"></i>
                <span class="menu-title">Beneficiary Polls </span>
              </a>
            </li>  
            <li class="nav-item">
              <a class="nav-link" href="#">
              <i class="menu-icon ti ti-search"></i>
                <span class="menu-title">Custom Search</span>
              </a>
            </li>
            <li class="nav-item nav-category">SECURITY DATA</li>
            <li class="nav-item">
              <a class="nav-link" href="pack_intransit.php">
                <i class="menu-icon ti ti-car"></i>
                <span class="menu-title">Food Packs Transit</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="food_pack_stages.php">
                <i class="menu-icon ti ti-layers-alt"></i>
                <span class="menu-title">Food Packs Stages</span>
              </a>
            </li>          
            <li class="nav-item">
              <a class="nav-link" href="food_pack_return.php">
                <i class="menu-icon ti ti-shift-left"></i>
                <span class="menu-title">Food Packs Return </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="security_all_activities.php">
                <i class="menu-icon ti ti-align-left"></i>
                <span class="menu-title">All Activities </span>
              </a>
            </li> 
            <li class="nav-item nav-category">DISTRIBUTION MODULE</li>
            <li class="nav-item">
              <a class="nav-link" href="list_beneficiary.php">
                <i class="menu-icon icon icon-list"></i>
                <span class="menu-title">Beneficiary List</span>
              </a>
            </li>  
            <li class="nav-item">
              <a class="nav-link" href="pack_intransit.php">
                <i class="menu-icon ti ti-car"></i>
                <span class="menu-title">Food Packs Transit</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="distribution_plan.php">
                <i class="menu-icon ti ti-direction-alt"></i>
                <span class="menu-title">Food Distribution Plan </span>
              </a>
            </li>            
            <li class="nav-item">
              <a class="nav-link" href="#">
              <i class="menu-icon ti ti-search"></i>
                <span class="menu-title">Custom Search</span>
              </a>
            </li>  
            <li class="nav-item nav-category">ADMINISTRATION</li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">
                <i class="menu-icon icon icon-people"></i>
                <span class="menu-title">Users</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="add_driver.php">
                <i class="menu-icon icon icon-user-following"></i>
                <span class="menu-title">Drivers</span>
              </a>
            </li>  
            <li class="nav-item">
              <a class="nav-link" href="add_vehicle.php">
                <i class="menu-icon ti ti-car"></i>
                <span class="menu-title">Vehicles</span>
              </a>
            </li>            
            <li class="nav-item nav-category">ANALYTICS & REPORTING</li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="menu-icon icon  icon-basket-loaded"></i>
                <span class="menu-title">Summary</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="menu-icon ti ti-angle-up"></i>
                <span class="menu-title">Warehouse</span>
              </a>
            </li>          
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="menu-icon ti ti-shopping-cart-full"></i>
                <span class="menu-title">Suppliers</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="menu-icon ti ti-face-smile"></i>
                <span class="menu-title">Beneficiaries</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="menu-icon ti ti-wallet"></i>
                <span class="menu-title">Distribution</span>
              </a>
            </li>   
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="menu-icon ti ti-briefcase"></i>
                <span class="menu-title">Hampers</span>
              </a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="menu-icon ti ti-truck"></i>
                <span class="menu-title">Transporting</span>
              </a>
            </li>               
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="menu-icon ti ti-face-smile"></i>
                <span class="menu-title">Custom Report</span>
              </a>
            </li>   
          </ul>
        </nav>  


