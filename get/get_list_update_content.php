<?php
session_start();
include_once('../get/get_option_function.php');
$username_op_cr = getoption_return_filter("username","account",$_SESSION["user_cr_filter"],"single","all_in_one_project");
$request_for_op = get_option_return_filter("ticket_type","","single","content_request");
$request_cr_status_op = get_option_return_filter("status","","single","content_request");
 function badge_ticket_type_cr($type){
    switch ($type) {
      case "Update Content": $type = '<span class="badge bg-primary" style="background-color: #fdfdfd!important;color: #5f85ff99!important;padding: 8px;">'.$type.'</span>'; break;
      case "Update Content & Image": $type = '<span class="badge bg-primary" style="background-color: #fdfdfd!important;color: #24929b99!important;padding: 8px;">'.$type.'</span>'; break;
      case "Free Gift Image": $type = '<span class="badge bg-primary" style="background-color: #fdfdfd!important;color: #f12f6099!important;padding: 8px;">'.$type.'</span>'; break;
      case "Change status": $type = '<span class="badge bg-primary" style="background-color: #fdfdfd!important;color: #2ff19499!important;padding: 8px;">'.$type.'</span>'; break;
      case "Product not found": $type = '<span class="badge bg-primary" style="background-color: #fdfdfd!important;color: #5f85ff99!important;padding: 8px;">'.$type.'</span>'; break;
      case "Update image": $type = '<span class="badge bg-primary" style="background-color: #fdfdfd!important;color: #f12f6099!important;padding: 8px;">'.$type.'</span>'; break;
      case "Datapump Add Source": $type = '<span class="badge bg-primary" style="background-color: #fdfdfd!important;color: #c567d399!important;padding: 8px;">'.$type.'</span>'; break;
      case "Datapump Delete Source": $type = '<span class="badge bg-primary" style="background-color: #fdfdfd!important;color: #c567d399!important;padding: 8px;">'.$type.'</span>'; break;
      default: $type = '<span class="badge bg-primary" style="background-color: #fdfdfd!important;color: #00000099!important;padding: 8px;">'.$type.'</span>';
    }
    return $type;
    }
    function badge_ticket_status_cr($status){
        switch ($status) {
          case "Close": $status = '<span class="badge bg-transparent" style="min-width: 120px;border: 1px solid #0eb32699!important;padding: 8px;color:#0eb32699">'.$status.'</span>'; break;
          case "Pending": $status = '<span class="badge bg-transparent" style="min-width: 120px;border: 1px solid #afafaf99!important;padding: 8px;color:#afafaf99">'.$status.'</span>'; break;
          case "Inprogress": $status = '<span class="badge bg-transparent" style="min-width: 120px;border: 1px solid #d7aa3999!important;padding: 8px;color:#d7aa3999">'.$status.'</span>'; break;
          case "Waiting Buyer": $status = '<span class="badge bg-transparent" style="min-width: 120px;border: 1px solid #cf67e599!important;padding: 8px;color:#cf67e599">'.$status.'</span>'; break;
          case "Waiting Execution": $status = '<span class="badge bg-transparent" style="min-width: 120px;border: 1px solid #182bd599!important;padding: 8px;color:#182bd599">'.$status.'</span>'; break;
          default: $status = '<span class="badge bg-transparent" style="min-width: 120px;border: 1px solid #00000099!important;padding: 8px;color:#00000099">'.$status.'</span>';
        }
        return $status;
        }
