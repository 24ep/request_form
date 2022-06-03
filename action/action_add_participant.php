<?php
 session_start();
function add_participant($id,$table){
        date_default_timezone_set("Asia/Bangkok");
        $con= mysqli_connect("localhost",cdse_admin,@aA417528639,"all_in_one_project") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $query = "SELECT  * FROM ".$table."  WHERE id = ".$id
        or die("Error:" . mysqli_error($con));
        $result =  mysqli_query($con, $query);
            while($row = mysqli_fetch_array($result)) {
                $participant = $row["participant"];
               // echo "<script>alert('".$id."')</script>";
        }
        if($participant==null or $participant==""){
                $sql = "UPDATE ".$table." SET participant = '".$_SESSION['username']."'  WHERE id=".$id;
                $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
                $query = mysqli_query($con,$sql);
        }else{
                if(strpos($participant,$_SESSION['username'])===false){
                 $sql = "UPDATE ".$table." SET participant = CONCAT(participant,',','".$_SESSION['username']."')   WHERE id=".$id;
                 $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
                 $query = mysqli_query($con,$sql);
                }
        }
}
?>