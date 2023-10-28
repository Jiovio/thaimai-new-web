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
 
$CheckANV_PrgWk = mysqli_query($conn,"SELECT * FROM antenatalvisit where picmeno=$AV_picmeno order by id desc LIMIT 0,1");
$CheckANV_PrgWk_val = mysqli_fetch_array($CheckANV_PrgWk);

$pregancyWeek1 = "";
$anc_cnt = "";
if(isset($CheckANV_PrgWk_val["pregnancyWeek"]) && !empty($CheckANV_PrgWk_val["pregnancyWeek"]))
{
    $pregancyWeek1 = intval(trim($CheckANV_PrgWk_val["pregnancyWeek"]));
	$anc_cnt = $CheckANV_PrgWk_val["ancPeriod"]; 
					 
	$week_opt = "";
	if($pregancyWeek1 > 3 AND $pregancyWeek1 <= 28)
	{
	  $week_opt = 1;
	}
	if($pregancyWeek1 > 28 AND $pregancyWeek1 <= 36)
	{
	 $week_opt = 2;
	}
	if($pregancyWeek1 > 36 AND $pregancyWeek1 <= 40)
	{
	 $week_opt = 3;
	}
					  
    $query_chk = "SELECT enumid,enumvalue FROM enumdata WHERE type=46 AND enumid=$week_opt";
    $exequery_chk = mysqli_query($conn, $query_chk);
    $listvalue_chk = mysqli_fetch_assoc($exequery_chk);
}

$picmeno ="0";
if (! empty($_POST["GlucoseDtls"])) {
  $picmeno =$AV_picmeno;
 // print_r($picmeno);
  $fastingSugar = $_POST["fastingSugar"]; 
  $postPrandial = $_POST["postPrandial"]; 
  $gctStatus = $week_opt; 
  $gctValue = isset($_POST["gctValue"]) ? $_POST["gctValue"] : ""; 
  
  $query = mysqli_query($conn,"UPDATE antenatalvisit SET fastingSugar='$fastingSugar', postPrandial='$postPrandial', 
  gctStatus='$gctStatus', gctValue='$gctValue' WHERE picmeno='$picmeno' AND ancPeriod = $anc_cnt");
            if (!empty($query)) {
              echo "<script>alert('Inserted Successfully');window.location.replace('{$siteurl}/forms/AnVisitAddBtn.php?History=$AV_picmeno');</script>";
            } 
} 
?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Antenatal Visit /</span> Add Glucose Challenge Test Details 
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
			
			<input type="text" required id="AVpicmeno" hidden name="picmeno" value="<?php echo $AV_picmeno; ?>" class="form-control" />
        
					<div class="row">
						<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-fastingSugar">Fasting Sugar </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="Number"
                              name="fastingSugar"
                              class="form-control"
                              id="fastingSugar"
                              placeholder="Fasting Sugar"
                              aria-label="Fasting Sugar"
							  min=60 max=400
                              aria-describedby="basic-icon-default-fastingSugar"
                              />
                          </div>
                        </div>
						
						<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-postPrandial">Post Prandial </label>
                          <div class="input-group input-group-merge">
                            						  
						  <input
                              type="Number"
                              name="postPrandial"
                              class="form-control"
                              id="postPrandial"
                              placeholder="Post Prandial"
                              aria-label="Post Prandial"
							  min=60 max=400
                              aria-describedby="basic-icon-default-postPrandial"
                              />
                          </div>
                        </div>
						</div>
					
					  <div class="row">
						<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-gctStatus">GCT Week Status <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
							  <input
                              type="text"
                              name="gctStatus"
                              class="form-control"
                              id="gctStatus"
                              placeholder="GCT Week Status"
                              aria-label="GCT Week Status"
                              aria-describedby="basic-icon-default-gctStatus"
							  value = <?php echo  $listvalue_chk['enumvalue'];?>
							  readonly
                              />
                          </div>
                          <div id="gctWeekStatus_box"></div>
                        </div>
                       
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-gctValue">GCT Value </label>
                          <div class="input-group input-group-merge">
						  <input
                              type="Number"
                              name="gctValue"
                              class="form-control"
                              id="gctValue"
                              placeholder="GCT Value"
                              aria-label="gctValue"
							  min=60 max=400
                              aria-describedby="basic-icon-default-gctValue"
                              />
                          </div>
                        </div>
						</div>
					
            <input type="submit" name="GlucoseDtls" value="Save" id="GlucoseDtls" class="btn btn-primary">
			
			</form>
			
			</div>
        </div>
    </div>
</div>
<!-- / Content -->
<?php include ('require/footer.php'); ?>