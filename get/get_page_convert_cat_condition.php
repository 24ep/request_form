<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script> -->
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
function get_page_convert_cat_condition(){
 $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
 $query = "SELECT * FROM u749625779_cdscontent.pim_cate_convert_condition" or die("Error:" . mysqli_error($con));
 mysqli_query($con, "SET NAMES 'utf8' ");
 $result = mysqli_query($con, $query);
 while($row = mysqli_fetch_array($result)) {
    $value .= '<tr>';
    $value .= '<td scope="col">'.$row['id'].'</td>';
    $value .= '<td scope="col"><ul>
                <li> dept :'.$row['department'].'</li>
                <li> sdept :'.$row['sub_department'].'</li>
                <li> sdept :'.$row['sub_department'].'</li>
                <li> bou_dept :'.$row['boutique_department'].'</li>
                <li> bou_sdept :'.$row['boutique_sub_department'].'</li>
                <li> gender :'.$row['gender'].'</li>
                <li> age :'.$row['age'].'</li>
                <li> occasion :'.$row['occasion'].'</li>
                </ul>
               </td>';
    $value .= '<td scope="col">'.$row['category_path_cds'].'</td>';
    $value .= '<td scope="col">Action</td>';
    $value .= '</tr>';
}


?>
<?php
 $table =  '<table class="table" id="st_convert_cate_mapping"  name="st_convert_cate_mapping" >
<thead>
    <tr style="text-align-last: center;border: solid #dee2e6 1px;background-color: transparent;">
      <th style="text-align-last: center;" scope="col">Id</th>
      <th scope="col" style="text-align-last: left;">Condition</th>
      <th scope="col">category_path_cds</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    '.$value.'
  </tbody>
</table>';

return $table;
}
?>

<script>
  $(document).ready( function () {
  $('#st_convert_cate_mapping').DataTable({
        lengthMenu: [
            [10,20, 50, 100, -1],
            [10, 20,50, 100, 'All'],
        ],
    });

} );

</script>