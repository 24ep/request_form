<?php
  function is_image($path)
  {
      $a = getimagesize($path);
      $image_type = $a[2];
      if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
      {
          return true;
      }
      return false;
  }
session_start();
include('action_send_line_api.php');
include('action_add_participant.php');
include('action_insert_log.php');
// include("connect.php");
$id = $_GET["id"];
$ticket_type = "add_new_job";
$dt= new DateTime();
$dt_formate = $dt->format('Y-m-d H:i:s');
$nickname = $_SESSION["username"];
//check size file
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
  //add comment
          $fullpath = '../../attachment/csg/attachments/ns/'.$id."/";
          if (!file_exists($fullpath)) {
            mkdir($fullpath, 0777, true);
          }
          // upload image
          foreach($_FILES['files']['tmp_name'] as $key => $val){
            $file_name = $_FILES['files']['name'][$key];
            $file_size = $_FILES['files']['size'][$key];
            $file_tmp  = $_FILES['files']['tmp_name'][$key];
            $file_type = $_FILES['files']['type'][$key];
            $is_image  = is_image($file_tmp);

            if(strpos($file_name,'xlsm')!==false and strpos(strtolower($file_name),'_cleaned')!==true){
              $file_group = 'Original' ;
            }elseif(strpos($file_name,'xlsm')!==false and strpos(strtolower($file_name),'_cleaned')===true){
              $file_group = 'Cleaned' ;
            }elseif(strpos(strtolower($file_name),'modal')!==false){
              $file_group = 'Model' ;
            }elseif(strpos(strtolower($file_name),'template')!==false){
              $file_group = 'Template' ;
            }else{
              $file_group = 'Other' ;
            }

            if(isset($_FILES["files"])){
                if ($file_name <> ""  ) { 
                $sql = "INSERT INTO attachment (
                    file_name,
                    file_path,
                    file_size,
                    file_type,
                    is_image,
                    file_owner,
                    ticket_id,
                    ticket_type,
                    file_group
                    )
                    VALUES(
                    '".$file_name."',
                    '".$fullpath."',
                    '".$file_size."',
                    '".$file_type."',
                    '".$is_image."',
                    '".$_SESSION["username"]."',
                    '".$id."',
                    'ticket_files',
                    '".$file_group."'
                    )";
                $query = mysqli_query($con,$sql);
                move_uploaded_file($file_tmp,$fullpath.$file_name);
                    }
                }
            }
      add_participant($id,"add_new_job");
  mysqli_close($con);
?>