<?php
 session_start();
function send_update_mail($ticket_id,$brand,$total_sku,$content_contact_person,$message_id,$description,$status){

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://prod-31.southeastasia.logic.azure.com:443/workflows/e0234bbc9e854bceaa6635f9914cfc46/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=ApiI1kxNlm9w8sOudVZ9Jy_opCJjbqXWiL0bC5sYWqs',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'
{
  "id": '.$ticket_id.',
  "brand": "'.$brand.'",
  "content_contact_person": "'.$content_contact_person.'",
  "total_sku": '.$total_sku.',
  "link_to_more":"",
  "message_id":"'.$message_id.'",
  "status":"'.$status.'",
  "description":"'.$description.'"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// echo $response;

}
