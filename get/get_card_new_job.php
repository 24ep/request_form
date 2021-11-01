<?php
function get_card_new_job($status){
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  if($status=='Close'){
    $limit = 'limit 5';
    $sort = 'update_date DESC';
  }else{
    $sort = 'id ASC';
  }
  $query = "SELECT * FROM all_in_one_project.add_new_job  where follow_assign_name = ".$_SESSION["username"]." and ".$status." ORDER by ".$sort." ".$limit ;
  $result = mysqli_query($con, $query);
  $result_count = mysqli_query($con, $query_count);
     while($row = mysqli_fetch_array($result)) {
    echo    '
    <div class="card" id="card_fl_'.$row["id"].'" style="margin-top:15px;'.$border.'">
        <div class="card-body shadow" >
            <h6 class="card-title" style="font-size:14px"><strong style="color:red">NS-'.$row["id"].'</strong> '.$row["brand"].' '.$row["sku"].' </h6>
        </div>
    </div>   
    ';
    } 
  mysqli_close($con);
}
  ?>