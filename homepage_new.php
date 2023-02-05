<?php
session_start();
function bg_dept($department){
    switch ($department) {
      case "Content Followup": $bg = '336BFF'; break;
      case "Content Traffic": $bg = '33FF39'; break;
      case "Content Admin": $bg = '9633FF'; break;
      case "Content Other": $bg = 'FF3333'; break;
      case "Content Studio Traffic": $bg = '33FFB5'; break;
      case "Buyer  Home": $bg = 'FFDA33'; break;
      case "Buyer Beauty": $bg = 'FF7AD9'; break;
      case "Buyer Mom and Kids": $bg = 'FFC17A'; break;
      case "Buyer Fashion": $bg = 'FF7A7A'; break;
      case "Operation": $bg = '000000'; break;
      case "Marketing": $bg = '474747'; break;
      case "Other": $bg = 'ADADAD'; break;
      case "Brand": $bg = '6E69E7'; break;
      default: $bg = '000000';
    }
    return $bg;
}

if (!$_SESSION["login_csg"]){
            Header("Location: login");
    }else{
        if($_SESSION['verify_code']=="verified"){
            echo '<script>console.log("account verified")</script>';
        }else{
            Header("Location: https://content-service-gate.cdse-commercecontent.com/verify?work_email=".$_SESSION['work_email']);
        }
    include_once('get/get_option_function.php');
        $username_op = getoption_return_filter("username","account",$_SESSION["user_filter"],"single","all_in_one_project");
        $username_op_cr = getoption_return_filter("username","account",$_SESSION["user_cr_filter"],"single","all_in_one_project");
        $request_for_op = get_option_return_filter("ticket_type","","single","content_request");
        $request_new_status_op = get_option_return_filter("status",$_SESSION["status_filter"],"single","add_new");
        $request_cr_status_op = get_option_return_filter("status","","single","content_request");
        $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $query = "SELECT * FROM all_in_one_project.account where username = '".$_SESSION['username']."' ORDER BY id DESC " or die("Error:" . mysqli_error($con));
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
<!doctype html>
<html lang="en">

<head>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <!-- push notification -->
    <!-- <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
    window.OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
        OneSignal.init({
        appId: "11dbc065-ce6a-4a28-b097-1fe73fa8669c",
        });
    });
    </script> -->
    <!-- push notification -->
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SG | Service gate</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link rel="icon" type="image/ocp" href="https://cdse-commercecontent.com/base/images/24ico.ico" /> -->
    <link rel="icon" type="image/ocp"
        href="https://content-service-gate.cdse-commercecontent.com/base/image/sg_logo_minimize.ico" />
    <!-- textarray -->
    <script src="https://cdn.tiny.cloud/1/cis8560ji58crrbq17zb11gp39qhpn2lka54u0m54s8du1gw/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <!-- return to top -->
    <!-- <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet"> -->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="base/action/notiflix/dist/notiflix-3.2.5.min.css" />
    <script src="base/action/notiflix/dist/notiflix-3.2.5.min.js"></script>
    <link rel="stylesheet" type="text/css" href="base/css-theam/light-new.css">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <!-- multi-select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.27.1/slimselect.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.27.1/slimselect.min.css" rel="stylesheet">
    <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
    <!-- file upload -->
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <!-- textarray -->
    <link href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css" rel="stylesheet">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <!-- preview image -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.css"
        integrity="sha512-3eoKq7cU6gdVeT+6eL40YcJLD8dxzQmOK54qxUWVjg7H4NN3u5AA5k5ywrqLV15hOZDBBgdQH/GK5CA9MwDVwg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.js"
        integrity="sha512-FbW9TrdqAZVgIOrQeqDRnCe+l0g+aMBP7pWEt/zLWx8zgafpBwvJ6F1rsU+mkvbXuB4mBwS2ehlkZHE9cknTrg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" type="text/css"
        href="https://content-service-gate.cdse-commercecontent.com/base/css-theam/tree-ticket.css">
    <!-- time ago -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/timeago.js/2.0.2/timeago.js"
        integrity="sha512-N3oYWQZs8pMSQhQtB13XHSIry/zDIUimpMqX4QMULawuaAYgRWSiU17cLHh7f51xgkGY18jQtY2ph98HtKeWaA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- js editor go -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/checklist@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/table@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/warning@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/paragraph@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/code@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/nested-list@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/editorjs-alert@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/delimiter@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/marker@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/underline@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/attaches@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/editorjs-style@latest"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@editorjs/inline-code@latest"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/image@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@calumk/editorjs-columns@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/editorjs-text-alignment-blocktune@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/editorjs-paragraph-with-alignment@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/editorjs-drag-drop@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@calumk/editorjs-nested-checklist@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/link@latest"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js">
    </script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <!-- Cookie Consent -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@v2.8.6/dist/cookieconsent.css"
        media="print" onload="this.media='all'">
    <script defer src="https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@v2.8.6/dist/cookieconsent.js"></script>
    <!-- body content ... -->
    <script defer src="base/js/cookieconsent-init.js"></script>
    <!-- subsc -->
    <!-- <script async custom-element="amp-web-push" src="https://cdn.ampproject.org/v0/amp-web-push-0.1.js"></script>

    <script async src="https://cdn.ampproject.org/v0.js"></script>

    <meta name="viewport" content="width=device-width">

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async src="https://cdn.ampproject.org/v0.js"></script> -->
    <!-- subsc -->

    <!-- preferance -->

    <?php

