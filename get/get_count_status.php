<?php
 session_start();
function count_status($username,$status){
    include('connect.php');
    $sql="SELECT count(*) as total from all_in_one_project.add_new_job where request_username = '".$username."' and status like '%".$status."%'";
    $result=mysqli_query($con,$sql);
    $data=mysqli_fetch_assoc($result);
    $count = $data['total'];
    mysqli_close($con);
    return $count;
}
?>