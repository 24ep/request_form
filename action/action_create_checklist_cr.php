<?php
session_start();
  $ticket_id = $_POST["id"];
  $sku = $_POST["sku"];
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost",$_SESSION["db_username"],$_SESSION["db_password"],"all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
	$sql = "INSERT INTO checklist_of_content_request (ticket_id,sku
    )
	VALUES (
    ".$ticket_id.",
    ".$sku."
    )";
	$query = mysqli_query($con,$sql);
    mysqli_close($con);
    include('http://content-service-gate.cdse-commercecontent.com/base/get/get_checklist_cr.php?id='.$ticket_id);
?>
