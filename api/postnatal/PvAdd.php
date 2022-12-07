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
include_once '../objects/postnatal.php';

$database = new Database();
$db = $database->getConnection();
$form = new postnatal($db);
// get posted data
$data = json_decode(file_get_contents("php://input"));
// make sure data is not empty
if (!empty($data->picmeNo)) {
    // set form property values
    $form->usertype = $data->usertype;
    $form->picmeNo = $data->picmeNo;
    $form->pncPeriod = $data->pncPeriod;
    $form->motherPnc = $data->motherPnc;
    $form->ifaTabletStatus = $data->ifaTabletStatus;
    $form->calcium = $data->calcium;
    $form->ppcMethod = $data->ppcMethod;
    $form->vitaminA = $data->vitaminA;
    $form->motherDangerSign = $data->motherDangerSign;
    $form->bloodSugar = $data->bloodSugar;
    $form->infantWeight = $data->infantWeight;
    $form->infantDangerSigns = $data->infantDangerSigns;
    $form->bpSys = $data->bpSys;
    $form->bpDia = $data->bpDia;


    $mvaliduser1 = $db->prepare("SELECT * FROM postnatalvisit WHERE picmeNo='".$data->picmeNo."' ORDER BY id ASC");
    $mvaliduser1->execute(array());
    $mvalidchecknum = $mvaliduser1->rowCount();
   
    if ($mvalidchecknum == 0) {
        $inserid = $form->createpostnatalvisit();
        // set response code - 201 created
        http_response_code(200);
        // tell the user
        echo json_encode(array("success" => "true", "Postnatal_id" => $inserid, "message" => "Postnatal created."));
    } else {
       
        http_response_code(400);
        // tell the user
        echo json_encode(array("success" => "false", "error" => "true","message" => "PICME No already Entered."));
        
    }
}
// tell the user data is incomplete
else {
    // set response code - 400 bad request
    http_response_code(400);
    // tell the user
    echo json_encode(array("success" => "false", "error" => "true", "message" => "Unable to create user. "));
}
?>