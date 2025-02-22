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
<div class="accordion accordion-flush" id="accordionFlushExample">
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
    <?php if($parent=='' and ($accepted_date == '' or $accepted_date == null)){
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
        <h2 class="accordion-header" id="flush-heading8">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse8"
                aria-expanded="false" aria-controls="flush-collapse8">
                <ion-icon name="file-tray-stacked-outline"></ion-icon> Tasks
            </button>
        </h2>
        <div id="flush-collapse8" class="accordion-collapse collapse show" aria-labelledby="flush-heading8"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body p-0">
                <?php
                  if($job_number == null or $job_number == ""){
                    $text_start_jc = "<ion-icon name='warning-outline'></ion-icon> NON CREATE A JOB YET";
                    $bt_disabled_jc = "disabled";
                  }else{
                    $text_start_jc = "start";
                    $bt_disabled_jc = "";
                  }
              if($start_checking_date == null){
                $status_change_to = "checking";
                $bt_checking = '<button
                  onclick="
                  update_value_attribute('.$id.', &#39;cs_edit_start_checking_date&#39; , &#39;cs&#39; , &#39;all_in_one_project&#39; , &#39;add_new_job&#39; , &#39;id&#39;);
                  update_value_attribute('.$id.', &#39;cs_edit_follow_up_by&#39; , &#39;cs&#39; , &#39;all_in_one_project&#39; , &#39;add_new_job&#39; , &#39;id&#39;);
                  update_value_attribute('.$id.', &#39;cs_edit_status&#39; , &#39;cs&#39; , &#39;all_in_one_project&#39; , &#39;add_new_job&#39; , &#39;id&#39;);
                  "
                  class="btn btn-sm btn-outline-primary shadow-sm bg-gradient rounded">Checking</button>';
              }else{
                $status_change_to = "on-productions";
                $bt_checking = '<button
                onclick="
                update_value_attribute('.$id.', &#39;cs_edit_accepted_date&#39; , &#39;cs&#39; , &#39;all_in_one_project&#39; , &#39;add_new_job&#39; , &#39;id&#39;);
                update_value_attribute('.$id.', &#39;cs_edit_status&#39; , &#39;cs&#39; , &#39;all_in_one_project&#39; , &#39;add_new_job&#39; , &#39;id&#39;);
                action_transfer_to_job_cms();
                "
                class="btn btn-sm btn-outline-success shadow-sm bg-gradient rounded">Accept</button>';
              }
              if($recive_item_date == null){
                $bt_recive_item = '<button
                  onclick="
                  update_value_attribute('.$id.', &#39;cs_edit_recive_item_date&#39; , &#39;cs&#39; , &#39;all_in_one_project&#39; , &#39;add_new_job&#39; , &#39;id&#39;);
                  update_value_attribute('.$id.', &#39;cs_edit_product_check_by&#39; , &#39;cs&#39; , &#39;all_in_one_project&#39; , &#39;add_new_job&#39; , &#39;id&#39;);
                  update_value_attribute('.$id.', &#39;cs_edit_studio_sku&#39; , &#39;cs&#39; , &#39;all_in_one_project&#39; , &#39;add_new_job&#39; , &#39;id&#39;);
                  "
                  class="btn btn-sm btn-outline-primary shadow-sm bg-gradient rounded">Recived</button>';
              }
              if($content_start_date == null){
                $bt_content = '<button
                onclick="
                update_value_attribute('.$id.', &#39;cs_edit_content_start_date&#39; , &#39;cs&#39; , &#39;all_in_one_project&#39; , &#39;add_new_job&#39; , &#39;id&#39;);
                update_value_attribute('.$id.', &#39;cs_edit_content_assign_name&#39; , &#39;cs&#39; , &#39;all_in_one_project&#39; , &#39;add_new_job&#39; , &#39;id&#39;);
                "
                class="btn btn-sm btn-outline-primary shadow-sm bg-gradient rounded" '.$bt_disabled_jc.'>'.$text_start_jc.'</button>';
              }else{
                $bt_content = '
                <button   data-bs-toggle="modal" data-bs-target="#exampleModal" style="right: 110px;position: absolute;"
                onclick="convert_to_akeneo_template('.$id.',&#39;'.$job_number.'&#39;,&#39;'.$actual_launch_date.'&#39;,&#39;'.$content_assign_name.'&#39;)"
                class="btn btn-sm btn-outline-dark shadow-sm bg-gradient rounded">Convert to PIM template</button>
                <button
                onclick="
                update_value_attribute('.$id.', &#39;cs_edit_content_complete_date&#39; , &#39;cs&#39; , &#39;all_in_one_project&#39; , &#39;add_new_job&#39; , &#39;id&#39;);
                "
                class="btn btn-sm btn-success shadow-sm bg-gradient rounded">Complete</button>';
              }
              if($shoots_start_date == null){
                $bt_shoots = '<button
                onclick="
                update_value_attribute('.$id.', &#39;cs_edit_shoots_start_date&#39; , &#39;cs&#39; , &#39;all_in_one_project&#39; , &#39;add_new_job&#39; , &#39;id&#39;);
                update_value_attribute('.$id.', &#39;cs_edit_shoots_assign_name&#39; , &#39;cs&#39; , &#39;all_in_one_project&#39; , &#39;add_new_job&#39; , &#39;id&#39;);
                "
                class="btn btn-sm btn-outline-primary shadow-sm bg-gradient rounded"'.$bt_disabled_jc.'>'.$text_start_jc.'</button>';
              }else{
                $bt_shoots= '<button
                onclick="
                update_value_attribute('.$id.', &#39;cs_edit_shoots_complete_date&#39; , &#39;cs&#39; , &#39;all_in_one_project&#39; , &#39;add_new_job&#39; , &#39;id&#39;);
                "
                class="btn btn-sm btn-success shadow-sm bg-gradient rounded">Complete</button>';
              }
              if($retouch_start_date == null){
                $bt_retouch = '<button
                onclick="
                update_value_attribute('.$id.', &#39;cs_edit_retouch_start_date&#39; , &#39;cs&#39; , &#39;all_in_one_project&#39; , &#39;add_new_job&#39; , &#39;id&#39;);
                update_value_attribute('.$id.', &#39;cs_edit_retouch_assign_name&#39; , &#39;cs&#39; , &#39;all_in_one_project&#39; , &#39;add_new_job&#39; , &#39;id&#39;);
                "
                class="btn btn-sm btn-outline-primary shadow-sm bg-gradient rounded" '.$bt_disabled_jc.'>'.$text_start_jc.'</button>';
              }else{
                $bt_retouch = '<button
                onclick="
                update_value_attribute('.$id.', &#39;cs_edit_retouch_complete_date&#39; , &#39;cs&#39; , &#39;all_in_one_project&#39; , &#39;add_new_job&#39; , &#39;id&#39;);
                "
                class="btn btn-sm btn-success shadow-sm bg-gradient rounded">Complete</button>';
              }
              if($upload_image_date == null){
                $bt_upload_image = '<button
                onclick="
                update_value_attribute('.$id.', &#39;cs_edit_upload_image_date&#39; , &#39;cs&#39; , &#39;all_in_one_project&#39; , &#39;add_new_job&#39; , &#39;id&#39;);
                update_value_attribute('.$id.', &#39;cs_edit_upload_image_by&#39; , &#39;cs&#39; , &#39;all_in_one_project&#39; , &#39;add_new_job&#39; , &#39;id&#39;);
                "
                class="btn btn-sm btn-outline-primary shadow-sm bg-gradient rounded" '.$bt_disabled_jc.' >Uploaded</button>';
              }
              if($approved_date == null){
                $bt_approve = '
                <button
                onclick="
                align_stage_status(&#39;approved&#39;);
                update_value_attribute('.$id.', &#39;cs_edit_approved_date&#39; , &#39;cs&#39; , &#39;all_in_one_project&#39; , &#39;add_new_job&#39; , &#39;id&#39;);
                update_value_attribute('.$id.', &#39;cs_edit_approved_by&#39; , &#39;cs&#39; , &#39;all_in_one_project&#39; , &#39;add_new_job&#39; , &#39;id&#39;);
                update_value_attribute('.$id.', &#39;cs_edit_status&#39; , &#39;cs&#39; , &#39;all_in_one_project&#39; , &#39;add_new_job&#39; , &#39;id&#39;);
                "
                class="btn btn-sm btn-success shadow-sm bg-gradient rounded" style="right: 90px;position: absolute;" '.$bt_disabled_jc.' >Approve</button>
                <button data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="form_reject('.$id.')" class="btn btn-sm btn-outline-danger shadow-sm bg-gradient rounded" '.$bt_disabled_jc.'>Reject</button>';
              }
              //complete_task
              $tasks = ['accepted_date','content_complete_date','shoots_complete_date','retouch_complete_date','upload_image_date','recive_item_date','approved_date'];
              foreach ($tasks as $task) {
                if(${$task} == null){
                  ${'bt_'.$task} = '';
                }else{
                  ${'bt_'.$task}  = 'style="display:none!important"';
                }
              }
              ?>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center"
                        <?php echo $bt_accepted_date; ?>>
                        Checking <?php echo $bt_checking; ?>
                        <input type="hidden" id="cs_edit_start_checking_date" value="CURRENT_TIMESTAMP">
                        <input type="hidden" id="cs_edit_accepted_date" value="CURRENT_TIMESTAMP">
                        <input type="hidden" id="cs_edit_status" value="<?php echo $status_change_to;?>">
                        <input type="hidden" id="cs_edit_follow_up_by" value="<?php echo $_SESSION['username'];?>">
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Send email stamp
                        <button onclick="itemize_send_mail_stamp(<?php echo $id; ?>);" type="button"
                            class="btn btn-primary btn-sm">Save</button>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center"
                        <?php echo $bt_content_complete_date; ?>>
                        writing <?php echo $bt_content; ?>
                        <input type="hidden" id="cs_edit_content_start_date" value="CURRENT_TIMESTAMP">
                        <input type="hidden" id="cs_edit_content_complete_date" value="CURRENT_TIMESTAMP">
                        <input type="hidden" id="cs_edit_content_assign_name"
                            value="<?php echo $_SESSION['username'];?>">
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center"
                        <?php echo $bt_recive_item_date; ?>>
                        Recive Item <?php echo $bt_recive_item; ?>
                        <input type="hidden" id="cs_edit_recive_item_date" value="CURRENT_TIMESTAMP">
                        <input type="hidden" id="cs_edit_studio_sku" value="<?php echo $sku;?>">
                        <input type="hidden" id="cs_edit_product_check_by" value="<?php echo $_SESSION['username'];?>">
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center"
                        <?php echo $bt_shoots_complete_date; ?>>
                        Shoots <?php echo $bt_shoots; ?>
                        <input type="hidden" id="cs_edit_shoots_start_date" value="CURRENT_TIMESTAMP">
                        <input type="hidden" id="cs_edit_shoots_complete_date" value="CURRENT_TIMESTAMP">
                        <input type="hidden" id="cs_edit_shoots_assign_name"
                            value="<?php echo $_SESSION['username'];?>">
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center"
                        <?php echo $bt_retouch_complete_date; ?>>
                        Retouch <?php echo $bt_retouch; ?>
                        <input type="hidden" id="cs_edit_retouch_start_date" value="CURRENT_TIMESTAMP">
                        <input type="hidden" id="cs_edit_retouch_complete_date" value="CURRENT_TIMESTAMP">
                        <input type="hidden" id="cs_edit_retouch_assign_name"
                            value="<?php echo $_SESSION['username'];?>">
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center"
                        <?php echo $bt_upload_image_date; ?>>
                        Upload image <?php echo $bt_upload_image; ?>
                        <input type="hidden" id="cs_edit_upload_image_date" value="CURRENT_TIMESTAMP">
                        <input type="hidden" id="cs_edit_upload_image_by" value="<?php echo $_SESSION['username'];?>">
                        <input type="hidden" id="cs_edit_upload_image_by" value="<?php echo $_SESSION['username'];?>"
                            <input type="hidden" id="cs_edit_check_image" value="Yes">
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center"
                        <?php echo $bt_approved_date; ?>>
                        QC <?php echo $bt_approve; ?> </li>
                    <input type="hidden" id="cs_edit_approved_date" value="CURRENT_TIMESTAMP">
                    <input type="hidden" id="cs_edit_approved_by" value="<?php echo $_SESSION['username'];?>">
                    <input type="hidden" id="cs_edit_approved_editing_status" value="approved">
                    <input type="hidden" id="cs_edit_status" value="approved">
                </ul>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<script>
function action_transfer_to_job_cms() {
    id = document.getElementById('anj_edit_id').value;
    bu = document.getElementById('anj_edit_bu').value;
    transfer_type = "Data and Photo";
    production_type = document.getElementById('anj_edit_production_type').value;
    department = document.getElementById('anj_edit_department').value;
    sub_department = document.getElementById('anj_edit_sub_department').value;
    actual_launch_date = document.getElementById('anj_edit_actual_launch_date').value;
    sku = document.getElementById('anj_edit_sku').value;
    product_sell_type = "Normall";
    // product_sorting = "Product";
    job_status_filter = "Continue"
    brand = document.getElementById('anj_edit_brand').value;
    product_website = document.getElementById('anj_edit_online_channel').value;
    recive_mail_date = document.getElementById('anj_edit_create_date').value;
    project_type = document.getElementById('anj_edit_project_type').value;
    $.post("/action/action_create_job_cms.php", {
            id: id,
            bu: bu,
            transfer_type: transfer_type,
            production_type: production_type,
            department: department,
            sub_department: sub_department,
            actual_launch_date: actual_launch_date,
            sku: sku,
            product_sell_type: product_sell_type,
            job_status_filter: job_status_filter,
            brand: brand,
            product_website: product_website,
            recive_mail_date: recive_mail_date
        },
        function(data) {
            // $('#form_production').html(data);
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
        });
}
function convert_to_akeneo_template(id, job_number, launch_date, content_assign_name) {
    Notiflix.Loading.hourglass('Loading...');
    $.post("/convert/interface.php", {
            id: id,
            job_number: job_number,
            launch_date: launch_date,
            content_assign_name: content_assign_name
        },
        function(data) {
            $('#model_lg').html(data);
            Notiflix.Loading.remove();
        });
}
function form_reject(id) {
    Notiflix.Loading.hourglass('Loading...');
    $.post("/form/form_ns_reject.php", {
            id: id
        },
        function(data) {
            $('#model_lg').html(data);
            Notiflix.Loading.remove();
        });
}
function align_stage_status(status){
    document.getElementById('cs_edit_status').value = status;
}
</script>