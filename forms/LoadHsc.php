<?php include ('require/topHeader.php'); ?>
<?php
     $BlockId = $_SESSION['BlockId'];
	// print_r($_SESSION['usertype']);
     if($_SESSION['usertype'] == 4 || $_SESSION['usertype'] == 3)
	 {
		 $PhcId = $_SESSION['PhcId'];
		 
	 }
	 else
	 {
	 $PhcId = $_POST['PhcId'];
	 }	 
	 $HscId = $_POST['HscId'];
//	 print_r($PhcId."*".$HscId);
	 $username = $_SESSION['username'];
	 
	// print_r("Loadhsc");
	 
$ErCntmq = mysqli_query($conn,"SELECT COUNT(id) AS ErCnt FROM ecregister WHERE BlockId='".$BlockId."' AND PhcId='".$PhcId."' AND HscId='".$HscId."' AND status!=0");
$ErCnt = mysqli_fetch_array($ErCntmq);
print_r($ErCnt);

$ArCntmq = mysqli_query($conn,"SELECT COUNT(ar.motheraadhaarid) AS ArCnt FROM anregistration ar JOIN ecregister ec ON ar.motheraadhaarid=ec.motheraadhaarid WHERE ec.BlockId='".$BlockId."' AND ec.PhcId='".$PhcId."' AND ec.HscId='".$HscId."' AND ar.status=1");
$ArCnt = mysqli_fetch_array($ArCntmq);

//$AvCntmq = mysqli_query($conn,"SELECT COUNT(DISTINCT(av.picmeno)) AS AvCnt FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno WHERE ec.BlockId='".$BlockId."' AND ec.PhcId='".$PhcId."' AND ec.HscId='".$HscId."' AND av.status=1");
//$AvCntmq = mysqli_query($conn,"SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno) AND
//EXISTS (SELECT ecregister.picmeNo FROM ecregister WHERE ecregister.picmeNo = av.picmeno) AND ec.BlockId='".$BlockId."' AND ec.PhcId='".$PhcId."' AND ec.HscId='".$HscId."' AND av.status=1 ORDER BY av.picmeno DESC, av.ancPeriod DESC");
//$AvCntmq = mysqli_query($conn,"SELECT COUNT(DISTINCT(av.picmeno)) AS AvCnt FROM antenatalvisit av WHERE ec.BlockId='".$BlockId."' AND ec.PhcId='".$PhcId."' AND ec.HscId='".$HscId."' AND av.status=1");
$AvCntmq = mysqli_query($conn,"SELECT av.picmeno AS AvCnt From antenatalvisit where
AND ec.BlockId='".$BlockId."' AND ec.PhcId='".$PhcId."' AND ec.HscId='".$HscId."' AND av.status=1 AND ancperiod = 1");
$AvCnt = mysqli_fetch_array($AvCntmq);

$MhCntmq = mysqli_query($conn,"SELECT COUNT(mh.picmeno) AS MhCnt FROM medicalhistory mh JOIN ecregister ec ON mh.picmeno=ec.picmeno WHERE ec.BlockId='".$BlockId."' AND ec.PhcId='".$PhcId."' AND ec.HscId='".$HscId."' AND mh.status=1");
$MhCnt = mysqli_fetch_array($MhCntmq);

$HrCntmq = mysqli_query($conn,"SELECT COUNT(DISTINCT(hr.picmeNo)) AS HrCnt FROM highriskmothers hr JOIN ecregister ec on hr.picmeNo=ec.picmeno 
JOIN hscmaster hs on ec.BlockId = hs.BlockId AND ec.PhcId = hs.PhcId AND ec.HscId =hs.HscId AND 
			ec.PanchayatId =hs.PanchayatId AND ec.VillageId = hs.VillageId
WHERE ec.BlockId='".$BlockId."' AND ec.PhcId='".$PhcId."' AND ec.HscId='".$HscId."' AND hr.status=1");
$HrCnt = mysqli_fetch_array($HrCntmq);

$DdCntmq = mysqli_query($conn,"SELECT COUNT(dd.picmeNo) AS DdCnt FROM deliverydetails dd JOIN ecregister ec ON dd.picmeno=ec.picmeno WHERE ec.BlockId='".$BlockId."' AND ec.PhcId='".$PhcId."' AND ec.HscId='".$HscId."' AND dd.status=1");
$DdCnt = mysqli_fetch_array($DdCntmq);

$ImCntmq = mysqli_query($conn,"SELECT COUNT(im.picmeNo) AS ImCnt FROM immunization im JOIN ecregister ec ON im.picmeno=ec.picmeno WHERE ec.BlockId='".$BlockId."' AND ec.PhcId='".$PhcId."' AND ec.HscId='".$HscId."' AND im.status=1");
$ImCnt = mysqli_fetch_array($ImCntmq);
									
$PvCntmq = mysqli_query($conn,"SELECT count(pv.picmeNo) AS PvCnt FROM postnatalvisit pv JOIN ecregister ec ON pv.picmeno=ec.picmeno WHERE ec.BlockId='".$BlockId."' AND ec.PhcId='".$PhcId."' AND ec.HscId='".$HscId."' AND pv.status=1");
$PvCnt = mysqli_fetch_array($PvCntmq);
    
$UsCntmq = mysqli_query($conn,"SELECT COUNT(id) AS UsCnt FROM users WHERE BlockId='".$BlockId."' AND PhcId='".$PhcId."' AND HscId='".$HscId."' AND status=1");
$UsCnt = mysqli_fetch_array($UsCntmq);
    
$LmCntmq = mysqli_query($conn,"SELECT COUNT(id) AS LmCnt FROM ecregister WHERE status NOT IN(0,1)  
AND NOT EXISTS (SELECT deliverydetails.picmeno FROM deliverydetails WHERE deliverydetails.picmeno = ecregister.picmeNo) AND BlockId='".$BlockId."' AND PhcId='".$PhcId."' AND HscId='".$HscId."'");
$LmCnt = mysqli_fetch_array($LmCntmq);
    
$HsCntmq = mysqli_query($conn,"SELECT COUNT(id) AS HsCnt FROM hscmaster WHERE BlockId='".$BlockId."' AND PhcId='".$PhcId."' AND HscId='".$HscId."'");
$HsCnt = mysqli_fetch_array($HsCntmq);
    
$PhCntmq = mysqli_query($conn,"SELECT COUNT(id) AS PhCnt FROM hospital WHERE BlockId='".$BlockId."'");
$PhCnt = mysqli_fetch_array($PhCntmq);
?>