function EcFormValid() {
  this;
  var regexMobile = /^[6-9]\d{9}$/gi;
  var adharcard = /^\d{12}$/; var pinco = /^\d{6}$/;

  var ecfrno = document.getElementById("ecfrno").value;
  if(ecfrno===""){
    document.getElementById("errEcfrNo").innerHTML="Enter Ec Number";
    document.getElementById("errEcfrNo").style.color="Red";
    document.getElementById("ecfrno").focus(); 
    return false;
} else {
    document.getElementById("errEcfrNo").innerHTML="";
}
               
  var DeReg = document.getElementById("dateecreg").value;
  if(DeReg==="") {
    document.getElementById("errEcReg").innerHTML="Enter DATE OF EC REG";
    document.getElementById("errEcReg").style.color="Red";
    document.getElementById("dateecreg").focus();
    return false;
  } else {
    document.getElementById("errEcReg").innerHTML="";

  }
  motheraadhaarid = document.getElementById("motheraadhaarid").value;
  if(motheraadhaarid===""){
    document.getElementById("errmotherAadhaarid").innerHTML="Enter Mother Aadhaar No.";
    document.getElementById("errmotherAadhaarid").style.color="Red";
    document.getElementById("motheraadhaarid").focus(); 
    return false;
  } else if (motheraadhaarid !=='') {
      if (!motheraadhaarid.match(adharcard)) {
          document.getElementById("errmotherAadhaarid").innerHTML="Invalid Aadhaar No.";
          document.getElementById("errmotherAadhaarid").style.color="Red";
          document.getElementById("motheraadhaarid").focus(); 
          return false;
      } document.getElementById("errmotherAadhaarid").innerHTML="";
  } else {
    document.getElementById("errmotherAadhaarid").innerHTML="";
  }
  var motheraadhaarname = document.getElementById("motheraadhaarname").value;
  if(motheraadhaarname===""){
      document.getElementById("errMName").innerHTML="Enter Mother Aadhaar Name";
      document.getElementById("errMName").style.color="Red";
      document.getElementById("motheraadhaarname").focus(); 
      return false;
  } else {
      document.getElementById("errMName").innerHTML="";
  }
  var motherfullname = document.getElementById("motherfullname").value;
if(motherfullname===""){
    document.getElementById("errMfullname").innerHTML="Enter Mother FullName";
    document.getElementById("errMfullname").style.color="Red";
    document.getElementById("motherfullname").focus(); 
    return false;
} else {
    document.getElementById("errMfullname").innerHTML="";
}
 var motherdob = document.getElementById("motherdob").value;
if(motherdob===""){
    document.getElementById("errMdob").innerHTML="Enter Mother DOB";
    document.getElementById("errMdob").style.color="Red";
    document.getElementById("motherdob").focus(); 
    return false;
} else {
    document.getElementById("errMdob").innerHTML="";
}
 var motheragemarriage = document.getElementById("motheragemarriage").value;
if(motheragemarriage===""){
    document.getElementById("errMoAgeMrg").innerHTML="Mother Age at Marriage";
    document.getElementById("errMoAgeMrg").style.color="Red";
    document.getElementById("motheragemarriage").focus(); 
    return false;
} else {
    document.getElementById("errMoAgeMrg").innerHTML="";
}
 var motherageecreg = document.getElementById("motherageecreg").value;
if(motherageecreg===""){
    document.getElementById("errMageecreg").innerHTML="Enter Mother Age at Register";
    document.getElementById("errMageecreg").style.color="Red";
    document.getElementById("motherageecreg").focus(); 
    return false;
} else {
    document.getElementById("errMageecreg").innerHTML="";
}
  var mothermobno = document.getElementById("mothermobno").value;
      // var adharcard = /^\d{12}$/;
if(mothermobno===""){
    document.getElementById("errMmobno").innerHTML="Enter Mobile No.";
    document.getElementById("errMmobno").style.color="Red";
    document.getElementById("mothermobno").focus(); 
    return false;
}  else if (mothermobno !=='') {
  if (!mothermobno.match(regexMobile)) {
      document.getElementById("errMmobno").innerHTML="Invalid Mobile No.";
      document.getElementById("errMmobno").style.color="Red";
      document.getElementById("mothermobno").focus(); 
      return false;
  } document.getElementById("errMmobno").innerHTML="";
} else {
document.getElementById("errMmobno").innerHTML="";
}
             
  var mobileofperson = document.getElementById("mobileofperson");
  var MomMobileValue = mobileofperson.options[mobileofperson.selectedIndex].value;
  if((MomMobileValue==="")){
  document.getElementById("errMobPerson").innerHTML="Select Mobile Belongs Too";
  document.getElementById("errMobPerson").style.color="Red";
  document.getElementById("mothermobno").focus(); 
  return false;
} else {
  document.getElementById("errMobPerson").innerHTML="";
}
  var motheredustatus = document.getElementById("motheredustatus");
  var MeduValue = motheredustatus.options[motheredustatus.selectedIndex].value;
  if((MeduValue==="")){
  document.getElementById("errMedustatus").innerHTML="Select Education Status";
  document.getElementById("errMedustatus").style.color="Red";
  document.getElementById("motheredustatus").focus(); 
  return false;
} else {
  document.getElementById("errMedustatus").innerHTML="";
}

 husbandaadhaarid = document.getElementById("husbandaadhaarid").value;
 if(husbandaadhaarid===""){
    document.getElementById("errHaadhaarid").innerHTML="Enter Husband Aadhaar No.";
    document.getElementById("errHaadhaarid").style.color="Red";
    document.getElementById("husbandaadhaarid").focus(); 
    return false;
  } else if (husbandaadhaarid !=='') {
      if (!husbandaadhaarid.match(adharcard)) {
          document.getElementById("errHaadhaarid").innerHTML="Invalid Aadhaar No.";
          document.getElementById("errHaadhaarid").style.color="Red";
          document.getElementById("husbandaadhaarid").focus(); 
          return false;
      } document.getElementById("errHaadhaarid").innerHTML="";
  } else {
    document.getElementById("errHaadhaarid").innerHTML="";
  }
  var husbandaadhaarname = document.getElementById("husbandaadhaarname").value;
  if(husbandaadhaarname===""){
    document.getElementById("errhaadhaarname").innerHTML="Enter Husband Aadhaar Name";
    document.getElementById("errhaadhaarname").style.color="Red";
    document.getElementById("husbandaadhaarname").focus(); 
    return false;
} else {
    document.getElementById("errhaadhaarname").innerHTML="";
}
 var husfullname = document.getElementById("husfullname").value;
if(husfullname===""){
  document.getElementById("errhfullname").innerHTML="Enter Husband FullName";
  document.getElementById("errhfullname").style.color="Red";
  document.getElementById("husfullname").focus(); 
  return false;
} else {
  document.getElementById("errhfullname").innerHTML="";
}
var husdob = document.getElementById("husdob").value;
if(husdob===""){
  document.getElementById("errhdob").innerHTML="Enter Husband DOB";
  document.getElementById("errhdob").style.color="Red";
  document.getElementById("husdob").focus(); 
  return false;
} else {
  document.getElementById("errhdob").innerHTML="";
}
var husagemarriage = document.getElementById("husagemarriage").value;
if(husagemarriage===""){
  document.getElementById("errhagemarriage").innerHTML="Husband Age Marriage";
  document.getElementById("errhagemarriage").style.color="Red";
  document.getElementById("husagemarriage").focus(); 
  return false;
} else {
  document.getElementById("errhagemarriage").innerHTML="";
}
var husageecreg = document.getElementById("husageecreg").value;
if(husageecreg===""){
  document.getElementById("errhageecreg").innerHTML="Enter Husband Age at Register";
  document.getElementById("errhageecreg").style.color="Red";
  document.getElementById("husageecreg").focus(); 
  return false;
} else {
  document.getElementById("errhageecreg").innerHTML="";
}
var husmobno = document.getElementById("husmobno").value;
if(husmobno===""){
  document.getElementById("errhmob").innerHTML="Enter Mobile No.";
  document.getElementById("errhmob").style.color="Red";
  document.getElementById("husmobno").focus(); 
  return false;
}  else if (husmobno !=='') {
  if (!husmobno.match(regexMobile)) {
      document.getElementById("errhmob").innerHTML="Invalid Mobile No.";
      document.getElementById("errhmob").style.color="Red";
      document.getElementById("husmobno").focus(); 
      return false;
  } document.getElementById("errhmob").innerHTML="";
} else {
document.getElementById("errhmob").innerHTML="";
}
             
             
 var husedustatus = document.getElementById("husedustatus");
  var HeduValue = husedustatus.options[husedustatus.selectedIndex].value;
  if((HeduValue==="")){
    
  document.getElementById("errhedustatus").innerHTML="Select Education Status";
  document.getElementById("errhedustatus").style.color="Red";
  document.getElementById("husedustatus").focus(); 
  return false;
} else {
  document.getElementById("errhedustatus").innerHTML="";
}

  var religion = document.getElementById("religion");
  var ReligionValue = religion.options[religion.selectedIndex].value;
  if((ReligionValue==="")){
    
  document.getElementById("errReligion").innerHTML="Select Religion";
  document.getElementById("errReligion").style.color="Red";
  document.getElementById("religion").focus(); 
  return false;
} else {
  document.getElementById("errReligion").innerHTML="";
}

  var caste = document.getElementById("caste");
  var casteValue = caste.options[caste.selectedIndex].value;
  if((casteValue==="")){
    
  document.getElementById("errCaste").innerHTML="Select Community";
  document.getElementById("errCaste").style.color="Red";
  document.getElementById("caste").focus(); 
  return false;
} else {
  document.getElementById("errCaste").innerHTML="";
}

  var BlockId = document.getElementById("BlockId");
  var BlockIdValue = BlockId.options[BlockId.selectedIndex].value;
  if((BlockIdValue==="")){
    
  document.getElementById("errBlockValue").innerHTML="Select Block";
  document.getElementById("errBlockValue").style.color="Red";
  document.getElementById("BlockId").focus(); 
  return false;
} else {
  document.getElementById("errBlockValue").innerHTML="";
}
 
var PhcId = document.getElementById("PhcId");
var PhcIdValue = PhcId.options[PhcId.selectedIndex].value;
if((PhcIdValue==="")){
              
  document.getElementById("errPhcValue").innerHTML="Select Phc";
  document.getElementById("errPhcValue").style.color="Red";
  document.getElementById("PhcId").focus(); 
  return false;
} else {
  document.getElementById("errPhcValue").innerHTML="";
}
            
var HscId = document.getElementById("HscId");
var HscIdValue = HscId.options[HscId.selectedIndex].value;
if((HscIdValue==="")){
              
  document.getElementById("errHscValue").innerHTML="Select Hsc";
  document.getElementById("errHscValue").style.color="Red";
  document.getElementById("HscId").focus(); 
  return false;
} else {
  document.getElementById("errHscValue").innerHTML="";
}                 
var PanchayatId = document.getElementById("PanchayatId");
var PanchayatIdValue = PanchayatId.options[PanchayatId.selectedIndex].value;
if((PanchayatIdValue==="")){
  
  document.getElementById("errPanchayat").innerHTML="Select Panchayat";
  document.getElementById("errPanchayat").style.color="Red";
  document.getElementById("PanchayatId").focus(); 
  return false;
} else {
  document.getElementById("errPanchayat").innerHTML="";
}
 
var VillageId = document.getElementById("VillageId");
var VillageIdValue = VillageId.options[VillageId.selectedIndex].value;
if((VillageIdValue==="")){
  
  document.getElementById("errVillage").innerHTML="Select Village";
  document.getElementById("errVillage").style.color="Red";
  document.getElementById("VillageId").focus(); 
  return false;
} else {
  document.getElementById("errVillage").innerHTML="";
}

var address = document.getElementById("address").value;
if(address===""){
  document.getElementById("errAddr").innerHTML="Enter Address";
  document.getElementById("errAddr").style.color="Red";
  document.getElementById("address").focus(); 
  return false;
} else {
  document.getElementById("errAddr").innerHTML="";
}
             
var pincode = document.getElementById("pincode").value;
if(pincode===""){
  document.getElementById("errPincode").innerHTML="Enter Pincode";
  document.getElementById("errPincode").style.color="Red";
  document.getElementById("pincode").focus(); 
  return false;
} else if (pincode !=='') {
      if (!pincode.match(pinco)) {
          document.getElementById("errPincode").innerHTML="Invalid Pincode";
          document.getElementById("errPincode").style.color="Red";
          document.getElementById("pincode").focus(); 
          return false;
      } document.getElementById("errPincode").innerHTML="";
  } else {
  document.getElementById("errPincode").innerHTML="";
}

var povertystatus = document.getElementById("povertystatus");
var povertystatusValue = povertystatus.options[povertystatus.selectedIndex].value;
if((povertystatusValue==="")){
  
  document.getElementById("errPoverty").innerHTML="Select Poverty Status";
  document.getElementById("errPoverty").style.color="Red";
  document.getElementById("povertystatus").focus(); 
  return false;
} else {
  document.getElementById("errPoverty").innerHTML="";
}
var migrantstatus = document.getElementById("migrantstatus");
var migrantstatusValue = migrantstatus.options[migrantstatus.selectedIndex].value;
if((migrantstatusValue==="")){
  document.getElementById("errMigrant").innerHTML="Select Migrant Status";
  document.getElementById("errMigrant").style.color="Red";
  document.getElementById("migrantstatus").focus(); 
  return false;
  } else {
  document.getElementById("errMigrant").innerHTML="";
  }
var rationcardtype = document.getElementById("rationcardtype");
var rationcardtypeValue = rationcardtype.options[rationcardtype.selectedIndex].value;
if((rationcardtypeValue==="")){
document.getElementById("errRtype").innerHTML="Select Ration Card Type";
document.getElementById("errRtype").style.color="Red";
document.getElementById("rationcardtype").focus(); 
return false;
} else {
document.getElementById("errRtype").innerHTML="";
}

var rationcardnum = document.getElementById("rationcardnum").value;
if(rationcardnum===""){
  document.getElementById("errRcardnum").innerHTML="Enter Ration Card No.";
  document.getElementById("errRcardnum").style.color="Red";
  document.getElementById("rationcardnum").focus(); 
  return false;
} else if (rationcardnum !=='') {
      if (!rationcardnum.match(adharcard)) {
          document.getElementById("errRcardnum").innerHTML="Invalid Ration Card No.";
          document.getElementById("errRcardnum").style.color="Red";
          document.getElementById("rationcardnum").focus(); 
          return false;
      } document.getElementById("errRcardnum").innerHTML="";
  } else {
  document.getElementById("errRcardnum").innerHTML="";
}
}