function get_value_main($crid,$col_re,$db,$table,$primary_key_id){
    $con_cr= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con_cr));
    mysqli_query($con_cr, "SET NAMES 'utf8' ");
    $query_cr = "SELECT * FROM ".$db.".".$table." where ".$primary_key_id." = '".$crid."' ORDER BY id DESC" or die("Error:" . mysqli_error($con_cr));
    $result_cr = mysqli_query($con_cr, $query_cr);
    while($row_cr = mysqli_fetch_array($result_cr)) {

                $current_cr = $row_cr[$col_re];

    }
    mysqli_close($con_cr);
    return $current_cr;
}

// $verify_code = get_value_main($_SESSION['username'], "verify_code", "all_in_one_project", "account", "username");

?>
    <style>
    .nav-link-preferance {
        color: <?php echo get_value_main($_SESSION['username'], "menu_front_color", "all_in_one_project", "account", "username");
        ?>;
    }

    .nav_list_bra-preferance {
        background: <?php echo get_value_main($_SESSION['username'], "menu_shade", "all_in_one_project", "account", "username");
        ?>;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: <?php echo get_value_main($_SESSION['username'], "primary_front_button_selected", "all_in_one_project", "account", "username");
        ?>;
        border: solid 1px <?php echo get_value_main($_SESSION['username'], "primary_border_button_slected", "all_in_one_project", "account", "username");
        ?>;
    }

    .nav-pills .nav-link {
        color: <?php echo get_value_main($_SESSION['username'], "menu_front_color", "all_in_one_project", "account", "username");
        ?>;
    }
    </style>

</head>

<body>
    <!-- <button class="js-push-btn" style="display: none;">
        Subscribe Push Messaging
