<?php

    session_start();

    include($_SERVER['DOCUMENT_ROOT']."/connect.php");

    include($_SERVER['DOCUMENT_ROOT'].'/action/action_insert_log.php');

    include($_SERVER['DOCUMENT_ROOT'].'/action/action_send_line_api.php');

    include($_SERVER['DOCUMENT_ROOT'].'/action/action_add_participant.php');

    date_default_timezone_set("Asia/Bangkok");

    $id = $_POST["id"];

    $op_follow_assign_name = $_POST["op_follow_assign_name"];

    $sql = "UPDATE add_new_job SET follow_assign_date = CURRENT_TIMESTAMP , follow_assign_name = '".$op_follow_assign_name."' WHERE id=".$id;

        // $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");

    $query = mysqli_query($con,$sql);

	if($query) {

      //send to line

      date_default_timezone_set("Asia/Bangkok");

      $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));

      mysqli_query($con, "SET NAMES 'utf8' ");

      $query = "SELECT  * FROM add_new_job  WHERE id = ".$id

      or die("Error:" . mysqli_error($con));

      $result =  mysqli_query($con, $query);

          while($row = mysqli_fetch_array($result)) {

              $participant = $row["participant"];

              $brand = $row["brand"];

              $sku = $row["sku"];

              $request_username = $row["request_username"];

              $parent = $row["parent"];



          }

          $sent_to = explode(",",$participant);

          foreach ($sent_https://phpstack-1225538-4364543.cloudwaysapps.com

          if($sent_to_username<>$_SESSION["username"] and $sent_to_username<>$request_username){

          $query = "SELECT  * FROM account where username = '".$sent_to_username."'" or die("Error:" . mysqli_error($con));

          $result =  mysqli_query($con, $query);

              while($row = mysqli_fetch_array($result)) {

                  $key = $row["token_line"];

              }

              if($key<>"" and $key<>null){

                  sent_line_noti("\nNS-".$id." [".$brand." ".$sku." SKUs]  \n--------------------------\n".$_SESSION["nickname"]." has assign this task to ".$op_follow_assign_name,$key);

                  send_ms_team("NS-".$id,$brand." ".$sku." SKUs",$_SESSION["nickname"]." has assign this task to ".$op_follow_assign_name);

                }

          }

      }

      echo '<script>Notiflix.Notify.success("NS-'.$id.' have been assign to "'.$op_follow_assign_name.');</script>';

       add_participant($_POST['id'],"add_new_job");

       add_participant($parent,"add_new_job");

        insert_log("assign follow = ".date("Y-m-d H:i:s")." has assign this task to ".$op_follow_assign_name ,"add_new_job",$_POST['id']);

        // echo date("Y-m-d H:i:s");

	}else{

        insert_log("assign follow >".$con->error ,"add_new_job",$id);

        echo "<script>

        Notiflix.Report.failure(

            'Failure',

            'Error: " . htmlspecialchars($sql ,ENT_QUOTES, 'UTF-8') . "<br/><br/>" .htmlspecialchars( $con->error,ENT_QUOTES, 'UTF-8').",

            'Okay',

            )</script>;

        ";

    }

    mysqli_close($con);

    //header( "location: https://cdse-commercecontent.com/homepage.php");

    ?>

