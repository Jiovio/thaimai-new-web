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

$checkvaliduser = $db->prepare("SELECT * FROM postnatalvisit pv join ecregister ec on ec.picmeNo=pv.picmeNo WHERE ec.BlockId='".$data->block."' AND ec.PhcId='".$data->phc."' AND ec.HscId='".$data->hsc."' AND pv.picmeNo='".$data->picmeNo."' AND pv.status=1 ");

$checkvaliduser->execute();

$checknum = $checkvaliduser->rowCount();


if ($checknum >0) {
     while ( $row = $checkvaliduser->fetch(PDO::FETCH_ASSOC)) 
     {
        

      
        $PvArray[] = array("picmeNo" =>$row['picmeNo'],
        "pncPeriod" =>$row['pncPeriod'],
        "motherPnc" =>$row['motherPnc'],
        "ifaTabletStatus" =>$row['ifaTabletStatus'],
        "calcium" =>$row['calcium'],
        "ppcMethod" =>$row['ppcMethod'],
        "vitaminA" =>$row['vitaminA'],
        "motherDangerSign" =>$row['motherDangerSign'],
        "bloodSugar" =>$row['bloodSugar'],
        "infantWeight" =>$row['infantWeight'],
        "infantDangerSigns" =>$row['infantDangerSigns'],
        "bpSys" =>$row['bpSys'],
        "bpDia" =>$row['bpDia'],
     );

    } 
    
    http_response_code(200);

    echo json_encode(
            array("success" => "true", "error"=> "false",  "PostnatalView" => $PvArray , "message" => "Postnatal Visit Registered List")
    );
  
} else {
    // set response code - 404 Not found
    http_response_code(404);

    echo json_encode(
            array("success" => "false","error"=>"true", "message" => "Postnatal Visit Data Not Found")
    );
}
?>
