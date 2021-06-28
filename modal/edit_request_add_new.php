<style>
.modal-content {
    border-radius: 0rem;
    border-color: #b4b4b4;
}

.close {
    background: transparent;
    border: none;
    font-size: 30px;
}

label#label_file_ins {
    color: #adb5bd;
    font-size: 12px;
    font-weight: 600 !important;
}

label#label_file_cme {
    color: #adb5bd;
    font-size: 12px;
    font-weight: 500 !important;
}

.modal {
    background: #fffcfc73;
}

.comment_label {
    padding: 12px;
    text-align: initial;
    /* border-radius: 0.7rem 0.7rem 0.7rem 0rem!important; */
    margin-bottom: 5px;
    font-size: 14px;
    white-space: pre-wrap;
    line-height: normal;
    overflow-wrap: anywhere;
}

.cl_left {
    margin-right: 70px;
    border-radius: 0.7rem 0.7rem 0.7rem 0rem !important;
}

.cl_right {
    margin-left: 70px;
    border-radius: 0.7rem 0.7rem 0rem 0.7rem !important;
}

.inpo.active {
    /* background-color: red!important; */
    background: url('image/11.jpg') !important;
    box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
    color: white !important;
    font-weight: 600;
    width: 100%;
}
</style>
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
<?php 
  session_start();
  $nickname = $_SESSION["nickname"];
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT * FROM add_new_job where id = ".$_POST['id']." ORDER BY id DESC " or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {
      $id = $row['id'];
      $brand = $row['brand'];
      $request_username = $row['request_username'];
      $create_date = $row['create_date'];
      $update_date = $row['update_date'];
      $brand = $row['brand'];
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


  $query = "SELECT * FROM account where username = '".$follow_up_by."' ORDER BY id DESC " or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {
    $follow_up_nickname = $row['nickname'];
    $follow_up_name = $row['firstname']." ".$row['lastname']." ( ".$follow_up_nickname." ) ";
    $office_tell = $row['office_tell'];
    $work_email = $row['work_email'];
  }
  
  mysqli_close($con);
  if($request_important=="Urgent"){
    $dp_tags .= '<span class="badge rounded-pill bg-danger" style="margin-left:10px">'.$request_important.'</span>';
}
  $tags_array = explode(", ", $tags);
  foreach ($tags_array as $tag) {
   $dp_tags .= '<span class="badge rounded-pill bg-dark" style="margin-left:10px">'.$tag.'</span>';
  }
