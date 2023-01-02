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

class AnVisit {

    // database connection and table name
    private $conn;
    private $table_name = "antenatalvisit";
    // object properties
    public $symtoms;
    
    // constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    
    function createantenatalvisit() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `antenatalvisit` WHERE `picmeno`='" . $this->picmeno . "' ORDER BY `id` ASC");
        $mvaliduser1->execute();
        $mvalidchecknum = $mvaliduser1->rowCount();
    
        if ($mvalidchecknum !="") {
    
            // query to insert record
            $query = "INSERT INTO
                " . $this->table_name . "
            SET
            motheraadhaarid='" . $this->motheraadhaarid . "',picmeno='" . $this->picmeno . "',residenttype='" . $this->residenttype . "',physicalpresent='" . $this->physicalpresent . "',
            placeofvisit='" . $this->placeofvisit . "',abortion='" . $this->abortion . "',anvisitDate='" . $this->anvisitDate . "', avdueDate='".date('d-m-Y', strtotime($this->anvisitDate. ' + 30 days'))."',
            avTag='1', ancPeriod='" . $this->ancPeriod . "',pregnancyWeek='" . $this->pregnancyWeek . "',motherWeight='" . $this->motherWeight . "',
            bpSys='" . $this->bpSys . "',bpDia='" . $this->bpDia . "',Hb='" . $this->Hb . "',
            urineTestStatus='" . $this->urineTestStatus . "',fastingSugar='" . $this->fastingSugar . "',
            postPrandial='" . $this->postPrandial . "',Rbs='" . $this->Rbs . "', gctStatus='" . $this->gctStatus . "',gctValue='" . $this->gctValue . "', Tsh='" . $this->Tsh . "',Td1Date='" . $this->Td1Date . "',
            TdDose='" . $this->TdDose . "',Td2Date='" . $this->Td2Date . "',
            Td2Dose='" . $this->Td2Dose . "',TdBdose='".$this->TdBdose."',TdBoosterDate='" . $this->TdBoosterDate . "', 
            Covidvac='" . $this->Covidvac . "',Dose1Date='" . $this->Dose1Date . "',Dose2Date='" . $this->Dose2Date . "',PreDate='" . $this->PreDate . "', 
            NoFolicAcid='" . $this->NoFolicAcid . "',NoIFA='" . $this->NoIFA . "', dateofIFA='" . $this->dateofIFA . "', dateofAlbendazole='" . $this->dateofAlbendazole . "',
            noCalcium='" . $this->noCalcium . "',calciumDate='" . $this->calciumDate . "',
            sizeUterusinWeeks='" . $this->sizeUterusinWeeks . "',
            fetalHeartRate='" . $this->fetalHeartRate . "',
            fetalPosition='" . $this->fetalPosition . "',
            fetalMovement='" . $this->fetalMovement . "',methodofConception='" . $this->methodofConception . "',symptomsHighRisk='" . $this->symptomsHighRisk . "',
            referralDate='" . $this->referralDate . "',referralDistrict='" . $this->referralDistrict . "',referralFacility='" . $this->referralFacility . "',
            referralPlace='" . $this->referralPlace . "',
            wusgTaken='" . $this->wusgTaken . "',usgDoneDate='" . $this->usgDoneDate . "', usgScanEdd='" . $this->usgScanEdd . "', usgFundalHeight='" . $this->usgFundalHeight . "',usgSizeUterusWeek='" . $this->usgSizeUterusWeek . "',
            usgFetusStatus='" . $this->usgFetusStatus . "',gestationSac='" . $this->gestationSac . "', 
            liquor='" . $this->liquor . "',usgFetalHeartRate='" . $this->usgFetalHeartRate . "', usgFetalPosition='" . $this->usgFetalPosition . "', usgFetalMovement='" . $this->usgFetalMovement . "',
            liquor1='" . $this->liquor1 . "',usgFetalHeartRate1='" . $this->usgFetalHeartRate1 . "', usgFetalPosition1='" . $this->usgFetalPosition1 . "', usgFetalMovement1='" . $this->usgFetalMovement1 . "',
            liquor2='" . $this->liquor2 . "',usgFetalHeartRate2='" . $this->usgFetalHeartRate2 . "', usgFetalPosition2='" . $this->usgFetalPosition2 . "', usgFetalMovement2='" . $this->usgFetalMovement2 . "',
            lT1='" . $this->lT1 . "',usgFHRT1='" . $this->usgFHRT1 . "', usgFPT1='" . $this->usgFPT1 . "', usgFMT1='" . $this->usgFMT1 . "',
            lT2='" . $this->lT2 . "',usgFHRT2='" . $this->usgFHRT2 . "', usgFPT2='" . $this->usgFPT2 . "', usgFMT2='" . $this->usgFMT2 . "',
            lT3='" . $this->lT3 . "',usgFHRT3='" . $this->usgFHRT3 . "', usgFPT3='" . $this->usgFPT3 . "', usgFMT3='" . $this->usgFMT3 . "',
            placenta='" . $this->placenta . "',usgResult='" . $this->usgResult . "',usgRemarks='" . $this->usgRemarks . "',
            bloodTransfusion='" . $this->bloodTransfusion . "',bloodTransfusionDate='" . $this->bloodTransfusionDate . "',
            placeAdministrator='" . $this->placeAdministrator . "',noOfIVDoses='" . $this->noOfIVDoses . "',createdBy='" . $this->usertype . "'";
            // prepare query
            $stmt = $this->conn->prepare($query);
    
    
    
            if ($stmt->execute()) {
                $inserid = $this->conn->lastInsertId();
                return $inserid;
            }
    
            return false;
        }
    }

    
    function editantenatalvisit() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `antenatalvisit` WHERE `picmeno`='" . $this->picmeno . "' ORDER BY `id` ASC");
        $mvaliduser1->execute();
        $mvalidchecknum = $mvaliduser1->rowCount();
    
        if ($mvalidchecknum !="") {
            date_default_timezone_set('Asia/Kolkata');
            $date = date('d-m-Y h:i:s');
            // query to insert record
            $query = "UPDATE " . $this->table_name . "
            SET
            motheraadhaarid='" . $this->motheraadhaarid . "',picmeno='" . $this->picmeno . "',residenttype='" . $this->residenttype . "',physicalpresent='" . $this->physicalpresent . "',
            placeofvisit='" . $this->placeofvisit . "',abortion='" . $this->abortion . "',anvisitDate='" . $this->anvisitDate . "',avdueDate='".date('d-m-Y', strtotime($this->anvisitDate. ' + 30 days'))."',
            avTag='1', ancPeriod='" . $this->ancPeriod . "',pregnancyWeek='" . $this->pregnancyWeek . "',motherWeight='" . $this->motherWeight . "',
            bpSys='" . $this->bpSys . "',bpDia='" . $this->bpDia . "',Hb='" . $this->Hb . "',
            urineTestStatus='" . $this->urineTestStatus . "',fastingSugar='" . $this->fastingSugar . "',
            postPrandial='" . $this->postPrandial . "',Rbs='" . $this->Rbs . "', gctStatus='" . $this->gctStatus . "',gctValue='" . $this->gctValue . "', Tsh='" . $this->Tsh . "',Td1Date='" . $this->Td1Date . "',
            TdDose='" . $this->TdDose . "',Td2Date='" . $this->Td2Date . "',
            Td2Dose='" . $this->Td2Dose . "',TdBdose='".$this->TdBdose."',TdBoosterDate='" . $this->TdBoosterDate . "',
            Covidvac='" . $this->Covidvac . "',Dose1Date='" . $this->Dose1Date . "',Dose2Date='" . $this->Dose2Date . "',PreDate='" . $this->PreDate . "', 
            NoFolicAcid='" . $this->NoFolicAcid . "',NoIFA='" . $this->NoIFA . "', dateofIFA='" . $this->dateofIFA . "', dateofAlbendazole='" . $this->dateofAlbendazole . "',
            noCalcium='" . $this->noCalcium . "',calciumDate='" . $this->calciumDate . "',
            sizeUterusinWeeks='" . $this->sizeUterusinWeeks . "',
            fetalHeartRate='" . $this->fetalHeartRate . "',
            fetalPosition='" . $this->fetalPosition . "',
            fetalMovement='" . $this->fetalMovement . "',methodofConception='" . $this->methodofConception . "',symptomsHighRisk='" . $this->symptomsHighRisk . "',
            referralDate='" . $this->referralDate . "',referralDistrict='" . $this->referralDistrict . "',referralFacility='" . $this->referralFacility . "',
            referralPlace='" . $this->referralPlace . "',
            wusgTaken='" . $this->wusgTaken . "',usgDoneDate='" . $this->usgDoneDate . "', usgScanEdd='" . $this->usgScanEdd . "', usgFundalHeight='" . $this->usgFundalHeight . "',usgSizeUterusWeek='" . $this->usgSizeUterusWeek . "',
            usgFetusStatus='" . $this->usgFetusStatus . "',gestationSac='" . $this->gestationSac . "',
            liquor='" . $this->liquor . "',usgFetalHeartRate='" . $this->usgFetalHeartRate . "', usgFetalPosition='" . $this->usgFetalPosition . "', usgFetalMovement='" . $this->usgFetalMovement . "',         
            liquor1='" . $this->liquor1 . "',usgFetalHeartRate1='" . $this->usgFetalHeartRate1 . "', usgFetalPosition1='" . $this->usgFetalPosition1 . "', usgFetalMovement1='" . $this->usgFetalMovement1 . "',
            liquor2='" . $this->liquor2 . "',usgFetalHeartRate2='" . $this->usgFetalHeartRate2 . "', usgFetalPosition2='" . $this->usgFetalPosition2 . "', usgFetalMovement2='" . $this->usgFetalMovement2 . "',
            lT1='" . $this->lT1 . "',usgFHRT1='" . $this->usgFHRT1 . "', usgFPT1='" . $this->usgFPT1 . "', usgFMT1='" . $this->usgFMT1 . "',
            lT2='" . $this->lT2 . "',usgFHRT2='" . $this->usgFHRT2 . "', usgFPT2='" . $this->usgFPT2 . "', usgFMT2='" . $this->usgFMT2 . "',
            lT3='" . $this->lT3 . "',usgFHRT3='" . $this->usgFHRT3 . "', usgFPT3='" . $this->usgFPT3 . "', usgFMT3='" . $this->usgFMT3 . "',
            placenta='" . $this->placenta . "',usgResult='" . $this->usgResult . "',usgRemarks='" . $this->usgRemarks . "',bloodTransfusion='" . $this->bloodTransfusion . "',bloodTransfusionDate='" . $this->bloodTransfusionDate . "',
            placeAdministrator='" . $this->placeAdministrator . "',noOfIVDoses='" . $this->noOfIVDoses . "', updatedBy='" . $this->usertype . "', updatedat='" . $date . "' WHERE picmeno='" . $this->picmeno . "'";
            // prepare query
            $stmt = $this->conn->prepare($query);
    
    
    
            if ($stmt->execute()) {
                //$inserid = $this->conn->lastInsertId();
                return true;
            }
    
            return false;
        }
    }

    function deleteantenatalvisit() {
        $mvaliduser1 = $this->conn->prepare("SELECT * FROM `antenatalvisit` WHERE `picmeno`='" . $this->picmeno . "' ORDER BY `id` ASC");
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