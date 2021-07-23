<?php
    function get_badge_message_important(){
        $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $query = "SELECT count(*) as total FROM target_message_box where readable = 0 and target_username = '".$_SESSION["username"]."'" or die("Error:" . mysqli_error());
        $result = mysqli_query($con, $query);
        $data = mysqli_fetch_assoc($result);
        return $data['total'];
    
    }

    $total_unread = get_badge_message_important();
    if(isset($total_unread)){
        echo "<span class='badge bg-danger'>".$total_unread."</span>";
    }
?>