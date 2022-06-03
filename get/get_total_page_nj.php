<?php
session_start();
if($_POST["from_post"] ==true ){
  $_SESSION["user_filter"] = $_POST["user_filter"];
  $_SESSION["status_filter"] = $_POST["status_filter"];
}
  // $pagenation = $_GET["pagenation"];
 if(strpos($_SESSION["page_view"],'Followup')!==false){
  if($_SESSION['user_filter']<>""){
    $position_filter = "participant like '%".$_SESSION["user_filter"]."%'";
   }else{
    $position_filter = "(follow_up_by ='' or follow_up_by is null)";
   }
 }elseif(strpos($_SESSION["page_view"],'Buyer')!==false){
  if($_SESSION['user_filter']<>""){
    $position_filter = "participant like '%".$_SESSION["user_filter"]."%'";
   }else{
    $position_filter ="(request_username ='' or request_username is null)";
   }
 }else{
  if($_SESSION['user_filter']<>""){
    $position_filter = "participant like '%".$_SESSION["user_filter"]."%'";
   }else{
    $position_filter ="1=1";
   }
 }
 if($_SESSION['status_filter']<>""){
  $status_filter ="status like '%".$_SESSION['status_filter']."%'";
 }else{
  $status_filter ="1=1";
 }
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
   //count comment
   $sql="SELECT count(*) as total from add_new_job where ".$status_filter." and ".$position_filter;
   $result_cmcr=mysqli_query($con,$sql);
   $data=mysqli_fetch_assoc($result_cmcr);
   $total_item_rnj = $data['total'];
   //cut description
   echo "/ ".ceil($total_item_rnj/30);
   $_SESSION["total_page_rnj"] = ceil($total_item_rnj/30);
   mysqli_close($con);
   //echo
?>