<?php
session_start();
$input = $_POST['input'];
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
//---
$query = "SELECT anj.id , anj.brand , anj.job_number from all_in_one_project.add_new_job anj where lower(anj.job_number) like lower('%".$input."%')  or lower(anj.brand) like lower('%".$input."%') or anj.id='".$input."' or concat('CR-',anj.id) = '".$input."'" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
echo "<ul style='list-style: unset;padding: 0px;font-weight: bold;color: #1b2c52;'>";
while($row = mysqli_fetch_array($result)) {
    echo "<li class='p-2 bg-light shadow-sm m-1'>NS-".$row['id']." ".$row['brand']."  <ion-icon type='button'  class='btn btn-outline-dark border-0 btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModal' onclick='call_model_edit_add_new(&#39;".$row['id']."&#39)' name='open-outline'>  </li>";
}
$query = "SELECT cr.id,cr.title from all_in_one_project.content_request cr where cr.id = '".$input."' or concat('CR-',cr.id) = '".$input."' or cr.title like '%".$input."%'  limit 10" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
    echo "<li class='p-2 bg-light shadow-sm m-1' >CR-".$row['id']." ".$row['title']."  <ion-icon type='button'  class='btn btn-outline-dark border-0 btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModal' onclick='call_model_edit_content_request(&#39;".$row['id']."&#39)' name='open-outline'>  </li>";
}
//---
$query = "SELECT sl.sku,sl.csg_id from all_in_one_project.sku_list sl where sl.sku = '".$input."' limit 3" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
    echo "<li class='p-2 bg-light shadow-sm m-1'>SKU : ".$row['sku']." <ion-icon type='button'  class='btn btn-outline-dark border-0 btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModal' onclick='call_model_edit_add_new(&#39;".$row['csg_id']."&#39)' name='open-outline'>  </li>";
}
echo "</ul>";
?>