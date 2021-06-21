<?php
  $con= mysqli_connect("localhost",$_SESSION["db_username"],$_SESSION["db_password"]) or die("Error: " . mysqli_error($con));
  $query = "SELECT * FROM all_in_one_project.log " or die("Error:" . mysqli_error());
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