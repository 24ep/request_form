<?php  
 session_start();
// include_once('get_count_status.php');
include("./connect.php");
function count_status($username,$status){
    global $con;
    $sql="SELECT count(*) as total from all_in_one_project.add_new_job where request_username = '".$username."' and status like '%".$status."%'";
    $result=mysqli_query($con,$sql);
    $data=mysqli_fetch_assoc($result);
    $count = $data['total'];
    mysqli_close($con);
    return $count;
}
?>
<div class="container overflow-auto" style="padding:20px 20px 0px 20px">
    <div class="card-group">
        <div class="card text-dark shadow-sm bg-light mb-3"
            style="max-width: 18rem;margin-top:0px;margin-right:10px;border: 0px solid #dee2e6;">
            <div class="card-header">Pending</div>
            <div class="card-body text-secondary">
                <div class="total_count_dashboard">
                    <?php $count_pending = count_status($_SESSION['username'],'pending');
                          echo $count_pending;
                    ?>
                </div>
                <div class="unit_count_dashboard">Ticket</div>
            </div>
        </div>
        <div class="card text-dark  shadow-sm  bg-light mb-3"
            style="max-width: 18rem;margin-top:0px;margin-right:10px;border: 0px solid #dee2e6;">
            <div class="card-header">Checking</div>
            <div class="card-body text-secondary">
                <div class="total_count_dashboard">
                    <?php
                        $count_checking =  count_status($_SESSION['username'],'checking');
                        echo $count_checking;
                    ?>
                </div>
                <div class="unit_count_dashboard">Ticket</div>
            </div>
        </div>
        <div class="card text-dark  shadow-sm  bg-light mb-3"
            style="max-width: 18rem;margin-top:0px;margin-right:10px;border: 0px solid #dee2e6;">
            <div class="card-header">Waiting info</div>
            <div class="card-body text-secondary">
                <div class="total_count_dashboard" style="color:red">
                    <?php
                         $count_checking =  count_status($_SESSION['username'],'wait');
                         echo $count_checking;
                    ?>
                </div>
                <div class="unit_count_dashboard" style="color:red">Ticket</div>
            </div>
        </div>
        <div class="card text-dark  shadow-sm bg-light mb-3"
            style="max-width: 18rem;margin-top:0px;margin-right:10px;border: 0px solid #dee2e6;">
            <div class="card-header">Waiting Confirm</div>
            <div class="card-body text-secondary">
                <div class="total_count_dashboard">
                    <?php
                        $count_checking =  count_status($_SESSION['username'],'confirm');
                        echo $count_checking;
                    ?>
                </div>
                <div class="unit_count_dashboard">Ticket</div>
            </div>
        </div>
        <div class="card text-white  shadow-sm bg-dark mb-3"
            style="max-width: 18rem;margin-top:0px;margin-right:10px;border: 0px solid #dee2e6;">
            <div class="card-header">Send to traffic already</div>
            <div class="card-body text-secondary">
                <div class="total_count_dashboard">
                    <?php
                        $count_checking =  count_status($_SESSION['username'],'on-productions');
                        echo $count_checking;
                    ?>
                </div>
                <div class="unit_count_dashboard">Ticket</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8" style="border-right: 1px solid #efecec;">
            <?php include("get_list_job_cms_dashboard.php"); ?>
        </div>
        <div class="col-4">
            <?php include("get_list_message_log.php"); ?>
        </div>
    </div>
</div>