</button> -->
      <!-- nav here -->
      <!-- <nav class="navbar sticky-top navbar-danger bg-danger" style="place-content: center;"> -->
                <!-- <marquee> -->
                    <!-- <span class="navbar-text" style="color:white;font-size: 16px;">
                            เปิดรับ Ticket สร้างสินค้าใหม่ขึ้นบนเว็บไซต์ จนถึง<strong>วันพุธที่ 14 ธันวาคม 2565</strong> หากเปิด Ticket มาหลังวันที่ดังกล่าว จะเริ่มดำเนินการในวันที่ 3 มกราคม 2566 เป็นต้นไป
                    </span> -->
                <!-- </marquee> -->
                <!-- </nav> -->

        <!-- nav here -->

    <div class="offcanvas offcanvas-start" style="width:70%" tabindex="-1" id="content_request_canvas"
        aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header" style="background: #313131;color: white;">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel" style="padding-left:50px;font-weight: bold;">
                <ion-icon style="margin-right:10px" name="add-circle-outline">
                </ion-icon>Request Creation
            </h5>
            <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" style="background-color: #fcfbf9;">
            <div class="container-md" style="padding:0px 50px 50px 50px;">
                <form class="row g-3">
                    <div id="add_new_cr_result">
                    </div>
                    <?php include_once('form/form_create_content_request_new.php')?>
                </form>
            </div>
        </div>
    </div>
    <div class="row" style="--bs-gutter-x: 0rem;">
        <div class="col-2 list_bra">
            <div class="nav nav-pills nav_list_bra nav_list_bra-preferance border-end" id="v-pills-tab" role="tablist"
                aria-orientation="vertical">

                <input type="hidden" id="minimize_menu" name="minimize_menu" value="show">
                <input type="hidden" id="active_sub_menu" name="active_sub_menu" value="hide">
                <a class="navbar-brand" href="#">
                    <!-- <img id="logo" class="logo" src="base/image/tms_logo_va.svg" alt="" width="auto"
                        height="30">-->

                    <img id="logo_minimize" class="logo_minimize hide" src="base/image/sg_logo_minimize.ico"
                        alt="" width="auto" height="30">

                    <h5 id="logo" class="logo fw-bold m-0" style="position: absolute;">ServiceGate</h5>
                    <!-- <h5 id="logo_minimize" class="fw-bold logo_minimize hide" >SG</h5> -->
                    <!-- <h3 id="apps_name" style="font-weight: lighter;color: firebrick;"> -->
                    <!-- <ion-icon name="layers" style="font-size: 40px;margin: 0px;color:#f85d60"></ion-icon> -->
                    <!-- TEMS -->
                    <br><small id="apps_name" style="font-size: small;
                        font-weight: 100;
                        color: gray;">Task management system
                    </small>
                    <!-- </h3> -->

                </a>
                <!-- <hr class="hr_menu_bra">
                <div class="img-avatar" style="display: inline-flex;">
                    <img src="https://ui-avatars.com/api/?name=<?php echo $_SESSION['firstname'].'+'.$_SESSION['lastname']; ?>&background=<?php echo bg_dept($_SESSION['department']); ?>&color=fff&rounded=true&size=40"
                        class="ms-3 mb-3">
                    <div style="align-self: center;" class="mb-3">
                        <span class="name_menu_bra"
                            style="place-self: center;"><?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']; ?></span><br>
                        <small class="dept_menu_bra"
                            style="place-self: center;"><?php echo $_SESSION['department']; ?></small>
                    </div>
                </div> -->
                <hr class="hr_menu_bra">
                <small class="header_menu_bra">Form create new product</small>
                <?php include("get/linesheet_download_alert_bra.php"); ?>
                <hr class="hr_menu_bra">
                <small class="header_menu_bra">menu</small>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <a class="nav-link nav-link-preferance" id="nav_activity" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRightactivity" aria-controls="offcanvasRight"
                        onclick="get_list_update_job();show_sub_menu('activity');">
                        <ion-icon name="notifications"></ion-icon><span class="main-menu-nav">Activity</span>
                        <div id="get_count_nt_unread">
                            <?php include('get/get_count_nt_unread.php'); ?>
                        </div>
                    </a>
                    <li class="nav-item" role="presentation">
                        <a class="main_bra nav-link nav-link-preferance active" data-bs-toggle="pill" type="button"
                            role="tab" aria-selected="false" id="nav_dashboard" onclick="get_page('dashboard');">
                            <ion-icon name="home"></ion-icon><span class="main-menu-nav">Home</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="main_bra nav-link nav-link-preferance" id="nav_create_new" data-bs-toggle="pill"
                            type="button" role="tab" aria-selected="false" onclick="get_page('create_new');">
                            <ion-icon name="rocket"></ion-icon><span class="main-menu-nav">New Products</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="main_bra nav-link nav-link-preferance" id="nav_update_content" data-bs-toggle="pill"
                            type="button" role="tab" aria-selected="false" onclick="get_page('update_content');">
                            <ion-icon name="ticket"></ion-icon><span class="main-menu-nav">Update Content</span>
                        </a>
                    </li>
                    <?php if(strpos($_SESSION["permission"],'ps_internal')!==false){
                ?>
                    <!-- <hr class="hr_menu_bra_in">
                    <small class="header_menu_bra">Production</small> -->

                    <!-- <li class="nav-item" role="presentation">
                        <a class="main_bra nav-link nav-link-preferance" id="nav_job_manage" data-bs-toggle="pill"
                            type="button" role="tab" aria-selected="false" onclick="get_page('job_manage');">
                            <ion-icon name="file-tray-stacked"></ion-icon><span class="main-menu-nav">24EP </span>
                        </a>
                    </li> -->

                    <!--
                    <li class="nav-item" role="presentation">
                        <a class="main_bra nav-link nav-link-preferance" id="nav_job_on_hand" data-bs-toggle="pill" type="button" role="tab"
                            aria-selected="false" onclick="get_page('job_on_hand');">
                            <ion-icon name="receipt"></ion-icon><span class="main-menu-nav">Job on hand</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="main_bra nav-link nav-link-preferance" id="nav_linesheet" data-bs-toggle="pill" type="button" role="tab"
                            aria-selected="false" onclick="get_page('linesheet');">
                            <ion-icon name="cloud-upload"></ion-icon><span class="main-menu-nav">Linesheet</span>
                        </a>
                    </li> -->
                    <hr class="hr_menu_bra_in">
                    <small class="header_menu_bra">Internals</small>
                    <li class="nav-item" role="presentation">
                        <a class="main_bra nav-link nav-link-preferance" id="nav_job_on_hand" data-bs-toggle="pill"
                            type="button" role="tab" aria-selected="false" onclick="get_page('job_on_hand');">
                            <ion-icon name="grid"></ion-icon><span class="main-menu-nav">Job On Hand</span>
                        </a>
                    </li>
                    <li class="nav-item btn-group dropend" role="presentation">
                        <a class="main_bra nav-link nav-link-preferance" id="nav_product_mantain" type="button"
                            onclick="show_sub_menu('product_maintain');">
                            <ion-icon name="storefront"></ion-icon><span class="main-menu-nav">CMS</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item" role="presentation">
                        <a class="main_bra nav-link nav-link-preferance" id="nav_report" data-bs-toggle="pill"
                            type="button" role="tab" aria-selected="false" onclick="get_page('report');">
                            <ion-icon name="bar-chart"></ion-icon><span class="main-menu-nav">Reports</span>
                        </a>
                    </li> -->

                    <li class="nav-item" role="presentation">
                        <a class="main_bra nav-link nav-link-preferance" id="nav_configurable" data-bs-toggle="pill"
                            type="button" role="tab" aria-selected="false" onclick="get_page('configurable');">
                            <ion-icon name="terminal"></ion-icon><span class="main-menu-nav">Configuration</span>
                        </a>
                    </li>

                    <li class="nav-item btn-group dropend" role="presentation">
                        <a class="main_bra nav-link nav-link-preferance" id="nav_quicklink" type="button"
                            onclick="show_sub_menu('quicklink');">
                            <ion-icon name="globe"></ion-icon><span class="main-menu-nav">Quick-link</span>
                        </a>
                    </li>
                    <?php } ?>
                    <hr class="hr_menu_bra_in">
                    <small class="header_menu_bra">Others</small>
                    <li class="nav-item" role="presentation">
                        <a class="main_bra nav-link nav-link-preferance" id="nav_setting" onclick="get_page('setting');"
                            data-bs-toggle="pill" type="button" role="tab" aria-selected="false">
                            <ion-icon name="settings"></ion-icon><span class="main-menu-nav">Settings</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="main_bra nav-link nav-link-preferance" id="nav_logout" data-bs-toggle="pill"
                            type="button" role="tab" aria-selected="false" onclick="logout()">
                            <ion-icon name="log-out"></ion-icon><span class="main-menu-nav">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-2 shadow sub_menu hide p-0 bg-white bg-gradient border-end" id="sub_menu"
            style="margin-left: inherit;">
        </div>
        <div class="col-10 col_detail_main" style="font-size: 14px;padding: 0px;margin-left: inherit;">
            <button type="button" id="bt_nav_coll_ex" onclick="minimize_nav();"
                class="position-absolute top-1_5 translate-middle btn btn-sm btn-secondary  bg-gradient shadow rounded-pill"
                style="width: 2rem; height:2rem;padding: 0px;z-index: 1;top: 95px!important;position:fixed!important">
                <!-- <ion-icon name="menu-outline" style="margin:0px"></ion-icon> -->
            </button>
            <?php

            $database = 'all_in_one_project';
            $table = 'account';
            $primary_key_id = 'username';
            $id=$_SESSION['username'];
            $prefix_table = 'ac';
            $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));

                $query = "SELECT  * FROM ".$database.".".$table." where ".$primary_key_id." = '".$id."'" or die("Error:" . mysqli_error($con));
                $result = mysqli_query($con, $query);
                while($row = mysqli_fetch_array($result)) {
                    $query_column = "SELECT `COLUMN_NAME`
                    FROM `INFORMATION_SCHEMA`.`COLUMNS`
                    WHERE `TABLE_SCHEMA`='".$database."'
                        AND `TABLE_NAME`='".$table."'" or die("Error:" . mysqli_error($con));
                    $result_column = mysqli_query($con, $query_column);
                    while($row_column = mysqli_fetch_array($result_column)) {
                        ${$prefix_table."_".$row_column['COLUMN_NAME']} = $row[$row_column['COLUMN_NAME']];
                    }
                }
            ?>
            <nav class="p-3 bg-white shadow-sm border-bottom sticky-top">
                <div class="container-fluid d-flex" style="align-items: center;height: 40px;">
                    <img
                        src="https://ui-avatars.com/api/?name=<?php echo $ac_firstname.'+'.$ac_lastname; ?>&background=<?php echo bg_dept($ac_department); ?>&color=fff&rounded=true&size=30">
                    <a class="navbar-brand ms-1" style="" href="#"><?php echo $ac_firstname." ".$ac_lastname; ?></a>
                    <small href="#"><?php echo $ac_department; ?> | <?php echo $ac_role; ?></small>
                    <ion-icon type="button" class="btn btn-outline-dark border-0 btn-sm" data-bs-toggle="modal"
                        data-bs-target="#exampleModal" onclick="call_model_edit_account('<?php echo $ac_username; ?>')"
                        name="open-outline">
                    </ion-icon>
                    <div class="dropdown">
                        <input type=search class="form-control form-control-sm rounded-pill" id="input_search"
                            onchange="search()" data-bs-auto-close="outside" data-bs-toggle="dropdown"
                            aria-expanded="false" style="inline-size: unset;width: 300px;" type="text"
                            placeholder="Search .. " aria-label=".form-control-sm example">
                        <form class="dropdown-menu p-4" style="width:500px">
                            <span id="search_input" class="bg-light text-secondary p-1 ps-2 pn-2 rounded "></span>
                            <hr>
                            <div id="search_result">

                            </div>
                        </form>
                    </div>
                </div>
            </nav>
            <div id="col_detail">
            </div>
        </div>
    </div>
    <!-- </div> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>
