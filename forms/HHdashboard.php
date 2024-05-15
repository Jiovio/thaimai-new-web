<?php include ('require/topHeader.php'); ?>
<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
     <div class="layout-container">
<?php 
  include ('require/header.php'); // Menu
 
  if($usertype == 5) {
  include ('require/Mfilter.php');   // Top Filter 	  
  include ('require/Hfilter.php');  
  
/*	$AvCntmq = mysqli_query($conn,"SELECT COUNT(DISTINCT(av.picmeno)) AS AvCnt, ec.mothermobno, ec.BlockId,ec.PhcId,ec.HscId FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno WHERE 
                av.status=1 AND ec.BlockId='".$BlockId."' AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno)");

	$Avcnt = mysqli_fetch_array($AvCntmq); */
   // $AvTot = $Avcnt["AvCnt"];
   
    if(isset($_POST['filter'])) {
		  
		 // print_r("I am here 1");
		$phcName = "";
        $hscName = "";
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
		
        if($bloName != "" && $phcName == "" && $hscName == ""){
          include 'LoadBlock.php';
		  print_r("test1");
        } else if($bloName != "" && $phcName != "" && $hscName == ""){
          include 'LoadPhc.php';
		   print_r("test2");
        } else if($bloName != "" && $phcName != "" && $hscName != ""){
            include 'LoadHsc.php';
			 print_r("test3");
          }
        } else if(isset($_POST['reset'])) {
          include 'DefaultBlock.php';
		   print_r("test4");
        } else {
          include 'DefaultBlock.php';
		   print_r("test5");
        }
      $EcTot = $ErCnt['ErCnt']; $ArTot = $ArCnt['ArCnt']; $AvTot = $AvCnt['AvCnt']; $MhTot = $MhCnt['MhCnt'];
      $HrTot = $HrCnt['HrCnt']; $DdTot = $DdCnt['DdCnt']; $ImTot = $ImCnt['ImCnt']; $PvTot = $PvCnt['PvCnt'];
      $UsTot = $UsCnt['UsCnt']; $LmTot = $LmCnt['LmCnt']; $HsTot = $HsCnt['HsCnt']; $PhTot = $PhCnt['PhCnt'];
	
  }
  
  else
	  if($usertype == 6) { 
  include ('require/Cfilter.php'); 
    
     $BlockId = $_SESSION['BlockId'];
     $PhcId = $_SESSION['PhcId'];	 
	 $HscId = $_SESSION['HscId'];
	 $username = $_SESSION['username'];
	 
	 $HscQry = "SELECT * From users where username = '".$username."' AND status=1";				 
	   $HscRes =  mysqli_query($conn,$HscQry);
       if($HscRes) {
         while($rowh = mysqli_fetch_array($HscRes)) 
		 {
	        $mobile = $rowh['mobile'];
	   }}
	   
 // $AvCntmq = mysqli_query($conn,"SELECT count(id) AS AvCnt FROM antenatalvisit WHERE status=1  AND createdBy='".$userid."'");
    
	if($usertype == 6)
	{
    $AvCntmq = mysqli_query($conn,"SELECT COUNT(DISTINCT(av.picmeno)) AS AvCnt, ec.mothermobno, ec.BlockId,ec.PhcId,ec.HscId FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno WHERE 
                av.status=1 AND ec.BlockId='".$BlockId."' AND ec.PhcId='".$PhcId."' AND ec.HscId='".$HscId."' AND ec.mothermobno ='".$mobile."' AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno)");
    }
	else
	{	
	$AvCntmq = mysqli_query($conn,"SELECT COUNT(DISTINCT(av.picmeno)) AS AvCnt, ec.mothermobno, ec.BlockId,ec.PhcId,ec.HscId FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno WHERE 
                av.status=1 AND ec.BlockId='".$BlockId."' AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno)");
    }	
	
	$Avcnt = mysqli_fetch_array($AvCntmq);
    $AvTot = $Avcnt["AvCnt"];
   
 
  //$AvCntmq = mysqli_query($conn,"SELECT COUNT(DISTINCT(av.picmeno)) AS AvCnt FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno WHERE av.status=1");
  //$Avcnt = mysqli_fetch_array($AvCntmq);
 // $AvTot = $Avcnt["AvCnt"];
 
  if($usertype == 6)
	{
  $HrCntmq = mysqli_query($conn,"SELECT COUNT(DISTINCT(hr.picmeNo)) AS HrCnt, ec.BlockId, ec.PhcId, ec.HscId, ec.mothermobno, hr.highRiskFactor, hr.status, hr.motherName From highriskmothers hr JOIN ecregister ec on hr.picmeNo = ec.picmeNo 
			JOIN hscmaster hs on ec.BlockId = hs.BlockId AND ec.PhcId = hs.PhcId AND ec.HscId =hs.HscId AND 
			ec.PanchayatId =hs.PanchayatId AND ec.VillageId = hs.VillageId WHERE hr.status!=0 AND ec.BlockId='".$BlockId."' AND hs.PhcId='".$PhcId."' AND hs.HscId='".$HscId."' AND ec.mothermobno ='".$mobile."'");
  }
	else
	{	
  $HrCntmq = mysqli_query($conn,"SELECT COUNT(DISTINCT(hr.picmeNo)) AS HrCnt, ec.BlockId, ec.PhcId, ec.HscId, ec.mothermobno, hr.highRiskFactor, hr.status, hr.motherName From highriskmothers hr JOIN ecregister ec on hr.picmeNo = ec.picmeNo 
			JOIN hscmaster hs on ec.BlockId = hs.BlockId AND ec.PhcId = hs.PhcId AND ec.HscId =hs.HscId AND 
			ec.PanchayatId =hs.PanchayatId AND ec.VillageId = hs.VillageId WHERE hr.status!=0 AND hs.BlockId='".$BlockId."'");
  }
  $HrCnt = mysqli_fetch_array($HrCntmq);
  $HrTot = $HrCnt["HrCnt"];
 /* $listQry_HR = "SELECT DISTINCT(hr.picmeNo), ec.BlockId, ec.PhcId, ec.HscId, ec.mothermobno, hr.highRiskFactor, hr.status, hr.motherName From highriskmothers hr JOIN ecregister ec on hr.picmeNo = ec.picmeNo 
			JOIN hscmaster hs on ec.BlockId = hs.BlockId AND ec.PhcId = hs.PhcId AND ec.HscId =hs.HscId AND 
			ec.PanchayatId =hs.PanchayatId AND ec.VillageId = hs.VillageId WHERE hr.status!=0";

  $orderQry_HR = " ORDER BY hr.picmeNo ASC";
  
    $ExeQuery_HR = mysqli_query($conn,$listQry_HR.$orderQry_HR);
              if($ExeQuery_HR) {
                         $cnt_HR=0;
                         while($row_HR = mysqli_fetch_array($ExeQuery_HR)) {
							 $match_fnd_HR = "N";  	
	  
       $HscQry_HR = "SELECT * From users";				 
	   $HscRes_HR =  mysqli_query($conn,$HscQry_HR);
       if($HscRes_HR) {
         while($rowh_HR = mysqli_fetch_array($HscRes_HR)) 
		 {
		
		 if(($usertype == 5) AND
			 $row_HR['BlockId']==$rowh_HR['BlockId'] )
		 {
          $match_fnd_HR = "Y"; 
		 } 
		 
		  if(($usertype == 6) AND
			 $row_HR['HscId']==$rowh_HR['HscId'] AND
			 $row_HR['BlockId']==$rowh_HR['BlockId'] AND
			 $row_HR['PhcId']==$rowh_HR['PhcId'] AND
			 $row_HR['mothermobno'] == $rowh_HR['mobile'] AND
			 $_SESSION['username'] == $rowh_HR['username'])
		 {
          $match_fnd_HR = "Y"; 
		 } 
	  }
	  if($match_fnd_HR == "Y")
	  {
		  // Code modify middle
                       ?>
                                  
                       <?php 
                           $cnt_HR++;
                         } 
						 }} //code modifying ends
                       } 
					   $HrTot = $cnt_HR;*/

 
 // $DdCntmq = mysqli_query($conn,"SELECT COUNT(id) AS DdCnt FROM deliverydetails WHERE status=1 AND createdBy='".$userid."'");
 //   $DdCntmq = mysqli_query($conn,"SELECT COUNT(id) AS DdCnt FROM deliverydetails WHERE status=1 AND createdBy='".$userid."'");
	
	 if($usertype == 6)
	{
  $DdCntmq = mysqli_query($conn,"SELECT COUNT(DISTINCT(dd.picmeno)) AS DdCnt, dd.id,ec.motheraadhaarname,ec.mothermobno, dd.deliverydate,dd.deliverytime,ec.BlockId,ec.PhcId,ec.HscId FROM deliverydetails dd JOIN ecregister ec on ec.picmeNo=dd.picmeno WHERE dd.status=1 AND ec.BlockId='".$BlockId."' AND ec.PhcId='".$PhcId."' AND ec.HscId='".$HscId."' AND ec.mothermobno ='".$mobile."'");
  }
	else
	{	
  $DdCntmq = mysqli_query($conn,"SELECT COUNT(DISTINCT(dd.picmeno)) AS DdCnt, dd.id,ec.motheraadhaarname,ec.mothermobno, dd.deliverydate,dd.deliverytime,ec.BlockId,ec.PhcId,ec.HscId FROM deliverydetails dd JOIN ecregister ec on ec.picmeNo=dd.picmeno WHERE dd.status=1 AND ec.BlockId='".$BlockId."'");
  
  }
 
   /*$listQry_DD = "SELECT DISTINCT(dd.picmeno),dd.id,ec.motheraadhaarname,ec.mothermobno, dd.deliverydate,dd.deliverytime,ec.BlockId,ec.PhcId,ec.HscId FROM deliverydetails dd JOIN ecregister ec on ec.picmeNo=dd.picmeno WHERE dd.status=1";
     $private_DD = "";
     $orderQry_DD = " ORDER BY ec.motheraadhaarname ASC";
  
    $ExeQuery_DD = mysqli_query($conn,$listQry_DD.$private_DD.$orderQry_DD);
              if($ExeQuery_DD) {
                         $cnt_DD=0;
                         while($row_DD = mysqli_fetch_array($ExeQuery_DD)) {
							 $match_fnd_DD = "N";  	
	  
       $HscQry_DD = "SELECT * From users";				 
	   $HscRes_DD =  mysqli_query($conn,$HscQry_DD);
       if($HscRes_DD) {
         while($rowh_DD = mysqli_fetch_array($HscRes_DD)) 
		 {
		
		 if(($usertype == 5) AND
			 $row_DD['BlockId']==$rowh_DD['BlockId'] )
		 {
          $match_fnd_DD = "Y"; 
		 } 
		 
		  if(($usertype == 6) AND
			 $row_DD['HscId']==$rowh_DD['HscId'] AND
			 $row_DD['BlockId']==$rowh_DD['BlockId'] AND
			 $row_DD['PhcId']==$rowh_DD['PhcId'] AND
			 $row_DD['mothermobno'] == $rowh_DD['mobile'] AND
			 $_SESSION['username'] == $rowh_DD['username'])
		 {
          $match_fnd_DD = "Y"; 
		 } 
	  }
	  if($match_fnd_DD == "Y")
	  {
		  // Code modify middle
                       ?>
                                  
                       <?php 
                           $cnt_DD++;
                         } 
						 }} //code modifying ends
                       } */
					   
	$DdCnt = mysqli_fetch_array($DdCntmq);
    $DdTot = $DdCnt["DdCnt"]; 

  //$ImCntmq = mysqli_query($conn,"SELECT COUNT(id) AS ImCnt FROM immunization WHERE status=1 AND createdUserId='".$userid."'");
  
   if($usertype == 6)
	{
  $ImCntmq = mysqli_query($conn,"SELECT COUNT(DISTINCT(im.picmeNo)) AS ImCnt, im.id,im.doseNo,im.doseDueDate,im.FutureDoseDate, im.doseName, ec.mothermobno, im.doseProvidedDate,im.breastFeeding,ec.motheraadhaarname,im.createdUserId,ec.BlockId,ec.PhcId,ec.HscId FROM immunization im JOIN ecregister ec on ec.picmeNo=im.picmeNo 
              WHERE im.doseNo = (SELECT max(CAST(im1.doseNo AS SIGNED)) From immunization im1 where im1.picmeNo = im.picmeNo) AND ec.BlockId='".$BlockId."' AND ec.PhcId='".$PhcId."' AND ec.HscId='".$HscId."' AND ec.mothermobno ='".$mobile."'");
  }
	else
	{	
  $ImCntmq = mysqli_query($conn,"SELECT COUNT(DISTINCT(im.picmeNo)) AS ImCnt, im.id,im.doseNo,im.doseDueDate,im.FutureDoseDate, im.doseName, ec.mothermobno, im.doseProvidedDate,im.breastFeeding,ec.motheraadhaarname,im.createdUserId,ec.BlockId,ec.PhcId,ec.HscId FROM immunization im JOIN ecregister ec on ec.picmeNo=im.picmeNo 
              WHERE im.doseNo = (SELECT max(CAST(im1.doseNo AS SIGNED)) From immunization im1 where im1.picmeNo = im.picmeNo) AND ec.BlockId='".$BlockId."'");

  }  
/*  $listQry_IMM = "SELECT im.picmeNo,im.id,im.doseNo,im.doseDueDate,im.FutureDoseDate, im.doseName, ec.mothermobno, im.doseProvidedDate,im.breastFeeding,ec.motheraadhaarname,im.createdUserId,ec.BlockId,ec.PhcId,ec.HscId FROM immunization im JOIN ecregister ec on ec.picmeNo=im.picmeNo 
              WHERE im.doseNo = (SELECT max(CAST(im1.doseNo AS SIGNED)) From immunization im1 where im1.picmeNo = im.picmeNo)";
  $private_IMM = "";
  $orderQry_IMM = " ORDER BY im.picmeNo + im.doseNo ASC";
  
    $ExeQuery_IMM = mysqli_query($conn,$listQry_IMM.$private_IMM.$orderQry_IMM);
              if($ExeQuery_IMM) {
                         $cnt_IMM=0;
                         while($row_IMM = mysqli_fetch_array($ExeQuery_IMM)) {
							 $match_fnd_IMM = "N";  	
	  
       $HscQry_IMM = "SELECT * From users";				 
	   $HscRes_IMM =  mysqli_query($conn,$HscQry_IMM);
       if($HscRes_IMM) {
         while($rowh_IMM = mysqli_fetch_array($HscRes_IMM)) 
		 {
		
		 if(($usertype == 5) AND
			 $row_MM['BlockId']==$rowh_MM['BlockId'] )
		 {
          $match_fnd_IMM = "Y"; 
		 } 
		 
		  if(($usertype == 6) AND
			 $row_IMM['HscId']==$rowh_IMM['HscId'] AND
			 $row_IMM['BlockId']==$rowh_IMM['BlockId'] AND
			 $row_IMM['PhcId']==$rowh_IMM['PhcId'] AND
			 $row_IMM['mothermobno'] == $rowh_IMM['mobile'] AND
			 $_SESSION['username'] == $rowh_IMM['username'])
		 {
          $match_fnd_IMM = "Y"; 
		 } 
	  }
	  if($match_fnd_IMM == "Y")
	  {
		  // Code modify middle
                       ?>
                                  
                       <?php 
                           $cnt_IMM++;
                         } 
						 }} //code modifying ends
                       } 
  $ImTot = $cnt_IMM; */
  
  $ImCnt = mysqli_fetch_array($ImCntmq);
  $ImTot = $ImCnt["ImCnt"];
 

 // $PvCntmq = mysqli_query($conn,"SELECT count(id) AS PvCnt FROM postnatalvisit WHERE status=1 AND createdBy='".$userid."'");
 
  if($usertype == 6)
	{
  $PvCntmq = mysqli_query($conn,"SELECT COUNT(DISTINCT(p.picmeNo)) AS PvCnt, p.id,p.ifaTabletStatus,p.motherDangerSign,p.bloodSugar,p.pncPeriod,p.motherPnc, ec.motheraadhaarname,ec.BlockId,ec.PhcId,ec.HscId FROM postnatalvisit p JOIN ecregister ec on ec.picmeNo=p.picmeno 
	            WHERE p.status=1 AND p.pncPeriod = (SELECT max(CAST(p1.pncPeriod AS SIGNED)) From postnatalvisit p1 where p1.picmeNo = p.picmeNo) AND ec.BlockId='".$BlockId."' AND ec.PhcId='".$PhcId."' AND ec.HscId='".$HscId."' AND ec.mothermobno ='".$mobile."'");
  }
	else
	{	
  $PvCntmq = mysqli_query($conn,"SELECT COUNT(DISTINCT(p.picmeNo)) AS PvCnt, p.id,p.ifaTabletStatus,p.motherDangerSign,p.bloodSugar,p.pncPeriod,p.motherPnc, ec.motheraadhaarname,ec.BlockId,ec.PhcId,ec.HscId FROM postnatalvisit p JOIN ecregister ec on ec.picmeNo=p.picmeno 
	            WHERE p.status=1 AND p.pncPeriod = (SELECT max(CAST(p1.pncPeriod AS SIGNED)) From postnatalvisit p1 where p1.picmeNo = p.picmeNo) AND ec.BlockId='".$BlockId."'");
 
  }  
  $PvCnt = mysqli_fetch_array($PvCntmq);
  $PvTot = $PvCnt["PvCnt"];
  
 /* $listQry_PV = "SELECT DISTINCT(p.picmeNo),p.id,p.ifaTabletStatus,p.motherDangerSign,p.bloodSugar,p.pncPeriod,p.motherPnc, ec.motheraadhaarname,ec.BlockId,ec.PhcId,ec.HscId FROM postnatalvisit p JOIN ecregister ec on ec.picmeNo=p.picmeno 
	            WHERE p.status=1 AND p.pncPeriod = (SELECT max(CAST(p1.pncPeriod AS SIGNED)) From postnatalvisit p1 where p1.picmeNo = p.picmeNo)";
    $private_PV = "";
    $orderQry_PV = " ORDER BY p.picmeNo + p.pncPeriod ASC";
  
    $ExeQuery_PV = mysqli_query($conn,$listQry_PV.$private_PV.$orderQry_PV);
              if($ExeQuery_PV) {
                         $cnt_PV=0;
                         while($row_PV = mysqli_fetch_array($ExeQuery_PV)) {
							 $match_fnd_PV = "N";  	
	  
       $HscQry_PV = "SELECT * From users";				 
	   $HscRes_PV =  mysqli_query($conn,$HscQry_PV);
       if($HscRes_PV) {
         while($rowh_PV = mysqli_fetch_array($HscRes_PV)) 
		 {
		
		 if(($usertype == 5) AND
			 $row_PV['BlockId']==$rowh_PV['BlockId'] )
		 {
          $match_fnd_PV = "Y"; 
		 } 
		 
		  if(($usertype == 6) AND
			 $row_PV['HscId']==$rowh_PV['HscId'] AND
			 $row_PV['BlockId']==$rowh_PV['BlockId'] AND
			 $row_PV['PhcId']==$rowh_PV['PhcId'] AND
			 $row_PV['mothermobno'] == $rowh_PV['mobile'] AND
			 $_SESSION['username'] == $rowh_PV['username'])
		 {
          $match_fnd_PV = "Y"; 
		 } 
	  }
	  if($match_fnd_PV == "Y")
	  {
		  // Code modify middle
                       ?>
                                  
                       <?php 
                           $cnt_PV++;
                         } 
						 }} //code modifying ends
                       }   
  $PvTot = $cnt_PV; */

  //$PsCntmq = mysqli_query($conn,"SELECT COUNT(id) AS PsCnt FROM ecregister WHERE status NOT IN(0,1) AND createdBy='".$userid."'");
  
  if($usertype == 6)
	{
  $PsCntmq = mysqli_query($conn,"SELECT COUNT(DISTINCT(ec.picmeNo)) AS PsCnt FROM `ecregister` ec WHERE ec.status NOT IN(0,1) 
	AND NOT EXISTS (SELECT dd.picmeno FROM deliverydetails dd WHERE dd.picmeno = ec.picmeNo) AND ec.BlockId='".$BlockId."' AND ec.PhcId='".$PhcId."' AND ec.HscId='".$HscId."' AND ec.mothermobno ='".$mobile."'");
  }
	else
	{	
  $PsCntmq = mysqli_query($conn,"SELECT COUNT(DISTINCT(ec.picmeNo)) AS PsCnt FROM `ecregister` ec WHERE ec.status NOT IN(0,1) 
	AND NOT EXISTS (SELECT dd.picmeno FROM deliverydetails dd WHERE dd.picmeno = ec.picmeNo) AND ec.BlockId='".$BlockId."'");
  
  }  
  $PsCnt = mysqli_fetch_array($PsCntmq);
  $PsTot = $PsCnt["PsCnt"];
  
  /*  $listQry_PS = "SELECT * FROM `ecregister` ec WHERE ec.status NOT IN(0,1) 
	AND NOT EXISTS (SELECT dd.picmeno FROM deliverydetails dd WHERE dd.picmeno = ec.picmeNo)";
	$private_PS = "";
    $orderQry_PS = " ORDER BY motheraadhaarname ASC";
  
    $ExeQuery_PS = mysqli_query($conn,$listQry_PS.$private_PS.$orderQry_PS);
              if($ExeQuery_PS) {
                         $cnt_PS=0;
                         while($row_PS = mysqli_fetch_array($ExeQuery_PS)) {
							 $match_fnd_PS = "N";  	
	  
       $HscQry_PS = "SELECT * From users";				 
	   $HscRes_PS =  mysqli_query($conn,$HscQry_PS);
       if($HscRes_PS) {
         while($rowh_PS = mysqli_fetch_array($HscRes_PS)) 
		 {
		
		 if(($usertype == 5) AND
			 $row_PS['BlockId']==$rowh_PS['BlockId'] )
		 {
          $match_fnd_PS = "Y"; 
		 } 
		 
		  if(($usertype == 6) AND
			 $row_PS['HscId']==$rowh_PS['HscId'] AND
			 $row_PS['BlockId']==$rowh_PS['BlockId'] AND
			 $row_PS['PhcId']==$rowh_PS['PhcId'] AND
			 $row_PS['mothermobno'] == $rowh_PS['mobile'] AND
			 $_SESSION['username'] == $rowh_PS['username'])
		 {
          $match_fnd_PS = "Y"; 
		 } 
	  }
	  if($match_fnd_PS == "Y")
	  {
		  // Code modify middle
                       ?>
                                  
                       <?php 
                           $cnt_PS++;
                         } 
						 }} //code modifying ends
                       } 
    $PsTot = $cnt_PS; */
	
	  } /* For user Type : 6 */
?>
		<!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-12 col-md-12 col-lg-12 order-3 order-md-2">
                  <div class="row">
                    <div class="col-3 mb-4">
                     <!---a href="<?php echo $siteurl; ?>/forms/AntenatalVisit.php"--->
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                            </div>
                          </div>
                          <span class="fw-semibold d-Block mb-1">Antenatal Visit</span>
                          <h3 class="card-title mb-2"><?php if($AvTot) { echo $AvTot; } else { echo "0"; } ?></h3>
                        </div>
                      </div>
                     <!--/a-->
                    </div>
				  <div class="col-3 mb-4">
				     <!---a href="<?php echo $siteurl; ?>/forms/highRiskMothers.php"--->
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="../assets/img/icons/unicons/cc-warning.png"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                          </div>
                          <span class="fw-semibold d-Block mb-1">High Risk Mothers</span>
                          <h3 class="card-title mb-2"><?php if($HrTot) { echo $HrTot; } else { echo "0"; }  ?></h3>
                        </div>
                      </div>
                     <!---/a--->
                    </div>
                    <div class="col-3 mb-4">
                     <!---a href="<?php echo $siteurl; ?>/forms/DeliveryDetails.php"--->
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../assets/img/icons/unicons/wallet.png" alt="Credit Card" class="rounded" />
                            </div>
                          </div>
                          <span class="fw-semibold d-Block mb-1">Delivery Details</span>
                         <h3 class="card-title mb-2"><?php  if($DdTot) { echo $DdTot; } else { echo "0"; } ?></h3>
                        </div>
                      </div>
                     <!---/a--->
                    </div>

					<div class="col-3 mb-4">
					 <!---a href="<?php echo $siteurl; ?>/forms/Immunization.php"--->
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../assets/img/icons/unicons/cc-success.png" alt="Credit Card" class="rounded" />
                            </div>
                          </div>
                          <span class="fw-semibold d-Block mb-1">Immunization Details</span>
                         <h3 class="card-title mb-2"><?php if($ImTot) { echo $ImTot; } else { echo "0"; } ?></h3>
                        </div>
                      </div>
                     <!---/a--->
                    </div>
					<div class="col-3 mb-4">
					 <!-----a href="<?php echo $siteurl; ?>/forms/PostnatalVisit.php"---->
              <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                          <img src="../assets/img/icons/unicons/chart.png" alt="Credit Card" class="rounded" />
                        </div>
                    </div>
                    <span class="fw-semibold d-Block mb-1">Postnatal Visit</span>
                    <h3 class="card-title mb-2"><?php if($PvTot) { echo $PvTot; } else { echo "0"; } ?></h3>
                </div>
              </div>
           <!---/a--->
          </div>
          <div class="col-3 mb-4">
                     <!---a href="<?php echo $siteurl; ?>/forms/MedicalHistory.php"--->
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="../assets/img/icons/unicons/cc-success.png" alt="Credit Card" class="rounded" />
                            </div>
                          </div>
                          <span class="fw-semibold d-Block mb-1">Pregnancy Status</span>
                          <h3 class="card-title mb-2"><?php if($PsTot) { echo $PsTot; } else { echo "0"; } ?></h3>
                        </div>
                      </div>
                     <!---/a--->
            </div>
        </div>
      </div>
    </div>
<?php include ('require/dtFooter.php'); ?>