<?php
 $id = $_POST['id'];
 $value_change = $_POST['value_change'];
 $attribute_code = $_POST['attribute_code'];
 $prefix = $_POST['prefix'];
 $database = $_POST['database'];
 $table = $_POST['table'];
 $primary_key_id = $_POST['primary_key_id'];
 $attribute_code =  str_replace($prefix."_edit_","",$attribute_code);
include($_SERVER['DOCUMENT_ROOT'].'/action/action_add_participant.php');
 session_start();


include($_SERVER['DOCUMENT_ROOT'].'/action/action_insert_log.php');
include($_SERVER['DOCUMENT_ROOT']."/action/action_send_linenotify.php");
    date_default_timezone_set("Asia/Bangkok");
    if($value_change==''){
        $sql = "UPDATE ".$database.".".$table." SET ".$attribute_code." = null  WHERE ".$primary_key_id."='".$id."'";
    }else{
        $sql = "UPDATE ".$database.".".$table." SET ".$attribute_code." = '".str_replace("'","''",$value_change)."'  WHERE ".$primary_key_id."='".$id."'";
    }
    $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    //     // $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
	if($query) {
        if( $table == 'add_new_job'){ //send notify only status of ticket have been update
            if($attribute_code=='status' or $attribute_code=='comment'){ //send notify only status of ticket have been update
                sendline($id,$attribute_code,$value_change,strtoupper($prefix));
            }

            add_participant($_POST['id'],"add_new_job");
            if($attribute_code=="follow_assign_name"){
                add_participant_with_user($_POST['id'],"add_new_job",$value_change);
            }
        }
        if(strtoupper($prefix)=='ANJ' or strtoupper($prefix)=='JC' or strtoupper($prefix)=='CS' or strtoupper($prefix)=='RJ'){
            $prefix_post = 'NS';
        }else{
            $prefix_post = strtoupper($prefix);
        }
        echo $prefix_post.'-'.$id.' have been updated';

        insert_log("update ".$table." \n ".$attribute_code." = ".$value_change ,$table,$_POST['id']);
	}else{
        insert_log("Update ".$table." fails".$con->error ,$table,$id);
        echo "Error: " . $sql . "<br/><br/>" . $con->error;
    }
    // mysqli_close($con);
?>
