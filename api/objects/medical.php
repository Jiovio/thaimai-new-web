<?php

function generateRandomString($length = 5) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

class Medical {

    // database connection and table name
    private $conn;
    private $table_name = "medicalhistory";
    // object properties
    public $symtoms;
    
    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    
    function createmedicalhistory() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `medicalhistory` WHERE `picmeno`='" . $this->picmeno . "' ORDER BY `id` ASC");
        $mvaliduser1->execute();
        $mvalidchecknum = $mvaliduser1->rowCount();
    
        if ($mvalidchecknum !="") {
    
            date_default_timezone_set('Asia/Kolkata');
            $date = date('d-m-Y h:i:s');
          // query to insert record
            $query = "INSERT INTO
                " . $this->table_name . "
            SET
            picmeno='" . $this->picmeno . "',lmpdate='" . $this->lmpdate . "',edddate='" . $this->edddate . "',
            reg12weeks='" . $this->reg12weeks . "',momBGtaken='" . $this->momBGtaken . "',momBGtype='" . $this->momBGtype . "',
            pastillness='" . $this->pastillness . "',bleedtime='" . $this->bleedtime . "',clotTime='" . $this->clottime . "',
             momVdrlRprResult='" . $this->momVdrlRprResult . "',
            husVdrlRprResult='" . $this->husVdrlRprResult . "',
            momhbresult='" . $this->momhbresult . "',
            hushbresult='" . $this->hushbresult . "',
             momhivtestresult='" . $this->momhivtestresult . "',
            hushivtestresult='" . $this->hushivtestresult . "',
            anyotherinvest='" . $this->anyotherinvest . "',
             totpregnancy='" . $this->totpregnancy . "',
            placeDeliveryDistrict='" . $this->placeDeliveryDistrict . "',
             hospitaltype='" . $this->hospitaltype . "',
             hospitalname='" . $this->hospitalname . "',createdBy='" . $this->usertype . "'";
            // prepare query
            $stmt = $this->conn->prepare($query);
    
    
    
            if ($stmt->execute()) {
                $inserid = $this->conn->lastInsertId();
                return $inserid;
            }
    
            return false;
        }
    }

    
    function editmedicalhistory() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `medicalhistory` WHERE `picmeno`='" . $this->picmeno . "' ORDER BY `id` ASC");
        $mvaliduser1->execute();
        $mvalidchecknum = $mvaliduser1->rowCount();
    
        if ($mvalidchecknum !="") {
            date_default_timezone_set('Asia/Kolkata');
            $date = date('d-m-Y h:i:s');
            // query to insert record
            $query = "UPDATE " . $this->table_name . "
            SET
            picmeno='" . $this->picmeno . "',lmpdate='" . $this->lmpdate . "',edddate='" . $this->edddate . "',
            reg12weeks='" . $this->reg12weeks . "',momBGtaken='" . $this->momBGtaken . "',momBGtype='" . $this->momBGtype . "',
            pastillness='" . $this->pastillness . "',bleedtime='" . $this->bleedtime . "',clotTime='" . $this->clottime . "',
            momVdrlRprResult='" . $this->momVdrlRprResult . "',
            husVdrlRprResult='" . $this->husVdrlRprResult . "',
            momhbresult='" . $this->momhbresult . "',
             hushbresult='" . $this->hushbresult . "',
              momhivtestresult='" . $this->momhivtestresult . "',
            hushivtestresult='" . $this->hushivtestresult . "',
            anyotherinvest='" . $this->anyotherinvest . "',
             totpregnancy='" . $this->totpregnancy . "',
            placeDeliveryDistrict='" . $this->placeDeliveryDistrict . "',
            hospitaltype='" . $this->hospitaltype . "',
            hospitalname='" . $this->hospitalname . "',updatedBy='" . $this->usertype . "', updatedat='" . $date . "' WHERE picmeno='" . $this->picmeno . "'";
            // prepare query
            $stmt = $this->conn->prepare($query);
    
    
    
            if ($stmt->execute()) {
                //$inserid = $this->conn->lastInsertId();
                return true;
            }
    
            return false;
        }
    }

    function deletemedicalhistory() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `medicalhistory` WHERE `picmeno`='" . $this->picmeno . "' ORDER BY `id` ASC");
        $mvaliduser1->execute();
        $mvalidchecknum = $mvaliduser1->rowCount();
    
    
        if ($mvalidchecknum !='' ) {
    
            //$row = $mvaliduser1->fetch(PDO::FETCH_ASSOC);
            // query to insert record
            date_default_timezone_set('Asia/Kolkata');
            $date = date('d-m-Y h:i:s');
            $query = "UPDATE " . $this->table_name . " SET status='0',deletedBy='" . $this->usertype . "', deletedat='".$date."'
            WHERE
            picmeno='" . $this->picmeno . "' AND status='1'";
            // prepare query
            $stmt = $this->conn->prepare($query);
    
    
    
            if ($stmt->execute()) {
                //return $row['id'];
                return true;
            }
    
            return false;
        }
    }

}




?>