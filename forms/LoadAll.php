<?php include ('require/topHeader.php'); ?>
<?php 
$ErCntmq = mysqli_query($conn,"SELECT COUNT(ec.id) AS ErCnt FROM ecregister ec JOIN hscmaster hs on 
ec.BlockId = hs.BlockId AND 
ec.PhcId = hs.PhcId AND 
ec.HscId =hs.HscId AND 
ec.PanchayatId =hs.PanchayatId AND 
ec.VillageId = hs.VillageId WHERE 
ec.status!=0");
$ErCnt = mysqli_fetch_array($ErCntmq);

$ArCntmq = mysqli_query($conn,"SELECT COUNT(an.id) AS ArCnt FROM anregistration an JOIN ecregister ec on ec.motheraadhaarid=an.motheraadhaarid 
JOIN hscmaster hs on
ec.BlockId = hs.BlockId AND 
ec.PhcId = hs.PhcId AND 
ec.HscId =hs.HscId AND 
ec.PanchayatId =hs.PanchayatId AND 
ec.VillageId = hs.VillageId
WHERE an.status=1");
$ArCnt = mysqli_fetch_array($ArCntmq);

$AvCntmq = mysqli_query($conn,"SELECT COUNT(DISTINCT(av.picmeno)) AS AvCnt FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno 
JOIN hscmaster hs on
ec.BlockId = hs.BlockId AND 
ec.PhcId = hs.PhcId AND 
ec.HscId =hs.HscId AND 
ec.PanchayatId =hs.PanchayatId AND 
ec.VillageId = hs.VillageId
WHERE av.status=1");
$AvCnt = mysqli_fetch_array($AvCntmq);

$MhCntmq = mysqli_query($conn,"SELECT count(mh.id) AS MhCnt FROM medicalhistory mh JOIN ecregister ec on ec.picmeNo=mh.picmeno 
JOIN hscmaster hs on
ec.BlockId = hs.BlockId AND 
ec.PhcId = hs.PhcId AND 
ec.HscId =hs.HscId AND 
ec.PanchayatId =hs.PanchayatId AND 
ec.VillageId = hs.VillageId
WHERE mh.status=1");
$MhCnt = mysqli_fetch_array($MhCntmq);

$HrCntmq = mysqli_query($conn,"SELECT COUNT(DISTINCT(hr.picmeNo)) as HrCnt from highriskmothers hr JOIN ecregister ec on hr.picmeNo=ec.picmeNo 
JOIN hscmaster hs on ec.BlockId = hs.BlockId AND ec.PhcId = hs.PhcId AND ec.HscId =hs.HscId AND 
			ec.PanchayatId =hs.PanchayatId AND ec.VillageId = hs.VillageId
WHERE hr.status!=0");
$HrCnt = mysqli_fetch_array($HrCntmq);

$DdCntmq = mysqli_query($conn,"SELECT COUNT(dd.id) AS DdCnt FROM deliverydetails dd JOIN ecregister ec on ec.picmeNo=dd.picmeno 
JOIN hscmaster hs on
ec.BlockId = hs.BlockId AND 
ec.PhcId = hs.PhcId AND 
ec.HscId =hs.HscId AND 
ec.PanchayatId =hs.PanchayatId AND 
ec.VillageId = hs.VillageId
WHERE dd.status=1");
$DdCnt = mysqli_fetch_array($DdCntmq);

$ImCntmq = mysqli_query($conn,"SELECT COUNT(DISTINCT(im.picmeNo)) AS ImCnt FROM immunization im JOIN ecregister ec on ec.picmeNo=im.picmeNo 
JOIN hscmaster hs on
ec.BlockId = hs.BlockId AND 
ec.PhcId = hs.PhcId AND 
ec.HscId =hs.HscId AND 
ec.PanchayatId =hs.PanchayatId AND 
ec.VillageId = hs.VillageId
WHERE im.status=1");
$ImCnt = mysqli_fetch_array($ImCntmq);
									
$PvCntmq = mysqli_query($conn,"SELECT COUNT(DISTINCT(p.picmeNo)) AS PvCnt FROM postnatalvisit p JOIN ecregister ec on ec.picmeNo=p.picmeno 
JOIN hscmaster hs on
ec.BlockId = hs.BlockId AND 
ec.PhcId = hs.PhcId AND 
ec.HscId =hs.HscId AND 
ec.PanchayatId =hs.PanchayatId AND 
ec.VillageId = hs.VillageId
WHERE p.status=1");
$PvCnt = mysqli_fetch_array($PvCntmq);
    
$UsCntmq = mysqli_query($conn,"SELECT COUNT(id) AS UsCnt FROM users WHERE email !='test@thaimaiyudan.org' AND status='1' AND usertype NOT IN (0,1)");
$UsCnt = mysqli_fetch_array($UsCntmq);   


/* Restricted Delivery Detials Record in pregnancy status count - by Nithya*/     
//$LmCntmq = mysqli_query($conn,"SELECT COUNT(id) AS LmCnt FROM ecregister WHERE status NOT IN(0,1) ");
$LmCntmq = mysqli_query($conn,"SELECT COUNT(ec.id) AS LmCnt FROM ecregister ec
JOIN hscmaster hs on
ec.BlockId = hs.BlockId AND 
ec.PhcId = hs.PhcId AND 
ec.HscId =hs.HscId AND 
ec.PanchayatId =hs.PanchayatId AND 
ec.VillageId = hs.VillageId
WHERE ec.status NOT IN(0,1)  
AND NOT EXISTS (SELECT deliverydetails.picmeno FROM deliverydetails WHERE deliverydetails.picmeno = ec.picmeNo)");
$LmCnt = mysqli_fetch_array($LmCntmq);
    
$HsCntmq = mysqli_query($conn,"SELECT COUNT(id) AS HsCnt FROM hscmaster");
$HsCnt = mysqli_fetch_array($HsCntmq);
    
$PhCntmq = mysqli_query($conn,"SELECT COUNT(id) AS PhCnt FROM hospital WHERE status=1");
$PhCnt = mysqli_fetch_array($PhCntmq);
?>