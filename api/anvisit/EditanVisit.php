<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
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
    
    $mAadhaaruser1 = $db->prepare("SELECT * FROM ecregister WHERE motheraadhaarid='".$data->motheraadhaarid."' ORDER BY id ASC");
    $mAadhaaruser1->execute(array());
    $mvalidAadhaaruser = $mAadhaaruser1->rowCount();
    if($mvalidAadhaaruser >0) {
        while ( $row = $mAadhaaruser1->fetch(PDO::FETCH_ASSOC)) 
     {  
      
       $data->motheraadhaarid = $row["motheraadhaarid"];
    $form->usertype = $data->usertype;
    $form->motheraadhaarid = $data->motheraadhaarid;
    $form->picmeno = $data->picmeno;
    $form->residenttype = $data->residenttype;
    $form->physicalpresent = $data->physicalpresent;
    $form->placeofvisit = $data->placeofvisit;
    $form->abortion = $data->abortion;
    $form->anvisitDate = $data->anvisitDate;
    $form->ancPeriod = $data->ancPeriod;
    $form->pregnancyWeek = $data->pregnancyWeek;
    $form->motherWeight = $data->motherWeight;
    $form->bpSys = $data->bpSys;
    $form->bpDia = $data->bpDia;
    $form->Hb = $data->Hb;
    $form->urineTestStatus = $data->urineTestStatus;
    $form->urineSugarPresent = $data->urineSugarPresent;
    $form->urineAlbuminPresent = $data->urineAlbuminPresent;
    $form->fastingSugar = $data->fastingSugar;
    $form->postPrandial = $data->postPrandial;
    $form->Rbs = $data->Rbs;
    $form->gctStatus = $data->gctStatus;
    $form->gctValue = $data->gctValue;
    $form->Tsh = $data->Tsh;
    $form->TdDose = $data->TdDose;
    $form->Td1Date = $data->Td1Date;
    $form->Td2Dose = $data->Td2Dose;
    $form->Td2Date = $data->Td2Date;
    $form->TdBoosterDate = $data->TdBoosterDate;
    $form->Covidvac = $data->Covidvac;
    $form->Dose1Date = $data->Dose1Date;
    $form->Dose2Date = $data->Dose2Date;
    $form->PreDate = $data->PreDate;
    $form->NoFolicAcid = $data->NoFolicAcid;
    $form->NoIFA = $data->NoIFA;
    $form->dateofIFA = $data->dateofIFA;
    $form->dateofAlbendazole = $data->dateofAlbendazole;
    $form->noCalcium = $data->noCalcium;
    $form->calciumDate = $data->calciumDate;
    $form->sizeUterusinWeeks = $data->sizeUterusinWeeks;
    $form->methodofConception = $data->methodofConception;
    $form->symptomsHighRisk = $data->symptomsHighRisk;
    $form->referralDate = $data->referralDate;
    $form->referralDistrict = $data->referralDistrict;
    $form->referralFacility = $data->referralFacility;
    $form->referralPlace = $data->referralPlace;
    $form->usgTakenStatus = $data->usgTakenStatus;
    $image = $data->usgreport;
    if ($image !='') {
        $filename = $image;
        $folder = "../usgDocument/" . $filename;
       move_uploaded_file($filename, $folder);

        $form->usgreport = $filename;
    } else {
        $form->usgreport = '';
    }
    $form->usgDoneDate = $data->usgDoneDate;
    $form->usgScanEdd = $data->usgScanEdd;
    $form->usgFundalHeight = $data->usgFundalHeight;
    $form->usgSizeUterusWeek = $data->usgSizeUterusWeek;
    $form->usgFetusStatus = $data->usgFetusStatus;
    $form->gestationSac = $data->gestationSac;
    $form->liquor = $data->liquor;
    $form->usgFetalHeartRate = $data->usgFetalHeartRate;
    $form->usgFetalPosition = $data->usgFetalPosition;
    $form->usgFetalMovement = $data->usgFetalMovement;
    $form->liquor1 = $data->liquor1; 
    $form->usgFetalHeartRate1 = $data->usgFetalHeartRate1;
    $form->usgFetalPosition1 = $data->usgFetalPosition1;
    $form->usgFetalMovement1 = $data->usgFetalMovement1;
    $form->liquor2 = $data->liquor2;
    $form->usgFetalHeartRate2 = $data->usgFetalHeartRate2;
    $form->usgFetalPosition2 = $data->usgFetalPosition2;
    $form->usgFetalMovement2 = $data->usgFetalMovement2;
    $form->lT1 = $data->lT1;
    $form->usgFHRT1 = $data->usgFHRT1;
    $form->usgFPT1 = $data->usgFPT1;
    $form->usgFMT1 = $data->usgFMT1;
    $form->lT2 = $data->lT2;
    $form->usgFHRT2 = $data->usgFHRT2;
    $form->usgFPT2 = $data->usgFPT2;
    $form->usgFMT2 = $data->usgFMT2;
    $form->lT3 = $data->lT3;
    $form->usgFHRT3 = $data->usgFHRT3;
    $form->usgFPT3 = $data->usgFPT3;
    $form->usgFMT3 = $data->usgFMT3;
    $form->placenta = $data->placenta;
    $form->usgResult = $data->usgResult;
    $form->usgRemarks = $data->usgRemarks;
    $form->bloodTransfusion = $data->bloodTransfusion;
    $form->bloodTransfusionDate = $data->bloodTransfusionDate;
    $form->placeAdministrator = $data->placeAdministrator;
    $form->noOfIVDoses = $data->noOfIVDoses;


    $mvaliduser1 = $db->prepare("SELECT * FROM antenatalvisit WHERE picmeno='".$data->picmeno."' ORDER BY id ASC");
    $mvaliduser1->execute(array());
    $mvalidchecknum = $mvaliduser1->rowCount();
   
    if ($mvalidchecknum > 0) {
        $inserid = $form->editantenatalvisit();
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
} else {
    http_response_code(400);

    echo json_encode(array("success" => "false", "error" => "true","message" => "Please Check the Mother Aadhaar ID. Antenatal Visit not Updated."));  
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