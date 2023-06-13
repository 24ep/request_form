<!DOCTYPE html>
<style>
.multiple-select_cr_edit .ms-choice {
    border: 0px;
}
.tox .tox-tinymce .tox-tinymce--toolbar-bottom{
  border-radius: 10px;
}

label#label_file {
    color: #adb5bd;
    font-size: 12px;
    font-weight: 600 !important;
}
</style>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php
session_start();

$id = $_POST['id'];
include_once('../get/get_option_function.php');
function get_attachment_cr($id){
  $list_attachment ="";
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT * FROM attachment WHERE ticket_type = 'content_request' and ticket_id = ".$id." and is_image<>1 ORDER BY id ASC" or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  $list_attachment .=  '<hr class="cr_hr_detail">
  <small style="display:block;margin-bottom:3px"><strong class="cr_detail_with_attachment">Attachments</strong></small>
  <ul class="list-group mt-2">';
  while($row = mysqli_fetch_array($result)) {
    $herf = str_replace("../..",'../..',$row['file_path'].$row['file_name']);
    $list_attachment.=  '
    <li class="list-group-item d-flex justify-content-between align-items-left"
      style="border:0px;padding:0px;margin-top:5px;background: transparent;" >
      <a href="'.$herf.'" download="'.$row['file_name'].'" class="row attachment" style="flex-wrap: nowrap;" >
        <div class="col-1 p-0" style="place-self: center;">
          <ion-icon style="color: #7e7e7e;margin-right: 5px;font-size: xx-large;"name="document-attach-outline"></ion-icon>
        </div>
        <div class="col-11 ps-4">
          '.$row["file_name"].'
        </div>
      </a>
    </li>';
    $pass = true;
  }
  $list_attachment.= '</ul>';
  if(!isset($pass)){$pass=false;}
  if($pass==true){
    return $list_attachment;
  }
}
function get_image_cr($id){
  $list_image="";
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT * FROM attachment WHERE ticket_type = 'content_request' and ticket_id = ".$id." and is_image=1 ORDER BY id ASC" or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  if(isset($list_image)){$list_image.= '<div class="baguetteBoxFour gallery" style="display: inline-flex;">';}else{$list_image= '<div class="row">';}
  while($row = mysqli_fetch_array($result)) {
    $herf = str_replace("../..",'../..',$row['file_path'].$row['file_name']);
    $list_image.=  ' <div class="thumbnail">
    <a href="'.$herf .'" target="_blank">
    <figure class="figure">
    <img src="'.$herf .'" class="img-thumbnail img-fluid" alt="'.$row["file_name"].'  " style="object-fit:cover;width:100px;height:100px;">
    </a></div>';
  }
  // <figcaption class="figure-caption text-end">'.$row["file_name"].'</figcaption></a></div>';
  $list_image.= '</div>';
  return $list_image;
}

