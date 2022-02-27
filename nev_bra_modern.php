<div class="list_bra window-full shadow" style="width: fit-content;">
                <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Home"  
                        class="nav-link active" id="v-pills-dashboard-tab" data-toggle="pill" href="#v-pills-dashboard"
                        role="tab" aria-controls="v-pills-dashboard" onclick="updateURL('v-pills-dashboard');"
                        aria-selected="true">
                        <ion-icon style="color:white" name="newspaper-outline"></ion-icon>
                    </a>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Request new job"  
                    class="nav-link" id="v-pills-request_list-tab" data-toggle="pill" href="#v-pills-request_list"
                        role="tab" aria-controls="v-pills-request_list" onclick="updateURL('v-pills-request_list');"
                        aria-selected="false">
                        <ion-icon style="color:white" name="rocket-outline"></ion-icon>
                    </a>
                    <a class="nav-link" id="v-pills-cr-tab" data-toggle="pill" href="#v-pills-cr" role="tab"
                        aria-controls="v-pills-cr" onclick="updateURL('v-pills-cr');" aria-selected="false">
                        <ion-icon style="color:white" name="ticket-outline"></ion-icon>
                    </a>
                    <hr class="hr_nav_bra">
                    <?php if(strpos($_SESSION["department"],'Admin')!==false){?>
                    <!-- <a class="nav-link" id="v-pills-cr_admin-tab" data-toggle="pill" href="#v-pills-cr_admin" role="tab"
                        aria-controls="v-pills-cr_admin" onclick="updateURL('v-pills-cr_admin');" aria-selected="false">
                        <ion-icon style="color:white" name="grid-outline"></ion-icon> CR Board
                    </a> -->
                    <a class="nav-link" id="v-pills-ts_admin-tab" data-toggle="pill" href="#v-pills-ts_admin" role="tab"
                        aria-controls="v-pills-ts_admin" onclick="updateURL('v-pills-ts_admin');" aria-selected="false">
                        <ion-icon style="color:white" name="grid-outline"></ion-icon>
                    </a>
                    <?php }?>
                    <!-- <?php// if(strpos($_SESSION["department"],'Content')!==false){?>
                    <a class="nav-link" id="v-pills-fl_board-tab" data-toggle="pill" href="#v-pills-fl_board" role="tab"
                        aria-controls="v-pills-fl_board" onclick="updateURL('v-pills-fl_board');" aria-selected="false">
                        <ion-icon style="color:white" name="grid-outline"></ion-icon> Follow-up Board
                    </a>
                    <?php// }?> -->
                    <hr class="hr_nav_bra">
                      <a class="nav-link" id="v-pills-ts_admin-tab" data-toggle="pill" href="#v-pills-ts_admin" role="tab"
                        aria-controls="v-pills-ts_admin" onclick="updateURL('v-pills-ts_admin');" aria-selected="false">
               
                        <ion-icon style="color:white"  name="person-outline"></ion-icon>
                    </a>
                    <a class="nav-link" id="v-pills-ts_admin-tab" data-toggle="pill" href="#v-pills-ts_admin" role="tab"
                        aria-controls="v-pills-ts_admin" onclick="updateURL('v-pills-ts_admin');" aria-selected="false">
                      
                        <ion-icon style="color:white"  name="settings-outline"></ion-icon>
                    
                    </a>
                    <a class="nav-link" id="v-pills-ts_admin-tab" data-toggle="pill" href="#v-pills-ts_admin" role="tab"
                        aria-controls="v-pills-ts_admin" onclick="updateURL('v-pills-ts_admin');" aria-selected="false">
                       
                        <ion-icon style="color:white"  name="log-out-outline"></ion-icon>
                  
                    
                    </a>
                    <hr class="hr_nav_bra">
                    <a class="nav-link" id="v-pills-ts_admin-tab" data-toggle="pill" href="#v-pills-ts_admin" role="tab"
                        aria-controls="v-pills-ts_admin" onclick="updateURL('v-pills-ts_admin');" aria-selected="false">
                       
                        <ion-icon style="color:white"  name="earth-outline"></ion-icon>
                      
                  
                    </a>
                </div>
            </div>
