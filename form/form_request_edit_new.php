<style>
.ms-parent,
.multiple-select_ens,
.ms-choice {
    border: 0px;
    width: 100% !important;
}
</style>
<?php
$con= mysqli_connect("localhost",$_SESSION["db_username"],$_SESSION["db_password"]) or die("Error: " . mysqli_error($con));
function return_input_box($att_name,$site_element,$current_value,$code_element,$enable_edit){
  $element = '
  <li class="list-group-item" style="display: inline-flex; background: #dee2e6">
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
      />
    </div>
  </li>
  ';
  return $element;
}
function return_s_select_box($att_name,$site_element,$current_value,$code_element,$attr_id,$enable_edit){
  $con= mysqli_connect("localhost",$_SESSION["db_username"],$_SESSION["db_password"]) or die("Error: " . mysqli_error($con));
    $query_op = "SELECT * FROM content_service_gate.attribute_option
    WHERE attribute_id = ".$attr_id." and function = 'add_new' ORDER BY option_id ASC" or die("Error:" . mysqli_error());
    $result_op = mysqli_query($con, $query_op);
    while($option = mysqli_fetch_array($result_op)) {
    if($option["attribute_option"]==$current_value){
        $option_element .= "<option selected value='".$option["attribute_option"]."'>".$option["attribute_option"]."</option>";
      }else{
        $option_element .= "<option value='".$option["attribute_option"]."'>".$option["attribute_option"]."</option>";
      }
    }
  $element = '
  <li class="list-group-item" style="display: inline-flex; background: #dee2e6">
    <div class="col-3 fw-bold">'.$att_name.'</div>
    <div class="col-9">
      <select
        class="form-select form-select-sm"
        id="'.$code_element.'"
        name="'.$code_element.'"
        style="border: 0px"
        '.$enable_edit.'
      >
      '.$option_element.'
      </select>
    </div>
  </li>
  ';
  unset($option_element);
  return $element;
}
function return_m_select_box($att_name,$site_element,$current_value,$code_element,$attr_id,$enable_edit){
  $con= mysqli_connect("localhost",$_SESSION["db_username"],$_SESSION["db_password"]) or die("Error: " . mysqli_error($con));
    $query_op = "SELECT * FROM content_service_gate.attribute_option
    WHERE attribute_id = ".$attr_id." and function = 'add_new' ORDER BY option_id ASC" or die("Error:" . mysqli_error());
    $result_op = mysqli_query($con, $query_op);
    while($option = mysqli_fetch_array($result_op)) {
    if(strpos($current_value ,$option["attribute_option"])!==false){
        $option_element .= "<option selected value='".$option["attribute_option"]."'>".$option["attribute_option"]."</option>";
      }else{
        $option_element .= "<option value='".$option["attribute_option"]."'>".$option["attribute_option"]."</option>";
      }
    }
  $element = '
  <li class="list-group-item" style="display: inline-flex; background: #dee2e6">
    <div class="col-3 fw-bold">'.$att_name.'</div>
    <div class="col-9">
      <select
        multiple="multiple"
        class="form-select"
        id="'.$code_element.'[]"
        name="'.$code_element.'[]"
        style="border: 0px"
        '.$enable_edit.'
      >
      '.$option_element.'
      </select>
    </div>
  </li>
  ';
  unset($option_element);
  return $element;
}
function return_textarea_box($att_name,$site_element,$current_value,$code_element,$enable_edit){
  $element = '
  <li class="list-group-item" style="display: inline-flex; background: #dee2e6">
    <div class="col-3 fw-bold">'.$att_name.'</div>
    <div class="col-9">
      <textarea
        class="form-control"
        id="'.$code_element.'"
        name="'.$code_element.'"
        style="border: 0px"
        rows="5"
        '.$enable_edit.'
      >'.$current_value.'
      </textarea>
    </div>
  </li>
  ';
  return $element;
}
$query = "SELECT * FROM content_service_gate.attribute_entity
          WHERE allow_display = 1 and attribute_function = 'add_new'  ORDER BY attribute_id ASC" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {
    //--
    if(strpos($_SESSION["department"],"Content")!==false){
        $allow_edit = "disabled";
    }else{
        $allow_edit = "disabled";
    }
    //---
    if($row["site_element"]=="number"){
        $element .= return_input_box($row["attribute_label"],"number",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"],$allow_edit);
    }elseif($row["site_element"]=="text"){
      $element .= return_input_box($row["attribute_label"],"text",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"],$allow_edit);
    }elseif($row["site_element"]=="datetime"){
      $element .= return_input_box($row["attribute_label"],"datetime-local",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"],$allow_edit);
    }elseif($row["site_element"]=="date"){
      $element .= return_input_box($row["attribute_label"],"date",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"],$allow_edit);
    }elseif($row["site_element"]=="textarea"){
      $element .= return_textarea_box($row["attribute_label"],"textarea",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"],$allow_edit);
    }elseif($row["site_element"]=="single_select"){
      $element .= return_s_select_box($row["attribute_label"],"single_select",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"],$row["attribute_id"],$allow_edit);
    }elseif($row["site_element"]=="multi_select"){
      $element .= return_m_select_box($row["attribute_label"],"multi_select",${$row["attribute_code"]},"ns_edit_".$row["attribute_code"],$row["attribute_id"],$allow_edit);
    }
  }
  echo '<ul class="list-group">';
  echo $element;
  echo '</ul>';
?>
<script>
$(function() {
    $(".multiple-select_ens").multipleSelect()
});
</script>