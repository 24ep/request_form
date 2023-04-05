<!DOCTYPE html>
<html>
<head>
	<title>Product Attributes</title>
</head>
<body class="container-md p-2">
    <div id="get_taxonomy">
    </div>

		<input type="button" value="Submit" onclick="updateSheetData('CDS10000946', 'PASS_TEST');">
</body>
</html>

<script>
function query_data(){

    var stage = document.getElementById(stage).value;
    // stage ='qc'
    // stage ='enrichment'
    $.post("base/get/get_taxonomy.php", {
                stage : stage
            },
            function(data) {
                Notiflix.Loading.hourglass('Loading...');
                $('#get_taxonomy').html(data);
                Notiflix.Loading.remove();
            });


}
function ShowSmallOriginalValue(element_id){
    var no_elements = document.getElementById("no_"+element_id)
    var elements = document.getElementById(element_id)

    if (no_elements.checked==true) {
        elements.style.display = "block";
    } else {
        elements.style.display = "none";
    }
}

function CheckRevisedElements() {
  const elements = document.querySelectorAll('[id^="no_"]');
  for (let i = 0; i < elements.length; i++) {
    if (elements[i].checked) {
      return "REVISED";
    }
  }
  return "QC_PASS";
}
function summit_taxonomy(sku){

var status = CheckRevisedElements();
var sku = document.getElementById('sku').value
var value_accessory_watches_style = document.getElementById('accessory_watches_style').value
var value_air_conditioner_type = document.getElementById('air_conditioner_type').value
var value_air_purifier_type = document.getElementById('air_purifier_type').value
var value_ball_type = document.getElementById('ball_type').value
var value_beauty_set_type = document.getElementById('beauty_set_type').value
var value_book_genre = document.getElementById('book_genre').value
var value_coffee_machine_type = document.getElementById('coffee_machine_type').value
var value_console_type = document.getElementById('console_type').value
var value_dress_length = document.getElementById('dress_length').value
var value_face_mask_type = document.getElementById('face_mask_type').value
var value_facial_part = document.getElementById('facial_part').value
var value_fan_type = document.getElementById('fan_type').value
var value_fashion_occasion = document.getElementById('fashion_occasion').value
var value_fryer_type = document.getElementById('fryer_type').value
var value_gender = document.getElementById('gender').value
var value_haircare_type = document.getElementById('haircare_type').value
var value_hat_type = document.getElementById('hat_type').value
var value_headphone_type = document.getElementById('headphone_type').value
var value_irons_type = document.getElementById('irons_type').value
var value_life_pen_type = document.getElementById('life_pen_type').value
var value_material_clothing = document.getElementById('material_clothing').value
var value_maternity = document.getElementById('maternity').value
var value_pencil_type = document.getElementById('pencil_type').value
var value_pet_type = document.getElementById('pet_type').value
var value_refrigerator_doors = document.getElementById('refrigerator_doors').value
var value_ring_type = document.getElementById('ring_type').value
var value_screen_resolution = document.getElementById('screen_resolution').value
var value_shoes_occasion = document.getElementById('shoes_occasion').value
var value_skirt_length = document.getElementById('skirt_length').value
var value_speaker_type = document.getElementById('speaker_type').value
var value_sport_type = document.getElementById('sport_type').value
var value_storage_drive_type = document.getElementById('storage_drive_type').value
var value_stove_type = document.getElementById('stove_type').value
var value_swimming_goggle_type = document.getElementById('swimming_goggle_type').value
var value_tea_coffee_equipment_type = document.getElementById('tea_coffee_equipment_type').value
var value_towels_type = document.getElementById('towels_type').value
var value_vacuum_cleaner_type = document.getElementById('vacuum_cleaner_type').value
var value_washing_machine_type = document.getElementById('washing_machine_type').value

      $.post("base/action/action_taxonomy_update.php", {
                sku : sku,
                value_accessory_watches_style : value_accessory_watches_style,
                value_air_conditioner_type : value_air_conditioner_type,
                value_air_purifier_type : value_air_purifier_type,
                value_ball_type : value_ball_type,
                value_beauty_set_type : value_beauty_set_type,
                value_book_genre : value_book_genre,
                value_coffee_machine_type : value_coffee_machine_type,
                value_console_type : value_console_type,
                value_dress_length : value_dress_length,
                value_face_mask_type : value_face_mask_type,
                value_facial_part : value_facial_part,
                value_fan_type : value_fan_type,
                value_fashion_occasion : value_fashion_occasion,
                value_fryer_type : value_fryer_type,
                value_gender : value_gender,
                value_haircare_type : value_haircare_type,
                value_hat_type : value_hat_type,
                value_headphone_type : value_headphone_type,
                value_irons_type : value_irons_type,
                value_life_pen_type : value_life_pen_type,
                value_material_clothing : value_material_clothing,
                value_maternity : value_maternity,
                value_pencil_type : value_pencil_type,
                value_pet_type : value_pet_type,
                value_refrigerator_doors : value_refrigerator_doors,
                value_ring_type : value_ring_type,
                value_screen_resolution : value_screen_resolution,
                value_shoes_occasion : value_shoes_occasion,
                value_skirt_length : value_skirt_length,
                value_speaker_type : value_speaker_type,
                value_sport_type : value_sport_type,
                value_storage_drive_type : value_storage_drive_type,
                value_stove_type : value_stove_type,
                value_swimming_goggle_type : value_swimming_goggle_type,
                value_tea_coffee_equipment_type : value_tea_coffee_equipment_type,
                value_towels_type : value_towels_type,
                value_vacuum_cleaner_type : value_vacuum_cleaner_type,
                value_washing_machine_type : value_washing_machine_type
            },
            function(data) {
                Notiflix.Loading.hourglass('Loading...');
                // $('#col_detail').html(data);
                query_data();
                Notiflix.Loading.remove();
            });
  }
