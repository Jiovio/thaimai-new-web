    $(document).ready(function() {
        $('#users-detail').dataTable();
        $('#edit').click(function() {
          var disabled = $("#name").prop('disabled');
          if (disabled) {
            $("#name").prop('disabled', false);		// if disabled, enable
          } else {
            $("#name").prop('disabled', true);		// if enabled, disable
          }
        })
      });

function fnReset() {
  document.getElementById("BlockId").value = "";
  document.getElementById("PhcId").value = ""; 
  document.getElementById("HscId").value = "";
}

function fnEnable() {
	//Mother Details
	document.getElementById("SelectHsc").disabled = false;
  document.getElementById("ecfrno").disabled = false;
  document.getElementById("dateecreg").disabled = false;
  document.getElementById("motheraadhaarname").disabled = false;
  document.getElementById("motherfullname").disabled = false;
  document.getElementById("motherdob").disabled = false;
  document.getElementById("motherageecreg").disabled = false;
  document.getElementById("motheragemarriage").disabled = false;
  document.getElementById("mothermobno").disabled = false;
  document.getElementById("mobileofperson").disabled = false;
  document.getElementById("motheredustatus").disabled = false;
//Father Details 
  document.getElementById("husbandaadhaarname").disabled = false;
  document.getElementById("husfullname").disabled = false;
  document.getElementById("husdob").disabled = false;
  document.getElementById("husageecreg").disabled = false;
  document.getElementById("husagemarriage").disabled = false;
  document.getElementById("husmobno").disabled = false;
  document.getElementById("husedustatus").disabled = false;
//Family Details 
  document.getElementById("religion").disabled = false;
  document.getElementById("caste").disabled = false;
  document.getElementById("BlockId").disabled = false;
  document.getElementById("PhcId").disabled = false;
  document.getElementById("HscId").disabled = false;
  document.getElementById("PanchayatId").disabled = false;
  document.getElementById("VillageId").disabled = false;
  document.getElementById("address").disabled = false;
  document.getElementById("pincode").disabled = false;
  document.getElementById("povertystatus").disabled = false;
  document.getElementById("migrantstatus").disabled = false;
  document.getElementById("rationcardtype").disabled = false; 
  document.getElementById("rationcardnum").disabled = false;
  
var x = document.getElementById("btnSaUp");
x.style.display = "block";
}

function fnUserEnable() {
    document.getElementById("name").disabled = false;
    document.getElementById("email").disabled = false;
    document.getElementById("username").disabled = false;
    document.getElementById("encpassword").disabled = false;
    document.getElementById("confirm_password").disabled = false;
    document.getElementById("mobile").disabled = false;
    document.getElementById("usertype").disabled = false;
    document.getElementById("HosId").disabled = false;
    document.getElementById("BlockId").disabled = false;
    document.getElementById("PhcId").disabled = false;
    document.getElementById("HscId").disabled = false;
    document.getElementById("status").disabled = false; 
    
  var x = document.getElementById("btnSaUp");
  x.style.display = "block";
}

function fnAnEnable() {
  document.getElementById("picmeRegDate").disabled = false;
 document.getElementById("residentType").disabled = false;
 document.getElementById("pregnancyTestResult").disabled = false;
 document.getElementById("methodofConception").disabled = false;
 document.getElementById("gravida").disabled = false;
 document.getElementById("para").disabled = false;
 document.getElementById("livingChildren").disabled = false;
 document.getElementById("abortion").disabled = false;
 document.getElementById("childDeath").disabled = false;
 document.getElementById("hrPregnancy").disabled = false;
 document.getElementById("obstetricCode").disabled = false;
 document.getElementById("motherHeight").disabled = false;
 document.getElementById("motherWeight").disabled = false;
 document.getElementById("bpSys").disabled = false;
 document.getElementById("bpDia").disabled = false;
 document.getElementById("anRegDate").disabled = false;
 document.getElementById("mrmbsEligible").disabled = false;
 document.getElementById("MotherAge").disabled = false;
 document.getElementById("HusbandAge").disabled = false;
 
var x = document.getElementById("btnSaUp");
x.style.display = "block";
} 

