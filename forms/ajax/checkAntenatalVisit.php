<?php
include "../../config/db_connect.php";
$picmeNo = $_POST["picmeno"];
$medicalSql = mysqli_query($conn, "SELECT * FROM medicalhistory WHERE picmeno = '$picmeNo' order by id desc LIMIT 0,1");
$medicalData = mysqli_fetch_array($medicalSql);
$result = ['result' => '', 'message' => '', 'place' =>''];
if(empty($medicalData) || $medicalData==0){
    $result['result'] = "fail";
    $result['message'] = "Invalid picme no.";
    $result['place'] = 'picmeno';
    echo json_encode($result);
    return;
}
$Checkabortion = mysqli_query($conn,"SELECT picmeNo, abortion  FROM antenatalvisit where picmeno='".$_POST["picmeno"]."' order by id desc LIMIT 0,1");
$CheckabortionData = mysqli_fetch_array($Checkabortion); 

if (!empty($CheckabortionData) && isset($CheckabortionData['picmeNo']) &&  $CheckabortionData['picmeNo'] > 0) {
  $newabortion = $CheckabortionData["abortion"];
  if($CheckabortionData['abortion']==1){
      $result['result'] = "error";
      $result['message'] = "During a prior antenatal appointment, the mother had an abortion. Since antenatal visits are not permitted.";
      $result['selected'] = "";
  } else {
       $result['result'] = "success";
       $result['selected'] = $CheckabortionData["abortion"];
   }
   
   
} 

echo json_encode($result);