    <?php
    session_start();
    if (!$_SESSION["login_csg"]){ 
        Header("Location: login_page.php");
    }else{
    include('get/get_card_content_request.php'); 
    include_once('get/get_count_status.php');

    function getoption_return_filter($col,$table,$select_option,$sorm,$database) {
        $con= mysqli_connect("localhost","cdse_admin","@aA417528639",$database) or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $query = "SELECT * FROM $table ORDER BY id asc" or die("Error:" . mysqli_error());
        $result = mysqli_query($con, $query);
        while($row = mysqli_fetch_array($result)) {
    // split array store
            if($sorm=="multi"){
                if($col=="store" or $col=="itemmize_type" or $col=="product_website"){
                $array_store = explode(', ', $select_option);
                $duplicate_op = false;
                $loop_in_null = false;
                foreach($array_store as $store)
                {
                    if($row[$col] <> '' ) {
                    if($store==$row[$col]){
                        $option_set .= '<option value="'.$row[$col].'" selected>'.$row[$col].'</option>';
                        $duplicate_op = true;
                    }
                    }
                }
                if($row[$col] <> ''){
                    if($duplicate_op == false){
                    $option_set .= '<option value="'.$row[$col].'">'.$row[$col].'</option>';
                    }
                }
                }
            }else{
                if($loop_in_null==false){
                $option_set .= '<option value=""></option>';
                $loop_in_null=true;
                }
                if($row[$col] <> '' )
                {

                    if($select_option==$row[$col]){
                        if($col=="username"){
                            $op_label = $row["nickname"]." ".$row["firstname"]." (".$row["username"].") ";

                        }else{
                            $op_label = $row[$col];

                        }
                        $option_set .= '<option value="'.$row[$col].'" selected>'.$op_label.'</option>';
                    }else{
                        if($col=="username"){
                            $op_label = $row["nickname"]." ".$row["firstname"]." (".$row["username"].") ";

                        }else{
                            $op_label = $row[$col];

                        }
                        $option_set .= '<option value="'.$row[$col].'">'.$op_label.'</option>';
                    }
                }
        }
        }
        return $option_set;
        mysqli_close($con);
        }

        function get_option_return_filter($attribute_code,$default_option,$select_type,$function){
            $con= mysqli_connect("localhost","cdse_admin","@aA417528639","content_service_gate") or die("Error: " . mysqli_error($con));
            mysqli_query($con, "SET NAMES 'utf8' ");
            $query = "SELECT 
            attribute_option.option_id as option_id,
            attribute_option.attribute_id as attribute_id,
            attribute_option.attribute_option as attribute_option,
            attribute_option.function as function,
            attribute_entity.attribute_code as attribute_code
            FROM content_service_gate.attribute_option as attribute_option
            left join content_service_gate.attribute_entity as attribute_entity
            on attribute_option.attribute_id = attribute_entity.attribute_id 
            where attribute_entity.attribute_code =  '".$attribute_code."' and attribute_option.function='".$function."' 
            ORDER BY option_id asc" or die("Error:" . mysqli_error());
            $result = mysqli_query($con, $query);
            
            
                if($select_type=="multi"){
                    while($row = mysqli_fetch_array($result)) {
                    $array_default = explode(', ', $default_option);
                    foreach($array_default as $option)
                      {
                        if($option==$row["attribute_option"]){
                            $option_set .= '<option selected value="'.$row["attribute_option"].'">'.$row["attribute_option"].'</option>';
                        }else{
                            $option_set .= '<option value="'.$row["attribute_option"].'">'.$row["attribute_option"].'</option>';
                        }
                        
                      }
                    }

                }else{
                    $option_set .= '<option value=""></option>';
                    while($row = mysqli_fetch_array($result)) {
                        if($default_option==$row["attribute_option"]){
                            $option_set .= '<option selected value="'.$row["attribute_option"].'">'.$row["attribute_option"].'</option>';
                        }else{
                            $option_set .= '<option value="'.$row["attribute_option"].'">'.$row["attribute_option"].'</option>';
                        }
                    }
                        
                }
            
            return $option_set;
            mysqli_close($con);
        }

        $username_op = getoption_return_filter("username","account",$_SESSION["user_filter"],"single","all_in_one_project");
        $username_op_cr = getoption_return_filter("username","account",$_SESSION["user_cr_filter"],"single","all_in_one_project");
        $request_new_status_op = get_option_return_filter("status",$_SESSION["status_filter"],"single","add_new");
        $con= mysqli_connect("localhost",$_SESSION["db_username"],$_SESSION["db_password"],"all_in_one_project") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $query = "SELECT * FROM account where username = '".$_SESSION['username']."' ORDER BY id DESC " or die("Error:" . mysqli_error());
        $result = mysqli_query($con, $query);
        while($row = mysqli_fetch_array($result)) {
        $nickname = $row['nickname'];
        $department = $row['department'];
        $office_tell = $row['office_tell'];
        $work_email = $row['work_email'];
        $get_contact_buyer = $row['firstname']." ".$row['lastname']." ( ".$nickname." )\nEmail: ".$row['work_email']."\nOffice tell: ".$row['office_tell'];
        }
        mysqli_close($con);
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Content and Studio - Homepage</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
        <link rel="icon" type="image/ocp" href="https://cdsecommercecontent.ga/powerappsp/images/24ico.ico" />
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
        <!-- google font Quicksand -->
        <!-- <link rel="preconnect" href="https://fonts.gstatic.com"> <link
            href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap"
            rel="stylesheet"> -->
        <!-- end google font -->
        <!-- Bootstrap css -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <!-- end Bootstrap css -->
        <link href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css" rel="stylesheet">
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
        </script>
        <!-- textarray -->
        <script src="https://cdn.tiny.cloud/1/cis8560ji58crrbq17zb11gp39qhpn2lka54u0m54s8du1gw/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
        <style>
        body {
            font-family: 'Prompt', sans-serif !important;
            font-size: 14px;
        }

        a {
            color: gray;
            text-decoration: auto;
        }

        a:hover {
            color: black;
            text-decoration: auto;
            font-weight: bold;
        }

        label {
            font-weight: 800 !important;
        }

        .row {
            margin-bottom: 15px;
        }

        .multiple-select,
        .multiple-select_adj,
        .multiple-select_edit {
            width: 100%;
        }

        .header_form {
            text-align: center;
            margin-bottom: 50px;
            margin-top: 50px;
        }

        .container-sm {
            max-width: 500px;
            margin-top: 8%;
            padding: 10px !important 50px !important 100px !important !important;
        }

        .list_bra .nav-pills .nav-link.active,
        .list_bra .nav-pills .show .nav-link {
            color: white;
            /* background-color: white; */
            border-radius: unset;
            background-color: #f0f2fc87;
            font-weight: bolder;
        }

        /* .nav-link{
            color: white;
        } */
        .list_bra .nav-pills .nav-link {
            color: white !important;
        }

        .list_bra .nav-link:hover {
            color: white !important;
            width: 100%;
            s font-weight: bolder;
        }

        .list_bra .nav-link.active:hover {
            color: #ffff !important;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show .nav-link {
            background-color: #f0f2fc87;
            color: white !important;
            width: 100%;
        }

        .navbar-brand {
            margin-left: 10px;
            margin-right: 10px;
            font-weight: 1000;
        }

        .navbar-brand {
            color: #ffff !important;
        }

        .navbar-brand:hover {
            color: #ffff !important;
        }

        .list_bra {
            padding-right: 0;
            /* background: rgba(236, 236, 236, 1); */
            /* background: #191919; */
            /* background: #212529!important; */
            background-image: url('image/11.jpg');
            color: black;
        }

        .my-1 {
            margin-top: 1rem !important;
            margin-bottom: 1rem !important;
        }

        .selection_filter {
            width: 150px;
            border: transparent;
            /* border-bottom:1px gray; */
            /* border-bottom-style: dotted; */
        }

        .selection_filter:active {
            border: transparent !important;
        }

        .selection_filter:focus {
            border: transparent !important;
            border-style: none;
        }

        ion-icon {
            font-size: 20px;
            margin: -0.2rem;
        }

        .link-light {
            color: white;
            padding: 0.2rem;
            padding-left: 40px;
            font-weight: 400;
            line-height: 1.5;
            font-size: 14px;
            font-family: 'Prompt', sans-serif !important;
        }

        .link-light:hover {
            color: white;
            background-color: #dbdbdb38;
            width: 100%;
            border-radius: 0px !important;
        }

        .link-light:focus {
            color: white;
            background-color: #dbdbdb38;
            width: 100%;
            border-radius: 0px !important;
        }

        .btn-check:focus+.btn,
        .btn:focus {
            box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 0%)
        }

        .total_count_dashboard {
            text-align: center;
            font-size: 70px;
        }

        .unit_count_dashboard {
            text-align: center;
        }

        ion-icon {
            margin-right: 5px;
        }

        .task_detial {
            color: #6c757d;
            ;
            margin-left: 20px;
            margin-right: 20px;
            display: block;
            font-size: 13px;
            padding-bottom: 3px;
            padding-top: 3px;
        }

        .icon_bar_tootle {
            margin-left: 20px;
            margin-right: 50px;
            font-size: 13px;
        }

        .icon_ocv {
            margin-right: 0px !important;
            font-size: 14px;
            color: gray;
        }

        .ticket_relate {
            border-color: white;
            padding: 0px;
            padding-bottom: 5px
        }

        .col-board {
            border-right: 1px #dee2e6 solid;
        }

        .cr_title {
            margin-bottom: 10px;
        }

        .status_cr_list {
            margin-right: 5px;
            margin-left: 10px;
            color: #d8d8d887;
            font-size: 30px;
        }
        </style>
    </head>

    <body onload="doAutoRefresh();filter_update();doAutoRefresh_cr();">
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-140386041-2"></script>
        <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-140386041-2');
        </script>
        <div class="offcanvas offcanvas-start overflow-auto" role="dialog" tabindex="-1" id="edit_add_new"
            style="width:100%" aria-labelledby="offcanvasExampleLabel">
            <div id="callmodal_request_add_new" style="height: 100%;"></div>
        </div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="notificationcanvas"
            aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasRightLabel">Update</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <?php include("get/get_log.php"); ?>
            </div>
        </div>
       
        <div class="row " style="margin-bottom: 0px;--bs-gutter-x: 0rem;">
            <div class="col-2 list_bra window-full shadow">
                <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="navbar-brand" href="#" style="margin: 15px;">Content <small
                            style="color: #dc3545;">Service
                            Gate</small></a>
                    <a class="nav-link active" id="v-pills-dashboard-tab" data-toggle="pill" href="#v-pills-dashboard"
                        role="tab" aria-controls="v-pills-dashboard" onclick="updateURL('v-pills-dashboard');"
                        aria-selected="true">
                        <ion-icon style="color:white" name="newspaper-outline"></ion-icon>Homepage
                    </a>
                    <a class="nav-link" id="v-pills-ms_admin-tab" data-toggle="pill" href="#v-pills-ms_admin" role="tab"
                        aria-controls="v-pills-ms_admin" onclick="updateURL('v-pills-ms_admin');" aria-selected="false">
                        <ion-icon name="mail-unread-outline"></ion-icon> Updated  <span id="total_unread_div"></span>
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
                    <?php if(strpos($_SESSION["department"],'Admin')!==false){?>
                    <a class="nav-link" id="v-pills-cr_admin-tab" data-toggle="pill" href="#v-pills-cr_admin" role="tab"
                        aria-controls="v-pills-cr_admin" onclick="updateURL('v-pills-cr_admin');" aria-selected="false">
                        <ion-icon stle="color:white" name="grid-outline"></ion-icon> CR Board
                    </a>
                    <?php }?>
                    <hr style="color: #eee!important;">
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
                                    <li><a target="_Blank" href="https://cdsecommercecontent.ga"
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
                                    <li><a href="action/action_logout.php"
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
            <div class="col-10 window-full overflow-auto" style="background:#f9fafb">
                <div class="tab-content" id="v-pills-tabContent" style="margin-top:15px">
                    <div class="tab-pane fade show active" id="v-pills-dashboard" role="tabpanel"
                        aria-labelledby="v-pills-dashboard-tab">
                        <div class="container" style="padding:0px 20px 0px 20px">
                            <?php echo $_GET["result"]; ?>
                            <div class="card-group">
                                <div class="card text-dark bg-light mb-3"
                                    style="max-width: 18rem;margin-top:0px;margin-right:10px;border: 1px solid #dee2e6;">
                                    <div class="card-header">Pending</div>
                                    <div class="card-body text-secondary">
                                        <div class="total_count_dashboard">
                                            <?php 
                                                $count_pending = count_status($_SESSION['username'],'pending');
                                                echo $count_pending;
                                                ?>
                                        </div>
                                        <div class="unit_count_dashboard">Ticket</div>
                                    </div>
                                </div>
                                <div class="card text-dark bg-light mb-3"
                                    style="max-width: 18rem;margin-top:0px;margin-right:10px;border: 1px solid #dee2e6;">
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
                                <div class="card text-dark bg-light mb-3"
                                    style="max-width: 18rem;margin-top:0px;margin-right:10px;border: 1px solid #dee2e6;">
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
                                <div class="card text-dark bg-light mb-3"
                                    style="max-width: 18rem;margin-top:0px;margin-right:10px;border: 1px solid #dee2e6;">
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
                                <div class="card text-white bg-dark mb-3"
                                    style="max-width: 18rem;margin-top:0px;margin-right:10px;border: 1px solid #dee2e6;">
                                    <div class="card-header">Send to traffic already</div>
                                    <div class="card-body text-secondary">
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
                            <?php include('get/get_list_job_cms_dashboard.php'); ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-request_list" role="tabpanel"
                        aria-labelledby="v-pills-request_list-tab">
                        <div class="tab-content" id="myTabContent">
                            <?php if($_GET["result"]<>""){
                                    echo $_GET["result"];
                                }
                            ?>
                            <div class="row align-items-center" style="margin:20px">
                                <div class="col-auto">
                                    <!-- <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Username</label>
                                    <select class="selection_filter" id="user_filter" onchange="filter_update();">
                                        <?php //echo $username_op;?>
                                    </select> -->

                                    <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Username</label>
                                    <input value="<?php echo $_SESSION["user_filter"];?>" class="selection_filter" list="datalistOptionsuser" id="user_filter" onchange="filter_update();" placeholder="Type to username...">
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
                                    <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Brand or ID</label>
                                    <input type="text" class="selection_filter"
                                        style="border-bottom: 1px #e0e0e0;border-style: double;" id="brand_filter"
                                        onchange="filter_update();">
                                </div>
                                <div class="col-auto">
                                    <h5>|</h5>
                                </div>
                                <div class="col-auto">
                                    <label class="mr-sm-2 sr-only" for="inlineFormInput">Page</label>
                                    <input type="number" class="selection_filter"
                                        style="width: 40px;border-bottom: 1px #e0e0e0;border-style: double;"
                                        id="pagenation_input" min=1
                                        <?php if($_SESSION["total_page_rnj"]<>""){echo "max=".$_SESSION["total_page_rnj"];}?>
                                        value="<?php echo $_SESSION["pagenation"];?>" onchange="filter_update();"
                                        placeholder="">
                                </div>
                                <div class="col-auto">
                                    <div id="total_page_nj"></div>
                                </div>
                                <!-- <div class="d-grid gap-2 d-md-flex justify-content-md-end"> -->
                                <div class="col-auto">
                                    <button class="btn btn-primary btn-sm" style="margin-left:10px" type="button"
                                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                                        aria-controls="offcanvasExample">
                                        <ion-icon size="small" name="add-outline"></ion-icon>
                                        New Request
                                    </button>
                                </div>
                                <!-- </div> -->
                                <div class="col-auto" style="right: 20px;position: absolute;margin-top: 15px;">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination pagination-sm">
                                            <div class="offcanvas offcanvas-start" style="width:90%" tabindex="-1"
                                                id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                                                <div class="offcanvas-header">
                                                    <h5 class="offcanvas-title" id="offcanvasExampleLabel"
                                                        style="padding-left:50px">
                                                        <ion-icon style="margin-right:10px" name="add-circle-outline">
                                                        </ion-icon>Request add new job
                                                    </h5>
                                                    <button type="button" class="btn-close text-reset"
                                                        data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                </div>
                                                <div class="offcanvas-body">
                                                    <div class="container-md" style="padding:0px 80px 0px 80px;">
                                                        <form class="row g-3"
                                                            action="action/action_submit_add_new_job.php" method="POST">
                                                            <div id="add_new_job_result"></div>
                                                            <?php include('form/form_request_add_new.php')?>
                                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                                <button type="submit"
                                                                    class="btn btn-dark btn-sm">Submit</button>
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
                        <div class="container-fluid" style="border-radius: 10px;width: 95%;">
                            <table class="table table-hover table-borderless  "
                                style="margin: 0px;font-size: 13px;vertical-align:middle;text-align:center;width:100%">
                                <thead style="background-color: rgba(0, 0, 0, 0);color: #908e8e;" class="fixed">
                                    <tr>
                                        <th scope="col">Ticket ID</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">SKU</th>
                                        <th scope="col">Important</th>
                                        <th scope="col">Production request</th>
                                        <th scope="col">Project-type</th>
                                        <th scope="col">Modal</th>
                                        <th scope="col">launch date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="job_list">
                                    <?php include('get/get_list_new_job.php'); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-cr" role="tabpanel" aria-labelledby="v-pills-cr-tab">
                        <div class="tab-content" id="myTabContent">
                            <div class="row align-items-center" style="margin:20px">
                                <div class="container " style="max-width: 1240px;">
                                    <?php echo $_GET["result_cr"]; ?>
                                    <div class="btn-group">
                                        <button onclick="filter_cr_ticket('Pending')" class="btn btn-secondary"
                                            aria-current="page">
                                            <ion-icon name="alert-circle-outline"></ion-icon>Pending
                                        </button>
                                        <button onclick="filter_cr_ticket('Inprogress')" class="btn btn-secondary">
                                            <ion-icon name="flash-outline"></ion-icon>Inprogress
                                        </button>
                                        <button onclick="filter_cr_ticket('Close')" class="btn btn-secondary">
                                            <ion-icon name="checkmark-done-circle-outline"></ion-icon>Fixed (Lastest 10)
                                        </button>
                                        <select class="form-select" style="width:150px" onchange="search_cr_ticket();"
                                            id="user_cr_filter" name="user_cr_filter"
                                            aria-label="Default select example">
                                            <option value="all_user">All User</option>
                                            <?php echo $username_op_cr; ?>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary " style="margin-left:10px;" type="button"
                                        data-bs-toggle="offcanvas" data-bs-target="#content_request_canvas"
                                        aria-controls="offcanvasExample">
                                        <ion-icon size="small" name="add-outline"></ion-icon>
                                        New Request
                                    </button>
                                    <div class="float-end">
                                        <input class="form-control " id="cr_search_input" onsearch="search_cr_ticket();"
                                            type="search" placeholder="Search.." aria-label="Search" spellcheck="false"
                                            data-ms-editor="true">
                                    </div>
                                    <ul class="list-group list-group shadow " style="margin-top:15px">
                                        <div id="list_grouping">
                                            <?php include('get/get_list_content_request.php'); ?>
                                        </div>
                                    </ul>
                                </div>
                                <div class="col-auto" style="right: 20px;position: absolute;margin-top: 10px;">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination pagination-sm">
                                            <div class="offcanvas offcanvas-start" style="width:70%" tabindex="-1"
                                                id="content_request_canvas" aria-labelledby="offcanvasExampleLabel">
                                                <div class="offcanvas-header">
                                                    <h5 class="offcanvas-title" id="offcanvasExampleLabel"
                                                        style="padding-left:50px">
                                                        <ion-icon style="margin-right:10px" name="add-circle-outline">
                                                        </ion-icon>Content Request
                                                    </h5>
                                                    <button type="button" class="btn-close text-reset"
                                                        data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                </div>
                                                <div class="offcanvas-body">
                                                    <div class="container-md" style="padding:0px 50px 50px 50px;">
                                                        <form class="row g-3"
                                                            action="action/action_submit_add_content_request.php"
                                                            method="POST" enctype="multipart/form-data">
                                                            <div id="add_new_cr_result"></div>
                                                            <?php include('form/form_create_content_request.php')?>
                                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                                <button type="submit" class="btn btn-primary btn-sm"
                                                                    style="width:100%">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                            </div>
                            </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-cr_admin" role="tabpanel"
                        aria-labelledby="v-pills-cr_admin-tab">
                        <div class="tab-content" id="myTabContent">
                            <div class="row align-items-center" style="padding:20px">
                                <div class="container ">
                                    <div class="row">
                                        <div class="col col-board window-full col-2" id="col_pending"
                                            ondrop="drop_card_cr(event,'Pending')" ondragover="allowDrop(event)">
                                            <small style="margin-bottom:5px"><strong>Pending</strong></small>
                                            <?php echo get_card("Pending");?>
                                        </div>
                                        <div class="col col-board window-full col-2" id="col_inprogress"
                                            ondrop="drop_card_cr(event,'Inprogress')" ondragover="allowDrop(event)">
                                            <small style="margin-bottom:5px"><strong>Inprogress</strong></small>
                                            <?php echo get_card("Inprogress");?>
                                        </div>
                                        <div class="col col-board window-full col-2" id="col_waiting_user"
                                            ondrop="drop_card_cr(event,'Waiting Buyer')" ondragover="allowDrop(event)">
                                            <small style="margin-bottom:5px"><strong>Waiting Buyer</strong></small>
                                            <?php echo get_card("Waiting Buyer");?>
                                        </div>
                                        <div class="col col-board window-full col-2" id="col_wait_excution"
                                            ondrop="drop_card_cr(event,'Waiting Excution')"
                                            ondragover="allowDrop(event)">
                                            <small style="margin-bottom:5px"><strong>Waiting Execution</strong></small>
                                            <?php echo get_card("Waiting Execution");?>
                                        </div>
                                        <div class="col col-board window-full col-2" id="col_wait_cto"
                                            ondrop="drop_card_cr(event,'Waiting CTO')" ondragover="allowDrop(event)">
                                            <small style="margin-bottom:5px"><strong>Waiting CTO</strong></small>
                                            <?php echo get_card("Waiting CTO");?>
                                        </div>
                                        <div class="col col-board window-full col-2" id="col_close_cancel"
                                            ondrop="drop_card_cr(event,'Close')" ondragover="allowDrop(event)">
                                            <small style="margin-bottom:5px"><strong>Close (latest 5)</strong></small>
                                            <?php echo get_card("Close");?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-ms_admin" role="tabpanel"
                        aria-labelledby="v-pills-ms_admin-tab">
                        <div class="tab-content" id="myTabContent">
                            <div class="row align-items-center" style="padding:20px">
                                <!-- <div class="container ">
                                    
                                </div> -->
                                <div class="container-fluid" style="border-radius: 10px;width: 95%;">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="list-group" id="list-tab" role="tablist">
                                                 <?php if(strpos($_SESSION["department"],'Content Admin')!==false){?>
                                                <a class="btn btn-dark" style="margin-bottom: 10px;" type="button"
                                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop"
                                                    aria-controls="offcanvasWithBackdrop">
                                                    <ion-icon name="add-outline"></ion-icon>Create
                                                </a>
                                                <?php } ?>
                                                <a class="list-group-item list-group-item-action active"
                                                    id="list-important-list" data-bs-toggle="list"
                                                    href="#list-important" role="tab" aria-controls="list-important">
                                                    <ion-icon name="star-outline"></ion-icon> Important <span id="total_unread_div_in"></span>
                                                </a>
                                                <a class="list-group-item list-group-item-action" id="list-update-list"
                                                    data-bs-toggle="list" href="#list-update" role="tab"
                                                    aria-controls="list-update">
                                                    <ion-icon name="notifications-outline"></ion-icon> Updated
                                                </a>
                                                <a class="list-group-item list-group-item-action" id="list-send-list"
                                                    data-bs-toggle="list" href="#list-send" role="tab"
                                                    aria-controls="list-send">
                                                    <ion-icon name="paper-plane-outline"></ion-icon> Send 
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-10">
                                            <div class="tab-content" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="list-important"
                                                    role="tabpanel" aria-labelledby="list-important-list">
                                                    <table class="table table-hover table-borderless  "
                                                        style="margin: 0px;font-size: 13px;vertical-align:middle;text-align:center;width:100%">
                                                        <thead
                                                            style="background-color: rgba(0, 0, 0, 0);color: #908e8e;"
                                                            class="fixed">
                                                            <tr>
                                                                <th scope="col">Important</th>
                                                                <th scope="col">Message ID</th>
                                                                <th scope="col">title</th>
                                                                <th scope="col">check</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="">
                                                            <?php include('get/get_list_message.php'); ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="tab-pane fade" id="list-update" role="tabpanel"
                                                    aria-labelledby="list-update-list">
                                                    <?php include('get/get_list_message_log.php'); ?>
                                                </div>
                                                <div class="tab-pane fade" id="list-send" role="tabpanel"
                                                    aria-labelledby="list-send-list">
                                                    <table class="table table-hover table-borderless  "
                                                        style="margin: 0px;font-size: 13px;vertical-align:middle;text-align:center;width:100%">
                                                        <thead
                                                            style="background-color: rgba(0, 0, 0, 0);color: #908e8e;"
                                                            class="fixed">
                                                            <tr>
                                                                <th scope="col">Important</th>
                                                                <th scope="col">Message ID</th>
                                                                <th scope="col">title</th>
                                                                <th scope="col">check</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="">
                                                            <?php include('get/get_list_send_message.php'); ?>
                                                        </tbody>
                                                    </table>
                                                    <!-- Modal -->
                                                  
                                                </div>


                                            </div>
                                        </div>
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                                            <div class="offcanvas offcanvas-start" style="width: 80%;" tabindex="-1"
                                                id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel">
                                                <div class="offcanvas-header">
                                                    <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">Message
                                                        box
                                                    </h5>
                                                    <button type="button" class="btn-close text-reset"
                                                        data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                </div>
                                                <div class="offcanvas-body">
                                                    <form class="row g-3" action="action/action_submit_add_message.php"
                                                        method="POST" enctype="multipart/form-data">
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="form-label">To
                                                                user</label>
                                                            <input type="text" multiple class="form-control"
                                                                list="datalistOptions" id="ms_target" name="ms_target"
                                                                placeholder="Type to search...">
                                                            <datalist id="ms_target">
                                                                <option value="@everyone">everyone in content-service
                                                                    gate</option>
                                                                <?php echo $username_op;?>
                                                            </datalist>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label">Title</label>
                                                            <input type="text" class="form-control" id="ms_title"
                                                                name="ms_title" placeholder="">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlTextarea1"
                                                                class="form-label">Detail</label>
                                                            <textarea class="form-control" id="ms_description"
                                                                name="ms_description" rows="5"></textarea>

                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlTextarea1"
                                                                class="form-label">Multi file input</label>
                                                            <input class="form-control form-control-sm" type="file"
                                                                id="ms_attachment" name="ms_attachment[]"
                                                                multiple="multiple">
                                                            <small>ขนาดไฟล์ต้องไม่เกิน 2MB</small>

                                                        </div>

                                                        <button type="submit" class="btn btn-primary btn-sm"
                                                            style="width:100%">Submit</button>

                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- offcanvas detail cr -->
                    <div class="offcanvas offcanvas-start overflow-auto" tabindex="-1" id="detail_cr" style="width:100%"
                        aria-labelledby="offcanvasExampleLabel">
                        <div id="calloffcanvas_cr">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
    <script>
