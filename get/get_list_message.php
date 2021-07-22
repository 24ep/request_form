<?php
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query_tg = "SELECT message_box.id as id, target.target_username as username, target.readable as readable, target.accepted_date as accepted_date, target.read_date as read_date, target.create_date as create_date, target.update_date as update_date, target.msid as msid, message_box.title as title,message_box.description as description 
  FROM all_in_one_project.target_message_box as target
  left join all_in_one_project.message_box as message_box on target.msid = message_box.id where target.target_username = '".$_SESSION["username"]."' ORDER BY message_box.id  DESC " or die("Error:" . mysqli_error());
  $result = mysqli_query($con, $query_tg);
  while($row = mysqli_fetch_array($result)) {
      if($row["important"]==1){
        $important = '<ion-icon name="star"></ion-icon>';
      }else{
        unset($important);
      }

      if($row["readable"]==0){
        $button_check = "<td style='width: 20%;'><button type='button' class='btn btn-danger btn-sm' name='ms_bt_id_".$row["id"]."' id='ms_bt_id_".$row["id"]."' data-bs-toggle='modal' onclick='message_get(".$row["id"].")' data-bs-target='#messagemodel'><ion-icon name='mail-unread-outline'></ion-icon> ตรวจสอบ</button></td>";
        unset($st_font_color);
      }else{
        $button_check = "<td style='width: 20%;'><button type='button' class='btn btn-secondary btn-sm' name='ms_bt_id_".$row["id"]."' id='ms_bt_id_".$row["id"]."' data-bs-toggle='modal 'onclick='message_get(".$row["id"].")'  data-bs-target='#messagemodel'><ion-icon name='mail-open-outline'></ion-icon> ตรวจสอบแล้ว</button></td>";
        $st_font_color = "color: grey"; 
      }
        echo "<tr class='shadow-sm p-3 mb-5 bg-body rounded' style='border-bottom: 1px solid #e0e0e0;'>";
        echo "<td style='width: 10%;". $st_font_color."' >".$important."</td>";
        echo "<td style='width: 15%;". $st_font_color."' >MS-".$row["id"]."</td>";
        echo "<td style='width: 55%;". $st_font_color."' >".$row["title"]."</td>";  
        echo $button_check;
        echo "</tr>";
    } 

  mysqli_close($con); 
  ?>

<div class="modal fade" id="messagemodel" tabindex="-1" aria-labelledby="messagemodelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div id="callmodel_message_detail">
</div>

        </div>
    </div>
</div>
<script>
function message_get(id) {
    if (id) {
        $.post("modal/model_message_detail.php", {
                id: id
            },
            function(data) {
                $('#callmodel_message_detail').html(data);
            });
    }
}
</script>