function UmValidate() {
  this;
  var name = document.getElementById("name").value;
  if(name===""){
                    document.getElementById("Edname").innerHTML="Enter FullName";
                    document.getElementById("Edname").style.color="Red";
                    document.getElementById("name").focus(); 
                    return false;
               } else {
                    document.getElementById("Edname").innerHTML="";
               }

  var email = document.getElementById("email").value;
  var regexEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if(email===""){
                    document.getElementById("Edemail").innerHTML="Enter Email";
                    document.getElementById("Edemail").style.color="Red";
                    document.getElementById("email").focus(); 
                    return false;
               } else if(!regexEmail.test(email)) {
                document.getElementById("Edemail").innerHTML="Invalid Email Format";
                document.getElementById("Edemail").style.color="Red";
                document.getElementById("email").focus();
                return false;
               } else {
                    document.getElementById("Edemail").innerHTML="";
               }

  var username = document.getElementById("username").value;
  if(username===""){
                    document.getElementById("Edusername").innerHTML="Enter Username";
                    document.getElementById("Edusername").style.color="Red";
                    document.getElementById("username").focus();
                    return false; 
               } else {
                    document.getElementById("Edusername").innerHTML="";
               }

  var encpassword = document.getElementById("encpassword").value;
  if(encpassword===""){
                    document.getElementById("EdencPwd").innerHTML="Enter Password";
                    document.getElementById("EdencPwd").style.color="Red";
                    document.getElementById("encpassword").focus();
                    return false;
               } else {
                    document.getElementById("EdencPwd").innerHTML="";
               }

  var confirm_password = document.getElementById("confirm_password").value;
  if(confirm_password===""){
                    document.getElementById("EdconPwd").innerHTML="Enter Confirm Password";
                    document.getElementById("EdconPwd").style.color="Red";
                    document.getElementById("confirm_password").focus(); 
                    return false;
               } else if(confirm_password != encpassword) {
                    document.getElementById("EdconPwd").innerHTML="Not Matching";
                    document.getElementById("EdconPwd").style.color="Red";
                    document.getElementById("confirm_password").focus(); 
                    return false;
               } else {
                document.getElementById("EdconPwd").innerHTML="";

               }

  var mobile = document.getElementById("mobile").value;
  var regexMobile = /^[6-9]\d{9}$/gi;
  if(mobile===""){
                    document.getElementById("Edmobile").innerHTML="Enter Mobile Number";
                    document.getElementById("Edmobile").style.color="Red";
                    document.getElementById("mobile").focus(); 
                    return false;
               } else if(!regexMobile.test(mobile)) {
                    document.getElementById("Edmobile").innerHTML="Check Mobile Number";
                    document.getElementById("Edmobile").style.color="Red";
                    document.getElementById("mobile").focus();
                    return false;
               } else {
                    document.getElementById("Edmobile").innerHTML="";
               }
  
  var usertype = document.getElementById("usertype");
  var selectedValue = usertype.options[usertype.selectedIndex].value;
  if(selectedValue==""){
    document.getElementById("Edusertype").innerHTML="Select User Type";
    document.getElementById("Edusertype").style.color="Red";
    document.getElementById("usertype").focus(); 
    return false;
} else {
    document.getElementById("Edusertype").innerHTML="";
}
  if((selectedValue=="2") || (selectedValue=="3") || (selectedValue=="4") || (selectedValue=="5")){
      var BlockId = document.getElementById("BlockId").value;
      if(BlockId===""){
                document.getElementById("Edblock").innerHTML="Select Block";
                document.getElementById("Edblock").style.color="Red";
                document.getElementById("BlockId").focus(); 
                return false;
              } else {
                document.getElementById("Edblock").innerHTML="";
              }
  }
  if((selectedValue=="3") || (selectedValue=="4")){
    var PhcId = document.getElementById("PhcId").value;
    if(PhcId===""){
                document.getElementById("Edphc").innerHTML="Select PHC";
                document.getElementById("Edphc").style.color="Red";
                document.getElementById("PhcId").focus(); 
                return false;
              } else {
                document.getElementById("Edphc").innerHTML="";
              }
  }
  if(selectedValue=="4"){
    var HscId = document.getElementById("HscId").value;
    if(HscId===""){
                document.getElementById("Edhsc").innerHTML="Select HSC";
                document.getElementById("Edhsc").style.color="Red";
                document.getElementById("HscId").focus(); 
                return false;
              } else {
                document.getElementById("Edhsc").innerHTML="";
              }
  }
  if(selectedValue=="5"){
    var HosId = document.getElementById("HosId");
    var hosValue = HosId.options[HosId.selectedIndex].value;
    if(hosValue===""){
              document.getElementById("EdHosId").innerHTML="Select Hospital";
              document.getElementById("EdHosId").style.color="Red";
              document.getElementById("HosId").focus(); 
              return false;
            } else {
              document.getElementById("EdHosId").innerHTML="";
            }
  }

  var status = document.getElementById("status").value;
  if(status===""){
                    document.getElementById("Edstatus").innerHTML="Select Status";
                    document.getElementById("Edstatus").style.color="Red";
                    document.getElementById("status").focus(); 
                    return false;
               } else {
                    document.getElementById("Edstatus").innerHTML="";
               }
}

function Arvalidate() {
this;
var picmeNo = /^\d{12}$/;
picmeno = document.getElementById("picmeno").value;
  if(picmeno===""){
    document.getElementById("errPicmeno").innerHTML="Enter PICME No.";
    document.getElementById("errPicmeno").style.color="Red";
    document.getElementById("picmeno").focus(); 
    return false;
  } else if (picmeno !=='') {
      if (!picmeno.match(picmeNo)) {
          document.getElementById("errPicmeno").innerHTML="Invalid PICME No.";
          document.getElementById("errPicmeno").style.color="Red";
          document.getElementById("picmeno").focus(); 
          return false;
      } document.getElementById("errPicmeno").innerHTML="";
  } else {
    document.getElementById("errPicmeno").innerHTML="";
  }
}