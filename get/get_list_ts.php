<?php
session_start();
include_once("get_function_badge.php");
include_once("get_default_profile_image.php");

//query limit
if($_POST["ts_command_limit"]<>""){
  $ts_command_limit = $_POST["ts_command_limit"];
}else{
  $ts_command_limit= 100;
}
//query username filter
if($_POST["ts_username"]<>"" and $_POST["ts_username"]<>null ){
  $_SESSION["ts_username"] = $_POST["ts_username"];
}elseif($_GET["ts_username"]<>"" and $_GET["ts_username"]<>null){
  $_SESSION["ts_username"] = $_GET["ts_username"];
}else{
  $_SESSION["ts_username"] = "";
}
//query search input
if($_POST["summary_filter"]<>"" and $_POST["summary_filter"]<>null ){
  $_SESSION["ts_query_input"] = $_POST["summary_filter"];
}elseif($_GET["summary_filter"]<>"" and $_GET["summary_filter"]<>null){
  $_SESSION["ts_query_input"] = $_GET["summary_filter"];
}else{
  $_SESSION["ts_query_input"] = "";
}

$filter = "";
$filter .= "lower(ticket.id) like lower('%".$_SESSION["ts_query_input"]."%') or ";
$filter .= "lower(ticket.title) like lower('%".$_SESSION["ts_query_input"]."%') or ";
$filter .= "lower(ticket.description) like lower('%".$_SESSION["ts_query_input"]."%') ";
  

    function list_ts_non_status($filter,$ts_command_limit,$level ){
        if(strpos($filter,"ticket.status = 'Close'")!==false){
          $sort_de_status="-ticket.effective_date DESC ,ticket.id DESC ";
        }else{
          $sort_de_status="-ticket.effective_date DESC ,ticket.case_officer ASC, ticket.id ASC ";
        }
        $i=1;
        //--
        $ts_filter = $filter;
        $con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $query = "SELECT ticket.id as id,
        ticket.title as title,
        ticket.piority as piority,
        ticket.request_by as request_by,
        ticket.create_date as create_date,
        ticket.status as status,
        ticket.ticket_template as ticket_template,
        ticket.participant as participant,
        ticket.case_officer as case_officer,
        ticket.effective_date as effective_date,
        ticket.color_project as color_project,
        ac.firstname as firstname,
        ac.lastname as lastname,
        ac.department as department,
        ac.username as username,
        pb.color_project as color_project,
        case when ticket.ticket_type like '%Content%' then 'Yes' end as contain_content,
        case when ticket.ticket_type like '%Image%' then 'Yes' end as contain_studio,
        case when ticket.ticket_type like '%Datapump%' then 'Yes' end as contain_datapump
        FROM all_in_one_project.content_request as ticket
        Left join all_in_one_project.account ac
        on ac.username = ticket.case_officer 
        Left join all_in_one_project.project_bucket pb 
        on pb.prefix  = ticket.ticket_template 
        where ".$ts_filter." 
        GROUP BY  ticket.id order by ".$sort_de_status."  limit ".$ts_command_limit;
        // echo "<script>console.log('".$query."');</script>";
        $result = mysqli_query($con, $query);
        echo "<ul style='padding:15px'>";
          while( $row = mysqli_fetch_array($result)) {
           
                ?>
<li class="row shadow-sm rounded md-3 p-2 bg-white position-relative npd-card-bording-priority-<?php echo strtolower($row['piority']); ?>"
    data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample"
    onclick="cr_id_toggle(<?php echo $row['id'] ?>)">

    <div class="col-12" data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample"
        onclick="cr_id_toggle(<?php echo $row['id'];?>) " style="align-self: center;">
        <div class="row">
            <div class="col-10">
                <?php echo "<strong style='color: ".$row["color_project"].";'>".$row["ticket_template"]."-".$row["id"]."</strong> ".$row["title"]; ?>
            </div>
            <div class="col-2">
                <!-- icon -->
            </div>
        </div>
        <hr style="margin: 5px;color: #6c757d8c;">
        <div>
            <div class="row">
                <?php     
                    unset($ef_badge);
                    unset($image_profile);
                    $image_profile = profile_image($row['firstname'],$row['department'],25,$row['case_officer'],1);
                    if($row['case_officer']==null or $row['case_officer']=="" or $row['case_officer']=="unassign"){
                        echo '<div class="col card-unassin-bt" >';
                        echo  '<a type="button" class="btn btn-sm btn-outline-secondary">Unassign</a>';
                        echo '</div>';
                        echo '<div class="col card-unassin-eft" >';
                        echo  badge_due_date($row["effective_date"]);
                        echo '</div>';
                    }else{
                        echo '<div class="col card-col-image-profile">';
                        echo $image_profile;
                        echo '</div>';
                        echo '<div class="col card-assign-name">';
                        echo ucwords($row["case_officer"]);
                        echo '</div>';
                        echo '<div class="col card-assigned-eft">';
                        echo  badge_due_date($row["effective_date"]);
                        echo '</div>';
                              }
                    ?>
            </div>
        </div>
    </div>
</li>
<?php $i++; }
                      echo "</ul>";
                    mysqli_close($con);
                }
        //----------------- new
        echo '<div >
        <div class="row">';
        $con_status= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
        mysqli_query($con, "SET NAMES 'utf8' ");
        $query_status = "SELECT * FROM content_service_gate.attribute_option 
        where attribute_id= 38 and attribute_option not in ('cancel','routine work','monitor','In-review','close')" or die("Error:" . mysqli_error($con));
        $result_status = mysqli_query($con_status, $query_status);
        $i=0;
        while($row_status = mysqli_fetch_array($result_status)) {

        if($i>0){
          $ts_board_col_left = "ts-board-col-left";
        }

        echo' <div class="col '.$ts_board_col_left.'" id="col_'.$row_status["attribute_option"].'"  >
        <small class="row m-3" style="font-weight: 900;">'.$row_status["attribute_option"].'</small>';
        list_ts_non_status("(".$filter.") and ( lower(ticket.participant) like  lower('%".$_SESSION["ts_username"]."%') or  lower(ticket.case_officer) like lower('%".$_SESSION["ts_username"]."%') )  and ticket.ticket_template in (".$_SESSION['prefix_project_sticky'].")  and ticket.status = '".$row_status["attribute_option"]."'",$ts_command_limit  ,'ticket');
        echo '</div>';
        $i++;
        }
     
        echo '</div>
        </div>';
        //------------- new
?>