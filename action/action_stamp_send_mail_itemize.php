<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$id = $_POST["id"];
$ticket_type = "ins_add_new_job";
$dt= new DateTime();
$dt_formate = $dt->format('Y-m-d H:i:s');
$nickname = $_SESSION["username"];
$send_type= $_POST["send_type"];
$subject_mail =$_POST["subject_mail"];
  //add comment
  	$sql = "INSERT INTO comment (
      ticket_id,
      comment,
      ticket_type,
      comment_by
    )
      VALUES(
        ".$id.",
        '[stamp_send_mail] ".$subject_mail."',
        'ins_add_new_job',
        '".$nickname."'
      )";
      $query = mysqli_query($con,$sql);

      $sql_update = "UPDATE add_new_job SET subject_mail = '".$subject_mail."' WHERE id=".$id;
      $query = mysqli_query($con,$sql_update);

      if($query){
          echo '<strong style="color:green">Success !</strong>';
      }else{
        echo 'Error: ' . $sql . '<hr>' . $con->error.'';
      }

      mysqli_close($con);

?>