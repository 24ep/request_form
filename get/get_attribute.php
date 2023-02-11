<?php
function return_input_box($att_code,$att_name,$site_element,$current_value,$code_element,$enable_edit,$id,$prefix,$database,$table,$primary_key_id,$require){
  if($site_element=='datetime-local'){
    if($current_value <> null){
      $current_value = date('Y-m-d H:i:s',strtotime($current_value));
      $current_value = str_replace(" ","T",$current_value);
    }
  }
  if($enable_edit==''){
    // $badge_edit_lv = '<ion-icon style="color:#707684;margin-left:3px" name="color-wand-outline"></ion-icon>';
    $badge_edit_lv  ='';
  }else{
    // $badge_edit_lv  ='';
    $badge_edit_lv  ='style="color:#C0C0C0"';
  }
  if($require==1 and $current_value==''){
    $require = 'is-invalid';
  }else{
    $require = '';
  }
  $element = '
  <li class="list-group-item m-2 row" style="display: inline-flex;">
  <div class="col-3 fw-bold" '.$badge_edit_lv.'>'.$att_name.' </div>
  <div class="col-9">
  <input
  class="form-control form-control-sm bg-light'.$require.'"
  id="'.$code_element.'"
  name="'.$code_element.'"
  type="'.$site_element.'"
  value="'.$current_value.'"
  '.$enable_edit.'
  onchange="update_value_attribute(&#39;'.$id.'&#39;, &#39;'.$code_element.'&#39; , &#39;'.$prefix.'&#39; , &#39;'.$database.'&#39; , &#39;'.$table.'&#39; , &#39;'.$primary_key_id.'&#39;)"
  />
  </div>
  </li>
  ';
  return $element;
}
function return_input_color($att_code,$att_name,$site_element,$current_value,$code_element,$enable_edit,$id,$prefix,$database,$table,$primary_key_id,$require){
  if($site_element=='datetime-local'){
    if($current_value <> null){
      $current_value = date('Y-m-d H:i:s',strtotime($current_value));
      $current_value = str_replace(" ","T",$current_value);
    }
  }
  if($enable_edit==''){
    // $badge_edit_lv = '<ion-icon style="color:#707684;margin-left:3px" name="color-wand-outline"></ion-icon>';
    $badge_edit_lv  ='';
  }else{
    // $badge_edit_lv  ='';
    $badge_edit_lv  ='style="color:#C0C0C0"';
  }
  if($require==1 and $current_value==''){
    $require = 'is-invalid';
  }else{
    $require = '';
  }
  $element = '
  <li class="list-group-item m-2 row" style="display: inline-flex;">
  <div class="col-3 fw-bold" '.$badge_edit_lv.'>'.$att_name.' </div>
  <div class="col-9">
  <input
  class="form-control form-control-color '.$require.'"
  id="'.$code_element.'"
  name="'.$code_element.'"
  type="'.$site_element.'"
  value="'.$current_value.'"
  '.$enable_edit.'
  onchange="update_value_attribute(&#39;'.$id.'&#39;, &#39;'.$code_element.'&#39; , &#39;'.$prefix.'&#39; , &#39;'.$database.'&#39; , &#39;'.$table.'&#39; , &#39;'.$primary_key_id.'&#39;)"
  />
  </div>
  </li>
  ';
  return $element;
}
function return_s_select_box($att_code,$att_name,$site_element,$current_value,$code_element,$enable_edit,$id,$prefix,$database,$table,$primary_key_id,$require){
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
  $query_op = "SELECT * FROM u749625779_cdscontent.job_attribute_option
  WHERE attribute_code = '".$att_code."' and attribute_table = '".$table."' ORDER BY id ASC" or die("Error:" . mysqli_error($con));
  $result_op = mysqli_query($con, $query_op);
  $i=0;
  while($option = mysqli_fetch_array($result_op)) {
    if($option["attribute_option_code"]==$current_value){
      $selected = 'selected';
    }else{
      $selected = '';
    }
    if($option["attribute_option_code"]<>"" and $i==0){
      $i++;
      $option_element .= "<option ".$selected ." value=''></option>";
    }
    $option_element .= "<option ".$selected ." value='".$option["attribute_option_code"]."'>".$option["attribute_option_label"]."</option>";
  }
  if($enable_edit==''){
    // $badge_edit_lv = '<ion-icon style="color:#707684;margin-left:3px" name="color-wand-outline"></ion-icon>';
    $badge_edit_lv  ='';
  }else{
    // $badge_edit_lv  ='';
    $badge_edit_lv  ='style="color:#C0C0C0"';
  }
  if($require==1 and $current_value==''){
    $require = 'is-invalid';
  }else{
    $require = '';
  }
  $element = '
  <li class="list-group-item m-2 row" style="display: inline-flex;">
  <div class="col-3 fw-bold" '.$badge_edit_lv.'>'.$att_name.'</div>
  <div class="col-9">
  <select
  class="select-slim '.$require.'"
  id="'.$code_element.'"
  name="'.$code_element.'"
  '.$enable_edit.'
  onchange="update_value_attribute(&#39;'.$id.'&#39;, &#39;'.$code_element.'&#39; , &#39;'.$prefix.'&#39; , &#39;'.$database.'&#39; , &#39;'.$table.'&#39; , &#39;'.$primary_key_id.'&#39;)"
  >
  '.$option_element.'
  </select>
  </div>
  </li>
  ';
  unset($option_element);
  return $element;
}
function return_m_select_box($att_code,$att_name,$site_element,$current_value,$code_element,$enable_edit,$id,$prefix,$database,$table,$primary_key_id,$require){
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
  $query_op = "SELECT * FROM u749625779_cdscontent.job_attribute_option
  WHERE attribute_code = '".$att_code."' and attribute_table = '".$table."' ORDER BY id ASC" or die("Error:" . mysqli_error($con));
  $result_op = mysqli_query($con, $query_op);
  while($option = mysqli_fetch_array($result_op)) {
    if(strpos($current_value ,$option["attribute_option_code"])!==false){
      $option_element .= "<option selected value='".$option["attribute_option_code"]."'>".$option["attribute_option_label"]."</option>";
    }else{
      $option_element .= "<option value='".$option["attribute_option_code"]."'>".$option["attribute_option_label"]."</option>";
    }
  }
  if($enable_edit==''){
    // $badge_edit_lv = '<ion-icon style="color:#707684;margin-left:3px" name="color-wand-outline"></ion-icon>';
    $badge_edit_lv  ='';
  }else{
    // $badge_edit_lv  ='';
    $badge_edit_lv  ='style="color:#C0C0C0"';
  }
  if($require==1 and $current_value==''){
    $require = 'is-invalid';
  }else{
    $require = '';
  }
  $element = '
  <li class="list-group-item m-2 row " style="display: inline-flex;">
  <div class="col-3 fw-bold" '.$badge_edit_lv.'>'.$att_name.'</div>
  <div class="col-9">
  <select
  multiple="multiple"
  class="form-select bg-light '.$require.'"
  id="'.$code_element.'"
  name="'.$code_element.'"
  '.$enable_edit.'
  onchange="update_value_attribute(&#39;'.$id.'&#39;, &#39;'.$code_element.'&#39; , &#39;'.$prefix.'&#39; , &#39;'.$database.'&#39; , &#39;'.$table.'&#39; , &#39;'.$primary_key_id.'&#39;)"
  >
  '.$option_element.'
  </select>
  </div>
  </li>
  ';
  unset($option_element);
  return $element;
}
function return_textarea_box($att_code,$att_name,$site_element,$current_value,$code_element,$enable_edit,$id,$prefix,$database,$table,$primary_key_id,$require){
  if($enable_edit==''){
    // $badge_edit_lv = '<ion-icon style="color:#707684;margin-left:3px"name="color-wand-outline"></ion-icon>';
    $badge_edit_lv  ='';
  }else{
    // $badge_edit_lv  ='';
    $badge_edit_lv  ='style="color:#C0C0C0"';
  }
  if($require==1 and $current_value==''){
    $require = 'is-invalid';
  }else{
    $require = '';
  }
  $element = '
  <li class="list-group-item m-2 row" style="display: inline-flex;">
  <div class="col-3 fw-bold" '.$badge_edit_lv.'>'.$att_name.'</div>
  <div class="col-9">
  <textarea
  class="form-control bg-light '.$require.'"
  id="'.$code_element.'"
  name="'.$code_element.'"
  rows="4"
  '.$enable_edit.'
  onchange="update_value_attribute(&#39;'.$id.'&#39;, &#39;'.$code_element.'&#39; , &#39;'.$prefix.'&#39; , &#39;'.$database.'&#39; , &#39;'.$table.'&#39; , &#39;'.$primary_key_id.'&#39;)"
  >'.$current_value.'
  </textarea>
  </div>
  </li>
  ';
  return $element;
}
//get attribute
function get_attribute($attribute_set,$section_group,$table,$database,$primary_key_id,$prefix_table){
  global $con;
  global $id;
  //Get data 24ep
  $query = "SELECT  * FROM ".$database.".".$table." where ".$primary_key_id." = '".$id."'" or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {
    $query_column = "SELECT `COLUMN_NAME`
    FROM `INFORMATION_SCHEMA`.`COLUMNS`
    WHERE `TABLE_SCHEMA`='".$database."'
    AND `TABLE_NAME`='".$table."'" or die("Error:" . mysqli_error($con));
    $result_column = mysqli_query($con, $query_column);
    while($row_column = mysqli_fetch_array($result_column)) {
      ${$prefix_table."_".$row_column['COLUMN_NAME']} = $row[$row_column['COLUMN_NAME']];
    }
  }
  $query = "SELECT  * FROM u749625779_cdscontent.job_attribute
  where allow_display=1 and attribute_set = '".$attribute_set."' and section_group ='".$section_group."' and table_name='".$table."'"  or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  $element="";
  while($row = mysqli_fetch_array($result)) {
    if($row['allow_in_edit']==0){
      $allow_in_edit = ' disabled';
    }else{
      $allow_in_edit = '';
    }
    if($row["attribute_type"]=="number"){
      $element .= return_input_box($row["attribute_code"],$row["attribute_label"],"number",${$row["prefix"]."_".$row["attribute_code"]},$row["prefix"]."_edit_".$row["attribute_code"],$allow_in_edit,$id,$row["prefix"],$row["db_name"],$row["table_name"],$row["primary_key_id"],$row["require_value"]);
    }elseif($row["attribute_type"]=="text"){
      $element .= return_input_box($row["attribute_code"],$row["attribute_label"],$row["attribute_type"],${$row["prefix"]."_".$row["attribute_code"]},$row["prefix"]."_edit_".$row["attribute_code"],$allow_in_edit,$id,$row["prefix"],$row["db_name"],$row["table_name"],$row["primary_key_id"],$row["require_value"]);
    }elseif($row["attribute_type"]=="color" ){
      $element .= return_input_color($row["attribute_code"],$row["attribute_label"],$row["attribute_type"],${$row["prefix"]."_".$row["attribute_code"]},$row["prefix"]."_edit_".$row["attribute_code"],$allow_in_edit,$id,$row["prefix"],$row["db_name"],$row["table_name"],$row["primary_key_id"],$row["require_value"]);
    }elseif($row["attribute_type"]=="datetime"){
      $element .= return_input_box($row["attribute_code"],$row["attribute_label"],"datetime-local",${$row["prefix"]."_".$row["attribute_code"]},$row["prefix"]."_edit_".$row["attribute_code"],$allow_in_edit,$id,$row["prefix"],$row["db_name"],$row["table_name"],$row["primary_key_id"],$row["require_value"]);
    }elseif($row["attribute_type"]=="date"){
      $element .= return_input_box($row["attribute_code"],$row["attribute_label"],"date",${$prefix_table."_".$row["attribute_code"]},$prefix_table."_edit_".$row["attribute_code"],$allow_in_edit,$id,$row["prefix"],$row["db_name"],$row["table_name"],$row["primary_key_id"],$row["require_value"]);
    }elseif($row["attribute_type"]=="textarea"){
      $element .= return_textarea_box($row["attribute_code"],$row["attribute_label"],"textarea",${$prefix_table."_".$row["attribute_code"]},$prefix_table."_edit_".$row["attribute_code"],$allow_in_edit,$id,$row["prefix"],$row["db_name"],$row["table_name"],$row["primary_key_id"],$row["require_value"]);
    }elseif($row["attribute_type"]=="single_select"){
      $element .= return_s_select_box($row["attribute_code"],$row["attribute_label"],"single_select",${$prefix_table."_".$row["attribute_code"]},$prefix_table."_edit_".$row["attribute_code"],$allow_in_edit,$id,$row["prefix"],$row["db_name"],$row["table_name"],$row["primary_key_id"],$row["require_value"]);
    }elseif($row["attribute_type"]=="multi_select"){
      $element .= return_m_select_box($row["attribute_code"],$row["attribute_label"],"multi_select",${$prefix_table."_".$row["attribute_code"]},$prefix_table."_edit_".$row["attribute_code"],$allow_in_edit,$id,$row["prefix"],$row["db_name"],$row["table_name"],$row["primary_key_id"],$row["require_value"]);
    }
  }
  return $element;
}
//get attribute section
function get_attribute_section($attribute_set,$table,$database,$primary_key_id,$prefix_table){
  global $con;
  $query = "SELECT distinct section_group FROM u749625779_cdscontent.job_attribute
  where allow_display=1 and attribute_set = '".$attribute_set."' and table_name='".$table."' order by sort_section ASC" or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  $section="";
  while($row = mysqli_fetch_array($result)) {
    $section .=  '<span class="shadow-sm ps-3 pt-1 pb-1 rounded m-0 bg-gray bg-gradient" style="font-size: medium;
    color: #4c4b4b;
    background: #dbdbdb;
    display: flex!important;
    text-transform: capitalize;
    margin: 0!important;
    "><strong>'.$row['section_group'].'</strong></span><br>';
    $section .= '<div class="row m-2">';
    $section .= get_attribute($attribute_set,$row['section_group'],$table,$database,$primary_key_id,$prefix_table);
    $section .= '</div>';
  }
  return  $section;
}
?>
<script>
function update_value_attribute(id, attribute_code, prefix, database, table, primary_key_id) {
  var isMulti = document.getElementById(attribute_code).multiple;
  console.log(isMulti)
  if (isMulti == true) {
    var selected = [];
    for (var option of document.getElementById(attribute_code).options) {
      if (option.selected) {
        selected.push(option.value);
      }
    }
    var value_change = selected.toString();
  } else {
    var value_change = document.getElementById(attribute_code).value;
  }
  var attribute_code = attribute_code;
  if (value_change == "CURRENT_TIMESTAMP") {
    var today = new Date();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date + ' ' + time;
    value_change = dateTime;
  }
  if (id) {
    $.post("base/action/action_update_value_attribute.php", {
      id: id,
      value_change: value_change,
      attribute_code: attribute_code,
      prefix: prefix,
      database: database,
      table: table,
      primary_key_id: primary_key_id
    },
    function(data) {
      // $('#call_update_ns_complete').html(data);
      var result = data.includes("Error");
      if (result == false) {
        Notiflix.Notify.success(data);
        if (prefix == "cs") {
          call_edit_add_new_modal(id);
        }
      } else {
        Notiflix.Report.failure(
          'Failure',
          data,
          'Okay',
          )
        }
      });
    }
  }
  </script>

<script>
   new SlimSelect({
    select: 'document.querySelectorAll(".select-slim")'
  })
</script>