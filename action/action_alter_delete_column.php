<?php
    $table = $_POST['table'];
    $db = $_POST['db'];
    $column = $_POST['column'];


    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $sql = "ALTER TABLE ".$db.".".$table." DROP COLUMN ".$column;
    $query = mysqli_query($con,$sql);

    if(!$query){
        echo 'Error:'.$con->error;
    }

?>