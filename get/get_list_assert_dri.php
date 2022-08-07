<?php

  session_start();
  $id = $_POST["dri_id"];

  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT dri.id, dri.code, dri.label, dri.parent,block.brand as block_name , block.body  
  FROM all_in_one_project.assets_directories as dri
  left join brand_editor as block 
  on block.dri_id  = dri.id
  " or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);

  while($row = mysqli_fetch_array($result)) {
    if($row['body']==''){
      //pring folder
      echo '<li class="list-group-item d-flex justify-content-between align-items-center">
          '.$row['label'].'
        <span class="badge bg-seconday rounded-pill">></span>
      </li>';
    }else{
      //pring assert 
      echo '<li class="list-group-item d-flex justify-content-between align-items-center">
      '.$row['block_name'].'
    </li>';
    }
  }

?>