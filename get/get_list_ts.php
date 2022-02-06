<?php
session_start();
if($_POST["summary_filter"]<>"" and $_POST["summary_filter"]<>null ){
  $_SESSION["ts_query_input"] = $_POST["summary_filter"];
}

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

if($_POST["cb_pj"]<>""){
  $_SESSION["cb_pj"] = $_POST["cb_pj"];
}else{
  if($_SESSION["cb_pj"]==""){
    $_SESSION["cb_pj"] = "true";
  }
}
if($_POST["cb_da"]<>""){
  $_SESSION["cb_da"] = $_POST["cb_da"];
}else{
  if($_SESSION["cb_da"]==""){
    $_SESSION["cb_da"] = "true";
  }
 
}
if($_POST["cb_cr"]<>""){
  $_SESSION["cb_cr"] = $_POST["cb_cr"];
}else{
  if($_SESSION["cb_cr"]==""){
    $_SESSION["cb_cr"] = "true";
  }
}

$filter = $_SESSION["ts_query_input"];


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
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #FA9193;color:#white;border:#FA9193">Waiting Execution</button>';
  }elseif($status=="Waiting Buyer"){
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #FE7A6F;color:#a80c1b;border:#FE7A6F">waiting buyer</button>';
  }elseif($status=="Inreview"){
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #2bf2ca;color:black;border:#2bf2ca">Inreview</button>';
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
        GROUP BY ticket.id order by ticket.id ".$sort_de_status."  limit ".$ts_command_limit;
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
                 }
                 $i++;
      }
        //------------------------------
     } 
     echo "</ul>";
   mysqli_close($con);
    }




<?php
if($_SESSION["username"]=="poojaroonwit"){
date_default_timezone_set("Asia/Bangkok");
$con_status= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$query_status = "SELECT * FROM content_service_gate.attribute_option 
where attribute_id= 38" or die("Error:" . mysqli_error());
$result_status = mysqli_query($con_status, $query_status);
echo '<div class="row">
<div class="col border-0 border-end">
    <small class="row m-3">Your Assignment</small>';
while($row_status = mysqli_fetch_array($result_status)) {
  if($row_status["attribute_option"]=="Close"){
    $limit=5;
  }else{
    $limit = $ts_command_limit;
  }
  echo '<small class="row m-3">'.$row_status["attribute_option"].'</small>';
  list_ts($_SESSION["ts_query_input"]." and ticket.status = '".$row_status["attribute_option"]."'",$limit ,'ticket');
  echo '<hr>';
}
echo '
</div>
    <div class="col">
        <small class="row m-3">Unassign</small>
        '; 
      
        
        list_ts("ticket.case_officer = 'unassign' and ticket.status <> 'Close'",500,'ticket');
   echo' </div>
</div>
';

}

?>
