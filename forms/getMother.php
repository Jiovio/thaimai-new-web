
<?php
require_once "../config/db_connect.php";
$motheraadhaarid = $_POST["motheraadhaarid"];
$result = mysqli_query($conn,"SELECT motheraadhaarid,motheraadhaarname,husbandaadhaarname FROM ecregister WHERE motheraadhaarid='$motheraadhaarid'");
while($MnCnt = mysqli_fetch_assoc($result)) {
$mothername = $MnCnt['motheraadhaarname'];
$husname = $MnCnt['husbandaadhaarname'];
}
?><body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <!-- Menu -->
<?php
include ('require/header.php'); // Menu & Top Search 
$pvalue =""; 
$residentType=""; $ptest=""; $gravida=""; $para=""; $child=""; $ab=""; $cd=""; $hrPreg=""; $obcode=""; 
$height=""; $weight=""; $bp=""; $dia=""; $date=""; $age=""; $mrmbs=""; $pvalue=""; $id = 0; $update = false;
$picmeno ="";
if (! empty($_POST["anuser"])) {
$CheckDuplicatePno = mysqli_query($conn,"SELECT picmeno FROM anregistration where picmeno='".$_POST["picmeno"]."' ");
while($picvalue = mysqli_fetch_array($CheckDuplicatePno))
{ 
  $pvalue = $picvalue["picmeno"];
}

if($pvalue > 0) {
  $type = "error";
  $emessage = "Duplicate PICME No.";
} else {
$picmeno =$_POST["picmeno"];
$picmeRegDate =$_POST["picmeRegDate"];
$motheraadhaarid = $_POST['motheraadhaarid'];
$residentType =$_POST["residentType"]; 
$ptest = $_POST["pregnancyTestResult"];
$methodofConception = $_POST["methodofConception"];
$gravida = $_POST["gravida"]; 
$para = $_POST["para"];
$child = $_POST["livingChildren"]; 
$ab = $_POST["abortion"]; 
$cd = $_POST["childDeath"];
$hrPreg = $_POST["hrPregnancy"];
//echo "hr-".$hrPreg; exit;
$obcode = $_POST["obstetricCode"]; 
$height = $_POST["motherHeight"];
$weight = $_POST["motherWeight"]; 
$bp = $_POST["bpSys"]; 
$dia = $_POST["bpDia"];
$date = $_POST["anRegDate"]; 
$mrmbs = $_POST["mrmbsEligible"];
$MotherAge = $_POST["MotherAge"]; 
$HusbandAge = $_POST["HusbandAge"];

$query = mysqli_query($conn,"INSERT INTO anregistration (motheraadhaarid, picmeno,picmeRegDate, residentType, pregnancyTestResult,methodofConception, gravida, para, livingChildren, abortion, childDeath, hrPregnancy, obstetricCode, motherHeight, motherWeight, bpSys, bpDia, anRegDate, mrmbsEligible,MotherAge,HusbandAge,createdBy) 
VALUES ('$motheraadhaarid','$picmeno','$picmeRegDate','$residentType','$ptest','$methodofConception','$gravida','$para','$child', '$ab', '$cd', '$hrPreg', '$obcode','$height','$weight','$bp','$dia','$date','$mrmbs','$MotherAge','$HusbandAge','$userid')");
          if (!empty($query)) {
          echo "<script>alert('Inserted Successfully');window.location.replace('{$siteurl}/forms/AnRegisterlist.php');</script>";
          } 
          $HighRisk =0;
if(($gravida > 2) || ($para > 2) || ($child > 2) || ($ab > 2) || ($cd > 2)) {
  $HighRisk = 1;
  $hrqry = mysqli_query($conn,"INSERT INTO highriskmothers (picmeNo, motherName, highRiskFactor) 
  VALUES ('$picmeno','$mothername','$obcode')"); 
  $uqry= mysqli_query($conn,"UPDATE anregistration SET highRisk=1 WHERE motheraadhaarid='$motheraadhaarid'");
}
$uquery = mysqli_query($conn,"UPDATE ecregister SET picmeNo='$picmeno',status=2 WHERE motheraadhaarid='$motheraadhaarid'");
$teenqy = mysqli_query($conn,"UPDATE ecregister SET status=5 WHERE motheraadhaarid='$motheraadhaarid' AND TIMESTAMPDIFF(YEAR, motherdob,CURDATE())<18");
          }
}
?>       
  <!-- Content wrapper -->
    <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Antenatal Registration /</span> Add Antenatal Registration
            <a href="AnRegisterlist.php"><button type="submit" class="btn btn-primary" id="btnBack">
                  <span class="bx bx-arrow-back"></span>&nbsp; Back
            </button></a>
          </h4>

            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4">
                <hr class="my-0" />
                  <div class="card-body">
                  <form onSubmit="return Arvalidate(this);" method="POST">
                <div class="row">
                        <div class="mb-3 col-md-4">
                        <label class="form-label" for="basic-icon-default-motheraathar">MOTHER'S AADHAAR ID <span class="mand">* </span> </span id="errPicmeno"><span></label>
                        <div class="input-group input-group-merge">
                            <input type="text" name="motheraadhaarid" value="<?php echo $motheraadhaarid; ?>" class="form-control" readonly />
                        </div>
                      </div>
                      <div class="mb-3 col-md-4">
                        <label class="form-label" for="basic-icon-default-mothername">MOTHER'S NAME AS PER AADHAAR <span class="mand">* </span> </span id="errPicmeno"><span></label>
                        <div class="input-group input-group-merge">
                            <input type="text" value="<?php echo $mothername; ?>" class="form-control" disabled /> 
                      </div>
                      </div>
                      <div class="mb-3 col-md-4">
                        <label class="form-label" for="basic-icon-default-husname">HUSBAND NAME AS PER AADHAAR <span class="mand">* </span> </span id="errPicmeno"><span></label>
                        <div class="input-group input-group-merge">
                        <input type="text" value="<?php echo $husname; ?>" class="form-control" disabled /> 
                      </div>
                      </div>
                </div><hr/>
                      <div class="row">
                      <div class="mb-3 col-md-6">
                        
                        <label class="form-label" for="basic-icon-default-picmeno">PICME No. <span class="mand">* </span> </span id="errPicmeno"><span></label>
                        
                        <div class="input-group input-group-merge">
                          <input
                          oninput = "onlyNumbers(this.value)"
                            type="number"
                            name="picmeno"
                            class="form-control anregisterPicmenoCls"
                            id="picmeno" min="100000000000" max="999999999999" required
                            placeholder="PICME No."
                            aria-label="PICME No."
                            aria-describedby="basic-icon-default-fullname2"
                            value ="<?php echo $picmeno; ?>"
                          />
                        </div>
                      </div>
                      
                      <div class="mb-3 col-md-6">
                          <label for="zipCode" class="form-label">PICME REGISTER DATE <span class="mand">* </span></label>
                          <input
                            type="date"
                            class="form-control"
                            id="picmeRegDate"
                            name="picmeRegDate"
                            placeholder="PICME REGISTER DATE"
                            required
                          />
                        </div>
                        </div>
                      <div class="row">
                        <div class="mb-3 col-md-6">
                          <label class="form-label">RESIDENT TYPE <span class="mand">* </span></label>
                          <select name="residentType" id="residentType" required class="form-select">
                        <option value="">Choose...</option>
                         
                         <?php  
                          $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=10";
                          $exequery = mysqli_query($conn, $query);
                          while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                        <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                         <?php } ?>
                           </select>
                        </div>
                        
                        <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-icon-default-pregnancyTestResult">PREGNANCY TEST RESULT <span class="mand">* </span></label>
                        <div class="input-group input-group-merge">
                          <select required name="pregnancyTestResult" id="pregnancyTestResult" class="form-select">
                          <option value="">Choose...</option>
                        <?php 
                          $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=11";
                          $exequery = mysqli_query($conn, $query);
                          while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                        <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                         <?php } ?>
                           </select>
                        </div>
                        </div>
                        
                      </div>
                      <div class="row">
                        <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-icon-default-methodofConception">Method Of Conception <span class="mand">* </span></label>
                        <div class="input-group input-group-merge">
                          <select required name="methodofConception" id="methodofConception" class="form-select" >
                        <option value="">Choose...</option>
                      <?php   
                          $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=45";
                          $exequery = mysqli_query($conn, $query);
                          while($listvalue = mysqli_fetch_assoc($exequery)) { 
                              ?>
                        <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                        <?php  } ?>
                           </select> 
                        </div>
                      </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label">GRAVIDA <span class="mand">* </span></label>
                          <select name="gravida" required id="gravida" class="form-select">
                        <option value="">Choose...</option>
                         <?php 
                          $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=40";
                          $exequery = mysqli_query($conn, $query);
                          while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                        <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                         <?php } ?>
                           </select>
                        </div>
                        
                      </div>
                      <div class="row">
                        <div class="mb-3 col-md-6">
                        <label class="form-label">PARA <span class="mand">* </span></label>
                          <select name="para" required id="para" class="form-select">
                        <option value="">Choose...</option>
                         <?php 
                          $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=12";
                          $exequery = mysqli_query($conn, $query);
                          while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                        <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                         <?php } ?>
                           </select>
                        </div>
                        
                        <div class="mb-3 col-md-6">
                        <label class="form-label">LIVING CHILDREN <span class="mand">* </span></label>
                          <select name="livingChildren" required id="livingChildren" class="form-select">
                        <option value="">Choose...</option>
                         <?php 
                          $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=12";
                          $exequery = mysqli_query($conn, $query);
                          while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                        <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                         <?php } ?>
                           </select>
                          </div>
                      
                          </div>
                      <div class="row">
                        <div class="mb-3 col-md-6">
                        <label class="form-label">ABORTION <span class="mand">* </span></label>
                          <select name="abortion" required id="abortion" class="form-select">
                        <option value="">Choose...</option>
                         <?php 
                          $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=12";
                          $exequery = mysqli_query($conn, $query);
                          while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                        <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                         <?php } ?>
                           </select>
                          </div>

                        <div class="mb-3 col-md-6">
                        <label class="form-label">Child Death <span class="mand">* </span></label>
                          <select name="childDeath" onclick="Obcode()" required id="childDeath" class="form-select">
                        <option value="">Choose...</option>
                         <?php 
                          $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=12";
                          $exequery = mysqli_query($conn, $query);
                          while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                        <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                         <?php } ?>
                           </select>
                          </div>

                          </div>
                      <div class="row">                            
                        <div class="mb-3 col-md-6">
                          <label class="form-label">OBSTETRIC CODE <span class="mand">* </span></label>
                          <input type="text" class="form-control" id="obstetricCode" name="obstetricCode" placeholder="Code" readonly />
                        </div>

                        <div class="mb-3 col-md-6">
                        <label class="form-label">HR Pregnancy <span class="mand">* </span></label>
                          <select name="hrPregnancy" required id="hrPregnancy" class="form-select">
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
                      <div class="row">
                        <div class="mb-3 col-md-6">
                          <label class="form-label">MOTHER'S HEIGHT <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <input class="form-control" type="number" id="motherHeight" required name="motherHeight" placeholder="Height" />
                        </div>
                        </div>
                        
                        <div class="mb-3 col-md-6">
                          <label for="zipCode" class="form-label">MOTHER'S WEIGHT <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <input
                            type="number"
                            class="form-control"
                            id="motherWeight"
                            name="motherWeight"
                            placeholder="Mother Weight"
                            required
                          />
                        </div>
                        </div>
                        
                      </div>
                      <div class="row">
                        <div class="mb-3 col-md-6">
                          <label class="form-label">BP Systolic <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select class="50-200 form-control" id="bpSys" name="bpSys" placeholder="BP SYS" required>
                          <option value="">Choose...</option>
                        </select>
                          </div>
                        </div>
                        
                        <div class="mb-3 col-md-6">
                          <label class="form-label">BP Diastolic <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select class="40-150 form-control" id="bpDia" name="bpDia" placeholder="BP DIA" required>
                          <option value="">Choose...</option>
                        </select>
                        </div>
                        </div>
                        
                      </div>
                      <div class="row">
                        <div class="mb-3 col-md-6">
                          <label for="zipCode" class="form-label">ANTENATAL REGISTER DATE <span class="mand">* </span></label>
                          <input
                            type="date"
                            class="form-control"
                            id="anRegDate"
                            name="anRegDate"
                            placeholder="ANTENATAL REGISTER DATE"
                            required
                          />
                        </div>
                        
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="country">MRMBS ELIGIBLE <span class="mand">* </span></label>
                          <select required name="mrmbsEligible" id="mrmbsEligible" class="form-select">
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
                
                      <div class="row">
                      <div class="mb-3 col-md-6">
                          <label class="form-label">Mother's Age at Conception <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <input
                            type="number"
                            min="11" max="99"
                            class="form-control"
                            id="MotherAge"
                            name="MotherAge"
                            placeholder="Mother's Age"
                            required
                          />
                        </div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label">Husband's Age at Conception <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <input
                            type="number"
                            min="11" max="99"
                            class="form-control"
                            id="HusbandAge"
                            name="HusbandAge"
                            placeholder="Husband's Age"
                            required
                          />
                        </div>
                        </div>
                      </div>
                      <div class="mt-2">
                      <input class="btn btn-primary" type="submit" name="anuser" value="Save">
                      </div>
                </form>
                  </div>
                  <!-- /Account -->
                </div>
              </div>
            </div>
            </div>
          </div>
          <!-- / Content -->
<?php include ('require/footer.php'); ?>