date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$query = "SELECT * FROM all_in_one_project.content_request where id=".$id." ORDER by id DESC";
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
  $description = $row["description"];
  $description = htmlspecialchars_decode($description,ENT_NOQUOTES);
  $request_by = $row["request_by"];
  $create_date = $row["create_date"];
  $title = $row["title"];
  $status = $row["status"];
  $ticket_type = $row["ticket_type"];
  $case_officer = $row["case_officer"];
  $cto_ref = $row["cto_ref"];
  $platform_issue = $row["platform_issue"];
  $brand = $row["brand"];
  $sku = $row["sku"];
  $note = $row["note"];
  $ticket_template = $row["ticket_template"];
  $participant = $row["participant"];
  $effective_date = $row["effective_date"];
  $origin_of_ticket = $row["origin_of_ticket"];
  $effective_date_edit =  str_replace(' ','T',$row["effective_date"]);
  $content_request_reson = $row["content_request_reson"];
  $ticket_template =$row["ticket_template"];
  if($case_officer=="" or $case_officer==null){
    $assign = '<div style="margin-bottom:15px">Unassign</div>';
  }else{
    $assign = '<div style="margin-bottom:15px">assign to '.$case_officer.'</div>';
  }

  $cr_op = get_option_attribute_entity("status","content_request",$status);
  $username_op_mul = get_username( $case_officer);
  $set_participant = str_replace(",","','",$participant);
  $set_participant = "'".trim($set_participant," ")."'";

  $type_op = get_option_attribute_entity("ticket_type","content_request",$ticket_type);
  $origin_of_ticket_op= get_origin_of_ticket("origin","origin_of_ticket",$origin_of_ticket,"single","all_in_one_project");
  $content_request_reason_op = get_option_attribute_entity("content_request_reson","content_request",$content_request_reson);
  $list_attachment = get_attachment_cr($id);
  $list_image = get_image_cr($id);
  // get contact
  $query = "SELECT * FROM all_in_one_project.account where username = '".$case_officer."' ORDER BY id DESC " or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {
    $case_nickname = $row['nickname'];
    $case_name = "Contact : ".$row['firstname']." ".$row['lastname']." ( ".$case_nickname." ) ";
    $office_tell = $row['office_tell'];
  }
  // get contact
  $query = "SELECT * FROM all_in_one_project.account where username = '".$request_by."' ORDER BY id DESC " or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query);
  while($row = mysqli_fetch_array($result)) {
    $request_by_nickname = $row['nickname'];
    $token_line = $row['token_line'];
    if($token_line<>""){
      $allow_requester_noti = ' <ion-icon name="notifications-outline"></ion-icon>';
    }else{
      $allow_requester_noti = "";
    }
    if($row['line_user_id']<> null and $row['line_user_id']<> "" ){
      if(strpos($_SESSION["department"],"Content")!==false or $_SESSION["department"]==""){
        $request_by_contact = $request_by." | ".$row['firstname']." ".$row['lastname']." ( ".$request_by_nickname." ) | ".$row['work_email']. " ".$allow_requester_noti;
        // $request_by_contact = $request_by." | ".$row['firstname']." ".$row['lastname']." ( ".$request_by_nickname." ) | ".$row['work_email']."<a type='button' href='https://chat.line.biz/Ubc7faf107145495bd45be106915c5ecd/chat/".$row['line_user_id']."' style='background:#00B900;color:white;border-radius:10px'class='btn btn-outline-success'>Chat with ".$row['nickname']."</a>";
      }else{
        $request_by_contact = $request_by." | ".$row['firstname']." ".$row['lastname']." ( ".$request_by_nickname." ) | ".$row['work_email']. " ".$allow_requester_noti;
      }
    }else{
      $request_by_contact = $request_by." | ".$row['firstname']." ".$row['lastname']." ( ".$request_by_nickname." ) | ".$row['work_email']. " ".$allow_requester_noti;
    }
  }
  date_default_timezone_set("Asia/Bangkok");
  $con_project= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con_project, "SET NAMES 'utf8' ");
  $query_project = "SELECT *
  FROM all_in_one_project.project_bucket
  where prefix='".$ticket_template."'" or die("Error:" . mysqli_error($con));
  $result_project = mysqli_query($con_project, $query_project);
  while($row_project = mysqli_fetch_array($result_project)) {
    $color_project = $row_project["color_project"];
    $project_name = $row_project["project_name"];
  }
  echo '
  <div class="modal fade" id="image_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
  <div class="modal-body">
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <img src="" class="image_preview" style="width: 100%;" >
  </div>
  </div>
  </div>
  </div>
  <div id="call_update_complete"></div>
  <div class="offcanvas-body"  style="padding:0px;z-index:1">
  <div class="row window-full overflow-auto" style="margin-bottom: 0px;padding-left:20px;background: white;">
  <div class="col-7" style="border-right:1px solid  #ebedef;padding: 1rem 1rem;">
  <div class="text-white bg-success toast align-items-center top-5 start-50 translate-middle-x fade hide" role="alert" aria-atomic="true" data-bs-delay="2000" aria-live="assertive" id="liveToast_cr" style="position: absolute; top: 0; right: 0;margin-top:10px;margin-right:10px">
  <div class="d-flex">
  <div class="toast-body" id="toast_ms">
  Hello, world! This is a toast message.
  </div>
  <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  </div>
  <small>
  <a type="button" style="text-decoration: none;color: gray;"
  onclick="get_page(&#39;cr_list&#39;);">
  <ion-icon name="chevron-back-outline" style="margin: 0px;"></ion-icon> Back to list
  </a>
  </small>
  <div style="color:gray;margin-bottom:15px;margin-top:10px;font-size:13px">
  <span>Create by
  '.$request_by_contact.'</span>
  <span>'.$create_date.'</span>
  </div>
  <span class="badge bg-primary" style="background-color:'.$color_project.'!important;margin-bottom:15px;padding:8px 15px;">'.$project_name.'</span>
  <button class="badge bg-light text-dark" style="border: solid 1px gainsboro;" id="EditDetailTicket" onclick="EditDetailTicket()"><ion-icon name="pencil-outline"></ion-icon></button>
  <button class="badge bg-primary" style="border: solid 1px gainsboro;display:none;"id="SaveDetailTicket"  onclick="SaveDetailTicket('.$id.')"><ion-icon style="color:white!important;margin-right:5px" name="save-outline"></ion-icon></ion-icon>Save</button>
  <button class="badge bg-secondary" style="border: solid 1px gainsboro;display:none;"id="CancelDetailTicket"  onclick="CancelDetailTicket('.$id.')"><ion-icon style="color:white!important;margin-right:5px" name="close-circle-outline"></ion-icon></ion-icon>Cancel</button>
  <div class="mb-3 row" style="font-size: 20px;">
  <label for="staticEmail" class="col-sm-2 col-form-label" style="width: fit-content;padding: 0px 0px 0px 12px">
  <strong style="color:'.$color_project.'!important;font-size: smaller;border-bottom: solid 3px;">'.$ticket_template.'-'.$id .'</strong></label>
  <div class="col-sm-10">
  <input class="input-cr-inactive" id="cr_edit_title" name="cr_edit_title" style="font-weight: bold;"
  type="text" disabled value="'.$title.'">
  </div>
  </div>
  <form method="post">
  <div class="des_cr" id="des_cr_inline" >';



  echo '
  <small style="display:block;margin-bottom:3px"><strong class="cr_detail_with_attachment">Description</strong></small>
  <div class="m-2">
  '.$description."</div>".$list_attachment.$list_image.'</div></form>
  <hr class="cr_hr_detail">
  <small style="font-weight: bolder;color: #adb5bd;margin-bottom:5px">Comments</small>
  <ul  class="list-group list-group-flush" style="background: fixed;">
  <div id="comment_box_cr">
  <div id="call_ticket_comment_cr">
  ';
  include('https://content-service-gate.cdse-commercecontent.com/base/get/get_comment_cr.php?id='.$id);
  echo '
  </div>
  </div>
  </ul>
  <textarea id="comment_input_cr" name="comment_input_cr" type="text" placeholder="Type message"></textarea>
  ';
  ?>