$(function() {
    $(".multiple-select").multipleSelect()
});
    </script>
    <!-- bootsrap js -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <!-- end bootsrap js -->
    <script>
function call_edit_add_new_modal(id, brand) {
    if (id) {
        $.post("modal/edit_request_add_new.php", {
            id: id
        }, function(data) {
            $('#callmodal_request_add_new').html(data);
        });
    }
}

function cr_id_toggle(id) {
    if (id) {
        $.post("get/get_content_request_detail.php", {
            id: id
        }, function(data) {
            $('#calloffcanvas_cr').html(data);
        });
    }
}

function start_checking(id) {
    ;
    if (id) {
        $.post("action/action_start_checking.php", {
            id: id
        }, function(data) {
            $('#start_checking_resault').html(data);
        });
    }
}

function accepted_stt(id,) {
    if (id) {
        sku_accepted = document.getElementById('sku_accepted').value;
        $.post("action/action_accept_stt.php", {
            id: id,
            sku_accepted:sku_accepted
        }, function(data) {
            $('#accept_checking_resault').html(data);
        });
    }
}

function cancel_stt(id) {
    if (id) {
        resone_cancel = document.getElementById('resone_cancel').value;
        $.post("action/action_cancel_stt.php", {
            id: id,
            resone_cancel: resone_cancel
        }, function(data) {
            $('#cancel_checking_resault').html(data);
        });
    }
}

