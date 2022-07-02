<?php
// $type = $_GET['type']; 

// if($type =='owner'){

// }
 session_start();
 date_default_timezone_set("Asia/Bangkok");
 $con = mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
 mysqli_query($con, "SET NAMES 'utf8' ");
 $query = "
 SELECT log.id, log.`action`, log.action_date, log.action_by, log.action_table, log.action_data_id, log.nt_readable, log.nt_readed , ac.firstname,ac.lastname    
 FROM all_in_one_project.log  as log
 left join all_in_one_project.account ac 
 where (log.nt_readable like '%".$row['username']."%' or log.nt_readed like '%".$row['username']."%' ) and log.action_by <> '".$row['username']."'
 order by log.id desc
 limit 100

 ";
 $result = mysqli_query($con, $query);
 while($row = mysqli_fetch_array($result)) {
    if($row["action_table"]=="add_new_job"){
        $prefix = "NS";
    }elseif($row["action_table"]=="content_request"){
        $prefix = "CR";
    }elseif($row["action_table"]=="checklist_of_content_request"){
        $prefix = "CR";
    }else{
        $prefix = "NA";
    }
    echo ' <li class="notifications-li">
                <span>
                '.ucwords($row["firstname"]).' '.ucwords($row["lastname"]).' has '.$row["action"].' at ticket <strong>'.$prefix.'-'.$row["action_data_id"].'</strong>
                <span>
                <br>
                <small class="timeago" datetime="'.$row["action_date"].'">'.$row["action_date"].'</small>
           </li>';
  }
  mysqli_close($con);
  ?>