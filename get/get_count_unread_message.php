<?php
session_start();
    function get_badge_message_important(){
        $con= mysqli_connect("localhost",$_SESSION["db_username"],$_SESSION["db_password"],"all_in_one_project") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $query = "SELECT count(*) as total FROM target_message_box where readable = 0 and target_username = '".$_SESSION["username"]."'" or die("Error:" . mysqli_error($con));
        $result = mysqli_query($con, $query);
        $data = mysqli_fetch_assoc($result);
        return $data['total'];
    
    }

    $total_unread = get_badge_message_important();
    if(isset($total_unread) and $total_unread <>0){
        echo "<span class='badge bg-danger'>".$total_unread."</span>";
    }else{
        echo "";
    }
?>