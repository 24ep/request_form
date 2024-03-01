<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<style>
.dataTables_wrapper {
    position: initial!important;
    clear: both;
    background: white;
    padding: 30px;
}
</style>
<?php
 session_start();
 include_once("get_default_profile_image.php");
function get_page_account(){
 $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
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
    $value_account .= '<td><button type="button" class="btn btn-outline-dark btn-sm"><ion-icon name="pencil-outline"></ion-icon></button></td>';
    $value_account .= '</tr>';
}


?>
<?php
 $table =  '<table class="table" id="st_account_tb"  name="st_account_tb" >
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
?>

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