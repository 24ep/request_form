<?php
session_start();
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","u749625779_cdscontent") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$id = $_POST["id"];
$sql="SELECT * FROM file_manage WHERE job_number='LACF-INDEX' and file_type='Linesheet' and upload_status='Active'";
 $results = mysqli_query($con,$sql);
    if(mysqli_num_rows($results)==1){
        $row = mysqli_fetch_array($results);
    }
    echo '
    <a class="nav-link" type="button" href="https://cdse-commercecontent.com/base/'.$row["file_path"].$row["file_name"].'" >
        <ion-icon name="cloud-download"></ion-icon><span class="main-manu-nav">'.$row["file_name"].'</span>
    </a>
    ';
            
                   ?>
<!-- end -->