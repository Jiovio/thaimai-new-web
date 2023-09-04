<?php include ('require/topHeader.php'); ?>
<?php session_start(); ?>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search
$picmeno = ""; $lmpdate = ""; $edddate = ""; $reg12weeks = ""; $momBGtaken = ""; $momBGtype = ""; $pastillness = "";
$bleedtime = ""; $clottime = ""; 
//$momVdrlRpr =""; 
$momVdrlRprResult=""; 
//$husVdrlRpr=""; 
$husVdrlRprResult=""; 
//$momhbsag=""; 
$momhbresult=""; 
//$hushbsag=""; 
$hushbresult=""; 
//$momhivtest=""; 
$momhivtestresult=""; 
//$hushivtest=""; 
$hushivtestresult=""; 
//$LastPregnancyComplication="";
//$LastPregnancyOutcome=""; 
$anyOtherInvest = ""; 
$totPregnancy;
$placeDeliveryDistrict=""; $hospitaltype=""; $hospitalname=""; 
//$deliveryMode=""; 
$id = 0; $view = false; $update = false;

    if (isset($_GET['view'])) {
		$id = $_GET['view'];
		$view = true;
		$record = mysqli_query($conn, "SELECT * FROM medicalhistory WHERE id=$id");
	  $n = mysqli_fetch_array($record);
    $picmeno = $n["picmeno"]; $lmpdate = $n["lmpdate"]; $edddate = $n["edddate"]; $reg12weeks = $n["reg12weeks"];
    $momBGtaken = $n["momBGtaken"]; $momBGtype = $n["momBGtype"]; $pastillness = $n["pastillness"]; 
    $bleedtime = $n["bleedtime"]; $clottime = $n["clotTime"]; 
    //$momVdrlRpr = $n["momVdrlRpr"];
    $momVdrlRprResult = $n["momVdrlRprResult"];
    //$husVdrlRpr = $n["husVdrlRpr"]; 
    $husVdrlRprResult = $n["husVdrlRprResult"];

    //$momhbsag = $n["momhbsag"]; 
    $momhbresult = $n["momhbresult"]; 
    //$hushbsag = $n["hushbsag"]; 
    $hushbresult = $n["hushbresult"];
    //$momhivtest = $n["momhivtest"]; 
    $momhivtestresult = $n["momhivtestresult"]; 
    //$hushivtest = $n["hushivtest"]; 
    $hushivtestresult = $n["hushivtestresult"];
    $anyOtherInvest = $n["anyOtherInvest"];     //$LastPregnancyComplication = $n["LastPregnancyComplication"]; $LastPregnancyOutcome = $n["LastPregnancyOutcome"]; $deliveryMode = $n["deliveryMode"]; 
    $placeDeliveryDistrict = $n["placeDeliveryDistrict"];
    $totPregnancy = $n["totPregnancy"];
    $hospitaltype = $n["hospitaltype"]; $hospitalname = $n["hospitalname"]; 
}

