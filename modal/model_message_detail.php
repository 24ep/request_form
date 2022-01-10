<?php
 session_start();
$id=$_POST["id"];
date_default_timezone_set("Asia/Bangkok");
$con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
$query = "SELECT message_box.id as target_ms_id,target.target_username as username,target.msid as msid,target.id as trmsid,message_box.title as title,message_box.description as description 
  FROM target_message_box as target left join message_box as message_box on target.msid = message_box.id 
  where target.target_username = '".$_SESSION["username"]."' and target.msid = ".$id or die("Error:" . mysqli_error());
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
    $description = htmlspecialchars_decode($row["description"],ENT_NOQUOTES);
    echo '<div class="modal-header">
    <h5 class="modal-title" id="messagemodelLabel">'.$row["title"].'</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body" id="messagebody">
    '.$description.'
    <hr>';
    ?>
    <div style="margin:20px">
    <ul class="list-group list-group-flush" style="background: fixed;">
        <div id="comment_box_ms">
                <div id="call_ticket_comment_ms">
                    <?php include('../get/get_comment_ms.php'); ?>
        </div>
        </div>
    </ul>
    <small style="font-weight: bolder;color: #adb5bd;">
            <ion-icon name="chatbubbles-outline"></ion-icon>Comment
    </small>
    <textarea id="comment_input_ms" style="margin-top:0px;margin-bottom:10px;font-size: 14px;" class="form-control" placeholder="Leave a comment here..." rows="4" style="height: 100px"></textarea>
    <div class="mb-3">
        <input type="file" id="actual-btn_ms" name="actual-btn_ms[]" multiple hidden />
        <label id="label_file_ms" name="label_file_ms" for="actual-btn_ms">
            <ion-icon name="attach-outline"></ion-icon>Attach file or image
        </label>
        <span id="file-chosen_ms"> </span>
    </div>
    <button type="button" class="btn btn-outline-primary btn-sm" onClick="comment_ms_id_with_file(<?php echo  $_POST['id']; ?>)">Add comment</button>
    </div>
    <?php
    echo '</div>';
$target_ms_id = $row['trmsid'];

}

$sql_update_read = "UPDATE target_message_box SET readable = 1,read_date=CURRENT_TIMESTAMP where id=".$target_ms_id;
$query_update_read = mysqli_query($con,$sql_update_read);




?>
<script>
function update_total_unread_div_action() {
   
   $.post("base/get/get_count_unread_message.php", {
       },
       function(data) {
           $('#total_unread_div').html(data);
           $('#total_unread_div_in').html(data);
           
           
       });

}
update_total_unread_div_action()
//other content
var actualBtn = document.getElementById('actual-btn_ms');
var fileChosen = document.getElementById('file-chosen_ms');
var fileChosen_bt = document.getElementById('label_file_ms');
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
function comment_ms_id_with_file(id) {
    var form_data = new FormData();
    var comment = document.getElementById("comment_input_ms").value;
    document.getElementById('comment_input_ms').value = ''; //clear value
    // var files = document.getElementById('actual-btn').files;
    var ins = document.getElementById('actual-btn_ms').files.length;
    for (var x = 0; x < ins; x++) {
        form_data.append("files[]", document.getElementById('actual-btn_ms').files[x]);
    }
    // form_data.append("files", files)              // Appending parameter named file with properties of file_field to form_data
    form_data.append("comment", comment) // Adding extra parameters to form_data
    form_data.append("id", id)
    $.ajax({
        url: "base/action/action_comment_ms.php",
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data, // Setting the data attribute of ajax with file_data
        type: 'post',
        success: function(data) {
            $('#call_ticket_comment_ms').html(data);
            document.getElementById('comment_box_ms').scrollBy(0, document.getElementById(
                "call_ticket_comment_ms").offsetHeight);
            document.getElementById('actual-btn_ms').value = ''; //clear value
            fileChosen_bt.textContent = ' + Attach file or image';
        }
    });
}


</script>