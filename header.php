<?php 

include("config/connect.php");
error_reporting(0);
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Gauteng Food Distribution Centre Automation System</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>



<style type="text/css">
  .DDlist { display:none; }
</style>

<script type="text/javascript">
  
      var categories = [];
      categories["startList"] = ["Western Cape", "Eastern Cape", 'Northern Cape', 'North West', 'Free State', 'Kwazulu Natal', 'Gauteng', 'Limpopo', 'Mpumalanga']; // Level 1  (True|False is 1 level only)

      categories["Western Cape"] = ["Cape Winelands District Municipality", "Central Karoo District Municipality", "Garden Route District Municipality", "Overberg District Municipality", "West Coast District Municipality", "City of Cape Town Metropolitan"];
      // Level 2
      categories["Cape Winelands District Municipality"] = ["Witzenberg", "Drakenstein", "Stellenbosch", "Breede Valley", "Langeberg"];
      categories["Central Karoo District Municipality"] = ["Laingsburg", "Prince Albert", "Beaufort West"];
      categories["Garden Route District Municipality"] = ["Kannaland", "Hessequa", "Mossel Bay", "George", "Oudtshoorn", "Bitou", "Knysna"];
      categories["Overberg District Municipality"] = ["Theewaterskloof", "Overstrand Cape", "Agulhas", "Swellendam"];
      categories["West Coast District Municipality"] = ["Matzikama", "Cederberg", "Bergrivier", "Saldanha Bay", "Swartland"];
      categories["City of Cape Town Metropolitan"] = ["City of Cape Town"];

      categories["Eastern Cape"] = ["Alfred Nzo District Municipality", "Amathole District Municipality", "Chris Hani District Municipality", "Joe Gqabi District Municipality", "OR Tambo District Municipality", "Sarah Baartman District Municipality", "Nelson Mandela Bay Metropolitan", "Buffalo City Metropolitan"]; // Level 2
      categories["Alfred Nzo District Municipality"] = ["Matatiele", "Mbizana", "Ntabankulu", "Umzimvubu"]; // Level 3 only
      categories["Amathole District Municipality"] = ["Mnquma", "Mbhashe", "Amahlathi", "Ngqushwa", "Great Kei", "Raymond Mhlaba"]; // Level 3 only
      categories["Chris Hani District Municipality"] = ["Intsika Yethu", "Enoch Mgijima", "Engcobo", "Emalahleni", "Inxuba Yethemba", "Sakhisizwe"];
      categories["Joe Gqabi District Municipality"] = ["Elundini", "Senqu", "Walter Sisulu"]; // Level 3 only
      categories["OR Tambo District Municipality"] = ["King Sabata Dalindyebo Local Municipality", "Nyandeni", "Ngquza Hill", "Mhlontlo", "Port St Johns"]; // Level 3 only
      categories["Sarah Baartman District Municipality"] = ["Blue Crane Route", "Dr Beyers Naudé", "Kou-Kamma", "Kouga", "Makana", "Ndlambe", "Sunday's River Valley"];
      categories["Buffalo City Metropolitan"] = ["Buffalo City"];
      categories["Nelson Mandela Bay Metropolitan"] = ["Nelson Mandela Bay Municipality"];

      categories["Northern Cape"] = ["Frances Baard District Municipality", "John Taolo Gaetsewe District Municipality", "Namakwa District Municipality", "Pixley ka Seme District Municipality", "ZF Mgcawu District Municipality"];
      categories["Frances Baard District Municipality"] = ["Sol Plaatje", "Dikgatlong", "Magareng", "Phokwane"];
      categories["John Taolo Gaetsewe District Municipality"] = ["Joe Morolong", "Ga-Segonyana", "Gamagara"];
      categories["Namakwa District Municipality"] = ["Richtersveld", "Nama Khoi", "Kamiesberg", "Hantam", "Karoo Hoogland", "Khâi-Ma"];
      categories["Pixley ka Seme District Municipality"] = ["Ubuntu", "Umsobomvu", "Emthanjeni", "Kareeberg", "Renosterberg", "Thembelihle", "Siyathemba", "Siyancuma"];
      categories["ZF Mgcawu District Municipality"] = ["Dawid Kruiper", "Kai ǃGarib", "ǃKheis", "Tsantsabane", "Kgatelopele"];

      categories["North West"] = ["Bojanala Platinum", "Ngaka Modiri Molema", "Dr Ruth Segomotsi Mompati", "Dr Kenneth Kaunda"];
      categories["Bojanala Platinum"] = ["Moretele", "Madibeng", "Rustenburg", "Kgetlengrivier", "Moses Kotane"];
      categories["Ngaka Modiri Molema"] = ["Ratlou", "Tswaing", "Mahikeng", "Ditsobotla", "Ramotshere"];
      categories["Dr Ruth Segomotsi Mompati"] = ["Naledi", "Mamusa", "Greater Taung", "Lekwa-Teemane", "Kagisano-Molopo"];
      categories["Dr Kenneth Kaunda"] = ["JB Marks", "Matlosana", "Maquassi Hills"];

      categories["Free State"] = ["Mangaung Metropolitan", "Fezile Dabi District", "Lejweleputswa District", "Thabo Mofutsanyana District", "Xhariep District"];
      categories["Mangaung Metropolitan"] = ["Mangaung Metropolitan Municipality"];
      categories["Fezile Dabi District"] = ["Moqhaka", "Ngwathe", "Metsimaholo", "Mafube"];
      categories["Lejweleputswa District"] = ["Masilonyana", "Tokologo", "Tswelopele", "Matjhabeng", "Nala"];
      categories["Thabo Mofutsanyana District"] = ["Setsoto", "Dihlabeng", "Nketoana", "Maluti-a-Phofung", "Phumelela", "Mantsopa"];
      categories["Xhariep District"] = ["Letsemeng", "Kopanong", "Mohokare", "Naledi"];

      categories["Kwazulu Natal"] = ["Amajuba District Municipality", "Harry Gwala District Municipality", "iLembe District Municipality", "King Cetshwayo District Municipality", "Ugu District Municipality", "uMgungundlovu District Municipality", "uMkhanyakude District Municipality", "uMzinyathi District Municipality", "uThukela District Municipality", "Zululand District Municipality", "eThekwini Metropolitan"];
      categories["Amajuba District Municipality"] = ["Dannhauser", "eMadlangeni", "Newcastle"];
      categories["Harry Gwala District Municipality"] = ["Dr Nkosazana Dlamini-Zuma", "Greater Kokstad", "Ubuhlebezwe", "Umzimkhulu"];
      categories["iLembe District Municipality"] = ["KwaDukuza", "Mandeni", "Maphumulo", "Ndwedwe"];
      categories["King Cetshwayo District Municipality"] = ["City of uMhlathuze", "Mthonjaneni", "Nkandla", "uMfolozi", "uMlalazi"];
      categories["Ugu District Municipality"] = ["Ray Nkonyeni", "uMdoni", "uMuziwabantu", "Umzumbe", "Vulamehlo"];
      categories["uMgungundlovu District Municipality"] = ["Impendle", "Mkhambathini", "Mpofana", "Msunduzi", "Richmond", "uMngeni", "uMshwathi"];
      categories["uMkhanyakude District Municipality"] = ["Big Five Hlabisa", "Jozini", "Mtubatuba", "uMhlabuyalingana"];
      categories["uMzinyathi District Municipality"] = ["Endumeni", "Msinga", "Nquthu", "Umvoti"];
      categories["uThukela District Municipality"] = ["Alfred Duma", "Inkosi Langalibalele", "Okhahlamba"];
      categories["Zululand District Municipality"] = ["Abaqulusi", "eDumbe", "Nongoma", "Ulundi", "uPhongolo"];
      categories["eThekwini Metropolitan"] = ["eThekwini Metropolitan Municipality"];

      /** 
      categories["Gauteng"] = ["Johannesburg", "Tshwane", "Ekurhuleni", "Sedibeng", "West Rand"];
      categories["Johannesburg"] = ["Johannesburg"];
      categories["Tshwane"] = ["Tshwane"];
      categories["Ekurhuleni"] = ["Ekurhuleni"];
      categories["Sedibeng"] = ["Emfuleni", "Lesedi", "Midvaal"];
      categories["West Rand"] = ["Merafong City", "Mogale City", "Rand West City"];
      */

      categories["Gauteng"] = ["Johannesburg", "Tshwane", "Ekurhuleni", "Sedibeng", "West Rand", "Other"];

      categories["Johannesburg"] = ["Dobsonville", "Chaiwelo","White City", "Mofolo","Zola","Protea Glen","Jabulani","Phiri Senoane","Midway industrial area","Meadowlands","Diepkloof Zone 4","Diepkloof Zone 6","Pimville","Alex","Benmore","Braamfontein","Jeppestown","Joubert Park","Hilbrow","Dooronfontein","Fordsburg","Orange Farm"];
      categories["Tshwane"] = ["Mamelodi"];
      categories["Ekurhuleni"] = ["Vosloorus","Katlehong","Daveyton","Thokoza","Palmridge","Tsakane","Kwa Thema", "Tembisa"];
      categories["Sedibeng"] = ["Evaton","Sebokeng"];
      categories["West Rand"] = ["Kagiso"];
      categories["Other"] = ["Other"];
      

      categories["Limpopo"] = ["Capricorn District Municipality", "Mopani District Municipality", "Sekhukhune District Municipality", "Vhembe District Municipality", "Waterberg District Municipality"];
      categories["Capricorn District Municipality"] = ["Blouberg", "Lepelle-Nkumpi", "Molemole", "Polokwane"];
      categories["Mopani District Municipality"] = ["Ba-Phalaborwa", "Greater Giyani", "Greater Letaba", "Greater Tzaneen", "Maruleng"];
      categories["Sekhukhune District Municipality"] = ["Elias Motsoaledi", "Ephraim Mogale", "Fetakgomo/Tubatse", "Makhuduthamaga"];
      categories["Vhembe District Municipality"] = ["Collins Chabane", "Makhado", "Musina", "Thulamela"];
      categories["Waterberg District Municipality"] = ["Bela-Bela", "Lephalale", "Mogalakwena", "Mookgophong/Modimolle", "Thabazimbi"];

      categories["Mpumalanga"] = ["Gert Sibande", "Nkangala", "Ehlanzeni"];
      categories["Gert Sibande"] = ["Albert Luthuli", "Msukaligwa", "Mkhondo", "Pixley ka Seme", "Lekwa", "Dipaleseng", "Govan Mbeki"];
      categories["Nkangala"] = ["Victor Khanye", "Emalahleni", "Steve Tshwete", "Emakhazeni", "Thembisile Hani", "Dr JS Moroka"];
      categories["Ehlanzeni"] = ["Thaba Chweu", "Mbombela", "Umjindi", "Nkomazi", "Bushbuckridge"];


      var nLists = 3; // number of lists in the set

      function fillSelect(currCat, currList) {
        var step = Number(currList.name.replace(/\D/g, ""));
        for (i = step; i < nLists + 1; i++) {
          document.forms[0]['List' + i].length = 1;
          document.forms[0]['List' + i].selectedIndex = 0;
          document.getElementById('List' + i).style.display = 'none';
          var firstP = document.getElementById('List' + i);
        }
        var nCat = categories[currCat];
        if (nCat != undefined) {
          document.getElementById('List' + step).style.display = 'inline';
          for (each in nCat) {
            var nOption = document.createElement('option');
            var nData = document.createTextNode(nCat[each]);
            nOption.setAttribute('value', nCat[each]);
            nOption.appendChild(nData);
            currList.appendChild(nOption);
          }
        }
      }

      function getValues() {
        var str = '';
        str += document.getElementById('List1').value + '\n';
        for (var i = 2; i <= nLists; i++) {
          if (document.getElementById('List' + i).selectedIndex != 0) {
            str += document.getElementById('List' + i).value + '\n';
          }
        }
        alert(str);
      }

      function init() {
        fillSelect('startList', document.forms[0]['List1']);
      }

      navigator.appName == "Microsoft Internet Explorer" ?
        attachEvent('onload', init, false) :
        addEventListener('load', init, false);


  function showHideRegistrationAfterKey() {
      var noOption = document.getElementById("reg_key").value;
      if (noOption == "MAHQUESTS2022DSDAPP") {
        jQuery('#registration_full_form').hide();
        document.getElementById("registration_full_form").style.visibility = 'hidden';
        jQuery('#registration_full_form').show();
        document.getElementById("registration_full_form").style.visibility = 'visible';               
      } else {
        jQuery('#registration_full_form').show();
        document.getElementById("registration_full_form").style.visibility = 'visible';
        jQuery('#registration_full_form').hide();
        document.getElementById("registration_full_form").style.visibility = 'hidden';
      }
  }

  function showNonAnnonymousUser() {
    var noOption = document.getElementById("anonymous").value;
    
    if (noOption != "Anonymous") {

        jQuery('#user_details').show();
        document.getElementById("user_details").style.visibility = 'visible';
        
    } else {

        jQuery('#user_details').hide();
        document.getElementById("user_details").style.visibility = 'hidden';

    }    
}

