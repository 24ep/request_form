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
<div class="tab-pane fade" id="v-pills-cp" role="tabpanel" aria-labelledby="v-pills-cp-tab">
    <!-- assign -->
    <form class="row g-3 action-block">
        <div class="col-4">
            <h6><strong>Person Assignee</strong></h6>
            <small>มอมหมายงานนี้ให้กับบุึลอื่น หรือตัวเอง</small>
        </div>
        <div class="col-4">
            <select class="form-select form-select-sm" id="op_follow_assign_name" name="op_follow_assign_name"
                aria-label="Default select example">
                <?php
                      $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
                    $query = "SELECT account.username as username,account.nickname as nickname,account.department as department,account.status as status ,sum(new_job.sku) as backlog_sku
                                            FROM account as account
                                            left join add_new_job as new_job on account.username = new_job.follow_assign_name and new_job.status <> 'on-productions' and  new_job.status like '%cancel%' and new_job.status <> 'none'
                                            group by account.username
                                            having (account.department like '%Content%' and account.status = 'Enabled') or account.username ='".$follow_assign_name."'" or die("Error:" . mysqli_error($con));
                                            $result = mysqli_query($con, $query);
                                            echo  '<option value="unassign">unassign</option>';
                                            while($row = mysqli_fetch_array($result)) {
                                                if($row["backlog_sku"]==null){$backlog_sku = 0;}else{$backlog_sku = $row["backlog_sku"];}
                                                if($row["username"]==$follow_assign_name){
                                                        echo  '<option selected value="'.$row["username"].'">'.$row["nickname"].' - '.$backlog_sku.'</option>';
                                                }else{
                                                    echo  '<option value="'.$row["username"].'">'.$row["nickname"].' - '.$backlog_sku.'</option>';
                                                }
                                            }
                                            mysqli_close($con);
                  ?>
            </select>
            <button type="button" style="margin-top: 5px;width: 100%;"
                onclick="action_assign_follow(<?php echo  $_POST['id']; ?>)" class="btn btn-primary btn-sm mb-3">Assign
                to NS-<?php echo $id;?></button>
        </div>
    </form>
    <!-- end assign -->
    <!-- Itemize send email stamp -->
    <div class="row g-3 action-block">
        <div class="col-4">
            <h6><strong>Send Email Stamp</strong></h6>
            <small>ลงบันทึกส่งอีเมลติดตาม (ระบุ tag ticket id บนอีเมลทุกครั้ง)</small>
        </div>
        <div class="col-4">
            <?php
                                                echo ' <button onclick="itemize_send_mail_stamp('.$id.');"
                                                type="button"
                                                class="btn btn-primary btn-sm"
                                                style="width: 100%;">Save</button>';
               ?>
        </div>
        <div class="col-4">
            <div id="itemize_stamp_respond">
            </div>
        </div>
    </div>
    <!-- end Itemize send email stamp -->
    <!-- cancel confirm not for sale -->
    <div class="row g-3 action-block">
        <div class="col-4">
            <h6><strong>Cancel ticket</strong></h6>
            <small>ระบุข้อความยืนยันจากร้านค้าหรือจัดซื้อ
                และเลือกสถานะที่ต้องการเปลี่ยน</small>
        </div>
        <div class="col-4">
            <input type="text" class="form-control" id="reason_cancel" <?php $allow_cancel; ?> name="reason_cancel"
                placeholder="เหตุผลยกเลิก ticket นี้" value="">
            <select style="margin-top: 5px;" id="type_cancel" name="type_cancel" <?php echo $allow_cancel; ?>
                class="form-select form-select-sm" aria-label="Default select example">
                <option value="cancel" selected>Cancel</option>
                <option value="Cancel - Confirm not for sale">Cancel - Confirm not for sale</option>
                <option value="Cancel - Confirm to be new sku">Cancel - Confirm to be new sku</option>
                <option value="Cancel - already content">Cancel - already content</option>
            </select>
            <button type="button" class="btn btn-danger btn-sm" onclick="cancel_ticket(<?php echo $id; ?>)"
                <?php echo $allow_cancel; ?> style="width: 100%;margin-top:5px">Cancel
            </button>
        </div>
        <div class="col-4">
            <div id="cancel_checking_result">
                <?php echo $help_cancel." ".$cancel_resone; ?>
            </div>
        </div>
    </div>
    <!-- cancel confirm not for sale -->
    <?php if($status<>"need update contact"){ ?>
    <div class="row g-3 action-block">
        <div class="col-4">
            <h6><strong>Need to update contact</strong></h6>
            <small>ใช้ในในกรณีที่ข้อมูลติดต่อร้านค้าหรือจัดซื้อผิด</small>
        </div>
        <div class="col-4">
            <button onclick="itm_just_status_need_updated_contact(<?php echo $id; ?>);" type="button"
                class="btn btn-warning btn-sm" <?php echo $allow_cancel; ?> style="width: 100%;margin-top:5px">Need to
                update contact
            </button>
        </div>
        <div class="col-4">
            <div id="itemize_need_to_update_respond">
                <?php echo $help_cancel." ".$cancel_resone; ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- Get new contact -->
    <?php if($status=="need update contact"){ ?>
    <div class="row g-3 action-block">
        <div class="col-4">
            <h6><strong>Get new contact</strong></h6>
            <small>ได้รับ contact ใหม่เปลี่ยน status เป็น pending</small>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="new_contact_buyer"
                    style="height: 100px"><?php echo $contact_buyer; ?></textarea>
                <label for="floatingTextarea2">Contact buyer</label>
            </div>
            <div class="form-floating" style="margin-top:10px">
                <textarea class="form-control" placeholder="Leave a comment here" id="new_contact_vender"
                    style="height: 100px"><?php echo $contact_vender; ?></textarea>
                <label for="floatingTextarea2">Contact vender</label>
            </div>
        </div>
        <div class="col-4">
            <button onclick="itm_just_status_updated_contact(<?php echo $id; ?>);" type="button"
                class="btn btn-success btn-sm" <?php echo $allow_cancel; ?> style="width: 100%;margin-top:5px">get
                contact - change to Pending
            </button>
        </div>
    </div>
    <?php } ?>
    <!-- normal process -->
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
    <div class="row g-3 action-block">
        <h6><strong>Create Sub-Ticket</strong></h6>
        <small>Generate new sub-ticket and convert ticket from buyer to parent ticket</small>
        <form>
            <div class="row mb-1" style="margin-top:10px">
                <label for="inputEmail3" class="col-sm-2 col-form-label">SKU</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control form-control-sm" id="sku_task_set" name="sku_task_set"
                        placeholder="10,40,23,45,45" required>
                </div>
                <div class="col-sm-3">
                    <button type="button" id="bt_create_task" onclick="split_to_subtask(<?php echo $id; ?>);"
                        class="btn btn-outline-primary btn-sm">
                        <ion-icon name="color-wand-outline"></ion-icon>Create Sub-ticket
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
        </form>
    </div>
    <?php }else{
                                    echo "<small>this ticket is sub ticket , so you can't use sub ticket function</small>";
                                } ?>
    <?php if($config_type=="task"){ ?>
    <!-- Special brand guideline -->
    <?php if($brand_info_link<>'' or isset($brand_info_link)){
                                    echo '<div class="alert alert-info" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                  </svg>
                                     สินค้าแบรนด์ '.$brand.' มี Guideline พิเศษของแบรนด์ '.$brand.' เอง กรุณาตรวจสอบ </strong><a style="color:red" href="'.$brand_info_link.'" target="_Blank"><strong>Click here</strong></a> !
                                   </div>';
                                }?>
    <!-- start -->
    <div class="row g-3  action-block">
        <div class="col-4">
            <h6><strong>Start Checking</strong></h6>
            <small>ลงบันทึกเวลาที่เริ่มตรวจสอบ information/linesheet/duplicate sku</small>
        </div>
        <div class="col-4">
            <?php
                                           echo ' <button onclick="start_checking('.$id.');"
                                           type="button"
                                           class="btn btn-primary btn-sm" '.$allow_task_ticket.'
                                           style="width: 100%;">Start</button>';
                                        ?>
        </div>
        <div class="col-4">
            <?php echo $help_start." ".$start_checking_date; ?>
        </div>
    </div>
    <!-- accepted -->
    <?php  if($start_checking_date<>"" and $start_checking_date<>null ){?>
    <div class="row g-3  action-block">
        <div class="col-4">
            <h6><strong>Complete Checking (Accepted)</strong></h6>
            <small>ลงบันทึกยืนยันตรวจสอบข้อมูลเรียบร้อย พร้อมเปิด job สำหรับ writer </small>
        </div>
        <div class="col-4">
            <!-- <div>
                                            <label style="margin-top:5px;margin-bottom:5px" for="sku_accepted"></label>
                                            <textarea style="font-size:12px" class="form-control" id="sku_accepted"
                                                name="sku_accepted"
                                                placeholder="Copy IBC column จาก excel วางตามตัวอย่างด้านล่าง&#10;&#10;3466644&#10;2443356&#10;2487356"
                                                rows="5" style="height: 100px"></textarea>
                                        </div> -->
            <button onclick="accepted_stt(<?php echo $id; ?>);" type="button" class="btn btn-success  btn-sm"
                <?php echo $allow_send_to_traffic; ?> style="width: 100%;margin-top:5px">accept</button>
        </div>
        <div class="col-4">
            <?php echo $help_traffic." ".$accepted_date; ?>
        </div>
    </div>
    <?php } ?>
    <?php if($status == 'waiting traffic'){ ?>
    <hr>
    <h6><strong>Create Writer & Studio - 24ep</strong></h6>
    <form action="base/action/action_create_job_cms.php" method="POST" target="_blank">
        <input type="hidden" id="id_adj" name="id_adj" value="<?php echo  $_POST['id']; ?>">
        <?php include('../form/form_create_job_cms.php')?>
    </form>
    <?php } ?>
    <?php } ?>
</div>