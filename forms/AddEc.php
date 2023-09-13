<?php include ('require/topHeader.php'); ?>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search
if (! empty($_POST["addEc"])) {   
  $CheckDuplicateMno = mysqli_query($conn,"SELECT motheraadhaarid,husbandaadhaarid FROM ecregister where motheraadhaarid='".$_POST["motheraadhaarid"]."' OR husbandaadhaarid='".$_POST["husbandaadhaarid"]."' ");

while($Mvalue = mysqli_fetch_array($CheckDuplicateMno)) {
  $mvid = $Mvalue["motheraadhaarid"];
  $mvid = $Mvalue["husbandaadhaarid"];
} 
if($mvid > 0) {
    $type = "error";
    $emessage = "Duplicate Mother's Aadhaar No.";
 } else {
  $ecfr = $_POST["ecfr"]; $ecfrno = $_POST["ecfrno"]; $ecfrmrg = $ecfr.$ecfrno;
  $dateecreg = $_POST["dateecreg"]; $maadhaarid = $_POST["motheraadhaarid"]; $maadhaarname = $_POST["motheraadhaarname"];
  $mfullname = $_POST["motherfullname"]; $mdob = $_POST["motherdob"]; $mageecreg = $_POST["motherageecreg"]; $magemarriage = $_POST["motheragemarriage"];
  $mmobno = $_POST["mothermobno"];$mobperson = $_POST["mobileofperson"]; $mstatus = $_POST["motheredustatus"]; $haadhaarid = $_POST["husbandaadhaarid"];   

  $haadhaarname = $_POST["husbandaadhaarname"]; $hfullname = $_POST["husfullname"]; $hdob = $_POST["husdob"];
  $hageecreg = $_POST["husageecreg"]; $hagemarriage = $_POST["husagemarriage"]; $husmobno = $_POST["husmobno"]; $hedustatus = $_POST["husedustatus"];
  $religion = $_POST["religion"]; $caste = $_POST["caste"]; $BlockId = $_POST["BlockId"]; $PhcId = $_POST["PhcId"]; $HscId = $_POST["HscId"]; 
  $PanchayatId = $_POST["PanchayatId"]; $VillageId = $_POST["VillageId"]; $address = $_POST["address"]; $pincode = $_POST["pincode"]; 
  $povertystatus = $_POST["povertystatus"]; $migrantstatus = $_POST["migrantstatus"]; $rctype = $_POST["rationcardtype"]; $rcnum = $_POST["rationcardnum"];
  
  $query = mysqli_query($conn,"INSERT INTO ecregister (ecfrno, dateecreg, motheraadhaarid, motheraadhaarname, husbandaadhaarid, 
  husbandaadhaarname, motherfullname, motherdob, motherageecreg, motheragemarriage, mothermobno, mobileofperson, motheredustatus,
   husfullname, husdob, husageecreg, husagemarriage, husmobno, husedustatus, religion, caste, BlockId, PhcId, HscId, PanchayatId,
   VillageId, address, pincode, povertystatus, migrantstatus, rationcardtype, rationcardnum, createdBy) 
  VALUES ('$ecfrmrg','$dateecreg','$maadhaarid','$maadhaarname','$haadhaarid','$haadhaarname','$mfullname','$mdob','$mageecreg',
  '$magemarriage','$mmobno','$mobperson','$mstatus','$hfullname','$hdob','$hageecreg','$hagemarriage','$husmobno','$hedustatus',
  '$religion','$caste','$BlockId','$PhcId','$HscId','$PanchayatId','$VillageId','$address','$pincode','$povertystatus',
  '$migrantstatus','$rctype','$rcnum','$userid')");
            if (!empty($query)) {
              echo "<script>alert('Inserted Successfully');window.location.replace('{$siteurl}/forms/EligibleCouple.php');</script>";
            } 
} }
?>
<!-- Content wrapper -->
      <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
             <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Eligible Couples /</span> Add Eligible Couple
             <a href="EligibleCouple.php"><button type="submit" class="btn btn-primary" id="btnBack">
                    <span class="bx bx-arrow-back"></span>&nbsp; Back
              </button></a>
            </h4>
            <?php 
            if (!empty($query)) {
            echo "<script>alert('Inserted Successfully');</script>";
            } 
            ?>
              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
						<h4 class="fw-bold"><span class="text-muted fw-light">Mother's Details</span></h4>
                        <small class="float-end"><span class="mand">* </span> Fields are Mandatory</small>
                    </div>
                    <div class="card-body">
            <form action="" method="post" onSubmit="return EcFormValid(this);">
                     
        <div id="response"
        class="<?php if(!empty($type)) { echo $type . " display-block"; } else { echo $type . " display-none"; } ?>"><?php if(!empty($emessage)) { echo $emessage; } ?></div>
						<div class="row">
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">EC FR No <span class="mand">* </span><span id="errEcfrNo"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            <span id="hscGen">
                            <select name="Hsc" id="SelectHsc" onchange="FirstAlphabet()" class="form-select" onclick="return addECValidate()">
                            <option value="">Choose...</option>
                           
                           <?php   
                            $query = "SELECT DISTINCT(HscCode),HscId FROM hscmaster ORDER BY HscId";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['HscCode']; ?>"><?php echo $listvalue['HscCode']; ?></option>
                          
                          <?php  } ?>
                             </select>
                             </span>
                            <input type="text" name="ecfr" class="form-control" id="ecfr" readonly />
                            <input
                              type="text"
                              name="ecfrno"
                              class="form-control"
                              id="ecfrno"
                              placeholder="EC FR No"
                              aria-label="EC FR No"
                              aria-describedby="basic-icon-default-ecfrno"
                            />
                          </div>
                        </div>
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">DATE OF EC REG <span class="mand">* </span> <span id="errEcReg"></span><span id="Magemarriage"></span></label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="dateecreg"
                              id="dateecreg"
                              class="form-control"
                              aria-describedby="basic-icon-default-email2"
							  <?php $cur_dt = date('Y-m-d', strtotime('+1 year')); ?>
							   min="1970-01-01" max=<?php echo $cur_dt; ?>
							   onclick="return addECValidate()"
							  required
                              />
                          </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">MOTHER'S AADHAAR ID <span class="mand">* </span> <span id="errmotherAadhaarid"></span></label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                            <input
                              type="text"
                              oninput = "MotheronlyNumbers(this.value)"
                              name="motheraadhaarid"
                              id="motheraadhaarid"
                              maxlength="12"
                              class="form-control"
                              placeholder="MOTHER'S AADHAAR ID"
                              aria-label="MOTHER'S AADHAAR ID"
                              aria-describedby="basic-icon-default-password2"
							  onclick="return addECValidate()"
                              required
                            />
                          </div>
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER'S NAME AS PER AADHAAR <span class="mand">* </span>  <span id="errMName"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-user-circle"></i
                            ></span>
                            <input
                              type="text"
                              name="motheraadhaarname"
                              id="motheraadhaarname"
                              class="form-control phone-mask"
                              placeholder="MOTHER'S NAME AS PER AADHAAR"
                              aria-label="MOTHER'S NAME AS PER AADHAAR"
                              aria-describedby="basic-icon-default-mobile"
							  onclick="return addECValidate()"
                              required
                            />
                          </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER'S FULL NAME <span class="mand">* </span><span id="errMfullname"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-user-check"></i
                            ></span>
                            <input
                              type="text"
                              name="motherfullname"
                              id="motherfullname"
                              class="form-control phone-mask"
                              placeholder="MOTHER'S FULL NAME"
                              aria-label="MOTHER'S FULL NAME"
                              aria-describedby="basic-icon-default-mobile"  
                              onclick="return addECValidate()"							  
							  required
                            />
                          </div>
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">MOTHER'S DATE OF BIRTH <span class="mand">* </span><span id="errMdob"></span></label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="motherdob"
                              id="motherdob"
                              class="form-control" 
							  <?php $cur_dt = date('Y-m-d', strtotime('-11 year')); ?>
							   min="1970-01-01" max=<?php echo $cur_dt; ?>
							  onchange="fnCalMotAge();"
                              aria-describedby="basic-icon-default-email2"
							  onclick="return addECValidate()"
                              required
                            />
                          </div>
                        </div>
                        </div>
                        <div class="row">
                         <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER'S AGE AT MARRIAGE <span class="mand">* </span><span id="errMoAgeMrg"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-user-pin"></i
                            ></span>
                            <input
                              type="number"
                              min="11" max="99"
                              name="motheragemarriage"
                              id="motheragemarriage"
                              class="form-control phone-mask"
                              placeholder="MOTHER'S AGE AT MARRIAGE"
                              aria-label="MOTHER'S AGE AT MARRIAGE"
                              aria-describedby="basic-icon-default-mobile"
							  onclick="return addECValidate()"
                              required
                            />
                            </div>
                          </div>
                          <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER'S AGE AT EC REGISTRATION <span class="mand">* </span><span id="errMageecreg"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-user-minus"></i
                            ></span>
                            
                            <input
                              type="number"
                              name="motherageecreg"
                              id="motherageecreg" readonly
                              class="form-control phone-mask"
                              placeholder="MOTHER'S AGE AT EC REGISTRATION"
                              aria-label="MOTHER'S AGE AT EC REGISTRATION"
                              aria-describedby="basic-icon-default-mobile"
							  onclick="return addECValidate()"
							  required
                             />
                          </div>
                        </div>
                        
                        </div>
                        <div class="row">
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER'S MOBILE NUMBER  <span class="mand">* </span><span id="errMmobno"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-mobile"></i
                            ></span>
                            <input
							  type="tel" 
                               oninput = "MothermobonlyNumbers(this.value)"
                              name="mothermobno"
                              id="mothermobno" 
                              class="form-control phone-mask"
                              placeholder="MOTHER'S MOBILE NUMBER"
                              aria-label="MOTHER'S MOBILE NUMBER"
                              aria-describedby="basic-icon-default-mobile"
							  pattern="[0-9]{3}[0-9]{3}[0-9]{4}" maxlength="10"
							  onclick="return addECValidate()"
                              required
                            />
                          </div>
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOBILE BELONGS TO <span class="mand">* </span><span id="errMobPerson"></span></span></label>
                          <div class="input-group input-group-merge">
                            
                          <select name="mobileofperson" id="mobileofperson" class="form-select" onclick="return addECValidate()" required>
                          <option value="">Choose...</option>
                           
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=3";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                      </div>
                        </div><br>

                      
                      <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER'S EDUCATIONAL STATUS <span class="mand">* </span><span id="errMedustatus"></span></label>
                          <div class="input-group input-group-merge">
                
                          <select name="motheredustatus" id="motheredustatus" class="form-select" onclick="return addECValidate()" required>
                          <option value="">Choose...</option>
                           
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=4";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } ?>
                             </select>
                      </div>
                  </div>
                </div>
              </div>
            </div>
			</div>
			</div><!--Mother Details Close-->
			<!-- Father Details Start Layout -->
            <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
						<h4 class="fw-bold"><span class="text-muted fw-light">Father's Details</span></h4>
                        <small class="float-end"><span class="mand">* </span> Fields are Mandatory</small>
                    </div>
                    <div class="card-body">
				<div class="errMsg" id="errMsg"></div>
               		<!-- <input type="hidden" name="id" disabled value="<?php echo $id; ?>"> -->
						<div class="row">
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">HUSBAND'S AADHAAR ID <span class="mand">* </span>  <span style="color:red" class= "husmessage" id="husmessage"></span><span id="errHaadhaarid"></span></label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                            <input
                              type="text"
                               oninput = "HusbandonlyNumbers(this.value)"
                              name="husbandaadhaarid"
                              id="husbandaadhaarid"
                              maxlength="12"
                              class="form-control"
                              placeholder="HUSBAND'S AADHAAR ID"
                              aria-label="HUSBAND'S AADHAAR ID"
                              aria-describedby="basic-icon-default-password2"
							  onclick="return addECValidate()"
                              required
                            />
                          </div>
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND'S NAME AS PER AADHAAR <span class="mand">* </span><span id="errhaadhaarname"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-user"></i></span>
                            <input
                              type="text"
                              name="husbandaadhaarname"
                              id="husbandaadhaarname"
                              class="form-control phone-mask"
                              placeholder="HUSBAND'S NAME AS PER AADHAAR"
                              aria-label="HUSBAND'S NAME AS PER AADHAAR"
                              aria-describedby="basic-icon-default-mobile"
							  onclick="return addECValidate()"
                              required
                            />
                          </div>
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND'S FULL NAME <span class="mand">* </span><span id="errhfullname"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-user-check"></i
                            ></span>
                            <input
                              type="text"
                              name="husfullname"
                              id="husfullname"
                              class="form-control phone-mask"
                              placeholder="HUSBAND'S FULL NAME"
                              aria-label="HUSBAND'S FULL NAME"
                              aria-describedby="basic-icon-default-mobile"
							  onclick="return addECValidate()"
                              required
                            />
                          </div>
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">HUSBAND'S DATE OF BIRTH <span class="mand">* </span><span id="errhdob"></span></label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="husdob"
                              id="husdob"
							  <?php $cur_dt = date('Y-m-d', strtotime('-11 year')); ?>
							   min="1970-01-01" max=<?php echo $cur_dt; ?>
                              class="form-control" onchange="fnCalHusAge();"
                              aria-describedby="basic-icon-default-email2"
							  onclick="return addECValidate()"
                               required
                            />
                          </div>
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND'S AGE AT MARRIAGE <span class="mand">* </span><span id="errhagemarriage"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-user-pin"></i
                            ></span>
                            
                            <input
                              type="number"
                              name="husagemarriage"
                              id="husagemarriage" 
                              class="form-control phone-mask"
                              placeholder="HUSBAND'S AGE AT MARRIAGE"
                              aria-label="HUSBAND'S AGE AT MARRIAGE"
                              aria-describedby="basic-icon-default-mobile"
							  min="11" max="99"
							  onclick="return addECValidate()"
                              required
                            />
                          </div>
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND'S AGE AT EC Registration <span class="mand">* </span><span id="errhageecreg"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-user-minus"></i
                            ></span>
                            <input
                              type="number"
                              name="husageecreg"
                              id="husageecreg" readonly
                              class="form-control phone-mask"
                              placeholder="HUSBAND'S AGE AT EC REGISTRATION"
                              aria-label="HUSBAND'S AGE AT EC REGISTRATION"
                              aria-describedby="basic-icon-default-mobile"
							  onclick="return addECValidate()"
                              required
                            />
                          </div>
                        </div>
                        
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND'S MOBILE NUMBER <span class="mand">* </span><span id="errhmob"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-mobile"></i
                            ></span>
                            <input
                              type="tel"
                               oninput = "HusmobonlyNumbers(this.value)"
                              name="husmobno"
                              id="husmobno" 
                              class="form-control phone-mask"
                              placeholder="HUSBAND'S MOBILE NUMBER"
                              aria-label="HUSBAND'S MOBILE NUMBER"
                              aria-describedby="basic-icon-default-mobile"
							  pattern="[0-9]{3}[0-9]{3}[0-9]{4}" maxlength="10"
							  onclick="return addECValidate()"
                              required
                            />
                          </div>
                        </div>
  
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND'S EDUCATIONAL STATUS <span class="mand">* </span><span id="errhedustatus"></span></label>
                          <div class="input-group input-group-merge">
                            
                          <select name="husedustatus" id="husedustatus" class="form-select" onclick="return addECValidate()" required>
                          <option value="">Choose...</option>
                           
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=4";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
						</div>
					</div>			
                </div><!--Father Div row-->
				</div>
				</div>
			</div>
			</div><!-- Father Details Close-->
			<!-- Family Details Start Layout -->
            <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
						<h4 class="fw-bold"><span class="text-muted fw-light">Family Details</span></h4>
                        <small class="float-end"><span class="mand">* </span> Fields are Mandatory</small>
                    </div>
                    <div class="card-body">
				<div class="errMsg" id="errMsg"></div>
               		<!-- <input type="hidden" name="id" value="<?php echo $id; ?>"> -->
						<div class="row">
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">RELIGION <span class="mand">* </span><span id="errReligion"></span></label>
                          <div class="input-group input-group-merge">
                            
                          <select name="religion" id="religion" class="form-select" onclick="return addECValidate()" required>
                          <option value="">Choose...</option>
                           
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=5";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
						</div>
					  </div>
					  <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Community <span class="mand">* </span><span id="errCaste"></span></label>
                          <div class="input-group input-group-merge">
                        
                          <select name="caste" id="caste" class="form-select" onclick="return addECValidate()" required>
                          <option value="">Choose...</option>
                           
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=6";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } ?>
                             </select>
                      </div>
					</div>
          <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Name of the Block <span class="mand">* </span><span id="errBlockValue"></span></label>
                          <div class="input-group input-group-merge">
                          <select onchange="BlockOn()" name="BlockId" id="BlockId" class="form-select" onclick="return addECValidate()" required>
                          <option value="">Choose...</option>
                           <?php  
                           if(($usertype == 2) || ($usertype == 3) || ($usertype == 4)) { 
                            $query = "SELECT DISTINCT(BlockId),BlockName FROM hscmaster WHERE BlockId='".$_SESSION["BlockId"]."' ORDER BY BlockName";
                            } else {
                            $query = "SELECT DISTINCT(BlockId),BlockName FROM hscmaster ORDER BY BlockName";
                            }
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['BlockId']; ?>"><?php echo $listvalue['BlockName']; ?></option>
                           <?php } ?>
                             </select>
						</div>
					  </div>
					<div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Name of the PHC <span class="mand">* </span><span id="errPhcValue"></span></label>
                          <div class="input-group input-group-merge">
                      
                          <select onchange="PhcOn()" name="PhcId" id="PhcId" class="form-select" onclick="return addECValidate()" required>
                          <option value="">Choose...</option>
                           <?php   
                           if(($usertype == 2) || ($usertype == 3) || ($usertype == 4)) {
                            $query = "SELECT DISTINCT(PhcId),PhcName FROM hscmaster WHERE PhcId='".$_SESSION["PhcId"]."' ORDER BY PhcName";
                           } else {
                            $query = "SELECT DISTINCT(PhcId),PhcName FROM hscmaster ORDER BY PhcName";
                            }
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                            <option value="<?php echo $listvalue['PhcId']; ?>"><?php echo $listvalue['PhcName']; ?></option>
                            <?php } ?>
                             </select>
						</div>
					  </div>
            <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Name of the HSC <span class="mand">* </span><span id="errHscValue"></span></label>
                          <div class="input-group input-group-merge">
                      
                          <select name="HscId" id="HscId" class="form-select" onclick="return addECValidate()" required>
                          <option value="">Choose...</option>
                           
                           <?php  
                           if(($usertype == 2) || ($usertype == 3) || ($usertype == 4)) { 
                            $query = "SELECT DISTINCT(HscId),HscName FROM hscmaster WHERE HscId='".$_SESSION["HscId"]."' ORDER BY HscId";
                           } else {
                            $query = "SELECT DISTINCT(HscId),HscName FROM hscmaster ORDER BY HscId";
                           }
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['HscId']; ?>"><?php echo $listvalue['HscName']; ?></option>
                          
                          <?php  } ?>
                             </select>
						              </div>
					  </div>
            <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Name of the Panchayat <span class="mand">* </span><span id="errPanchayat"></span></label>
                          <div class="input-group input-group-merge">
                      
                          <select name="PanchayatId" id="PanchayatId" class="form-select" id="inputGroupSelect04" onclick="return addECValidate()" required>
                          <option value="">Choose...</option>
                           
                           <?php   
                            $query = "SELECT DISTINCT(PanchayatId),PanchayatName FROM hscmaster ORDER BY PanchayatId";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['PanchayatId']; ?>"><?php echo $listvalue['PanchayatName']; ?></option>
                          
                          <?php  } ?>
                             </select>
						              </div>
					  </div>
            <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Name of the Village<span class="mand">* </span><span id="errVillage"></span></label>
                          <div class="input-group input-group-merge">
                      
                          <select name="VillageId" id="VillageId" class="form-select" id="inputGroupSelect04" onclick="return addECValidate()" required>
                          <option value="">Choose...</option>
                           
                           <?php   
                            $query = "SELECT DISTINCT(VillageId),VillageName FROM hscmaster ORDER BY VillageId";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['VillageId']; ?>"><?php echo $listvalue['VillageName']; ?></option>
                          
                          <?php  } ?>
                             </select>
						                </div>
					  </div>
            <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">ADDRESS <span class="mand">* </span><span id="errAddr"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-map-pin"></i></span>
                              <textarea id="address" name="address" class="form-control" required onclick="return addECValidate()" cols="42" rows="3"></textarea >
                          </div>
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">PINCODE  <span id="errPincode"></span></label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-map"></i></span>
                            <input
                              type="text"
                               oninput = "PincodeonlyNumbers(this.value)"
                              name="pincode"
                              id="pincode" maxlength="6"
                              class="form-control"
                              placeholder="PINCODE"
                              aria-label="PINCODE"
                              aria-describedby="basic-icon-default-email2"
							  pattern="[0-9]{6}"
							  onclick="return addECValidate()"
                              required
                            />
                          </div>
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">POVERTY STATUS <span class="mand">* </span><span id="errPoverty"></span></label>
                          <div class="input-group input-group-merge">
                          
                          <select name="povertystatus" id="povertystatus" required onclick="return addECValidate()" class="form-select">
                          <option value="">Choose...</option>
                           
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=7";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } ?>
                          </select>
							</div>
						</div>
					
                      <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MIGRANT STATUS <span class="mand">* </span><span id="errMigrant"></span></label>
                          <div class="input-group input-group-merge">
                          
                          <select name="migrantstatus" id="migrantstatus" required onclick="return addECValidate()" class="form-select">
                          <option value="">Choose...</option>
                           
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=9";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  }  ?>
                             </select>
						</div>
                      </div>  

                      <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">RATION CARD TYPE <span class="mand">* </span><span id="errRtype"></span></label>
                          <div class="input-group input-group-merge">
                          <select name="rationcardtype" id="rationcardtype" required onclick="return addECValidate()" class="form-select">
                          <option value="">Choose...</option>
                           
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=8";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } ?>
                             </select>
						</div>
                      </div>
					  
                      <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">RATION CARD NUMBER <span class="mand">* </span><span id="errRcardnum"></span></label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                            <input
                            oninput = "onlyRationNo(this.value)"
                              type="text"
                              name="rationcardnum"
                              id="rationcardnum" maxlength="12"
                              class="form-control"
                              placeholder="RATION CARD NUMBER"
                              aria-label="RATION CARD NUMBER"
                              aria-describedby="basic-icon-default-email2"
							  pattern="[0-9]{12}"
							  onclick="return addECValidate()"
                              required
                            />
                          </div>
                        </div>
						<div class="mt-2">
							<input class="btn btn-primary" type="submit" id="mysubmit" name="addEc" value="Save" onclick="return addECValidate()">
              
						</div>	
                </div><!--Family Div row-->
				</div>
				</div>
			</div>
			</div><!-- Family Details Close-->
			</form>
			<!-- / Content -->
<?php include ('require/footer.php'); ?>