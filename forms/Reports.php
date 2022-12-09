<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu
	  if(($usertype == 0) || ($usertype == 1)) {
	  include ('require/filter.php'); // Top Filter 
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
                <h5 class="card-header">
                  <span class="text-muted fw-light">All Reports / </span>Reports
                </h5>
                <br/>
                <form action="EcExport.php" method="post">
                  <button type="submit" id="export_data" name='export_data' class="btn lt btn-primary"><span class="bx bx-download"></span>&nbsp; Pregnant Report</button>
                  <button type="submit" id="teenPregExp" name='teenPregExp' class="btn lt btn-primary"><span class="bx bx-download"></span>&nbsp; Teenage Preg Report</button>	
              </form>
            </div>		  
       <!--/ Hoverable Table rows -->           
<?php include ('require/dtFooter.php'); ?>
<style>
.lt{
  float: left !important;
  margin-left: 15px;
}
</style>