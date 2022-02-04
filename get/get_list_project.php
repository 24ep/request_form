<?php


  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","u749625779_cdscontent") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT * FROM project_bucket where status = 'Open'" or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);
 ?><div class="row overflow-auto"><?php
     while($row = mysqli_fetch_array($result)) {
         echo ' 
         <div class="col-sm-6">
            <div class="card">
            <span class="position-absolute top-0 start-0 translate-middle p-2 bg-danger border border-light rounded-circle">
            <span class="visually-hidden">New alerts</span>
          </span>
            <div class="card-body">
                <h5 class="card-title">'.$row["project_name"].'</h5>
                <span class="card-text">Owner : '.$row["owner"].'.</span>
            </div>
            </div>
        </div>';

     }
  mysqli_close($con);
  ?></div> <?php

?>