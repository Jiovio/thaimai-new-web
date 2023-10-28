<?php include ('require/topHeader.php'); ?>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search 
// Including the Code - Add !

if (isset($_GET['History'])) {
  $AV_picmeno = $_GET['History'];
  $picmeno =$AV_picmeno;
 }
 
$CheckANV_PrgWk = mysqli_query($conn,"SELECT * FROM antenatalvisit where picmeno=$AV_picmeno order by id desc LIMIT 0,1");
$CheckANV_PrgWk_val = mysqli_fetch_array($CheckANV_PrgWk);

$anc_cnt = "";
if(isset($CheckANV_PrgWk_val["pregnancyWeek"]) && !empty($CheckANV_PrgWk_val["pregnancyWeek"]))
{
  //print_r($CheckANV_PrgWk_val["ancPeriod"]); exit;
  $anc_cnt = $CheckANV_PrgWk_val["ancPeriod"]; 
}


if (! empty($_POST["VacnDtls"])) {
  $picmeno =$AV_picmeno;
  $Td1 = $_POST["Td1"];
  $TdDose = $_POST["TdDose"];
  $Td1Date = $_POST["Td1Date"];
  $Td2 = $_POST["Td2"];
  $Td2Dose = $_POST["Td2Dose"];
  $Td2Date = $_POST["Td2Date"];
  $Tdb = $_POST["Tdb"];
  $TdBdose = $_POST["TdBdose"];
  $TdBoosterDate = $_POST["TdBoosterDate"];
  $Covidvac = $_POST["Covidvac"]; 
  $Dose1Date = $_POST["Dose1Date"];
  $Dose2Date = $_POST["Dose2Date"];
  $PreDate = $_POST["PreDate"];
  
  $query = mysqli_query($conn, "UPDATE antenatalvisit SET Td1='$Td1',TdDose='$TdDose',Td1Date='$Td1Date',Td2='$Td1',Td2Dose='$Td2Dose',
 Td2Date='$Td2Date',Tdb='$Tdb',TdBdose='$TdBdose',TdBoosterDate='$TdBoosterDate',Covidvac='$Covidvac',Dose1Date='$Dose1Date',Dose2Date='$Dose2Date',
 preDate='$PreDate' WHERE picmeno='$picmeno' AND ancPeriod=$anc_cnt");
 
            if (!empty($query)) {
              echo "<script>alert('Inserted Successfully');window.location.replace('{$siteurl}/forms/AnVisitAddBtn.php?History=$AV_picmeno');</script>";
            } 
} 
?>
          <!-- Content wrapper --> 
          <div class="content-wrapper">
            <!-- Content -->
      <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Antenatal Visit /</span> Add Antenatal Visit
                
			  <a href="AnVisitAddBtn.php?History=<?php echo $AV_picmeno; ?>" ><button type="submit" class="btn btn-primary" id="btnBack">
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
			
		<?php 
	    	$AV_picme = $picmeno;
			
			$CheckAVDt1 = mysqli_query($conn,"SELECT * FROM antenatalvisit where picmeno=$AV_picme order by id desc LIMIT 0,1");
            $CheckAVDt1_Fnd = mysqli_fetch_array($CheckAVDt1);
			if(!empty($CheckAVDt1_Fnd))
            {
             $ANV_date = $CheckAVDt1_Fnd['anvisitDate']; 
            }

            $Td_ind = "";	
            $Cov_Ind = "N";
            $Td1_ind = "N";
            $Td2_ind = "N";
            $Td_Bst = "N";
            $CheckANV4 = mysqli_query($conn,"SELECT * FROM antenatalvisit where picmeno=$AV_picme AND (Covidvac=1 OR Covidvac=2)");
$CheckANVal4 = mysqli_fetch_array($CheckANV4);
if(!empty($CheckANVal4))
{
$Cov_Ind = "Y";
} 
else
{

$CheckANV3 = mysqli_query($conn,"SELECT * FROM antenatalvisit where picmeno=$AV_picme AND Tdb=1");
$CheckANVal3 = mysqli_fetch_array($CheckANV3);
if(!empty($CheckANVal3))	
{
$Td_Bst = "Y";
}
else
{

$CheckANV2 = mysqli_query($conn,"SELECT * FROM antenatalvisit where picmeno=$AV_picme AND Td2=1");
$CheckANVal2 = mysqli_fetch_array($CheckANV2);
if(!empty($CheckANVal2))
{
$Next_Tm_Int2 = $CheckANVal2['anvisitDate'];
$Td2_ind = "Y";
}
else
{
$CheckANV1 = mysqli_query($conn,"SELECT * FROM antenatalvisit where picmeno=$AV_picme AND Td1=1");
$CheckANVal1 = mysqli_fetch_array($CheckANV1);
if(!empty($CheckANVal1))
{
$Next_Tm_Int1 = $CheckANVal1['anvisitDate'];
$Dose_Td2_gap = date('Y-m-d', strtotime($Next_Tm_Int1. '+ 4 Weeks' )); /*4 weeks calculation*/

$startDate = new DateTime($Next_Tm_Int1);
$endDate = new DateTime($anvisitDate);
$interval = $startDate->diff($endDate);

$Td2_Td1_int = (int)(($interval->days) / 7);

//print_r($Td2_Td1_int);
if($Td2_Td1_int >= 4)
{
$Td1_ind = "Y";
}
}
else
{
$Td_ind = "Y";	
}
}}}
//print_r("here".$Td1_ind.$Td2_ind.$Td_Bst.$Cov_Ind);
/*$Td1_ind = "Y";
$Td2_ind = "Y";
$Td_Bst  = "Y";
$Cov_Ind = "Y";*/
					 ?>	
                      
					  <?php 
					    $Td1 = "";
					    $Td2 = "";
						$Tdb = "";
						
						$Cov1_Fnd_Ind = "N";
						$Next_Cov_Int1 = "";
					    $Cov2_Fnd_Ind = "N";
						$Next_Cov_Int2 = "";
						$Cov3_Fnd_Ind = "N";
						$Next_Cov_Int3 = "";
						$Dose_cov2_gap = "";
						$Dose_cov3_gap = "";
						$CheckCov1 = mysqli_query($conn,"SELECT * FROM antenatalvisit where picmeno=$AV_picme AND Dose1Date!=''");
                        $CheckCov1_Fnd = mysqli_fetch_array($CheckCov1);
                        if(!empty($CheckCov1_Fnd))
                        {
                         $Next_Cov_Int1 = $CheckCov1_Fnd['Dose1Date'];
                         $Cov1_Fnd_Ind = "Y";
						 $Dose_cov2_gap = date('Y-m-d', strtotime($Next_Cov_Int1. '+ 3 months' )); /*3 months calculation*/
						// print_r("Dose2".$Dose_cov2_gap); 
                        }
						else
						{
						$CheckCov2 = mysqli_query($conn,"SELECT * FROM antenatalvisit where picmeno=$AV_picme AND Dose2Date!=''");
                        $CheckCov2_Fnd = mysqli_fetch_array($CheckCov2);
                        if(!empty($CheckCov2_Fnd))
                        {
						 $Dose_cov3_gap = date('Y-m-d', strtotime($Next_Cov_Int2. '+ 3 months' )); /*3 months calculation*/	
                         $Next_Cov_Int2 = $CheckCov2_Fnd['Dose2Date'];
						 if($Next_Cov_Int2 >= $Dose_cov2_gap)
						 {
                         $Cov2_Fnd_Ind = "Y";
						 }
                        }	
                        else
                        {
						$CheckCov3 = mysqli_query($conn,"SELECT * FROM antenatalvisit where picmeno=$AV_picme AND PreDate!=''");
                        $CheckCov3_Fnd = mysqli_fetch_array($CheckCov3);
                        if(!empty($CheckCov3_Fnd))
                        {
                         $Next_Cov_Int3 = $CheckCov3_Fnd['PreDate'];
                         if($Next_Cov_Int3 >= $Dose_cov3_gap)
						 {
                         $Cov3_Fnd_Ind = "Y";
						 }
                        }	
                        }						
						}
					  ?>
						
					<div class="row">  
					<div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-TdBoosterDate">Td1 (Yes / No) </label>
                          <div class="input-group input-group-merge">
						  <?php if($Cov_Ind=='Y' OR $Td_Bst == 'Y' OR $Td2_ind == 'Y' OR $Td1_ind == 'Y')
						  { ?>
                          <input type=text name="Td1" id="Td1" class="form-control" readonly />
						  <?php }
						  else
						  { ?>
							<select name="Td1" id="Td1" class="form-select" onchange="Td1Change()">  
						  
                          <option value="">Choose...</option>
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { $Td1 = $listvalue['enumid']; ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php 
						  } ?>
						  
                             </select>
							 <?php
						  } ?>
                          </div>
                        </div>
                
						<div class="col-4 mb-3"  id="Tddose1" style="display: none;">
                          <label class="form-label" for="basic-icon-default-TdDose">Td1 Dose </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="TdDose"
                              class="form-control"
                              id="TdDose"
                              placeholder="Td Dose"
                              aria-label="Td Dose"
                              aria-describedby="basic-icon-default-TdDose"
                              
                              />
                          </div>
                        </div>

                        <div class="col-4 mb-3" id="Tddate1"  style="display: none;">
                          <label class="form-label" for="basic-icon-default-Td1Date">Td1 Date </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="Td1Date"
                              class="form-control"
                              id="Td1Date"
                              placeholder="Td1 Date"
                              aria-label="Td1 Date"
                              aria-describedby="basic-icon-default-Td1Date"
							  value=<?php echo $ANV_date; ?>
                              readonly
                              />
                          </div>
                        </div>
						</div>
                        
 <!---                        <div class="col-4 mb-3"  id="Tdd2" style="display: none;"> !--->
                          <div class="row">  
                          <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-TdBoosterDate">Td2 (Yes / No)</label>
                          <div class="input-group input-group-merge">
						  <?php if($Cov_Ind=='Y' OR $Td2_ind == 'Y' OR $Td_Bst == 'Y' OR $Td1_ind == 'N')
						  { ?>
                          <input type=text name="Td2" id="Td2" class="form-control" readonly />
						  <?php }
						  else
						  { ?>
                          <select name="Td2" id="Td2" class="form-select" onchange="Td2Change()" readonly>
                          <option value="">Choose...</option>
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { $Td2 = $listvalue['enumid']; ?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
							 <?php } ?>
                          </div>
                        </div>

          <div class="col-4 mb-3" id="Tddose2"  style="display: none;">
                          <label class="form-label" for="basic-icon-default-Td2Dose">Td2 Dose </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="text"
                              name="Td2Dose"
                              class="form-control"
                              id="Td2Dose"
                              placeholder="Td Dose"
                              aria-label="Td Dose"
                              aria-describedby="basic-icon-default-TdDose"
                              
                              />
                          </div>
                        </div>
                        <div class="col-4 mb-3" id="Tddate2"  style="display: none;">
                          <label class="form-label" for="basic-icon-default-Td1Date">Td2 Date </label>
                          <div class="input-group input-group-merge">
                            <input
                              type="date"
                              name="Td2Date"
                              class="form-control"
                              id="Td2Date"
                              placeholder="Td1 Date"
                              aria-label="Td1 Date"
                              aria-describedby="basic-icon-default-Td1Date"
							  value=<?php echo $ANV_date; ?>
                              readonly
                              
                              />
                          </div>
                        </div>
                        </div>
          
<!---		                <div class="col-4 mb-3"  id="Tddb" style="display: none;">   !--->
                          <div class="row">    
                          <div class="col-4 mb-3">
                          <label class="form-label" for="basic-icon-default-TdBoosterDate">Td Booster (Yes / No)</label>
                          <div class="input-group input-group-merge">
						  <?php if($Cov_Ind=='Y' OR $Td_Bst == 'Y' OR $Td2_ind == 'N')
						  { ?>
                          <input type=text name="Tdb" id="Tdb" class="form-control" readonly />
						  <?php }
						  else
						  { ?>
                          <select name="Tdb" id="Tdb" class="form-select" onchange="TdBChange()" readonly>
                          <option value="">Choose...</option>
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=13";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { $Tdb = $listvalue['enumid'];?>
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
							 <?php } ?>
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
                              value=<?php echo $ANV_date; ?>
                              readonly
                              />
                          </div>
                        </div>
						</div>
						<div class="row"> 
                        <div class="col-4 mb-3" id="Covidvacn" style="display: none;">
                          <label class="form-label" for="basic-icon-default-TdBoosterDate">Covid vaccination</label>
                          <div class="input-group input-group-merge">
						  <?php if($Cov_Ind=='Y')
						  { ?>
                          <input type=text name="Covidvac" id="Covidvac" class="form-control" readonly />
						  <?php }
						  else
						  { ?>
                          <select name="Covidvac" id="Covidvac" class="form-select" onchange="CovidChange()" readonly>
                          <option value="">Choose...</option>
                           <?php   
                            $query = "SELECT enumid,enumvalue FROM enumdata WHERE type=47";
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
							
                          <option value="<?php echo $listvalue['enumid']; ?>"><?php echo $listvalue['enumvalue']; ?></option>
                          <?php } ?>
                             </select>
							 <?php } ?>
                          </div>
                        </div>
						</div>

<?php //$Cov1_Fnd_Ind = "Y"; $Next_Cov_Int1 = "20250912";?>
                        <div class="row">  
                        <div class="col-4 mb-3" id="dose1" style="display: none;">
                          <label class="form-label" for="basic-icon-default-Dose1Date">Dose1 Date </label>
                          <div class="input-group input-group-merge">
						  <?php if($Cov1_Fnd_Ind=='Y')
						  { ?>
                          <input type="date" name="Dose1Date" id="Dose1Date" value=<?php echo $Next_Cov_Int1; ?> class="form-control" readonly />
						  <?php }
						  else
						  { ?>
                            <input
                              type="date"
                              name="Dose1Date"
                              class="form-control"
                              id="Dose1Date"
                              placeholder="Dose1 Date"
                              aria-label="Dose1 Date"
                              aria-describedby="basic-icon-default-Dose1Date"
                              value=<?php echo $ANV_date; ?>
                              readonly
                              />
						  <?php } ?>
                          </div>
                        </div>
                        
                        <div class="col-4 mb-3" id="dose2" style="display: none;">
                          <label class="form-label" for="basic-icon-default-Dose2Date">Dose2 date </label>
                          <div class="input-group input-group-merge">
						  <?php if($Cov2_Fnd_Ind=='Y' OR $Cov3_Fnd_Ind=='Y')
						  { ?>
                          <input type="date" name="Dose2Date" id="Dose2Date" value=<?php echo $Next_Cov_Int2; ?> class="form-control" readonly />
						  <?php }
						  else
						  { ?>
                            <input
                              type="date"
                              name="Dose2Date"
                              class="form-control"
                              id="Dose2Date"
                              placeholder="Dose2 Date"
                              aria-label="Dose2 Date"
                              aria-describedby="basic-icon-default-Dose2Date"
                              readonly
                              value=<?php 
							          if($Cov1_Fnd_Ind=='Y')
									  { echo $ANV_date;} 
								       ?>
                              />
						  <?php } ?>
                          </div>
                        </div>
                        
						  <div class="col-4 mb-3" id="predose" style="display: none;">
                          <label class="form-label" for="basic-icon-default-PreDate">Precaution Dose Date </label>
                          <div class="input-group input-group-merge">
						  <?php if($Cov2_Fnd_Ind=='Y' OR $Cov3_Fnd_Ind=='Y' OR $Cov1_Fnd_Ind=='Y')
						  { ?>
                          <input type="date" name="PreDate" id="PreDate" value=<?php echo $Next_Cov_Int3; ?> class="form-control" readonly />
						  <?php }
						  else
						  { ?>
                            <input
                              type="date"
                              name="PreDate"
                              class="form-control"
                              id="PreDate"
                              placeholder="Pre Date"
                              aria-label="Pre Date"
                              aria-describedby="basic-icon-default-PreDate"
                              readonly
                              value=<?php 
							          if($Cov2_Fnd_Ind=='Y')
									  { echo $ANV_date;} 
								       ?>
                              />
						  <?php } ?>
                          </div>
                        </div>
						</div>
             </div>
			 <input type="submit" name="VacnDtls" value="Save" id="VacnDtls" class="btn btn-primary" onclick="return checkPicmeAV()">
			</div>
				
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->
<?php include ('require/footer.php'); ?>
