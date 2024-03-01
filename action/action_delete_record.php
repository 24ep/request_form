<?php
    $table = $_POST['table'];
    $db = $_POST['db'];
    $id = $_POST['id'];
    $primary_key_id = $_POST['primary_key_id'];
    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $sql = "DELETE FROM ".$db.".".$table." where ".$primary_key_id." = ".$id;
    $query = mysqli_query($con,$sql);
    if($query){
        echo $id;
    }else{
        echo 'Error : '.$sql." ".$con->error;
    }
    // $last_id = $con->insert_id;
     

?>