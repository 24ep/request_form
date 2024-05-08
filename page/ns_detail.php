<?php
function get_value_main($crid,$col_re,$db,$table,$primary_key_id){
    $con_cr= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con_cr));
    mysqli_query($con_cr, "SET NAMES 'utf8' ");
    $query_cr = "SELECT * FROM ".$db.".".$table." where ".$primary_key_id." = '".$crid."' ORDER BY id DESC" or die("Error:" . mysqli_error($con_cr));
    $result_cr = mysqli_query($con_cr, $query_cr);
    while($row_cr = mysqli_fetch_array($result_cr)) {
                $current_cr = $row_cr[$col_re];
    }
    mysqli_close($con_cr);
    return $current_cr;
}
  session_start();
//   include($_SERVER['DOCUMENT_ROOT']."/get/get_default_profile_image.php");
//   include($_SERVER['DOCUMENT_ROOT']."action/action_send_linenotify.php");
  $nickname = $_SESSION["nickname"];
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT
            anj.id as id,
            anj.brand as brand,
            anj.request_username as request_username,
            anj.create_date as create_date,
            anj.request_date as request_date,
            anj.update_date as update_date,
            anj.production_type as production_type,
            anj.business_type as business_type,
            anj.project_type as project_type,
            anj.stock_source as stock_source,
            anj.contact_buyer as contact_buyer,
            anj.contact_vender as contact_vender,
            anj.launch_date as launch_date,
            anj.link_info as link_info,
            anj.remark as remark,
            anj.department as department,
            anj.sku as sku,
            anj.status as status,
            anj.start_checking_date as start_checking_date,
            anj.accepted_date as accepted_date,
            anj.cancel_resone as cancel_resone,
            anj.need_more_info_date as need_more_info_date,
            anj.follow_up_by as follow_up_by,
            anj.bu as bu,
            anj.tags as tags,
            anj.online_channel as online_channel,
            anj.request_important as request_important,
            anj.follow_assign_name as follow_assign_name,
            anj.follow_assign_date as follow_assign_date,
            anj.sub_department as sub_department,
            anj.parent as parent,
            anj.config_type as config_type,
            anj.trigger_status as trigger_status,
            anj.subject_mail as subject_mail,
            ac.nickname as follow_assign_nickname,
            ac_request.id as request_user_id,
            ac_follow.id as follow_user_id,
            ac_request.firstname as request_firstname,
            ac_request.lastname as request_lastname,
            ac_request.office_tell as request_office_tell,
            ac_request.nickname as request_nickname,
            brand_editor.body  as brand_editor,
            anj.web_cate as web_cate,
            anj.approved_date as approved_date,
            anj.approved_by as approved_by,
            anj.approved_complete_sku as approved_complete_sku,
            anj.approved_edited_date as approved_edited_date,
            anj.approved_decline_date as approved_decline_date,
            anj.approved_decline_remark as approved_decline_remark,
            anj.job_number as job_number,
            anj.actual_launch_date as actual_launch_date,
            anj.content_start_date as content_start_date,
            anj.content_complete_date as content_complete_date,
            anj.content_assign_name as content_assign_name,
            anj.shoots_start_date as shoots_start_date,
            anj.shoots_complete_date as shoots_complete_date,
            anj.retouch_start_date as retouch_start_date,
            anj.retouch_complete_date as retouch_complete_date,
            anj.upload_image_date as upload_image_date,
            anj.studio_status as studio_status,
            anj.image_renaming_assign_name as image_renaming_assign_name,
            anj.image_renaming_assign_date as image_renaming_assign_name,
            anj.image_renaming_start_date as image_renaming_start_date,
            anj.image_renaming_complete_date as image_renaming_complete_date
            FROM all_in_one_project.add_new_job as anj
            left join all_in_one_project.account as ac
            on ac.username = anj.follow_assign_name
            left join all_in_one_project.account as ac_request
            on ac_request.username = anj.request_username
            left join all_in_one_project.account as ac_follow
            on ac_follow.username = anj.follow_up_by
            left join all_in_one_project.brand_editor as brand_editor
            on brand_editor.brand = anj.brand
            where anj.id = ".$_POST['id']." ORDER BY anj.id DESC " or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {
      $id = $row['id'];
      $actual_launch_date=$row['actual_launch_date'];
      $brand = $row['brand'];
      $request_user_id = $row['request_user_id'];
      $follow_user_id = $row['follow_user_id'];
      $request_username = $row['request_username'];
      $request_firstname = $row['request_firstname'];
      $request_lastname = $row['request_lastname'];
      $request_nickname = $row['request_nickname'];
      $request_office_tell = $row['request_office_tell'];
      $create_date = $row['create_date'];
      $request_date= $row['request_date'];
      $update_date = $row['update_date'];
      $production_type = $row['production_type'];
      $business_type = $row['business_type'];
      $project_type = $row['project_type'];
      $stock_source = $row['stock_source'];
      $contact_buyer = $row['contact_buyer'];
      $contact_vender = $row['contact_vender'];
      $launch_date = $row['launch_date'];
      $link_info = $row['link_info'];
      $remark = $row['remark'];
      $department = $row['department'];
      $sku = $row['sku'];
      $status = $row['status'];
      $start_checking_date = $row['start_checking_date'];
      $accepted_date = $row['accepted_date'];
      $cancel_resone = $row['cancel_resone'];
      $need_more_info_date = $row['need_more_info_date'];
      $need_more_info_note = $row['need_more_info_note'];
      $follow_up_by = $row['follow_up_by'];
      $bu = $row['bu'];
      $tags = $row['tags'];
      $online_channel = $row['online_channel'];
      $request_important = $row['request_important'];
      $follow_assign_name = $row['follow_assign_name'];
      $follow_assign_date = $row['follow_assign_date'];
      $sub_department = $row['sub_department'];
      $parent = $row['parent'];
      $config_type = $row['config_type'];
      $subject_mail = $row['subject_mail'];
      $follow_assign_nickname = $row['follow_assign_nickname'];
      $web_cate = $row['web_cate'];
      $brand_editor=$row['brand_editor'];
      $trigger_status=$row['trigger_status'];
      $job_number=$row['job_number'];
      $approved_date=$row['approved_date'];
      $approved_complete_sku=$row['approved_complete_sku'];
      $approved_edited_date=$row['approved_edited_date'];
      $approved_decline_date=$row['approved_decline_date'];
      $approved_decline_remark=$row['approved_decline_remark'];
      $content_start_date = $row['content_start_date'];
      $content_complete_date = $row['content_complete_date'];
      $content_assign_name = $row['content_complete_date'];
      $shoots_start_date = $row['shoots_start_date'];
      $shoots_complete_date = $row['shoots_complete_date'];
      $retouch_start_date = $row['retouch_start_date'];
      $retouch_complete_date = $row['retouch_complete_date'];
      $upload_image_date = $row['upload_image_date'];
      $studio_status = $row['studio_status'];
      $image_renaming_assign_name = $row['image_renaming_assign_name'];
      $image_renaming_assign_date = $row['image_renaming_assign_date'];
      $image_renaming_start_date = $row['image_renaming_start_date'];
      $image_renaming_complete_date = $row['image_renaming_complete_date'];
    //stamp color status
    if($row["status"]=="pending"){
    $status_style = 'style="background: #a9a9a94f;color:#8f8f8f"';
    }elseif($row["status"]=="checking"){
        $status_style = 'style="background: #ffff7e;color:#997300"';
    }elseif($row["status"]=="on-productions"){
        $status_style = 'style="background: #7befb2;color:#115636"';
    }elseif($row["status"]=="waiting confirm"){
        $status_style = 'style="background: #499CF7;color:#093f8e"';
    }elseif($row["status"]=="waiting image"){
        $status_style = 'style="background: #FE7A6F;color:#a80c1b"';
    }elseif($row["status"]=="waiting data"){
        $status_style = 'style="background: #FE7A6F;color:#a80c1b"';
    }elseif($row["status"]=="waiting traffic"){
        $status_style = 'style="background: #ea79f7;color:#6a2e71"';
    }
  }
  $query = "SELECT * FROM all_in_one_project.account where username = '".$follow_up_by."' ORDER BY id DESC " or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {
    $follow_up_nickname = $row['nickname'];
    $follow_up_name = $row['firstname']." ".substr($row['lastname'],0,2).". ( ".$follow_up_nickname." ) ";
    $office_tell = $row['office_tell'];
    $work_email = $row['work_email'];
  }
  $query = "SELECT * FROM all_in_one_project.add_new_job  where id<> ".$id." and request_username = '".$request_username."' and status not in ('on-productions','cancel') ORDER BY id DESC limit 2" or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  $same_owner = '';
  while($row = mysqli_fetch_array($result)) {
    $same_owner .= " <li style='margin-top: 5px;' class='text-nowrap' >NS-".$row['id']." ".$row['brand']." ".$row['sku']." SKUs</li>";
  }
  $same_owner .= " <li style='margin-top: 5px;color: #81a8dd;' class='text-nowrap' ><a type='button' onclick='ns_discover(&#34;user_filter&#34;,&#34;".$request_username."&#34;);' id='discover_more_requester_bt' >Discover more <ion-icon name='arrow-forward-outline'></ion-icon></a></li>";
  $query = "SELECT * FROM all_in_one_project.add_new_job  where id<> ".$id." and brand = '".$brand."' and status not in ('on-productions','cancel') ORDER BY id DESC limit 2" or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  $same_brand = '';
  while($row = mysqli_fetch_array($result)) {
    $same_brand .= " <li style='margin-top: 5px;' class='text-nowrap' >NS-".$row['id']." ".$row['brand']." ".$row['sku']." SKUs</li>";
  }
  $same_brand .= " <li style='margin-top: 5px;color: #81a8dd;' class='text-nowrap' ><a type='button' onclick='ns_discover(&#34;brand_filter&#34;,&#34;".$brand."&#34;);' id='discover_more_brand_bt' >Discover more <ion-icon name='arrow-forward-outline'></ion-icon></a></li>";
  if($follow_up_name==""){
    $follow_up_name = '-';
    $office_tell = '-';
    $work_email = '-';
  }
  mysqli_close($con);
  if($request_important=="Urgent"){
    $dp_tags .= '<span class="badge bg-danger bg-gradient shadow-sm" style="margin: 0px 10px 10px 0px;padding: 8px;">'.$request_important.'</span>';
}
  $tags_array = explode(", ", $tags);
  foreach ($tags_array as $tag) {
   $dp_tags .= '<span class="badge bg-dark bg-gradient shadow-sm" style="margin: 0px 10px 10px 0px;padding: 8px;">'.$tag.'</span>';
  }
