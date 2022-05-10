<?php
session_start();
if($_POST["summary_filter"]<>"" and $_POST["summary_filter"]<>null ){
  $_SESSION["ts_query_input"] = $_POST["summary_filter"];
}else{
  if($_SESSION["ts_query_input"]<>""){
    $_SESSION["ts_query_input"]=$_SESSION["ts_query_input"];
  }else{
    $_SESSION["ts_query_input"]="";
  }

}
// if($_SESSION["ts_query_input"]=="" or $_SESSION["ts_query_input"] == null ){
//   $_SESSION["ts_query_input"] = "ticket.participant like  '%".$_SESSION["username"]."%'";
// }
if($_POST["ts_command_limit"]<>""){
  $ts_command_limit = $_POST["ts_command_limit"];
}else{
  $ts_command_limit= 100;
}

$filter = "";
$filter .= "lower(ticket.id) like lower('%".$_SESSION["ts_query_input"]."%') or ";
$filter .= "lower(ticket.title) like lower('%".$_SESSION["ts_query_input"]."%') or ";
$filter .= "lower(ticket.description) like lower('%".$_SESSION["ts_query_input"]."%') ";
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
      //--
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
        // echo "<script>console.log('".$query."');</script>";
        $result = mysqli_query($con, $query);
        echo "<ul style='width: 95%;'>";
          while( $row = mysqli_fetch_array($result)) {
                $count_comment_cr = $row["count_comment"];
                  switch ($row['piority']) {
                    case "Urgent": $ri_style = "border-left: #dc3545 solid 10px;"; break;
                    case "High": $ri_style = "border-left: #f396bf solid 10px;"; break;
                    case "Medium": $ri_style = "border-left: #f396bf solid 10px;"; break;
                    case "low": $ri_style = "border-left: #ccc solid 10px;"; break;
                    default: $ri_style = "border-left: #ccc solid 10px;";
                  }
                  date_default_timezone_set("Asia/Bangkok");
                  $con_project= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
                  mysqli_query($con_project, "SET NAMES 'utf8' ");
                  $query_project = "SELECT *
                  FROM all_in_one_project.project_bucket 
                  where prefix='".$row["ticket_template"]."'" or die("Error:" . mysqli_error($con));
                  $result_project = mysqli_query($con_project, $query_project);
                  while($row_project = mysqli_fetch_array($result_project)) {
                    $color_project = $row_project["color_project"];
                    $project_name = $row_project["project_name"];
                  }
                ?>
<li class="row shadow-sm rounded md-3 p-2 bg-white position-relative" style="<?php echo  $ri_style ?> "
    data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample"
    onclick="cr_id_toggle(<?php echo $row['id'] ?>)">
    <div class="col-9" data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample"
        onclick="cr_id_toggle(<?php echo $row['id'];?>) " style="align-self: center;">
        <!-- <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-primary" style="<?php //echo $ico_ts_bg; ?>;left: -8px!important;"><ion-icon name="<?php //echo $ico_ts; ?>" style="margin: 0px;color: white!important;"></ion-icon> <span class="visually-hidden">unread messages</span></span> -->
        <?php echo "<strong style='color: ".$color_project.";'>".$row["ticket_template"]."-".$row["id"]."</strong> ".$row["title"]; ?>
    </div>
    <!-- <div class="col-3" data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample"
              onclick="cr_id_toggle(<?php echo $row['id']; ?>)" style="align-self: center;">
              <?php //echo badge_status_cr($row["status"]); ?>
          </div> -->
</li>
<?php
                 $i++;
      }
        //------------------------------
     echo "</ul>";
   mysqli_close($con);
    }
    function list_ts_non_status($filter,$ts_command_limit,$level ){
        if(strpos($filter,"ticket.status = 'Close'")!==false){
          $sort_de_status="ticket.id DESC ";
        }else{
          $sort_de_status="ticket.case_officer ASC, ticket.id ASC ";
        }
        $i=1;
        //--
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
        GROUP BY ticket.id order by ".$sort_de_status."  limit ".$ts_command_limit;
        echo "<script>console.log('".$query."');</script>";
        $result = mysqli_query($con, $query);
        echo "<ul style='width: 95%;padding: 15px;'>";
          while( $row = mysqli_fetch_array($result)) {
                $count_comment_cr = $row["count_comment"];


                switch ($row['piority']) {
                    case "Urgent": $ri_style = "border-left: #dc3545 solid 10px;"; break;
                    case "High": $ri_style = "border-left: #f396bf solid 10px;"; break;
                    case "Medium": $ri_style = "border-left: #f396bf solid 10px;"; break;
                    case "low": $ri_style = "border-left: #ccc solid 10px;"; break;
                    default: $ri_style = "border-left: #ccc solid 10px;";
                }
             
                  date_default_timezone_set("Asia/Bangkok");
                  $con_project= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
                  mysqli_query($con_project, "SET NAMES 'utf8' ");
                  $query_project = "SELECT *
                  FROM all_in_one_project.project_bucket 
                  where prefix='".$row["ticket_template"]."'" or die("Error:" . mysqli_error($con));
                  $result_project = mysqli_query($con_project, $query_project);
                  while($row_project = mysqli_fetch_array($result_project)) {
                    $color_project = $row_project["color_project"];
                    $project_name = $row_project["project_name"];
                  }
                ?>
                  <li class="row shadow-sm rounded md-3 p-2 bg-white position-relative" style="<?php echo  $ri_style ?> "
                      data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample"
                      onclick="cr_id_toggle(<?php echo $row['id'] ?>)">
                      <div class="col-12" data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample"
                          onclick="cr_id_toggle(<?php echo $row['id'];?>) " style="align-self: center;">
                          <!-- <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-primary" style="<?php //echo $ico_ts_bg; ?>;left: -8px!important;"><ion-icon name="<?php //echo $ico_ts; ?>" style="margin: 0px;color: white!important;"></ion-icon> <span class="visually-hidden">unread messages</span></span> -->
                          <?php echo "<strong style='color: ".$color_project.";'>".$row["ticket_template"]."-".$row["id"]."</strong> ".$row["title"]; ?>
                          <!-- <div style="margin: 5px 0px;"><?php // echo badge_status_cr($row["status"]); ?></div> -->
                          <hr style="margin: 5px;color: #6c757d8c;">
                          <div><img data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $row["case_officer"]; ?>"
                                  width="25px" height="25px" src="base/image/user_profile/<?php echo $row["case_officer"]; ?>.jpg"
                                  class="rounded-circle" alt="<?php echo $row["case_officer"]; ?>"><span
                                  style="margin-left:5px"><?php echo $row["case_officer"]; ?></span></div>
                      </div>
                  </li>
                  <?php $i++; }
                  
                      echo "</ul>";
                    mysqli_close($con);
                }
        //----------------- new
        echo '<div >
        <div class="row">';
        date_default_timezone_set("Asia/Bangkok");
        $con_status= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $query_status = "SELECT * FROM content_service_gate.attribute_option 
        where attribute_id= 38 and attribute_option not in ('cancel','routine work','monitor','In-review','close')" or die("Error:" . mysqli_error($con));
        $result_status = mysqli_query($con_status, $query_status);
              $i=0;
        while($row_status = mysqli_fetch_array($result_status)) {
        $limit = $ts_command_limit;
          if($i==0){
            echo' <div class="col" id="col_'.$row_status["attribute_option"].'" ondrop="drop_card_cr(event,'.$row_status["attribute_option"].')" ondragover="allowDrop(event)" >
            <small class="row m-3" style="font-weight: 900;">'.$row_status["attribute_option"].'</small>';
            list_ts_non_status("(".$filter.") and ticket.ticket_template in (".$_SESSION['prefix_project_sticky'].")  and ticket.status = '".$row_status["attribute_option"]."'",$limit ,'ticket');
            echo '</div>';
          }else{
            echo' <div class="col" style="border-left: 1px solid #e3e2e2;" id="col_'.$row_status["attribute_option"].'" ondrop="drop_card_cr(event,'.$row_status["attribute_option"].')" ondragover="allowDrop(event)" >
            <small class="row m-3" style="font-weight: 900;">'.$row_status["attribute_option"].'</small>';
            list_ts_non_status("(".$filter.") and ticket.ticket_template in (".$_SESSION['prefix_project_sticky'].")  and ticket.status = '".$row_status["attribute_option"]."'",$limit ,'ticket');
            echo '</div>';
          }
          $i++;
        }
        // echo '<small class="row m-3">Assigned to other</small>';
        //   list_ts("(ticket.case_officer <> '".$_SESSION["username"]."' and ticket.case_officer <> 'unassign'  ) and ticket.ticket_template in (".$_SESSION['prefix_project_sticky'].")  and ticket.status <> 'Close'",500 ,'ticket');
        //   echo '<hr>';
        echo '</div>
        </div>';
        //------------- new
    
?>