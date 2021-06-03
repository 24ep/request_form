
<?php
    //include('action/connect.php');
function count_status($username,$status){
    include('action/connect.php');
    $sql="SELECT count(*) as total from add_new_job where request_username = '".$username."' and status like '%".$status."%'";
    $result=mysqli_query($con,$sql);
    $data=mysqli_fetch_assoc($result);
    $count = $data['total'];
    return $count;
    mysqli_close($con);
}




?>