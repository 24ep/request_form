<?php 
session_start();
if (!$_SESSION["login_csg"]){ 
    Header("Location: login");
}else{
    if(strpos($_SESSION["role"],'deverloper')!==false){
        include('homepage_new.php');
    }else{
        include('homepage_old.php');
    }
}

 ?>