</script>


<!--
<script>

    // Load the Google Sheets API client library
    gapi.load('client', start);
       function start(sku, status) {

            // Initialize the API client library
            gapi.client.init({
            apiKey: 'AIzaSyB0sTxGv1N6vNFfUeij9U6KycrfezZi92U',
            discoveryDocs: ['https://sheets.googleapis.com/$discovery/rest?version=v4'],
            clientId: '514529310578-jkv0lqnhr27jkaec3e0qu292d2ip295g.apps.googleusercontent.com',
            scope: 'https://www.googleapis.com/auth/spreadsheets',
            plugin_name: 'streamy'
        }).then(function(sku, status) {
            // Call the Sheets API to update a value in a cell
            var spreadsheetId = '15yMjoMYxKVomcIs9beZvBG6BcwVO4kdzwEd-Kt0ICws';
            var sheetName = 'DEMO';

            var checkDate = new Date().toISOString(); // Replace with the new check date
            var range = sheetName + '!A:F';
            var values = [];
            var request = gapi.client.sheets.spreadsheets.values.get({
                spreadsheetId: spreadsheetId,
                range: range,
                majorDimension: 'ROWS',
            });

        request.then(function(response) {
            var data = response.result.values;
            console.log(data)
            if (data && data.length > 0) {
            // Get the column indexes for the 'status' and 'check_date' columns
            var headerRow = data[0];
            var statusIndex = headerRow.indexOf('status');
            var checkDateIndex = headerRow.indexOf('check_date');
            for (var i = 0; i < data.length; i++) {
                    var row = data[i];
                    if (row[0] === sku) {
                        row[statusIndex] = status; // Set the status value in the 'status' column
                        row[checkDateIndex] = checkDate; // Set the check date in the 'check_date' column
                        values.push(row);
                        console.log(row[0])
                        break; // Exit the loop once the SKU is found
                }
            }
            var requestBody = {
                range: range,
                values: values,
                majorDimension: 'ROWS'
            };
            //update status
            var updateRequest = gapi.client.sheets.spreadsheets.values.update({
                spreadsheetId: spreadsheetId,
                range: sheetName + '!J' + (i+1 ) + '!K' + (i+1 ) ,
                valueInputOption: 'USER_ENTERED',
                resource: {
                  values: [row]
                }
            });
            //update check_by
            // var updateRequest = gapi.client.sheets.spreadsheets.values.update({
            //     spreadsheetId: spreadsheetId,
            //     range: sheetName + '!H' + (i+1 ),
            //     valueInputOption: 'USER_ENTERED',
            //     resource: {
            //     //   values: ['<?php //session_start();echo $_SESSION['username'];?>']
            //         values:[row][1]
            //     }
            // });
            // //update check_date
            // var currentDate = new Date();
            // var isoString = currentDate.toISOString();
            // var withoutMillis = isoString.substring(0, isoString.length - 5) + "Z";

            // var updateRequest = gapi.client.sheets.spreadsheets.values.update({
            //     spreadsheetId: spreadsheetId,
            //     range: sheetName + '!I' + (i +1),
            //     valueInputOption: 'USER_ENTERED',
            //     resource: {
            //       values: withoutMillis
            //     }
            // });
            updateRequest.then(function(response) {
                console.log(response.result);
            }, function(reason) {
                console.error('Error: ' + reason.result.error.message);
            });
            } else {
            console.log('No data found.');
            }
        }, function(reason) {
            console.error('Error: ' + reason.result.error.message);
        });
        });
        }

        // Call the updateSheetData() function with the SKU, status, and checkDate values as arguments

        function updateSheetData(sku, status){
            start(sku, status);
        }



</> -->





