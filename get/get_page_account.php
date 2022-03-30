<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<style>
.dataTables_wrapper {
    position: relative;
    clear: both;
    background: white;
    padding: 50px;
    border-radius: 40px;
    box-shadow: 0 .3rem 1rem rgba(0,0,0,.15)!important;
}
</style>
<?php

function get_page_account(){
 $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
 $query_account = "SELECT * FROM all_in_one_project.account" or die("Error:" . mysqli_error());
 $result_account = mysqli_query($con, $query_account);
 
 while($row_account = mysqli_fetch_array($result_account)) {
   if($row_account["status"]=="Enabled"){
    $status ='<span class="badge rounded-pill bg-success">Enabled</span>';

   }else{
    $status ='<span class="badge rounded-pill bg-secondary">Disabled</span>';
   }
    $value_account .='<tr style="text-align-last: center;border: solid #dee2e6 1px;background-color: transparent;">';
    $value_account .= '<td>'.$row_account["id"].'</td>';
    $value_account .= '<td>'.$row_account["username"].'</td>';
    $value_account .= '<td>'.$status.'</td>';
    $value_account .= '<td>'.$row_account["department"].'</td>';
    $value_account .= '<td>'.$row_account["register_type"].'</td>';
    $value_account .= '<td><button type="button" class="btn btn-outline-dark btn-sm">More detail</button></td>';
    $value_account .= '</tr>';
}


?>
<?php
 $table =  '<table class="table" id="st_account_tb"  name="st_account_tb" table table-bordered">
<thead>
    <tr style="text-align-last: center;border: solid #dee2e6 1px;background-color: transparent;">
      <th scope="col">Account ID</th>
      <th scope="col">Username</th>
      <th scope="col">status</th>
      <th scope="col">Department</th>
      <th scope="col">Register type</th>
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
  $('#st_account_tb').DataTable();

} );

</script>