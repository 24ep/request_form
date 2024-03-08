<?php
$con = mysqli_connect("service-gate.a.aivencloud.com", "avnadmin", "AVNS_lAORtpjxYyc9Pvhm5O4", "all_in_one_project", "10628") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");

$query = "SELECT COUNT(work_email) AS email_count FROM all_in_one_project.account";
$result = mysqli_query($con, $query) or die("Error: " . mysqli_error($con));

// Fetch the count from the result set
$row = mysqli_fetch_assoc($result);
$emailCount = $row['email_count'];

if ($emailCount > 0) {
    echo "exist-email";
} else {
    echo "non-exist-email";
}

// Close the database connection
mysqli_close($con);
?>
