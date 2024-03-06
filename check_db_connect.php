<?php



error_reporting(E_ALL);

ini_set('display_errors', 1);



$host = "service-gate-cds-omni-service-gate.a.aivencloud.com";

$username = "avnadmin";

$password = "AVNS_lAORtpjxYyc9Pvhm5O4";

$database = "all_in_one_project";



// Create a connection

$con = mysqli_connect($host, $username, $password, $database,"10628");



// Check the connection

if (!$con) {

    die("Connection failed: " . mysqli_connect_error());

}



// Set the character set

if (!mysqli_set_charset($con, 'utf8')) {

    die("Error setting character set: " . mysqli_error($con));

}



echo "Connected successfully";



// Example query

$sql = "SELECT * FROM all_in_one_project.account LIMIT 5";

$result = mysqli_query($con, $sql);



// Check if the query was successful

if ($result) {

    // Fetch and display the data

    while ($row = mysqli_fetch_assoc($result)) {

        echo "ID: " . $row["id"];

    }



    // Free the result set

    mysqli_free_result($result);

} else {

    // If the query fails, print the error

    echo "Query failed: " . mysqli_error($con);

}



// Close the connection

mysqli_close($con);

?>

