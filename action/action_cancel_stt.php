<?php

    session_start();

    include("connect.php");

    include('action_insert_log.php');

    include('action_send_line_api.php');

    date_default_timezone_set("Asia/Bangkok");

    $id = $_POST["id"];

    $resone_cancel = $_POST["resone_cancel"];

    $status_change = $_POST["status_change"];

    $sql = "UPDATE add_new_job SET cancel_resone = '".$_SESSION["username"]." had been ".$status_change." sine of ".$resone_cancel." ".date("Y-m-d H:i:s")."' , status = '".$status_change."',cancel_date = CURRENT_TIMESTAMP  WHERE id=".$id;

        // $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");

    $query = mysqli_query($con,$sql);

	if($query) {

        //get key

        date_default_timezone_set("Asia/Bangkok");

        $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));

        mysqli_query($con, "SET NAMES 'utf8' ");

        $query = "SELECT  * FROM add_new_job as job

        left join account as account

        ON job.request_ushttps://phpstack-1225538-4364543.cloudwaysapps.comjob.id = ".$id

        or die("Error:" . mysqli_error($con));

        $result =  mysqli_query($con, $query);

            while($row = mysqli_fetch_array($result)) {

                $key = $row["token_line"];

                $brand = $row["brand"];

                $sku = $row["sku"];

            }

            if($key<>"" and $key<>null){

                sent_line_noti("\n• '".$status_change."'  NS-".$id." [ ".$brand." ".$sku." SKUs ]",$key);

                //send_ms_team("NS-".$id,$status_change,$brand." ".$sku." SKUs");

            }

        insert_log("'".$status_change."' Ticket = ".date("Y-m-d H:i:s")." \n status = '".$status_change."'" ,"add_new_job",$id);

        echo 'NS-'.$id.' have been cancel already';

	}else{

        insert_log("'".$status_change."' Ticket faild >".$con->error ,"add_new_job",$id);

        echo 'Error: ' . $sql . '<br>' . $con->error.'';

    }

    mysqli_close($con);

    //header( "location: https://cdse-commercecontent.com/homepage.php");

    ?>

