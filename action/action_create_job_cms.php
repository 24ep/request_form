<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/action/action_insert_log.php');

function max_job_by_bu($bu_job) {
    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $query_text = "SELECT MAX(substring(job_number,9,4)) AS max_job FROM `all_in_one_project`.`add_new_job` WHERE  substring(job_number,1,3) ='".$bu_job."' and substring(job_number,4,2) = substring(YEAR(current_timestamp),3,2)";
    $query = mysqli_query($con,$query_text);
    $row = mysqli_fetch_assoc($query);
    $largestNumber = $row["max_job"];
    return $largestNumber;
}

if ($_POST["bu"] == "MSL" || $_POST["bu"] == "MJT") {
    $bu_job = "CDS";
} else {
    $bu_job = $_POST["bu"];
}

$na = max_job_by_bu($bu_job);
$na++;
$job_number_laset = $bu_job.date("y").date("m")."-".str_pad($na, 4, "0", STR_PAD_LEFT);

$con = mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$sql = "UPDATE add_new_job SET
            job_number = '".$job_number_laset."'
        WHERE id = '".$_POST["id"]."'";

$query = mysqli_query($con, $sql);

if ($query) {
    insert_log("Update job_cms with id ".$_POST["id"], "add_new_job", $_POST["id"]);
    echo $job_number_laset." have been updated ";
} else {
    echo 'Error: '.$con->error;
}
