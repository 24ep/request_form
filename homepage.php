<?php 
session_start();
if (!$_SESSION["login_csg"]){ 
    Header("Location: login");
}else{
if($_GET['env']=="poojaroonwit"){
    include('homepage_new.php');
}else{
    include('homepage_old.php');
}
}

 ?>