function filter_cr_ticket(status) {
    document.getElementById('cr_search_input').value = '';
    var update = true;
    if (status) {
        $.post("get/get_list_content_request.php", {
            status: status,
            update: update
        }, function(data) {
            $('#list_grouping').html(data);
        });
    }
}

function search_cr_ticket() {
    var cr_search_input = document.getElementById("cr_search_input").value
    var user_cr_filter = document.getElementById("user_cr_filter").value
    // if (cr_search_input) {
    $.post("get/get_list_content_request.php", {
        cr_search_input: cr_search_input,
        user_cr_filter: user_cr_filter
    }, function(data) {
        $('#list_grouping').html(data);
    });
}
    </script>
    <script type="text/javascript">
function select_current_tab(selecttab) {
    if (selecttab == "v-pills-dashboard") {
        document
            .getElementById("v-pills-dashboard-tab")
            .classList
            .add('active');
        document
            .getElementById("v-pills-request_list-tab")
            .classList
            .remove('active');
        document
            .getElementById("v-pills-cr-tab")
            .classList
            .remove('active');
        document
            .getElementById("v-pills-dashboard")
            .classList
            .add('active');
        document
            .getElementById("v-pills-request_list")
            .classList
            .remove('active');
        document
            .getElementById("v-pills-cr")
            .classList
            .remove('active');
        document
            .getElementById("v-pills-dashboard")
            .classList
            .add('show');
        document
            .getElementById("v-pills-request_list")
            .classList
            .remove('show');
        document
            .getElementById("v-pills-cr")
            .classList
            .remove('show');
    } else if (selecttab == "v-pills-request_list") {
        document
            .getElementById("v-pills-dashboard-tab")
            .classList
            .remove('active');
        document
            .getElementById("v-pills-cr-tab")
            .classList
            .remove('active');
        document
            .getElementById("v-pills-request_list-tab")
            .classList
            .add('active');
        document
            .getElementById("v-pills-dashboard")
            .classList
            .remove('active');
        document
            .getElementById("v-pills-cr")
            .classList
            .remove('active');
        document
            .getElementById("v-pills-request_list")
            .classList
            .add('active');
        document
            .getElementById("v-pills-dashboard")
            .classList
            .remove('show');
        document
            .getElementById("v-pills-cr")
            .classList
            .remove('show');
        document
            .getElementById("v-pills-request_list")
            .classList
            .add('show');
    } else if (selecttab == "v-pills-cr") {
        document
            .getElementById("v-pills-dashboard-tab")
            .classList
            .remove('active');
        document
            .getElementById("v-pills-cr-tab")
            .classList
            .add('active');
        document
            .getElementById("v-pills-request_list-tab")
            .classList
            .remove('active');
        document
            .getElementById("v-pills-dashboard")
            .classList
            .remove('active');
        document
            .getElementById("v-pills-cr")
            .classList
            .add('active');
        document
            .getElementById("v-pills-request_list")
            .classList
            .remove('active');
        document
            .getElementById("v-pills-dashboard")
            .classList
            .remove('show');
        document
            .getElementById("v-pills-cr")
            .classList
            .add('show');
        document
            .getElementById("v-pills-request_list")
            .classList
            .remove('show');
    }
}

