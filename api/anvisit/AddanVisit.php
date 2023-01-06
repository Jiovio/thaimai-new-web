<?php
ini_set("display_errors",'1');
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require '../../vendor/autoload.php';
use Aws\S3\S3Client;
// get database connection
include_once '../config/database.php';

// instantiate product object
include_once '../objects/anvisit.php';

$database = new Database();
$db = $database->getConnection();
$form = new AnVisit($db);
// get posted data
$data = json_decode(file_get_contents("php://input"));
// make sure data is not empty
if (!empty($data->picmeno)) {
    // set form property values
    

    $mvaliduser1 = $db->prepare("SELECT * FROM antenatalvisit WHERE picmeno='".$data->picmeno."' ORDER BY id ASC");
    $mvaliduser1->execute(array());
    $mvalidchecknum = $mvaliduser1->rowCount();
   
    if ($mvalidchecknum > 0) {
        //$inserid = $form->createantenatalvisit();
        $date = date('Y-m-d', strtotime($data->anvisitDate. ' + 30 days'));
        $addquery = "INSERT INTO antenatalvisit (`picmeno`, `residenttype`, `physicalpresent`, `placeofvisit`, `abortion`, 
        `anvisitDate`,`avdueDate`,`avTag`,`ancPeriod`, `pregnancyWeek`, `motherWeight`, `bpSys`, `bpDia`, `Hb`, `urineTestStatus`,`urineSugarPresent`,`urineAlbuminPresent`, 
        `fastingSugar`, `postPrandial`, `gctStatus`, `gctValue`, `Tsh`, `Td1`,`TdDose`, `Td2`,`Td2Dose`,`Tdb`, `TdBdose`, `Td1Date`, `Td2Date`, 
        `TdBoosterDate`, `Covidvac`, `Dose1Date`, `Dose2Date`, `PreDate`, `NoFolicAcid`, `NoIFA`, `dateofIFA`, `dateofAlbendazole`, `noCalcium`, 
        `calciumDate`, `sizeUterusinWeeks`, `fetalHeartRate`, `fetalPosition`, `fetalMovement`, `methodofConception`,`AnyOtherSpecify`, 
        `HighRisk`,`symptomsHighRisk`, `referralDate`, `referralDistrict`, `referralFacility`, `referralPlace`, `wusgTaken`, `usgDoneDate`, `usgScanEdd`,
        `usgScanStatus`, `usgSizeUterusWeek`, `usgFetusStatus`, `gestationSac`, `liquor`, `usgFetalHeartRate`, `usgFetalPosition`, `usgFetalMovement`,
        `liquor1`, `usgFetalHeartRate1`, `usgFetalPosition1`, `usgFetalMovement1`, `liquor2`, `usgFetalHeartRate2`, `usgFetalPosition2`, `usgFetalMovement2`,
        `placenta`, `usgResult`, `usgRemarks`,`bloodTransfusion`, `bloodTransfusionDate`, `placeAdministrator`, `noOfIVDoses`,`createdBy`) 
        VALUES('$data->picmeno','$data->residenttype','$data->physicalpresent','$data->placeofvisit','$data->abortion',
        '$data->anvisitDate','$date','1','$data->ancPeriod','$data->pregnancyWeek','$data->motherWeight','$data->bpSys','$data->bpDia','$data->Hb',
        '$data->urineTestStatus','$data->urineSugarPresent','$data->urineAlbuminPresent','$data->fastingSugar','$data->postPrandial','$data->gctStatus','$data->gctValue','$data->Tsh',
        '$data->td1','$data->TdDose','$data->td2','$data->Td2Dose','$data->tdb','$data->TdBdose','$data->Td1Date','$data->Td2Date','$data->TdBoosterDate','$data->Covidvac','$data->Dose1Date','$data->Dose2Date',
        '$data->PreDate','$data->NoFolicAcid','$data->NoIFA','$data->dateofIFA','$data->dateofAlbendazole','$data->noCalcium','$data->calciumDate',
        '$data->sizeUterusinWeeks','$data->fetalHeartRate','$data->fetalPosition','$data->fetalMovement','$data->methodofConception','$data->anyOtherSpecify',
        '$data->HighRisk','$data->symptomsHighRisk','$data->referralDate','$data->referralDistrict','$data->referralFacility','$data->referralPlace',
        '$data->wusgTaken','$data->usgDoneDate','$data->usgScanEdd','$data->usgScanStatus','$data->usgSizeUterusWeek','$data->usgFetusStatus',
        '$data->gestationSac','$data->liquor','$data->usgFetalHeartRate','$data->usgFetalPosition','$data->usgFetalMovement',
        '$data->liquor1','$data->usgFetalHeartRate1','$data->usgFetalPosition1','$data->usgFetalMovement1','$data->liquor2','$data->usgFetalHeartRate2',
        '$data->usgFetalPosition2','$data->usgFetalMovement2','$data->placenta','$data->usgResult',
        '$data->usgRemarks','$data->bloodTransfusion','$data->bloodTransfusionDate','$data->placeAdministrator','$data->noOfIVDoses','$data->usertype')";
        $addstmt = $db->prepare($addquery);
        $addstmt->execute(array());
        $query = "UPDATE ecregister ec INNER JOIN antenatalvisit av ON ec.picmeNo=av.picmeno SET ec.status=6 WHERE av.symptomsHighRisk NOT IN('1','48') AND ec.picmeNo='".$data->picmeno."' ORDER BY ec.motheraadhaarid ASC";
        $stmt = $db->prepare($query);
        $stmt->execute(array());
        // set response code - 201 created
        http_response_code(200);
        // tell the user
        echo json_encode(array("success" => "true", /*"Anvisit_id" => $inserid,*/ "message" => "Antenatal Visit created."));
    } else {
       
        http_response_code(400);
        // tell the Antenatal Visit
        echo json_encode(array("success" => "false", "error" => "true","message" => "PICME No already Entered."));
        
    }
}
// tell the Antenatal Visit data is incomplete
else {
    // set response code - 400 bad request
    http_response_code(400);
    // tell the Antenatal Visit
    echo json_encode(array("success" => "false", "error" => "true", "message" => "Unable to create Antenatal Visit. "));
}
?>