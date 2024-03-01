<?php
 session_start();
 include($_SERVER['DOCUMENT_ROOT']."/connect.php");
function get_card($status){
global $con;
  if($status=='Close'){
    $limit = 'limit 5';
    $sort = 'update_date DESC';
  }else{
    $sort = 'id ASC';
  }
  $query = "SELECT * FROM all_in_one_project.content_request  where status = '".$status."' ORDER by ".$sort." ".$limit ;
  $result = mysqli_query($con, $query);
  // $result_count = mysqli_query($con, $query_count);
     while($row = mysqli_fetch_array($result)) {
      //count comment
      $sql="SELECT count(*) as total from all_in_one_project.comment where ticket_type = 'content_request' and ticket_id=".$row['id'];
      $result_cmcr=mysqli_query($con,$sql);
      $data=mysqli_fetch_assoc($result_cmcr);
      $count_comment_cr = $data['total'];
      //cut description
        if(strlen($row["description"])>50){
            $description  = htmlspecialchars_decode($row["description"],ENT_NOQUOTES);
            $description = substr(strip_tags($description),0,50)." ...";
          }else{
            $description  = htmlspecialchars_decode($row["description"],ENT_NOQUOTES);
            $description = strip_tags($description);
          }
      //piority
      if($row["piority"]=="Urgent"){
        $border =   'border-color: transparent;border-left:solid 5px red;min-height:170px';
        // $border =  'border-color: #ffc7cc;background: #ffc7cc;color: red;';
      }elseif ($row["piority"]=="High"){
          $border =   'border-color: transparent;border-left:solid 5px  #ffd967;min-height:170px';
          // $border =   'border-color: #ffd967;background: #ffd967;color: #795b00;';
      }elseif($row["piority"]=="Medium"){
          $border =   'border-color: transparent;min-height:170px';
      }else{
          $border =   'border-color: transparent;min-height:170px';
      }
    echo    '
    <div class="card" id="card_cr_'.$row["id"].'" style="margin-top:15px;'.$border.'" draggable="true" ondragstart="drag_card_cr(event)">
        <div class="card-body shadow" >
            <h6 class="card-title" style="font-size:14px"><strong style="color:red">CR-'.$row["id"].'</strong> '.$row["title"].'</h6>
            <p class="card-text" style="color:gray;font-size:13px"  data-bs-toggle="offcanvas" data-bs-target="#detail_cr" aria-controls="offcanvasExample" onclick="cr_id_toggle('.$row['id'].','.$count_comment_cr.')">'.$description.'</p>
            <ion-icon name="chatbubbles-outline" class="icon_ocv"></ion-icon>
            <small style="color: #adb5bd;font-size:12px;">'.$count_comment_cr.' Comment <br><strong>'.$row["case_officer"].'</strong> </small>
        </div>
    </div>
    ';
    }
  mysqli_close($con);
}
  ?>