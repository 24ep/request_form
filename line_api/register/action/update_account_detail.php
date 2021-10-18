<?php
 $username = $_POST['username'];
 $attribute_update_name = $_POST['attribute_update_name'];
 $attribute_update_value = $_POST['attribute_update_value'];
 $pictureUrl = $_POST['pictureUrl'];
 session_start();
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    date_default_timezone_set("Asia/Bangkok");
    $sql = "UPDATE account SET ".$attribute_update_name." = '".$attribute_update_value."',profile_url = '". $pictureUrl."'  WHERE username='".$username."'";
    $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
	if($query) {
        $sql_gb = "SELECT * from  all_in_one_project.account WHERE username='".$username."'";
        $query_gb  = mysqli_query($con,$sql_gb);
        while($row = mysqli_fetch_array($query_gb)) {
            $id = $row["id"];
            $tell = $row["office_tell"];
            $dept = $row["department"];

        }
        echo '<div style="  height: 200px;
        width: 400px;
        position: fixed;
        top: 50%;
        left: 50%;
        text-align: center;
        margin-top: -100px;
        margin-left: -200px;"><h6><strong><ion-icon name="checkmark-circle-outline"></ion-icon>Success ! </strong></h6><p>คุณสามารถปิดหน้าต่างนี้เพื่อส่งเริ่มส่งข้อความ</p></div>';
        include("https://content-service-gate.cdsecommercecontent.ga/line_api/register/action/send_bubble_register.php");
        bubble_register($id ,$username,$tell,$dept,"Connected !");
	}else{
        echo '<script>alert("Error: ' . $sql . '\n\n' . $con->error.'")</script>';
    }
    mysqli_close($con);
?>