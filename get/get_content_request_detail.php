<style>
.multiple-select_cr_edit .ms-choice {
    border: 0px;
}

label#label_file {
    color: #adb5bd;
    font-size: 12px;
    font-weight: 600 !important;
}
</style>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php
$id = $_POST['id'];
// $func = $_POST['func'];
function get_attachment_cr($id){
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT * FROM attachment WHERE ticket_type = 'content_request' and ticket_id = ".$id." and is_image<>1 ORDER BY id ASC" or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);
  $list_attchment .=  '<small style="display:block;margin-bottom:3px"><strong style="color:gray">Attchment</strong></small>
  <ul class="list-group ">';
    while($row = mysqli_fetch_array($result)) {
      $herf = str_replace("../..",'https://cdsecommercecontent.ga',$row['file_path'].$row['file_name']);
      $list_attchment.=  ' <li class="list-group-item d-flex justify-content-between align-items-left">
      <div><ion-icon name="document-attach-outline"></ion-icon>'.$row["file_name"].'</div>
      <a href="'.$herf.'" download="'.$row['file_name'].'"><ion-icon name="cloud-download-outline" style="color:blue"></ion-icon></a>
      </li>';
      $pass = true;
    }
    $list_attchment.= '</ul>';
    if(!isset($pass)){$pass=false;}
    if($pass==true){
      return $list_attchment;
    }else{
      return '<small><strong style="color:gray">No attachment</strong></small>';
    }
}
function get_image_cr($id){
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT * FROM attachment WHERE ticket_type = 'content_request' and ticket_id = ".$id." and is_image=1 ORDER BY id ASC" or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query);
  if(isset($list_image)){$list_image.= '<div class="row">';}else{$list_image= '<div class="row">';}
  
    while($row = mysqli_fetch_array($result)) {
      $herf = str_replace("../..",'https://cdsecommercecontent.ga',$row['file_path'].$row['file_name']);
      $list_image.=  ' <div class="col-md"><div class="thumbnail">
      <a href="'.$herf .'" target="_blank">
      <figure class="figure">
      <img src="'.$herf .'" class="img-thumbnail img-fluid" alt="'.$row["file_name"].'  " style="object-fit:cover;width:180px;height:180px;">
      <figcaption class="figure-caption text-end">'.$row["file_name"].'</figcaption></a></div></div>';
    }
    $list_image.= '</div>';
      return $list_image;
}
function getoption_return_edit_cr($col,$table,$select_option,$sorm,$database) {
    $con= mysqli_connect("localhost","cdse_admin","@aA417528639",$database) or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $query = "SELECT * FROM $table ORDER BY id asc" or die("Error:" . mysqli_error());
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
  // split array store
          if($sorm=="multi"){
            if($col=="store" or $col=="itemmize_type" or $col=="product_website"){
              $array_store = explode(', ', $select_option);
              $duplicate_op = false;
              $loop_in_null = false;
              foreach($array_store as $store)
              {
                if($row[$col] <> '' ) {
                  if($store==$row[$col]){
                    if(isset($option_set)){
                      $option_set .= '<option value="'.$row[$col].'" selected>'.$row[$col].'</option>';
                    }else{
                      $option_set = '<option value="'.$row[$col].'" selected>'.$row[$col].'</option>';
                    }
                    
                    $duplicate_op = true;
                  }
                }
              }
              if($row[$col] <> ''){
                if($duplicate_op == false){
                  if(isset($option_set)){
                  $option_set .= '<option value="'.$row[$col].'">'.$row[$col].'</option>';
                  }else{
                  $option_set = '<option value="'.$row[$col].'">'.$row[$col].'</option>';
                  }
                }
              }
            }
          }else{
            $loop_in_null=false;
            if($loop_in_null==false){
              if(isset($option_set)){
                $option_set .= '<option value=""></option>';
              }else{
                $option_set = '<option value=""></option>';
              }
           
              $loop_in_null=true;
            }
              if($row[$col] <> '' )
              {
                  if($select_option==$row[$col]){
                    $option_set .= '<option value="'.$row[$col].'" selected>'.$row[$col].'</option>';
                  }else{
                      $option_set .= '<option value="'.$row[$col].'">'.$row[$col].'</option>';
                  }
              }
      }
    }
       return $option_set;
       mysqli_close($con);
      }
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$query = "SELECT * FROM all_in_one_project.content_request where id=".$id." ORDER by id DESC";
$result = mysqli_query($con, $query);
// $result_count = mysqli_query($con, $query_count);
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
    $effective_date = $row["effective_date"];
    $effective_date_edit =  str_replace(' ','T',$row["effective_date"]);
    $content_request_reson = $row["content_request_reson"];
    if($case_officer=="" or $case_officer==null){
        $assign = '<div style="margin-bottom:15px">Unassign</div>';
    }else{
        $assign = '<div style="margin-bottom:15px">assign to '.$case_officer.'</div>';
    }
    $cr_op = getoption_return_edit_cr("content_request_status","option",$status,"single","all_in_one_project");
    $username_op = getoption_return_edit_cr("username","account",$case_officer,"single","all_in_one_project");
    $type_op = getoption_return_edit_cr("issue_type","option",$ticket_type,"single","all_in_one_project");
    $content_request_reson_op = getoption_return_edit_cr("content_request_reson","option",$content_request_reson,"single","all_in_one_project");
    $website_op = getoption_return_edit_cr("product_website","job_option_cms",$platform_issue,"multi","u749625779_cdscontent");
    $list_attachment = get_attachment_cr($id);
    $list_image = get_image_cr($id);
    // get contact
    $query = "SELECT * FROM all_in_one_project.account where username = '".$case_officer."' ORDER BY id DESC " or die("Error:" . mysqli_error());
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
      $case_nickname = $row['nickname'];
      $case_name = "Contact : ".$row['firstname']." ".$row['lastname']." ( ".$case_nickname." ) ";
      $office_tell = $row['office_tell'];
    }
    // get contact
    $query = "SELECT * FROM all_in_one_project.account where username = '".$request_by."' ORDER BY id DESC " or die("Error:" . mysqli_error());
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
      $request_by_nickname = $row['nickname'];
      $request_by_contact = $request_by." | ".$row['firstname']." ".$row['lastname']." ( ".$request_by_nickname." ) | ".$row['work_email'];
      // $office_tell = $row['office_tell'];
    }
    if($case_nickname==""){
      $case_nickname = "in queue";
      $office_tell  = "in queue";
    }
    echo ' 
    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">              
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <img src="" class="imagepreview" style="width: 100%;" >
          </div>
        </div>
      </div>
    </div>
        <div id="call_update_complete"></div>
        <div class="offcanvas-body"  > 
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" style="position: fixed;right: 40px;" aria-label="Close"></button>
        <div class="row  window-full overflow-auto">
        <div class="col-8" style="border-right:1px solid  #ebedef;">
        <div style="color:gray;margin-bottom:15px;margin-top:10px;font-size:13px">
        <span>Create by '.$request_by_contact.'</span>   
        <span>'.$create_date.'</span>      
        </div>
        <h5><strong style="color:red;">CR-'.$id .'</strong> '.$title.'</h5>
        <div style="padding:20px">'.$description.'</div>
        '.$list_image.'
        <hr style="margin-bottom:5px;color: #dee2e6;">
        <small style="font-weight: bolder;color: #adb5bd;">Comment</small>
        <ul  class="list-group list-group-flush" style="background: fixed;">
        <div id="comment_box_cr">
        <div id="call_ticket_comment_cr">
        '; 
        include('get_comment_cr.php');
        echo '
        </div>
        </div>
        </ul> 
        <textarea id="comment_input_cr" style="margin-top:0px;margin-bottom:10px;font-size: 14px;" class="form-control" placeholder="Leave a comment here..." rows="4" style="height: 100px"></textarea>
       ';
      //  if($_SESSION["username"]=="poojaroonwit"){
        echo '
        <div class="mb-3">
          <input type="file" id="actual-btn" name="actual-btn[]" multiple hidden/>
          <label id="label_file" name="label_file" for="actual-btn"><ion-icon name="attach-outline"></ion-icon>Attach file or image</label>
          <span id="file-chosen"> </span>
        </div>
      ';
      // }
       echo ' <button type="button" class="btn btn-outline-primary btn-sm" onClick="comment_cr_id_with_file('.$id.')"  >Add comment</button></div>';
        echo'
        <div class="col-4" >
        <div style="margin-left: 10px;margin-right: 10px;">
        <small style="display:block"><strong style="color:gray">Ticket Status</strong></small>
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
        
