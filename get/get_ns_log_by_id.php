<?php
 session_start();
$id = $_GET['id'];
$action_table = $_GET['action_table'];
$actiob_data = $_GET['action_data'];
$job_number = $_GET['job_number'];
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
if($_GET['action_data']=="24ep"){;
  $query = "SELECT * FROM u749625779_cdscontent.log_cms where action_at_table='".$action_table."' and job_number ='".$job_number."'" or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {
    //  $tr .=
    //  '<tr>
    //    <td>'.$row["action_date"].'</td>
    //    <td>'.$row["value_change"].'</td>
    //    <td>'.$row["action_from_user"].'</td>
    //  </tr>';
    $tr .= "<li>";
    $tr .= $row["action_from_user"]."<br>";
    $tr .= "<small>".$row["action_date"]."</small><br>";
    $tr .= $row["value_change"]."<br>";
    $tr .= "</li>";
  }
}elseif($_GET['action_data']=="csg"){
  $query = "SELECT * FROM all_in_one_project.log where action_table='".$action_table."' and action_data_id =".$id or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {
    //  $tr .=
    //  '<tr>
    //    <td>'.$row["action_date"].'</td>
    //    <td>'.$row["action"].'</td>
    //    <td>'.$row["action_by"].'</td>
    //  </tr>';
     $tr .= "<li>";
     $tr .= $row["action_by"]."<br>";
     $tr .= "<small>".$row["action_date"]."</small>"."<br>";
     $tr .= $row["action"]."<br>";
     $tr .= "</li>";
  }
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>log NS-<?php echo $id;?></title>
</head>
<body style="font-size:14px">
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <div style="padding-top:10px;">
        <h6 class="ps-3"><strong>log <?php echo "NS-".$id;?></strong></h6>
                <?php echo $tr; ?>
    </div>
</body>
</html>