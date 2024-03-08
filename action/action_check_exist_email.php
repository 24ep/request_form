<?php
 $con= mysqli_connect("service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
 mysqli_query($con, "SET NAMES 'utf8' ");

$query = "SELECT work_email FROM all_in_one_project.account";
$result = mysqli_query($con, $query) or die("Error: " . mysqli_error($con));

// Check if there are rows returned
if (mysqli_num_rows($result) > 0) {
    // Fetch and process the data
  
    echo "exist-email";
} else {
    // No data
    echo "non-exist-email";
}

// Close the database connection
mysqli_close($con);



?>