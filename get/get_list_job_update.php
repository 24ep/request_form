<?php
// $type = $_GET['type']; 

// if($type =='owner'){

// }
 session_start();
 date_default_timezone_set("Asia/Bangkok");
 $con = mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
 mysqli_query($con, "SET NAMES 'utf8' ");
 $query = "
 SELECT 
 lg.id,
 lg.`action`,
 lg.action_date, lg.action_by, lg.action_table, lg.action_data_id, lg.nt_readable, lg.nt_readed , ac.firstname,ac.lastname  ,
 case when lg.nt_readed like 'poojaroonwit' then read end as readed  
 FROM all_in_one_project.log  as lg
 left join all_in_one_project.account as ac 
 on ac.username = lg.action_by
 where (lg.nt_readable like '%".$row['username']."%' or lg.nt_readed like '%".$row['username']."%' ) and lg.action_by <> '".$row['username']."'
 order by lg.id desc
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

    if($row['readed']=='read'){
        $style = 'style="color: #8a8787;"';

    }
    echo ' <li class="notifications-li" '.$style.'>
                <span>
                <strong>'.ucwords($row["firstname"]).' '.$row["lastname"].'</strong> has '.$row["action"].' at ticket <strong>'.$prefix.'-'.$row["action_data_id"].'</strong>
                <span>
                <br>
                <small class="timeago" datetime="'.$row["action_date"].'">'.$row["action_date"].'</small>
           </li>';
  }
  mysqli_close($con);
  ?>
      <script>
timeago().render(document.querySelectorAll('.timeago'));
    </script>