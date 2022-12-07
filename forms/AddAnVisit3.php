<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search
if (!empty($_POST["btnSecond"])) {
  $picmeno = $_POST["picmeno"];
  $fastingSugar = $_POST["fastingSugar"]; 
  $postPrandial = $_POST["postPrandial"]; 
  $gctStatus = $_POST["gctStatus"]; 
  $gctValue = $_POST["gctValue"]; 
  $tsh = $_POST["Tsh"]; 
  $TdDose = $_POST["TdDose"];
  $Td1Date = $_POST["Td1Date"]; 
  $Td2Dose = $_POST["Td2Dose"];
  $Td2Date = $_POST["Td2Date"]; 
  $TdBoosterDate = $_POST["TdBoosterDate"];
  $Covidvac = $_POST["Covidvac"]; 
  $Dose1Date = $_POST["Dose1Date"];
  $Dose2Date = $_POST["Dose2Date"];
  $PreDate = $_POST["PreDate"];
  $NoFolicAcid = $_POST["NoFolicAcid"];
  $NoIFA = $_POST["NoIFA"]; 
  $dateofIFA = $_POST["dateofIFA"]; 
  $dateofAlbendazole = $_POST["dateofAlbendazole"];
  $noCalcium = $_POST["noCalcium"];

 $query = mysqli_query($conn, "UPDATE antenatalvisit SET fastingSugar='$fastingSugar',postPrandial='$postPrandial',
 gctStatus='$gctStatus',gctValue='$gctValue',Tsh='$tsh',TdDose='$TdDose',Td1Date='$Td1Date',Td2Dose='$Td2Dose',
 Td2Date='$Td2Date',TdBoosterDate='$TdBoosterDate',covidvac='$Covidvac',Dose1Date='$Dose1Date',Dose2Date='$Dose2Date',
 preDate='$PreDate',NoFolicAcid='$NoFolicAcid',NoIFA='$NoIFA',DateofIFA='$dateofIFA',
 DateofAlbendazole='$dateofAlbendazole',noCalcium='$noCalcium' WHERE picmeno=".$picmeno);
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
                      <h5 class="mb-0">Add Antenatal Visit</h5>
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
			<form action="AddAnVisit4.php"  enctype="multipart/form-data" method="post">
			<input type="hidden" name="picmeno" value="<?php echo $picmeno; ?>">

                    <div class="row">
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
                              required
                            />
                          </div>
                        </div>
					            	<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-sizeUterusinWeeks">Uterus Size In Weeks <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="sizeUterusinWeeks"
                              class="form-control"
                              id="sizeUterusinWeeks"
                              placeholder="Size Uterus In Weeks"
                              aria-label="Size Uterus In Weeks"
                              aria-describedby="basic-icon-default-sizeUterusinWeeks"
                              required />
                          </div>
                        </div>
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
                               />
                          </div>
                        </div>
                        
			           <div class="col-4 mb-3" id="usgScanEdd" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgScanEdd">USG Scan Edd</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgScanEdd"
                              class="form-control"
                              id="usgScanEdd"
                              placeholder="USG Scan Edd"
                              aria-label="USG Scan Edd"
                              aria-describedby="basic-icon-default-usgScanEdd"
                              />
                          </div>
                        </div>
                        
                        </div>
					<div class="row">
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
                        
                        </div>
					<div class="row">
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
                           
						         <div class="col-4 mb-3" id="liquor" class="liquor" style="display:none;">
                          <label class="form-label" for="basic-icon-default-liquor">Liquor</label>
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
					          	<div class="col-4 mb-3" id="usgFetalHeartRate" class="usgFetalHeartRate" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalHeartRate">USG FOETAL Heart Rate</label>
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
                       
					            	<div class="col-4 mb-3" id="usgFetalPosition" class="usgFetalPosition" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalPosition">USG FOETAL Presentation</label>
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
					            	<div class="col-4 mb-3" id="usgFetalMovement" class="usgFetalMovement" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalMovement">USG FOETAL Movement</label>
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

                        <div class="col-4 mb-3" id="liquor1" class="liquor1" style="display:none;">
                          <label class="form-label" for="basic-icon-default-liquor">Liquor 1</label>
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
					          	<div class="col-4 mb-3" id="usgFetalHeartRate1" class="usgFetalHeartRate1" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalHeartRate">USG FOETAL Heart Rate 1</label>
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
                       
					            	<div class="col-4 mb-3" id="usgFetalPosition1" class="usgFetalPosition1" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalPosition">USG FOETAL Presentation 1</label>
                          <div class="input-group input-group-merge">
                          <input
                              type="text"
                              name="usgFetalPosition1"
                              class="form-control"
                              id="usgFetalPosition1"
                              placeholder="USG FOETAL Heart Rate"
                              aria-label="USG FOETAL Heart Rate"
                              aria-describedby="basic-icon-default-usgFetalHeartRate"
                               />
                          </div>
                        </div> 
					            	<div class="col-4 mb-3" id="usgFetalMovement1" class="usgFetalMovement1" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalMovement">USG FOETAL Movement 1</label>
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

                        <div class="col-4 mb-3" id="liquor2" class="liquor2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-liquor">Liquor 2</label>
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
					          	<div class="col-4 mb-3" id="usgFetalHeartRate2" class="usgFetalHeartRate2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalHeartRate">USG FOETAL Heart Rate 2</label>
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
                       
					            	<div class="col-4 mb-3" id="usgFetalPosition2" class="usgFetalPosition2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalPosition">USG FOETAL Presentation 2</label>
                          <div class="input-group input-group-merge">
                          <input
                              type="text"
                              name="usgFetalPosition2"
                              class="form-control"
                              id="usgFetalPosition2"
                              placeholder="USG FOETAL Heart Rate"
                              aria-label="USG FOETAL Heart Rate"
                              aria-describedby="basic-icon-default-usgFetalHeartRate"
                               />
                          </div>
                        </div> 
					            	<div class="col-4 mb-3" id="usgFetalMovement2" class="usgFetalMovement2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalMovement">USG FOETAL Movement 2</label>
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

                        <!---- Triple Baby Field Start --->

                        <div class="col-4 mb-3" id="lT1" class="lT" style="display:none;">
                          <label class="form-label" for="basic-icon-default-liquor">Liquor 1</label>
                          <div class="input-group input-group-merge">
                          <select  name="lT1" id="lT1" class="form-select">
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
					          	<div class="col-4 mb-3" id="usgFHRT1" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalHeartRate">USG FOETAL Heart Rate 1</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgFHRT1"
                              class="form-control"
                              id="usgFHRT1"
                              placeholder="USG FOETAL Heart Rate"
                              aria-label="USG FOETAL Heart Rate"
                              aria-describedby="basic-icon-default-usgFetalHeartRate"
                               />
                          </div>
                        </div>
                       
					            	<div class="col-4 mb-3" id="usgFPT1" class="usgFPT1" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalPosition">USG FOETAL Presentation 1</label>
                          <div class="input-group input-group-merge">
                          <input
                              type="text"
                              name="usgFPT1"
                              class="form-control"
                              id="usgFPT1"
                              placeholder="USG FOETAL Heart Rate"
                              aria-label="USG FOETAL Heart Rate"
                              aria-describedby="basic-icon-default-usgFetalHeartRate"
                               />
                          </div>
                        </div> 
					            	<div class="col-4 mb-3" id="usgFMT1" class="usgFMT1" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalMovement">USG FOETAL Movement 1</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFMT1" id="usgFMT1" class="form-select">
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

                        <div class="col-4 mb-3" id="lT2" class="lT2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-liquor">Liquor 2</label>
                          <div class="input-group input-group-merge">
                          <select  name="lT2" id="lT2" class="form-select">
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
					          	<div class="col-4 mb-3" id="usgFHRT2" class="usgFHRT2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalHeartRate">USG FOETAL Heart Rate 2</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgFHRT2"
                              class="form-control"
                              id="usgFHRT2"
                              placeholder="USG FOETAL Heart Rate"
                              aria-label="USG FOETAL Heart Rate"
                              aria-describedby="basic-icon-default-usgFetalHeartRate"
                               />
                          </div>
                        </div>
                       
					            	<div class="col-4 mb-3" id="usgFPT2" class="usgFPT2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalPosition">USG FOETAL Presentation 2</label>
                          <div class="input-group input-group-merge">
                          <input
                              type="text"
                              name="usgFPT2"
                              class="form-control"
                              id="usgFPT2"
                              placeholder="USG FOETAL Heart Rate"
                              aria-label="USG FOETAL Heart Rate"
                              aria-describedby="basic-icon-default-usgFetalHeartRate"
                               />
                          </div>
                        </div> 
					            	<div class="col-4 mb-3" id="usgFMT2" class="usgFMT2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalMovement">USG FOETAL Movement 2</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFMT2" id="usgFMT2" class="form-select">
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
                        
                        <div class="col-4 mb-3" id="lT3" class="lT3" style="display:none;">
                          <label class="form-label" for="basic-icon-default-liquor">Liquor 3</label>
                          <div class="input-group input-group-merge">
                          <select  name="lT3" id="lT3" class="form-select">
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
					          	<div class="col-4 mb-3" id="usgFHRT3" class="usgFHRT3" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalHeartRate">USG FOETAL Heart Rate 3</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgFHRT3"
                              class="form-control"
                              id="usgFHRT3"
                              placeholder="USG FOETAL Heart Rate"
                              aria-label="USG FOETAL Heart Rate"
                              aria-describedby="basic-icon-default-usgFetalHeartRate"
                               />
                          </div>
                        </div>
                       
					            	<div class="col-4 mb-3" id="usgFPT3" class="usgFPT3" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalPosition">USG FOETAL Presentation 3</label>
                          <div class="input-group input-group-merge">
                          <input
                              type="text"
                              name="usgFPT3"
                              class="form-control"
                              id="usgFPT3"
                              placeholder="USG FOETAL Heart Rate"
                              aria-label="USG FOETAL Heart Rate"
                              aria-describedby="basic-icon-default-usgFetalHeartRate"
                               />
                          </div>
                        </div> 
					            	<div class="col-4 mb-3" id="usgFMT3" class="usgFMT3" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalMovement">USG FOETAL Movement 3</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFMT3" id="usgFMT3" class="form-select">
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
                    </div>					
<input class="btn btn-primary" type="submit" name="btnThird" value="NEXT">		
			</form>
			</div>
			</div>
    </div>
  </div>
</div>
<!-- / Content -->
<?php include ('require/footer.php'); ?>