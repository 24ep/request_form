<?php
session_start();
$create_type = $_POST['create_type'];
$parent = $_POST['parent'];
$label = $_POST['label'];
$code = $_POST['code'];
$path_id = $_POST['path_id'];



function insert_folder($parent,$label,$code,$path_id){
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
	$sql = "INSERT INTO assets_directories (
	code,
    label,
    parent,
    path_id
    )
	VALUES (
    '".$code."',
    '".$label."',
    '".$parent."',
    '".$path_id."'
    )";
	$query = mysqli_query($con,$sql);
    mysqli_close($con);
}
function insert_block($parent,$label,$code,$path_id){
    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
      $sql = "INSERT INTO brand_editor (
      brand,
      update_by,
      dri_id
      )
      VALUES (
      '".$label."',
      '".$_SESSION['username']."',
      '".$parent."'
      )";
      $query = mysqli_query($con,$sql);
      mysqli_close($con);
  }

if($create_type=='folder'){
    insert_folder($parent,$label,$code,$path_id);
}
elseif($create_type=='block'){
    insert_block($parent,$label,$code,$path_id);
}




?>