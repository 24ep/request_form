<?php
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");

$message_id = $_POST["message_id"];
$query = "SELECT mail_message_id FROM add_new_job where mail_message_id=".$message_id or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
 
while($row = mysqli_fetch_array($result)) {
    // ad comment note
    // $query_comment = "SELECT mail_message_id FROM add_new_job where mail_message_id=".$message_id or die("Error:" . mysqli_error($con));
    // $result_comment = mysqli_query($con, $query_comment);

}

?>