echo "<script>console.log('".$_SESSION["department"]."');</script>";
        if(strpos($_SESSION["department"],"Content")!==false or $_SESSION["department"]==""){
            echo '<select class="form-select form-select-lg mt-2" id="cr_edit_status" name="cr_edit_status" onchange="update_cr_detail('.$id.','.$cr_edit_status.')" style="border: 0px;font-weight: bold;" aria-label=".form-select-lg example">
            '.$cr_op.'
            </select>';
            echo '
            <hr>
            <div class="row">
              <div class="col" style=" padding-left: 25px;">assign to </div>
              <div class="col">
              <select class="form-select form-select-sm"  id="cr_edit_case_officer" name="cr_edit_case_officer" onchange="update_cr_detail('.$id.','.$cr_edit_case_officer.')"  style="border: 0px;font-weight: bold;" aria-label=".form-select-lg example">
              '.$username_op.'
              </select>
              </div>
            </div>';
            echo '
            <div class="row">
              <div class="col" style=" padding-left: 25px;">'.$case_name."Tell : ".$office_tell.'</div>
            </div>
            <hr>';
            // end contact
            // ---check list
          if($_SESSION['username']=='poojaroonwit'){
            ?>
            <div id="list_cr_box">   
              <div id="list_cr">        
              <div class="d-grid gap-1 d-md-flex justify-content-md-end" style="margin-bottom: 8px;">
                <button class="btn btn-primary btn-sm" onclick="add_cr_list()" type="button"><ion-icon name="add-outline"></ion-icon> Add</button>
              </div>

              <div class="mb-3 row">
                <div class="col-2" style="padding: 3px;">
                  <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm" aria-label=".form-control-sm example">
                </div>
                <div class="col" style="padding: 3px;">
                  <select class="form-select form-select-sm" aria-label="Default select example">
                    <option selected>status</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
                <div class="col" style="padding: 3px;">
                  <select class="form-select form-select-sm" aria-label="Default select example">
                    <option selected>update type</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
                <div class="col" style="padding: 3px;">
                  <select class="form-select form-select-sm" aria-label="Default select example">
                    <option selected>update due reason</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
                <div class="col-1" style="padding: 3px;">
                   <ion-icon name="trash-outline"></ion-icon>
                </div>
              </div>
              </div>
              </div>


            <?php

          }
            echo '<hr>';
            // ---- end check list
            // start detail
            echo '
            <ul class="list-group">
            <li class="list-group-item" style="display: inline-flex;background: #dee2e6;"><div class="col-6 fw-bold ">ref cto</div><div class="col-6">
            <input class="form-control form-control-sm" id="cr_edit_cto_ref" name="cr_edit_cto_ref" onchange="update_cr_detail('.$id.','.$cr_edit_ref_cto.')" type="text" style="border: 0px;" placeholder="Default input" aria-label="default input example" value="'.$cto_ref.'"> 
            </div>
            </li>
            <li class="list-group-item" style="display: inline-flex;background: #dee2e6;"><div class="col-6 fw-bold ">website</div><div class="col-6">
            <select multiple="multiple"   id="cr_edit_platform_issue[]" name="cr_edit_platform_issue[]" onchange="update_cr_detail('.$id.','.$cr_edit_platform_issue.')"class="multiple-select_cr_edit" style="border: 0px;font-weight: bold;" aria-label=".form-select-lg example">
            '.$website_op.'
            </select>
            </div>
            </li>
            <li class="list-group-item" style="display: inline-flex;background: #dee2e6;"><div class="col-6 fw-bold ">type</div><div class="col-6">
            <select class="form-select form-select-sm" id="cr_edit_ticket_type" name="cr_edit_ticket_type" onchange="update_cr_detail('.$id.','.$cr_edit_ticket_type.')" style="border: 0px;font-weight: bold;" aria-label=".form-select-lg example">
            '.$type_op.'
            </select>
            </div></li>
            <li class="list-group-item" style="display: inline-flex;background: #dee2e6;"><div class="col-6 fw-bold ">sku</div><div class="col-6">
            <input class="form-control form-control-sm" id="cr_edit_sku" name="cr_edit_sku" onchange="update_cr_detail('.$id.','.$cr_edit_sku.')" type="text" style="border: 0px;" placeholder="" aria-label="default input example" value="'.$sku.'"> 
            </div>
            </li>
            <li class="list-group-item" style="display: inline-flex;background: #dee2e6;"><div class="col-6 fw-bold ">effective_date</div><div class="col-6">
            <input class="form-control form-control-sm" id="cr_edit_effective_date" name="cr_edit_effective_date" onchange="update_cr_detail('.$id.','.$cr_edit_effective_date.')" type="datetime-local" style="border: 0px;" placeholder="" aria-label="default input example" value="'.$effective_date_edit.'"> 
            </div></li>
            </ul>
            <br>
            '.$list_attachment.'
            <br>
            <small style="display:block"><strong style="color:gray">Internal</strong></small>
            <div class="mb-3">
            <label for="exampleDataList" class="form-label">Update resone</label>
              <input class="form-control form-control-sm" list="datalistOptions"  onchange="update_cr_detail('.$id.','.$cr_edit_content_request_reson.')" id="cr_edit_content_request_reson" name="cr_edit_content_request_reson" placeholder="Type to search..." value="'.$content_request_reson.'">
              <datalist id="datalistOptions">
              '.$content_request_reson_op.'
              </datalist>
              </div>
            <div class="mb-3">
            <div class="mb-3">
            <label for="exampleDataList" class="form-label">Request by</label>
              <input class="form-control form-control-sm" list="datalistOptionsrequestby"  onchange="update_cr_detail('.$id.','.$cr_edit_request_by.')" id="cr_edit_request_by" name="cr_edit_request_by" placeholder="Type to search..." value="'.$request_by.'">
              <datalist id="datalistOptionsrequestby">
              '.$username_op.'
              </datalist>
              </div>
            <div class="mb-3">
            <label>Note</label>
            <label for="exampleFormControlTextarea1" class="form-label">Internal note</label>
            <textarea id="cr_edit_note" name="cr_edit_note" onchange="update_cr_detail('.$id.','.$cr_edit_note.')"  class="form-control"  rows="5">'.$note.'</textarea>
            </div>';
        }else{
           echo '<h4 style="margin:10px">'.$status.'</h4>'; 
           echo '  
           <hr>
           <ul class="list-group">
           <li class="list-group-item" style="display: inline-flex;border: 0px;background: aliceblue;"><div class="col-6 fw-bold ">assign</div><div class="col-6">'.$case_officer.'</div></li>
           <li class="list-group-item" style="display: inline-flex;border: 0px;background: aliceblue;"><div class="col-6 fw-bold ">name</div><div class="col-6">'.$case_name.'</div></li>
           <li class="list-group-item" style="display: inline-flex;border: 0px;background: aliceblue;"><div class="col-6 fw-bold ">office tell</div><div class="col-6">'.$office_tell.'</div></li>
           <li class="list-group-item" style="display: inline-flex;border: 0px;background: aliceblue;"><div class="col-6 fw-bold ">ref cto</div><div class="col-6">'.$cto_ref.'</div></li>
           <li class="list-group-item" style="display: inline-flex;border: 0px;background: aliceblue;"><div class="col-6 fw-bold ">website</div><div class="col-6">'.$platform_issue.'</div></li>
           <li class="list-group-item" style="display: inline-flex;border: 0px;background: aliceblue;"><div class="col-6 fw-bold ">type</div><div class="col-6">'.$type.'</div></li>
           <li class="list-group-item" style="display: inline-flex;border: 0px;background: aliceblue;"><div class="col-6 fw-bold ">sku</div><div class="col-6">'.$sku.'</div></li>
           <li class="list-group-item" style="display: inline-flex;border: 0px;background: aliceblue;"><div class="col-6 fw-bold ">effective_date</div><div class="col-6">'.$effective_date.'</div></li>
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
    var comment = document.getElementById("comment_input_cr").value;
    document.getElementById('comment_input_cr').value = ''; //clear value
    if (id) {
        $.post("action/action_comment_cr.php", {
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

function add_cr_list() {
    var node = document.createElement("DIV");
    var new_list = document.getElementById("list_cr")
    var list_box = document.getElementById("list_cr_box")
    node.appendChild(list_box);
    document.getElementById("list_box").appendChild(node);
   
}

function comment_cr_id_with_file(id) {
    var form_data = new FormData();
    var comment = document.getElementById("comment_input_cr").value;
    document.getElementById('comment_input_cr').value = ''; //clear value
    // var files = document.getElementById('actual-btn').files;
    var ins = document.getElementById('actual-btn').files.length;
    for (var x = 0; x < ins; x++) {
        form_data.append("files[]", document.getElementById('actual-btn').files[x]);
    }
    // form_data.append("files", files)              // Appending parameter named file with properties of file_field to form_data
    form_data.append("comment", comment) // Adding extra parameters to form_data
    form_data.append("id", id)
    $.ajax({
        url: "action/action_comment_cr.php",
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
        $.post("action/action_update_cr_detail.php", {
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
$(function() {
    $(".multiple-select_cr_edit").multipleSelect()
});
</script>