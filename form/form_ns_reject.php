<?php
$id = $_POST['id'];
include('../get/get_attribute.php');

?>

<h5><strong><ion-icon name="warning-outline"></ion-icon> REJECT</strong></h5>
<div class="row bg-white">
    <ul class="list-group">
        <?php
            echo return_s_select_box('approved_editing_status','Reject status',"single_select",$jc_edit_approved_editing_status,'rj_edit_approved_editing_status','',$id,'jc','all_in_one_project','add_new_job','id','0');
            echo return_textarea_box('approved_decline_remark','Reject Note',"textarea",$jc_edit_approved_decline_remark,'rj_edit_approved_decline_remark','',$id,'jc','all_in_one_project','add_new_job','id','0');
            echo return_input_box('approved_decline_date','Reject date',"datetime-local",$jc_edit_approved_decline_date,'rj_approved_decline_date','',$id,'jc','all_in_one_project','add_new_job','id','0');
            echo return_input_box('approved_edited_date','Revised date',"datetime-local",$jc_edit_approved_edited_date,'rj_approved_edited_date','',$id,'jc','all_in_one_project','add_new_job','id','0');
        ?>
    </ul>
</div>