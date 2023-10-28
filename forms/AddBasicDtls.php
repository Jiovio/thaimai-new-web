<?php include ('require/topHeader.php'); ?>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search 
// Including the Code - Add !
if (isset($_GET['History'])) {
  $AV_picmeno = $_GET['History'];
 }

if (! empty($_POST["BasicDtls"])) {
  $picmeno =$AV_picmeno;
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
  
  $query = mysqli_query($conn,"INSERT INTO antenatalvisit (picmeno, residenttype, physicalpresent, placeofvisit, abortion,
  anvisitDate, avduedate, ancPeriod, pregnancyWeek, motherWeight, bpSys, bpDia, Hb, urineTestStatus, urineSugarPresent, urineAlbuminPresent, createdBy) 
  VALUES ('$picmeno','$residenttype','$physicalpresent','$placeofvisit','$abortion','$anvisitDate','$avduedate','$ancPeriod','$pregnancyWeek',
  '$motherWeight','$bpSys','$bpDia','$Hb','$urineTestStatus','$urineSugarPresent','$urineAlbuminPresent','$userid')");
            if (!empty($query)) {
              echo "<script>alert('Inserted Successfully');window.location.replace('{$siteurl}/forms/AnVisitAddBtn.php?History=$AV_picmeno');</script>";
            } 
} 
?>
          <!-- Content wrapper --> 
          <div class="content-wrapper">
            <!-- Content -->
      <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Antenatal Visit /</span> Add Antenatal Visit
                
			  <a href="AnVisitAddBtn.php?picmeno=<?php echo $AV_picmeno; ?>" ><button type="submit" class="btn btn-primary" id="btnBack">
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
                <hr class="my-0" />
                    
                    <div class="card-body">
                <form id="form" action="" method="post" onSubmit="return checkPicmeAV(this);">
                      
				<div id="firstDiv">
					<div class="row">
          <div class="col-4 mb-3">
        <label class="form-label" for="basic-icon-default-fullname">RCHID (PICME) NUMBER <span class="mand">* </span><span id="errPicme"></span></label>
        <div class="frmSearch">
        <input type="text" required id="AVpicmeno" hidden name="picmeno" oninput = "onlyNumbers(this.value)" onclick="return checkPicmeAV()" value="<?php echo $AV_picmeno; ?>" placeholder="RCHID (PICME) Number" class="form-control" />
        <label class="lblViolet"><?php echo $AV_picmeno; ?>
		<div id="suggesstion-box"></div>
         </div>
                </div>
                      
					<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Resident Type <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required name="residenttype" id="residenttype" class="form-select" onclick="return checkPicmeAV()">
                          <option value="">Choose...</option>
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=10";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
						              </div>
					              </div>
          
						            <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-physicalpresent">Physical Present <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required name="physicalpresent" id="physicalpresent" class="form-select" onclick="return checkPicmeAV()">
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
						             <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-placeofvisit">Place of Visit <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required name="placeofvisit" id="placeofvisit" class="form-select" onclick="return checkPicmeAV()">
                          <option value="">Choose...</option>
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=25";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
                          </div>
                          </div>
                    
						              <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-abortion">Abortion <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required name="abortion" id="abortion" class="form-select" onclick="return checkPicmeAV()">
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
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-anvisitDate">Antenatal Visit Date <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="anvisitDate"
                              class="form-control"
                              id="anvisitDate"
							  <?php $cur_dt = date('Y-m-d'); ?>
							  min="2023-01-01" max=<?php echo $cur_dt; ?>
                              placeholder="Antenatal Visit Date"
                              aria-label="Antenatal Visit Date"
                              aria-describedby="basic-icon-default-anvisitDate"
							  onclick="return checkPicmeAV()"
							  
                              required
                            />
							
                          </div>
						  
						<div id="avdt-suggesstion-box"></div>
                        </div>
					</div>
          <div class="row">
						            <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-ancPeriod">Antenatal Visit Count <span class="mand">* </span></label>
                          <div class="input-group input-group-merge" id="ancSection">
                              <input type="text" min=1 max=20 class="form-control" id="ancPeriod" required onclick="return checkPicmeAV()" />
                              
<!--                            
<!--                            
<select class="1-15 form-control" id="ancPeriod" name="ancPeriod" required>
                          <option value="">Choose...</option>
                          </select>-->
                          </div>
                        </div>
						           <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-pregnancyWeek">Pregnancy Week <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="pregnancyWeek"
                              class="form-control"
                              id="pregnancyWeek"
                              placeholder="Pregnancy Week"
                              aria-label="Pregnancy Week"
							  onclick="return checkPicmeAV()"
                              aria-describedby="basic-icon-default-pregnancyWeek"
                              required
                              />
                          </div>
                        </div>
					             <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-motherWeight">Mother Weight <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="motherWeight"
                              class="form-control"
                              id="motherWeight"
                              placeholder="Mother Weight"
                              aria-label="Mother Weight"
							  onclick="return checkPicmeAV()"
                              aria-describedby="basic-icon-default-motherWeight"
                              required
                              />
                          </div>
                        </div>
          </div>
          <div class="row">
						             <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-motherWeight">BP Systolic <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
						  <input
                              type="Number"
                              name="bpSys"
                              class="form-control"
                              id="bpSys"
                              placeholder="bpSys"
                              aria-label="bpSys"
							  min=50 max=200
							  onclick="return checkPicmeAV()"
                              aria-describedby="basic-icon-default-bpSys"
                              required
                              />
                          </div>
                        </div>
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-bpDia">BP Diastolic <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <input
                              type="Number"
                              name="bpDia"
                              class="form-control"
                              id="bpDia"
                              placeholder="bpDia"
                              aria-label="bpDia"
							  min=40 max=150
							  onclick="return checkPicmeAV()"
                              aria-describedby="basic-icon-default-bpDia"
                              required
                              />
                          </div>
                        </div>
						<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-Hb">Hb </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="Hb"
                              class="form-control"
                              id="Hb"
                              placeholder="Hb"
                              aria-label="Hb"
							  onclick="return checkPicmeAV()"
                              aria-describedby="basic-icon-default-Hb"
                              />
                          </div>
                        </div>
          </div>
          <div class="row">
						               <div class="col-4 mb-3">
                            <label class="form-label" for="basic-icon-default-urineTestStatus">Urine Test Status <span class="mand">* </span></label>
                            <div class="input-group input-group-merge">
                            <select required name="urineTestStatus" id="urineTestStatus" onchange="UrinetestChange()" onclick="return checkPicmeAV()" class="form-select">
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
                          <div class="col-4 mb-3" id="urineSP" style="display:none;">
                            <label class="form-label" for="basic-icon-default-urineSugarPresent">Urine Sugar Present <!--<span class="mand">* </span>--></label>
                            <div class="input-group input-group-merge">
                              <select name="urineSugarPresent" id="urineSugarPresent" class="form-select">
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
                          <div class="col-4 mb-3" id="urineAP" style="display:none;">
                            <label class="form-label" for="basic-icon-default-urineAlbuminPresent">Urine Albumin Present <!--<span class="mand">* </span>--></label>
                            <div class="input-group input-group-merge">
                          <select name="urineAlbuminPresent" id="urineAlbuminPresent" class="form-select">
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
			 <input type="submit" name="BasicDtls" value="Save" id="BasicDtls" class="btn btn-primary" onclick="return checkPicmeAV()">
			</div>
				
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->
<?php include ('require/footer.php'); ?>
