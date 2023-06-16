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
			<!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <small class="float-end"><span class="mand">* </span> Fields are Mandatory</small>
                    </div>
                <hr class="my-0" />
                    
                    <div class="card-body">
                <form id="form" action="AddAnVisit2.php" method="POST">
                      
				<div id="firstDiv">
					<div class="row">
          <div class="col-4 mb-3">
        <label class="form-label" for="basic-icon-default-fullname">PICME NUMBER <span class="mand">* </span><span id="errPicme"></span></label>
        <div class="frmSearch">
        <input type="text" required id="picmeno" name="picmeno" oninput = "onlyNumbers(this.value)" onkeyup="checkPicme(this.value); return false;" placeholder="PICME Number" class="form-control" />
        <div id="suggesstion-box"></div>
         </div>
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
                          <label class="form-label" for="basic-icon-default-ancPeriod">Antenatal Visit Count <span class="mand">* </span></label>
                          <div class="input-group input-group-merge" id="ancSection">
                              <input type="text" class="form-control" id="ancPeriod" name="ancPeriod" required/>
<!--                            <select class="1-15 form-control" id="ancPeriod" name="ancPeriod" required>
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
                            <select class="50-200 form-control" id="bpSys" name="bpSys" placeholder="BP SYS" required>
                              <option value="">Choose...</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-bpDia">BP Diastolic <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select class="40-150 form-control" id="bpDia" name="bpDia" placeholder="BP DIA" required>
                          <option value="">Choose...</option>
                          </select>
                          </div>
                        </div>
						<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-Hb">Hb <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="Hb"
                              class="form-control"
                              id="Hb"
                              placeholder="Hb"
                              aria-label="Hb"
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
                            <select required name="urineTestStatus" id="urineTestStatus" onchange="UrinetestChange()" class="form-select">
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
           <input type="submit" id="btnFirst" class="btn btn-primary" name="btnFirst" value="NEXT">
				</div>
				
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->
<?php include ('require/footer.php'); ?>
