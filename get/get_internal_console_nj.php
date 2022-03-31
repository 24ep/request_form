  <!-- new cp -->

  <div class="tab-pane fade" id="v-pills-cp" role="tabpanel" aria-labelledby="v-pills-cp-tab">

      <!-- assign -->

      <form class="row g-3">
          <div class="col-auto">
              <strong>Person assign </strong>
          </div>
          <div class="col-auto">
              <select class="form-select" id="op_follow_assign_name" name="op_follow_assign_name"
                  aria-label="Default select example">
                  <?php
                      $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
                    $query = "SELECT account.username as username,account.nickname as nickname,account.department as department,account.status as status ,sum(new_job.sku) as backlog_sku
                                            FROM account as account
                                            left join add_new_job as new_job on account.username = new_job.follow_assign_name and new_job.status <> 'accepted' and  new_job.status like '%cancel%' and new_job.status <> 'none'
                                            group by account.username
                                            having (account.department like '%Content%' and account.status = 'Enabled') or account.username ='".$follow_assign_name."'" or die("Error:" . mysqli_error());
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
          </div>
          <div class="col-auto">
              <button type="button" onclick="action_assign_follow(<?php echo  $_POST['id']; ?>)"
                  class="btn btn-primary mb-3">Assign to NS-<?php echo $id;?></button>
          </div>
      </form>
      <!-- end assign -->
      <hr>
      <!-- Itemize send email stamp -->
      <div class="row g-3">
          <div class="col-4">
              <h6><strong>Itemize send email stamp</strong></h6>
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
      <hr>
      <!-- cancel confirm not for sale -->
      <div class="row g-3">
          <div class="col-4">
              <h6><strong>Cancel ticket</strong></h6>
              <small>ระบุข้อความยืนยันจากร้านค้าหรือจัดซื้อ
                  และเลือกสถานะที่ต้องการเปลี่ยน</small>

              <input type="text" class="form-control" id="itm_reason_cancel" <?php $allow_cancel; ?>
                  name="resone_cancel" placeholder="เหตุผลจากร้านค้า" value="">

          </div>

          <div class="col-4">
              <button onclick="itm_confirm_cancel(<?php echo $id; ?>,'cancel - confirm not for sale');" type="button"
                  class="btn btn-danger btn-sm" <?php echo $allow_cancel; ?> style="width: 100%;margin-top:5px">Cancel -
                  Confirm not for sale
              </button>
              <button onclick="itm_confirm_cancel(<?php echo $id; ?>,'cancel - confirm to be new sku');" type="button"
                  class="btn btn-dark btn-sm" <?php echo $allow_cancel; ?> style="width: 100%;margin-top:5px">Cancel -
                  Confirm to be new sku
              </button>
              <button onclick="itm_confirm_cancel(<?php echo $id; ?>,'cancel - already content');" type="button"
                  class="btn btn-success btn-sm" <?php echo $allow_cancel; ?> style="width: 100%;margin-top:5px">Cancel
                  - Confirm already content
              </button>
          </div>
          <div class="col-4">
              <div id="cancel_checking_result">
                  <?php echo $help_cancel." ".$cancel_resone; ?>
              </div>
          </div>
      </div>
      <hr>
      <!-- cancel confirm not for sale -->
      <?php if($status<>"need update contact"){ ?>
      <div class="row g-3">
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
      <hr>
      <?php } ?>
      <!-- Get new contact -->
      <?php if($status=="need update contact"){ ?>
      <div class="row g-3">
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
      </div>
      <?php } ?>