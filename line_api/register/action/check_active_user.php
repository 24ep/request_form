<?php

$pictureUrl = $_POST["pictureUrl"];
$userId = $_POST["userId"];
$displayName = $_POST["displayName"];
$con= mysqli_connect("localhost",cdse_admin,@aA417528639,"all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
date_default_timezone_set("Asia/Bangkok");
    $sql_gb = "SELECT * from  account WHERE line_user_id ='".$userId."'";
    $query_gb  = mysqli_query($con,$sql_gb);
    $id = "";
    while($row = mysqli_fetch_array($query_gb)) {
        $id = $row["id"];
    }
   
    if($id==""){
         echo "inactive";
    }else{
        echo "active";
    }
   
   

?>