?>
<link rel="stylesheet" href="/action/notiflix/dist/notiflix-3.2.5.min.css" />
<script src="/action/notiflix/dist/notiflix-3.2.5.min.js"></script>
<?php
if($parent<>""){
echo '
<nav class="navbar bg-secondary bg-gradient shadow-sm  bg-opacity-50">
  <form class="container-fluid justify-content-start">
    <button class="btn btn-sm" type="button" onclick="call_edit_add_new_modal('.$parent.')"><ion-icon name="chevron-back-outline"></ion-icon>
     Go to parent ticket (NS-'.$parent.')</button>
  </form>
</nav>
';
}
?>
<nav class="p-3 bg-white text-dark bg-gradient shadow-sm  ">
    <div class="row">
        <div class="col-4">
            <div class="container-fluid">
                <small>
                    <a type="button" style="text-decoration: none;color: gray;margin-left: 10px;padding: 5px;"
                        onclick="get_page('ns_list');">
                        <ion-icon name="chevron-back-outline" style="margin: 0px;"></ion-icon> Back to list
                    </a>
                </small>
                <h5><a class="navbar-brand" href="#">NS-<?php echo $id." ".$brand." ".$sku." SKUs" ?> </a></h5>
                <div class="ms-3">
                    <?php echo $dp_tags; ?>
                </div>
            </div>
        </div>
        <div class="col-2 bg-white" style="border-left: 1px solid #e0e0e0;">
            <small class="content-assignee-header"><?php echo $request_firstname; ?> also pending</small>
            <ul class="contact-person-ns">
                <?php echo $same_owner; ?>
            </ul>
        </div>
        <div class="col-2 bg-white" style="border-left: 1px solid #e0e0e0;">
            <small class="content-assignee-header"><?php echo $brand; ?> also pending</small>
            <ul class="contact-person-ns">
                <?php echo $same_brand; ?>
            </ul>
        </div>
        <div class="col-2 bg-white" style="border-left: 1px solid #e0e0e0;">
            <small class="content-assignee-header">Requested by</small>
            <div id="contact_person_requester">
                <ul class="contact-person-ns">
                    <li style="margin-top: 5px;">
                        <ion-icon name="person-outline"></ion-icon>
                        <?php echo $request_firstname." ".substr($request_lastname,0,2).". ( ".$request_nickname." ) " ?>
                        <ion-icon type="button" class="btn btn-outline-dark border-0 btn-sm" data-bs-toggle="modal"
                            data-bs-target="#exampleModal"
                            onclick="call_model_edit_account('<?php echo $request_user_id; ?>')" name="open-outline">
                    </li>
                    <li style="margin-top: 5px;">
                        <ion-icon name="call-outline"></ion-icon> <?php echo $request_office_tell; ?>
                    </li>
                    <li style='margin-top: 5px;color: #81a8dd;'>
                        <a type="button" id="take_owner_bt" onclick="take_ns_requester(<?php echo $id;?>)">
                            <ion-icon name="golf-outline"></ion-icon> Take owner
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-2" style="border-left: 1px solid #e0e0e0;">
            <small class="content-assignee-header">Contact person</small>
            <div id="contact_person_officer">
                <?php if($follow_up_name=="-"){
                    echo '<button type="button" id="take_officer_bt" onclick="take_ns_officer('.$id.')" class="btn btn-sm btn-primary m-3 bg-gradient"><ion-icon name="person-outline"></ion-icon> Take officer</button>';
                }else{
                    ?>
                <ul class="contact-person-ns">
                    <li style="margin-top: 5px;">
                        <ion-icon name="person-outline"></ion-icon><?php echo $follow_up_name; ?>
                        <ion-icon type="button" class="btn btn-outline-dark border-0 btn-sm" data-bs-toggle="modal"
                            data-bs-target="#exampleModal"
                            onclick="call_model_edit_account('<?php echo $follow_user_id; ?>')" name="open-outline">
                    </li>
                    <li style="margin-top: 5px;">
                        <ion-icon name="call-outline"></ion-icon> <?php echo $office_tell; ?>
                    </li>
                </ul>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</nav>
<div class="container-fluid ">
    <div class="row">
        <div class="col-8 mt-3 ">
            <?php if($config_type=='parent'){?>
            <div class="row">
                <div class="officerassingbox">
                    <div id="call_subtask">
                        <?php include($_SERVER['DOCUMENT_ROOT'].'/get/get_sub_task_in_task.php'); ?>
                    </div>
                </div>
            </div>
            <hr>
            <?php }?>
            <?php //if($config_type=='task'){?>
            <?php
                                    if($status=='checking'){
                                        $badge_progres_0 = 'btn-success';
                                        $badge_progres_1 = 'btn-success';
                                        $badge_progres_2 = 'btn-secondary';
                                        $badge_progres_3 = 'btn-secondary';
                                        $badge_progres_4 = 'btn-secondary';
                                        $progress_per = '30';
                                    }elseif($status=='on-productions' and $approved_date ==''){
                                        $badge_progres_0 = 'btn-success';
                                        $badge_progres_1 = 'btn-success';
                                        $badge_progres_2 = 'btn-success';
                                        $badge_progres_3 = 'btn-secondary';
                                        $progress_per = '60';
                                    }elseif($status=='on-productions' and $approved_date <>''){
                                        $badge_progres_0 = 'btn-success';
                                        $badge_progres_1 = 'btn-success';
                                        $badge_progres_2 = 'btn-success';
                                        $badge_progres_3 = 'btn-success';
                                        $progress_per = '100';
                                    }elseif($status=='approved' and $approved_date <>''){
                                        $badge_progres_0 = 'btn-success';
                                        $badge_progres_1 = 'btn-success';
                                        $badge_progres_2 = 'btn-success';
                                        $badge_progres_3 = 'btn-success';
                                        $progress_per = '100';
                                    }elseif($status=='cancel'){
                                        $badge_progres_0 = 'btn-secondary';
                                        $badge_progres_1 = 'btn-secondary';
                                        $badge_progres_2 = 'btn-secondary';
                                        $badge_progres_3 = 'btn-secondary';
                                        $progress_per = '0';
                                    }elseif($status=='pending'){
                                        $badge_progres_0 = 'btn-success';
                                        $badge_progres_1 = 'btn-secondary';
                                        $badge_progres_2 = 'btn-secondary';
                                        $badge_progres_3 = 'btn-secondary';
                                        $progress_per = '0';
                                    }else{
                                        $badge_progres_1 = 'btn-secondary';
                                        $badge_progres_2 = 'btn-secondary';
                                        $badge_progres_3 = 'btn-secondary';
                                        $progress_per = '0';
                                    }
                                    ?>
            <ul class="nav nav-pills mb-3 "
                style="flex-flow: unset;font-weight: bolder;width: 100%;width: inherit;text-align-last: left;"
                id="pills-tab" role="tablist">
                <li class="nav-item" style="width: fit-content;" role="presentation">
                    <button class="nav-link active" id="pills-ticket-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-ticket" type="button" role="tab" aria-controls="pills-ticket"
                        aria-selected="true">
                        <ion-icon name="podium-outline"></ion-icon>Progress
                        <!-- status -->
                        <!-- end status -->
                    </button>
                </li>
                <li class="nav-item" style="width: fit-content;" role="presentation">
                    <button class="nav-link" id="pills-productions-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-productions" type="button" role="tab" aria-controls="pills-productions"
                        aria-selected="false">
                        <ion-icon name="file-tray-stacked-outline"></ion-icon>Information
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-ticket" role="tabpanel"
                    aria-labelledby="pills-ticket-tab">
                    <div class="position-relative" style="margin: 10%!important;margin-top: 50px!important;">
                        <div class="progress" style="height: 5px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success shadow-sm"
                                role="progressbar" aria-label="Progress" style="width: <?php echo $progress_per; ?>%;"
                                aria-valuenow="<?php echo $progress_per; ?>" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <button type="button"
                            class="position-absolute top-0 start-0 translate-middle btn btn-sm shadow-sm <?php echo $badge_progres_0; ?> rounded-pill"
                            style="width: 2rem; height:2rem;">0</button>
                        <small id="requester_pg" style="top: 50px!important;"
                            class="position-absolute top-100 start-0 translate-middle btn btn-sm"><strong>Request</strong><br>
                            <span class="timeago"
                                datetime="<?php echo $create_date; ?>"><?php echo $create_date; ?></span></small>
                        <button type="button"
                            class="position-absolute top-0 start-30 translate-middle btn btn-sm shadow-sm <?php echo $badge_progres_1; ?> rounded-pill"
                            style="width: 2rem; height:2rem;">1</button>
                        <small id="checking_pg" style="top: 50px!important;"
                            class="position-absolute top-100 start-30 translate-middle btn btn-sm"><strong>Checking</strong>
                            <br><span class="timeago"
                                datetime="<?php echo $accepted_date; ?>"><?php echo $accepted_date; ?></span></small>
                        <button type="button"
                            class="position-absolute top-0 start-60 translate-middle btn btn-sm shadow-sm <?php echo $badge_progres_2; ?> rounded-pill"
                            style="width: 2rem; height:2rem;">2</button>
                        <small onclick="copytext('<?php echo $job_number; ?>')" id="onproduction_pg"
                            style="top: 50px!important;"
                            class="position-absolute top-100 start-60 translate-middle btn btn-sm"><strong>On-productions</strong>
                            <br><?php echo $job_number; ?></small>
                        <button type="button"
                            class="position-absolute top-0 start-100 translate-middle btn btn-sm shadow-sm <?php echo $badge_progres_3; ?> rounded-pill"
                            style="width: 2rem; height:2rem;">3</button>
                        <small id="approved_pg" style="top: 50px!important;"
                            class="position-absolute top-100 start-100 translate-middle btn btn-sm"><strong>Approved</strong><br><span
                                class="timeago"
                                datetime="<?php echo $approved_date; ?>"><?php echo $approved_date; ?></span></small>
                    </div>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-public-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-public" type="button" role="tab" aria-controls="nav-public"
                                aria-selected="true">
                                <ion-icon name="chatbubble-outline"></ion-icon>Public comment
                            </button>
                            <?php if(strpos($_SESSION["permission"],'ps_cr_internal_note')!==false){?>
                            <button class="nav-link" id="nav-internal-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-internal" type="button" role="tab" aria-controls="nav-internal"
                                aria-selected="false">
                                <ion-icon name="text-outline"></ion-icon>Internal note
                            </button>
                            <?php }?>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-public" role="tabpanel"
                            aria-labelledby="nav-public-tab" tabindex="0">
                            <div class="alert alert-light m-2 shadow-sm" role="alert">
                                <?php if( $remark<>""){
                        ?>
                                <ion-icon name="information-circle-outline"></ion-icon><?php echo $remark;?>
                                <hr>
                                <?php
                    }
                    else{
                        ?>
                                <ion-icon name="information-circle-outline"></ion-icon><small>Have no any remark from
                                    requester.</small>
                                <hr>
                                <?php
                    }
                    ?>
                                <a type="button" href="<?php echo $link_info;?>" target="_blank"
                                    class="attachment">
                                    <ion-icon style="color: #7e7e7e;margin-right: 5px;"name="document-attach-outline"></ion-icon>Go to files information
                                </a>
                            </div>
                            <!-- comment ns -->
                            <ul class="list-group list-group-flush m-1"
                                style="background: fixed;--bs-list-group-bg: #fff0;">
                                <div id="comment_box_ns">
                                    <div id="call_ticket_comment_ns">
                                        <?php include($_SERVER['DOCUMENT_ROOT'].'/get/get_comment_ns.php'); ?>
                                    </div>
                                </div>
                            </ul>
                            <small style="font-weight: bolder;color: #adb5bd;">
                                <ion-icon name="chatbubbles-outline"></ion-icon>Comment
                            </small>
                            <textarea id="comment_input_ns" style="font-size: 14px;" class="form-control mt-2 mb-2"
                                placeholder="Leave a comment here..." rows="4" style="height: 100px"></textarea>
                            <div class="mb-3">
                                <input type="file" id="actual-btn_ns" name="actual-btn_ns[]" multiple hidden />
                                <label id="label_file_ns" name="label_file_ns" for="actual-btn_ns">
                                    <ion-icon name="attach-outline"></ion-icon>Attach file or image
                                </label>
                                <span id="file-chosen_ns"> </span>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm"
                                onClick="comment_ns_id_with_file(<?php echo  $_POST['id']; ?>)">Add
                                comment</button>
                            <!-- end comment ns -->
                        </div>
                        <div class="tab-pane fade" id="nav-internal" role="tabpanel" aria-labelledby="nav-internal-tab"
                            tabindex="0">
                            <!-- internal note -->
                            <ul class="list-group list-group-flush m-1"
                                style="background: fixed;--bs-list-group-bg: #fff0;">
                                <div id="comment_box_ins">
                                    <div id="call_ticket_comment_ins">
                                        <?php include($_SERVER['DOCUMENT_ROOT'].'/get/get_comment_ins.php'); ?>
                                    </div>
                                </div>
                            </ul>
                            <small style="font-weight: bolder;color: #adb5bd;">
                                <ion-icon name="chatbubbles-outline"></ion-icon>Comment
                            </small>
                            <textarea id="comment_input_ins" style="font-size: 14px;" class="form-control mt-2 mb-2"
                                placeholder="Leave a comment here..." rows="4" style="height: 100px"></textarea>
                            <div class="mb-3">
                                <input type="file" id="actual-btn_ins" name="actual-btn_ins[]" multiple hidden />
                                <label id="label_file_ins" name="label_file_ins" for="actual-btn_ins">
                                    <ion-icon name="attach-outline"></ion-icon>Attach file or image
                                </label>
                                <span id="file-chosen_ins"> </span>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm"
                                onClick="comment_ins_id_with_file(<?php echo  $_POST['id']; ?>)">Add
                                comment</button>
                            <!-- end internal note -->
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-productions" role="tabpanel"
                    aria-labelledby="pills-productions-tab">
                    <div id="form_production"></div>
                </div>
            </div>
        </div>
        <div class="col-4"
            style="height: auto;background-color: white;border-left: solid 1px #fde5e5;margin-top: 2.5px;padding: 0px;">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-note-tab" data-bs-toggle="tab" data-bs-target="#nav-note"
                        type="button" role="tab" aria-controls="nav-note" aria-selected="true">
                        <ion-icon name="document-text-outline"></ion-icon>
                        <strong><?php echo $brand; ?></strong> Note
                    </button>
                    <?php if(strpos($_SESSION["permission"],'ps_ns_logs')!==false){?>
                    <button class="nav-link" id="nav-logs-tab" data-bs-toggle="tab" data-bs-target="#nav-logs"
                        type="button" role="tab" aria-controls="nav-logs" aria-selected="false">
                        <ion-icon name="time-outline"></ion-icon>Logs
                    </button>
                    <?php } ?>
                    <?php if(strpos($_SESSION["permission"],'ps_ns_function')!==false){?>
                    <button class="nav-link" id="nav-console-tab" data-bs-toggle="tab" data-bs-target="#nav-console"
                        type="button" role="tab" aria-controls="nav-console" aria-selected="false">
                        <ion-icon name="game-controller-outline"></ion-icon>Function
                    </button>
                    <?php } ?>
                    <?php if(strpos($_SESSION["permission"],'pr_ticket_files')!==false){?>
                    <button class="nav-link" id="nav-files-tab" data-bs-toggle="tab" data-bs-target="#nav-files"
                        type="button" role="tab" aria-controls="nav-files" aria-selected="false">
                        <ion-icon name="folder-open-outline"></ion-icon>files
                    </button>
                    <?php } ?>
                    <button class="nav-link" id="nav-sku-tab" data-bs-toggle="tab" data-bs-target="#nav-sku"
                        type="button" role="tab" aria-controls="nav-sku" aria-selected="false">
                        <ion-icon name="list-outline"></ion-icon>SKUs
                    </button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade" id="nav-detail" role="tabpanel" aria-labelledby="nav-detail-tab"
                    tabindex="0">
                    <div class="container" style="padding: 20px!important;">
                        <div class="alert alert-primary shadow-sm" role="alert">
                            <ion-icon name="color-wand-outline"></ion-icon>
                            สามาถแก้ไขข้อมูลบางส่วนด้วยตนเองได้ จนกว่า ทาง Content จะทำการ assign
                            ticket นี้ให้กับทางผู้เกี่ยวข้อง
                        </div>
                        <div id="form_request_edit_new_2">
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-logs" role="tabpanel" aria-labelledby="nav-logs-tab" tabindex="0">
                    <div class="container p-0 m-0" >
                        <div id="get_ns_log">
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-files" role="tabpanel" aria-labelledby="nav-files-tab" tabindex="0">
                    <div class="container" style="padding: 20px!important;">
                        <div id="get_files">
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="nav-note" role="tabpanel" aria-labelledby="nav-note-tab"
                    tabindex="0">
                    <div class="container-fluid " style="padding: 10px;">
                        <div id="editorjs"></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-console" role="tabpanel" aria-labelledby="nav-console-tab"
                    tabindex="0">
                    <div id="get_internal_console_nj_new">
                        <?php include($_SERVER['DOCUMENT_ROOT'].'/get/get_internal_console_nj_new.php');?>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-sku" role="tabpanel" aria-labelledby="nav-sku-tab" tabindex="0">
                    <?php include($_SERVER['DOCUMENT_ROOT'].'/get/get_list_sku_ticket.php'); ?>
                </div>
            </div>
            <script>
            // first define the tools to be made avaliable in the columns
            var column_tools = {
                header: Header,
                alert: Alert,
                paragraph: Paragraph,
                delimiter: Delimiter
            }
            // editor.destroy();
            var ImageTool = window.ImageTool;
            var editor = new EditorJS({
                placeholder: 'ข้อความที่อยู่ใน block นี้จะแสดงในทุกๆ ticket ของแบรนด์ดังกล่าว',
                onReady: () => {
                    //console.log('Editor.js is ready to work!');
                    new DragDrop(editor);
                },
                onChange: (api, event) => {
                    //console.log('<?php //echo $_SESSION['username'];?>have been updated a content in brand note', event)
                    editor.save().then((outputData) => {
                        // console.log('Article data: ', outputData)
                        outputData = JSON.stringify(outputData, null, 4);
                        update_brand_note(outputData, '<?php echo $brand; ?>');
                    }).catch((error) => {
                        console.log('Saving failed: ', error)
                    });
                },
                holder: 'editorjs',
                tools: {
                    columns: {
                        class: editorjsColumns,
                        config: {
                            tools: column_tools, // IMPORTANT! ref the column_tools
                        }
                    },
                    header: {
                        class: Header,
                        config: {
                            placeholder: 'Enter a header',
                            levels: [2, 3, 4],
                            defaultLevel: 3
                        }
                    },
                    list: {
                        class: List,
                        inlineToolbar: true,
                        config: {
                            defaultStyle: 'unordered'
                        }
                    },
                    list: {
                        class: NestedList,
                        inlineToolbar: true,
                    },
                    checklist: {
                        class: Checklist,
                        inlineToolbar: true,
                    },
                    table: {
                        class: Table,
                        inlineToolbar: true,
                        config: {
                            rows: 2,
                            cols: 3,
                        },
                    },
                    paragraph: {
                        class: Paragraph,
                        inlineToolbar: true,
                    },
                    code: CodeTool,
                    embed: Embed,
                    warning: Warning,
                    alert: Alert,
                    delimiter: Delimiter,
                    underline: Underline,
                    code: CodeTool,
                    // linkTool: {
                    //     class: LinkTool,
                    //     config: {
                    //         endpoint: 'http://service-gate-cds-omni-service-gate.a.aivencloud.com:8008/fetchUrl', // Your backend endpoint for url data fetching,
                    //     }
                    // },
                    // raw: RawTool,
                    marker: {
                        class: Marker,
                        shortcut: 'CMD+SHIFT+M'
                    },
                    image: {
                        class: ImageTool,
                        config: {
                            endpoints: {
                                byFile: '<?php echo $_SERVER['DOCUMENT_ROOT'];?>/action/action_endpoint_uploadfiles.php', // Your backend file uploader endpoint
                                byUrl: '<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/action/action_endpoint_uploadfiles.php', // Your endpoint that provides uploading by Url
                            }
                        }
                    },

                },
                <?php if($brand_editor<>"")
                {
                    echo ' data: '.$brand_editor;
                }?>
            });
            </script>
        </div>
    </div>
</div>
</div>
<script>
function ns_discover(key, value) {
    key = encodeURIComponent(key);
    value = encodeURIComponent(value);
    // kvp looks like ['key1=value1', 'key2=value2', ...]
    var kvp = document.location.search.substr(1).split('&');
    let i = 0;
    for (; i < kvp.length; i++) {
        if (kvp[i].startsWith(key + '=')) {
            let pair = kvp[i].split('=');
            pair[1] = value;
            kvp[i] = pair.join('=');
            break;
        }
    }
    if (i >= kvp.length) {
        kvp[kvp.length] = [key, value].join('=');
    }
    // can return this or...
    let params = kvp.join('&');
    // reload page with new params
    document.location.search = params;
    //set status
    document.getElementById("status_filter").value =
        'pending,checking,waiting data,waiting image,waiting traffic,waiting confirm,need update contact';
}
function take_ns_requester(id) {
    if (id) {
        $.post("<?php echo $documentRoot; ?>/action/action_take_ns_requester.php", {
            id: id
        }, function(data) {
            $('#contact_person_requester').html(data);
            Notiflix.Notify.success("owner of NS-" + id + "have been change");
        });
    }
}
function take_ns_officer(id) {
    if (id) {
        $.post("/action/action_take_ns_officer.php", {
            id: id
        }, function(data) {
            $('#contact_person_officer').html(data);
            Notiflix.Notify.success("officer of NS-" + id + "have been change");
        });
    }
}
function comment_ns_id_with_file(id) {
    var form_data = new FormData();
    var comment = document.getElementById("comment_input_ns").value;
    document.getElementById('comment_input_ns').value = ''; //clear value
    // var files = document.getElementById('actual-btn').files;
    var ins = document.getElementById('actual-btn_ns').files.length;
    for (var x = 0; x < ins; x++) {
        form_data.append("files[]", document.getElementById('actual-btn_ns').files[x]);
    }
    // form_data.append("files", files)              // Appending parameter named file with properties of file_field to form_data
    form_data.append("comment", comment) // Adding extra parameters to form_data
    form_data.append("id", id)
    $.ajax({
        url: "/action/action_comment_ns.php",
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data, // Setting the data attribute of ajax with file_data
        type: 'post',
        success: function(data) {
            $('#call_ticket_comment_ns').html(data);
            document.getElementById('comment_box_ns').scrollBy(0, document.getElementById(
                "call_ticket_comment_ns").offsetHeight);
            document.getElementById('actual-btn_ns').value = ''; //clear value
            fileChosen_bt.textContent = ' + Attach file or image';
        }
    });
}
function comment_ins_id_with_file(id) {
    var form_data = new FormData();
    var comment = document.getElementById("comment_input_ins").value;
    document.getElementById('comment_input_ins').value = ''; //clear value
    // var files = document.getElementById('actual-btn').files;
    var ins = document.getElementById('actual-btn_ins').files.length;
    for (var x = 0; x < ins; x++) {
        form_data.append("files[]", document.getElementById('actual-btn_ins').files[x]);
    }
    // form_data.append("files", files)              // Appending parameter named file with properties of file_field to form_data
    form_data.append("comment", comment) // Adding extra parameters to form_data
    form_data.append("id", id)
    $.ajax({
        url: "/action/action_comment_ins.php",
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data, // Setting the data attribute of ajax with file_data
        type: 'post',
        success: function(data) {
            $('#call_ticket_comment_ins').html(data);
            document.getElementById('comment_box_ins').scrollBy(0, document.getElementById(
                "call_ticket_comment_ins").offsetHeight);
            document.getElementById('actual-btn_ins').value = ''; //clear value
            fileChosen_bt.textContent = ' + Attach file or image';
        }
    });
}
function force_sync_with_ticket(id, bu) {
    var result_checking_sku = document.getElementById("result_checking_sku").value;
    var sku_change = document.getElementById("sku_checking").value;
    // var be_status_on_change = document.getElementById("be_status_on_change").value;
    if (result_checking_sku == "no_duplicate") {
        be_status_on_change = "Keep";
        if (sku_change) {
            $.post("/action/action_force_change_csg_id_of_sku.php", {
                    id: id,
                    sku_change: sku_change,
                    be_status_on_change: be_status_on_change,
                    bu: bu
                },
                function(data) {
                    $('#sku_checking_result_force').html(data);
                });
        }
    } else {
        Notiflix.Confirm.show(
            'Found some sku in current database',
            'Do you want the system do any action with duplicate ticket ?',
            'Keep duplicate ticket',
            'Cancel duplicate ticket',
            // 'Keep that ticket , I will update some sku then replace sku of that ticket by myself.',
            // 'Cancel that ticket , all sku duplicate and I want to use this ticket to proceed',
            // 'Close , I will update later',
            function okCb() {
                be_status_on_change = "Keep";
                if (sku_change) {
                    $.post("/action/action_force_change_csg_id_of_sku.php", {
                            id: id,
                            sku_change: sku_change,
                            be_status_on_change: be_status_on_change,
                            bu: bu
                        },
                        function(data) {
                            Notiflix.Report.success(
                                'Success',
                                'SKU have updated to CR-' + id,
                                'Okay',
                            );
                            $('#sku_checking_result_force').html(data);
                        });
                }
            },
            function cancelCb() {
                be_status_on_change = "cancel";
                if (sku_change) {
                    $.post("/action/action_force_change_csg_id_of_sku.php", {
                            id: id,
                            sku_change: sku_change,
                            be_status_on_change: be_status_on_change,
                            bu: bu
                        },
                        function(data) {
                            $('#sku_checking_result_force').html(data);
                            Notiflix.Report.success(
                                'Success',
                                'SKU have updated to CR-' + id + ' and duplicate ticket have been cancel',
                                'Okay',
                            );
                        });
                }
            }, {
                width: '500px',
                cancelButtonColor: '#ffffff',
                cancelButtonBackground: '#CF142B',
                clickToClose: true,
                closeButton: true,
                backOverlayClickToClose: true,
            },
        );
    }
}
function itemize_send_mail_stamp(id) {
    Notiflix.Confirm.prompt(
        'Email Stamp',
        'Wait your subkect email',
        '<?php echo $subject_mail; ?>',
        'Stamp',
        'Later',
        function okCb(clientAnswer) {
            alert('Client answer is: ' + clientAnswer);
            let subject_mail = clientAnswer
        },
        function cancelCb(clientAnswer) {
            //nothing
            // alert("user cancel prompt");
        }, {},
    );
    // let subject_mail = prompt("ระบุ subject mail", '<?php echo $subject_mail; ?>');
    if (subject_mail == null || subject_mail == "") {
        // alert("user cancel prompt");
    } else {
        var comment = "[stamp_send_mail]";
        // var subject_mail = document.getElementById("itemize_subject_email").value;
        if (id) {
            $.post("/action/action_stamp_send_mail_itemize.php", {
                    id: id,
                    comment: comment,
                    subject_mail: subject_mail
                },
                function(data) {
                    $('#itemize_stamp_respond').html(data);
                });
        }
    }
}
function sku_checking() {
    // sku_checking_result
    var sku_list = document.getElementById("sku_checking").value;
    if (sku_list) {
        $.post("/action/action_sku_checking.php", {
                sku_list: sku_list
            },
            function(data) {
                $('#sku_checking_result').html(data);
            });
    }
}
// get_detail_more
function form_request_edit_new(id) {
    $.post("/form/form_request_edit_new_2.php", {
            id: id
        },
        function(data) {
            $('#form_request_edit_new_2').html(data);
        });
}
function get_ns_log(action_table, action_data, action_data_id) {
    $.post("/get/get_ns_log.php", {
            action_table: action_table,
            action_data: action_data,
            action_data_id: action_data_id
        },
        function(data) {
            $('#get_ns_log').html(data);
        });
    console.log("action_data_id:" + action_data_id);
}
function get_files(id) {
    $.post("/get/get_file_control.php", {
            id: id
        },
        function(data) {
            $('#get_files').html(data);
        });
}
// get_detail_more
function form_production(id) {
    var table_name = "'add_new_job'";
    $.post("/form/form_value.php", {
            id: id,
            table_name:table_name
        },
        function(data) {
            $('#form_production').html(data);
        });
}
form_production(<?php echo $id; ?>);
form_request_edit_new(<?php echo $id; ?>);
get_ns_log('add_new_job', 'csg', <?php echo $id; ?>);
get_files(<?php echo $id; ?>);
function split_to_subtask(id) {
    var sku_task_set = document.getElementById("sku_task_set").value;
    document.getElementById('bt_create_task').innerHTML =
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...';
    if (id) {
        $.post("/action/action_ns_create_subtask.php", {
                id: id,
                sku_task_set: sku_task_set
            },
            function(data) {
                $('#call_subtask').html(data);
                // alert("Created new sub ticket");
            });
        document.getElementById('sku_task_set').value = ''; //clear value
        document.getElementById('bt_create_task').innerHTML =
            '<ion-icon name="checkmark-done-outline"></ion-icon> Success !!';
    }
}
function action_assign_follow(id) {
    var op_follow_assign_name = document.getElementById("op_follow_assign_name").value;
    if (id) {
        $.post("/action/action_assign_follow.php", {
                id: id,
                op_follow_assign_name: op_follow_assign_name
            },
            function(data) {
                // $('#call_subtask').html(data);
                // alert("Assigned !");
            });
        alert("Assigned !");
    }
}
// toolstip
tippy('#nav-detail-tab', {
    content: "Ticket Information",
    placement: 'top',
    animation: 'fade',
});
tippy('#nav-logs-tab', {
    content: "Updated History",
    placement: 'top',
    animation: 'fade',
});
tippy('#nav-console-tab', {
    content: "Ticket Control",
    placement: 'top',
    animation: 'fade',
});
tippy('#nav-sku-tab', {
    content: "SKUs list",
    placement: 'top',
    animation: 'fade',
});
tippy('#nav-note-tab', {
    content: "Brand Note",
    placement: 'top',
    animation: 'fade',
});
tippy('#discover_more_brand_bt', {
    content: "ดูงานที่เป็นแบรนด์เดียวกัน",
    placement: 'bottom',
    animation: 'fade',
});
tippy('#discover_more_requester_bt', {
    content: "ดูงานที่เป็นถูกสร้างจากผู้ใช้เดียวกัน",
    placement: 'bottom',
    animation: 'fade',
});
tippy('#take_owner_bt', {
    content: "เปลี่ยนข้อมูลผู้ใช้ที่สร้าง ticket นี้ให้เป็นชื่อของคุณ",
    placement: 'bottom',
    animation: 'fade',
});
tippy('#take_officer_bt', {
    content: "รับงานนี้เข้ามาอยู่ในความดูแลของคุณ",
    placement: 'bottom',
    animation: 'fade',
});
tippy('#requester_pg', {
    content: "งานนี้ถูกสร้างโดย <?php echo $request_firstname.' '.$request_lastname;?> เมื่อวันที่ <?php echo $create_date;?>>",
    placement: 'bottom',
    animation: 'fade',
});
tippy('#checking_pg', {
    content: "ทางทีมได้เริ่มตรวจสอบข้อมูลของสินค้า เมื่อวันที่ <?php echo $start_checking_date;?>",
    placement: 'bottom',
    animation: 'fade',
});
tippy('#onproduction_pg', {
    content: "ทางทีมได้เริ่มกระบวนการ production เมื่อวันที่ <?php echo $accepted_date;?>",
    placement: 'bottom',
    animation: 'fade',
});
tippy('#approved_pg', {
    content: "ทางทีมได้การสร้าง product contant แล้วเมื่อวันที่ <?php echo $approved_date;?> และจะทำการปรับ Enable สินค้าเพื่อขึ้นขายวันที่ <?php echo $launch_date;?> ",
    placement: 'bottom',
    animation: 'fade',
});
function copytext(text) {
    // Copy the text inside the text field
    navigator.clipboard.writeText(text);
    // Alert the copied text
    Notiflix.Notify.success("Copy " + text + " to clipboard !");
}
function remove_file(id, path, name) {
    $.post("/action/action_delete_file.php", {
        id: id,
        path: path,
        name: name
    }, function(data) {
        // $('#model_lg').html(data);
        var result = data.includes("Error");
        if (result == false) {
            Notiflix.Notify.success(data);
        } else {
            Notiflix.Report.failure(
                'Failure',
                data,
                'Okay',
            )
        }
        get_files(<?php echo $id; ?>);
    });
}
document.addEventListener('FilePond:processfiles', (e) => {
    Notiflix.Notify.success('The file had been uploaded');
    get_files(<?php echo $id; ?>);
    // console.log('FilePond ready for use', e.detail);
    // get create method reference
    // const { create } = e.detail;
});
timeago().render(document.querySelectorAll('.timeago'));
</script>
<?php
if($status == 'waiting data' or $status =='waiting image'){
echo "<script>Notiflix.Report.warning(
        'Waiting more information',
        'เรียนผู้เกี่ยวข้อง Ticket นี้กำลังรอข้อมูลสินค้าเพิ่มเติมจากผู้เกี่ยวข้อง โปรดดูเพิ่มเติมในช่องแสดงความคิดเห็น <br/> - ขออภัยหากได้ส่งข้อมูลเพิ่มเติมแล้ว -',
        'รับทราบ',
        );</script>";
}
if($status == 'on-productions' and $approved_date <> null){
    echo "<script>Notiflix.Report.success(
            'The job had been approved',
            'เรียนผู้เกี่ยวข้อง Ticket นี้ได้รับการดำเนินการสร้างข้อมูลเนื้อหาบนระบบหลังบ้านเรียบร้อยแล้ว โดยสินค้าขึ้นแสดงบนหน้าว็บ ณ วันที่ ".$luanchdate."<br/><br/><strong> - อย่างไรก็ตามหากท่านต้องการแก้ไขข้อมูลสินค้าสามารถเปิด <a>เปิด ticket เพิ่มเติม</a>ได้</strong>',
            'รับทราบ',
            );</script>";
    }
?>
<!--
var url = new URL("http://foo.bar/?x=1&y=2");
// If your expected result is "http://foo.bar/?x=1&y=2&x=42"
url.searchParams.append('x', 42);
// If your expected result is "http://foo.bar/?x=42&y=2"
url.searchParams.set('x', 42); -->