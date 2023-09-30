<?php include ('require/topHeader.php'); ?>
<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
<?php ini_set('display_errors','1'); include ('require/header.php'); // Menu & Top Search
$pid = "";
$pv_picmeno = "";
$pv_picmeno = $_GET['picmeNo'];

$deliverySql = mysqli_query($conn, "SELECT * FROM deliverydetails WHERE picmeno = '$pv_picmeno'");
$deliveryData = mysqli_fetch_array($deliverySql);

$CheckPNCPeriod = mysqli_query($conn,"SELECT picmeNo, pncPeriod FROM postnatalvisit where picmeNo='$pv_picmeno' order by id desc LIMIT 0,1");
$CheckPNCPeriodData = mysqli_fetch_array($CheckPNCPeriod); 

$PNC_period = "";
$PNC_period = $CheckPNCPeriodData['pncPeriod'];
$PNC_period_next = "";

if($PNC_period > 0)
{
 $PNC_period_next = $PNC_period + 1;
}

//print_r($PNC_period_next); exit;

$PNC_date = "";

 if($PNC_period_next == 2) 
{	  
  $PNC_date = date('Y-m-d', strtotime($deliveryData['deliverydate']. ' + 3 days'));
}

if($PNC_period_next == 3) 
{	  
  $PNC_date = date('Y-m-d', strtotime($deliveryData['deliverydate']. ' + 7 days'));
}

if($PNC_period_next == 4) 
{	  
  $PNC_date = date('Y-m-d', strtotime($deliveryData['deliverydate']. ' + 14 days'));
}

if($PNC_period_next == 5) 
{	  
  $PNC_date = date('Y-m-d', strtotime($deliveryData['deliverydate']. ' + 21 days'));
}

if($PNC_period_next == 6) 
{	  
  $PNC_date = date('Y-m-d', strtotime($deliveryData['deliverydate']. ' + 28 days'));
}
if($PNC_period_next == 7) 
{	  
  $PNC_date = date('Y-m-d', strtotime($deliveryData['deliverydate']. ' + 42 days'));
}

if($PNC_period_next > 7) 
{	  
  echo "<script>alert('Had seven prior visits. No more visits are permitted for this picme.');
  window.location.replace('{$siteurl}/forms/PostnatalVisitDtl.php?History=$pv_picmeno');</script>";
}

