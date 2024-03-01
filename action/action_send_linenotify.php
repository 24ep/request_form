<?php
 session_start();
 function sent_line_notify($message,$key){
    //echo '<script>alert("'.$key.'");</script>';
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://notify-api.line.me/api/notify',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => 'message='.$message,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/x-www-form-urlencoded',
        'Authorization: Bearer '.$key
    ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    //send MS team API
}
function webpush($users,$text,$id,$callback_url){
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://notix.io/api/send?app=10052dd0063417a1645897f10306381',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "message" :{
        "text": "'.$text.'",
        "title": "Ticket updated",
        "url": "'.$callback_url.'"
    },
    "target":{
        "user":['.$users.']
    }
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization-Token: 2d8b30b2e7d8a1a25d05a7246c1401cd53cdba425af72114',
    'Content-Type: application/json'
  ),
));
$response = curl_exec($curl);
curl_close($curl);
// echo $response;
}
function sendline($id,$value_name,$value_change,$prefix){
        if($prefix=='ANJ' or $prefix=='JC' or $prefix=='NS' or $prefix=='RJ' ){
                $callback_url  = 'https://servicegate.000webhostapp.com/?env=poojaroonwit&page=create_new&prefix=NS&direct='.$id;
                $prefix_post = 'NS';
        }
        if($prefix=='CR'){
            $callback_url  = 'https://servicegate.000webhostapp.com/?env=poojaroonwit&page=update_content&prefix=CR&direct='.$id;
            $prefix_post = 'CR';
    }
    $text_update = "\n".$prefix_post."-".$id." \n".$_SESSION["nickname"]." have been update ".$value_name." = ".$value_change;
    $text_update_web_push =  $prefix_post."-".$id." ".$_SESSION["nickname"]." have been update ".$value_name." = ".$value_change;
    //send to line
    $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
    if($prefix=='ANJ' or $prefix=='NS' or $prefix=='CS' or $prefix=='RJ'){
      mysqli_query($con, "SET NAMES 'utf8' ");
      $query = "SELECT  * FROM all_in_one_project.add_new_job  WHERE id = ".$id or die("Error:" . mysqli_error($con));
      $result =  mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
          $participant = $row["participant"];
      }
    }
    if($prefix=='CR'){
      mysqli_query($con, "SET NAMES 'utf8' ");
      $query = "SELECT  * FROM all_in_one_project.content_request  WHERE id = ".$id or die("Error:" . mysqli_error($con));
      $result =  mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
          $participant = $row["participant"];
      }
    }
       $sent_to = explode(",",$participant);
       foreach ($sent_to as $sent_to_username) {
         if($sent_to_username<>$_SESSION["username"] or $_SESSION["username"] =='poojaroonwit'){
          $query = "SELECT  * FROM all_in_one_project.account where username = '".$sent_to_username."'" or die("Error:" . mysqli_error($con));
          $result =  mysqli_query($con, $query);
              while($row = mysqli_fetch_array($result)) {
                  $key = $row["token_line"];
                  $list_user_push .= ',"'.$row["username"].'"';
              }
              if($key<>"" and $key<>null){
                sent_line_notify($text_update,$key);
                //send_ms_team($prefix."-".$id,$topic,$_SESSION["nickname"]." changed ".$value_name." to ".$value_change);
            }
         }
      }
      $list_users = substr($list_user_push,1);
      webpush($list_users,$text_update_web_push,$id,$callback_url);
}
?>