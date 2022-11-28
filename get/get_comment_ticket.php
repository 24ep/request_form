<?php
//issue get
session_start();
function get_comment($id){
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT * FROM comment WHERE ticket_type = 'add_new' and ticket_id = ".$id." ORDER BY id ASC" or die("Error:" . mysqli_error($con));
   $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
        //get image or file
        $query_attach = "SELECT * FROM attachment WHERE ticket_type = 'cme_comment' and ticket_id = ".$row['id']." ORDER BY id ASC" or die("Error:" . mysqli_error($con));
        $result_attach = mysqli_query($con, $query_attach);
        while($row_attach = mysqli_fetch_array($result_attach)) {
            $herf = str_replace("../..",'../..',$row_attach['file_path'].$row_attach['file_name']);
            if($row_attach['is_image']==1){
                $list_image .= '<div class="baguetteBoxFour gallery"><a target= "_blank" href="'.$herf.'"><img src="'.$row_attach['file_path'].$row_attach['file_name'].'"  class="img-thumbnail" alt="'.$row_attach['file_name'].'" style="object-fit:cover;width:180px;height:180px;margin-right:5px"></a><div>';
            }else{
                $list_file .= '<a type="button" href="'.$herf.'" style="margin-right:0px;margin-bottom:5px;font-size: 12px;border-color: #7ec1a2;"class="btn btn-outline-success btn-sm "><ion-icon name="document-outline" style="font-size: 12px;"></ion-icon>'.$row_attach['file_name'].'</a>';
            }
        }
        //end
    $comment = $row['comment'];
    $comment = str_replace("#need_more_image ","<span style='color:#842029;'><strong><ion-icon name='alert-circle-outline'></ion-icon> Need more image</strong></span><hr style='margin:10px 0px 10px 0px'>",($comment));
    $comment = str_replace("#need_more_data ","<span style='color:#842029;'><strong><ion-icon name='alert-circle-outline'></ion-icon> Need more data</strong></span><hr style='margin:10px 0px 10px 0px'>",($comment));
    $comment = str_replace("#need_more_image","<span style='color:#842029;'><strong><ion-icon name='alert-circle-outline'></ion-icon> Need more image</strong></span><hr style='margin:10px 0px 10px 0px'>",($comment));
    $comment = str_replace("#need_more_data","<span style='color:#842029;'><strong><ion-icon name='alert-circle-outline'></ion-icon> Need more data</strong></span><hr style='margin:10px 0px 10px 0px'>",($comment));
    $comment = str_replace("#traffic_need_more","<span style='color:#842029;'><strong><ion-icon name='alert-circle-outline'></ion-icon> Traffic need more</strong></span><hr style='margin:10px 0px 10px 0px'>",($comment));
    $query_account = "SELECT * FROM account where username = '".$row["comment_by"]."' ORDER BY id DESC " or die("Error:" . mysqli_error($con));
    $result_account = mysqli_query($con, $query_account);
    while($row_account = mysqli_fetch_array($result_account)) {
    $comment_by_nickname = $row_account['nickname'];
    $comment_by = $row_account['username'];
    $comment_by_dp = $row_account['department'];
    if(strpos($comment_by_dp,"Content")!==false){
        $comment_by_dp = str_replace("Content ","Ⓒ",$comment_by_dp);
    }elseif(strpos($comment_by_dp,"Buyer")!==false){
        $comment_by_dp = str_replace("Buyer ","Ⓑ",$comment_by_dp);
    }
    // $case_name = "Contact : ".$row['firstname']." ".$row['lastname']." ( ".$case_nickname." ) ";
    // $office_tell = $row['office_tell'];
    }
        if($row["comment_by"]==$_SESSION["username"] or $row["comment_by"]==$_SESSION["nickname"]){
                        //driver style only
            if(strpos($row['comment'],"need_more")!==false){
                $background_cm = '';
                $sd = 'style="background: #f8d7da;color:#842029!important;"';
                $last_comment = "need_more";
                $last_comment_by = $row['comment_by'];
            }else{
                $background_cm = 'bg-dark';
                $sd="";
                $botton_status_change ='';
                $last_comment = "non_need_more";
                $last_comment_by = $row['comment_by'];
            }
            echo    '<div class="d-grid gap-2 d-md-flex justify-content-md-end" style="width:100%">'. $list_file.'</div><div class="d-grid gap-2 d-md-flex justify-content-md-end" style="width:100%;margin-bottom:8px;">'.$list_image.'</div>';
            echo '<div class="d-grid gap-2 d-md-flex justify-content-md-end" style="width:100%">';
                echo "<span class='comment_label  shadow-sm cl_right badge rounded-pill ".$background_cm." text-light' ".$sd.">".$comment."</span>";
            echo '</div>';
            echo '<small class="d-grid gap-2 d-md-flex justify-content-md-end" style="width:100%;margin-bottom: 15px;">';
                echo "<small class='form-text' style='margin-right: 10px;text-align: end;'>".$comment_by." - ".$comment_by_nickname." | ". $comment_by_dp."<hr style='margin:2px'>".date('d/m/y h:i A',strtotime($row['comment_date']))."</small>";
            echo '</small>';
        }else{
            if(strpos($row['comment'],"need_more")!==false){
                $background_cm = '';
                $sd = 'style="background: #f8d7da;color:#842029!important;"';
                $last_comment = "need_more";
                $last_comment_by = $row['comment_by'];
            }else{
                $background_cm = '';
                $sd="style='background: #e3e3e3;'";
                $botton_status_change ='';
                $last_comment = "non_need_more";
                $last_comment_by = $row['comment_by'];
            }
            echo '<div style="width:100%">'. $list_file.'</div><div class="baguetteBoxFour gallery" style="width:100%;margin-bottom:8px;">'.$list_image.'</div>';
            echo '<div  style="width:100%">';
                echo "<span class='comment_label shadow-sm cl_left badge rounded-pill ".$background_cm." text-dark ' ".$sd." >".$comment."</span>";
            echo '</div>';
            echo '<div style="width:100%;margin-bottom: 15px;">';
            echo "<small class='form-text' style='margin-right: 10px;text-align: start;'>".$comment_by." - ".$comment_by_nickname." | ". $comment_by_dp."<hr style='margin:2px;width: 40%;'>".date('d/m/y h:i A',strtotime($row['comment_date']))."</small>";
            echo '</div>';
        }
        unset($list_file);
        unset($list_image);
    }
}

