<?php  
 session_start();
// include_once('get_count_status.php');
include("../connect.php");
function count_status($username,$status){
    global $con;
    $sql="SELECT count(*) as total from all_in_one_project.add_new_job where  (participant like '%".$username."%' or request_username = '".$username."')  and status like '%".$status."%' and trigger_status is null and config_type<>'parent'";
    $result=mysqli_query($con,$sql);
    $data=mysqli_fetch_assoc($result);
    $count = $data['total'];
    // mysqli_close($con);
    if($count==null){
        $count = 0;
    }
    return $count;
}
function get_list_status($username,$status){
    global $con;
    $sql="SELECT id,brand,sku from all_in_one_project.add_new_job where (participant like '%".$username."%' or request_username = '".$username."') and status like '%".$status."%' and trigger_status is null and config_type<>'parent'";
    $result = mysqli_query($con, $sql);
    $list="";
    while($row = mysqli_fetch_array($result)) {
        $list .= '<li type="button" data-bs-toggle="offcanvas" data-bs-target="#edit_add_new" aria-controls="offcanvasExample"
         onclick="call_edit_add_new_modal('.$row["id"].')" class="list-group-item bg-transparent text-light p-1 text-nowrap" 
         style="font-size: smaller;width: 150px;"><strong style="color: #f85d60;">NS-'.$row["id"].'</strong> '.$row["brand"].' '.$row["sku"].' SKU</li>';
    }
    // mysqli_close($con);
    return $list;
}
?>
<div class="container overflow-auto" style="padding:20px 20px 0px 20px">
    <div class="card-group" style="position: absolute;    z-index: -1;">
        <div class="card text-light shadow-sm bg-dark bg-gradient mb-3"
            style="max-width: 18rem;margin-top:0px;margin-right:10px;border: 0px solid #dee2e6;z-index: -1;">
            <div class="card-header">Pending</div>
            <div class="row card-body text-light" style="flex: 0;">
                <div class="ps-3">
                    <div class="total_count_dashboard">
                        <?php $count_pending = count_status($_SESSION['username'],'pending');
                          echo $count_pending;
                    ?>
                        <small class="unit_count_dashboard" style="font-size: small;">Ticket</small>
                    </div>
                </div>
                <div class="ps-3">
                    <ul class="list-group list-group-flush overflow-auto" style="max-height: 100px;">
                        <?php $list = get_list_status($_SESSION['username'],'pending');
                          echo $list;
                    ?>

                    </ul>
                </div>
            </div>
        </div>
        <div class="card text-light shadow-sm bg-dark bg-gradient mb-3"
            style="max-width: 18rem;margin-top:0px;margin-right:10px;border: 0px solid #dee2e6;z-index: -1;">
            <div class="card-header">Checking</div>
            <div class="row card-body text-light" style="flex: 0;">
                <div class="ps-3">
                    <div class="total_count_dashboard">
                        <?php $count_pending = count_status($_SESSION['username'],'checking');
                          echo $count_pending;
                    ?>
                        <small class="unit_count_dashboard" style="font-size: small;">Ticket</small>
                    </div>

                </div>
                <div class="ps-3">
                    <ul class="list-group list-group-flush overflow-auto" style="max-height: 100px;">
                        <?php $list = get_list_status($_SESSION['username'],'checking');
                          echo $list;
                    ?>

                    </ul>
                </div>
            </div>
        </div>
        <div class="card text-light shadow-sm bg-dark bg-gradient mb-3"
            style="max-width: 18rem;margin-top:0px;margin-right:10px;border: 0px solid #dee2e6;z-index: -1;">
            <div class="card-header">Waiting information</div>
            <div class="row card-body text-light" style="flex: 0;">
                <div class="ps-3">
                    <div class="total_count_dashboard">
                        <?php $count_pending = count_status($_SESSION['username'],'wait');
                          echo $count_pending;
                    ?>
                        <small class="unit_count_dashboard" style="font-size: small;">Ticket</small>
                    </div>
                </div>
                <div class="ps-3">
                    <ul class="list-group list-group-flush overflow-auto" style="max-height: 100px;">
                        <?php $list = get_list_status($_SESSION['username'],'wait');
                          echo $list;
                    ?>

                    </ul>
                </div>
            </div>
        </div>
        <div class="card text-light shadow-sm bg-dark bg-gradient mb-3"
            style="max-width: 18rem;margin-top:0px;margin-right:10px;border: 0px solid #dee2e6;z-index: -1;">
            <div class="card-header">On production</div>
            <div class="row card-body text-light" style="flex: 0;">
                <div class="ps-3">
                    <div class="total_count_dashboard">
                        <?php $count_pending = count_status($_SESSION['username'],'accepted');
                          echo $count_pending;
                    ?>
                        <small class="unit_count_dashboard" style="font-size: small;">Ticket</small>
                    </div>

                </div>
                <div class="ps-3">
                    <ul class="list-group list-group-flush overflow-auto" style="max-height: 100px;">
                        <?php $list = get_list_status($_SESSION['username'],'accepted');
                          echo $list;
                    ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="col-8" style="border-right: 1px solid #efecec;">
            <?php include("../get/get_list_job_cms_dashboard.php"); ?>
        </div>
        <div class="col-4">
            <?php include("../get/get_list_message_log.php"); ?>
        </div>
    </div> -->
</div>
<script>
timeago().render(document.querySelectorAll('.timeago'));
</script>