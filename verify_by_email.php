<?php 
    session_start();
$verify_code = htmlspecialchars($_GET['verify_code'],  ENT_QUOTES, 'UTF-8');
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
$con_update= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");

$sql_update  = "UPDATE account SET verify_code = 'verified' WHERE verify_code='".$verify_code."'";
$query_update = mysqli_query($con_update,$sql_update);

if($query_update ){
    $verify_code_verified = 'verified';
    $_SESSION['verify_code'] = $verify_code_verified;
    Header("Location: https://content-service-gate.cdse-commercecontent.com/");
    exit();
}else{
    echo $con->error;
}


// echo  $con->error;
// echo $verify_code;

?>