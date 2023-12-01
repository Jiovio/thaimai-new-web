<?php include ('require/topHeader.php'); ?>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search 
// Including the Code - Add !

if (isset($_GET['History'])) {
	$id = $_GET['History'];
 }
 

$anc_cnt = "";
$anc_dt = "";
$trns_dt = "";
$HR_Ind = "N";
$HR_val = "";
$Mis_Crg = "N";

 
$CheckANV_PrgWk = mysqli_query($conn,"SELECT * FROM antenatalvisit where id=$id");
$CheckANV_PrgWk_val = mysqli_fetch_array($CheckANV_PrgWk);

$id = "";

$id = $CheckANV_PrgWk_val["id"];
$AV_picmeno = $CheckANV_PrgWk_val["picmeno"];
$picmeno =$AV_picmeno;
$HighRisk = $CheckANV_PrgWk_val["HighRisk"];
$HighRisk_val = $CheckANV_PrgWk_val["HighRisk"];
//print_r("Hi".$HighRisk_val);
$symptomsHighRisk = $CheckANV_PrgWk_val["symptomsHighRisk"];
$referralDate = $CheckANV_PrgWk_val["referralDate"]; 
$referralDistrict = $CheckANV_PrgWk_val["referralDistrict"];
$referralFacility = $CheckANV_PrgWk_val["referralFacility"]; 
$referralPlace = $CheckANV_PrgWk_val["referralPlace"];
$bloodTransfusion = $CheckANV_PrgWk_val["bloodTransfusion"];
$bloodTransfusionDate = $CheckANV_PrgWk_val["bloodTransfusionDate"];
$placeAdministrator = $CheckANV_PrgWk_val["placeAdministrator"];
$nooIVdoses = $CheckANV_PrgWk_val["noOfIVDoses"];
//print_r("$nooIVdoses".$nooIVdoses);

if(isset($CheckANV_PrgWk_val["pregnancyWeek"]) && !empty($CheckANV_PrgWk_val["pregnancyWeek"]))
{
  //print_r($CheckANV_PrgWk_val["ancPeriod"]); exit;
 // print_r("Testing"); exit;
  $anc_cnt = $CheckANV_PrgWk_val["ancPeriod"]; 
  $anc_dt = $CheckANV_PrgWk_val["anvisitDate"];
  $trns_dt = date('Y-m-d', strtotime($anc_dt. '+ 14 days' ));
  if( 
 ($CheckANV_PrgWk_val["Hb"] > 0 AND $CheckANV_PrgWk_val["Hb"] < 10) OR 
 $CheckANV_PrgWk_val["urineSugarPresent"] == 1 OR 
 $CheckANV_PrgWk_val["urineAlbuminPresent"] == 1 OR 
 $CheckANV_PrgWk_val["gctValue"] > 140 OR 
 $CheckANV_PrgWk_val["Tsh"] == 'yes' OR 
 $CheckANV_PrgWk_val["bpSys"] > 130 OR 
 $CheckANV_PrgWk_val["bpDia"] > 90 OR 
 ($CheckANV_PrgWk_val["motherWeight"] > 0 AND $CheckANV_PrgWk_val["motherWeight"] < 40) OR 
 $CheckANV_PrgWk_val["fastingSugar"] > 110 OR 
 $CheckANV_PrgWk_val["postPrandial"] > 140 OR 
 ($CheckANV_PrgWk_val["fetalHeartRate"] > 0 AND $CheckANV_PrgWk_val["fetalHeartRate"] < 100) OR 
 $CheckANV_PrgWk_val["fetalHeartRate"] > 170 OR 
 $CheckANV_PrgWk_val["fetalPosition"] == 2 OR 
 $CheckANV_PrgWk_val["fetalMovement"] == 4)
 {
	$HR_Ind = "Y"; 
	if($CheckANV_PrgWk_val["Hb"] > 0 AND $CheckANV_PrgWk_val["Hb"] < 10)
	{
	 $HR_val = 'Severe Anaemia';	
	}
	else
	if($CheckANV_PrgWk_val["urineSugarPresent"] == 1)
	{
	 $HR_val = 'Gestational Diabetes';	
	}
	else
	if($CheckANV_PrgWk_val["urineAlbuminPresent"] == 1)
	{
	 $HR_val = 'Kidney Disease';	
	}
	else
	if($CheckANV_PrgWk_val["gctValue"] > 140)
	{
	 $HR_val = 'GDM';	
	}
	else
	if($CheckANV_PrgWk_val["Tsh"] == 'yes')
	{
	 $HR_val = 'hyperthyroidism';	
	}
	else
	if($CheckANV_PrgWk_val["bpSys"] > 130)
	{
	 $HR_val = 'PIH/Pre Eclampsia/Eclampsia';	
	}
	else
	if($CheckANV_PrgWk_val["bpDia"] > 90)
	{
	 $HR_val = 'PIH/Pre Eclampsia/Eclampsia';	
	}
	else
	if($CheckANV_PrgWk_val["motherWeight"] > 0 AND $CheckANV_PrgWk_val["motherWeight"] < 40)
	{
	 $HR_val = 'Weight below 40 kg';	
	}
	else
	if($CheckANV_PrgWk_val["fastingSugar"] > 110)
	{
	 $HR_val = 'High Blood Pressure';	
	}
	else
	if($CheckANV_PrgWk_val["postPrandial"] > 140)
	{
	 $HR_val = 'Gestational Diabetes';	
	}
	else
	if($CheckANV_PrgWk_val["fetalHeartRate"] > 0 AND $CheckANV_PrgWk_val["fetalHeartRate"] < 100)
	{
	 $HR_val = 'Bradyhardic';	
	}
	else
	if($CheckANV_PrgWk_val["fetalHeartRate"] > 170)
	{
	 $HR_val = 'Fetal Distress';	
	}
	else
	if($CheckANV_PrgWk_val["fetalPosition"] == 2)
	{
	 $HR_val = 'Breech';	
		}
	else
	if($CheckANV_PrgWk_val["fetalMovement"] == 4)
	{
	 $HR_val = 'Absent Fetal Movement';	
	}
	
	if($CheckANV_PrgWk_val["Hb"] > 0 AND $CheckANV_PrgWk_val["Hb"] < 7)
	{
	 $HR_val = 'Chance to Miscarriage';	
     $Mis_Crg = "Y";	  	 
	}
	else
	{
	 $bloodTransfusion = ""; 
     $bloodTransfusionDate = ""; 
     $placeAdministrator = ""; 
     $nooIVdoses = "";	
	}
 }
}

