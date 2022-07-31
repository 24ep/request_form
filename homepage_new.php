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
    <link rel="stylesheet" href="action/notiflix/dist/notiflix-3.2.5.min.css" />
    <script src="action/notiflix/dist/notiflix-3.2.5.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css-theam/light-new.css">
    <script src="js/notifications.js"></script>
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
    <div class="row">
        <div class="col-2 list_bra shadow">
            <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="navbar-brand" href="#">ONLINE CONTENT</a>
                <hr class="hr_manu_bra">
                <span class="name_manu_bra"><?php $_SESSION['nickname'].' '.$_SESSION['firstname']; ?></span>
                <small class="dept_manu_bra"><?php $_SESSION['department']; ?></small>
                <hr class="hr_manu_bra">
                <small class="header_manu_bra">Manu</small>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <a class="nav-link" type="button" onclick="get_list_update_job();">
                        <ion-icon name="notifications"></ion-icon>Notifications
                        <div id="get_count_nt_unread">
                            <?php include('get/get_count_nt_unread.php'); ?>
                        </div>
                    </a>
                    <li class="nav-item" role="presentation"></li>
                    <a class="nav-link active" data-bs-toggle="pill" type="button" role="tab" aria-selected="false" onclick="get_page('dashboard');">
                        <ion-icon name="home"></ion-icon>Dashboard
                    </a>
                    </li>
                    <li class="nav-item" role="presentation"></li>
                    <a class="nav-link" data-bs-toggle="pill" type="button" role="tab" aria-selected="false"
                        onclick="get_page('create_new');">
                        <ion-icon name="ticket"></ion-icon>Create New
                    </a>
                    </li>
                    <li class="nav-item" role="presentation"></li>
                    <a class="nav-link" data-bs-toggle="pill" type="button" role="tab" aria-selected="false"
                        onclick="get_page('update_content');">
                        <ion-icon name="ticket"></ion-icon>Update content
                    </a>
                    </li>
                    <hr class="hr_manu_bra_in">
                    <small class="header_manu_bra">Internals</small>
                    <li class="nav-item" role="presentation"></li>
                    <a class="nav-link" data-bs-toggle="pill" type="button" role="tab" aria-selected="false">
                        <ion-icon name="bar-chart"></ion-icon>Reports
                    </a>
                    </li>
                    <li class="nav-item" role="presentation"></li>
                    <a class="nav-link" data-bs-toggle="pill" type="button" role="tab" aria-selected="false">
                        <ion-icon name="cube"></ion-icon>Assests
                    </a>
                    </li>
                    <li class="nav-item" role="presentation"></li>
                    <a class="nav-link" data-bs-toggle="pill" type="button" role="tab" aria-selected="false"
                        onclick="get_page('account');">
                        <ion-icon name="people"></ion-icon>Account
                    </a>
                    </li>
                    <hr class="hr_manu_bra_in">
                    <small class="header_manu_bra">Others</small>
                    <li class="nav-item" role="presentation"></li>
                    <a class="nav-link" data-bs-toggle="pill" type="button" role="tab" aria-selected="false">
                        <ion-icon name="globe"></ion-icon>Quick link
                    </a>
                    </li>
                    <li class="nav-item" role="presentation"></li>
                    <a class="nav-link" data-bs-toggle="pill" type="button" role="tab" aria-selected="false">
                        <ion-icon name="settings"></ion-icon>Settings
                    </a>
                    </li>
                    <li class="nav-item" role="presentation"></li>
                    <a class="nav-link" data-bs-toggle="pill" type="button" role="tab" aria-selected="false"
                        onclick="logout()">
                        <ion-icon name="log-out"></ion-icon>Logout
                    </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-10" style="margin-left: auto;font-size: 14px;">
            <div id="col_detail">
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>
<script>
function get_page(page) {
    if (page == "update_content") {
        Notiflix.Loading.hourglass('Loading...');
        $.post("page/update_content.php", {}, function(data) {
            $('#col_detail').html(data);
            Notiflix.Loading.remove();
        });
    } else if (page == "create_new") {
        Notiflix.Loading.hourglass('Loading...');
        $.post("page/create_new.php", {}, function(data) {
            $('#col_detail').html(data);
            Notiflix.Loading.remove();
        });
    } else if (page == "account") {
        Notiflix.Loading.hourglass('Loading...');
        $.post("page/account.php", {}, function(data) {
            $('#col_detail').html(data);
            Notiflix.Loading.remove();
        });
    } else if (page == "dashboard") {
        Notiflix.Loading.hourglass('Loading...');
        $.post("page/dashboard.php", {}, function(data) {
            $('#col_detail').html(data);
            Notiflix.Loading.remove();
        });
    } else {
        $('#col_detail').html("not avaliable");
        Notiflix.Loading.remove();
    }
}

