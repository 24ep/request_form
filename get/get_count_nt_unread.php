<?php
 session_start();
 date_default_timezone_set("Asia/Bangkok");
 $con = mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
 mysqli_query($con, "SET NAMES 'utf8' ");
 $query = "
 SELECT count(id) as count_id FROM all_in_one_project.log where nt_readable like '%".$_SESSION["username"]."%' and (nt_readed not like '%".$_SESSION['username']."%' or nt_readed is null) and action_by <> '".$_SESSION["username"]."'
 ";
 $result = mysqli_query($con, $query);
 while($row = mysqli_fetch_array($result)) {
    $count =  $row['count_id'];
  }
  if($count > 0){
    echo '<span class="position-absolute translate-middle badge rounded-pill bg-danger" style="left: 35px;">  
    '.$count.'
    <span class="visually-hidden">unread messages</span>
    </span>';
  }

  mysqli_close($con);
  ?>
