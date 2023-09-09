$(document).ready(function() {
  $('#users-detail').dataTable();
  $('#highRisk-mother-detail').dataTable();
  $('#antenetal-visit-detail').dataTable();
  $('#immunization-detail').dataTable();
  $('#postnalVisit-detail').dataTable();
  $('#edit').click(function() {
    var disabled = $("#name").prop('disabled');
    if (disabled) {
      $("#name").prop('disabled', false);		// if disabled, enable
    } else {
      $("#name").prop('disabled', true);		// if enabled, disable
    }
  });
//grouping tables based on column
  /*  const dataListTable = {
        '0': {'id': 'antenetal-visit-detail', 'group_column': 2},
        '1': {'id': 'immunization-detail', 'group_column': 2},
       '2': {'id': 'highRisk-mother-detail', 'group_column': 1}, /Unique picme - so no need to group
        '3': {'id': 'postnalVisit-detail', 'group_column': 2}
    }; */
//	const dataListTable = {
//        '0': {'id': 'antenetal-visit-detail', 'group_column': 2},
//        '1': {'id': 'immunization-detail', 'group_column': 2},
//        '3': {'id': 'postnalVisit-detail', 'group_column': 2}
//    };
//    for (var keys in dataListTable) {
//        var groupColumn = dataListTable[keys]['group_column'];
//        var tableID = dataListTable[keys]['id'];
//        var ascRecords = dataListTable[keys]['desc'];
//        var table1 = $('#' + tableID).DataTable({
//            columnDefs: [{visible: false, targets: groupColumn, orderData: [0, ascRecords]}],
//            order: [[0, 'asc']],
//            displayLength: 10,
//
//            drawCallback: function (settings) {
//                var api = this.api();
//                var rows = api.rows({page: 'current'}).nodes();
//                var last = null;
//
//                api.column(groupColumn, {page: 'current'})
//                        .data()
//                        .each(function (group, i) {
//                            if (last !== group) {
//                                $(rows)
//                                        .eq(i)
//                                        .before(
//                                                '<tr class="group"><td colspan="5" style="font-weight:bold">' +
//                                                group +
//                                                '</td></tr>'
//                                                );
//
//                                last = group;
//                            }
//                        });
//            }
//        });
//    }
//   
   new DataTable('#antenetal-visit-detail', {
    orderFixed: [3, 'asc'],
    rowGroup: {
        dataSrc: 2
    }
});
   
/*   var groupColumn = 3;
var table1 = $('#antenetal-visit-detail').DataTable({
    columnDefs: [{ visible: false, targets: groupColumn }],
    order: [[groupColumn, 'asc']],
    displayLength: 25,
    drawCallback: function (settings) {
        var api = this.api();
        var rows = api.rows({ page: 'current' }).nodes();
        var last = null;
 
        api.column(groupColumn, { page: 'current' })
            .data()
            .each(function (group, i) {
                if (last !== group) {
                    $(rows)
                        .eq(i)
                        .before(
                            '<tr class="group"><td colspan="5">' +
                                group +
                                '</td></tr>'
                        );
 
                    last = group;
                }
            });
    }
}); */
   
   
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
document.getElementById("BlockId").disabled = false;
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
//document.getElementById("picmeno").disabled = false;
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
document.getElementById("injuction").disabled = false;

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
document.getElementById("TdBdose").disabled = false;
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
document.getElementById("usgDDate").disabled = false;
document.getElementById("ScanEdd").disabled = false;
document.getElementById("ScanStatus").disabled = false;
document.getElementById("FundalHeight").disabled = false;
document.getElementById("SizeUterusWeek").disabled = false;
document.getElementById("FetusStatus").disabled = false;
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
document.getElementById("pla").disabled = false;
document.getElementById("Result").disabled = false;
document.getElementById("usgRemarks").disabled = false;
document.getElementById("methodofConception").disabled = false;
document.getElementById("AnyOtherSpecify").disabled = false;
document.getElementById("HighRisk").disabled = false;
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

var gr = document.getElementById("childDeath").value;
var par = document.getElementById("childDeath").value;
var cd = document.getElementById("childDeath").value;
var abr = document.getElementById("childDeath").value;
var lc = document.getElementById("childDeath").value;
var mw = document.getElementById("childDeath").value;
var bpsy = document.getElementById("childDeath").value;
var bpd = document.getElementById("childDeath").value;

if($('#gravida').val() > 2 || $('#para').val() > 2 ||  $('#childDeath').val() >2 ||
    $('#abortion').val() > 2 || $('#livingChildren').val() > 2 || $('#motherWeight').val() < 40 ||
    $('#bpSys').val() >= 140 ||  $('#bpDia').val() >=90)
    {
      var hrpgcy = "Yes";
    } 
	else 
{
      var hrpgcy = "No";
    }
	document.getElementById("hrPregnancy").value = hrpgcy; 

}

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

$('#picmenoNew').on('keydown keyup change', function(){
    var picmeno = $(this).val();
    checkDuplicatePicmeNo(picmeno);
   
});


/* Medical History PICME - Starts */
/**
 * Add Medical History picme no
 * @returns {undefined}
 */
 
 $('#picmenomed').on('keydown keyup change', function(){
    var picmeno = $(this).val();
    checkMedicaldetails(picmeno);
   
});

function addMedicalValidate(){
    var picmeno = $('#picmenomed').val();
 
    checkMedicaldetails(picmeno);
}

function checkMedicaldetails(picmeno){
        $.ajax({
        url: "ajax/MedicalDetails.php",
        type: "POST",
        data: {
            picmeno: picmeno
        },
		cache: false,
        success: function (result) {
            $('#suggesstion-box').html("")
            result= $.trim(result);
            if ($.trim(result) === '1')
            {
                $('#suggesstion-box').html("<span style='color:red'>Medical history already exists for this picme.</span>");
                return false;
            }

            if (result === '3')
            {
                $('#suggesstion-box').html("<span style='color:red'>Valid picme.</span>");
                return true;
            }

            if (result === '4')
            {
                $('#suggesstion-box').html("<span style='color:red'>Picme not found in AN Registration</span>");
                return false;
            }	
        }
    });
}
/* Medical History PICME - Ends */


$('#picmenoImmune').on('keydown keyup change', function(){
    var picmeno = $('#picmenoImmune').val();
    checkImmunedetails(picmeno);
   
});

$('#doseNo').change(function (){
     var picmeno = $('#picmenoImmune').val();
 
    return checkImmunedetails(picmeno);
});

$('#doseProvidedDate').change(function(){
     var picmeno = $('#picmenoImmune').val();
     var doseProvidedDateVal = $(this).val();
     checkImmunedetails(picmeno, 'date');
});

function addImmuneValidate(){
    var picmeno = $('#picmenoImmune').val();
 
    return checkImmunedetails(picmeno,"");
}


function checkImmunedetails(picmeno, place=''){
      returnParam = true
      $.ajax({
        url: "ajax/immunizationDetails.php",
        async: false,
        type: "POST",
        data: {
            picmeno: picmeno, doseProvidedDateVal: $('#doseProvidedDate').val()
        },
        cache: false,
        success: function (response) {
          
            result = JSON.parse(response);
            $('#suggesstion-box').html("");
            $('#dose-provide-box').html("");
             $('#doseName').attr('disabled', true);
            if (result['result'] === 'fail') {
               $('#suggesstion-box').html("<span style='color:red'>This Picme number didn't have delivery details. \n\
Please proceed with delivery date from delivery details</span>");
               returnParam= false;
            } else {
                
                if(result['result']=='error'){
                    if(place===''){
                    $('#suggesstion-box').html("<span style='color:red'>"+result['message']+"</span>");
                   } else {
                       $('#dose-provide-box').html("<span style='color:red'>"+result['message']+"</span>");
                   }
                    $('#doseName').attr('disabled', false);
                    $("#doseNo").val(result['doseNo']);
                    $("#doseDueDate").attr('value', result['doseDueDate']);
                    $("#doseDueDate").attr('readOnly', true);
                     returnParam =  false;
                }           
                
                 
                if (result['result'] == 'success') {
                    $('#suggesstion-box').html("<span style='color:red'>" + result['message'] + "</span>");
                    $("#doseNo").val(result['doseNo']);
                    $('#doseName').removeAttr('disabled');
                    $("#doseDueDate").attr('value', result['doseDueDate']);
                    $("#doseDueDate").attr('readOnly', true);
                     returnParam = true;
                    //   $("#doseDueDate").attr('value', result['doseDueDate']).change();
                    // $("#doseDueDate").val(result['doseDueDate']);

                }
            }
        }
    });
    console.log(returnParam)
    return returnParam;
}



/**
 * Add delivery picme no
 * @returns {undefined}
 */
function validateAddDelivery(){
    var picmeno = $('#picmenoNew').val();
    checkDuplicatePicmeNo(picmeno);
}

function checkDuplicatePicmeNo(picmeno){
     $.ajax({
        url: "ajax/duplicatePicmeValidation.php",
        type: "POST",
        data: {
            picmeno: picmeno
        },
        cache: false,
        success: function (result) {
            $('#suggesstion-box').html("")
            if (result === '1') {
               $('#suggesstion-box').html("<span style='color:red'>Delivery details already exists</span>");
               return false;
            }
			if (result === '3') {
               $('#suggesstion-box').html("<span style='color:red'>Invalid picmeno.</span>");
               return false;
            }
        }
    });
}

/* Postnatal */
function validatePVPicme(){
    var picmeno = $('#picmeno').val();
    checkPVPicmeNo(picmeno);
}

function checkPVPicmeNo(picmeno){
     $.ajax({
        url: "ajax/PVPicmeValidation.php",
        type: "POST",
        data: {
            picmeno: picmeno
        },
        cache: false,
        success: function (result) {
            $('#suggesstion-box').html("")
            if (result === '1') {
               $('#suggesstion-box').html("<span style='color:red'>Invalid picme no</span>");
               return false;
            }
        }
    });
}


function checkGCTWeekStatusDuplicate(picmeno, selectedValue, selectedText)
{
    resultParam = true;
    if (selectedText != "Not Done") {
        $.ajax({
            url: "ajax/ANVisitValidation.php",
            type: "POST",
            async:false,
            data: {
                picmeno: picmeno, gctStatus: selectedValue
            },
            cache: false,
            success: function (response) {
                result = JSON.parse(response);
                $('#gctWeekStatus_box').html("")
                if (result['result'] === 'fail') {
                    $('#gctWeekStatus_box').html("<span style='color:red'>" + result['message'] + "</span>");
                    resultParam = false;
                }
            }
        });
    }
    return resultParam;
}



$('#pncPeriod').change(function (){
     var picmeno = $('#picmenoPostNalVisit').val();
     var pncperiod = $(this).val();     
     $('#suggesstion-box').html("");
     if(picmeno == ""){
         $('#suggesstion-box').html("<span style='color:red'>Please enter picme no</span>");
     } else {
         checkPostnalVisitPeriod(picmeno, pncperiod);
     }
});

$('#picmenoPostNalVisit').on('blur change click', function () {
    var picmeno = $('#picmenoPostNalVisit').val();
    $('#suggesstion-box').html("");
    $('#pnc-period-box').html("");
    var pncperiod = $('#pncPeriod').val();
    if(pncperiod==""){
        $('#pnc-period-box').html("<span style='color:red'>Please select PNC period for evaluation before Picme no</span>");
       
    } else {
        checkPostnalVisitPeriod(picmeno, pncperiod);
    }
});

function checkPostnalVisitPeriod(picmeno, pncperiod){
    resultParam = true;
    $('#suggesstion-box').html("");
      $.ajax({
        url: "ajax/checkPostNalVisitPeriod.php",
        async: false,
        type: "POST",
        data: {
            picmeno: picmeno, pncPeriod:pncperiod
        },
        cache: false,
        success: function (response) {
             result = JSON.parse(response);
             $('#pnc-period-box').html("");
            if (result['result'] === 'fail') {
               if(result['place']==''){
                $('#pnc-period-box').html("<span style='color:red'>"+result['message']+"</span>");
                $("#pncPeriod").val(result['selected']).change();
               } else {
                    $('#suggesstion-box').html("<span style='color:red'>Please enter valid picme no</span>");
               }
               resultParam =  false;
            }
            if(result['result']=='error'){
                $('#pnc-period-box').html("<span style='color:red'>"+result['message']+"</span>");
                $("#pncPeriod").val(result['selected']).change();
                resultParam =  false;
            }
            
        }
    });
    return resultParam;
}

function validatePostnalVisit(){
    var picmeno = $('#picmenoPostNalVisit').val();
    var pncperiod = $('#pncPeriod').val();
    return checkPostnalVisitPeriod(picmeno, pncperiod);
}


$('#lmpdate').on('blur change', function(){
  var lmpdate = $(this).val();
  if(lmpdate != ""){
     lmpdateAr = lmpdate.split("-");
     formattedLmpdateAr = lmpdateAr[0] + "/" +  lmpdateAr[1] + "/" + lmpdateAr[2];
    var newDate = formatDate(addDays(new Date(formattedLmpdateAr), 280));
   
    $('#edddate').val(newDate)
  }
});
//for retrieve total no of pregnancy when enter picme number in medical history
$('#picmeno').on('blur change click', function () {
    var picmeno = $(this).val();
    var anvisitDate = $('#anvisitDate').val();
    $.ajax({
        url: "getGravida.php",
        type: "POST",
        data: {
            picmeno: picmeno
        },
        cache: false,
        success: function (result) {
            if (result !== "") {
                $("#totPregnancy").val(result).change();
                $("#totPregnancy").attr("disabled", true);
                if($('#pregnancyResult').length > 0 && $('#pregnancyResult').val() != ''){
                    $('#pregnancyResult').val(result);
                } else {
                     $('<input>').attr({
                    type: 'hidden',
                    name: 'totPregnancy',
                    value: result,
                    id : 'pregnancyResult'
                }).appendTo('#placeDelivery');
                }
            }
        }
    });
    checkPicme(picmeno, anvisitDate);
});

$('#anvisitDate').on('blur change click', function () {
    anvisitDate = $(this).val();
    var picmeno = $('#picmeno').val();
    if (anvisitDate != "") {
      
        checkPicme(picmeno, anvisitDate);
    }
});


$('.highPregnancyCls').on('blur change', function (){
    var tagId = $(this).attr('id');
    var gravidaVal = $('#gravida').val();
    var para = $('#para').val();
    var childDeath = $('#childDeath').val()
    
/*    if($('#gravida').val() > 2 || $('#para').val() > 2 ||  $('#childDeath').val() >2 ||
           $('#abortion').val() > 2 || $('#livingChildren').val() > 2 || $('#motherWeight').val() < 40 ||
           $('#bpSys').val() >= 140 ||  $('#bpSys').val() >=90
            ){
       $("#hrPregnancy").val(1).change();
    } else {
       $("#hrPregnancy").val(0).change();
    } */
    
//    var negative = true;
//    if(tagId === 'gravida' || tagId === 'para' || tagId === 'childDeath' || tagId === 'abortion' || tagId === 'livingChildren'){
//       var checkVal =  $('#'+tagId).val();
//       if(checkVal > 2){
//             $("#hrPregnancy").val(1).change();
//       } else {
//            $("#hrPregnancy").val(0).change();
//       }
//    } 
    
//   
//    if(tagId == 'motherWeight '){
//       var checkVal =  $('#'+tagId).val();
//       if(checkVal <= 40){
//             $("#hrPregnancy").val(1).change();
//       } else {
//            $("#hrPregnancy").val(0).change();
//       }
//    }
//    
//    if(tagId == 'bpSys'){
//         var checkVal =  $('#'+tagId).val();
//       if(checkVal >= 140){
//             $("#hrPregnancy").val(1).change();
//       } else {
//            $("#hrPregnancy").val(0).change();
//       }
//    } 
//    
//    if(tagId == 'childDeath'){
//          var checkVal =  $('#'+tagId).val();
//       if(bpDia  >= 90){
//             $("#hrPregnancy").val(1).change();
//       } else {
//            $("#hrPregnancy").val(0).change();
//       }
//    }
});

/**
 * Anvisit - Step2 - number of IFA related process
 * @param {type} date *
 */


$('#HscId').on('change', function(){
    hscId = $(this).val();
    $.ajax({
        url: "ajax/getPanchayat.php",
        type: "POST",
        data: {
            hscId: hscId,
            type:'hsc'
        },
        cache: false,
        success: function (result) {
            $("#PanchayatId").html(result);
            $("#PanchayatId").prop('disabled', false);
            $("#PanchayatId").focus();
        }
    });
});



$('.anregisterPicmenoCls').on('blur change', function(){
    picmeno =  $(this).val();
     $.ajax({
        url: "ajax/AnVisitData.php",
        type: "POST",
        async: false,
        data: {
            picmeno: picmeno         
        },
        cache: false,
        success: function (response) {
            result = JSON.parse(response);
           
            if(result['result']=='success'){
             //    $("#hrPregnancy").val(result['highRisk']).change();
                  $("#obstetricCode").val(result['obcode']).change();
            } 
            
        }
    });
});

$('#PanchayatId').on('change', function(){
    panchayatId = $(this).val();
    $.ajax({
        url: "ajax/getPanchayat.php",
        type: "POST",
        data: {
            panchayatId: panchayatId,
            type : 'panchayat'
        },
        cache: false,
        success: function (result) {
            $("#VillageId").html(result);
            $("#VillageId").prop('disabled', false);
            $("#VillageId").focus();
        }
    });
});




$('#lmpdate').on('blur change', function(){
  var lmpdate = $(this).val();
  if(lmpdate != ""){
     lmpdateAr = lmpdate.split("-");
     formattedLmpdateAr = lmpdateAr[0] + "/" +  lmpdateAr[1] + "/" + lmpdateAr[2];
    var newDate = formatDate(addDays(new Date(formattedLmpdateAr), 280));
   
    $('#edddate').val(newDate)
  }
});

/**
 * 
 * @param {type} val ->picme no
 * @param {type} anvisitDate
 * @returns {undefined}
 */
function checkPicme(val, anvisitDate)
{    
    $('#pregnancyWeek').val("");
//    $('#pregnancyWeek').attr("readOnly", false);
     $.ajax({
        url: "ajax/fetchPregnancyWeek.php",
        type: "POST",
        data: {
            picmeno: val, anvisitDate : anvisitDate
        },
        cache: false,
        success: function (result) {
            if (result !== "") {      
                resultAr = result.split("-#@#-")
                if(resultAr[0] !==0){
                    $("#ancPeriod").val(resultAr[0]).change();   
                    $("#ancPeriod").attr("disabled", true);
                if($('#ancPeriodCount').length > 0 && $('#ancPeriodCount').val() != ''){
                    $('#ancPeriodCount').val(resultAr[0]);
                } else {
                     $('<input>').attr({
                    type: 'hidden',
                    name: 'ancPeriod',
                    value: result,
                    id : 'ancPeriodCount'
                }).appendTo('#ancSection');
                }
                }
                $('#pregnancyWeek').val("");
                  $("#ancPeriod").val(resultAr[0]).change();   
//                $('#pregnancyWeek').attr("readOnly", false);
                if(resultAr[1] !=='0' && resultAr[1] !==""){
                    console.log(resultAr[1])
                    $('#pregnancyWeek').val(resultAr[1]);
//                    $('#pregnancyWeek').attr("readOnly", true);
                }
            }
        }
    });
}


function formatDate(date) {
    day = date.getDate();
    month = (date.getMonth() + 1)
    if(day < 10){
        day = '0'+day;
        
    }
    
    if(month < 10){
        month = '0'+month;
    }
    
    
    return day + '/' + month + '/' + date.getFullYear();
}

// Correct
function addDays(date, days) {
    var result = new Date(date);
    result.setDate(date.getDate() + days);
    return result;
}

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
//if(selectedValue == "1") { Tddose1.style.display = "block"; } else if(selectedValue == "0") { Tddose1.style.display = "none"; }
if(selectedValue == "1") { Tddate1.style.display = "block"; } else if(selectedValue == "0") { Tddate1.style.display = "none"; }
}
function Td2Change() {
var selectBox = document.getElementById("Td2");
var selectedValue = selectBox.options[selectBox.selectedIndex].value;
var Tddose2 = document.getElementById("Tddose2"); 
var Tddate2 = document.getElementById("Tddate2");
//if(selectedValue == "1") { Tddose2.style.display = "block"; } else if(selectedValue == "0") { Tddose2.style.display = "none"; }
if(selectedValue == "1") { Tddate2.style.display = "block"; } else if(selectedValue == "0") { Tddate2.style.display = "none"; }
}

