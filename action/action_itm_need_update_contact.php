<?php
    session_start();
    include("connect.php");
    include('action_insert_log.php');
    include('action_send_line_api.php');
    date_default_timezone_set("Asia/Bangkok");
    $id = $_POST["id"];
    $sql = "UPDATE add_new_job SET status = 'need update contact' WHERE id=".$id;
    $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
	if($query) {
        //get key
        date_default_timezone_set("Asia/Bangkok");
        $con= mysqli_connect("localhost",$_SESSION["db_username"],$_SESSION["db_password"],"all_in_one_project") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $query = "SELECT  * FROM add_new_job as job
        left join account as account
        ON job.request_username = account.username WHERE job.id = ".$id
        or die("Error:" . mysqli_error($con));
        $result =  mysqli_query($con, $query);
            while($row = mysqli_fetch_array($result)) {
                $key = $row["token_line"];
                $brand = $row["brand"];
                $sku = $row["sku"];
            }
            if($key<>"" and $key<>null){
                sent_line_noti("\n• Change status to need update contact  NS-".$id." [ ".$brand." ".$sku." SKUs ]",$key);
                send_ms_team("NS-".$id,$brand." ".$sku." SKUs","The ticket have been changed the status to -need update contact- ");
            }
        insert_log("Change status to need update contact Ticket = ".date("Y-m-d H:i:s")." \n status = need update contact" ,"add_new_job",$id);
        echo "success ! ".date("Y-m-d H:i:s");
	}else{
        insert_log("Change status to need update contact Ticket faild >".$con->error ,"add_new_job",$id);
        echo 'Error: ' . $sql . '<br>' . $con->error.'';
    }
    mysqli_close($con);
    ?>
