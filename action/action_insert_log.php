<?php
session_start();

function insert_log($action,$action_table,$action_data_id){
  //get participat from data id
  date_default_timezone_set("Asia/Bangkok");
   $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
   mysqli_query($con, "SET NAMES 'utf8' ");
   $query = "SELECT 
   job.participant as participant
   FROM all_in_one_project.".$action_table." as job
   where job.id = ".$action_data_id."
   ";
   $result = mysqli_query($con, $query);
   while($row = mysqli_fetch_array($result)) {
    $participant = $row['participant'];
    }
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
	$sql = "INSERT INTO log (
	action,
    action_date,
    action_by,
    action_table,
    action_data_id,
    nt_readable
    )
	VALUES (
    '".$action."',
    CURRENT_TIMESTAMP,
    '".$_SESSION['username']."',
    '".$action_table."',
    '".$action_data_id."',
    '".$participant."',
    )";
	$query = mysqli_query($con,$sql);
    mysqli_close($con);
}
?>
