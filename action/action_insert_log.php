<?php
session_start();
function insert_log($action,$action_table,$action_data_id){

  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");

	$sql = "INSERT INTO log (
	action,
    action_date,
    action_by,
    action_table,
    action_data_id
    )
	VALUES (
    '".$action."',
    CURRENT_TIMESTAMP,
    '".$_SESSION['username']."',
    '".$action_table."',
    '".$action_data_id."'
    

    )";
	$query = mysqli_query($con,$sql);
	
    mysqli_close($con);
    
}

?>
