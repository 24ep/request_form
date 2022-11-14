<?php
  session_start();
$department=$_GET["department"];
function return_s_select_box_cl_cr($current_value,$attr_id){
    session_start();
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
      $query_op = "SELECT * FROM content_service_gate.attribute_option
      WHERE attribute_id = ".$attr_id." and  (function = 'checklist_of_content_request' or function = 'content_request') ORDER BY option_id ASC" or die("Error:" . mysqli_error($con));
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
    $query = "SELECT * FROM $table ORDER BY $col asc" or die("Error:" . mysqli_error($con));
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
       mysqli_close($con);
       return $option_set;
       
      }
   $ticket_id = $_GET["id"];
   date_default_timezone_set("Asia/Bangkok");
   $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
   mysqli_query($con, "SET NAMES 'utf8' ");
   $query = "
    SELECT 
    cl.id,
    cl.case_officer, 
    cl.inprogress_date,
    cl.complete_date,
    cl.status,
    cl.update_due_reason,
    cl.update_type,
    cl.sku,
    cl.ticket_id,
    cl.create_date,
    cl.update_date,
    cl.description,
    cl.est_start_date,
    cl.est_due_date,
    cr.ticket_template,
    cl.description
    FROM all_in_one_project.checklist_of_content_request as cl
    left join all_in_one_project.content_request as cr
    on cl.ticket_id = cr.id    
    where ticket_id =".$ticket_id;
   $query_count = "SELECT count(id) as count_id FROM all_in_one_project.checklist_of_content_request where ticket_id =".$ticket_id;
   $query_count_complete = "SELECT count(id) as count_id FROM all_in_one_project.checklist_of_content_request where status = 'Close' and  ticket_id =".$ticket_id;
   $result = mysqli_query($con, $query);
   $result_count = mysqli_query($con, $query_count);
   $result_count_complete = mysqli_query($con, $query_count_complete);
    $count_id=mysqli_fetch_assoc($result_count);
    $count_id_complete=mysqli_fetch_assoc($result_count_complete);
    $count_id_fr=$count_id['count_id'];
    $count_id_fr_complete=$count_id_complete['count_id'];

    //cal progress
   
      $percent_progress = ($count_id_fr_complete/$count_id_fr)*100;

    //--
   $cl_edit_case_officer = "'cl_edit_case_officer'";
   $cl_edit_status = "'cl_edit_status'";
   $cl_edit_sku = "'cl_edit_sku'";
   $cl_edit_update_due_reason= "'cl_edit_update_due_reason'";
   $cl_edit_update_type= "'cl_edit_update_type'";
   $cl_edit_est_start_date= "'cl_edit_est_start_date'";
   $cl_edit_est_due_date= "'cl_edit_est_due_date'";
   $cl_edit_description= "'cl_edit_description'";
   
    if(  $count_id_fr == 0 or  $count_id_fr == null or  $count_id_fr =='' ){
      echo '<div style="    text-align-last: center;
    color: #bbbbbb;
    border: solid #bbbbbb 1px;
    border-radius: 5px;">
    Have no sub-task available for now </div>';
    }

    $i=1;

   
     while($row = mysqli_fetch_array($result)) {
      if($row['ticket_template']=='PJ' and $count_id_fr<>0 and $i == 1){
        echo '
        <div class="load_cr_dt progress shadow-sm progress-bar-striped progress-bar-animated" style="margin-bottom:10px">
          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="background-color: #17b717;width: '.$percent_progress.'%;" aria-valuenow="'.$percent_progress.'" aria-valuemin="0" aria-valuemax="100">Progress '.$percent_progress.'%</div>
        </div>
        ';
        }
     
          if($row['ticket_template']=='CR' and $i == 1){
            if(strpos($department,"Content")!==false or $department==''){
           
              echo '<li class="mb-1 row">
              <div class="col-2 text-center" style="padding:3px;"> <strong>Assignee</strong></div>
              <div class="col-2 text-center" style="padding:3px;"> <strong>Total SKUs</strong></div>
              <div class="col text-center" style="padding:3px;"> <strong>Status</strong></div>
              <div class="col text-center" style="padding:3px;"> <strong>Type</strong></div>
              <div class="col text-center" style="padding:3px;"> <strong>Reason</strong></div>
              <div class="col-1 text-center" style="padding:3px;"> <strong></strong></div>
              </li>';
              }else{
                echo '<li class="mb-1 row">
              <div class="col-2 text-center" style="padding:3px;"> <strong>Assignee</strong></div>
              <div class="col-2 text-center" style="padding:3px;"> <strong>Total SKUs</strong></div>
              <div class="col text-center" style="padding:3px;"> <strong>Status</strong></div>
              <div class="col text-center" style="padding:3px;"> <strong>Type</strong></div>
           
              </li>';
              }
            }
            if($row['ticket_template']=='PJ' and $i == 1){
            
        
           
                  echo '<li class="mb-1 row">
                <div class="col-1 text-center" style="padding:1px;"> </div>
                <div class="col-6 text-center" style="padding:6px;"> <strong>Task</strong></div>
                <div class="col-2 text-center" style="padding:2px;"> <strong>Assignee</strong></div>
                <div class="col-2 text-center" style="padding:2px;"> <strong>Status</strong></div>
                <div class="col-1 text-center" style="padding:1px;"> </div>
             
                </li>';
                
              }
            
        
                    if($row['ticket_template']=='CR' or $row['ticket_template']=='NPS'){
                  echo '
                <li class="mb-3 row shadow-sm bg-white rounded" id="checklist_cr" style="">
                          <div class="col-2" style="padding: 3px;">
                              <select id="cl_edit_case_officer_'.$row["id"].'" name="cl_edit_case_officer_'.$row["id"].'" onchange="update_cl_detail('.$row["id"].','.$cl_edit_case_officer.')" class="form-select form-select-sm rounded-0 border-0 border-end text-center" aria-label="Default select example">
                                  ';
                                  $op_username_cl = getoption_return_edit_job("username","account", $row["case_officer"],"single");
                                  echo $op_username_cl;
                                  echo'
                              </select>
                          </div>
                          <div class="col-2" style="padding: 3px;">
                            <input id="cl_edit_sku_'.$row["id"].'" name="cl_edit_sku_'.$row["id"].'" onchange="update_cl_detail('.$row["id"].','.$cl_edit_sku.')" class="form-control form-control-sm rounded-0 border-0 border-end text-center" type="number" placeholder="sku" value="'.$row['sku'].'" aria-label=".form-control-sm example">
                          </div>
                          <div class="col" style="padding: 3px;">
                            <select id="cl_edit_status_'.$row["id"].'" name="cl_edit_status_'.$row["id"].'" onchange="update_cl_detail('.$row["id"].','.$cl_edit_status.')" class="form-select form-select-sm rounded-0 border-0 border-end text-center" aria-label="Default select example">
                                  ';
                                  // $op_status_cl = getoption_return_edit_job("content_request_status","option", $row["status"],"single");
                                  $op_status_cl =return_s_select_box_cl_cr($row["status"],"38");
                                  echo $op_status_cl;
                                  echo'
                            </select>
                          </div>
                          ';
                          if(strpos($department,"Content")!==false or $department=='' ){
                            $er= "border-end";
                          }
                          echo '
                          <div class="col" style="padding: 3px;">
                            <select id="cl_edit_update_type_'.$row["id"].'" name="cl_edit_update_type_'.$row["id"].'" onchange="update_cl_detail('.$row["id"].','.$cl_edit_update_type.')" class="form-select form-select-sm rounded-0 border-0 '.$er.' text-center" aria-label="Default select example">
                            ';    
                            $op_update_type = return_s_select_box_cl_cr($row["update_type"],"74");
                            echo $op_update_type;
                            echo'
                            </select>
                          </div>';
                  
                          if(strpos($department,"Content")!==false or $department=='' ){
                            echo'
                          <div class="col" style="padding: 3px;">
                            <select id="cl_edit_update_due_reason_'.$row["id"].'" name="cl_edit_update_due_reason_'.$row["id"].'" onchange="update_cl_detail('.$row["id"].','.$cl_edit_update_due_reason.')" class="form-select form-select-sm rounded-0 border-0 border-end text-center" aria-label="Default select example">
                            ';    
                            $op_update_due_reason = return_s_select_box_cl_cr($row["update_due_reason"],"73");
                            echo $op_update_due_reason;
                            echo'
                            </select>
                          </div>
                          <div class="col-1" style="padding: 3px;text-align: center;align-self: center;">
                            <button  style="background: transparent;border: 0px;" onclick="remove_cr_list('.$row['id'].','.$ticket_id.')" ><ion-icon name="trash-outline"></ion-icon></button>
                          </div>
                          ';
                          }
                  echo'
                    </li>
                    ';
              }

          //card for project
          
 //----------------
                if($row['ticket_template']=='DT' or  $row['ticket_template']=='DP'){
                  

                  echo '
                  <div class="card text-dark bg-light mb-3 shadow-sm" style="border-color: transparent;padding-left: 10px;background-color: #ffffff!important;" >
                    <div class="card-body" style="height: 100px;">
                      <div class="row" style="margin-bottom: 5px;place-content: center; ">
                      <label for="inputPassword" class="col-sm-1 col-form-label" style="flex-basis: fit-content;padding: 2px;place-self: center;">'.$i.'</label>
                      <div class="col-sm-6" style="padding-right:0px">
                    
                          <textarea placeholder="input detail of task  '.$i.' here ." style="font-size: unset;background-color:transparent;height: 65px;"
                          class="form-control" onchange="update_cl_detail('.$row["id"].','.$cl_edit_description.')" id="cl_edit_description_'.$row["id"].'" name="cl_edit_description_'.$row["id"].'" rows="auto">'.$row["description"].'</textarea>
                       
                      </div>
                      <div class="col-sm-4" style="padding: 0px 4px;">
                          <div  style="align-self: center;padding-bottom: 2px;">
                          
                                        
                                          <select  id="cl_edit_case_officer_'.$row["id"].'" name="cl_edit_case_officer_'.$row["id"].'" onchange="update_cl_detail('.$row["id"].','.$cl_edit_case_officer.')" class="form-select form-select-sm" aria-label="Default select example">';
                                            $op_username_cl = getoption_return_edit_job("username","account", $row["case_officer"],"single");
                                            echo $op_username_cl;
                                            echo'
                                          </select>
                                    
                          </div>
                          <div  style="align-self: center;padding-top: 2px;">
                                          <select  id="cl_edit_status_'.$row["id"].'" name="cl_edit_status_'.$row["id"].'" onchange="update_cl_detail('.$row["id"].','.$cl_edit_status.')" class="form-select form-select-sm" aria-label="Default select example">';
                                          $op_status_cl = getoption_return_edit_job("content_request_status","option", $row["status"],"single");
                                          echo $op_status_cl;
                                          echo'
                                        </select>
                          </div>
                      </div>
                      <div class="col-sm-1" style="align-self: center;padding: 2px;">
                        <button  style="background: transparent;border: 0px;" onclick="remove_cr_list('.$row['id'].','.$ticket_id.')" ><ion-icon name="trash-outline"></ion-icon></button>
                      </div>
                      </div>
                      
                    </div>
                    </div>';
              
                }
          


          $i++;
    } 
  mysqli_close($con);
  ?>
