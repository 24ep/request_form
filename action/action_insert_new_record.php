<?php
    $table = $_POST['table'];
    $db = $_POST['db'];
    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $sql = "INSERT INTO ".$db.".".$table." (id) VALUES (default)";
    $query = mysqli_query($con,$sql);

    $last_id = $con->insert_id;
    echo $last_id;

?>