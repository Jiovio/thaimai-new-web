<?php
include "../../config/db_connect.php";
$picmeNo = $_POST["picmeno"];

$Checkabortion = mysqli_query($conn,"SELECT picmeno, abortion, anvisitDate FROM antenatalvisit where picmeno='".$_POST["picmeno"]."' order by id desc LIMIT 0,1");
$CheckabortionData = mysqli_fetch_array($Checkabortion); 

if (!empty($CheckabortionData)) {
  $preavdate = $CheckabortionData["anvisitDate"];
  $new_avdate = $_POST['anvisitDate'];
  if(strlen($new_avdate) > 0 && $preavdate > $new_avdate){
	  echo "3";  
    return;   
  } 
} 
?>