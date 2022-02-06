<?php 
function list_project($filter,$ts_command_limit,$level ){
    if(strpos($filter,"ticket.status = 'Close'")!==false){
      $sort_de_status=" DESC ";
    }else{
      $sort_de_status=" ASC ";
    }
    $i=1;
      //-------------subtask for project-----------------
    $ts_filter = $filter;
    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    //--
    if($level=="task"){
      echo "<ul style='width: 95%;'>";
      $sts_filter = str_replace("ticket.case_officer","task.case_officer",$ts_filter);
      $sts_filter = str_replace("ticket.participant","task.case_officer",$sts_filter);
      $sts_filter = str_replace("ticket.status","task.status",$sts_filter);
      $sts_filter = str_replace("ticket.id","task.ticket_id,",$sts_filter);
    $query_task = "SELECT 
    task.id,
    task.case_officer, 
    task.inprogress_date,
    task.complete_date,
    task.status,
    task.ticket_id,
    task.create_date,
    task.update_date,
    task.description,
    task.est_start_date,
    task.est_due_date,
    ticket.ticket_template,
    ticket.title,
    task.description
    FROM all_in_one_project.checklist_of_content_request as task
    left join all_in_one_project.content_request as ticket
    on task.ticket_id = ticket.id    
    where ".$sts_filter."
    order by task.id ".$sort_de_status."  
    limit ".$ts_command_limit;
    
    //echo "<script>console.log('".$query."');</script>";
    $result_task = mysqli_query($con, $query_task);
    $i=1;
      while( $row_task = mysqli_fetch_array($result_task)) {
        $ri_style = "border-left: #ccc solid 15px;";
        if($i==1){
          echo '<li class="mb-1 row">
          <div class="col-6 " style="padding:3px;"> <strong>Task name</strong></div>
          <div class="col-3 text-center" style="padding:3px;"> <strong>Project</strong></div>
          <div class="col-3 text-center" style="padding:3px;"> <strong>Status</strong></div>
          </li>';
        }
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$query = "SELECT 
pb.project_name,
pb.description,
pb.owner,
pb.sticky,
pb.status,
pb.prefix,
ac.profile_url
FROM all_in_one_project.project_bucket as pb 
left join all_in_one_project.account as ac
on pb.owner = ac.username 
where pb.id=".$_POST["id"] or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {

    echo '
        <div class="modal-header" style="border-color: transparent;background: #f3f3f3;">
            <h5 class="modal-title" id="exampleModalLabel">'.$row["project_name"].'</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-9">
                    <small><ion-icon name="people-outline"></ion-icon> Project Owner & Participant</small>
                    <hr>
                    <small><ion-icon name="reader-outline"></ion-icon> Description</small>
                    <p>'.$row["description"].'</p>
                    <hr>
                    <small><ion-icon name="document-attach-outline"></ion-icon> Attachments</small>
                    <hr>
                    <small><ion-icon name="file-tray-stacked-outline"></ion-icon> Task</small>
                    ';
                    ?>
                    <div class="row">
    <div class="col border-0 border-end">
        <small class="row m-3">Your Assignment</small>
        <small class="row m-3">Pending</small>
        <hr>
        <div id="list_cr_task_pending">
            <?php list_project($_SESSION["ts_query_input"]." and ticket.status = 'Pending' and  ticket.ticket_template = 'CR'",100,'ticket');
                      echo '<script>console.log("'.$_SESSION["ts_query_input"].' ");</script>';
                      ?>
        </div>
        <small class="row m-3">inprogress</small>
        <hr>
        <div id="list_cr_task_inprogress">
            <?php list_project($_SESSION["ts_query_input"]."   and ticket.status = 'Inprogress' and  ticket.ticket_template = 'CR'",100,'ticket'); ?>
        </div>
        <small class="row m-3">Waiting Execution</small>
        <hr>
        <div id="list_cr_task_we">
            <?php list_project($_SESSION["ts_query_input"]."  and ticket.status = 'Waiting Execution' and  ticket.ticket_template = 'CR'",100,'ticket'); ?>
        </div>
        <small class="row m-3">Waiting CTO</small>
        <hr>
        <div id="list_cr_task_wcto">
            <?php list_project($_SESSION["ts_query_input"]."   and ticket.status = 'Waiting CTO' and  ticket.ticket_template = 'CR'",100,'ticket'); ?>
        </div>
        <small class="row m-3">Waiting Buyer</small>
        <hr>
        <div id="list_cr_task_wb">
            <?php list_project($_SESSION["ts_query_input"]."   and ticket.status = 'Waiting Buyer' and  ticket.ticket_template = 'CR'",100,'ticket'); ?>
        </div>
        <small class="row m-3">Close [lastest 5 ticket]</small>
        <hr>
        <div id="list_cr_task_wb">
            <?php list_project($_SESSION["ts_query_input"]."   and ticket.status = 'Close' and  ticket.ticket_template = 'CR'",5,'ticket'); ?>
        </div>
    </div>
    <div class="col">
        <small class="row m-3">Unassign</small>
        <?php list_project("ticket.ticket_template = 'CR' and ticket.case_officer = 'unassign' and ticket.status <> 'Close'",100,'ticket'); ?>
    </div>
</div>
                    
                    <?php
                    echo '
                </div>
                <div class="col-3">
                <small>status</small>
                    <select class="form-select" style="border: 0px;background-color: #f5f5f5;"
                    aria-label="Default select example">
                        <option selected value="Open">Open</option>
                        <option value="Close">Close</option>
                    </select>
                </div>
            </div>
        </div>';

}



?>