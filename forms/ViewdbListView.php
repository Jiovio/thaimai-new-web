<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search
 if (isset($_GET['view'])) {
   $id = $_GET['view']; $view = true;
   $record = mysqli_query($conn, "SELECT * FROM ecregister WHERE id=$id");
   $n = mysqli_fetch_array($record);
   $picmeNo = $n["picmeNo"]; $dateecreg = $n["dateecreg"]; $maadhaarid = $n["motheraadhaarid"]; $maadhaarname = $n["motheraadhaarname"];
   $mfullname = $n["motherfullname"]; $mdob = $n["motherdob"]; $mageecreg = $n["motherageecreg"]; $magemarriage = $n["motheragemarriage"];
   $mmobno = $n["mothermobno"];$mobperson = $n["mobileofperson"]; $mstatus = $n["motheredustatus"]; $haadhaarid = $n["husbandaadhaarid"]; $haadhaarname = $n["husbandaadhaarname"]; $hfullname = $n["husfullname"]; $hdob = $n["husdob"];
   $hageecreg = $n["husageecreg"]; $hagemarriage = $n["husagemarriage"]; $husmobno = $n["husmobno"]; $hedustatus = $n["husedustatus"];
   $religion = $n["religion"]; $caste = $n["caste"]; $BlockId = $n["BlockId"]; $PhcId = $n["PhcId"]; $HscId= $n["HscId"]; $address = $n["address"]; $pincode = $n["pincode"]; 
   $povertystatus = $n["povertystatus"]; $migrantstatus = $n["migrantstatus"]; $rctype = $n["rationcardtype"]; $rcnum = $n["rationcardnum"];

   $arqry = mysqli_query($conn, "SELECT id,motheraadhaarid FROM anregistration WHERE motheraadhaarid='".$maadhaarid."'");
   $ar = mysqli_fetch_array($arqry);
   if($ar == !''){ $arid = $ar["id"]; }
   
   $avqry = mysqli_query($conn, "SELECT id,picmeno,motheraadhaarid FROM antenatalvisit WHERE picmeno='".$picmeNo."' OR motheraadhaarid='".$maadhaarid."'");
   $av = mysqli_fetch_array($avqry);
   if($av == !''){ $avid = $av["id"]; }
   
   $mhqry = mysqli_query($conn, "SELECT id,picmeno FROM medicalhistory WHERE picmeno='".$picmeNo."'");
   $mh = mysqli_fetch_array($mhqry);
   if($mh == !''){ $mhid = $mh["id"]; }
   
   $ddqry = mysqli_query($conn, "SELECT id,picmeno FROM deliverydetails WHERE picmeno='".$picmeNo."'");
   $dd = mysqli_fetch_array($ddqry);
   if($dd == !''){ $ddid = $dd["id"]; }
   
   $imqry = mysqli_query($conn, "SELECT id,picmeNo FROM immunization WHERE picmeNo='".$picmeNo."'");
   $im = mysqli_fetch_array($imqry);
   if($im == !''){ $imid = $im["id"]; }
   
   $pvqry = mysqli_query($conn, "SELECT id,picmeNo FROM postnatalvisit WHERE picmeNo='".$picmeNo."'");
   $pv = mysqli_fetch_array($pvqry);
   if($pv == !''){ $pvid = $pv["id"]; }
 }
