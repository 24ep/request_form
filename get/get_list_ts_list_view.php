<?php
session_start();
include_once("get_function_badge.php");
include_once("get_default_profile_image.php");
//query limit
if($_POST["ts_command_limit"]<>""){
  $ts_command_limit = $_POST["ts_command_limit"];
}else{
  $ts_command_limit= 500;
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
    function list_ts_non_status($filter,$ts_command_limit ,$status){
        if(strpos($filter,"ticket.status = 'Close'")!==false){
          $sort_de_status="-ticket.effective_date DESC ,ticket.id DESC ";
        }else{
          $sort_de_status="-ticket.effective_date DESC ,ticket.case_officer ASC, ticket.id ASC";
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
        ac.firstname as firstname,
        ac.lastname as lastname,
        ac.nickname as nickname,
        ac.department as department,
        ac.username as username,
        pb.color_project as color_project,
        pb.prefix as prefix,
        case when ticket.ticket_type like '%Content%' or ticket.ticket_type like '%Status%' then 'Yes' end as contain_content,
        case when ticket.ticket_type like '%Provide%' then 'Yes' end as contain_data,
        case when ticket.ticket_type like '%Image%' then 'Yes' end as contain_studio,
        case when ticket.ticket_type like '%Datapump%' then 'Yes' end as contain_datapump
        FROM all_in_one_project.content_request as ticket
        Left join all_in_one_project.account ac
        on ac.username = ticket.case_officer
        Left join all_in_one_project.project_bucket pb
        on pb.prefix  = ticket.ticket_template
        where ".$ts_filter."  and status <> 'archive' 
        GROUP BY  ticket.id order by ".$sort_de_status."  limit ".$ts_command_limit;
        $result = mysqli_query($con, $query);
        echo " <table class='table table-hover'>";
        echo "  <tr>
                    <th>Id</th>
                    <td>Title</td>
                    <td>STATUS</td>
                    <td>Request for</td>
                    <td>Due date</td>
                </th>";
          while( $row = mysqli_fetch_array($result)) {
                ?>
            <!-- ui -->
            <tr>
                <th><?php echo $row['ticket_template']."-".$row['id']; ?></th>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['ticket_type']; ?></td>
                <td><?php echo $row['effective_date']; ?></td>
            </tr>
            <!-- ui -->
        <?php $i++; }
        echo '</table>';
                      echo "</ul>";
                    mysqli_close($con);
        }
        echo' <div class="col '.$ts_board_col_left.'" id="col_'.$row_status["attribute_option"].'"  >
        <small class="row m-3" style="font-weight: 900;">'.$row_status["attribute_option"].'</small>';
        list_ts_non_status("(".$filter.")",$ts_command_limit  ,$row_status["attribute_option"]);
        echo '</div>';
        mysqli_close($con_status);
        ?>