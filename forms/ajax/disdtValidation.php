<?php
include "../../config/db_connect.php";
$picmeNo = $_POST["picmeno"];



$AvCntmq = mysqli_query($conn, "SELECT count(av.id) AS deliveryCnt FROM deliverydetails as av WHERE av.picmeno = '$picmeNo' LIMIT 0,1");
$AvCnt = mysqli_fetch_array($AvCntmq);

if (!empty($AvCnt) && isset($AvCnt['deliveryCnt']) &&  $AvCnt['deliveryCnt'] > 0) {
	 if(($AvCnt['deliverydate'] > $AvCnt['dischargedate']) AND isset($AvCnt['deliverydate']))
	   {
		   echo 6;
	   }
	   else
	   {
		if(($AvCnt['deliverydate'] = $AvCnt['dischargedate']) AND 
		   ($AvCnt['deliverytime'] > $AvCnt['dischargetime']) AND
		    AND isset(['deliverytime']))   
		{
			echo 7;
		}
	   }
}