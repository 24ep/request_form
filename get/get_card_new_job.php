<?php
function get_card_new_job($status,$username){
  if($username==""){
      $username==$_SESSION["username"];
  }
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  if($status=='Close'){
    $limit = 'limit 5';
    $sort = 'update_date DESC';
  }else{
    $sort = 'launch_date ASC';
  }
  $query = "SELECT * FROM all_in_one_project.add_new_job  where follow_assign_name = '".$username."' and ".$status." ORDER by ".$sort." ".$limit ;
  $result = mysqli_query($con, $query);
  $result_count = mysqli_query($con, $query_count);
     while($row = mysqli_fetch_array($result)) {
      $border =   'border-color: transparent;';
    echo    '
    <div class="card" id="card_fl_'.$row["id"].'" style="margin-top:15px;'.$border.'">
        <div class="card-body shadow" >
            <h6 class="card-title" style="font-size:14px"><strong style="color:red">NS-'.$row["id"].'</strong> '.$row["brand"].' '.$row["sku"].' SKUs </h6>
            <div class="row">
              <div class="col" style="color:gray;font-size:12px" >status : </div>
              <div class="col">'.$row["status"].' </div>
            </div>
            <div class="row" style="color:gray;font-size:12px">
              <div class="col">launch  : </div>
              <div class="col">'.$row["launch_date"].' </div>
            </div>
        </div>
    </div>   
    ';
    } 
  mysqli_close($con);
}
  ?>