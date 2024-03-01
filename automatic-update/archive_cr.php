<?php
    session_start();
    include("connect.php");
    date_default_timezone_set("Asia/Bangkok");
    $sql = "update content_request set status = 'archive' where CURRENT_DATE() - date(complete_date) > 30 ";
        // $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
    mysqli_close($con);
?>