function logout() {
    Notiflix.Confirm.show(
        'Confirm ',
        'Do you want to logout ?',
        'Yes ',
        'No ',
        function okCb() {
            window.location.href = "action/action_logout.php";
        },
        function cancelCb() {
            //nothing to do
        },
    );

}
</script>
<script>
function call_edit_add_new_modal(id, brand) {
    Notiflix.Loading.hourglass('Loading...');
    if (id) {
        $.post("base/modal/edit_request_add_new.php", {
            id: id
        }, function(data) {
            $('#callmodal_request_add_new').html(data);
            Notiflix.Loading.remove();
        });
    }
}

function cr_id_toggle(id) {
    Notiflix.Loading.hourglass('Loading...');
    if (id) {
        $.post("base/get/get_content_request_detail.php", {
            id: id
        }, function(data) {
            $('#calloffcanvas_cr').html(data);
            Notiflix.Loading.remove();
        });
    }
}

function start_checking(id) {
    if (id) {
        $.post("base/action/action_start_checking.php", {
            id: id
        }, function(data) {
            $('#start_checking_resault').html(data);
        });
    }
}

function accepted_stt(id) {
    if (id) {
        // sku_accepted = document.getElementById('sku_accepted').value;
        $.post("base/action/action_accept_stt.php", {
            id: id
            // sku_accepted: sku_accepted
        }, function(data) {
            $('#accept_checking_resault').html(data);
        });
    }
}

function cancel_stt(id, status_change) {
    resone_cancel = document.getElementById('resone_cancel').value;
    status_change = 'cancel';
    if (id) {
        $.post("base/action/action_cancel_stt.php", {
            id: id,
            resone_cancel: resone_cancel,
            status_change: status_change
        }, function(data) {
            $('#cancel_checking_resault').html(data);
        });
    }
}

function cancel_ticket(id) {
    resone_cancel = document.getElementById('reason_cancel').value;
    status_change = document.getElementById('type_cancel').value;
    // status_change = 'cancel';
    if (id) {
        $.post("base/action/action_cancel_stt.php", {
            id: id,
            resone_cancel: resone_cancel,
            status_change: status_change
        }, function(data) {
            $('#cancel_checking_resault').html(data);
        });
    }
}

function itm_confirm_cancel(id, status_change) {
    let message = prompt("พิมพ์ " + status_change + " อีกครั้งเพื่อยืนยัน", "");
    if (message == null || message == "") {
        alert("user cancel prompt");
    } else {
        if (message == status_change) {
            if (id) {
                resone_cancel = document.getElementById('itm_reason_cancel').value;
                $.post("base/action/action_cancel_stt.php", {
                    id: id,
                    resone_cancel: resone_cancel,
                    status_change: status_change
                }, function(data) {
                    $('#cancel_checking_result').html(data);
                });
            }
        } else {
            alert("ไม่ตรงกัน ลองใหม่อีกครั้ง");
        }
    }
}

function filter_cr_ticket(status) {
    document.getElementById('cr_search_input').value = '';
    var update = true;
    if (status) {
        $.post("base/get/get_list_content_request.php", {
            status: status,
            update: update
        }, function(data) {
            $('#list_grouping').html(data);
        });
    }
}

function get_project_model(id) {
    if (id) {
        $.post("base/get/get_project_model.php", {
            id: id
        }, function(data) {
            $('#return_project_model').html(data);
        });
    }
}

function search_cr_data() {
    var input = document.getElementById('ts_command').value.toLowerCase();;
    if (input != "") {
        //hide all card
        var SearchInputQuery = document.querySelectorAll('[data-card="#detail_cr"]');
        for (var card of SearchInputQuery) {
            card.className = card.className.replace(/(?:^|\s)cr-search-hide(?!\S)/g, '');
            card.className += " cr-search-hide";
        }
        //show title contain
        var SearchInputQuery = document.querySelectorAll('[data-cr-title*="' + input + '"]');
        for (var card of SearchInputQuery) {
            card.className = card.className.replace(/(?:^|\s)cr-search-hide(?!\S)/g, '');
        }

        //show id equal
        var SearchInputQuery = document.querySelectorAll('[data-cr-id="' + input + '"]');
        for (var card of SearchInputQuery) {
            card.className = card.className.replace(/(?:^|\s)cr-search-hide(?!\S)/g, '');
        }
    } else {
        //unhide all card
        var SearchInputQuery = document.querySelectorAll('[data-bs-target="#detail_cr"]');
        for (var card of SearchInputQuery) {
            card.className = card.className.replace(/(?:^|\s)cr-search-hide(?!\S)/g, '');
        }
    }
}

