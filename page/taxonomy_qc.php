<nav class="navbar navbar-light bg-light shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand m-0 ms-3">Taxonomy QC</a>
        <form class="d-flex">
            <a class="btn btn-outline-secondary btn-sm me-3"
                href="https://docs.google.com/spreadsheets/d/15yMjoMYxKVomcIs9beZvBG6BcwVO4kdzwEd-Kt0ICws/edit#gid=1938593248"
                target="_blank">Categories & Attribute option</a>
            <!-- <a class="btn btn-outline-secondary" href="" target="_blank">SiteMap</a> -->
            <a class="btn btn-outline-secondary btn-sm"
                href="https://lookerstudio.google.com/u/1/reporting/04d93777-6c5c-4c71-8f30-63d87acb077d/page/pQvLD"
                target="_blank">Dashboard</a>
        </form>
    </div>
</nav>

<body class="container-md p-2">
    <div id="get_taxonomy">
    </div>

</body>

<script>
function change_attribute_cate() {
    var new_cate_element = document.getElementById('new_cate')
    var selectedOptions = Array.from(new_cate_element.options).filter(option => option.selected);
    var cate_value = selectedOptions.map(option => option.value).join(",");
    $.post("base/get/get_taxonomy_cate_att_map.php", {
        cate_value:cate_value
        },
        function(data) {
            console.log(data);
            var tobeHideAttribteArray = data.split(",");
            console.log(tobeHideAttribteArray);
            for (let pim_attribute_code of tobeHideAttribteArray) {
                console.log(pim_attribute_code);
                document.getElementById("new_"+pim_attribute_code).style.display = "block";
                document.getElementById("old_"+pim_attribute_code).style.display = "block";
                document.getElementById("no_new_"+pim_attribute_code).style.display = "block";
                document.getElementById("yes_new_"+pim_attribute_code).style.display = "block";
                document.getElementById("label_old_"+pim_attribute_code).style.display = "block";
                document.getElementById("label_new_"+pim_attribute_code).style.display = "block";
            }
        });
}

function query_data() {
    $.post("base/get/get_taxonomy.php", {

        },
        function(data) {
            Notiflix.Loading.hourglass('Loading...');
            $('#get_taxonomy').html(data);
            change_attribute_cate();
            Notiflix.Loading.remove();
        });
}

function ShowSmallOriginalValue(element_id) {
    var no_elements = document.getElementById("no_" + element_id)
    var elements = document.getElementById("original_" + element_id)

    if (no_elements.checked == true) {
        elements.style.display = "block";
    } else {
        elements.style.display = "none";
    }
}

function auto_select_no(element_id) {
    ShowSmallOriginalValue(element_id);
    document.getElementById("no_" + element_id).checked = true;
}

function CheckRevisedElements() {
    //   const elements = document.querySelectorAll('[id^="no_"]');
    const elements_no = document.querySelectorAll('[id^="no_"]');

    for (let i = 0; i < elements_no.length; i++) {

        if (elements_no[i].checked) {
            return "REVISED";
        }
    }
    return "QC_PASSED";
}

function CheckYesNoElements() {

    //   const elements_no = document.querySelectorAll('[id^="no_"]');
    //   const elements_yes = document.querySelectorAll('[id^="yes_"]');

    const elements_no = document.querySelectorAll('[id^="no_"]:not([style*="display:none"])');
    const elements_yes = document.querySelectorAll('[id^="yes_"]:not([style*="display:none"])');

    var count_yes = 0;
    var count_no = 0;
    var count_elements = 0;
    for (let i = 0; i < elements_no.length; i++) {
        // if(elements_no[i].style.display != "none"){
        count_elements = count_elements + 1;
        if (elements_no[i].checked) {
            count_no = count_no + 1;
        }
        if (elements_yes[i].checked) {
            count_yes = count_yes + 1;
        }
        // }

    }
    var count_checked = count_yes + count_no;
    console.log(count_yes)
    console.log(count_no)
    console.log(count_elements)
    if (count_checked == count_elements) {
        return "ALL_CHECKED";
    } else {
        return "MISSING_CHECKED";
    }

}

function revised_record(sku) {
    const elements_no = document.querySelectorAll('[id^="no_"]:not([style*="display:none"])');
    var element_name = "";
    for (let i = 0; i <= elements_no.length - 1; i++) {

        if (elements_no[i].checked) {
            element_name = elements_no[i].value;
            var new_value = document.getElementById(element_name).value;
            // handle multi-select element
            if (element_name == 'new_cate') {
                var new_cate_element = document.getElementById('new_cate')
                var selectedOptions = Array.from(new_cate_element.options).filter(option => option.selected);
                var new_value = selectedOptions.map(option => option.value).join(",");
                // var new_value="'"+new_value+"'";
            }

            console.log(new_cate);

            $.post("base/action/action_taxonomy_revised_record.php", {
                    element_name: element_name,
                    sku: sku,
                    new_value: new_value
                },
                function(data) {
                    if (data.includes("error")) {
                        Notiflix.Report.failure(
                            'Updated Failure',
                            data,
                            'Okay',
                        );

                    }
                });
        }
    }
}