<?php
  echo '
  <div class="mb-3">
  <input type="file" id="actual-btn" name="actual-btn[]" multiple hidden/>
  <label id="label_file" name="label_file" for="actual-btn"><ion-icon name="attach-outline"></ion-icon>Attach file or image</label>
  <span id="file-chosen"> </span>
  </div>
  ';
  // }
  if($ticket_template=="PJ"){
    $sj = "Project";
  }else{
    $sj = "Ticket";
  }
  echo ' <button type="button" class="btn btn-outline-primary btn-sm" onClick="comment_cr_id_with_file('.$id.')"  >Add comment</button></div>';
  echo'
  <div class="col-5" style="padding:1rem 1rem;background: #f7f7f7;">
  <div style="margin-left: 10px;margin-right: 10px;">
  <small style="display:block;"><strong style="color:gray">'.$sj.' Status</strong></small>
  ';
  $cr_edit_status = "'cr_edit_status'";
  $cr_edit_case_officer = "'cr_edit_case_officer'";
  $cr_edit_ref_cto = "'cr_edit_cto_ref'";
  $cr_edit_platform_issue  = "'cr_edit_platform_issue '";
  $cr_edit_ticket_type = "'cr_edit_ticket_type'";
  $cr_edit_brand = "'cr_edit_brand'";
  $cr_edit_sku = "'cr_edit_sku'";
  $cr_edit_note = "'cr_edit_note'";
  $cr_edit_effective_date = "'cr_edit_effective_date'";
  $cr_edit_content_request_reson= "'cr_edit_content_request_reson'";
  $cr_edit_request_by= "'cr_edit_request_by'";
  $cr_edit_origin_of_ticket = "'cr_edit_origin_of_ticket'";
  // echo "<script>console.log('".$_SESSION["department"]."');</script>";
  if(strpos($_SESSION["department"],"Content")!==false or $_SESSION["department"]==""){
    echo '<select class="form-select form-select-lg mt-2" id="cr_edit_status" name="cr_edit_status" onchange="update_cr_detail('.$id.','.$cr_edit_status.')" style="border: 0px;font-weight: bold;padding-left: 0.6rem;font-size: xx-large;background-color: transparent;" aria-label=".form-select-lg example">
    '.$cr_op.'
    </select>';
    ?>
<?php
    echo '
    <div class="row" >
    <span style="padding: 0px 0px 5px 25px;"><strong>'.$sj.' Owner</strong></span>
    <div class="col " style=" padding-left: 25px;text-align-last: right;">
    <input type="hidden" id="cr_edit_case_officer" name="cr_edit_case_officer" value="'.$case_officer.'">
    <select  multiple id="cr_edit_case_officer_show"
    name="cr_edit_case_officer_show"
    aria-label=".form-select-lg example">
    <option data-placeholder="true"></option>
    '.$username_op_mul.'
    </select>
    </div>
    </div>';

    echo '<hr>';
   echo '
    <small style="display:block;margin-bottom:3px"><strong class="cr_detail_with_attachment">Origin of ticket</strong></small>
      <div style="border: 0px;text-align-last: left;" class="mt-2 mb-3 pt-2 pt-2">
        <input type="hidden" id="cr_edit_origin_of_ticket" name="cr_edit_origin_of_ticket" value="'.$origin_of_ticket.'">
        <select  id="cr_edit_origin_of_ticket_show" class="origin_block_out" aria-label=".form-select-lg example" onchange="update_cr_detail('.$id.',&#39;cr_edit_origin_of_ticket&#39;)">
        <option data-placeholder="true"></option>
          '.$origin_of_ticket_op.'
        </select>
      </div>
      <hr class="cr_hr_detail">';
      echo '
      <small style="display:block;margin-bottom:3px"><strong class="cr_detail_with_attachment">Origin of ticket</strong></small>
        <div style="border: 0px;text-align-last: left;" class="mt-2 mb-3 pt-2 pt-2">
          <input type="hidden" id="cr_edit_origin_of_ticket" name="cr_edit_origin_of_ticket" value="'.$origin_of_ticket.'">
          <select  id="cr_edit_origin_of_ticket_show" class="origin_block_out" aria-label=".form-select-lg example" onchange="update_cr_detail('.$id.',&#39;cr_edit_origin_of_ticket&#39;)">
          <option data-placeholder="true"></option>
            '.$origin_of_ticket_op.'
          </select>
        </div>
        <hr class="cr_hr_detail">';

    ?>
<div class="row">
    <div class="col">
        <strong>TASK LIST</strong><br>
    </div>
    <div class="col">
        <div class="d-grid gap-1 d-md-flex justify-content-md-end" style="margin-bottom: 8px;">
            <button class="btn btn-primary btn-sm"
                onclick="add_cr_list(<?php echo $id; ?>,'<?php echo $ticket_template; ?>')">
                <ion-icon name="add-outline" role="img" class="md hydrated" aria-label="add outline"></ion-icon> ADD
                TASK
            </button>
        </div>
    </div>
</div>
<ul id="checklist_box" style="padding: 5px;">
    <?php     include('https://content-service-gate.cdse-commercecontent.com/base/get/get_checklist_cr.php?id='.$id.'&department='.$_SESSION["department"]); ?>
</ul>
<?php
    if($ticket_template<>"PJ"){
      echo '<hr>';
      // ---- end check list
      // start detail
      echo '
      <ul class="list-group">
      <li class="list-group-item" style="display: inline-flex;background: #dee2e6;"><div class="col-6 fw-bold ">Ticket CTO</div><div class="col-6">
      <input class="form-control form-control-sm" id="cr_edit_cto_ref" name="cr_edit_cto_ref" onchange="update_cr_detail('.$id.','.$cr_edit_ref_cto.')" type="text" style="border: 0px;" placeholder="Default input" aria-label="default input example" value="'.$cto_ref.'">
      </div>
      </li>
      <li class="list-group-item" style="display: inline-flex;background: #dee2e6;"><div class="col-6 fw-bold ">Request for</div><div class="col-6">
      <select class="form-select form-select-sm" id="cr_edit_ticket_type" name="cr_edit_ticket_type" onchange="update_cr_detail('.$id.','.$cr_edit_ticket_type.')" style="border: 0px;font-weight: bold;" aria-label=".form-select-lg example">
      '.$type_op.'
      </select>
      </div></li>
      <li class="list-group-item" style="display: inline-flex;background: #dee2e6;"><div class="col-6 fw-bold ">SKUs</div><div class="col-6">
      <input class="form-control form-control-sm" id="cr_edit_sku" name="cr_edit_sku" onchange="update_cr_detail('.$id.','.$cr_edit_sku.')" type="text" style="border: 0px;" placeholder="" aria-label="default input example" value="'.$sku.'">
      </div>
      </li>
      <li class="list-group-item" style="display: inline-flex;background: #dee2e6;"><div class="col-6 fw-bold ">Effective date</div><div class="col-6">
      <input class="form-control form-control-sm" id="cr_edit_effective_date" name="cr_edit_effective_date" onchange="update_cr_detail('.$id.','.$cr_edit_effective_date.')" type="datetime-local" style="border: 0px;" placeholder="" aria-label="default input example" value="'.$effective_date_edit.'">
      </div></li>
      </ul>
      <br>';
    }
    if($ticket_template<>"PJ"){
      echo '
      <hr>
      <small style="display:block"><strong style="color:gray">Internal</strong></small>
      <div class="mb-3 row">
      <label for="exampleDataList" class="col-sm-3 col-form-label">Origins</label>
      <div class="col-sm-9">
      <input class="form-control form-control-sm" list="datalistOptions"  onchange="update_cr_detail('.$id.','.$cr_edit_content_request_reson.')" id="cr_edit_content_request_reson" name="cr_edit_content_request_reson" placeholder="Type to search..." value="'.$content_request_reson.'">
      <datalist id="datalistOptions">
      '.$content_request_reason_op.'
      </datalist>
      </div>
      </div>';

      echo'
      <div class="mb-3">
      <label for="exampleFormControlTextarea1" class="form-label">Internal note</label>
      <textarea id="cr_edit_note" name="cr_edit_note" onchange="update_cr_detail('.$id.','.$cr_edit_note.')"  class="form-control"  rows="5">'.$note.'</textarea>
      </div>';
    }
  }else{
    echo '<h4 style="font-weight: 900;padding-left: 0rem;font-size: xxx-large;background-color: transparent;">'.$status.'</h4>';
    ?>
<hr>
<div class="col">
    <strong>TASK LIST</strong><br>
    <small>Sub task of ticket (for staff)</small>
</div>
<ul id="checklist_box" style="padding: 5px;">
    <?php     include('https://content-service-gate.cdse-commercecontent.com/base/get/get_checklist_cr.php?id='.$id.'&department='.$_SESSION["department"]); ?>
</ul>
<?php
    echo '
    <hr>
    <ul class="list-group list-group shadow-sm border-0 rounded bg-white">
    <li class="list-group-item border-0 border-bottom" style="display: inline-flex;"><div class="col-6 fw-bold ">Assign</div><div class="col-6">'.$case_officer.'</div></li>
    <li class="list-group-item border-0 border-bottom" style="display: inline-flex;"><div class="col-6 fw-bold ">Name</div><div class="col-6">'.$case_name.'</div></li>
    <li class="list-group-item border-0 border-bottom "  style="display: inline-flex;;"><div class="col-6 fw-bold ">Office tell</div><div class="col-6">'.$office_tell.'</div></li>
    <li class="list-group-item border-0 border-bottom " style="display: inline-flex;"><div class="col-6 fw-bold ">Ticket CTO</div><div class="col-6">'.$cto_ref.'</div></li>
    <li class="list-group-item border-0 border-bottom" style="display: inline-flex;"><div class="col-6 fw-bold ">Request for</div><div class="col-6">'.$type.'</div></li>
    <li class="list-group-item border-0 border-bottom" style="display: inline-flex;"><div class="col-6 fw-bold ">SKUs</div><div class="col-6">'.$sku.'</div></li>
    <li class="list-group-item border-0 border-bottom" style="display: inline-flex;"><div class="col-6 fw-bold ">Effective date</div><div class="col-6">'.$effective_date.'</div></li>
    </ul>
    <br>
    '.$list_attachment.'
    <br>';
  }
  echo '</div>
  </div>
  </div>
  </div>';
}
?>
<script>
var actualBtn = document.getElementById('actual-btn');
var fileChosen = document.getElementById('file-chosen');
var fileChosen_bt = document.getElementById('label_file');
actualBtn.addEventListener('change', function() {
    // fileChosen.textContent = this.files[0].name
    count_file = this.files.length;
    var i;
    var file_name;
    for (i = 0; i < count_file; i++) {
        if (i == 0) {
            file_name = this.files[i].name;
        } else {
            file_name += " , " + this.files[i].name;
        }
    }
    if (file_name == "undefined") {
        fileChosen_bt.textContent = "";
    }
    fileChosen_bt.textContent = ' Selected file : ' + file_name;
})

