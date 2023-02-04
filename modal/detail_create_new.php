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
            brand_info.link as brand_info_link,
            brand_editor.body  as brand_editor,
            anj.web_cate as web_cate,
            jc.approved_date as approved_date,
            jc.job_number as job_number
            FROM all_in_one_project.add_new_job as anj
            left join all_in_one_project.account as ac
            on ac.username = anj.follow_assign_name
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
  $query = "SELECT * FROM account where username = '".$follow_up_by."' ORDER BY id DESC " or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {
    $follow_up_nickname = $row['nickname'];
    $follow_up_name = $row['firstname']." ".substr($row['lastname'],0,2).". ( ".$follow_up_nickname." ) ";
    $office_tell = $row['office_tell'];
    $work_email = $row['work_email'];
  }
  if($follow_up_name==""){
    $follow_up_name = '-';
    $office_tell = '-';
    $work_email = '-';
  }
  mysqli_close($con);
  if($request_important=="Urgent"){
    $dp_tags .= '<span class="badge bg-danger" style="margin: 0px 10px 10px 0px;padding: 8px;">'.$request_important.'</span>';
}
  $tags_array = explode(", ", $tags);
  foreach ($tags_array as $tag) {
   $dp_tags .= '<span class="badge bg-dark" style="margin: 0px 10px 10px 0px;padding: 8px;">'.$tag.'</span>';
  }
