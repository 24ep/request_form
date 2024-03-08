<?php
 session_start();
 $con= mysqli_connect("service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
 mysqli_query($con, "SET NAMES 'utf8' ");
 $query = "SELECT * FROM all_in_one_project.setting_menu" or die("Error:" . mysqli_error($con));
 $result = mysqli_query($con, $query);
 include($_SERVER['DOCUMENT_ROOT']."/get/get_page_account.php");
 include($_SERVER['DOCUMENT_ROOT']."/get/get_page_data_script.php");
//  include($_SERVER['DOCUMENT_ROOT']."/get/get_page_system_performance.php");
 include($_SERVER['DOCUMENT_ROOT']."/get/get_page_convert_cat_condition.php");
 while($row = mysqli_fetch_array($result)) {
    $value.= '<button style="text-align: left;font-weight: 600;" class="nav-link" id="v-pills-setting_'.$row["code"].'-tab" data-bs-toggle="pill" data-bs-target="#v-pills-setting_'.$row["code"].'" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><ion-icon style="margin-right: 8px" name="'.$row["icon"].'"></ion-icon>'.$row["value"].'</button>';
    $detail.= '<div class="tab-pane fade" id="v-pills-setting_'.$row["code"].'" role="tabpanel" aria-labelledby="v-pills-setting_'.$row["code"].'-tab">';
    // if($row["code"]=="account"){
    //     $detail .= include("/get_page_".$row["code"].".php");
    // }
         if($row["code"]=="account"){
            $detail .= get_page_account();
         }
         if($row["code"]=="data_script"){
          $detail .= get_page_data_script();
         }
         if($row["code"]=="convert_cat_condition"){
          $detail .= get_page_convert_cat_condition();
         }
    $detail.='</div>';
}
?>
<div class="d-flex align-items-start">
  <div class="nav flex-column nav-pills me-3" id="v-pills-tab" style="border-right: solid #ccc 1px;padding: 10px;" role="tablist" aria-orientation="vertical">
    <?php  echo  $value; ?>
  </div>
  <div class="tab-content" style="width:80%" id="v-pills-tabContent">
    <?php  echo  $detail; ?>
  </div>
</div>
