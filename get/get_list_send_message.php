<?php
 session_start();
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $query_tg = "SELECT * FROM all_in_one_project.message_box
  where create_by = '".$_SESSION["username"]."' ORDER BY id  DESC " or die("Error:" . mysqli_error($con));
  $result = mysqli_query($con, $query_tg);
  while($row = mysqli_fetch_array($result)) {
      if($row["important"]==1){
        $important = '<ion-icon name="star"></ion-icon>';
      }else{
        unset($important);
      }

        echo "<tr class='shadow-sm p-3 mb-5 bg-body rounded' style='border-bottom: 1px solid #e0e0e0;'>";
        echo "<td style='width: 10%;' >".$important."</td>";
        echo "<td style='width: 15%;' >MS-".$row["id"]."</td>";
        echo "<td style='width: 60%;width: 60%;' >".$row["title"]."</td>";  
        echo "<td style='width: 15%;'><button type='button' class='btn btn-primary btn-sm' name='ms_send_bt_id_".$row["id"]."' id='ms_send_bt_id_".$row["id"]."' data-bs-toggle='modal' onclick='message_send_get(".$row["id"].")' data-bs-target='#messagesendmodel'><ion-icon name='mail-open-outline'></ion-icon> ตรวจสอบ</button></td>";
        echo "</tr>";
    } 

  mysqli_close($con); 
  ?>

<div class="modal fade" id="messagesendmodel" tabindex="-1" aria-labelledby="messagesendmodelLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div id="callmodel_message_send_detail">
            </div>

        </div>
    </div>
</div>
<script>
function message_send_get(id) {
    if (id) {
        $.post("base/modal/model_message_detail.php", {
                id: id
            },
            function(data) {
                $('#callmodel_message_send_detail').html(data);
            });
    }
}
</script>