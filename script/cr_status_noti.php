<?php
//0YGrwiJuSNzYEv3cmjCDXhZ6ebxDjZyGhMl2Uo9EUTV กรุปแดง
//HWq46fbTgIlTqSCzaR5s14erVTVHINBdLV0y1yutoA1 ของ bos
//WvreGIJLhmAU7Wen98wX95WgbJGskBz6sspukf3D34A studio
//Ihu1IrOXu1ksLVXRGLCtskznHKeTRl3AHQyd5XhIWKi content request
//5qS2f2Tk1fLs9kA0bufqSRhDNu8vXEN6IneVplz5P6N support
date_default_timezone_set("Asia/Bangkok");
$say_hi = date("h");
$day  = date("l");
$time = date("A");
$day_time = $say_hi.$time;
   // end--------------------------------------------------------------------------------------
   $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
   mysqli_query($con, "SET NAMES 'utf8' ");
   $day_num = date("d");
   $current_day = date("Y-m-d");

   $query_cr = "SELECT status,sum(sku) as sku,count(id) as ticket FROM all_in_one_project.content_request where status not in ('Close','Monitor','Cancel') group by status ORDER BY id DESC" or die("Error:" . mysqli_error($con));
  // loop old
  $result =  mysqli_query($con, $query_cr);
  $massage_line = "\nContent Request Status\n";
  while($row = mysqli_fetch_array($result)) {
    
    $massage_line .= "• ".$row["status"]." ".number_format($row["ticket"])." Ticket / ".number_format($row["sku"])." SKUs"."\n";
  } 
  
   mysqli_close($con);
   // line noti api
   // content 
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
     CURLOPT_POSTFIELDS => 'message='.$massage_line.$massage_line_new  ,
     CURLOPT_HTTPHEADER => array(
       'Content-Type: application/x-www-form-urlencoded',
       'Authorization: Bearer Ihu1IrOXu1ksLVXRGLCtskznHKeTRl3AHQyd5XhIWKi'
     ),
   ));
   $response = curl_exec($curl); 
   curl_close($curl);
   //support
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
     CURLOPT_POSTFIELDS => 'message='.$massage_line.$massage_line_new  ,
     CURLOPT_HTTPHEADER => array(
       'Content-Type: application/x-www-form-urlencoded',
       'Authorization: Bearer 5qS2f2Tk1fLs9kA0bufqSRhDNu8vXEN6IneVplz5P6N'
     ),
   ));
   $response = curl_exec($curl);
   curl_close($curl);
  //  echo $response;
?>
