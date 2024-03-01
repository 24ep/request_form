<?php
    session_start();
    include("connect.php");
    date_default_timezone_set("Asia/Bangkok");
    $sql = "UPDATE all_in_one_project.log SET  nt_readed= concat(nt_readed,',','".$_SESSION['username']."')
	where nt_readable like '%".$_SESSION["username"]."%' and (nt_readed not like '%".$_SESSION['username']."%' or nt_readed is null) and action_by <> '".$_SESSION["username"]."'";
        // $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
    mysqli_close($con);
    //header( "location: https://cdsecommercecontent.ga/homepage.php");
    ?>

