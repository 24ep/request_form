<?php

// $con = mysqli_connect('localhost', 'root', '', 'test_temp');
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
$con->set_charset('utf8mb4');

if(mysqli_connect_errno()){
    echo "MySql Connection Error<br>";
    die;
}