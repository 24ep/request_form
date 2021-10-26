<?php
$userId = $_POST["userId"];
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
date_default_timezone_set("Asia/Bangkok");
    $sql_gb = "SELECT ac.username,cr.description,cr.title,cr.status,cr.create_date,cr.id  from content_request as cr
    left join account as ac
    on ac.username=cr.request_by WHERE line_user_id ='".$userId."'";
    $query_gb  = mysqli_query($con,$sql_gb);
    while($row = mysqli_fetch_array($query_gb)) {
        $list_cr  .=   '<li class="list-group-item">
        <span><strong> CR-'.$row["id"].'</strong> | '.$row["status"].'</span>
        <small>'.$row["create_date"].'</small>
        </li>';
    }
echo $list_cr;
    
?>

