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
include_once '../objects/delivery.php';

$database = new Database();
$db = $database->getConnection();
$form = new Delivery($db);
// get posted data
$data = json_decode(file_get_contents("php://input"));
// make sure data is not empty
if (!empty($data->picmeno)) {
    // set form property values
    $form->usertype = $data->usertype;
    $form->picmeno = $data->picmeno;
    $form->deliverydate = $data->deliverydate;
    $form->deliverytime = $data->deliverytime;
    $form->deliverydistrict = $data->deliverydistrict;
    $form->hospitaltype = $data->hospitaltype;
    $form->hospitalname = $data->hospitalname;
    $form->childGender = $data->childGender;
    $form->deliveryConductBy = $data->deliveryConductBy;
    $form->deliverytype = $data->deliverytype;
    $form->deliveryCompilcation = $data->deliveryCompilcation;
    $form->deliveryOutcome = $data->deliveryOutcome;
    $form->noOfLiveBirth = $data->noOfLiveBirth;
    $form->noOfStillBirth = $data->noOfStillBirth;
    $form->infantId = $data->infantId;
    $form->birthDetails = $data->birthDetails;
    $form->birthWeight = $data->birthWeight;
    $form->birthHeight = $data->birthHeight;
    $form->delayedCClamping = $data->delayedCClamping;
    $form->skintoskinContact = $data->skintoskinContact;
    $form->breastfeedInitiated = $data->breastfeedInitiated;
    $form->admittedSncu = $data->admittedSncu;
    $form->sncudate = $data->sncudate;
    $form->sncuAreaName = $data->sncuAreaName;
    $form->sncuOutcome = $data->sncuOutcome;
    $form->dischargedate = $data->dischargedate;
    $form->dischargetime = $data->dischargetime;
    $form->bcgdate = $data->bcgdate;
    $form->opvDdate = $data->opvDdate;
    $form->hebBdate = $data->hebBdate;
    $form->injuction = $data->injuction;



    $mvaliduser1 = $db->prepare("SELECT * FROM deliverydetails WHERE picmeno='".$data->picmeno."' ORDER BY id ASC");
    $mvaliduser1->execute(array());
    $mvalidchecknum = $mvaliduser1->rowCount();
   
    if ($mvalidchecknum == 0) {
        $inserid = $form->createdeliverydetails();
        // set response code - 201 created
        http_response_code(200);
        // tell the user
        echo json_encode(array("success" => "true", "delivery_id" => $inserid,"message" => "Delivery Details created."));
    } else {
       
        http_response_code(400);
        // tell the Delivery Details
        echo json_encode(array("success" => "false", "error" => "true","message" => "PICME No already Entered."));
        
    }
}
// tell the Delivery Details data is incomplete
else {
    // set response code - 400 bad request
    http_response_code(400);
    // tell the Delivery Details
    echo json_encode(array("success" => "false", "error" => "true", "message" => "Unable to create Delivery Details. "));
}
?>