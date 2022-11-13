<?php
    session_start();
    include("connect.php");
    $dataoutput = base64_decode($_POST['dataoutput']'');
    $id = $_POST['id'];

    date_default_timezone_set("Asia/Bangkok");
    $sql = "UPDATE  all_in_one_project.brand_editor set body = '".$dataoutput."'  , update_by='".$_SESSION['username']."',version = version+1 , update_date = current_timestamp where id = ".$id;
    $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
    mysqli_close($con);
?>