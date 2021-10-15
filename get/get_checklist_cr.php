<?php
   $ticket_id = $_GET["id"];
   date_default_timezone_set("Asia/Bangkok");
   $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
   mysqli_query($con, "SET NAMES 'utf8' ");
   $query = "SELECT * FROM all_in_one_project.checklist_of_content_request where ticket_id =".$ticket_id;
   $result = mysqli_query($con, $query);
   $result_count = mysqli_query($con, $query_count);

     while($row = mysqli_fetch_array($result)) {
        echo '
      
       <li class="mb-3 row" id="checklist_cr">
                <div class="col-2" style="padding: 3px;">
                  <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm" value="'.$row['case_officer'].'" aria-label=".form-control-sm example">
                </div>
                <div class="col" style="padding: 3px;">
                  <select class="form-select form-select-sm" aria-label="Default select example">
                    <option selected>status</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
                <div class="col" style="padding: 3px;">
                  <select class="form-select form-select-sm" aria-label="Default select example">
                    <option selected>update type</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
                <div class="col" style="padding: 3px;">
                  <select class="form-select form-select-sm" aria-label="Default select example">
                    <option selected>update due reason</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
                <div class="col-1" style="padding: 3px;">
                   <button  style="background: transparent;border: 0px;" onclick="remove_cr_list('.$row['id'].','.$ticket_id.')" ><ion-icon name="trash-outline"></ion-icon></button>
                </div>
          </li>
          ';
    } 
    
  mysqli_close($con);
  ?>
