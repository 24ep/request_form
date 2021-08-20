<?php
    session_start();
    include("connect.php");
    include('action_insert_log.php');
    include('action_send_line_api.php');
    date_default_timezone_set("Asia/Bangkok");
    $id = $_POST["id"];
    $sku_accepted = $_POST['sku_accepted'];
    $sql = "UPDATE add_new_job SET accepted_date = CURRENT_TIMESTAMP , status = 'waiting traffic'  WHERE id=".$id;
    $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
	if($query) {

        date_default_timezone_set("Asia/Bangkok");
        $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));

        $sku_accepted_array = explode("\n", $sku_accepted);
        $sku_list_array = array();
        foreach ($sku as $sku_accepted_array) {
            array_push($sku_list_array,"('".$sku ."','".$_SESSION['username'] ."',".$id .")");
        }

        $sku_list = implode(',',$sku_list_array);

        $sql = "INSERT INTO sku_list (
            sku,create_by,csg_id )
        VALUES 
            ".$sku_list.";";

        $query = mysqli_query($con,$sql);

        //get key
        
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
                sent_line_noti("\n• Updated  NS-".$id." [ ".$brand." ".$sku." SKUs ]\n----------------------------\n• ตรวจสอบข้อมูลเรียบร้อย งานถูกส่งต่อไปที่ Traffic แล้ว",$key);
            }
        insert_log("send to traffic > accepted_date = ".date("Y-m-d H:i:s")." \n status = waiting traffic" ,"add_new_job",$id);
        echo date("Y-m-d H:i:s");
	}else{
        insert_log("send to traffic faild >".$con->error ,"add_new_job",$id);
        echo 'Error: ' . $sql . '<br>' . $con->error.'';
    }
    mysqli_close($con);
    //header( "location: https://cdsecommercecontent.ga/request_form/homepage.php");
    ?>
