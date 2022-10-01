<?php
session_start();
$input = $_POST['input'];
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$query = "SELECT  sl.sku , anj.id , jc.job_number , jc.job_status_filter , jc.status
FROM all_in_one_project.sku_list as sl
left join all_in_one_project.add_new_job anj 
on sl.csg_id = anj.id 
left join u749625779_cdscontent.job_cms jc 
on jc.csg_request_new_id = anj.id 
where anj.id=".$input." or jc.job_number like '%".$input."%' or sl.sku like '%".$input."%'" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
    $sku = $row['sku']; 
    $id = $row['id']; 
    $job_number = $row['job_number']; 

}
echo "<ul>";
echo "<li>SKU : ".$sku."</li>";
echo "<li>NS-ID : ".$id."</li>";
echo "<li>job_number : ".$job_number."</li>";
echo "</ul>";

?>