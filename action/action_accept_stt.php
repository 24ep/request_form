<?php

    session_start();

    include("connect.php");

    include('action_insert_log.php');

    include('action_send_line_api.php');

    date_default_timezone_set("Asia/Bangkok");

    $id = $_POST["id"];

    $sku_accepted = $_POST['sku_accepted'];

    trim($sku_accepted," ");

    $sql = "UPDATE all_in_one_project.add_new_job SET accepted_date = CURRENT_TIMESTAMP , status = 'waiting traffic'  WHERE id=".$id;

        // $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");

    $query = mysqli_query($con,$sql);

	if($query) {



        mysqli_query($con, "SET NAMES 'utf8' ");

        $query = "SELECT  * FROM all_in_one_project.add_new_job as job

        left join all_in_one_project.account as account

        ON job.request_username = account.username WHERE job.id = ".$id

        or die("Error:" . mysqli_error($con));

        $result =  mysqli_query($con, $query);

            while($row = mysqli_fetch_array($result)) {

                $key = $row["token_line"];

                $brand = $row["brand"];

                $sku = $rhttps://phpstack-1225538-4364543.cloudwaysapps.com

                //echo '<script>alert("'.$key.'");</script>';

            }

            if($key<>"" and $key<>null){

                sent_line_noti("\n• Updated  NS-".$id." [ ".$brand." ".$sku." SKUs ]\n----------------------------\n• ตรวจสอบข้อมูลเรียบร้อย งานถูกส่งต่อไปที่ Traffic แล้ว",$key);

                send_ms_team("NS-".$id,$brand." ".$sku." SKUs","ตรวจสอบข้อมูลเรียบร้อย งานถูกส่งต่อไปที่ Traffic แล้ว");

            }

        echo '<script>

        Notiflix.Notify.success("NS-'.$id.' have been accepted");</script>';

        insert_log("send to traffic > accepted_date = ".date("Y-m-d H:i:s")." \n status = waiting traffic" ,"add_new_job",$id);

        echo date("Y-m-d H:i:s");

	}else{

        insert_log("send to traffic faild >".$con->error ,"add_new_job",$id);

        echo '<script>alert("'.'Error: ' . $sql . '<br>' . $con->error.'");</script>';

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

    

