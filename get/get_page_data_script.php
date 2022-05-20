<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css"></script>
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

function get_page_data_script(){


// $conn_id = ftp_connect("156.67.217.3") or die("Cannot connect");
// ftp_login($conn_id, "admin_convert_module", "a417528639") or die("Cannot login");
// ftp_pasv($conn_id, true) or die("Cannot change to passive mode");

// $files = ftp_nlist($conn_id, "/atena-query/*.py");

// foreach ($files as $file)
// {
//     $value_account .='<tr style="text-align-last: center;border: solid #dee2e6 1px;background-color: transparent;">';
//     $value_account .= '<td>'.$file.'</td>';
//     $value_account .= '<td><a href="https://cdse-commercecontent.com/atena-query/running.php?file='.$file.'" target="_blank"class="btn btn-danger btn-sm">Run Script</a></td>';
//     $value_account .= '</tr>';
// }

$value_account ='<tr style="text-align-last: center;border: solid #dee2e6 1px;background-color: transparent;">';
$value_account .= '<td scope="col">SKU on web status checking</td>';
$value_account .= '<td>db_mdc-monitor_list.py</td>';
$value_account .= '<td><a href="https://docs.google.com/spreadsheets/d/1JUGTB55LmrI5tcJjpt6HVtf1fC8Ak3h3ofSoUuZ_6ds/edit#gid=893993526" target="_blank"><ion-icon class="icon-mg" name="analytics-outline"></ion-icon>Input sku here</a></td>';
$value_account .= '<td><a href="https://datastudio.google.com/u/0/reporting/b90ee0e2-066f-4a82-a210-6ce8c514947d/page/p_tm56um2itc" target="_blank"></ion-icon>Dashboard</a></td>';
$value_account .= '<td><a href="https://cdse-commercecontent.com/atena-query/running.php?file=db_mdc-monitor_list.py" target="_blank"class="btn btn-danger btn-sm">Run Script</a></td>';
$value_account .= '<td><a href="https://github.com/DVM-CDS-CONTENT/athena-cds-product-query/blob/main/db_mdc-monitor_list.py" ><ion-icon name="logo-github"></ion-icon></a></td>';
$value_account .= '</tr>';

$value_account .='<tr style="text-align-last: center;border: solid #dee2e6 1px;background-color: transparent;">';
$value_account .= '<td scope="col">Brand day checking</td>';
$value_account .= '<td>db_mdc-brand_day.py</td>';
$value_account .= '<td><a href="https://docs.google.com/spreadsheets/d/1JUGTB55LmrI5tcJjpt6HVtf1fC8Ak3h3ofSoUuZ_6ds/edit#gid=1693215773" target="_blank"><ion-icon class="icon-mg" name="analytics-outline"></ion-icon>Input sku here</a></td>';
$value_account .= '<td><a href="https://datastudio.google.com/reporting/b90ee0e2-066f-4a82-a210-6ce8c514947d/page/p_m13q7ei0qc" target="_blank"><ion-icon class="icon-mg" name="reader-outline"></ion-icon>Dashboard</a></td>';
$value_account .= '<td><a href="https://cdse-commercecontent.com/atena-query/running.php?file=db_mdc-brand_day.py" target="_blank"class="btn btn-danger btn-sm">Run Script</a></td>';
$value_account .= '<td><a href="https://github.com/DVM-CDS-CONTENT/athena-cds-product-query/blob/main/db_mdc-brand_day.py" ><ion-icon name="logo-github"></ion-icon></a></td>';
$value_account .= '</tr>';

?>
<?php
 $table =  '<table class="table" id="st_querry_running_tb"  name="st_querry_running_tb" table table-bordered">
<thead>
    <tr style="text-align-last: center;border: solid #dee2e6 1px;background-color: transparent;">
      <th scope="col">Script</th>
      <th scope="col">File</th>
      <th scope="col">Input data</th>
      <th scope="col">Output data</th>
      <th scope="col">Action</th>
      <th scope="col">Source code</th>
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
  $('#st_querry_running_tb').DataTable({
        lengthMenu: [
            [25, 50, 100, -1],
            [25, 50, 100, 'All'],
        ],
    });

} );

</script>