function search_cr_username() {
    var username = document.getElementById('ts_username').value.toLowerCase();;
    if (username != "") {
        //hide all card
        var SearchInputQuery = document.querySelectorAll('[data-card="#detail_cr"]');
        for (var card of SearchInputQuery) {
            card.className = card.className.replace(/(?:^|\s)cr-username-hide(?!\S)/g, '');
            card.className += " cr-username-hide";
        }
        //show data-cr-participant contain
        var SearchInputQuery = document.querySelectorAll('[data-cr-participant*="' + username + '"]');
        for (var card of SearchInputQuery) {
            card.className = card.className.replace(/(?:^|\s)cr-username-hide(?!\S)/g, '');
        }
    } else {
        //unhide all card
        var SearchInputQuery = document.querySelectorAll('[data-bs-target="#detail_cr"]');
        for (var card of SearchInputQuery) {
            card.className = card.className.replace(/(?:^|\s)cr-username-hide(?!\S)/g, '');
        }
    }
}

function search_cr_request_for() {
    var request_for = document.getElementById('ts_request_for').value;
    if (request_for != "") {
        //hide all card
        var SearchInputQuery = document.querySelectorAll('[data-card="#detail_cr"]');
        for (var card of SearchInputQuery) {
            card.className = card.className.replace(/(?:^|\s)cr-request-for-hide(?!\S)/g, '');
            card.className += " cr-request-for-hide";
        }
        //show data-cr-request contain
        var SearchInputQuery = document.querySelectorAll('[data-cr-request-for*="' + request_for + '"]');
        for (var card of SearchInputQuery) {
            card.className = card.className.replace(/(?:^|\s)cr-request-for-hide(?!\S)/g, '');
        }
    } else {
        //unhide all card
        var SearchInputQuery = document.querySelectorAll('[data-card="#detail_cr"]');
        for (var card of SearchInputQuery) {
            card.className = card.className.replace(/(?:^|\s)cr-request-for-hide(?!\S)/g, '');
        }
    }
}

function search_cr_status() {
    var status = document.getElementById('ts_status').value;
    if (status != "") {
        //hide all card
        var SearchInputQuery = document.querySelectorAll('[data-card="#detail_cr"]');
        for (var card of SearchInputQuery) {
            card.className += " cr-status-hide";
        }
        //show data-cr-request contain
        var SearchInputQuery = document.querySelectorAll('[data-cr-status*="' + status + '"]');
        for (var card of SearchInputQuery) {
            card.className = card.className.replace(/(?:^|\s)cr-status-hide(?!\S)/g, '');
        }
    } else {
        //unhide all card
        var SearchInputQuery = document.querySelectorAll('[data-card="#detail_cr"]');
        for (var card of SearchInputQuery) {
            card.className = card.className.replace(/(?:^|\s)cr-status-hide(?!\S)/g, '');
        }
    }
}

function update_project_sticky_badge(BuketPrefix) {
    var prefix_project_sticky_array = [];
    var prefix_project_sticky = "";
    $.each($("input[name='bucket_checking']:not(:checked)"), function() {
        if ($(this).val() != BuketPrefix) {
            var boxes = document.querySelectorAll('[data-bucket="' + $(this).val() + '"]');
            for (var box of boxes) {
                box.className += " bucket-hin";
            }
        } else {
            var boxes = document.querySelectorAll('[data-bucket="' + BuketPrefix + '"]');
            for (var box of boxes) {
                box.className = box.className.replace(/(?:^|\s)bucket-hin(?!\S)/g, '');
            }
            prefix_project_sticky_array.push($(this).val());
        }
    });
    $.each($("input[name='bucket_checking']:checked"), function() {
        if ($(this).val() != BuketPrefix) {
            var boxes = document.querySelectorAll('[data-bucket="' + $(this).val() + '"]');
            for (var box of boxes) {
                box.className = box.className.replace(/(?:^|\s)bucket-hin(?!\S)/g, '');
            }
            prefix_project_sticky_array.push($(this).val());
        } else {
            var boxes = document.querySelectorAll('[data-bucket="' + BuketPrefix + '"]');
            for (var box of boxes) {
                box.className += " bucket-hin";
            }
        }
    });
    prefix_project_sticky = prefix_project_sticky_array.join("','");
    prefix_project_sticky = "'" + prefix_project_sticky + "'";
    console.log("is checked: " + prefix_project_sticky_array.join(","));
    $.post("base/get/get_list_bucket.php", {
        prefix_project_sticky: prefix_project_sticky
    }, function(data) {
        // z-index: -1;
        // position: absolute!important;
        // display: none;
    });
}

