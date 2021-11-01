<?php
function get_card_new_job($status,$username){
  if($username==''){
      $username=$_SESSION["username"];
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
  $query = "SELECT * FROM all_in_one_project.add_new_job  where (".$status." and follow_assign_name = '".$username."') or status = 'none' ORDER by ".$sort." ".$limit ;
  echo '<script>console.log("'.$query.'")</script>';
  $result = mysqli_query($con, $query);
  // $result_count = mysqli_query($con, $query_count);
     while($row = mysqli_fetch_array($result)) {
      $border =   'border-color: transparent;';

      if($row["config_type"]=="parent" ){
          //count sub ticket
          $query_count="SELECT count(*) as total from all_in_one_project.add_new_job where follow_assign_name = '".$username."' and ".$status."  and parent = ".$row["id"];
          $result_count = mysqli_query($con, $query_count);
          $data_count=mysqli_fetch_assoc($result_count);
          $subtask_count = $data_count['total'];
          echo '<script>console.log("s-'.$subtask_count."p-".$row["id"].'")</script>';
          if(isset($subtask_count) and $subtask_count <> 0 and $subtask_count <>null){
            echo '<script>console.log("s-pass")</script>';
            echo '  <div class="card" data-bs-toggle="offcanvas" data-bs-target="#edit_add_new" aria-controls="offcanvasExample" onclick="call_edit_add_new_modal('.$row['id'].')" style="margin-top:15px;background:#c6c6c6;padding:5px;'.$border.'">';
            echo ' <h6 class="card-title" data-bs-toggle="offcanvas" data-bs-target="#edit_add_new" aria-controls="offcanvasExample" onclick="call_edit_add_new_modal('.$row['id'].')"  style="font-size:14px"><strong style="color:red;margin-bottom:0px">NS-'.$row["id"].'</strong> '.$row["brand"].' '.$row["sku"].' SKUs </h6>';  
            $query_child = "SELECT * FROM all_in_one_project.add_new_job  where parent = ".$row['id']." ORDER by ".$sort." ".$limit ;
              $result_child  = mysqli_query($con, $query_child);
              while($row_child = mysqli_fetch_array($result_child)) {
                if(strtolower($row_child["follow_assign_name"])==strtolower($username) and strpos($status,$row_child["status"])!==FALSE  ){
                  if($row_child["launch_date"]==""){
                    $launch_date="no launch date";
                  }else{
                    $launch_date=$row_child["launch_date"];
                  }
                        $current_day = date('Y-m-d');
                  $up_date = date('Y-m-d', strtotime($row_child["update_date"])); 
                 $date_diff = (strtotime($current_day) - strtotime($up_date)) /  ( 60 * 60 * 24 );
                 $date_diff_f = number_format($date_diff);
                  
                 $text_launch_date = 'อัพเดตล่าสุดเมื่อ '.$date_diff_f.' วันที่แล้ว';
                  if( $date_diff>2){
                    $badge_update = '<span class="badge bg-secondary text-dark" style="background-color: #e9ebed!important;">'. $text_launch_date.'</span>';
                  }else{
                    $badge_update = "";
                  }
          $date_diff_ld = (strtotime($current_day) - strtotime($row_child["launch_date"])) /  ( 60 * 60 * 24 );
          $date_diff_ld_f = number_format($date_diff_ld);
                 $text_ld = 'อีก '.$date_diff_ld_f.' วัน launch date นะ เลื่อนไหม ?';
               if($date_diff_ld<4 and $row_child["launch_date"]<>""){
                    $badge_ld = '<span class="badge bg-warning text-dark">'. $text_ld.'</span>';
                  }else{
                    $badge_ld = "";
                  }
                 
                  echo    '
                  <div class="card" data-bs-toggle="offcanvas" data-bs-target="#edit_add_new" aria-controls="offcanvasExample" onclick="call_edit_add_new_modal('.$row_child['id'].')" style="margin-top:15px;'.$border.'">
                      <div data-bs-toggle="offcanvas" data-bs-target="#edit_add_new" aria-controls="offcanvasExample" onclick="call_edit_add_new_modal('.$row_child['id'].')"  class="card-body shadow" >
                          <h6 class="card-title" data-bs-toggle="offcanvas" data-bs-target="#edit_add_new" aria-controls="offcanvasExample" onclick="call_edit_add_new_modal('.$row_child['id'].')"  style="font-size:14px"><strong style="color:red">NS-'.$row_child["id"].'</strong> '.$row_child["brand"].' '.$row_child["sku"].' SKUs </h6>
                           '.$badge_update.''.$badge_ld.'
                          <div class="row" style="margin-bottom:3px;margin-top:3px;color:gray;font-size:12px;" data-bs-toggle="offcanvas" data-bs-target="#edit_add_new" aria-controls="offcanvasExample" onclick="call_edit_add_new_modal('.$row_child['id'].')" >
                            <div class="col-3">status : </div>
                            <div class="col-9">'.$row_child["status"].' </div>
                          </div>
                          <div class="row" style="margin-bottom:3px;margin-top:3px;color:gray;font-size:12px" data-bs-toggle="offcanvas" data-bs-target="#edit_add_new" aria-controls="offcanvasExample" onclick="call_edit_add_new_modal('.$row_child['id'].')"  >
                            <div class="col-3">launch  : </div>
                            <div class="col-9">'. $launch_date.' </div>
                          </div>
                      </div>
                  </div>   
                  ';
                }else{
                  if($row_child["launch_date"]==""){
                    $launch_date="no launch date";
                  }else{
                    $launch_date=$row_child["launch_date"];
                  }
                       $current_day = date('Y-m-d');
                  $up_date = date('Y-m-d', strtotime($row_child["update_date"])); 
                 $date_diff = (strtotime($current_day) - strtotime($up_date)) /  ( 60 * 60 * 24 );
                 $date_diff_f = number_format($date_diff);
                  
                 $text_launch_date = 'อัพเดตล่าสุดเมื่อ '.$date_diff_f.' วันที่แล้ว';
                  if( $date_diff>2){
                    $badge_update = '<span class="badge bg-secondary text-dark" style="background-color: #e9ebed!important;">'. $text_launch_date.'</span>';
                  }else{
                    $badge_update = "";
                  }
          $date_diff_ld = (strtotime($current_day) - strtotime($row_child["launch_date"])) /  ( 60 * 60 * 24 );
          $date_diff_ld_f = number_format($date_diff_ld);
                 $text_ld = 'อีก '.$date_diff_ld_f.' วัน launch date นะ เลื่อนไหม ?';
               if($date_diff_ld<4 and $row_child["launch_date"]<>""){
                    $badge_ld = '<span class="badge bg-warning text-dark">'. $text_ld.'</span>';
                  }else{
                    $badge_ld = "";
                  }
                  echo    '
                  <div class="card" data-bs-toggle="offcanvas" data-bs-target="#edit_add_new" aria-controls="offcanvasExample" onclick="call_edit_add_new_modal('.$row_child['id'].')" style="margin-top:15px;background:#e3e3e3;color:#c6c6c6;'.$border.'">
                      <div data-bs-toggle="offcanvas" data-bs-target="#edit_add_new" aria-controls="offcanvasExample" onclick="call_edit_add_new_modal('.$row_child['id'].')"  class="card-body shadow" >
                          <h6 class="card-title" data-bs-toggle="offcanvas" data-bs-target="#edit_add_new" aria-controls="offcanvasExample" onclick="call_edit_add_new_modal('.$row_child['id'].')"  style="font-size:14px;color:#c6c6c6;"><strong style="color:#c6c6c6">NS-'.$row_child["id"].'</strong> '.$row_child["brand"].' '.$row_child["sku"].' SKUs </h6>
                            '.$badge_update.''.$badge_ld.'
                          <div class="row" style="margin-bottom:3px;margin-top:3px;color:#c6c6c6;font-size:12px" data-bs-toggle="offcanvas" data-bs-target="#edit_add_new" aria-controls="offcanvasExample" onclick="call_edit_add_new_modal('.$row_child['id'].')" >
                            <div class="col-3">status : </div>
                            <div class="col-9">'.$row_child["status"].' </div>
                          </div>
                          <div class="row" style="margin-bottom:3px;margin-top:3px;color:#c6c6c6;font-size:12px" data-bs-toggle="offcanvas" data-bs-target="#edit_add_new" aria-controls="offcanvasExample" onclick="call_edit_add_new_modal('.$row_child['id'].')"  >
                            <div class="col-3">launch  : </div>
                            <div class="col-9">'. $launch_date.' </div>
                          </div>
                      </div>
                  </div>   
                  ';
                }

              }
            echo '</div>';
          }
   
      }else{
        if($row["launch_date"]==""){
          $launch_date="no launch date";
        }else{
          $launch_date=$row["launch_date"];
        }
                 $current_day = date('Y-m-d');
                  $up_date = date('Y-m-d', strtotime($row["update_date"])); 
                 $date_diff = (strtotime($current_day) - strtotime($up_date)) /  ( 60 * 60 * 24 );
                 $date_diff_f = number_format($date_diff);
                  
                 $text_launch_date = 'อัพเดตล่าสุดเมื่อ '.$date_diff_f.' วันที่แล้ว';
                  if( $date_diff>2){
                    $badge_update = '<span class="badge bg-secondary text-dark" style="background-color: #e9ebed!important;">'. $text_launch_date.'</span>';
                  }else{
                    $badge_update = "";
                  }
          $date_diff_ld = (strtotime($current_day) - strtotime($row["launch_date"])) /  ( 60 * 60 * 24 );
          $date_diff_ld_f = number_format($date_diff_ld);
                 $text_ld = 'อีก '.$date_diff_ld_f.' วัน launch date นะ เลื่อนไหม ?';
               if($date_diff_ld<4 and $row["launch_date"]<>""){
                    $badge_ld = '<span class="badge bg-warning text-dark">'. $text_ld.'</span>';
                  }else{
                    $badge_ld = "";
                  }
        echo    '
        <div class="card" data-bs-toggle="offcanvas" data-bs-target="#edit_add_new" aria-controls="offcanvasExample" onclick="call_edit_add_new_modal('.$row['id'].')" style="margin-top:15px;'.$border.'">
            <div data-bs-toggle="offcanvas" data-bs-target="#edit_add_new" aria-controls="offcanvasExample" onclick="call_edit_add_new_modal('.$row['id'].')"  class="card-body shadow" >
                <h6 class="card-title" data-bs-toggle="offcanvas" data-bs-target="#edit_add_new" aria-controls="offcanvasExample" onclick="call_edit_add_new_modal('.$row['id'].')"  style="font-size:14px"><strong style="color:red">NS-'.$row["id"].'</strong> '.$row["brand"].' '.$row["sku"].' SKUs </h6>
                  '.$badge_update.''.$badge_ld.'
                <div class="row" style="margin-bottom:3px;margin-top:3px;color:gray;font-size:12px" data-bs-toggle="offcanvas" data-bs-target="#edit_add_new" aria-controls="offcanvasExample" onclick="call_edit_add_new_modal('.$row['id'].')" >
                  <div class="col-3">status : </div>
                  <div class="col-9">'.$row["status"].' </div>
                </div>
                <div class="row" style="margin-bottom:3px;margin-top:3px;color:gray;font-size:12px" data-bs-toggle="offcanvas" data-bs-target="#edit_add_new" aria-controls="offcanvasExample" onclick="call_edit_add_new_modal('.$row['id'].')"  >
                  <div class="col-3">launch  : </div>
                  <div class="col-9">'. $launch_date.' </div>
                </div>
            </div>
        </div>   
        ';
      }
  
    } 
  mysqli_close($con);
}
function count_add_new_card($status,$username){
  if($username==''){
    $username=$_SESSION["username"];
}
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query_count="SELECT count(*) as total from all_in_one_project.add_new_job where follow_assign_name = '".$username."' and ".$status;
  $result_count = mysqli_query($con, $query_count);
  $data_count=mysqli_fetch_assoc($result_count);
  $subtask_count = $data_count['total'];
  echo $subtask_count;
}
function sum_add_new_card($status,$username){
  if($username==''){
    $username=$_SESSION["username"];
}
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query_count="SELECT sum(sku) as total from all_in_one_project.add_new_job where follow_assign_name = '".$username."' and ".$status;
  $result_count = mysqli_query($con, $query_count);
  $data_count=mysqli_fetch_assoc($result_count);
  $subtask_count = $data_count['total'];
  if($subtask_count>0){
    echo number_format($subtask_count);
  }else{
    echo 0;
  }
  
}
  ?>
