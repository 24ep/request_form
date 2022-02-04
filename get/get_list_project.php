<?php


  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT * FROM project_bucket where status = 'Open'" or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);
 ?><div class="row overflow-auto"><?php
     while($row = mysqli_fetch_array($result)) {
         echo ' 
         <div class="col-sm-6">
         <span class="position-absolute top-0 start-0 translate-middle p-2 bg-info border border-light rounded-circle" style="background:#0dcaf0;">
         <span class="visually-hidden">New alerts</span>
            <div class="card">
         
          </span>
            <div class="card-body" style="border: solid 2px #0dcaf0;">
                <h5 class="card-title">'.$row["project_name"].'</h5>
                <span class="card-text">Owner : '.$row["owner"].'.</span>
            </div>
            </div>
        </div>';

     }
  mysqli_close($con);
  ?></div> <?php

?>