function fnImEnable() {
 document.getElementById("doseNo").disabled = false;
 document.getElementById("doseName").disabled = false;
 document.getElementById("doseDueDate").disabled = false;
 document.getElementById("doseProvidedDate").disabled = false;
 document.getElementById("breastFeeding").disabled = false;
 document.getElementById("compliFoodStart").disabled = false;
 document.getElementById("motherCovidVac1Done").disabled = false;
 document.getElementById("motherCovidVac1Type").disabled = false;
 document.getElementById("motherCovidVac1Date").disabled = false;
 document.getElementById("motherCovidVac2Done").disabled = false;
 document.getElementById("motherCovidVac2Type").disabled = false;
 document.getElementById("motherCovidVac2Date").disabled = false;
 
 document.getElementById("motherCovidVacBoosterDone").disabled = false;
 document.getElementById("motherCovidVacBoosterType").disabled = false;
 document.getElementById("motherCovidVacBoosterDate").disabled = false;
 
var x = document.getElementById("btnSaUp");
x.style.display = "block";
}

function fnMedEnable() {
 //document.getElementById("picmeno").disabled = false;
 document.getElementById("lmpdate").disabled = false;
 document.getElementById("edddate").disabled = false;
 document.getElementById("reg12weeks").disabled = false;
 document.getElementById("momBGtaken").disabled = false;
 document.getElementById("momBGtype").disabled = false;
 document.getElementById("pastillness").disabled = false;
 document.getElementById("bleedtime").disabled = false;
 document.getElementById("clotTime").disabled = false;
 //document.getElementById("momVdrlRpr").disabled = false;
 document.getElementById("momVdrlRprResult").disabled = false;
 //document.getElementById("husVdrlRpr").disabled = false;
 document.getElementById("husVdrlRprResult").disabled = false;
 //document.getElementById("momhbsag").disabled = false;
 document.getElementById("momhbresult").disabled = false;
 //document.getElementById("hushbsag").disabled = false;
 document.getElementById("hushbresult").disabled = false;
 //document.getElementById("momhivtest").disabled = false;
 document.getElementById("momhivtestresult").disabled = false;
 //document.getElementById("hushivtest").disabled = false;
 document.getElementById("anyOtherInvest").disabled = false;
 document.getElementById("hushivtestresult").disabled = false;
 //document.getElementById("LastPregnancyComplication").disabled = false;
 //document.getElementById("LastPregnancyOutcome").disabled = false;
 //document.getElementById("deliveryMode").disabled = false;
 document.getElementById("totPregnancy").disabled = false;
 document.getElementById("placeDeliveryDistrict").disabled = false;
 document.getElementById("hospitaltype").disabled = false;
 document.getElementById("hospitalname").disabled = false;

var x = document.getElementById("btnSaUp");
x.style.display = "block";
}

function fnPostEnable() {
 document.getElementById("pncPeriod").disabled = false;
 document.getElementById("motherPnc").disabled = false;
 document.getElementById("ifaTabletStatus").disabled = false;
 document.getElementById("calcium").disabled = false;
 document.getElementById("ppcMethod").disabled = false;
 document.getElementById("vitaminA").disabled = false;
 document.getElementById("motherDangerSign").disabled = false;
 document.getElementById("bloodSugar").disabled = false;
 document.getElementById("infantWeight").disabled = false;
 document.getElementById("infantDangerSigns").disabled = false;
 document.getElementById("bpSys").disabled = false;
 document.getElementById("bpDia").disabled = false;

var x = document.getElementById("btnSaUp");
x.style.display = "block";
}