function comment_cr_id(id) {
    //var comment = document.getElementById("comment_input_cr").value;
    var myIFrame = document.getElementById("comment_input_cr_ifr");
    var comment = myIFrame.contentWindow.document.body.innerHTML;
    alert("frame content : " + frameContent);
    //document.getElementById('comment').innerHTML  = ''; //clear value
    if (id) {
        $.post("https://content-service-gate.cdse-commercecontent.com/base/action/action_comment_cr.php", {
                id: id,
                comment: comment
            },
            function(data) {
                $('#call_ticket_comment_cr').html(data);
                document.getElementById('comment_box_cr').scrollBy(0, document.getElementById(
                    "call_ticket_comment_cr").offsetHeight);
            });
    }
}

function add_cr_list(id, ticket_template) {
    if (ticket_template == "CR") {
        var sku = document.getElementById("cr_edit_sku").value;
    } else {
        var sku = 0;
    }
    if (id) {
        $.post("base/action/action_create_checklist_cr.php", {
                id: id,
                sku: sku
            },
            function(data) {
                $('#checklist_box').html(data);
                // $('#call_ticket_comment_cr').html(data);
                // document.getElementById('comment_box_cr').scrollBy(0, document.getElementById(
                //     "call_ticket_comment_cr").offsetHeight);
            });
    }
}

