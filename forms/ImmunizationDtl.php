<?php include ('require/topHeader.php'); ?>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu & Top Search
if (isset($_GET['History'])) {
  $IM_picmeno = $_GET['History'];
  $record = mysqli_query($conn, "SELECT * FROM ecregister ec WHERE ec.picmeNo=$IM_picmeno AND ec.status != 0");
  $his = mysqli_fetch_array($record);
  $his_mot_name = $his['motheraadhaarname'];
    
$History = true;}
  
?>
<!-- Content wrapper -->
    <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
			

           <!-- Hoverable Table rows -->
                 <div class="card">
                   <h5 class="card-header"><span class="text-muted fw-light">Immunization /</span> Immunization Header List /</span> Immunization Detail List
                   	   
				   <a href="Immunization.php?History=<?php echo $IM_picmeno; ?>"><button type="submit" class="btn btn-primary" id="btnBack">
                    <span class="bx bx-arrow-back"></span>&nbsp; Back
                   </button></a>
				   <h5 class="card-header"><span class="text-muted fw-light"> PICME : </span> <?php echo $_GET['History']; ?> 
				   <h5 class="card-header"><span class="text-muted fw-light"> Mother Name : </span> <?php echo $his_mot_name; ?>
                   <a href="AddImmunizationDtl.php?picmeNo=<?php echo $_GET['History']; ?>" id="add" type="button" class="btn btn-primary" style="float:right;">
                       <span class="bx bx-plus"></span>&nbsp; Add Details
                   </a>
				   </h5>
                   <div class="table-responsive text-nowrap">
           <div class="container">
           <table id="users-detail" class="display nowrap" cellspacing="0" width="100%">
                       <thead>
                         <tr>
               <th>Dose No </th>
			   <th>Dose Name </th> 
               <th>Dose Due Date</th>
               <th>Dose Provided Date</th>
			   <th>Future Dose Date</th>
               <th>View</th>
                         </tr>
                       </thead>
<?php 
  $listQry = "SELECT DISTINCT(im.picmeNo),im.id,im.doseNo,im.doseDueDate,im.doseName, im.FutureDoseDate, im.doseProvidedDate,im.breastFeeding,ec.motheraadhaarname,im.createdUserId,ec.BlockId,ec.PhcId,ec.HscId FROM immunization im JOIN ecregister ec on ec.picmeNo=im.picmeNo 
              WHERE im.status=1 AND im.picmeNo = $IM_picmeno";
  $private = " AND im.createdUserId='".$userid."'";
  $orderQry = " ORDER BY im.picmeNo + im.doseNo ASC";

    if(($usertype == 0) || ($usertype == 1)) {
            if(isset($_POST['filter'])) {
	            $bloName = $_POST['BlockId']; 
	            $phcName = $_POST['PhcId'];
              $hscName = $_POST['HscId'];        
                        if($bloName == "" && $phcName == "" && $hscName == ""){
                          $ExeQuery = mysqli_query($conn,$listQry.$orderQry);
                        } else if($bloName != "" && $phcName == "" && $hscName == ""){
                          $ExeQuery = mysqli_query($conn,$listQry." AND ec.BlockId='".$bloName."'".$orderQry);
                        } else if($bloName != "" && $phcName != "" && $hscName == ""){
                          $ExeQuery = mysqli_query($conn,$listQry." AND ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."'".$orderQry);
                        } else if($bloName != "" && $phcName != "" && $hscName != ""){
                          $ExeQuery = mysqli_query($conn,$listQry." AND ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."' AND ec.HscId='".$hscName."'".$orderQry);
                        }
                      } else if(isset($_POST['reset'])) {
                        $ExeQuery = mysqli_query($conn,$listQry.$orderQry);
                      } else {
                        $ExeQuery = mysqli_query($conn,$listQry.$orderQry);
                      }
    } else if(($usertype == 2) || ($usertype == 3) || ($usertype == 4)) {
    $ExeQuery = mysqli_query($conn,$listQry." AND ec.BlockId='".$BlockId."'".$orderQry);
            }  else {
                $ExeQuery = mysqli_query($conn,$listQry.$private.$orderQry);
            }
              if($ExeQuery) {
                         $cnt=1;
                         while($row = mysqli_fetch_array($ExeQuery)) {
                       ?>
                                   <tr>
									   <td><?php $dn = $row['doseNo'];
                                    if($dn == 1) { echo "Dose 1 (Day 45)";}elseif($dn == 2){ echo "Dose 2 (Day 75)"; }
                                    elseif($dn == 3){ echo "Dose 3 (Day 105)"; } 
                                    elseif($dn == 4){ echo "Dose 4 (Day 270)"; } 
                                    elseif($dn == 5){ echo "Dose 5 (Day 480)"; }
                                       ?></td>
                                      
                                 <?php  
								 $wild_srch = "";
								 $wild = $row['doseName'];
								 $wild_srch = str_replace(' ', '', $wild);
								 $search_text_input = "";
								 $search_text_input = ",";
								 $dose_name = "";
								 $ini_pos = 0;
								 $cur_pos = 0;
								 $search_pos = 2;
								 $search_val = "";
								 $dose_name = "";
	                             $sub_cnt = substr_count($wild_srch,$search_text_input);
								 if($sub_cnt == 0)
								 {
								  $search_val = $wild_srch; 
								  
                                  $rec_enum = mysqli_query($conn, "SELECT * FROM enumdata ed WHERE ed.enumid = $search_val AND ed.type = 43");
                                  $vac_nm = mysqli_fetch_array($rec_enum);
 								  $dose_name = $vac_nm['enumvalue'];
								  //print_r($dose_name); exit;
								 }
								 else
								 {
								 while($sub_cnt >= 0)
								 {
								  if(stripos($wild_srch,$search_text_input)!==false) /*STRIPOS - Case incensitive search */
	                              {
		                           $search_val = "";
		                           $search_val = substr($wild_srch, $cur_pos, $search_pos);
								  // print_r($search_val);
								   $cur_pos = $cur_pos + 3;
	                               $rec_enum = mysqli_query($conn, "SELECT * FROM enumdata ed WHERE ed.enumid = $search_val AND ed.type = 43");
                                   $vac_nm = mysqli_fetch_array($rec_enum);
								   if(strlen($dose_name) > 0)
								   {	   
		                            $dose_name = $dose_name.", ".$vac_nm['enumvalue'];
								   }
								   else
								   {	   
		                            $dose_name = $vac_nm['enumvalue'];
								   }   
		                           $sub_cnt--;
								   
								 } }
								 }
								?>
                                       <td><?php echo $dose_name; ?></td>
									   <td><?php $dpd = date('d-m-Y', strtotime($row['doseDueDate'])); echo $dpd; ?></td>
                                       <td><?php $dosepd = date('d-m-Y', strtotime($row['doseProvidedDate'])); echo $dosepd; ?></td>
									   <td><?php
									   if(strlen($row['FutureDoseDate']) > 0 )
									   { $futpd = date('d-m-Y', strtotime($row['FutureDoseDate']));} 
								       else
									   { $futpd = ""; print_r($row['FutureDoseDate']);}  
								   echo $futpd; ?></td>
                             <td ><a id="view" name="view" href="../forms/ViewEditImmunization.php?view=<?php echo $row['id']; ?>" ><i  class="bx bx-show me-1"></i>View</a></td>
				    </tr>
                       <?php 
                           $cnt++;
                         } 
                       } ?>
                     </table></div>
                   </div>
                 </div>
        <!--/ Hoverable Table rows -->
<?php include ('require/dtFooter.php'); ?>