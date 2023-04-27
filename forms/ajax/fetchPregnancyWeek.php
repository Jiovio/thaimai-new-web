<?php
include "../../config/db_connect.php";
$picmeNo = $_POST["picmeno"];

$AvCntmq = mysqli_query($conn,"SELECT count(av.id) AS AvCnt FROM antenatalvisit as av WHERE av.picmeno = '$picmeNo'");
$AvCnt = mysqli_fetch_array($AvCntmq);
$ArTot = $AvCnt['AvCnt']+1;
$selectLmpDate = mysqli_query($conn,"SELECT lmpdate FROM medicalhistory WHERE picmeno = '$picmeNo'");
$lmpDateData = mysqli_fetch_array($selectLmpDate);
if(!empty($selectLmpDate) && isset($lmpDateData['lmpdate'])){

$lmpDate = $lmpDateData['lmpdate'];
} else {
    $lmpDate = date('d-m-Y');
}


$totalWeek = numWeeks($lmpDate, date('d-m-Y'));

echo $ArTot.'-#@#-'.$totalWeek;

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
