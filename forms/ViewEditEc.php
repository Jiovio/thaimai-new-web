<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search
$ecfrno =""; $dateecreg =""; $maadhaarid = ""; $maadhaarname=""; $haadhaarid=""; $haadhaarname=""; $mfullname=""; $mdob=""; $mageecreg="";
$magemarriage=""; $mmobno=""; $mobperson=""; $mstatus=""; $hfullname=""; $hdob=""; $hageecreg=""; $hagemarriage =""; $husmobno="";
$hedustatus=""; $religion=""; $caste=""; $BlockId=""; $PhcId =""; $HscId=""; $PanchayatId=""; $VillageId=""; $address=""; $pincode=""; $povertystatus=""; $migrantstatus=""; $rctype=""; $rcnum="";
 $id = 0;
 $update = false;
 $view = false;

 if (isset($_GET['view'])) {
   $id = $_GET['view']; $view = true;
   $record = mysqli_query($conn, "SELECT * FROM ecregister WHERE id=$id");
   $n = mysqli_fetch_array($record);
   $ecfrno = $n["ecfrno"]; $dateecreg = $n["dateecreg"]; $maadhaarid = $n["motheraadhaarid"]; $maadhaarname = $n["motheraadhaarname"];
   $mfullname = $n["motherfullname"]; $mdob = $n["motherdob"]; $mageecreg = $n["motherageecreg"]; $magemarriage = $n["motheragemarriage"];
   $mmobno = $n["mothermobno"];$mobperson = $n["mobileofperson"]; $mstatus = $n["motheredustatus"]; $haadhaarid = $n["husbandaadhaarid"]; 
   $haadhaarname = $n["husbandaadhaarname"]; $hfullname = $n["husfullname"]; $hdob = $n["husdob"]; $hageecreg = $n["husageecreg"]; 
   $hagemarriage = $n["husagemarriage"]; $husmobno = $n["husmobno"]; $hedustatus = $n["husedustatus"]; $religion = $n["religion"]; 
   $caste = $n["caste"]; $BlockId = $n["BlockId"]; $PhcId = $n["PhcId"]; $HscId= $n["HscId"]; $PanchayatId= $n["PanchayatId"]; 
   $VillageId= $n["VillageId"]; $address = $n["address"]; $pincode = $n["pincode"]; $povertystatus = $n["povertystatus"]; 
   $migrantstatus = $n["migrantstatus"]; $rctype = $n["rationcardtype"]; $rcnum = $n["rationcardnum"];
 }

 if (isset($_GET['edit'])) {
   $id = $_GET['edit']; $update = true;
   $record = mysqli_query($conn, "SELECT * FROM ecregister WHERE id=$id");
   $n = mysqli_fetch_array($record);
   $ecfrno = $n["ecfrno"]; $dateecreg = $n["dateecreg"]; $maadhaarname = $n["motheraadhaarname"]; $mfullname = $n["motherfullname"]; $mdob = $n["motherdob"]; $mageecreg = $n["motherageecreg"]; $magemarriage = $n["motheragemarriage"]; $mmobno = $n["mothermobno"];$mobperson = $n["mobileofperson"]; $mstatus = $n["motheredustatus"]; $haadhaarname = $n["husbandaadhaarname"]; $hfullname = $n["husfullname"]; $hdob = $n["husdob"]; $hageecreg = $n["husageecreg"]; $hagemarriage = $n["husagemarriage"]; $husmobno = $n["husmobno"]; $hedustatus = $n["husedustatus"]; $religion = $n["religion"]; $caste = $n["caste"]; $BlockId = $n["BlockId"]; $PhcId = $n["PhcId"]; $HscId= $n["HscId"]; $PanchayatId= $n["PanchayatId"]; 
       $VillageId= $n["VillageId"]; $address = $n["address"]; $pincode = $n["pincode"]; $povertystatus = $n["povertystatus"]; $migrantstatus = $n["migrantstatus"]; $rctype = $n["rationcardtype"]; $rcnum = $n["rationcardnum"];
 }

