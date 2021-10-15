<?php
session_start();
  $ticket_id = $_POST["ticket_id"];
  $list_id = $_POST["list_id"];
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
	$sql = "DELETE FROM checklist_of_content_request WHERE id = ".$ticket_id ;
	$query = mysqli_query($con,$sql);
    mysqli_close($con);
    include('http://content-service-gate.cdsecommercecontent.ga/get/get_checklist_cr.php?id='.$ticket_id);
?>
