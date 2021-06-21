<?php
$id = $_GET['id'];
$action_table = $_GET['action_table'];

  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  $query = "SELECT * FROM all_in_one_project.log where action_table='".$action_table."' and action_data_id =".$id or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);
   while($row = mysqli_fetch_array($result)) {
      $tr .= 
      '<tr>
        <th scope="row">'.$row["action_date"].'</th>
        <td>'.$row["action"].'</td>
        <td>'.$row["action_by"].'</td>
      </tr>';
   }
?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">action date</th>
      <th scope="col">action</th>
      <th scope="col">action by</th>
    </tr>
  </thead>
  <tbody>
  <?php echo $tr; ?>
  </tbody>
</table>