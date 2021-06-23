<?php
$id = $_POST["id"];
$sku_task_set = $_POST["sku_task_set"];
echo '<script>console.log("'.$id.'|'.$sku_task_set.'");</script>';
$array_number_subtask = explode(",",$sku_task_set );
//loop insert new to new ticket
foreach ($array_number_subtask as $number_of_sku) {
    //create new ticket
    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
	$sql = "INSERT INTO add_new_job SELECT * FROM add_new_job WHERE id=".$id ;
	$query = mysqli_query($con,$sql);
	if($query) {
        $last_id = $conn->insert_id;
        $sql_update_parent = "UPDATE add_new_job SET sku =0,status = 'none',config_type= 'parent' where id=".$id ;
        $query_update_parent = mysqli_query($con,$sql_update_child);
        if($query_update_parent){
            //show log
        }
        $sql_update_child = "UPDATE add_new_job SET sku =".$number_of_sku.",status = 'pending',parent=".$id." where id=".$last_id ;
	    $query_update_child = mysqli_query($con,$sql_update_child);
        if($query_update_child){
            //show log
        }
    }
}
mysqli_close($con);
?>