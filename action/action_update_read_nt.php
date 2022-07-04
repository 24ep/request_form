<?php
    session_start();
    include("connect.php");
    date_default_timezone_set("Asia/Bangkok");
    $id = $_POST["id"];
    $sql = "UPDATE all_in_one_project.log
	SET  nt_readed= concat(nt_readed,',','".$_SESSION['username']."')
	WHERE (log.nt_readable like '%".$_SESSION['username']."%' and   log.action_by <> '".$_SESSION['username']."' ) 
    and log.action_by <> '".$_SESSION['username']."'";
    $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
    mysqli_close($con);
    //header( "location: https://cdsecommercecontent.ga/base/homepage.php");
    ?>
