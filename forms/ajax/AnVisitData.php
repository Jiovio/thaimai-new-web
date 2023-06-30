<?php
include "../../config/db_connect.php";
$picmeNo = $_POST["picmeno"];

$deliverySql = mysqli_query($conn, "SELECT * FROM antenatalvisit WHERE picmeno = '$picmeNo' order by id desc LIMIT 0,1");
$antVisitData = mysqli_fetch_array($deliverySql);
$anRegSql = mysqli_query($conn, "SELECT * FROM anregistration WHERE picmeno = '$picmeNo' order by id desc LIMIT 0,1");
$anRegData = mysqli_fetch_array($anRegSql);
$result = ['result' => 'fail', 'message' => '', 'place' =>''];



if (!empty($antVisitData) && $antVisitData != 0) {
    $result['data'] = $antVisitData;
    $result['highRisk'] = 0;
    if ((($antVisitData['Hb'] > 10 ) || ($antVisitData['urineSugarPresent'] == 1) || $antVisitData['urineAlbuminPresent'] == 1) || $antVisitData['gctValue'] >= "190" OR $antVisitData['Tsh'] > "4.87" OR $antVisitData['bpSys'] >= "140" OR $antVisitData['bpDia'] >= "90" OR $antVisitData['motherWeight'] <= "40") {
        $result['highRisk'] = 1;
    }
   
    
}
 $result['obcode'] = "";
if (!empty($anRegData) && $anRegData != 0) {
    $result['result'] = "success";
    $result['obcode'] = $anRegData['obstetricCode'];
} 

echo json_encode($result);
return;