function remove_cr_list(list_id, ticket_id) {
    if (list_id) {
        $.post("base/action/action_remove_checklist_cr.php", {
                list_id: list_id,
                ticket_id: ticket_id
            },
            function(data) {
                $('#checklist_box').html(data);
                // $('#call_ticket_comment_cr').html(data);
                // document.getElementById('comment_box_cr').scrollBy(0, document.getElementById(
                //     "call_ticket_comment_cr").offsetHeight);
            });
    }
}

function comment_cr_id_with_file(id) {
    var form_data = new FormData();
    // var comment = document.getElementById("comment_input_cr").value;
    var myIFrame = document.getElementById("comment_input_cr_ifr");
    var comment = myIFrame.contentWindow.document.body.innerHTML;
    myIFrame.contentWindow.document.body.innerHTML = '';
    // document.getElementById('comment_input_cr').value = ''; //clear value
    // var files = document.getElementById('actual-btn').files;
    var ins = document.getElementById('actual-btn').files.length;
    for (var x = 0; x < ins; x++) {
        form_data.append("files[]", document.getElementById('actual-btn').files[x]);
    }
    // form_data.append("files", files)  // Appending parameter named file with properties of file_field to form_data
    form_data.append("comment", comment) // Adding extra parameters to form_data
    form_data.append("id", id)
    $.ajax({
        url: "https://content-service-gate.cdse-commercecontent.com/base/action/action_comment_cr.php",
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data, // Setting the data attribute of ajax with file_data
        type: 'post',
        success: function(data) {
            $('#call_ticket_comment_cr').html(data);
            document.getElementById('comment_box_cr').scrollBy(0, document.getElementById(
                "call_ticket_comment_cr").offsetHeight);
            document.getElementById('actual-btn').value = ''; //clear value
            fileChosen_bt.textContent = ' + Attach file or image';
        }
    });
}

