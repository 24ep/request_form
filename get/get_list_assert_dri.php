<?php

  session_start();
  $dri_parent = $_POST["dri_parent"];
  if($dri_parent==""){
    $dri_parent = 1;
  }
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  //pring folder
  $query = "SELECT dri.id, dri.code, dri.label, dri.parent
  FROM all_in_one_project.assets_directories as dri
  where  dri.parent =   ".$dri_parent."
  " or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);

  while($row = mysqli_fetch_array($result)) {
      
      echo '<a type="button"  class="list-group-item d-flex justify-content-between align-items-center " onclick="goto_dri('.$row['id'].');change_breadcrumb('.$row['id'].',0)">
      <ion-icon name="folder-open"></ion-icon> '.$row['label'].'
      <div class="dropdown">
      <a class="btn btn-light btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
        <ion-icon name="ellipsis-vertical-outline"></ion-icon>
      </a>

      <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <li><a class="dropdown-item" href="#">Remove</a></li>
      </ul>
    </div>
      </a>';
    
  }

  //get_assert
  $query = "SELECT id, brand as assert_name, body, version, create_date, update_date, update_by, dri_id
  FROM all_in_one_project.brand_editor
  where dri_id =   ".$dri_parent."
  " or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);

  while($row = mysqli_fetch_array($result)) {
      //pring folder
      echo '<a type="button" class="list-group-item d-flex justify-content-between align-items-center" onclick="change_breadcrumb('.$row['dri_id'].','.$row['id'].');get_block('.$row['id'].')">
      <ion-icon name="document-outline"></ion-icon> '.$row['assert_name'].'
      <div class="dropdown">
        <a class="btn btn-light dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          <ion-icon name="ellipsis-vertical-outline"></ion-icon>
        </a>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <li><a class="dropdown-item" href="#">Remove</a></li>
        </ul>
      </div>
      </a>';
    
  }

?>