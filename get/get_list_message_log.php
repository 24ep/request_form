<?php
   date_default_timezone_set("Asia/Bangkok");
   $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
   mysqli_query($con, "SET NAMES 'utf8' ");
   $query = "SELECT 
   log_data.action_data_id as action_data_id,
   log_data.action_table as action_table,
   log_data.action_date as action_date,
   log_data.action_by as action_by,
   log_data.action as action,
   new_job.brand as nj_brand,
   new_job.sku as nj_sku,
   cr.title as  cr_title 
   FROM all_in_one_project.log as log_data 
   left join all_in_one_project.add_new_job as new_job
   on log_data.action_data_id = new_job.id
   left join all_in_one_project.content_request as cr
   on log_data.action_data_id = cr.id
   where ((new_job.participant like '%".$_SESSION["username"]."%' and (action_table = 'add_new_job' or action_table = 'job_cms')) or ( cr.participant like '%".$_SESSION["username"]."%'and action_table = 'content_request')) and log_data.action_by <> '".$_SESSION["username"]."' order by log_data.id DESC limit 10 ";
   //echo "<script>console.log('".$query."');</script>";
   $result = mysqli_query($con, $query);
   $result_count = mysqli_query($con, $query_count);
   echo "<h6>Latest Update</h6><hr>";
echo '<div class="list-group">';
     while($row = mysqli_fetch_array($result)) {
        if($row["action_table"]=="add_new_job" or $row["action_table"]=="job_cms"){
            $label_id = "<span style='color:red'>NS-".$row["action_data_id"]."</span> ".$row["nj_brand"]." ".$row["nj_sku"];
        }elseif($row["action_table"]=="content_request"){
            $label_id = "<span style='color:red'>CR-".$row["action_data_id"]."</span> ".$row["cr_title"];
        }
        echo 
        '<div class="d-flex w-100 justify-content-between">
             <h5 class="mb-1" style="font-size:15px"><strong>'. $label_id.'</strong></h5>
             <small>'.$row["action_date"].'</small>
           </div>
           <p class="mb-1"><small>'.$row["action"].'</small></p>
           <small style="color:gray">Update by <strong>'.$row["action_by"].'</strong></small>
         <hr>';
    } 
echo '</div>';
  mysqli_close($con);
  ?>