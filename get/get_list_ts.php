<?php
session_start();

function badge_status_cr($status){
  if($status=="Pending"){
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #a9a9a94f;color:#8f8f8f;border:#8f8f8f">pending</button>';
  }elseif( $status=="Inprogress"){
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #ff9a59;color:white;border:#ff9a59">Inprogress</button>';
  }elseif($status=="Close" or $status=="approved"){
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #7befb2;color:#115636;border:#115636">'.$status.'</button>';
  }elseif($status=="Waiting CTO"){
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #499CF7;color:#093f8e;border:#499CF7">Waiting CTO</button>';
  }elseif($status=="Waiting Execution"){
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #FE7A6F;color:#a80c1b;border:#FE7A6F">Waiting Execution</button>';
  }elseif($status=="Waiting Buyer"){
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #FE7A6F;color:#a80c1b;border:#FE7A6F">waiting buyer</button>';
  }elseif($status=="In-review"){
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #ea79f7;color:#6a2e71;border:#ea79f7">In-review"</button>';
  }else{
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #a9a9a94f;color:#8f8f8f;border:#8f8f8f">'.$status.'</button>';
  }
return $status;
}
    function list_ts($filter,$ts_command_limit,$level ){
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
?>
<li class="row shadow-sm rounded md-3 p-2 bg-white" style="<?php echo  $ri_style ?> " data-bs-toggle="offcanvas"
    data-bs-target="#detail_cr" aria-controls="offcanvasExample"
    onclick="cr_id_toggle(<?php echo $row['ticket_id'] ?>)">
    <div class="col-6 border-0 border-end" data-bs-toggle="offcanvas" data-bs-target="#detail_cr"
        aria-controls="offcanvasExample" onclick="cr_id_toggle(<?php echo $row_task['ticket_id'];?>) "
        style="align-self: center;">
        <?php echo $row_task["description"]; ?>
    </div>
    <div class="col-3 text-center" data-bs-toggle="offcanvas" data-bs-target="#detail_cr"
        aria-controls="offcanvasExample" onclick="cr_id_toggle(<?php echo $row_task['ticket_id']; ?>)"
        style="align-self: center;">
        <?php echo $row_task["title"]; ?>
    </div>
    <div class="col-3 text-center" data-bs-toggle="offcanvas" data-bs-target="#detail_cr"
        aria-controls="offcanvasExample" onclick="cr_id_toggle(<?php echo $row_task['ticket_id']; ?>)"
        style="align-self: center;">
        <?php echo badge_status_cr($row_task["status"]); ?>
    </div>
</li>
<?php
$i++;
        }
      }else{
        $ts_filter = $filter;
        date_default_timezone_set("Asia/Bangkok");
        $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $query = "SELECT ticket.id as id,
        ticket.title as title,
        ticket.description as description,
        ticket.piority as piority,
        ticket.request_by as request_by,
        ticket.create_date as create_date,
        ticket.status as status,
        ticket.ticket_template as ticket_template,
        comment.ticket_type as ticket_type,
        ticket.participant as participant,
        ticket.case_officer as case_officer,
        sum(case when comment.ticket_type='content_request' then 1 else 0 end) as count_comment 
        FROM all_in_one_project.content_request as ticket
        LEFT JOIN all_in_one_project.comment as comment
        ON ticket.id = comment.ticket_id 
        where ".$ts_filter." 
        GROUP BY ticket.id order by ticket.id ".$sort_de_status."   limit ".$ts_command_limit;
        //echo "<script>console.log('".$query."');</script>";
        $result = mysqli_query($con, $query);
        echo "<ul style='width: 95%;'>";
          while( $row = mysqli_fetch_array($result)) {
                $count_comment_cr = $row["count_comment"];
                if($row['piority']=="Urgent"){
                    $ri_style = "border-left: #dc3545 solid 15px;";
                  }elseif($row['piority']=="High"){
                    $ri_style = "border-left: #f396bf solid 15px;";
                  }elseif($row['piority']=="Medium"){
                    $ri_style = "border-left: #f396bf solid 15px;";
                  }elseif($row['piority']=="low"){
                    $ri_style = "border-left: #ccc solid 15px;";
                  }else{
                    $ri_style = "border-left: #ccc solid 15px;";
                  }
                  if($row['ticket_template']=="CR" or  $row['ticket_template']=="DT" ){
                    // if($i==1){
                    //   // echo '<li class="mb-1 row">
                    //   // <div class="col-9 " style="padding:3px;"> <strong>Request name</strong></div>
                    //   // <div class="col-3 " style="padding:3px;"> <strong>status</strong></div>
                    //   // </li>';
                    // }
                ?>
<li class="row shadow-sm rounded md-3 p-2 bg-white" style="<?php echo  $ri_style ?> " data-bs-toggle="offcanvas"
    data-bs-target="#detail_cr" aria-controls="offcanvasExample" onclick="cr_id_toggle(<?php echo $row['id'] ?>)">
    <div class="col-9" data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample"
        onclick="cr_id_toggle(<?php echo $row['id'];?>) " style="align-self: center;">
        <?php echo "<strong>".$row["ticket_template"]."-".$row["id"]."</strong> ".$row["title"]; ?>
    </div>
    <div class="col-3" data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample"
        onclick="cr_id_toggle(<?php echo $row['id']; ?>)" style="align-self: center;">
        <?php echo badge_status_cr($row["status"]); ?>
    </div>
</li>
<?php
                 }elseif($row['ticket_template']=="PJ" ){
                  if($i==1){
                    echo '<li class="mb-1 row">
                    <div class="col-6 " style="padding:3px;"> <strong>Project name</strong></div>
                    <div class="col-3 text-center" style="padding:3px;"> <strong>Owner</strong></div>
                    <div class="col-3 text-center" style="padding:3px;"> <strong>Progress</strong></div>
                    </li>';
                  }
                   $query_count = "SELECT count(id) as count_id FROM all_in_one_project.checklist_of_content_request where ticket_id =".$row['id'];
                   $query_count_complete = "SELECT count(id) as count_id FROM all_in_one_project.checklist_of_content_request where status = 'Close' and  ticket_id =".$row['id'];
                   $result_count = mysqli_query($con, $query_count);
                   $result_count_complete = mysqli_query($con, $query_count_complete);
                   $count_id=mysqli_fetch_assoc($result_count);
                   $count_id_complete=mysqli_fetch_assoc($result_count_complete);
                   $count_id_fr=$count_id['count_id'];
                   $count_id_fr_complete=$count_id_complete['count_id'];
                  //  cal progress
                   $percent_progress = ($count_id_fr_complete/$count_id_fr)*100;
                   if($percent_progress >0 and $percent_progress < 50){
                     $bsc_progress = "#ffc107";
                   }elseif($percent_progress >=50 and $percent_progress < 100){
                    $bsc_progress = "#778719";
                   }elseif($percent_progress == 100){
                    $bsc_progress = "#198754";
                   }else{
                    $bsc_progress = "rgb(13 110 253 / 25%);";
                   }
                ?>
<li class="row shadow-sm rounded md-3 p-2 bg-white" style="<?php echo  $ri_style ?> " data-bs-toggle="offcanvas"
    data-bs-target="#detail_cr" aria-controls="offcanvasExample" onclick="cr_id_toggle(<?php echo $row['id']; ?>)">
    <div class="col-6" data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample"
        onclick="cr_id_toggle(<?php echo $row['id'];?>) " style="align-self: center;">
        <?php echo "<strong>".$row["ticket_template"]."-".$row["id"]."</strong> ".$row["title"]; ?>
    </div>
    <div class="col-3 text-center " data-bs-toggle="offcanvas" data-bs-target="#detail_cr"
        aria-controls="offcanvasExample" onclick="cr_id_toggle(<?php echo $row['id'];?>) " style="align-self: center;">
        <?php echo $row["case_officer"]; ?>
    </div>
    <div class="col-3 text-center" data-bs-toggle="offcanvas" data-bs-target="#detail_cr"
        aria-controls="offcanvasExample" onclick="cr_id_toggle(<?php echo $row['id'];?>)" style="align-self: center;">
        <div class="progress-bar rounded progress-bar-striped progress-bar-animated" role="progressbar"
            style="background-color: <?php echo $bsc_progress ;?>;width: <?php echo $percent_progress ;?>%;padding: .25rem .5rem;"
            aria-valuenow="<?php echo $percent_progress ;?>" aria-valuemin="0" aria-valuemax="100">
            <?php echo $percent_progress ;?>% (<?php echo $count_id_fr_complete ;?>/<?php echo $count_id_fr ;?>)
        </div>
    </div>
</li>
<?php
                 }
                 $i++;
      }
        //------------------------------
     } 
     echo "</ul>";
   mysqli_close($con);
    }
  $_SESSION["ts_query_input"] = $_POST["summary_filter"];
  if($_SESSION["ts_query_input"]=="" or $_SESSION["ts_query_input"] == null ){
    $_SESSION["ts_query_input"] = "ticket.participant like  '%".$_SESSION["username"]."%'";
  }

  if($_POST["ts_command_limit"]<>""){
    $ts_command_limit = $_POST["ts_command_limit"];
  }else{
    $ts_command_limit=100;
  }
 
  if($_POST["ts_level"]<>""){
    $ts_level = $_POST["ts_level"];
  }else{
    $ts_level = "ticket";
  }
  $filter = $_SESSION["ts_query_input"];
  echo '<script>console.log("'.$_SESSION["ts_query_input"] .'");</script>';
    // if($filter<>""){
    //   list_ts($filter,$ts_command_limit,$ts_level);
    // }
  ?>
