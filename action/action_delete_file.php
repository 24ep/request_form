<?php
//remove form sql
    session_start();
    // include("insert_log.php");
    $id=$_POST["id"]; 
    $file_path = $_POST["path"];

    $file_name = $_POST["name"];
    $file = 'public_html/'.$file_path.$file_name ;
//remove form FTP
// ftp://admin_base_csg@156.67.217.3/public_html/attachment/csg/attachments/ns/15359
$ftp_server = "ftp://156.67.217.3";
$ftp_conn = ftp_connect($ftp_server) or die("Error : 1Could not connect to $ftp_server");
$login = ftp_login($ftp_conn, 'admin_base_csg', '@aA417528639');
// try to delete file
if (ftp_delete($ftp_conn, $file))
  {
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
    $sql_start =   "DELETE FROM attachment WHERE id=".$id;
    $query_start = mysqli_query($con,$sql_start);
	if($query_start) {
        echo 'Done';
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
    // header( "location: https://cdse-commercecontent.com/base/job_manage.php?result=$result");
    ?>