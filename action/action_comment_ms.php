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
$id = $_POST["id"];
$ticket_type = "message_box";
$comment = str_replace("'","''",$_POST["comment"]);
$dt= new DateTime();
$dt_formate = $dt->format('Y-m-d H:i:s');
$nickname = $_SESSION["username"];
$send_type= $_POST["send_type"];
//check size file
    //action upload file
    if(isset($_FILES['files'])){
      foreach($_FILES['files']['tmp_name'] as $key => $val){
          $file_name = $_FILES['files']['name'][$key];
          $file_size =$_FILES['files']['size'][$key];
          $file_tmp =$_FILES['files']['tmp_name'][$key];
          $file_type=$_FILES['files']['type'][$key];
          $is_image = is_image($file_tmp);
          if (($file_size > 2097152 or $file_size ==0) and $file_name <> ""  ) { 
              $result = '<div class="alert alert-danger">ขนาดไฟล์ต้องไม่เกิน 2MB โปรดทำใฟล์เล็กลง หรือแชร์เป็น link เพื่อเข้าถึงไฟล์</div>';
              echo '<script>alert("ขนาดไฟล์ต้องไม่เกิน 2MB โปรดทำใฟล์เล็กลง หรือแชร์เป็น link เพื่อเข้าถึงไฟล์")</script>';
              exit();
      }
  }
}
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
if($comment<>'' or $file_size <>0){
  //add comment
  	$sql = "INSERT INTO comment (
    ticket_id,
      comment,
      ticket_type,
      comment_by
    )
      VALUES(
        ".$id.",
        '".$comment."',
        '".$ticket_type."',
        '".$nickname."'
      )";
      $query = mysqli_query($con,$sql);
          //create forder
          $last_id = $con->insert_id;
          $fullpath = '../../attachment/csg/comment/ms/'.$last_id."/";
          if (!file_exists($fullpath)) {
            mkdir($fullpath, 0777, true);
          }
          // upload image
          foreach($_FILES['files']['tmp_name'] as $key => $val){
            $file_name = $_FILES['files']['name'][$key];
            $file_size =$_FILES['files']['size'][$key];
            $file_tmp =$_FILES['files']['tmp_name'][$key];
            $file_type=$_FILES['files']['type'][$key];
            $is_image = is_image($file_tmp);
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
                    ticket_type
                    )
                    VALUES(
                    '".$file_name."',
                    '".$fullpath."',
                    '".$file_size."',
                    '".$file_type."',
                    '".$is_image."',
                    '".$_SESSION["username"]."',
                    '".$last_id."',
                    '".$ticket_type."'
                    )";
                $query = mysqli_query($con,$sql);
                move_uploaded_file($file_tmp,$fullpath.$file_name);
                    }
                }
            }
      add_participant($id,"add_new_job");
      insert_log("New message box comment \n".$comment,"comment",$id);
}
  include('../get/get_comment_ms.php');
  mysqli_close($con);
   //send to line
   date_default_timezone_set("Asia/Bangkok");
   $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
   mysqli_query($con, "SET NAMES 'utf8' ");
   $query = "SELECT  * FROM message_box  WHERE id = ".$id
   or die("Error:" . mysqli_error($con));
   $result =  mysqli_query($con, $query);
       while($row = mysqli_fetch_array($result)) {
           $create_by = $row["create_by"];
       }
       $query = "SELECT  * FROM account where username = '".$create_by."'" or die("Error:" . mysqli_error($con));
       $result =  mysqli_query($con, $query);
           while($row = mysqli_fetch_array($result)) {
               $key = $row["token_line"];
           }
           if($key<>"" and $key<>null){
             sent_line_noti("\nMS-".$id." [ ".$brand." ".$sku." SKUs ]\n----------------------------\n".$_SESSION["nickname"]." has comment (message_box) : \n".$comment,$key);
             send_ms_team("MS-".$id,$brand." ".$sku." SKUs",$_SESSION["nickname"]." has (message_box) : <br>".$comment);
            }
?>
