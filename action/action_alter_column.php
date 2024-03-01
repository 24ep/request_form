<?php
    $table = $_POST['table'];
    $db = $_POST['db'];
    $column = $_POST['column'];
    $type = $_POST['type'];

    if($type=='number'){
        $db_type = 'int';
    }elseif($type=='datetime'){
        $db_type = 'DATETIME';
    }else{
        $db_type = 'VARCHAR(255)';
    }

    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $sql = "ALTER TABLE ".$db.".".$table." ADD COLUMN ".$column." ".$db_type;
    $query = mysqli_query($con,$sql);

    if(!$query){
        echo 'Error:'.$con->error;
    }

?>