?>
<div class="offcanvas-body" style="padding-bottom: 0px;height: 100%;">
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" style="position: fixed;right: 40px;"
        aria-label="Close"></button>
    <div class="row" style="height: 100%;">
        <div class="col-9" style="border-right: solid 1px #f0eaea;padding-right:0px;height: 85%;">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_add_new_title">
                    <?php echo "<strong><span style='color:red'>NS</span>-".$_POST["id"]."</strong> ".$brand." ".$sku." SKU ". $dp_tags . "<a style='font-size:10px;margin-left:10px' target='_Blank' href='https://content-service-gate.cdsecommercecontent.ga/get/get_ns_log_by_id.php?id=".$_POST["id"]."&action_table=add_new_job&action_data=csg'><small><ion-icon name='time-outline'></ion-icon>Changed log</small></a>"; ?>
                </h5>
                <button type="button" class="btn btn-light btn-sm" <?php echo $status_style; ?>>
                    <?php  echo $status; ?></button>
            </div>
            <div class="modal-body overflow-auto" style="height:100%">
                <!--"-->
                <div class="row" style="height:auto">
                    <div class="col-2" style="border-right: 1px #e6e6e6;border-right-style: double;height: auto;">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">

                            <a class="nav-link active inpo" id="v-pills-progress-tab" data-toggle="pill"
                                href="#v-pills-progress" role="tab" aria-controls="v-pills-progress"
                                aria-selected="false">
                                <ion-icon name="speedometer-outline"></ion-icon>Progress
                            </a>
                            <a class="nav-link inpo" id="v-pills-request_detail-tab" data-toggle="pill"
                                href="#v-pills-request_detail" role="tab" aria-controls="v-pills-request_detail"
                                aria-selected="true">
                                <ion-icon name="reader-outline"></ion-icon>Request Detail
                            </a>
                            <?php if(strpos($_SESSION["department"],'Content')!==false){?>
                            <hr>
                            <a class="nav-link inpo" id="v-pills-fu_team-tab" data-toggle="pill" href="#v-pills-fu_team"
                                role="tab" aria-controls="v-pills-fu_team" aria-selected="false">
                                <ion-icon name="sparkles-outline"></ion-icon>follow-up team
                            </a>
                            <a class="nav-link inpo" id="v-pills-tf_team-tab" data-toggle="pill" href="#v-pills-tf_team"
                                role="tab" aria-controls="v-pills-tf_team" aria-selected="false">
                                <ion-icon name="trail-sign-outline"></ion-icon>traffic team
                            </a>
                            <a class="nav-link inpo" id="v-pills-internal_note-tab" data-toggle="pill"
                                href="#v-pills-internal_note" role="tab" aria-controls="v-pills-internal_note"
                                aria-selected="false">
                                <ion-icon name="chatbox-ellipses-outline"></ion-icon>Internal note
                            </a>
                            <?php }?>
                        </div>
                    </div>
                    <div class="col-10" style="height: 85%;">
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
                                <div class="row">
                                    <div class="col-sm-12">


                                        <div id="call_subtask">
                                            <?php include('../get/get_sub_task_in_task.php'); ?>
                                        </div>

                                    </div>
                                </div>
                                <hr>
                                <h6><strong>Writer & Studio Job</strong></h6>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php include('../get/get_list_job_cms.php'); ?>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade" id="v-pills-request_detail" role="tabpanel"
                                aria-labelledby="v-pills-request_detail-tab">
                                <div class="container" style="padding: 20px!important;">

                                    <?php include('../form/form_request_edit_new.php')?>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-log" role="tabpanel"
                                aria-labelledby="v-pills-log-tab">...</div>
                            <div class="tab-pane fade" id="v-pills-fu_team" role="tabpanel"
                                aria-labelledby="v-pills-fu_team-tab">

                                <?php if(strpos($status,"review")!==false){
                        echo '<div class="alert alert-warning" style="border-radius: 0px;" role="alert">
                        <h6 class="alert-heading" style="margin:0px">
                        <strong>Need more infomation</strong> 
                        </h6><small style="color: gray;">Last reply date : '.$need_more_info_date.'</small>
                        <p style="font-size:14px;margin-top:10px">
                            '.$need_more_info_note.'
                        </p>
                        </div>';
                    }?>
                    <?php 
                    if($start_checking_date<>"" and $start_checking_date<>null){
                        $allow_task_ticket = "disabled";
                        $help_start = "<small>you has been start checking information</small>";
                    }else{unset($allow_task_ticket);unset($help_start;} 
                    if($accepted_date<>"" and $accepted_date<>null){
                        $allow_send_to_traffic = "disabled";
                        $help_traffic = "<small>you has been send this ticket to traffic</small>";
                    }else{unset($allow_send_to_traffic);unset($help_traffic);} 
                    if($cancel_resone<>"" and $cancel_resone<>null){
                        $allow_cancel = "disabled";
                        $allow_send_to_traffic = "disabled";
                        $allow_task_ticket = "disabled";}
                        $help_start = "<small>you has been cancel ticket</small>";
                        $help_traffic = "<small>you has been cancel ticket</small>";
                        $help_cancel = "<small>you has been cancel ticket</small>";
                        else{
                            unset($allow_cancel);
                            unset($help_cancel);
                        } 

                    
                    ?>
                            <h6><strong>Create Sub Ticket</strong></h6>
                                <small>Generate new sub-ticket and convert ticket from buyer to parent ticket</small>
                                <br style="margin-bottom:5px">
                                <div class="row mb-1">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">SKU</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-sm" id="sku_task_set"
                                            name="sku_task_set" placeholder="10,40,23,45,45">
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="button" onclick="split_to_subtask(<?php echo $id; ?>);"
                                            class="btn btn-outline-primary btn-sm">
                                            <ion-icon name="color-wand-outline"></ion-icon>Create sub ticket
                                        </button>
                                    </div>
                                    <div id="emailHelp" class="form-text">
                                        <strong>Does it work ?</strong>
                                        <ul>
                                            <li>Fll separate number of SKUs you want to create sub-ticket</li>
                                            <li>Additional data will be copy from parent ticket</li>
                                            <li>Parent sku do not calculate on report</li>
                                        </ul>
                                    </div>

                                </div>
                                <hr>
                                <h6><strong>Main action Console</strong></h6>
                                <small>Manage you ticket at here , please make sure your step before take action</small>
                                <br style="margin-bottom:5px">
                                <div class="card-group">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">1.Checking information</h6>
                                            <p class="card-text">Press this button first for take a job,the system will
                                                show your contact on detail of ticket and notification to requester
                                                ticket</p>
                                            
                                            <button onclick="start_checking(<?php echo $id; ?>);" type="button"
                                                class="btn btn-primary btn-sm" <?php echo $allow_task_ticket; ?>
                                                style="width: 100%;">Start
                                                Checking</button>
                                            <?php echo $help_start; ?>
                                                
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">
                                                <div id="start_checking_resault">Latest : <?php echo $start_checking_date;?> 
                                                </div>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">2.Confirm send to traffic</h6>
                                            <p class="card-text">Press this button when you completed information for
                                                those SKUs,the system will change status of ticket to 'waiting traffic
                                            </p>
                                            <button onclick="accepted_stt(<?php echo $id; ?>);" type="button"
                                                class="btn btn-success  btn-sm" <?php echo $allow_send_to_traffic; ?> 
                                                style="width: 100%;">Sent to
                                                Traffic</button>
                                                <?php echo $help_traffic; ?>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">
                                                <div id="accept_checking_resault">Latest : <?php echo $accepted_date;?></div>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">2.Cancel ticket</h6>
                                            <p class="card-text">Press this button when you want ... or requester
                                                request to cancel this ticket,please make sure you have a reason for
                                                take this action </p>

                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="resone_cancel" <?php $allow_cancel; ?> 
                                                    name="resone_cancel" value="">
                                                <label for="floatingInputGrid">Reason</label>
                                            </div>
                                            <button onclick="cancel_stt(<?php echo $id; ?>);" type="button"
                                                class="btn btn-danger btn-sm" <?php echo $allow_cancel; ?> 
                                                style="width: 100%;;margin-top:5px">Cancel
                                            </button>
                                            <?php echo $help_cancel; ?>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">
                                                <div id="cancel_checking_resault">Latest : <?php echo $cancel_resone;?></div>
                                            </small>
                                        </div>
                                    </div>
                                </div>



                                
                               


                            </div>
                            <div class="tab-pane fade" id="v-pills-tf_team" role="tabpanel"
                                aria-labelledby="v-pills-tf_team-tab">
                                <form action="action/action_create_job_cms.php" method="POST" target="_blank">
                                    <input type="hidden" id="id_adj" name="id_adj" value="<?php echo  $_POST['id']; ?>">
                                    <?php include('../form/form_create_job_cms.php')?>
                                </form>
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
                        </div>
                    </div>
                    <?php echo $need_more_respone;?>
                </div>
            </div>
            <div class="modal-footer" style="height: 50px;position: absolute;bottom: 15px;width: inherit;">
                <small style="color:gray;position: absolute;left: 10px;">Request by : <a
                        href="action/action_show_user_info.php?username=<?php echo $request_username; ?>"
                        target="_blank" class="text-warning stretched-link"><?php echo $request_username; ?></a> |
                    create date :
                    <?php echo $create_date; ?> | update date : <?php echo $update_date; ?></small>
            </div>
        </div>
        <div class="col-3" style="padding-left:0px">
            <div class="modal-header">
                <h5 class="modal-title">
                    <ion-icon name="chatbubbles-outline"></ion-icon>Comment
                </h5>
            </div>
            <div class="modal-body" style="height: 85%;padding-top: 0px;padding-right: 0px;" id="over_comment">
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
        url: "action/action_comment_ins.php",
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

function comment_cr_id(id) {
    var comment = document.getElementById("comment_input_cr").value;
    document.getElementById('comment_input_cr').value = ''; //clear value
    if (id) {
        $.post("action/action_comment_cr.php", {
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

function comment_ticket_id(id, send_type) {
    var comment = document.getElementById("comment_input").value;
    document.getElementById('comment_input').value = ''; //clear value
    if (id) {
        $.post("action/action_comment_re_add_new.php", {
                id: id,
                send_type: send_type,
                comment: comment
            },
            function(data) {
                $('#call_ticket_comment').html(data);
                document.getElementById('comment_box').scrollBy(0, document.getElementById("call_ticket_comment")
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
        url: "action/action_comment_re_add_new.php",
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
            fileChosen_bt_cme.innerHTML = '<ion-icon style="margin:0px" name="attach-outline"></ion-icon>';
        }
    });
}

function split_to_subtask(id) {
    var sku_task_set = document.getElementById("sku_task_set").value;
    document.getElementById('sku_task_set').value = ''; //clear value
    if (id) {
        $.post("action/action_ns_create_subtask.php", {
                id: id,
                sku_task_set: sku_task_set
            },
            function(data) {
                $('#call_subtask').html(data);
            });
    }
}
</script>