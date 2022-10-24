<?php
session_start();
$ac_role = $_POST['ac_role'];
$ac_username = $_POST['ac_username'];
$ac_nickname = $_POST['ac_nickname'];
$status = $_POST['status'];

function get_panel_card($primary_key_id,$id,$title,$prefix,$end_key,$status_key,$limit){
    
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
    $query = "SELECT 
        jc.id as jc_id,
        jc.job_number as jc_job_number,
        jc.job_type as jc_job_type,
        jc.department as jc_department,
        jc.sub_department as jc_sub_department,
        jc.brand as jc_brand,
        jc.sku as jc_sku,
        jc.job_status_filter as jc_job_status_filter,
        jc.production_type as jc_production_type,
        jc.product_type as jc_product_type,
        jc.transfer_type as jc_transfer_type,
        jc.product_sorting as jc_product_sorting,
        jc.store as jc_store,
        jc.luanch_date as jc_luanch_date,
        jc.product_website as jc_product_website,
        jc.bu as jc_bu,
        jc.traffic as jc_traffic,
        jc.date_run_job_traffic as jc_date_run_job_traffic,
        jc.recive_linesheet_date as jc_recive_linesheet_date,
        jc.recive_mail_date as jc_recive_mail_date,
        jc.product_sell_type as jc_product_sell_type,
        jc.total_cancel_sku as jc_total_cancel_sku,
        jc.cancel_date as jc_cancel_date,
        jc.wrong_data_linesheet as jc_wrong_data_linesheet,
        jc.enable_product as jc_enable_product,
        jc.shoots_piece_style as jc_shoots_piece_style,
        jc.studio_sku as jc_studio_sku,
        jc.product_check_by as jc_product_check_by,
        jc.recive_item_date as jc_recive_item_date,
        jc.upload_image_by as jc_upload_image_by,
        jc.upload_image_date as jc_upload_image_date,
        jc.check_image as jc_check_image,
        jc.content_assign_date as jc_content_assign_date,
        jc.content_assign_name as jc_content_assign_name,
        jc.content_queue_date as jc_content_queue_date,
        jc.content_start_date as jc_content_start_date,
        jc.content_complete_date as jc_content_complete_date,
        jc.content_translate as jc_content_translate,
        jc.shoots_assign_name as jc_shoots_assign_name,
        jc.shoots_assign_date as jc_shoots_assign_date,
        jc.shoots_day_1 as jc_shoots_day_1,
        jc.shoots_day_2 as jc_shoots_day_2,
        jc.shoots_day_3 as jc_shoots_day_3,
        jc.shoots_start_date as jc_shoots_start_date,
        jc.shoots_complete_date as jc_shoots_complete_date,
        jc.retouch_assign_name as jc_retouch_assign_name,
        jc.retouch_assign_date as jc_retouch_assign_date,
        jc.retouch_piece_style as jc_retouch_piece_style,
        jc.retouch_day_1 as jc_retouch_day_1,
        jc.retouch_day_2 as jc_retouch_day_2,
        jc.retouch_day_3 as jc_retouch_day_3,
        jc.retouch_start_date as jc_retouch_start_date,
        jc.retouch_complete_date as jc_retouch_complete_date,
        jc.approved_by as jc_approved_by,
        jc.approved_date as jc_approved_date,
        jc.approved_complete_sku as jc_approved_complete_sku,
        jc.approved_editing_status as jc_approved_editing_status,
        jc.approved_edited_date as jc_approved_edited_date,
        jc.approved_decline_date as jc_approved_decline_date,
        jc.approved_content_attribute_set as jc_approved_content_attribute_set,
        jc.approved_content_bullet as jc_approved_content_bullet,
        jc.approved_content_categories as jc_approved_content_categories,
        jc.approved_content_description as jc_approved_content_description,
        jc.approved_content_grouping as jc_approved_content_grouping,
        jc.approved_content_photo as jc_approved_content_photo,
        jc.approved_content_product_name as jc_approved_content_product_name,
        jc.approved_buyer_bullet as jc_approved_buyer_bullet,
        jc.approved_buyer_categories as jc_approved_buyer_categories,
        jc.approved_buyer_description as jc_approved_buyer_description,
        jc.approved_buyer_grouping as jc_approved_buyer_grouping,
        jc.approved_buyer_photo as jc_approved_buyer_photo,
        jc.approved_buyer_product_name as jc_approved_buyer_product_name,
        jc.approved_decline_remark as jc_approved_decline_remark,
        jc.approved_no_kpi_attribute_set as jc_approved_no_kpi_attribute_set,
        jc.approved_no_kpi_bullet as jc_approved_no_kpi_bullet,
        jc.approved_no_kpi_categories as jc_approved_no_kpi_categories,
        jc.approved_no_kpi_description as jc_approved_no_kpi_description,
        jc.approved_no_kpi_grouping as jc_approved_no_kpi_grouping,
        jc.approved_no_kpi_photo as jc_approved_no_kpi_photo,
        jc.approved_no_kpi_product_name as jc_approved_no_kpi_product_name,
        jc.remark as jc_remark,
        jc.create_at as jc_create_at,
        jc.last_update_at as jc_last_update_at,
        jc.duplicate_sku_in_mdc as jc_duplicate_sku_in_mdc,
        jc.wrong_data_sku as jc_wrong_data_sku,
        jc.datapump as jc_datapump,
        jc.itemmize_type as jc_itemmize_type,
        jc.job_status_fillter as jc_job_status_fillter,
        jc.csg_request_new_id as jc_csg_request_new_id,
        jc.pre_content_assign_name as jc_pre_content_assign_name,
        jc.ref_ticket_cto as jc_ref_ticket_cto,
        jc.ref_ticket_support as jc_ref_ticket_support,
        jc.lock_content_assign_name as jc_lock_content_assign_name,
        jc.approved_assign_name as jc_approved_assign_name,
        jc.approved_assign_date as jc_approved_assign_date,
        jc.approved_assign_by as jc_approved_assign_by,
        jc.datapump_success_date as jc_datapump_success_date,
        anj.id as anj_id,
        anj.brand as anj_brand,
        anj.department as anj_department,
        anj.sku as anj_sku,
        anj.production_type as anj_production_type,
        anj.project_type as anj_project_type,
        anj.business_type as anj_business_type,
        anj.launch_date as anj_launch_date,
        anj.contact_buyer as anj_contact_buyer,
        anj.contact_vender as anj_contact_vender,
        anj.remark as anj_remark,
        anj.request_username as anj_request_username,
        anj.job_id as anj_job_id,
        anj.create_date as anj_create_date,
        anj.update_date as anj_update_date,
        anj.new_brand as anj_new_brand,
        anj.status as anj_status,
        anj.start_checking_date as anj_start_checking_date,
        anj.follow_up_by as anj_follow_up_by,
        anj.accepted_date as anj_accepted_date,
        anj.online_channel as anj_online_channel,
        anj.bu as anj_bu,
        anj.request_important as anj_request_important,
        anj.tags as anj_tags,
        anj.reply_back_info_date as anj_reply_back_info_date,
        anj.participant as anj_participant,
        anj.internal_note as anj_internal_note,
        anj.cancel_resone as anj_cancel_resone,
        anj.config_type as anj_config_type,
        anj.parent as anj_parent,
        anj.follow_assign_name as anj_follow_assign_name,
        anj.follow_assign_date as anj_follow_assign_date,
        anj.sub_department as anj_sub_department,
        anj.subject_mail as anj_subject_mail,
        anj.cancel_date as anj_cancel_date,
        anj.trigger_status as anj_trigger_status,
        anj.job_cms_data_sync as anj_job_cms_data_sync,
        anj.web_cate as anj_web_cate,
        anj.request_date as anj_request_date,
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
    where ".$primary_key_id." = '".$id."' and ".$end_key."
    order by piority ASC,anj.launch_date is null ,anj.launch_date ASC,anj.create_date ASC,anj.sku DESC limit ".$limit or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
        
         ?>
<div class="p-3 border-bottom"
    onclick="call_edit_add_new_panel(<?php echo $row['anj_id']; ?>,'<?php echo $row['anj_brand']; ?>')">
    <div class="row">
        <div class="col">
            <ul class="list-group list-group-flush">
                <li class="" style="list-style: none"><strong><?php echo $prefix.$row[$title];?></strong></li>
                <li class="" style="list-style: none"><?php echo $row['anj_brand']." ".$row['anj_sku'];?> SKUs</li>
                <li class="" style="list-style: none"><span><?php echo $row[$status_key];?></span></li>
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
if($status=='inprogress'){
    if($ac_role=='follow'){
        get_panel_card('anj.follow_up_by',$ac_username ,'anj_id','NS-','anj.accepted_date is null and anj.status not like "%cancel%" and anj.status not like "%wait%"','status',10);
    }elseif($ac_role=='writer'){
        get_panel_card('jc.content_assign_name',$ac_nickname,'jc_job_number','','jc.content_complete_date is null and  jc.job_status_filter not like "%cancel%" and jc.job_status_filter not like "%wait%" and anj.status not like "%wait%"','jc_job_status_filter',10);
    }elseif($ac_role=='shooter'){
        get_panel_card('jc.shoot_assign_name',$ac_nickname,'jc_job_number','','jc.shoot_complete_date is null and jc.job_status_filter not like "%cancel%" and jc.job_status_filter not like "%wait%" and anj.status not like "%wait%"','jc_job_status_filter',10);
    }elseif($ac_role=='retoucher'){
        get_panel_card('jc.retouch_assign_name',$ac_nickname,'jc_job_number','','jc.retouch_complete_date is null and jc.job_status_filter not like "%cancel%" and jc.job_status_filter not like "%wait%" and anj.status not like "%wait%"','jc_job_status_filter',10);
    }elseif($ac_role=='product_executive' or $ac_role== 'deverloper'){
        get_panel_card('anj.follow_up_by',$ac_username ,'anj_id','NS-','jc.approved_date is null and anj.status not like "%cancel%" and jc.job_status_filter not like "%wait%" and anj.status not like "%wait%" ' ,'anj_status',10);
    }elseif($ac_role=='approver'){
        get_panel_card('jc.approved_assign_name',$ac_nickname,'jc_job_number','','jc.approved_date is null and anj.status not like "%cancel%" and jc.job_status_filter not like "%wait%" and anj.status not like "%wait%"' ,'jc_job_status_filter',10);
    }
}elseif($status=='pending'){
    if($ac_role=='follow'){
        get_panel_card('1', '1','anj_id','NS-','anj.status  like "%pending%"','status',1);
    }elseif($ac_role=='writer'){
        get_panel_card('1', '1','jc_job_number','','lower(jc.transfer_type) like "%data%" and jc.job_number is not null and jc.content_start_date is null and jc.job_status_filter not like "%cancel%"','jc_job_status_filter',1);
    }elseif($ac_role=='shooter'){
        get_panel_card('1', '1','jc_job_number','','lower(jc.transfer_type) like "%photo%" and jc.job_number is not null and jc.shoot_start_date is null and jc.job_status_filter not like "%cancel%" ','jc_job_status_filter',1);
    }elseif($ac_role=='retoucher'){
        get_panel_card('1', '1','jc_job_number','','jc.shoot_complete_date is not null and lower(jc.transfer_type) like "%photo%" and jc.job_number is not null and jc.retouch_start_date is null and jc.job_status_filter not like "%cancel%" ','jc_job_status_filter',1);
    }elseif($ac_role=='product_executive' or $ac_role== 'deverloper'){
        get_panel_card('1', '1','anj_id','NS-','anj.status  like "%pending%" ' ,'anj_status',1);
    }elseif($ac_role=='approver'){
        get_panel_card('1','1','jc_job_number','','jc.job_status_filter = "Continue" and (jc.upload_image_date is not null or lower(jc.transfer_type) not like "%photo%") and  (jc.content_complete_date is not null or lower(jc.transfer_type) not like "%data%") and jc.job_number is not null and jc.approved_date is null and anj.status not like "%cancel%" ' ,'jc_job_status_filter',10);
    }
}elseif($status=='waiting'){
    if($ac_role=='follow'){
        get_panel_card('1', '1','anj_id','NS-','anj.status  like "%wait%"','status',1);
    }elseif($ac_role=='writer'){
        get_panel_card('1', '1','jc_job_number','','  (jc.job_status_filter  like "%wait%" or anj.status  like "%wait%")','jc_job_status_filter',1);
    }elseif($ac_role=='shooter'){
        get_panel_card('1', '1','jc_job_number','','(jc.job_status_filter  like "%wait%" or anj.status  like "%wait%" )','jc_job_status_filter',1);
    }elseif($ac_role=='retoucher'){
        get_panel_card('1', '1','jc_job_number','',' (jc.job_status_filter  like "%wait%" or anj.status  like "%wait%" )','jc_job_status_filter',1);
    }elseif($ac_role=='product_executive' or $ac_role== 'deverloper'){
        get_panel_card('1', '1','anj_id','NS-','anj.status  like "%wait%" ' ,'anj_status',1);
    }elseif($ac_role=='approver'){
        get_panel_card('1','1','jc_job_number','',' (jc.job_status_filter  like "%wait%" or anj.status nt like "%wait%") ' ,'jc_job_status_filter',1);
    }
}
elseif($status=='revise'){
    if($ac_role=='follow'){
        //get_panel_card('1', '1','anj_id','NS-','anj.status  like "%wait%"','status',1);
    }elseif($ac_role=='writer'){
        get_panel_card('1', '1','jc_job_number','','  (jc.job_status_filter  like "%Continue%" and jc.approved_editing_status like "content_editing" )','jc_job_status_filter',1);
    }elseif($ac_role=='shooter'){
        //get_panel_card('1', '1','jc_job_number','','(jc.job_status_filter  like "%wait%" or anj.status  like "%wait%" )','jc_job_status_filter',1);
    }elseif($ac_role=='retoucher'){
        get_panel_card('1', '1','jc_job_number','',' (jc.job_status_filter  like "%Continue%" and jc.approved_editing_status like "studio_editing" )','jc_job_status_filter',1);
    }elseif($ac_role=='product_executive' or $ac_role== 'deverloper'){
        get_panel_card('1', '1','anj_id','NS-','jc.job_status_filter  like "%Continue%" and jc.approved_editing_status like "%editing%" ' ,'anj_status',1);
    }elseif($ac_role=='approver'){
        get_panel_card('1','1','jc_job_number','',' (jc.job_status_filter  like "%Continue%" and jc.approved_editing_status like "content_editing") ' ,'jc_job_status_filter',1);
    }
}
elseif($status=='revised'){
    if($ac_role=='follow'){
        //get_panel_card('1', '1','anj_id','NS-','anj.status  like "%wait%"','status',1);
    }elseif($ac_role=='writer'){
        get_panel_card('1', '1','jc_job_number','','  (jc.job_status_filter  like "%Continue%" and jc.approved_editing_status like "edited" )','jc_job_status_filter',1);
    }elseif($ac_role=='shooter'){
        //get_panel_card('1', '1','jc_job_number','','(jc.job_status_filter  like "%wait%" or anj.status  like "%wait%" )','jc_job_status_filter',1);
    }elseif($ac_role=='retoucher'){
        get_panel_card('1', '1','jc_job_number','',' (jc.job_status_filter  like "%Continue%" and jc.approved_editing_status like "edited" )','jc_job_status_filter',1);
    }elseif($ac_role=='product_executive' or $ac_role== 'deverloper'){
        get_panel_card('1', '1','anj_id','NS-','jc.job_status_filter  like "%Continue%" and jc.approved_editing_status like "edited"' ,'anj_status',1);
    }elseif($ac_role=='approver'){
        get_panel_card('1','1','jc_job_number','',' (jc.job_status_filter  like "%Continue%" and jc.approved_editing_status like "edited") ' ,'jc_job_status_filter',1);
    }
}


?>