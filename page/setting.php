<!-- get accout informations -->

<?php
 session_start();
   $database = 'all_in_one_project';
   $table = 'account';
   $primary_key_id = 'username';
   $id=$_SESSION['username'];
   $prefix_table = 'ac';
   $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));

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
?>


<nav class="p-3 bg-white shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><?php echo $ac_firstname." ".$ac_lastname; ?></a>
    <small  href="#"><?php echo $ac_department; ?></small>
  </div>
</nav>

<?php

function return_input_box($att_name,$site_element,$current_value,$code_element,$enable_edit,$id){
    if($site_element=='datetime-local'){
      $current_value = str_replace(" ","T",$current_value);
    }
    $element = '
    <li class="list-group-item m-2 row" style="display: inline-flex;">
      <div class="col-3 fw-bold">'.$att_name.'</div>
      <div class="col-9">
        <input
          class="form-control form-control-sm bg-light"
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
  function return_s_select_box($att_name,$site_element,$current_value,$code_element,$table_name,$enable_edit,$id){
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
      $query_op = "SELECT * FROM u749625779_cdscontent.job_attribute_option
      WHERE attribute_code = '".$att_name."' and attribute_table = '".$table_name."' ORDER BY id ASC" or die("Error:" . mysqli_error($con));
      $result_op = mysqli_query($con, $query_op);
      while($option = mysqli_fetch_array($result_op)) {
        if($current_value=="" or $current_value==null){
          $option_element .= "<option selected value=''></option>";
        }else{
          $option_element .= "<option  value=''></option>";
          if($option["attribute_option_code"]==$current_value){
            $option_element .= "<option selected value='".$option["attribute_option_code"]."'>".$option["attribute_option_label"]."</option>";
          }else{
            $option_element .= "<option value='".$option["attribute_option_code"]."'>".$option["attribute_option_label"]."</option>";
          }
          }
        }
      
    $element = '
    <li class="list-group-item m-2 row" style="display: inline-flex;">
      <div class="col-3 fw-bold">'.$att_name.'</div>
      <div class="col-9">
        <select
          class="form-select form-select-sm bg-light"
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
  function return_m_select_box($att_name,$site_element,$current_value,$code_element,$table_name,$enable_edit,$id){
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
      $query_op = "SELECT * FROM job_attribute_option.job_attribute_option
      WHERE attribute_code = '".$att_name."' and attribute_table = '".$table_name."' ORDER BY id ASC" or die("Error:" . mysqli_error($con));
      $result_op = mysqli_query($con, $query_op);
      while($option = mysqli_fetch_array($result_op)) {
      if(strpos($current_value ,$option["attribute_option"])!==false){
          $option_element .= "<option selected value='".$option["attribute_option"]."'>".$option["attribute_option"]."</option>";
        }else{
          $option_element .= "<option value='".$option["attribute_option"]."'>".$option["attribute_option"]."</option>";
        }
      }
    $element = '
    <li class="list-group-item m-2 row" style="display: inline-flex;">
      <div class="col-3 fw-bold">'.$att_name.'</div>
      <div class="col-9">
        <select
          multiple="multiple"
          class="form-select bg-light"
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
    <li class="list-group-item m-2 row" style="display: inline-flex;">
      <div class="col-3 fw-bold">'.$att_name.'</div>
      <div class="col-9">
        <textarea
          class="form-control bg-light"
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
        // $element.= $row['attribute_label'];
        if($row['allow_in_edit']==0){
            $allow_in_edit = ' disabled';
        }else{
            $allow_in_edit = '';
        }
        if($row["attribute_type"]=="number"){
        $element .= return_input_box($row["attribute_label"],"number",${$prefix_table."_".$row["attribute_code"]},$prefix_table."_edit_".$row["attribute_code"],$allow_in_edit,$id);
          }elseif($row["attribute_type"]=="text"){
          $element .= return_input_box($row["attribute_label"],"text",${$prefix_table."_".$row["attribute_code"]},$prefix_table."_edit_".$row["attribute_code"],$allow_in_edit,$id);
          }elseif($row["attribute_type"]=="datetime"){
          $element .= return_input_box($row["attribute_label"],"datetime-local",${$prefix_table."_".$row["attribute_code"]},$prefix_table."_edit_".$row["attribute_code"],$allow_in_edit,$id);
          }elseif($row["attribute_type"]=="date"){
          $element .= return_input_box($row["attribute_label"],"date",${$prefix_table."_".$row["attribute_code"]},$prefix_table."_edit_".$row["attribute_code"],$allow_in_edit,$id);
          }elseif($row["attribute_type"]=="textarea"){
          $element .= return_textarea_box($row["attribute_label"],"textarea",${$prefix_table."_".$row["attribute_code"]},$prefix_table."_edit_".$row["attribute_code"],$allow_in_edit,$id);
          }elseif($row["attribute_type"]=="single_select"){
           $element .= return_s_select_box($row["attribute_code"],"single_select",${$prefix_table."_".$row["attribute_code"]},$prefix_table."_edit_".$row["attribute_code"],$table,$allow_in_edit,$id);
          }elseif($row["attribute_type"]=="multi_select"){
         $element .= return_m_select_box($row["attribute_code"],"single_select",${$prefix_table."_".$row["attribute_code"]},$prefix_table."_edit_".$row["attribute_code"],$table,$allow_in_edit,$id);
          }
    }
    return $element;
}

//get attribute section
function get_attribute_section($attribute_set,$table,$database,$primary_key_id,$prefix_table){
    global $con;
    $query = "SELECT distinct section_group FROM u749625779_cdscontent.job_attribute 
    where allow_display=1 and attribute_set = '".$attribute_set."' and table_name='".$table."'" or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $query);
    $section="";
    while($row = mysqli_fetch_array($result)) {
        $section .=  '<span class="m-3" style="font-size: large;border-bottom-style: solid;color:#7f7879;display: flex!important;
        margin: 10px;text-transform: uppercase;"><strong>'.$row['section_group'].'</strong></span><br>';
        $section .= '<div class="row m-2">';
        $section .= get_attribute($attribute_set,$row['section_group'],$table,$database,$primary_key_id,$prefix_table);
        $section .= '</div>';
    }
    return  $section;
}

//get attribute set manu
$query = "SELECT distinct attribute_set,table_name,db_name,primary_key_id,prefix FROM u749625779_cdscontent.job_attribute where allow_display= 1 and table_name in ('account') order by sort_attribute_set" or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  $d_attribute_set="";
  $d_attribute_section="";
  $i=0;
  while($row = mysqli_fetch_array($result)) {
    $i++;
    if($i==1){
      $active_section_bt = ' active';
      $active_section_bd = ' show active';
    }else{
      $active_section_bt = ' ';
      $active_section_bd = ' ';
    }
    echo '<div id="call_update_ac_complete"></div>';
    echo '<ul class="list-group">';
    $d_attribute_set .=  '  <button style="text-align:-webkit-left" class="nav-link '.$active_section_bt.'" id="v-pills-'.str_replace(" ","_",$row['attribute_set']).'-tab" data-bs-toggle="pill" data-bs-target="#v-pills-'.str_replace(" ","_",$row['attribute_set']).'" type="button" role="tab" aria-controls="v-pills-'.str_replace(" ","_",$row['attribute_set']).'" aria-selected="false">'.ucwords($row['attribute_set']).'</button>';
    $d_attribute_section .= '<div class="tab-pane fade  shadow-sm bg-white p-3 rounded '.$active_section_bd.'" id="v-pills-'.str_replace(" ","_",$row['attribute_set']).'" role="tabpanel" aria-labelledby="v-pills-'.str_replace(" ","_",$row['attribute_set']).'-tab">'.get_attribute_section($row['attribute_set'],$row['table_name'],$row['db_name'],$row['primary_key_id'],$row['prefix']).'</div>';
    echo '</ul>';
    
  }
  echo'
  <div class="d-flex align-items-start pt-4 pe-5 me-5 ms-2">
      <div class="nav flex-column nav-pills me-4" style="text-align-last: left;" id="v-pills-tab" role="tablist" aria-orientation="vertical">
     
      '.$d_attribute_set.'
      </div>
      <div class="tab-content" id="v-pills-tabContent">
      '.$d_attribute_section.'
      </div>
  </div>
';

?>