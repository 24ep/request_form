<?php
session_start();


include_once($_SERVER['DOCUMENT_ROOT'].'/get/get_option_function.php');
// echo $_SERVER['DOCUMENT_ROOT'].'/get/get_option_function.php?id'.$_GET["id"];

$department= $_POST["department"];
$ticket_id = $_POST["id"];

if(!isset($_POST["id"])){
  $department= $_GET["department"];
  $ticket_id = $_GET["id"];
}
   date_default_timezone_set("Asia/Bangkok");
   $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));

   mysqli_query($con, "SET SQL_BIG_SELECTS=1");
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
   cl.description,
   pb.template_of_task
   FROM all_in_one_project.checklist_of_content_request as cl
   left join all_in_one_project.content_request as cr
   on cl.ticket_id = cr.id
   left join all_in_one_project.project_bucket as pb
   on pb.prefix = cr.ticket_template
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

    if($count_id_fr_complete==0){
      $percent_progress = 0;
    }else{
      $percent_progress = ($count_id_fr_complete/$count_id_fr)*100;
    }


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
      if($row['template_of_task']=='free-style' and $count_id_fr<>0 and $i == 1){
        echo '
        <div class="load_cr_dt progress shadow-sm progress-bar-striped progress-bar-animated" style="margin-bottom:10px">
          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="background-color: #17b717;width: '.$percent_progress.'%;" aria-valuenow="'.$percent_progress.'" aria-valuemin="0" aria-valuemax="100">Progress '.$percent_progress.'%</div>
        </div>
        ';
        }

          if($row['template_of_task']=='general' and $i == 1){
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
            if($row['template_of_task']=='free-style' and $i == 1){



                  echo '<li class="mb-1 row">
                <div class="col-1 text-center" style="padding:1px;"> </div>
                <div class="col-6 text-center" style="padding:6px;"> <strong>Task</strong></div>
                <div class="col-2 text-center" style="padding:2px;"> <strong>Assignee</strong></div>
                <div class="col-2 text-center" style="padding:2px;"> <strong>Status</strong></div>
                <div class="col-1 text-center" style="padding:1px;"> </div>

                </li>';

              }


                    if($row['template_of_task']=='general'){
                  echo '
                <li class="mb-3 row shadow-sm bg-white rounded" id="checklist_cr" style="">
                          <div class="col-2" style="padding: 3px;">
                              <select id="cl_edit_case_officer_'.$row["id"].'" name="cl_edit_case_officer_'.$row["id"].'" onchange="update_cl_detail('.$row["id"].','.$cl_edit_case_officer.')" class="form-select form-select-sm rounded-0 border-0 border-end text-center" aria-label="Default select example">
                                  ';


                                  $op_username_cl = get_username( $row["case_officer"]);
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

                                  $op_status_cl =get_option_attribute_entity("status","content_request",$row["status"]);
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

                            $op_update_type =get_option_attribute_entity("update_type","checklist_of_content_request",$row["update_type"]);
                            echo $op_update_type;
                            echo'
                            </select>
                          </div>';

                          if(strpos($department,"Content")!==false or $department=='' ){
                            echo'
                          <div class="col" style="padding: 3px;">
                            <select id="cl_edit_update_due_reason_'.$row["id"].'" name="cl_edit_update_due_reason_'.$row["id"].'" onchange="update_cl_detail('.$row["id"].','.$cl_edit_update_due_reason.')" class="form-select form-select-sm rounded-0 border-0 border-end text-center" aria-label="Default select example">
                            ';

                            $op_update_due_reason =get_option_attribute_entity("update_due_reason","checklist_of_content_request",$row["update_due_reason"]);
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
                if($row['template_of_task']=='free-style'){


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

                                            $op_username_cl = get_username( $row["case_officer"]);
                                            echo $op_username_cl;
                                            echo'
                                          </select>

                          </div>
                          <div  style="align-self: center;padding-top: 2px;">
                                          <select  id="cl_edit_status_'.$row["id"].'" name="cl_edit_status_'.$row["id"].'" onchange="update_cl_detail('.$row["id"].','.$cl_edit_status.')" class="form-select form-select-sm" aria-label="Default select example">';

                                          $op_status_cl =get_option_attribute_entity("status","content_request",$row["status"]);
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
  // mysqli_close($con);
  ?>