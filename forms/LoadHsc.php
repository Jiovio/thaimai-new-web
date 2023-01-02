<?php
$ErCntmq = mysqli_query($conn,"SELECT COUNT(id) AS ErCnt FROM ecregister WHERE BlockId='".$bloName."' AND PhcId='".$phcName."' AND HscId='".$hscName."' AND status!=0");
$ErCnt = mysqli_fetch_array($ErCntmq);

$ArCntmq = mysqli_query($conn,"SELECT COUNT(ar.motheraadhaarid) AS ArCnt FROM anregistration ar JOIN ecregister ec ON ar.motheraadhaarid=ec.motheraadhaarid WHERE ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."' AND ec.HscId='".$hscName."' AND ar.status=1");
$ArCnt = mysqli_fetch_array($ArCntmq);

$AvCntmq = mysqli_query($conn,"SELECT COUNT(av.picmeno) AS AvCnt FROM antenatalvisit av JOIN ecregister ec ON av.picmeno=ec.picmeno WHERE ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."' AND ec.HscId='".$hscName."' AND av.status=1");
$AvCnt = mysqli_fetch_array($AvCntmq);

$MhCntmq = mysqli_query($conn,"SELECT COUNT(mh.picmeno) AS MhCnt FROM medicalhistory mh JOIN ecregister ec ON mh.picmeno=ec.picmeno WHERE ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."' AND ec.HscId='".$hscName."' AND mh.status=1");
$MhCnt = mysqli_fetch_array($MhCntmq);

$HrCntmq = mysqli_query($conn,"SELECT COUNT(av.symptomsHighRisk) AS HrCnt FROM antenatalvisit av JOIN ecregister ec on av.picmeNo=ec.picmeno WHERE ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."' AND ec.HscId='".$hscName."' AND av.symptomsHighRisk!=48 AND av.status=1");
$HrCnt = mysqli_fetch_array($HrCntmq);

$DdCntmq = mysqli_query($conn,"SELECT COUNT(dd.picmeNo) AS DdCnt FROM deliverydetails dd JOIN ecregister ec ON dd.picmeno=ec.picmeno WHERE ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."' AND ec.HscId='".$hscName."' AND dd.status=1");
$DdCnt = mysqli_fetch_array($DdCntmq);

$ImCntmq = mysqli_query($conn,"SELECT COUNT(im.picmeNo) AS ImCnt FROM immunization im JOIN ecregister ec ON im.picmeno=ec.picmeno WHERE ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."' AND ec.HscId='".$hscName."' AND im.status=1");
$ImCnt = mysqli_fetch_array($ImCntmq);
									
$PvCntmq = mysqli_query($conn,"SELECT count(pv.picmeNo) AS PvCnt FROM postnatalvisit pv JOIN ecregister ec ON pv.picmeno=ec.picmeno WHERE ec.BlockId='".$bloName."' AND ec.PhcId='".$phcName."' AND ec.HscId='".$hscName."' AND pv.status=1");
$PvCnt = mysqli_fetch_array($PvCntmq);
    
$UsCntmq = mysqli_query($conn,"SELECT COUNT(id) AS UsCnt FROM users WHERE BlockId='".$bloName."' AND PhcId='".$phcName."' AND HscId='".$hscName."' AND status=1");
$UsCnt = mysqli_fetch_array($UsCntmq);
    
$LmCntmq = mysqli_query($conn,"SELECT COUNT(id) AS LmCnt FROM hscmaster WHERE BlockId='".$bloName."' AND PhcId='".$phcName."' AND HscId='".$hscName."'");
$LmCnt = mysqli_fetch_array($LmCntmq);
    
$HsCntmq = mysqli_query($conn,"SELECT COUNT(id) AS HsCnt FROM hscmaster WHERE BlockId='".$bloName."' AND PhcId='".$phcName."' AND HscId='".$hscName."'");
$HsCnt = mysqli_fetch_array($HsCntmq);
    
$PhCntmq = mysqli_query($conn,"SELECT COUNT(id) AS PhCnt FROM hospital WHERE BlockId='".$bloName."'");
$PhCnt = mysqli_fetch_array($PhCntmq);
?>