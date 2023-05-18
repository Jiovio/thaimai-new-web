<?php
include "../../config/db_connect.php";
$picmeNo = $_POST["picmeno"];
$CheckPNCPeriod = mysqli_query($conn,"SELECT picmeNo, pncPeriod  FROM postnatalvisit where picmeNo='".$_POST["picmeno"]."' order by id desc LIMIT 0,1");
$CheckPNCPeriodData = mysqli_fetch_array($CheckPNCPeriod); 
$result = ['result' => '', 'message' => ''];
if (!empty($CheckPNCPeriodData) && isset($CheckPNCPeriodData['picmeNo']) &&  $CheckPNCPeriodData['picmeNo'] > 0) {
  $newPNCPeriod = $CheckPNCPeriodData["pncPeriod"] + 1;
  if($CheckPNCPeriodData['pncPeriod']==7){
      $result['result'] = "error";
      $result['message'] = "Already entered for all PNC period details for this picme no";
      $result['selected'] = "";
  } else if($_POST["pncPeriod"] != $CheckPNCPeriodData["pncPeriod"]){
       $result['result'] = "error";
       $result['message'] = "Above selected period is missed to enter. Please fill for above period";
       $result['selected'] = $CheckPNCPeriodData["pncPeriod"]+1;
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