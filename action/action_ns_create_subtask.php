<?php
 session_start();
    include($_SERVER['DOCUMENT_ROOT'].'/action/action_insert_log.php');
    include($_SERVER['DOCUMENT_ROOT'].'/action/action_send_line_api.php');
$id = $_POST["id"];
$sku_task_set = $_POST["sku_task_set"];
$array_number_subtask = explode(",",$sku_task_set );
//loop insert new to new ticket
foreach ($array_number_subtask as $number_of_sku) {
    //create new ticket
    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
	$sql = "INSERT INTO add_new_job (brand,department,sku,production_type,project_type,business_type,link_info,launch_date,stock_source,contact_buyer,
    contact_vender,remark,request_username,new_brand,
    online_channel,bu,request_important,tags,participant,subject_mail,sub_department,web_cate,request_date)
    SELECT brand,department,sku,production_type,project_type,business_type,link_info,launch_date,stock_source,contact_buyer,
    contact_vender,remark,request_username,new_brand,
    online_channel,bu,request_important,tags,participant,subject_mail,sub_department,web_cate,request_date FROM add_new_job WHERE id=".$id ;
	$query = mysqli_query($con,$sql);
	if($query) {
        $last_id = $con->insert_id;
        $sql_update_parent = "UPDATE add_new_job SET status = 'none',config_type= 'parent' where id=".$id ;
        $query_update_parent = mysqli_query($con,$sql_update_parent);
        if($query_update_parent){
            //show log
        }
        $sql_update_child = "UPDATE add_new_job SET sku =".$number_of_sku.",status = 'pending',parent=".$id." where id=".$last_id ;
	    $query_update_child = mysqli_query($con,$sql_update_child);
        if($query_update_child){
            //show log
        }
            //send to line
            date_default_timezone_set("Asia/Bangkok");
            $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
            mysqli_query($con, "SET NAMES 'utf8' ");
            $query = "SELECT  * FROM add_new_job  WHERE id = ".$id
            or die("Error:" . mysqli_error($con));
            $result =  mysqli_query($con, $query);
                while($row = mysqli_fetch_array($result)) {
                    $participant = $row["participant"];
                    $brand = $row["brand"];
                    $sku = $row["sku"];
                }
                $sent_to = explode(",",$participant);
                foreach ($sent_to as $sent_to_username) {
                if($sent_to_username<>$_SESSION["username"]){
                $query = "SELECT  * FROM account where username = '".$sent_to_username."'" or die("Error:" . mysqli_error($con));
                $result =  mysqli_query($con, $query);
                    while($row = mysqli_fetch_array($result)) {
                        $key = $row["token_line"];
                    }
                    if($key<>"" and $key<>null){
                        sent_line_noti("\nNS-".$id." [".$brand." ".$sku." SKUs]  \n----------------------------\n".$_SESSION["nickname"]." create new sub-ticket",$key);
                        send_ms_team("NS-".$id,$brand." ".$sku." SKUs",$_SESSION["nickname"]." created new sub-ticket");
                    }
                }
            }
                add_participant($_POST['id'],"add_new_job");
                add_participant($last_id,"add_new_job");
                insert_log("create new sub-ticket (".$last_id.")","add_new_job",$_POST['id']);
                insert_log("create new sub-ticket (".$last_id.")","add_new_job",$last_id);
                echo '<script>Notiflix.Notify.success("NS-'.htmlspecialchars($_POST['id'],  ENT_QUOTES, 'UTF-8').' have been create new sub-ticket ('.htmlspecialchars($last_id,  ENT_QUOTES, 'UTF-8').')");</script>';


    }else{
        echo "<script>
        Notiflix.Report.failure(
            'Failure',
            'Error: " . $query  . "<br/><br/>" . $con->error.",
            'Okay',
            )</script>;
        ";

    }
}
// mysqli_close($con);
?>
