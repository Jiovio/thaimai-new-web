<?php include ('require/topHeader.php'); ?>
<?php
 
include ('require/Refheader.php');
CREATE TEMPORARY TABLE sms_temp LIKE sms;

LOAD DATA INFILE '/tmp/sms.csv'
INTO TABLE sms_temp
FIELDS TERMINATED BY ','
(id,ecfrno,dateecreg,picmeNo,motheraadhaarid,motheraadhaarname,motheraadhaarmarathiname,husbandaadhaarid,husbandaadhaarname,mothermobno,BlockId,PhcId,HscId,PanchayatId,VillageId,address,pincode,status,createdat,createdBy,updatedat,updatedBy,deletedat,deletedBy); 

UPDATE sms
INNER JOIN sms_temp on sms_temp.id = sms.id
SET sms.motheraadhaarmarathiname = sms_temp.motheraadhaarmarathiname;

DROP TEMPORARY TABLE sms_temp;

?>