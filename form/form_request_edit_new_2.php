<?php
 session_start();
 $id = $_POST['id'];
$con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
function return_input_box($att_name,$site_element,$current_value,$code_element,$enable_edit,$id){
  if($site_element=='datetime-local'){
    $current_value = str_replace(" ","T",$current_value);
  }
  $element = '
  <li class="list-group-item" style="display: inline-flex; background: #f9fafb">
    <div class="col-3 fw-bold">'.$att_name.'</div>
    <div class="col-9">
      <input
        class="form-control form-control-sm"
        id="'.$code_element.'"
        name="'.$code_element.'"
        type="'.$site_element.'"
        style="border: 0px"
        value="'.$current_value.'"
        '.$enable_edit.'
        onchange="update_ns_detail('.$id.',&#39;'.$code_element.'&#39;)"
      />
    </div>
  </li>
  ';
  return $element;
}
function return_s_select_box($att_name,$site_element,$current_value,$code_element,$attr_id,$enable_edit,$id){
  $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
    $query_op = "SELECT * FROM all_in_one_project.attribute_option
    WHERE attribute_id = ".$attr_id." and `function` = 'add_new' ORDER BY option_id ASC" or die("Error:" . mysqli_error($con));
    $result_op = mysqli_query($con, $query_op);
    while($option = mysqli_fetch_array($result_op)) {
    if($option["attribute_option"]==$current_value){
        $option_element .= "<option selected value='".$option["attribute_option"]."'>".$option["attribute_option"]."</option>";
      }else{
        $option_element .= "<option value='".$option["attribute_option"]."'>".$option["attribute_option"]."</option>";
      }
    }
  $element = '
  <li class="list-group-item" style="display: inline-flex; background: #f9fafb">
    <div class="col-3 fw-bold">'.$att_name.'</div>
    <div class="col-9">
      <select
        class="form-select form-select-sm"
        id="'.$code_element.'"
        name="'.$code_element.'"
        style="border: 0px"
        '.$enable_edit.'
        onchange="update_ns_detail('.$id.',&#39;'.$code_element.'&#39;)"
      >
      '.$option_element.'
      </select>
    </div>
  </li>
  ';
  unset($option_element);
  return $element;
}
function return_m_select_box($att_name,$site_element,$current_value,$code_element,$attr_id,$enable_edit,$id){
  $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
    $query_op = "SELECT * FROM all_in_one_project.attribute_option
    WHERE attribute_id = ".$attr_id." and `function` = 'add_new' ORDER BY option_id ASC" or die("Error:" . mysqli_error($con));
    $result_op = mysqli_query($con, $query_op);
    while($option = mysqli_fetch_array($result_op)) {
    if(strpos($current_value ,$option["attribute_option"])!==false){
        $option_element .= "<option selected value='".$option["attribute_option"]."'>".$option["attribute_option"]."</option>";
      }else{
        $option_element .= "<option value='".$option["attribute_option"]."'>".$option["attribute_option"]."</option>";
      }
    }
  $element = '
  <li class="list-group-item" style="display: inline-flex; background: #f9fafb">
    <div class="col-3 fw-bold">'.$att_name.'</div>
    <div class="col-9">
      <select
        multiple="multiple"
        class="form-select"
        id="'.$code_element.'"
        name="'.$code_element.'"
        style="border: 0px"
        '.$enable_edit.'
        onchange="update_ns_detail('.$id.',&#39;'.$code_element.'&#39;)"
      >
      '.$option_element.'
      </select>
    </div>
  </li>
  ';
  unset($option_element);
  return $element;
}
function return_textarea_box($att_name,$site_element,$current_value,$code_element,$enable_edit,$id){
  $element = '
  <li class="list-group-item" style="display: inline-flex; background: #f9fafb">
    <div class="col-3 fw-bold">'.$att_name.'</div>
    <div class="col-9">
      <textarea
        class="form-control"
        id="'.$code_element.'"
        name="'.$code_element.'"
        style="border: 0px"
        rows="4"
        '.$enable_edit.'
        onchange="update_ns_detail('.$id.',&#39;'.$code_element.'&#39;)"
      >'.$current_value.'
      </textarea>
    </div>
  </li>
  ';
  return $element;
}
// function get_list_element($group,$id){
//     $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
//     $query = "SELECT * FROM all_in_one_project.attribute_entity
//     WHERE allow_display = 1 and attribute_function = 'add_new'  and group_attribute = '".$group."' ORDER BY attribute_id ASC" or die("Error:" . mysqli_error($con));
// $result = mysqli_query($con, $query);
// while($row = mysqli_fetch_array($result)) {
// //--
// if(strpos($_SESSION["department"],"Content")!==false){
//   if($row["allow_in_edit"]==1){
//     $allow_edit = "";
//   }else{
//     $allow_edit = "disabled";
//   }
// }else{
// if($row["allow_ex_edit"]==1){
//   //check assign name
//   if($follow_assign_name == "unassign"){
//     $allow_edit = "";
//   }else{
//     $allow_edit = "disabled";
//   }
// }else{
//   $allow_edit = "disabled";
// }
// }
// //------
// $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
//   $query_ticket_info = "SELECT
//             anj.id as id,
//             anj.brand as brand,
//             anj.request_username as request_username,
//             anj.create_date as create_date,
//             anj.request_date as request_date,
//             anj.update_date as update_date,
//             anj.production_type as production_type,
//             anj.business_type as business_type,
//             anj.project_type as project_type,
//             anj.stock_source as stock_source,
//             anj.contact_buyer as contact_buyer,
//             anj.contact_vender as contact_vender,
//             anj.launch_date as launch_date,
//             anj.link_info as link_info,
//             anj.remark as remark,
//             anj.department as department,
//             anj.sku as sku,
//             anj.status as status,
//             anj.start_checking_date as start_checking_date,
//             anj.accepted_date as accepted_date,
//             anj.cancel_resone as cancel_resone,
//             anj.need_more_info_date as need_more_info_date,
//             anj.follow_up_by as follow_up_by,
//             anj.bu as bu,
//             anj.tags as tags,
//             anj.online_channel as online_channel,
//             anj.request_important as request_important,
//             anj.follow_assign_name as follow_assign_name,
//             anj.follow_assign_date as follow_assign_date,
//             anj.sub_department as sub_department,
//             anj.parent as parent,
//             anj.config_type as config_type,
//             anj.trigger_status as trigger_status,
//             anj.subject_mail as subject_mail,
//             ac.nickname as follow_assign_nickname,
//             ac_request.firstname as request_firstname,
//             ac_request.lastname as request_lastname,
//             ac_request.office_tell as request_office_tell,
//             ac_request.nickname as request_nickname,
//             brand_editor.body  as brand_editor,
//             anj.web_cate as web_cate,
//             anj.approved_date as approved_date,
//             anj.approved_complete_sku as approved_complete_sku,
//             anj.approved_edited_date as approved_edited_date,
//             anj.approved_decline_date as approved_decline_date,
//             anj.approved_decline_remark as approved_decline_remark,
//             anj.job_number as job_number
//             FROM all_in_one_project.add_new_job as anj
//             left join all_in_one_project.account as ac
//             on ac.username = anj.follow_assign_name
//             left join all_in_one_project.account as ac_request
//             on ac_request.username = anj.request_username
//             left join all_in_one_project.brand_editor as brand_editor
//             on brand_editor.brand = anj.brand
//             where anj.id = ".$id." ORDER BY anj.id DESC " or die("Error:" . mysqli_error($con));
//   $result_ticket_info = mysqli_query($con, $query_ticket_info);
//   while($row_ticket_info = mysqli_fetch_array($result_ticket_info)) {
//       $id = $row_ticket_info['id'];
//       $brand = $row_ticket_info['brand'];
//       $request_username = $row_ticket_info['request_username'];
//       $request_firstname = $row_ticket_info['request_firstname'];
//       $request_lastname = $row_ticket_info['request_lastname'];
//       $request_nickname = $row_ticket_info['request_nickname'];
//       $request_office_tell = $row_ticket_info['request_office_tell'];
//       $create_date = $row_ticket_info['create_date'];
//       $request_date= $row_ticket_info['request_date'];
//       $update_date = $row_ticket_info['update_date'];
//       $production_type = $row_ticket_info['production_type'];
//       $business_type = $row_ticket_info['business_type'];
//       $project_type = $row_ticket_info['project_type'];
//       $stock_source = $row_ticket_info['stock_source'];
//       $contact_buyer = $row_ticket_info['contact_buyer'];
//       $contact_vender = $row_ticket_info['contact_vender'];
//       $launch_date = $row_ticket_info['launch_date'];
//       $link_info = $row_ticket_info['link_info'];
//       $remark = $row_ticket_info['remark'];
//       $department = $row_ticket_info['department'];
//       $sku = $row_ticket_info['sku'];
//       $status = $row_ticket_info['status'];
//       $start_checking_date = $row_ticket_info['start_checking_date'];
//       $accepted_date = $row_ticket_info['accepted_date'];
//       $cancel_resone = $row_ticket_info['cancel_resone'];
//       $need_more_info_date = $row_ticket_info['need_more_info_date'];
//       $need_more_info_note = $row_ticket_info['need_more_info_note'];
//       $follow_up_by = $row_ticket_info['follow_up_by'];
//       $bu = $row_ticket_info['bu'];
//       $tags = $row_ticket_info['tags'];
//       $online_channel = $row_ticket_info['online_channel'];
//       $request_important = $row_ticket_info['request_important'];
//       $follow_assign_name = $row_ticket_info['follow_assign_name'];
//       $follow_assign_date = $row_ticket_info['follow_assign_date'];
//       $sub_department = $row_ticket_info['sub_department'];
//       $parent = $row_ticket_info['parent'];
//       $config_type = $row_ticket_info['config_type'];
//       $subject_mail = $row_ticket_info['subject_mail'];
//       $follow_assign_nickname = $row_ticket_info['follow_assign_nickname'];
//       // $brand_info_link = $row_ticket_info['brand_info_link'];
//       $web_cate = $row_ticket_info['web_cate'];
//       $brand_editor=$row_ticket_info['brand_editor'];
//       $trigger_status=$row_ticket_info['trigger_status'];
//       $job_number=$row_ticket_info['job_number'];
//       $approved_date=$row_ticket_info['approved_date'];
//       $approved_editing_status=$row_ticket_info['approved_editing_status'];
//       $approved_decline_remark=$row_ticket_info['approved_decline_remark'];
//       $approved_decline_date=$row_ticket_info['approved_decline_date'];
//       $approved_edited_date=$row_ticket_info['approved_edited_date'];
//   }
// //---
// if($row["site_element"]=="number"){
//   $element .= return_input_box($row["attribute_label"],"number",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"],$allow_edit,$id);
// }elseif($row["site_element"]=="text"){
// $element .= return_input_box($row["attribute_label"],"text",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"],$allow_edit,$id);
// }elseif($row["site_element"]=="datetime"){
// $element .= return_input_box($row["attribute_label"],"datetime-local",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"],$allow_edit,$id);
// }elseif($row["site_element"]=="date"){
// $element .= return_input_box($row["attribute_label"],"date",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"],$allow_edit,$id);
// }elseif($row["site_element"]=="textarea"){
// $element .= return_textarea_box($row["attribute_label"],"textarea",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"],$allow_edit,$id);
// }elseif($row["site_element"]=="single_select"){
// $element .= return_s_select_box($row["attribute_label"],"single_select",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"],$row["attribute_id"],$allow_edit,$id);
// }elseif($row["site_element"]=="multi_select"){
// $element .= return_m_select_box($row["attribute_label"],"multi_select",${$row_ticket_info["attribute_code"]},"ns_edit_".$row["attribute_code"],$row["attribute_id"],$allow_edit,$id);
// }
// }
// $element_return = "";
// $element_return .= '<div id="call_update_ns_complete"></div>';
// $element_return .= '<ul class="list-group list-group-flush">';
// $element_return .= $element;
// $element_return .= '</ul>';
//  return $element_return;
// }
// echo '<div class="accordion accordion-flush" id="accordionFlushExample">';
// $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
// $query = "SELECT distinct sort , group_attribute  FROM all_in_one_project.attribute_entity
// WHERE allow_display = 1 and attribute_function = 'add_new' ORDER BY sort ASC" or die("Error:" . mysqli_error($con));
// $result = mysqli_query($con, $query);
// while($row = mysqli_fetch_array($result)) {
//     echo '<div class="accordion-item">';
//     echo '<h2 class="accordion-header" id="panelsStayOpen-heading'.str_replace(" ","_",$row['group_attribute']).'">
//             <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse'.str_replace(" ","_",$row['group_attribute']).'" aria-expanded="true" aria-controls="panelsStayOpen-collapse'.str_replace(" ","_",$row['group_attribute']).'">
//               '.$row['group_attribute'].'
//             </button>
//           </h2>';
//     echo '
//           <div id="panelsStayOpen-collapse'.str_replace(" ","_",$row['group_attribute']).'" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading'.str_replace(" ","_",$row['group_attribute']).'">
//             <div class="accordion-body" style="padding:0px">';
//             echo get_list_element($row['group_attribute'],$id);
//       echo '</div>';
//     echo '</div>';
//     echo '</div>';
// }
// echo '</div>';
?>
<script>
function update_ns_detail(id, id_name) {
    var id_name = id_name;
    var value_change = document.getElementById(id_name).value;
    if (id) {
        $.post("/action/action_update_ns_detail.php", {
                id: id,
                value_change: value_change,
                id_name: id_name
            },
            function(data) {
                $('#call_update_ns_complete').html(data);
            });
    }
}
</script>