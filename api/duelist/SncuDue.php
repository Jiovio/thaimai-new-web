<?php
//ini_set("display_errors",'1');
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

$checkvaliduser = $db->prepare("SELECT * FROM PhcIddeliverydetailsPhcId dd join ecregister ec ON ec.picmeno=dd.picmeNo WHERE dischargedate>=DATE_FORMAT(NOW() ,'%Y-%m-01') AND ec.BlockId='".$data->block."' AND ec.PhcId='".$data->phc."' AND ec.HscId='".$data->hsc."' AND dd.status=1");

$checkvaliduser->execute();

$checknum = $checkvaliduser->rowCount();


if ($checknum >0) {
     while ( $row = $checkvaliduser->fetch(PDO::FETCH_ASSOC)) 
     {
        

     $sncuarray[] = array( 
        "motheraadhaarname" =>$row['motheraadhaarname'],
         
        "picmeno" =>$row['picmeno'],
        "deliverydate" =>$row['deliverydate'],
        "deliverytime" =>$row['deliverytime'],
        "deliverydistrict" =>$row['deliverydistrict'],
        "hospitaltype" =>$row['hospitaltype'],
        "hospitalname" =>$row['hospitalname'],
        "childGender" =>$row['childGender'],
        "deliveryConductBy" =>$row['deliveryConductBy'],
        "deliverytype" =>$row['deliverytype'],
        "deliveryCompilcation" =>$row['deliveryCompilcation'],
        "deliveryOutcome" =>$row['deliveryOutcome'],
        "noOfLiveBirth" =>$row['noOfLiveBirth'],
        "noOfStillBirth" =>$row['noOfStillBirth'],
        "infantId" =>$row['infantId'],
        "birthDetails" =>$row['birthDetails'],
        "birthWeight" =>$row['birthWeight'],
        "birthHeight" =>$row['birthHeight'],
        "delayedCClamping" =>$row['delayedCClamping'],
        "skintoskinContact" =>$row['skintoskinContact'],
        "breastfeedInitiated" =>$row['breastfeedInitiated'],
        "admittedSncu" =>$row['admittedSncu'],
        "sncudate" =>$row['sncudate'],
        "sncuAreaName" =>$row['sncuAreaName'],
        "sncuOutcome" =>$row['sncuOutcome'],
        "dischargedate" =>$row['dischargedate'],
        "dischargetime" =>$row['dischargetime'],
        "bcgdate" =>$row['bcgdate'],
        "opvDdate" =>$row['opvDdate'],
        "hebBdate" =>$row['hebBdate'],
        "injuction" => $row["injuction"]
        
        );
         
        
            } 
            
            
            
            http_response_code(200);
        
        
            echo json_encode(
                    array("success" => "true", "error"=> "false",  "SNCU Discharge Babies List" => $sncuarray , "message" => "High Risk Mother List")
            );
          
        } else {
            // set response code - 404 Not found
            http_response_code(404);
        
            echo json_encode(
                    array("success" => "false", "error"=>"true", "message" => "SNCU Discharge Babies List Data Not Found")
            );
        }
        ?>