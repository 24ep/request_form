<?php
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$query_bk = "SELECT DISTINCT  bucket FROM all_in_one_project.quick_link;" or die("Error:" . mysqli_error());
$result_bk = mysqli_query($con, $query_bk);
while($row_bk = mysqli_fetch_array($result_bk)) {
$bk_list .= '<button class="nav-link" id="v-pills-'.$row_bk["bucket"].'-tab" data-bs-toggle="pill" data-bs-target="#v-pills-'.$row_bk["bucket"].'" type="button" role="tab" aria-controls="v-pills-'.$row_bk["bucket"].'" aria-selected="false">'.$row_bk["bucket"].'</button>';

$query = "SELECT * from quick_link where bucket = '".$row_bk["bucket"]."'" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);

while($row = mysqli_fetch_array($result)) {
    $list_detail = '
    <div class="card">
        <div class="card-body">
        <a href="'.$row["link"].'" target="_blank" ><h5 class="card-header">'.$row["label"].'</h5></a>
                '.$row["description"].'
            </div>
        </div>';
}
$bk_detail .= '<div class="tab-pane fade" id="v-pills-'.$row_bk["bucket"].'" role="tabpanel" aria-labelledby="v-pills-'.$row_bk["bucket"].'-tab">'.$list_detail.'</div>';
unset($list_detail);
}


    
?>

<div class="d-flex align-items-start">
  <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <?php echo $bk_list; ?>
  </div>
  <div class="tab-content" id="v-pills-tabContent">
  <?php echo $bk_detail; ?>
  </div>
</div>