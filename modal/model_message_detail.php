<?php
$id=$_POST["id"];
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$query = "SELECT message_box.id as target_ms_id,target.target_username as username,target.msid as msid,message_box.title as title,message_box.description as description 
  FROM all_in_one_project.target_message_box as target left join all_in_one_project.message_box as message_box on target.msid = message_box.id 
  where target.target_username = 'poojaroonwit' and target.msid = 5" or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
    $description = htmlspecialchars_decode($row["description"],ENT_NOQUOTES);
    echo '<div class="modal-header">
    <h5 class="modal-title" id="messagemodelLabel">'.$row["title"].'</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body" id="messagebody">
    '.$description.'
    </div>';
  
}
// $sql_update_read = "UPDATE all_in_one_project.target_message_box SET readable = 1,read_date=CURRENT_TIMESTAMP where id=".$row['target_ms_id'] ;
// $query_update_read = mysqli_query($con,$sql_update_read);
// if($query_update_read){
//     // echo '<script>
//     // document.getElementById("ms_bt_id_'.$id.'").innerHTML  ="ตรวจสอบแล้ว";
//     // document.getElementById("ms_bt_id_'$id.'").className ="btn btn-secondary btn-sm";
//     // </script>';    
// }


?>