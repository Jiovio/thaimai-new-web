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

class AnReg {

    // database connection and table name
    private $conn;
    private $table_name = "anregistration";
    // object properties
    public $symtoms;
    
    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    
    function createanregistration() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `anregistration` WHERE `motheraadhaarid`='".$this->motheraadhaarid."' ORDER BY `id` ASC");
        $mvaliduser1->execute();
        $mvalidchecknum = $mvaliduser1->rowCount();
    
        if ($mvalidchecknum !="") {
    
            // query to insert record
            $query = "INSERT INTO
                " . $this->table_name . "
            SET
            residentType='" . $this->residentType . "',motheraadhaarid='" . $this->motheraadhaarid . "',
            picmeno='" . $this->picmeno . "',picmeRegDate='" . $this->picmeregdate . "',
            pregnancyTestResult='" . $this->pregnancyTestResult . "',methodofConception='" . $this->methodofConception . "',
            gravida='" . $this->gravida . "',para='" . $this->para . "',livingChildren='" . $this->livingChildren . "',
            abortion='" . $this->abortion . "',childDeath='" . $this->childDeath . "',hrPregnancy='" . $this->hrPregnancy . "',
            obstetricCode='" . $this->obstetricCode . "',motherHeight='" . $this->motherHeight . "',
            motherWeight='" . $this->motherWeight . "',bpSys='" . $this->bpSys . "',bpDia='" . $this->bpDia . "',
            anRegDate='" . $this->anRegDate . "',mrmbsEligible='" . $this->mrmbsEligible . "',MotherAge='" . $this->motherage . "',
            HusbandAge='" . $this->husbandage . "',createdBy='" . $this->usertype . "'";
            // prepare query
            $stmt = $this->conn->prepare($query);
    
            if ($stmt->execute()) {
                $inserid = $this->conn->lastInsertId();
                return $inserid;
            }
    
            return false;
        }
    }
    
    function editanregistration() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `anregistration` WHERE `motheraadhaarid`='".$this->motheraadhaarid."' ORDER BY `id` ASC");
        $mvaliduser1->execute();
        $mvalidchecknum = $mvaliduser1->rowCount();
    
    
        if ($mvalidchecknum !='' ) {
    
            //$row = $mvaliduser1->fetch(PDO::FETCH_ASSOC);
            // query to insert record
            date_default_timezone_set('Asia/Kolkata');
            $date = date('d-m-Y h:i:s');
            $query = "UPDATE " . $this->table_name . "
            SET
            residentType='" . $this->residentType . "',motheraadhaarid='" . $this->motheraadhaarid . "',
            picmeno='" . $this->picmeno . "',picmeRegDate='" . $this->picmeregdate . "',
            pregnancyTestResult='" . $this->pregnancyTestResult . "',methodofConception='" . $this->methodofConception . "',
            gravida='" . $this->gravida . "',para='" . $this->para . "',livingChildren='" . $this->livingChildren . "',
            abortion='" . $this->abortion . "',childDeath='" . $this->childDeath . "',hrPregnancy='" . $this->hrPregnancy . "',obstetricCode='" . $this->obstetricCode . "',motherHeight='" . $this->motherHeight . "',
            motherWeight='" . $this->motherWeight . "',bpSys='" . $this->bpSys . "',bpDia='" . $this->bpDia . "',
            anRegDate='" . $this->anRegDate . "',mrmbsEligible='" . $this->mrmbsEligible . "',MotherAge='" . $this->motherage . "',HusbandAge='" . $this->husbandage . "',
            updatedBy='" . $this->usertype . "', updatedat='" . $date . "' WHERE `motheraadhaarid`='".$this->motheraadhaarid."'";
            // prepare query
            $stmt = $this->conn->prepare($query);
    
        if ($stmt->execute()) {
                return true;
            }
    
            return false;
        }
    }

    function deleteanregistration() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `anregistration` WHERE `motheraadhaarid`='".$this->motheraadhaarid."' ORDER BY `id` ASC");
        $mvaliduser1->execute();
        $mvalidchecknum = $mvaliduser1->rowCount();
    
    
        if ($mvalidchecknum !='' ) {
            // query to insert record
            date_default_timezone_set('Asia/Kolkata');
            $date = date('d-m-Y h:i:s');
            $query = "UPDATE " . $this->table_name . " SET status='0',deletedBy='" . $this->usertype . "', deletedat='".$date."'
            WHERE
            `motheraadhaarid`='".$this->motheraadhaarid."' AND status='1'";
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