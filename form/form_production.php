<?php
$id=$_POST['id'];
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
//get attribute 
function get_attribute($attribute_set,$section_group){
    global $con;
    $query = "SELECT  * FROM u749625779_cdscontent.job_attribute 
    where allow_display=1 and $attribute_set = '".$attribute_set."' and section_group ='".$section_group."'" or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $query);
    $attribute="";
    while($row = mysqli_fetch_array($result)) {
        $attribute.= $row['attribute_label'];
    }
    echo $attribute;
}

//get attribute section
function get_attribute_section($attribute_set){
    global $con;
    $query = "SELECT  section_group FROM u749625779_cdscontent.job_attribute 
    where allow_display=1 and $attribute_set = '".$attribute_set."'" or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $query);
    $section="";
    while($row = mysqli_fetch_array($result)) {
        $section .=  $row['section_group'];
        $section .= get_attribute($attribute_set,$row['section_group']);
    }
    echo  $section;
}

//get attribute set manu
$query = "SELECT distinct attribute_set FROM u749625779_cdscontent.job_attribute where allow_display=1" or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  $d_attribute_set="";
  $d_attribute_section="";
  while($row = mysqli_fetch_array($result)) {
    $d_attribute_set .=  '  <button class="nav-link" id="v-pills-'.$row['attribute_set'].'-tab" data-bs-toggle="pill" data-bs-target="#v-pills-'.str_replace(" ","_",$row['attribute_set']).'" type="button" role="tab" aria-controls="v-pills-'.str_replace(" ","_",$row['attribute_set']).'" aria-selected="false">'.str_replace(" ","_",$row['attribute_set']).'</button>';
    $d_attribute_section .= '<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">'.get_attribute_section($row['attribute_set']).'</div>';

  }
  echo'
  <div class="d-flex align-items-start">
      <div class="nav flex-column nav-pills me-3" style="text-align-last: left;" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        '.$d_attribute_set.'
      </div>
      <div class="tab-content" id="v-pills-tabContent">
      '.$d_attribute_section.'
      </div>
  </div>
';
?>