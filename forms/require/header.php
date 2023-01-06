<?php 
session_start();
if (isset($_SESSION["username"]) || isset($_SESSION["userid"]) || isset($_SESSION["usertype"]) || isset($_SESSION["BlockId"]) || isset($_SESSION["PhcId"]) || isset($_SESSION["HscId"])) {
    $username = $_SESSION["username"];
    $userid = $_SESSION["userid"];
    $usertype = $_SESSION["usertype"];
    $BlockId = $_SESSION["BlockId"];
    $PhcId = $_SESSION["PhcId"];
    $HscId = $_SESSION["HscId"];
    session_write_close();
} else {
    session_unset();
    session_write_close();
    $url = "./index.php";
    header("Location: $url");
}
include "../config/db_connect.php";
// include ('preloader.php');
?>

<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

    <title>Thaimaiyudan</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.png" height="100" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    
    <!-- Page CSS -->
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
    
  </head>
        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
			<img src="../assets/img/Thaimaiyudan-logo.png" class="w-px-40 h-auto rounded-circle" />
              <span class="app-brand-text demo menu-text fw-bolder ms-2">Thaimaiyudan</span>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-Block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <?php if(($usertype == 0) || ($usertype == 1)) { ?>
            <li class="menu-item">
              <a href="dashboard.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>
           <?php
           } else if(($usertype == 2)) { ?>
           <li class="menu-item">
              <a href="Bdashboard.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>
           <?php
           } else if(($usertype == 3) || ($usertype == 4)) { ?>
           <li class="menu-item">
              <a href="Pdashboard.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>
           <?php 
          } else if($usertype == 5) { ?>
           <li class="menu-item">
              <a href="Hdashboard.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>
          <?php } if($usertype != 5) { ?> <!-- Starts with IF Condition because of New Statement -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div data-i18n=">Current Month Due">Current Month Due</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="DeliveryDue.php" class="menu-link">
                    <div data-i18n="Basic">Delivery Due List</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="AntenatalDue.php" class="menu-link">
                    <div data-i18n="Basic">Antenatal Due List</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="BabyImDue.php" class="menu-link">
                    <div data-i18n="Basic">Baby Immunization Due</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="MotherImDue.php" class="menu-link">
                    <div data-i18n="Basic">Mother Immunization Due</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="NotifiedList.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bell"></i>
                <div data-i18n="Eligible Couples List">Notified List</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="Reports.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-id-card"></i>
                <div data-i18n="Report">Report List</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="EligibleCouple.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Eligible Couples List">Eligible Couples</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="AnRegisterlist.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-female-sign"></i>
                <div data-i18n="Antenatal Registeration">Antenatal Registration</div>
              </a>
            </li>
            <?php } ?>
            <?php if($usertype != 5) { ?>
            <li class="menu-item">
              <a href="MedicalHistory.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-plus"></i>
                <div data-i18n="Medical History">Medical History</div>
              </a>
            </li>
            <?php } ?>
            <li class="menu-item">
              <a href="AntenatalVisit.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-check"></i>
                <div data-i18n="Antenatal Visit">Antenatal Visit</div>
              </a>
            </li>
            <?php if(($usertype != 5) || ($usertype != 6)) { ?>
            <li class="menu-item">
              <a href="highRiskMothers.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-street-view"></i>
                <div data-i18n="Hospital Master">High Risk Mothers</div>
              </a>
            </li>
          <?php } ?>
            <li class="menu-item">
              <a href="DeliveryDetails.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-female"></i>
                <div data-i18n="Delivery Details">Delivery Details</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="Immunization.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-test-tube"></i>
                <div data-i18n="Immunization Details">Immunization Details</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="PostnatalVisit.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-clinic"></i>
                <div data-i18n="Postnatal Visit">Postnatal Visit</div>
              </a>
            </li>
             <li class="menu-item">
              <a href="MotherStatus.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-list-check"></i>
                <div data-i18n="Postnatal Visit">Pregnancy Status</div>
              </a>
            </li>
			    <?php if(($usertype == 0) || ($usertype == 1)) { ?>
            <li class="menu-item">
              <a href="UserManagement.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-pin"></i>
                <div data-i18n="User Management">User Management</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="Hscmaster.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-map"></i>
                <div data-i18n="Location Master">Location Master</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="Hospitalmaster.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-buildings"></i>
                <div data-i18n="Hospital Master">Private Hospitals</div>
              </a>
            </li>
          <?php } ?>
          </ul>
        </aside>
        <!-- / Menu -->
   <link rel="stylesheet" href="../forms/datatables/dataTables.min.css">
   <link rel="stylesheet" href="../forms/datatables/style.css">
   <script src="../forms/datatables/jquery-3.5.1.min.js" type="text/javascript"></script>
   <script src="../forms/datatables/dataTables.min.js" type="text/javascript"></script>
   
        <!-- Layout container -->
        <div class="layout-page">