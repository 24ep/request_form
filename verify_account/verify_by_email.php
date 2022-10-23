<?php 
    session_start();
$username = $_GET['username'];
$verify_code = $_GET['verify_code'];
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$sql  = "SELECT username,verify_code from account WHERE username='".$username."'";
$query = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)) {
    if($row['verify_code']==$verify_code){
        $sql_update  = "UPDATE account SET verify_code = 'verified' WHERE username='".$username."'";
        $query_update = mysqli_query($con,$sql_update);
        if($query_update){
        // echo 'verify complete';
        $_SESSION['verify_code'] = 'verified';
        Header("Location: https://content-service-gate.cdse-commercecontent.com/");
        }else{
            echo  $con->error;
        }
    }else{
        echo  $con->error;
        echo 'verify uncomplete';
    }
}
echo  $con->error;
echo $sql;

?>