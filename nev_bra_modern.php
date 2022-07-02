<div class="list_bra shadow">
    <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <h5 style="text-align-last: center;font-weight: bolder;font-family: 'Prompt';color: #d36363;">CSG</h5>
        <div class="btn-group dropend">
        <button type="button" class="nav-link" data-bs-toggle="dropdown" aria-expanded="false">
            <ion-icon style="color:white" name="notifications-outline"></ion-icon>
        </button>
        <ul class="dropdown-menu notifications-box shadow">
            <span><ion-icon style="color:white" name="notifications-outline"></ion-icon> Job updated</span>
            
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-owner-tab" data-bs-toggle="pill" data-bs-target="#pills-owner" type="button" role="tab" aria-controls="pills-owner" aria-selected="true">Owner</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-participant-tab" data-bs-toggle="pill" data-bs-target="#pills-participant" type="button" role="tab" aria-controls="pills-participant" aria-selected="false">Participant</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-message-tab" data-bs-toggle="pill" data-bs-target="#pills-message" type="button" role="tab" aria-controls="pills-message" aria-selected="false">Message</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-owner" role="tabpanel" aria-labelledby="pills-owner-tab">
                    <li><a class="dropdown-item notifications-li" href="#">Menu item</a></li>
                    <li><a class="dropdown-item notifications-li" href="#">Menu item</a></li>
                    <li><a class="dropdown-item notifications-li" href="#">Menu item</a></li>
                </div>
                <div class="tab-pane fade" id="pills-participant" role="tabpanel" aria-labelledby="pills-participant-tab">
                    <li><a class="dropdown-item notifications-li" href="#">Menu item</a></li>
                    <li><a class="dropdown-item notifications-li" href="#">Menu item</a></li>
                    <li><a class="dropdown-item notifications-li" href="#">Menu item</a></li>
                </div>
                <div class="tab-pane fade" id="pills-message" role="tabpanel" aria-labelledby="pills-message-tab">
                    <li><a class="dropdown-item notifications-li" href="#">Menu item</a></li>
                    <li><a class="dropdown-item notifications-li" href="#">Menu item</a></li>
                    <li><a class="dropdown-item notifications-li" href="#">Menu item</a></li>
                </div>
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