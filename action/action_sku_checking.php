<?php
  $sku_list= $_POST['sku_list'];
  trim($sku_list," ");

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
            $sku_item_check .= $row["sku"]." > ".$row["csg_id"]ว

        }

        if($sku_item_check == " "){

        }else{
            echo 'ตรวจจพบ sku ด้านล่าง ซ้ำในฐานข้องมูลของ <strong>SERVICE-GATE&#10;
            เมื่อยืนยัน accept ระบบจะเปลี่ยน ให้ sku เหล่านั้นเป็น sku ของ ticket ที่กด accept</strong>&#10';
            echo $sku_item_check;
        }
        echo 'ปล.การตรวจสอบกับฐานข้อมูล MDC ยังทำไม่เสร็จ'
        


?>