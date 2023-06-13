<?php
include "../../config/db_connect.php";
$picmeNo = $_POST["picmeno"];
$result = [];
$deliverySql = mysqli_query($conn, "SELECT * FROM deliverydetails WHERE picmeno = '$picmeNo' order by id desc LIMIT 0,1");
$deliveryData = mysqli_fetch_array($deliverySql);

if(empty($deliveryData) || $deliveryData==0){
    $result['result'] = "fail";
    echo json_encode($result);
    return;
}
$doseProvidedDate = $_POST['doseProvidedDateVal'];
$checkdoseProvidedDate =0;
if(!empty($doseProvidedDate) && !is_null($doseProvidedDate)){
    $checkdoseProvidedDate = $_POST['doseProvidedDateVal'];
}
$immuneSql = mysqli_query($conn, "SELECT * FROM immunization WHERE picmeno = '$picmeNo' order by id desc LIMIT 0,1");
$immuneData = mysqli_fetch_array($immuneSql);

$doseDays = [1 => 45, 2=> 75, 3=>105, 4=>270, 5=>480];
if (!empty($immuneData) &&  $immuneData !=0) {
 
     $today = date('Y-m-d');
     $dateDiff =  noOfDaysBetweenDates($deliveryData['deliverydate'], $today);
     
    switch($immuneData['doseNo']){
        case 1:
           $ImmuneDate = date('Y-m-d', strtotime($deliveryData['deliverydate']. ' + 75 days'));
           $displayDate = date('d/m/Y', strtotime($ImmuneDate));
            if($dateDiff > $doseDays[2]){
                $result['result'] = "success.";
                $result['message'] = "Second dose due date is " . $displayDate . ". It is already expired. Please take 2nd dose immediately";
                $result['doseNo'] = 2;
                $result['doseDueDate'] = $ImmuneDate;
            } else if($dateDiff <  $doseDays[2]) {
                $result['result'] = "error";
                $result['message']= "Second dose due date is ".$displayDate.". Please wait upto date of ".$displayDate;
                $result['doseNo'] = 2;
                $result['doseDueDate'] = $ImmuneDate;
                if($checkdoseProvidedDate!=0 && (strtotime($ImmuneDate) > strtotime($checkdoseProvidedDate))){
                     $result['message']= "You are taking this dose before due date ".$displayDate;                     
                } else if($checkdoseProvidedDate!=0 && (strtotime($ImmuneDate) <= strtotime($checkdoseProvidedDate))){
                     $result['result'] = "success";
                     $result['message']="";
                }
            } else {
                $result['result'] = "success";
                $result['message'] = ".";
                $result['doseNo'] = 2;
                $result['doseDueDate'] = $ImmuneDate;
            }
           break;
        case 2:
            $ImmuneDate = date('Y-m-d', strtotime($deliveryData['deliverydate']. ' + 105 days'));
             $displayDate = date('d/m/Y', strtotime($ImmuneDate));
            if($dateDiff > $doseDays[3]){
                $result['result'] = "success";
                $result['message'] = "Third dose due date is " . $displayDate . ". It is already expired. Please take 3rd dose immediately.";
                $result['doseNo'] = 3;
                $result['doseDueDate'] = $ImmuneDate;
            } else if($dateDiff <  $doseDays[3]) {
                $result['result'] = "error";
                $result['message']= "Third dose due date is ".$displayDate.". Please wait upto date of ".$displayDate;
                $result['doseNo'] = 3;
                $result['doseDueDate'] = $ImmuneDate;
                if($checkdoseProvidedDate!=0 && (strtotime($ImmuneDate) > strtotime($checkdoseProvidedDate))){
                     $result['message']= "You are taking this dose before due date ".$displayDate;                     
                } else if($checkdoseProvidedDate!=0 && (strtotime($ImmuneDate) <= strtotime($checkdoseProvidedDate))){
                     $result['result'] = "success";
                     $result['message']="";
                }
            } else {
                $result['result'] = "success";
                $result['message'] = "";
                $result['doseNo'] = 3;
                $result['doseDueDate'] = $ImmuneDate;
            }
            break;
        case 3:
            $ImmuneDate = date('Y-m-d', strtotime($deliveryData['deliverydate']. ' + 270 days'));
             $displayDate = date('d/m/Y', strtotime($ImmuneDate));
            if($dateDiff > $doseDays[4]){
                $result['result'] = "success";
                $result['message'] = "Fourth dose due date is " . $displayDate . ". It is already expired. Please take 4th dose immediately.";
                $result['doseNo'] = 4;
                $result['doseDueDate'] = $ImmuneDate;
            } else if($dateDiff <  $doseDays[4]) {
                $result['result'] = "error";
                $result['message']= "Fourth dose due date is ".$displayDate.". Please wait upto date of ".$displayDate;
                $result['doseNo'] = 4;
                $result['doseDueDate'] = $ImmuneDate;
                if($checkdoseProvidedDate!=0 && (strtotime($ImmuneDate) > strtotime($checkdoseProvidedDate))){
                     $result['message']= "You are taking this dose before due date ".$displayDate;                     
                } else if($checkdoseProvidedDate!=0 && (strtotime($ImmuneDate) <= strtotime($checkdoseProvidedDate))){
                     $result['result'] = "success";
                     $result['message']="";
                }
            } else {
                $result['result'] = "success";
                $result['message'] = "";
                $result['doseNo'] = 4;
                $result['doseDueDate'] = $ImmuneDate;
            }
            break;
        case 4:
            $ImmuneDate = date('Y-m-d', strtotime($deliveryData['deliverydate']. ' + 480 days'));
             $displayDate = date('d/m/Y', strtotime($ImmuneDate));
              if($dateDiff > $doseDays[5]){
                $result['result'] = "success";
                $result['message'] = "Fifth dose due date is " . $displayDate . ". It is already expired. Please take 5th dose immediately.";
                $result['doseNo'] = 5;
                $result['doseDueDate'] = $ImmuneDate;
            } else if($dateDiff <  $doseDays[5]) {
                $result['result'] = "error";
                $result['message']= "Fifth dose due date is ".$displayDate.". Please wait upto date of ".$displayDate;
                $result['doseNo'] = 5;
                $result['doseDueDate'] = $ImmuneDate;

                if($checkdoseProvidedDate!=0 && (strtotime($ImmuneDate) > strtotime($checkdoseProvidedDate))){
                     $result['message']= "You are taking this dose before due date ".$displayDate;                     
                } else if($checkdoseProvidedDate!=0 && (strtotime($ImmuneDate) <= strtotime($checkdoseProvidedDate))){
                     $result['result'] = "success";
                     $result['message']="";
                }
            } else {
                $result['result'] = "success";
                $result['message'] = "";
                $result['doseNo'] = 5;
                $result['doseDueDate'] = $ImmuneDate;
            }
           break;
        case 5:
             $result['result'] = "error";
             $result['message']= "Already 5 doses taken. No more doses applicable for this picme. Please choose new picme";
             break;
       
    }
   echo json_encode($result);
} else {
   $today = date('Y-m-d');
   $firstDoseDate =  date('Y-m-d', strtotime($deliveryData['deliverydate']. ' + 45 days'));
   $dateDiff =  noOfDaysBetweenDates($deliveryData['deliverydate'], $today);
       $displayDate = date('d/m/Y', strtotime($firstDoseDate));
   if($dateDiff > 45){
       $result['result'] = "success";
       $result['message']= "First dose due date is ".$displayDate.". It is already expired. Please take first dose immediately.";
       $result['doseNo'] = 1;
       $result['doseDueDate'] = $firstDoseDate;
//       $msg = "success#@#First dose due date is ".$firstDoseDate.". It is already expired. Please take first dose immediately.";
//       $msg = $msg."#@#1#@#".$firstDoseDate;
   } else if($dateDiff < 45){
       $result['result'] = "error";
       $result['message']= "First dose due date is ".$displayDate.". Please wait upto date of ".$displayDate;
       $result['doseNo'] = 1;
       $result['doseDueDate'] = $firstDoseDate;
       
   }
   echo json_encode($result);
}

function noOfDaysBetweenDates($startDate, $toDate) {
    $startTimeStamp = strtotime($startDate);
    $endTimeStamp = strtotime($toDate);
    if ($endTimeStamp > $startTimeStamp) {
        $timeDiff = abs($endTimeStamp - $startTimeStamp);
    } else {
        $timeDiff = abs($startTimeStamp - $endTimeStamp);
    }

    $numberDays = $timeDiff / 86400;  // 86400 seconds in one day
// and you might want to convert to integer
    $numberDays = intval($numberDays);
    return $numberDays;
}
