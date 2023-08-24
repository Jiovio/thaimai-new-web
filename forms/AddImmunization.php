<?php include ('require/topHeader.php'); ?>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search
if (! empty($_POST["addImmunization"])) {
  $CheckDuplicatePno = mysqli_query($conn,"SELECT picmeNo FROM deliverydetails where picmeNo='".$_POST["picmeNo"]."' ");
  $pid = 0;
  while($Mvalue = mysqli_fetch_array($CheckDuplicatePno)) {
      
    $pid = $Mvalue["picmeNo"];
  
  } 
  if(empty($pid)) {
   
  $type = "error";
  $emessage = "PICME No doesn't exist";
  
   } else {
  $picmeno = $_POST["picmeNo"]; 
  $doseNo = $_POST["doseNo"]; 
  $doseName = implode(",",$_POST["doseName"]); 
  $doseDueDate = $_POST["doseDueDate"];
  $doseProvidedDate = $_POST["doseProvidedDate"]; 
  $query = mysqli_query($conn,"SELECT dd.deliverydate FROM deliverydetails dd JOIN immunization im  ON im.picmeNo=dd.picmeno WHERE dd.picmeno='$picmeno'");
  while ($fdate = mysqli_fetch_array($query)){
   $futdate = $fdate['deliverydate'];
  }
  if($doseNo == 1) {
  $FutureDoseDate = date('Y-m-d', strtotime($futdate. '+ 74 days' ));
  } if($doseNo == 2) {
    $FutureDoseDate = date('Y-m-d', strtotime($futdate. '+ 104 days' ));
  } if($doseNo == 3) {
    $FutureDoseDate = date('Y-m-d', strtotime($futdate. '+ 269 days' ));
  } if($doseNo == 4) {
    $FutureDoseDate = date('Y-m-d', strtotime($futdate. '+ 479 days' ));
  }

if($doseNo == 1) {
  $FutureDoseNo = $doseNo + 1;
  } else if($doseNo == 2) {
  $FutureDoseNo = $doseNo + 1;
  } else if($doseNo == 3) {
  $FutureDoseNo = $doseNo + 1;
  } else if($doseNo == 4) {
  $FutureDoseNo = $doseNo + 1;
  }
  
  $breastFeeding = $_POST["breastFeeding"]; 
  $compliFoodStart = $_POST["compliFoodStart"];
  //  $motherCovidVac1Done = $_POST["motherCovidVac1Done"];
  // $motherCovidVac1Type = $_POST["motherCovidVac1Type"];
  // $motherCovidVac1Date = $_POST["motherCovidVac1Date"]; 
  
//   if($motherCovidVac1Type == '1') {
//     $Fcov2DueDate = date('Y-m-d', strtotime($motherCovidVac1Date. '+ 30 days' ));
//   } else if($motherCovidVac1Type == '2'){
//     $Fcov2DueDate = date('Y-m-d', strtotime($motherCovidVac1Date. '+ 90 days' ));  
//   }
  
  // if($motherCovidVac1Type == '1') {
  //   $motherFuDoseDate = date('Y-m-d', strtotime($motherCovidVac1Date. '+ 30 days' ));
  // } else if($motherCovidVac1Type == '2'){
  //   $motherFuDoseDate = date('Y-m-d', strtotime($motherCovidVac1Date. '+ 90 days' ));  
  // }

  // $motherCovidVac2Done = $_POST["motherCovidVac2Done"];
  // $motherCovidVac2Type = $_POST["motherCovidVac2Type"]; 
  // $motherCovidVac2Date = $_POST["motherCovidVac2Date"];
  
//   if($motherCovidVac2Type == '1') {
//     $FBcovDueDate = date('Y-m-d', strtotime($motherCovidVac2Date. '+ 180 days' ));
//   } else if($motherCovidVac2Type == '2'){
//     $FBcovDueDate = date('Y-m-d', strtotime($motherCovidVac2Date. '+ 180 days' )); 
//   }
  
  // if($motherCovidVac1Type == '1') {
  //   $motherFuDoseDate = date('Y-m-d', strtotime($motherCovidVac2Date. '+ 180 days' ));
  // } else if($motherCovidVac1Type == '2'){
  //   $motherFuDoseDate = date('Y-m-d', strtotime($motherCovidVac2Date. '+ 180 days' ));  
  // }

  // $motherCovidVacBoosterDone = $_POST["motherCovidVacBoosterDone"]; 
  // $motherCovidVacBoosterType = $_POST["motherCovidVacBoosterType"];
  // $motherCovidVacBoosterDate = $_POST["motherCovidVacBoosterDate"];
  
//   if($motherCovidVac1Type == '1' || $motherCovidVac1Type == '2' ) {
//     $NextDoseName1 = $motherCovidVac1Type;
//   }else if($motherCovidVac2Type == '1' || $motherCovidVac2Type == '2'){
//     $NextDoseName1 = $motherCovidVac2Type;
    
//   } else if($motherCovidVacBoosterType == '1' || $motherCovidVacBoosterType == '2'){
//     $NextDoseName1 = $motherCovidVacBoosterType;
    
//   }
  // if($motherCovidVac1Type == '1' || $motherCovidVac1Type == '2' ) {
  //   $motherFuDoseName = $motherCovidVac1Type;
  // }else if($motherCovidVac2Type == '1' || $motherCovidVac2Type == '2'){
  //   $motherFuDoseName = $motherCovidVac2Type;
    
  // } else if($motherCovidVacBoosterType == '1' || $motherCovidVacBoosterType == '2'){
  //   $motherFuDoseName = $motherCovidVacBoosterType;
    
  // }
  $query = mysqli_query($conn,"INSERT INTO immunization(picmeNo, DoseNo, DoseName, DoseDueDate, DoseProvidedDate,futureDoseNo,futureDoseDate, breastFeeding, compliFoodStart,createdUserId) 
  VALUES ('$picmeno','$doseNo','$doseName','$doseDueDate','$doseProvidedDate','$FutureDoseNo','$FutureDoseDate','$breastFeeding','$compliFoodStart','$userid')");
//   print_r($query.'hhhhhhhh');
//   exit;
    if (!empty($query)) {
            echo "<script>alert('Inserted Successfully');window.location.replace('{$siteurl}/forms/Immunization.php');</script>";
    } } } ?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Immunization /</span> Add Immunization
              <a href="Immunization.php"><button type="submit" class="btn btn-primary" id="btnBack">
                    <span class="bx bx-arrow-back"></span>&nbsp; Back
              </button></a>
			</h4>
			<!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">
                        Add Immunization
					  </h5>
                    <small class="float-end"><span class="mand">* </span> Fields are Mandatory</small>
                    </div>
                    <div class="card-body">
                    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } else { echo $type . " display-none"; } ?>"><?php if(!empty($emessage)) { echo $emessage; } ?></div>
                    <br>
                      <form action="" method="post" autocomplete="off" onSubmit="return addImmuneValidate()">
					<div class="row">
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="basic-icon-default-fullname">PICME NUMBER <span class="mand">* </span></label>
                          <div class="frmSearch">
                          <input type="text" required id="picmenoImmune" name="picmeNo" oninput = "onlyNumbers(this.value)" placeholder="PICME Number" class="form-control" />
                          <div id="suggesstion-box"></div>
                      </div>
                      </div>
						<div class="mb-3 col-md-6">
                          <label class="form-label">Dose No. <span class="mand">* </span></label>
                            <select required name="doseNo" id="doseNo" class="form-select">
                          <option value="">Choose...</option>
                           <?php 
                            $query = "SELECT enumid,enumvalue,doseNo FROM enumdata WHERE type=42;";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                           <?php } ?>
                             </select>
                          </div>
                    </div>
					<div class="row">
						<div class="mb-3 col-md-6">
                          <label class="form-label">Dose Name <span class="mand">* </span></label>
                            <select required name="doseName[]" id="doseName" multiple="multiple" class="form-select" disabled>
                          <?php 
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=43;";
                            $exequery = mysqli_query($conn, $query);

                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                           <?php 
                             } ?>
                             </select>
                        </div>
						<div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">Dose Due Date <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="doseDueDate"
                              id="doseDueDate"
                              class="form-control"
                              placeholder="Dose Due Date"
                              aria-label="Dose Due Date"
                              aria-describedby="basic-icon-default-conpassword" 
                              required
                            />
                          </div>
                        </div>
					</div>
					<div class="row">
						<div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Dose Provided Date <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="doseProvidedDate"
                              id="doseProvidedDate"
                              class="form-control phone-mask"
                              placeholder="Dose Provided Date"
                              aria-label="Dose Provided Date"
                              aria-describedby="basic-icon-default-mobile"
                            required
                              />
                            
                          </div>
                          <div id="dose-provide-box"></div>
                        </div>
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Breast Feeding</label>
                          <div class="input-group input-group-merge">
                          <select name="breastFeeding" id="breastFeeding" class="form-select" value="<?php echo $usertype; ?>">
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
						<div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Complimentary Food Started ( 7th Month )</label>
                          <div class="input-group input-group-merge">
                          <select name="compliFoodStart" id="compliFoodStart" class="form-select">
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
						<!-- <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Mother Vaccine 1 Done</label>
                          <div class="input-group input-group-merge">
                          <select onchange="VacDone1()" name="motherCovidVac1Done" id="motherCovidVac1Done" class="form-select">
                          <option value="">Choose...</option>
                          <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                          </select>
						</div>
						</div> -->
					</div>
                    <!-- <div class="row">
						<div class="col-6 mb-3" id="motherCovidVac1T" style="display: none;">
                          <label class="form-label" for="basic-icon-default-phone">Mother Vaccine 1 Type</label>
                          <div class="input-group input-group-merge">
                          <select name="motherCovidVac1Type" id="motherCovidVac1Type" class="form-select">
                          <option value="">Choose...</option>
                          <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=18";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                          </select>
						</div>
						</div>
						<div class="col-6 mb-3" id="motherCovidVac1D" style="display: none;">
                          <label class="form-label" for="basic-icon-default-password">Mother Vaccine 1 Date</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="motherCovidVac1Date"
                              id="motherCovidVac1Date"
                              class="form-control"
                              placeholder="Mother Vaccine 1 Date"
                              aria-label="CMother Vaccine 1 Date"
                              aria-describedby="basic-icon-default-conpassword" 
                            />
                          </div>
                        </div>
					</div> -->
					<!-- <div class="row">
					<div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Mother Vaccine 2 Done</label>
                          <div class="input-group input-group-merge">
                          <select name="motherCovidVac2Done" id="motherCovidVac2Done" class="form-select" onchange="dose2()">
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
						<div id="motherCovidVac2T" class="col-6 mb-3" style="display: none;">
                          <label class="form-label" for="basic-icon-default-phone">Mother Vaccine 2 Type</label>
                          <div class="input-group input-group-merge">
                          <select name="motherCovidVac2Type" id="motherCovidVac2Type" class="form-select">
                          <option value="">Choose...</option>
                          <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=18";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                          </select>
						</div>
						</div>
					</div> -->
					<!-- <div class="row">
					<div id="motherCovidVac2D" class="col-6 mb-3" style="display: none;">
                          <label class="form-label" for="basic-icon-default-password">Mother Vaccine 2 Date</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="motherCovidVac2Date"
                              id="motherCovidVac2Date"
                              class="form-control"
                              placeholder="Mother Vaccine 2 Date"
                              aria-label="Mother Vaccine 2 Date"
                              aria-describedby="basic-icon-default-conpassword" 
                            />
                          </div>
                        </div>
						<div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Mother Vaccine Booster Done</label>
                          <div class="input-group input-group-merge">
                          <select name="motherCovidVacBoosterDone" id="motherCovidVacBoosterDone" class="form-select" onchange="Bdose()">
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
					</div> -->
					<!-- <div class="row">
					<div id="motherCovidVacBooster" class="col-6 mb-3" style="display: none;">
                          <label class="form-label" for="basic-icon-default-phone">Mother Vaccine Booster Type</label>
                          <div class="input-group input-group-merge">
                          <select name="motherCovidVacBoosterType" id="motherCovidVacBoosterType" class="form-select">
                          <option value="">Choose...</option>
                          <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=18";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                          </select>
						</div>
					</div>
					<div id="motherCovidVacBoosterD" class="col-6 mb-3" style="display: none;">
                          <label class="form-label" for="basic-icon-default-password">Mother Vaccine Booster Date</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="motherCovidVacBoosterDate"
                              id="motherCovidVacBoosterDate"
                              class="form-control"
                              placeholder="Mother Vaccine Booster Date"
                              aria-label="Mother Vaccine Booster Date"
                              aria-describedby="basic-icon-default-conpassword" 
                            />
                          </div>
                        </div>
					</div> -->
					<div class="input-group">
                                            <input class="btn btn-primary" type="submit" name="addImmunization" value="Save">
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->
<?php include ('require/footer.php'); ?>