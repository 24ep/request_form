<?php
session_start();
if(isset($_POST["cr_search_input"]) ){
  $_SESSION["cr_search_input"] = $_POST["cr_search_input"];
 }else{
   unset($_SESSION["cr_search_input"]);
}
 if(isset($_POST["user_cr_filter"])){
  $_SESSION["user_cr_filter"]= $_POST["user_cr_filter"];
 }
if( $_SESSION["user_cr_filter"]<>"" and $_SESSION["user_cr_filter"]<>"all_user"){
  $cr_status_user = ' and lower(ticket.participant) like lower("%'.$_SESSION["user_cr_filter"].'%") ';
}else{
  $cr_status_user = '';
}
if(isset($_POST["status"])){$_SESSION["status"]= $_POST["status"];}
    if(!isset($_SESSION["status"])){
      if($_SESSION["cr_filter_status"]==""){
         $cr_status = 'ticket.status = "Pending"'.$cr_status_user;
         $_SESSION["cr_filter_status"] = "Pending";
         $LIMIT ='';
         $sort_by= 'ticket.id';
         $sort_code = 'ASC';
      }else{
        if($_SESSION["cr_filter_status"]=="Pending"){
          $cr_status = 'ticket.status = "Pending"'.$cr_status_user;
          $LIMIT ='';
          $sort_by= 'ticket.id';
          $sort_code = 'ASC';
        }elseif($_SESSION["cr_filter_status"]=="Close"){
          $cr_status = 'ticket.status = "Close"'.$cr_status_user;
          $LIMIT= 'LIMIT 10';
          $sort_by= 'ticket.complete_date'.$cr_status_user;
          $sort_code = 'DESC';
        }else{
          $cr_status = 'ticket.status <> "Cancel" and  ticket.status <> "Close" and status  <> "Pending"'.$cr_status_user;
          $LIMIT ='';
          $sort_by= 'ticket.update_date';
          $sort_code = 'DESC';
        }
      }
    }else{
          $_SESSION["cr_filter_status"]=$_SESSION["status"];
            if($_SESSION["status"]=="Pending"){
              $cr_status = 'ticket.status = "Pending"'.$cr_status_user;
              $LIMIT ='';
              $sort_by= 'ticket.id';
              $sort_code = 'ASC';
            }elseif($_SESSION["status"]=="Close"){
              $cr_status = 'ticket.status = "Close"'.$cr_status_user;
              $LIMIT= 'LIMIT 10';
              $sort_by= 'ticket.complete_date';
              $sort_code = 'DESC';
            }else{
              $cr_status = 'ticket.status <> "Cancel" and ticket.status <> "Close" and status  <> "Pending"'.$cr_status_user;
              $LIMIT ='';
              $sort_by= 'ticket.update_date';
              $sort_code = 'DESC';
            }
    }
    if(isset($_SESSION["cr_search_input"])){
      $cr_status = '(( lower(ticket.title) like lower("%'.$_SESSION["cr_search_input"].'%") or lower(ticket.id) like lower("%'.$_SESSION["cr_search_input"].'%") or lower(ticket.id) like lower("%'.str_replace('CR-','',$_SESSION["cr_search_input"]).'%")  or lower(ticket.description) like lower("%'.$_SESSION["cr_search_input"].'%")))';
    }
   date_default_timezone_set("Asia/Bangkok");
   $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
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
   where ".$cr_status."
   GROUP BY ticket.id
   ORDER by ". $sort_by." ".$sort_code." ".$LIMIT;
   //echo "<script>console.log('".$query."');</script>";
   $result = mysqli_query($con, $query);
  //  $result_count = mysqli_query($con, $query_count);
     while( $row = mysqli_fetch_array($result)) {
           $count_comment_cr = $row["count_comment"];
          $description  = htmlspecialchars_decode($row["description"],ENT_NOQUOTES);
          $description = substr(strip_tags($description),0,200)." ...";
          if($row["piority"]=="Urgent"){
              $badge =  '<span class="badge bg-danger rounded-pill" style="margin-left:10px;">'.$row["piority"].'</span>';
          }elseif ($row["piority"]=="High"){
              $badge =  '<span class="badge  rounded-pill" style="margin-left:10px;background-color:#F46475;">'.$row["piority"].'</span>';
          }elseif($row["piority"]=="Medium"){
              $badge =  '<span class="badge rounded-pill" style="margin-left:10px;background-color:#F4DC64;">'.$row["piority"].'</span>';
          }else{
              $badge =  '<span class="badge rounded-pill" style="margin-left:10px;background-color:#D1D1D1;">'.$row["piority"].'</span>';
          }
    echo    '<li class="list-group-item d-flex justify-content-between align-items-start" style="font-size:16px;display: block!important;"   >
                            <div style="margin-left: 10px;margin-top:0px;" >
                                <div class="fw-bold" data-bs-toggle="offcanvas" data-card="#detail_cr" data-bs-target="#detail_cr" aria-controls="offcanvasExample" onclick="cr_id_toggle('.$row['id'].')"><strong style="color:red;">'.$row["ticket_template"].'-'.$row["id"].'</strong> '.$row["title"]. $badge .'<div class="float-end status_cr_list">'.$row['status'].'</div></div>
                                <div data-bs-toggle="offcanvas" data-card="#detail_cr" data-bs-target="#detail_cr" aria-controls="offcanvasExample" onclick="cr_id_toggle('.$row['id'].')" style="color:gray;font-size:13px;margin-right:20px;margin-bottom:5px">'.$description.'</div>
                                <!--<ion-icon name="chatbubbles-outline" class="icon_ocv"></ion-icon> -->
                                <small style="color: #adb5bd;font-size:12px;">'.$count_comment_cr.' Comment <strong> | Create by '.$row["request_by"].'</strong></small> <small class="timeago" datetime="'.$row["create_date"].'">'.$row["create_date"].'</small>
                            </div>
            </li>';
    }
  mysqli_close($con);
  ?>
<script>
timeago().render(document.querySelectorAll('.timeago'));
</script>