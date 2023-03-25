<?php
  include("get_default_profile_image.php");
$id = $_POST['action_data_id'];
$action_table = $_POST['action_table'];
$actiob_data = $_POST['action_data'];
$job_number = $_POST['job_number'];
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
if($_POST['action_data']=="24ep"){;
  $query = "SELECT * FROM u749625779_cdscontent.log_cms where action_at_table in ('job_cms','add_new_job') and job_number ='".$job_number."' order by id DESC" or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {
    //  $tr .=
    //  '<tr>
    //    <td>'.$row["action_date"].'</td>
    //    <td>'.$row["value_change"].'</td>
    //    <td>'.$row["action_from_user"].'</td>
    //  </tr>';
    $image_profile = profile_avatar($row["action_from_user"],$row['department'],25);
    $tr .= "<li class='list-group-item list-group-item border-bottom p-2' >";
    $tr .=  $image_profile;
    $tr .= "<strong class='ms-2'>".$row["action_from_user"]."</strong>";
    $tr .= " <small class='ms-1'>".$row["action_date"]."</small>"."<br>";
    $tr .= "<span class='ms-2'>".$row["value_change"]."</span><br>";
    $tr .= "</li>";

  }
}elseif($_POST['action_data']=="csg"){
  $query = "SELECT * FROM all_in_one_project.log where action_table in ('job_cms','add_new_job') and action_data_id =".$id." order by id DESC" or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {
    //  $tr .=
    //  '<tr>
    //    <td>'.$row["action_date"].'</td>
    //    <td>'.$row["action"].'</td>
    //    <td>'.$row["action_by"].'</td>
    //  </tr>';
    $image_profile = profile_avatar($row["action_by"],$row['department'],25);
    $action = str_replace("{snapshot}","<span class='badge rounded-pill bg-primary me-1' >Snapshot</span>",$row["action"]);
    $action = str_replace("{add_new_job} ","<span class='badge rounded-pill bg-dark m-1' >NS</span>",$action);
    $action = str_replace("update ","<span class='badge rounded-pill bg-dark m-1' >Update</span>",$action);
    $action = str_replace("New comment","<span class='badge rounded-pill bg-secondary m-1' >Comment</span>",$action);
    $action = str_replace("add_new_job","<span class='badge rounded-pill bg-primary m-1' >NS</span>",$action);
    $tr .= "<li class='list-group-item list-group-item border-bottom ps-4 pe-4 p-3' >";
    $tr .=  $image_profile;
    $tr .= "<strong class='ms-2'>".$row["action_by"]."</strong>";
    $tr .= " <small class='ms-1'>".$row["action_date"]."</small>"."<br>";
    $tr .=   "<span class='mt-1'>".$action."</span><br>";
    $tr .= "</li>";
  }
}


?>




    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <div >
    <ion-icon name="time-outline"></ion-icon>
    <h6 class="border-bottom p-3"><strong>Logs of <?php echo "NS-".$id;?></strong></h6>
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

