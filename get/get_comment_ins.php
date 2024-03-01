<?php
 session_start();
//issue get
session_start();
$id = $_POST['id'];
$comment = $_POST['comment'];
function get_comment_ins($id){
    date_default_timezone_set("Asia/Bangkok");
    $con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");
    $query = "SELECT * FROM comment WHERE ticket_type = 'ins_add_new_job' and ticket_id = ".$id." ORDER BY id ASC" or die("Error:" . mysqli_error($con));
     $result = mysqli_query($con, $query);
      while($row = mysqli_fetch_array($result)) {
        $query_attach = "SELECT * FROM attachment WHERE ticket_type = 'ins_add_new_job' and ticket_id = ".$row['id']." ORDER BY id ASC" or die("Error:" . mysqli_error($con));
        $result_attach = mysqli_query($con, $query_attach);
        while($row_attach = mysqli_fetch_array($result_attach)) {
            $herf = str_replace("../..",'../..',$row_attach['file_path'].$row_attach['file_name']);
            if($row_attach['is_image']==1){
                $list_image .= '<a target= "_blank" href="'.$herf.'"><img src="'.$herf.'"  class="img-thumbnail" alt="'.$row_attach['file_name'].'" style="object-fit:cover;width:180px;height:180px;margin-right:5px"></a>';
            }else{

                $list_file .= '<a type="button" href="'.$herf.'" style="margin-right:8px;margin-bottom:5px;font-size: 12px;border-color: #7ec1a2;"class="btn btn-outline-success btn-sm "><ion-icon name="document-outline" style="font-size: 12px;"></ion-icon>'.$row_attach['file_name'].'</a>';
            }
        }
      echo   '
      <li class="list-group-item" style="position: initial;padding-left:0px;border-color: #e9ecef;    border-right-width: 0px;
      border-left-width: 0px;
      border-top-width: 0px;">
      <div class="ms-2 me-auto">
      <div >
          <div class="fw-bold">'.$row['comment_by'].'</div><small style="color:gray">Comment '.$row['comment_date'].'</small>
      </div>
      <div style="margin-right: 7px;">'.$list_file.'</div>
          <p>'.$row['comment'].'</p>
          <div class="baguetteBoxFour gallery">'.$list_image.'</div>
      </div>
      </li>';
  unset($list_image);
  unset($list_file);
      }
  }
  get_comment_ins($id);
//   mysqli_close($con);
?>
