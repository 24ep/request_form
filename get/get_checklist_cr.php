<?php
  session_start();
function return_s_select_box_cl_cr($current_value,$attr_id){
    session_start();
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
      $query_op = "SELECT * FROM content_service_gate.attribute_option
      WHERE attribute_id = ".$attr_id." and function = 'cl_content_request' ORDER BY option_id ASC" or die("Error:" . mysqli_error());
      $result_op = mysqli_query($con, $query_op);
      if($current_value==""){
        $option_element = "<option selected value=''></option>";
      }
      while($option = mysqli_fetch_array($result_op)) {
        if($option["attribute_option"]==$current_value){
            $option_element .= "<option selected value='".$option["attribute_option"]."'>".$option["attribute_option"]."</option>";
          }else{
            $option_element .= "<option value='".$option["attribute_option"]."'>".$option["attribute_option"]."</option>";
          }
      }
    return $option_element;
  }
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
   $cl_edit_update_due_reason= "'cl_edit_update_due_reason'";
   $cl_edit_update_type= "'cl_edit_update_type'";
     while($row = mysqli_fetch_array($result)) {
        echo '
       <li class="mb-3 row" id="checklist_cr">
                <div class="col-2" style="padding: 3px;">
                    <select id="cl_edit_case_officer_'.$row["id"].'" name="cl_edit_case_officer_'.$row["id"].'" onchange="update_cl_detail('.$row["id"].','.$cl_edit_case_officer.')" class="form-select form-select-sm" aria-label="Default select example">
                        ';
                        $op_username_cl = getoption_return_edit_job("username","account", $row["case_officer"],"single");
                        echo $op_username_cl;
                        echo'
                    </select>
                </div>
                <div class="col-2" style="padding: 3px;">
                  <input id="cl_edit_sku_'.$row["id"].'" name="cl_edit_sku_'.$row["id"].'" onchange="update_cl_detail('.$row["id"].','.$cl_edit_sku.')" class="form-control form-control-sm" type="number" placeholder="sku" value="'.$row['sku'].'" aria-label=".form-control-sm example">
                </div>
                <div class="col" style="padding: 3px;">
                  <select id="cl_edit_status_'.$row["id"].'" name="cl_edit_status_'.$row["id"].'" onchange="update_cl_detail('.$row["id"].','.$cl_edit_status.')" class="form-select form-select-sm" aria-label="Default select example">
                        ';
                        $op_status_cl = getoption_return_edit_job("content_request_status","option", $row["status"],"single");
                        echo $op_status_cl;
                        echo'
                  </select>
                </div>
                <div class="col" style="padding: 3px;">
                  <select id="cl_edit_update_type_'.$row["id"].'" name="cl_edit_update_type_'.$row["id"].'" onchange="update_cl_detail('.$row["id"].','.$cl_edit_update_type.')" class="form-select form-select-sm" aria-label="Default select example">
                  ';    
                  $op_update_type = return_s_select_box_cl_cr($row["update_type"],"74");
                  echo $op_update_type;
                  echo'
                  </select>
                </div>';
        
                if(strpos($_SESSION["department"],"Content")!==false or $_SESSION["department"]==""){
                  echo'
                <div class="col" style="padding: 3px;">
                  <select id="cl_edit_update_due_reason_'.$row["id"].'" name="cl_edit_update_due_reason_'.$row["id"].'" onchange="update_cl_detail('.$row["id"].','.$cl_edit_update_due_reason.')" class="form-select form-select-sm" aria-label="Default select example">
                  ';    
                  $op_update_due_reason = return_s_select_box_cl_cr($row["update_due_reason"],"73");
                  echo $op_update_due_reason;
                  echo'
                  </select>
                </div>
                <div class="col-1" style="padding: 3px;">
                   <button  style="background: transparent;border: 0px;" onclick="remove_cr_list('.$row['id'].','.$ticket_id.')" ><ion-icon name="trash-outline"></ion-icon></button>
                </div>
                ';
                }
         echo'
          </li>
          ';
    } 
  mysqli_close($con);
  ?>