function search_cr_ticket() {
    var cr_search_input = document.getElementById("cr_search_input").value
    var user_cr_filter = document.getElementById("user_cr_filter").value
    // if (cr_search_input) {
    $.post("base/get/get_list_content_request.php", {
        cr_search_input: cr_search_input,
        user_cr_filter: user_cr_filter
    }, function(data) {
        $('#list_grouping').html(data);
    });
}

function run_ts_command(ts_level) {
    var summary_filter = document.getElementById("ts_command").value;
    var ts_username = document.getElementById("ts_username").value;
    var ts_command_limit = document.getElementById("ts_command_limit").value;
    $.post("base/get/get_list_ts_board_view.php", {
        summary_filter: summary_filter,
        ts_command_limit: ts_command_limit,
        ts_username: ts_username
    }, function(data) {
        $('#get_ts_admin_console').html(data);
    });
    update_project_sticky_badge('skip');
    search_cr_data();
    search_cr_username();
    search_cr_request_for();
    search_cr_status();
}
</script>
<script type="text/javascript">
function open_ticket_detail(id) {
    document.getElementById('user_filter').value = "";
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

function update_project_sticky() {
    var prefix_project_sticky = "";
    for (var option of document.getElementById('project_sticky_mse').options) {
        if (option.selected) {
            if (prefix_project_sticky == "") {
                prefix_project_sticky = "'" + option.value + "'";
            } else {
                prefix_project_sticky = prefix_project_sticky + ",'" + option.value + "'";
            }
            // selected.push(option.value);
        }
    }
    $.post("base/get/get_list_project.php", {
        prefix_project_sticky: prefix_project_sticky
    }, function(data) {
        $('#project_bucket').html(data);
    });
}

function update_brand_note(dataoutput, brand) {
    $.post("base/action/action_update_brand_note.php", {
        dataoutput: dataoutput,
        brand: brand
    }, function(data) {
        // $('#get_list_job_update').html(data);
    });
}

function filter_update(be) {
    var user_filter = document.getElementById("user_filter").value
    var status_filter = document.getElementById("status_filter").value
    var pagenation_input = document.getElementById("pagenation_input").value
    var brand_filter = document.getElementById("brand_filter").value
    var from_post = true;
    if (from_post) {
        $.post("base/get/get_list_new_job.php", {
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
        $.post("base/get/get_total_page_nj.php", {
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
    plugins: 'print preview paste importcss searchreplace table autolink autosave save directionality lists code visualblocks visualchars fullscreen link template codesample charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist  wordcount textpattern noneditable help charmap  emoticons',
    imagetools_cors_hosts: ['picsum.photos'],
    menubar: 'file edit view insert format tools table help',
    toolbar: 'bold italic underline strikethrough | forecolor backcolor removeformat | table code | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | pagebreak | charmap emoticons | fullscreen  preview  print | link anchor codesample | ltr rtl',
    toolbar_sticky: true,
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 600,
    noneditable_noneditable_class: 'mceNonEditable',
    toolbar_mode: 'sliding',
    contextmenu: 'link bold italic | quicklink h2 h3 blockquote ',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});
</script>
<script type="text/javascript">
tinymce.init({
    selector: '#des_cr_inline',
    inline: true
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
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>
<script>
run_ts_command('task');
</script>
<script>
function load_tiny_comment() {
    tinymce.init({
        selector: "textarea#comment_input_cr",
        plugins: "autoresize link lists emoticons",
        toolbar: "bold italic underline strikethrough  forecolor  numlist bullist  link blockquote emoticons",
        menubar: false,
        statusbar: false,
        width: "100%",
        toolbar_location: "bottom",
        autoresize_bottom_margin: 0,
        contextmenu: false,
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px; } ',
        setup: (ed) => {
            editor = ed;
        },
    });
}
</script>
<style>
.tox.tox-tinymce.tox-tinymce--toolbar-bottom {
    border-radius: 7px;
    margin-top: 8px;
}

.tox-tinymce:not(.tox-tinymce-inline) .tox-editor-header:not(:first-child) .tox-toolbar-overlord:first-child .tox-toolbar__primary,
.tox-tinymce:not(.tox-tinymce-inline) .tox-editor-header:not(:first-child) .tox-toolbar:first-child {
    border-top: 1px solid #fff;
}

.tox .tox-tbtn svg {
    display: block;
    fill: #6c757d !important;
}
</style>
<script>
baguetteBox.run('.baguetteBoxFour', {
    buttons: false
});
</script>
<script>
timeago().render(document.querySelectorAll('.timeago'));
</script>
<?php } ?>