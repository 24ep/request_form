<?php


  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT * FROM project_bucket where status = 'Open' order by sticky DESC" or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);
  
 ?><div class="overflow-auto slide" style="padding: 10px;margin-bottom:10px">
 <div class="card-group" style="width: max-content;"><?php
     while($row = mysqli_fetch_array($result)) {
       if($row["sticky"]==1){
        $sticky_style= 'style="border: solid 3px #75dfa5c7;border-radius: 10px!important;"';
       }else{
         unset($sticky_style);
       }
         echo ' 
            <div class="card" style="margin: 10px;border-radius: 10px!important;">
                <div class="card-body" '.$sticky_style.'>
                    <h6 class="card-title">'.$row["prefix"]." | ".$row["project_name"].'</h6>
                    <span class="card-text">Owner : '.$row["owner"].'.</span>
                </div>
            </div>
          
       ';

     }
  mysqli_close($con);
  ?>

</div>
<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div><?php

?>