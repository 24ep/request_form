<?php
function badge_status($status){
    if($status=="pending"){
      $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm status-pending" style="min-width: 115px;">pending</span>';
    }elseif($status=="checking"  ){
      $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm status-checking" style="min-width: 115px;">checking</span>';
    }elseif( $status=="on-productions"){
      $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm status-on-productions" style="min-width: 115px;">on-productions</button>';
    }elseif($status=="approved"){
      $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm status-approved" style="min-width: 115px;">approved</button>';
    }elseif($status=="waiting confirm"){
      $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm status-waiting-confirm" style="min-width: 115px;">waiting confirm</span>';
    }elseif($status=="waiting image"){
      $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm status-waiting-image" style="min-width: 115px;">waiting image</button>';
    }elseif($status=="waiting data"){
      $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm status-waiting-data" style="min-width: 115px;">waiting data</button>';
    }elseif($status=="waiting traffic"){
      $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm status-waiting-traffic" style="min-width: 115px;">waiting traffic</button>';
    }elseif($status=="cancel"){
      $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm status-cancel" style="min-width: 115px;">Cancel</button>';
    }else{
      $status = '<span type="button" class="badge rounded p-2 ps-3 pe-3 mb-1 ml-1 shadow-sm status-other" style="min-width: 115px;">'.$status.'</span>';
    }
    return $status;
  }
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
//
function get_panel_card($primary_key_id,$id,$end_key,$limit){
    if($id=='null'){
        $person_key = $primary_key_id." is null ";

    }
    else{
        $person_key = $primary_key_id." = '".$id."'";
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
    else 9 end as priority
    FROM all_in_one_project.add_new_job as anj
    left join u749625779_cdscontent.job_cms as jc
    on anj.id = jc.csg_request_new_id
    where (".$person_key.") and (".$end_key.")
    order by priority ASC,anj.launch_date is null ,anj.launch_date ASC,anj.create_date ASC,anj.sku DESC limit ".$limit or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $query);
    echo $person_key." and ".$end_key;
    while($row = mysqli_fetch_array($result)) {
        ?>
<div class="p-3 border-bottom rounded shadow-sm bg-white m-2"
    onclick="call_edit_add_new_panel(<?php echo $row['anj_id']; ?>,'<?php echo $row['anj_brand']; ?>')">
    <div class="row">
        <div class="col">
            <ul class="list-group list-group-flush">
                <li class="" style="list-style: none"><strong><?php echo 'NS-'.$row['anj_id'];?></strong></li>
                <li class="" style="list-style: none"><?php echo $row['anj_brand']." ".$row['anj_sku'];?> SKUs</li>
                <li class="" style="list-style: none"><span><?php echo badge_status($row['anj_status']);?></span></li>
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
        $p_badge .= '<span class="badge rounded p-1 ps-3 pe-3 mb-1 ml-1 modern-badge-red"><ion-icon name="warning-outline" style="margin: 0;"></ion-icon>Age > '.$create_date_diff.' Days</span>';
        }elseif($create_date_diff>=3){
        $p_badge .= '<span class="badge rounded p-1 ps-3 pe-3 mb-1 ml-1 modern-badge-purple"><ion-icon name="warning-outline" style="margin: 0;"></ion-icon>Age > '.$create_date_diff.' Days</span>';
        }
        //  launch date
        if($row["anj_launch_date"] <> null){
            $launch_date_c = date_create($row["anj_launch_date"]);
            $launch_date_c = date_format($launch_date_c,"Y-m-d");
            $launch_date_diff = (strtotime($launch_date_c)-strtotime($current_day))/  ( 60 * 60 * 24 );
            if($launch_date_diff<=0){
                $p_badge .= '<span class="badge rounded p-1 ps-3 pe-3 mb-1 ml-1 normal-badge-red" ><ion-icon name="warning-outline" style="margin: 0;"></ion-icon> Over Launch '.($launch_date_diff*(-1)).' days</span>';
                }elseif($launch_date_diff<=5){
                $p_badge .= '<span class="badge rounded p-1 ps-3 pe-3 mb-1 ml-1 modern-badge-purple" ><ion-icon name="warning-outline" style="margin: 0;"></ion-icon>Launch in '.$launch_date_diff.' days</span>';
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
// define status per stage
$configurable_map = array (
        array(
            'ac_role'=>'follow',
            'status'=>'pending',
            'filter'=>'anj.status = "pending"',
            'key_stage'=>'anj.follow_up_by',
            'key_name'=>'null'
        ),
        array(
            'ac_role'=>'follow',
            'status'=>'inprogress',
            'filter'=>'anj.status = "checking"',
            'key_stage'=>'anj.follow_up_by',
            'key_name'=>$ac_username
        ),
        array(
            'ac_role'=>'follow',
            'status'=>'waiting',
            'filter'=>'anj.status like "%wait%"',
            'key_stage'=>'anj.follow_up_by',
            'key_name'=>$ac_username
        ),
        array(
            'ac_role'=>'follow',
            'status'=>'waiting for other stage',
            'filter'=>'anj.accept_date is not null and jc.approved_by is null',
            'key_stage'=>'anj.follow_up_by',
            'key_name'=>$ac_username
        ),
        array(
            'ac_role'=>'writer',
            'status'=>'pending',
            'filter'=>'jc.content_start_date is null and anj.status ="on-productions"',
            'key_stage'=>'jc.content_assign_name',
            'key_name'=>'null'
        ),
        array(
            'ac_role'=>'writer',
            'status'=>'inprogress',
            'filter'=>'jc.content_start_date is not null and jc.content_complete_date is null and anj.status ="on-productions"',
            'key_stage'=>'jc.content_assign_name',
            'key_name'=>$ac_nickname
        ),
        array(
            'ac_role'=>'shoot',
            'status'=>'waiting for other stage',
            'filter'=>'jc.shoot_complete_date is null and jc.approved_by is null and anj.status ="on-productions"',
            'key_stage'=>'jc.shoot_assign_name',
            'key_name'=>$ac_nickname
        ),
        array(
            'ac_role'=>'recive_item',
            'status'=>'pending',
            'filter'=>'jc.recive_item_date is null ',
            'key_stage'=>'jc.shoot_assign_name',
            'key_name'=>'null'
        ),
        array(
            'ac_role'=>'shoot',
            'status'=>'pending',
            'filter'=>'jc.shoot_assign_name is null and anj.status ="on-productions"',
            'key_stage'=>'jc.shoot_assign_name',
            'key_name'=>'null'
        ),
        array(
            'ac_role'=>'shoot',
            'status'=>'inprogress',
            'filter'=>'jc.shoot_start_date is not null and jc.shoot_complete_date is null and anj.status ="on-productions"',
            'key_stage'=>'jc.shoot_assign_name',
            'key_name'=>$ac_nickname
        ),
        array(
            'ac_role'=>'shoot',
            'status'=>'waiting for other stage',
            'filter'=>'jc.shoot_complete_date is null and jc.approved_by is null and anj.status ="on-productions"',
            'key_stage'=>'jc.shoot_assign_name',
            'key_name'=>$ac_nickname
        ),
        array(
            'ac_role'=>'retouch',
            'status'=>'pending',
            'filter'=>'jc.shoot_complete_date is not null and jc.retouch_assign_name is null  and anj.status ="on-productions"',
            'key_stage'=>'jc.retouch_assign_name',
            'key_name'=>'null'
        ),
        array(
            'ac_role'=>'retouch',
            'status'=>'inprogress',
            'filter'=>'jc.retouch_start_date is not null and jc.retouch_complete_date is null',
            'key_stage'=>'jc.retouch_assign_name',
            'key_name'=>$ac_nickname
        ),
        array(
            'ac_role'=>'retouch',
            'status'=>'waiting for other stage',
            'filter'=>'jc.retouch_complete_date is null and jc.approved_by is null',
            'key_stage'=>'jc.retouch_assign_name',
            'key_name'=>$ac_nickname
        ),
        array(
            'ac_role'=>'image_uploader',
            'status'=>'pending',
            'filter'=>'jc.retouch_complete_date is null and jc.upload_image <> "Yes"',
            'key_stage'=>'jc.retouch_assign_name',
            'key_name'=>'null'
        ),
        array(
            'ac_role'=>'approve',
            'status'=>'pending',
            'filter'=>'jc.approved_date is not null and jc.approve_editing_status ="correct"',
            'key_stage'=>'jc.approve_by',
            'key_name'=>'null'
        ),
        array(
            'ac_role'=>'writer',
            'status'=>'rejected',
            'filter'=>'jc.approved_editing_status  in ("content_studio_editing","content_editing")',
            'key_stage'=>'jc.approve_by',
            'key_name'=>'null'
        ),
        array(
            'ac_role'=>'retouch',
            'status'=>'rejected',
            'filter'=>'jc.approved_editing_status  in ("content_studio_editing","studio_editing")',
            'key_stage'=>'jc.approve_by',
            'key_name'=>'null'
        ),
        );
//
$length_configurable_map = count($configurable_map);
for ($j=0; $j  < $length_configurable_map; $j++) {
    $ac_role_config = $configurable_map[$j]['ac_role'];
    $status_config = $configurable_map[$j]['status'];
    $key_stage = $configurable_map[$j]['key_stage'];
    $key_name = $configurable_map[$j]['key_name'];


    if( $ac_role_config ==  $ac_role and $status ==$status_config){

        get_panel_card($key_stage ,$key_name ,$configurable_map[$j]['filter'],100);
    }

}

            ?>