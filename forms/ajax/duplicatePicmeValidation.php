<?php
include "../../config/db_connect.php";
$picmeNo = $_POST["picmeno"];

$AvCntmq = mysqli_query($conn, "SELECT count(av.id) AS deliveryCnt FROM deliverydetails as av WHERE av.picmeno = '$picmeNo' LIMIT 0,1");
$AvCnt = mysqli_fetch_array($AvCntmq);

if (!empty($AvCnt) && isset($AvCnt['deliveryCnt']) &&  $AvCnt['deliveryCnt'] > 0) {
    echo 1;
} else {
   echo 0;
}