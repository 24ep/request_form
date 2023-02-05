<?php

session_start();
$dt= new DateTime();
$dt_formate = $dt->format('Y-m-d H:i:s');
$nickname = $_SESSION["username"];
$major_version = $_POST['major_version'];
$mminor_version = $_POST['minor_version'];
$change_log = $_POST['change_log'];
//check size file
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
          //add comment
          $fullpath = '../../attachment/csg/linesheet_app';
          if (!file_exists($fullpath)) {
            mkdir($fullpath, 0777, true);
          }
          // upload image
          foreach($_FILES['files']['tmp_name'] as $key => $val){
            $file_name = $_FILES['files']['name'][$key];
            $file_size = $_FILES['files']['size'][$key];
            $file_tmp  = $_FILES['files']['tmp_name'][$key];
            $file_type = $_FILES['files']['type'][$key];

            if(isset($_FILES["files"])){
                if ($file_name <> ""  ) {
                $sql = "INSERT INTO app_version_control (
                    app_name,
                    version,
                    path,
                    log_description,
                    app_url
                    )
                    VALUES(
                    '".$file_name."',
                    '".$fullpath."',
                    '".$version."',
                    '".$change_log."',
                    '".$fullpath."'
                    )";
                $query = mysqli_query($con,$sql);
                move_uploaded_file($file_tmp,$fullpath.$file_name);
                    }
                }
            }
  mysqli_close($con);
?>