<?php
function get_page_account(){
 $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
 mysqli_query($con, "SET NAMES 'utf8' ");
 $query = "SELECT value,icon FROM all_in_one_project.account" or die("Error:" . mysqli_error());
 $result = mysqli_query($con, $query);
 
 while($row = mysqli_fetch_array($result)) {
    $value .= '<tr>';
    $value.= '<td>$row["'.$row["id"].'"]</td>';
    $value.= '<td>$row["'.$row["username"].'"]</td>';
    $value.= '<td>$row["'.$row["work_email"].'"]</td>';
    $value.= '<td>$row["'.$row["status"].'"]</td>';
    $value.= '<td>$row["'.$row["department"].'"]</td>';
    $value.= '<td>$row["'.$row["register_type"].'"]</td>';
    $value.= '<td>IP : 45.55.55.4 T : 14 Feb 2022 12:10 PM</td>';
    $value.= '<td><ion-icon name="ellipsis-vertical-outline"></ion-icon></td>';
    $value .= '</tr>';
}


?>
<?php
echo '<table class="table table-borderless">
<thead>
    <tr>
      <th scope="col">Account ID</th>
      <th scope="col">Username</th>
      <th scope="col">Mail</th>
      <th scope="col">status</th>
      <th scope="col">Department</th>
      <th scope="col">Register type</th>
      <th scope="col">Last login</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    '.$value.'
  </tbody>
</table>';
}
?>