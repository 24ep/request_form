<?php
    $table = $_POST['table'];
    $db = $_POST['db'];
    $id = $_POST['id'];
    $primary_key_id = $_POST['primary_key_id'];
    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $sql = "DELETE FROM ".$db.".".$table." where ".$primary_key_id." = ".$id."";
    $query = mysqli_query($con,$sql);

    // $last_id = $con->insert_id;
     echo $id;

?>