<?php 
//   include("../get/get_default_profile_image.php");
//   include("../get/action_send_linenotify.php");
?>
<!doctype html>
<div class="container-fluid ">
    <div class="input-group input-group-sm p-3" style="position: initial!important;">
        <span class="input-group-text" id="basic-addon1">
            <ion-icon style="vertical-align: middle;margin-right: 5px;" name="filter-circle-outline">
            
            </ion-icon> Filter
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
        <input style="width: 30%;position: initial!important;" type="search" style="position: initial!important;"
            class="form-control" onsearch="search_cr_data();" id="ts_command" name="ts_command"
            placeholder="leave your ticket number or message have contain in title" aria-label="Username"
            aria-describedby="basic-addon1" value="<?php echo $sqb; ?>">
        <span class="input-group-text">Username</span>
        <input style="width: 10%;position: initial!important;" list="qlistoption" style="position: initial!important;"
            type="text" class="form-control" onchange="search_cr_username();" id="ts_username" name="ts_username"
            placeholder="all user" aria-label="Username" aria-describedby="basic-addon1"
            value="<?php echo $_SESSION["ts_username"];   ?>">
        <span class="input-group-text">Request for</span>
        <input style="width: 10%;position: initial!important;" list="qlistoption_rf"
            style="position: initial!important;" type="text" class="form-control" onchange="search_cr_request_for();"
            id="ts_request_for" name="ts_request_for" placeholder="all type" aria-label="Request for"
            aria-describedby="basic-addon1" value="<?php echo $_SESSION["ts_request_for"];  ?>">
        <span class="input-group-text">status</span>
        <input style="width: 10%;position: initial!important;" list="qlistoption_status"
            style="position: initial!important;" type="text" class="form-control" onchange="search_cr_status();"
            id="ts_status" name="ts_status" placeholder="all status" aria-label="status" aria-describedby="basic-addon1"
            value="<?php echo $_SESSION["ts_status"];  ?>">
        <form class="d-flex">
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
            </div>
            <button class="btn btn-dark btn-sm " style="margin-left:10px;position: initial!important;" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#content_request_canvas" aria-controls="offcanvasExample">
                <ion-icon size="small" name="add-outline" role="img" class="md icon-small hydrated"
                    aria-label="add outline">
                </ion-icon>
                New Ticket
            </button>
        </form>
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
    <div class="btn-group btn-group-sm" style="position: inherit;" role="group"
        aria-label="Basic checkbox toggle button group">
        <?php include('../get/get_list_bucket.php'); ?>
        <ul class="nav nav-pills mb-3 row p-0 me-3" id="pills-tab"
            style="right: 0;position: absolute;padding: 10px 40px;" role="tablist">
            <li class="nav-item col p-0" role="presentation">
                <button class="nav-link ts-view active m-0" id="pills-list_view_ts-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-list_view_ts" type="button" role="tab" aria-controls="pills-list_view_ts"
                    aria-selected="true">
                    <ion-icon name="reorder-four-outline" style="margin:0px"></ion-icon>
                </button>
            </li>
            <li class="nav-item col p-0" role="presentation">
                <button class="nav-link ts-view m-0" id="pills-board_view_ts-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-board_view_ts" type="button" role="tab" aria-controls="pills-board_view_ts"
                    aria-selected="false">
                    <ion-icon name="grid-outline" style="margin:0px"></ion-icon>
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
    <script>
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
        $.post("base/get/get_board_update_content.php", {
            summary_filter: summary_filter,
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
        height: 500,
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

    function cr_id_toggle(id) {
        Notiflix.Loading.hourglass('Loading...');
        if (id) {
            $.post("base/page/cr_detail.php", {
                id: id
            }, function(data) {
                // $('#calloffcanvas_cr').html(data);
                $('#col_detail').html(data);
                Notiflix.Loading.remove();
            });
        }
    }

    function open_ticket_detail(id) {
        document.getElementById('user_filter').value = "";
        document.getElementById("ns_ticket_" + id).click();
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