<?php
include "../../config/db_connect.php";
$picmeNo = $_POST["picmeno"];



$AvCntmq = mysqli_query($conn, "SELECT count(av.id) AS deliveryCnt FROM deliverydetails as av WHERE av.picmeno = '$picmeNo' LIMIT 0,1");
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
   $AnVis = mysqli_query($conn, "SELECT * FROM antenatalvisit WHERE picmeno = '$picmeNo'");
   $AnVis_dt = mysqli_fetch_array($AnVis);
   if(!empty($AnVis_dt))
   {
	echo 2;   
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