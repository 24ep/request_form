<?php

session_start();
$con= mysqli_connect("localhost","cdse_admin",$_SESSION["db_password"],"all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");



 ?>