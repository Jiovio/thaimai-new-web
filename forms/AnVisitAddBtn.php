<?php include ('require/topHeader.php'); ?>
<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
    <?php include ('require/header.php'); // Menu & Top Search 
	
	// Including the Code - Add !
  $add_ind = "N";
  if (isset($_POST['picmeno']) OR isset($_GET['picmeno'])) {
  if (isset($_POST['picmeno']))
  {	  
  $AV_picmeno = $_POST['picmeno'];
  }
  if(isset($_GET['picmeno']))
  {	  
  $AV_picmeno = $_GET['picmeno'];
  }
  $add_ind = "Y";
  } 
  
if (isset($_GET['History'])) {
	
  $AV_picmeno = $_GET['History'];
  $History = true;
  $add_ind = "N";
 } 
 
 // print_r($AV_picmeno);
 $Glu_Add = "N";
 $Thy_Add = "N";
 $Vac_Add = "N";
 $Pre_Add = "N";
 $USG_Add = "N";
 $HR_Add = "N";
  $CheckANV_Cnt = mysqli_query($conn,"SELECT * FROM antenatalvisit where picmeno=$AV_picmeno order by id desc LIMIT 0,1");
  $CheckANV_Cnt_val = mysqli_fetch_array($CheckANV_Cnt);
  $anc_cnt = "";
  if(isset($CheckANV_Cnt_val) AND !empty($CheckANV_Cnt_val))
  {
	$anc_cnt = $CheckANV_Cnt_val['ancPeriod'] + 1;  
	$Glu_Add_Val = "";
    $Glu_Add_Val = $CheckANV_Cnt_val['fastingSugar'].$CheckANV_Cnt_val['postPrandial'].$CheckANV_Cnt_val['gctStatus'].$CheckANV_Cnt_val['gctValue'];
    if(isset($Glu_Add_Val) AND !empty($Glu_Add_Val))
    {
    	$Glu_Add = "Y";  
    }
	
	$Thy_Add_Val = "";
    $Thy_Add_Val = $CheckANV_Cnt_val['Tsh'];
    if(isset($Thy_Add_Val) AND !empty($Thy_Add_Val))
    {
    	$Thy_Add = "Y";  
    }
	
	$Vac_Add_Val = "";
    $Vac_Add_Val = $CheckANV_Cnt_val['Td1'].
	               $CheckANV_Cnt_val['TdDose'].
				   $CheckANV_Cnt_val['Td1Date'].
				   $CheckANV_Cnt_val['Td2'].
				   $CheckANV_Cnt_val['Td2Dose'].
				   $CheckANV_Cnt_val['Td2Date'].
				   $CheckANV_Cnt_val['Tdb'].
				   $CheckANV_Cnt_val['TdBdose'].
				   $CheckANV_Cnt_val['TdBoosterDate'].
				   $CheckANV_Cnt_val['Covidvac'].
				   $CheckANV_Cnt_val['Dose1Date'].
				   $CheckANV_Cnt_val['Dose2Date'].
				   $CheckANV_Cnt_val['PreDate']
	;
    if(isset($Vac_Add_Val) AND !empty($Vac_Add_Val))
    {
    	$Vac_Add = "Y";  
    }
	  
    $Pre_Add_Val = "";
    $Pre_Add_Val = $CheckANV_Cnt_val['NoFolicAcid'].
	               $CheckANV_Cnt_val['NoIFA'].
				   $CheckANV_Cnt_val['dateofIFA'].
				   $CheckANV_Cnt_val['dateofAlbendazole'].
				   $CheckANV_Cnt_val['noCalcium'].
				   $CheckANV_Cnt_val['calciumDate']
	;
    if(isset($Pre_Add_Val) AND !empty($Pre_Add_Val))
    {
    	$Pre_Add = "Y";  
    }
	
	$USG_Add_Val = "";
	
    $USG_Add_Val = $CheckANV_Cnt_val['wusgTaken'].
	               $CheckANV_Cnt_val['usgDoneDate'].
				   $CheckANV_Cnt_val['usgScanEdd'].
				   $CheckANV_Cnt_val['sizeUterusinWeeks'].
				   $CheckANV_Cnt_val['usgScanStatus'].
				   $CheckANV_Cnt_val['usgFundalHeight'].
				   $CheckANV_Cnt_val['usgSizeUterusWeek'].
				   $CheckANV_Cnt_val['usgFetusStatus'].
				   $CheckANV_Cnt_val['gestationSac'].
				   $CheckANV_Cnt_val['liquor'].
				   $CheckANV_Cnt_val['usgFetalHeartRate'].
				   $CheckANV_Cnt_val['usgFetalPosition'].
				   $CheckANV_Cnt_val['usgFetalMovement'].
				   $CheckANV_Cnt_val['liquor1'].
				   $CheckANV_Cnt_val['usgFetalHeartRate1'].
				   $CheckANV_Cnt_val['usgFetalPosition1'].
				   $CheckANV_Cnt_val['usgFetalMovement1'].
				   $CheckANV_Cnt_val['liquor2'].
				   $CheckANV_Cnt_val['usgFetalHeartRate2'].
				   $CheckANV_Cnt_val['usgFetalPosition2'].
				   $CheckANV_Cnt_val['usgFetalMovement2'].
				   $CheckANV_Cnt_val['placenta'].
				   $CheckANV_Cnt_val['usgResult'].
				   $CheckANV_Cnt_val['usgRemarks'];
    if(isset($USG_Add_Val) AND !empty($USG_Add_Val))
    {
    	$USG_Add = "Y";  
    }
	
	$HR_Add_Val = "";
	
    $HR_Add_Val = $CheckANV_Cnt_val['HighRisk'].
	               $CheckANV_Cnt_val['symptomsHighRisk'].
				   $CheckANV_Cnt_val['referralDate'].
				   $CheckANV_Cnt_val['referralDistrict'].
				   $CheckANV_Cnt_val['referralFacility'].
				   $CheckANV_Cnt_val['referralPlace'].
				   $CheckANV_Cnt_val['bloodTransfusion'].
				   $CheckANV_Cnt_val['bloodTransfusionDate'].
				   $CheckANV_Cnt_val['placeAdministrator'].
				   $CheckANV_Cnt_val['noOfIVDoses'];
    if(isset($HR_Add_Val) AND !empty($HR_Add_Val))
    {
    	$HR_Add = "Y";  
    }
  }
  else
  {
	$anc_cnt = 1;  
  } 
	
	
	if (isset($AV_picmeno)) {
  $record = mysqli_query($conn, "SELECT * FROM ecregister ec WHERE ec.picmeNo=$AV_picmeno");
  $his = mysqli_fetch_array($record);
  $his_mot_name = $his['motheraadhaarname'];
  
	}
	?>
    <!-- Content wrapper -->
      <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
			<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Antenatal Visit /</span> Add Antenatal Visit 
              
				 <a href="AnVisit.php?History=<?php echo $AV_picmeno; ?>" ><span button type="button" class="btn btn-primary" id="btnBack">
                    <span class="bx bx-arrow-back"></span>&nbsp; Back
					
              </button></a>
			  
			  </h4>
			  <h5><span class="text-muted fw-light"> RCHID (PICME) No : </span> <?php echo $AV_picmeno; ?>			  
		     <h5> <span class="text-muted fw-light"> Mother Name : </span> <?php echo $his_mot_name; ?>
             
			  </h5> </h5>
			  <div class="row">
                <div class="col-12 col-md-12 col-lg-12 order-3 order-md-2">
                  <div class="row">
                  <div class="col-4 mb-4">
                     <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../assets/img/icons/unicons/wallet-info.png" style="cursor:default" style="cursor:default" alt="Credit Card" class="rounded" />
                            </div>
                          </div>
                          <span class="fw-semibold d-Block mb-2" style="cursor:default">Basic AV Details</span>
						  <?php if($add_ind == "Y") {  ?>
						  <a href="AddBasicDtls.php?History=<?php echo $AV_picmeno; ?>" ><span button type="button" class="btn btn-primary" id="Addbasic">
                    <span class="bx bx-plus"></span>&nbsp; Add
              </button></a></span>
						  <?php } else { ?>
					 <button disabled type="button" class="btn btn-primary" id="Addbasic" ">
				<span class="bx bx-plus"></span>&nbsp; Add
              </button></a></span>
			  <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-4 mb-4">
                     <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../assets/img/icons/unicons/cc-warning.png" style="cursor:default" style="cursor:default" alt="Credit Card" class="rounded" />
                            </div>
                          </div>
                          <span class="fw-semibold d-Block mb-1" style="cursor:default">Glucose Challenge Test Details</span>
						  <?php if($add_ind == "N" AND $Glu_Add == "N") {  ?>
						  <a href="AddGlucoseDetails.php?History=<?php echo $AV_picmeno; ?>" ><span button type="button" class="btn btn-primary" id="Addglucose">
                    <span class="bx bx-plus"></span>&nbsp; Add
              </button></a></span>
						  <?php } else { ?>
				 <button disabled type="button" class="btn btn-primary" id="Addglucose" ">
				<span class="bx bx-plus"></span>&nbsp; Add
              </button></a></span>
			  <?php } ?>
                        </div>
                      </div>
                    </div>
					
					<div class="col-4 mb-4">
                     <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../assets/img/icons/unicons/cc-success.png" style="cursor:default" style="cursor:default" alt="Credit Card" class="rounded" />
                            </div>
                          </div>
                          <span class="fw-semibold d-Block mb-1" style="cursor:default">Thyroid Test Details</span>
						  <?php if($add_ind == "N" AND $Thy_Add == "N") {  ?>
                         <a href="AddThyroidDetails.php?History=<?php echo $AV_picmeno; ?>" ><span button type="button" class="btn btn-primary" id="Addvaccination">
                    <span class="bx bx-plus"></span>&nbsp; Add
              </button></a></span>
			  <?php } else { ?>
			  <button disabled type="button" class="btn btn-primary" id="Addvaccination" ">
				<span class="bx bx-plus"></span>&nbsp; Add
              </button></a></span>
			  <?php } ?>
                        </div>
                      </div>
                    </div>
					
					<div class="col-4 mb-4">
                     <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../assets/img/icons/unicons/cc-success.png" style="cursor:default" style="cursor:default" alt="Credit Card" class="rounded" />
                            </div>
                          </div>
                          <span class="fw-semibold d-Block mb-1" style="cursor:default">Vaccination Details</span>
						  <?php if($add_ind == "N" AND $Vac_Add == "N") {  ?>
                         <a href="AddVacnDtls.php?History=<?php echo $AV_picmeno; ?>" ><span button type="button" class="btn btn-primary" id="Addvaccination">
                    <span class="bx bx-plus"></span>&nbsp; Add
              </button></a></span>
			  <?php } else { ?>
			  <button disabled type="button" class="btn btn-primary" id="Addvaccination" ">
				<span class="bx bx-plus"></span>&nbsp; Add
              </button></a></span>
			  <?php } ?>
                        </div>
                      </div>
                    </div>
				  <div class="col-4 mb-4">
				     <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="../assets/img/icons/unicons/cc-success.png"
                                alt="chart success"
								style="cursor:default"
                                class="rounded"
                              />
                            </div>
                          </div>
                          <span class="fw-semibold d-Block mb-2" style="cursor:default">Prescription Details</span>
						  <?php if($add_ind == "N" AND $Pre_Add == "N") {  ?>
						  <a href="AddPrescriptionDetails.php?History=<?php echo $AV_picmeno; ?>" ><span button type="button" class="btn btn-primary" id="Addprescription">
                    <span class="bx bx-plus"></span>&nbsp; Add
              </button></a></span>
			  <?php } else { ?>
			  <button disabled type="button" class="btn btn-primary" id="Addprescription" ">
				<span class="bx bx-plus"></span>&nbsp; Add
              </button></a></span>
			  <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-4 mb-4">
                     <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../assets/img/icons/unicons/wallet.png" style="cursor:default" alt="Credit Card" class="rounded" />
                            </div>
                          </div>
                          <span class="fw-semibold d-Block mb-1" style="cursor:default">USG (Scan) Details</span>
						  <?php if($add_ind == "N" AND $USG_Add == "N") {  ?>
                         <a href="AddUSGDetails.php?History=<?php echo $AV_picmeno; ?>" ><span button type="button" class="btn btn-primary" id="AddUSG">
                    <span class="bx bx-plus"></span>&nbsp; Add
              </button></a></span>
			  <?php } else { ?>
			  <button disabled type="button" class="btn btn-primary" id="AddUSG" ">
				<span class="bx bx-plus"></span>&nbsp; Add
              </button></a></span>
			  <?php } ?>
                        </div>
                      </div>
                    </div>
<?php
$Checkusr = mysqli_query($conn,"SELECT * FROM users where id='".$userid."' AND (usertype=1 OR usertype=0)");
$Checkusr_val = mysqli_fetch_array($Checkusr);

$usr_typ = "N";
if(isset($Checkusr_val))
{
  $usr_typ = "Y";
  $usr_typ = $Checkusr_val["usertype"]; 
}
  print_r($usr_typ);
?>
<?php if($usr_typ == 'Y') { ?>
					<div class="col-4 mb-4">
					 <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../assets/img/icons/unicons/cc-warning.png" style="cursor:default" style="cursor:default" alt="Credit Card" class="rounded" />
                            </div>
                          </div>
                          <span class="fw-semibold d-Block mb-1" style="cursor:default">High Risk Details</span>
						  <?php if($add_ind == "N" AND $HR_Add == "N") {  ?>
                         <a href="AddHighRiskDtls.php?History=<?php echo $AV_picmeno; ?>" ><span button type="button" class="btn btn-primary" id="AddHighRisk">
                    <span class="bx bx-plus"></span>&nbsp; Add
              </button></a></span>
			  <?php } else { ?>
			   <button disabled type="button" class="btn btn-primary" id="AddHighRisk" ">
				<span class="bx bx-plus"></span>&nbsp; Add
              </button></a></span>
			  <?php } ?>
                        </div>
                      </div>
                    </div>
<?php } ?>
					                    
                </div>
                </div>
              </div>
<?php include ('require/dtFooter.php'); ?>