if (! empty($_POST["update"])) {
 $id = $_POST['id'];

   $ecfrno = $_POST["ecfrno"]; $dateecreg = $_POST["dateecreg"]; $maadhaarname = $_POST["motheraadhaarname"]; $mfullname = $_POST["motherfullname"]; $mdob = $_POST["motherdob"]; $mageecreg = $_POST["motherageecreg"]; $magemarriage = $_POST["motheragemarriage"]; $mmobno = $_POST["mothermobno"]; $mobperson = $_POST["mobileofperson"]; $mstatus = $_POST["motheredustatus"]; $haadhaarname = $_POST["husbandaadhaarname"]; $hfullname = $_POST["husfullname"]; $hdob = $_POST["husdob"]; $hageecreg = $_POST["husageecreg"]; $hagemarriage = $_POST["husagemarriage"]; $husmobno = $_POST["husmobno"]; $hedustatus = $_POST["husedustatus"]; $religion = $_POST["religion"]; $caste = $_POST["caste"]; $BlockId = $_POST["BlockId"]; $PhcId = $_POST["PhcId"]; $HscId= $_POST["HscId"]; 
       $PanchayatId = $_POST["PanchayatId"]; $VillageId = $_POST["VillageId"]; $address = $_POST["address"]; $pincode = $_POST["pincode"]; 
   $povertystatus = $_POST["povertystatus"]; $migrantstatus = $_POST["migrantstatus"]; $rctype = $_POST["rationcardtype"]; $rcnum = $_POST["rationcardnum"];
 date_default_timezone_set('Asia/Kolkata');
 $date = date('d-m-Y h:i:s');
 $uquery = mysqli_query($conn, "UPDATE ecregister SET ecfrno='$ecfrno', dateecreg='$dateecreg', motheraadhaarname='$maadhaarname', husbandaadhaarname='$haadhaarname', motherfullname='$mfullname', motherdob='$mdob', motherageecreg='$mageecreg', motheragemarriage='$magemarriage',
 mothermobno='$mmobno', mobileofperson='$mobperson', motheredustatus='$mstatus', husfullname='$hfullname', husdob='$hdob', husageecreg='$hageecreg', husagemarriage='$hagemarriage',husmobno='$husmobno', husedustatus='$hedustatus', religion='$religion', caste='$caste', BlockId='$BlockId',PhcId='$PhcId',HscId= '$HscId', PanchayatId='$PanchayatId',VillageId='$VillageId', address='$address',pincode='$pincode', povertystatus='$povertystatus',migrantstatus='$migrantstatus', rationcardtype='$rctype',
 rationcardnum='$rcnum', updatedat='$date', updatedBy='$userid' WHERE id=$id");

if (!empty($uquery)) { 
   ?> 
   <div class="alert alert-success alert-dismissible"><h6><i class="icon fa fa-check"></i>Updated Successfully</h6></div>
 <?php  header('location: EligibleCouple.php');
 } else { ?>
 <div class="alert alert-danger alert-dismissible"><h6><i class="icon fa fa-close"></i>Check the Fields User Unable to Update</h6></div>
 <?php  } }
 if (isset($_GET['del'])) {
   $id = $_GET['del'];
   date_default_timezone_set('Asia/Kolkata');
   $date = date('d-m-Y h:i:s');
   mysqli_query($conn, "UPDATE ecregister SET status=0, deletedat='$date', deletedBy='$userid' WHERE status=1 AND  id=$id");
   header('location: EligibleCouple.php');
 }
?>
<!-- Content wrapper -->
    <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
             <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Eligible Couples /</span> 
              <?php if($view == true) { 
                echo "View";
              } elseif($update == true) {
                echo "Edit";
              }else {
                echo "Add";
              } ?> Eligible Couple
              <a href="EligibleCouple.php"><button type="submit" class="btn btn-primary" id="btnBack">
                    <span class="bx bx-arrow-back"></span>&nbsp; Back
              </button></a>
              
              <a href="../forms/ViewEditEc.php?del=<?php echo $id; ?>" onclick="return confirm('Are you sure to delete?')"><button type="submit" class="btn btn-danger btnSpace">
                    <span class="bx bx-minus"></span>&nbsp; Delete
              </button></a>

              <button type="submit" id="edit" class="btn btn-success btnSpace edit" value="<?php echo $id; ?>" onclick="fnEnable()">
                    <span class="bx bx-edit"></span>&nbsp; Edit
              </button>
              
			</h4>

        <form action="" method="post" onSubmit="return EcFormValid(this);">
              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
						<h4 class="fw-bold"><span class="text-muted fw-light">Mother Details</span></h4>
                        <small class="text-muted float-end"><span class="mand">* </span> Fields are Mandatory</small>
                    </div>
                    <div class="card-body">
               		<input type="hidden" name="id" value="<?php echo $id; ?>">
						<div class="row">
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">EC FR No <span class="mand">* </span><span id="errEcfrNo"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            <span id="hscGen">
                            <select name="Hsc" id="SelectHsc" onchange="FirstAlphabet()" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon"  disabled>
                           
                           <?php   
                            $query = "SELECT DISTINCT(HscCode),HscId FROM hscmaster ORDER BY HscId";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['HscCode']; ?>"><?php echo $listvalue['HscCode']; ?></option>
                          
                          <?php  } ?>
                             </select>
                             </span>
                            <input
                              type="text"
                              name="ecfrno"
                              class="form-control"
                              id="ecfrno" 
                              placeholder="EC FR No"
                              aria-label="EC FR No"
                              aria-describedby="basic-icon-default-fullname2"
                              disabled value="<?php echo $ecfrno; ?>"
                            />
                          </div>
                        </div>
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">DATE OF EC REG <span class="mand">* </span> <span id="errEcReg"></span></label>
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
                        </div>
                        <div class="row">
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">MOTHER AADHAAR ID <span id="errmotherAadhaarid"></span></label>
                          <div class="input-group input-group-merge">
                            <label class="lblViolet"><?php echo $maadhaarid; ?>
                              </label>
                              <input
                              type="hidden"
                              oninput = "MotheronlyNumbers(this.value)"
                              name="motheraadhaarid"
                              id="motheraadhaar"
                              maxlength="12"
                              class="form-control"
                              placeholder="MOTHER AADHAAR ID"
                              aria-label="MOTHER AADHAAR ID"
                              aria-describedby="basic-icon-default-password2"
                              value="<?php echo $maadhaarid; ?>"
                            />
                          </div>
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER NAME AS PER AADHAAR <span class="mand">* </span><span id="errMName"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-user-circle"></i></span>
                            <input
                              type="text"
                              name="motheraadhaarname"
                              id="motheraadhaarname" 
                              class="form-control phone-mask"
                              placeholder="MOTHER NAME AS PER AADHAAR"
                              aria-label="MOTHER NAME AS PER AADHAAR"
                              aria-describedby="basic-icon-default-mobile"
                              disabled value="<?php echo $maadhaarname; ?>"
                            />
                          </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER FULLNAME <span class="mand">* </span><span id="errMfullname"></span></label>
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

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">MOTHER DATE OF BIRTH <span class="mand">* </span><span id="errMdob"></span></label>
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
                        </div>
                        <div class="row">
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER AGE AT MARRIAGE <span class="mand">* </span><span id="errMoAgeMrg"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-user-pin"></i
                            ></span>
                            <input
                              type="text"
                              min="11" max="99"
                              name="motheragemarriage"
                              id="motheragemarriage"
                              class="form-control phone-mask"
                              placeholder="MOTHER AGE AT MARRIAGE"
                              aria-label="MOTHER AGE AT MARRIAGE"
                              aria-describedby="basic-icon-default-mobile"
                              disabled value="<?php echo $magemarriage; ?>"
                              
                            />
                          </div>
                        </div>
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER AGE AT Registration <span class="mand">* </span><span id="errMageecreg"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-user-minus"></i
                            ></span>
                            
                            <input
                              type="text"
                              min="11" max="99"
                              name="motherageecreg"
                              id="motherageecreg" 
                              class="form-control phone-mask"
                              placeholder="MOTHER AGE AT REGISTRATION"
                              aria-label="MOTHER AGE AT REGISTRATION"
                              aria-describedby="basic-icon-default-mobile"
                              disabled value="<?php echo $mageecreg; ?>"
                            />
                          </div>
                        </div>

                        </div>
                        <div class="row">
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER MOBILE NUMBER  <span id="errMmobno"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-mobile"></i
                            ></span>
                            <input
                              type="text"
                              oninput = "MothermobonlyNumbers(this.value)"
                              name="mothermobno"
                              id="mothermobno"
                              maxlength="10"
                              class="form-control phone-mask"
                              placeholder="MOTHER MOBILE NUMBER"
                              aria-label="MOTHER MOBILE NUMBER"
                              aria-describedby="basic-icon-default-mobile"
                              disabled value="<?php echo $mmobno; ?>"
                              
                            />
                          </div>
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOBILE BELONGS TO <span class="mand">* </span><span id="errMobPerson"></span></label>
                          <div class="input-group input-group-merge">
                          <select name="mobileofperson" id="mobileofperson" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" disabled >
                            
                                <?php

                                $list=mysqli_query($conn, "SELECT ec.mobileofperson,e.enumid,e.enumvalue from ecregister ec join enumdata e on e.enumid=ec.mobileofperson WHERE type=3 AND ec.id=".$id);

                                while($row_list=mysqli_fetch_assoc($list)){

                                ?>

                                <option value="<?php echo $row_list['enumid']; ?>">

                                <?php if($row_list['enumvalue']== $mobperson){  }?>
                                
                                <?php echo $row_list['enumvalue']; ?></option>
                                <?php 
                                $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=3";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                              ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php }  } ?>
                      </select>
                      </div>
                        </div><br>

                      
                      <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER EDUCATIONAL STATUS <span class="mand">* </span><span id="errMedustatus"></span></label>
                          <div class="input-group input-group-merge">
                          <select name="motheredustatus" id="motheredustatus" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" value="<?php echo $motheredustatus; ?>" disabled>
                            
                                <?php

                                $list=mysqli_query($conn, "SELECT ec.motheredustatus,e.enumid,e.enumvalue from ecregister ec join enumdata e on e.enumid=ec.motheredustatus WHERE type=4 AND ec.id=".$id);

                                while($row_list=mysqli_fetch_assoc($list)){

                                ?>

                                <option value="<?php echo $row_list['enumid']; ?>">

                                <?php if($row_list['enumvalue']==$mstatus){ echo "selected"; } ?>
                                
                                <?php echo $row_list['enumvalue']; ?></option>
                                <?php 
                                $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=4";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                              ?>
                          
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php }
                                } ?>
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
						<h4 class="fw-bold"><span class="text-muted fw-light">Father Details</span></h4>
                        <small class="text-muted float-end"><span class="mand">* </span> Fields are Mandatory</small>
                    </div>
                    <div class="card-body">
				<div class="errMsg" id="errMsg"></div>
               		<input type="hidden" name="id" disabled value="<?php echo $id; ?>">
						<div class="row">
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">HUSBAND AADHAAR ID <span id="errHaadhaarid"></span></label>
                          <div class="input-group input-group-merge">
                            <label class="lblViolet"><?php echo $haadhaarid; ?>
                              </label>
                              <input
                              type="hidden"
                               oninput = "HusbandonlyNumbers(this.value)"
                              name="husbandaadhaarid"
                              id="husbandaadhaarid"
                              maxlength="12"
                              class="form-control"
                              placeholder="HUSBAND AADHAAR ID"
                              aria-label="HUSBAND AADHAAR ID"
                              aria-describedby="basic-icon-default-password2"
                             value="<?php echo $haadhaarid; ?>"
                            />
                          </div>
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND NAME AS PER AADHAAR <span class="mand">* </span><span id="errhaadhaarname"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-user"></i
                            ></span>
                            <input
                              type="text"
                              name="husbandaadhaarname"
                              id="husbandaadhaarname" 
                              class="form-control phone-mask"
                              placeholder="HUSBAND NAME AS PER AADHAAR"
                              aria-label="HUSBAND NAME AS PER AADHAAR"
                              aria-describedby="basic-icon-default-mobile"
                              disabled value="<?php echo $haadhaarname; ?>"
                            />
                          </div>
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND FULLNAME <span class="mand">* </span><span id="errhfullname"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-user-check"></i
                            ></span>
                            <input
                              type="text"
                              name="husfullname"
                              id="husfullname"
                              class="form-control phone-mask"
                              placeholder="HUSBAND FULLNAME"
                              aria-label="HUSBAND FULLNAME"
                              aria-describedby="basic-icon-default-mobile"
                              disabled value="<?php echo $hfullname; ?>"
                              
                            />
                          </div>
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">HUSBAND DATE OF BIRTH <span class="mand">* </span><span id="errhdob"></span></label>
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
                        
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND AGE AT MARRIAGE <span class="mand">* </span><span id="errhagemarriage"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-user-pin"></i
                            ></span>
                            <input
                              type="number"
                              min="11" max="99"
                              name="husagemarriage"
                              id="husagemarriage"
                              class="form-control phone-mask"
                              placeholder="HUSBAND AGE AT CONCEPTION"
                              aria-label="HUSBAND AGE AT CONCEPTION"
                              aria-describedby="basic-icon-default-mobile"
                              disabled value="<?php echo $hagemarriage; ?>"
                              
                            />
                            
                          </div>
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND AGE AT Registration <span class="mand">* </span><span id="errhageecreg"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-user-minus"></i
                            ></span>
                            <input
                              type="text"
                              min="11" max="99"
                              name="husageecreg"
                              id="husageecreg"
                              class="form-control phone-mask"
                              placeholder="HUSBAND AGE AT MARRIAGE"
                              aria-label="HUSBAND AGE AT MARRIAGE"
                              aria-describedby="basic-icon-default-mobile"
                              disabled value="<?php echo $hageecreg; ?>"
                              
                            />
                          </div>
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND MOBILE NUMBER <span id="errhmob"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-mobile"></i
                            ></span>
                            <input
                              type="text"
                              oninput = "HusmobonlyNumbers(this.value)"
                              name="husmobno"
                              id="husmobno"
                              maxlength="10"
                              class="form-control phone-mask"
                              placeholder="HUSBAND MOBILE NUMBER"
                              aria-label="HUSBAND MOBILE NUMBER"
                              aria-describedby="basic-icon-default-mobile"
                              disabled value="<?php echo $husmobno; ?>"
                              
                            />
                          </div>
                        </div>
  
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND EDUCATIONAL STATUS <span class="mand">* </span><span id="errhedustatus"></span></label>
                          <div class="input-group input-group-merge">
                          <select name="husedustatus" id="husedustatus" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" value="<?php echo $husedustatus; ?>" disabled> 
                                <?php

                                $list=mysqli_query($conn, "SELECT ec.husedustatus,e.enumid,e.enumvalue from ecregister ec join enumdata e on e.enumid=ec.husedustatus WHERE type=4 AND ec.id=".$id);

                                while($row_list=mysqli_fetch_assoc($list)){

                                ?>

                                <option value="<?php echo $row_list['enumid']; ?>">

                                <?php if($row_list['enumvalue']==$hedustatus){ echo "selected"; } ?>
                                
                                <?php echo $row_list['enumvalue']; ?></option>
                                <?php 
                                $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=4";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                              ?>
                          
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php }
                                } ?>
						
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
                        <small class="text-muted float-end"><span class="mand">* </span> Fields are Mandatory</small>
                    </div>
                    <div class="card-body">
               		<input type="hidden" name="id" value="<?php echo $id; ?>">
						<div class="row">
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">RELIGION <span class="mand">* </span><span id="errReligion"></span></label>
                          <div class="input-group input-group-merge">
                          <select name="religion" id="religion" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" disabled >
                            
                                <?php

                                $list=mysqli_query($conn, "SELECT ec.religion,e.enumid,e.enumvalue from ecregister ec join enumdata e on e.enumid=ec.religion WHERE type=5 AND ec.id=".$id);

                                while($row_list=mysqli_fetch_assoc($list)){

                                ?>

                                <option value="<?php echo $row_list['enumid']; ?>">

                                <?php if($row_list['enumvalue']==$religion){ echo "selected"; } ?>
                                
                                <?php echo $row_list['enumvalue']; ?></option>
                                <?php 
                                $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=5";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                              ?>
                          
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php }
                                } ?>
                                </select>
                
						</div>
					  </div>
					  <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Community <span class="mand">* </span><span id="errCaste"></span></label>
                          <div class="input-group input-group-merge">
                          <select name="caste" id="caste" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" disabled >
                            
                                <?php

                                $list=mysqli_query($conn, "SELECT ec.caste,e.enumid,e.enumvalue from ecregister ec join enumdata e on e.enumid=ec.caste WHERE type=6 AND ec.id=".$id);

                                while($row_list=mysqli_fetch_assoc($list)){

                                ?>

                                <option value="<?php echo $row_list['enumid']; ?>">

                                <?php if($row_list['enumvalue']==$caste){ } ?>
                                
                                <?php echo $row_list['enumvalue']; ?></option>
                                <?php 
                                $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=6";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                              ?>
                          
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php }
                                } ?>

                                </select>
                            
                      </div>
					</div>
          <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Name of the Block <span class="mand">* </span><span id="errBlockValue"></span></label>
                          <div class="input-group input-group-merge">
                            <?php if($update == true || $view == true) { ?>
                          <select name="BlockId" id="BlockId" onchange="BlockOn()" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" disabled>
                            
                                <?php

                                $list=mysqli_query($conn, "SELECT DISTINCT(lm.BlockId),ec.BlockId,lm.BlockName FROM ecregister ec LEFT JOIN hscmaster lm ON ec.BlockId=lm.BlockId WHERE ec.id=".$id);

                                while($row_list=mysqli_fetch_assoc($list)){

                                ?>

                                <option value="<?php echo $row_list['BlockId']; ?>">

                                <?php if($row_list['BlockId']== $BlockId){  }?>
                                
                                <?php echo $row_list['BlockName']; ?></option>
                                <?php 
                                $query = "SELECT DISTINCT(BlockId),BlockName FROM hscmaster ORDER BY BlockId";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                              ?>
                          
                          <option value="<?php echo $listvalue['BlockId']; ?>"><?php echo $listvalue['BlockName']; ?></option>

                            

                                <?php }
                                } ?>

                                </select>
                            <?php } ?>
						</div>
					  </div>
					<div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Name of the PHC <span class="mand">* </span><span id="errPhcValue"></span></label>
                          <div class="input-group input-group-merge">
                            <?php if($update == true || $view == true) { ?>
                          <select name="PhcId" id="PhcId" onchange="PhcOn()" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" disabled>
                            
                                <?php

                                $list=mysqli_query($conn, "SELECT DISTINCT(lm.PhcId), ec.PhcId,lm.PhcName FROM ecregister ec LEFT JOIN hscmaster lm ON ec.PhcId=lm.PhcId WHERE ec.id=".$id);

                                while($row_list=mysqli_fetch_assoc($list)){

                                ?>

                                <option value="<?php echo $row_list['PhcId']; ?>">

                                <?php if($row_list['PhcId']== $PhcId){  }?>
                                
                                <?php echo $row_list['PhcName']; ?></option>
                                <?php 
                                $query = "SELECT DISTINCT(PhcId),PhcName FROM hscmaster ORDER BY PhcId";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                              ?>
                          
                          <option value="<?php echo $listvalue['PhcId']; ?>"><?php echo $listvalue['PhcName']; ?></option>

                                <?php }
                                } ?>

                                </select>
                            <?php } ?>
                          
						</div>
					  </div>
            <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Name of the HSC <span class="mand">* </span><span id="errHscValue"></span></label>
                          <div class="input-group input-group-merge">
                            <?php if($update == true || $view == true) { ?>
                          <select name="HscId" id="HscId" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" disabled>
                            
                                <?php

                                $list=mysqli_query($conn, "SELECT DISTINCT(lm.HscId), ec.HscId, lm.HscName FROM ecregister ec LEFT JOIN hscmaster lm ON ec.HscId=lm.HscId WHERE ec.id=".$id);

                                while($row_list=mysqli_fetch_assoc($list)){

                                ?>

                                <option value="<?php echo $row_list['HscId']; ?>">

                                <?php if($row_list['HscId']== $HscId){  }?>
                                
                                <?php echo $row_list['HscName']; ?></option>
                                <?php 
                                $query = "SELECT DISTINCT(HscId),HscName FROM hscmaster ORDER BY HscId";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                              ?>
                          
                          <option value="<?php echo $listvalue['HscId']; ?>"><?php echo $listvalue['HscName']; ?></option>

                                <?php }
                                } ?>

                                </select>
                            <?php } ?>
                          
						</div>
					  </div>
            
            <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Name of the Panchayat <span class="mand">* </span><span id="errPanchayat"></span></label>
                          <div class="input-group input-group-merge">
                            <?php if($update == true || $view == true) { ?>
                          <select name="PanchayatId" id="PanchayatId" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" disabled>
                            
                                <?php

                                $list=mysqli_query($conn, "SELECT DISTINCT(lm.PanchayatId), ec.PanchayatId, lm.PanchayatName FROM ecregister ec LEFT JOIN hscmaster lm ON ec.PanchayatId=lm.PanchayatId WHERE ec.id=".$id);

                                while($row_list=mysqli_fetch_assoc($list)){

                                ?>

                                <option value="<?php echo $row_list['PanchayatId']; ?>">

                                <?php if($row_list['PanchayatId']== $PanchayatId){  }?>
                                
                                <?php echo $row_list['PanchayatName']; ?></option>
                                <?php 
                                $query = "SELECT DISTINCT(PanchayatId),PanchayatName FROM hscmaster ORDER BY PanchayatId";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                              ?>
                          
                          <option value="<?php echo $listvalue['PanchayatId']; ?>"><?php echo $listvalue['PanchayatName']; ?></option>

                                <?php }
                                } ?>

                                </select>
                            <?php } ?>
                          
						</div>
					  </div>
					  <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Name of the Village <span class="mand">* </span><span id="errVillage"></span></label>
                          <div class="input-group input-group-merge">
                            <?php if($update == true || $view == true) { ?>
                          <select name="VillageId" id="VillageId" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" disabled>
                            
                                <?php

                                $list=mysqli_query($conn, "SELECT DISTINCT(lm.VillageId), ec.VillageId, lm.VillageName FROM ecregister ec LEFT JOIN hscmaster lm ON ec.VillageId=lm.VillageId WHERE ec.id=".$id);

                                while($row_list=mysqli_fetch_assoc($list)){

                                ?>

                                <option value="<?php echo $row_list['VillageId']; ?>">

                                <?php if($row_list['VillageId']== $VillageId){  }?>
                                
                                <?php echo $row_list['VillageName']; ?></option>
                                <?php 
                                $query = "SELECT DISTINCT(VillageId),VillageName FROM hscmaster ORDER BY VillageId";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                              ?>
                          
                          <option value="<?php echo $listvalue['VillageId']; ?>"><?php echo $listvalue['VillageName']; ?></option>

                                <?php }
                                } ?>

                                </select>
                            <?php } ?>
                          
						</div>
					  </div>
            <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">ADDRESS <span class="mand">* </span><span id="errAddr"></span></label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-mobile" class="input-group-text"
                              ><i class="bx bx-map-pin"></i
                            ></span>
                            <textarea id="address" name="address" class="form-control" cols="42" rows="3" disabled><?php  echo $address; ?></textarea>
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
                              disabled value="<?php echo $pincode; ?>"
                              
                            />
                          </div>
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">POVERTY STATUS <span class="mand">* </span><span id="errPoverty"></span></label>
                          <div class="input-group input-group-merge">
                          <select name="povertystatus" id="povertystatus" ="" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" value="<?php echo $povertystatus; ?>" disabled>
                            
                                <?php

                                $list=mysqli_query($conn, "SELECT ec.povertystatus,e.enumid,e.enumvalue from ecregister ec join enumdata e on e.enumid=ec.povertystatus WHERE type=7 AND ec.id=".$id);

                                while($row_list=mysqli_fetch_assoc($list)){

                                ?>

                                <option value="<?php echo $row_list['enumid']; ?>">

                                <?php if($row_list['enumvalue']==$povertystatus){ } ?>
                                
                                <?php echo $row_list['enumvalue']; ?></option>
                                <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=7";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } 
                             } ?>
					</select>      
							</div>
						</div>
					
                      <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MIGRANT STATUS <span class="mand">* </span><span id="errMigrant"></span></label>
                          <div class="input-group input-group-merge">
                            <?php //if($update == true || $view == true) { ?>
                          <select name="migrantstatus" id="migrantstatus" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" value="<?php echo $migrantstatus; ?>" disabled >
                            
                                <?php

                                $list=mysqli_query($conn, "SELECT ec.migrantstatus,e.enumid,e.enumvalue from ecregister ec join enumdata e on e.enumid=ec.migrantstatus WHERE type=9 AND ec.id=".$id);

                                while($row_list=mysqli_fetch_assoc($list)){

                                ?>

                                <option value="<?php echo $row_list['enumid']; ?>">

                                <?php if($row_list['enumvalue']==$migrantstatus){} ?>
                                
                                <?php echo $row_list['enumvalue']; ?></option>
                               <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=9";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } 
                             } ?>
					</select>
						</div>
                      </div>  

                      <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">RATION CARD TYPE <span class="mand">* </span><span id="errRtype"></span></label>
                          <div class="input-group input-group-merge">
                          <select name="rationcardtype" id="rationcardtype" class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon" disabled >
                            
                                <?php

                                $list=mysqli_query($conn, "SELECT ec.rationcardtype,e.enumid,e.enumvalue FROM ecregister ec JOIN enumdata e on e.enumid=ec.rationcardtype WHERE type=8 AND ec.id=".$id);

                                while($row_list=mysqli_fetch_assoc($list)){

                                ?>

                                <option value="<?php echo $row_list['enumid']; ?>">

                                <?php if($row_list['enumvalue']== $rctype){  }?>
                                
                                <?php echo $row_list['enumvalue']; ?></option>
                                <?php 
                                $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=8";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                              ?>
                          
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php }  } ?>
                      </select>
						</div>
                      </div>
					  
                      <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">RATION CARD NUMBER <span class="mand">* </span><span id="errRcardnum"></span></label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                            <input
                              type="text"
                              oninput = "onlyRationNo(this.value)"
                              name="rationcardnum"
                              id="rationcardnum" maxlength="12"
                              class="form-control" 
                              placeholder="RATION CARD NUMBER"
                              aria-label="RATION CARD NUMBER"
                              aria-describedby="basic-icon-default-email2"
                              disabled value="<?php echo $rcnum; ?>"
                              
                            />
                          </div>
                        </div>
                        
                      <div class="input-group" id="btnSaUp" style="display:none">
                            
                        <input class="btn btn-primary" type="submit" id="update" name="update" value="Update">
                      </div>			
                </div><!--Family Div row-->
				</div>
				</div>
			</div>
			</div><!-- Family Details Close-->
			</form>
			<!-- / Content -->
<?php include ('require/footer.php'); ?>



