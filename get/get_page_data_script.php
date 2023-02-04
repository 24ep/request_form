<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css"></script> -->
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
function get_page_data_script(){
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query_cr = "SELECT * FROM all_in_one_project.script_running order by id ASC" or die("Error:" . mysqli_error($con));
  // loop old
  $result =  mysqli_query($con, $query_cr);
  $value_account="";
  while($rowscript = mysqli_fetch_array($result)) {
    
    $value_account .='<tr style="text-align-last: center;border: solid #dee2e6 1px;background-color: transparent;">';
    $value_account .= '<td style="width:40%;text-align-last: left;" scope="col"><strong>'.$rowscript["script_name"].'</strong><br><small>'.$rowscript["description"].'</small></td>';
    $value_account .= '<td><a href="'.$rowscript["input_date_link"].'" target="_blank"><ion-icon class="icon-mg" name="analytics-outline"></ion-icon>Input sku here</a></td>';
    $value_account .= '<td><a href="'.$rowscript["dashboard_link"].'" target="_blank"></ion-icon>Dashboard</a></td>';
    $value_account .= '<td><a href="'.$rowscript["scurce_code"].'" ><ion-icon name="logo-github"></ion-icon></a></td>';
    $value_account .= '<td><a href="'.$rowscript["running_path"].'" target="_blank"class="btn btn-danger btn-sm">Run Script</a></td>';
    $value_account .= '</tr>';
  } 




?>
<?php
 $table =  '<table class="table" id="st_querry_running_tb"  name="st_querry_running_tb" table table-bordered">
<thead>
    <tr style="text-align-last: center;border: solid #dee2e6 1px;background-color: transparent;">
      <th scope="col">Script</th>
      <th scope="col">Input data</th>
      <th scope="col">Output data</th>
      <th scope="col">Source code</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>
    '.$value_account.'
  </tbody>
</table>';
mysqli_close($con);
return $table;
}
?>

<script>
  $(document).ready( function () {
  $('#st_querry_running_tb').DataTable({
        lengthMenu: [
            [25, 50, 100, -1],
            [25, 50, 100, 'All'],
        ],
    });

} );

</script>