function fnDEnable() {
 document.getElementById("picmeno").disabled = false;
 document.getElementById("deliverydate").disabled = false;
 document.getElementById("deliverytime").disabled = false;
 document.getElementById("deliverydistrict").disabled = false;
 document.getElementById("hospitaltype").disabled = false;
 document.getElementById("hospitalname").disabled = false;
 document.getElementById("childGender").disabled = false;
 document.getElementById("deliveryConductBy").disabled = false;
 document.getElementById("deliverytype").disabled = false;
 document.getElementById("deliveryCompilcation").disabled = false;
 document.getElementById("deliveryOutcome").disabled = false;
 document.getElementById("noOfLiveBirth").disabled = false;
 document.getElementById("noOfStillBirth").disabled = false;
 document.getElementById("infantId").disabled = false;
 document.getElementById("birthDetails").disabled = false;
 document.getElementById("birthWeight").disabled = false;
 document.getElementById("birthHeight").disabled = false;
 document.getElementById("delayedCClamping").disabled = false;
 document.getElementById("skintoskinContact").disabled = false;
 document.getElementById("breastfeedInitiated").disabled = false;
 document.getElementById("admittedSncu").disabled = false;
 document.getElementById("sncudate").disabled = false;
 document.getElementById("sncuAreaName").disabled = false;
 document.getElementById("sncuOutcome").disabled = false;
 document.getElementById("dischargedate").disabled = false;
 document.getElementById("dischargetime").disabled = false;
 document.getElementById("bcgdate").disabled = false;
 document.getElementById("opvDdate").disabled = false;
 document.getElementById("hebBdate").disabled = false;

var x = document.getElementById("btnSaUp");
x.style.display = "block";
}

function fnAnVisitEnable() {
 document.getElementById("residenttype").disabled = false;
 document.getElementById("physicalpresent").disabled = false;
 document.getElementById("placeofvisit").disabled = false;
 document.getElementById("abortion").disabled = false;
 document.getElementById("anvisitDate").disabled = false;
 document.getElementById("ancPeriod").disabled = false;
 document.getElementById("pregnancyWeek").disabled = false;
 document.getElementById("motherWeight").disabled = false;
 document.getElementById("bpSys").disabled = false;
 document.getElementById("bpDia").disabled = false;
 document.getElementById("Hb").disabled = false;
 document.getElementById("urineTestStatus").disabled = false;
 document.getElementById("urineSugarPresent").disabled = false;
 document.getElementById("urineAlbuminPresent").disabled = false;
 document.getElementById("fastingSugar").disabled = false;
 document.getElementById("postPrandial").disabled = false;
 document.getElementById("gctStatus").disabled = false;
 document.getElementById("gctValue").disabled = false;
 document.getElementById("Tsh").disabled = false;
 document.getElementById("Td1").disabled = false;
 document.getElementById("Td2").disabled = false;
 document.getElementById("Tdb").disabled = false;
 document.getElementById("TdDose").disabled = false;
 document.getElementById("Td2Dose").disabled = false;
 document.getElementById("Td1Date").disabled = false;
 document.getElementById("Td2Date").disabled = false;
document.getElementById("TdBoosterDate").disabled = false;
document.getElementById("Covidvac").disabled = false;
document.getElementById("Dose1Date").disabled = false;
document.getElementById("Dose2Date").disabled = false;
document.getElementById("PreDate").disabled = false;
document.getElementById("NoFolicAcid").disabled = false;
 document.getElementById("NoIFA").disabled = false;
 document.getElementById("dateofIFA").disabled = false;
 document.getElementById("dateofAlbendazole").disabled = false;
 document.getElementById("noCalcium").disabled = false;
 document.getElementById("calciumDate").disabled = false;
 document.getElementById("sizeUterusinWeeks").disabled = false;
 document.getElementById("wusgTaken").disabled = false;
 document.getElementById("usgreport").disabled = false;
 document.getElementById("usgDoneDate").disabled = false;
 document.getElementById("usgScanEdd").disabled = false;
 document.getElementById("usgFundalHeight").disabled = false;
 document.getElementById("usgSizeUterusWeek").disabled = false;
 document.getElementById("usgFetusStatus").disabled = false;
 document.getElementById("gestation").disabled = false;
 document.getElementById("liquorop").disabled = false;
 document.getElementById("usgFetalHeartRate").disabled = false;
 document.getElementById("usgFetalPosition").disabled = false;
 document.getElementById("usgFetalMovement").disabled = false;
 document.getElementById("liquor1value").disabled = false;
 document.getElementById("usgFetalHeartRate1value").disabled = false;
 document.getElementById("usgFetalPosition1value").disabled = false;
 document.getElementById("usgFetalMovement1value").disabled = false;
 document.getElementById("liquor2value").disabled = false;
 document.getElementById("usgFetalHeartRate2value").disabled = false;
 document.getElementById("usgFetalPosition2value").disabled = false;
 document.getElementById("usgFetalMovement2value").disabled = false;
 document.getElementById("lT1value").disabled = false;
 document.getElementById("usgFHRT1value").disabled = false;
 document.getElementById("usgFPT1value").disabled = false;
 document.getElementById("usgFMT1value").disabled = false;
 document.getElementById("lT2value").disabled = false;
 document.getElementById("usgFHRT2value").disabled = false;
 document.getElementById("usgFPT2value").disabled = false;
 document.getElementById("usgFMT2value").disabled = false;
 document.getElementById("lT3value").disabled = false;
 document.getElementById("usgFHRT3value").disabled = false;
 document.getElementById("usgFPT3value").disabled = false;
 document.getElementById("usgFMT3value").disabled = false;
 document.getElementById("placenta").disabled = false;
 document.getElementById("usgResult").disabled = false;
 document.getElementById("usgRemarks").disabled = false;
 document.getElementById("methodofConception").disabled = false;
 document.getElementById("symptomsHighRisk").disabled = false;
 document.getElementById("referralDate").disabled = false;
 document.getElementById("referralDistrict").disabled = false;
 document.getElementById("referralFacility").disabled = false;
 document.getElementById("referralPlace").disabled = false;
 document.getElementById("bloodTransfusion").disabled = false;
 document.getElementById("bloodTransfusionDate").disabled = false;
 document.getElementById("placeAdministered").disabled = false;
 document.getElementById("noOfIVDoses").disabled = false;

var x = document.getElementById("btnSaUp");
x.style.display = "block";
}