function update_cr_detail(id, id_name) {
    var id_name = id_name;
    var value_change = document.getElementById(id_name).value;
    if (id) {
        $.post("base/action/action_update_cr_detail.php", {
                id: id,
                value_change: value_change,
                id_name: id_name
            },
            function(data) {
                $('#call_update_complete').html(data);
                // document.getElementById('comment_box_cr').scrollBy(0, document.getElementById("call_ticket_comment_cr").offsetHeight);
            });
    }
}

function update_cl_detail(id, id_name) {
    var id_name = id_name;
    var value_change = document.getElementById(id_name + '_' + id).value;
    if (id) {
        $.post("base/action/action_update_checklist_cr.php", {
                id: id,
                value_change: value_change,
                id_name: id_name
            },
            function(data) {
                // $('#call_update_complete').html(data);
                // document.getElementById('comment_box_cr').scrollBy(0, document.getElementById("call_ticket_comment_cr").offsetHeight);
            });
    }
}

function EditDetailTicket() {
    var disabled = document.getElementById("cr_edit_title").disabled;
    if (disabled) {
        document.getElementById("cr_edit_title").disabled = false;
        document.getElementById("EditDetailTicket").style.display = 'none';
        document.getElementById("SaveDetailTicket").disabled = false;
        document.getElementById("SaveDetailTicket").style.display = 'inline';
        document.getElementById("CancelDetailTicket").disabled = false;
        document.getElementById("CancelDetailTicket").style.display = 'inline';
        document.getElementById("cr_edit_title").className = document.getElementById("cr_edit_title").className.replace(
            /(?:^|\s)input-cr-inactive(?!\S)/g, 'input-cr-active');
    } else {
        document.getElementById("cr_edit_title").disabled = true;
        document.getElementById("EditDetailTicket").style.display = 'inline';
        document.getElementById("SaveDetailTicket").disabled = true;
        document.getElementById("SaveDetailTicket").style.display = 'none';
        document.getElementById("CancelDetailTicket").disabled = true;
        document.getElementById("CancelDetailTicket").style.display = 'none';
        document.getElementById("cr_edit_title").className = document.getElementById("cr_edit_title").className.replace(
            /(?:^|\s)input-cr-active(?!\S)/g, 'input-cr-inactive');
    }
}

