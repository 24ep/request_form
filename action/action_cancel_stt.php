<?php
    session_start();
    include("connect.php");
    include('action_insert_log.php');
    include('action_send_line_api.php');
    date_default_timezone_set("Asia/Bangkok");
    $id = $_POST["id"];
    $resone_cancel = $_POST["resone_cancel"];
    $status_change = = $_POST["status_change"];
    $sql = "UPDATE add_new_job SET cancel_resone = '".$_SESSION["username"]." has ".$resone_cancel.date("Y-m-d H:i:s")."' , status = '".$status_change."'  WHERE id=".$id;
    $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
	if($query) {
        //get key
        date_default_timezone_set("Asia/Bangkok");
        $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $query = "SELECT  * FROM add_new_job as job
        left join account as account
        ON job.request_username = account.username WHERE job.id = ".$id
        or die("Error:" . mysqli_error());
        $result =  mysqli_query($con, $query);
            while($row = mysqli_fetch_array($result)) {
                $key = $row["token_line"];
                $brand = $row["brand"];
                $sku = $row["sku"];
                //echo '<script>alert("'.$key.'");</script>';
            }
            if($key<>"" and $key<>null){
                sent_line_noti("\n• Cancel  NS-".$id." [ ".$brand." ".$sku." SKUs ]",$key);
            }
        insert_log("Cancel Ticket = ".date("Y-m-d H:i:s")." \n status = cancel" ,"add_new_job",$id);
        echo date("Y-m-d H:i:s");
	}else{
        insert_log("Cancel Ticket faild >".$con->error ,"add_new_job",$id);
        echo 'Error: ' . $sql . '<br>' . $con->error.'';
    }
    mysqli_close($con);
    //header( "location: https://cdsecommercecontent.ga/request_form/homepage.php");
    ?>
