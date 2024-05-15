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
}else if(($usertype == 2)|| ($usertype == 4) || ($usertype == 5)) {
    include ('require/Mfilter.php');
}else if(($usertype == 3) ) {
    include ('require/Bfilter.php');
} else if(($usertype == 6)) {
    include ('require/Cfilter.php');   
}
?>
<!-- Content wrapper -->
    <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">

           <!-- Hoverable Table rows -->
                 <div class="card">
                   <h5 class="card-header"><span class="text-muted fw-light">Immunization /</span> Immunization Header List
				    <?php if($usertype != 5 AND $usertype != 6) { ?>
                   <a href="AddImmunization.php" id="add" type="button" class="btn btn-primary" style="float:right;">
                       <span class="bx bx-plus"></span>&nbsp; Add Immunization
                   </a>
				   <?php } ?> 
                   </h5>
                   <div class="table-responsive text-nowrap">
           <div class="container">
           <table id="users-detail" class="display nowrap" cellspacing="0" width="100%">
                       <thead>
                         <tr>
               <th>S.No</th>
               <th>RCHID (PICME) No.</th>
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
  $listQry = "";
  $private = "";
  $orderQry = "";
  $listQry = "SELECT im.picmeNo,im.id,im.doseNo,im.doseDueDate,im.FutureDoseDate, im.doseName, ec.mothermobno, im.doseProvidedDate,im.breastFeeding,ec.motheraadhaarname,im.createdUserId,ec.BlockId,ec.PhcId,ec.HscId FROM immunization im JOIN ecregister ec on ec.picmeNo=im.picmeNo 
              WHERE im.doseNo = (SELECT max(CAST(im1.doseNo AS SIGNED)) From immunization im1 where im1.picmeNo = im.picmeNo)";
 // $private = " AND im.createdUserId='".$userid."'";
  $private = "";
  $orderQry = " ORDER BY im.picmeNo + im.doseNo ASC";

  //  if(($usertype == 0) || ($usertype == 1)) {
	  
	  $bloName = "";
				 $phcName = "";
				 $hscName = "";
				 
				 if(($usertype == 0) || ($usertype == 1)) {
		               if(isset($_POST['BlockId']))
	                 	{
                          $bloName = $_POST['BlockId']; 
	                 	} 
						if(isset($_POST['PhcId']))
	                	{
                         $phcName = $_POST['PhcId']; 
		                } 
						if(isset($_POST['HscId']))
	                  	{
                         $hscName = $_POST['HscId']; 
	                   	}	
						
				  }	
				 
				  if(($usertype == 5) || ($usertype == 2) || ($usertype == 4)) {
		               if(isset($_SESSION['BlockId']))
	                 	{
                          $bloName = $_SESSION['BlockId']; 
	                 	} 
						if(isset($_POST['PhcId']))
	                	{
                         $phcName = $_POST['PhcId']; 
		                } 
						if(isset($_POST['HscId']))
	                  	{
                         $hscName = $_POST['HscId']; 
	                   	}	
						
				  }	
                  if($usertype == 3)	{
					  if(isset($_SESSION['BlockId']))
	                 	{
                          $bloName = $_SESSION['BlockId']; 
	                 	} 
						if(isset($_SESSION['PhcId']))
	                	{
                         $phcName = $_SESSION['PhcId']; 
		                } 
						if(isset($_POST['HscId']))
	                  	{
                         $hscName = $_POST['HscId']; 
	                   	}	
				  }
				  if($usertype == 6)	{
					  if(isset($_SESSION['BlockId']))
	                 	{
                          $bloName = $_SESSION['BlockId']; 
	                 	} 
						if(isset($_SESSION['PhcId']))
	                	{
                         $phcName = $_SESSION['PhcId']; 
		                }
						if(isset($_SESSION['HscId']))
	                 	{
                         $hscName = $_SESSION['HscId']; 
	                 	}
				  } 
				  
            if(isset($_POST['filter'])) {
	        //    $bloName = $_POST['BlockId']; 
	         //   $phcName = $_POST['PhcId'];
             // $hscName = $_POST['HscId'];        
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
                     //   $ExeQuery = mysqli_query($conn,$listQry.$orderQry);
					  if(($usertype == 0) || ($usertype == 1)) {
		               $ExeQuery = mysqli_query($conn,$listQry.$orderQry);
				  }	
				 
				  if(($usertype == 5) || ($usertype == 2) || ($usertype == 4)) {
		               $ExeQuery = mysqli_query($conn,$listQry." AND BlockId='".$bloName."'".$orderQry);
				  }	
                  if($usertype == 3)	{
					  $ExeQuery = mysqli_query($conn,$listQry." AND BlockId='".$bloName."' AND PhcId='".$phcName."'".$orderQry);
				  }
				  if($usertype == 6)	{
					  $ExeQuery = mysqli_query($conn,$listQry." AND BlockId='".$bloName."' AND PhcId='".$phcName."' AND HscId='".$hscName."'".$orderQry);
				  }
                      } else {
                      //  $ExeQuery = mysqli_query($conn,$listQry.$orderQry);
					   if($bloName == "" && $phcName == "" && $hscName == ""){
                  $ExeQuery = mysqli_query($conn,$listQry.$orderQry);
                } else if($bloName != "" && $phcName == "" && $hscName == ""){
                  $ExeQuery = mysqli_query($conn,$listQry." AND BlockId='".$bloName."'".$orderQry);
                } else if($bloName != "" && $phcName != "" && $hscName == ""){
                  $ExeQuery = mysqli_query($conn,$listQry." AND BlockId='".$bloName."' AND PhcId='".$phcName."'".$orderQry);
                } else if($bloName != "" && $phcName != "" && $hscName != ""){
                  $ExeQuery = mysqli_query($conn,$listQry." AND BlockId='".$bloName."' AND PhcId='".$phcName."' AND HscId='".$hscName."'".$orderQry);
                } 
                      }
 /*   } else if(($usertype == 2) || ($usertype == 3) || ($usertype == 4)) {
    $ExeQuery = mysqli_query($conn,$listQry." AND ec.BlockId='".$BlockId."'".$orderQry);
            }  else {
                $ExeQuery = mysqli_query($conn,$listQry.$private.$orderQry);
            } */
              if($ExeQuery) {
                         $cnt=1;
						 $row = "";
                         while($row = mysqli_fetch_array($ExeQuery)) {
							  //Need to modify the code here for user types
	  $match_fnd = "N";  	
	  
       $HscQry = "SELECT * From users";				 
	   $HscRes =  mysqli_query($conn,$HscQry);
       if($HscRes) {
         while($rowh = mysqli_fetch_array($HscRes)) 
		 {
		
		/* if((($usertype == 0) || ($usertype == 1)))
		 {
          $match_fnd = "Y"; 
		 } 
		 
		 if((($usertype == 5) || ($usertype == 2)) AND
			 $row['BlockId']==$rowh['BlockId'] )
		 {
          $match_fnd = "Y"; 
		 } 
		 
	   if(($usertype == 3) AND
			 $row['BlockId']==$rowh['BlockId'] AND
			 $row['PhcId']==$rowh['PhcId'])
		 {
          $match_fnd = "Y"; 
		 } 
		 
		  if(($usertype == 6) AND
			 $row['HscId']==$rowh['HscId'] AND
			 $row['BlockId']==$rowh['BlockId'] AND
			 $row['PhcId']==$rowh['PhcId'] AND
			 $row['mothermobno'] == $rowh['mobile'] AND
			 $_SESSION['username'] == $rowh['username'])
		 {
          $match_fnd = "Y"; 
		 } 
		 
		  if(($usertype == 4) AND
			 $row['HscId']==$rowh['HscId'] AND
			 $row['BlockId']==$rowh['BlockId'] AND
			 $row['PhcId']==$rowh['PhcId'])
		 {
          $match_fnd = "Y"; 
		 } 
	  }
	  if($match_fnd == "Y")
	  { */
		  // Code modify middle
		  if(($usertype == 6) AND
			 $row['HscId']==$rowh['HscId'] AND
			 $row['BlockId']==$rowh['BlockId'] AND
			 $row['PhcId']==$rowh['PhcId'] AND
			 $row['mothermobno'] == $rowh['mobile'] AND
			 $_SESSION['username'] == $rowh['username'])
		 {
          $match_fnd = "Y"; 
		 } 
	   }}
		  if((($usertype == 6) AND $match_fnd == "Y") || ($usertype < 6))
		  {
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
								// print_r($wild_srch); exit;
								 $search_text_input = "";
								 $search_text_input = ",";
								 $dose_name = "";
								 $ini_pos = 0;
								 $cur_pos = 0;
								 $search_pos = 2;
	                             $sub_cnt = substr_count($wild_srch,$search_text_input);
								 
								 if($sub_cnt == 0)
								 {
								  $search_val = $wild_srch; 
                                  $rec_enum = mysqli_query($conn, "SELECT * FROM enumdata ed WHERE ed.enumid = $search_val AND ed.type = 43");
                                  $vac_nm = mysqli_fetch_array($rec_enum);
 								  $dose_name = $vac_nm['enumvalue'];
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
						   <td ><a id="History" name="History" href="../forms/ImmunizationDtl.php?History=<?php echo $row['picmeNo']; ?>" ><i  class="bx bx-show me-1"></i>History</a></td>
		                     </tr>
                       <?php 
                           $cnt++;
                         } 
						 }
						// }} //code modifying ends
                       } ?>
                     </table></div>
                   </div>
                 </div>
        <!--/ Hoverable Table rows -->
<?php include ('require/dtFooter.php'); ?>