?>
<div class="offcanvas-body" style="padding-bottom: 0px;height: 100%;">
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" style="position: fixed;right: 40px;"
        aria-label="Close"></button>
    <div class="row" style="height: 100%;margin-bottom: 0px;padding: 0px 20px;">
        <div class="col-9" style="border-right: solid 1px #f0eaea;padding-right:0px;height: 85%;">
            <!-- <div class="modal-header nsbox_header" >
                <h5 class="modal-title" id="edit_add_new_title">
                    <?php //echo "<strong><span style='color:red'>NS</span>-".$_POST["id"]."</strong> ".$brand." ".$sku." SKU ". $dp_tags . "<a style='font-size:10px;margin-left:10px' target='_Blank' href='https://content-service-gate.cdse-commercecontent.com/base/get/get_ns_log_by_id.php?id=".$_POST["id"]."&action_table=add_new_job&action_data=csg'><small><ion-icon name='time-outline'></ion-icon>Changed log</small></a>"; ?>
                </h5>
                <button type="button" class="btn btn-light btn-sm" <?php //echo $status_style; ?>>
                    <?php  //echo $status; ?></button>
            </div>
            <hr> -->
            <div class="modal-body" style="height:100%;padding-top: 0px;padding-bottom: unset;">
                <div class="row" style="height:100%">
                    <div class="col-2 ns_detail_menu_box shadow-sm">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link active inpo" id="v-pills-progress-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-progress" role="tab" aria-controls="v-pills-progress"
                                aria-selected="false">
                                <ion-icon name="speedometer-outline"></ion-icon>Progress
                            </a>
                            <a class="nav-link inpo" id="v-pills-request_detail-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-request_detail" role="tab" aria-controls="v-pills-request_detail"
                                aria-selected="true">
                                <ion-icon name="reader-outline"></ion-icon>Request Detail
                            </a>
                            <?php if($config_type=='task'){?>
                            <hr>
                            <small class="content-assignee-header">Job Detail</small>
                            <ul class="contact-person-ns">
                                <li style="margin-top: 5px;">
                                    <ion-icon name="ticket-outline"></ion-icon><strong><span style='color:red'>NS-</span><?php echo $_POST["id"]; ?></strong>
                                </li>
                                <li style="margin-top: 5px;">
                                    <ion-icon name="storefront-outline"></ion-icon> <?php echo $brand; ?>
                                </li>
                                <li style="margin-top: 5px;">
                                    <ion-icon name="server-outline"></ion-icon> <?php echo $sku; ?> SKUs
                                </li>
                            </ul>
                            <hr>
                            <small class="content-assignee-header">Content Assinee</small>
                            <ul class="contact-person-ns">
                                <li style="margin-top: 5px;">
                                    <ion-icon name="person-outline"></ion-icon><?php echo $follow_up_name; ?>
                                </li>
                                <li style="margin-top: 5px;">
                                    <ion-icon name="call-outline"></ion-icon> <?php echo $office_tell; ?>
                                </li>
                            </ul>
                            <?php }?>
                            <?php if(strpos($_SESSION["department"],'Content')!==false){?>
                            <hr>
                            <a class="nav-link inpo" id="v-pills-cp-tab" data-bs-toggle="pill" data-bs-target="#v-pills-cp"
                                role="tab" aria-controls="v-pills-cp" aria-selected="false">
                                <ion-icon name="grid-outline"></ion-icon>Control Panel
                            </a>
                            <a class="nav-link inpo" id="v-pills-sku-checking-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-sku-checking" role="tab" aria-controls="v-pills-sku-checking"
                                aria-selected="false">
                                <ion-icon name="trail-sign-outline"></ion-icon>SKU Checking
                            </a>
                            <a class="nav-link inpo" id="v-pills-sku-tab" data-bs-toggle="pill" data-bs-target="#v-pills-sku"
                                role="tab" aria-controls="v-pills-sku" aria-selected="false">
                                <ion-icon name="trail-sign-outline"></ion-icon>SKU list
                            </a>
                            <a class="nav-link inpo" id="v-pills-internal_note-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-internal_note" role="tab" aria-controls="v-pills-internal_note"
                                aria-selected="false">
                                <ion-icon name="chatbox-ellipses-outline"></ion-icon>Internal note
                            </a>
                            <?php }?>
                        </div>
                    </div>
                    <div class="col-10 overflow-auto ns_detail_box" style="padding: 30px;">
                        <?php
            if(strpos(strtolower ($status),"waiting data",0)!== false or strpos(strtolower ($status),"wait image",0)!== false ){
                echo '<div class="alert alert-danger" style="border-radius: 0px;"role="alert">
                        <ion-icon name="alert-circle-outline"></ion-icon>
                        Need more information โปรดูในช่อง Comment ล่างสุด หากมีข้อสงสัย <strong>กรุณาติดต่อ คุณ'.$follow_up_nickname.' โทร '.$office_tell.'</strong>
                    </div>';
                }
                elseif(strpos(strtolower ($status),"waiting confirm",0)!== false ){
                echo '<div class="alert alert-warning" style="border-radius: 0px;"role="alert">
                    <ion-icon name="checkmark-done-outline"></ion-icon>
                    เราได้รับข้อมูลตอบกลับของคุณแล้ว โปรดรอการยืนยันจาากทางทีม หากมีข้อสงสัย <strong>กรุณาติดต่อ คุณ'.$follow_up_nickname.' โทร '.$office_tell.'</strong>
                </div>';
                }
        ?>
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-progress" role="tabpanel"
                                aria-labelledby="v-pills-progress-tab">
                                <?php echo $dp_tags;?>
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
                                    <div class="position-relative m-5" style="margin-bottom: 5rem!important;">
                                    <div class="progress" style="height: 5px;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-label="Progress" style="width: <?php echo $progress_per; ?>%;" aria-valuenow="<?php echo $progress_per; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm <?php echo $badge_progres_0; ?> rounded-pill" style="width: 2rem; height:2rem;">0</button>
                                    <small style="top: 50px!important;" class="position-absolute top-100 start-0 translate-middle btn btn-sm"><strong>Request</strong><br><?php echo $create_date; ?></small>
                                    <button type="button" class="position-absolute top-0 start-30 translate-middle btn btn-sm <?php echo $badge_progres_1; ?> rounded-pill" style="width: 2rem; height:2rem;">1</button>
                                    <small style="top: 50px!important;" class="position-absolute top-100 start-30 translate-middle btn btn-sm"><strong>Checking</strong> <br><?php echo $accepted_date; ?></small>
                                    <button type="button" class="position-absolute top-0 start-60 translate-middle btn btn-sm <?php echo $badge_progres_2; ?> rounded-pill" style="width: 2rem; height:2rem;">2</button>
                                    <small style="top: 50px!important;" class="position-absolute top-100 start-60 translate-middle btn btn-sm"><strong>On-productions</strong> <br><?php echo $job_number; ?></small>
                                    <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm <?php echo $badge_progres_3; ?> rounded-pill" style="width: 2rem; height:2rem;">3</button>
                                    <small style="top: 50px!important;" class="position-absolute top-100 start-100 translate-middle btn btn-sm"><strong>Approved</strong><br><?php echo $approved_date; ?></small>
                                    </div>
                                <!-- <h6>
                                    <ion-icon name="color-wand-outline"></ion-icon><strong>Productions Job</strong>
                                </h6> -->
                                <!-- <div class="row">
                                    <div class="col-sm-12">
                                        <?php// include('../get/get_list_job_cms.php'); ?>
                                    </div>
                                </div> -->
                                <?php }?>
                                <h6>
                                    <ion-icon name="document-text-outline"></ion-icon>
                                    <strong><?php echo $brand; ?></strong> Note <small
                                        style="color:red">ข้อความที่อยู่ใน block นี้จะแสดงในทุกๆ ticket
                                        ของแบรนด์ดังกล่าว</small>
                                </h6>
                                <div class="container-fluid shadow-sm"
                                    style="border-radius: 10px;border: 1px solid #f4f4f4;padding: 30px;">
                                    <div id="editorjs"></div>
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
                                        placeholder: 'Let`s write commitment and brand guideline together !',
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
                                    }
                                );
                                </script>
                            </div>
                            <div class="tab-pane fade" id="v-pills-request_detail" role="tabpanel"
                                aria-labelledby="v-pills-request_detail-tab">
                                <div class="container" style="padding: 20px!important;">
                                    <div class="alert alert-primary" role="alert">
                                        <ion-icon name="color-wand-outline"></ion-icon>
                                        สามาถแก้ไขข้อมูลบางส่วนด้วยตนเองได้ จนกว่า ทาง Content-Traffic จะทำการ assign
                                        ticket นี้ให้กับทางผู้เกี่ยวข้อง
                                    </div>
                                    <?php include('../form/form_request_edit_new.php')?>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-sku-checking" role="tabpanel"
                                aria-labelledby="v-pills-sku-checking-tab">
                                <div class="row">
                                    <div class="col-6">
                                        <label style="margin-top:5px;margin-bottom:5px" for="sku_checking">sku
                                            checking</label>
                                        <textarea style="font-size:12px" oninput="sku_checking()" class="form-control"
                                            id="sku_checking" name="sku_accepted"
                                            placeholder="ตรวจสอบ IBC ตามตัวอย่างด้านล่าง วางตามตัวอย่างด้านล่าง&#10;&#10;3466644&#10;2443356&#10;2487356"
                                            rows="20" style="height: 300px"></textarea>
                                        <!-- 
                                        <div class="form-floating" style="margin-top:10px"> -->
                                        <!-- <select class="form-select" style="margin-top:10px" id="be_status_on_change"
                                                aria-label="Floating label select example">
                                                <option selected value="cancel">ให้ยกเลิก ticket นั้น (ปรับสถานะเป็น
                                                    cancel)</option>
                                                <option value="keep">ให้คงสถานะเดิมไว้</option>
                                            </select> -->
                                        <!-- <label for="floatingSelect">สถานะ ticket เดิมในกรณีที่เป็น sku
                                                ที่มีอยู่แล้ว</label>
                                        </div> -->
                                        <input type="hidden" id="result_checking_sku" name="result_checking_sku"
                                            value="">
                                        <button type="button" style="margin-top:10px"
                                            onclick="force_sync_with_ticket(<?php echo $_POST['id'].',&#34;'.$bu.'&#34;'; ?>)"
                                            class="btn btn-danger">ยืนยัน เชื่อมต่อ sku ด้านบนกับ ticket NS-
                                            <?php echo $_POST["id"];?></button>
                                        <br><small>ในกรณี ย้าย sku จาก ตัวแม่ "ให้เลือก คงสถานะเดิมไว้"</small>
                                    </div>
                                    <div class="col-6">
                                        <div id="sku_checking_result">
                                        </div>
                                        <div id="sku_checking_result_force">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-sku" role="tabpanel"
                                aria-labelledby="v-pills-sku-tab">
                                <?php include('../get/get_list_sku_ticket.php'); ?>
                            </div>
                            <div class="tab-pane fade" id="v-pills-internal_note" role="tabpanel"
                                aria-labelledby="v-pills-internal_note-tab">
                                <ul class="list-group list-group-flush" style="background: fixed;">
                                    <div id="comment_box_ins">
                                        <div id="call_ticket_comment_ins">
                                            <?php include('../get/get_comment_ins.php'); ?>
                                        </div>
                                    </div>
                                </ul>
                                <small style="font-weight: bolder;color: #adb5bd;">
                                    <ion-icon name="chatbubbles-outline"></ion-icon>Comment
                                </small>
                                <textarea id="comment_input_ins"
                                    style="margin-top:0px;margin-bottom:10px;font-size: 14px;" class="form-control"
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
                            </div>
                            <!-- new cp -->
                            <?php include('../get/get_internal_console_nj.php');?>
                            <!-- new cp -->
                        </div>
                    </div>
                    <?php //echo $need_more_respone;?>
                </div>
            </div>
            <div class="modal-footer" style="margin: 15px;position: relative;">
                <small style="color:gray;position: inherit;">Request by : <a
                        href="action/action_show_user_info.php?username=<?php echo $request_username; ?>"
                        target="_blank" class="text-warning stretched-link"><?php echo $request_username; ?></a> |
                    create date :
                    <?php echo $create_date; ?> | update date : <?php echo $update_date; ?></small>
            </div>
        </div>
        <div class="col-3" style="padding-left:0px">
            <div class="modal-header">
                <h5 class="modal-title" style="padding: 20px;">
                    <ion-icon name="chatbubbles-outline"></ion-icon>Comment
                </h5>
            </div>
            <div class="modal-body" style="height: 85%;padding-top: 0px;padding-right: 0px;padding-left: 20px;" id="over_comment">
                <div class=" overflow-auto" id="comment_box" style="height: auto;margin-bottom: 0px;margin-top: 0px;">
                    <div id="call_ticket_comment">
                        <?php   include('../get/get_comment_ticket.php');?>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="height: 50px;position: absolute;bottom: 15px;width: inherit;">
                <div class="input-group input-group-sm mb-3">
                    <?php echo  $bt_comment_type;?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
