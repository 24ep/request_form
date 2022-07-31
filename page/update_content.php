<div class="container ">
    <nav class="navbar">
        <div class="container-fluid p-0">
            <form class="d-flex">
                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                </div>
                <button class="btn btn-primary btn-sm " style="margin-left:10px;" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#content_request_canvas"
                    aria-controls="offcanvasExample">
                    <ion-icon size="small" name="add-outline" role="img" class="md icon-small hydrated"
                        aria-label="add outline">
                    </ion-icon>
                    New Ticket
                </button>

            </form>
        </div>
    </nav>
    <nav class="navbar">
        <form style="width:100%">
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <ion-icon style="vertical-align: middle;margin-right: 5px;" name="search-outline">
                    </ion-icon> Search
                </span>
                <?php 
                                                if($_SESSION["ts_query_input"]<>""){
                                                    $sqb = $_SESSION["ts_query_input"];
                                                }else{
                                                    $sqb =  "";
                                                }
                                                if($_SESSION["ts_username"]<>""){
                                                    $squser = $_SESSION["ts_username"];
                                                }else{
                                                    $squser="";
                                                }
                                                ?>
                <input style="width: 30%;" type="search" class="form-control" onsearch="search_cr_data();"
                    id="ts_command" name="ts_command"
                    placeholder="leave your ticket number or message have contain in title" aria-label="Username"
                    aria-describedby="basic-addon1" value="<?php echo $sqb; ?>">
                <span class="input-group-text">Username</span>
                <input style="width: 10%;" list="qlistoption" type="text" class="form-control"
                    onchange="search_cr_username();" id="ts_username" name="ts_username" placeholder="all user"
                    aria-label="Username" aria-describedby="basic-addon1"
                    value="<?php echo $_SESSION["ts_username"];   ?>">
                <span class="input-group-text">Request for</span>
                <input style="width: 10%;" list="qlistoption_rf" type="text" class="form-control"
                    onchange="search_cr_request_for();" id="ts_request_for" name="ts_request_for" placeholder="all type"
                    aria-label="Request for" aria-describedby="basic-addon1"
                    value="<?php echo $_SESSION["ts_request_for"];  ?>">
                <span class="input-group-text">status</span>
                <input style="width: 10%;" list="qlistoption_status" type="text" class="form-control"
                    onchange="search_cr_status();" id="ts_status" name="ts_status" placeholder="all status"
                    aria-label="status" aria-describedby="basic-addon1" value="<?php echo $_SESSION["ts_status"];  ?>">
            
            </div>
            <datalist id="qlistoption">
                <?php echo $username_op_cr; ?>
            </datalist>
            <datalist id="qlistoption_rf">
                <?php echo $request_for_op; ?>
            </datalist>
            <datalist id="qlistoption_status">
                <?php echo $request_cr_status_op; ?>
            </datalist>
        </form>
    </nav>
    <div class="btn-group btn-group-sm" style="position: inherit;" role="group"
        aria-label="Basic checkbox toggle button group">
        <?php include('../get/get_list_bucket.php'); ?>

        <ul class="nav nav-pills mb-3" id="pills-tab" style="right: 0;position: absolute;padding: 10px 40px;"
            role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link ts-view active" id="pills-list_view_ts-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-list_view_ts" type="button" role="tab" aria-controls="pills-list_view_ts"
                    aria-selected="true">
                    <ion-icon name="reorder-four-outline"></ion-icon>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link ts-view" id="pills-board_view_ts-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-board_view_ts" type="button" role="tab" aria-controls="pills-board_view_ts"
                    aria-selected="false">
                    <ion-icon name="grid-outline"></ion-icon>
                </button>
            </li>
        </ul>
    </div>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-list_view_ts" role="tabpanel"
            aria-labelledby="pills-list_view_ts-tab" tabindex="0">
            <div class="row" id="get_ts_admin_console_list_view">
                <?php include('../get/get_list_update_content.php'); ?>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-board_view_ts" role="tabpanel" aria-labelledby="pills-board_view_ts-tab"
            tabindex="0">
            <div class="row" id="get_ts_admin_console">
            </div>
        </div>
    </div>
</div>