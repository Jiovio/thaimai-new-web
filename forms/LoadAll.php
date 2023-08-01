<?php 
$ErCntmq = mysqli_query($conn,"SELECT COUNT(id) AS ErCnt FROM ecregister WHERE status!=0");
$ErCnt = mysqli_fetch_array($ErCntmq);

$ArCntmq = mysqli_query($conn,"SELECT COUNT(an.id) AS ArCnt FROM anregistration an JOIN ecregister ec on ec.motheraadhaarid=an.motheraadhaarid WHERE an.status=1");
$ArCnt = mysqli_fetch_array($ArCntmq);

$AvCntmq = mysqli_query($conn,"SELECT count(av.id) AS AvCnt FROM antenatalvisit av JOIN ecregister ec on ec.picmeNo=av.picmeno WHERE av.status=1");
$AvCnt = mysqli_fetch_array($AvCntmq);

$MhCntmq = mysqli_query($conn,"SELECT count(mh.id) AS MhCnt FROM medicalhistory mh JOIN ecregister ec on ec.picmeNo=mh.picmeno WHERE mh.status=1");
$MhCnt = mysqli_fetch_array($MhCntmq);

$HrCntmq = mysqli_query($conn,"SELECT count(hr.id) as HrCnt from highriskmothers hr JOIN ecregister ec on hr.picmeNo=ec.picmeNo WHERE hr.status!=0");
$HrCnt = mysqli_fetch_array($HrCntmq);

$DdCntmq = mysqli_query($conn,"SELECT COUNT(dd.id) AS DdCnt FROM deliverydetails dd JOIN ecregister ec on ec.picmeNo=dd.picmeno WHERE dd.status=1");
$DdCnt = mysqli_fetch_array($DdCntmq);

$ImCntmq = mysqli_query($conn,"SELECT COUNT(im.id) AS ImCnt FROM immunization im JOIN ecregister ec on ec.picmeNo=im.picmeNo WHERE im.status=1");
$ImCnt = mysqli_fetch_array($ImCntmq);
									
$PvCntmq = mysqli_query($conn,"SELECT count(p.id) AS PvCnt FROM postnatalvisit p JOIN ecregister ec on ec.picmeNo=p.picmeno WHERE p.status=1");
$PvCnt = mysqli_fetch_array($PvCntmq);
    
$UsCntmq = mysqli_query($conn,"SELECT COUNT(id) AS UsCnt FROM users WHERE email !='test@thaimaiyudan.org' AND status='1' AND usertype NOT IN (0,1)");
$UsCnt = mysqli_fetch_array($UsCntmq); 


/* Restricted Delivery Detials Record in pregnancy status count - by Nithya*/     
//$LmCntmq = mysqli_query($conn,"SELECT COUNT(id) AS LmCnt FROM ecregister WHERE status NOT IN(0,1) ");
$LmCntmq = mysqli_query($conn,"SELECT COUNT(id) AS LmCnt FROM ecregister WHERE status NOT IN(0,1)  
AND NOT EXISTS (SELECT deliverydetails.picmeno FROM deliverydetails WHERE deliverydetails.picmeno = ecregister.picmeNo)");
$LmCnt = mysqli_fetch_array($LmCntmq);
    
$HsCntmq = mysqli_query($conn,"SELECT COUNT(id) AS HsCnt FROM hscmaster");
$HsCnt = mysqli_fetch_array($HsCntmq);
    
$PhCntmq = mysqli_query($conn,"SELECT COUNT(id) AS PhCnt FROM hospital WHERE status=1");
$PhCnt = mysqli_fetch_array($PhCntmq);
?>