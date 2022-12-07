<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search 
if (!empty($_POST["btnFirst"])) {
  $motheraadhaarid = $_POST["motheraadhaarid"];
  $CheckDuplicatePno = mysqli_query($conn,"SELECT picmeno FROM antenatalvisit where picmeno='".$_POST["picmeno"]."' ");
  while($picvalue = mysqli_fetch_array($CheckDuplicatePno))
  { 
    $pvalue = $picvalue["picmeno"];
  }
  
  if($pvalue > 0) {
    $type = "error";
    $emessage = "Duplicate PICME No.";
  } else {
  $picmeno =$_POST["picmeno"];
  $residenttype = $_POST["residenttype"]; 
  $physicalpresent = $_POST["physicalpresent"]; 
  $placeofvisit = $_POST["placeofvisit"];
  $abortion = $_POST["abortion"]; 
  $anvisitDate = $_POST["anvisitDate"]; 
  $avduedate = date('Y-m-d', strtotime($anvisitDate. ' + 30 days'));
  $ancPeriod = $_POST["ancPeriod"]; 
  $pregnancyWeek = $_POST["pregnancyWeek"];
  $motherWeight = $_POST["motherWeight"]; 
  $bpSys = $_POST["bpSys"]; 
  $bpDia = $_POST["bpDia"];
  $Hb = $_POST["Hb"]; 
  $urineTestStatus = $_POST["urineTestStatus"]; 
  $urineSugarPresent = $_POST["urineSugarPresent"];
  $urineAlbuminPresent = $_POST["urineAlbuminPresent"];

  $query = mysqli_query($conn,"INSERT INTO antenatalvisit (motheraadhaarid,picmeno,residenttype,physicalpresent,placeofvisit,abortion,anvisitDate,avdueDate,avTag,ancPeriod,pregnancyWeek,motherWeight,bpSys,bpDia,Hb,urineTestStatus,urineSugarPresent,urineAlbuminPresent,createdBy) 
  VALUES ('$motheraadhaarid','$picmeno','$residenttype','$physicalpresent','$placeofvisit','$abortion','$anvisitDate','$avduedate','1','$ancPeriod','$pregnancyWeek','$motherWeight','$bpSys','$bpDia','$Hb','$urineTestStatus','$urineSugarPresent','$urineAlbuminPresent','$userid')");   

  }
}

if(!empty($_POST["btnFirst"])) {
  $motheraadhaarid = $_POST["motheraadhaarid"];
  $picmeno =$_POST["picmeno"]; 
  $uquery = mysqli_query($conn,"UPDATE ecregister SET picmeNo='$picmeno' WHERE motheraadhaarid='$motheraadhaarid' ");
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
  <div id="response" class="<?php if(!empty($type)) { echo $type . " display-BlockId"; } ?>"><?php if(!empty($emessage)) { echo $emessage; } ?></div>

			<div id="secondDiv">
			
                           <form action="AddAnVisit3.php" method="post">
			<input type="hidden" name="picmeno" value="<?php echo $picmeno ?>">
					<div class="row">
						<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-fastingSugar">Fasting Sugar </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="fastingSugar"
                              class="form-control"
                              id="fastingSugar"
                              placeholder="Fasting Sugar"
                              aria-label="Fasting Sugar"
                              aria-describedby="basic-icon-default-fastingSugar"
                    
                            />
                          </div>
                        </div>
						<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-postPrandial">Post Prandial </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="postPrandial"
                              class="form-control"
                              id="postPrandial"
                              placeholder="Post Prandial"
                              aria-label="Post Prandial"
                              aria-describedby="basic-icon-default-postPrandial"
                            
                            />
                          </div>
                        </div>
					
						<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-gctStatus">GCT Week Status <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select name="gctStatus" id="gctStatus" class="form-select" onchange="usgChange()">
                          <option value="">Choose...</option>
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=46";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
                          </div>
                        </div>
                       
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-gctValue">GCT Value <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <input
                              type="number"
                              name="gctValue"
                              class="form-control"
                              id="gctValue"
                              placeholder="GCT Value"
                              aria-label="GCT Value"
                              aria-describedby="basic-icon-default-gctValue"
                              required
                              />
                          </div>
                        </div>
                   
						<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-Tsh">TSH </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="Tsh"
                              class="form-control"
                              id="tsh"
                              placeholder="TSH"
                              aria-label="TSH"
                              aria-describedby="basic-icon-default-Tsh"
                              
                              />
                          </div>
                        </div>
                        
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-TdBoosterDate">Td1 (Yes / No) <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required name="Td1" id="Td1" class="form-select" onchange="Td1Change()">
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
                
						<div class="col-4 mb-3"  id="Tddose1" style="display: none;">
                          <label class="form-label" for="basic-icon-default-TdDose">Td1 Dose </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="TdDose"
                              class="form-control"
                              id="TdDose"
                              placeholder="Td Dose"
                              aria-label="Td Dose"
                              aria-describedby="basic-icon-default-TdDose"
                              
                              />
                          </div>
                        </div>

                        <div class="col-4 mb-3" id="Tddate1"  style="display: none;">
                          <label class="form-label" for="basic-icon-default-Td1Date">Td1 Date </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="Td1Date"
                              class="form-control"
                              id="Td1Date"
                              placeholder="Td1 Date"
                              aria-label="Td1 Date"
                              aria-describedby="basic-icon-default-Td1Date"
                              
                              />
                          </div>
                        </div>
                        
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-TdBoosterDate">Td2 (Yes / No) <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required name="Td2" id="Td2" class="form-select" onchange="Td2Change()">
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

          <div class="col-4 mb-3" id="Tddose2"  style="display: none;">
                          <label class="form-label" for="basic-icon-default-Td2Dose">Td2 Dose </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="Td2Dose"
                              class="form-control"
                              id="Td2Dose"
                              placeholder="Td Dose"
                              aria-label="Td Dose"
                              aria-describedby="basic-icon-default-TdDose"
                              
                              />
                          </div>
                        </div>
                        <div class="col-4 mb-3" id="Tddate2"  style="display: none;">
                          <label class="form-label" for="basic-icon-default-Td1Date">Td2 Date </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="Td2Date"
                              class="form-control"
                              id="Td1Date"
                              placeholder="Td1 Date"
                              aria-label="Td1 Date"
                              aria-describedby="basic-icon-default-Td1Date"
                              
                              />
                          </div>
                        </div>
                        
          <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-TdBoosterDate">Td Booster (Yes / No) <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required name="Tdb" id="Tdb" class="form-select" onchange="TdBChange()">
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
                        
						<div class="col-4 mb-3" id="TdB"  style="display: none;">
                          <label class="form-label" for="basic-icon-default-TdBoosterDate">Td Booster Date</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="TdBoosterDate"
                              class="form-control"
                              id="TdBoosterDate"
                              placeholder="Td Booster Date"
                              aria-label="Td Booster Date"
                              aria-describedby="basic-icon-default-TdBoosterDate"
                              
                              />
                          </div>
                        </div>
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-TdBoosterDate">Covid vaccination</label>
                          <div class="input-group input-group-merge">
                          <select name="Covidvac" id="Covidvac" class="form-select" onchange="CovidChange()">
                          <option value="">Choose...</option>
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=47";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
                          </div>
                        </div>

                        <div class="col-4 mb-3" id="dose1" style="display: none;">
                          <label class="form-label" for="basic-icon-default-Dose1Date">Dose1 Date </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="Dose1Date"
                              class="form-control"
                              id="Dose1Date"
                              placeholder="Dose1 Date"
                              aria-label="Dose1 Date"
                              aria-describedby="basic-icon-default-Dose1Date"
                              
                              />
                          </div>
                        </div>
                        
                        <div class="col-4 mb-3" id="dose2" style="display: none;">
                          <label class="form-label" for="basic-icon-default-Dose2Date">Dose2 date </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="Dose2Date"
                              class="form-control"
                              id="Dose2Date"
                              placeholder="Dose2 Date"
                              aria-label="Dose2 Date"
                              aria-describedby="basic-icon-default-Dose2Date"
                              
                              />
                          </div>
                        </div>
                        
                        <div class="col-4 mb-3" id="predose" style="display: none;">
                          <label class="form-label" for="basic-icon-default-PreDate">Precaution Dose Date </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="PreDate"
                              class="form-control"
                              id="PreDate"
                              placeholder="Td1 Date"
                              aria-label="Td1 Date"
                              aria-describedby="basic-icon-default-PreDate"
                              
                              />
                          </div>
                        </div>
                        
					<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-NoFolicAcid">Number of Folic Acid </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="NoFolicAcid"
                              class="form-control"
                              id="NoFolicAcid"
                              placeholder="No. of Folic Acid"
                              aria-label="No. of Folic Acid"
                              aria-describedby="basic-icon-default-NoFolicAcid"
                              
                              />
                          </div>
                    </div>
                    
					<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-NoIFA">Number of IFA </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="NoIFA"
                              class="form-control"
                              id="NoIFA"
                              placeholder="No. of IFA"
                              aria-label="No. of IFA"
                              aria-describedby="basic-icon-default-NoIFA"
                              
                              />
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
                               />
                          </div>
                        </div>
                        
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
                              aria-describedby="basic-icon-default-dateofAlbendazole"
                              
                              />
                          </div>
                        </div>
                        
						<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-noCalcium">No. of Calcium </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="noCalcium"
                              class="form-control"
                              id="noCalcium"
                              placeholder="No. of Calcium"
                              aria-label="No. of Calcium"
                              aria-describedby="basic-icon-default-noCalcium"
                              
                              />
                          </div>
                        </div>
					</div>
<input class="btn btn-primary" type="submit" name="btnSecond" value="NEXT">
			</form>
			</div>
			</div>
        </div>
    </div>
</div>
<!-- / Content -->
<?php include ('require/footer.php'); ?>