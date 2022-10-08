<?php
$id = $_POST['action_data_id'];
$action_table = $_POST['action_table'];
$actiob_data = $_POST['action_data'];
$job_number = $_POST['job_number'];
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
if($_POST['action_data']=="24ep"){;
  $query = "SELECT * FROM u749625779_cdscontent.log_cms where action_at_table='".$action_table."' and job_number ='".$job_number."'" or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {
    //  $tr .= 
    //  '<tr>
    //    <td>'.$row["action_date"].'</td>
    //    <td>'.$row["value_change"].'</td>
    //    <td>'.$row["action_from_user"].'</td>
    //  </tr>';
    $tr .= "<li class='list-group-item list-group-item border-bottom p-2' >";
    $tr .= profile_avatar($row["action_from_user"],$row['department'],25);
    $tr .= "<strong>".$row["action_from_user"]."</strong>";
    $tr .= " <small class='ms-1'>".$row["action_date"]."</small>"."<br>";
    $tr .= $row["value_change"]."<br>";
    $tr .= "</li>";
    
  }
}elseif($_POST['action_data']=="csg"){
  $query = "SELECT * FROM all_in_one_project.log where action_table='".$action_table."' and action_data_id =".$id or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {
    //  $tr .= 
    //  '<tr>
    //    <td>'.$row["action_date"].'</td>
    //    <td>'.$row["action"].'</td>
    //    <td>'.$row["action_by"].'</td>
    //  </tr>';
    $action = str_replace("{snapshot}","<span class='badge rounded-pill bg-primary' >Snapshot</span>",$row["action"]);
    $tr .= "<li class='list-group-item list-group-item border-bottom p-2' >";
    $tr .= profile_avatar($row["action_from_user"],$row['department'],25);
    $tr .= "<strong>".$row["action_by"]."</strong>";
    $tr .= " <small class='ms-1'>".$row["action_date"]."</small>"."<br>";
    $tr .=   $action."<br>";
    $tr .= "</li>";
  }
}


?>


    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <div class="container-md" style="padding:10px">
    <h6>log <?php echo "NS-".$id;?></h6>
    <!-- <table class="table table-bordered"> -->
      <!-- <thead>
        <tr>
          <th scope="col">action date</th>
          <th scope="col">action</th>
          <th scope="col">action by</th>
        </tr>
      </thead> -->
      <!-- <tbody> -->
        <?php echo $tr; ?>
      <!-- </tbody> -->
    <!-- </table> -->
    </div>

