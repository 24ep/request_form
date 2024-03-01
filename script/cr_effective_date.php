<?php
//0YGrwiJuSNzYEv3cmjCDXhZ6ebxDjZyGhMl2Uo9EUTV กรุปแดง
//HWq46fbTgIlTqSCzaR5s14erVTVHINBdLV0y1yutoA1 ของ bos
//WvreGIJLhmAU7Wen98wX95WgbJGskBz6sspukf3D34A studio
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
//    $tmr_day = date("Y-m-d", time() + 86400);
//    $tmr_day_nt = date("Y-m-d", time() + 86400 + 86400);
//    $tmr_day_display = date("l j F Y h:i:s A");
//    $current_day_display_current = date("l j F");
//    $current_day_display_current = date("l j F");
//    $tmr_day_display_tmr = date("l j F" , time() + 86400 );
//    $tmr_day_display_tmr_nt = date("l j F" , time() + 86400 + 86400);
   $query_cr = "SELECT * FROM all_in_one_project.content_request WHERE effective_date like '%". $current_day  ."%' ORDER BY id DESC" or die("Error:" . mysqli_error($con));
   $query_job = "SELECT * FROM all_in_one_project.add_new_job WHERE actual_launch_date = '". $current_day  ."' ORDER BY id DESC" or die("Error:" . mysqli_error($con));
  // loop old
  $result =  mysqli_query($con, $query_cr);
  $massage_line = "\n😗Content Request ที่มี effective date วันนี้\n";
  while($row = mysqli_fetch_array($result)) {
    $eff_date = substr(substr($row["effective_date"],11),0,5)." น.";
    $massage_line .= $eff_date." > CR-".$row["id"]." > ".$row["status"]."\n";
  }
  $result_new =  mysqli_query($con, $query_job);
  $massage_line_new = "\n😗New job Enable for Today ".$current_day ."\n";
  while($row_new = mysqli_fetch_array($result_new)) {
    // $eff_date = substr(substr($row["effective_date"],11),0,5)." น.";
    $massage_line_new .= $row_new["job_number"]." > ".$row_new["product_website"]."\n";
  }
   mysqli_close($con);
   //  $post_line = $massage_line_old."".$massage_line_current."".$massage_line_tmr."".$massage_line_tmr_nt."\n⠭ แสดงเพียง Job ที่ SKU มากที่สุด 3 อันดับแรก \n⠭ ดูเพิ่มเติมที่นี่ http://bit.ly/3eCAwqr";
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
       'Authorization: Bearer 0YGrwiJuSNzYEv3cmjCDXhZ6ebxDjZyGhMl2Uo9EUTV'
     ),
   ));
   $response = curl_exec($curl);
   curl_close($curl);
   //studio
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
       'Authorization: Bearer WvreGIJLhmAU7Wen98wX95WgbJGskBz6sspukf3D34A'
     ),
   ));
   $response = curl_exec($curl);
   curl_close($curl);
  //  echo $response;
?>