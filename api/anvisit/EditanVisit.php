<?php
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
        // $inserid = $form->editantenatalvisit();
        $date = date('Y-m-d', strtotime($data->anvisitDate. ' + 30 days'));
        $uquery ="UPDATE antenatalvisit SET picmeno='$data->picmeno',residenttype='$data->residenttype',physicalpresent='$data->physicalpresent',placeofvisit='$data->placeofvisit',
        abortion='$data->abortion',anvisitDate='$data->anvisitDate',avdueDate='$date',avTag='1',ancPeriod='$data->ancPeriod',pregnancyWeek='$data->pregnancyWeek',
        motherWeight='$data->motherWeight',bpSys='$data->bpSys',bpDia='$data->bpDia',Hb='$data->Hb',urineTestStatus='$data->urineTestStatus',
        urineSugarPresent='$data->urineSugarPresent',urineAlbuminPresent='$data->urineAlbuminPresent',fastingSugar='$data->fastingSugar',postPrandial='$data->postPrandial',
        gctStatus='$data->gctStatus',gctValue='$data->gctValue',Tsh='$data->Tsh',Td1='$data->td1',TdDose='$data->TdDose',Td2='$data->td2',Td2Dose='$data->Td2Dose',
        Tdb='$data->tdb',TdBdose='$data->TdBdose',Td1Date='$data->Td1Date',Td2Date='$data->Td2Date',TdBoosterDate='$data->TdBoosterDate',Covidvac='$data->Covidvac',
        Dose1Date='$data->Dose1Date',Dose2Date'$data->Dose2Date',PreDate='$data->PreDate',NoFolicAcid='$data->NoFolicAcid',NoIFA='$data->NoIFA',dateofIFA='$data->dateofIFA',
        dateofAlbendazole='$data->dateofAlbendazole',noCalcium='$data->noCalcium',calciumDate='$data->calciumDate',sizeUterusinWeeks='$data->sizeUterusinWeeks',
        fetalHeartRate='$data->fetalHeartRate',fetalPosition='$data->fetalPosition',fetalMovement='$data->fetalMovement',methodofConception='$data->methodofConception',
        AnyOtherSpecify='$data->anyOtherSpecify',HighRisk='$data->HighRisk',symptomsHighRisk='$data->symptomsHighRisk',referralDate='$data->referralDate',
        referralDistrict='$data->referralDistrict',referralFacility='$data->referralFacility',referralPlace='$data->referralPlace',wusgTaken='$data->wusgTaken',
        usgDoneDate='$data->usgDoneDate',usgScanEdd='$data->usgScanEdd',usgScanStatus='$data->usgScanStatus',usgSizeUterusWeek='$data->usgSizeUterusWeek',
        usgFetusStatus='$data->usgFetusStatus',gestationSac='$data->gestationSac',liquor='$data->liquor',usgFetalHeartRate='$data->usgFetalHeartRate',
        usgFetalPosition='$data->usgFetalPosition',usgFetalMovement='$data->usgFetalMovement',liquor1='$data->liquor1',usgFetalHeartRate1='$data->usgFetalHeartRate1',
        usgFetalPosition1='$data->usgFetalPosition1',usgFetalMovement1='$data->usgFetalMovement1',liquor2='$data->liquor2',usgFetalHeartRate2='$data->usgFetalHeartRate2',
        usgFetalPosition2='$data->usgFetalPosition2',usgFetalMovement2='$data->usgFetalMovement2',lT1='$data->lT1',usgFHRT1='$data->usgFHRT1',usgFPT1='$data->usgFPT1',
        usgFMT1='$data->usgFMT1',lT2='$data->lT2',usgFHRT2='$data->usgFHRT2',usgFPT2='$data->usgFPT2',usgFMT2='$data->usgFMT2',lT3='$data->lT3',
        usgFHRT3='$data->usgFHRT3',usgFPT3='$data->usgFPT3',usgFMT3='$data->usgFMT3',placenta='$data->placenta',usgResult='$data->usgResult',usgRemarks='$data->usgRemarks',
        bloodTransfusion='$data->bloodTransfusion',bloodTransfusionDate='$data->bloodTransfusionDate',placeAdministrator='$data->placeAdministrator,
        noOfIVDoses='$data->noOfIVDoses','updatedBy='$data->usertype' WHERE picmeno='$data->picmeno'";
        $ustmt = $db->prepare($uquery);
        $ustmt->execute(array());
        $query = "UPDATE ecregister ec INNER JOIN antenatalvisit av ON ec.picmeNo=av.picmeno SET ec.status=6 WHERE av.symptomsHighRisk NOT IN('1','48') AND ec.picmeNo='".$data->picmeno."' ORDER BY ec.motheraadhaarid ASC";
        $stmt = $db->prepare($query);
        $stmt->execute(array());
        // set response code - 201 Updated
        http_response_code(200);
        // tell the user
        echo json_encode(array("success" => "true", "error" => "false", "message" => "Antenatal Visit Updated."));
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
    echo json_encode(array("success" => "false", "error" => "true", "message" => "Unable to Update Antenatal Visit. "));
}
?>