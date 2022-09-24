

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
function sendline($id,$value_name,$value_change,$prefix){
      //send to line
        $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $query = "SELECT  * FROM add_new_job  WHERE id = ".$id or die("Error:" . mysqli_error($con));
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
                sent_line_notify("\n".$prefix."-".$id." ".$topic."  \n".$_SESSION["nickname"]." have been update ".$value_name." to ".$value_change,$key);
                //send_ms_team($prefix."-".$id,$topic,$_SESSION["nickname"]." changed ".$value_name." to ".$value_change);  
            }
         }
      }
}

?>