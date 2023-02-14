<?php
session_start();
$ac_role = $_POST['ac_role'];
$ac_username = $_POST['ac_username'];
$status = $_POST['status'];

//get username
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
$query = "SELECT * FROM all_in_one_project.account where username='".$ac_username."'" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
    $ac_nickname = $row['nickname'];
}

function get_panel_card($primary_key_id,$id,$title,$prefix,$end_key,$status_key,$limit){

    if($id<>null){
        $id = "'".$id."'";
    }
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
    $query = "SELECT
    anj.id as anj_id,
    anj.brand as anj_brand,
    anj.sku as anj_sku,
    anj.launch_date as anj_launch_date,
    anj.create_date as anj_create_date,
    anj.status as anj_status,
    jc.job_status_filter as jc_job_status_filter,
    jc.job_number as jc_job_number,
    CASE
    when TIMESTAMPDIFF( day ,CURRENT_DATE(),anj.launch_date)+1 <= 3 then 0
    when jc.upload_image_date is not null and  TIMESTAMPDIFF( day ,CURRENT_DATE(),anj.launch_date)+1 <= 5  then 1
    when jc.upload_image_date is not null and  anj.launch_date is null and TIMESTAMPDIFF( day ,anj.create_date,CURRENT_DATE())+1 > 10 then 2
    when jc.upload_image_date is not null and  TIMESTAMPDIFF( day ,CURRENT_DATE(),anj.launch_date)+1 < 5 and TIMESTAMPDIFF( day ,anj.create_date,CURRENT_DATE())+1 > 10 then 3
    when TIMESTAMPDIFF( day ,CURRENT_DATE(),anj.launch_date)+1 < 4 then 4
    when anj.launch_date is null and TIMESTAMPDIFF( day ,anj.create_date,CURRENT_DATE())+1 > 9 and lower(anj.project_type ) like '%new%' then 5
    when TIMESTAMPDIFF( day ,CURRENT_DATE(),anj.launch_date)+1 < 10  then 6
    when anj.launch_date is null and TIMESTAMPDIFF( day ,anj.create_date,CURRENT_DATE())+1 > 9 and lower(anj.project_type ) like '%item%' then 7
    when anj.launch_date is not null then 8
    else 9 end as piority
    FROM all_in_one_project.add_new_job as anj
    left join u749625779_cdscontent.job_cms as jc
    on anj.id = jc.csg_request_new_id
    where ".$primary_key_id." = ".$id." and ".$end_key."
    order by piority ASC,anj.launch_date is null ,anj.launch_date ASC,anj.create_date ASC,anj.sku DESC limit ".$limit or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {

        ?>
<div class="p-3 border-bottom rounded shadow-sm bg-white m-2"
    onclick="call_edit_add_new_panel(<?php echo $row['anj_id']; ?>,'<?php echo $row['anj_brand']; ?>')">
    <div class="row">
        <div class="col">
            <ul class="list-group list-group-flush">
                <li class="" style="list-style: none"><strong><?php echo $prefix.$row[$title];?></strong></li>
                <li class="" style="list-style: none"><?php echo $row['anj_brand']." ".$row['anj_sku'];?> SKUs</li>
                <li class="" style="list-style: none"><span><?php echo $row[$status_key];?></span></li>
                <li class="" style="list-style: none"><span><?php echo $row['status'];?></span></li>
            </ul>
        </div>
        <div class="col">
            <?php
        //priority_badge
        $current_day = date("Y-m-d");
        $p_badge="";
        $create_date = date_create($row['anj_create_date']);
        $create_date = date_format($create_date,"Y-m-d");
        // -1 create date > 5
        $create_date_diff = (strtotime($current_day) - strtotime($create_date))/  ( 60 * 60 * 24 );
        if($create_date_diff>=10){
            $p_badge .= '<span class="badge bg-danger bg-gradient shadow-sm rounded p-1 ps-2 pe-2 mb-1" style="margin-left:5px;background-color: #8b47db!important;"><ion-icon name="warning-outline"></ion-icon>Age > '.$create_date_diff.' Days</span>';
        }elseif($create_date_diff>=5){
            $p_badge .= '<span class="badge bg-danger bg-gradient shadow-sm rounded p-1 ps-2 pe-2 mb-1" style="margin-left:5px"> <ion-icon name="warning-outline" style="margin"></ion-icon>Age > '.$create_date_diff.' Days</span>';
        }elseif($create_date_diff>=3){
            $p_badge .= '<span class="badge bg-danger bg-gradient shadow-sm rounded p-1 ps-2 pe-2 mb-1" style="margin-left:5px">Age > '.$create_date_diff.' Days</span>';
        }
        //  launch date
        if($row["anj_launch_date"] <> null){
            $launch_date_c = date_create($row["anj_launch_date"]);
            $launch_date_c = date_format($launch_date_c,"Y-m-d");
            $launch_date_diff = (strtotime($launch_date_c)-strtotime($current_day))/  ( 60 * 60 * 24 );
            if($launch_date_diff<=0){
                $p_badge .= '<span class="badge bg-danger bg-gradient shadow-sm rounded p-1 ps-2 pe-2 mb-1" style="margin-left:5px;background-color: #8b47db!important;"><ion-icon name="warning-outline"></ion-icon> Over Launch '.($launch_date_diff*(-1)).' days</span>';
            }elseif($launch_date_diff<=5){
                $p_badge .= '<span class="badge bg-danger bg-gradient shadow-sm rounded p-1 ps-2 pe-2 mb-1" style="margin-left:5px"><ion-icon name="warning-outline"></ion-icon>Launch in '.$launch_date_diff.' days</span>';
            }
        }
        echo $p_badge;
        ?>
        </div>
    </div>
</div>
<?php
    }
}
//new card algoritum
if($status<>'pending'){
    $ac_nickname = null
}
if($ac_role=='follow'){
    get_panel_card('anj.follow_up_by',$ac_username ,'anj_id','NS-','anj.status = "'.$status.'"','status',100);
}elseif($ac_role=='writer'){
    get_panel_card('jc.content_assign_name',$ac_nickname ,'anj_id','NS-','anj.status = "'.$status.'"','status',100);
}elseif($ac_role=='shooter'){
    get_panel_card('jc.shoot_assign_name',$ac_nickname ,'anj_id','NS-','anj.status = "'.$status.'"','status',100);
}elseif($ac_role=='retoucher'){
    get_panel_card('jc.retouch_assign_name',$ac_nickname ,'anj_id','NS-','anj.status = "'.$status.'"','status',100);
}elseif($ac_role=='product_executive' or $ac_role== 'developer'){
    get_panel_card('1','1' ,'anj_id','NS-','anj.status = "'.$status.'"','status',100);
}elseif($ac_role=='approver'){
    get_panel_card('jc.approved_by',$ac_nickname ,'anj_id','NS-','anj.status = "'.$status.'"','status',100);
}
// //old
// if($status=='inprogress'){
//     if($ac_role=='follow'){
//         get_panel_card('anj.follow_up_by',$ac_username ,'anj_id','NS-','anj.accepted_date is null and anj.status not like "%cancel%" and anj.status not like "%wait%"','status',10);
//     }elseif($ac_role=='writer'){
//         get_panel_card('jc.content_assign_name',$ac_nickname,'jc_job_number','','jc.content_complete_date is null and jc.content_start_date is not null and  jc.job_status_filter not like "%cancel%" and jc.job_status_filter not like "%wait%" and anj.status not like "%wait%"','jc_job_status_filter',10);
//     }elseif($ac_role=='shooter'){
//         get_panel_card('jc.shoot_assign_name',$ac_nickname,'jc_job_number','','jc.shoot_complete_date is null and jc.job_status_filter not like "%cancel%" and jc.job_status_filter not like "%wait%" and anj.status not like "%wait%"','jc_job_status_filter',10);
//     }elseif($ac_role=='retoucher'){
//         get_panel_card('jc.retouch_assign_name',$ac_nickname,'jc_job_number','','jc.retouch_complete_date is null and jc.job_status_filter not like "%cancel%" and jc.job_status_filter not like "%wait%" and anj.status not like "%wait%"','jc_job_status_filter',10);
//     }elseif($ac_role=='product_executive' or $ac_role== 'developer'){
//         get_panel_card('anj.follow_up_by',$ac_username ,'anj_id','NS-','jc.approved_date is null and anj.status not like "%cancel%" and jc.job_status_filter not like "%wait%" and anj.status not like "%wait%" ' ,'anj_status',10);
//     }elseif($ac_role=='approver'){
//         get_panel_card('jc.approved_assign_name',$ac_nickname,'jc_job_number','','jc.approved_date is null and anj.status not like "%cancel%" and jc.job_status_filter not like "%wait%" and anj.status not like "%wait%"' ,'jc_job_status_filter',10);
//     }
// }elseif($status=='pending'){
//     if($ac_role=='follow'){
//         get_panel_card('1', '1','anj_id','NS-','anj.status  like "%pending%"','status',10);
//     }elseif($ac_role=='writer'){
//         get_panel_card('1', '1','jc_job_number','','lower(jc.transfer_type) like "%data%" and jc.job_number is not null and jc.content_start_date is null and jc.job_status_filter not like "%cancel%"','jc_job_status_filter',100);
//     }elseif($ac_role=='shooter'){
//         get_panel_card('1', '1','jc_job_number','','lower(jc.transfer_type) like "%photo%" and jc.job_number is not null and jc.shoot_start_date is null and jc.job_status_filter not like "%cancel%" ','jc_job_status_filter',100);
//     }elseif($ac_role=='retoucher'){
//         get_panel_card('1', '1','jc_job_number','','jc.shoot_complete_date is not null and lower(jc.transfer_type) like "%photo%" and jc.job_number is not null and jc.retouch_start_date is null and jc.job_status_filter not like "%cancel%" ','jc_job_status_filter',100);
//     }elseif($ac_role=='product_executive' or $ac_role== 'developer'){
//         get_panel_card('1', '1','anj_id','NS-','anj.status  like "%pending%" ' ,'anj_status',100);
//     }elseif($ac_role=='approver'){
//         get_panel_card('1','1','jc_job_number','','jc.job_status_filter = "Continue" and (jc.upload_image_date is not null or lower(jc.transfer_type) not like "%photo%") and  (jc.content_complete_date is not null or lower(jc.transfer_type) not like "%data%") and jc.job_number is not null and jc.approved_date is null and anj.status not like "%cancel%" ' ,'jc_job_status_filter',10);
//     }
// }elseif($status=='waiting'){
//     if($ac_role=='follow'){
//         get_panel_card('anj.follow_up_by', $ac_username,'anj_id','NS-','anj.status  like "%wait%"','status',100);
//     }elseif($ac_role=='writer'){
//         get_panel_card('jc.content_assign_name',$ac_nickname,'jc_job_number','','  (jc.job_status_filter  like "%wait%" or anj.status  like "%wait%")','jc_job_status_filter',100);
//     }elseif($ac_role=='shooter'){
//         get_panel_card('jc.shoot_assign_name',$ac_nickname,'jc_job_number','','(jc.job_status_filter  like "%wait%" or anj.status  like "%wait%" )','jc_job_status_filter',100);
//     }elseif($ac_role=='retoucher'){
//         get_panel_card('jc.retouch_assign_name',$ac_nickname,'jc_job_number','',' (jc.job_status_filter  like "%wait%" or anj.status  like "%wait%" )','jc_job_status_filter',100);
//     }elseif($ac_role=='product_executive' or $ac_role== 'developer'){
//         get_panel_card('anj.follow_up_by',$ac_username,'anj_id','NS-','anj.status  like "%wait%" ' ,'anj_status',100);
//     }elseif($ac_role=='approver'){
//         get_panel_card('jc.approved_by',$ac_nickname,'jc_job_number','',' (jc.job_status_filter  like "%wait%" or anj.status nt like "%wait%") ' ,'jc_job_status_filter',100);
//     }
// }
// elseif($status=='revise'){
//     if($ac_role=='follow'){
//         //get_panel_card('1', '1','anj_id','NS-','anj.status  like "%wait%"','status',100);
//     }elseif($ac_role=='writer'){
//         get_panel_card('anj.follow_up_by', $ac_username,'jc_job_number','','  (jc.job_status_filter  like "%Continue%" and jc.approved_editing_status like "content_editing" )','jc_job_status_filter',100);
//     }elseif($ac_role=='shooter'){
//         //get_panel_card('1', '1','jc_job_number','','(jc.job_status_filter  like "%wait%" or anj.status  like "%wait%" )','jc_job_status_filter',100);
//     }elseif($ac_role=='retoucher'){
//         get_panel_card('1', '1','jc_job_number','',' (jc.job_status_filter  like "%Continue%" and jc.approved_editing_status like "studio_editing" )','jc_job_status_filter',100);
//     }elseif($ac_role=='product_executive' or $ac_role== 'developer'){
//         get_panel_card('1', '1','anj_id','NS-','jc.job_status_filter  like "%Continue%" and jc.approved_editing_status like "%editing%" ' ,'anj_status',100);
//     }elseif($ac_role=='approver'){
//         get_panel_card('1','1','jc_job_number','',' (jc.job_status_filter  like "%Continue%" and jc.approved_editing_status like "content_editing") ' ,'jc_job_status_filter',100);
//     }
// }
// elseif($status=='revised'){
//     if($ac_role=='follow'){
//         //get_panel_card('1', '1','anj_id','NS-','anj.status  like "%wait%"','status',100);
//     }elseif($ac_role=='writer'){
//         get_panel_card('1', '1','jc_job_number','','  (jc.job_status_filter  like "%Continue%" and jc.approved_editing_status like "edited" )','jc_job_status_filter',100);
//     }elseif($ac_role=='shooter'){
//         //get_panel_card('1', '1','jc_job_number','','(jc.job_status_filter  like "%wait%" or anj.status  like "%wait%" )','jc_job_status_filter',100);
//     }elseif($ac_role=='retoucher'){
//         get_panel_card('1', '1','jc_job_number','',' (jc.job_status_filter  like "%Continue%" and jc.approved_editing_status like "edited" )','jc_job_status_filter',100);
//     }elseif($ac_role=='product_executive' or $ac_role== 'developer'){
//         get_panel_card('1', '1','anj_id','NS-','jc.job_status_filter  like "%Continue%" and jc.approved_editing_status like "edited"' ,'anj_status',100);
//     }elseif($ac_role=='approver'){
//         get_panel_card('1','1','jc_job_number','',' (jc.job_status_filter  like "%Continue%" and jc.approved_editing_status like "edited") ' ,'jc_job_status_filter',100);
//     }
// }


?>