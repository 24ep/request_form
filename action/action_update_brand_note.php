<?php
    session_start();
    include("connect.php");
    $brand_content = $_POST['brand_content'];
    date_default_timezone_set("Asia/Bangkok");
    $sql = "INSERT INTO all_in_one_project.brand_editor (body,version) VALUES ('".$brand_content."',1) ON DUPLICATE KEY UPDATE body='".$brand_content."',version = version+1";
    $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
    mysqli_close($con);
?>