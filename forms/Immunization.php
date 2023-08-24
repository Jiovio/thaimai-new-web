<?php include ('require/topHeader.php'); ?>
<?php session_start(); ?>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
<?php include ('require/header.php'); // Menu
	  if(($usertype == 0) || ($usertype == 1)) {
	  include ('require/filter.php'); // Top Filter 
}else if(($usertype == 2)) {
    include ('require/Bfilter.php');
}else if(($usertype == 3) || ($usertype == 4)) {
    include ('require/Pfilter.php');  
} else {
    include ('require/Hfilter.php'); // Top Filter
}
?>
<!-- Content wrapper -->
    <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">

           <!-- Hoverable Table rows -->
                 <div class="card">
                   <h5 class="card-header"><span class="text-muted fw-light">Immunization /</span> Immunization Header List
                   <a href="AddImmunization.php" id="add" type="button" class="btn btn-primary" style="float:right;">
                       <span class="bx bx-plus"></span>&nbsp; Add Immunization
                   </a>
                   </h5>
                   <div class="table-responsive text-nowrap">
           <div class="container">
           <table id="users-detail" class="display nowrap" cellspacing="0" width="100%">
                       <thead>
                         <tr>
               <th>S.No</th>
               <th>PICME No.</th>
               <th>Mother Name</th>
               <th>Dose No.</th>
			   <th>Dose Name </th> 
               <th>Dose Due Date</th>
               <th>Dose Provided Date</th>
			   <th>Future Dose Date</th>
               <th>History</th>
                         </tr>
                       </thead>
<?php 
  $listQry = "SELECT DISTINCT(im.picmeNo),im.id,im.doseNo,im.doseDueDate,im.FutureDoseDate, im.doseName, im.doseProvidedDate,im.breastFeeding,ec.motheraadhaarname,im.createdUserId,ec.BlockId,ec.PhcId,ec.HscId FROM immunization im JOIN ecregister ec on ec.picmeNo=im.picmeNo 
              WHERE im.status=1 AND im.doseNo = (SELECT max(CAST(im1.doseNo AS SIGNED)) From immunization im1 where im1.picmeNo = im.picmeNo)";
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
                                       <td><?php echo $cnt; ?></td>
                                       <td><?php echo $row['picmeNo']; ?></td>
									   <td><?php echo $row['motheraadhaarname']; ?></td>
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
	                             $sub_cnt = substr_count($wild_srch,$search_text_input);
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
							//	 print_r($dose_name); exit;?>
                                       <td><?php echo $dose_name; ?></td>
                                       
                                       
									   <td><?php $dpd = date('d-m-Y', strtotime($row['doseDueDate'])); echo $dpd; ?></td>
                                       <td><?php $dosepd = date('d-m-Y', strtotime($row['doseProvidedDate'])); echo $dosepd; ?></td>
                                       <td><?php $futpd = date('d-m-Y', strtotime($row['FutureDoseDate'])); echo $futpd; ?></td>
						   <td ><a id="History" name="History" href="../forms/ImmunizationDtl.php?History=<?php echo $row['picmeNo']; ?>" ><i  class="bx bx-show me-1"></i>History</a></td>
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