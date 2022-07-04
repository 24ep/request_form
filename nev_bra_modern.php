<div class="list_bra shadow">
    <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <h5 style="text-align-last: center;font-weight: bolder;font-family: 'Prompt';color: #d36363;">CSG</h5>
        <!-- <a class="navbar-brand" href="#" style="padding:0px">
            <img style="padding:0px" src="/base/image/csg_logo.png" alt="" width="30" height="30">
        </a> -->
        <div class="btn-group dropend">
        <button type="button" class="nav-link" data-bs-toggle="dropdown" aria-expanded="false" onclick="get_list_update_job();" >
            <ion-icon style="color:white" name="notifications-outline"></ion-icon>
            
            <div id="get_count_nt_unread">
                        <?php include('get/get_count_nt_unread.php'); ?>
                </div>
        </button>
        <ul class="dropdown-menu notifications-box shadow overflow-auto">
            <span><ion-icon style="color:white" name="notifications-outline"></ion-icon> <strong>Job updated</strong></span>
            
                  <div id="get_list_job_update">
                    <?php include('get/get_list_job_update.php'); ?>
                  </div>
        </ul>
        </div>
        <a data-bs-toggle="tooltip" data-bs-placement="right" title="Home" class="nav-link active"
            id="v-pills-dashboard-tab" data-toggle="pill" href="#v-pills-dashboard" role="tab"
            aria-controls="v-pills-dashboard" onclick="updateURL('v-pills-dashboard');" aria-selected="true">
            <ion-icon style="color:white" name="newspaper-outline"></ion-icon>
        </a>
        <a data-bs-toggle="tooltip" data-bs-placement="right" title="Request new job" class="nav-link"
            id="v-pills-request_list-tab" data-toggle="pill" href="#v-pills-request_list" role="tab"
            aria-controls="v-pills-request_list" onclick="updateURL('v-pills-request_list');" aria-selected="false">
            <ion-icon style="color:white" name="rocket-outline"></ion-icon>
        </a>
        <a data-bs-toggle="tooltip" data-bs-placement="right" title="Content Request" class="nav-link"
            id="v-pills-cr-tab" data-toggle="pill" href="#v-pills-cr" role="tab" aria-controls="v-pills-cr"
            onclick="updateURL('v-pills-cr');" aria-selected="false">
            <ion-icon style="color:white" name="ticket-outline"></ion-icon>
        </a>
        <hr class="hr_nav_bra">
        <?php if(strpos($_SESSION["department"],'Content')!==false){?>
        <a data-bs-toggle="tooltip" data-bs-placement="right" title="Board" class="nav-link" id="v-pills-ts_admin-tab"
            data-toggle="pill" href="#v-pills-ts_admin" role="tab" aria-controls="v-pills-ts_admin"
            onclick="updateURL('v-pills-ts_admin');" aria-selected="false">
            <ion-icon style="color:white" name="grid-outline"></ion-icon>
        </a>
        <?php }?>
        <hr class="hr_nav_bra">
        <a disabled data-bs-toggle="tooltip" data-bs-placement="right" title="user" class="nav-link"
            id="v-pills-user-tab" data-toggle="pill" href="#v-pills-user" role="tab" aria-controls="v-pills-user"
            onclick="updateURL('v-pills-user');" aria-selected="false">
            <ion-icon style="color:white" name="person-outline"></ion-icon>
        </a>
        <a disabled data-bs-toggle="tooltip" data-bs-placement="right" title="Setting" class="nav-link"
            id="v-pills-setting-tab" data-toggle="pill" href="#v-pills-setting" role="tab"
            aria-controls="v-pills-setting" onclick="updateURL('v-pills-setting');" aria-selected="false">
            <ion-icon style="color:white" name="settings-outline"></ion-icon>
        </a>
        <a data-bs-toggle="tooltip" data-bs-placement="right" title="Logout" class="nav-link"
            href="base/action/action_logout.php">
            <ion-icon style="color:white" name="log-out-outline"></ion-icon>
        </a>
        <hr class="hr_nav_bra">
        <a disabled data-bs-toggle="tooltip" data-bs-placement="right" title="Quick link" class="nav-link"
            id="v-pills-link-tab" data-toggle="pill" href="#v-pills-link" role="tab" aria-controls="v-pills-link"
            aria-selected="false">
            <ion-icon style="color:white" name="earth-outline"></ion-icon>
        </a>
    </div>
</div>