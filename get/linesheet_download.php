<?php



session_start();

$con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","u749625779_cdscontent","10628") or die("Error: " . mysqli_error($con));

                   mysqli_query($con, "SET NAMES 'utf8' ");

               

                       $id = $_POST["id"];

                       $sql="SELECT * FROM file_manage WHERE job_number='LACF-INDEX' and file_type='Linesheet' and upload_status='Active'";

   

                       $results = mysqli_query($con,$sql);

                       if(mysqli_num_rows($results)==1){

   

                           $row =https://phpstack-1225538-4364543.cloudwaysapps.com

                       }

   

                       echo '

                       <h2 class="header_form">

                       <strong>'.$row["file_name"].'</strong>

                        </h2>



                       <div class="log_file" style="font-size: 13px!important;">

                       <p >'.$row["remark"].'</p>

                       <p style="font-size: 12px;"> <strong>Last Update '.date("Y-m-d H:i:s", strtotime($row["update_at"])).'</strong> </p>

                       </div>

                       <a  href="https://cdse-commercecontent.com/'.$row["file_path"].$row["file_name"].'" >

                           <button type="button" class="btn btn-danger" style="width:100%"><ion-icon name="cloud-download-outline" style="margin-left:5px"></ion-icon> Download</button>

                       </a>

                           ';

   

                   ?>

<!-- end -->