<?php
session_start();
$input = $_POST['input'];
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
//---
$query = "SELECT anj.id  from all_in_one_project.add_new_job anj where anj.id='".$input."'" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
echo "<ul>";
while($row = mysqli_fetch_array($result)) {
    echo "<li>NS-ID : ".$row['id']."</li>";
}
//---
$query = "SELECT jc.job_number from u749625779_cdscontent.job_cms jc where jc.job_number like '%".$input."%'" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
    echo "<li>Job Number : ".$row['job_number']."</li>";
}
echo "</ul>";


?>