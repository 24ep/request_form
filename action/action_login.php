<?php
session_start();
$_SESSION["db_username"] = "cdse_admin";
$_SESSION["db_password"] = "@aA417528639";
include("connect.php");
include('action_insert_log.php');
$username = $_POST["username"];
$password = $_POST["password"];
//encode password
$password_encode = md5(strrev(md5(str_replace(2,4,str_replace(strpos( substr(md5($password),2,1),md5($password)),strpos( substr(md5($password),4,1),md5($password)),md5($password))))));
// get current username for check
$query = "SELECT * FROM account WHERE username = '".$username."' and password = '".$password_encode."'"or die("Error:" . mysqli_error());
$result =  mysqli_query($con, $query);
if((mysqli_fetch_array($result) === null)){
    insert_log("login faild | username ".$username." | pass ".$password,"account",0);
    header("Location: /login_page.php?respone=username หรือ password ไม่ถูกต้อง&code=".$password_encode);
}else{
    $query = "SELECT * FROM account WHERE username = '".$username."' and password = '".$password_encode."'"or die("Error:" . mysqli_error());
    $result =  mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
        $_SESSION["nickname"]=$row["nickname"];
        $_SESSION["department"]=$row["department"];
        $_SESSION["page_view"]="";
    }
    $_SESSION["cr_status_filter"] ="Pending";
    $_SESSION['login_csg']=true;
    $_SESSION['pagenation'] = 1;
    $_SESSION["user_filter"] = $username;
    $internal_role = array("Content Admin", "Content Traffic", "Content Followup", "Content Studio Traffic");
    if(in_array($_SESSION["department"], $internal_role)){
        $_SESSION["user_cr_filter"] = "all_user";
    }else{
        $_SESSION["user_cr_filter"] = $username;
    }
    $_SESSION["username"] = $username;
    $_SESSION["request_by_filter"] = $username;
    $_SESSION["request_status"] = "pending";
    $request_by = $_SESSION["username"];
    insert_log("login success | username ".$username,"account",0);
    header("Location: /homepage.php?");
}
?>
