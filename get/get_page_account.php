<?php

 $query_account = "SELECT * FROM all_in_one_project.account" or die("Error:" . mysqli_error());
 $result_account = mysqli_query($con, $query_account);
 
 while($row_account = mysqli_fetch_array($result_account)) {
    $value_account .= '<tr>';
    $value_account.= '<td>'.$row_account["id"].'</td>';
    $value_account.= '<td>'.$row_account["username"].'</td>';
    $value_account.= '<td>'.$row_account["status"].'</td>';
    $value_account.= '<td>'.$row_account["department"].'</td>';
    $value_account.= '<td>'.$row_account["register_type"].'</td>';
    $value_account.= '<td><ion-icon name="ellipsis-vertical-outline"></ion-icon></td>';
    $value_account .= '</tr>';
}


?>
<?php
echo  '<table class="table table-borderless">
<thead>
    <tr>
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

?>