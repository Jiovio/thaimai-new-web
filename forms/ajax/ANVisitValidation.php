<?php
include "../../config/db_connect.php";
$picmeNo = $_POST["picmeno"];
$gctStatus = $_POST['gctStatus'];
$deliverySql = mysqli_query($conn, "SELECT * FROM antenatalvisit WHERE picmeno = '$picmeNo' AND gctStatus='$gctStatus' order by id desc LIMIT 0,1");
$antVisitData = mysqli_fetch_array($deliverySql);
$result = ['result' => '', 'message' => '', 'place' =>''];
if(empty($antVisitData) || $antVisitData==0){
    $result['result'] = "success";    
} 
else 
if($gctStatus == "4")	
{
    $result['result'] = "success";  
}
else 
{
    $result['result'] = "fail";
    $result['message'] = "This GCT week status is already present.";
}

echo json_encode($result);
return;