function TdBChange() {
var selectBox = document.getElementById("Tdb");
var selectedValue = selectBox.options[selectBox.selectedIndex].value;
var Bdose = document.getElementById("Bdose");
var TdB = document.getElementById("TdB"); 

//if(selectedValue == "1") { Bdose.style.display = "block"; } else if(selectedValue == "0") { Bdose.style.display = "none"; }
if(selectedValue == "1") { TdB.style.display = "block"; } else if(selectedValue == "0") { TdB.style.display = "none"; }
}
function UrinetestChange() {
var selectBox = document.getElementById("urineTestStatus");
var selectedValue = selectBox.options[selectBox.selectedIndex].value;
var sp = document.getElementById("urineSP");
var ap = document.getElementById("urineAP"); 

if(selectedValue == "1") { sp.style.display = "block"; } else if(selectedValue == "0") { sp.style.display = "none"; }
if(selectedValue == "1") { ap.style.display = "block"; } else if(selectedValue == "0") { ap.style.display = "none"; }
}

function gctChange(picmeno)
{
    var selectBox = document.getElementById("gctStatus");
    var selectedValue = selectBox.options[selectBox.selectedIndex].text;
    var selectedIndex = selectBox.options[selectBox.selectedIndex].value;
    $('#gctValue').attr('disabled', false);
    if (selectedValue == 'Not Done') {
        $('#gctValue').attr('disabled', true);
    }
    return checkGCTWeekStatusDuplicate(picmeno, selectedIndex, selectedValue)
}

