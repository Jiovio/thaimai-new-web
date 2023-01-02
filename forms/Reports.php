<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php  ini_set("display_errors",'1'); include ('require/header.php'); // Menu
	  if(($usertype == 0) || ($usertype == 1)) {
	  include ('require/Rfilter.php'); // Top Filter 
}else if(($usertype == 2)) {
    include ('require/Bfilter.php');
}else if(($usertype == 3) || ($usertype == 4)) {
    include ('require/Pfilter.php');  
}

?>
<!-- Content wrapper -->
<div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Hoverable Table rows -->
              <div class="card">
              
              </div>		  
       <!--/ Hoverable Table rows -->           
<?php include ('require/dtFooter.php'); ?>
<style>
.lt{
  float: left !important;
  margin-left: 15px;
}
</style>