session_start();
include_once("get_function_badge.php");
include_once("get_default_profile_image.php");
if($_POST["bucket"] == 'all'){
  $bucket_filter = "";
}elseif($_POST["bucket"] ==""){
  $bucket_filter="";
}else{
  $bucket_filter = "and ticket.ticket_template = '".$_GET["bucket"]."'";
}
echo $bucket_filter;


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
          // $sort_de_status="-ticket.effective_date DESC ,ticket.id DESC ";
          $sort_de_status= "ticket.id DESC";
        }else{
          // $sort_de_status="-ticket.effective_date DESC ,ticket.case_officer ASC, ticket.id ASC";
          $sort_de_status= "ticket.id DESC";
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
        ticket.ticket_type as ticket_type,
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
        -- and ticket.status not in ('archive','cancel')
        where ".$ts_filter."  and lower(ticket.status) not in ('cancel','archive') ".$bucket_filter ."
         order by ".$sort_de_status;
        $result = mysqli_query($con, $query);

        echo "  <li class='row mb-3' style='color: #b3b3b3;font-weight: 600;text-align-last: center;'>
                    <div class='col'>Id</div>
                    <div class='col-4'>Title</div>
                    <div class='col'>STATUS</div>
                    <div class='col'>Request for</div>
                    <div class='col'>Due date</div>
                    <div class='col'>Assignee</div>
                    <div class='col'>Ticket</div>
                </li>";
          while( $row = mysqli_fetch_array($result)) {
                ?>
<!-- ui -->
<li class='row shadow-sm p-2 m-2 rounded bg-white' style='text-align: -webkit-center;align-items: center;'
    onclick="cr_id_toggle(<?php echo $row['id'];?>) " data-card="#detail_cr" data-bs-toggle="offcanvas" data-bs-target="#detail_cr"
    data-bucket="<?php echo $row['prefix'];?>" data-cr-status="<?php echo $row['status'];?>"
    data-cr-request-for="<?php echo $row['ticket_type'];?>" data-cr-id="<?php echo $row['id'];?>"
    data-cr-participant="<?php echo strtolower($row['participant']);?>" id="crid_<?php echo $row['id'];?>"
    data-cr-title="<?php echo strtolower($row['title']);?>" aria-controls="offcanvasExample">

    <div class="col"><?php echo "<strong style='color: ".$row["color_project"].";'>".$row["ticket_template"]."-".$row["id"]."</strong>";?></div>
    <div class="col-4" style="text-align: -webkit-left;"><?php echo $row['title']; ?></div>
    <div class="col" style="text-align: -webkit-center;"><?php echo badge_ticket_status_cr($row['status']); ?></div>
    <div class="col" style="text-align: -webkit-center;"><?php echo badge_ticket_type_cr($row['ticket_type']); ?></div>
    <div class="col" style="text-align: -webkit-center;"><?php echo badge_due_date($row["effective_date"]); ?></div>
    <div class="col" style="inline-size: 10px;">
        <?php
                        $ef_badge = "";
                        $image_profile = "";
                        if($row['case_officer']==null or $row['case_officer']=="" or $row['case_officer']=="unassign"){
                            echo '<div class="col card-unassign-bt" >';
                            echo  '<a type="button" class="btn btn-sm btn-outline-secondary">Unassign</a>';
                            echo '</div>';
                        }else{
                          $ef_badge = "";
                          $image_profile = "";
                          $officer_display =  explode(",",$row['case_officer']);
                          foreach ($officer_display as $officer){
                          //  $image_profile = profile_image($officer,$row['department'],25,$officer,1);
                           $image_profile = profile_avatar($officer,$row['department'],25);
                            echo '<div class="badge-profile" style="display: inline-flex;">';
                              echo '<div class="col">';
                              echo $image_profile;
                              echo '</div>';
                              echo '<div class="col card-assign-name">';
                              echo ucwords($officer);
                              echo '</div>';
                            echo '</div>';
                          }
                        }
                    ?>

    </div>
    <div class="col">
    <button onclick="cr_id_toggle(<?php echo $row['id'];?>) "  data-card="#detail_cr"
            data-bucket="<?php echo $row['prefix'];?>" data-cr-request-for="<?php echo $row['ticket_type'];?>"
            data-cr-id="<?php echo $row['id'];?>" data-cr-status="<?php echo $row['status'];?>"
            data-cr-participant="<?php echo strtolower($row['participant']);?>" id="crid_<?php echo $row['id'];?>"
            data-cr-title="<?php echo strtolower($row['title']);?>"  type="button"
            class="btn btn-dark btn-sm">Detail</button>
    </div>
</li>
<!-- ui -->
<?php $i++; }

                    mysqli_close($con);
        }
        echo' <div class="col '.$ts_board_col_left.'" id="col_'.$row_status["attribute_option"].'"  >
        <small class="row m-3" style="font-weight: 900;">'.$row_status["attribute_option"].'</small>';
        list_ts_non_status("(".$filter.")",$ts_command_limit  ,$row_status["attribute_option"]);
        echo '</div>';
        mysqli_close($con_status);
        ?>