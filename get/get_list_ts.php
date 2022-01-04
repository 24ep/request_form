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
  }elseif($status=="waiting Buyer"){
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #FE7A6F;color:#a80c1b;border:#FE7A6F">waiting buyer</button>';
  }elseif($status=="In-review"){
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #ea79f7;color:#6a2e71;border:#ea79f7">In-review"</button>';
  }else{
    $status = '<button type="button" class="btn btn-secondary btn-sm shadow-sm" style="background: #a9a9a94f;color:#8f8f8f;border:#8f8f8f">'.$status.'</button>';
  }
return $status;
}

    function list_ts($filter ){
    
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
    ticket.participant as ticket_participant,
    sum(case when comment.ticket_type='content_request' then 1 else 0 end) as count_comment 
    FROM all_in_one_project.content_request as ticket
    LEFT JOIN all_in_one_project.comment as comment
    ON ticket.id = comment.ticket_id 
    where ".$ts_filter." 
    GROUP BY ticket.id
    LIMIT 100";
    //echo "<script>console.log('".$query."');</script>";
    $result = mysqli_query($con, $query);

    echo "<ul >";
      while( $row = mysqli_fetch_array($result)) {
            $count_comment_cr = $row["count_comment"];
            if($row['piority']=="Urgent"){
                $ri_style = '<span class="badge rounded-pill bg-danger" style="margin-left:5px">'.$row['piority'].'</span>';
              }else{
                $ri_style = '<span class="badge rounded-pill bg-secondary" style="margin-left:5px">'.$row['piority'].'</span>';
              }
            ?>
            <li class="row shadow-sm rounded md-3 p-2 bg-white">
                <div class="col-6" style="align-self: center;">
                    <?php echo $row["ticket_template"]."-".$row["id"]." ".$row["title"]; echo $ri_style;  ?>
                </div>
                <div class="col-2">
                <?php echo badge_status_cr($row["status"]); ?>    
                </div>
          
                <div class="col-2" style="align-self: center;">
                        <ion-icon name="grid-outline"></ion-icon>
                </div>
            </li>
            <?php
     
     } 
     echo "</ul>";
   mysqli_close($con);
    }



  
  ?>
