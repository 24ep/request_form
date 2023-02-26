<!doctype html>
<html lang="en">
<?php
session_start();
if (!$_SESSION["login_csg"]){
    Header("Location: login");
}else{
    include('homepage_new.php');
}

 ?>