var actualBtn_cme = document.getElementById('actual-btn_cme');
var fileChosen_cme = document.getElementById('file-chosen_cme');
var fileChosen_bt_cme = document.getElementById('label_file_cme');
actualBtn_cme.addEventListener('change', function() {
    // fileChosen.textContent = this.files[0].name
    count_file_cme = this.files.length;
    var i_cme;
    var file_name_cme;
    for (i_cme = 0; i_cme < count_file_cme; i_cme++) {
        if (i_cme == 0) {
            file_name_cme = this.files[i_cme].name;
        } else {
            file_name_cme += " , " + this.files[i_cme].name;
        }
    }
    if (file_name_cme == "undefined") {
        fileChosen_bt_cme.textContent = "";
    }
    fileChosen_bt_cme.textContent = count_file_cme + " Files";
})
//other content
var actualBtn = document.getElementById('actual-btn_ins');
var fileChosen = document.getElementById('file-chosen_ins');
var fileChosen_bt = document.getElementById('label_file_ins');
actualBtn.addEventListener('change', function() {
    // fileChosen.textContent = this.files[0].name
    count_file = this.files.length;
    var i;
    var file_name;
    for (i = 0; i < count_file; i++) {
        if (i == 0) {
            file_name = this.files[i].name;
        } else {
            file_name += " , " + this.files[i].name;
        }
    }
    if (file_name == "undefined") {
        fileChosen_bt.textContent = "";
    }
    fileChosen_bt.textContent = ' Selected file : ' + file_name;
})
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
function itm_just_status_updated_contact(id) {
    var new_contact_vender = document.getElementById('new_contact_vender').value;
    var new_contact_buyer = document.getElementById('new_contact_buyer').value;
    if (id) {
        $.post("base/action/action_itm_updated_contact_status.php", {
            id: id,
            new_contact_buyer: new_contact_buyer,
            new_contact_vender: new_contact_vender
        }, function(data) {
            $('#contact_update').html(data);
        });
    }
}
function comment_cr_id(id) {
    var comment = document.getElementById("comment_input_cr").value;
    document.getElementById('comment_input_cr').value = ''; //clear value
    if (id) {
        $.post("base/action/action_comment_cr.php", {
                id: id,
                comment: comment
            },
            function(data) {
                $('#call_ticket_comment_cr').html(data);
                document.getElementById('comment_box_cr').scrollBy(0, document.getElementById(
                    "call_ticket_comment_cr").offsetHeight);
            });
    }
}
function itemize_send_mail_stamp(id) {
    let subject_mail = prompt("ระบุ subject mail", '<?php echo $subject_mail; ?>');
    if (subject_mail == null || subject_mail == "") {
        alert("user cancel prompt");
    } else {
        var comment = "[stamp_send_mail]";
        // var subject_mail = document.getElementById("itemize_subject_email").value;
        if (id) {
            $.post("base/action/action_stamp_send_mail_itemize.php", {
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
function itm_just_status_need_updated_contact(id) {
    if (id) {
        $.post("base/action/action_itm_need_update_contact.php", {
                id: id
            },
            function(data) {
                $('#itemize_need_to_update_respond').html(data);
            });
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
function comment_ticket_id(id, send_type) {
    var comment = document.getElementById("comment_input").value;
    document.getElementById('comment_input').value = ''; //clear value
    if (id) {
        $.post("base/action/action_comment_re_add_new.php", {
                id: id,
                send_type: send_type,
                comment: comment
            },
            function(data) {
                $('#call_ticket_comment').html(data);
                document.getElementById('comment_box').scrollBy(0, document.getElementById(
                        "call_ticket_comment")
                    .offsetHeight);
            });
    }
}
function comment_cme_id_with_file(id, send_type) {
    var form_data = new FormData();
    var comment = document.getElementById("comment_input").value;
    document.getElementById('comment_input').value = ''; //clear value
    // var files = document.getElementById('actual-btn').files;
    var cme = document.getElementById('actual-btn_cme').files.length;
    for (var i = 0; i < cme; i++) {
        form_data.append("files_cme[]", document.getElementById('actual-btn_cme').files[i]);
    }
    // form_data.append("files", files)              // Appending parameter named file with properties of file_field to form_data
    form_data.append("comment", comment) // Adding extra parameters to form_data
    form_data.append("id", id)
    form_data.append("send_type", send_type)
    $.ajax({
        url: "base/action/action_comment_re_add_new.php",
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data, // Setting the data attribute of ajax with file_data
        type: 'post',
        success: function(data) {
            $('#call_ticket_comment').html(data);
            document.getElementById('comment_box').scrollBy(0, document.getElementById(
                "call_ticket_comment").offsetHeight);
            document.getElementById('actual-btn_cme').value = ''; //clear value
            fileChosen_bt_cme.innerHTML =
                '<ion-icon style="margin:0px" name="attach-outline"></ion-icon>';
        }
    });
}
function split_to_subtask(id) {
    var sku_task_set = document.getElementById("sku_task_set").value;
    document.getElementById('bt_create_task').innerHTML =
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...';
    if (id) {
        $.post("base/action/action_ns_create_subtask.php", {
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
        $.post("base/action/action_assign_follow.php", {
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
</script>