<script>
function updateparams(key, value) {
    // Construct URLSearchParams object instance from current URL querystring.
    var queryParams = new URLSearchParams(window.location.search);
    // Set new or modify existing parameter value.
    if (value == "") {
        queryParams.delete(key);
    } else {
        queryParams.set(key, value);
    }
    // Replace current querystring with the new one.
    history.replaceState(null, null, "?" + queryParams.toString());
}

function get_page(page) {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var brand_filter = urlParams.get('brand_filter');
    var user_filter = urlParams.get('user_filter');
    updateparams('page', page);
    // if (page ===true ) {
    Notiflix.Loading.hourglass('Loading...');
    $.post("base/page/" + page + ".php", {
        brand_filter: brand_filter,
        user_filter: user_filter
    }, function(data) {
        $('#col_detail').html(data);
        Notiflix.Loading.remove();
    });
}
function get_attribute_config(target_tb,target_db,target_prefix) {
    Notiflix.Loading.hourglass('Loading...');
    $.post("base/page/attribute_config.php", {
        target_tb:target_tb,
        target_db:target_db,
        target_prefix:target_prefix
    }, function(data) {
        $('#col_detail').html(data);
        Notiflix.Loading.remove();
    });
}
//check for page param then goto the page
var queryString = window.location.search;
var urlParams = new URLSearchParams(queryString);
console.log(queryString);
if (urlParams.has('page') && urlParams.get('page') != null) {
    document.getElementById('nav_' + urlParams.get('page')).click();
    get_page(urlParams.get('page'));
    var url = new URL(window.location.href);
    // url.searchParams.set('page', urlParams.get('page'));
} else {
    document.getElementById('nav_dashboard').click();
    get_page('dashboard');
    // url.searchParams.set('page', 'dashboard');
}

