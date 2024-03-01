<?php
session_start();

function insert_log($action,$action_table,$action_data_id){

  //get participat from data id
  if($action_data_id<>0 and ($action_table=="add_new_job" or $action_table=="content_request")){
    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $query = "SELECT
    job.participant as participant
    FROM all_in_one_project.".$action_table." as job
    where job.id = ".$action_data_id."";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
     $participant = $row['participant'];
     }
  }else{$participant="";}


  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
	$sql = "INSERT INTO all_in_one_project.log (
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
    '".$participant."'
    )";
	$query = mysqli_query($con,$sql);
    // mysqli_close($con);
}
?>
