<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search
if (!empty($_POST["btnThird"])) {
  $picmeno = $_POST["picmeno"];
   $calciumDate =$_POST["calciumDate"]; 
   $sizeUterusinWeeks = $_POST["sizeUterusinWeeks"]; 
   
  $filename = $_FILES["usgreport"]["name"];

  $tempname = $_FILES["usgreport"]["tmp_name"];

  $folder = "../usgDocument/" . $filename;
  
// Now let's move the uploaded image into the folder: image

  move_uploaded_file($tempname, $folder);

$usgDoneDate = $_POST["usgDoneDate"]; 
$usgScanEdd = $_POST["usgScanEdd"];
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
$usgFetalMovement2 = $_POST["usgFetalMovement2"];
$lT1 = $_POST["lT1"]; 
$usgFHRT1 = $_POST["usgFHRT1"];
$usgFPT1 = $_POST["usgFPT1"]; 
$usgFMT1 = $_POST["usgFMT1"];
$lT2 = $_POST["lT2"]; 
$usgFHRT2 = $_POST["usgFHRT2"];
$usgFPT2 = $_POST["usgFPT2"]; 
$usgFMT2 = $_POST["usgFMT2"];
$lT3 = $_POST["lT3"]; 
$usgFHRT3 = $_POST["usgFHRT3"];
$usgFPT3 = $_POST["usgFPT3"]; 
$usgFMT3 = $_POST["usgFMT3"];

$placenta = $_POST["placenta"];
$usgResult = $_POST["usgResult"];
$usgRemarks = $_POST["usgRemarks"];

$query = mysqli_query($conn, "UPDATE antenatalvisit SET calciumDate='$calciumDate',PHCsizeUterusinWeeks='$sizeUterusinWeeks',usgreport='$filename',
 usgDoneDate='$usgDoneDate',usgScanEdd='$usgScanEdd',usgScanStatus='$usgScanStatus',usgFundalHeight='$usgFundalHeight',
 usgSizeUterusWeek='$usgSizeUterusWeek',usgFetusStatus='$usgFetusStatus',gestationSac='$gestationSac',liquor='$liquor',
 usgFetalHeartRate='$usgFetalHeartRate',usgFetalPosition='$usgFetalPosition',usgFetalMovement='$usgFetalMovement',liquor1='$liquor1',
 usgFetalHeartRate1='$usgFetalHeartRate1',usgFetalPosition1='$usgFetalPosition1',usgFetalMovement1='$usgFetalMovement',liquor2='$liquor2',
 usgFetalHeartRate2='$usgFetalHeartRate2',usgFetalPosition2='$usgFetalPosition2',usgFetalMovement2='$usgFetalMovement2',lT1='$lT1',
 usgFHRT1='$usgFHRT1',usgFPT1='$usgFPT1',usgFMT1='$usgFMT1',lT2='$lT2',
 usgFHRT2='$usgFHRT2',usgFPT2='$usgFPT2',usgFMT2='$usgFMT2',lT3='$lT3',
 usgFHRT3='$usgFHRT3',usgFPT3='$usgFPT3',usgFMT3='$usgFMT3',
 placenta='$placenta',usgResult='$usgResult',usgRemarks='$usgRemarks' WHERE picmeno=".$picmeno);
}

if (!empty($_POST["btnFourth"])) { 
  $picmeno = $_POST["picmeno"]; 
   $methodofConception = $_POST["methodofConception"]; 
   $symptomsHighRisk = $_POST["symptomsHighRisk"];
   $referralDate = $_POST["referralDate"]; 
   $referralDistrict = $_POST["referralDistrict"]; 
   $referralFacility = $_POST["referralFacility"];
   $referralPlace = $_POST["referralPlace"]; 
   $bloodTransfusion =$_POST["bloodTransfusion"]; 
   $bloodTransfusionDate = $_POST["bloodTransfusionDate"]; 
   $placeAdministrator = $_POST["placeAdministrator"]; 
   $nooIVdoses = $_POST["noOfIVDoses"];
  
 $query = mysqli_query($conn, "UPDATE antenatalvisit SET methodofConception='$methodofConception',
 PHCsymptomsHighRisk='$symptomsHighRisk',referralDate='$referralDate',referralDistrict='$referralDistrict',
 referralFacility='$referralFacility',referralPlace='$referralPlace',bloodTransfusion='$bloodTransfusion',bloodTransfusionDate='$bloodTransfusionDate',placeAdministrator='$placeAdministrator',
   noOfIVDoses='$nooIVdoses' WHERE picmeno=".$picmeno);
   
$motstatus = mysqli_query($conn, "UPDATE ecregister SET status=2 WHERE picmeNo=".$picmeno);
} 
?>
<!-- Content wrapper -->
    <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Antenatal Visit /</span> Add Antenatal Visit
              <a href="AntenatalVisit.php"><button type="submit" class="btn btn-primary" id="btnBack">
				<span class="bx bx-arrow-back"></span>&nbsp; Back
              </button></a>
			</h4>
      
			<!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">
                        Add Antenatal Visit
					  </h5>
                    <small class="float-end"><span class="mand">* </span> Fields are Mandatory</small>
                    </div>
                    <div class="card-body">
                      <?php
                      if (! empty($registrationResponse["status"])) {
                       
                        if ($registrationResponse["status"] == "error") {
                     ?>
				             <div class="server-response errMsg"><?php echo $registrationResponse["message"]; ?></div>
                    <?php
                             } else if ($registrationResponse["status"] == "success") {
                    ?>
                    <div class="server-response success-msg"><?php echo $registrationResponse["message"]; ?></div>
                    <?php
        }
    }
    ?>
	<div class="errMsg" id="errMsg"></div>
			<div id="secondDiv">
			<form action="" method="post">
			<input type="hidden" name="picmeno" value="<?php echo $picmeno; ?>">

            <div class="row">
                  <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-methodofConception">Method Of Contraception Councelling <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <select required name="methodofConception" id="methodofConception" class="form-select" >
                          <option value="">Choose...</option>
                        
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=29";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } ?>
                             </select> 
                          </div>
                        </div>
						            <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-symptomsHighRisk"> Symptoms High Risk During Visit <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <select required name="methodofConception" id="methodofConception" class="form-select" >
                          <option value="">Choose...</option>
                        
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=51";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } ?>
                             </select>
                          </div>
                        </div>
                        
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-referralFacility">Referral Facility <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required name="referralFacility" id="referralFacility" class="form-select" onchange="RefChange()">
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
                        <div class="col-4 mb-3" id="refDist" style="display: none;">
                          <label class="form-label" for="basic-icon-default-referralDistrict">Referral District </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="referralDistrict"
                              class="form-control"
                              id="referralDistrict"
                              placeholder="Referral District"
                              aria-label="Referral District"
                              aria-describedby="basic-icon-default-referralDistrict"
                              
                              />
                          </div>
                        </div>

						            <div class="col-4 mb-3"  id="refPlace" style="display: none;">
                          <label class="form-label" for="basic-icon-default-referralDate">Referral Place </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="referralPlace"
                              class="form-control"
                              id="referralPlace"
                              placeholder="Referral Place"
                              aria-label="Referral Place"
                              aria-describedby="basic-icon-default-referralDate"
                              
                              />
                          </div>
                        </div>

						            <div class="col-4 mb-3"  id="refDate" style="display: none;">
                          <label class="form-label" for="basic-icon-default-referralDate">Referral Date </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="referralDate"
                              class="form-control"
                              id="referralDate"
                              placeholder="Referral Date"
                              aria-label="Referral Date"
                              aria-describedby="basic-icon-default-referralDate"
                              
                              />
                          </div>
                        </div> 
						            <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-bloodTransfusion">Transfusion <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required name="bloodTransfusion" id="bloodTransfusion" class="form-select">
                          <option value="">Choose...</option>
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=44";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
                          </div>
                        </div>
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-bloodTransfusionDate">Transfusion Date <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="bloodTransfusionDate"
                              class="form-control"
                              id="bloodTransfusionDate"
                              placeholder="USG REPORT URL"
                              aria-label="USG REPORT URL"
                              aria-describedby="basic-icon-default-bloodTransfusionDate"
                              required />
                          </div>
                        </div>
						           <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-placeAdministered">Place Administered <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="placeAdministrator"
                              class="form-control"
                              id="placeAdministrator"
                              placeholder="Place Administered"
                              aria-label="Place Administered"
                              aria-describedby="basic-icon-default-placeAdministered"
                              required />
                          </div>
                        </div>
					
				                <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-noOfIVDoses">NO. of Units / IV Doses <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="noOfIVDoses"
                              class="form-control"
                              id="noOfIVDoses"
                              placeholder="NO. of IV Doses"
                              aria-label="NO. of IV Doses"
                              aria-describedby="basic-icon-default-noOfIVDoses"
                              required />
                          </div>
                        </div>
					            </div>				
			<input class="btn btn-primary" type="submit" name="btnFourth" value="Save">
			</form>
			</div>
			</div>
        </div>
    </div>
</div>
<!-- / Content -->
<?php include ('require/footer.php'); ?>