function update_readed_nt() {
    $.post("base/action/action_update_read_nt.php", {}, function(data) {
        // $('#project_bucket').html(data);
    });
}

function get_count_read_nt() {
    $.post("base/get/get_count_nt_unread.php", {}, function(data) {
        $('#get_count_nt_unread').html(data);
    });
}

function get_list_update_job() {
    $.post("base/get/get_list_job_update.php", {}, function(data) {
        $('#get_list_job_update').html(data);
        timeago().render(document.querySelectorAll('.timeago'));
        update_readed_nt();
        get_count_read_nt();
    });
}

function logout() {
    Notiflix.Confirm.show(
        'Confirm ',
        'Do you want to logout ?',
        'Yes ',
        'No ',
        function okCb() {
            window.location.href = "base/action/action_logout.php";
        },
        function cancelCb() {
            //nothing to do
        },
    );
}
</script>
<script>
</script>
<script type="text/javascript">
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
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>
<script>
document.getElementById("bt_nav_coll_ex").innerHTML =
    '<ion-icon name="chevron-back-outline" style="margin:0px;color:white"></ion-icon>';

function show_sub_menu(sub_menu) {
    if (sub_menu != 'close') {
        //get_sub_menu
        if (sub_menu == 'activity') {
            $.post("base/get/get_sub_menu_activity.php", {}, function(data) {
                $('#sub_menu').html(data);
            });
        } else if (sub_menu == 'product_maintain') {
            $.post("base/get/get_sub_menu_product_maintain.php", {}, function(data) {
                $('#sub_menu').html(data);
            });
        } else if (sub_menu == 'quicklink') {
            $.post("base/get/get_sub_menu_quicklink.php", {}, function(data) {
                $('#sub_menu').html(data);
            });
        }
        //hideshow

        var sub_menu = document.getElementsByClassName("sub_menu");
        var col_detail_main = document.getElementsByClassName("col_detail_main");
        for (var i = 0; i < sub_menu.length; i++) {
            sub_menu[i].className = sub_menu[i].className.replace(/(?:^|\s)hide(?!\S)/g, '');
        }
        for (var i = 0; i < col_detail_main.length; i++) {
            col_detail_main[i].className = col_detail_main[i].className.replace(/(?:^|\s)col-10(?!\S)/g, 'col-8');
        }
    } else {
        var col_detail_main = document.getElementsByClassName("col_detail_main");
        var sub_menu = document.getElementsByClassName("sub_menu");
        for (var i = 0; i < sub_menu.length; i++) {
            sub_menu[i].className += " hide";
        }
        for (var i = 0; i < col_detail_main.length; i++) {
            col_detail_main[i].className = col_detail_main[i].className.replace(/(?:^|\s)col-8(?!\S)/g, 'col-10');
        }
    }
}

