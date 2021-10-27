<?php
$userId = $_POST["userId"];
$additional_condition = $_POST["additional_condition"];
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
date_default_timezone_set("Asia/Bangkok");
    $sql_gb = "SELECT ac.username,cr.description,cr.title,cr.status,cr.create_date,cr.id  from content_request as cr
    left join account as ac
    on ac.username=cr.request_by WHERE line_user_id ='".$userId."' ".$additional_condition;
    $query_gb  = mysqli_query($con,$sql_gb);
    while($row = mysqli_fetch_array($query_gb)) {

        if($row["status"]=='Pending'){
            $icon_status = "ticket-outline";
        }elseif($row["status"]=='Inprogress'){
            $icon_status = "reload-circle-outline";
        }elseif($row["status"]=='Waiting Buyer'){
            $icon_status = "warning-outline";
        }elseif($row["status"]=='Waiting Execution'){
            $icon_status = "stopwatch-outline";
        }elseif($row["status"]=='Waiting CTO'){
            $icon_status = "bug-outline";
            
        }elseif($row["status"]=='Close'){
            $icon_status = "checkmark-outline";
        }else{
            $icon_status = "chevron-forward-outline";
        }

        $pre_detail_request =  substr($row["description"],0,45);
        $list_cr  .=   '<li class="list-group-item"><div class="row">
        <div class="col-1" style="margin-right:5px">
        <ion-icon style="font-size: 25px;margin-top:10px;" name="'.$icon_status.'"></ion-icon>
        </div>
        <div class="col-9">
        <span style="font-size:13px"><strong style="color:red"> CR-'.$row["id"].'</strong> | <span style="
        background: bisque;
        padding: 0px 10px 0px 10px;
        font-weight:600
    "> '.$row["status"].'</span></span><br>
        <span style="font-size:11px">'.$pre_detail_request.'...<span>
        <br><small style="color:#b8aeae:font-size:11px">create date : '.$row["create_date"].'</small>
        </div >
        <div class="col-2" style="margin-left:-10px">
        <a href="https://content-service-gate.cdsecommercecontent.ga/line_api/register/form/content_request_detail.php?id='.$row["id"].'">
            <ion-icon style="font-size: 30px;margin-top:5px" name="chevron-forward-outline"></ion-icon>
            </a>
        </div>
        </div>
        </li>';
    }
echo $list_cr;
    
?>

