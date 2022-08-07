<?php

  session_start();
  $dri_id = $_POST["dri_id"];
  if($dri_id==""){
    $dri_id = 0;
  }
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT dri.id, dri.code, dri.label, dri.parent,block.brand as block_name , block.body  
  FROM all_in_one_project.assets_directories as dri
  left join brand_editor as block  
  on block.dri_id  = dri.id where  dri.id =  ".$dri_id."
  " or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);

  while($row = mysqli_fetch_array($result)) {
    if($row['body']==''){
      //pring folder
      echo '<li class="list-group-item d-flex justify-content-between align-items-center" onclick="goto_dri('.$row['parent'].')">
      <ion-icon name="folder-open-outline"></ion-icon> '.$row['label'].'
        <span class="badge bg-seconday rounded-pill">></span>
      </li>';
    }else{
      //pring assert 
      echo '<li class="list-group-item d-flex justify-content-between align-items-center">
      <ion-icon name="folder-open-outline"></ion-icon>'.$row['block_name'].'
    </li>';
    }
  }

?>