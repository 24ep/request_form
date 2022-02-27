<div class="col-2 list_bra window-full shadow" style="<?php echo  $nev_avg; ?>">
                <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a id="logo_badge" style="color:black" class="navbar-brand" href="#" style="margin: 15px;">Content
                        <span style="color: #dc3545;">Service Gate</span></a>
                    <a class="nav-link active" id="v-pills-dashboard-tab" data-toggle="pill" href="#v-pills-dashboard"
                        role="tab" aria-controls="v-pills-dashboard" onclick="updateURL('v-pills-dashboard');"
                        aria-selected="true">
                        <ion-icon style="color:white" name="newspaper-outline"></ion-icon>Homepage
                    </a>
                    <a class="nav-link" id="v-pills-request_list-tab" data-toggle="pill" href="#v-pills-request_list"
                        role="tab" aria-controls="v-pills-request_list" onclick="updateURL('v-pills-request_list');"
                        aria-selected="false">
                        <ion-icon style="color:white" name="rocket-outline"></ion-icon>New Request
                    </a>
                    <a class="nav-link" id="v-pills-cr-tab" data-toggle="pill" href="#v-pills-cr" role="tab"
                        aria-controls="v-pills-cr" onclick="updateURL('v-pills-cr');" aria-selected="false">
                        <ion-icon style="color:white" name="ticket-outline"></ion-icon>Content Request
                    </a>
                    <hr class="hr_nav_bra">
                    <?php if(strpos($_SESSION["department"],'Admin')!==false){?>
                    <!-- <a class="nav-link" id="v-pills-cr_admin-tab" data-toggle="pill" href="#v-pills-cr_admin" role="tab"
                        aria-controls="v-pills-cr_admin" onclick="updateURL('v-pills-cr_admin');" aria-selected="false">
                        <ion-icon style="color:white" name="grid-outline"></ion-icon> CR Board
                    </a> -->
                    <a class="nav-link" id="v-pills-ts_admin-tab" data-toggle="pill" href="#v-pills-ts_admin" role="tab"
                        aria-controls="v-pills-ts_admin" onclick="updateURL('v-pills-ts_admin');" aria-selected="false">
                        <ion-icon style="color:white" name="grid-outline"></ion-icon> Request Console
                    </a>
                    <?php }?>
                    <!-- <?php// if(strpos($_SESSION["department"],'Content')!==false){?>
                    <a class="nav-link" id="v-pills-fl_board-tab" data-toggle="pill" href="#v-pills-fl_board" role="tab"
                        aria-controls="v-pills-fl_board" onclick="updateURL('v-pills-fl_board');" aria-selected="false">
                        <ion-icon style="color:white" name="grid-outline"></ion-icon> Follow-up Board
                    </a>
                    <?php// }?> -->
                    <hr class="hr_nav_bra">
                    <ul class="list-unstyled ps-0">
                        <li class="mb-1">
                            <button style="color:#eee;padding:8px 16px;font-size:14px"
                                class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                                data-bs-target="#re_ds-collapse" aria-expanded="true">
                                <ion-icon style="color:white" name="stats-chart-outline"></ion-icon> Report & Dashboard
                            </button>
                            <div class="collapse" id="re_ds-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a target="_Blank"
                                            href="https://datastudio.google.com/reporting/de4de45a-8427-4611-a1a7-669467dfbcfd"
                                            class="d-inline-flex align-items-center rounded link-light">Job Daily
                                            progress Report</a></li>
                                    <li><a target="_Blank" href=""
                                            class="d-inline-flex align-items-center rounded link-light">Product-Feed
                                            (สินค้าหน้าเว็บ 4 ชั่วโมงล่าสุด)</a></li>
                                    <li><a target="_Blank"
                                            href="https://centralgroup-my.sharepoint.com/personal/ton_central_tech/_layouts/15/onedrive.aspx?originalPath=aHR0cHM6Ly9jZW50cmFsZ3JvdXAtbXkuc2hhcmVwb2ludC5jb20vOmY6L2cvcGVyc29uYWwvdG9uX2NlbnRyYWxfdGVjaC9FazduSEkzODZNWkFnQ3ZVNWUxeEF2a0JwNDJFNlBtOG9sQUJra3QxTUx5WlpnP3J0aW1lPUhuOGo5YmRIMTBn&sortField=Modified&isAscending=false&viewid=8d7d0290%2D9094%2D4b5e%2Daeb9%2D7719dd3ae652&id=%2Fpersonal%2Fton%5Fcentral%5Ftech%2FDocuments%2FCDS%2Fshare%2Fcds%5Fcontent"
                                            class="d-inline-flex align-items-center rounded link-light">Lamton Daily
                                            Export
                                            (all sku)</a></li>
                                    <li><a target="_Blank"
                                            href="https://tableau.central.co.th/#/site/central/views/Newassortment/REPORT"
                                            class="d-inline-flex align-items-center rounded link-light">Tableau
                                            assoertment
                                            (CDS)</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="mb-1">
                            <button style="color:#eee;padding:8px 16px;font-size:14px"
                                class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                                data-bs-target="#more-collapse" aria-expanded="true">
                                <ion-icon style="color:white" name="link-outline"></ion-icon> More
                            </button>
                            <div class="collapse" id="more-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a target="_Blank"
                                            href="https://backend.central.co.th/gutentag/admin/index/index/key/431e9e114e344c145c2f4899f39ed31f830b3ba301989086767f865e46a5f443/"
                                            class="d-inline-flex align-items-center rounded link-light">Magento CDS</a>
                                    </li>
                                    <li><a target="_Blank"
                                            href="https://doa.robinson.co.th/getmein/admin/dashboard/index/key/de971d117d6693136b0c5f5728929afd7b63bf21f20f1529937366f5fa08223e/"
                                            class="d-inline-flex align-items-center rounded link-light">Magento RBS</a>
                                    </li>
                                    <hr style="width: 70%;margin: 10px 35px 10px 35px;color: white;">
                                    <li><a target="_Blank"
                                            href="https://cenergy.atlassian.net/servicedesk/customer/portals"
                                            class="d-inline-flex align-items-center rounded link-light">Cenergy
                                            (แจ้งปัญหา CTO)</a></li>
                                    <li><a target="_Blank" href="http://cnext.centralgroup.com/"
                                            class="d-inline-flex align-items-center rounded link-light">C-next</a></li>
                                    <li><a target="_Blank"
                                            href="https://ris6789.central.co.th/arsys/shared/login.jsp?/arsys/"
                                            class="d-inline-flex align-items-center rounded link-light">RIS 6789</a>
                                    </li>
                                    <li><a target="_Blank" href="https://cdse-commercecontent.com"
                                            class="d-inline-flex align-items-center rounded link-light">Linesheet</a>
                                    </li>
                                    <hr style="width: 70%;margin: 10px 35px 10px 35px;color: white;">
                                </ul>
                            </div>
                        </li>
                        <li class="mb-1">
                            <button style="color:#eee;padding:8px 16px;font-size:14px"
                                class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                                data-bs-target="#admin-collapse" aria-expanded="true">
                                <ion-icon style="color:white" name="terminal-outline"></ion-icon> Account
                            </button>
                            <div class="collapse" id="admin-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><a target="_Blank" href=""
                                            class="d-inline-flex align-items-center rounded link-light">Setting</a>
                                    </li>
                                    <li><a href="base/action/action_logout.php"
                                    class="d-inline-flex align-items-center rounded link-light">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <button type="button" class="btn btn-light"
                    style="margin: 0px 20px 0px 20px;bottom: 30px;width: 13%;position: absolute;">
                    <?php echo $_SESSION["username"]; ?></button>
            </div>
