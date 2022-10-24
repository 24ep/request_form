-<?php
$id = $_POST['id'];
include('../get/get_attribute');
?>

<h5>Recject</h5>
<label for="approved_decline_remark" class="form-label">Reject Note</label>
<input type="textarea" id="rj_edit_approved_decline_remark" class="form-control" aria-describedby="reject_note">

<?php
echo return_s_select_box('approved_editing_status','reject status',"single_select",'rj_approved_editing_status','rj_edit_approved_editing_status','',$id,'jc','u749625779_cdscontent','job_cms','csg_request_new_id');
?>
<input type="hidden" id="rj_edit_approved_edited_date" class="form-control" value="CURRENT_TIMESTAMP"aria-describedby="approved_edited_date">

<button type="button" onclick="ns_reject(<?php echo $id;?>)" class="btn btn-danger">Reject</button>

<script>
function ns_reject(id){
    // document.getElementById('approved_edited_date').value = Date.now();
    approved_decline_remark = document.getElementById('rj_edit_approved_decline_remark').value
    approved_editing_status = document.getElementById('rj_edit_approved_editing_status').value
    approved_edited_date = document.getElementById('rj_edit_approved_edited_date').value

    update_value_attribute(id, 'rj_edit_approved_decline_remark', 'rj', 'u749625779_cdscontent', 'job_cms', 'csg_request_new_id');
    update_value_attribute(id, 'rj_edit_approved_editing_status', 'rj', 'u749625779_cdscontent', 'job_cms', 'csg_request_new_id');
    update_value_attribute(id, 'rj_edit_approved_edited_date', 'rj', 'u749625779_cdscontent', 'job_cms', 'csg_request_new_id');
}
</script>