function get_bt_comment($id){
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query = "SELECT * FROM comment WHERE ticket_id = ".$id." ORDER BY id ASC" or die("Error:" . mysqli_error($con));
   $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
        if(strpos($row['comment'],"need_more")!==false){
            $last_comment = "need_more";
            $last_comment_by = $row['comment_by'];
        }else{
            $last_comment = "non_need_more";
            $last_comment_by = $row['comment_by'];
        }
    }
    if($last_comment == "need_more" and $_SESSION['username']<>$last_comment_by){
        $send_type = "'send_back_data'";
        $bt_comment_type ='
        <input type="text" class="form-control " style="border-color: #ffc107;" id="comment_input" name="comment_input" placeholder="กรอก link ของข้อมูลตอบกลับที่นี่" aria-label="say something.." aria-describedby="button-addon2">';
        $bt_comment_type .=  '<button class="btn btn-outline-secondary"  style="padding: 3px;border-color: #ffc107;" type="button" id="button-attachment">
              <input type="file" id="actual-btn_cme" name="actual-btn_cme[]" multiple hidden />
              <label id="label_file_cme" name="label_file_cme" for="actual-btn_cme">
                  <ion-icon style="margin:0px" name="attach-outline"></ion-icon>
              </label>
              <span id="file-chosen_cme" style="padding:0px"> </span></button>';
        $bt_comment_type .='<button class="btn btn-outline-secondary" style="border-color: #ffc107;color:#ffc107;" onClick="comment_ticket_id('.$id.','.$send_type.')" type="button" id="button-send">Send back data</button>';
   }else{
       $send_type = "'send_message'";
       $bt_comment_type ='
       <input type="text" class="form-control " id="comment_input" name="comment_input" placeholder="say something .. " aria-label="say something.." aria-describedby="button-addon2">';
        $bt_comment_type .=  '<button class="btn btn-outline-secondary"  style="padding: 3px;border-color: #c3c6ca;" type="button" id="button-attachment">
              <input type="file" id="actual-btn_cme" name="actual-btn_cme[]" multiple hidden />
              <label id="label_file_cme" name="label_file_cme" for="actual-btn_cme">
                  <ion-icon style="margin:0px" name="attach-outline"></ion-icon>
              </label>
              <span id="file-chosen_cme" style="padding:0px"> </span></button>';
       $bt_comment_type .='<button class="btn btn-outline-secondary"  style="border-color: #c3c6ca;" onClick="comment_cme_id_with_file('.$id.','.$send_type.')" type="button" id="button-send">Send</button>';
   }
   return  $bt_comment_type;
}
$bt_comment_type = get_bt_comment($id);
get_comment($id);
// if($status =='on-productions'){
//     echo '<small style="text-align: center;color:#b7b5b5;">This ticket had been accepted. if you have a comment content team also get notification but status will not change to waiting confirm</small>';
// }
echo '<script>
        var elem = document.getElementById("over_comment");
        elem.scrollTop = elem.scrollHeight;
    </script>';
?>
