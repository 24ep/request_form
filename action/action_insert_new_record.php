<?php
    $table = $_POST['table'];

    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $sql = "INSERT INTO ".$table." VALUES (default)";
    $query = mysqli_query($con,$sql);
    
    $last_id = $con->insert_id;
    echo $last_id;

?>