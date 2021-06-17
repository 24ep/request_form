<?php
$to = "poojaroonwit@central.co.th,poojaroonwit@central.co.th";
$subject = "HTML email";
$message = '
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Central Service Gate</title>
  </head>
  <body>
    <div class="d-grid col-8 mx-auto">
        <div class="col-9">
            <div style="width:500px; padding:20px 20px 20px 20px; margin:20px 20px 20px 20px;"><h3>Central Service Gate</h3></div>
            <div class="p-5 border bg-light" style="margin:20px;">Dear __________
            <p>
                ทางทีม Content Online ได้รับคำขอ ________ ของคุณแล้ว
                <p>โดยรายละเอียดมีดังนี้
                <br>แบรนด์ ________
                <br>จำนวน ______ sku
                <p>Status from _________ to _________</p>
                <p>อีเมลฉบับนี้เป็นการแจ้งข้อมูลอัตโนมัติ ไม่สามารถตอบกลับได้ หากท่านมีข้อสงสัยประการใด กรุณาติดต่อ Team Content Online</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a type="button" class="btn btn-info btn-sm" href="https://www.youtube.com/watch?v=kjf1jFIceKg">Contact</a>
              </div>
                </p>
            </div>
        </div>
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>
';
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
// More headers
$headers .= 'From: automation@content-service-gate.cdsecommercecontent.ga' . "\r\n";
$headers .= 'Cc: poojaroonwit@central.co.th' . "\r\n";
mail($to,$subject,$message,$headers);
?>