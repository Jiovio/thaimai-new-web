<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search
if (isset($_GET['view'])) {
  $id = $_GET['view'];
  $view = true;
  $record = mysqli_query($conn, "SELECT * FROM antenatalvisit WHERE id=$id");
  $AnData = mysqli_fetch_array($record);
 
  $record = mysqli_query($conn, "SELECT * FROM antenatalvisit WHERE picmeno=". $AnData['picmeno']." order by id DESC");
  $An = mysqli_fetch_array($record);
  $picmeno = $An["picmeno"]; $residenttype = $An["residenttype"]; 
  $physicalpresent = $An["physicalpresent"]; $placeofvisit = $An["placeofvisit"]; $abortion = $An["abortion"]; 
  $anvisitDate = $An["anvisitDate"]; $ancPeriod = $An["ancPeriod"]; $pregnancyWeek = $An["pregnancyWeek"];
  $motherWeight = $An["motherWeight"]; $bpSys = $An["bpSys"];  $bpDia = $An["bpDia"]; $Hb = $An["Hb"]; 
  $urineTestStatus = $An["urineTestStatus"]; $urineSugarPresent = $An["urineSugarPresent"];
  $urineAlbuminPresent = $An["urineAlbuminPresent"]; $bloodSugartest =$An["bloodSugartest"]; 
  $fastingSugar = $An["fastingSugar"]; $postPrandial = $An["postPrandial"]; 
  $gctStatus = $An["gctStatus"];  $gctValue = $An["gctValue"]; 
  $tsh = $An["Tsh"]; $Td1 = $An["Td1"]; $TdDose = $An["TdDose"]; $Td2 = $An["Td2"]; $Td2Dose = $An["Td2Dose"]; $Td1Date = $An["Td1Date"]; 
  $Tdb = $An["Tdb"]; $TdBdose = $An["TdBdose"]; $TdBoosterDate = $An["TdBoosterDate"]; $Covidvac = $An["Covidvac"]; 
  $Dose1Date = $An["Dose1Date"]; $Dose2Date = $An["Dose2Date"]; $PreDate = $An["PreDate"]; $NoFolicAcid = $An["NoFolicAcid"]; $NoIFA = $An["NoIFA"]; 
  $dateofIFA = $An["dateofIFA"]; $dateofAlbendazole = $An["dateofAlbendazole"]; $noCalcium = $An["noCalcium"];

  $calciumDate = $An["calciumDate"];
  $sizeUterusinWeeks = $An["sizeUterusinWeeks"];
  $methodofConception = $An["methodofConception"]; 
  $AnyOtherSpecify = $An["AnyOtherSpecify"];
  $HighRisk = $An["HighRisk"];
  $symptomsHighRisk = $An["symptomsHighRisk"];
  $referralDate = $An["referralDate"]; $referralDistrict = $An["referralDistrict"];
  $referralFacility = $An["referralFacility"]; $referralPlace = $An["referralPlace"];
//   $usgStatus = $An["usgTakenStatus"]; 
//   $usgtakenStatus = str_replace('..', '', $usgStatus);
$wusgTaken = $An["wusgTaken"];
  $usgStatus = $An["usgreport"]; 
  $usgreport = str_replace('..', '', $usgStatus);
  $usgDoneDate = $An["usgDoneDate"];
  $usgScanEdd = $An["usgScanEdd"];  $usgScanStatus = $An["usgScanStatus"]; $usgFundalHeight = $An["usgFundalHeight"];
  $usgSizeUterusWeek = $An["usgSizeUterusWeek"];
  $usgFetusStatus = $An["usgFetusStatus"];
  $gestationSac = $An["gestationSac"];
  $liquor1 = $An["liquor"];
  $usgFetalHeartRate1 = $An["usgFetalHeartRate"];
  $usgFetalPosition1 = $An["usgFetalPosition"];
  $usgFetalMovement1 = $An["usgFetalMovement"];
  $liquor2 = $An["liquor1"]; 
  $usgFetalHeartRate2 = $An["usgFetalHeartRate1"];
  $usgFetalPosition2 = $An["usgFetalPosition1"]; 
  $usgFetalMovement2 = $An["usgFetalMovement1"];
  $liquor3 = $An["liquor2"]; 
  $usgFetalHeartRate3 = $An["usgFetalHeartRate2"];
  $usgFetalPosition3 = $An["usgFetalPosition2"]; 
  $usgFetalMovement3 = $An["usgFetalMovement2"];
  $placenta = $An["placenta"];
  $usgResult = $An["usgResult"];
  $usgRemarks = $An["usgRemarks"];
  $bloodTransfusion = $An["bloodTransfusion"];
  $bloodTransfusionDate = $An["bloodTransfusionDate"];
  $placeAdministrator = $An["placeAdministrator"];
  $nooIVdoses = $An["noOfIVDoses"];
}

