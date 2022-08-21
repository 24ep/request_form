<?php
  session_start();
  $nickname = $_SESSION["nickname"];
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
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
            ac_request.firstname as request_firstname,
            ac_request.lastname as request_lastname,
            ac_request.office_tell as request_office_tell,
            ac_request.nickname as request_nickname,
            brand_info.link as brand_info_link,
            brand_editor.body  as brand_editor,
            anj.web_cate as web_cate,
            jc.approved_date as approved_date,
            jc.job_number as job_number
            FROM all_in_one_project.add_new_job as anj
            left join all_in_one_project.account as ac
            on ac.username = anj.follow_assign_name
            left join all_in_one_project.account as ac_request
            on ac_request.username = anj.request_username
            left join all_in_one_project.brand_information as brand_info
            on brand_info.brand = anj.brand
            left join u749625779_cdscontent.job_cms as jc
            on anj.id = jc.csg_request_new_id
            left join all_in_one_project.brand_editor as brand_editor
            on brand_editor.brand = anj.brand
            where anj.id = ".$_POST['id']." ORDER BY anj.id DESC " or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {
      $id = $row['id'];
      $brand = $row['brand'];
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
      $brand_info_link = $row['brand_info_link'];
      $web_cate = $row['web_cate'];
      $brand_editor=$row['brand_editor'];
      $trigger_status=$row['trigger_status'];
      $job_number=$row['job_number'];
      $approved_date=$row['approved_date'];
      
    //stamp color status
    if($row["status"]=="pending"){
    $status_style = 'style="background: #a9a9a94f;color:#8f8f8f"';
    }elseif($row["status"]=="checking"){
        $status_style = 'style="background: #ffff7e;color:#997300"';
    }elseif($row["status"]=="accepted"){
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
  $query = "SELECT * FROM account where username = '".$follow_up_by."' ORDER BY id DESC " or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {
    $follow_up_nickname = $row['nickname'];
    $follow_up_name = $row['firstname']." ".substr($row['lastname'],0,2).". ( ".$follow_up_nickname." ) ";
    $office_tell = $row['office_tell'];
    $work_email = $row['work_email'];
  }
  $query = "SELECT * FROM all_in_one_project.add_new_job  where id<> ".$id." and request_username = '".$request_username."' and status not in ('accepted','cancel') ORDER BY id DESC limit 2" or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  $same_owner = '';
  while($row = mysqli_fetch_array($result)) {
    $same_owner .= " <li style='margin-top: 5px;' class='text-nowrap' >NS-".$row['id']." ".$row['brand']." ".$row['sku']." SKUs</li>";
  }
  $same_owner .= " <li style='margin-top: 5px;color: #81a8dd;' class='text-nowrap' ><a type='button' onclick='ns_discover(&#34;user_filter&#34;,&#34;".$request_username."&#34;);' >Discover more <ion-icon name='arrow-forward-outline'></ion-icon></a></li>";
  $query = "SELECT * FROM all_in_one_project.add_new_job  where id<> ".$id." and brand = '".$brand."' and status not in ('accepted','cancel') ORDER BY id DESC limit 2" or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  $same_brand = '';
  while($row = mysqli_fetch_array($result)) {
   
    $same_brand .= " <li style='margin-top: 5px;' class='text-nowrap' >NS-".$row['id']." ".$row['brand']." ".$row['sku']." SKUs</li>";
  }
  $same_brand .= " <li style='margin-top: 5px;color: #81a8dd;' class='text-nowrap' ><a type='button' onclick='ns_discover(&#34;brand_filter&#34;,&#34;".$brand."&#34;);' >Discover more <ion-icon name='arrow-forward-outline'></ion-icon></a></li>";
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
<link rel="stylesheet" href="base/action/notiflix/dist/notiflix-3.2.5.min.css" />
<script src="base/action/notiflix/dist/notiflix-3.2.5.min.js"></script>

<nav class="p-3 bg-white text-dark bg-gradient shadow-sm  ">
    <div class="row">
        <div class="col-4">
            <div class="container-fluid">
                <small>
                    <a type="button" style="text-decoration: none;color: gray;margin-left: 10px;padding: 5px;"
                        onclick="get_page('create_new');">

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
                    </li>
                    <li style="margin-top: 5px;">
                        <ion-icon name="call-outline"></ion-icon> <?php echo $request_office_tell; ?>
                    </li>
                    <li style='margin-top: 5px;color: #81a8dd;'>
                        <a type="button" onclick="take_ns_requester(<?php echo $id;?>)">
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
                    echo '<button type="button" class="btn btn-sm btn-primary m-3 bg-gradient"><ion-icon name="person-outline"></ion-icon> Take officer</button>';
                }else{
                    ?>
                <ul class="contact-person-ns">
                    <li style="margin-top: 5px;">
                        <ion-icon name="person-outline"></ion-icon><?php echo $follow_up_name; ?>
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
            <!-- <nav class="p-3 bg-light text-dark bg-gradient shadow-sm  " style="">
            <div class="container-fluid">
            <a style="text-decoration: none;color: gray;margin-left: 10px;padding: 5px;"><small>
                <ion-icon name="person-outline" style="margin: 0px;"></ion-icon> Contact Person
            </small></a>
                <h5><a class="navbar-brand" href="#"><?php echo $follow_up_name; ?> <?php echo $office_tell; ?></a></h5>
            </div>
            
        </nav> -->

            <?php if($config_type=='parent'){?>

            <div class="row">
                <div class="col-sm-12 shadow officerassingbox">
                    <div id="call_subtask">
                        <?php include('../get/get_sub_task_in_task.php'); ?>
                    </div>
                </div>
            </div>
            <hr>
            <?php }?>

            <?php if($config_type=='task'){?>
            <?php 
                                    if($status=='checking'){
                                        $badge_progres_0 = 'btn-success';
                                        $badge_progres_1 = 'btn-success';
                                        $badge_progres_2 = 'btn-secondary';
                                        $badge_progres_3 = 'btn-secondary';
                                        $badge_progres_4 = 'btn-secondary';
                                        $progress_per = '30';
                                    }elseif($status=='accepted' and $approved_date ==''){
                                        $badge_progres_0 = 'btn-success';
                                        $badge_progres_1 = 'btn-success';
                                        $badge_progres_2 = 'btn-success';
                                        $badge_progres_3 = 'btn-secondary';
                                        $progress_per = '60';
                                    }elseif($status=='accepted' and $approved_date <>''){
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
            <h6 class="ms-5">
                <ion-icon name="podium-outline"></ion-icon><strong>Progress</strong>
            </h6>
            <div class="position-relative" style="margin: 10%!important;margin-top: 50px!important;">
                <div class="progress" style="height: 5px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success shadow-sm"
                        role="progressbar" aria-label="Progress" style="width: <?php echo $progress_per; ?>%;"
                        aria-valuenow="<?php echo $progress_per; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <button type="button"
                    class="position-absolute top-0 start-0 translate-middle btn btn-sm shadow-sm <?php echo $badge_progres_0; ?> rounded-pill"
                    style="width: 2rem; height:2rem;">0</button>
                <small style="top: 50px!important;"
                    class="position-absolute top-100 start-0 translate-middle btn btn-sm"><strong>Request</strong><br><?php echo $create_date; ?></small>
                <button type="button"
                    class="position-absolute top-0 start-30 translate-middle btn btn-sm shadow-sm <?php echo $badge_progres_1; ?> rounded-pill"
                    style="width: 2rem; height:2rem;">1</button>
                <small style="top: 50px!important;"
                    class="position-absolute top-100 start-30 translate-middle btn btn-sm"><strong>Checking</strong>
                    <br><?php echo $accepted_date; ?></small>
                <button type="button"
                    class="position-absolute top-0 start-60 translate-middle btn btn-sm shadow-sm <?php echo $badge_progres_2; ?> rounded-pill"
                    style="width: 2rem; height:2rem;">2</button>
                <small style="top: 50px!important;"
                    class="position-absolute top-100 start-60 translate-middle btn btn-sm"><strong>On-productions</strong>
                    <br><?php echo $job_number; ?></small>
                <button type="button"
                    class="position-absolute top-0 start-100 translate-middle btn btn-sm shadow-sm <?php echo $badge_progres_3; ?> rounded-pill"
                    style="width: 2rem; height:2rem;">3</button>
                <small style="top: 50px!important;"
                    class="position-absolute top-100 start-100 translate-middle btn btn-sm"><strong>Approved</strong><br><?php echo $approved_date; ?></small>
            </div>
            <?php }?>


            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-public-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-public" type="button" role="tab" aria-controls="nav-public"
                        aria-selected="true">
                        <ion-icon name="chatbubble-outline"></ion-icon>Public comment
                    </button>
                    <button class="nav-link" id="nav-detail-tab" data-bs-toggle="tab" data-bs-target="#nav-detail"
                        type="button" role="tab" aria-controls="nav-detail" aria-selected="false">
                        <ion-icon name="receipt-outline"></ion-icon>Ticket infomation
                    </button>
                    <button class="nav-link" id="nav-internal-tab" data-bs-toggle="tab" data-bs-target="#nav-internal"
                        type="button" role="tab" aria-controls="nav-internal" aria-selected="false">
                        <ion-icon name="text-outline"></ion-icon>Internal note
                    </button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-public" role="tabpanel" aria-labelledby="nav-public-tab"
                    tabindex="0">
                    <?php if( $remark<>""){
                        ?>
                    <div class="alert alert-info m-2 shadow-sm" role="alert">
                        <ion-icon name="information-circle-outline"></ion-icon><?php echo $remark;?>
                    </div>
                    <?php
                    }
                    ?>
                    <!-- comment ns -->
                    <ul class="list-group list-group-flush m-1" style="background: fixed;">
                        <div id="comment_box_ns">
                            <div id="call_ticket_comment_ns">
                                <?php include('../get/get_comment_ns.php'); ?>
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
                <div class="tab-pane fade" id="nav-detail" role="tabpanel" aria-labelledby="nav-detail-tab"
                    tabindex="0">
                    <div class="container" style="padding: 20px!important;">
                        <div class="alert alert-primary shadow-sm" role="alert">
                            <ion-icon name="color-wand-outline"></ion-icon>
                            สามาถแก้ไขข้อมูลบางส่วนด้วยตนเองได้ จนกว่า ทาง Content จะทำการ assign
                            ticket นี้ให้กับทางผู้เกี่ยวข้อง
                        </div>
                        <?php include('../form/form_request_edit_new.php')?>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-internal" role="tabpanel" aria-labelledby="nav-internal-tab"
                    tabindex="0">
                    <!-- internal note -->

                    <ul class="list-group list-group-flush m-1" style="background: fixed;">
                        <div id="comment_box_ins">
                            <div id="call_ticket_comment_ins">
                                <?php include('../get/get_comment_ins.php'); ?>
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
        <div class="col-4"
            style="height: -webkit-fill-available;background-color: white;border-left: solid 1px #fde5e5;margin-top: 2.5px;padding: 10px;">





            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">

                    <button class="nav-link active" id="nav-note-tab" data-bs-toggle="tab" data-bs-target="#nav-note"
                        type="button" role="tab" aria-controls="nav-note" aria-selected="true">
                        <ion-icon name="document-text-outline"></ion-icon>
                        <strong><?php echo $brand; ?></strong> Note
                    </button>
                    <button class="nav-link" id="nav-console-tab" data-bs-toggle="tab" data-bs-target="#nav-console"
                        type="button" role="tab" aria-controls="nav-console" aria-selected="false">
                        <strong>Console</strong>
                    </button>
                    <button class="nav-link" id="nav-sku-tab" data-bs-toggle="tab" data-bs-target="#nav-sku"
                        type="button" role="tab" aria-controls="nav-sku" aria-selected="false">
                        <strong>SKU List</strong>
                    </button>
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-note" role="tabpanel" aria-labelledby="nav-note-tab"
                    tabindex="0">

                    <div class="container-fluid " style="padding: 10px;">
                        <div id="editorjs"></div>
                    </div>

                </div>

                <div class="tab-pane fade" id="nav-console" role="tabpanel" aria-labelledby="nav-console-tab"
                    tabindex="0">
                    <?php include('../get/get_internal_console_nj_new.php');?>
                </div>
                <div class="tab-pane fade" id="nav-sku" role="tabpanel" aria-labelledby="nav-sku-tab" tabindex="0">
                    <?php include('../get/get_list_sku_ticket_new.php'); ?>
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
                    console.log('Editor.js is ready to work!');
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
                    //         endpoint: 'http://localhost:8008/fetchUrl', // Your backend endpoint for url data fetching,
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
                                byFile: 'https://content-service-gate.cdse-commercecontent.com/base/action/action_endpoint_uploadfiles.php', // Your backend file uploader endpoint
                                byUrl: 'https://content-service-gate.cdse-commercecontent.com/base/action/action_endpoint_uploadfiles.php', // Your endpoint that provides uploading by Url
                            }
                        }
                    },
                    // attaches: {
                    //     class: AttachesTool,
                    //     config: {
                    //         endpoint: 'https://content-service-gate.cdse-commercecontent.com/base/action/action_endpoint_attachfiles.php'
                    //     }
                    // },
                },
                <?php if($brand_editor<>""){
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
        $.post("../base/action/action_take_ns_requester.php", {
            id: id
        }, function(data) {
            $('#contact_person_requester').html(data);
            Notiflix.Notify.success("owner of NS-" + id + "have been change");
        });
    }
}
function take_ns_officer(id) {
    if (id) {
        $.post("../base/action/action_take_ns_officer.php", {
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
        url: "base/action/action_comment_ns.php",
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
        url: "base/action/action_comment_ins.php",
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
            $.post("base/action/action_force_change_csg_id_of_sku.php", {
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
                    $.post("base/action/action_force_change_csg_id_of_sku.php", {
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
                    $.post("base/action/action_force_change_csg_id_of_sku.php", {
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

function sku_checking() {
    // sku_checking_result
    var sku_list = document.getElementById("sku_checking").value;
    if (sku_list) {
        $.post("base/action/action_sku_checking.php", {
                sku_list: sku_list
            },
            function(data) {
                $('#sku_checking_result').html(data);
            });
    }
}
</script>
<!-- 
var url = new URL("http://foo.bar/?x=1&y=2");

// If your expected result is "http://foo.bar/?x=1&y=2&x=42"
url.searchParams.append('x', 42);

// If your expected result is "http://foo.bar/?x=42&y=2"
url.searchParams.set('x', 42); -->