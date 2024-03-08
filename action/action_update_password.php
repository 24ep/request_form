<?php

$password_encode = md5(strrev(md5(str_replace(2,4,str_replace(strpos( substr(md5($_POST['password']),2,1),md5($_POST['password'])),strpos( substr(md5($_POST['password']),4,1),md5($_POST['password'])),md5($_POST['password']))))));
$con = mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com", "avnadmin", "AVNS_lAORtpjxYyc9Pvhm5O4", "all_in_one_project", "10628") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$sql  = "UPDATE account SET password = '".$password_encode."',verify_code='verified' WHERE work_email='".$_POST['email']."'";
$query = mysqli_query($con,$sql);
if($query){
    echo 'password-changed';
}else{
    echo 'error';
}


?>