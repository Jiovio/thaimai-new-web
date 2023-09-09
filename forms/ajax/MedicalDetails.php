
<?php
include "../../config/db_connect.php";
$picmeNo = $_POST["picmeno"];

print_r("I am here"); 

$medicalSql = mysqli_query($conn, "SELECT * FROM medicalhistory WHERE picmeno = '$picmeNo' order by id");
$medicalData = mysqli_fetch_array($medicalSql);

if (!empty($medicalData)) {
    echo 1;
} 
/*else {
   $antenatalSql = mysqli_query($conn, "SELECT * FROM anregistration WHERE picmeno = '$picmeNo' order by id");
$antenatalData = mysqli_fetch_array($antenatalSql);

if (!empty($antenatalData) && isset($antenatalData)) {
    echo 3;
} else {
   echo 4;
}
} */




/* include "../../config/db_connect.php";
$picmeNo = $_POST["picmeno"];
$result = [];
$antenatalSql = mysqli_query($conn, "SELECT * FROM anregistration WHERE picmeno = '$picmeNo' order by id");
$antenatalData = mysqli_fetch_array($antenatalSql);

if(empty($antenatalData) || $antenatalData==0){
    $result['result'] = "fail";
    echo json_encode($result);
    return;
}

$medicalSql = mysqli_query($conn, "SELECT * FROM medicalhistory WHERE picmeno = '$picmeNo' order by id");
$medicalData = mysqli_fetch_array($medicalSql);

if(empty($medicalData) || $medicalData==0)
{
	$result['result'] = "success.";
    $result['message'] = "Valid picme";
 }
else
{
    $result['result'] = "success.";
    $result['message'] = "Picme already exists in medical history.";
}

   echo json_encode($result); 
} */
