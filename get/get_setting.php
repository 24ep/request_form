<?php
 $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
 mysqli_query($con, "SET NAMES 'utf8' ");
 $query = "SELECT value FROM content_service_gate.setting_menu" or die("Error:" . mysqli_error());
 $result = mysqli_query($con, $query);
 while($row = mysqli_fetch_array($result)) {
    $value.= '<button class="nav-link" id="v-pills-setting_'.$row["value"].'-tab" data-bs-toggle="pill" data-bs-target="#v-pills-setting_'.$row["value"].'" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">'.$row["value"].'</button>';
    $detail.= '<div class="tab-pane fade" id="v-pills-setting_'.$row["value"].'" role="tabpanel" aria-labelledby="v-pills-setting_'.$row["value"].'-tab">Coming Soon</div>';
}

?>

<div class="d-flex align-items-start">
  <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <?php  echo  $value; ?>
  </div>
  <div class="tab-content" id="v-pills-tabContent">
    <?php  echo  $detail; ?>
  </div>
</div>