function minimize_nav() {
    var minimize_menu = document.getElementById('minimize_menu').value;
    console.log(minimize_menu);
    if (minimize_menu == 'hide') {
        document.getElementById('minimize_menu').value = 'show';
        document.getElementById("bt_nav_coll_ex").innerHTML =
            '<ion-icon name="chevron-back-outline" style="margin:0px;color:white"></ion-icon>';
        var list_bra = document.getElementsByClassName("mini-nav-col");
        for (var i = 0; i < list_bra.length; i++) {
            list_bra[i].className = list_bra[i].className.replace(/(?:^|\s)mini-nav-col(?!\S)/g, '');
        }
        document.getElementById("apps_name").className = document.getElementById("apps_name").className.replace(
            /(?:^|\s)hide(?!\S)/g, '');
        document.getElementById("logo").className = document.getElementById("logo").className.replace(
            /(?:^|\s)hide(?!\S)/g, '');
        document.getElementById("logo_minimize").className += " hide";
        var img_avatar = document.getElementsByClassName("img-avatar");
        for (var i = 0; i < img_avatar.length; i++) {
            img_avatar[i].className = img_avatar[i].className.replace(/(?:^|\s)hide(?!\S)/g, '');
        }
        var main_menu_nav = document.getElementsByClassName("main-menu-nav");
        for (var i = 0; i < main_menu_nav.length; i++) {
            console.log('unhide ' + i);
            main_menu_nav[i].className = main_menu_nav[i].className.replace(/(?:^|\s)hide(?!\S)/g, '');
        }
        var main_bra = document.getElementsByClassName("main_bra nav-link nav-link-preferance minimize");
        for (var i = 0; i < main_bra.length; i++) {
            main_bra[i].className = main_bra[i].className.replace(/(?:^|\s)minimize(?!\S)/g, '');
        }
        var col_detail_main = document.getElementsByClassName("col-10 col_detail_main minimize");
        for (var i = 0; i < col_detail_main.length; i++) {
            col_detail_main[i].className = col_detail_main[i].className.replace(/(?:^|\s)minimize(?!\S)/g, '');
        }
        var header_menu_bra = document.getElementsByClassName("header_menu_bra");
        for (var i = 0; i < header_menu_bra.length; i++) {
            header_menu_bra[i].className = header_menu_bra[i].className.replace(/(?:^|\s)hide(?!\S)/g, '');
        }
        var name_menu_bra = document.getElementsByClassName("name_menu_bra");
        for (var i = 0; i < name_menu_bra.length; i++) {
            name_menu_bra[i].className = name_menu_bra[i].className.replace(/(?:^|\s)hide(?!\S)/g, '');
        }
        var dept_menu_bra = document.getElementsByClassName("dept_menu_bra");
        for (var i = 0; i < dept_menu_bra.length; i++) {
            dept_menu_bra[i].className = dept_menu_bra[i].className.replace(/(?:^|\s)hide(?!\S)/g, '');
        }
        var hr_menu_bra = document.getElementsByClassName("hr_menu_bra");
        for (var i = 0; i < hr_menu_bra.length; i++) {
            hr_menu_bra[i].className = hr_menu_bra[i].className.replace(/(?:^|\s)hide(?!\S)/g, '');
        }
        var hr_menu_bra_in = document.getElementsByClassName("hr_menu_bra_in");
        for (var i = 0; i < hr_menu_bra_in.length; i++) {
            hr_menu_bra_in[i].className = hr_menu_bra_in[i].className.replace(/(?:^|\s)hide(?!\S)/g, '');
        }
    } else {
        document.getElementById('minimize_menu').value = 'hide';
        document.getElementById("bt_nav_coll_ex").innerHTML =
            '<ion-icon name="chevron-forward-outline" style="margin:0px;color:white"></ion-icon>';
        var list_bra = document.getElementsByClassName("list_bra");
        for (var i = 0; i < list_bra.length; i++) {
            list_bra[i].className += " mini-nav-col";
        }
        // document.getElementById("main-menu-nav").className += " hide";
        document.getElementById("apps_name").className += " hide";
        document.getElementById("logo").className += " hide";
        document.getElementById("logo_minimize").className = document.getElementById("logo").className
            .replace(
                /(?:^|\s)hide(?!\S)/g, '');
        var main_menu_nav = document.getElementsByClassName("main-menu-nav");
        for (var i = 0; i < main_menu_nav.length; i++) {
            console.log('hide ' + i);
            main_menu_nav[i].className += " hide";
        }
        var header_menu_bra = document.getElementsByClassName("header_menu_bra");
        for (var i = 0; i < header_menu_bra.length; i++) {
            header_menu_bra[i].className += " hide";
        }
        var img_avatar = document.getElementsByClassName("img-avatar");
        for (var i = 0; i < img_avatar.length; i++) {
            img_avatar[i].className += " hide";
        }
        var col_detail_main = document.getElementsByClassName("col-10 col_detail_main");
        for (var i = 0; i < col_detail_main.length; i++) {
            col_detail_main[i].className += " minimize";
        }
        var main_bra = document.getElementsByClassName("main_bra");
        for (var i = 0; i < main_bra.length; i++) {
            main_bra[i].className += " minimize";
        }
        var name_menu_bra = document.getElementsByClassName("name_menu_bra");
        for (var i = 0; i < name_menu_bra.length; i++) {
            name_menu_bra[i].className += " hide";
        }
        var dept_menu_bra = document.getElementsByClassName("dept_menu_bra");
        for (var i = 0; i < dept_menu_bra.length; i++) {
            dept_menu_bra[i].className += " hide";
        }
        var hr_menu_bra = document.getElementsByClassName("hr_menu_bra");
        for (var i = 0; i < hr_menu_bra.length; i++) {
            hr_menu_bra[i].className += " hide";
        }
        var hr_menu_bra_in = document.getElementsByClassName("hr_menu_bra_in");
        for (var i = 0; i < hr_menu_bra_in.length; i++) {
            hr_menu_bra_in[i].className += " hide";
        }
    }
}

