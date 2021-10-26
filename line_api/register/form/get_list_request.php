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
        $list_cr  .=   '<li class="list-group-item">\
        <div class="col-10">
        <span><strong style="color:red"> CR-'.$row["id"].'</strong> | <span style="
        background: bisque;
        padding: 0px 5px 0px 5px;
        font-weight:600
    "> '.$row["status"].'</span></span>
        <br><small style="color:#b8aeae:font-size:11px">Created : '.$row["create_date"].'</small>
        </div>
        <div class="col-2">
        <ion-icon name="chevron-forward-outline"></ion-icon>
        </div>
        </li>';
    }
echo $list_cr;
    
?>

