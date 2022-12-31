<?php
session_start();
include_once("get_function_badge.php");
include_once("get_default_profile_image.php");
//query limit
if($_POST["ts_command_limit"]<>""){
  $ts_command_limit = $_POST["ts_command_limit"];
}else{
  $ts_command_limit= 300;
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
function listing_ticket_card($result_after_fetch ,$status){
  $row  = "";
  echo "<ul id='ul_".$status."' style='padding:15px'>";
  while( $row = mysqli_fetch_array($result_after_fetch)) {

    if(strtolower($row['status'])==strtolower($status)){
      ?>
      <li class="row shadow-sm rounded mb-3 p-2 bg-white position-relative npd-card-bording-priority-<?php echo strtolower($row['piority']); ?>"
      onclick="cr_id_toggle(<?php echo $row['id'];?>) " data-bs-toggle="offcanvas" data-bs-target="#detail_cr"
      data-card="#detail_cr" data-bucket="<?php echo $row['prefix'];?>" data-cr-status="<?php echo $row['status'];?>"
      data-cr-request-for="<?php echo $row['ticket_type'];?>" data-cr-id="<?php echo $row['id'];?>"
      data-cr-participant="<?php echo strtolower($row['participant']);?>" id="crid_<?php echo $row['id'];?>"
      data-cr-title="<?php echo strtolower($row['title']);?>" aria-controls="offcanvasExample">
      <div class="row" style="padding-right: 0px;">
      <div class="col-10" style="padding-right: 0px;" onclick="cr_id_toggle(<?php echo $row['id'];?>) "
      data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample">
      <?php echo "<strong style='color: ".$row["color_project"].";'>".$row["ticket_template"]."-".$row["id"]."</strong> ".$row["title"]; ?>
      </div>
      <div class="col-2" style="padding-right: 0px;" onclick="cr_id_toggle(<?php echo $row['id'];?>) "
      data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample">
      <?php
      if($row["contain_content"] == 'Yes'){
        echo '<ion-icon style="color:#41baf0!important" name="pencil-outline"></ion-icon>';
      }
      if($row["contain_studio"] == 'Yes'){
        echo '<ion-icon style="color:#CC0000!important" name="image-outline"></ion-icon>';
      }
      if($row["contain_datapump"] == 'Yes'){
        echo '<ion-icon style="color:#e126ec!important" name="server-outline"></ion-icon>';
      }
      if($row["contain_data"] == 'Yes'){
        echo '<ion-icon style="color:#41baf0!important" name="receipt-outline"></ion-icon>';
      }
      ?>
      </div>
      </div>
      <hr style="margin: 5px;color: #6c757d8c;">
      <div class="row" style="margin-bottom: 0px;" onclick="cr_id_toggle(<?php echo $row['id'];?>)"
      data-bs-toggle="offcanvas" data-bs-target="#detail_cr">
      <?php
      $ef_badge = "";
      $image_profile = "";
      if($row['case_officer']==null or $row['case_officer']=="" or $row['case_officer']=="unassign"){
        echo '<div class="col card-unassin-bt" >';
        echo  '<a type="button" class="btn btn-sm btn-outline-secondary" style="border-radius: 15px;">Unassign</a>';
        echo '</div>';
        echo '<div class="col card-unassin-eft" >';
        echo  badge_due_date($row["effective_date"]);
        echo '</div>';
      }else{
        $ef_badge = "";
        $image_profile = "";
        $officer_display =  explode(",",$row['case_officer']);
        foreach ($officer_display as $officer){
          // $image_profile = profile_image($officer,$row['department'],25,$officer,1);
          $image_profile = profile_avatar($officer,$row['department'],25);
          echo '<div class="badge-profile">';
          echo '<div class="col">';
          echo $image_profile;
          echo '</div>';
          echo '<div class="col card-assign-name">';
          echo ucwords($officer);
          echo '</div>';
          echo '</div>';
        }
        echo '<div class="col card-assigned-eft">';
        echo  badge_due_date($row["effective_date"]);
        echo '</div>';
      }
      ?>
      </div>
      </li>
      <?php
    }
  }
  echo "</ul>";
  unset($result_after_fetch);
  unset($status);
}
// query all status
$sort_de_status="ticket.status DESC , -ticket.effective_date DESC ,ticket.case_officer ASC, ticket.id ASC";
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
ticket.ticket_type as ticket_type,
pb.color_project as color_project,
pb.prefix as prefix,
case when ticket.ticket_type like '%Content%' or ticket.ticket_type like '%Status%' then 'Yes' end as contain_content,
case when ticket.ticket_type like '%Provide%' then 'Yes' end as contain_data,
case when ticket.ticket_type like '%Image%' then 'Yes' end as contain_studio,
case when ticket.ticket_type like '%Datapump%' then 'Yes' end as contain_datapump
FROM all_in_one_project.content_request as ticket
Left join all_in_one_project.project_bucket pb
on pb.prefix  = ticket.ticket_template
where (".$filter.") and lower(ticket.status) not in ('cancel','routine work','monitor','in-review','close','archive')
order by ".$sort_de_status."  limit 500";


// getting by status
$query_status = "SELECT attribute_option_code FROM u749625779_cdscontent.job_attribute_option
where attribute_code= 'status' and attribute_table = 'content_request' and
attribute_option_code not in('cancel','routine work','monitor','In-review','close','Waiting Buyer', 'Waiting Execution','Waiting CTO')"
or die("Error:" . mysqli_error($con));
$result_status = mysqli_query($con, $query_status);
$i=0;
while($row_status = mysqli_fetch_array($result_status)) {
  if($i>0){$ts_board_col_left = "ts-board-col-left";}
  $ticket_status=$row_status["attribute_option_code"];

  echo' <div class="col '.$ts_board_col_left.'" id="col_'.$ticket_status.'"  >
  <small class="row m-3" style="font-weight: 900;">'.$ticket_status.'</small>';
  $result = mysqli_query($con, $query);
  $result_after_fetch =$result;
  listing_ticket_card( $result_after_fetch,$ticket_status);
  echo '</div>';
  $i++;

}
//getting status=waiting
echo' <div class="col ts-board-col-left" id="col_waiting"  >
<small class="row m-3" style="font-weight: 900;">Waiting</small>';
$result = mysqli_query($con, $query);
$result_after_fetch =$result;
echo'<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
<li class="nav-item" role="presentation" style="width: fit-content;">
  <button class="nav-link active" id="pills-waiting_buyer-tab" data-bs-toggle="pill" data-bs-target="#pills-waiting_buyer" type="button" role="tab" aria-controls="pills-waiting_buyer" aria-selected="true">Buyer</button>
</li>
<li class="nav-item" role="presentation" style="width: fit-content;">
  <button class="nav-link" id="pills-execution-tab" data-bs-toggle="pill" data-bs-target="#pills-execution" type="button" role="tab" aria-controls="pills-execution" aria-selected="false">Execution</button>
</li>
<li class="nav-item" role="presentation" style="width: fit-content;">
  <button class="nav-link" id="pills-cto-tab" data-bs-toggle="pill" data-bs-target="#pills-cto" type="button" role="tab" aria-controls="pills-cto" aria-selected="false">CTO</button>
</li>
</ul>';

echo'<div class="tab-content" id="pills-tabContent">
<div class="tab-pane fade show active" id="pills-waiting_buyer" role="tabpanel" aria-labelledby="pills-waiting_buyer-tab" tabindex="0">'.listing_ticket_card( $result_after_fetch,'Waiting Buyer').'</div>
<div class="tab-pane fade" id="pills-execution" role="tabpanel" aria-labelledby="pills-execution-tab" tabindex="0">'.listing_ticket_card( $result_after_fetch,'Waiting Execution').'</div>
<div class="tab-pane fade" id="pills-cto" role="tabpanel" aria-labelledby="pills-cto-tab" tabindex="0">'.listing_ticket_card( $result_after_fetch,'Waiting CTO').'</div>
</div>';

echo '</div>';

mysqli_close($con);
?>