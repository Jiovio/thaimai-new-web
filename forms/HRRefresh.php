<?php
 error_reporting(E_ALL);

  include "../config/db_connect.php";
  
  //$listQry_anreg_ins = mysqli_query($conn,"DELETE highriskmothers");
  
  $listQry_trunc = mysqli_query($conn,"TRUNCATE highriskmothers");

    /* ------------------------------------------------------- AN Registration --------------------------------------------------------------------*/

    $listQry_anreg_ins = mysqli_query($conn, "INSERT INTO highriskmothers (picmeNo,status) SELECT DISTINCT(picmeno),status from anregistration WHERE (anregistration.gravida > 2 OR anregistration.livingChildren > 2 OR anregistration.abortion > 2 OR anregistration.childDeath > 2 OR anregistration.para > 2 OR anregistration.motherWeight <= 40 OR anregistration.bpSys >= 140 OR anregistration.bpDia >= 90 OR anregistration.MotherAge < 18) 
AND NOT EXISTS (SELECT antenatalvisit.picmeno FROM antenatalvisit WHERE antenatalvisit.picmeno = anregistration.picmeno)
AND NOT EXISTS (SELECT deliverydetails.picmeno FROM deliverydetails WHERE deliverydetails.picmeno = anregistration.picmeno)");  

    $listQry_anreg_upd_1 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN ecregister ON highriskmothers.picmeNo = ecregister.picmeNo SET highriskmothers.motherName = ecregister.motheraadhaarname");

    $listQry_anreg_upd_2 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN anregistration ON highriskmothers.picmeNo = anregistration.picmeno SET highriskmothers.highRiskFactor = 'Multiple Pregnancy' WHERE (anregistration.gravida > 2 OR anregistration.livingChildren > 2 OR anregistration.abortion > 2 OR
anregistration.childDeath > 2)");

    $listQry_anreg_upd_3 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN anregistration ON highriskmothers.picmeNo = anregistration.picmeno SET highriskmothers.highRiskFactor = 'Multi Para' WHERE (anregistration.para > 2)");
 
    $listQry_anreg_upd_4 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN anregistration ON highriskmothers.picmeNo = anregistration.picmeno SET highriskmothers.highRiskFactor = 'Weight below 40 kg' WHERE (anregistration.motherWeight <= 40)");

    $listQry_anreg_upd_5 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN anregistration ON highriskmothers.picmeNo = anregistration.picmeno SET highriskmothers.highRiskFactor = 'PIH/Pre Eclampsia/Eclampsia' WHERE (anregistration.bpSys >= 140 OR anregistration.bpDia >= 90 )");

    $listQry_anreg_upd_6 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN anregistration ON highriskmothers.picmeNo = anregistration.picmeno SET highriskmothers.highRiskFactor = 'Teenage Pregnancy' WHERE (anregistration.MotherAge < 18 )");
	
	$listQry_anreg_upd_7 = mysqli_query($conn, "UPDATE `anregistration` SET `hrPregnancy`='1',`highRisk`='1' WHERE gravida > 2 OR livingChildren > 2 OR abortion > 2 OR childDeath > 2 OR para > 2 OR motherWeight <= 40 OR bpSys >= 140 OR bpDia >= 90 OR MotherAge < 18");
	
	$listQry_anreg_upd_8 = mysqli_query($conn, "UPDATE `ecregister` JOIN anregistration ON ecregister.picmeNo = anregistration.picmeno SET ecregister.status = '6' WHERE anregistration.gravida > 2 OR anregistration.livingChildren > 2 OR anregistration.abortion > 2 OR anregistration.childDeath > 2 OR anregistration.para > 2 OR anregistration.motherWeight <= 40 OR anregistration.bpSys >= 140 OR anregistration.bpDia >= 90");
	
	//$listQry_anreg_upd_9 = mysqli_query($conn, "UPDATE `ecregister` JOIN anregistration ON ecregister.picmeNo = anregistration.picmeno SET ecregister.status = '2' WHERE ecregister.status = '6' AND anregistration.gravida <= 2 AND anregistration.livingChildren <= 2 AND anregistration.abortion <= 2 AND anregistration.childDeath <= 2 AND anregistration.para <= 2 AND anregistration.motherWeight > 40 AND anregistration.bpSys < 140 AND anregistration.bpDia < 90");
	
	
	/* ------------------------------------------------------- Medical History -----------------------------------------------------------*/
    
     $listQry_MH_ins = mysqli_query($conn, "INSERT INTO highriskmothers (picmeNo,status) SELECT DISTINCT(picmeno),status from medicalhistory WHERE (medicalhistory.momhivtestresult = 1 OR medicalhistory.hushivtestresult = 1 OR medicalhistory.momVdrlRprResult = 1 OR medicalhistory.husVdrlRprResult = 1 OR medicalhistory.momhbresult = 1 OR medicalhistory.hushbresult = 1 OR medicalhistory.totPregnancy > 2 OR medicalhistory.momhbresult = 3 OR medicalhistory.hushbresult = 3 OR medicalhistory.momhivtestresult = 3 OR medicalhistory.hushivtestresult = 3 OR medicalhistory.pastillness = 101 OR medicalhistory.pastillness = 102 OR medicalhistory.pastillness = 103 OR medicalhistory.pastillness = 104 OR medicalhistory.pastillness = 105 OR medicalhistory.pastillness = 106 OR medicalhistory.pastillness = 107 OR medicalhistory.pastillness = 108 OR medicalhistory.pastillness = 109 OR medicalhistory.pastillness = 110 OR medicalhistory.pastillness = 111 OR medicalhistory.pastillness = 112) 
	 AND NOT EXISTS (SELECT antenatalvisit.picmeno FROM antenatalvisit WHERE antenatalvisit.picmeno = medicalhistory.picmeno)
	 AND NOT EXISTS (SELECT deliverydetails.picmeno FROM deliverydetails WHERE deliverydetails.picmeno = medicalhistory.picmeno)");
     
	 $listQry_MH_upd_1 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN ecregister ON highriskmothers.picmeNo = ecregister.picmeNo SET highriskmothers.motherName = ecregister.motheraadhaarname");
	 
	 $listQry_MH_upd_2 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'HIV affected mother' WHERE (medicalhistory.momhivtestresult = 1)");
	  
	 $listQry_MH_upd_3 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'HIV affected husband' WHERE (medicalhistory.hushivtestresult = 1)");
	 
	 $listQry_MH_upd_4 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'Moms VDRL Positive' WHERE (medicalhistory.momVdrlRprResult = 1)");
	 
	 $listQry_MH_upd_5 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'Husbands VDRL Positive' WHERE (medicalhistory.husVdrlRprResult = 1)");
	 
	 $listQry_MH_upd_6 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'Hepatitis B surface antigen for mother' WHERE (medicalhistory.momhbresult = 1)");
	 
	 $listQry_MH_upd_7 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'Hepatitis B surface antigen for husband' WHERE (medicalhistory.hushbresult = 1)");
	 
	 $listQry_MH_upd_8 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'Multiple Pregnancy' WHERE (medicalhistory.totPregnancy > 2)");
	 
	 $listQry_MH_upd_9 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'HBsAG test not done for mother' WHERE (medicalhistory.momhbresult = 3)");
	 
	 $listQry_MH_upd_10 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'HBsAG test not done for husband' WHERE (medicalhistory.hushbresult = 3)");
	 
	 $listQry_MH_upd_11 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'HIV test not done for mother' WHERE (medicalhistory.momhivtestresult = 3)"); 
	 
	 $listQry_MH_upd_12 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'HIV test not done for husband' WHERE (medicalhistory.hushivtestresult = 3)");
	  
	 $listQry_MH_upd_13 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'TB' WHERE (medicalhistory.pastillness = 101)"); 
	 
	 $listQry_MH_upd_14 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'Diabetes' WHERE (medicalhistory.pastillness = 102)");
	 
	 $listQry_MH_upd_15 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'Hypertension' WHERE (medicalhistory.pastillness = 103)");
	 
	 $listQry_MH_upd_16 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'Heart Disease' WHERE (medicalhistory.pastillness = 104)");
	 
	 $listQry_MH_upd_17 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'Epilepsy' WHERE (medicalhistory.pastillness = 105)");
	 
	 $listQry_MH_upd_18 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'RTI / STI' WHERE (medicalhistory.pastillness = 106)");
	 
	 $listQry_MH_upd_19 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'HIV Positive' WHERE (medicalhistory.pastillness = 107)");
	 
	 $listQry_MH_upd_20 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'Asthma' WHERE (medicalhistory.pastillness = 108)");
	 
	 $listQry_MH_upd_21 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'Hep B' WHERE (medicalhistory.pastillness = 109)"); 
	 
	 $listQry_MH_upd_22 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'Any Other Specify' WHERE (medicalhistory.pastillness = 110)");
	  
	 $listQry_MH_upd_23 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'Gestational Diabetes' WHERE (medicalhistory.pastillness = 111)"); 
	 
	 $listQry_MH_upd_24 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN medicalhistory ON highriskmothers.picmeNo = medicalhistory.picmeno SET highriskmothers.highRiskFactor = 'Hypothyroidism' WHERE (medicalhistory.pastillness = 112)");
    
	 $listQry_MH_upd_25 = mysqli_query($conn, "UPDATE `medicalhistory` SET `highRisk`='1' WHERE (momhivtestresult = '1' OR hushivtestresult = '1' OR momVdrlRprResult = '1' OR husVdrlRprResult = '1' OR momhbresult = '1' OR hushbresult = '1' OR totPregnancy > '2' OR momhbresult = '3' OR hushbresult = '3' OR momhivtestresult = '3' OR hushivtestresult = '3' OR pastillness = '101' OR pastillness = '102' OR pastillness = '103' OR pastillness = '104' OR pastillness = '105' OR pastillness = '106' OR pastillness = '107' OR pastillness = '108' OR pastillness = '109' OR pastillness = '110' OR pastillness = '111' OR pastillness = '112')");
	
	 $listQry_MH_upd_26 = mysqli_query($conn, "UPDATE `ecregister` JOIN medicalhistory ON ecregister.picmeNo = medicalhistory.picmeno SET ecregister.status = '6' WHERE (medicalhistory.momhivtestresult = 1 OR medicalhistory.hushivtestresult = 1 OR medicalhistory.momVdrlRprResult = 1 OR medicalhistory.husVdrlRprResult = 1 OR medicalhistory.momhbresult = 1 OR medicalhistory.hushbresult = 1 OR medicalhistory.totPregnancy > 2 OR medicalhistory.momhbresult = 3 OR medicalhistory.hushbresult = 3 OR medicalhistory.momhivtestresult = 3 OR medicalhistory.hushivtestresult = 3 OR medicalhistory.pastillness = 101 OR medicalhistory.pastillness = 102 OR medicalhistory.pastillness = 103 OR medicalhistory.pastillness = 104 OR medicalhistory.pastillness = 105 OR medicalhistory.pastillness = 106 OR medicalhistory.pastillness = 107 OR medicalhistory.pastillness = 108 OR medicalhistory.pastillness = 109 OR medicalhistory.pastillness = 110 OR medicalhistory.pastillness = 111 OR medicalhistory.pastillness = 112)");
	
//	 $listQry_MH_upd_27 = mysqli_query($conn, "UPDATE `ecregister` JOIN medicalhistory ON ecregister.picmeNo = medicalhistory.picmeno SET ecregister.status = '1' WHERE (ecregister.status = '6' AND medicalhistory.momhivtestresult = 0 AND medicalhistory.hushivtestresult = 0 AND medicalhistory.momVdrlRprResult = 0 AND medicalhistory.husVdrlRprResult = 0 AND medicalhistory.momhbresult = 0 AND medicalhistory.hushbresult = 0 AND medicalhistory.totPregnancy <= 2 AND medicalhistory.pastillness != 101 AND medicalhistory.pastillness != 102 AND medicalhistory.pastillness != 103 AND medicalhistory.pastillness != 104 AND medicalhistory.pastillness != 105 AND medicalhistory.pastillness != 106 AND medicalhistory.pastillness != 107 AND medicalhistory.pastillness = 108 AND medicalhistory.pastillness = 109 AND medicalhistory.pastillness != 110 AND medicalhistory.pastillness != 111 AND medicalhistory.pastillness != 112)");
	
	/* ------------------------------------------------------- antenatalvisit -----------------------------------------------------------*/

	$listQry_AV_ins = mysqli_query($conn, "INSERT INTO highriskmothers (picmeNo,status) SELECT picmeno,status from antenatalvisit av WHERE (av.HighRisk = 1 OR av.Hb < 10 OR av.urineSugarPresent = 1 OR av.urineAlbuminPresent = 1 OR av.gctValue >= 190 OR av.Tsh > 4.87 OR av.bpSys >= 140 OR av.bpDia >= 90 OR av.motherWeight <= 40) 
	AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno) AND
NOT EXISTS (SELECT highriskmothers.picmeNo FROM highriskmothers WHERE highriskmothers.picmeNo = av.picmeno)");  
	
	$listQry_AV_upd_1 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN ecregister ON highriskmothers.picmeNo = ecregister.picmeNo SET highriskmothers.motherName = ecregister.motheraadhaarname");
	 
	 $listQry_AV_upd_2 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN antenatalvisit av ON highriskmothers.picmeNo = av.picmeno SET highriskmothers.highRiskFactor = 'Severe Anaemia' WHERE (av.Hb < 10)
	 AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno)");
	  
	 $listQry_AV_upd_3 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN antenatalvisit av ON highriskmothers.picmeNo = av.picmeno SET highriskmothers.highRiskFactor = 'Gestational Diabetes' WHERE (av.urineSugarPresent = 1)
	 AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno)");
	 
	 $listQry_AV_upd_4 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN antenatalvisit av ON highriskmothers.picmeNo = av.picmeno SET highriskmothers.highRiskFactor = 'Kidney Disease' WHERE (av.urineAlbuminPresent = 1)
	 AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno)");
	 
	 $listQry_AV_upd_5 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN antenatalvisit av ON highriskmothers.picmeNo = av.picmeno SET highriskmothers.highRiskFactor = 'GDM' WHERE (av.gctValue >= 190 AND av.gctStatus != 4)
	 AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno)");
	 
	 $listQry_AV_upd_6 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN antenatalvisit av ON highriskmothers.picmeNo = av.picmeno SET highriskmothers.highRiskFactor = 'hyperthyroidism' WHERE (av.Tsh > 4.87)
	 AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno)");
	 
	 $listQry_AV_upd_7 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN antenatalvisit av ON highriskmothers.picmeNo = av.picmeno SET highriskmothers.highRiskFactor = 'PIH/Pre Eclampsia/Eclampsia' WHERE (av.bpSys >= 140 OR av.bpDia >= 90)
	 AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno)");
	 
	 $listQry_AV_upd_8 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN antenatalvisit av ON highriskmothers.picmeNo = av.picmeno SET highriskmothers.highRiskFactor = 'Weight below 40 kg' WHERE (av.motherWeight <= 40)
	 AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno)");

