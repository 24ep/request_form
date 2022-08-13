<?php  
 session_start();
// include_once('get_count_status.php');
include("../connect.php");
function count_status($username,$status){
    global $con;
    $sql="SELECT count(*) as total from all_in_one_project.add_new_job where request_username = '".$username."' and status like '%".$status."%' and trigger_status is null";
    $result=mysqli_query($con,$sql);
    $data=mysqli_fetch_assoc($result);
    $count = $data['total'];
    mysqli_close($con);
    if($count==null){
        $count = 0;
    }
    return $count;
}
function get_list_status($username,$status){
    global $con;
    $sql="SELECT id,brand,sku from all_in_one_project.add_new_job where request_username = '".$username."' and status like '%".$status."%' and trigger_status is null";
    $result = mysqli_query($con, $sql);
    $list="";
    while($row = mysqli_fetch_array($result)) {
        $list .= '<li class="list-group-item bg-transparent text-light p-1">[NS-'.$row["id"].']'.$row["brand"].' '.$row["sku"].' SKU</li>';
    }
    mysqli_close($con);
    return $list;
}
?>
<div class="container overflow-auto" style="padding:20px 20px 0px 20px">
    <div class="card-group">
        <div class="card text-light shadow-sm bg-dark bg-gradient mb-3"
            style="max-width: 18rem;margin-top:0px;margin-right:10px;border: 0px solid #dee2e6;">
            <div class="card-header">Pending</div>
            <div class="row card-body text-light">
                <div class="col-4" style="text-align: -webkit-center;">
                <div class="total_count_dashboard">
                    <?php $count_pending = count_status($_SESSION['username'],'pending');
                          echo $count_pending;
                    ?>
                </div>
                <div class="unit_count_dashboard">Ticket</div>
                </div>
                <div class="col">
                    <ul class="list-group list-group-flush overflow-auto" style="max-height: 100px;">
                    <?php $list = get_list_status($_SESSION['username'],'pending');
                          echo $list;
                    ?>
                  
                    </ul>
                </div>
            </div>
        </div>
        <div class="card text-light shadow-sm bg-dark bg-gradient mb-3"
            style="max-width: 18rem;margin-top:0px;margin-right:10px;border: 0px solid #dee2e6;">
            <div class="card-header">Checking</div>
            <div class="card-body text-light">
                <div class="total_count_dashboard">
                    <?php
                        $count_checking =  count_status($_SESSION['username'],'checking');
                        echo $count_checking;
                    ?>
                </div>
                <div class="unit_count_dashboard">Ticket</div>
            </div>
        </div>
        <div class="card text-light shadow-sm bg-dark bg-gradient mb-3"
            style="max-width: 18rem;margin-top:0px;margin-right:10px;border: 0px solid #dee2e6;">
            <div class="card-header">Waiting info</div>
            <div class="card-body text-light">
                <div class="total_count_dashboard" style="color:red">
                    <?php
                         $count_checking =  count_status($_SESSION['username'],'wait');
                         echo $count_checking;
                    ?>
                </div>
                <div class="unit_count_dashboard" style="color:red">Ticket</div>
            </div>
        </div>
        <div class="card text-light shadow-sm bg-dark bg-gradient mb-3"
            style="max-width: 18rem;margin-top:0px;margin-right:10px;border: 0px solid #dee2e6;">
            <div class="card-header">On production</div>
            <div class="card-body text-light">
                <div class="total_count_dashboard">
                    <?php
                        $count_checking =  count_status($_SESSION['username'],'accepted');
                        echo $count_checking;
                    ?>
                </div>
                <div class="unit_count_dashboard">Ticket</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8" style="border-right: 1px solid #efecec;">
            <?php include("../get/get_list_job_cms_dashboard.php"); ?>
        </div>
        <div class="col-4">
            <?php include("../get/get_list_message_log.php"); ?>
        </div>
    </div>
</div>
<script>
timeago().render(document.querySelectorAll('.timeago'));
</script>