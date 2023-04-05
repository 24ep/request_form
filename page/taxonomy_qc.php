<!DOCTYPE html>
<html>
<head>
	<title>Product Attributes</title>
</head>
<body class="container-md p-2">
	<form>
		<label for="sku">SKU:</label>
		<input type="text" id="sku" name="sku"><br>

		<label for="th_name">TH Name:</label>
		<input type="text" id="th_name" name="th_name"><br>

		<label for="en_name">EN Name:</label>
		<input type="text" id="en_name" name="en_name"><br>

		<label for="priority">Priority:</label>
		<input type="number" id="priority" name="priority"><br>

		<label for="top_200">TOP 200:</label>
		<input type="checkbox" id="top_200" name="top_200"><br>

		<label for="sale">SALE:</label>
		<input type="checkbox" id="sale" name="sale"><br>

		<label for="check_by">Check By:</label>
		<input type="text" id="check_by" name="check_by"><br>

		<label for="check_date">Check Date:</label>
		<input type="date" id="check_date" name="check_date"><br>

		<label for="status">Status:</label>
		<select id="status" name="status" >
			<option value="active">Active</option>
			<option value="discontinued">Discontinued</option>
			<option value="out_of_stock">Out of Stock</option>
		</select><br>

		<input type="button" value="Submit" onclick="updateSheetData('CDS10000946', 'PASS_TEST');">
	</form>
</body>
</html>


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
                range: sheetName + '!J' + (i +1),
                valueInputOption: 'USER_ENTERED',
                resource: {
                  values: [row]
                }
            });
            //update check_by
            var updateRequest = gapi.client.sheets.spreadsheets.values.update({
                spreadsheetId: spreadsheetId,
                range: sheetName + '!H' + (i +1),
                valueInputOption: 'USER_ENTERED',
                resource: {
                  values: '<?php session_start();echo $_SESSION['username'];?>'
                }
            });
            //update check_date
            var updateRequest = gapi.client.sheets.spreadsheets.values.update({
                spreadsheetId: spreadsheetId,
                range: sheetName + '!J' + (i +1),
                valueInputOption: 'USER_ENTERED',
                resource: {
                  values: <?php echo date('d/m/Y');?>
                }
            });
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



</script>





