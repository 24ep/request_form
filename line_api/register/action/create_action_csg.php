<?php
 $username = $_POST['name'];
 $tell = $_POST['tell'];
 $dept = $_POST['dept'];
 session_start();
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    date_default_timezone_set("Asia/Bangkok");
    $sql = "insert into account SET ".$attribute_update_name." = '".$attribute_update_value."'  WHERE username='".$username."'";
    $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
	if($query) {
        echo '<div style="  height: 200px;
        width: 400px;
        position: fixed;
        top: 50%;
        left: 50%;
        text-align: center;
        margin-top: -100px;
        margin-left: -200px;"><h6><strong><ion-icon name="checkmark-circle-outline"></ion-icon>Success ! </strong></h6><p>คุณสามารถปิดหน้าต่างนี้เพื่อส่งเริ่มส่งข้อความ</p></div>';
	}else{
        echo '<script>alert("Error: ' . $sql . '\n\n' . $con->error.'")</script>';
    }
    mysqli_close($con);
?>