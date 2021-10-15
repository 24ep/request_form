<?php
 $id = $_POST['id'];
 $value_change = $_POST['value_change'];
 $value_name = $_POST['id_name'];
 $value_name =  str_replace("cr_edit_","",$value_name);
 include('action_add_participant.php');
session_start();
    include("connect.php");
    include('action_insert_log.php');
    date_default_timezone_set("Asia/Bangkok");
    if( $value_name=="status"){
        if( $value_change =="Pending"){
            $timestamp = ",inprogress_date = null,complete_date  = null";
        }elseif($value_change =="Inprogress"){
            $timestamp = ",inprogress_date = CURRENT_TIMESTAMP,complete_date = null";
        }elseif($value_change =="Close"){
            $timestamp = ",complete_date = CURRENT_TIMESTAMP";
        }else{
            $timestamp = "";
        }
    }
    $sql = "UPDATE checklist_of_content_request SET ".$value_name." = '".$value_change."' ".$timestamp."  WHERE id=".$id;
    $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
	if($query) {
        add_participant($_POST['id'],"content_request");
        insert_log("update ticket \n ".$value_name." = ".$value_change ,"cl_content_request",$_POST['id']);
        echo '<script>alert("Update Ticket ID CR-'.$_POST['id'].'")</script>';
	}else{
        insert_log("update ticket faild".$con->error ,"content_request",$id);
        echo '<script>alert("Error: ' . $sql . '\n\n' . $con->error.'")</script>';
    }
    mysqli_close($con);
?>