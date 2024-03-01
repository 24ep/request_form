<?php
    session_start();
    include("connect.php");
    include('action_insert_log.php');
    include('action_send_line_api.php');
    date_default_timezone_set("Asia/Bangkok");
    $id = $_POST["id"];
    $new_contact_vender = $_POST["new_contact_vender"];
    $new_contact_buyer = $_POST["new_contact_buyer"];
    $sql = "UPDATE add_new_job SET status = 'pending',contact_buyer = '".$new_contact_buyer."',contact_vender = '".$new_contact_vender."' WHERE id=".$id;
        // $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
	if($query) {
        //get key
        date_default_timezone_set("Asia/Bangkok");
        $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
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
                //echo '<script>alert("'.$key.'");</script>';
            }
            if($key<>"" and $key<>null){
                sent_line_noti("\n• Get new contact - change status to pending  NS-".$id." [ ".$brand." ".$sku." SKUs ]",$key);
                send_ms_team("NS-".$id,$brand." ".$sku." SKUs","<strong>Get new contact</strong> - change status to pending");
            }
        insert_log("Get new contact - change status to pending  Ticket = ".date("Y-m-d H:i:s")." \n status = need to update contact" ,"add_new_job",$id);
        echo '<script>Notiflix.Notify.success("NS-'.$id.' : Get new contact - change status to pending ");</script>';
	}else{
        insert_log("Get new contact - change status to pending  Ticket faild >".$con->error ,"add_new_job",$id);
        echo "<script>
        Notiflix.Report.failure(
            'Failure',
            'Error: " . $sql . "<br/><br/>" . $con->error.",
            'Okay',
            )</script>;
        ";
    }
    mysqli_close($con);
    //header( "location: https://cdse-commercecontent.com/homepage.php");
    ?>
