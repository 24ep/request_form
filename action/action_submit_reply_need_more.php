<?php

    session_start();

    date_default_timezone_set("Asia/Bangkok");

    $id = $_POST["id"];

    $need_more_type =  $_POST["need_more_status"]; 

    $need_more_info_note =  $_POST["need_more_info_note"]; 

    $con= mysqli_connect("localhost",cdse_admin,@aA417528639,"all_in_one_project") or die("Error: " . mysqli_error($con));

    mysqli_query($con, "SET NAMES 'utf8' ");

    $sql = "UPDATE add_new_job SET need_more_info_date = CURRENT_TIMESTAMP , status = 'in-review' ,  need_more_info_note = concat(need_more_info_note,'<hr>','".$_SESSION['username']." > ','".$need_more_info_note."  ','<small>',CURRENT_TIMESTAMP,'</small>')  WHERE id=".$id;

    $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");

    $query = mysqli_query($con,$sql);



	if($query) {

        header( "Location: /homepage.php?tab=v-pills-request_list");

	}else{

        echo 'Error: ' . $sql . '<br>' . $con->error.'';

    }

    mysqli_close($con);

    

    ?>