if (! empty($_POST["addpostnatal"])) { 
  
  $CheckDuplicatePno = mysqli_query($conn,"SELECT picmeNo FROM postnatalvisit where picmeNo='".$_POST["picmeNo"]."' AND pncPeriod='".$_POST["pncPeriod"]."'");
  
  while($Mvalue = mysqli_fetch_array($CheckDuplicatePno)) {
    $pid = $Mvalue["picmeNo"];
  
  } 
  if($pid > 0) {
   
  $type = "error";
  $emessage = "Selected ANC Period data is already entered for mentioned Picmeno";
  
   } else {
  $picmeNo =$_POST["picmeNo"]; 
  //$pncPeriod = $_POST["pncPeriod"]; 
  $pncPeriod = $PNC_period_next;
 // $motherPnc = $_POST["motherPnc"];
  $motherPnc = $PNC_date;
  $ifaTabletStatus = $_POST["ifaTabletStatus"]; 
  $calcium = $_POST["calcium"];
  $ppcMethod = $_POST["ppcMethod"]; 
  $vitaminA = $_POST["vitaminA"]; 
  $mDangerSign = $_POST["motherDangerSign"]; 
  $bloodSugar = $_POST["bloodSugar"];
  $weight = $_POST["infantWeight"]; 
  $iDSigns = $_POST["infantDangerSigns"];
  $bpSys = $_POST["bpSys"];  
  $bpDia = $_POST["bpDia"]; 

  $query = mysqli_query($conn,"INSERT INTO postnatalvisit (picmeno, pncPeriod, motherPnc, ifaTabletStatus,calcium, ppcMethod,vitaminA, motherDangerSign, bloodSugar, infantWeight, infantDangerSigns,bpSys,bpDia,createdBy) 
  VALUES ('$picmeNo','$pncPeriod','$motherPnc','$ifaTabletStatus','$calcium','$ppcMethod','$vitaminA','$mDangerSign','$bloodSugar','$weight','$iDSigns','$bpSys','$bpDia','$userid')");
  if (!empty($query)) {
     echo "<script>alert('Inserted Successfully');window.location.replace('{$siteurl}/forms/PostnatalVisitDtl.php?History=$pv_picmeno');</script>";
   } 
  $motstatus = mysqli_query($conn, "UPDATE ecregister SET status=3 WHERE picmeNo='$picmeNo'");
  } } ?>
      
<!-- Content wrapper -->
    <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Postnatal /</span> Add Postnatal
              <a href="../forms/PostnatalVisitDtl.php?History=<?php echo $pv_picmeno; ?>" ><button type="submit" class="btn btn-primary" id="btnBack">
                    <span class="bx bx-arrow-back"></span>&nbsp; Back </button></a>
            </h4>
              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                
                    <hr class="my-0" />
                    <div class="card-body">
                    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } else { echo $type . " display-none"; } ?>"><?php if(!empty($emessage)) { echo $emessage; } ?></div>
                    <br>
                      <form id="formAccountSettings" autocomplete="off" method="POST" onsubmit="return validatePostnalVisit()">
					   <div class="row">
                        <div class="mb-3 col-md-6">
                          <label class="form-label" for="basic-icon-default-fullname">RCHID (PICME) NUMBER <span class="mand">* </span></label>
                          <div class="frmSearch">
                          <input type="number" required id="picmenoPostNalVisit" name="picmeNo" class="form-control" onclick="return validatePostnalVisit()" value=<?php echo $pv_picmeno; ?> hidden />
                          <label class="lblViolet"><?php echo $pv_picmeno; ?>
                              </label>
						  <div id="suggesstion-box"></div>
                      </div>
                      </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label">PNC PERIOD <span class="mand">* </span></label>
                            <select name="pncPeriod" required id="pncPeriod" onclick="return validatePostnalVisit()" class="form-select" disabled>                           
                           <?php 
                           $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=17 AND enumid = '$PNC_period_next'";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } 
                              ?>
                             </select>
                            <div id="pnc-period-box"></div>
                          </div>
                          </div>
                        <div class="row">

                          <div class="mb-3 col-md-6">
                            <label for="zipCode" class="form-label">MOTHER PNC DATE </label>
                            <div class="input-group input-group-merge">
                            <input
                              type="date"
                              class="form-control"
                              id="motherPnc"
                              name="motherPnc"
                              placeholder=""
							  value ="<?php echo $PNC_date; ?>"
                              onclick="return validatePostnalVisit()"
							  disabled
                            />
                          </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label">IFA TABLET</label>
                            <select name="ifaTabletStatus" id="ifaTabletStatus" onclick="return validatePostnalVisit()" class="form-select">
                          <option value="">Choose...</option>
                          <?php $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php  } ?>
                             </select>
                          </div>
                          
                        </div>
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label class="form-label">Calcium</label>
                            <select name="calcium" id="calcium" onclick="return validatePostnalVisit()" class="form-select">
                          <option value="">Choose...</option>
                          <?php $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php  } ?>
                             </select>
                          </div>

                          <div class="mb-3 col-md-6">
                          <label class="form-label">Family Welfare Method Accepted <span class="mand">* </span></label>
                            <select name="ppcMethod" id="ppcMethod" onclick="return validatePostnalVisit()" class="form-select" required>
                          <option value="">Choose...</option>
                          <?php $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=29";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php  }  ?>
                             </select>
                          </div>
                        </div>
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="zipCode" class="form-label">Vitamin A Solution</label>
                            <div class="input-group input-group-merge">
                            <input
                              type="text"
                              class="form-control"
                              id="vitaminA"
                              name="vitaminA"
                              placeholder="Vitamin A Solution"
							  onclick="return validatePostnalVisit()"
                            />
                          </div>
                          </div> 
                          <div class="mb-3 col-md-6">
                          <label class="form-label">MOTHER DANGER SIGN <span class="mand">* </span></label>
                            <select name="motherDangerSign" required id="motherDangerSign" onclick="return validatePostnalVisit()" class="form-select">
                          <option value="">Choose...</option>
                          <?php $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=15";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
                            </div>
                        </div>
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="zipCode" class="form-label">BLOOD SUGAR</label>
                            <div class="input-group input-group-merge">
                            <input
                              type="text"
                              class="form-control"
                              id="bloodSugar"
                              name="bloodSugar"
                              placeholder="BLOOD SUGAR"
                              onclick="return validatePostnalVisit()"
                            />
                          </div>
                          </div> 

                          <div class="mb-3 col-md-6">
                          <label class="form-label">INFANT WEIGHT</label>
                          <input class="form-control" type="number" step="0.001" min="1" max="6" name="infantWeight" id="infantWeight" onclick="return validatePostnalVisit()" />
                           
                            </div>
                        </div>
                        <div class="row">
                          <div class="mb-3 col-md-6">
                          <label class="form-label">INFANT DANGER SIGNS <span class="mand">* </span></label>
                            <select name="infantDangerSigns" required id="infantDangerSigns" onclick="return validatePostnalVisit()" class="form-select">
                          <option value="">Choose...</option>
                          <?php $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=16";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php  } ?>
                             </select>
                            </div>
                            <div class="col-md-6 mb-3">
                          <label class="form-label" for="basic-icon-default-motherWeight">BP Systolic</label>
                          <div class="input-group input-group-merge">
                            <select class="50-200 form-control" id="bpSys" name="bpSys" placeholder="BP SYS" onclick="return validatePostnalVisit()" >
                              <option value="">Choose...</option>
                            </select>
                          </div>
                        </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 mb-3">
                          <label class="form-label" for="basic-icon-default-bpDia">BP Diastolic</label>
                          <div class="input-group input-group-merge">
                            <select class="40-150 form-control" id="bpDia" name="bpDia" onclick="return validatePostnalVisit()" placeholder="BP DIA">
                          <option value="">Choose...</option>
                          </select>
                          </div>
                        </div>
                        </div>
                        <div class="mt-2">
                        <input class="btn btn-primary" type="submit" name="addpostnatal" value="Save" onclick="return validatePostnalVisit()">
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->
<?php include ('require/footer.php'); ?>