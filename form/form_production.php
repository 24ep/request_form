<?php
$id=$_POST['id'];
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
include('../get/get_attribute.php');

//get attribute set manu
$query = "SELECT distinct attribute_set,table_name,db_name,primary_key_id,prefix,set_complete_attribute FROM u749625779_cdscontent.job_attribute where allow_display=1 and table_name in ('add_new_job','job_cms') order by sort_attribute_set" or die("Error:" . mysqli_error($con));
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
    echo '<div id="call_update_jc_complete"></div>';
    echo '<ul class="list-group">';
    if($row['set_complete_attribute'] <> ""){
      $query_stc = "SELECT ".$row['set_complete_attribute']." FROM u749625779_cdscontent.job_cms where csg_request_new_id =".$id or die("Error:" . mysqli_error($con));
      $result_stc = mysqli_query($con, $query_stc);
      while($row_stc = mysqli_fetch_array($result_stc)) {
        if($row_stc[$row['set_complete_attribute']]<>""){
            $section_badge = '<ion-icon style="color:green" name="checkmark-circle-outline"></ion-icon>';
        }else{
            $section_badge = '';
        }
      }
      
    }
    $d_attribute_set .=  '  <button style="text-align:-webkit-left" class="nav-link '.$active_section_bt.'" id="v-pills-'.str_replace(" ","_",$row['attribute_set']).'-tab" data-bs-toggle="pill" data-bs-target="#v-pills-'.str_replace(" ","_",$row['attribute_set']).'" type="button" role="tab" aria-controls="v-pills-'.str_replace(" ","_",$row['attribute_set']).'" aria-selected="false">'.ucwords($row['attribute_set'])." ".$section_badge.'</button>';
    $d_attribute_section .= '<div class="tab-pane fade  shadow-sm bg-white p-3 rounded '.$active_section_bd.'" id="v-pills-'.str_replace(" ","_",$row['attribute_set']).'" role="tabpanel" aria-labelledby="v-pills-'.str_replace(" ","_",$row['attribute_set']).'-tab">'.get_attribute_section($row['attribute_set'],$row['table_name'],$row['db_name'],$row['primary_key_id'],$row['prefix']).'</div>';
    echo '</ul>';
    
  }
  echo'
  <div class="d-flex align-items-start">
      <div class="nav flex-column nav-pills me-3 pe-4 p-2 bg-white shadow-sm rounded" style="text-align-last: left;font-weight: 600;" id="v-pills-tab" role="tablist" aria-orientation="vertical">
     
      '.$d_attribute_set.'
      </div>
      <div class="tab-content" id="v-pills-tabContent">
      '.$d_attribute_section.'
      </div>
  </div>
';
?>