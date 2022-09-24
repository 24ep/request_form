<?php
 $id = $_POST['id'];
 $value_change = $_POST['value_change'];
 $attribute_code = $_POST['attribute_code'];
 $prefix = $_POST['prefix'];
 $database = $_POST['database'];
 $table = $_POST['table'];
 $primary_key_id = $_POST['primary_key_id'];
 $attribute_code =  str_replace($prefix."_edit_","",$attribute_code);
 include('action_add_participant.php');
 session_start();
    include("connect.php");
    include('action_insert_log.php');
    include("action_send_linenotify.php");
    date_default_timezone_set("Asia/Bangkok");
    $sql = "UPDATE ".$database.".".$table." SET ".$attribute_code." = '".str_replace("'","''",$value_change)."'  WHERE ".$primary_key_id."='".$id."'";
    $query_time_zone = mysqli_query($con,"SET time_zone = 'Asia/Bangkok';");
    $query = mysqli_query($con,$sql);
	if($query) {
        if( $table == 'add_new_job'){
            sendline($id,$attribute_code,$value_change,strtoupper($prefix));
            add_participant($_POST['id'],"add_new_job");
            if($attribute_code=="follow_assign_name"){
                add_participant_with_user($_POST['id'],"add_new_job",$value_change);
            }
        }
        echo strtoupper($prefix).'-'.$id.' have been updated';
        
        insert_log("update ".$table." \n ".$attribute_code." = ".$value_change ,$table,$_POST['id']);
	}else{
        insert_log("Update ".$table." fails".$con->error ,$table,$id);
        echo "Error: " . $sql . "<br/><br/>" . $con->error;
    }
    mysqli_close($con);
?>
