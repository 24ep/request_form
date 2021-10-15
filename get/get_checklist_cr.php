<?php
function getoption_return_edit_job($col,$table,$select_option,$sorm) {
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $query = "SELECT * FROM $table ORDER BY $col asc" or die("Error:" . mysqli_error());
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
  // split array store
          if($sorm=="multi"){
            if($col=="store" or $col=="itemmize_type" or $col=="product_website"){
              $array_store = explode(', ', $select_option);
              $duplicate_op = false;
              $loop_in_null = false;
              foreach($array_store as $store)
              {
                if($row[$col] <> '' ) {
                  if($store==$row[$col]){
                    $option_set .= '<option value="'.$row[$col].'" selected>'.$row[$col].'</option>';
                    $duplicate_op = true;
                  }
                }
              }
              if($row[$col] <> ''){
                if($duplicate_op == false){
                  $option_set .= '<option value="'.$row[$col].'">'.$row[$col].'</option>';
                }
              }
            }
          }else{
            if($loop_in_null==false){
              $option_set .= '<option value=""></option>';
              $loop_in_null=true;
            }
              if($row[$col] <> '' )
              {
                  if($select_option==$row[$col]){
                    $option_set .= '<option value="'.$row[$col].'" selected>'.$row[$col].'</option>';
                  }else{
                      $option_set .= '<option value="'.$row[$col].'">'.$row[$col].'</option>';
                  }
              }
      }
    }
       return $option_set;
       mysqli_close($con);
      }
  
   $ticket_id = $_GET["id"];
   date_default_timezone_set("Asia/Bangkok");
   $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
   mysqli_query($con, "SET NAMES 'utf8' ");
   $query = "SELECT * FROM all_in_one_project.checklist_of_content_request where ticket_id =".$ticket_id;
   $result = mysqli_query($con, $query);
   $result_count = mysqli_query($con, $query_count);
   $cl_edit_case_officer = "'cl_edit_case_officer'";
   $cl_edit_status = "'cl_edit_status'";
   $cl_edit_sku = "'cl_edit_sku'";
     while($row = mysqli_fetch_array($result)) {
        echo '
      
       <li class="mb-3 row" id="checklist_cr">
                <div class="col-2" style="padding: 3px;">
                    <select id="cl_edit_case_officer" name="cl_edit_case_officer" onchange="update_cl_detail('.$row["id"].','.$cl_edit_case_officer.')" class="form-select form-select-sm" aria-label="Default select example">
                        ';
                        $op_username_cl = getoption_return_edit_job("username","account", $row["case_officer"],"single");
                        echo $op_username_cl;
                        echo'
                    </select>
                </div>
                <div class="col-2" style="padding: 3px;">
                  <input id="cl_edit_sku" name="cl_edit_sku" onchange="update_cl_detail('.$row["id"].','.$cl_edit_sku.')" class="form-control form-control-sm" type="number" placeholder="sku" value="'.$row['sku'].'" aria-label=".form-control-sm example">
                </div>
                <div class="col" style="padding: 3px;">
                  <select id="cl_edit_status" name="cl_edit_status" onchange="update_cl_detail('.$row["id"].','.$cl_edit_status.')" class="form-select form-select-sm" aria-label="Default select example">
                        ';
                        $op_status_cl = getoption_return_edit_job("content_request_status","option", $row["status"],"single");
                        echo $op_status_cl;
                        echo'
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
