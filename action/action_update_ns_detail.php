<?php
 $id = $_POST['id'];
 $value_change = $_POST['value_change'];
 $value_name = $_POST['id_name'];
 $value_name =  str_replace("ns_edit_","",$value_name);
 include('action_add_participant.php');
 session_start();
    include("connect.php");
    include('action_insert_log.php');
    include('action_send_line_api.php');
    date_default_timezone_set("Asia/Bangkok");
    $sql = "UPDATE add_new_job SET ".$value_name." = '".str_replace("'","''",$value_change)."'  WHERE id=".$id;
    $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
	if($query) {
        if($value_name=="sub_department"){
            $con_job_cms= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con_job_cms));
            mysqli_query($con_job_cms, "SET NAMES 'utf8' ");
            $sql_job_cms = "UPDATE all_in_one_project.add_new_job SET ".$value_name." = '".str_replace("'","''",$value_change)."'  WHERE id=".$id;
            $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
            $query = mysqli_query($con_job_cms,$sql_job_cms);
        }
         //send to line
   date_default_timezone_set("Asia/Bangkok");
   $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
   mysqli_query($con, "SET NAMES 'utf8' ");
   $query = "SELECT  * FROM add_new_job  WHERE id = ".$id
   or die("Error:" . mysqli_error($con));
   $result =  mysqli_query($con, $query);
       while($row = mysqli_fetch_array($result)) {
           $participant = $row["participant"];
           $topic = $row["title"];
       }
       $sent_to = explode(",",$participant);
       foreach ($sent_to as $sent_to_username) {
         if($sent_to_username<>$_SESSION["username"]){
          $query = "SELECT  * FROM account where username = '".$sent_to_username."'" or die("Error:" . mysqli_error($con));
          $result =  mysqli_query($con, $query);
              while($row = mysqli_fetch_array($result)) {
                  $key = $row["token_line"];
              }
              if($key<>"" and $key<>null){
                sent_line_noti("\nNS-".$id." ".$topic."  \n----------------------------\n".$_SESSION["nickname"]." changed ".$value_name." to ".$value_change,$key);
                send_ms_team("NS-".$id,$topic,$_SESSION["nickname"]." changed ".$value_name." to ".$value_change);
            }
         }
      }
        echo '<script>Notiflix.Notify.success("NS-'.$id.' have been updated");</script>';
        add_participant($_POST['id'],"add_new_job");
        if($value_name=="follow_assign_name"){
            add_participant_with_user($_POST['id'],"add_new_job",$value_change);
        }
        insert_log("update ticket \n ".$value_name." = ".$value_change ,"add_new_job",$_POST['id']);
	}else{
        insert_log("Update ticket fails".$con->error ,"content_request",$id);
        echo "<script>
        Notiflix.Report.failure(
            'Failure',
            'Error: " . $sql . "<br/><br/>" . $con->error.",
            'Okay',
            )</script>;
        ";
    }
    mysqli_close($con);
?>
