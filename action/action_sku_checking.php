<?php
  $sku_list= $_POST['sku_list'];
  trim($sku_list," ");
  date_default_timezone_set("Asia/Bangkok");
  $con= mysqli_connect("localhost","cdse_admin","@aA417528639","all_in_one_project") or die("Error: " . mysqli_error($con));
  mysqli_query($con, "SET NAMES 'utf8' ");
  $sku_list_ex = explode("\n", $sku_list);
  $sku_list_array = array();
    foreach ( $sku_list_ex as $sku ) {
        if($sku <> '' and $sku <> null){
            array_push($sku_list_array,"'".trim($sku," ")."'");
        }        
    }
        $sku_list = implode(',',$sku_list_array);
    
        $query = "SELECT * FROM sku_list where sku in (".$sku_list .") ORDER BY id DESC " or die("Error:" . mysqli_error());
        $result = mysqli_query($con, $query);
        $sku_item_check = " ";
        while($row = mysqli_fetch_array($result)) {
            $sku_item_check .= $row["sku"]." > ".$row["csg_id"]."\n";

        }

        if($sku_item_check == " "){
            
            echo '<div class="alert alert-success" role="alert">
                        ตรวจไม่พบ sku ที่ซ้ำบนระบบ service-gate
                  </div>'
        }else{
            echo '<div class="alert alert-danger" role="alert">
            ตรวจจพบ sku ด้านล่าง ซ้ำในฐานข้องมูลของ <strong>SERVICE-GATE\n
            เมื่อยืนยัน accept ระบบจะเปลี่ยน ให้ sku เหล่านั้นเป็น sku ของ ticket ที่กด accept</strong>\n
            ';
            echo $sku_item_check;
            echo '</div>';
        }
        echo '<strong>ปล.การตรวจสอบกับฐานข้อมูล MDC ยังทำไม่เสร็จ</strong>';
        


?>