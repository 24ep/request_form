<?php
session_start();
$ac_role = $_POST['ac_role'];
$ac_username = $_POST['ac_username'];
$ac_nickname = $_POST['ac_nickname'];
function get_panel_card($database,$table,$primary_key_id,$id,$title,$prefix,$end_key,$status_key,$create_key){
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
    $query = "SELECT ".$title.",brand,sku,id,".$status_key.",".$create_key." FROM ".$database.".".$table." where ".$primary_key_id." = '".$id."' and ".$end_key."
    order by id ASC limit 10" or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
        
         ?>
<div class="p-3 border-bottom">
    <div class="row">
        <div class="col">
            <ul class="list-group list-group-flush">
                <li class="" style="list-style: none"><strong><?php echo $prefix.$row[$title];?></strong></li>
                <li class="" style="list-style: none"><?php echo $row['brand']." ".$row['sku'];?> SKUs</li>
                <li class="" style="list-style: none"><span><?php echo $row[$status_key];?></span></li>
            </ul>
        </div>
        <div class="col">
            <?php 
                            //priority_badge
                                $current_day = date("Y-m-d");
                                $p_badge="";
                                $create_date = date_create($row[$create_key]);
                                $create_date = date_format($create_date,"Y-m-d");
                                // -1 create date > 5
                                $create_date_diff = (strtotime($current_day) - strtotime($create_date))/  ( 60 * 60 * 24 );
                                if($create_date_diff>=10){
                                $p_badge .= '<span class="badge bg-danger bg-gradient p-2 mb-1" style="margin-left:5px;background-color: #46088f!important;"><ion-icon name="warning-outline"></ion-icon>Age > '.$create_date_diff.' Days</span>';
                                }elseif($create_date_diff>=5){
                                $p_badge .= '<span class="badge bg-danger bg-gradient p-2 mb-1" style="margin-left:5px"> <ion-icon name="warning-outline" style="margin"></ion-icon>Age > '.$create_date_diff.' Days</span>';
                                }elseif($create_date_diff>=3){
                                $p_badge .= '<span class="badge bg-warning bg-gradient p-2 mb-1" style="margin-left:5px">Age > '.$create_date_diff.' Days</span>';
                                }
                                //  launch date
                                if($row["launch_date"] <> null){
                                $launch_date_c = date_create($row["launch_date"]);
                                $launch_date_c = date_format($launch_date_c,"Y-m-d");
                                $launch_date_diff = (strtotime($launch_date_c)-strtotime($current_day))/  ( 60 * 60 * 24 );
                                    if($launch_date_diff<=0){
                                    $p_badge .= '<span class="badge bg-danger bg-gradient  p-2 mb-1" style="margin-left:5px;background-color: #46088f!important;"><ion-icon name="warning-outline"></ion-icon> Over Launch '.($launch_date_diff*(-1)).' days</span>';
                                    }elseif($launch_date_diff<=5){
                                        $p_badge .= '<span class="badge bg-danger bg-gradient  p-2 mb-1" style="margin-left:5px"><ion-icon name="warning-outline"></ion-icon>Launch in '.$launch_date_diff.' days</span>';
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
if($status=='inprogress'){
    if($ac_role=='follow'){
        get_panel_card('all_in_one_project','add_new_job','follow_up_by',$ac_username ,'id','NS-','accepted_date is null ','status','recive_mail_date');
    }elseif($ac_role=='writer'){
        get_panel_card('u749625779_cdscontent','job_cms','content_assign_name',$ac_nickname,'job_number','','content_complete_date is null ','job_status_filter','recive_mail_date');
    }elseif($ac_role=='shooter'){
        get_panel_card('u749625779_cdscontent','job_cms','shoot_assign_name',$ac_nickname,'job_number','','shoot_complete_date is null ','job_status_filter','recive_mail_date');
    }elseif($ac_role=='retoucher'){
        get_panel_card('u749625779_cdscontent','job_cms','retouch_assign_name',$ac_nickname,'job_number','','retouch_complete_date is null ','job_status_filter','recive_mail_date');
    }elseif($ac_role=='product_executive'){
        get_panel_card('all_in_one_project','add_new_job','follow_up_by',$ac_username ,'id','NS-','accepted_date is null' ,'status','recive_mail_date');
    }
}elseif($status=='pending'){

}


?>