<?php
 $id = $_POST['id'];
 $value_change = $_POST['value_change'];
 $value_name = $_POST['id_name'];
 $value_name =  str_replace("cl_edit_","",$value_name);
 include($_SERVER['DOCUMENT_ROOT'].'/action/action_add_participant.php');
 session_start();
    // include($_SERVER['DOCUMENT_ROOT']."/connect.php");
    include($_SERVER['DOCUMENT_ROOT'].'/action/action_insert_log.php');
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
    $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
    $sql = "UPDATE all_in_one_project.checklist_of_content_request SET ".$value_name." = '".$value_change."' ".$timestamp."  WHERE id=".$id;
        // $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
	if($query) {
        add_participant($_POST['id'],"content_request");
        if( $value_name=="case_officer"){
            add_participant_with_user($_POST['id'],"content_request",$value_change);
        }
        insert_log("update checklist of ticket \n ".$value_name." = ".$value_change ,"content_request",$_POST['id']);
        // echo '<script>Notiflix.Notify.success("Ticket CR-'.$_POST['id'] .' have been update status to '.$value_change.' );</script>';
        echo '<script>Notiflix.Notify.success("Checklist ID '.htmlspecialchars($_POST['id'],  ENT_QUOTES, 'UTF-8').' have been updated");</script>';
	}else{
        insert_log("update checklist of ticket fails".$con->error ,"content_request",$id);
        echo "<script>
        Notiflix.Report.failure(
            'Failure',
            'Error: " . $sql . "<br/><br/>" . $con->error.",
            'Okay',
            )</script>;
        ";
    }
    // mysqli_close($con);
?>