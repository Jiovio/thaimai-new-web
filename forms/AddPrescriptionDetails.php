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

$anc_cnt = "";
if(isset($CheckANV_PrgWk_val["pregnancyWeek"]) && !empty($CheckANV_PrgWk_val["pregnancyWeek"]))
{
  //print_r($CheckANV_PrgWk_val["ancPeriod"]); exit;
  $anc_cnt = $CheckANV_PrgWk_val["ancPeriod"]; 
}

 
$CheckANV_PrgWk = mysqli_query($conn,"SELECT * FROM antenatalvisit where picmeno=$AV_picmeno order by id desc LIMIT 0,1");
$CheckANV_PrgWk_val = mysqli_fetch_array($CheckANV_PrgWk);

$pregancyWeek1 = "";
$anc_cnt = "";
$anv_dt = "";
if(isset($CheckANV_PrgWk_val["pregnancyWeek"]) && !empty($CheckANV_PrgWk_val["pregnancyWeek"]))
{
 $anc_cnt = $CheckANV_PrgWk_val["ancPeriod"];  
 $pregancyWeek1 = $CheckANV_PrgWk_val["pregnancyWeek"];
 $cal_dt = $CheckANV_PrgWk_val["anvisitDate"];
}

$picmeno ="0";
if (! empty($_POST["PrescriptionDtls"])) {
  $picmeno =$AV_picmeno;
 // print_r($picmeno);
  $NoFolicAcid = isset($_POST["NoFolicAcid"]) ? $_POST["NoFolicAcid"] : "";
  $NoIFA = isset($_POST["NoIFA"]) ? $_POST["NoIFA"] : ""; 
  $dateofIFA = isset($_POST["dateofIFA"]) ? $_POST["dateofIFA"] : ""; 
  $dateofAlbendazole = isset($_POST["dateofAlbendazole"]) ? $_POST["dateofAlbendazole"] : "" ;
  $noCalcium = isset($_POST["noCalcium"]) ? $_POST["noCalcium"] : "";
  $calciumDate = isset($_POST["calciumDate"]) ? $_POST["calciumDate"] : ""; 
  
  $query = mysqli_query($conn,"UPDATE antenatalvisit SET NoFolicAcid='$NoFolicAcid', NoIFA='$NoIFA', 
  dateofIFA='$dateofIFA', dateofAlbendazole='$dateofAlbendazole', noCalcium='$noCalcium',calciumDate='$calciumDate' 
  WHERE picmeno='$picmeno' AND ancPeriod = $anc_cnt");
            if (!empty($query)) {
              echo "<script>alert('Inserted Successfully');window.location.replace('{$siteurl}/forms/AnVisitAddBtn.php?History=$AV_picmeno');</script>";
            } 
} 
?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Antenatal Visit /</span> Add Prescription Details 
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
			<form id="prescform" action="" method="post" onclick="return checkPicmeAN()">	
			
			<input type="text" required id="AVpicmeno" hidden name="picmeno" value="<?php echo $AV_picmeno; ?>" class="form-control" />
        
					<div class="row">
					<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-NoFolicAcid">Number of Folic Acid </label>
                          <div class="input-group input-group-merge">
                              <input type="number"  id="NoFolicAcid" name="NoFolicAcid" onclick="return checkPicmeAN()" min="1" max="30" class="form-control" <?php if($pregancyWeek1 > 12) { ?> readonly="readonly" <?php } ?>/>
                        
                          </div>
						  </div>
						  </div>                    
                    
					<div class="row">
					<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-NoIFA">Number of IFA </label>
                          <div class="input-group input-group-merge">        
                              <select class="form-control" id="NoIFA" onclick="return checkPicmeAN()" name="NoIFA" <?php if($pregancyWeek1 <= 12) { ?> disabled="disabled" <?php } ?>>
                          <option value="">Choose...</option>
                          <?php
                          for ($j=1; $j < 61; $j++){
                          ?>
                          <option value ="<?php echo $j;?>"><?php echo $j;?></option>
                          <?php
                          } ?>
                          </select>
                          </div>
                    </div>
                    
						<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-dateofIFA">Date Of IFA </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="dateofIFA"
                              class="form-control"
                              id="dateofIFA"
                              placeholder="Date Of IFA"
                              aria-label="Date Of IFA"
                              aria-describedby="basic-icon-default-dateofIFA"
                              <?php if($pregancyWeek1 <= 12) { ?> disabled="disabled" <?php } ?>
                               />
                          </div>
						  <div id="dtifa-sug-box"></div>
                        </div>
						</div>
                        
					    <div class="row">
						<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-dateofAlbendazole">Date Of Albendazole </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="dateofAlbendazole"
                              class="form-control"
                              id="dateofAlbendazole"
                              placeholder="Date Of Albendazole"
                              aria-label="Date Of Albendazole"
							  onclick="return checkPicmeAN()"
                              aria-describedby="basic-icon-default-dateofAlbendazole"
                              <?php if($pregancyWeek1 <= 12) { ?> disabled="disabled" <?php } ?>
                              />
                          </div>
						<div id="suggesstion-box"></div>
                        </div>
						</div>
                        
						<div class="row">
						<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-noCalcium">No. of Calcium </label>
                          <div class="input-group input-group-merge">
                          <select class="form-control" id="noCalcium" onclick="return checkPicmeAN()" 
						  name="noCalcium" <?php if($pregancyWeek1 <= 12) { ?> disabled="disabled" <?php } ?>>
                          <option value="">Choose...</option>
                          <?php
                           for($i=1; $i<=60; $i++){
                               echo "<option value=".$i.">".$i."</option>";
                           }
                          ?>
                          </select>
                          </div>
                        </div>
						
						   <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-calciumDate">Calcium Date </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="calciumDate"
                              class="form-control"
                              id="calciumDate"
                              placeholder="Calcium Date"
                              aria-label="Calcium Date"
                              aria-describedby="basic-icon-default-calciumDate"     
                              
							   min=<?php echo $cal_dt; ?> 					  
                              <?php if($pregancyWeek1 <= 12) { ?> disabled="disabled" <?php } ?>
                            />
                          </div>
						<div id="dtcal-sug-box"></div>
                        </div>
						</div>
					
					
           <input type="submit" name="PrescriptionDtls" value="Save" id="PrescriptionDtls" class="btn btn-primary" onclick="return checkPicmeAN()"> 
			</form>
			
			</div>
        </div>
    </div>
</div>
<!-- / Content -->
<?php include ('require/footer.php'); ?>