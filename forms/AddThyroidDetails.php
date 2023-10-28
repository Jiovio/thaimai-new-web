<?php include ('require/topHeader.php'); ?>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search 
if (isset($_GET['History'])) {
	
  $AV_picmeno = $_GET['History'];
 }
 
 //print_r($AV_picmeno); exit;
 
$CheckANV_PrgWk = mysqli_query($conn,"SELECT * FROM antenatalvisit where picmeno=$AV_picmeno order by id desc LIMIT 0,1");
$CheckANV_PrgWk_val = mysqli_fetch_array($CheckANV_PrgWk);

$anc_cnt = "";
if(isset($CheckANV_PrgWk_val["pregnancyWeek"]) && !empty($CheckANV_PrgWk_val["pregnancyWeek"]))
{
  //print_r($CheckANV_PrgWk_val["ancPeriod"]); exit;
  $anc_cnt = $CheckANV_PrgWk_val["ancPeriod"]; 
}

$picmeno ="0";
if (! empty($_POST["ThyroidDtls"])) {
  $picmeno =$AV_picmeno;
  
  $Tsh = $_POST["Tsh"]; 
  
  
  //print_r($CheckANV_PrgWk_val["ancPeriod"]); exit;
  $query = mysqli_query($conn,"UPDATE antenatalvisit SET Tsh='$Tsh' WHERE picmeno='$picmeno' AND ancPeriod=$anc_cnt");
    if (!empty($query)) {
              echo "<script>alert('Inserted Successfully');window.location.replace('{$siteurl}/forms/AnVisitAddBtn.php?History=$AV_picmeno');</script>";
            } 
} 
?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Antenatal Visit /</span> Add Thyroid Test Details 
              <a href="AnVisitAddBtn.php?History=<?php echo $AV_picmeno; ?>" ><button type="submit" class="btn btn-primary" id="btnBack">
                    <span class="bx bx-arrow-back"></span>&nbsp; Back
              </button></a>
			</h4>
			<!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      
                    <small class="float-end"><span class="mand">* </span> Fields are Mandatory</small>
                    </div>
                    <div class="card-body">
                      
  <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($emessage)) { echo $emessage; } ?></div>

			
			
 <!----                          <form action="AddAnVisit3.php" method="post" onsubmit="return validateGctChange()"> !--->
			<form id="form" action="" method="post">	
			
			<div class="col-4 mb-3">
			<input type="text" required id="AVpicmeno" hidden name="picmeno" value="<?php echo $AV_picmeno; ?>" class="form-control" />
        </div>
					<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-Tsh">TSH </label>
                          <div class="input-group input-group-merge">
                          <select class="form-control" id="Tsh" name="Tsh">
                          <option value="">Choose...</option>
                          <option value="yes">Yes</option>
                           <option value="no">No</option>
                          </select>
                          </div>
                        </div>
					
            <input type="submit" name="ThyroidDtls" value="Save" id="ThyroidDtls" class="btn btn-primary">
			
			</form>
			
			</div>
        </div>
    </div>
</div>
<!-- / Content -->
<?php include ('require/footer.php'); ?>