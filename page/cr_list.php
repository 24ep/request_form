

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
        <div class="row">
            <div class="col-2">
                <div class="btn-group btn-group-sm" style="position: inherit;" role="group"
                    aria-label="Basic checkbox toggle button group">
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
                    <div class="d-flex align-items-start">
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <?php
                                $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
                                mysqli_query($con, "SET NAMES 'utf8' ");
                                $query = "SELECT id, project_name, prefix , color_project FROM all_in_one_project.project_bucket;" or die("Error:" . mysqli_error($con));
                                $result = mysqli_query($con, $query);
                                $bucket  = '<button class="nav-link text-start active" id="v-pills-all-tab" data-bs-toggle="pill" data-bs-target="#v-pills-all" type="button" role="tab" aria-controls="v-pills-all" aria-selected="true">';
                                $bucket  .= '<img class="me-2 rounded" src="https://ui-avatars.com/api/?name=ALL>&background=999999&color=fff&rounded=false&size=25">';
                                $bucket  .= 'All Bucket</button>';
                                while($row = mysqli_fetch_array($result)) {
                                    $bucket  .= '<button class="nav-link text-start" id="v-pills-'.$row['prefix'].'-tab" data-bs-toggle="pill" data-bs-target="#v-pills-'.$row['prefix'].'" type="button" role="tab" aria-controls="v-pills-'.$row['prefix'].'" aria-selected="true">';
                                    $bucket  .= '<div class="row"><div class="col-1"><img class="me-2 rounded" src="https://ui-avatars.com/api/?name='.$row['prefix'].'>&background='.str_replace("#","",$row['color_project']).'&color=fff&rounded=false&size=25"></div>';
                                    $bucket .= $row['project_name'].'
                                    </div>
                                    </button>';
                                }
                                mysqli_close($con);
                                echo $bucket;
                            ?>
                        </div>
                        <div class="tab-content" id="v-pills-tabContent">
                            <?php
                                $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
                                mysqli_query($con, "SET NAMES 'utf8' ");
                                $query = "SELECT id, project_name, prefix , color_project FROM all_in_one_project.project_bucket;" or die("Error:" . mysqli_error($con));
                                $result = mysqli_query($con, $query);
                                echo '<div class="tab-pane fade show active" id="v-pills-all" role="tabpanel" aria-labelledby="v-pills-all-tab" tabindex="0">...</div>';
                                while($row = mysqli_fetch_array($result)) {
                                    echo'<div class="tab-pane fade" id="v-pills-'.$row['prefix'].'" role="tabpanel" aria-labelledby="v-pills-'.$row['prefix'].'-tab" tabindex="0">';
                                    include("base/get/get_list_update_content.php?bucket=".$row['prefix']);
                                    echo '</div>';
                                }
                                mysqli_close($con);
                            ?>
                        </div>
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