<?php
 session_start();
$sku = $_POST['sku'];

date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","taxonomy") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");

//update_exsiting_status
$sql = "update taxonomy.taxonomy_raw_f2 set
check_by = '".$_SESSION['username']."',
check_date = CURRENT_TIMESTAMP,
status = 'SKIP'
where sku = '".$sku."'"
or die("Error:" . mysqli_error($con));
$query = mysqli_query($con,$sql);

if($query){
        echo "update completed";
}else{
        echo "error: can't update ,".$con->error.", please contact jaroonwit - sku  ".$sku;
}


?>