<?php

  session_start();
  $dri_id = $_POST["dri_id"];
  if($dri_id==""){
    $dri_id = 1;
  }
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  //pring folder
  $query = "SELECT dri.id, dri.code, dri.label, dri.parent ,dri.path_id
  FROM all_in_one_project.assets_directories as dri
  where  dri.id =   ".$dri_id."
  " or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);

  while($row = mysqli_fetch_array($result)) {
    $path_id = $row['path_id'];
    echo $path_id ;
  }
  $path_id_arr = explode("/",$path_id);
  
  foreach($path_id_arr as $dri_id_in_path ){
    $query = "SELECT dri.id, dri.code, dri.label, dri.parent
    FROM all_in_one_project.assets_directories as dri
    where  dri.id =   ".$dri_id_in_path."
    " or die("Error:" . mysqli_error($con));
    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_array($result)) {
        echo '<li class="breadcrumb-item"><a onclick="goto_dri('.$row['id'].')">'.$row['label'].'</a></li>';
    
        
    }
    
  }


?>