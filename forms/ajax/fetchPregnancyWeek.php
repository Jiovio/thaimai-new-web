<?php
include "../../config/db_connect.php";
$picmeNo = $_POST["picmeno"];

$medicalSql = mysqli_query($conn, "SELECT * FROM medicalhistory WHERE picmeNo = '$picmeNo' order by id desc LIMIT 0,1");
$medicalData = mysqli_fetch_array($medicalSql);


if(empty($medicalData) || $medicalData==0)
{
    echo 1;
    return;
}

$Checkabortion = mysqli_query($conn,"SELECT picmeno, abortion, anvisitDate FROM antenatalvisit where picmeno='".$_POST["picmeno"]."' order by id desc LIMIT 0,1");
$CheckabortionData = mysqli_fetch_array($Checkabortion); 

if (!empty($CheckabortionData)) {
  $newabortion = $CheckabortionData["abortion"];
  $preavdate = $CheckabortionData["anvisitDate"];
  if($newabortion==1){
	  echo "2";  
    return;   
  }
  $new_avdate = $_POST['anvisitDate'];
  if(strlen($new_avdate) > 0 && $preavdate == $new_avdate){
	  echo "3";  
    return;   
  } 
   if(strlen($new_avdate) > 0 && $preavdate > $new_avdate){
	  echo "4";  
    return;   
  } 
} 

$AvCntmq = mysqli_query($conn, "SELECT count(av.id) AS AvCnt FROM antenatalvisit as av WHERE av.picmeno = '$picmeNo'");
$AvCnt = mysqli_fetch_array($AvCntmq);
$ArTot = $AvCnt['AvCnt'] + 1;
$selectLmpDate = mysqli_query($conn, "SELECT lmpdate FROM medicalhistory WHERE picmeno = '$picmeNo'");
$lmpDateData = mysqli_fetch_array($selectLmpDate);
if (!empty($selectLmpDate) && isset($lmpDateData['lmpdate'])) {

    $lmpDate = $lmpDateData['lmpdate'];
} else {
    $lmpDate = date('d-m-Y');
}
$totalWeek = "";
if (isset($_POST['anvisitDate']) && !empty($_POST['anvisitDate'])) {
    $totalWeek = numWeeks($lmpDate, $_POST['anvisitDate']);
}
$ArTot = empty($ArTot) ? 1 : $ArTot;
echo $ArTot . '-#@#-' . $totalWeek;

/**
 * A custom function that calculates how many weeks occur
 * between two given dates.
 * 
 * @param string $dateOne Y-m-d format.
 * @param string $dateTwo Y-m-d format.
 * @return int
 */
function numWeeks($dateOne, $dateTwo){
    //Create a DateTime object for the first date.
    $firstDate = new DateTime($dateOne);
    //Create a DateTime object for the second date.
    $secondDate = new DateTime($dateTwo);
    //Get the difference between the two dates in days.
    $differenceInDays = $firstDate->diff($secondDate)->days;
    //Divide the days by 7
    $differenceInWeeks = $differenceInDays / 7;
    //Round down with floor and return the difference in weeks.
    return floor($differenceInWeeks);
}

?>