function Obcode() {
	var g = document.getElementById("gravida").value;
	var p = document.getElementById("para").value;
	var l = document.getElementById("livingChildren").value;
	var a = document.getElementById("abortion").value;
	var c = document.getElementById("childDeath").value;

	var obscode = "G"+g+"P"+p+"L"+l+"A"+a+"C"+c;
	document.getElementById("obstetricCode").value = obscode; 
}

$(document).ready(function() {
$('#motheraadhaarid').on('change', function() {
var motheraadhaarid = document.getElementById("motheraadhaarid").value;
$.ajax({
url: "getMother.php",
type: "POST",
data: {
  motheraadhaarid: motheraadhaarid
},
cache: false,
success: function(result){
$("#husbandaadhaarname").html(result);
$("#husbandaadhaarname").prop('disabled', false);
$("#husbandaadhaarname").focus();
}
});

$.ajax({
url: "getMotherName.php",
type: "POST",
data: {
  motheraadhaarid: motheraadhaarid
},
cache: false,
success: function(result){
$("#motheraadhaarname").html(result);
$("#motheraadhaarname").prop('disabled', false);
$("#motheraadhaarname").focus();
}
});
});  
});

function onlyNumbers(text) {  
  text = text.replace(/[^0-9]/g, '');
  // Set to HTML
  var inputResult   = document.getElementById('picmeno');
  inputResult.value = text;
}
var PminLength = 12;
var PmaxLength = 12;
    $('#picmeno').on('keydown keyup change', function(){
        var Pchar = $(this).val();
        var PcharLength = $(this).val().length;
        if(PcharLength < PminLength){
            $('#Pmessage').text(' minimum'+PminLength+' required.');
        }
        else if(PcharLength > PmaxLength){
            $('#Pmessage').text(' maximum '+PmaxLength+' allowed.');
            $(this).val(Pchar.substring(0, PmaxLength));
        }else{
            $('#Pmessage').text('');
        }
    });

  function CovidChange() {
  var selectBox = document.getElementById("Covidvac");
  var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    var dd1 = document.getElementById("dose1"); 
    var dd2 = document.getElementById("dose2");
    var pd = document.getElementById("predose"); 
    if(selectedValue == "1") { dd1.style.display = "block"; } else if(selectedValue == "2") { dd1.style.display = "block"; } else if(selectedValue == "0") { dd1.style.display = "none"; }
    if(selectedValue == "1") { dd2.style.display = "block"; } else if(selectedValue == "2") { dd2.style.display = "block"; } else if(selectedValue == "0") { dd2.style.display = "none"; }
    if(selectedValue == "1") { pd.style.display = "block"; } else if(selectedValue == "2") { pd.style.display = "block"; }   else if(selectedValue == "0") { pd.style.display = "none"; }
  }

  function Td1Change() {
    var selectBox = document.getElementById("Td1");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    var Tddose1 = document.getElementById("Tddose1"); 
    var Tddate1 = document.getElementById("Tddate1");
    if(selectedValue == "1") { Tddose1.style.display = "block"; } else if(selectedValue == "0") { Tddose1.style.display = "none"; }
    if(selectedValue == "1") { Tddate1.style.display = "block"; } else if(selectedValue == "0") { Tddate1.style.display = "none"; }
  }
  function Td2Change() {
    var selectBox = document.getElementById("Td2");
  var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    var Tddose2 = document.getElementById("Tddose2"); 
    var Tddate2 = document.getElementById("Tddate2");
    if(selectedValue == "1") { Tddose2.style.display = "block"; } else if(selectedValue == "0") { Tddose2.style.display = "none"; }
    if(selectedValue == "1") { Tddate2.style.display = "block"; } else if(selectedValue == "0") { Tddate2.style.display = "none"; }
  }

  function TdBChange() {
    var selectBox = document.getElementById("Tdb");
  var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    var TdB = document.getElementById("TdB"); 
    if(selectedValue == "1") { TdB.style.display = "block"; } else if(selectedValue == "0") { TdB.style.display = "none"; }
  }
  
  function usgChange() {
    var selectBox = document.getElementById("wusgTaken"); 
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
 
    var ts = document.getElementById("takenStatus"); 
    var res = document.getElementById("usgResult");
    var dd = document.getElementById("usgDoneDate"); 
    var sed = document.getElementById("usgScanEdd");
    var usgt = document.getElementById("usgScanStatus"); 
    var fh = document.getElementById("usgFundalHeight");
    var suw = document.getElementById("usgSizeUterusWeek"); 
    var fs = document.getElementById("usgFetusStatus");
    var gs = document.getElementById("gestationSac"); 
    var pla = document.getElementById("placenta");
    var rem = document.getElementById("usgRemarks"); 
    
    if(selectedValue == "1") { ts.style.display = "block"; } else if(selectedValue == "0") { ts.style.display = "none"; } 
    if(selectedValue == "1") { res.style.display = "block"; } else if(selectedValue == "0") { res.style.display = "none"; } 
    if(selectedValue == "1") { dd.style.display = "block"; } else if(selectedValue == "0") { dd.style.display = "none"; } 
    if(selectedValue == "1") { sed.style.display = "block"; } else if(selectedValue == "0"){ sed.style.display = "none"; } 
    if(selectedValue == "1") { usgt.style.display = "block"; } else if(selectedValue == "0"){ usgt.style.display = "none"; } 
    if(selectedValue == "1") { fh.style.display = "block"; } else if(selectedValue == "0"){ fh.style.display = "none"; } 
    if(selectedValue == "1") { suw.style.display = "block"; } else if(selectedValue == "0"){ suw.style.display = "none"; } 
    if(selectedValue == "1") { fs.style.display = "block"; } else if(selectedValue == "0"){ fs.style.display = "none"; }  
    if(selectedValue == "1") { gs.style.display = "block"; } else if(selectedValue == "0"){ gs.style.display = "none"; } 
    if(selectedValue == "1") { pla.style.display = "block"; } else if(selectedValue == "0"){ pla.style.display = "none"; } 
    if(selectedValue == "1") { rem.style.display = "block"; } else if(selectedValue == "0"){ rem.style.display = "none"; }   
  }

  function gsacField() {
    var selectBox = document.getElementById("gestation");
    var selectedValue1 = selectBox.options[selectBox.selectedIndex].value;

    var liq = document.getElementById("liquor");
    var fhr = document.getElementById("usgFetalHeartRate"); 
    var fp = document.getElementById("usgFetalPosition");
    var fm = document.getElementById("usgFetalMovement");

    var liq1 = document.getElementById("liquor1");
    var fhr1 = document.getElementById("usgFetalHeartRate1"); 
    var fp1 = document.getElementById("usgFetalPosition1");
    var fm1 = document.getElementById("usgFetalMovement1");
    var liq2 = document.getElementById("liquor2");
    var fhr2 = document.getElementById("usgFetalHeartRate2"); 
    var fp2 = document.getElementById("usgFetalPosition2");
    var fm2 = document.getElementById("usgFetalMovement2");

    var liqt1 = document.getElementById("lT1");
    var fhrt1 = document.getElementById("usgFHRT1"); 
    var fpt1 = document.getElementById("usgFPT1");
    var fmt1 = document.getElementById("usgFMT1");
    var liqt2 = document.getElementById("lT2");
    var fhrt2 = document.getElementById("usgFHRT2"); 
    var fpt2 = document.getElementById("usgFPT2");
    var fmt2 = document.getElementById("usgFMT2");
    var liqt3 = document.getElementById("lT3");
    var fhrt3 = document.getElementById("usgFHRT3"); 
    var fpt3 = document.getElementById("usgFPT3");
    var fmt3 = document.getElementById("usgFMT3");

    if(selectedValue1 == "1") { liq.style.display = "block"; } else if(selectedValue1 == "2"){ liq.style.display = "none"; } 
    if(selectedValue1 == "1") { fhr.style.display = "block"; } else if(selectedValue1 == "2"){ fhr.style.display = "none"; } 
    if(selectedValue1 == "1") { fp.style.display = "block"; } else if(selectedValue1 == "2"){ fp.style.display = "none"; } 
    if(selectedValue1 == "1") { fm.style.display = "block"; } else if(selectedValue1 == "2"){ fm.style.display = "none"; }

    if(selectedValue1 == "2") { liq1.style.display = "block"; } else if(selectedValue1 == "3"){ liq1.style.display = "none"; } 
    if(selectedValue1 == "2") { fhr1.style.display = "block"; } else if(selectedValue1 == "3"){ fhr1.style.display = "none"; } 
    if(selectedValue1 == "2") { fp1.style.display = "block"; } else if(selectedValue1 == "3"){ fp1.style.display = "none"; } 
    if(selectedValue1 == "2") { fm1.style.display = "block"; } else if(selectedValue1 == "3"){ fm1.style.display = "none"; }
    if(selectedValue1 == "2") { liq2.style.display = "block"; } else if(selectedValue1 == "3"){ liq2.style.display = "none"; } 
    if(selectedValue1 == "2") { fhr2.style.display = "block"; } else if(selectedValue1 == "3"){ fhr2.style.display = "none"; } 
    if(selectedValue1 == "2") { fp2.style.display = "block"; } else if(selectedValue1 == "3"){ fp2.style.display = "none"; } 
    if(selectedValue1 == "2") { fm2.style.display = "block"; } else if(selectedValue1 == "3"){ fm2.style.display = "none"; }
    
    if(selectedValue1 == "3") { liqt1.style.display = "block"; }  
    if(selectedValue1 == "3") { fhrt1.style.display = "block"; }  
    if(selectedValue1 == "3") { fpt1.style.display = "block"; }  
    if(selectedValue1 == "3") { fmt1.style.display = "block"; } 
    if(selectedValue1 == "3") { liqt2.style.display = "block"; }  
    if(selectedValue1 == "3") { fhrt2.style.display = "block"; }  
    if(selectedValue1 == "3") { fpt2.style.display = "block"; }  
    if(selectedValue1 == "3") { fmt2.style.display = "block"; } 
    if(selectedValue1 == "3") { liqt3.style.display = "block"; }  
    if(selectedValue1 == "3") { fhrt3.style.display = "block"; }  
    if(selectedValue1 == "3") { fpt3.style.display = "block"; }  
    if(selectedValue1 == "3") { fmt3.style.display = "block"; }
  }

