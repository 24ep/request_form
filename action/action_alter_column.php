<?php
    $table = $_POST['table'];
    $db = $_POST['db'];
    $column = $_POST['column'];
    $type = $_POST['type'];

    if($type=='number'){
        $db_type = 'INT';
    }elseif($type=='datetime'){
        $db_type = 'DATETIME';
    }else{
        $db_type = 'VARCHAR(255)';
    }

    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $sql = "ALTER TABLE ".$db.".".$table." ADD COLUMN ".$column." ".$db_type;
    $query = mysqli_query($con,$sql);

    if(!$query){
        echo 'Error:'.$con->error;
    }

?>