<?php
    session_start();
    include("connect.php");
    include('action_insert_log.php');
    include('action_send_line_api.php');
    include('action_add_participant.php');
    date_default_timezone_set("Asia/Bangkok");
    $id = $_POST["id"];
    $sql = "UPDATE add_new_job SET start_checking_date = CURRENT_TIMESTAMP , status = 'checking',follow_up_by='".$_SESSION['username']."' WHERE id=".$id;
        // $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
	if($query) {
         add_participant($id,"add_new_job");
         //get key
         date_default_timezone_set("Asia/Bangkok");
         $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
         mysqli_query($con, "SET NAMES 'utf8' ");
         $query = "SELECT  * FROM add_new_job as job
         left join account as account
         ON job.request_username = account.username WHERE job.id = ".$id or die("Error:" . mysqli_error($con));
         $result =  mysqli_query($con,$sql);
             while($row = mysqli_fetch_array($result)) {
                 $key = $row["token_line"];
                 $brand = $row["brand"];
                 $sku = $row["sku"];
                 $follow_up = $row["nickname"];
                 $tell = $row["office_tell"];
                 $email = $row["work_email"];
                 //echo '<script>alert("'.$key.'");</script>';
             }
             if($key<>"" and $key<>null){
                 sent_line_noti("\n• Updated NS-".$id." [ ".$brand." ".$sku." SKUs ]\n----------------------------\n• เริ่มทำการตรวจสอบข้อมูล\n• หากมีข้อสงสัยเพิ่มเติม กรุณาติดต่อคุณ  ".$follow_up."\n• tell :".$tell."\n• Email :".$email,$key);
                 send_ms_team("NS-".$id,$brand." ".$sku." SKUs","เริ่มทำการตรวจสอบข้อมูล\n• หากมีข้อสงสัยเพิ่มเติม กรุณาติดต่อคุณ  ".$follow_up."<br>• tell :".$tell."<br>• Email :".$email);
                }
        insert_log("follow-up start checking > start_checking_date = ".date("Y-m-d H:i:s")." \n status = checking \n follow_up_by= ".$_SESSION['username'] ,"add_new_job",$id);
        echo '<script>Notiflix.Notify.success("NS-'.$id.' have been start checking");</script>';
	}else{
        insert_log("follow-up faild >".$con->error ,"add_new_job",$id);
        echo "<script>
        Notiflix.Report.failure(
            'Failure',
            'Error: " . $sql . "<br/><br/>" . $con->error.",
            'Okay',
            )</script>;
        ";
    }
    mysqli_close($con);
    //header( "location: https://cdsecommercecontent.ga/homepage.php");
    ?>
