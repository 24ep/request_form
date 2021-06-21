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

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <h1>Hello, world!</h1>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

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

  </body>
</html>