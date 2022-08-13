<?php
session_start();
if (!$_SESSION["login_csg"]){ 
            Header("Location: login");
    }else{
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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New ui content service gate</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/ocp" href="https://cdse-commercecontent.com/base/images/24ico.ico" />
    <!-- textarray -->
    <script src="https://cdn.tiny.cloud/1/cis8560ji58crrbq17zb11gp39qhpn2lka54u0m54s8du1gw/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
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
</head>

<body>
    <!-- <nav class="navbar navbar-light bg-light">
        <div class="" style="background:#ff000069;color:white;position: fixed;z-index: 1;">
            <a class="navbar-brand" href="#">You are in pre-launch environment</a>
        </div>
    </nav> -->
    <div class="offcanvas offcanvas-start overflow-auto" role="dialog" tabindex="-1" id="edit_add_new"
        style="width:100%" aria-labelledby="offcanvasExampleLabel">
        <div id="callmodal_request_add_new" style="height: 100%;"></div>
    </div>
    <!-- offcanvas detail cr -->
    <div class="offcanvas offcanvas-start" tabindex="0" id="detail_cr" style="width:100%"
        aria-labelledby="offcanvasExampleLabel">
        <div id="calloffcanvas_cr">
        </div>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="notificationcanvas" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Update</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <?php include("get/get_log.php"); ?>
        </div>
    </div>

    <div class="offcanvas offcanvas-start" style="width:70%" tabindex="-1" id="content_request_canvas"
        aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header" style="    background: #313131;color: white;">
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

    <div class="col-2 list_bra shadow">
        <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button type="button" id="bt_nav_coll_ex" onclick="minimize_nav();"
                class="position-absolute top-1_5 start-100 translate-middle btn btn-sm btn-dark rounded-pill"
                style="width: 2rem; height:2rem;padding: 0px;">
                <ion-icon name="menu-outline" style="margin:0px"></ion-icon>
            </button>
            <input type="hidden" id="minimize_manu" name="minimize_manu" value="show">
            <a class="navbar-brand" href="#">
                <ion-icon name="layers" style="font-size: 20px;margin: 0px;"></ion-icon>
                ONLINE CONTENT
            </a>
            <hr class="hr_manu_bra">
            <span class="name_manu_bra"><?php echo $_SESSION['nickname'].' '.$_SESSION['firstname']; ?></span>
            <small class="dept_manu_bra"><?php echo $_SESSION['department']; ?></small>
            <hr class="hr_manu_bra">
            <small class="header_manu_bra">Manu</small>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <a class="nav-link" type="button" onclick="get_list_update_job();">
                    <ion-icon name="notifications"></ion-icon><span id="main-manu-nav">Notifications</span>
                    <div id="get_count_nt_unread">
                        <?php include('get/get_count_nt_unread.php'); ?>
                    </div>
                </a>
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="pill" type="button" role="tab" aria-selected="false"
                        onclick="get_page('dashboard');">
                        <ion-icon name="home"></ion-icon><span id="main-manu-nav">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="pill" type="button" role="tab" aria-selected="false"
                        onclick="get_page('create_new');">
                        <ion-icon name="ticket"></ion-icon><span id="main-manu-nav">Create New</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="pill" type="button" role="tab" aria-selected="false"
                        onclick="get_page('update_content');">
                        <ion-icon name="ticket"></ion-icon><span id="main-manu-nav">Other Requests</span>
                    </a>
                </li>
                <hr class="hr_manu_bra_in">
                <small class="header_manu_bra">Internals</small>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="pill" type="button" role="tab" aria-selected="false"
                        onclick="get_page('report');">
                        <ion-icon name="bar-chart"></ion-icon><span id="main-manu-nav">Reports</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="pill" type="button" role="tab" aria-selected="false"
                        onclick="get_page('assert');">
                        <ion-icon name="cube"></ion-icon><span id="main-manu-nav">Assests</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="pill" type="button" role="tab" aria-selected="false"
                        onclick="get_page('notion');">
                        <ion-icon name="book"></ion-icon><span id="main-manu-nav">Notion</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="pill" type="button" role="tab" aria-selected="false"
                        onclick="get_page('account');">
                        <ion-icon name="people"></ion-icon><span id="main-manu-nav">Administration</span>
                    </a>
                </li>

                <li class="nav-item btn-group dropend" role="presentation">
                    <a class="nav-link" data-bs-toggle="dropdown" data-bs-auto-close="outside" type="button" role="tab"
                        aria-selected="false" data-bs-toggle="dropdown">
                        <ion-icon name="layers"></ion-icon><span id="main-manu-nav">Productions</span>
                    </a>
                    <ul class="dropdown-menu menu-block shadow p3">
                        <small class="header_manu_bra">Datapump</small>
                        <li><a onclick="get_page('datapump_convert');" class="dropdown-item dp-link" type="button">
                                <ion-icon name="shapes"></ion-icon>Datapump Convert
                            </a></li>
                        <li><a onclick="get_page('datapump_admin');" class="dropdown-item dp-link" type="button">
                                <ion-icon name="shapes"></ion-icon>Datapump Admin
                            </a></li>
                        <hr class="hr_manu_bra_in">
                        <small class="header_manu_bra">Backend (PROD)</small>
                        <li><a href="https://cto-pim.cloud.akeneo.com/" target="_blank" class="dropdown-item dp-link"
                                type="button">
                                <ion-icon name="shapes"></ion-icon>PIM
                            </a></li>
                        <li><a href="https://backend.central.co.th/gutentag/admin/index/index/key/36f79751536eaff794291a09bb5d1831d1f4453a2819d0d731cde2da72b95ffb/"
                                target="_blank" class="dropdown-item dp-link" type="button">
                                <ion-icon name="shapes"></ion-icon>MDC
                            </a></li>
                        <hr class="hr_manu_bra_in">
                        <small class="header_manu_bra">Backend (Stagging)</small>
                        <li><a href="https://uat.central.co.th/th" target="_blank" class="dropdown-item dp-link"
                                type="button">
                                <ion-icon name="shapes"></ion-icon>FE
                            </a></li>
                        <li><a href="https://eor-admin-uat.central.tech/upload" target="_blank"
                                class="dropdown-item dp-link" type="button">
                                <ion-icon name="shapes"></ion-icon>DATAPUMP Admin
                            </a></li>
                        <li><a href="https://cto-pim-uat.cloud.akeneo.com/user/login" target="_blank"
                                class="dropdown-item dp-link" type="button">
                                <ion-icon name="shapes"></ion-icon>PIM
                            </a></li>
                        <li><a href="https://staging-mdc.central.co.th/admin/admin/index/index/key/84db97aa4de2e2c911fef6db4bab589d9eab2b47811d1d714d7193c2029e299f/"
                                target="_blank" class="dropdown-item dp-link" type="button">
                                <ion-icon name="shapes"></ion-icon>MDC
                            </a></li>
                        <hr class="hr_manu_bra_in">
                        <small class="header_manu_bra">Ability</small>
                        <li><a onclick="get_page('writer-auto-assign-console');" class="dropdown-item dp-link"
                                type="button">
                                <ion-icon name="shapes"></ion-icon>writer auto-assign console
                            </a></li>
                        <li><a onclick="get_page('convert_mapping');" class="dropdown-item dp-link" type="button">
                                <ion-icon name="shapes"></ion-icon>Convert Mapping
                            </a></li>
                        <li><a onclick="get_page('wordtohtml');" class="dropdown-item dp-link" type="button">
                                <ion-icon name="shapes"></ion-icon>Word to HTML
                            </a></li>
                        <li><a href="https://centrality.workplace.com/" target="_blank" class="dropdown-item dp-link"
                                type="button">
                                <ion-icon name="shapes"></ion-icon>Workchat
                            </a></li>
                    </ul>
                </li>
                <hr class="hr_manu_bra_in">
                <small class="header_manu_bra">Others</small>
                <li class="nav-item btn-group dropend" role="presentation">
                    <a class="nav-link" data-bs-toggle="dropdown" data-bs-auto-close="outside" type="button" role="tab"
                        aria-selected="false" data-bs-toggle="dropdown">
                        <ion-icon name="globe"></ion-icon><span id="main-manu-nav">Quicklink</span>
                    </a>
                    <ul class="dropdown-menu menu-block shadow p3">
                        <small class="header_manu_bra">Central</small>

                        <li><a href="http://cnext.centralgroup.com/" target="_blank" class="dropdown-item dp-link"
                                type="button">
                                <ion-icon name="shapes"></ion-icon>Cnext
                            </a></li>
                        <li><a href="https://ris6789.central.co.th/arsys/shared/login.jsp?/arsys/" target="_blank"
                                class="dropdown-item dp-link" type="button">
                                <ion-icon name="shapes"></ion-icon>RIS 6789
                            </a></li>
                        <li><a href="https://cenergy.atlassian.net/servicedesk/customer/portals" target="_blank"
                                class="dropdown-item dp-link" type="button">
                                <ion-icon name="shapes"></ion-icon>CTO JIRA
                            </a></li>
                        <li><a href="https://centralgroup-my.sharepoint.com/:f:/g/personal/ton_central_tech/Ek7nHI386MZAgCvU5e1xAvkBJX9gZbW_xE6NYjq8dUgo6g?e=2frs9b"
                                target="_blank" class="dropdown-item dp-link" type="button">
                                <ion-icon name="shapes"></ion-icon>LAMTON DRIVE
                            </a></li>
                        <li><a href="https://cds-content.myjetbrains.com/youtrack/articles/SD-A-21/user-for-content-team"
                                target="_blank" class="dropdown-item dp-link" type="button">
                                <ion-icon name="shapes"></ion-icon>Yourtrack
                            </a></li>
                    </ul>

                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="pill" type="button" role="tab" aria-selected="false">
                        <ion-icon name="settings"></ion-icon><span id="main-manu-nav">Settings</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="pill" type="button" role="tab" aria-selected="false"
                        onclick="logout()">
                        <ion-icon name="log-out"></ion-icon><span id="main-manu-nav">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-10" style="margin-left: auto;font-size: 14px;padding: 0px;">
        <div id="col_detail">
        </div>
    </div>
    <!-- </div> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>
<script>
function get_page(page) {
    if (page == "update_content") {
        Notiflix.Loading.hourglass('Loading...');
        $.post("base/page/update_content.php", {}, function(data) {
            $('#col_detail').html(data);
            Notiflix.Loading.remove();
        });
    } else if (page == "create_new") {
        Notiflix.Loading.hourglass('Loading...');
        $.post("base/page/create_new.php", {}, function(data) {
            $('#col_detail').html(data);
            Notiflix.Loading.remove();
        });
    } else if (page == "account") {
        Notiflix.Loading.hourglass('Loading...');
        $.post("base/page/account.php", {}, function(data) {
            $('#col_detail').html(data);
            Notiflix.Loading.remove();
        });
    } else if (page == "dashboard") {
        Notiflix.Loading.hourglass('Loading...');
        $.post("base/page/dashboard.php", {}, function(data) {
            $('#col_detail').html(data);
            Notiflix.Loading.remove();
        });
    } else if (page == "datapump_convert") {
        Notiflix.Loading.hourglass('Loading...');
        $.post("base/page/datapump_convert.php", {}, function(data) {
            $('#col_detail').html(data);
            Notiflix.Loading.remove();
        });
    } else if (page == "datapump_admin") {
        Notiflix.Loading.hourglass('Loading...');
        $.post("base/page/datapump_admin.php", {}, function(data) {
            $('#col_detail').html(data);
            Notiflix.Loading.remove();
        });
    } else if (page == "writer-auto-assign-console") {
        Notiflix.Loading.hourglass('Loading...');
        $.post("base/page/writer-auto-assign-console.php", {}, function(data) {
            $('#col_detail').html(data);
            Notiflix.Loading.remove();
        });
    } else if (page == "convert_mapping") {
        Notiflix.Loading.hourglass('Loading...');
        $.post("base/page/convert_mapping.php", {}, function(data) {
            $('#col_detail').html(data);
            Notiflix.Loading.remove();
        });
    } else if (page == "wordtohtml") {
        Notiflix.Loading.hourglass('Loading...');
        $.post("base/page/wordtohtml.php", {}, function(data) {
            $('#col_detail').html(data);
            Notiflix.Loading.remove();
        });
    } else if (page == "assert") {
        Notiflix.Loading.hourglass('Loading...');
        $.post("base/page/assert.php", {}, function(data) {
            $('#col_detail').html(data);
            Notiflix.Loading.remove();
        });
    } else if (page == "notion") {
        Notiflix.Loading.hourglass('Loading...');
        $.post("base/page/notion.php", {}, function(data) {
            $('#col_detail').html(data);
            Notiflix.Loading.remove();
        });
    } else if (page == "report") {
        Notiflix.Loading.hourglass('Loading...');
        $.post("base/page/report.php", {}, function(data) {
            $('#col_detail').html(data);
            Notiflix.Loading.remove();
        });
    } else {
        $('#col_detail').html("not avaliable");
        Notiflix.Loading.remove();
    }
}
get_page('dashboard');

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
function minimize_nav() {
    var minimize_manu = document.getElementById('minimize_manu').value;
    console.log(minimize_manu);
    if (minimize_manu == 'hide') {
        document.getElementById('minimize_manu').value = 'show';
        
        var list_bra = document.getElementsByClassName("list_bra");
        for(var i = 0; i < list_bra.length; i++)
        {
            list_bra[i].className.replace(/(?:^|\s)mini-nav-col(?!\S)/g, '');
        }

        var main_manu_nav = document.getElementsByClassName("main-manu-nav");
        for(var i = 0; i < main_manu_nav.length; i++)
        {
            main_manu_nav[i].className.replace(/(?:^|\s)hide(?!\S)/g, '');
        }

        var header_manu_bra = document.getElementsByClassName("header_manu_bra");
        for(var i = 0; i < header_manu_bra.length; i++)
        {
            header_manu_bra[i].className.replace(/(?:^|\s)hide(?!\S)/g, '');
        }

        var dept_manu_bra = document.getElementsByClassName("dept_manu_bra");
        for(var i = 0; i < dept_manu_bra.length; i++)
        {
            dept_manu_bra[i].className.replace(/(?:^|\s)hide(?!\S)/g, '');
        }

        var hr_manu_bra = document.getElementsByClassName("hr_manu_bra");
        for(var i = 0; i < hr_manu_bra.length; i++)
        {
            hr_manu_bra[i].className.replace(/(?:^|\s)hide(?!\S)/g, '');
        }

        var hr_manu_bra_in = document.getElementsByClassName("hr_manu_bra_in");
        for(var i = 0; i < hr_manu_bra_in.length; i++)
        {
            hr_mhr_manu_bra_inanu_bra[i].className.replace(/(?:^|\s)hide(?!\S)/g, '');
        }
        
    else {
        document.getElementById('minimize_manu').value = 'hide';
        var list_bra = document.getElementsByClassName("list_bra");
        for(var i = 0; i < list_bra.length; i++)
        {
            list_bra[i].className += " mini-nav-col";
        }

        var main_manu_nav = document.getElementsByClassName("main-manu-nav");
        for(var i = 0; i < main_manu_nav.length; i++)
        {
            main_manu_nav[i].className += " hide";
        }

        var header_manu_bra = document.getElementsByClassName("header_manu_bra");
        for(var i = 0; i < header_manu_bra.length; i++)
        {
            header_manu_bra[i].className += " hide";
        }

        var dept_manu_bra = document.getElementsByClassName("dept_manu_bra");
        for(var i = 0; i < dept_manu_bra.length; i++)
        {
            dept_manu_bra[i].className += " hide";
        }

        var hr_manu_bra = document.getElementsByClassName("hr_manu_bra");
        for(var i = 0; i < hr_manu_bra.length; i++)
        {
            hr_manu_bra[i].className += " hide";
        }

        var hr_manu_bra_in = document.getElementsByClassName("hr_manu_bra_in");
        for(var i = 0; i < hr_manu_bra_in.length; i++)
        {
            hr_mhr_manu_bra_inanu_bra[i].className += " hide";
        }

     
    
    }
}
</script>
<?php } ?>