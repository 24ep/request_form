<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Content and Studio - Homepage</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link
            rel="icon"
            type="image/ocp"
            href="https://cdse-commercecontent.com/images/24ico.ico"/>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link
            href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap"
            rel="stylesheet">
        <!-- google font Quicksand -->
        <!-- <link rel="preconnect" href="https://fonts.gstatic.com"> <link
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap"
        rel="stylesheet"> -->
        <!-- end google font -->
        <!-- fornt -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <!-- Bootstrap css -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
            crossorigin="anonymous">
        <!-- end Bootstrap css -->
        <link
            href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css"
            rel="stylesheet">
        <link
            href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css"
            rel="stylesheet"
            type="text/css"/>
        <style>
body {
                font-family: 'Prompt', sans-serif;
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
                font-weight: 800!important;
            }
            .row {
                margin-bottom: 15px;
            }
            .multiple-select {
                width: 200px;
            }
            .header_form {
                text-align: center;
                margin-bottom: 50px;
                margin-top: 50px;
            }
            .container-sm {
                max-width: 500px;
                margin-top: 8%;
                padding: 10px!important 50px!important 100px!important !important;
            }
            .list_bra .nav-pills .nav-link.active,
            .list_bra .nav-pills .show .nav-link {
                color: #fff;
                /* background-color: black; */
                border-radius: unset;
                background-color: #ff4747;
            }
            .list_bra .nav-pills .nav-link{
                color: #eee!important;
            }
            .list_bra .nav-link:hover{
                color: #ff4747!important;
            }
            .list_bra .nav-link.active:hover{
                color: #eee!important;
            }
            .nav-pills .nav-link.active,
            .nav-pills .show .nav-link { 
                background-color: #dc3545;
            }
            .navbar-brand {
                margin-left: 10px;
                margin-right: 10px;
                font-weight: 1000;
            }
            .navbar-brand{
                color: #eee!important;
            }
            .navbar-brand:hover{
                color: #eee!important;
            }
            .list_bra {
                padding-right: 0;
                /* background: rgba(236, 236, 236, 1); */
                /* background: #191919; */
                background: rgb(0 0 0 / 72%);
                color: black;
            }
            .linebutton {
                background: #00C300;
                border: 0;
                color: #FFFFFF;
            }
            .linebutton:hover {
                background: #00E000;
                border: 0;
                color: #FFFFFF;
            }
            .linebutton:disabled {
                background: #C6C6C6;
                border: 0;
                color: #FFFFFF;
            }
            .my-1{
                margin-top: 1rem!important;
                margin-bottom: 1rem!important;
            }
            .selection_filter{
                width: 150px;
                border: transparent;
                /* border-bottom:1px gray; */
                /* border-bottom-style: dotted; */
            }
            .selection_filter:active{
                border: transparent!important;
            }
            .selection_filter:focus{
                border: transparent!important;
                border-style:none;
            }
        </style>
         </head>
    <body>
    <div class="container-sm" style="max-width:800px">
<?php
$id=$_GET["id"];
echo "ID NJ-".htmlspecialchars($id,  ENT_QUOTES, 'UTF-8')."<br>";
echo '<h5>Need more information</h5>';
echo '<form action="/action/action_submit_need_more_info.php" method="POST">';
echo '<div class="form-group">
        <input type="hidden" id="id" name="id" value='.htmlspecialchars($id,  ENT_QUOTES, 'UTF-8').'>
        <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Need more ? </label>
        <select class="custom-select mr-sm-2" id="need_more_status" name="need_more_status"style="margin-bottom:10px">
            <option>Data</option>
            <option>Image</option>
            <option>Data and Image</option>
        </select>
        <textarea class="form-control" id="need_more_info_note" name="need_more_info_note" rows="8"></textarea>
        <button type="submit" id="" name=""  class="btn btn-dark" style="margin-top:20px;right:0px">Submit</button>
      </div>';
echo '</form>' ;
  ?>
</div>
</body>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script
            src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
        <script
            src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js"
            type="text/javascript"></script>
        <script
            src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
        <!-- end bootsrap js -->
        <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
            </html>