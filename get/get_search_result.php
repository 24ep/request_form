<?php
session_start();
$input = $_POST['input'];
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$query = "SELECT anj.id , jc.job_number , jc.job_status_filter , anj.status
from all_in_one_project.add_new_job anj 
left join u749625779_cdscontent.job_cms jc 
on jc.csg_request_new_id = anj.id 
where anj.id='".$input."' or jc.job_number like '%".$input."%' 
group by anj.id , jc.job_number , jc.job_status_filter , anj.status" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
    echo "<ul>";
    echo "<li>NS-ID : ".$row['id']."</li>";
    echo "<li>job_number : ".$row['job_number']."</li>";
    echo "</ul>";

}


?>