<?php 
$ErCntmq = mysqli_query($conn,"SELECT COUNT(id) AS ErCnt FROM ecregister WHERE status!=0");
$ErCnt = mysqli_fetch_array($ErCntmq);

$ArCntmq = mysqli_query($conn,"SELECT COUNT(id) AS ArCnt FROM anregistration WHERE status=1");
$ArCnt = mysqli_fetch_array($ArCntmq);

$AvCntmq = mysqli_query($conn,"SELECT count(id) AS AvCnt FROM antenatalvisit WHERE status=1");
$AvCnt = mysqli_fetch_array($AvCntmq);

$MhCntmq = mysqli_query($conn,"SELECT count(id) AS MhCnt FROM medicalhistory WHERE status=1");
$MhCnt = mysqli_fetch_array($MhCntmq);

$HrCntmq = mysqli_query($conn,"SELECT COUNT(av.symptomsHighRisk) AS HrCnt FROM antenatalvisit av JOIN ecregister ec on av.picmeNo=ec.picmeno WHERE av.symptomsHighRisk!=48 AND av.status=1");
$HrCnt = mysqli_fetch_array($HrCntmq);

$DdCntmq = mysqli_query($conn,"SELECT COUNT(id) AS DdCnt FROM deliverydetails WHERE status=1");
$DdCnt = mysqli_fetch_array($DdCntmq);

$ImCntmq = mysqli_query($conn,"SELECT COUNT(id) AS ImCnt FROM immunization WHERE status=1");
$ImCnt = mysqli_fetch_array($ImCntmq);
									
$PvCntmq = mysqli_query($conn,"SELECT count(id) AS PvCnt FROM postnatalvisit WHERE status=1");
$PvCnt = mysqli_fetch_array($PvCntmq);
    
$UsCntmq = mysqli_query($conn,"SELECT COUNT(id) AS UsCnt FROM users WHERE status=1");
$UsCnt = mysqli_fetch_array($UsCntmq);
    
$LmCntmq = mysqli_query($conn,"SELECT COUNT(id) AS LmCnt FROM ecregister WHERE status NOT IN(0,1)");
$LmCnt = mysqli_fetch_array($LmCntmq);
    
$HsCntmq = mysqli_query($conn,"SELECT COUNT(id) AS HsCnt FROM hscmaster");
$HsCnt = mysqli_fetch_array($HsCntmq);
    
$PhCntmq = mysqli_query($conn,"SELECT COUNT(id) AS PhCnt FROM hospital WHERE status=1");
$PhCnt = mysqli_fetch_array($PhCntmq);
?>