<?php
    session_start();
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
    $lastest_message_id = $_POST["message_id"];
    $ticket_id = $_POST["ticket_id"];
    date_default_timezone_set("Asia/Bangkok");
    $sql = "UPDATE add_new_job SET mail_lastest_message_id = $lastest_message_id  WHERE id=".$ticket_id;
    $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
    mysqli_close($con);
    ?>
