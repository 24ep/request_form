<?php
include("action_send_linenotify.php");
function bb_confirm_ticket($id ,$user_id,$detail,$status){
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.line.me/v2/bot/message/push',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'
       { "to": "'.$user_id.'",
        "messages":[
                        {
                        "type": "flex",
                        "altText": "Confirm ticket !",
                        "sender": {
                            "name": "CSG-BOT",
                            "iconUrl": "https://cdse-commercecontent.com/img/csg_ico.png"
                        },
                         "contents": {
                            "type": "bubble",
                            "direction": "ltr",
                            "body": {
                              "type": "box",
                              "layout": "vertical",
                              "contents": [
                                {
                                  "type": "text",
                                  "text": "CR-'.$id.'",
                                  "weight": "bold",
                                  "size": "xl",
                                  "color": "#C53600FF",
                                  "margin": "sm",
                                  "contents": []
                                },
                                {
                                  "type": "text",
                                  "text": "'.$detail.'",
                                  "color": "#949494FF",
                                  "contents": []
                                },
                                {
                                  "type": "separator",
                                  "margin": "md"
                                },
                                {
                                  "type": "box",
                                  "layout": "horizontal",
                                  "spacing": "lg",
                                  "margin": "lg",
                                  "contents": [
                                    {
                                      "type": "text",
                                      "text": "อัพเดตสถานะ",
                                      "contents": []
                                    },
                                    {
                                      "type": "text",
                                      "text": "'.$status.'",
                                      "color": "#4BCA44FF",
                                      "contents": []
                                    }
                                  ]
                                }
                              ]
                            }
                          }
                        }
                ]
        }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer J/R5foEYEGdmDL85DJBMdlMfOos7JOKVlqzd4VOE3nXpT8OtSoc6On+3wNH4bZ6GU+4riP4v562ixfwVUwWdDmHae3qbVBxKUMrKcgoBFbGkrpX+QttoamNeNodqY5aXN3hXijql94zqPLAW7d+JgQdB04t89/1O/w1cDnyilFU='
      ),
    ));
}
 $id = $_POST['id'];
 $value_change = $_POST['value_change'];
 $value_name = $_POST['id_name'];
 $value_name =  str_replace("cr_edit_","",$value_name);
 include('action_add_participant.php');
session_start();
    include("connect.php");
    include('action_insert_log.php');
    include('action_send_line_api.php');
    date_default_timezone_set("Asia/Bangkok");
    if( $value_name=="status"){
        if( $value_change =="Pending"){
            $timestamp = ",inprogress_date = null,complete_date  = null";
        }elseif($value_change =="Inprogress"){
            $timestamp = ",inprogress_date = CURRENT_TIMESTAMP,complete_date = null";
        }elseif($value_change =="Close"){
            $timestamp = ",complete_date = CURRENT_TIMESTAMP";
        }else{
            $timestamp = "";
        }
    }
    $sql = "UPDATE content_request SET ".$value_name." = '".$value_change."' ".$timestamp."  WHERE id=".$id;
        // $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
	if($query) {
   //send to line
   if( $value_name<>"content_request_reson" and $value_name<>"note" ){
   date_default_timezone_set("Asia/Bangkok");
   $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
   mysqli_query($con, "SET NAMES 'utf8' ");
   $query = "SELECT  * FROM content_request  WHERE id = ".$id
   or die("Error:" . mysqli_error($con));
   $result =  mysqli_query($con, $query);
       while($row = mysqli_fetch_array($result)) {
           $participant = $row["participant"];
           $topic = $row["title"];
           $ticket_template = $row["ticket_template"];
       }
       $sent_to = explode(",",$participant);
       foreach ($sent_to as $sent_to_username) {
         if($sent_to_username<>$_SESSION["username"]){
          $query = "SELECT  * FROM account where username = '".$sent_to_username."'" or die("Error:" . mysqli_error($con));
          $result =  mysqli_query($con, $query);
              while($row = mysqli_fetch_array($result)) {
                  $key = $row["token_line"];
                  $line_user_id = $row["line_user_id"];
                  $request_by = $row["request_by"];
                  $description = $row["description"];
              }
              if($key<>"" and $key<>null){
                sent_line_noti("\nCR-".$id." ".$topic."  \n----------------------------\n".$_SESSION["nickname"]." changed ".$value_name." to ".$value_change,$key);
                send_ms_team("CR-".$id,$topic,$_SESSION["nickname"]." changed ".$value_name." to ".$value_change);
              }
              if($line_user_id <>"" and $line_user_id <>null and $sent_to_username == $request_by and $value_name == "status" ){
                $pre_detail_request =  substr($description,0,80);
                bb_confirm_ticket($id ,$line_user_id,$pre_detail_request,$value_change);
              }
         }
      }
    }
        add_participant($_POST['id'],"content_request");
        insert_log("update ticket \n ".$value_name." = ".$value_change ,"content_request",$_POST['id']);
        echo '<script>Notiflix.Notify.success("Ticket CR-'.$_POST['id'] .' have been update status to '.$value_change.'");</script>';
        if($value_name=='status'){
          sendline($_POST['id'],"update ".$value_name." = ",$value_change ,'CR');
        }

        // echo '<script>
        //  document.getElementById("toast_ms").innerHTML =  "Updated Ticket ID '.htmlspecialchars($ticket_template,  ENT_QUOTES, 'UTF-8').'-'.htmlspecialchars($_POST['id'],  ENT_QUOTES, 'UTF-8').'";
        //  var toastLiveExample = document.getElementById("liveToast_cr");
        //  var toast = new bootstrap.Toast(toastLiveExample);
        //  toast.show();</script>';
        //   if($value_name=='status' and $value_change<>'Close' and $value_change<>'Cancel'){
        //     echo '<script>
        //      var child_c = document.getElementById("crid_'.$_POST["id"].'");
        //      var parent_c = document.getElementById("ul_'.$value_change.'");
        //      parent_c.appendChild(child_c);
        //     </script>';
        //   }elseif($value_name=='status' and ( $value_change=='Close' or $value_change=='Cancel') ){
        //     echo '<script>
        //     var child_c = document.getElementById("crid_'.htmlspecialchars($_POST["id"],  ENT_QUOTES, 'UTF-8').'");
        //     child_c.parentNode.removeChild(child_c);
        //    </script>';
        //   }
	}else{
        insert_log("update ticket faild".$con->error ,"content_request",$id);
        echo "<script>
        Notiflix.Report.failure(
            'Failure',
            'Error: " . htmlspecialchars($sql,  ENT_QUOTES, 'UTF-8') . "<br/><br/>" . htmlspecialchars($con->error,  ENT_QUOTES, 'UTF-8').",
            'Okay',
            )</script>;
        ";
    }
    mysqli_close($con);
?>