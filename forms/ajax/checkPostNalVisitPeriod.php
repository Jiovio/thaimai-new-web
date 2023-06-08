<?php
include "../../config/db_connect.php";
$picmeNo = $_POST["picmeno"];
$deliverySql = mysqli_query($conn, "SELECT * FROM deliverydetails WHERE picmeno = '$picmeNo' order by id desc LIMIT 0,1");
$deliveryData = mysqli_fetch_array($deliverySql);
$result = ['result' => '', 'message' => '', 'place' =>''];
if(empty($deliveryData) || $deliveryData==0){
    $result['result'] = "fail";
    $result['message'] = "Invalid Picme no";
    $result['place'] = 'picmeno';
    echo json_encode($result);
    return;
}
$CheckPNCPeriod = mysqli_query($conn,"SELECT picmeNo, pncPeriod  FROM postnatalvisit where picmeNo='".$_POST["picmeno"]."' order by id desc LIMIT 0,1");
$CheckPNCPeriodData = mysqli_fetch_array($CheckPNCPeriod); 

$query = "SELECT enumid,enumvalue FROM enumdata WHERE type=17";
$exequery = mysqli_query($conn, $query);
$periodAr= array();
while ($listvalue = mysqli_fetch_assoc($exequery)) {
    $periodAr[$listvalue['enumid']] = $listvalue['enumvalue'];
}

if (!empty($CheckPNCPeriodData) && isset($CheckPNCPeriodData['picmeNo']) &&  $CheckPNCPeriodData['picmeNo'] > 0) {
  $newPNCPeriod = $CheckPNCPeriodData["pncPeriod"] + 1;
  if($CheckPNCPeriodData['pncPeriod']==7){
      $result['result'] = "error";
      $result['message'] = "Picme reached seven entries. No more entries allowed to this picme";
      $result['selected'] = "";
  } else if($_POST["pncPeriod"] != ($CheckPNCPeriodData["pncPeriod"]+1)){
       $result['result'] = "error";
       $result['selected'] = $CheckPNCPeriodData["pncPeriod"]+1;
       $period = isset($periodAr[$result['selected']]) ? " : ".$periodAr[$result['selected']] : "";
       $result['message'] = "Selected PNC is already present. Please enter the details for applicable PNC ".$period;
   } else {
       $result['result'] = "success";
       $result['selected'] = $CheckPNCPeriodData["pncPeriod"]+1;
   }
   
   
} else {
   if($_POST["pncPeriod"]!=1){
       $result['result'] = "fail";
       $result['message'] = "Please enter data for first day PNC Period";
       $result['selected'] = 1;
   } else {
       $result['selected'] = 1;
   }
}

echo json_encode($result);