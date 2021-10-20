<?php

$pictureUrl = $_POST["pictureUrl"];
$userId = $_POST["userId"];
$displayName = $_POST["displayName"];

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