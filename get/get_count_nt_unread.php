<?php
 session_start();
 date_default_timezone_set("Asia/Bangkok");
 $con = mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
 mysqli_query($con, "SET NAMES 'utf8' ");
 $query = "
 SELECT count(id) as count_id FROM all_in_one_project.log where nt_readable like '%".$_SESSION["username"]."%' and lg.nt_readed <> '".$_SESSION['username']."' and action_by not like '%".$_SESSION["username"]."%'
 ";
 $result = mysqli_query($con, $query);
 while($row = mysqli_fetch_array($result)) {
    $count =  $row['count_id'];
  }
  if($count > 0){
    echo '<span class="position-absolute translate-middle badge rounded-pill bg-danger" style="left: 35px;top: 10px;">  
    '.$count.'       
    <span class="visually-hidden">unread messages</span>
    </span>';
  }

  mysqli_close($con);
  ?>