if (! empty($_POST["update"])) {

  $mname = mysqli_query($conn,"SELECT picmeNo,motheraadhaarname FROM ecregister where picmeNo='".$_POST["picmeno"]."' ");
  
  while($MnameValue = mysqli_fetch_array($mname)) {
    $mn = $MnameValue["motheraadhaarname"];
  
  }
  $id = $_POST['id'];
    $lmpdate = $_POST["lmpdate"]; $edddate = $_POST["edddate"]; $reg12weeks = $_POST["reg12weeks"];
    $momBGtaken = $_POST["momBGtaken"]; $momBGtype = $_POST["momBGtype"]; 
    $pastillness = $_POST["pastillness"]; 
    $bleedtime = $_POST["bleedtime"]; $clottime = $_POST["clotTime"]; 
    $momVdrlRprResult = $_POST["momVdrlRprResult"];
    $husVdrlRprResult = $_POST["husVdrlRprResult"];
    $momhbresult = $_POST["momhbresult"];
    $hushbresult = $_POST["hushbresult"]; 
    $momhivtestresult = $_POST["momhivtestresult"];
    $hushivtestresult = $_POST["hushivtestresult"];
    $anyOtherInvest = $_POST["anyOtherInvest"]; 
    $totPregnancy = $_POST["totPregnancy"];
    $placeDeliveryDistrict = $_POST["placeDeliveryDistrict"];
    $hospitaltype = $_POST["hospitaltype"]; $hospitalname = $_POST["hospitalname"]; 
    date_default_timezone_set('Asia/Kolkata');
    $date = date('d-m-Y h:i:s');
    
    $query = mysqli_query($conn,"UPDATE medicalhistory SET lmpdate='$lmpdate',edddate='$edddate',
    reg12weeks='$reg12weeks',momBGtaken='$momBGtaken',momBGtype='$momBGtype',pastillness='$pastillness',bleedtime='$bleedtime',clotTime='$clottime',
    momVdrlRprResult='$momVdrlRprResult',HusVdrlRprResult='$husVdrlRprResult',
    momhbresult='$momhbresult',Hushbresult='$hushbresult',momhivtestresult='$momhivtestresult',
    Hushivtestresult='$hushivtestresult',anyOtherInvest='$anyOtherInvest',totPregnancy='$totPregnancy',
    placeDeliveryDistrict='$placeDeliveryDistrict',hospitaltype='$hospitaltype',hospitalname='$hospitalname',
    updatedat='$date',updatedBy='$userid' WHERE id=".$id); 
    if(($pastillness !=100) || ($momVdrlRprResult == 1) || ($momhbresult == 1) || ($hushbresult == 1) || ($momhivtestresult == 1) || ($hushivtestresult == 1)) {
    
      $hrqry = mysqli_query($conn,"UPDATE highriskmothers SET picmeNo='$picmeno', motherName='$mn', highRiskFactor='$pastillness' WHERE picmeNo='$picmeno'"); 
        $uqry= mysqli_query($conn,"UPDATE medicalhistory SET highRisk=1 WHERE picmeno='$picmeno'");
      } else {
        $uqry= mysqli_query($conn,"UPDATE highriskmothers SET status=0 WHERE picmeno='$picmeno'");

      }
if (!empty($query)) {
  echo "<script>alert('Updated Successfully');window.location.replace('{$siteurl}/forms/MedicalHistory.php');</script>";
  } }

if (isset($_GET['del'])) {
  $id = $_GET['del'];
 // date_default_timezone_set('Asia/Kolkata');
 // $date = date('d-m-Y h:i:s');
  
 // mysqli_query($conn, "UPDATE medicalhistory SET status=0, deletedat='$date', deletedBy='$userid' WHERE status=1 AND id=$id");
 // $_SESSION['message'] = "User deleted!"; 
  
  $rec_del_pic = mysqli_query($conn, "SELECT * FROM medicalhistory WHERE id = $id");
				          $n_del = mysqli_fetch_array($rec_del_pic);
	          $Del_picmeNo = "";
	          $Del_picmeNo = $n_del['picmeno'];
			  
			  mysqli_query($conn, "DELETE FROM medicalhistory WHERE id=$id");
			  mysqli_query($conn, "DELETE FROM deliverydetails WHERE picmeNo = $Del_picmeNo");
              mysqli_query($conn, "DELETE FROM immunization WHERE picmeNo = $Del_picmeNo");
              mysqli_query($conn, "DELETE FROM postnatalvisit WHERE picmeNo = $Del_picmeNo");
  echo "<script>alert('Deleted Successfully');window.location.replace('{$siteurl}/forms/MedicalHistory.php');</script>";
}
?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
             <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Medical /</span> 
             <?php if($view == true) { 
                echo "View";
              } else {
                echo "Edit";
              } ?> Medical
              
              <a href="MedicalHistory.php"><button type="submit" class="btn btn-primary" id="btnBack">
                    <span class="bx bx-arrow-back"></span>&nbsp; Back
              </button></a>
            <?php if($_SESSION["usertype"] == '0' || $_SESSION["usertype"] == '1' || $_SESSION["usertype"] == '2') { ?>
              <a href="../forms/ViewEditMedical.php?del=<?php echo $id; ?>" onclick="return confirm('Are you sure to delete?')"><button type="submit" class="btn btn-danger btnSpace">
                    <span class="bx bx-minus"></span>&nbsp; Delete
              </button></a>
            <?php } ?>
              <button type="submit" id="edit" class="btn btn-success btnSpace edit" value="<?php echo $id; ?>" onclick="fnMedEnable()">
                    <span class="bx bx-edit"></span>&nbsp; Edit
              </button>

            </h4>
            <form action="" method="post">
              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
						<h4 class="fw-bold"><span class="text-muted fw-light">Medical Details</span></h4>
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
        ?>
				<?php
    }
    ?>
				<div class="errMsg" id="errMsg"></div>
               		<input type="hidden" name="id" value="<?php echo $id; ?>">
					    	<div class="row">
                <div class="mb-3 col-md-6">
                            <label class="form-label">PICME NUMBER <!--<span class="mand">* </span>--></label>
                            <div class="input-group input-group-merge">
                            <!-- <input
                              type="text"
                              class="form-control"
                              id="picmeNo"
                              name="picmeNo"
                              placeholder="PICME NUMBER"
                              value="<?php //echo $picmeNo; ?>"
                              disabled
                              required
                            /> -->
                            <label class="lblViolet"><?php echo $picmeno; ?>
                              </label>
                          </div>
                          </div>
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">LMP DATE <span class="mand">* </span></label>
                            <input
                              type="date"
                              name="lmpdate"
                              id="lmpdate" required
                              class="form-control"
                              placeholder=""
                              aria-label=""
                              aria-describedby="basic-icon-default-email2"
							   <?php $cur_dt = date('Y-m-d', strtotime('+1 year')); ?>
							   min="1970-01-01" max=<?php echo $cur_dt; ?>
                              value="<?php echo $lmpdate; ?>"  
							  disabled
                            />
                          
                        </div>
                        
                  </div>
                        
                  <div class="row">
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">EDD DATE <span class="mand">* </span></label>
                            <input
                              type="text"
                              name="edddate"
                              id="edddate" required
                              class="form-control"
                              placeholder=""
                              aria-label=""
                              aria-describedby="basic-icon-default-password2"
                              value="<?php echo date('m-d-Y', strtotime($edddate)); ?>" 
							  readonly="readonly"
                              disabled
                            />
                          
                        </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">REGISTER 12 WEEKS <span class="mand">* </span></label>
                          <?php if($view == true) { ?>
                          <select name="reg12weeks" id="reg12weeks" class="form-select" required disabled>
                           <?php   
                            $query = mysqli_query($conn, "SELECT m.reg12weeks,e.enumid,e.enumvalue FROM medicalhistory m join enumdata e on m.reg12weeks=e.enumid WHERE type=13 AND m.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$reg12weeks) ?>
                                    <?php { echo $status_list['enumvalue']; } ?>
                                  </option>
                                    <?php 
                                $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                            $exequery = mysqli_query($conn, $dquery);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                              ?>
                          
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php }
                                } ?>
                                </select>
                                <?php } ?>
                          
                        </div>
                        
                    </div>
                        
                        <div class="row">
                         
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER BLOOD GROUP TAKEN</label>
                          <div class="input-group input-group-merge">
                            <?php if($view == true) { ?>
                          <select name="momBGtaken" id="momBGtaken" class="form-select" disabled>
                           <?php   
                            $query = mysqli_query($conn, "SELECT m.momBGtaken,e.enumid,e.enumvalue FROM medicalhistory m join enumdata e on m.momBGtaken=e.enumid WHERE type=20 AND m.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$momBGtaken){ echo "selected"; } ?>
                                    <?php echo $status_list['enumvalue']; ?>
                                    </option>
                                    <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=20";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                                <?php } ?>
                           </div>
                         </div>

                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER BLOOD GROUP TYPE <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <?php if($view == true) { ?>
                          <select name="momBGtype" id="momBGtype" class="form-select" required disabled>

                           <?php   
                            $query = mysqli_query($conn, "SELECT m.momBGtype,e.enumid,e.enumvalue FROM medicalhistory m join enumdata e on m.momBGtype=e.enumid WHERE type=19 AND m.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$momBGtype) ?>
                                    <?php { echo $status_list['enumvalue']; } ?>
                                    </option>
                                    <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=19";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                                <?php } ?>
                      </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">PAST ILLNESS <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                           <?php if($view == true) { ?> 
                          <select required name="pastillness" id="pastillness" class="form-select" disabled>
                           <?php   
                            $query = mysqli_query($conn, "SELECT m.pastillness,e.enumid,e.enumvalue FROM medicalhistory m join enumdata e on m.pastillness=e.enumid WHERE type=21 AND m.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$pastillness) ?>
                                    <?php { echo $status_list['enumvalue']; } ?>
                                    </option>
                                    <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=21";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                                <?php } ?>
                      </div>
                        </div>
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">Bleeding Time </label>
                            <input
                              type="time"
                              name="bleedtime"
                              id="bleedtime"
                              class="form-control"
                              placeholder="Bleeding Time"
                              aria-label="Bleeding Time"
                              aria-describedby="basic-icon-default-email2"
                              value="<?php echo $bleedtime ?>"
                              disabled
                            />
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">clotting Time </label>
                            <input
                              type="time"
                              name="clotTime"
                              id="clotTime"
                              class="form-control"
                              placeholder="clotting Time"
                              aria-label="clotting Time"
                              aria-describedby="basic-icon-default-email2"
                              value="<?php echo $clottime ?>"
                              disabled
                            />
                          </div>

                        <!-- <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER VDRL RPR</label>
                          <div class="input-group input-group-merge">
                            
                          <?php if($view == true) { ?>
                            <select name="momVdrlRpr" id="momVdrlRpr" class="form-select" disabled>
                           <?php   
                            $query = mysqli_query($conn, "SELECT m.momVdrlRpr,e.enumid,e.enumvalue FROM medicalhistory m join enumdata e on m.momVdrlRpr=e.enumid WHERE type=20 AND m.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$momVdrlRpr) ?>
                                    <?php { echo $status_list['enumvalue']; } ?>
                                    </option>
                                    <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=20";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                                <?php } ?>
                      </div>
                        </div> -->
                        
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER VDRl RPR RESULT <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <?php if($view == true) { ?>
                          <select required name="momVdrlRprResult" id="momVdrlRprResult" class="form-select" disabled>
                           <?php   
                            $query = mysqli_query($conn, "SELECT m.momVdrlRprResult,e.enumid,e.enumvalue FROM medicalhistory m join enumdata e on m.momVdrlRprResult=e.enumid WHERE type=26 AND m.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$momVdrlRprResult) ?>
                                    <?php { echo $status_list['enumvalue']; } ?>
                                    </option>
                                    <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=26";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                                <?php } ?>
                      </div>
                        </div>

                        <!-- <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND VDRL RPR</label>
                          <div class="input-group input-group-merge">
                            <?php if($view == true) { ?>
                          <select name="husVdrlRpr" id="husVdrlRpr" class="form-select" disabled>

                           <?php   
                            $query = mysqli_query($conn, "SELECT m.husVdrlRpr,e.enumid,e.enumvalue FROM medicalhistory m join enumdata e on m.husVdrlRpr=e.enumid WHERE type=20 AND m.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$husVdrlRpr) ?>
                                    <?php { echo $status_list['enumvalue']; } ?>
                                    </option>
                                    <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=20";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                                <?php } ?>
                      </div>
                        </div> -->
                        </div>
                        <div class="row">
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND VDRl RPR RESULT <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <?php if($view == true) { ?>
                          <select required name="husVdrlRprResult" id="husVdrlRprResult" class="form-select" disabled>

                           <?php   
                              $query = mysqli_query($conn, "SELECT m.husVdrlRprResult,e.enumid,e.enumvalue FROM medicalhistory m join enumdata e on m.husVdrlRprResult=e.enumid WHERE type=26 AND m.id=".$id);
                              while($status_list=mysqli_fetch_assoc($query)){
                                  ?>
                                      <option value="<?php echo $status_list['enumid']; ?>">
                                      <?php if($status_list['enumvalue']==$husVdrlRprResult) ?>
                                      <?php { echo $status_list['enumvalue']; } ?>
                                      </option>
                                    <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=26";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                                <?php } ?>
                      </div>
                        </div>
                        
                        <!-- <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER HBSAG</label>
                          <div class="input-group input-group-merge">
                            <?php if($view ==  true) { ?>
                          <select name="momhbsag" id="momhbsag" class="form-select" disabled>

                           <?php   
                            $query = mysqli_query($conn, "SELECT m.momhbsag,e.enumid,e.enumvalue FROM medicalhistory m join enumdata e on m.momhbsag=e.enumid WHERE type=20 AND m.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$husVdrlRpr) ?>
                                    <?php { echo $status_list['enumvalue']; } ?>
                                    </option>
                                    <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=20";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                                <?php } ?>
                      </div>
                        </div> -->
                        
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER HBSAG RESULT <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <?php if($view == true) { ?>  
                          <select required name="momhbresult" id="momhbresult" class="form-select" required disabled>
                          
                           <?php   
                            $query = mysqli_query($conn, "SELECT m.momhbresult,e.enumid,e.enumvalue FROM medicalhistory m join enumdata e on m.momhbresult=e.enumid WHERE type=11 AND m.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$momhbresult) ?>
                                    <?php { echo $status_list['enumvalue']; } ?>
                                    </option>
                                    <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=11";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                                <?php } ?>
                      </div>
                        </div>
                        </div>
                        <div class="row">
                        <!-- <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND HBSAG <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <?php if($view == true) { ?>                            
                          <select required name="hushbsag" id="hushbsag" class="form-select" disabled>
                           <?php   
                            $query = mysqli_query($conn, "SELECT m.hushbsag,e.enumid,e.enumvalue FROM medicalhistory m join enumdata e on m.hushbsag=e.enumid WHERE type=20 AND m.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$hushbsag){ echo "selected"; } ?>
                                    <?php echo $status_list['enumvalue']; ?>
                                    </option>
                                    <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=20";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                                <?php } ?>
                      </div>
                        </div> -->
                        
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND HBSAG RESULT <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <?php if($view == true) { ?>  
                          <select required name="hushbresult" id="hushbresult" class="form-select" required disabled>
                           <?php   
                            $query = mysqli_query($conn, "SELECT m.hushbresult,e.enumid,e.enumvalue FROM medicalhistory m join enumdata e on m.hushbresult=e.enumid WHERE type=11 AND m.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$hushbresult) ?>
                                    <?php { echo $status_list['enumvalue']; } ?>
                                    </option>
                                    <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=11";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                                <?php } ?>
                      </div>
                        </div>

                        <!-- <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER HIV TEST</label>
                          <div class="input-group input-group-merge">
                            <?php if($view == true) { ?>
                          <select name="momhivtest" id="momhivtest" class="form-select" disabled>
                           <?php   
                            $query = mysqli_query($conn, "SELECT m.momhivtest,e.enumid,e.enumvalue FROM medicalhistory m join enumdata e on m.momhivtest=e.enumid WHERE type=20 AND m.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$momhivtest) ?>
                                    <?php { echo $status_list['enumvalue']; } ?>
                                    </option>
                                    <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=20";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                                <?php } ?>
                      </div>
                        </div> -->
                        
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">MOTHER HIV TEST RESULT <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <?php if($view == true) { ?>
                          <select required name="momhivtestresult" id="momhivtestresult" class="form-select" required disabled>
                          
                           <?php   
                            $query = mysqli_query($conn, "SELECT m.momhivtestresult,e.enumid,e.enumvalue FROM medicalhistory m join enumdata e on m.momhivtestresult=e.enumid WHERE type=11 AND m.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$momhivtestresult) ?>
                                    <?php { echo $status_list['enumvalue'];} ?>
                                    </option>
                                    <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=11";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                                <?php } ?>
                      </div>
                        </div>
                        </div>
                        <div class="row">
                        <!-- <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND HIV TEST</label>
                          <div class="input-group input-group-merge">
                            <?php if($view == true) { ?>
                          <select name="hushivtest" id="hushivtest" class="form-select" disabled>
                           <?php   
                            $query = mysqli_query($conn, "SELECT m.hushivtest,e.enumid,e.enumvalue FROM medicalhistory m join enumdata e on m.hushivtest=e.enumid WHERE type=20 AND m.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$hushivtest){ echo "selected"; } ?>
                                    <?php echo $status_list['enumvalue']; ?>
                                    </option>
                                    <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                                <?php } ?>
                            </div>
                          </div> -->
                       
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">HUSBAND HIV TEST RESULT <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <?php if($view == true) { ?>
                          <select name="hushivtestresult" id="hushivtestresult" class="form-select" required disabled>
                           <?php   
                            $query = mysqli_query($conn, "SELECT m.hushivtestresult,e.enumid,e.enumvalue FROM medicalhistory m join enumdata e on m.hushivtestresult=e.enumid WHERE type=11 AND m.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$hushivtestresult) ?>
                                    <?php { echo $status_list['enumvalue']; } ?>
                                    </option>
                                    <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=11";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                                <?php } ?>
                      </div>
                        </div>
						
						<div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">Any Other Investigation With Result </label>
                            <input
                              type="text"
                              name="anyOtherInvest"
                              id="anyOtherInvest"
                              class="form-control"
                              placeholder="Any Other Investigation"
                              aria-label="Any Other Investigation"
                              aria-describedby="basic-icon-default-email2"
                              value="<?php  echo $anyOtherInvest ?>"
                              disabled
                            />
                          </div>

                        </div>
                        <div class="row">
                        <!-- <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">LAST PREGNANCY COMPLICATIONS</label>
                          <div class="input-group input-group-merge">
                            <?php if($view == true) { ?>
                          <select name="LastPregnancyComplication" id="LastPregnancyComplication" class="form-select" disabled>

                           <?php   
                            $query = mysqli_query($conn, "SELECT m.LastPregnancyComplication,e.enumid,e.enumvalue FROM medicalhistory m join enumdata e on m.LastPregnancyComplication=e.enumid WHERE type=23 AND m.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$LastPregnancyComplication) ?>
                                    <?php { echo $status_list['enumvalue']; } ?>
                                    </option>
                                    <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=23";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                                <?php } ?>
                      </div>
                        </div> -->
                        <!-- <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">LAST PREGNANCY OUTCOME</label>
                          <div class="input-group input-group-merge">
                          <?php if($view == true) { ?>  
                          <select name="LastPregnancyOutcome" id="LastPregnancyOutcome" class="form-select" disabled>
                          <?php   
                            $query = mysqli_query($conn, "SELECT m.LastPregnancyOutcome,e.enumid,e.enumvalue FROM medicalhistory m join enumdata e on m.LastPregnancyOutcome=e.enumid WHERE type=24 AND m.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$LastPregnancyOutcome) ?>
                                    <?php { echo $status_list['enumvalue']; } ?>
                                    </option>
                                    <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=24";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                                <?php } ?>
                      </div>
                        </div> -->
                        
                        </div>
                        <div class="row">
                        <!-- <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Mode Of Delivery</label>
                          <div class="input-group input-group-merge">
                            <?php if($view == true) { ?>
                          <select name="deliveryMode" id="deliveryMode" class="form-select" disabled>
                           <?php   
                            $query = mysqli_query($conn, "SELECT m.deliveryMode,e.enumid,e.enumvalue FROM medicalhistory m join enumdata e on m.deliveryMode=e.enumid WHERE type=49 AND m.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$deliveryMode) ?>
                                    <?php { echo $status_list['enumvalue']; } ?>
                                    </option>
                                    <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=49";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                                <?php } ?>
                      </div>
                        </div> -->
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Total Number Of Pregnancy <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <?php if($view == true) { ?>
                          <select required name="totPregnancy" id="totPregnancy" class="form-select" disabled>
                           <?php   
                            $query = mysqli_query($conn, "SELECT m.totPregnancy,e.enumid,e.enumvalue FROM medicalhistory m join enumdata e on m.totPregnancy=e.enumid WHERE type=52 AND m.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$totPregnancy) ?>
                                    <?php { echo $status_list['enumvalue']; } ?>
                                    </option>
                                    <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=52";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                                <?php } ?>
                      </div>
                        </div>
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-email">PREVIOUS DELIVERY DISTRICT </label>
                            <input
                              type="text"
                              name="placeDeliveryDistrict"
                              id="placeDeliveryDistrict"
                              class="form-control"
                              placeholder="PREVIOUS DELIVERY DISTRICT"
                              aria-label="PREVIOUS DELIVERY DISTRICT"
                              aria-describedby="basic-icon-default-email2"
                              value="<?php echo $placeDeliveryDistrict ?>"
                              disabled
                            />
                          </div>

                          </div>
                        <div class="row">
                      <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">PLACE OF DELIVERY Recommended <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <?php if($view == true) { ?>
                          <select  required name="hospitaltype" id="hospitaltype" class="form-select" disabled>
                           <?php   
                            $query = mysqli_query($conn, "SELECT m.hospitaltype,e.enumid,e.enumvalue FROM medicalhistory m join enumdata e on m.hospitaltype=e.enumid WHERE type=25 AND m.id=".$id);
                            while($status_list=mysqli_fetch_assoc($query)){
                                ?>
                                    <option value="<?php echo $status_list['enumid']; ?>">
                                    <?php if($status_list['enumvalue']==$hospitaltype) ?>
                                    <?php { echo $status_list['enumvalue']; } ?>
                                    </option>
                                    <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=25";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                                <?php } ?>

                      </div>
                  </div>
                        <div class="col-6 mb-3">
                          <label class="form-label" for="basic-icon-default-password">Recommended HOSPITAL NAME <span class="mand">* </span></label>
                          
                            <input
                              type="text"
                              name="hospitalname"
                              id="hospitalname"
                              class="form-control"
                              placeholder="HOSPITAL NAME"
                              aria-label="HOSPITAL NAME"
                              aria-describedby="basic-icon-default-password2"
                              value="<?php echo $hospitalname ?>"
                              disabled
                            />  
                        </div>
                </div>
                <div class="input-group" id="btnSaUp" style="display:none">
                    <input class="btn btn-primary" type="submit" id="update" name="update" value="Update">
                </div>
              </div>
            </div>
			</div>
			</div><!--Mother Details Close-->
    </form>
<!-- / Content -->
<?php include ('require/footer.php'); ?>
