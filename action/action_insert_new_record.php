<?php
    $table = $_POST['table'];
    $db = $_POST['db'];
    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $sql = "INSERT INTO ".$db.".".$table." (id) VALUES (default)";
    $query = mysqli_query($con,$sql);

    $last_id = $con->insert_id;
    echo $last_id;

?>