<!-- nav bar -->
<?php
                                    function get_server_memory_usage(){
                                        $free = shell_exec('free');
                                        $free = (string)trim($free);
                                        $free_arr = explode("\n", $free);
                                        $mem = explode(" ", $free_arr[1]);
                                        $mem = array_filter($mem);
                                        $mem = array_merge($mem);
                                        $memory_usage = $mem[2]/$mem[1]*100;
                                        return round($memory_usage);
                                    }
                                    function get_server_cpu_usage(){
                                        $load = sys_getloadavg();
                                        return round($load[0]);
                                    }
                                    ?>
<nav class="navbar">
    <div class="container-fluid p-0">
        <a class="navbar-brand"></a>
        <form class="d-flex">
            <?php 
            $memory_usage = get_server_memory_usage();
            $CPU_usage = get_server_cpu_usage();
            echo "<small  style='align-self: center;'>CPU usage ".$CPU_usage."% | memory usage : ".$memory_usage."%</small>"; ?>
            <button class="btn btn-primary btn-sm " style="margin-left:10px;" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#content_request_canvas" aria-controls="offcanvasExample">
                <ion-icon size="small" name="add-outline" role="img" class="md icon-small hydrated"
                    aria-label="add outline">
                </ion-icon>
                New Ticket
            </button>
        </form>
    </div>
