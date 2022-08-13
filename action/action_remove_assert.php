<?php
session_start();
  $remove_id = $_POST["remove_id"];
  $assert_type = $_POST["assert_type"];
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");

  if($assert_type=='folder'){
	$sql = "DELETE FROM assets_directories WHERE (id = ".$remove_id." or code like '%/".$remove_id."_%' or code like '%/".$remove_id."/%' )" ;
	$query = mysqli_query($con,$sql);
  if($query){
    // echo '<script>Notiflix.Notify.success("assert have been delete");</script>';
  }else{
    // echo "<script>
    // Notiflix.Report.failure(
    //     'Failure',
    //     'Error: " . $query  . "<br/><br/>" . $con->error.",
    //     'Okay',
    //     )</script>;
    // ";
  }
  }

  mysqli_close($con);
?>