function open_ticket_detail(id) {
    document.getElementById("ns_ticket_" + id).click();
}

function updateURL(pill) {
    if (history.pushState) {
        var newurl = window.location.protocol + "//" + window.location.host +
            window.location.pathname + '?tab=' + pill;
        window
            .history
            .pushState({
                path: newurl
            }, '', newurl);
    }
}

function filter_update(be) {
    var user_filter = document.getElementById("user_filter").value
    var status_filter = document.getElementById("status_filter").value
    var pagenation_input = document.getElementById("pagenation_input").value
    var brand_filter = document.getElementById("brand_filter").value
    var from_post = true;
    if (from_post) {
        $.post("get/get_list_new_job.php", {
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
        $.post("get/get_total_page_nj.php", {
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
    <?php 
                $tab_select = $_GET["tab"];
                echo '<script>select_current_tab("'.$tab_select.'");</script>';
                ?>
    <script>
var elements = document.getElementsByClassName('window-full');
var windowheight = window.innerHeight + "px";
fullheight(elements);

function fullheight(elements) {
    for (let el in elements) {
        if (elements.hasOwnProperty(el)) {
            elements[el].style.height = windowheight;
        }
    }
}
window.onresize = function(event) {
    fullheight(elements);
}
    </script>
    <script>
function Inint_AJAX() {
    try {
        return new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {}
    try {
        return new ActiveXObject("Microsoft.XMLHTTP");
    } catch (e) {}
    try {
        return new XMLHttpRequest();
    } catch (e) {}
    alert("XMLHttpRequest not supported")
    return null
}

function doAutoRefresh() {
    var req = Inint_AJAX();
    //var req_cr = Inint_AJAX();
    // Ajax ส่งค่าไปสอบถามเวลาจาก Server ที่ไฟล์ time.php
    req.open("POST", 'get/get_list_new_job.php?' + new Date().getTime(), true);
    //req_cr.open("POST", 'get/get_list_content_request.php?' + new Date().getTime(), true);
    // กำหนด ฟังก์ชั่นเพื่อส่งค่ากลับ
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            if (req.status == 200) {
                // รับค่ากลับมา และ แสดงผล
                //document.getElementById("list_grouping").innerHTML = req_cr.responseText;
                document.getElementById("job_list").innerHTML = req.responseText;
                // Auto Refresh กลับมาอ่าน เวลาทุก 30 วินาที สำหรับรอบต่อไป
                setTimeout("doAutoRefresh()", 3000);
            }
        }
    };
    req.send(null);
};

function doAutoRefresh_cr() {
    var req_cr = Inint_AJAX();
    // Ajax ส่งค่าไปสอบถามเวลาจาก Server ที่ไฟล์ time.php
    req_cr.open("POST", 'get/get_list_content_request.php?' + new Date().getTime(), true);
    // กำหนด ฟังก์ชั่นเพื่อส่งค่ากลับ
    req_cr.onreadystatechange = function() {
        if (req_cr.readyState == 4) {
            if (req_cr.status == 200) {
                // รับค่ากลับมา และ แสดงผล
                document.getElementById("list_grouping").innerHTML = req_cr.responseText;
                setTimeout("doAutoRefresh_cr()", 7000);
            }
        }
    };
    req_cr.send(null);
};
    </script>
    <script>
$(document).ready(function() {
    $("#search_job").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#upload_list tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
    </script>
    <script>
tinymce.init({
    selector: 'textarea#cr_description',
    height: 380,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
    //content_style: 'body { font-family: Prompt, sans-serif; font-size:14px }'
});
    </script>
    <script>
tinymce.init({
    selector: 'textarea#ms_description',
    height: 380,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
    //content_style: 'body { font-family: Prompt, sans-serif; font-size:14px }'
});
    </script>
    <script>
function allowDrop(ev) {
    ev.preventDefault();
}

function drag_card_cr(ev) {
    ev.dataTransfer.setData("card", ev.target.id);
}

function drop_card_cr(ev, new_status) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("card");
    var id_card = document.getElementById(data).id;
    var id_ticket = id_card.substring(8);
    ev.target.appendChild(document.getElementById(data));
    //update status
    var id_name = "status";
    var id = id_ticket;
    var value_change = new_status;
    if (id) {
        $.post("action/action_update_cr_detail.php", {
                id: id,
                value_change: value_change,
                id_name: id_name
            },
            function(data) {
                alert(data);
                // $('#call_update_complete').html(data);
                // document.getElementById('comment_box_cr').scrollBy(0, document.getElementById("call_ticket_comment_cr").offsetHeight);
            });
    }
}
    </script>

    </html>
    <?php if( $_GET["fopenticket"]<>""){
    $_SESSION["fopenticket"]=$_GET["fopenticket"];
    echo '<script>open_ticket_detail('.$_GET["fopenticket"].');</script>';
    }} ?>