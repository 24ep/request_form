<?php
session_start();
include_once('../get/get_option_function.php');
$username_op = getoption_return_filter("username","account",$_SESSION["user_filter"],"single","all_in_one_project");
$request_new_status_op = get_option_return_filter("status",$_SESSION["status_filter"],"single","add_new");
?>
<div style="margin-left: 10px;">
    <div class="tab-content" id="myTabContent">
        <div class="row align-items-center mt-3 mb-3">
            <div class="col-5">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Search</span>
                    <input type="text" class="form-control" id="brand_filter" onchange="filter_update();"
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                        placeholder="Dept , Sub Dept , Brand , ID">
                </div>
            </div>
            <div class="col-auto">
                <div class="input-group input-group-sm mb-3 flex-nowrap">
                    <span class="input-group-text " id="addon-wrapping">Username</span>
                    <input value="<?php echo $_SESSION["user_filter"];?>" class="form-control"
                        list="datalistOptionsuser" id="user_filter" onchange="filter_update();" placeholder="Username"
                        aria-label="Username" aria-describedby="addon-wrapping">
                    <datalist id="datalistOptionsuser">
                        <?php echo $username_op;?>
                    </datalist>
                </div>
            </div>
            <div class="col-2">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Status</span>
                    <select class="form-select" id="status_filter" onchange="filter_update();">
                        <?php echo $request_new_status_op;?>
                    </select>
                </div>
            </div>
            <div class="col-1">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Page</span>
                    <input type="number" class="form-control" onchange="filter_update();"
                        id="pagenation_input" min=1
                        <?php if($_SESSION["total_page_rnj"]<>""){echo "max=".$_SESSION["total_page_rnj"];}?>
                        value="<?php echo $_SESSION["pagenation"];?>" onchange="filter_update();" placeholder=""
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"
                        placeholder="Dept , Sub Dept , Brand , ID">
                    <span class="input-group-text" id="inputGroup-sizing-sm">
                        <div id="total_page_nj"></div>
                    </span>
                </div>
            </div>
            <div class="col-auto">
                <div class="input-group input-group-sm mb-3">
                    <button class="btn btn-dark btn-sm" style="margin-left:10px" type="button"
                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                        <ion-icon size="small" name="add-outline"></ion-icon>
                        Create New
                    </button>
                </div>
            </div>
            <!-- </div> -->
            <div class="col-auto" style="right: 20px;position: absolute;margin-top: 15px;">
                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-sm">
                        <div class="offcanvas offcanvas-start" style="width:90%" tabindex="-1" id="offcanvasExample"
                            aria-labelledby="offcanvasExampleLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasExampleLabel" style="padding-left:50px">
                                    <ion-icon style="margin-right:10px" name="add-circle-outline">
                                    </ion-icon>Request add new job
                                </h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <div class="container-md" style="padding:0px 80px 0px 80px;">
                                    <form class="row g-3" action="../action/action_submit_add_new_job.php"
                                        method="POST">
                                        <div id="add_new_job_result"></div>
                                        <?php include('../form/form_request_add_new.php')?>
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button type="submit" class="btn btn-dark btn-sm">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
            </div>
            </ul>
            </nav>
        </div>
    </div>
    <li class="row mb-3" style="color: #b3b3b3;font-weight: 600;text-align-last: center;">
        <div class="col" scope="col">Ticket ID</div>
        <div class="col" scope="col">Department</div>
        <div class="col" scope="col">Brand</div>
        <div class="col" scope="col">SKU</div>
        <div class="col" scope="col">Production request</div>
        <div class="col" scope="col">Project-type</div>
        <div class="col" scope="col">launch date</div>
        <div class="col" scope="col">Badge</div>
        <div class="col" scope="col">Status</div>
        <div class="col" scope="col">Action</div>
    </li>
    <?php include('../get/get_list_new_job_new.php'); ?>
</div>
<script>
function filter_update(be) {
    var user_filter = document.getElementById("user_filter").value
    var status_filter = document.getElementById("status_filter").value
    var pagenation_input = document.getElementById("pagenation_input").value
    var brand_filter = document.getElementById("brand_filter").value
    var from_post = true;
    if (from_post) {
        $.post("../get/get_list_new_job.php", {
            user_filter: user_filter,
            status_filter: status_filter,
            from_post: from_post,
            pagenation_input: pagenation_input,
            brand_filter: brand_filter
        }, function(data) {
            $('#job_list').html(data);
        });
    }
    if (from_post) {
        $.post("../get/get_total_page_nj.php", {
            user_filter: user_filter,
            status_filter: status_filter,
            from_post: from_post,
            pagenation_input: pagenation_input,
            brand_filter: brand_filter
        }, function(data) {
            $('#total_page_nj').html(data);
        });
    }
}
</script>