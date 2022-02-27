    <?php
    session_start();
    if($_GET["audit"]=="audit" ){
        $_SESSION["nickname"]="Bos";
        $_SESSION["pf_theme"]="Dark";
        $_SESSION["department"]="Content Admin";
        $_SESSION["page_view"]="";
        $_SESSION["db_username"] = "cdse_admin";
        $_SESSION["db_password"] = "@aA417528639";
        $_SESSION["cr_status_filter"] ="Pending";
        $_SESSION['login_csg']=true;
        $_SESSION['pagenation'] = 1;
        $_SESSION["user_filter"] = "poojaroonwit";
        $internal_role = array("Content Admin", "Content Traffic", "Content Followup", "Content Studio Traffic");
        $_SESSION["user_cr_filter"] = "all_user";
        $_SESSION["username"] = "poojaroonwit";
        $_SESSION["request_by_filter"] = "poojaroonwit";
        $_SESSION["request_status"] = "pending";
        $request_by ="poojaroonwit";
    }
    if (!$_SESSION["login_csg"]){ 
            Header("Location: login");
    }else{
    // include('get/get_card_content_request.php'); 
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
        <link rel="icon" type="image/ocp" href="https://cdse-commercecontent.com/base/images/24ico.ico" />
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
        <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
        </script>
        <!-- textarray -->
        <script src="https://cdn.tiny.cloud/1/cis8560ji58crrbq17zb11gp39qhpn2lka54u0m54s8du1gw/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
        <!-- Bootstrap css -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <!-- end Bootstrap css -->
        <link href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css" rel="stylesheet">
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
        <script>
        $(function() {
            $(".multiple-select").multipleSelect()
        });
        </script>
        <!-- bootstrap js -->
        <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
        </script>
        <style>
        body {
            font-family: 'Prompt', sans-serif !important;
            font-size: 14px;
            background-color: #f6f6f6;
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
            background-image: url('base/image/11.jpg');
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

        .des_cr {
            padding: 20px;
            border-radius: 10px;
            background: #f9f9f9;
            margin-bottom: 10px;
        }

        <?php if($_SESSION["pf_theme"]=="Dark") {
            ?>body {
                font-family: 'Prompt', sans-serif !important;
                font-size: 14px;
                background-color: #1e1e1e !important;
                color: white !important;
            }

            tr.sub-ticket.shadow-sm.p-3.mb-5.bg-body {
                background-color: #171515 !important;
                color: white;
                border-bottom: 1px solid #272727 !important;
            }

            tr.shadow-sm.p-3.mb-5 {
                background-color: #171515 !important;
                color: white;
                border-bottom: 1px solid #272727 !important;
            }

            tr.sub-ticket {
                color: white;
            }

            tr {
                color: white;
            }

            .btn-primary {
                color: #fff;
                background-color: #1a1a1a;
                border-color: #134a9a;
            }

            input {
                background-color: #0f0f0f !important;
                border: 0px solid !important;
                color: white !important;
            }

            textarea {
                background-color: #0f0f0f !important;
                border: 0px solid !important;
                color: white !important;
            }

            select#status_filter {
                background-color: #414141;
                border: 0px solid;
                color: white;
                border-radius: 3px;
            }

            select#be_status_on_change {
                background-color: #0f0f0f;
                color: #b32121;
            }

            .offcanvas-body {
                background-color: #181818 !important;
                color: white;
            }

            a:hover {
                color: #dc3545;
                text-decoration: auto;
                font-weight: bold;
            }

            .nav-pills .nav-link.active,
            .nav-pills .show .nav-link {
                background-color: #dc3545 !important;
                color: #fcfcfc !important;
                width: 100%;
            }

            li.list-group-item {
                background-color: #1f1f1f !important;
                color: white;
                border: solid 1px #171717;
            }

            .alert-success {
                color: #1ac570;
                background-color: #1c3128;
                border-color: #07512f;
            }

            .form-select {
                color: #e9ecef;
                background-color: #0f0f0f;
                border-color: #0f0f0f;
            }

            li.row.shadow-sm.rounded.md-3.p-2.bg-white {
                background-color: #0f0f0f !important;
            }

            span#basic-addon1 {
                background-color: #1d1d1d;
                color: white;
            }

            .table-hover>tbody>tr:hover {
                color: #b80f0f;
            }

            .card.text-dark.bg-light.mb-3 {
                background-color: #1e1e1e !important;
                color: white !important;
                margin-top: 20px !important;
                border: 1px solid transparent !important;
                align-items: center;
            }

            .card.text-white.bg-dark.mb-3 {
                background-color: #1e1e1e !important;
                color: white !important;
                margin-top: 20px !important;
                border: 1px solid transparent !important;
                align-items: center;
            }

            table.table.table-hover {
                border-bottom: 1px solid #282727;
            }

            .border-end {
                border-right: 1px solid #2c2c2c !important;
            }

            hr {
                background-color: #4f4f4f;
            }

            .col-5 {
                background-color: #121212 !important;
            }

            .des_cr {
                padding: 20px;
                border-radius: 10px;
                background: #0e0e0e;
                margin-bottom: 10px;
            }

            .load_cr_dt {
                background-color: #212121;
            }

            .card-body {
                align-self: normal;
            }

            button.ms-choice {
                background-color: #0f0f0f;
                border-color: #0f0f0f;
            }

            .col-7 {
                flex: 0 0 auto;
                width: 58.3333333333%;
                border-right: 1px solid #191919;
            }

            .col-8 {
                flex: 0 0 auto;
                width: 66.6666666667%;
                border-right: 1px solid #2f2d2d;
            }

            .col-2.list_bra.window-full.shadow {
                background-color: transparent !important;
                padding: 30px;
                box-shadow: none !important;
            }

            <?php
        }

        elseif($_SESSION["pf_theme"]=="Light Modern") {
            ?>.col-2.list_bra.window-full.shadow {
                background-color: transparent !important;
                padding: 30px;
                box-shadow: none !important;
            }

            .nav-pills .nav-link.active,
            .nav-pills .show .nav-link {
                /* background-color: #dc3545 !important; */
                background-color: #ffabb3 !important;
                color: #fcfcfc !important;
                width: 100%;
            }

            .list_bra .nav-pills .nav-link {
                color: #212529 !important;
                font-weight: 700;
            }

            .nav-.list_bra .nav-link:hover {
                color: #dc3545 !important;
                font-weight: bolder;
            }

            ion-icon {
                color: black !important;
            }

            ion-icon:hover {
                color: #dc3545;
            }

            .nav-link.active {
                color: white;
            }

            button.btn.btn-toggle.align-items-center.rounded.collapsed {
                color: black !important;
                font-weight: 700;
            }

            button.btn.btn-toggle.align-items-center.rounded {
                color: black !important;
                font-weight: 300;
            }

            .link-light {
                color: black;
                padding: 0.2rem;
                padding-left: 40px;
                font-weight: 400;
                line-height: 1.5;
                font-size: 14px;
                font-family: 'Prompt', sans-serif !important;
            }

            .hr_nav_bra {
                width: 80%
            }


            .navbar-brand {
                color: #6c757d !important;
            }

            <?php
        }

        ?>

        /* add test */
        .tree_label {
            padding-left: 15px;
            color: gray;
        }

        .tree_label:after {
            position: absolute;
            top: 0em;
            left: -2px;
            display: table-column-group;
            height: 10px;
            width: 20px;
            border-bottom: 2px solid #727476;
            border-left: 2px solid #727476;
            border-radius: 0 0 0 .4em;
            content: '';
            padding-top: 23px;
        }

        .tree_lift {
            left: 0px;
            position: relative;
            border-left: 2px solid #6c757d;
        }

        .tree_lift_end {
            left: 0px;
            position: relative;
            border-left: 2px solid transparent;
        }

        .sub-ticket {
            border: 0px solid transparent
        }

        label.tree_label:hover {
            color: #666;
        }

        /* add test */

        /* width */
        </style>
    </head>

    <body onload="doAutoRefresh();filter_update();doAutoRefresh_cr();doAutoRefresh_ts_admin();">
        <!-- Modal -->
        <div class="modal fade " id="project_model" tabindex="-1" aria-labelledby="project_modelLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" style="border-radius: 3%;">
                <div class="modal-content">
                    <div id="return_project_model">
                    </div>
                </div>
            </div>
        </div>
        <!-- toast -->
        <!-- <div class="toast align-items-center text-white bg-primary border-0 top-0 end-0" role="alert" data-bs-autohide="true" aria-atomic="true" data-bs-delay="10000" aria-live="assertive" id="liveToast_cr" style="z-index: 11">
            <div class="d-flex">
              <div class="toast-body" id="toast">
                Hello, world! This is a toast message.
              </div>
              <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
          </div> -->
        <!-- toast -->
        <!--         <nav class="navbar sticky-top navbar-danger bg-danger">
          <marquee>
           <span class="navbar-text" style="color:white" >
                แจ้งปิดรับการส่งสร้างสินค้าใหม่ สำหรับปี 2021 ตั้งแต่วันที่ 24 ธันวาคม 2021 - 4 มกราคม 2022 , สำหรับ content request ยังสามารถส่งได้ตามปกติ หากมีข้อสงสัย สามารถสอบถามได้จากน้อง content follow-up และ studio ได้เลยครับ
          </span>
          </marquee>
         </nav> -->
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
            <?php 
         if(strpos($_SESSION["department"],'Content Admin')!==false){
            $nev_avg = "background: #212121;";
         }
        ?>
        <!-- start nav normal -->
           <?php 
           if($_SESSION["pf_theme"]<>"Light Modern") {
           include('nev_bra.php');
         
           }else{
            include('nev_bra_modern.php');
           }
           ?>
             
            <div class="col-10 window-full overflow-auto">
                <div class="tab-content" id="v-pills-tabContent">
                    <!-- style="margin-top:15px" -->
                    <div class="tab-pane fade show active" id="v-pills-dashboard" role="tabpanel"
                        aria-labelledby="v-pills-dashboard-tab">
                        <div class="container overflow-auto" style="padding:20px 20px 0px 20px">
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
                            <div class="row">
                                <div class="col-8" style="border-right: 1px solid #efecec;">
                                    <?php include("get/get_list_job_cms_dashboard.php"); ?>
                                </div>
                                <div class="col-4">
                                    <?php include("get/get_list_message_log.php"); ?>
                                </div>
                            </div>
                            <?php //include('get/get_list_message_log.php'); ?>
                            <!-- <hr>
                            <?php //include('get/get_list_job_cms_dashboard.php'); ?> -->
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
                                    <input value="<?php echo $_SESSION["user_filter"];?>" class="selection_filter"
                                        list="datalistOptionsuser" id="user_filter" onchange="filter_update();"
                                        placeholder="Type to username...">
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
                                                            action="base/action/action_submit_add_new_job.php"
                                                            method="POST">
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
                            </div>
                            <!-- ffff -->
                        </div>
                    </div>
                    <!-- <div class="tab-pane fade" id="v-pills-cr_admin" role="tabpanel"
                        aria-labelledby="v-pills-cr_admin-tab">
                        <div class="tab-content" id="myTabContent">
                            <div class="row align-items-center" style="padding:20px">
                                <div class="container ">
                                    <div class="row">
                                        <div class="col col-board window-full col-2" id="col_pending"
                                            ondrop="drop_card_cr(event,'Pending')" ondragover="allowDrop(event)">
                                            <small style="margin-bottom:5px"><strong>Pending</strong></small>
                                            <?php //echo get_card("Pending");?>
                                        </div>
                                        <div class="col col-board window-full col-2" id="col_inprogress"
                                            ondrop="drop_card_cr(event,'Inprogress')" ondragover="allowDrop(event)">
                                            <small style="margin-bottom:5px"><strong>Inprogress</strong></small>
                                            <?php //echo get_card("Inprogress");?>
                                        </div>
                                        <div class="col col-board window-full col-2" id="col_waiting_user"
                                            ondrop="drop_card_cr(event,'Waiting Buyer')" ondragover="allowDrop(event)">
                                            <small style="margin-bottom:5px"><strong>Waiting Buyer</strong></small>
                                            <?php //echo get_card("Waiting Buyer");?>
                                        </div>
                                        <div class="col col-board window-full col-2" id="col_wait_excution"
                                            ondrop="drop_card_cr(event,'Waiting Excution')"
                                            ondragover="allowDrop(event)">
                                            <small style="margin-bottom:5px"><strong>Waiting Execution</strong></small>
                                            <?php //echo get_card("Waiting Execution");?>
                                        </div>
                                        <div class="col col-board window-full col-2" id="col_wait_cto"
                                            ondrop="drop_card_cr(event,'Waiting CTO')" ondragover="allowDrop(event)">
                                            <small style="margin-bottom:5px"><strong>Waiting CTO</strong></small>
                                            <?php //echo get_card("Waiting CTO");?>
                                        </div>
                                        <div class="col col-board window-full col-2" id="col_close_cancel"
                                            ondrop="drop_card_cr(event,'Close')" ondragover="allowDrop(event)">
                                            <small style="margin-bottom:5px"><strong>Close (latest 5)</strong></small>
                                            <?php //echo get_card("Close");?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- ts console -->
                    <div class="tab-pane fade" id="v-pills-ts_admin" role="tabpanel"
                        aria-labelledby="v-pills-ts_admin-tab">
                        <div class="tab-content" id="myTabContent">
                            <div class="row align-items-center" style="padding:20px">
                                <div class="container ">
                                    <nav class="navbar">
                                        <div class="container-fluid p-0">
                                            <a class="navbar-brand"></a>
                                            <form class="d-flex">
                                                <div class="btn-group" role="group"
                                                    aria-label="Basic checkbox toggle button group">

                                                </div>
                                                <button class="btn btn-primary btn-sm " style="margin-left:10px;"
                                                    type="button" data-bs-toggle="offcanvas"
                                                    data-bs-target="#project_sticky" aria-controls="project_sticky">
                                                    <ion-icon size="small" name="file-tray-stacked-outline" role="img"
                                                        class="md icon-small hydrated" aria-label="add outline">
                                                    </ion-icon>
                                                    project sticky
                                                </button>
                                                <button class="btn btn-primary btn-sm " style="margin-left:10px;"
                                                    type="button" data-bs-toggle="offcanvas"
                                                    data-bs-target="#content_request_canvas"
                                                    aria-controls="offcanvasExample">
                                                    <ion-icon size="small" name="add-outline" role="img"
                                                        class="md icon-small hydrated" aria-label="add outline">
                                                    </ion-icon>
                                                    New Ticket
                                                </button>
                                            </form>
                                        </div>
                                    </nav>
                                    <nav class="navbar">
                                        <form style="width:100%">
                                            <div class="input-group input-group-sm mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <ion-icon style="vertical-align: middle;" name="terminal-outline">
                                                    </ion-icon>Query Search
                                                </span>
                                                <?php 
                                                if($_SESSION["ts_query_input"]<>""){
                                                    $sqb = $_SESSION["ts_query_input"];
                                                }else{
                                                    $sqb =  "ticket.case_officer like  '%".$_SESSION["username"]."%' ";
                                                }
                                                ?>
                                                <input list="qlistoption" style="width: 75%;" type="text"
                                                    class="form-control" onchange="run_ts_command('task');"
                                                    id="ts_command" name="ts_command"
                                                    placeholder="Your task will display follow your command .."
                                                    aria-label="Username" aria-describedby="basic-addon1"
                                                    value="<?php echo $sqb;   ?>">
                                                <span class="input-group-text">Limit</span>
                                                <input type="number" max="999" onchange="run_ts_command('task');"
                                                    min="1" class="form-control" id="ts_command_limit"
                                                    name="ts_command_limit" placeholder="Server" value="100"
                                                    aria-label="Server">
                                            </div>
                                            <datalist id="qlistoption">
                                                <option
                                                    value="(ticket.participant like  '%<?php echo $_SESSION["username"]; ?>%' or ticket.case_officer like '%<?php echo $_SESSION["username"]; ?>%')">
                                                <option
                                                    value="ticket.participant like  '%<?php echo $_SESSION["username"]; ?>%'">
                                                <option
                                                    value="ticket.case_officer like '%<?php echo $_SESSION["username"]; ?>%'">
                                                <option value="ticket.title like  '%grouping%'">
                                                <option value="ticket.id = 3009">
                                                <option value="ticket.status = 'Pending'">
                                            </datalist>
                                        </form>
                                    </nav>
                                    <div id="project_bucket">
                                        <?php //if(strpos($_SESSION["username"],'poojaroonwit')!==false){ 
                                       
                                        include('get/get_list_project.php');
                                    // } ?>
                                    </div>
                                    <div id="get_ts_admin_console">

                                        <?php 
                                       
                                            include('get/get_list_ts.php');
                                   
                                         ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- fl console -->
                    <div class="tab-pane fade" id="v-pills-fl_board" role="tabpanel"
                        aria-labelledby="v-pills-fl_board-tab">
                        <div class="tab-content" id="myTabContent">
                            <div class="row align-items-center" style="padding:20px">
                                <div class="container ">
                                    <!-- get card -->
                                    <div id="get_card_add_new">
                                        <?php //include('get/get_card_new_job.php'); ?>
                                    </div>
                                    <!-- get card -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="tab-pane fade" id="v-pills-ms_admin" role="tabpanel"
                        aria-labelledby="v-pills-ms_admin-tab">
                        <div class="tab-content" id="myTabContent">
                            <div class="row align-items-center" style="padding:20px">
                               <div class="container ">
                                </div> -->
                    <!-- <div class="container-fluid" style="border-radius: 10px;width: 95%;">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="list-group" id="list-tab" role="tablist">
                                                <?php //if(strpos($_SESSION["department"],'Content Admin')!==false){?>
                                                <a class="btn btn-dark" style="margin-bottom: 10px;" type="button"
                                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop"
                                                    aria-controls="offcanvasWithBackdrop">
                                                    <ion-icon name="add-outline"></ion-icon>Create
                                                </a>
                                                <?php// } ?>
                                                <a class="list-group-item list-group-item-action active"
                                                    id="list-important-list" data-bs-toggle="list"
                                                    href="#list-important" role="tab" aria-controls="list-important">
                                                    <ion-icon name="star-outline"></ion-icon> Important <span
                                                        id="total_unread_div_in"></span>
                                                </a> -->
                    <!-- <a class="list-group-item list-group-item-action" id="list-update-list"
                                                    data-bs-toggle="list" href="#list-update" role="tab"
                                                    aria-controls="list-update">
                                                    <ion-icon name="notifications-outline"></ion-icon> Updated
                                                </a> -->
                    <!-- <a class="list-group-item list-group-item-action" id="list-send-list"
                                                    data-bs-toggle="list" href="#list-send" role="tab"
                                                    aria-controls="list-send">
                                                    <ion-icon name="paper-plane-outline"></ion-icon> Send
                                                </a>
                                            </div>
                                        </div> -->
                    <!-- <div class="col-10">
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
                                                            <?php //include('get/get_list_message.php'); ?>
                                                        </tbody>
                                                    </table>
                                                </div> -->
                    <!-- <div class="tab-pane fade" id="list-update" role="tabpanel"
                                                    aria-labelledby="list-update-list">
                                                    <?php// include('get/get_list_message_log.php'); ?>
                                                </div> -->
                    <!-- <div class="tab-pane fade" id="list-send" role="tabpanel"
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
                                                            <?php //include('get/get_list_send_message.php'); ?>
                                                        </tbody>
                                                    </table>
                                                    Modal
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
                                                                <?php //echo $username_op;?>
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
                    </div>-->
                    <!-- offcanvas detail cr -->
                    <div class="offcanvas offcanvas-start" tabindex="0" id="detail_cr" style="width:100%"
                        aria-labelledby="offcanvasExampleLabel">
                        <div id="calloffcanvas_cr">
                        </div>
                    </div>

                    <!-- offcanvas project sticky cr -->

                    <div class="offcanvas offcanvas-start" tabindex="-1" id="project_sticky"
                        aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Project sticky</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div style="margin-bottom:10px">
                                Select project you wnt to see , this option will show only project are not close
                            </div>
                            <select class="form-select" style="border: 0px;margin-top: 30px;" size="25"
                                id="project_sticky_mse" onclick="update_project_sticky();run_ts_command('task');"
                                multiple aria-label="multiple select example">

                                <?php
                               
                                    $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
                                    mysqli_query($con, "SET NAMES 'utf8' ");
                                    $query = "SELECT * FROM project_bucket where status <> 'Close' ORDER BY id asc" or die("Error:" . mysqli_error());
                                    $result = mysqli_query($con, $query);
                                    if($_SESSION["prefix_project_sticky"]==""){
                                        $_SESSION["prefix_project_sticky"] = "'CR','DT'";
                                    }

                                    while($row = mysqli_fetch_array($result)) {

                                        if(strpos($_SESSION["prefix_project_sticky"],$row['prefix'])!==false){
                                            echo  "<option selected value='".$row["prefix"]."'>".$row["project_name"]."</option>";
                                        }else{
                                            echo "<option value='".$row["prefix"]."'>".$row["project_name"]."</option>";
                                        }
                                    }
                                
                                ?>

                            </select>
                        </div>
                    </div>
                    <!-- offcanvas create -->
                    <div class="col-auto" style="right: 20px;position: absolute;margin-top: 10px;">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-sm">
                                <div class="offcanvas offcanvas-start" style="width:70%" tabindex="-1"
                                    id="content_request_canvas" aria-labelledby="offcanvasExampleLabel">
                                    <div class="offcanvas-header" style="    background: #313131;color: white;">
                                        <h5 class="offcanvas-title" id="offcanvasExampleLabel"
                                            style="padding-left:50px;font-weight: bold;">
                                            <ion-icon style="margin-right:10px" name="add-circle-outline">
                                            </ion-icon>Request Creation
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white text-reset"
                                            data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body" style="background-color: #fcfbf9;">
                                        <div class="container-md" style="padding:0px 50px 50px 50px;">
                                            <form class="row g-3"
                                                action="base/action/action_submit_add_content_request.php" method="POST"
                                                enctype="multipart/form-data">
                                                <div id="add_new_cr_result">
                                                </div>
                                                <?php include_once('form/form_create_content_request.php')?>
                                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                    <button type="submit" class="btn btn-primary btn-sm"
                                                        style="width:100%">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </nav>
                    </div>
                    <!-- offcanvas create -->
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
    </body>
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
    <!-- end bootsrap js -->
    <script>
