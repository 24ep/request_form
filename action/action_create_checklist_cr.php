<?php
session_start();
  $ticket_id = $_POST["id"];
  $sku = $_POST["sku"];
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
	$sql = "INSERT INTO checklist_of_content_request (ticket_id,sku
    )
	VALUES (
    ".$ticket_id.",
    ".$sku."
    )";
	$query = mysqli_query($con,$sql);
    mysqli_close($con);

?>