?>
<!-- Content wrapper -->
    <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
             <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Eligible Couple / </span>Mother Basic Details
                <a href="dashboard.php"><button type="submit" class="btn btn-primary" id="btnBack">
                    <span class="bx bx-arrow-back"></span>&nbsp; Back</button>
                </a>
             </h4>

        <form action="" method="post">
              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
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
        ?>
				<?php
    }
    ?>
				<div class="errMsg" id="errMsg"></div>
               		<input type="hidden" name="id" value="<?php echo $id; ?>">
						<div class="row">
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-picmeNo">PICME Number</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-picmeNo" class="input-group-text"
                              ><i class="bx bx-food-menu"></i
                            ></span>
                            <input
                              type="text"
                              name="picmeNo"
                              class="form-control"
                              id="picmeNo" required
                              placeholder="PICME Number"
                              aria-label="PICME Number"
                              aria-describedby="basic-icon-default-picmeNo" style="color: red;"
                              disabled value="<?php if($picmeNo!=""){ echo $picmeNo; } else { echo "Not Generated"; } ?>"
                            />
                          </div>
                        </div>
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-email">DATE OF EC REG</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                            <input
                              type="date"
                              name="dateecreg"
                              id="dateecreg"
                              class="form-control"
                              placeholder=""
                              aria-label=""
                              aria-describedby="basic-icon-default-email2"
                              disabled value="<?php echo $dateecreg; ?>"
                            />
                          </div>
                        </div>
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-password">MOTHER AADHAAR ID  <span style="color:red" class= "warning-message" id="warning-message"></span></label>
                          <div class="input-group input-group-merge">
                            <label class="lblViolet"><?php echo $maadhaarid; ?>
                              </label>
                          </div>
                        </div>

                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER NAME AS PER AADHAAR</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-user-circle"></i></span>
                            <input
                              type="text"
                              name="motheraadhaarname"
                              id="motheraadhaarname" required
                              class="form-control phone-mask"
                              placeholder="MOTHER NAME AS PER AADHAAR"
                              aria-label="MOTHER NAME AS PER AADHAAR"
                              aria-describedby="basic-icon-default-mobile"
                              disabled value="<?php echo $maadhaarname; ?>"
                            />
                          </div>
                        </div>

                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER FULLNAME</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-user-check"></i
                            ></span>
                            <input
                              type="text"
                              name="motherfullname"
                              id="motherfullname"
                              class="form-control phone-mask"
                              placeholder="MOTHER FULLNAME"
                              aria-label="MOTHER FULLNAME"
                              aria-describedby="basic-icon-default-mobile"
                              disabled value="<?php echo $mfullname; ?>"
                            />
                          </div>
                        </div>

                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-email">MOTHER DATE OF BIRTH</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                            <input
                              type="date"
                              name="motherdob"
                              id="motherdob"
                              class="form-control"
                              placeholder=""
                              aria-label=""
                              aria-describedby="basic-icon-default-email2"
                              disabled value="<?php echo $mdob; ?>"
                            />
                          </div>
                        </div>

                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER AGE AT Conception</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-user-plus"></i
                            ></span>
                            <input
                              type="number"
                              name="motheragemarriage"
                              id="motheragemarriage"
                              class="form-control phone-mask"
                              placeholder="MOTHER AGE AT CONCEPTION"
                              aria-label="MOTHER AGE AT CONCEPTION"
                              aria-describedby="basic-icon-default-mobile"
                              disabled value="<?php echo $magemarriage; ?>"
                            />
                            </div>
                        </div>

                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER MOBILE NUMBER  <span style="color:red" class= "Mmobmessage" id="Mmobmessage"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-mobile"></i
                            ></span>
                            <input
                              type="text"
                              oninput = "MothermobonlyNumbers(this.value)"
                              name="mothermobno"
                              id="mothermobno"
                              class="form-control phone-mask"
                              placeholder="MOTHER MOBILE NUMBER"
                              aria-label="MOTHER MOBILE NUMBER"
                              aria-describedby="basic-icon-default-mobile"
                              disabled value="<?php echo $mmobno; ?>"
                            />
                          </div>
                        </div>

                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-password">HUSBAND AADHAAR ID <span style="color:red" class= "husmessage" id="husmessage"></span></label>
                          <div class="input-group input-group-merge">
                            <label class="lblViolet"><?php echo $haadhaarid; ?>
                              </label>
                          </div>
                        </div>

                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND NAME AS PER AADHAAR</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-user-circle"></i
                            ></span>
                            <input
                              type="text"
                              name="husbandaadhaarname"
                              id="husbandaadhaarname" required
                              class="form-control phone-mask"
                              placeholder="HUSBAND NAME AS PER AADHAAR"
                              aria-label="HUSBAND NAME AS PER AADHAAR"
                              aria-describedby="basic-icon-default-mobile"
                              disabled value="<?php echo $haadhaarname; ?>"
                            />
                          </div>
                        </div>

                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-email">HUSBAND DATE OF BIRTH</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                            <input
                              type="date"
                              name="husdob"
                              id="husdob"
                              class="form-control"
                              placeholder=""
                              aria-label=""
                              aria-describedby="basic-icon-default-email2"
                              disabled value="<?php echo $hdob; ?>"
                            />
                          </div>
                        </div>
                        
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND MOBILE NUMBER <span style="color:red" class= "Hmobmessage" id="Hmobmessage"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-mobile"></i
                            ></span>
                            <input
                              type="text"
                              oninput = "HusmobonlyNumbers(this.value)"
                              name="husmobno"
                              id="husmobno"
                              class="form-control phone-mask"
                              placeholder="HUSBAND MOBILE NUMBER"
                              aria-label="HUSBAND MOBILE NUMBER"
                              aria-describedby="basic-icon-default-mobile"
                              disabled value="<?php echo $husmobno; ?>"
                            />
                          </div>
                        </div>			
                </div><!--Father Div row-->
				<?php if($pv == !''){ ?>
				<a href="../forms/ViewEditPostnatal.php?view=<?php echo $pvid; ?>">
					<button type="button" class="btn btn-primary btnForm">
                    <span class="bx bx-clinic"></span>&nbsp; Postnatal</button>
				</a>
				<?php } if($im == !''){ ?>
				<a href="../forms/ViewEditImmunization.php?view=<?php echo $imid; ?>">
					<button type="button" class="btn btn-primary btnForm">
                    <span class="bx bx-test-tube"></span>&nbsp; Immunization</button>
				</a>
				<?php } if($dd == !''){ ?>
				<a href="../forms/ViewEditDelivery.php?view=<?php echo $ddid; ?>">
					<button type="button" class="btn btn-primary btnForm">
                    <span class="bx bx-female"></span>&nbsp; Delivery</button>
				</a>
				<?php } if($mh == !''){ ?>
				<a href="../forms/ViewEditMedical.php?view=<?php echo $mhid; ?>">
					<button type="button" class="btn btn-primary btnForm">
                    <span class="bx bx-user-plus"></span>&nbsp; Med History</button>
				</a>
				<?php } if($av == !''){ ?>
				<a href="../forms/ViewEditAnVisit.php?view=<?php echo $avid; ?>">
					<button type="button" class="btn btn-primary btnForm">
                    <span class="bx bx-user-check"></span>&nbsp; An Visit</button>
				</a>
				<?php } if($ar == !''){ ?>
				<a href="../forms/ViewEditAntenatal.php?view=<?php echo $arid; ?>">
					<button type="button" class="btn btn-primary btnForm">
                    <span class="bx bx-female-sign"></span>&nbsp; An Registration</button>
				</a>
				<?php } ?>
				<a href="../forms/ViewEditEc.php?view=<?php echo $id; ?>">
					<button type="button" class="btn btn-primary btnForm">
                    <span class="bx bx-group"></span>&nbsp; Eligible Couple</button>
				</a>
			  </div>
			</div>
		  </div>
		 </div><!-- Father Details Close-->
		</div>
	  </div>
	</form>
<!-- / Content -->
<?php include ('require/footer.php'); ?>