function showHideValidationType() {
    var noOption = document.getElementById("validation_procedure").value;
    
    if (noOption == "idnumber") {

      jQuery('#id_number-label').show();
      document.getElementById("id_number-label").style.visibility = 'visible';

      jQuery('#cellphone-surname-label').hide();
      document.getElementById("cellphone-surname-label").style.visibility = 'hidden';      
      
    } else if (noOption == "surnamecellphone") {

      jQuery('#cellphone-surname-label').show();
      document.getElementById("cellphone-surname-label").style.visibility = 'visible';   

      jQuery('#id_number-label').hide();
      document.getElementById("id_number-label").style.visibility = 'hidden';

    }
    
  }

  function showHideValidationType() {
    var noOption = document.getElementById("validation_procedure").value;
    
    if (noOption == "idnumber") {

      jQuery('#id_number-label').show();
      document.getElementById("id_number-label").style.visibility = 'visible';

      jQuery('#cellphone-surname-label').hide();
      document.getElementById("cellphone-surname-label").style.visibility = 'hidden';      
      
    } else if (noOption == "surnamecellphone") {

      jQuery('#cellphone-surname-label').show();
      document.getElementById("cellphone-surname-label").style.visibility = 'visible';   

      jQuery('#id_number-label').hide();
      document.getElementById("id_number-label").style.visibility = 'hidden';

    }
    
  }  

</script>
