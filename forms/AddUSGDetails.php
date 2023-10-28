<?php include ('require/topHeader.php'); ?>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search 

if (isset($_GET['History'])) {
	
  $AV_picmeno = $_GET['History'];
  $picmeno = $AV_picmeno;
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
$anv_min_dt = "";
$edd_min_dt = "";
$edd_max_dt = "";
$edd_dt = "";
if(isset($CheckANV_PrgWk_val["pregnancyWeek"]) && !empty($CheckANV_PrgWk_val["pregnancyWeek"]))
{
 $anc_cnt = $CheckANV_PrgWk_val["ancPeriod"];  
 $pregancyWeek1 = $CheckANV_PrgWk_val["pregnancyWeek"];
 $anv_dt = $CheckANV_PrgWk_val["anvisitDate"];
 $anv_min_dt = date('Y-m-d', strtotime($anv_dt. '- 1 Months' ));
}

$medicalSql = mysqli_query($conn, "SELECT * FROM medicalhistory WHERE picmeNo = '$AV_picmeno' order by id desc LIMIT 0,1");
$medicalData = mysqli_fetch_array($medicalSql);

if(isset($medicalData))
{
 $edd_dt = $medicalData['edddate'];	
 $edd_min_dt = date('Y-m-d', strtotime($edd_dt. '- 1 Months' ));
 $edd_max_dt = date('Y-m-d', strtotime($edd_dt. '+ 1 Months' ));   
}


$picmeno ="0";
if (! empty($_POST["USGDtls"])) {
  $picmeno =$AV_picmeno;
 // print_r($picmeno);
  
  $filename = $_FILES["usgreport"]["name"];

  $tempname = $_FILES["usgreport"]["tmp_name"];

  $folder = "../usgDocument/" . $filename; 
  
// Now let's move the uploaded image into the folder: image

  move_uploaded_file($tempname, $folder);
$wusgTaken = $_POST["wusgTaken"];

$usgDoneDate = $_POST["usgDoneDate"]; 
$usgScanEdd = $_POST["usgScanEdd"];
$sizeUterusinWeeks = $_POST["sizeUterusinWeeks"]; 
$usgScanStatus = $_POST["usgScanStatus"]; 
$usgFundalHeight = $_POST["usgFundalHeight"]; 
$usgSizeUterusWeek = $_POST["usgSizeUterusWeek"]; 
$usgFetusStatus = $_POST["usgFetusStatus"];
$gestationSac = $_POST["gestationSac"]; 
$liquor = $_POST["liquor"]; 
$usgFetalHeartRate = $_POST["usgFetalHeartRate"];
$usgFetalPosition = $_POST["usgFetalPosition"]; 
$usgFetalMovement = $_POST["usgFetalMovement"]; 
$liquor1 = $_POST["liquor1"]; 
$usgFetalHeartRate1 = $_POST["usgFetalHeartRate1"];
$usgFetalPosition1 = $_POST["usgFetalPosition1"]; 
$usgFetalMovement1 = $_POST["usgFetalMovement1"];
$liquor2 = $_POST["liquor2"]; 
$usgFetalHeartRate2 = $_POST["usgFetalHeartRate2"];
$usgFetalPosition2 = $_POST["usgFetalPosition2"];
//print_r("Hi".$usgFetalPosition2); exit;
$usgFetalMovement2 = $_POST["usgFetalMovement2"];
$placenta = $_POST["placenta"];
$usgResult = $_POST["usgResult"];
$usgRemarks = $_POST["usgRemarks"];
  
  $query = mysqli_query($conn,"UPDATE antenatalvisit SET  
  wusgTaken = '$wusgTaken',
usgDoneDate = '$usgDoneDate', 
usgScanEdd = '$usgScanEdd',
sizeUterusinWeeks = '$sizeUterusinWeeks',
usgScanStatus = '$usgScanStatus',
usgFundalHeight = '$usgFundalHeight',
usgSizeUterusWeek = '$usgSizeUterusWeek', 
usgFetusStatus = '$usgFetusStatus', 
gestationSac = '$gestationSac',
liquor = '$liquor', 
usgFetalHeartRate = '$usgFetalHeartRate',
usgFetalPosition = '$usgFetalPosition',
usgFetalMovement = '$usgFetalMovement', 
liquor1 = '$liquor1', 
usgFetalHeartRate1 = '$usgFetalHeartRate1',
usgFetalPosition1 = '$usgFetalPosition1', 
usgFetalMovement1 = '$usgFetalMovement1',
liquor2 = '$liquor2', 
usgFetalHeartRate2 = '$usgFetalHeartRate2',
usgFetalPosition2 = '$usgFetalPosition2', 
usgFetalMovement2 = '$usgFetalMovement2',
placenta = '$placenta',
usgResult = '$usgResult',
usgRemarks = '$usgRemarks' WHERE picmeno='$picmeno' AND ancPeriod = '$anc_cnt'");
            if (!empty($query)) {
              echo "<script>alert('Inserted Successfully');window.location.replace('{$siteurl}/forms/AnVisitAddBtn.php?History=$AV_picmeno');</script>";
            } 
} 
?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Antenatal Visit /</span> Add USG Details 
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
                        <div class="col-4 mb-3" >
                          <label class="form-label" for="basic-icon-default-physicalpresent">Whether USG Taken <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required name="wusgTaken" id="wusgTaken" class="form-select" onchange="usgChange()">
                          <option value="">Choose...</option>
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
                          </div>
                          </div>
						<div class="col-4 mb-3" id="usgDoneDate" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgDoneDate">USG Done Date</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="usgDoneDate"
                              class="form-control"
                              id="usgDoneDate"
                              placeholder="USG Done Date"
                              aria-label="USG Done Date"
                              aria-describedby="basic-icon-default-usgDoneDate"
							  min=<?php echo $anv_min_dt; ?>
							  max=<?php echo $anv_dt; ?>
                               />
                          </div>
                        </div>
						<div class="col-4 mb-3" id="usgScanEdd" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgScanEdd">USG Scan Edd</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="usgScanEdd"
                              class="form-control"
                              id="ScanEdd"
                              placeholder="USG Scan Edd"
                              aria-label="USG Scan Edd"
                              aria-describedby="basic-icon-default-usgScanEdd"
							  value = <?php echo $edd_dt; ?>
                               min=<?php echo $edd_min_dt; ?>
                               max=<?php echo $edd_max_dt; ?> 
                              />
                          </div>
                        </div>
						
						<div class="col-4 mb-3" id="usgSizeUterusWeek" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgSizeUterusWeek">USG Size Uterus Week</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgSizeUterusWeek"
                              class="form-control"
                              id="usgSizeUterusWeek"
                              placeholder="USG Size Uterus"
                              aria-label="USG Size Uterus"
                              aria-describedby="basic-icon-default-usgSizeUterusWeek"
                               />
                          </div>
                        </div>
						
						<div class="col-4 mb-3" id="sizeUterusinWeeks" style="display:none;">
                          <label class="form-label" for="basic-icon-default-sizeUterusinWeeks">Uterus Size In Weeks </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="sizeUterusinWeeks"
                              class="form-control"
                              id="sizeUterusinWeeks"
                              placeholder="Size Uterus In Weeks"
                              aria-label="Size Uterus In Weeks"
                              aria-describedby="basic-icon-default-sizeUterusinWeeks"
							  />
                          </div>
                        </div>
						
						 <div class="col-4 mb-3" id="placenta" style="display:none;" >
                          <label class="form-label" for="basic-icon-default-phone">Placenta</label>
                          <div class="input-group input-group-merge">
                          <select  name="placenta" id="placenta" class="form-select">
                          <option value="">Choose...</option>
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=41";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
						           </div>
					           </div>
						
						<div class="col-4 mb-3" id="usgFundalHeight" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFundalHeight">USG FUNDAL HEIGHT</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgFundalHeight"
                              class="form-control"
                              id="usgFundalHeight"
                              placeholder="USG Fundal Height"
                              aria-label="USG Fundal Height"
                              aria-describedby="basic-icon-default-usgFundalHeight"
                               />
                          </div>
                        </div>
						
						<div class="col-4 mb-3" id="usgFetusStatus" style="display:none;">
                          <label class="form-label" for="basic-icon-default-phone">USG Fetus Status</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFetusStatus" id="usgFetusStatus" class="form-select">
                          <option value="">Choose...</option>
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=30";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
						  </div>
					    </div>
						
						 <div class="col-4 mb-3" id="gestationSac" style="display:none;">
                          <label class="form-label" for="basic-icon-default-phone">Gestation Sac</label>
                          <div class="input-group input-group-merge">
                          <select  name="gestationSac" id="gestation" class="form-select gestationSac" onchange="gsacField()">
                          <option value="">Choose...</option>
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=31";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
						             </div>
					             </div>
								 </div>
								 
								 
					<div class="row">
						  <div class="col-4 mb-3" id="liquor1" class="liquor" style="display:none;">
                          <label class="form-label" for="basic-icon-default-liquor">Liquor 1</label>
                          <div class="input-group input-group-merge">
                          <select  name="liquor" id="liquor" class="form-select">
                          <option value="">Choose...</option>
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=28";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                          </select>
						            </div>
					            </div>
								</div>
					<div class="row">
					          	<div class="col-4 mb-3" id="usgFetalHeartRate1" class="usgFetalHeartRate" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalHeartRate">USG FOETAL Heart Rate 1</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgFetalHeartRate"
                              class="form-control"
                              id="usgFetalHeartRate"
                              placeholder="USG FOETAL Heart Rate"
                              aria-label="USG FOETAL Heart Rate"
                              aria-describedby="basic-icon-default-usgFetalHeartRate"
                               />
                          </div>
                        </div>
                       
					            	<div class="col-4 mb-3" id="usgFetalPosition1" class="usgFetalPosition" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalPosition">USG FOETAL Presentation 1</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFetalPosition" id="usgFetalPosition" class="form-select">
                          <option value="">Choose...</option>
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=32";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
                          </div>
                        </div> 
					            	<div class="col-4 mb-3" id="usgFetalMovement1" class="usgFetalMovement" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalMovement">USG FOETAL Movement 1</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFetalMovement" id="usgFetalMovement" class="form-select">
                          <option value="">Choose...</option>
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=28";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
                          </div>
                        </div>
                            </div>
                            <div class="row">
                        <div class="col-4 mb-3" id="liquor2" class="liquor2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-liquor">Liquor 2</label>
                          <div class="input-group input-group-merge">
                          <select  name="liquor1" id="liquor1" class="form-select">
                          <option value="">Choose...</option>
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=28";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                          </select>
						            </div>
					            </div>
                      </div>
					  <div class="row">
					          	<div class="col-4 mb-3" id="usgFetalHeartRate2" class="usgFetalHeartRate2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalHeartRate">USG FOETAL Heart Rate 2</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgFetalHeartRate1"
                              class="form-control"
                              id="usgFetalHeartRate1"
                              placeholder="USG FOETAL Heart Rate"
                              aria-label="USG FOETAL Heart Rate"
                              aria-describedby="basic-icon-default-usgFetalHeartRate"
                               />
                          </div>
                        </div>
                       
					            	<div class="col-4 mb-3" id="usgFetalPosition2" class="usgFetalPosition2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalPosition">USG FOETAL Presentation 2</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFetalPosition1" id="usgFetalPosition1" class="form-select">
                          <option value="">Choose...</option>
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=32";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
                          </div>
                        </div> 
                
					            	<div class="col-4 mb-3" id="usgFetalMovement2" class="usgFetalMovement1" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalMovement">USG FOETAL Movement 2</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFetalMovement1" id="usgFetalMovement1" class="form-select">
                          <option value="">Choose...</option>
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=28";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
                          </div>
                        </div>
						</div>

<div class="row">    
                        <div class="col-4 mb-3" id="liquor3" class="liquor2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-liquor">Liquor 3</label>
                          <div class="input-group input-group-merge">
                          <select  name="liquor2" id="liquor2" class="form-select">
                          <option value="">Choose...</option>
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=28";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                          </select>
						            </div>
					            </div>
								</div>
								
                      <div class="row">  
					          	<div class="col-4 mb-3" id="usgFetalHeartRate3" class="usgFetalHeartRate2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalHeartRate">USG FOETAL Heart Rate 3</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgFetalHeartRate2"
                              class="form-control"
                              id="usgFetalHeartRate2"
                              placeholder="USG FOETAL Heart Rate"
                              aria-label="USG FOETAL Heart Rate"
                              aria-describedby="basic-icon-default-usgFetalHeartRate"
                               />
                          </div>
                        </div>                   
					            	<div class="col-4 mb-3" id="usgFetalPosition3" class="usgFetalPosition2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalPosition">USG FOETAL Presentation 3</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFetalPosition2" id="usgFetalPosition2" class="form-select">
                          <option value="">Choose...</option>
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=32";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
                          </div>
                        </div> 
					            	<div class="col-4 mb-3" id="usgFetalMovement3" class="usgFetalMovement2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalMovement">USG FOETAL Movement 3</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFetalMovement2" id="usgFetalMovement2" class="form-select">
                          <option value="">Choose...</option>
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=28";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
                          </div>
                        </div>
                     </div>
                        
						  <div class="row"> 
						  <div class="col-4 mb-3" id="usgResult" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgResult">USG Result</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgResult" id="usgResult" class="form-select">
                          <option value="">Choose...</option>
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=27";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
						             </div>
					              </div>


						            <div class="col-4 mb-3" id="usgRemarks" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgRemarks">USG Remarks</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgRemarks"
                              class="form-control"
                              id="usgRemarks"
                              placeholder="USG Remarks"
                              aria-label="USG Remarks"
                              aria-describedby="basic-icon-default-usgRemarks"
                               />
                          </div>
                        </div>
						
						 <div class="col-4 mb-3" id="usgScanStatus" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgTrimester">USG Scan Status</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgScanStatus" id="usgScanStatus" class="form-select">
                          <option value="">Choose...</option>
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=48";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
                          </div>
                        </div>
						</div>
						<div class="row">
						
						<div class="col-4 mb-3" id="takenStatus" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgDoneDate">USG Report</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="file"
                              name="usgreport"
                              class="form-control"
                              id="usgreport"
                              placeholder="USG Taken Status"
                              aria-label="USG Taken Status"
                              aria-describedby="basic-icon-default-usgDoneDate"
                              accept="image/png, image/jpeg, application/pdf"
                           />
                          </div>
                        </div>
                        </div>				
				
           <input type="submit" name="USGDtls" value="Save" id="USGDtls" class="btn btn-primary" onclick="return checkPicmeAN()"> 
			</form>
			
			</div>
        </div>
    </div>
</div>
<!-- / Content -->
<?php include ('require/footer.php'); ?>