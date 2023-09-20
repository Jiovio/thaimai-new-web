<?php
include "../../config/db_connect.php";
$picmeNo = $_POST["picmeno"];
$predeldate = $_POST["predeldate"];


$AvCntmq = mysqli_query($conn, "SELECT * FROM deliverydetails WHERE picmeno = '$picmeNo'");
$AvCnt = mysqli_fetch_array($AvCntmq);

if (!empty($AvCnt) && isset($AvCnt['deliveryCnt']) &&  $AvCnt['deliveryCnt'] > 0) {
    echo 1;
} else {
 //  echo 0;
   $ANReg = mysqli_query($conn, "SELECT * FROM anregistration WHERE picmeno = '$picmeNo'");
   $ANReg_dt = mysqli_fetch_array($ANReg);
   if(!empty($ANReg_dt))
   {
   $MedHis = mysqli_query($conn, "SELECT * FROM medicalhistory WHERE picmeno = '$picmeNo'");
   $MedHis_dt = mysqli_fetch_array($MedHis);
   if(!empty($MedHis_dt))
   {
   $AnVis = mysqli_query($conn, "SELECT * FROM antenatalvisit av WHERE picmeno = '$picmeNo'
   AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno)");
   $AnVis_dt = mysqli_fetch_array($AnVis);
   if(!empty($AnVis_dt))
   {
	 if($AnVis_dt['anvisitDate'] > $predeldate)
	 {   
       	echo 6; 
	 }
   } 
   else
   {
	echo 5;   
   }
   } 
   else
	   {
	echo 4;   
   }  
   }
   else
   {
	echo 3;   
   }   

}