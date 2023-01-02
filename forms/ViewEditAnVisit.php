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
  $An = mysqli_fetch_array($record);
  $picmeno = $An["picmeno"]; $residenttype = $An["residenttype"]; 
  $physicalpresent = $An["physicalpresent"]; $placeofvisit = $An["placeofvisit"]; $abortion = $An["abortion"]; 
  $anvisitDate = $An["anvisitDate"]; $ancPeriod = $An["ancPeriod"]; $pregnancyWeek = $An["pregnancyWeek"];
  $motherWeight = $An["motherWeight"]; $bpSys = $An["bpSys"];  $bpDia = $An["bpDia"]; $Hb = $An["Hb"]; 
  $urineTestStatus = $An["urineTestStatus"]; $urineSugarPresent = $An["urineSugarPresent"];
  $urineAlbuminPresent = $An["urineAlbuminPresent"]; $bloodSugartest =$An["bloodSugartest"]; 
  $fastingSugar = $An["fastingSugar"]; $postPrandial = $An["postPrandial"]; 
  $rbs = $An["Rbs"]; $gctStatus = $An["gctStatus"];  $gctValue = $An["gctValue"]; 
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
  $liquor = $An["liquor"];
  $usgFetalHeartRate = $An["usgFetalHeartRate"];
  $usgFetalPosition = $An["usgFetalPosition"];
  $usgFetalMovement = $An["usgFetalMovement"];
  $liquor1 = $An["liquor1"]; 
  $usgFetalHeartRate1 = $An["usgFetalHeartRate1"];
  $usgFetalPosition1 = $An["usgFetalPosition1"]; 
  $usgFetalMovement1 = $An["usgFetalMovement1"];
  $liquor2 = $An["liquor2"]; 
  $usgFetalHeartRate2 = $An["usgFetalHeartRate2"];
  $usgFetalPosition2 = $An["usgFetalPosition2"]; 
  $usgFetalMovement2 = $An["usgFetalMovement2"];
  $lT1 = $An["lT1"]; 
  $usgFHRT1 = $An["usgFHRT1"];
  $usgFPT1 = $An["usgFPT1"]; 
  $usgFMT1 = $An["usgFMT1"];
  $lT2 = $An["lT2"]; 
  $usgFHRT2 = $An["usgFHRT2"];
  $usgFPT2 = $An["usgFPT2"]; 
  $usgFMT2 = $An["usgFMT2"];
  $lT3 = $An["lT3"]; 
  $usgFHRT3 = $An["usgFHRT3"];
  $usgFPT3 = $An["usgFPT3"]; 
  $usgFMT3 = $An["usgFMT3"];
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
  $gestationSac = $_POST["gestationSac"]; $liquor = $_POST["liquor"]; $usgFetalHeartRate = $_POST["usgFetalHeartRate"];
  $usgFetalPosition = $_POST["usgFetalPosition"]; $usgFetalMovement = $_POST["usgFetalMovement"]; $liquor1 = $_POST["liquor1"]; 
  $usgFetalHeartRate1 = $_POST["usgFetalHeartRate1"];
  $usgFetalPosition1 = $_POST["usgFetalPosition1"]; 
  $usgFetalMovement1 = $_POST["usgFetalMovement1"];
  $liquor2 = $_POST["liquor2"]; 
  $usgFetalHeartRate2 = $_POST["usgFetalHeartRate2"];
  $usgFetalPosition2 = $_POST["usgFetalPosition2"]; 
  $usgFetalMovement2 = $_POST["usgFetalMovement2"];
  $lT1 = $_POST["lT1"]; 
  $usgFHRT1 = $_POST["usgFHRT1"];
  $usgFPT1 = $_POST["usgFPT1"]; 
  $usgFMT1 = $_POST["usgFMT1"];
  $lT2 = $_POST["lT2"]; 
  $usgFHRT2 = $_POST["usgFHRT2"];
  $usgFPT2 = $_POST["usgFPT2"]; 
  $usgFMT2 = $_POST["usgFMT2"];
  $lT3 = $_POST["lT3"]; 
  $usgFHRT3 = $_POST["usgFHRT3"];
  $usgFPT3 = $_POST["usgFPT3"]; 
  $usgFMT3 = $_POST["usgFMT3"]; $placenta = $_POST["placenta"];
  $usgResult = $_POST["usgResult"]; $usgRemarks = $_POST["usgRemarks"]; 
  $bloodTransfusion = $_POST["bloodTransfusion"]; $bloodTransfusionDate = $_POST["bloodTransfusionDate"];
  $placeAdministrator = $_POST["placeAdministrator"]; $nooIVdoses = $_POST["noOfIVDoses"];
  date_default_timezone_set('Asia/Kolkata');
  $date = date('d-m-Y h:i:s');
  
  $query = mysqli_query($conn,"UPDATE antenatalvisit SET residenttype='$residenttype',physicalpresent='$physicalpresent',
  placeofvisit='$placeofvisit',abortion='$abortion',anvisitDate='$anvisitDate',avduedate='$avduedate',avTag='1',ancPeriod='$ancPeriod',pregnancyWeek='$pregnancyWeek',
  motherWeight='$motherWeight',bpSys='$bpSys',bpDia='$bpDia',Hb='$Hb',urineTestStatus='$urineTestStatus',
  urineSugarPresent='$urineSugarPresent',urineAlbuminPresent='$urineAlbuminPresent',bloodSugartest='$bloodSugartest',fastingSugar='$fastingSugar',
  postPrandial='$postPrandial',rbs='$rbs',gctStatus='$gctStatus',gctValue='$gctValue',Tsh='$tsh',
  TdDose='$TdDose',Td2Dose='$Td2Dose',Td1Date='$Td1Date',TdBdose='$TdBdose',TdBoosterDate='$TdBoosterDate',covidvac='$Covidvac',Dose1Date='$Dose1Date',Dose2Date='$Dose2Date',
preDate='$PreDate',NoFolicAcid='$NoFolicAcid',NoIFA='$NoIFA',
  DateofIFA='$dateofIFA',DateofAlbendazole='$dateofAlbendazole',noCalcium='$noCalcium',calciumDate='$calciumDate',
  sizeUterusinWeeks='$sizeUterusinWeeks',methodofConception='$methodofConception',AnyOtherSpecify='$AnyOtherSpecify',HighRisk='$HighRisk',symptomsHighRisk='$symptomsHighRisk',referralDate='$referralDate',
  referralDistrict='$referralDistrict',referralFacility='$referralFacility',referralPlace='$referralPlace',wusgTaken='$wusgTaken',usgreport='$filename',
  usgDoneDate='$usgDoneDate',usgScanEdd='$usgScanEdd',usgScanStatus='$usgScanStatus',usgFundalHeight='$usgFundalHeight',
  usgSizeUterusWeek='$usgSizeUterusWeek',usgFetusStatus='$usgFetusStatus',gestationSac='$gestationSac',liquor='$liquor',
  usgFetalHeartRate='$usgFetalHeartRate',usgFetalPosition='$usgFetalPosition',usgFetalMovement='$usgFetalMovement',liquor1='$liquor1',
usgFetalHeartRate1='$usgFetalHeartRate1',usgFetalPosition1='$usgFetalPosition1',usgFetalMovement1='$usgFetalMovement',liquor2='$liquor2',
usgFetalHeartRate2='$usgFetalHeartRate2',usgFetalPosition2='$usgFetalPosition2',usgFetalMovement2='$usgFetalMovement2',lT1='$lT1',
usgFHRT1='$usgFHRT1',usgFPT1='$usgFPT1',usgFMT1='$usgFMT1',lT2='$lT2',
usgFHRT2='$usgFHRT2',usgFPT2='$usgFPT2',usgFMT2='$usgFMT2',lT3='$lT3',
usgFHRT3='$usgFHRT3',usgFPT3='$usgFPT3',usgFMT3='$usgFMT3',placenta='$placenta',
  usgResult='$usgResult',usgRemarks='$usgRemarks',bloodTransfusion='$bloodTransfusion',
  bloodTransfusionDate='$bloodTransfusionDate',placeAdministrator='$placeAdministrator',noOfIVDoses='$nooIVdoses',
  updatedat='$date',updatedBy='$userid' WHERE id=".$id);
  if (!empty($query)) {
            echo "<script>alert('Updated Successfully');window.location.replace('http://admin.thaimaiyudan.org/forms/AntenatalVisit.php');</script>";
          }
          $highrisk = mysqli_query($conn, "UPDATE ecregister ec INNER JOIN antenatalvisit av ON ec.picmeNo=av.picmeno SET ec.status=6 WHERE av.symptomsHighRisk NOT IN('1','48') AND av.picmeNo=".$picmeno);
}