function summit_taxonomy(sku) {

    revised_record(sku)


    var validate_checked = CheckYesNoElements();
    if (validate_checked == "ALL_CHECKED") {
        var status = CheckRevisedElements();
        var sku = document.getElementById('sku').value
        var value_new_accessory_watches_style = document.getElementById('new_accessory_watches_style').value
        var value_new_air_conditioner_type = document.getElementById('new_air_conditioner_type').value
        var value_new_air_purifier_type = document.getElementById('new_air_purifier_type').value
        var value_new_ball_type = document.getElementById('new_ball_type').value
        var value_new_beauty_set_type = document.getElementById('new_beauty_set_type').value
        var value_new_book_genre = document.getElementById('new_book_genre').value
        var value_new_coffee_machine_type = document.getElementById('new_coffee_machine_type').value
        var value_new_console_type = document.getElementById('new_console_type').value
        var value_new_dress_length = document.getElementById('new_dress_length').value
        var value_new_face_mask_type = document.getElementById('new_face_mask_type').value
        var value_new_facial_part = document.getElementById('new_facial_part').value
        var value_new_fan_type = document.getElementById('new_fan_type').value
        var value_new_fashion_occasion = document.getElementById('new_fashion_occasion').value
        var value_new_fryer_type = document.getElementById('new_fryer_type').value
        var value_new_gender = document.getElementById('new_gender').value
        var value_new_haircare_type = document.getElementById('new_haircare_type').value
        var value_new_hat_type = document.getElementById('new_hat_type').value
        var value_new_headphone_type = document.getElementById('new_headphone_type').value
        var value_new_irons_type = document.getElementById('new_irons_type').value
        var value_new_life_pen_type = document.getElementById('new_life_pen_type').value
        var value_new_material_clothing = document.getElementById('new_material_clothing').value
        var value_new_maternity = document.getElementById('new_maternity').value
        var value_new_pencil_type = document.getElementById('new_pencil_type').value
        var value_new_pet_type = document.getElementById('new_pet_type').value
        var value_new_refrigerator_doors = document.getElementById('new_refrigerator_doors').value
        var value_new_ring_type = document.getElementById('new_ring_type').value
        var value_new_screen_resolution = document.getElementById('new_screen_resolution').value
        var value_new_shoes_occasion = document.getElementById('new_shoes_occasion').value
        var value_new_skirt_length = document.getElementById('new_skirt_length').value
        var value_new_speaker_type = document.getElementById('new_speaker_type').value
        var value_new_sport_type = document.getElementById('new_sport_type').value
        var value_new_storage_drive_type = document.getElementById('new_storage_drive_type').value
        var value_new_stove_type = document.getElementById('new_stove_type').value
        var value_new_swimming_goggle_type = document.getElementById('new_swimming_goggle_type').value
        var value_new_tea_coffee_equipment_type = document.getElementById('new_tea_coffee_equipment_type').value
        var value_new_towels_type = document.getElementById('new_towels_type').value
        var value_new_vacuum_cleaner_type = document.getElementById('new_vacuum_cleaner_type').value
        var value_new_washing_machine_type = document.getElementById('new_washing_machine_type').value
        // var new_cate = document.getElementById('new_cate').value


        // handle multi-select element
        var new_cate_element = document.getElementById('new_cate')
        var selectedOptions = Array.from(new_cate_element.options).filter(option => option.selected);
        var new_cate = selectedOptions.map(option => option.value).join(",");
        // var new_cate="'"+new_cate+"'";



        $.post("base/action/action_taxonomy_update.php", {
                sku: sku,
                status: status,
                value_new_accessory_watches_style: value_new_accessory_watches_style,
                value_new_air_conditioner_type: value_new_air_conditioner_type,
                value_new_air_purifier_type: value_new_air_purifier_type,
                value_new_ball_type: value_new_ball_type,
                value_new_beauty_set_type: value_new_beauty_set_type,
                value_new_book_genre: value_new_book_genre,
                value_new_coffee_machine_type: value_new_coffee_machine_type,
                value_new_console_type: value_new_console_type,
                value_new_dress_length: value_new_dress_length,
                value_new_face_mask_type: value_new_face_mask_type,
                value_new_facial_part: value_new_facial_part,
                value_new_fan_type: value_new_fan_type,
                value_new_fashion_occasion: value_new_fashion_occasion,
                value_new_fryer_type: value_new_fryer_type,
                value_new_gender: value_new_gender,
                value_new_haircare_type: value_new_haircare_type,
                value_new_hat_type: value_new_hat_type,
                value_new_headphone_type: value_new_headphone_type,
                value_new_irons_type: value_new_irons_type,
                value_new_life_pen_type: value_new_life_pen_type,
                value_new_material_clothing: value_new_material_clothing,
                value_new_maternity: value_new_maternity,
                value_new_pencil_type: value_new_pencil_type,
                value_new_pet_type: value_new_pet_type,
                value_new_refrigerator_doors: value_new_refrigerator_doors,
                value_new_ring_type: value_new_ring_type,
                value_new_screen_resolution: value_new_screen_resolution,
                value_new_shoes_occasion: value_new_shoes_occasion,
                value_new_skirt_length: value_new_skirt_length,
                value_new_speaker_type: value_new_speaker_type,
                value_new_sport_type: value_new_sport_type,
                value_new_storage_drive_type: value_new_storage_drive_type,
                value_new_stove_type: value_new_stove_type,
                value_new_swimming_goggle_type: value_new_swimming_goggle_type,
                value_new_tea_coffee_equipment_type: value_new_tea_coffee_equipment_type,
                value_new_towels_type: value_new_towels_type,
                value_new_vacuum_cleaner_type: value_new_vacuum_cleaner_type,
                value_new_washing_machine_type: value_new_washing_machine_type,
                new_cate: new_cate
            },
            function(data) {
                if (data.includes("error")) {
                    Notiflix.Report.failure(
                        'Updated Failure',
                        data,
                        'Okay',
                    );

                } else {
                    Notiflix.Notify.success('data updated');
                    Notiflix.Loading.hourglass('Loading...');
                    // $('#col_detail').html(data);
                    query_data();
                    Notiflix.Loading.remove();
                }

            });
    } else {
        Notiflix.Report.failure(
            'Missing some check',
            '"Please check for all attribute before submit',
            'Okay',
        );
    }

}

query_data();
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