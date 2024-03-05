<?php

session_start();

$con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","u749625779_cdscontent") or die("Error: " . mysqli_error($con));

mysqli_query($con, "SET NAMES 'utf8' ");

$sql="SELECT * FROM file_manage WHERE job_number='LACF-INDEX' and file_type='Linesheet' and upload_status='Active'";

 $results = mysqli_query($con,$sql);https://phpstack-1225538-4364543.cloudwaysapps.com

    if(mysqli_num_rows($results)==1){

        $row = mysqli_fetch_array($results);

    }

    echo '

    <a style="width: fit-content;font-weight: 100;color: #b53441;" id="nav_linesheet_download" class="nav-link" type="button" href="https://cdse-commercecontent.com/'.$row["file_path"].$row["file_name"].'" >

        <ion-icon name="cloud-download"></ion-icon><span class="main-menu-nav">'.$row["file_name"].'</span>

    </a>

    ';



                   ?>

<!-- end -->