function call_edit_add_new_modal(id, brand) {
    if (id) {
        $.post("base/modal/edit_request_add_new.php", {
            id: id
        }, function(data) {
            $('#callmodal_request_add_new').html(data);
        });
    }
}

function cr_id_toggle(id) {
    if (id) {
        $.post("base/get/get_content_request_detail.php", {
            id: id
        }, function(data) {
            $('#calloffcanvas_cr').html(data);
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
        sku_accepted = document.getElementById('sku_accepted').value;
        if (sku_accepted == null) {
            alert("กรุณาระบ sku ที่ accept (ตัดซ้ำ ตัด cancel ออกแล้ว)")
        } else {
            $.post("base/action/action_accept_stt.php", {
                id: id,
                sku_accepted: sku_accepted
            }, function(data) {
                $('#accept_checking_resault').html(data);
            });
        }
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
    var ts_command_input = document.getElementById("ts_command").value;
    var ts_command_limit = document.getElementById("ts_command_limit").value;
    var summary_filter = ts_command_input;
    $.post("base/get/get_list_ts.php", {
        summary_filter: summary_filter,
        ts_command_limit: ts_command_limit

    }, function(data) {
        $('#get_ts_admin_console').html(data);
    });
}
    </script>
    <script type="text/javascript">
function select_current_tab(selecttab) {
    if (selecttab == "v-pills-dashboard") {
        document.getElementById("v-pills-dashboard-tab").classList.add('active');
        document.getElementById("v-pills-request_list-tab").classList.remove('active');
        document.getElementById("v-pills-cr-tab").classList.remove('active');
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
    } else if (selecttab == "v-pills-fl_board") {
        document
            .getElementById("v-pills-dashboard-tab")
            .classList
            .remove('active');
        document
            .getElementById("v-pills-cr-tab")
            .classList
            .remove('active');
        document
            .getElementById("v-pills-fl_board-tab")
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
            .remove('active');
        document
            .getElementById("v-pills-fl_board")
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
            .remove('show');
        document
            .getElementById("v-pills-request_list")
            .classList
            .remove('show');
        document
            .getElementById("v-pills-fl_board")
            .classList
            .add('show');
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
    <?php 
                $tab_select = $_GET["tab"];
                echo '<script>select_current_tab("'.$tab_select.'");</script>';
                ?>
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
    var url = window.location.href;
    let result = url.includes("v-pills-request_list");
    if (result == true) {
        var req = Inint_AJAX();
        //var req_cr = Inint_AJAX();
        // Ajax ส่งค่าไปสอบถามเวลาจาก Server ที่ไฟล์ time.php
        req.open("POST", 'base/get/get_list_new_job.php?' + new Date().getTime(), true);
        //req_cr.open("POST", 'get/get_list_content_request.php?' + new Date().getTime(), true);
        // กำหนด ฟังก์ชั่นเพื่อส่งค่ากลับ
        req.onreadystatechange = function() {
            if (req.readyState == 4) {
                if (req.status == 200) {
                    // รับค่ากลับมา และ แสดงผล
                    //document.getElementById("list_grouping").innerHTML = req_cr.responseText;
                    document.getElementById("job_list").innerHTML = req.responseText;
                    // Auto Refresh กลับมาอ่าน เวลาทุก 30 วินาที สำหรับรอบต่อไป
                    setTimeout("doAutoRefresh()", 5000);
                }
            }
        };
        req.send(null);
    }
};

function doAutoRefresh_ts_admin() {
    var url = window.location.href;
    let result = url.includes("v-pills-ts_admin");
    if (result == true) {
        var req_ts = Inint_AJAX();
        //var req_cr = Inint_AJAX();
        // Ajax ส่งค่าไปสอบถามเวลาจาก Server ที่ไฟล์ time.php
        req_ts.open("POST", 'base/get/get_list_ts.php?' + new Date().getTime(), true);
        //req_cr.open("POST", 'get/get_list_content_request.php?' + new Date().getTime(), true);
        req_ts.onreadystatechange = function() {
            if (req_ts.readyState == 4) {
                if (req_ts.status == 200) {
                    // รับค่ากลับมา และ แสดงผล
                    //document.getElementById("list_grouping").innerHTML = req_cr.responseText;
                    document.getElementById("get_ts_admin_console").innerHTML = req_ts.responseText;
                    // Auto Refresh กลับมาอ่าน เวลาทุก 30 วินาที สำหรับรอบต่อไป
                    setTimeout("doAutoRefresh_ts_admin()", 1000);
                }
            }
        };
        req_ts.send(null);
    }
};

function doAutoRefresh_cr() {
    var url = window.location.href;
    let result = url.includes("v-pills-cr");
    if (result == true) {
        var req_cr = Inint_AJAX();
        // Ajax ส่งค่าไปสอบถามเวลาจาก Server ที่ไฟล์ time.php
        req_cr.open("POST", 'base/get/get_list_content_request.php?' + new Date().getTime(), true);
        // กำหนด ฟังก์ชั่นเพื่อส่งค่ากลับ
        req_cr.onreadystatechange = function() {
            if (req_cr.readyState == 4) {
                if (req_cr.status == 200) {
                    // รับค่ากลับมา และ แสดงผล
                    document.getElementById("list_grouping").innerHTML = req_cr.responseText;
                    setTimeout("doAutoRefresh_cr()", 5000);
                }
            }
        };
        req_cr.send(null);
    }
};
// function doAutoRefresh_can() {
//     var req_can = Inint_AJAX();
//     //var req_cr = Inint_AJAX();
//     // Ajax ส่งค่าไปสอบถามเวลาจาก Server ที่ไฟล์ time.php
//     req_can.open("POST", 'base/get/get_card_new_job.php?' + new Date().getTime(), true);
//     req_can.onreadystatechange = function() {
//         if (req_can.readyState == 4) {
//             if (req_can.status == 200) {
//                 // รับค่ากลับมา และ แสดงผล
//                 //document.getElementById("list_grouping").innerHTML = req_cr.responseText;
//                 document.getElementById("get_card_add_new").innerHTML = req_can.responseText;
//                 // Auto Refresh กลับมาอ่าน เวลาทุก 30 วินาที สำหรับรอบต่อไป
//                 setTimeout("doAutoRefresh_can()", 50000);
//             }
//         }
//     };
//     req_can.send(null);
// };
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
// tinymce.init({
//     selector: 'textarea#cr_description',
//     height: 380,
//     menubar: false,
//     plugins: [
//         'advlist autolink lists link image charmap print preview anchor',
//         'searchreplace visualblocks code fullscreen',
//         'insertdatetime media table paste code help wordcount'
//     ],
//     toolbar: 'bold italic backcolor | alignleft aligncenter ' +
//         'alignright alignjustify | bullist numlist outdent indent | ' +
//         'removeformat | help',
//     //content_style: 'body { font-family: Prompt, sans-serif; font-size:14px }'
// });
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
//   var toastElList = [].slice.call(document.querySelectorAll('.toast'))
//   var toastList = toastElList.map(function (toastEl) {
//   return new bootstrap.Toast(toastEl, option)
// })
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
        $.post("base/action/action_update_cr_detail.php", {
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
    }
    if( $_GET["cr_open"]<>""){
        // echo '<script>document.getElementById("cr_search_input").value ='.$_GET["cr_open"].'</script>';
        // document.getElementById("ns_ticket_" + id).click();
        echo '<script>cr_id_toggle('.$_GET["cr_open"].');</script>';
        echo '<script>
        var detail_cr = document.getElementById("detail_cr")
        var bsOffcanvas = new bootstrap.Offcanvas(detail_cr)
        bsOffcanvas.show()
        </script>';
        }
    } ?>

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>