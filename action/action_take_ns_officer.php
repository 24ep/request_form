<?php
    session_start();
    include("connect.php");
    $id = $_POST['id'];
    include('action_insert_log.php');

    date_default_timezone_set("Asia/Bangkok");
    $sql = "UPDATE  all_in_one_project.add_new_job set follow_up_assign_name = '".$_SESSION['username']."',follow_up_assign_date = CURRENT_TIMESTAMP  where id = ".$id;
        // $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
    mysqli_close($con);
    insert_log($uesrname . "have been take an officer of NS-".$id ,"add_new_job",$id);

    echo '
    <ul class="contact-person-ns">
    <li style="margin-top: 5px;">
        <ion-icon name="person-outline"></ion-icon>
        '.$_SESSION['firstname'].' '.substr($_SESSION['lastname'],0,2).' ( '.$_SESSION['nickname'].' ) 
    </li>
    <li style="margin-top: 5px;">
        <ion-icon name="call-outline"></ion-icon> '.$_SESSION['office_tell'].'
    </li>
</ul>
    
    ';
?>