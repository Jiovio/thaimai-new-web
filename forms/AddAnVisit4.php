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
$wusgTaken = $_POST["wusgTaken"];
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
$placenta = $_POST["placenta"];
$usgResult = $_POST["usgResult"];
$usgRemarks = $_POST["usgRemarks"];

$query = mysqli_query($conn, "UPDATE antenatalvisit SET calciumDate='$calciumDate',sizeUterusinWeeks='$sizeUterusinWeeks',wusgTaken='$wusgTaken',usgreport='$filename',
 usgDoneDate='$usgDoneDate',usgScanEdd='$usgScanEdd',usgScanStatus='$usgScanStatus',usgFundalHeight='$usgFundalHeight',
 usgSizeUterusWeek='$usgSizeUterusWeek',usgFetusStatus='$usgFetusStatus',gestationSac='$gestationSac',liquor='$liquor',
 usgFetalHeartRate='$usgFetalHeartRate',usgFetalPosition='$usgFetalPosition',usgFetalMovement='$usgFetalMovement',liquor1='$liquor1',
 usgFetalHeartRate1='$usgFetalHeartRate1',usgFetalPosition1='$usgFetalPosition1',usgFetalMovement1='$usgFetalMovement1',liquor2='$liquor2',
 usgFetalHeartRate2='$usgFetalHeartRate2',usgFetalPosition2='$usgFetalPosition2',usgFetalMovement2='$usgFetalMovement2',
 placenta='$placenta',usgResult='$usgResult',usgRemarks='$usgRemarks' WHERE picmeno=".$picmeno);
}

if (!empty($_POST["btnFourth"])) { 
  $picmeno = $_POST["picmeno"]; 
   $methodofConception = $_POST["methodofConception"]; 
   $AnyOtherSpecify = $_POST["AnyOtherSpecify"];
   $HighRisk = $_POST["HighRisk"];
   $symptomsHighRisk = $_POST["symptomsHighRisk"];
   $referralDate = $_POST["referralDate"]; 
   $referralDistrict = $_POST["referralDistrict"]; 
   $referralFacility = $_POST["referralFacility"];
   $referralPlace = $_POST["referralPlace"]; 
   $bloodTransfusion =$_POST["bloodTransfusion"]; 
   $bloodTransfusionDate = $_POST["bloodTransfusionDate"]; 
   $placeAdministrator = $_POST["placeAdministrator"]; 
   $nooIVdoses = $_POST["noOfIVDoses"];
  
 $query = mysqli_query($conn, "UPDATE antenatalvisit SET methodofConception='$methodofConception',AnyOtherSpecify='$AnyOtherSpecify',
 HighRisk='$HighRisk',symptomsHighRisk='$symptomsHighRisk',referralDate='$referralDate',referralDistrict='$referralDistrict',
referralFacility='$referralFacility',referralPlace='$referralPlace',bloodTransfusion='$bloodTransfusion',bloodTransfusionDate='$bloodTransfusionDate',placeAdministrator='$placeAdministrator',
   noOfIVDoses='$nooIVdoses' WHERE picmeno=".$picmeno);
   if (!empty($query)) {
            echo "<script>alert('Inserted Successfully');window.location.replace('http://admin.thaimaiyudan.org/forms/AntenatalVisit.php');</script>";
          }
	if(($symptomsHighRisk !=47) && ($symptomsHighRisk !=48)) {
      
            $getMname = mysqli_query($conn,"SELECT motheraadhaarname FROM ecregister WHERE picmeNo='$picmeno'");
            while($value = mysqli_fetch_array($getMname)) {
                $mn = $value["motheraadhaarname"];
            }
            $hrqry = mysqli_query($conn,"INSERT INTO highriskmothers (picmeNo, motherName, highRiskFactor) 
            VALUES ('$picmeno','$mn','$symptomsHighRisk')"); 
            $uqry= mysqli_query($conn,"UPDATE antenatalvisit SET highRiskStatus=1 WHERE picmeno='$picmeno'");
        }
$highrisk = mysqli_query($conn, "UPDATE ecregister ec INNER JOIN antenatalvisit av ON ec.picmeNo=av.picmeno SET ec.status=6 WHERE av.symptomsHighRisk NOT IN('1','48') AND ec.picmeNo=".$picmeno);
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
                            <select required name="methodofConception" id="methodofConception" onChange="MofConceptionChange()" class="form-select" >
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
                        <div class="col-4 mb-3" id="Specify" style="display: none;">
                          <label class="form-label" for="basic-icon-default-AnyOtherSpecify">Any Other Specify </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="AnyOtherSpecify"
                              class="form-control"
                              id="AnyOtherSpecify"
                              placeholder="Any Other Specify"
                              aria-label="Any Other Specify"
                              aria-describedby="basic-icon-default-AnyOtherSpecify"
                              
                              />
                          </div>
                        </div>
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-highRisk">Symptoms High Risk <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required name="HighRisk" id="highRisk" onChange="SymHighRishChange()" class="form-select">
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
						            <div class="col-4 mb-3" id="symptom" style="display: none;">
                          <label class="form-label" for="basic-icon-default-symptomsHighRisk"> Symptoms High Risk During Visit <!--<span class="mand">* </span>--></label>
                          <div class="input-group input-group-merge">
                            <select name="symptomsHighRisk" id="symptomsHighRisk" class="form-select" >
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
                        
                        <div class="col-4 mb-3" id="refFacility" style="display: none;">
                          <label class="form-label" for="basic-icon-default-referralFacility">Referral Facility </label>
                          <div class="input-group input-group-merge">
                          <select name="referralFacility" id="referralFacility" class="form-select" onchange="RefChange()">
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
						            <div class="col-4 mb-3" id="bTrans" style="display: none;">
                          <label class="form-label" for="basic-icon-default-bloodTransfusion">Transfusion <!--<span class="mand">* </span>--></label>
                          <div class="input-group input-group-merge">
                          <select name="bloodTransfusion" id="bloodTransfusion" class="form-select">
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
                        <div class="col-4 mb-3" id="transDate" style="display: none;">
                          <label class="form-label" for="basic-icon-default-bloodTransfusionDate">Transfusion Date <!--<span class="mand">* </span>--></label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="bloodTransfusionDate"
                              class="form-control"
                              id="bloodTransfusionDate"
                              placeholder="USG REPORT URL"
                              aria-label="USG REPORT URL"
                              aria-describedby="basic-icon-default-bloodTransfusionDate"
                               />
                          </div>
                        </div>
						           <div class="col-4 mb-3" id="placeAdmin" style="display: none;">
                          <label class="form-label" for="basic-icon-default-placeAdministered">Place Administered <!--<span class="mand">* </span>--></label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="placeAdministrator"
                              class="form-control"
                              id="placeAdministrator"
                              placeholder="Place Administered"
                              aria-label="Place Administered"
                              aria-describedby="basic-icon-default-placeAdministered"
                               />
                          </div>
                        </div>
					
				                <div class="col-4 mb-3" id="ivDoses" style="display: none;">
                          <label class="form-label" for="basic-icon-default-noOfIVDoses">NO. of Units / IV Doses <!--<span class="mand">* </span>--></label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="noOfIVDoses"
                              class="form-control"
                              id="noOfIVDoses"
                              placeholder="NO. of IV Doses"
                              aria-label="NO. of IV Doses"
                              aria-describedby="basic-icon-default-noOfIVDoses"
                               />
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
