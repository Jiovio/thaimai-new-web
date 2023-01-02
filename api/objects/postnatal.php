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

class Postnatal {

    // database connection and table name
    private $conn;
    private $table_name = "postnatalvisit";
    // object properties
    public $symtoms;
    
    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    
    function createpostnatalvisit() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `postnatalvisit` WHERE `picmeNo`='" . $this->picmeNo . "' ORDER BY `id` ASC");
        $mvaliduser1->execute();
        $mvalidchecknum = $mvaliduser1->rowCount();
    
        if ($mvalidchecknum !="") {
    
            // query to insert record
            $query = "INSERT INTO
                " . $this->table_name . "
            SET
            picmeNo='" . $this->picmeNo . "',pncPeriod='" . $this->pncPeriod . "',motherPnc='" . $this->motherPnc . "',ifaTabletStatus='" . $this->ifaTabletStatus . "',ppcMethod='" . $this->ppcMethod . "',
            calcium='" . $this->calcium . "',vitaminA='" . $this->vitaminA . "', motherDangerSign='" . $this->motherDangerSign . "',bloodSugar='" . $this->bloodSugar . "',infantWeight='" . $this->infantWeight . "',
            infantDangerSigns='" . $this->infantDangerSigns . "', bpSys='" . $this->bpSys . "',bpDia='" . $this->bpDia . "',createdBy='" . $this->usertype . "'";
            // prepare query
            $stmt = $this->conn->prepare($query);
    
    
    
            if ($stmt->execute()) {
                $inserid = $this->conn->lastInsertId();
                return $inserid;
            }
    
            return false;
        }
    }
    
    function editpostnatalvisit() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `postnatalvisit` WHERE `picmeNo`='" . $this->picmeNo . "' ORDER BY `id` ASC");
        $mvaliduser1->execute();
        $mvalidchecknum = $mvaliduser1->rowCount();
    
    
        if ($mvalidchecknum !='' ) {
    
            //$row = $mvaliduser1->fetch(PDO::FETCH_ASSOC);
            // query to insert record
            date_default_timezone_set('Asia/Kolkata');
            $date = date('d-m-Y h:i:s');
            $query = "UPDATE " . $this->table_name . "
            SET
            pncPeriod='" . $this->pncPeriod . "',motherPnc='" . $this->motherPnc . "',ifaTabletStatus='" . $this->ifaTabletStatus . "',
            calcium='" . $this->calcium . "',vitaminA='" . $this->vitaminA . "',ppcMethod='" . $this->ppcMethod . "',
            motherDangerSign='" . $this->motherDangerSign . "',bloodSugar='" . $this->bloodSugar . "',infantWeight='" . $this->infantWeight . "',
            infantDangerSigns='" . $this->infantDangerSigns . "',bpSys='" . $this->bpSys . "',bpDia='" . $this->bpDia . "',updatedBy='" . $this->usertype . "',updatedat='".$date."' WHERE picmeNo='" . $this->picmeNo . "'";
            // prepare query
            $stmt = $this->conn->prepare($query);
    
        if ($stmt->execute()) {
                return true;
            }
    
            return false;
        }
    }

    function deletepostnatalvisit() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `postnatalvisit` WHERE `picmeNo`='" . $this->picmeNo . "' ORDER BY `id` ASC");
        $mvaliduser1->execute();
        $mvalidchecknum = $mvaliduser1->rowCount();
    
    
        if ($mvalidchecknum !='' ) {
            // query to insert record
            date_default_timezone_set('Asia/Kolkata');
            $date = date('d-m-Y h:i:s');
            $query = "UPDATE " . $this->table_name . " SET status='0', deletedBy='" . $this->usertype . "', deletedat='".$date."'
            WHERE
            picmeNo='" . $this->picmeNo . "' AND status='1'";
            // prepare query
            $stmt = $this->conn->prepare($query);
    
            if ($stmt->execute()) {
                return true;
            }
    
            return false;
        }
    }

}

?>