</nav>

<!-- console bra -->
<!-- project -->
<span class="row"><strong>
        <ion-icon name="business-outline" style="vertical-align: middle;">
        </ion-icon>Project
    </strong></span>
<div class="row">
    <div class="col border-0 border-end">
        <small class="row m-3">Your tasks assignment (task of project)</small>
        <div id="list_pj_task">
            <?php list_ts($_SESSION["ts_query_input"]."  and ticket.status <> 'Close' and  ticket.ticket_template = 'PJ'",100,'task'); ?>
            
        </div>
    </div>
    <div class="col">
        <small class="row m-3">All project</small>
        <?php list_ts("ticket.ticket_template = 'PJ' and ticket.status <> 'Close'",500,'ticket' ); ?>
    </div>
</div>
<!-- support task -->
<hr>
<span class="row"><strong>
        <ion-icon name="server-outline" style="vertical-align: middle;"></ion-icon>
        Data & Application Support
    </strong></span>
<div class="row">
    <div class="col border-0 border-end">
        <small class="row m-3">Your Assignment</small>
        <div id="list_da_task">
            <?php list_ts($_SESSION["ts_query_input"]."   and ticket.status <> 'Close' and ticket.ticket_template = 'DT'",100,'ticket'); ?>
        </div>
    </div>
    <div class="col">
        <small class="row m-3">Unassign</small>
        <?php list_ts("ticket.ticket_template = 'DT' and ticket.case_officer = 'unassign' and ticket.status <> 'Close'",100,'ticket'); ?>
    </div>
</div>
<!-- Content request -->
<hr>
<span class="row"><strong>
        <ion-icon name="layers-outline" style="vertical-align: middle;"></ion-icon>
        Content Request
    </strong></span>
<div class="row">
    <div class="col border-0 border-end">
        <small class="row m-3">Your Assignment</small>
        <small class="row m-3">Pending</small>
        <hr>
        <div id="list_cr_task_pending">
            <?php list_ts($_SESSION["ts_query_input"]." and ticket.status = 'Pending' and  ticket.ticket_template = 'CR'",100,'ticket');
            echo '<script>console.log("'.$_SESSION["ts_query_input"].' ");</script>';
            ?>
        </div>
        <small class="row m-3">inprogress</small>
        <hr>
        <div id="list_cr_task_inprogress">
            <?php list_ts($_SESSION["ts_query_input"]."   and ticket.status = 'Inprogress' and  ticket.ticket_template = 'CR'",100,'ticket'); ?>
        </div>
        <small class="row m-3">Waiting Execution</small>
        <hr>
        <div id="list_cr_task_we">
            <?php list_ts($_SESSION["ts_query_input"]."  and ticket.status = 'Waiting Execution' and  ticket.ticket_template = 'CR'",100,'ticket'); ?>
        </div>
        <small class="row m-3">Waiting CTO</small>
        <hr>
        <div id="list_cr_task_wcto">
            <?php list_ts($_SESSION["ts_query_input"]."   and ticket.status = 'Waiting CTO' and  ticket.ticket_template = 'CR'",100,'ticket'); ?>
        </div>
        <small class="row m-3">Waiting Buyer</small>
        <hr>
        <div id="list_cr_task_wb">
            <?php list_ts($_SESSION["ts_query_input"]."   and ticket.status = 'Waiting Buyer' and  ticket.ticket_template = 'CR'",100,'ticket'); ?>
        </div>
        <small class="row m-3">Close [lastest 5 ticket]</small>
        <hr>
        <div id="list_cr_task_wb">
            <?php list_ts($_SESSION["ts_query_input"]."   and ticket.status = 'Close' and  ticket.ticket_template = 'CR'",5,'ticket'); ?>
        </div>
    </div>
    <div class="col">
        <small class="row m-3">Unassign</small>
        <?php list_ts("ticket.ticket_template = 'CR' and ticket.case_officer = 'unassign' and ticket.status <> 'Close'",100,'ticket'); ?>
    </div>
</div>