function call_edit_add_new_modal(id, brand) {
    Notiflix.Loading.hourglass('Loading...');
    if (id) {
        $.post("../base/page/ns_detail.php", {
            id: id
        }, function(data) {
            $('#col_detail').html(data);
            Notiflix.Loading.remove();
        });
    }
}
//toolstips menu
tippy('#nav_activity', {
    content: "Activity",
    placement: 'right',
    animation: 'fade',
});
tippy('#nav_dashboard', {
    content: "dashboard",
    placement: 'right',
    animation: 'fade',
});
tippy('#nav_create_new', {
    content: "Create New content",
    placement: 'right',
    animation: 'fade',
});
tippy('#nav_update_content', {
    content: "Update a product content",
    placement: 'right',
    animation: 'fade',
});
tippy('#nav_update_content', {
    content: "Update a product content",
    placement: 'right',
    animation: 'fade',
});
tippy('#nav_job_manage', {
    content: "Job manage",
    placement: 'right',
    animation: 'fade',
});
tippy('#nav_job_on_hand', {
    content: "Job on hand",
    placement: 'right',
    animation: 'fade',
});
tippy('#nav_linesheet', {
    content: "Linesheet management",
    placement: 'right',
    animation: 'fade',
});
tippy('#nav_report', {
    content: "Report",
    placement: 'right',
    animation: 'fade',
});
tippy('#nav_product_mantain', {
    content: "Content Management System",
    placement: 'right',
    animation: 'fade',
});
tippy('#nav_quicklink', {
    content: "Quciklink",
    placement: 'right',
    animation: 'fade',
});
tippy('#nav_logout', {
    content: "logout",
    placement: 'right',
    animation: 'fade',
});
tippy('#nav_linesheet_download', {
    content: "Creation Form (Lasest)",
    placement: 'right',
    animation: 'fade',
});
tippy('#nav_configulable', {
    content: "Configulable",
    placement: 'right',
    animation: 'fade',
});
tippy('#nav_setting', {
    content: "Setting",
    placement: 'right',
    animation: 'fade',
});
tippy('#nav_toolkit', {
    content: "All in one tools",
    placement: 'right',
    animation: 'fade',
});