//	$listQry_AV_upd_9 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN antenatalvisit av ON highriskmothers.picmeNo = av.picmeno SET highriskmothers.highRiskFactor = av.symptomsHighRisk WHERE (av.HighRisk = 1) AND
//	av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno)");

	$listQry_AV_upd_13 = mysqli_query($conn, "UPDATE `highriskmothers` "
                . "JOIN antenatalvisit av ON highriskmothers.picmeNo=av.picmeno AND av.symptomsHighRisk!='' "
                . "JOIN enumdata ON enumdata.enumid = av.symptomsHighRisk SET highriskmothers.highRiskFactor = enumdata.enumvalue WHERE (enumdata.type = 51)");

	
	
	 $listQry_AV_upd_10 = mysqli_query($conn, "UPDATE `ecregister` JOIN antenatalvisit av ON ecregister.picmeNo = av.picmeno SET ecregister.status = '6' WHERE (av.HighRisk = 1 OR av.Hb < 10 OR av.urineSugarPresent = 1 OR av.urineAlbuminPresent = 1 OR av.gctValue >= 190 OR av.Tsh > 4.87 OR av.bpSys >= 140 OR av.bpDia >= 90 OR av.motherWeight <= 40)
	 AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 where av1.picmeno = av.picmeno)");
	
    /* ------------------------------------------------------- HR to Low Risk -----------------------------------------------------------*/	
	 $listQry_upd_ec_11 = mysqli_query($conn, "UPDATE `ecregister` JOIN 
                 antenatalvisit av ON ecregister.picmeNo = av.picmeno SET ecregister.status = '2' 
                 WHERE ecregister.status = '6' AND NOT EXISTS (SELECT highriskmothers.picmeNo 
                 FROM highriskmothers WHERE highriskmothers.picmeNo = ecregister.picmeNo) 
                 AND av.ancPeriod = (SELECT max(CAST(av1.ancPeriod AS SIGNED)) From antenatalvisit av1 
                 where av1.picmeno = av.picmeno)"); 
	 
/*	 $listQry_AV_del_upd_ec_12 = mysqli_query($conn, "UPDATE `highriskmothers` JOIN antenatalvisit ON highriskmothers.picmeNo = antenatalvisit.picmeno SET highriskmothers.status = 'D' WHERE (antenatalvisit.HighRisk = 0 AND antenatalvisit.Hb >= 10 AND antenatalvisit.urineSugarPresent = 0 AND antenatalvisit.urineAlbuminPresent = 0 AND antenatalvisit.gctValue < 190 AND antenatalvisit.Tsh <= 4.87 AND antenatalvisit.bpSys < 140 AND antenatalvisit.bpDia < 90 OR antenatalvisit.motherWeight > 40) AND
antenatalvisit.anvisitDate = (SELECT max(av1.anvisitDate) From antenatalvisit av1 where av1.picmeno = antenatalvisit.picmeno)"); 
	 
	 
     $listQry_AV_del_12 = mysqli_query($conn, "TRUNCATE `highriskmothers` WHERE highriskmothers.status = 'D'"); */
	/* ------------------------------------------------------- Refresh Message -----------------------------------------------------------*/
      	 
	 echo "<script>alert('Refreshed Successfully!!!');window.location.replace('{$siteurl}/forms/highRiskMothers.php');</script>";
         header("Location:".$redirectUrl);
	//exit;   

