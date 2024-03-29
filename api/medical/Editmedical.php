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
include_once '../objects/medical.php';

$database = new Database();
$db = $database->getConnection();
$form = new Medical($db);
// get posted data
$data = json_decode(file_get_contents("php://input"));
// make sure data is not empty
if (!empty($data->picmeno)) {
    // set form property values
    $form->usertype = $data->usertype;
    $form->picmeno = $data->picmeno;
    $form->lmpdate = $data->lmpdate;
    $form->edddate = $data->edddate;
    $form->reg12weeks = $data->reg12weeks;
    $form->momBGtaken = $data->momBGtaken;
    $form->momBGtype = $data->momBGtype;
    $form->pastillness = $data->pastillness;
    $form->bleedtime = $data->bleedtime;
    $form->clottime = $data->clottime;
   // $form->momVdrlRpr = $data->momVdrlRpr;
    $form->momVdrlRprResult = $data->momVdrlRprResult;
    //$form->husVdrlRpr = $data->husVdrlRpr;
    $form->husVdrlRprResult = $data->husVdrlRprResult;
    //$form->momhbsag = $data->momhbsag;
    $form->momhbresult = $data->momhbresult;
    //$form->hushbsag = $data->hushbsag;
    $form->hushbresult = $data->hushbresult;
    //$form->momhivtest = $data->momhivtest;
    $form->momhivtestresult = $data->momhivtestresult;
    //$form->hushivtest = $data->hushivtest;
    $form->hushivtestresult = $data->hushivtestresult;
    //$form->LastPregnancyComplication = $data->LastPregnancyComplication;
    //$form->LastPregnancyOutcome = $data->LastPregnancyOutcome;
    $form->anyotherinvest = $data->anyotherinvest;
    $form->totpregnancy = $data->totpregnancy;
    $form->placeDeliveryDistrict = $data->placeDeliveryDistrict;
    //$form->deliveryMode = $data->deliveryMode;
    $form->hospitaltype = $data->hospitaltype;
    $form->hospitalname = $data->hospitalname;
    


    $mvaliduser1 = $db->prepare("SELECT * FROM medicalhistory WHERE picmeno='".$data->picmeno."' ORDER BY id ASC");
    $mvaliduser1->execute(array());
    $mvalidchecknum = $mvaliduser1->rowCount();
   
    if ($mvalidchecknum > 0) {
        $inserid = $form->editmedicalhistory();
        // set response code - 201 Updated
        http_response_code(200);
        // tell the user
        echo json_encode(array("success" => "true", "error" => "false", "message" => "Medical History Updated."));
    } else {
       
        http_response_code(400);
        // tell the Medical History
        echo json_encode(array("success" => "false", "error" => "true","message" => "Check the PICME No."));
        
    }
}
// tell the Medical History data is incomplete
else {
    // set response code - 400 bad request
    http_response_code(400);
    // tell the Medical History
    echo json_encode(array("success" => "false", "error" => "true", "message" => "Unable to Update Medical History. "));
}
?>