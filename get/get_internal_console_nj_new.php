<?php
 session_start();
 if($cancel_resone<>"" and $cancel_resone<>null){
    $allow_cancel = "disabled";
    $allow_send_to_traffic = "disabled";
    $allow_task_ticket = "disabled";
    $help_start = "<small style='color:Red'>someone had been cancel this ticket</small><br>";
    $help_traffic = "<small style='color:Red'>someone had been cancel this ticket</small><br>";
    $help_cancel = "<small style='color:Red'>someone had been cancel this ticket</small><br>";
}
    else{
        unset($allow_cancel);
        unset($help_cancel);
    }
?>
<?php if($status == 'waiting traffic'){ ?>
<hr>
<h6><strong>Create Writer & Studio - 24ep</strong></h6>
<form action="base/action/action_create_job_cms.php" method="POST" target="_blank">
    <input type="hidden" id="id_adj" name="id_adj" value="<?php echo  $_POST['id']; ?>">
    <?php include('../form/form_create_job_cms.php')?>
</form>
<?php }else{ ?>
<div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                <ion-icon name="mail-outline"></ion-icon> Stamp Email send
            </button>
        </h2>
        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <!-- Itemize send email stamp -->
                <div class="row  p-3  bg-dark text-light rounded bg-gradient shadow-sm">
                    <div class="col-6">
                        <h6><strong>Send Email Stamp</strong></h6>
                        <small>ลงบันทึกส่งอีเมลติดตาม (ระบุ tag ticket id บนอีเมลทุกครั้ง)</small>
                    </div>
                    <div class="col-6">
                        <?php
                                                echo ' <button onclick="itemize_send_mail_stamp('.$id.');"
                                                type="button"
                                                class="btn btn-primary btn-sm"
                                                style="width: 100%;">Save</button>';
               ?>
                    </div>
                    <div class="row">
                        <div id="itemize_stamp_respond">
                        </div>
                    </div>
                </div>
                <!-- end Itemize send email stamp -->
            </div>
        </div>
    </div>
    <?php
                    if($start_checking_date<>"" and $start_checking_date<>null){
                        $allow_task_ticket = "disabled";
                        $help_start = "<small style='color:Red'><strong>".$follow_up_by."</strong> had been start checking information</small>";
                    } elseif($follow_assign_name=="unassign"){
                            $allow_task_ticket = "disabled";
                            $help_start = "<small style='color:Red'>this ticket is unassign</small>";}
                    elseif($follow_assign_name <> $_SESSION["username"]){
                        $allow_task_ticket = "disabled";
                        $help_start = "<small style='color:Red'>Only ".$follow_assign_name."(assignee) can start checking information</small>";
                    }else{unset($allow_task_ticket);unset($help_start);}
                    if($accepted_date<>"" and $accepted_date<>null ){
                        $allow_send_to_traffic = "disabled";
                        $help_traffic = "<small style='color:Red'>someone had been send this ticket to traffic</small><br>";
                    }
                    else{
                        unset($allow_send_to_traffic);unset($help_traffic);
                    }
                    ?>
    <?php if(!isset($parent) or $status <> 'accepted'){
                    ?>
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading5">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse5" aria-expanded="false" aria-controls="flush-collapse5">
                <ion-icon name="cut-outline"></ion-icon> Create Sub-Ticket
            </button>
        </h2>
        <div id="flush-collapse5" class="accordion-collapse collapse" aria-labelledby="flush-heading5"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <div class="row  p-3  bg-dark text-light rounded bg-gradient shadow-sm">
                    <h6><strong>Create Sub-Ticket</strong></h6>
                    <small>Generate new sub-ticket and convert ticket from buyer to parent ticket</small>
                    <form>
                        <div class="row mb-1" style="margin-top:10px">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">SKU</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" id="sku_task_set"
                                    name="sku_task_set" placeholder="10,40,23,45,45" required>
                            </div>
                            <div class="col-sm-3">
                                <button type="button" id="bt_create_task"
                                    onclick="split_to_subtask(<?php echo $id; ?>);"
                                    class="btn btn-outline-primary btn-sm">
                                    <ion-icon name="color-wand-outline"></ion-icon>Create Sub-ticket
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php }else{
        $notic_sub_ticket_message = "<ion-icon name='alert-circle-outline'></ion-icon> <small>this ticket is sub ticket , so you can't use sub ticket function</small>";
    } ?>
    <?php if($config_type=="task"){ ?>
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading6">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse6" aria-expanded="false" aria-controls="flush-collapse6">
                <ion-icon name="bonfire-outline"></ion-icon> Stamp Start checking infomation
            </button>
        </h2>
        <div id="flush-collapse6" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <!-- start -->
                <div class="row  p-3  bg-dark text-light rounded bg-gradient shadow-sm">
                    <div class="col-6">
                        <h6><strong>Start Checking</strong></h6>
                        <small>ลงบันทึกเวลาที่เริ่มตรวจสอบ information/linesheet/duplicate sku</small>
                    </div>
                    <div class="col-6">
                        <?php
                                           echo ' <button onclick="start_checking('.$id.');"
                                           type="button"
                                           class="btn btn-primary btn-sm" '.$allow_task_ticket.'
                                           style="width: 100%;">Start</button>';
                                        ?>
                    </div>
                    <div class="row">
                        <?php echo $help_start." ".$start_checking_date; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php  if($start_checking_date<>"" and $start_checking_date<>null ){?>
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading7">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse7" aria-expanded="false" aria-controls="flush-collapse7">
                <ion-icon name="checkmark-done-circle-outline"></ion-icon> Stamp accept job
            </button>
        </h2>
        <div id="flush-collapse7" class="accordion-collapse collapse" aria-labelledby="flush-heading7"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <!-- accepted -->
                <div class="row  p-3  bg-dark text-light rounded bg-gradient shadow-sm">
                    <div class="col-6">
                        <h6><strong>Complete Checking (Accepted)</strong></h6>
                        <small>ลงบันทึกยืนยันตรวจสอบข้อมูลเรียบร้อย พร้อมเปิด job สำหรับ writer </small>
                    </div>
                    <div class="col-6">
                        <button onclick="accepted_stt(<?php echo $id; ?>);" type="button"
                            class="btn btn-success  btn-sm" <?php echo $allow_send_to_traffic; ?>
                            style="width: 100%;margin-top:5px">accept</button>
                    </div>
                    <div class="row">
                        <?php echo $help_traffic." ".$accepted_date; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading8">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse8" aria-expanded="false" aria-controls="flush-collapse8">
                <ion-icon name="checkmark-done-circle-outline"></ion-icon> Job activity
            </button>
        </h2>
        <div id="flush-collapse8" class="accordion-collapse collapse" aria-labelledby="flush-heading8"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body p-0">
              <?php
               //start task
              $tasks = ['start_checking_date','content_start_date','shoots_start_date','retouch_start_date'];
             
              foreach ($tasks as $task) {
                if(${$task} == null){
                  ${'bt_'.$task} = '<button class="btn btn-sm btn-outline-primary shadow-sm bg-gradient rounded">Start</button>';
                }else{
                  ${'bt_'.$task}  = '<button class="btn btn-sm btn-outline-success shadow-sm bg-gradient rounded">Complete</button>';
                }
              }
              if($upload_image_date <> null){
                $bt_upload_image_date = '<button class="btn btn-sm btn-outline-success shadow-sm bg-gradient rounded">Uploaded</button>';
              }
              if($approved_date <> null){
                $bt_approved_date = '
                <button class="btn btn-sm btn-outline-success shadow-sm bg-gradient rounded">Approve</button>
                <button class="btn btn-sm btn-outline-danger shadow-sm bg-gradient rounded">Reject</button>';
              }
              
              //complete_task
              $tasks = ['accepted_date','content_complete_date','shoots_complete_date','retouch_complete_date'];
             
              foreach ($tasks as $task) {
                if(${$task} == null){
                  ${'bt_'.$task} = 'style="display:block!important"';
                }else{
                  ${'bt_'.$task}  = 'style="display:none!important"';
                }
              }
             
              
              
              
              ?>
            <ul class="list-group">
                  <li class="list-group-item d-flex justify-content-between align-items-center" <?php echo $bt_accepted_date; ?>> Checking <?php echo $bt_start_checking_date; ?> </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center" <?php echo $bt_content_complete_date; ?> > writing <?php echo $bt_content_start_date; ?> </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center" <?php echo $bt_shoots_complete_date; ?>> Shoots <?php echo $bt_shoots_start_date; ?> </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center" <?php echo $bt_retouch_complete_date; ?>> Retouch <?php echo $bt_retouch_start_date; ?> </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center" <?php echo $bt_upload_image_date; ?>> Upload image <?php echo $bt_upload_image_date; ?> </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center" <?php echo $bt_approved_date; ?> > QC <?php echo $bt_approved_date; ?> </li>
                </ul>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php } ?>
    <?php } ?>
</div>

<script>
  function action_stamp(id,attribute_date,attribute_name,name_stamp,table,database){

  }
</script>