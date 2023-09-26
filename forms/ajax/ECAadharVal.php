
<?php
include "../../config/db_connect.php";
$aadhar = $_POST["motadhaar"];
$result = [];

$antenatalSql = mysqli_query($conn, "SELECT * FROM anregistration WHERE motheraadhaarid = '$aadhar' order by id");
$antenatalData = mysqli_fetch_array($antenatalSql);

if (!empty($antenatalData) && isset($antenatalData)) {
    $result['result'] = "1";
} 
else {
   $ECSql = mysqli_query($conn, "SELECT * FROM ecregister WHERE motheraadhaarid = '$aadhar' order by id");
   $ECData = mysqli_fetch_array($ECSql);

if (!empty($ECData) && isset($ECData)) {
   $motdob = $ECData['motherdob'];
   $fatdob = $ECData['husdob'];
   $result['result'] = "3";
   $result['Motdob'] = $motdob;
   $result['Fatdob'] = $fatdob;
   
 /*  echo $motdob;
   echo $fatdob; 
   echo 3; */
     
} else {
   $result['result'] = "4";;
   
}
} 

   echo json_encode($result);