function SncuChange() {
  var selectBox = document.getElementById("admittedSncu");
  var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    var sdate = document.getElementById("sncuDate"); 
    var sname = document.getElementById("sncuName");
    var scome = document.getElementById("sncuCome"); 
    if(selectedValue == "1") { sdate.style.display = "block"; }  else if(selectedValue == "0") { sdate.style.display = "none"; }
    if(selectedValue == "1") { sname.style.display = "block"; }  else if(selectedValue == "0") { sname.style.display = "none"; }
    if(selectedValue == "1") { scome.style.display = "block"; }   else if(selectedValue == "0") { scome.style.display = "none"; }
  }  
 
function VacDone1() {
  var selectBox = document.getElementById('motherCovidVac1Done');
  var selectedValue = selectBox.options[selectBox.selectedIndex].value;
  var cv1type = document.getElementById('motherCovidVac1T');
  var cv1date = document.getElementById('motherCovidVac1D');

  if(selectedValue == '1') { cv1type.style.display ="block"; } else if(selectedValue == "0") { cv1type.style.display ="none"; }
  if(selectedValue == '1') { cv1date.style.display ="block"; } else if(selectedValue == "0") { cv1date.style.display ="none"; }
}

function dose2() {
  var selectBox = document.getElementById('motherCovidVac2Done');
  var selectedValue = selectBox.options[selectBox.selectedIndex].value;
  var cv2type = document.getElementById('motherCovidVac2T');
  var cv2date = document.getElementById('motherCovidVac2D');

  if(selectedValue == '1') { cv2type.style.display ="block"; } else if(selectedValue == "0") { cv2type.style.display ="none"; }
  if(selectedValue == '1') { cv2date.style.display ="block"; } else if(selectedValue == "0") { cv2date.style.display ="none"; }
}