function validateGctChange(){
    
    var picmeNum = $('#picmepage2').val();
    return gctChange(picmeNum);
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
var liq1 = document.getElementById("liquor1");
var fhr1 = document.getElementById("usgFetalHeartRate1"); 
var fp1 = document.getElementById("usgFetalPosition1");
var fm1 = document.getElementById("usgFetalMovement1");

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
if(selectedValue == "1") { liq1.style.display = "block"; } else if(selectedValue == "0"){ liq1.style.display = "none"; }
if(selectedValue == "1") { fhr1.style.display = "block"; } else if(selectedValue == "0"){ fhr1.style.display = "none"; }
if(selectedValue == "1") { fp1.style.display = "block"; } else if(selectedValue == "0"){ fp1.style.display = "none"; }
if(selectedValue == "1") { fm1.style.display = "block"; } else if(selectedValue == "0"){ fm1.style.display = "none"; }

}

function gsacField() {
var selectBox = document.getElementById("gestation");
var selectedValue1 = selectBox.options[selectBox.selectedIndex].value;
var liq1 = document.getElementById("liquor1");
var fhr1 = document.getElementById("usgFetalHeartRate1"); 
var fp1 = document.getElementById("usgFetalPosition1");
var fm1 = document.getElementById("usgFetalMovement1");
var liq2 = document.getElementById("liquor2");
var fhr2 = document.getElementById("usgFetalHeartRate2"); 
var fp2 = document.getElementById("usgFetalPosition2");
var fm2 = document.getElementById("usgFetalMovement2");
var liq3 = document.getElementById("liquor3");
var fhr3 = document.getElementById("usgFetalHeartRate3"); 
var fp3 = document.getElementById("usgFetalPosition3");
var fm3 = document.getElementById("usgFetalMovement3");

if(selectedValue1 == "1"){ liq2.style.display = "none"; } if(selectedValue1 == "1"){ liq3.style.display = "none"; }
if(selectedValue1 == "1"){ fhr2.style.display = "none"; } if(selectedValue1 == "1"){ fhr3.style.display = "none"; }
if(selectedValue1 == "1"){ fp2.style.display = "none"; }   if(selectedValue1 == "1"){ fp3.style.display = "none"; }
if(selectedValue1 == "1"){ fm2.style.display = "none"; }   if(selectedValue1 == "1"){ fm3.style.display = "none"; }

if(selectedValue1 == "2") { liq1.style.display = "block"; } if(selectedValue1 == "2") { liq2.style.display = "block"; } 
if(selectedValue1 == "2") { fhr1.style.display = "block"; } if(selectedValue1 == "2") { fhr2.style.display = "block"; } 
if(selectedValue1 == "2") { fp1.style.display = "block"; }  if(selectedValue1 == "2") { fp2.style.display = "block"; } 
if(selectedValue1 == "2") { fm1.style.display = "block"; }  if(selectedValue1 == "2") { fm2.style.display = "block"; }

if(selectedValue1 == "2"){ liq3.style.display = "none"; }
if(selectedValue1 == "2"){ fhr3.style.display = "none"; }
if(selectedValue1 == "2"){ fp3.style.display = "none"; }
if(selectedValue1 == "2"){ fm3.style.display = "none"; }

if(selectedValue1 == "3") { liq1.style.display = "block"; }  
if(selectedValue1 == "3") { fhr1.style.display = "block"; }  
if(selectedValue1 == "3") { fp1.style.display = "block"; }  
if(selectedValue1 == "3") { fm1.style.display = "block"; } 
if(selectedValue1 == "3") { liq2.style.display = "block"; }  
if(selectedValue1 == "3") { fhr2.style.display = "block"; }  
if(selectedValue1 == "3") { fp2.style.display = "block"; }  
if(selectedValue1 == "3") { fm2.style.display = "block"; } 
if(selectedValue1 == "3") { liq3.style.display = "block"; }  
if(selectedValue1 == "3") { fhr3.style.display = "block"; }  
if(selectedValue1 == "3") { fp3.style.display = "block"; }  
if(selectedValue1 == "3") { fm3.style.display = "block"; }
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

var table = $('#users-detail').DataTable({
}).on('search.dt', function() {
  var input = $('.dataTables_filter input')[0];
  $('#search_text_input').val(input.value);
  console.log(input.value)
})




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
document.getElementById("HscId").value="";
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
document.getElementById("ecfr").value = selectedValue;
document.getElementById("ecfrno").value = "";
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

function onlyAadhar(text) {  
text = text.replace(/[^0-9]/g, '');
// Set to HTML
var inputResult   = document.getElementById('motheraadhaarid');
inputResult.value = text;
}

$(document).ready(function() {
$("#motheraadhaarid").keyup(function() {
$.ajax({
    type: "POST",
    url: "readMoAadhar.php",
    data: 'keyword=' + $(this).val(),
    beforeSend: function() {
        $("#motheraadhaarid").css("background", "#FFF url(LoaderIcon.jpeg) no-repeat 165px");
    },
    success: function(data) {
        $("#suggesstion-box").show();
        $("#suggesstion-box").html(data);
        $("#motheraadhaarid").css("background", "#FFF");
    }
});
});
});

function selectMoAadhar(val) {
$("#motheraadhaarid").val(val);
$("#suggesstion-box").hide();
}

function MofConceptionChange() {
var selectOption = document.getElementById("methodofConception");
var valueSelected = selectOption.options[selectOption.selectedIndex].value;
var anyOtherSpecify = document.getElementById("Specify");
if(valueSelected == '8') { anyOtherSpecify.style.display = "block"; }
else if(valueSelected == '1' || valueSelected == '2' || valueSelected == '3' || valueSelected == '4' 
|| valueSelected == '5' || valueSelected == '6' || valueSelected == '7') {
anyOtherSpecify.style.display = "none";
}
}

function SymHighRishChange() {
var selectBox = document.getElementById("highRisk"); 
var selectedValue = selectBox.options[selectBox.selectedIndex].value;

var symptom = document.getElementById("symptom"); 
var refFacility = document.getElementById("refFacility");
var bTrans = document.getElementById("bTrans"); 
var transDate = document.getElementById("transDate");
var placeAdmin = document.getElementById("placeAdmin"); 
var ivDoses = document.getElementById("ivDoses");

if(selectedValue == "1") { symptom.style.display = "block"; } else if(selectedValue == "0") { symptom.style.display = "none"; } 
if(selectedValue == "1") { refFacility.style.display = "block"; } else if(selectedValue == "0") { refFacility.style.display = "none"; } 
if(selectedValue == "1") { bTrans.style.display = "block"; } else if(selectedValue == "0") { bTrans.style.display = "none"; } 
if(selectedValue == "1") { transDate.style.display = "block"; } else if(selectedValue == "0"){ transDate.style.display = "none"; } 
if(selectedValue == "1") { placeAdmin.style.display = "block"; } else if(selectedValue == "0"){ placeAdmin.style.display = "none"; } 
if(selectedValue == "1") { ivDoses.style.display = "block"; } else if(selectedValue == "0"){ ivDoses.style.display = "none"; } 
}

function fnCalMotAge(){
  var MotDateinput = document.getElementById("motherdob").value;   
  // convert user input value into date object
  var motbirthDate = new Date(MotDateinput);
  
  // get difference from current date;
  var mdiff=Date.now() - motbirthDate.getTime(); 
  var  motAgeDate = new Date(mdiff); 
  var motCalcAge=   Math.abs(motAgeDate.getUTCFullYear() - 1970);
  document.getElementById("motherageecreg").value = motCalcAge;  
}

function fnCalHusAge(){
  var HusDateinput = document.getElementById("husdob").value;   
  // convert user input value into date object
  var husbirthDate = new Date(HusDateinput);
  
  // get difference from current date;
  var hdiff=Date.now() - husbirthDate.getTime(); 
  var  husAgeDate = new Date(hdiff); 
  var husCalcAge=   Math.abs(husAgeDate.getUTCFullYear() - 1970);
  document.getElementById("husageecreg").value = husCalcAge;  
}