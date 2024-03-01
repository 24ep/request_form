<?php
    session_start();
    include("connect.php");
    $dataoutput = $_POST['dataoutput'];
    $brand = $_POST['brand'];
    date_default_timezone_set("Asia/Bangkok");
    $sql = "INSERT INTO all_in_one_project.brand_editor (body,version,brand) VALUES ('".$dataoutput."',1,'".$brand."') ON DUPLICATE KEY UPDATE body='".$dataoutput."',version = version+1,update_date=current_timestamp(),update_by='".$_SESSION['username']."'";
        // $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
    mysqli_close($con);
?>