function Bdose() {
  var selectBox = document.getElementById('motherCovidVacBoosterDone');
  var selectedValue = selectBox.options[selectBox.selectedIndex].value;
  var Btype = document.getElementById('motherCovidVacBooster');
  var Bdate = document.getElementById('motherCovidVacBoosterD');

  if(selectedValue == '1') { Btype.style.display ="block"; } else if(selectedValue == "0") { Btype.style.display ="none"; }
  if(selectedValue == '1') { Bdate.style.display ="block"; } else if(selectedValue == "0") { Bdate.style.display ="none"; }
}

$(document).ready(function() {
$('#doseNo').on('change', function() {
var doseNo = this.value;
$.ajax({
url: "getDoseName.php",
type: "POST",
data: {
  doseNo: doseNo
},
cache: false,
success: function(result){
$("#doseName").html(result);
$("#doseName").prop('disabled', false);
$("#doseName").focus();
}
});
});  
}); 

function RefChange() {
  var selectBox = document.getElementById("referralFacility");
  var selectedValue = selectBox.options[selectBox.selectedIndex].value;
  var refDist = document.getElementById("refDist"); 
  var refPlace = document.getElementById("refPlace");
  var refDate = document.getElementById("refDate");

  if(selectedValue == "1") { refDist.style.display = "block"; } else if(selectedValue == "0") { refDist.style.display = "none"; }
  if(selectedValue == "1") { refPlace.style.display = "block"; } else if(selectedValue == "0") { refPlace.style.display = "none"; }
  if(selectedValue == "1") { refDate.style.display = "block"; } else if(selectedValue == "0") { refDate.style.display = "none"; }
}

