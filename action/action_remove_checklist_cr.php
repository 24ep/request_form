<?php
session_start();
  $ticket_id = $_POST["ticket_id"];
  $list_id = $_POST["list_id"];
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
	$sql = "DELETE FROM checklist_of_content_request WHERE id = ".$list_id ;
	$query = mysqli_query($con,$sql);
  if($query){
    echo '<script>Notiflix.Notify.success("Ticket ID'.$ticket_id .' have been remove checklist ('.$list_id.')");</script>';
  }else{
    echo "<script>
    Notiflix.Report.failure(
        'Failure',
        'Error: " . $query  . "<br/><br/>" . $con->error.",
        'Okay',
        )</script>;
    ";
  }
  mysqli_close($con);
  include('http://content-service-gate.cdse-commercecontent.com/base/get/get_checklist_cr.php?id='.$ticket_id);
?>
