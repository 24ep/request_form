
<?php 
session_start();
// echo ini_get('session.auto_start');

// echo session_status();
// var_dump($_SESSION);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
?>
<!doctype html>
<html lang="en">
<?php
// ini_set('allow_url_include', '1');

if (!isset($_SESSION["login_csg"])){
    // echo  "no session" ; 
    Header("Location: /login");

}else{
    include($_SERVER['DOCUMENT_ROOT'].'/homepage_new.php');
}

 ?>