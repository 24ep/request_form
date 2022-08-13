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
      
      echo '<li type="button"  class="list-group-item d-flex  align-items-center " >
      <div onclick="goto_dri('.$row['id'].');change_breadcrumb('.$row['id'].',0)"><ion-icon name="folder-open"></ion-icon> '.$row['label'].'</div>
      <div class="dropdown dropstart" style="right: 0px;position: absolute;color: gray;">
        <a class="" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          <ion-icon name="ellipsis-vertical-outline"></ion-icon>
        </a>

        <ul class="dropdown-menu"  style="font-size: 14px;" aria-labelledby="dropdownMenuLink">
          <li><a type="button" class="dropdown-item"  onclick="remove_assert(&#34;folder&#34;,'.$row['id'].')"> <ion-icon name="trash-outline"></ion-icon> Remove</a></li>
        </ul>
      </div>
      </li>';
    
  }

  //get_assert
  $query = "SELECT id, brand as assert_name, body, version, create_date, update_date, update_by, dri_id
  FROM all_in_one_project.brand_editor
  where dri_id =   ".$dri_parent."
  " or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);

  while($row = mysqli_fetch_array($result)) {
      //pring folder
      echo '<li type="button" class="list-group-item d-flex align-items-center" >
      <div onclick="change_breadcrumb('.$row['dri_id'].','.$row['id'].');get_block('.$row['id'].')"><ion-icon name="document-outline"></ion-icon> '.$row['assert_name'].'</div>
      <div class="dropdown dropstart" style="right: 0px;position: absolute;color: gray;">
        <a class="" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          <ion-icon name="ellipsis-vertical-outline"></ion-icon>
        </a>

        <ul class="dropdown-menu" style="font-size: 14px;" aria-labelledby="dropdownMenuLink">
          <li><a class="dropdown-item" href="#"> <ion-icon name="trash-outline"></ion-icon> Remove</a></li>
        </ul>
      </div>
      </li>';
    
  }

?>