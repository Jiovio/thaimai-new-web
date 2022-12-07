<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search ?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
      <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Antenatal Visit /</span> Add Antenatal Visit
                <a href="AntenatalVisit.php"><button type="submit" class="btn btn-primary" id="btnBack">
                    <span class="bx bx-arrow-back"></span>&nbsp; Back</button></a>
			        </h4>
              <div class="row">
                    <div class="col-md-12">
                <div class="card mb-4">
                <hr class="my-0" />

                <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">
                        Add Antenatal Visit
					  </h5>
            
                    <small class="float-end"><span class="mand">* </span> Fields are Mandatory</small>
                    </div>
                <div class="card-body">
                            
                <form id="form" action="AddAnVisit2.php" method="POST">

                    <div class="row">
                      
                    <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-password">MOTHER AADHAAR ID</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                            <select name="motheraadhaarid" id="motheraadhaarid" class="form-select" required>
                          <option value="">Choose...</option>
                           
                           <?php   
                            $query = "SELECT motheraadhaarid,motheraadhaarname FROM ecregister";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['motheraadhaarid']; ?>"><?php echo $listvalue['motheraadhaarid']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                             
                          </div>
                        </div>
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER NAME AS PER AADHAAR</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            <select name="motheraadhaarname" id="motheraadhaarname" class="form-select" disabled>
                           
                           <?php   
                            $query = "SELECT motheraadhaarid,motheraadhaarname FROM ecregister";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option disabled="disabled" value="<?php echo $listvalue['motheraadhaarname']; ?>"><?php echo $listvalue['motheraadhaarname']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                            
                          </div>
                        </div>
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND NAME AS PER AADHAAR</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            <select name="husbandaadhaarname" id="husbandaadhaarname" class="form-select" disabled>
                           
                           <?php   
                            $query = "SELECT motheraadhaarid,husbandaadhaarname FROM ecregister";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option disabled="disabled" value="<?php echo $listvalue['husbandaadhaarname']; ?>"><?php echo $listvalue['husbandaadhaarname']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                            
                          </div>
                        </div>
                    </div>
                    </div>
                  </div>
                          </div>
                      </div>
			<!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                <hr class="my-0" />
                    
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
			<input type="hidden" name="picmeno" value="<?php echo $picmeno; ?>">
				<div id="firstDiv">
					<div class="row">
          <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">PICME No. <span class="mand">* </span id="errPicmeno"><span></span></label>
                          <select name="picmeno" id="picmeno"  oninput = "onlyNumbers(this.value)" value="" class="form-control picmeNo" required>
                            <option value="">Choose...</option>
                          <?php   
                            $query = "SELECT picmeno FROM anregistration WHERE status=1";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['picmeno']; ?>"><?php echo $listvalue['picmeno']; ?></option>
                          
                          <?php  }  ?>
                             </select>
                          
                        </div>
                      
						            <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Resident Type <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required name="residenttype" id="residenttype" class="form-select">
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
                          <select required name="physicalpresent" id="physicalpresent" class="form-select">
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
                          <select required name="placeofvisit" id="placeofvisit" class="form-select">
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
                          <select required name="abortion" id="abortion" class="form-select">
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
                              placeholder="Antenatal Visit Date"
                              aria-label="Antenatal Visit Date"
                              aria-describedby="basic-icon-default-anvisitDate"
                              required
                            />
                          </div>
                        </div>
					</div>
          <div class="row">
						            <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-ancPeriod">Antenatal Period <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="ancPeriod"
                              class="form-control"
                              id="ancPeriod"
                              placeholder="Antenatal Period"
                              aria-label="Antenatal Period"
                              aria-describedby="basic-icon-default-ancPeriod"
                              required
                            />
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
                              type="text"
                              name="bpSys"
                              class="form-control"
                              id="bpSys"
                              placeholder="Bp Systolic"
                              aria-label="Bp Systolic"
                              aria-describedby="basic-icon-default-motherWeight"
                              required
                              />
                          </div>
                        </div>
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-bpDia">BP Diastolic <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="bpDia"
                              class="form-control"
                              id="bpDia"
                              placeholder="BP Diastolic"
                              aria-label="BP Diastolic"
                              aria-describedby="basic-icon-default-bpDia"
                              required
                              />
                          </div>
                        </div>
						           <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-Hb">HB <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="Hb"
                              class="form-control"
                              id="Hb"
                              placeholder="HB"
                              aria-label="HB"
                              aria-describedby="basic-icon-default-Hb"
                              required
                              />
                          </div>
                        </div>
          </div>
          <div class="row">
						               <div class="col-4 mb-3">
                            <label class="form-label" for="basic-icon-default-urineTestStatus">Urine Test Status <span class="mand">* </span></label>
                            <div class="input-group input-group-merge">
                            <select required name="urineTestStatus" id="urineTestStatus" class="form-select">
                          <option value="">Choose...</option>
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=20";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
                            </div>
                          </div>
                          <div class="col-4 mb-3">
                            <label class="form-label" for="basic-icon-default-urineSugarPresent">Urine Sugar Present <span class="mand">* </span></label>
                            <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="urineSugarPresent"
                              class="form-control"
                              id="urineSugarPresent"
                              placeholder="Urine Sugar Present"
                              aria-label="UrineSugarPresent"
                              aria-describedby="basic-icon-default-urineSugarPresent"
                              required
                              />
                              
                            </div>
                          </div>
                          <div class="col-4 mb-3">
                            <label class="form-label" for="basic-icon-default-urineAlbuminPresent">Urine Albumin Present <span class="mand">* </span></label>
                            <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="urineAlbuminPresent"
                              class="form-control"
                              id="urineAlbuminPresent"
                              placeholder="Urine Albumin Present"
                              aria-label="urineAlbuminPresent"
                              aria-describedby="basic-icon-default-urineAlbuminPresent"
                              required
                              />
                            </div>
                          </div>
             </div>
           <input type="submit" id="btnFirst" class="btn btn-primary" name="btnFirst" value="NEXT">
				</div>
				
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->
            <script>
              
var options = document.getElementById("picmeno").value;
for (var i = 0; i < options.length; i++) {
  if (options[i].text == options) {
    options[i].selected = true;
    break;
  }
}
            </script>
<?php include ('require/footer.php'); ?>
