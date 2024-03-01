<?php
 session_start();
function add_participant($id,$table){
        date_default_timezone_set("Asia/Bangkok");
        $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
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
                    // $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
                $query = mysqli_query($con,$sql);
        }else{
                if(strpos($participant,$_SESSION['username'])===false){
                 $sql = "UPDATE ".$table." SET participant = CONCAT(participant,',','".$_SESSION['username']."')   WHERE id=".$id;
                     // $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
                 $query = mysqli_query($con,$sql);
                }
        }
}
function add_participant_with_user($id,$table,$username){
        date_default_timezone_set("Asia/Bangkok");
        $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $query = "SELECT  * FROM ".$table."  WHERE id = ".$id
        or die("Error:" . mysqli_error($con));
        $result =  mysqli_query($con, $query);
            while($row = mysqli_fetch_array($result)) {
                $participant = $row["participant"];
               // echo "<script>alert('".$id."')</script>";
        }
        if($participant==null or $participant==""){
                $sql = "UPDATE ".$table." SET participant = '".$username."'  WHERE id=".$id;
                    // $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
                $query = mysqli_query($con,$sql);
        }else{
                if(strpos($participant,$username)===false){
                 $sql = "UPDATE ".$table." SET participant = CONCAT(participant,',','".$username."')   WHERE id=".$id;
                     // $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
                 $query = mysqli_query($con,$sql);
                }
        }
}
?>