if($Mis_Crg == "N")
{
	 $bloodTransfusion = ""; 
     $bloodTransfusionDate = ""; 
     $placeAdministrator = ""; 
     $nooIVdoses = "";	
	}
//print_r("HighRisk".$HighRisk."HR_Ind".$HR_Ind);

if (! empty($_POST["HRDtls"])) {
  $picmeno =$AV_picmeno;
 
  $HighRisk = $_POST['HighRisk'];
  print_r("Hello"."Here".$_POST['symptomsHighRisk']); exit;
 if(isset($HighRisk) AND $HighRisk==1)
 {
  $symptomsHighRisk = $_POST['symptomsHighRisk'];
 }
 else
 {
	$symptomsHighRisk = ""; 
 }
  // print_r("test".$HighRisk.$symptomsHighRisk); exit;
  $referralFacility = $_POST["referralFacility"];
  if(isset($referralFacility) AND $referralFacility==1)
 {
   $referralDate = $_POST["referralDate"]; 
   $referralDistrict = $_POST["referralDistrict"]; 
   $referralPlace = $_POST["referralPlace"]; 
 }
 else
 {
  $referralDate = "";
  $referralDistrict = "";
  $referralPlace = "";
 }
   $bloodTransfusion =$_POST["bloodTransfusion"]; 
   $bloodTransfusionDate = $_POST["bloodTransfusionDate"]; 
   $placeAdministrator = $_POST["placeAdministrator"]; 
   $nooIVdoses = $_POST["noOfIVDoses"];  
   
   print_r("Test");
  
  $query = mysqli_query($conn, "UPDATE antenatalvisit SET HighRisk='$HighRisk',symptomsHighRisk='$symptomsHighRisk',
           referralDate = '$referralDate', referralDistrict = '$referralDistrict', referralFacility = '$referralFacility',
           referralPlace = '$referralPlace', bloodTransfusion = '$bloodTransfusion', bloodTransfusionDate = '$bloodTransfusionDate',
		   placeAdministrator = '$placeAdministrator', noOfIVDoses = '$nooIVdoses' WHERE picmeno='$picmeno' AND ancPeriod=$anc_cnt");
 
            if (!empty($query)) {
              echo "<script>alert('Updated Successfully');window.location.replace('{$siteurl}/forms/AntenatalVisitDtl.php?History=$picmeno');</script>";
            } 
} 
?>
          <!-- Content wrapper --> 
          <div class="content-wrapper">
            <!-- Content -->
      <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Antenatal Visit /</span> Edit High Risk Details
                
			  <a href="EditAnVisit.php?view=<?php echo $id; ?>" ><button type="submit" class="btn btn-primary" id="btnBack">
                    <span class="bx bx-arrow-back"></span>&nbsp; Back
              </button></a>
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
                <form id="form" action="" method="post" onSubmit="return checkPicmeAV(this);">
                      
				<div id="firstDiv">
					<div class="row">
        
        <input type="text" required id="AVpicmeno" hidden name="picmeno" oninput = "onlyNumbers(this.value)" onclick="return checkPicmeAV()" value="<?php echo $AV_picmeno; ?>" placeholder="RCHID (PICME) Number" class="form-control" />
		

		
		<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-highRisk">Symptoms High Risk <span class="mand">* </span></label>
                          <div class="input-group input-group-merge">
						  <?php if($HR_Ind == "N" AND ($HighRisk != 0 AND $HighRisk != 1)) {; ?>
                          <select required name="HighRisk" id="highRisk" onChange="SymHighRishChange()" class="form-select">
                          <option value="">Choose...</option>
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>" 
						  <selected ><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
							 
							 <?php } else {?> 
							 <?php if($HR_Ind == "N" AND ($HighRisk == 1)) {; ?>
                          <select disabled required name="HighRisk" style="color: red;" id="highRisk" onClick="SymHighRishChange()" class="form-select">
                          
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13 AND enumid=1";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>" 
						  <selected ><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
							 <select hidden required name="HighRisk" style="color: red;" id="highRisk" onClick="SymHighRishChange()" class="form-select">
                          
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13 AND enumid=1";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>" 
						  <selected ><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
							 <?php } else {?> 
							 <?php if($HR_Ind == "N" AND ($HighRisk == 0)) {; ?>
                          <select disabled required name="HighRisk" style="color: red;" id="highRisk" onClick="SymHighRishChange()" class="form-select">
                          
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13 AND enumid=0";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>" 
						  <selected ><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
							 <select hidden required name="HighRisk" style="color: red;" id="highRisk" onClick="SymHighRishChange()" class="form-select">
                          
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13 AND enumid=0";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>" 
						  <selected ><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
							
							 <?php } else {?> 
							 <select disabled required name="HighRisk" style="color: red;" id="highRisk" onClick="SymHighRishChange()" class="form-select">
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13 AND enumid=1";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>" 
						  <selected ><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
							 <select hidden required name="HighRisk" style="color: red;" id="highRisk" onClick="SymHighRishChange()" class="form-select">
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13 AND enumid=1";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>" 
						  <selected ><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
							 
							 <?php }}} ?> 
                          </div>
                        </div>
						
						   <div class="col-4 mb-3" id="symptom" <?php if(($HR_Ind == "N") AND ($HighRisk == 0)) {;?> style="display: none;" <?php }; ?> >
                          <label class="form-label" for="basic-icon-default-symptomsHighRisk"> Symptoms High Risk During Visit <!--<span class="mand">* </span>--></label>
                          <div class="input-group input-group-merge">
						  <?php if(($HR_Ind == "N") AND ($HighRisk == 0)) {; ?>
                            <select name="symptomsHighRisk" id="symptomsHighRisk" class="form-select" >
                          <option value="">Choose...</option>
                        
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=51";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          
                          <?php  } ?>
                             </select>
							  <?php } else 
								  if (empty($HR_val) AND isset($symptomsHighRisk)) {?> 
						  <select name="symptomsHighRisk" id="symptomsHighRisk" disabled style="color: red;" class="form-select">
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
						   <select name="symptomsHighRisk" id="symptomsHighRisk" hidden style="color: red;" class="form-select">
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
                          <?php $symptomsHighRisk = "";} } ?>
                           </select>
						  
								  <?php } else { ?>
						  <input disabled name="symptomsHighRisk" style="color: red;" id="symptomsHighRisk"
                              value = "<?php echo $HR_val;  ?>"  							  
							  class="form-select" >
							  <input hidden name="symptomsHighRisk" style="color: red;" id="symptomsHighRisk"
                              value = "<?php echo $HR_val;  ?>"  							  
							  class="form-select" >
								  <?php } ?>
                          </div>
                        </div>
						<div class="col-4 mb-3" id="refFacility" <?php if(($HR_Ind == "N") AND ($HighRisk == 0)) {;?> style="display: none;" <?php }; ?>>
                          <label class="form-label" for="basic-icon-default-referralFacility">Referral Facility </label>
                          <div class="input-group input-group-merge">
						  <select name="referralFacility" id="referralFacility" class="form-select" onchange="RefChange()">
						  <?php 
						  if(isset($referralFacility ))
							{
                            $query = "SELECT av.referralFacility,enumid,enumvalue FROM antenatalvisit av join enumdata e on e.enumid=av.referralFacility WHERE type=13 AND av.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { 
							
							?>
							
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$referralFacility) ?>
                         <?php { echo $listvalue['enumvalue']; } ?>
                         <?php 
                                    $dquery = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                                    $exequery = mysqli_query($conn, $dquery);
                                    while($listvalue = mysqli_fetch_assoc($exequery)) { 
                                    ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
							<?php } }} else { ?>
                          <option value="">Choose...</option>
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
							<?php }}?>
                             </select>
                          </div>
                        </div>
                        <div class="col-4 mb-3" id="refDist" <?php if((empty($referralFacility) OR $referralFacility == 0)) {;?> style="display: none;" <?php }; ?>>
                          <label class="form-label" for="basic-icon-default-referralDistrict">Referral District </label>
                          <div class="input-group input-group-merge">
						  <?php if(isset($referralDistrict) AND !empty($referralDistrict)) { ?>
							<input
                              type="text"
                              name="referralDistrict"
                              class="form-control"
                              id="referralDistrict"
                              placeholder="Referral District"
                              aria-label="Referral District"
                              aria-describedby="basic-icon-default-referralDistrict"
							  value = <?php echo $referralDistrict; ?> 
                              /> 
						  <?php } else { ?>
						  <input
                              type="text"
                              name="referralDistrict"
                              class="form-control"
                              id="referralDistrict"
                              placeholder="Referral District"
                              aria-label="Referral District"
                              aria-describedby="basic-icon-default-referralDistrict" 
/>
                               
						  <?php } ?>
                          </div>
                        </div>

						            <div class="col-4 mb-3"  id="refPlace" <?php if((empty($referralFacility) OR $referralFacility == 0)) {;?> style="display: none;" <?php }; ?>
                          <label class="form-label" for="basic-icon-default-referralDate">Referral Place </label>
                          <div class="input-group input-group-merge">
						  <?php 
						  if(isset($referralPlace) AND !empty($referralPlace))
							{ ?>
                            <input
                              type="text"
                              name="referralPlace"
                              class="form-control"
                              id="referralPlace"
                              placeholder="Referral Place"
                              aria-label="Referral Place"
                              aria-describedby="basic-icon-default-referralDate"
							  value = <?php echo $referralPlace; ?> 
                              />
							  <?php } else { ?>
							  <input
                              type="text"
                              name="referralPlace"
                              class="form-control"
                              id="referralPlace"
                              placeholder="Referral Place"
                              aria-label="Referral Place"
                              aria-describedby="basic-icon-default-referralDate"
                              /> 
							  <?php } ?>
                          </div>
                        </div>

                        <?php $cur_dt = date('Y-m-d'); ?>
						<div class="col-4 mb-3"  id="refDate" <?php if((empty($referralFacility) OR $referralFacility == 0)) {;?> style="display: none;" <?php }; ?>
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
                              value = <?php if(isset($referralDate) AND !empty($referralDate)) { echo $referralDate; } else {echo $cur_dt; } ?>
							  readonly
                              />
                          </div>
                        </div> 
						
						  <div class="col-4 mb-3" id="bTrans" <?php if($Mis_Crg == "N") {;?> style="display: none;" <?php }; ?>>
                          <label class="form-label" for="basic-icon-default-bloodTransfusion">Transfusion <!--<span class="mand">* </span>--></label>
                          <div class="input-group input-group-merge">
						  <?php 
						  if(isset($bloodTransfusion) AND !empty($bloodTransfusion))
							{ ?>
                          <select name="bloodTransfusion" id="bloodTransfusion" class="form-select" <?php if($Mis_Crg == "Y") {; ?> required <?php }; ?> >
                          
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=44";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
							 <?php } else { ?>
							 <select name="bloodTransfusion" id="bloodTransfusion" class="form-select" <?php if($Mis_Crg == "Y") {; ?> required <?php }; ?> >
                          <option value="">Choose...</option>
                          <?php
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=44";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
							  <?php } ?>
                          </div>
                        </div>
                        <div class="col-4 mb-3" id="transDate" <?php if($Mis_Crg == "N") {;?> style="display: none;" <?php }; ?>>
                          <label class="form-label" for="basic-icon-default-bloodTransfusionDate">Transfusion Date <!--<span class="mand">* </span>--></label>
                          <div class="input-group input-group-merge">
						  <?php 
						  if(isset($bloodTransfusionDate) AND !empty($bloodTransfusionDate))
							{ ?>
                            <input
                              type="date"
                              name="bloodTransfusionDate"
                              class="form-control"
                              id="bloodTransfusionDate"
                              placeholder="USG REPORT URL"
                              aria-label="USG REPORT URL"
                              aria-describedby="basic-icon-default-bloodTransfusionDate"
							  min=<?php echo $anc_dt; ?> 
       						  max=<?php echo $trns_dt; ?> 
							  value = <?php echo $bloodTransfusionDate; ?>
                              <?php if($Mis_Crg == "Y") {; ?> required <?php }; ?>							  
                               />
							    <?php } else { ?>
								<input
                              type="date"
                              name="bloodTransfusionDate"
                              class="form-control"
                              id="bloodTransfusionDate"
                              placeholder="USG REPORT URL"
                              aria-label="USG REPORT URL"
                              aria-describedby="basic-icon-default-bloodTransfusionDate"
							  min=<?php echo $anc_dt; ?> 
       						  max=<?php echo $trns_dt; ?>
                              <?php if($Mis_Crg == "Y") {; ?> required <?php }; ?>							  
                               />
							   <?php } ?>
                          </div>
                        </div>
						           <div class="col-4 mb-3" id="placeAdmin" <?php if($Mis_Crg == "N") {;?> style="display: none;" <?php }; ?>>
                          <label class="form-label" for="basic-icon-default-placeAdministered">Place Administered <!--<span class="mand">* </span>--></label>
                          <div class="input-group input-group-merge">
						  <?php 
						  if(isset($placeAdministrator) AND !empty($placeAdministrator))
							{ ?>
                            <input
                              type="text"
                              name="placeAdministrator"
                              class="form-control"
                              id="placeAdministrator"
                              placeholder="Place Administered"
                              aria-label="Place Administered"
                              aria-describedby="basic-icon-default-placeAdministered"
							   value = <?php echo $placeAdministrator; ?>
							  <?php if($Mis_Crg == "Y") {; ?> required <?php }; ?>
                               />
							   <?php } else { ?>
							   <input
                              type="text"
                              name="placeAdministrator"
                              class="form-control"
                              id="placeAdministrator"
                              placeholder="Place Administered"
                              aria-label="Place Administered"
                              aria-describedby="basic-icon-default-placeAdministered"
							  <?php if($Mis_Crg == "Y") {; ?> required <?php }; ?>
                               />
							   <?php } ?>
							   
                          </div>
                        </div>
					
				        <div class="col-4 mb-3" id="ivDoses" <?php if($Mis_Crg == "N") {;?> style="display: none;" <?php }; ?> >
                        <label class="form-label" for="basic-icon-default-noOfIVDoses">No. of Units / IV Doses <!--<span class="mand">* </span>--></label>
                        <div class="input-group input-group-merge">
						<?php 
						  if(isset($nooIVdoses) AND !empty($nooIVdoses))
							{ ?>
                            <input
                              type="number"
                              name="noOfIVDoses"
                              class="form-control"
                              id="noOfIVDoses"
                              placeholder="No. of Units / IV Doses"
                              aria-label="No. of Units / IV Doses"
                              aria-describedby="basic-icon-default-noOfIVDoses"
							  <?php if($Mis_Crg == "Y") {; ?> required <?php }; ?>
							  min=1 max=4
							  value = <?php echo $nooIVdoses; ?>
                               />
							   <?php } else { ?>
							   <input
                              type="number"
                              name="noOfIVDoses"
                              class="form-control"
                              id="noOfIVDoses"
                              placeholder="No. of Units / IV Doses"
                              aria-label="No. of Units / IV Doses"
                              aria-describedby="basic-icon-default-noOfIVDoses"
							  <?php if($Mis_Crg == "Y") {; ?> required <?php }; ?>
							  min=1 max=4
                               />
							    <?php } ?>
                        </div>
                        </div>
					    </div>				
								
             </div>
			 <input type="submit" name="HRDtls" value="Update" id="HRDtls" class="btn btn-primary" onclick="return checkPicmeAV()">
			</div>
				
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->
<?php include ('require/footer.php'); ?>
