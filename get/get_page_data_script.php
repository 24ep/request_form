<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<style>
.dataTables_wrapper {
    position: relative;
    clear: both;
    background: white;
    padding: 50px;
    border-radius: 30px;
    box-shadow: 0 .3rem 1rem rgba(0,0,0,.15)!important;
}
</style>
<?php

function get_page_data_script(){


$conn_id = ftp_connect("156.67.217.3") or die("Cannot connect");
ftp_login($conn_id, "admin_convert_module", "a417528639") or die("Cannot login");
ftp_pasv($conn_id, true) or die("Cannot change to passive mode");

$files = ftp_nlist($conn_id, "/atena-query/*.py");

foreach ($files as $file)
{
    $value_account .='<tr style="text-align-last: center;border: solid #dee2e6 1px;background-color: transparent;">';
    $value_account .= '<td>'.$file.'</td>';
    $value_account .= '<td><a href="https://cdse-commercecontent.com/atena-query/running.php?file='.$file.'" target="_blank"class="btn btn-danger btn-sm">Run Script</a></td>';
    $value_account .= '</tr>';
}


?>
<?php
 $table =  '<table class="table" id="st_querry_running_tb"  name="st_querry_running_tb" table table-bordered">
<thead>
    <tr style="text-align-last: center;border: solid #dee2e6 1px;background-color: transparent;">
      <th scope="col">Script</th>
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
  $('#st_querry_running_tb').DataTable();

} );

</script>