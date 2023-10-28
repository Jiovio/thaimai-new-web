<?php
include "../../config/db_connect.php";
$picmeNo = $_POST["picmeno"];
$result = [];

$medicalSql = mysqli_query($conn, "SELECT * FROM medicalhistory WHERE picmeNo = '$picmeNo' order by id desc LIMIT 0,1");
$medicalData = mysqli_fetch_array($medicalSql);


if(empty($medicalData) || $medicalData==0)
{
    $result['result'] = "1";
}

$Checkabortion = mysqli_query($conn,"SELECT picmeno, abortion, anvisitDate FROM antenatalvisit where picmeno='".$_POST["picmeno"]."' order by id desc LIMIT 0,1");
$CheckabortionData = mysqli_fetch_array($Checkabortion); 

if (!empty($CheckabortionData)) {
  $newabortion = $CheckabortionData["abortion"];
  $preavdate = $CheckabortionData["anvisitDate"];
  if($newabortion==1){
	 $result['result'] = "2";
  }
  
} 

echo json_encode($result);

?>
