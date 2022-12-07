<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");


include_once '../config/database.php';





$database = new Database();
$db = $database->getConnection();

// initialize object
$data = json_decode(file_get_contents("php://input"));

$checkvaliduser = $db->prepare("SELECT * FROM antenatalvisit av join ecregister ec on ec.motheraadhaarid=av.motheraadhaarid WHERE ec.BlockId='".$data->block."' AND ec.PhcId='".$data->phc."' AND ec.HscId='".$data->hsc."' AND av.picmeno='".$data->picmeno."' AND av.status=1");

$checkvaliduser->execute();

$checknum = $checkvaliduser->rowCount();


if ($checknum >0) {
     while ( $row = $checkvaliduser->fetch(PDO::FETCH_ASSOC)) 
     {
        

     
      
        $anarray[] = array( 
            "ecfrno" =>$row['ecfrno'],
            "motheraadhaarid" =>$row['motheraadhaarid'],
             "address" =>$row['address'],
             "pincode" =>$row['pincode'],   
            "motheraadhaarname" =>$row['motheraadhaarname'],
            "mothermobno" =>$row['mothermobno'],
            "husmobno" =>$row['husmobno'],
            "husbandaadhaarname" =>$row['husbandaadhaarname'],   
            "picmeno" =>$row['picmeno'],
            "residenttype" =>$row['residenttype'],
            "physicalpresent" =>$row['physicalpresent'],
            "placeofvisit" =>$row['placeofvisit'],
            "abortion" =>$row['abortion'],
            "anvisitDate" =>$row['anvisitDate'],
            "ancPeriod" =>$row['ancPeriod'],
            "pregnancyWeek" =>$row['pregnancyWeek'],
            "motherWeight" =>$row['motherWeight'],
            "bpSys" =>$row['bpSys'],
            "bpDia" =>$row['bpDia'],
            "Hb" =>$row['Hb'],
            "urineTestStatus" =>$row['urineTestStatus'],
            "urineSugarPresent" =>$row['urineSugarPresent'],
            "urineAlbuminPresent" =>$row['urineAlbuminPresent'],
            "fastingSugar" =>$row['fastingSugar'],
            "postPrandial" =>$row['postPrandial'],
            "Rbs" =>$row['Rbs'],
            "gctStatus" =>$row['gctStatus'],
            "gctValue" =>$row['gctValue'],
            "Tsh" =>$row['Tsh'],
            "TdDose" =>$row['TdDose'],
            "Td1Date" =>$row['Td1Date'],
            "Td2Dose" =>$row['Td2Dose'],
            "Td2Date" =>$row['Td2Date'],
            "TdBoosterDate" =>$row['TdBoosterDate'],
            "Covidvac" =>$row['Covidvac'],
            "Dose1Date" =>$row['Dose1Date'],
            "Dose2Date" =>$row['Dose2Date'],
            "PreDate" =>$row['PreDate'],
            "NoFolicAcid" =>$row['NoFolicAcid'],
            "NoIFA" =>$row['NoIFA'],
            "dateofIFA" =>$row['dateofIFA'],
            "dateofAlbendazole" =>$row['dateofAlbendazole'],
            "noCalcium" =>$row['noCalcium'],
            "calciumDate" =>$row['calciumDate'],
            "sizeUterusinWeeks" =>$row['sizeUterusinWeeks'],
            "fetalHeartRate" =>$row['fetalHeartRate'],
            "fetalPosition" =>$row['fetalPosition'],
            "fetalMovement" =>$row['fetalMovement'],
            "methodofConception" =>$row['methodofConception'],
            "symptomsHighRisk" =>$row['symptomsHighRisk'],
            "referralDate" =>$row['referralDate'],
            "referralDistrict" =>$row['referralDistrict'],
            "referralFacility" =>$row['referralFacility'],
            "referralPlace" =>$row['referralPlace'],
            "placeofDelivery" =>$row['placeofDelivery'],
            "deliveryDistrict" =>$row['deliveryDistrict'],
            "hospitalType" =>$row['hospitalType'],
            "deliveryHospital" =>$row['deliveryHospital'],
            "usgTakenStatus" =>$row['usgTakenStatus'],
            "usgDoneDate" =>$row['usgDoneDate'],
            "usgScanEdd" =>$row['usgScanEdd'],
            "usgFundalHeight" =>$row['usgFundalHeight'],
            "usgSizeUterusWeek" =>$row['usgSizeUterusWeek'],
            "usgFetusStatus" =>$row['usgFetusStatus'],
            "gestationSac" =>$row['gestationSac'],
            "liquor" =>$row['liquor'],
            "usgFetalHeartRate" =>$row['usgFetalHeartRate'],
            "usgFetalPosition" =>$row['usgFetalPosition'],
            "usgFetalMovement" =>$row['usgFetalMovement'],
            "liquor1" =>$row['liquor1'],
            "usgFetalHeartRate1" =>$row['usgFetalHeartRate1'],
            "usgFetalPosition1" =>$row['usgFetalPosition1'],
            "usgFetalMovement1" =>$row['usgFetalMovement1'],
            "liquor2" =>$row['liquor2'],
            "usgFetalHeartRate2" =>$row['usgFetalHeartRate2'],
            "usgFetalPosition2" =>$row['usgFetalPosition2'],
            "usgFetalMovement2" =>$row['usgFetalMovement2'],
            "Tripleliquor1" =>$row['lT1'],
            "TripleusgFetalHeartRate1" =>$row['usgFHRT1'],
            "TripleusgFetalPosition1" =>$row['usgFPT1'],
            "TripleusgFetalMovement1" =>$row['usgFMT1'],
            "Tripleliquor2" =>$row['lT2'],
            "TripleusgFetalHeartRate2" =>$row['usgFHRT2'],
            "TripleusgFetalPosition2" =>$row['usgFPT2'],
            "TripleusgFetalMovement2" =>$row['usgFMT2'],
            "Tripleliquor3" =>$row['lT3'],
            "TripleusgFetalHeartRate3" =>$row['usgFHRT3'],
            "TripleusgFetalPosition3" =>$row['usgFPT3'],
            "TripleusgFetalMovement3" =>$row['usgFMT3'],
            "placenta" =>$row['placenta'],
            "usgResult" =>$row['usgResult'],
            "usgRemarks" =>$row['usgRemarks'],
            "bloodTransfusion" =>$row['bloodTransfusion'],
            "bloodTransfusionDate" =>$row['bloodTransfusionDate'],
            "placeAdministrator" =>$row['placeAdministrator'],
            "noOfIVDoses" =>$row['noOfIVDoses']
        
        
        );
         
        
            } 
            
            
            
            http_response_code(200);
        
        
            echo json_encode(
                    array("success" => "true", "error"=> "false",  "Antenatalvisit" => $anarray , "message" => "Antenatal Visit Registered List")
            );
          
        } else {
            // set response code - 404 Not found
            http_response_code(404);
        
            echo json_encode(
                    array("success" => "false", "error"=>"true", "message" => "Antenatal Visit Data Not Found")
            );
        }
        ?>
