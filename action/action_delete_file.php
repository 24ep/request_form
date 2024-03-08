<?php
//remove form sql
    session_start();
    // include("insert_log.php");
    $id=$_POST["id"];
    $file_path = str_replace('../..','public_html',$_POST["path"]);
    $file_name = $_POST["name"];
    $file = $file_path.$file_name ;
//remove form FTP
// ftp://admin_base_csg@service-gate-cds-omni-service-gate.a.aivencloud.com/public_html/attachment/csg/attachments/ns/15359
$ftp_server = "156.67.217.3";
$ftp_conn = ftp_connect($ftp_server) or die("Error : 1Could not connect to $ftp_server");
$login = ftp_login($ftp_conn, 'admin_base_csg', '@AVNS_lAORtpjxYyc9Pvhm5O4');
// try to delete file
if (ftp_delete($ftp_conn, $file))
  {
    $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
    $sql_start =   "DELETE FROM all_in_one_project.attachment WHERE id=".$id;
    $query_start = mysqli_query($con,$sql_start);
	if($query_start) {
        echo 'The files had been deleted';
	}else{
        echo 'Error: ' . $sql_start . '<br>' . $con->error;
    }
  }
else
  {
    echo 'Error : Could not connect to '.$ftp_server;
  }
//noti
// close connection
ftp_close($ftp_conn);
mysqli_close($con);
    // header( "location: https://cdse-commercecontent.com/job_manage.php?result=$result");
    ?>