<?php 
session_start();
if($_SESSION="poojaroonwit"){
    include('homepage_new.php');
}else{
    include('homepage_old.php');
}

 ?>