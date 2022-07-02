<?php
 session_start();
 date_default_timezone_set("Asia/Bangkok");
 $con = mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
 mysqli_query($con, "SET NAMES 'utf8' ");
 $query = "
 SELECT count(id) as count_id FROM all_in_one_project.log where nt_readable like '%".$_SESSION["username"]."%' and nt_readed not like '%".$_SESSION["username"]."%'
 ";
 $result = mysqli_query($con, $query);
 while($row = mysqli_fetch_array($result)) {
    $count =  $row['count_id'];
  }
  if($count > 0){
    echo '<span class="position-absolute top-5 start-80 translate-middle badge rounded-pill bg-danger">  
    '.$count.'       
    <span class="visually-hidden">unread messages</span>
    </span>';
  }

  mysqli_close($con);
  ?>
