<?php
//remove form sql
    session_start();
    date_default_timezone_set("Asia/Bangkok");
    include("insert_log.php");
    $id=$_POST["id"];
    $job_number=$_POST["job_number"];
    $file_path = $_POST["path"];
    $file_name = $_POST["name"];
    $row = $_POST["row"];
    $file = "base/".$file_path.$file_name ;
//remove form FTP
$ftp_server = "ftp.content-service-gate.cdse-commercecontent.com";
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
$login = ftp_login($ftp_conn, 'admin_base_csg', '@aA417528639');
// try to delete file
if (ftp_delete($ftp_conn, $file))
  {
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
    echo 'Error form FTP : ' . $sql_start . '<br>' . $ftp_conn->error;
  }
//noti


// close connection
ftp_close($ftp_conn);
mysqli_close($con);
    // header( "location: https://cdse-commercecontent.com/base/job_manage.php?result=$result");
    ?>