if (! empty($_POST["editVisit"])) {
  $id =$_POST["id"]; $residenttype = $_POST["residenttype"]; 
  $physicalpresent = $_POST["physicalpresent"]; $placeofvisit = $_POST["placeofvisit"]; $abortion = $_POST["abortion"]; 
  $anvisitDate = $_POST["anvisitDate"]; $avduedate = date('d-m-Y', strtotime($anvisitDate. ' + 30 days'));
  $ancPeriod = $_POST["ancPeriod"]; $pregnancyWeek = $_POST["pregnancyWeek"];
  $motherWeight = $_POST["motherWeight"]; $bpSys = $_POST["bpSys"];  $bpDia = $_POST["bpDia"]; $Hb = $_POST["Hb"]; 
  $urineTestStatus = $_POST["urineTestStatus"]; $urineSugarPresent = $_POST["urineSugarPresent"];
  $urineAlbuminPresent = $_POST["urineAlbuminPresent"]; $bloodSugartest =$_POST["bloodSugartest"]; 
  $fastingSugar = $_POST["fastingSugar"]; $postPrandial = $_POST["postPrandial"]; $gctStatus = $_POST["gctStatus"];  $gctValue = $_POST["gctValue"]; 
  $tsh = $_POST["Tsh"]; $Td1 = $_POST["Td1"]; $TdDose = $_POST["TdDose"]; $Td2 = $_POST["Td2"]; $Td2Dose = $_POST["Td2Dose"]; $Td1Date = $_POST["Td1Date"]; 
  $Tdb = $_POST["Tdb"]; $TdBdose = $An["TdBdose"]; $TdBoosterDate = $_POST["TdBoosterDate"]; $Covidvac = $_POST["Covidvac"]; 
  $Dose1Date = $_POST["Dose1Date"]; $Dose2Date = $_POST["Dose2Date"]; $PreDate = $_POST["PreDate"]; 
  $NoFolicAcid = $_POST["NoFolicAcid"]; $NoIFA = $_POST["NoIFA"]; $dateofIFA = $_POST["dateofIFA"]; 
  $dateofAlbendazole = $_POST["dateofAlbendazole"]; $noCalcium = $_POST["noCalcium"];

  $calciumDate = $_POST["calciumDate"];
  $sizeUterusinWeeks = $_POST["sizeUterusinWeeks"];
  $methodofConception = $_POST["methodofConception"]; $AnyOtherSpecify = $_POST["AnyOtherSpecify"]; $HighRisk = $_POST["HighRisk"];
  $symptomsHighRisk = $_POST["symptomsHighRisk"];
  $referralDate = $_POST["referralDate"]; $referralDistrict = $_POST["referralDistrict"];
  $referralFacility = $_POST["referralFacility"]; $referralPlace = $_POST["referralPlace"];
  $wusgTaken = $_POST["wusgTaken"];
  $filename = $_FILES["usgreport"]["name"];
  $tempname = $_FILES["usgreport"]["tmp_name"];
  $folder = "../usgDocument/" . $filename;
 // Now let's move the uploaded image into the folder: image
  move_uploaded_file($tempname, $folder);

  $usgDoneDate = $_POST["usgDoneDate"];
  $usgScanEdd = $_POST["usgScanEdd"]; $usgScanStatus = $_POST["usgScanStatus"]; $usgFundalHeight = $_POST["usgFundalHeight"];
  $usgSizeUterusWeek = $_POST["usgSizeUterusWeek"]; $usgFetusStatus = $_POST["usgFetusStatus"];
  $gestationSac = $_POST["gestationSac"]; $liquor1 = $_POST["liquor"]; $usgFetalHeartRate1 = $_POST["usgFetalHeartRate"];
  $usgFetalPosition1 = $_POST["usgFetalPosition"]; $usgFetalMovement1 = $_POST["usgFetalMovement"]; $liquor2 = $_POST["liquor1"]; 
  $usgFetalHeartRate2 = $_POST["usgFetalHeartRate1"];
  $usgFetalPosition2 = $_POST["usgFetalPosition1"]; 
  $usgFetalMovement2 = $_POST["usgFetalMovement1"];
  $liquor3 = $_POST["liquor2"]; 
  $usgFetalHeartRate3 = $_POST["usgFetalHeartRate2"];
  $usgFetalPosition3 = $_POST["usgFetalPosition2"]; 
  $usgFetalMovement3 = $_POST["usgFetalMovement2"];
  $placenta = $_POST["placenta"];
  $usgResult = $_POST["usgResult"]; $usgRemarks = $_POST["usgRemarks"]; 
  $bloodTransfusion = $_POST["bloodTransfusion"]; $bloodTransfusionDate = $_POST["bloodTransfusionDate"];
  $placeAdministrator = $_POST["placeAdministrator"]; $nooIVdoses = $_POST["noOfIVDoses"];
  date_default_timezone_set('Asia/Kolkata');
  $date = date('d-m-Y h:i:s');
  
  $query = mysqli_query($conn,"UPDATE antenatalvisit SET residenttype='$residenttype',physicalpresent='$physicalpresent',
  placeofvisit='$placeofvisit',abortion='$abortion',anvisitDate='$anvisitDate',avduedate='$avduedate',avTag='1',ancPeriod='$ancPeriod',pregnancyWeek='$pregnancyWeek',
  motherWeight='$motherWeight',bpSys='$bpSys',bpDia='$bpDia',Hb='$Hb',urineTestStatus='$urineTestStatus',
  urineSugarPresent='$urineSugarPresent',urineAlbuminPresent='$urineAlbuminPresent',bloodSugartest='$bloodSugartest',fastingSugar='$fastingSugar',
  postPrandial='$postPrandial',gctStatus='$gctStatus',gctValue='$gctValue',Tsh='$tsh',
  TdDose='$TdDose',Td2Dose='$Td2Dose',Td1Date='$Td1Date',TdBdose='$TdBdose',TdBoosterDate='$TdBoosterDate',covidvac='$Covidvac',Dose1Date='$Dose1Date',Dose2Date='$Dose2Date',
preDate='$PreDate',NoFolicAcid='$NoFolicAcid',NoIFA='$NoIFA',
  DateofIFA='$dateofIFA',DateofAlbendazole='$dateofAlbendazole',noCalcium='$noCalcium',calciumDate='$calciumDate',
  sizeUterusinWeeks='$sizeUterusinWeeks',methodofConception='$methodofConception',AnyOtherSpecify='$AnyOtherSpecify',HighRisk='$HighRisk',symptomsHighRisk='$symptomsHighRisk',referralDate='$referralDate',
  referralDistrict='$referralDistrict',referralFacility='$referralFacility',referralPlace='$referralPlace',wusgTaken='$wusgTaken',usgreport='$filename',
  usgDoneDate='$usgDoneDate',usgScanEdd='$usgScanEdd',usgScanStatus='$usgScanStatus',usgFundalHeight='$usgFundalHeight',
  usgSizeUterusWeek='$usgSizeUterusWeek',usgFetusStatus='$usgFetusStatus',gestationSac='$gestationSac',liquor='$liquor1',
  usgFetalHeartRate='$usgFetalHeartRate1',usgFetalPosition='$usgFetalPosition1',usgFetalMovement='$usgFetalMovement1',liquor1='$liquor2',
usgFetalHeartRate1='$usgFetalHeartRate2',usgFetalPosition1='$usgFetalPosition2',usgFetalMovement1='$usgFetalMovemen2',liquor2='$liquor3',
usgFetalHeartRate2='$usgFetalHeartRate3',usgFetalPosition2='$usgFetalPosition3',usgFetalMovement2='$usgFetalMovement3',placenta='$placenta',
  usgResult='$usgResult',usgRemarks='$usgRemarks',bloodTransfusion='$bloodTransfusion',
  bloodTransfusionDate='$bloodTransfusionDate',placeAdministrator='$placeAdministrator',noOfIVDoses='$nooIVdoses',
  updatedat='$date',updatedBy='$userid' WHERE id=".$id);
  if (!empty($query)) {
            echo "<script>alert('Updated Successfully');window.location.replace('{$siteurl}/forms/AntenatalVisit.php');</script>";
          }
          $highrisk = mysqli_query($conn, "UPDATE ecregister ec INNER JOIN antenatalvisit av ON ec.picmeNo=av.picmeno SET ec.status=6 WHERE av.symptomsHighRisk NOT IN('1','48') AND av.picmeNo=".$picmeno);
}
if(($symptomsHighRisk !=47) && ($symptomsHighRisk !=48)) {
      
  $getMname = mysqli_query($conn,"SELECT motheraadhaarname FROM ecregister WHERE picmeNo='$picmeno'");
  while($value = mysqli_fetch_array($getMname)) {
      $mn = $value["motheraadhaarname"];
  }
  $hrqry = mysqli_query($conn,"INSERT INTO highriskmothers (picmeNo, motherName, highRiskFactor) 
  VALUES ('$picmeno','$mn','$symptomsHighRisk')"); 
  $uqry= mysqli_query($conn,"UPDATE antenatalvisit SET highRiskStatus=1 WHERE picmeno='$picmeno'");
} else {
  $uqry= mysqli_query($conn,"UPDATE highriskmothers SET status=0 WHERE picmeno='$picmeno'");
}
if (isset($_GET['del'])) {
  $id = $_GET['del'];
  date_default_timezone_set('Asia/Kolkata');
  $date = date('d-m-Y h:i:s');
  mysqli_query($conn, "UPDATE antenatalvisit SET status=0, deletedat='$date', deletedBy='$userid' WHERE status=1 AND id=$id");
  $_SESSION['message'] = "User deleted!"; 
    echo "<script>alert('Deleted Successfully');window.location.replace('{$siteurl}/forms/AntenatalVisit.php');</script>";
}
?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Antenatal Visit /</span> View Antenatal Visit
              <a href="AntenatalVisit.php"><button type="submit" class="btn btn-primary" id="btnBack">
                    <span class="bx bx-arrow-back"></span>&nbsp; Back
              </button></a>

              <?php if($_SESSION["usertype"] == '0' || $_SESSION["usertype"] == '1' || $_SESSION["usertype"] == '2') { ?>
              <a href="../forms/ViewEditAnVisit.php?del=<?php echo $id; ?>" onclick="return confirm('Are you sure to delete?')"><button type="submit" class="btn btn-danger btnSpace">
                    <span class="bx bx-minus"></span>&nbsp; Delete
              </button></a>
              <?php } ?>
              <button type="submit" id="edit" class="btn btn-success btnSpace edit" value="<?php echo $id; ?>" onclick="fnAnVisitEnable()" >
                    <span class="bx bx-edit"></span>&nbsp; Edit
              </button>
			</h4>
      
			<!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <small class="float-end"><span class="mand">* </span> Fields are Mandatory</small>
                    </div>
                  <h5 class="mb-0">
                    
                    <div class="card-body">
      
	<div class="errMsg" id="errMsg"></div>
  <form action=""  enctype="multipart/form-data" method="POST">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
					<div class="row">
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-picmeno">PICME No. <!--<span class="mand">* </span>--> <span style="color:red" class= "Pmessage" id="Pmessage"></span></label>
                          <div class="input-group input-group-merge">
                          <label class="lblViolet"><?php echo $picmeno; ?>
                              </label>
                          </div>
                        </div>
						            <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-phone">Resident Type  <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required name="residenttype" id="residenttype" class="form-select" disabled>
                           <?php   
                             $query = "SELECT av.residenttype,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.residenttype WHERE type=10 AND av.id=".$id;
                             $exequery = mysqli_query($conn, $query);
                             while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                           <option value="<?php echo $listvalue['enumid']; ?>">
                           <?php if($listvalue['enumvalue']==$residenttype) ?>
                          <?php { echo $listvalue['enumvalue']; } ?>
                          <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=10";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
						              </div>
					              </div>
          
						            <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-physicalpresent">Physical Present<span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required name="physicalpresent" id="physicalpresent" class="form-select" disabled>
                           <?php   
                            $query = "SELECT av.physicalpresent,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.physicalpresent WHERE type=13 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$physicalpresent) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                          </div>
                          </div>
          
						             <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-placeofvisit">Place of Visit <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required name="placeofvisit" id="placeofvisit" class="form-select" disabled>
                           <?php   
                            $query = "SELECT av.placeofvisit,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.placeofvisit WHERE type=25 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$placeofvisit) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=25";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                          </div>
                          </div>
                    
						              <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-abortion">Abortion <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required name="abortion" id="abortion" class="form-select" disabled>
                           <?php   
                            $query = "SELECT av.abortion,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.abortion WHERE type=13 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$abortion) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
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
                              value="<?php echo $anvisitDate ?>"
                              disabled
                              required
                            />
                          </div>
                        </div>
						            <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-ancPeriod">Antenatal Period <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <select class="40-150 form-control" id="ancPeriod" name="ancPeriod" placeholder="Antenatal Period" required disabled>
                            <?php

                              $list=mysqli_query($conn, "SELECT ancPeriod from antenatalvisit WHERE id=".$id);
                              while($row_list=mysqli_fetch_assoc($list)){

                              ?>
                              <option value="<?php echo $row_list['ancPeriod']; ?>">

                              <?php if($row_list['ancPeriod']==$ancPeriod) ?>

                              <?php { echo $row_list['ancPeriod']; } ?></option>
                              <?php } ?>
                              </select>
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
                              value="<?php echo $pregnancyWeek ?>"
                              disabled
                              required
                            />
                          </div>
                        </div>
					             <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-motherWeight">Mother Weight <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <input
                            required
                              type="text"
                              name="motherWeight"
                              class="form-control"
                              id="motherWeight"
                              placeholder="Mother Weight"
                              aria-label="Mother Weight"
                              aria-describedby="basic-icon-default-motherWeight"
                              value="<?php echo $motherWeight ?>"
                              disabled
                            />
                          </div>
                        </div>
						             <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-motherWeight">BP Systolic <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <select class="50-200 form-control" id="bpSys" name="bpSys" placeholder="BP SYS" required disabled>
                            <?php

                            $list=mysqli_query($conn, "SELECT bpSys from antenatalvisit WHERE id=".$id);
                            while($row_list=mysqli_fetch_assoc($list)){

                            ?>
                            <option value="<?php echo $row_list['bpSys']; ?>">

                            <?php if($row_list['bpSys']==$bpSys) ?>

                            <?php { echo $row_list['bpSys']; } ?></option>
                            <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-bpDia">BP Diastolic <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <select class="40-150 form-control" id="bpDia" name="bpDia" placeholder="BP DIA" required disabled>
                            <?php

                              $list=mysqli_query($conn, "SELECT bpDia from antenatalvisit WHERE id=".$id);
                              while($row_list=mysqli_fetch_assoc($list)){

                              ?>
                              <option value="<?php echo $row_list['bpDia']; ?>">

                              <?php if($row_list['bpDia']==$bpDia) ?>

                              <?php { echo $row_list['bpDia']; } ?></option>
                              <?php } ?>
                              </select>
                          </div>
                        </div>
						<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-Hb">Hb <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <input
                            required
                              type="text"
                              name="Hb"
                              class="form-control"
                              id="Hb"
                              placeholder="Hb"
                              aria-label="Hb"
                              aria-describedby="basic-icon-default-Hb"
                              value="<?php echo $Hb ?>"
                              disabled
                            />
                          </div>
                        </div>
						<div class="col-4 mb-3">
                            <label class="form-label" for="basic-icon-default-urineTestStatus">Urine Test Status <span class="mand">* </span></label>
                            <div class="input-group input-group-merge">
                            <select onchange="UrinetestChange()" required name="urineTestStatus" id="urineTestStatus" class="form-select" disabled>
                           <?php   
                            $query = "SELECT av.urineTestStatus,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.urineTestStatus WHERE type=13 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$urineTestStatus) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                            </div>
                          </div>
                          <div class="col-4 mb-3" id="urineSP">
                            <label class="form-label" for="basic-icon-default-urineSugarPresent">Urine Sugar Present <!--<span class="mand">* </span>--></label>
                            <div class="input-group input-group-merge">
                              <select name="urineSugarPresent" id="urineSugarPresent" class="form-select" disabled>
                           <?php   
                            $query = "SELECT av.urineSugarPresent,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.urineSugarPresent WHERE type=13 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$urineSugarPresent) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                            </div>
                          </div>
                          <div class="col-4 mb-3" id="urineAP">
                            <label class="form-label" for="basic-icon-default-urineAlbuminPresent">Urine Albumin Present <!--<span class="mand">* </span>--></label>
                            <div class="input-group input-group-merge">
                            <select name="urineAlbuminPresent" id="urineAlbuminPresent" class="form-select" disabled>
                           <?php   
                            $query = "SELECT av.urineAlbuminPresent,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.urineAlbuminPresent WHERE type=13 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$urineAlbuminPresent) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                            </div>
                          </div>
				              
						            <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-fastingSugar">Fasting Sugar</label>
                          <div class="input-group input-group-merge">
                            <select class="60-400 form-control" id="fastingSugar" name="fastingSugar" disabled>
                            <?php

                              $list=mysqli_query($conn, "SELECT fastingSugar from antenatalvisit WHERE id=".$id);
                              while($row_list=mysqli_fetch_assoc($list)){

                              ?>
                              <option value="<?php echo $row_list['fastingSugar']; ?>">

                              <?php if($row_list['fastingSugar']==$fastingSugar) ?>

                              <?php { echo $row_list['fastingSugar']; } ?></option>
                              <?php } ?>
                              </select>
                          </div>
                        </div>
						             <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-postPrandial">Post Prandial</label>
                          <div class="input-group input-group-merge">
                            <select class="60-400 form-control" id="postPrandial" name="postPrandial" disabled>
                            <?php

                              $list=mysqli_query($conn, "SELECT postPrandial from antenatalvisit WHERE id=".$id);
                              while($row_list=mysqli_fetch_assoc($list)){

                              ?>
                              <option value="<?php echo $row_list['postPrandial']; ?>">

                              <?php if($row_list['postPrandial']==$postPrandial) ?>

                              <?php { echo $row_list['postPrandial']; } ?></option>
                              <?php } ?>
                              </select>
                          </div>
                        </div>
						            
						            <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-gctStatus">GCT Week Status <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required name="gctStatus" id="gctStatus" class="form-select" onchange="usgChange()" disabled>
                          <!-- <option value="">Choose...</option> -->
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=46";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                            <option value="<?php echo $listvalue['enumid']; ?>" <?php if($gctStatus==$listvalue['enumid']) { echo "Selected"; } ?> ><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
                          </div>
                        </div>
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-gctValue">GCT Value <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <select class="60-400 form-control" id="gctValue" name="gctValue" required disabled>
                            <?php

                              $list=mysqli_query($conn, "SELECT gctValue from antenatalvisit WHERE id=".$id);
                              while($row_list=mysqli_fetch_assoc($list)){

                              ?>
                              <option value="<?php echo $row_list['gctValue']; ?>">

                              <?php if($row_list['gctValue']==$gctValue) ?>

                              <?php { echo $row_list['gctValue']; } ?></option>
                              <?php } ?>
                              </select>
                          </div>
                        </div>
						  <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-Tsh">TSH</label>
                          <div class="input-group input-group-merge">
                            <select class="60-400 form-control" id="Tsh" name="Tsh" disabled>
                            <?php

                              $list=mysqli_query($conn, "SELECT Tsh from antenatalvisit WHERE id=".$id);
                              while($row_list=mysqli_fetch_assoc($list)){

                              ?>
                              <option value="<?php echo $row_list['Tsh']; ?>">

                              <?php if($row_list['Tsh']==$Tsh) ?>

                              <?php { echo $row_list['Tsh']; } ?></option>
                              <?php } ?>
                              </select>
                          </div>
                          </div>
                          <div class="col-4 mb-3"  style="display:none">
                          <label class="form-label" for="basic-icon-default-TdBoosterDate">Td1 (Yes / No) <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required name="Td1" id="Td1" class="form-select" onchange="Td1Change()" disabled>
                          <!-- <option value="">Choose...</option> -->
                           <?php   
                            $query = "SELECT av.Td1,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.Td1 WHERE type=13 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$Td1) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                          </div>
                        </div>
                
					   <div class="col-4 mb-3"  id="Tddose1"  style="display:none">
                          <label class="form-label" for="basic-icon-default-TdDose">Td1 Dose</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="TdDose"
                              class="form-control"
                              id="TdDose"
                              placeholder="Td Dose"
                              aria-label="Td Dose"
                              aria-describedby="basic-icon-default-TdDose"
                              value="<?php echo $TdDose ?>"
                              disabled
                            />
                          </div>
                        </div>
                        <div class="col-4 mb-3" id="Tddate1"  style="display:none">
                          <label class="form-label" for="basic-icon-default-Td1Date">Td1 Date</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="Td1Date"
                              class="form-control"
                              id="Td1Date"
                              placeholder="Td1 Date"
                              aria-label="Td1 Date"
                              aria-describedby="basic-icon-default-Td1Date"
                              value="<?php echo $Td1Date ?>"
                              disabled
                            />
                          </div>
                        </div>
                        <div class="col-4 mb-3"  style="display:none">
                          <label class="form-label" for="basic-icon-default-TdBoosterDate">Td2 (Yes / No) <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required name="Td2" id="Td2" class="form-select" onchange="Td2Change()" disabled>
                          <!-- <option value="">Choose...</option> -->
                           <?php   
                            $query = "SELECT av.Td2,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.Td2 WHERE type=13 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$Td2) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                          </div>
                        </div>

                        <div class="col-4 mb-3" id="Tddose2" style="display:none">
                          <label class="form-label" for="basic-icon-default-TdDose">Td2 Dose</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="Td2Dose"
                              class="form-control"
                              id="Td2Dose"
                              placeholder="Td Dose"
                              aria-label="Td Dose"
                              aria-describedby="basic-icon-default-TdDose"
                              value="<?php echo $Td2Dose ?>"
                              disabled
                            />
                          </div>
                        </div>
                        <div class="col-4 mb-3"  id="Tddate2" style="display:none">
                          <label class="form-label" for="basic-icon-default-Td1Date">Td2 Date</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="Td2Date"
                              class="form-control"
                              id="Td2Date"
                              placeholder="Td1 Date"
                              aria-label="Td1 Date"
                              aria-describedby="basic-icon-default-Td1Date"
                              value="<?php echo $Td2Date ?>"
                              disabled
                            />
                          </div>
                        </div>
				<div class="col-4 mb-3" style="display:none">
                          <label class="form-label" for="basic-icon-default-TdBoosterDate">Td Booster (Yes / No) <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required name="Tdb" id="Tdb" class="form-select" onchange="TdBChange()" disabled>
                          <!-- <option value="">Choose...</option> -->
                           <?php   
                            $query = "SELECT av.Tdb,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.Tdb WHERE type=13 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$Tdb) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                          </div>
                        </div>
                        <div class="col-4 mb-3" id="Bdose">
                          <label class="form-label" for="basic-icon-default-Td2Dose">Booster Dose </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="TdBdose"
                              class="form-control"
                              id="TdBdose"
                              placeholder="Booster Dose"
                              aria-label="Booster Dose"
                              aria-describedby="basic-icon-default-TdDose"
                              value="<?php echo $TdBdose; ?>" disabled
                              />
                          </div>
                        </div>
						<div class="col-4 mb-3" id="TdB" style="display:none">
                          <label class="form-label" for="basic-icon-default-TdBoosterDate">Td Booster Date</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="TdBoosterDate"
                              class="form-control"
                              id="TdBoosterDate"
                              placeholder="Td Booster Date"
                              aria-label="Td Booster Date"
                              aria-describedby="basic-icon-default-TdBoosterDate"
                              value="<?php echo $TdBoosterDate ?>"
                              disabled
                            />
                          </div>
                        </div>
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-TdBoosterDate">Covid vaccination <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required name="Covidvac" id="Covidvac" class="form-select" onchange="CovidChange()" disabled>
                           <?php
                            $query = "SELECT av.Covidvac,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.Covidvac WHERE type=47 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$Covidvac) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=47";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                          </div>
                        </div>
                        <div class="col-4 mb-3" id="dose1" style="display: none;">
                          <label class="form-label" for="basic-icon-default-Dose1Date">Dose1 Date </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="Dose1Date"
                              class="form-control"
                              id="Dose1Date"
                              placeholder="Dose1 Date"
                              aria-label="Dose1 Date"
                              aria-describedby="basic-icon-default-Dose1Date"
                              value="<?php echo $Dose1Date ?>"
                              disabled
                              />
                          </div>
                        </div>
                        <div class="col-4 mb-3" id="dose2" style="display: none;" >
                          <label class="form-label" for="basic-icon-default-Dose2Date">Dose2 date </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="Dose2Date"
                              class="form-control"
                              id="Dose2Date"
                              placeholder="Dose2 Date"
                              aria-label="Dose2 Date"
                              aria-describedby="basic-icon-default-Dose2Date"
                              value="<?php echo $Dose2Date ?>"
                              disabled
                              />
                          </div>
                        </div>
                        <div class="col-4 mb-3" id="predose" style="display: none;">
                          <label class="form-label" for="basic-icon-default-PreDate">Precaution Dose Date </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="PreDate"
                              class="form-control"
                              id="PreDate"
                              placeholder="Td1 Date"
                              aria-label="Td1 Date"
                              aria-describedby="basic-icon-default-PreDate"
                              value="<?php echo $PreDate ?>"
                              disabled
                              />
                          </div>
                        </div>
                
						            <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-NoFolicAcid">Number of Folic Acid</label>
                          <div class="input-group input-group-merge">
                            <select class="1-50 form-control" id="NoFolicAcid" name="NoFolicAcid" disabled>
                            <?php

                              $list=mysqli_query($conn, "SELECT NoFolicAcid from antenatalvisit WHERE id=".$id);
                              while($row_list=mysqli_fetch_assoc($list)){

                              ?>
                              <option value="<?php echo $row_list['NoFolicAcid']; ?>">

                              <?php if($row_list['NoFolicAcid']==$NoFolicAcid) ?>

                              <?php { echo $row_list['NoFolicAcid']; } ?></option>
                              <?php } ?>
                              </select>
                          </div>
                        </div>
					            	<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-NoIFA">Number of IFA</label>
                          <div class="input-group input-group-merge">
                            <select class="1-50 form-control" id="NoIFA" name="NoIFA" disabled>
                            <?php

                              $list=mysqli_query($conn, "SELECT NoIFA from antenatalvisit WHERE id=".$id);
                              while($row_list=mysqli_fetch_assoc($list)){

                              ?>
                              <option value="<?php echo $row_list['NoIFA']; ?>">

                              <?php if($row_list['NoIFA']==$NoIFA) ?>

                              <?php { echo $row_list['NoIFA']; } ?></option>
                              <?php } ?>
                              </select>
                          </div>
                        </div>
						              <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-dateofIFA">Date Of IFA</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="dateofIFA"
                              class="form-control"
                              id="dateofIFA"
                              placeholder="Date Of IFA"
                              aria-label="Date Of IFA"
                              aria-describedby="basic-icon-default-dateofIFA"
                              value="<?php echo $dateofIFA ?>"
                              disabled
                            />
                          </div>
                        </div>
                        
					             <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-dateofAlbendazole">Date Of Albendazole</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="dateofAlbendazole"
                              class="form-control"
                              id="dateofAlbendazole"
                              placeholder="Date Of Albendazole"
                              aria-label="Date Of Albendazole"
                              aria-describedby="basic-icon-default-dateofAlbendazole"
                              value="<?php echo $dateofAlbendazole ?>"
                              disabled
                            />
                          </div>
                        </div>
						           <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-noCalcium">No. of Calcium</label>
                          <div class="input-group input-group-merge">
                            <select class="1-50 form-control" id="noCalcium" name="noCalcium" disabled>
                            <?php

                              $list=mysqli_query($conn, "SELECT noCalcium from antenatalvisit WHERE id=".$id);
                              while($row_list=mysqli_fetch_assoc($list)){

                              ?>
                              <option value="<?php echo $row_list['noCalcium']; ?>">

                              <?php if($row_list['noCalcium']==$noCalcium) ?>

                              <?php { echo $row_list['noCalcium']; } ?></option>
                              <?php } ?>
                              </select>
                          </div>
                        </div>
						             <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-calciumDate">Calcium Date</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="calciumDate"
                              class="form-control"
                              id="calciumDate"
                              placeholder="Calcium Date"
                              aria-label="Calcium Date"
                              aria-describedby="basic-icon-default-calciumDate"
                              value="<?php echo $calciumDate ?>"
                              disabled
                            />
                          </div>
                        </div>
                        
					            	<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-sizeUterusinWeeks">Uterus Size In Weeks <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <input
                            required
                              type="text"
                              name="sizeUterusinWeeks"
                              class="form-control"
                              id="sizeUterusinWeeks"
                              placeholder="Size Uterus In Weeks"
                              aria-label="Size Uterus In Weeks"
                              aria-describedby="basic-icon-default-sizeUterusinWeeks"
                              value="<?php echo $sizeUterusinWeeks ?>"
                              disabled
                            />
                          </div>
                        </div>
                          
						            <div class="col-4 mb-3" >
                          <label class="form-label" for="basic-icon-default-physicalpresent">Whether USG Taken <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select required name="wusgTaken" id="wusgTaken" class="form-select" onchange="usgChange()" disabled>
                          <!-- <option value="">Choose...</option> -->
                          <?php
                                $list=mysqli_query($conn, "SELECT av.wusgTaken,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.wusgTaken WHERE type=13 AND av.id=".$id);

                                while($row_list=mysqli_fetch_assoc($list)){

                                ?>

                                <option value="<?php echo $row_list['enumid']; ?>">

                                <?php if($row_list['enumvalue']== $wusgTaken)?>
                                
                                <?php { echo $row_list['enumvalue']; } ?></option>
                                <?php 
                                $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                              ?>
                          
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } } ?>
                           </select>
                          </div>
                          </div>
                          
                        <div class="col-4 mb-3" id="takenStatus" >
                          <label class="form-label" for="basic-icon-default-usgDoneDate">USG Report</label>
                           <a href="<?php echo $siteurl."/usgDocument/".$usgreport; ?>" target="_blank"><button type="button" class="btn btn btn-primary">View USG Status</button></a>
                          <div class="input-group input-group-merge">
                            <input
                              type="file"
                              name="usgreport"
                              class="form-control"
                              id="usgreport"
                              placeholder="USG Taken Status"
                              aria-label="USG Taken Status"
                              aria-describedby="basic-icon-default-usgDoneDate"
                              accept="image/png, image/jpeg, application/pdf"
                              disabled
                            />
                          </div>
                        </div>
						 <div class="col-4 mb-3" id="usgDoneDate" >
                          <label class="form-label" for="basic-icon-default-usgDoneDate">USG Done Date</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="usgDoneDate"
                              class="form-control"
                              id="usgDDate"
                              placeholder="USG Done Date"
                              aria-label="USG Done Date"
                              aria-describedby="basic-icon-default-usgDoneDate"
                              value="<?php echo $usgDoneDate ?>"
                              disabled
                            />
                          </div>
                        </div>
                        
						<div class="col-4 mb-3" id="usgScanEdd" >
                          <label class="form-label" for="basic-icon-default-usgScanEdd">USG Scan Edd</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgScanEdd"
                              class="form-control"
                              id="ScanEdd"
                              placeholder="USG Scan Edd"
                              aria-label="USG Scan Edd"
                              aria-describedby="basic-icon-default-usgScanEdd"
                              value="<?php echo $usgScanEdd ?>"
                              disabled
                            />
                          </div>
                        </div>
                        <div class="row">
					            <div class="col-4 mb-3" id="usgScanStatus" >
                          <label class="form-label" for="basic-icon-default-usgTrimester">USG Scan Status</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgScanStatus" id="ScanStatus" class="form-select" disabled>
                          <?php
                            $query = "SELECT av.usgScanStatus,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.usgScanStatus WHERE type=48 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$usgScanStatus) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=48";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                          </div>
                        </div>
			        	<div class="col-4 mb-3" id="usgFundalHeight" >
                          <label class="form-label" for="basic-icon-default-usgFundalHeight">USG FUNDAL HEIGHT</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgFundalHeight"
                              class="form-control"
                              id="FundalHeight"
                              placeholder="USG Fundal Height"
                              aria-label="USG Fundal Height"
                              aria-describedby="basic-icon-default-usgFundalHeight"
                              value="<?php echo $usgFundalHeight ?>"
                              disabled
                            />
                          </div>
                        </div>
                        			
						 <div class="col-4 mb-3" id="usgSizeUterusWeek" >
                          <label class="form-label" for="basic-icon-default-usgSizeUterusWeek">USG Size Uterus Week</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgSizeUterusWeek"
                              class="form-control"
                              id="SizeUterusWeek"
                              placeholder="USG Size Uterus"
                              aria-label="USG Size Uterus"
                              aria-describedby="basic-icon-default-usgSizeUterusWeek"
                              value="<?php echo $usgSizeUterusWeek ?>"
                              disabled
                              />
                          </div>
                        </div>
                        
						           <div class="col-4 mb-3" id="usgFetusStatus" >
                          <label class="form-label" for="basic-icon-default-phone">USG Fetus Status</label>
                          <div class="input-group input-group-merge">
                          <select name="usgFetusStatus" id="FetusStatus" class="form-select" disabled>
                          <?php
                            $query = "SELECT av.usgFetusStatus,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.usgFetusStatus WHERE type=30 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$usgFetusStatus) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=30";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
						  </div>
					    </div>
			            <div class="col-4 mb-3" id="gestationSac" >
                          <label class="form-label" for="basic-icon-default-phone">Gestation Sac</label>
                          <div class="input-group input-group-merge">
                          <select name="gestationSac" id="gestation" class="form-select" onchange="gsacField()" disabled>
                          <?php
                            $query = "SELECT av.gestationSac,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.gestationSac WHERE type=31 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$gestationSac){ echo "selected"; } ?>
                         <?php echo $listvalue['enumvalue']; ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=31";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
						             </div>
					             </div>
                           
						         <div class="col-4 mb-3 liquor" id="liquor1" >
                          <label class="form-label" for="basic-icon-default-liquor">Liquor 1</label>
                          <div class="input-group input-group-merge">
                          <select name="liquor" id="liquorop" class="form-select" disabled>
                          <?php
                            $query = "SELECT av.liquor,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.liquor WHERE type=28 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$liquor1) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=28";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
						            </div>
					            </div>

					          	<div class="col-4 mb-3 FetalHeartRate" id="usgFetalHeartRate1" >
                          <label class="form-label" for="basic-icon-default-usgFetalHeartRate">USG FOETAL Heart Rate 1</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgFetalHeartRate"
                              class="form-control"
                              id="usgFetalHeartRate"
                              placeholder="USG FOETAL Heart Rate"
                              aria-label="USG FOETAL Heart Rate"
                              aria-describedby="basic-icon-default-usgFetalHeartRate"
                              value="<?php echo $usgFetalHeartRate1 ?>"
                              disabled
                            />
                          </div>
                        </div>
                        
					            	<div class="col-4 mb-3 FetalPosition" id="usgFetalPosition1" >
                          <label class="form-label" for="basic-icon-default-usgFetalPosition">USG FOETAL Presentation 1</label>
                          <div class="input-group input-group-merge">
                          <select name="usgFetalPosition" id="usgFetalPosition" class="form-select" disabled>

                            <?php
                            $query = "SELECT av.usgFetalPosition,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.usgFetalPosition WHERE type=32 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$usgFetalPosition1) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=32";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                          </div>
                        </div>
                        
					            	<div class="col-4 mb-3 FetalMovement" id="usgFetalMovement1" >
                          <label class="form-label" for="basic-icon-default-usgFetalMovement">USG FOETAL Movement 1</label>
                          <div class="input-group input-group-merge">
                          <select name="usgFetalMovement" id="usgFetalMovement" class="form-select" disabled>

                            <?php
                          $query = "SELECT av.usgFetalMovement,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.usgFetalMovement WHERE type=28 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$usgFetalMovement1) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=28";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                          </div>
                        </div>

                        <div class="col-4 mb-3" id="liquor2" class="liquor2" >
                          <label class="form-label" for="basic-icon-default-liquor">Liquor 2</label>
                          <div class="input-group input-group-merge">
                          <select  name="liquor1" id="liquor1value" class="form-select" disabled>
                          <!-- <option value="">Choose...</option> -->
                          <?php
                            $query = "SELECT av.liquor1,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.liquor1 WHERE type=28 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$liquor2) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=28";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
						            </div>
					            </div>
                      
					          	<div class="col-4 mb-3" id="usgFetalHeartRate2" class="usgFetalHeartRate2" >
                          <label class="form-label" for="basic-icon-default-usgFetalHeartRate">USG FOETAL Heart Rate 2</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgFetalHeartRate1"
                              class="form-control"
                              id="usgFetalHeartRate1value"
                              placeholder="USG FOETAL Heart Rate"
                              aria-label="USG FOETAL Heart Rate"
                              aria-describedby="basic-icon-default-usgFetalHeartRate"
                              value="<?php echo $usgFetalHeartRate2 ?>"
                              disabled
                              />
                          </div>
                        </div>
                       
					            	<div class="col-4 mb-3" id="usgFetalPosition2" class="usgFetalPosition2" >
                          <label class="form-label" for="basic-icon-default-usgFetalPosition">USG FOETAL Presentation 2</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFetalPosition1" id="usgFetalPosition1value" class="form-select" disabled>
                          <!-- <option value="">Choose...</option> -->
                          <?php
                            $query = "SELECT av.usgFetalPosition1,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.usgFetalPosition1 WHERE type=32 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$usgFetalPosition2) ?>
                         <?php {echo $listvalue['enumvalue']; }  ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=32";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                          </div>
                        </div> 
					            	<div class="col-4 mb-3" id="usgFetalMovement2" class="usgFetalMovement2" >
                          <label class="form-label" for="basic-icon-default-usgFetalMovement">USG FOETAL Movement 2</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFetalMovement1" id="usgFetalMovement1value" class="form-select" disabled>
                          <!-- <option value="">Choose...</option> -->
                          <?php
                          $query = "SELECT av.usgFetalMovement1,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.usgFetalMovement1 WHERE type=28 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$usgFetalMovement2) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=28";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                          </div>
                        </div>

                        <div class="col-4 mb-3" id="liquor3" class="liquor3" >
                          <label class="form-label" for="basic-icon-default-liquor">Liquor 3</label>
                          <div class="input-group input-group-merge">
                          <select  name="liquor2" id="liquor2value" class="form-select" disabled>
                          <!-- <option value="">Choose...</option> -->
                          <?php
                            $query = "SELECT av.liquor2,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.liquor2 WHERE type=28 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$liquor3) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=28";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
						            </div>
					            </div>
                      
					          	<div class="col-4 mb-3" id="usgFetalHeartRate3" class="usgFetalHeartRate3" >
                          <label class="form-label" for="basic-icon-default-usgFetalHeartRate">USG FOETAL Heart Rate 3</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgFetalHeartRate2"
                              class="form-control"
                              id="usgFetalHeartRate2value"
                              placeholder="USG FOETAL Heart Rate"
                              aria-label="USG FOETAL Heart Rate"
                              aria-describedby="basic-icon-default-usgFetalHeartRate"
                              value="<?php echo $usgFetalHeartRate3 ?>"
                              disabled
                              />
                          </div>
                        </div>
                       
					            	<div class="col-4 mb-3" id="usgFetalPosition3" class="usgFetalPosition3" >
                          <label class="form-label" for="basic-icon-default-usgFetalPosition">USG FOETAL Presentation 3</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFetalPosition2" id="usgFetalPosition2value" class="form-select"  disabled>
                          <!-- <option value="">Choose...</option> -->
                          <?php
                            $query = "SELECT av.usgFetalPosition2,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.usgFetalPosition2 WHERE type=32 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$usgFetalPosition3) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=20";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                          </div>
                        </div> 
					            	<div class="col-4 mb-3" id="usgFetalMovement3" class="usgFetalMovement3" >
                          <label class="form-label" for="basic-icon-default-usgFetalMovement">USG FOETAL Movement 3</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFetalMovement2" id="usgFetalMovement2value" class="form-select" disabled>
                          <!-- <option value="">Choose...</option> -->
                          <?php
                          $query = "SELECT av.usgFetalMovement2,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.usgFetalMovement2 WHERE type=28 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$usgFetalMovement3) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <option value="1">Normal</option><?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=28";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                          </div>
                        </div>   

						           <div class="col-4 mb-3" id="placenta" >
                          <label class="form-label" for="basic-icon-default-phone">Placenta</label>
                          <div class="input-group input-group-merge">
                          <select name="placenta" id="pla" class="form-select" disabled>
                          <?php
                            $query = "SELECT av.placenta,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.placenta WHERE type=41 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$placenta) ?>
                         <?php  { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=41";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
						           </div>
					           </div>
						             <div class="col-4 mb-3" id="usgResult" >
                          <label class="form-label" for="basic-icon-default-usgResult">USG Result</label>
                          <div class="input-group input-group-merge">
                          <select name="usgResult" id="Result" class="form-select" disabled>
                          <?php
                            $query = "SELECT av.usgResult,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.usgResult WHERE type=27 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$usgResult) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=27";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
						             </div>
					              </div>
                           
						            <div class="col-4 mb-3" id="Remarks" >
                          <label class="form-label" for="basic-icon-default-usgRemarks">USG Remarks</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgRemarks"
                              class="form-control"
                              id="usgRemarks"
                              placeholder="USG Remarks"
                              aria-label="USG Remarks"
                              aria-describedby="basic-icon-default-usgRemarks"
                              value="<?php echo $usgRemarks ?>"
                              disabled
                            />
                          </div>
                        </div>
                        
						             <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-methodofConception">Method Of Contraception Councelling <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <select required name="methodofConception" id="methodofConception" onChange="MofConceptionChange()" class="form-select" disabled >
                           <?php   
                            $query = "SELECT av.methodofConception,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.methodofConception WHERE type=29 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$methodofConception) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=29";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                          </div>
                        </div>
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-AnyOtherSpecify">Any Other Specify </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="AnyOtherSpecify"
                              class="form-control"
                              id="AnyOtherSpecify"
                              placeholder="Any Other Specify"
                              aria-label="Any Other Specify"
                              aria-describedby="basic-icon-default-AnyOtherSpecify"
                              value="<?php echo $AnyOtherSpecify ?>"
                              disabled
                              />
                          </div>
                        </div>
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-highRisk">Symptoms High Risk <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                          <select name="HighRisk" id="HighRisk" class="form-select" required disabled>
                                <?php
                                $list=mysqli_query($conn, "SELECT av.HighRisk,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.HighRisk WHERE type=13 AND av.id=".$id);

                                while($row_list=mysqli_fetch_assoc($list)){

                                ?>

                                <option value="<?php echo $row_list['enumid']; ?>">

                                <?php if($row_list['enumvalue']== $HighRisk)?>
                                
                                <?php { echo $row_list['enumvalue']; } ?></option>
                                <?php 
                                $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                              ?>
                          
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } } ?>
                           </select>
                          </div>
                        </div>
						            <div class="col-4 mb-3" id="symptom">
                          <label class="form-label" for="basic-icon-default-symptomsHighRisk">Symptoms High Risk During Visit <!--<span class="mand">* </span>--></label>
                          <div class="input-group input-group-merge">
                          <select name="symptomsHighRisk" id="symptomsHighRisk" class="form-select" disabled>
                                <?php
                                $list=mysqli_query($conn, "SELECT av.symptomsHighRisk,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.symptomsHighRisk WHERE type=51 AND av.id=".$id);

                                while($row_list=mysqli_fetch_assoc($list)){

                                ?>

                                <option value="<?php echo $row_list['enumid']; ?>">

                                <?php if($row_list['enumvalue']== $symptomsHighRisk)?>
                                
                                <?php { echo $row_list['enumvalue']; } ?></option>
                                <?php 
                                $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=51";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                              ?>
                          
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } } ?>
                           </select>
                          </div>
                        </div>
                        <div class="col-4 mb-3" id="refFacility">
                          <label class="form-label" for="basic-icon-default-referralFacility">Referral Facility <!--<span class="mand">* </span>--></label>
                          <div class="input-group input-group-merge">
                          <select name="referralFacility" id="referralFacility" class="form-select" onchange="RefChange()" disabled>
                          <?php
                            $query = "SELECT av.referralFacility,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.referralFacility WHERE type=13 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$referralFacility) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                          </div>
                        </div>
                        <div class="col-4 mb-3" id="refDist">
                          <label class="form-label" for="basic-icon-default-referralDistrict">Referral District </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="referralDistrict"
                              class="form-control"
                              id="referralDistrict"
                              placeholder="Referral District"
                              aria-label="Referral District"
                              aria-describedby="basic-icon-default-referralDistrict"                             
                              value="<?php echo $referralDistrict ?>"
                              disabled
                              />
                          </div>
                        </div>

						            <div class="col-4 mb-3"  id="refPlace">
                          <label class="form-label" for="basic-icon-default-referralDate">Referral Place </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="referralPlace"
                              class="form-control"
                              id="referralPlace"
                              placeholder="Referral Place"
                              aria-label="Referral Place"
                              aria-describedby="basic-icon-default-referralDate"
                              value="<?php echo $referralPlace ?>"
                              disabled
                              />
                          </div>
                        </div>

						            <div class="col-4 mb-3"  id="refDate">
                          <label class="form-label" for="basic-icon-default-referralDate">Referral Date </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="referralDate"
                              class="form-control"
                              id="referralDate"
                              placeholder="Referral Date"
                              aria-label="Referral Date"
                              aria-describedby="basic-icon-default-referralDate"
                              value="<?php echo $referralDate ?>"
                              disabled
                              />
                          </div>
                        </div> 
						      <div class="col-4 mb-3" id="bTrans">
                          <label class="form-label" for="basic-icon-default-bloodTransfusion">Transfusion</label>
                          <div class="input-group input-group-merge">
                          <select name="bloodTransfusion" id="bloodTransfusion" class="form-select" disabled>
                <?php $query = "SELECT av.bloodTransfusion,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.bloodTransfusion WHERE type=44 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$bloodTransfusion) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=29";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                          </div>
                        </div>
                        
                        <div class="col-4 mb-3" id="transDate">
                          <label class="form-label" for="basic-icon-default-bloodTransfusionDate">Transfusion Date</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="bloodTransfusionDate"
                              class="form-control"
                              id="bloodTransfusionDate"
                              placeholder="USG REPORT URL"
                              aria-label="USG REPORT URL"
                              aria-describedby="basic-icon-default-bloodTransfusionDate"
                              value="<?php echo $bloodTransfusionDate ?>"
                              disabled
                            />
                          </div>
                        </div>
                      
				           <div class="col-4 mb-3" id="placeAdmin">
                          <label class="form-label" for="basic-icon-default-placeAdministered">Place Administered</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="placeAdministrator"
                              class="form-control"
                              id="placeAdministered"
                              placeholder="Place Administered"
                              aria-label="Place Administered"
                              aria-describedby="basic-icon-default-placeAdministered"
                              value="<?php echo $placeAdministrator ?>"
                              disabled
                            />
                          </div>
                        </div>
				                <div class="col-4 mb-3" id="ivDoses">
                          <label class="form-label" for="basic-icon-default-noOfIVDoses">NO. of Units / IV Doses</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="noOfIVDoses"
                              class="form-control"
                              id="noOfIVDoses"
                              placeholder="NO. of IV Doses"
                              aria-label="NO. of IV Doses"
                              aria-describedby="basic-icon-default-noOfIVDoses"
                              value="<?php echo $nooIVdoses ?>"
                              disabled
                            />
                          </div>
                        </div>
                        <div class="input-group" id="btnSaUp" style="display:none">
                          <input class="btn btn-primary" type="submit" id="update" name="editVisit" value="Update">
                        </div>
                            </div>
                      </div>
                  </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->
<?php include ('require/footer.php'); ?>