$('#encpassword, #confirm_password').on('keyup', function () {
  if ($('#encpassword').val() == $('#confirm_password').val()) {
    $('#message').html('Password Matching').css('color', 'green');
  } else 
    $('#message').html('Password Not Matching').css('color', 'red');
});

function BlockOn() {
  var BlockId = document.getElementById("BlockId").value;
  $.ajax({
  url: "getPhc.php",
  type: "POST",
  data: {
      BlockId: BlockId
  },
  cache: false,
  success: function(result){
  $("#PhcId").html(result);
  $("#PhcId").prop('disabled', false);
  $("#PhcId").focus();
  }
  });
 }

 function PhcOn() {
  var PhcId = document.getElementById("PhcId").value;
  $.ajax({
  url: "getHsc.php",
  type: "POST",
  data: {
      PhcId: PhcId
  },
  cache: false,
  success: function(result){
  $("#HscId").html(result);
  $("#HscId").prop('disabled', false);
  $("#HscId").focus();
  }
  });
 }

function changeFunc() {
  var selectBox = document.getElementById("usertype");
  var selectedValue = selectBox.options[selectBox.selectedIndex].value;
  var b = document.getElementById("blockDiv");
  var p = document.getElementById("phcDiv");
  var h = document.getElementById("hscDiv");
  var hospital = document.getElementById("HospitalDiv");

    if ((selectedValue=="0") || (selectedValue=="1")) {
      b.style.display = "none";  p.style.display = "none"; h.style.display = "none"; hospital.style.display = "none";
    }
    if (selectedValue=="2"){
      b.style.display = "block";  p.style.display = "none"; h.style.display = "none"; hospital.style.display = "none";
    }
    if (selectedValue=="3"){
      b.style.display = "block";  p.style.display = "block"; h.style.display = "none"; hospital.style.display = "none";
    }
    if (selectedValue=="4"){
      b.style.display = "block";  p.style.display = "block"; h.style.display = "block"; hospital.style.display = "none";
    }
    if (selectedValue=="5"){
      b.style.display = "block";  p.style.display = "none"; h.style.display = "none"; hospital.style.display = "";
    }
    if (selectedValue=="6"){
      b.style.display = "block";  p.style.display = "block"; h.style.display = "block"; hospital.style.display = "none";
    }
}

