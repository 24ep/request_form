<?php
 session_start();
function sent_line_noti($message,$key){
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

function send_ms_team($id,$topic,$value){

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://prod-25.southeastasia.logic.azure.com:443/workflows/6683912c94e248a0bf848420c48f5268/triggers/menual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmenual%2Frun&sv=1.0&sig=-Us9nlVGaxLV00rS-KIM50SRwmgLbfunjrLMT0t-9FA',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "message_value":"'.$value.'",
    "topic":"'.$topic.'",
    "id":"'.$id.'"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// echo $response;

}
?>