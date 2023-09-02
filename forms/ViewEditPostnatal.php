<?php include ('require/topHeader.php'); ?>
<?php session_start(); ?>
<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search
$picmeNo = ""; $pncPeriod = ""; $motherPnc = ""; $ifaTabletStatus = ""; 
$ppcMethod = ""; $mDangerSign = ""; $bloodSugar = ""; $weight =  ""; $iDSigns = "";
$id =0;

  if (isset($_GET['view']) OR isset($_GET['delview'])) {
	   if(isset($_GET['view'])) /*Added Newly*/
		{
	     $id = $_GET['view'];		 
		}
  //  $id = $_GET['view'];
  
    $del_view_ind = "N";
		if(isset($_GET['delview']))
		{
	     $del_view_ind = "Y";	
         $id = $_GET['delview'];		 
		}
    $view = true;
    $record = mysqli_query($conn, "SELECT * FROM postnatalvisit WHERE id=$id");

    $pv = mysqli_fetch_array($record);
    $picmeNo =$pv["picmeNo"]; 
    $pncPeriod = $pv["pncPeriod"]; 
    $motherPnc = $pv["motherPnc"];
    $ifaTabletStatus = $pv["ifaTabletStatus"]; 
    $calcium = $pv['calcium'];
    $ppcMethod = $pv["ppcMethod"]; 
    $vitaminA = $pv["vitaminA"]; 
    $mDangerSign = $pv["motherDangerSign"]; 
    $bloodSugar = $pv["bloodSugar"];
    $weight = $pv["infantWeight"]; 
    $iDSigns = $pv["infantDangerSigns"]; 
    $bpSys = $pv["bpSys"];  
    $bpDia = $pv["bpDia"];
}

 if (! empty($_POST["editpostnatal"])) {
    $id = $_POST["id"];
  //  $pncPeriod = $_POST["pncPeriod"]; 
    $motherPnc = $_POST["motherPnc"];
    $ifaTabletStatus = $_POST["ifaTabletStatus"]; 
    $calcium = $_POST['calcium'];
    $ppcMethod = $_POST["ppcMethod"]; 
    $vitaminA = $_POST["vitaminA"]; 
    $mDangerSign = $_POST["motherDangerSign"]; 
    $bloodSugar = $_POST["bloodSugar"];
    $weight = $_POST["infantWeight"]; 
    $iDSigns = $_POST["infantDangerSigns"];
    $bpSys = $_POST["bpSys"];  
    $bpDia = $_POST["bpDia"];  
    date_default_timezone_set('Asia/Kolkata');
    $date = date('d-m-Y h:i:s');
				
	$rec_del_pic = mysqli_query($conn, "SELECT * FROM postnatalvisit p WHERE $id = p.id");
    $n_del = mysqli_fetch_array($rec_del_pic);
	$Del_picmeNo = "";
	$Del_picmeNo = $n_del['picmeNo'];
	
	$str_dt = "";
	$str_dt = $_POST["motherPnc"];
			  
    $sub_cnt = 0;		
    $sub_cnt = strpos(strval($str_dt),"-");
	$dt_len = 0;
	$dt_len = substr(strval($str_dt),0,($sub_cnt));
	
	if(strlen($dt_len) > 4 OR strlen($dt_len) < 4 OR (int)$str_dt < 1970 OR (int)$str_dt > 2023)
	{
	 echo "<script> alert('Invalid year. Not Updated'); window.location.replace('{$siteurl}/forms/ViewEditPostnatal.php?view=$id');</script>";
	}		
	else
	{
    $query = mysqli_query($conn,"UPDATE postnatalvisit SET calcium='$calcium',pncPeriod='$pncPeriod',vitaminA='$vitaminA',motherPnc='$motherPnc',ifaTabletStatus='$ifaTabletStatus',ppcMethod='$ppcMethod',motherDangerSign='$mDangerSign',
    bloodSugar='$bloodSugar',infantWeight='$weight',infantDangerSigns='$iDSigns',bpSys='$bpSys',bpDia='$bpDia',updatedat='$date',updatedBy='$userid' WHERE id=".$id);
    if (!empty($query)) { 
            echo "<script>alert('Updated Successfully');window.location.replace('{$siteurl}/forms/PostnatalVisitDtl.php?History=$Del_picmeNo');</script>";
	}
          } }

if (isset($_GET['del'])) {
    $id = $_GET['del'];
    date_default_timezone_set('Asia/Kolkata');
    $date = date('d-m-Y h:i:s');
   // mysqli_query($conn, "UPDATE postnatalvisit SET status=0, deletedat='$date', deletedBy='$userid' WHERE status=1 AND id=$id");
   // $_SESSION['message'] = "User deleted!"; 
   
   $rec_del_pic = mysqli_query($conn, "SELECT * FROM postnatalvisit p WHERE $id = p.id AND
		                       p.pncPeriod = (SELECT max(CAST(p1.pncPeriod AS SIGNED)) From postnatalvisit p1 where p1.picmeNo = p.picmeNo)");
		      $n_del = mysqli_fetch_array($rec_del_pic);
	          $Del_picmeNo = "";
	          $Del_picmeNo = $n_del['picmeNo'];
			//  print_r($Del_picmeNo); exit;
	
	mysqli_query($conn, "DELETE FROM postnatalvisit WHERE id=$id");
	
    echo "<script>alert('Deleted Successfully');window.location.replace('{$siteurl}/forms/PostnatalVisitDtl.php?History=$Del_picmeNo');</script>";
  }
?>
<!-- Content wrapper -->
   <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Postnatal /</span> 
              <?php if($view == true) {
                  echo "View";
              } else {
                  echo "Edit";
              } ?> Postnatal
            
              <a href="PostnatalVisitDtl.php?History=<?php echo $picmeNo; ?>"><button type="submit" class="btn btn-primary" id="btnBack">
                    <span class="bx bx-arrow-back"></span>&nbsp; Back
              </button></a>
            
              <button type="submit" id="edit" class="btn btn-success btnSpace edit" value="<?php echo $id; ?>" onclick="fnPostEnable()">
                    <span class="bx bx-edit"></span>&nbsp; Edit
              </button>
			  			  
			  <?php if($_SESSION["usertype"] == '0' || $_SESSION["usertype"] == '1' || $_SESSION["usertype"] == '2') { ?>
              <?php
			 // PRINT_R($id); EXIT;
			 
			 
			  $rec_del_pic = mysqli_query($conn, "SELECT * FROM postnatalvisit p WHERE $picmeNo = p.picmeNo AND
		                       p.pncPeriod = (SELECT max(CAST(p1.pncPeriod AS SIGNED)) From postnatalvisit p1 where p1.picmeNo = p.picmeNo)");
			  $n_del = "";
			  $n_del = mysqli_fetch_array($rec_del_pic);
	          $Del_picmeNo = "";
	          $Del_picmeNo = $n_del['picmeNo'];
			//  print_r($picmeNo."*".$n_del['id']."*".$id); exit;
			  
			  if(($n_del['id']==$id))
			  {
			  ?>
			  	  <a href="../forms/ViewEditPostnatal.php?del=<?php echo $n_del['id']; ?>" onclick="return confirm('Are you sure to delete?')"><button type="submit" class="btn btn-danger btnSpace">
                    <span class="bx bx-minus"></span>&nbsp; Delete
              </button></a>
			  <?php }
			  else
			  { 
		//  print_r("I am here!"); exit;
		       if ($del_view_ind == "Y")
			   { 
		        echo "<script>alert('Can delete only the most recent visit !!!')</script>"; ?>
				 <a href="../forms/ViewEditPostnatal.php?delview=<?php echo $id; ?>"><button type="submit" class="btn btn-danger btnSpace">
                    <span class="bx bx-minus"></span>&nbsp; Delete
              </button></a> 
			   <?php }
		   else
		   { ?>
		     <a href="../forms/ViewEditPostnatal.php?delview=<?php echo $id; ?>"><button type="submit" class="btn btn-danger btnSpace">
                    <span class="bx bx-minus"></span>&nbsp; Delete
              </button></a>   
			  
			  
			<?php }}} ?>
            
             </h4>
              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                
                    <hr class="my-0" />
                    <div class="card-body">
                      <form id="formAccountSettings" method="POST">
                          <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label class="form-label">PICME NUMBER</label>
                            <div class="input-group input-group-merge">
                            <label class="lblViolet"><?php echo $picmeNo; ?>
                              </label>
                          </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label">PNC PERIOD <span class="mand">* </span></label>
                            
							
							<?php  
                            $query = "SELECT p.pncPeriod,enumid,enumvalue FROM postnatalvisit p join enumdata e on e.enumid=p.pncPeriod WHERE type=17 AND p.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) {
                            if($listvalue['enumid'] == 1)
									{
										$print_val = "1st day";
									}
							else
								if($listvalue['enumid'] == 2)
									{
										$print_val = "3rd day";
									}
							else
								if($listvalue['enumid'] == 3)
									{
										$print_val = "7th day";
									}		
							else
								if($listvalue['enumid'] == 4)
									{
										$print_val = "14th day";
									}
							else
								if($listvalue['enumid'] == 5)
									{
										$print_val = "21st day";
									}
							else
								if($listvalue['enumid'] == 6)
									{
										$print_val = "28th day";
									}
							else
								if($listvalue['enumid'] == 7)
									{
										$print_val = "42nd day";
									}	
									}
								?>
							<input
                              type="text"
                              class="form-control"
                              id="pncPeriod"
                              name="pncPeriod"
                              placeholder=""
                             value="<?php echo $print_val; ?>"   
                            readonly = "readonly"
                            />
							
                          </div>
                          </div>
                        <div class="row">
						                          <div class="mb-3 col-md-6">
                            <label for="zipCode" class="form-label">MOTHER PNC DATE </label>
                            <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                            <input
                              type="text"
                              class="form-control"
                              id="motherPnc"
                              name="motherPnc"
                              placeholder=""
							 
                             value="<?php echo $motherPnc; ?>"
							 disabled
							 
                            />
							
							
                          </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label">IFA TABLET</label>
                            <select name="ifaTabletStatus" id="ifaTabletStatus" class="form-select" disabled>
                           <?php  
                          $query = "SELECT p.ifaTabletStatus,enumid,enumvalue FROM postnatalvisit p join enumdata e on e.enumid=p.ifaTabletStatus WHERE type=13 AND p.id=".$id;
                          $exequery = mysqli_query($conn, $query);
                          while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                        <option value="<?php echo $listvalue['enumid']; ?>">
                        <?php if($listvalue['enumvalue']==$ifaTabletStatus){ echo "selected"; } ?>
                       <?php echo $listvalue['enumvalue']; ?>
                       <option value="1">Yes</option>
                        <option value="0">No</option>
                              </option>
                          <?php  } 
                              ?>
                             </select>
                          </div>
                          
                          </div>
                        <div class="row">

                          <div class="mb-3 col-md-6">
                            <label class="form-label">Calcium</label>
                            <select name="calcium" id="calcium" class="form-select" disabled>
                           <?php  
                          $query = "SELECT p.calcium,enumid,enumvalue FROM postnatalvisit p join enumdata e on e.enumid=p.calcium WHERE type=13 AND p.id=".$id;
                          $exequery = mysqli_query($conn, $query);
                          while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                        <option value="<?php echo $listvalue['enumid']; ?>">
                        <?php if($listvalue['enumvalue']==$calcium){ echo "selected"; } ?>
                       <?php echo $listvalue['enumvalue']; ?>
                       <option value="1">Yes</option>
                        <option value="0">No</option>
                              </option>
                          <?php  } 
                              ?>
                             </select>
                          </div>
                          <div class="mb-3 col-md-6">
                          <label class="form-label">Family Welfare Method Accepted <span class="mand">* </span></label>
                            <select name="ppcMethod" required id="ppcMethod" class="form-select" disabled>
                           <?php  
                          $query = "SELECT p.ppcMethod,enumid,enumvalue FROM postnatalvisit p join enumdata e on e.enumid=p.ppcMethod WHERE type=29 AND p.id=".$id;
                          $exequery = mysqli_query($conn, $query);
                          while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                        <option value="<?php echo $listvalue['enumid']; ?>">
                        <?php if($listvalue['enumvalue']==$ppcMethod){ echo "selected"; } ?>
                       <?php echo $listvalue['enumvalue']; ?>
                                    <option value="1">Can’t decide now</option>
                                   <option value="2">None</option>
                                    <option value="3">Condom</option>
                                    <option value="4">Male Sterilization</option>
                                    <option value="5">IUCD-PP</option>
                                    <option value="6">PP-PS</option>
                                    <option value="8">IUCD-PP</option>
                                    <option value="9">Any Traditional Methods</option>
                                    <option value="10">Any Others Specify</option>		
                              </option>
                          <?php  } 
                              ?>
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
                              value="<?php echo $vitaminA;  ?>"
                              disabled
                            />
                          </div>
                          </div>

                          <div class="mb-3 col-md-6">
                          <label class="form-label">MOTHER DANGER SIGN <span class="mand">* </span></label>
                            <select name="motherDangerSign" required id="motherDangerSign" class="form-select" disabled>                           
                           <?php  
                            $query = "SELECT p.motherDangerSign,enumid,enumvalue FROM postnatalvisit p join enumdata e on e.enumid=p.motherDangerSign WHERE type=15 AND p.id=".$id;
                            $exequery = mysqli_query($conn, $query);
                            while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                            <option value="<?php echo $listvalue['enumid']; ?>">
                            <?php if($listvalue['enumvalue']==$mDangerSign){ echo "selected"; } ?>
                            <?php echo $listvalue['enumvalue']; ?>
                                    <option value="1">PPH</option>
                                    <option value="2">Fever</option>
                                    <option value="3">Sepsis</option>
                                    <option value="4">Severe Abdominal Pain</option>
                                    <option value="5">Severe Headache/Blurred Vision</option>
                                    <option value="6">Difficulty Breathing</option>
                                    <option value="7">Fever/Chills</option>
                                    <option value="8">None</option>
                                    <option value="9">Any Others Specify</option> 
                                </option>
                          <?php  } 
                              ?>
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
                              placeholder="BLOOD SUGER"
                              value="<?php echo $bloodSugar;  ?>"
                              disabled
                            />
                          </div>
                          </div> 

                          <div class="mb-3 col-md-6">
                          <label class="form-label">INFANT WEIGHT</label>
                            <select name="infantWeight" id="infantWeight" class="form-select" disabled> 
                           <?php  
                          $query = "SELECT p.infantWeight,enumid,enumvalue FROM postnatalvisit p join enumdata e on e.enumid=p.infantWeight WHERE type=12 AND p.id=".$id;
                          $exequery = mysqli_query($conn, $query);
                          while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                          <option value="<?php echo $listvalue['enumid']; ?>">
                          <?php if($listvalue['enumvalue']==$weight){ } ?>
                          <?php echo $listvalue['enumvalue']; ?>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                              </option>
                          <?php  } 
                              ?>
                             </select>
                            </div>
                            </div>
                        <div class="row">

                            <div class="mb-3 col-md-6">
                          <label class="form-label">INFANT DANGER SIGNS <span class="mand">* </span></label>
                            <select required name="infantDangerSigns" id="infantDangerSigns" class="form-select" disabled> 
                           <?php  
                           $query = "SELECT p.infantDangerSigns,enumid,enumvalue FROM postnatalvisit p join enumdata e on e.enumid=p.infantDangerSigns WHERE type=16 AND p.id=".$id;
                           $exequery = mysqli_query($conn, $query);
                           while($listvalue = mysqli_fetch_assoc($exequery)) { ?>
                           <option value="<?php echo $listvalue['enumid']; ?>">
                           <?php if($listvalue['enumvalue']==$iDSigns){ echo "selected"; } ?>
                           <?php echo $listvalue['enumvalue']; ?>
                           <option value="1">Jaundice</option>
                                    <option value="2">Diarrhoea</option>
                                    <option value="3">Vomiting</option>
                                    <option value="4">Fever</option>
                                    <option value="5">Hypothermia</option>
                                    <option value="6">Convulsions</option>
                                    <option value="7">Chest Indrawing</option>
                                    <option value="8">Difficulty in Feeding/Unable to Suck/Decreased Movements</option>
                                    <option value="9">Asphyxia</option>
                                    <option value="10">Prematurity</option>
                                    <option value="11">LBW</option>
                                    <option value="12">Big Baby</option>
                                    <option value="13">Birth Injury</option>
                                    <option value="14">Congenital Malformation</option>
                                    <option value="15">CHD</option>
                                    <option value="16">Pneumonia</option>
                                    <option value="17">Sepsis</option>
                                    <option value="18">Baby of Mother with HIV</option>
                                    <option value="19">Motherless Baby</option>
                                    <option value="20">None</option>
                                    <option value="21">Any Other Specify</option>
                               </option>
                          <?php  } 
                              ?>
                             </select>
                            </div>
                            <div class="col-md-6 mb-3">
                          <label class="form-label" for="basic-icon-default-motherWeight">BP Systolic</label>
                          <div class="input-group input-group-merge">
                            <select class="50-200 form-control" id="bpSys" name="bpSys" placeholder="BP SYS" disabled>
                            <?php

                            $list=mysqli_query($conn, "SELECT bpSys from postnatalvisit WHERE id=".$id);
                            while($row_list=mysqli_fetch_assoc($list)){

                            ?>
                            <option value="<?php echo $row_list['bpSys']; ?>">

                            <?php if($row_list['bpSys']==$bpSys) ?>

                            <?php { echo $row_list['bpSys']; } ?></option>
                            <?php } ?>
                            </select>
                          </div>
                        </div>
                        </div>
                        <div class="row">
                       
                        <div class="col-md-6 mb-3">
                          <label class="form-label" for="basic-icon-default-bpDia">BP Diastolic</label>
                          <div class="input-group input-group-merge">
                            <select class="40-150 form-control" id="bpDia" name="bpDia" placeholder="BP DIA" disabled>
                            <?php

                              $list=mysqli_query($conn, "SELECT bpDia from postnatalvisit WHERE id=".$id);
                              while($row_list=mysqli_fetch_assoc($list)){

                              ?>
                              <option value="<?php echo $row_list['bpDia']; ?>">

                              <?php if($row_list['bpDia']==$bpDia) ?>

                              <?php { echo $row_list['bpDia']; } ?></option>
                              <?php } ?>
                              </select>
                          </div>
                        </div>
                      
                        </div>
                        <div class="input-group" id="btnSaUp" style="display:none">
                          <input class="btn btn-primary" type="submit" id="update" name="editpostnatal" value="Update">
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