<?php

session_start();

$_SESSION["user_filter"] = $_GET["user_filter"];

$_SESSIOLocation:hoilter"] = $_GET["status_filter"];

$_SESSION["page_view"] = $_GET["page_view"];

// $_SESSION["launch_date_filter"] = $_POST["request_new_page_view"];

header("Location:homepage.php?tab=v-pills-request_list");

?>