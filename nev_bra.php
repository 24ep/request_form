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
    <!-- fornt -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
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
    .col-board{
        border-right:1px #f0f2fc87 solid;
    }
    .cr_title{
        margin-bottom:10px;
    }
    .status_cr_list{
        margin-right:5px;
        margin-left:10px;
        color: #d8d8d887;
        font-size: 30px;
    }
    </style>
</head>
<?php
?>