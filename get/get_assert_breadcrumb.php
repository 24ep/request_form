<?php

  session_start();
  $dri_id = $_POST["dri_id"];
  if($dri_id==""){
    $dri_id = 1;
  }
  $block_id = $_POST["block_id"];
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  //pring folder
  $query = "SELECT dri.id, dri.code, dri.label, dri.parent , concat(path_id,'/',id) as path_id
  FROM all_in_one_project.assets_directories as dri
  where  dri.id =   ".$dri_id."
  " or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);

  while($row = mysqli_fetch_array($result)) {
    $path_id = $row['path_id'];
    $id = $row['id'];
    echo '<input type="hidden" id="under_path" name="under_path" value="'.$path_id.'">';
    echo '<input type="hidden" id="parent" name="parent" value="'.$id.'">';
  }
  $path_id_arr = explode("/",$path_id);
  foreach($path_id_arr as $dri_id_in_path ){
    $query = "SELECT dri.id, dri.code, dri.label, dri.parent
    FROM all_in_one_project.assets_directories as dri
    where  dri.id =   ".$dri_id_in_path."
    " or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_array($result)) {
        echo '<li  class="breadcrumb-item"><a type="button" onclick="goto_dri('.$row['id'].');change_breadcrumb('.$row['id'].',0)">'.$row['label'].'</a></li>';
    }
  }

  if($block_id<>""){
    $query = "SELECT id, brand, body, version, create_date, update_date, update_by, dri_id
    FROM all_in_one_project.brand_editor
    where  id =   ".$block_id."
    " or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $query);
    
    while($row = mysqli_fetch_array($result)) {
      echo '<li  class="breadcrumb-item active" aria-current="page">'.$row['brand'].'</a></li>';
    }
  }

?>