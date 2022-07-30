<div style="    margin-left: 30px;">
    <div class="tab-content" id="myTabContent">
        <div class="row align-items-center" style="margin:20px">
            <div class="col-auto">
                <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Username</label>
                <input value="<?php echo $_SESSION["user_filter"];?>" class="selection_filter"
                    list="datalistOptionsuser" id="user_filter" onchange="filter_update();"
                    placeholder="Type to username...">
                <datalist id="datalistOptionsuser">
                    <?php echo $username_op;?>
                </datalist>
            </div>
            <div class="col-auto">
                <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Status</label>
                <select class="selection_filter" id="status_filter" onchange="filter_update();">
                    <?php echo $request_new_status_op;?>
                </select>
            </div>
            <div class="col-auto">
                <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Search</label>
                <input placeholder="Dept , Sub Dept , Brand , ID" type="text" class="selection_filter"
                    style="border-bottom: 1px #e0e0e0;border-style: double;width:300px" id="brand_filter"
                    onchange="filter_update();">
            </div>
            <div class="col-auto">
                <h5>|</h5>
            </div>
            <div class="col-auto">
                <label class="mr-sm-2 sr-only" for="inlineFormInput">Page</label>
                <input type="number" class="selection_filter"
                    style="width: 40px;border-bottom: 1px #e0e0e0;border-style: double;" id="pagenation_input" min=1
                    <?php if($_SESSION["total_page_rnj"]<>""){echo "max=".$_SESSION["total_page_rnj"];}?>
                    value="<?php echo $_SESSION["pagenation"];?>" onchange="filter_update();" placeholder="">
            </div>
            <div class="col-auto">
                <div id="total_page_nj"></div>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary btn-sm" style="margin-left:10px" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    <ion-icon size="small" name="add-outline"></ion-icon>
                    New Request
                </button>
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
    
            <li class="row">
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
      
        
            <?php include('../get/get_list_new_job.php'); ?>
     
    
</div>