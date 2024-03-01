<?php
 session_start();
 date_default_timezone_set("Asia/Bangkok");
 $con_log = mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
 mysqli_query($con_log, "SET NAMES 'utf8' ");
 $query_log = "
 SELECT 
 lg.id,
 lg.`action`,
 lg.action_date, lg.action_by, lg.action_table, lg.action_data_id, lg.nt_readable, lg.nt_readed , ac.firstname,ac.lastname  ,
 case when lg.nt_readed like '%".$_SESSION['username']."%' then 'readed' end as readed  
 FROM all_in_one_project.log  as lg
 left join all_in_one_project.account as ac 
 on ac.username = lg.action_by
 where lg.nt_readable like '%".$_SESSION['username']."%'  and lg.action_by <> '".$_SESSION['username']."' 
 order by lg.id desc
 limit 100
 ";
 $result_log = mysqli_query($con_log, $query_log);
 while($row_log = mysqli_fetch_array($result_log)) {
    if($row_log["action_table"]=="add_new_job"){
        $prefix = "NS";
    }elseif($row["action_table"]=="content_request"){
        $prefix = "CR";
    }elseif($row["action_table"]=="checklist_of_content_request"){
        $prefix = "CR";
    }else{
        $prefix = "NA";
    }

    if($row_log['readed']=='readed'){
        $style_read = 'style="color: #c7c7c7;"';
        $read_badge = '.<small> Read</small>';

    }else{
        unset($style_read);
        unset($read_badge);
    }
    echo ' <li class="notifications-li" '.$style_read.'>
                <span>
                <strong>'.ucwords($row_log["firstname"]).' '.$row_log["lastname"].'</strong> has '.$row_log["action"].' at ticket <strong>'.$prefix.'-'.$row_log["action_data_id"].'</strong>
                </span>
                <br>
                <small class="timeago" datetime="'.$row_log["action_date"].'">'.$row_log["action_date"].'</small> '.$read_badge.'
           </li>';
  }
  mysqli_close($con_log);
  ?>
<script>
    timeago().render(document.querySelectorAll('.timeago'));
</script>