function MotheronlyNumbers(text) {  
  text = text.replace(/[^0-9]/g, '');
  var inputResult   = document.getElementById('motheraadhaarid');
  inputResult.value = text;
}

function HusbandonlyNumbers(text) { 
  text = text.replace(/[^0-9]/g, '');
  var inputResult   = document.getElementById('husbandaadhaarid');
  inputResult.value = text;
}

function MothermobonlyNumbers(text) {  
  text = text.replace(/[^0-9]/g, '');
  var inputResult   = document.getElementById('mothermobno');
  inputResult.value = text;
}

function HusmobonlyNumbers(text) {  
  text = text.replace(/[^0-9]/g, '');
  var inputResult   = document.getElementById('husmobno');
  inputResult.value = text;
}

function PincodeonlyNumbers(text) {  
  text = text.replace(/[^0-9]/g, '');
  var inputResult   = document.getElementById('pincode');
  inputResult.value = text;
}

function onlyRationNo(text) {  
text = text.replace(/[^0-9]/g, '');
var inputResult   = document.getElementById('rationcardnum');
inputResult.value = text;
}

// Set TimeOut Function
const myTimeout = setTimeout(fnClose, 1000000);
function fnClose() {
  window.location = $siteurl;
}

function FirstAlphabet() {
  var selectBox = document.getElementById("SelectHsc");
  var selectedValue = selectBox.options[selectBox.selectedIndex].value.substring(0,3); 
  document.getElementById("ecfrno").value = selectedValue;
}

function totPregnancyChange() {
  var selectBox = document.getElementById("totPregnancy");
  var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    var PdeliveryDist = document.getElementById("placeDelivery");  
    if(selectedValue == "1") { PdeliveryDist.style.display = "none"; } 
    else if(selectedValue == "2" || selectedValue == "3" || selectedValue == "4" || selectedValue == "5" || selectedValue == "6") {
      PdeliveryDist.style.display = "block";
    }
  }

  function mesgResponse() {
  setTimeout(() => {
    var divBox = document.getElementById('response');
  
    divBox.style.display = 'none';
  
  }, 2000); 
  }

  $(document).ready(function() {
    $("#picmeno").keyup(function() {
        $.ajax({
            type: "POST",
            url: "readPicme.php",
            data: 'keyword=' + $(this).val(),
            beforeSend: function() {
                $("#picmeno").css("background", "#FFF url(LoaderIcon.jpeg) no-repeat 165px");
            },
            success: function(data) {
                $("#suggesstion-box").show();
                $("#suggesstion-box").html(data);
                $("#picmeno").css("background", "#FFF");
            }
        });
    });
});
function selectPicme(val) {
    $("#picmeno").val(val);
    $("#suggesstion-box").hide();
}

// function checkPicme()
// {

//     var picmeno = document.getElementById('picmeno');
   
    
//     var message = document.getElementById('errPicme');

//   //  var goodColor = "#0C6";
//     var badColor = "#FF9B37";
  
//     if(picmeno.value.length!=12){
       
//         picmeno.style.backgroundColor = badColor;
//         message.style.color = badColor;
//         message.innerHTML = "required 12 digits"
//         return false;
//     }
//   }
