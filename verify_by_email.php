<?php 
    session_start();
$verify_code = htmlspecialchars($_GET['verify_code'],  ENT_QUOTES, 'UTF-8');
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
$con_update= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$sql  = "SELECT username,verify_code from account WHERE verify_code='".$verify_code."'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)) {
 
        $sql_update  = "UPDATE account SET verify_code = 'verified' WHERE verify_code='".$verify_code."'";
        $query_update = mysqli_query($con_update,$sql_update);
        $verify_code = 'verified';
        
   
}
$_SESSION['verify_code'] =$verify_code;
echo $_SESSION['verify_code'] ;
//Header("Location: https://content-service-gate.cdse-commercecontent.com/");
exit();
// echo  $con->error;
// echo $verify_code;

?>