<?php
    session_start();
    // include("connect.php");
    $id = $_POST['id'];
    include('action_insert_log.php');
    $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
         mysqli_query($con, "SET NAMES 'utf8' ");
    date_default_timezone_set("Asia/Bangkok");
    $sql = "UPDATE  all_in_one_project.add_new_job set request_username = '".$_SESSION['username']."'   where id = ".$id;
        // $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
    mysqli_close($con);
    insert_log($uesrname . "have been take an owner of NS-".$id ,"add_new_job",$id);

    echo '
    <ul class="contact-person-ns">
    <li style="margin-top: 5px;">
        <ion-icon name="person-outline"></ion-icon>
        '.$_SESSION['firstname'].' '.substr($_SESSION['lastname'],0,2).' ( '.$_SESSION['nickname'].' ) 
    </li>
    <li style="margin-top: 5px;">
        <ion-icon name="call-outline"></ion-icon> '.$_SESSION['office_tell'].'
    </li>
    <li style="margin-top: 5px;color: #81a8dd;" >
    <a type="button" onclick="take_ns_requester(<?php echo $id;?>)"><ion-icon name="golf-outline"></ion-icon> Take owner </a>
    </li>
</ul>
    
    ';
?>