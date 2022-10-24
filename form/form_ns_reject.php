<?php
$id = $_POST['id'];
include('../get/get_attribute.php');

?>

<h5><strong><ion-icon name="warning-outline"></ion-icon> REJECT</strong></h5>
<div class="row bg-white">
    <ul class="list-group">
        <?php
            echo return_textarea_box('approved_decline_remark','Reject Note',"textarea",'','rj_edit_approved_decline_remark','',$id,'jc','u749625779_cdscontent','job_cms','csg_request_new_id');
            echo return_s_select_box('approved_editing_status','Reject status',"single_select",'','rj_edit_approved_editing_status','',$id,'jc','u749625779_cdscontent','job_cms','csg_request_new_id');
            echo return_input_box('approved_decline_date','Reject date',"datetime-local",'','rj_approved_decline_date','',$id,'jc','u749625779_cdscontent','job_cms','csg_request_new_id');
            echo return_input_box('approved_edited_date','Revised date',"datetime-local",'','rj_approved_edited_date','',$id,'jc','u749625779_cdscontent','job_cms','csg_request_new_id');
        ?>
    </ul>
</div>