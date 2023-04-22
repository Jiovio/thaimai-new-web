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
//date_default_timezone_set('Asia/Kolkata');
//$data->startdate =  date('d-m-Y h:i:s');
//$checkvaliduser = $db->prepare("SELECT mh.id,mh.picmeno,ec.motheraadhaarname,mh.edddate,ec.mothermobno,ec.PhcId,u.name FROM medicalhistory mh JOIN ecregister ec on ec.picmeNo=mh.picmeno JOIN users u on u.id=mh.createdBy WHERE YEAR(edddate) = YEAR(CURRENT_DATE()) AND MONTH(edddate) = MONTH(CURRENT_DATE()) AND ec.BlockId='".$data->block."' AND ec.PhcId='".$data->phc."' AND ec.HscId='".$data->hsc."' AND mh.status=1 ORDER BY mh.picmeno ASC;");

$checkvaliduser = $db->prepare("SELECT DISTINCT(mh.picmeno),ec.motheraadhaarname,mh.id,mh.edddate,ec.mothermobno,mh.createdBy,ec.BlockId,ec.PhcId, ec.HscId FROM medicalhistory mh JOIN ecregister ec on ec.picmeNo=mh.picmeno JOIN users u on u.id = mh.id 
WHERE NOT EXISTS (SELECT dd.picmeno FROM deliverydetails dd WHERE dd.picmeno = mh.picmeno) AND 
mh.edddate >= CURRENT_DATE() AND mh.status=1 ORDER By mh.edddate DESC");

$checkvaliduser->execute();

$checknum = $checkvaliduser->rowCount();


if ($checknum >0) {
     while ( $row = $checkvaliduser->fetch(PDO::FETCH_ASSOC)) 
     {
        

     
      
        $sncuarray[] = array( "picmeno" =>$row['picmeno'],
        "motheraadhaarname" =>$row['motheraadhaarname'],
        "edddate" =>$row['edddate'],
        "mothermobno" =>$row['mothermobno'],
        "PhcId" =>$row['PhcId'],
        "name" =>$row['createdBy']
        );
         
        
            } 
            
            
            
            http_response_code(200);
        
        
            echo json_encode(
                    array("success" => "true", "error"=> "false",  "Delivery Due List" => $sncuarray , "message" => "High Risk Mother List")
            );
          
        } else {
            // set response code - 404 Not found
            http_response_code(404);
        
            echo json_encode(
                    array("success" => "false", "error"=>"true", "message" => "Delivery Due List Data Not Found")
            );
        }
        ?>