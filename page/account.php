
<style>
.dataTables_wrapper {
    position: relative;
    clear: both;
    background: white;
    padding: 50px;
    border-radius: 10px;
    box-shadow: 0 .3rem 1rem rgba(0,0,0,.15)!important;
}
</style>



<?php
session_start();
include_once("../get/get_default_profile_image.php");
function get_page_account(){

 $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
 $query_account = "SELECT * FROM all_in_one_project.account" or die("Error:" . mysqli_error($con));
 $result_account = mysqli_query($con, $query_account);

 while($row_account = mysqli_fetch_array($result_account)) {
  unset($image_profile);
  // $image_profile = profile_image($row_account['firstname'],$row_account['department'],32,$row_account['case_officer'],1);
  $image_profile = profile_avatar_medium($row_account['firstname'],$row_account['lastname'],$row_account['department'],32);
   if($row_account["status"]=="Enabled"){
    $status ='<span class="badge rounded-pill bg-success">Enabled</span>';

   }else{
    $status ='<span class="badge rounded-pill bg-secondary">Disabled</span>';
   }
    $value_account .='<tr style="text-align-last: center;border: solid #dee2e6 1px;background-color: transparent;">';
    $value_account .= '<td scope="col">'.$row_account["id"].'</td>';
    $value_account .= '<td style="width:30%"><div class="row"><div class="col-2">
    '.$image_profile.'</div><div style="text-align-last: left;" class="col-10">
    <strong>'.$row_account["firstname"]." ".$row_account["lastname"].' ('.$row_account["nickname"].')</strong>
    <br>
    <small>Username : '.$row_account["username"].'</small></div></div></td>';
    $value_account .= '<td style="text-align-last: left;"><ion-icon class="icon-mg" name="mail-outline"></ion-icon>'.$row_account["work_email"].'<br><ion-icon class="icon-mg" name="call-outline"></ion-icon>'.$row_account["office_tell"].'</td>';
    $value_account .= '<td>'.$status.'</td>';
    $value_account .= '<td>'.$row_account["department"].'</td>';
    $value_account .= '<td><button type="button" onclick="call_model_edit_account(&#39;'.$row_account["username"].'&#39;)" class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><ion-icon name="pencil-outline"></ion-icon></button></td>';
    $value_account .= '</tr>';
}
?>
<?php

 $table =  '<table class="table" id="st_account_tb" name="st_account_tb" >
<thead>
    <tr style="text-align-last: center;border: solid #dee2e6 1px;background-color: transparent;">
      <th style="text-align-last: center;" scope="col">ID</th>
      <th scope="col" style="width: 30%;text-align-last: left;">Name</th>
      <th scope="col">Contact</th>
      <th scope="col">Status</th>
      <th scope="col">Department</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    '.$value_account.'
  </tbody>
</table>';

return $table;
}
$detail = get_page_account();

?>

<nav>
  <div class="nav nav-tabs shadow-sm bg-white" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-account-tab" data-bs-toggle="tab" data-bs-target="#nav-account" type="button" role="tab" aria-controls="nav-account" aria-selected="true">Accounts</button>
    <button class="nav-link" id="nav-attribute-tab" data-bs-toggle="tab" data-bs-target="#nav-attribute" type="button" role="tab" aria-controls="nav-attribute" aria-selected="false">Attribute</button>
    <button class="nav-link" id="nav-app_version_control-tab" data-bs-toggle="tab" data-bs-target="#nav-app_version_control" type="button" role="tab" aria-controls="nav-app_version_control" aria-selected="false">App version control</button>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-account" role="tabpanel" aria-labelledby="nav-account-tab" tabindex="0"><nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand">Account</a>
    <div class="d-flex">

      <button class="btn btn-outline-success disabled">Create new account</button>
    </div>
  </div>
</nav>
  <?php echo $detail; ?></div>
  <div class="tab-pane fade" style="overflow: auto;" id="nav-attribute" role="tabpanel" aria-labelledby="nav-attribute-tab" tabindex="0">
    <?php include('attribute_config.php'); ?>
  </div>
  <div class="tab-pane fade" style="overflow: auto;" id="nav-app_version_control" role="tabpanel" aria-labelledby="nav-app_version_control-tab" tabindex="0">
    <?php include('app_version_control.php'); ?>
  </div>
</div>
<script>
  $(document).ready( function () {
  $('#st_account_tb').DataTable({
        lengthMenu: [
            [10,20, 50, 100, -1],
            [10, 20,50, 100, 'All'],
        ],
    });

} );



</script>