function call_model_edit_account(username) {
    Notiflix.Loading.hourglass('Loading...');
    if (username) {
        $.post("../base/page/setting.php", {
            username: username
        }, function(data) {
            $('#model_lg').html(data);
            Notiflix.Loading.remove();
        });
    }
}

function call_model_edit_add_new(id) {
    Notiflix.Loading.hourglass('Loading...');
    if (id) {
        $.post("../base/page/ns_detail.php", {
            id: id
        }, function(data) {
            $('#model_lg').html(data);
            Notiflix.Loading.remove();
        });
    }
}

function call_model_edit_content_request(id) {
    Notiflix.Loading.hourglass('Loading...');
    if (id) {
        $.post("../base/page/cr_detail.php", {
            id: id
        }, function(data) {
            $('#model_lg').html(data);
            Notiflix.Loading.remove();
        });
    }
}

function search() {
    var input = document.getElementById('input_search').value;
    // Notiflix.Loading.hourglass('Loading...');
    document.getElementById('search_input').innerHTML = input;
    if (input) {
        $.post("../base/get/get_search_result.php", {
            input: input
        }, function(data) {
            $('#search_result').html(data);
            // Notiflix.Loading.remove();
        });
    }
}
// // ===== Scroll to Top ====
// $(window).scroll(function() {
//     if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
//         $('#return-to-top').fadeIn(200);    // Fade in the arrow
//     } else {
//         $('#return-to-top').fadeOut(200);   // Else fade out the arrow
//     }
// });
// $('#return-to-top').click(function() {      // When arrow is clicked
//     $('body,html').animate({
//         scrollTop : 0                       // Scroll to top of body
//     }, 500);
// });
</script>

<?php } ?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content rounded shadow">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <div id="model_lg">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalsm" tabindex="-1" aria-labelledby="exampleModalLabelsm" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content rounded shadow">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelsm"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <div id="model_sm">
                </div>
            </div>
        </div>
    </div>
</div>
<script id="script">
var s = document.createElement("script")
s.src = "https://notix.io/ent/current/enot.min.js"
s.onload = function(sdk) {
    sdk.startInstall({
        appId: "10052dd0063417a1645897f10306381",
        loadSettings: true,
        user: "<?php echo $_SESSION['username']; ?>",
        disableConsoleDebug: true
    })
}
document.head.append(s)
</script>
<?php
if($_GET['direct']<>null and $_GET['prefix']<>null){ ?>
<script>
if (<?php echo $_GET['prefix']; ?> == 'NS') {
    call_edit_add_new_modal(<?php echo$_GET['direct']; ?>);
}
if {
    cr_id_toggle(<?php echo$_GET['direct']; ?>);
}
</script>
<?php
}

?>
<!-- <script>
Notiflix.Report.warning(
'แจ้งปิดรับงาน',
'เปิดรับ Ticket สร้างสินค้าใหม่ขึ้นบนเว็บไซต์ จนถึง<strong>วันพุธที่ 14 ธันวาคม 2565</strong>  <br/><br/> หากเปิด Ticket มาหลังวันที่ดังกล่าว จะเริ่มดำเนินการในวันที่ 3 มกราคม 2566 เป็นต้นไป',
'รับทราบ',
);
</script> -->