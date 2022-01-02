<?php
session_start();
    function list_ts($ticket_template ){
    echo "<ul >";
    $ts_filter = "ticket_template = '".$ticket_template."'";
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
   
      while( $row = mysqli_fetch_array($result)) {
            $count_comment_cr = $row["count_comment"];

            ?>
            <li class="row shadow-sm rounded md-3">
                <div class="col">
                    <?php echo "CR-".$row["id"]." ".$row["title"]; ?>
                </div>
                <div class="col">
                    <?php echo $row["status"]; ?>
                </div>
            </li>
            <?php
     
     } 
     echo "</ul>";
   mysqli_close($con);
    }



  
  ?>
