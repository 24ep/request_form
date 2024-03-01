<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$id = $_POST["id"];
$ticket_type = "ins_add_new_job";
$dt= new DateTime();
$dt_formate = $dt->format('Y-m-d H:i:s');
$nickname = $_SESSION["username"];
$send_type= $_POST["send_type"];
$subject_mail =$_POST["subject_mail"];
include('action_insert_log.php');
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

      $sql_update = "UPDATE add_new_job SET subject_mail = '".$subject_mail."',status ='send mail - waiting brand confirm data' WHERE id=".$id;
      $query = mysqli_query($con,$sql_update);

      if($query){
        echo '<script>Notiflix.Notify.success("NS-'.$id.' have been stamp send mail");</script>';
      }else{
        echo "<script>
        Notiflix.Report.failure(
            'Failure',
            'Error: " . $sql . "<br/><br/>" . $con->error.",
            'Okay',
            )</script>;
        ";
      }
      insert_log("Stamp send email itemmize\n","add_new_job",$id);
      mysqli_close($con);

      

?>