function SaveDetailTicket(id) {
    update_cr_detail(id, 'cr_edit_title');
    document.getElementById("cr_edit_title").disabled = true;
    document.getElementById("EditDetailTicket").style.display = 'inline';
    document.getElementById("SaveDetailTicket").style.display = 'none';
    document.getElementById("CancelDetailTicket").style.display = 'none';
    document.getElementById("cr_edit_title").className = document.getElementById("cr_edit_title").className.replace(
        /(?:^|\s)input-cr-active(?!\S)/g, 'input-cr-inactive');
}

function CancelDetailTicket(id) {
    document.getElementById("cr_edit_title").disabled = true;
    document.getElementById("EditDetailTicket").style.display = 'inline';
    document.getElementById("SaveDetailTicket").style.display = 'none';
    document.getElementById("CancelDetailTicket").style.display = 'none';
    document.getElementById("cr_edit_title").className = document.getElementById("cr_edit_title").className.replace(
        /(?:^|\s)input-cr-active(?!\S)/g, 'input-cr-inactive');
}
</script>
<script>
var elements = document.getElementsByClassName('window-full');
var windowheight = window.innerHeight + "px";
fullheight(elements);

function fullheight(elements) {
    for (let el in elements) {
        if (elements.hasOwnProperty(el)) {
            elements[el].style.height = windowheight;
        }
    }
}
window.onresize = function(event) {
    fullheight(elements);
}
</script>
<script>
</script>
<script>
// baguetteBox.run('.baguetteBoxFour', {
//     buttons: false
// });
// baguetteBox.run('.baguetteBoxFour'); //preview image
// pureScriptSelect('#multiSelect'); //multi select
new SlimSelect({
    select: '#cr_edit_case_officer_show',
    settings: {
        closeOnSelect: false,
        allowDeselectOption: true,
    },
    events: {
        afterChange: (info) => {
            var input_update = "";
            for (let i = 0; i < info.length; i++) {
                if (input_update == "") {
                    input_update = info[i].value;
                } else {
                    input_update = input_update + ',' + info[i].value;
                }
            }
            document.getElementById("cr_edit_case_officer").value = input_update;
            update_cr_detail(<?php echo $id; ?>, <?php echo $cr_edit_case_officer; ?>)
        }
    }
})
new SlimSelect({
    select: '#cr_edit_origin_of_ticket_show',
    settings: {
        closeOnSelect: false,
        placeholderText: 'Select origin of ticket',
    },
    events: {
        afterChange: (info) => {

            document.getElementById("cr_edit_origin_of_ticket").value = info[0].value;
            update_cr_detail(<?php echo $id; ?>, <?php echo $cr_edit_origin_of_ticket; ?>)
        }
    }
})
</script>
<script>
$(function() {
    $(".multiple-select_cr_edit").multipleSelect()
});
if (tinyMCE.get('comment_input_cr')) {
    tinymce.remove('#comment_input_cr');
} else {}
load_tiny_comment();
</script>