if (isset($_GET['del'])) {
  $id = $_GET['del'];
  date_default_timezone_set('Asia/Kolkata');
  $date = date('d-m-Y h:i:s');
  mysqli_query($conn, "UPDATE antenatalvisit SET status=0, deletedat='$date', deletedBy='$userid' WHERE status=1 AND id=$id");
  $_SESSION['message'] = "User deleted!"; 
    echo "<script>alert('Deleted Successfully');window.location.replace('http://admin.thaimaiyudan.org/forms/AntenatalVisit.php');</script>";
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

              <?php if($_SESSION["usertype"] == '0' || $_SESSION["usertype"] == '1') { ?>
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
                            <input
                              type="text"
                              name="ancPeriod"
                              class="form-control"
                              id="ancPeriod"
                              placeholder="Antenatal Period"
                              aria-label="Antenatal Period"
                              aria-describedby="basic-icon-default-ancPeriod"
                              value="<?php echo $ancPeriod ?>"
                              disabled
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
                            <input
                            required
                              type="text"
                              name="bpSys"
                              class="form-control"
                              id="bpSys"
                              placeholder="Bp Systolic"
                              aria-label="Bp Systolic"
                              aria-describedby="basic-icon-default-motherWeight"
                              value="<?php echo $bpSys ?>"
                              disabled
                            />
                          </div>
                        </div>
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-bpDia">BP Diastolic</label>
                          <div class="input-group input-group-merge">
                            <input
                            required
                              type="text"
                              name="bpDia"
                              class="form-control"
                              id="bpDia"
                              placeholder="BP Diastolic"
                              aria-label="BP Diastolic"
                              aria-describedby="basic-icon-default-bpDia"
                              value="<?php echo $bpDia ?>"
                              disabled
                            />
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
                            $query = "SELECT av.urineTestStatus,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.urineTestStatus WHERE type=20 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$urineTestStatus) ?>
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
                          <div class="col-4 mb-3" id="urineSP">
                            <label class="form-label" for="basic-icon-default-urineSugarPresent">Urine Sugar Present <!--<span class="mand">* </span>--></label>
                            <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="urineSugarPresent"
                              class="form-control"
                              id="urineSugarPresent"
                              placeholder="Urine Sugar Present"
                              aria-label="UrineSugarPresent"
                              aria-describedby="basic-icon-default-urineSugarPresent"
                              value="<?php echo $urineSugarPresent ?>"
                              disabled
                              />
                              
                            </div>
                          </div>
                          <div class="col-4 mb-3" id="urineAP">
                            <label class="form-label" for="basic-icon-default-urineAlbuminPresent">Urine Albumin Present <!--<span class="mand">* </span>--></label>
                            <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="urineAlbuminPresent"
                              class="form-control"
                              id="urineAlbuminPresent"
                              placeholder="Urine Albumin Present"
                              aria-label="urineAlbuminPresent"
                              aria-describedby="basic-icon-default-urineAlbuminPresent"
                              value="<?php echo $urineAlbuminPresent ?>"
                              disabled
                              />
                            </div>
                          </div>
				              
						            <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-fastingSugar">Fasting Sugar</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="fastingSugar"
                              class="form-control"
                              id="fastingSugar"
                              placeholder="Fasting Sugar"
                              aria-label="Fasting Sugar"
                              aria-describedby="basic-icon-default-fastingSugar"
                              value="<?php echo $fastingSugar ?>"
                              disabled
                            />
                          </div>
                        </div>
						             <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-postPrandial">Post Prandial</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="postPrandial"
                              class="form-control"
                              id="postPrandial"
                              placeholder="Post Prandial"
                              aria-label="Post Prandial"
                              aria-describedby="basic-icon-default-postPrandial"
                              value="<?php echo $postPrandial ?>"
                              disabled
                            />
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
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
                          </div>
                        </div>
                        <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-gctValue">GCT Value <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
                            <input
                            required
                              type="text"
                              name="gctValue"
                              class="form-control"
                              id="gctValue"
                              placeholder="GCT Value"
                              aria-label="GCT Value"
                              aria-describedby="basic-icon-default-gctValue"
                              value="<?php echo $gctValue ?>"
                              disabled
                            />
                          </div>
                        </div>
						              <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-Tsh">TSH</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="Tsh"
                              class="form-control"
                              id="Tsh"
                              placeholder="TSH"
                              aria-label="TSH"
                              aria-describedby="basic-icon-default-Tsh"
                              value="<?php echo $tsh ?>"
                              disabled
                            />
                          </div>
                          </div>
                          <div class="col-4 mb-3">
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
                
					             	<div class="col-4 mb-3"  id="Tddose1" style="display: none;">
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
                        <div class="col-4 mb-3" id="Tddate1"  style="display: none;" >
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
                        <div class="col-4 mb-3">
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

                        <div class="col-4 mb-3" id="Tddose2"  style="display: none;"  >
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
                        <div class="col-4 mb-3"  id="Tddate2"  style="display: none;" >
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
				<div class="col-4 mb-3">
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
                        <div class="col-4 mb-3" id="Bdose"  style="display: none;">
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
                              value="<?php echo $TdBdose; ?>"
                              />
                          </div>
                        </div>
						<div class="col-4 mb-3" id="TdB"  style="display: none;">
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
                            <input
                              type="text"
                              name="NoFolicAcid"
                              class="form-control"
                              id="NoFolicAcid"
                              placeholder="No. of Folic Acid"
                              aria-label="No. of Folic Acid"
                              aria-describedby="basic-icon-default-NoFolicAcid"
                              value="<?php echo $NoFolicAcid ?>"
                              disabled
                            />
                          </div>
                        </div>
					            	<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-NoIFA">Number of IFA</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="NoIFA"
                              class="form-control"
                              id="NoIFA"
                              placeholder="No. of IFA"
                              aria-label="No. of IFA"
                              aria-describedby="basic-icon-default-NoIFA"
                              value="<?php echo $NoIFA ?>"
                              disabled
                            />
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
                            <input
                              type="text"
                              name="noCalcium"
                              class="form-control"
                              id="noCalcium"
                              placeholder="No. of Calcium"
                              aria-label="No. of Calcium"
                              aria-describedby="basic-icon-default-noCalcium"
                              value="<?php echo $noCalcium ?>"
                              disabled
                            />
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
                          
                        <div class="col-4 mb-3" id="takenStatus" style="display:none;">
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
						 <div class="col-4 mb-3" id="usgDoneDate" style="display:none;">
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
                        
						<div class="col-4 mb-3" id="usgScanEdd" style="display:none;">
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
					            <div class="col-4 mb-3" id="usgScanStatus" style="display:none;">
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
			        	<div class="col-4 mb-3" id="usgFundalHeight" style="display:none;">
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
                        			
						 <div class="col-4 mb-3" id="usgSizeUterusWeek" style="display:none;">
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
                        
						           <div class="col-4 mb-3" id="usgFetusStatus" style="display:none;">
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
			            <div class="col-4 mb-3" id="gestationSac" style="display:none;">
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
                           
						         <div class="col-4 mb-3 liquor" id="liquor" style="display:none;">
                          <label class="form-label" for="basic-icon-default-liquor">Liquor</label>
                          <div class="input-group input-group-merge">
                          <select name="liquor" id="liquorop" class="form-select" disabled>
                          <?php
                            $query = "SELECT av.liquor,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.liquor WHERE type=28 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$liquor) ?>
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

					          	<div class="col-4 mb-3 FetalHeartRate" id="FetalHeartRate" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalHeartRate">USG FOETAL Heart Rate</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgFetalHeartRate"
                              class="form-control"
                              id="usgFetalHeartRate"
                              placeholder="USG FOETAL Heart Rate"
                              aria-label="USG FOETAL Heart Rate"
                              aria-describedby="basic-icon-default-usgFetalHeartRate"
                              value="<?php echo $usgFetalHeartRate ?>"
                              disabled
                            />
                          </div>
                        </div>
                        
					            	<div class="col-4 mb-3 FetalPosition" id="FetalPosition" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalPosition">USG FOETAL Presentation</label>
                          <div class="input-group input-group-merge">
                          <select name="usgFetalPosition" id="usgFetalPosition" class="form-select" disabled>

                            <?php
                            $query = "SELECT av.usgFetalPosition,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.usgFetalPosition WHERE type=32 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$usgFetalPosition) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=12";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                               <?php } } ?>
                                </select>
                          </div>
                        </div>
                        
					            	<div class="col-4 mb-3 FetalMovement" id="FetalMovement" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalMovement">USG FOETAL Movement</label>
                          <div class="input-group input-group-merge">
                          <select name="usgFetalMovement" id="usgFetalMovement" class="form-select" disabled>

                            <?php
                          $query = "SELECT av.usgFetalMovement,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.usgFetalMovement WHERE type=28 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$usgFetalMovement) ?>
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

                        <div class="col-4 mb-3" id="liquor1" class="liquor1" style="display:none;">
                          <label class="form-label" for="basic-icon-default-liquor">Liquor 1</label>
                          <div class="input-group input-group-merge">
                          <select  name="liquor1" id="liquor1value" class="form-select" disabled>
                          <!-- <option value="">Choose...</option> -->
                          <?php
                            $query = "SELECT av.liquor1,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.liquor1 WHERE type=28 AND av.id=".$id;
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
                      
					          	<div class="col-4 mb-3" id="usgFetalHeartRate1" class="usgFetalHeartRate1" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalHeartRate">USG FOETAL Heart Rate 1</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgFetalHeartRate1"
                              class="form-control"
                              id="usgFetalHeartRate1value"
                              placeholder="USG FOETAL Heart Rate"
                              aria-label="USG FOETAL Heart Rate"
                              aria-describedby="basic-icon-default-usgFetalHeartRate"
                              value="<?php echo $usgFetalHeartRate1 ?>"
                              disabled
                              />
                          </div>
                        </div>
                       
					            	<div class="col-4 mb-3" id="usgFetalPosition1" class="usgFetalPosition1" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalPosition">USG FOETAL Presentation 1</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFetalPosition1" id="usgFetalPosition1value" class="form-select" disabled>
                          <!-- <option value="">Choose...</option> -->
                          <?php
                            $query = "SELECT av.usgFetalPosition1,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.usgFetalPosition1 WHERE type=32 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$usgFetalPosition1) ?>
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
					            	<div class="col-4 mb-3" id="usgFetalMovement1" class="usgFetalMovement1" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalMovement">USG FOETAL Movement 1</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFetalMovement1" id="usgFetalMovement1value" class="form-select" disabled>
                          <!-- <option value="">Choose...</option> -->
                          <?php
                          $query = "SELECT av.usgFetalMovement1,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.usgFetalMovement1 WHERE type=28 AND av.id=".$id;
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

                        <div class="col-4 mb-3" id="liquor2" class="liquor2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-liquor">Liquor 2</label>
                          <div class="input-group input-group-merge">
                          <select  name="liquor2" id="liquor2value" class="form-select" disabled>
                          <!-- <option value="">Choose...</option> -->
                          <?php
                            $query = "SELECT av.liquor2,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.liquor2 WHERE type=28 AND av.id=".$id;
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
                      
					          	<div class="col-4 mb-3" id="usgFetalHeartRate2" class="usgFetalHeartRate2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalHeartRate">USG FOETAL Heart Rate 2</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgFetalHeartRate2"
                              class="form-control"
                              id="usgFetalHeartRate2value"
                              placeholder="USG FOETAL Heart Rate"
                              aria-label="USG FOETAL Heart Rate"
                              aria-describedby="basic-icon-default-usgFetalHeartRate"
                              value="<?php echo $usgFetalHeartRate2 ?>"
                              disabled
                              />
                          </div>
                        </div>
                       
					            	<div class="col-4 mb-3" id="usgFetalPosition2" class="usgFetalPosition2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalPosition">USG FOETAL Presentation 2</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFetalPosition2" id="usgFetalPosition2value" class="form-select"  disabled>
                          <!-- <option value="">Choose...</option> -->
                          <?php
                            $query = "SELECT av.usgFetalPosition2,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.usgFetalPosition2 WHERE type=32 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$usgFetalPosition2) ?>
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
					            	<div class="col-4 mb-3" id="usgFetalMovement2" class="usgFetalMovement2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalMovement">USG FOETAL Movement 2</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFetalMovement2" id="usgFetalMovement2value" class="form-select" disabled>
                          <!-- <option value="">Choose...</option> -->
                          <?php
                          $query = "SELECT av.usgFetalMovement2,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.usgFetalMovement2 WHERE type=28 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$usgFetalMovement2) ?>
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

                        <!---- Triple Baby Field Start --->

                        <div class="col-4 mb-3" id="lT1" class="lT" style="display:none;">
                          <label class="form-label" for="basic-icon-default-liquor">Liquor 1</label>
                          <div class="input-group input-group-merge">
                          <select  name="lT1" id="lT1value" class="form-select" disabled>
                          <!-- <option value="">Choose...</option> -->
                          <?php
                            $query = "SELECT av.lT1,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.lT1 WHERE type=28 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$lT1) ?>
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
                      
					          	<div class="col-4 mb-3" id="usgFHRT1" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalHeartRate">USG FOETAL Heart Rate 1</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgFHRT1"
                              class="form-control"
                              id="usgFHRT1value"
                              placeholder="USG FOETAL Heart Rate"
                              aria-label="USG FOETAL Heart Rate"
                              aria-describedby="basic-icon-default-usgFetalHeartRate"
                              value="<?php echo $usgFHRT1 ?>"
                              disabled
                              />
                          </div>
                        </div>
                       
					            	<div class="col-4 mb-3" id="usgFPT1" class="usgFPT1" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalPosition">USG FOETAL Presentation 1</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFPT1" id="usgFPT1value" class="form-select" disabled>
                          <!-- <option value="">Choose...</option> -->
                          <?php
                            $query = "SELECT av.usgFPT1,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.usgFPT1 WHERE type=32 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$usgFPT1) ?>
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
					            	<div class="col-4 mb-3" id="usgFMT1" class="usgFMT1" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalMovement">USG FOETAL Movement 1</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFMT1" id="usgFMT1value" class="form-select" disabled>
                          <!-- <option value="">Choose...</option> -->
                          <?php
                          $query = "SELECT av.usgFMT1,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.usgFMT1 WHERE type=28 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$usgFMT1) ?>
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

                        <div class="col-4 mb-3" id="lT2" class="lT2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-liquor">Liquor 2</label>
                          <div class="input-group input-group-merge">
                          <select  name="lT2" id="lT2value" class="form-select" disabled>
                          <!-- <option value="">Choose...</option> -->
                          <?php
                            $query = "SELECT av.lT2,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.lT2 WHERE type=28 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$lT2) ?>
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
                      
					          	<div class="col-4 mb-3" id="usgFHRT2" class="usgFHRT2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalHeartRate">USG FOETAL Heart Rate 2</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgFHRT2"
                              class="form-control"
                              id="usgFHRT2value"
                              placeholder="USG FOETAL Heart Rate"
                              aria-label="USG FOETAL Heart Rate"
                              aria-describedby="basic-icon-default-usgFetalHeartRate"
                              value="<?php echo $usgFHRT2 ?>"
                              disabled
                              />
                          </div>
                        </div>
                       
					            	<div class="col-4 mb-3" id="usgFPT2" class="usgFPT2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalPosition">USG FOETAL Presentation 2</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFPT2" id="usgFPT2value" class="form-select" disabled>
                          <!-- <option value="">Choose...</option> -->
                          <?php
                            $query = "SELECT av.usgFPT2,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.usgFPT2 WHERE type=32 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$usgFPT2) ?>
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
					            	<div class="col-4 mb-3" id="usgFMT2" class="usgFMT2" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalMovement">USG FOETAL Movement 2</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFMT2" id="usgFMT2value" class="form-select" disabled>
                          <!-- <option value="">Choose...</option> -->
                          <?php
                          $query = "SELECT av.usgFMT2,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.usgFMT2 WHERE type=28 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$usgFMT2) ?>
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
                        
                        <div class="col-4 mb-3" id="lT3" class="lT3" style="display:none;">
                          <label class="form-label" for="basic-icon-default-liquor">Liquor 3</label>
                          <div class="input-group input-group-merge">
                          <select  name="lT3" id="lT3value" class="form-select" disabled> 
                          <!-- <option value="">Choose...</option> -->
                          <?php
                            $query = "SELECT av.lT3,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.lT3 WHERE type=28 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$lT3) ?>
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
                      
					          	<div class="col-4 mb-3" id="usgFHRT3" class="usgFHRT3" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalHeartRate">USG FOETAL Heart Rate 3</label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="usgFHRT3"
                              class="form-control"
                              id="usgFHRT3value"
                              placeholder="USG FOETAL Heart Rate"
                              aria-label="USG FOETAL Heart Rate"
                              aria-describedby="basic-icon-default-usgFetalHeartRate"
                              value="<?php echo $usgFHRT3 ?>"
                              disabled
                              />
                          </div>
                        </div>
                       
					            	<div class="col-4 mb-3" id="usgFPT3" class="usgFPT3" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalPosition">USG FOETAL Presentation 3</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFPT3" id="usgFPT3value" class="form-select" disabled>
                          <!-- <option value="">Choose...</option> -->
                          <?php
                            $query = "SELECT av.usgFPT3,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.usgFPT3 WHERE type=32 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$usgFPT3) ?>
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
					            	<div class="col-4 mb-3" id="usgFMT3" class="usgFMT3" style="display:none;">
                          <label class="form-label" for="basic-icon-default-usgFetalMovement">USG FOETAL Movement 3</label>
                          <div class="input-group input-group-merge">
                          <select  name="usgFMT3" id="usgFMT3value" class="form-select" disabled>
                          <!-- <option value="">Choose...</option> -->
                          <?php
                          $query = "SELECT av.usgFMT3,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.usgFMT3 WHERE type=28 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$usgFMT3) ?>
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
                       

						           <div class="col-4 mb-3" id="placenta" style="display:none;">
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
						             <div class="col-4 mb-3" id="usgResult" style="display:none;">
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
                           
						            <div class="col-4 mb-3" id="Remarks" style="display:none;">
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
