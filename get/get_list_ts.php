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
      echo "<ul style='width: 95%;'>";
      $i=1;
        //-------------subtask for project-----------------

      $ts_filter = $filter;
      date_default_timezone_set("Asia/Bangkok");
      $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
      mysqli_query($con, "SET NAMES 'utf8' ");
      //--
      if($level=="task"){
        $sts_filter = str_replace("ticket.case_officer","task.case_officer",$ts_filter);
      $sts_filter = str_replace("ticket.status","task.status",$ts_filter);
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
      limit ".$ts_command_limit;
      //echo "<script>console.log('".$query."');</script>";
      $result_task = mysqli_query($con, $query_task);
  
     
      $i=1;
        while( $row_task = mysqli_fetch_array($result)) {
          $ri_style = "border-left: #ccc solid 15px;";

          if($i==1){
            echo '<li class="mb-1 row">
            <div class="col-6 " style="padding:3px;"> <strong>Task name</strong></div>
            <div class="col-3 text-center" style="padding:3px;"> <strong>Status</strong></div>
            <div class="col-3 text-center" style="padding:3px;"> <strong>Project</strong></div>
          
            </li>';
          }
?>
               <li class="row shadow-sm rounded md-3 p-2 bg-white" style="<?php echo  $ri_style ?> " data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample"  onclick="cr_id_toggle(<?php echo $row['ticket_id'] ?>)">
                    <div class="col-6" data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample" onclick="cr_id_toggle(<?php echo $row_task['ticket_id'];?>) " style="align-self: center;">
                        <?php echo $row_task["description"]; ?>
                    </div>
                    <div class="col-3" data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample"  onclick="cr_id_toggle(<?php echo $row_task['ticket_id']; ?>)" style="align-self: center;">
                        <?php echo badge_status_cr($row_task["status"]); ?>    
                    </div>
                    <div class="col-3" data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample"  onclick="cr_id_toggle(<?php echo $row_task['ticket_id']; ?>)" style="align-self: center;">
                        <?php echo $row_task["title"]; ?>    
                    </div>
              
                </li>
                <?php




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
        GROUP BY ticket.id limit ".$ts_command_limit;
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
    
                  if($row['ticket_template']=="CR"){
                  
                    if($i==1){
                      echo '<li class="mb-1 row">
                      <div class="col-9 " style="padding:3px;"> <strong>Project name</strong></div>
                      <div class="col-3 " style="padding:3px;"> <strong>status</strong></div>
                    
                    
                      </li>';
                    }
                ?>
    
                
                <li class="row shadow-sm rounded md-3 p-2 bg-white" style="<?php echo  $ri_style ?> " data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample"  onclick="cr_id_toggle(<?php echo $row['id'] ?>)">
                    <div class="col-9" data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample" onclick="cr_id_toggle(<?php echo $row['id'];?>) " style="align-self: center;">
                        <?php echo "<strong>".$row["ticket_template"]."-".$row["id"]."</strong> ".$row["title"]; ?>
                    </div>
                    <div class="col-3" data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample"  onclick="cr_id_toggle(<?php echo $row['id']; ?>)" style="align-self: center;">
                        <?php echo badge_status_cr($row["status"]); ?>    
                    </div>
              
                </li>
                <?php
                
                 }elseif($row['ticket_template']=="PJ" or  $row['ticket_template']=="DT" ){
    
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
                
                   
                  
                ?>
                  <li class="row shadow-sm rounded md-3 p-2 bg-white" style="<?php echo  $ri_style ?> " data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample"  onclick="cr_id_toggle(<?php echo $row['id']; ?>)">
                    <div class="col-6" data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample" onclick="cr_id_toggle(<?php echo $row['id'];?>) " style="align-self: center;">
                        <?php echo "<strong>".$row["ticket_template"]."-".$row["id"]."</strong> ".$row["title"]; ?>
                    </div>
    
                    <div class="col-3 text-center " data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample" onclick="cr_id_toggle(<?php echo $row['id'];?>) " style="align-self: center;">
                        <?php echo $row["case_officer"]; ?>
                    </div>
    
                    <div class="col-3 text-center" data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample"  onclick="cr_id_toggle(<?php echo $row['id'];?>)" style="align-self: center;">
                      <div class="progress-bar rounded progress-bar-striped progress-bar-animated" 
                          role="progressbar"
                          style="background: #17b717;width: 100%;"
                          aria-valuenow="<?php echo $percent_progress ;?>"
                          aria-valuemin="0" 
                          aria-valuemax="100">
                          <?php echo $percent_progress ;?>% (<?php echo $count_id_fr_complete ;?>/<?php echo $count_id_fr ;?>)
                      </div> 
                    </div> 
    
                    
              
              
                </li>
    
    
                <?php
    
                 }
                
      }
      
        //------------------------------
    
             $i++;
     } 
    
     echo "</ul>";
   mysqli_close($con);
    }
  $filter =$_POST["summary_filter"];
  $ts_command_limit = $_POST["ts_command_limit"];
  $ts_level = $_POST["ts_level"];
  echo '<script>console.log("'.$filter.'");</script>';
    if($filter<>""){
      list_ts($filter,$ts_command_limit,$ts_level);
    }



  
  ?>
